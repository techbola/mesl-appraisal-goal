<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{


    public function index()
    {
        //
    }


    public function create()
    {
        $companies = Company::first();
        return view('companies.create', compact('companies'));
    }


    public function store(Request $request)
    {
        $formInput = $request->except('LogoUrl');
        $this->validate($request, [
            'Company' => 'required',
            'LogoUrl' => 'required|image|mimes:png,jpg,Jpeg|max:10000',
        ]);
        $image = $request->LogoUrl;
        if ($image) {
            $imageName = $image->getClientOriginalName();
            $image->move('images/CompanyLogo', $imageName);
            $formInput['LogoUrl'] = $imageName;
        }

        if (Company::create($formInput)) {
            return redirect()->route('companies.create')->with('success', 'Company name was created successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Company name failed to save');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
