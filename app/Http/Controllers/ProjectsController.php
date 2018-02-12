<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectUser;
use App\Company;
use App\User;
use Auth;
use Session;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $projects = Project::where('user_id', Auth::user()->id)->get();
            return view('projects.index')->withProjects($projects);
        } else {
            Session::flash('errors', 'Ensure you are logged in');
            return redirect()->route('login');
        }
        
        
    }

    public function adduser(Request $request)
    {
        $project = Project::find($request->input('project_id'));
        if (Auth::user()->id == $project->user_id) {
            $user = User::where('email', $request->input('email'))->first();

            $projectUser =ProjectUser::where('user_id', $user->id)->where('project_id', $project->id)->first();

            if ($projectUser) {
                Session::flash('success', 'user already exists');
                return redirect()->route('projects.show', ['project' => $project->id]);
            }

            if ($user && $project) {
                $project->users()->attach($user->id);
                Session::flash('success', 'user added to project successfuly');
                return redirect()->route('projects.show', ['project' => $project->id]);
            }
        } else {
            Session::flash('errors', 'Error incurred in adding user to project');
            return redirect()->route('projects.show', ['project' => $project->id]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        $companies = null;
        if (!$company_id) {
            $companies = Company::where('user_id' , Auth::user()->id)->get();
        }
        return view('projects.create',['company_id' =>$company_id])->withCompanies($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:100',
            'description'=>'required|max:255'
        ]);
        $project = new Project;
        if (Auth::check()) {
            
            $project->name = $request->name;
            $project->description = $request->description;
            $project->company_id = $request->company_id;
            $project->user_id = $request->user()->id;
            $project->save();

            if ($project->save()) {
                Session::flash('success', 'project Added Successfully');
                return redirect()->route('projects.show', $project->id);
            } else {
                return back()->withInput();
            }
        } else {
           return redirect()->route('projects.show', $project->id);
           Session::flash('errors', 'Ensure you have Logged in');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::where('id',$project->id)->first();
        $comments = $project->comments;
        return view('projects.show')->withProject($project)->withComments($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project = Project::find($project->id);
        return view('projects.edit')->withProject($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'description' => 'required|max:255'
        ]);
        $project = Project::find($project->id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();

        if ($project->save()) {
            Session::flash('success', 'Data updated successfuly');
            return redirect()->route('projects.show', $project->id);
        } else {
            Session::flash('errors', 'There was a problem saving your update. Try again.');
            return redirect()->route('projects.edit', $project->id);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project = Project::find($project->id);
        if ($project->delete()) {
            return redirect()->route('projects.index')->with('success', 'project was deleted successfuly.');
        } else {
            return back()->withInput()->with('error', 'An error was incurred in deleting the project');
        }

    }
}
