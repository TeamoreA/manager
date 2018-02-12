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
            $companies = Company::where('user_id', Auth::user()->id)->get();
            return view('companies.index')->withCompanies($companies);
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
        return view('companies.create');
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
        $company = new Company;
        if (Auth::check()) {
            
            $company->name = $request->name;
            $company->description = $request->description;
            $company->user_id = $request->user()->id;
            $company->save();

            if ($company->save()) {
                Session::flash('success', 'Company Added Successfully');
                return redirect()->route('companies.show', $company->id);
            } else {
                return back()->withInput();
            }
        } else {
           return redirect()->route('companies.show', $company->id);
           Session::flash('errors', 'Ensure you have Logged in');
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company = Company::find($company->id);
        return view('companies.show')->withCompany($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $company = Company::find($company->id);
        return view('companies.edit')->withCompany($company);
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
        $company = Company::find($company->id);
        $company->name = $request->name;
        $company->description = $request->description;
        $company->save();

        if ($company->save()) {
            Session::flash('success', 'Data updated successfuly');
            return redirect()->route('companies.show', $company->id);
        } else {
            Session::flash('errors', 'There was a problem saving your update. Try again.');
            return redirect()->route('companies.edit', $company->id);
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
        $company = Company::find($company->id);
        if ($company->delete()) {
            return redirect()->route('companies.index')->with('success', 'Company was deleted successfuly.');
        } else {
            return back()->withInput()->with('error', 'An error was incurred in deleting the company');
        }

    }
}
