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
            $books = Project::where('user_id', Auth::user()->id)->get();
            return view('books.index')->withBooks($books);
        } else {
            Session::flash('errors', 'Ensure you are logged in');
            return redirect()->route('login');
        }
        
        
    }

    public function adduser(Request $request)
    {
        $book = Project::find($request->input('book_id'));
        if (Auth::user()->id == $book->user_id) {
            $user = User::where('email', $request->input('email'))->first();

            $bookUser =bookUser::where('user_id', $user->id)->where('book_id', $book->id)->first();

            if ($bookUser) {
                Session::flash('success', 'user already exists');
                return redirect()->route('books.show', ['book' => $book->id]);
            }

            if ($user && $book) {
                $book->users()->attach($user->id);
                Session::flash('success', 'user added to book successfuly');
                return redirect()->route('books.show', ['book' => $book->id]);
            }
        } else {
            Session::flash('errors', 'Error incurred in adding user to book');
            return redirect()->route('books.show', ['book' => $book->id]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($genre_id = null)
    {
        $genres = null;
        if (!$genre_id) {
            $genres = Company::where('user_id' , Auth::user()->id)->get();
        }
        return view('books.create',['genre_id' =>$genre_id])->withGenres($genres);
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
        $book = new Project;
        if (Auth::check()) {
            
            $book->name = $request->name;
            $book->description = $request->description;
            $book->genre_id = $request->genre_id;
            $book->user_id = $request->user()->id;
            $book->save();

            if ($book->save()) {
                Session::flash('success', 'book Added Successfully');
                return redirect()->route('books.show', $book->id);
            } else {
                return back()->withInput();
            }
        } else {
           return redirect()->route('books.show', $book->id);
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
        $book = Project::where('id',$book->id)->first();
        $comments = $book->comments;
        return view('books.show')->withBook($book)->withComments($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $book = Project::find($book->id);
        return view('books.edit')->withBook($book);
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
        $book = Project::find($book->id);
        $book->name = $request->name;
        $book->description = $request->description;
        $book->save();

        if ($book->save()) {
            Session::flash('success', 'Data updated successfuly');
            return redirect()->route('books.show', $book->id);
        } else {
            Session::flash('errors', 'There was a problem saving your update. Try again.');
            return redirect()->route('books.edit', $book->id);
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
        $book = Project::find($book->id);
        if ($book->delete()) {
            return redirect()->route('books.index')->with('success', 'book was deleted successfuly.');
        } else {
            return back()->withInput()->with('error', 'An error was incurred in deleting the book');
        }

    }
}
