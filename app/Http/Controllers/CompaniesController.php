<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Session;
use Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $genres = Company::where('user_id', Auth::user()->id)->get();
            return view('genres.index')->withGenres($genres);
        } else {
            Session::flash('errors', 'Ensure you are logged in');
            return redirect()->route('login');
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('genres.create');
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
            'description'=>'required|min:50|max:255'
        ]);
        $genre = new Company;
        if (Auth::check()) {
            
            $genre->name = $request->name;
            $genre->description = $request->description;
            $genre->user_id = $request->user()->id;
            $genre->save();

            if ($genre->save()) {
                Session::flash('success', 'genre Added Successfully');
                return redirect()->route('genres.show', $genre->id);
            } else {
                return back()->withInput();
            }
        } else {
           return redirect()->route('genres.show', $genre->id);
           Session::flash('errors', 'Ensure you have Logged in');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $genre)
    {
        $genre = Company::find($genre->id);
        return view('genres.show')->withGenre($genre);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $genre = Company::find($genre->id);
        return view('genres.edit')->withGenre($genre);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'description' => 'required|max:255'
        ]);
        $genre = Company::find($genre->id);
        $genre->name = $request->name;
        $genre->description = $request->description;
        $genre->save();

        if ($genre->save()) {
            Session::flash('success', 'Data updated successfuly');
            return redirect()->route('genres.show', $genre->id);
        } else {
            Session::flash('errors', 'There was a problem saving your update. Try again.');
            return redirect()->route('genres.edit', $genre->id);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $genre = Company::find($genre->id);
        if ($genre->delete()) {
            return redirect()->route('genres.index')->with('success', 'genre was deleted successfuly.');
        } else {
            return back()->withInput()->with('error', 'An error was incurred in deleting the genre');
        }

    }
}
