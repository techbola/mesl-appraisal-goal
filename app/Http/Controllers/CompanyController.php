<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Company;
use Illuminate\Http\Request;
use Image;
use File;

class CompanyController extends Controller
{


    public function index()
    {
        //
    }


    public function create()
    {
        // $companies = Company::first();
        // return view('companies.create', compact('companies'));
    }


    public function store(Request $request)
    {
        // $formInput = $request->except('LogoUrl');
        // $this->validate($request, [
        //     'Company' => 'required',
        //     'LogoUrl' => 'required|image|mimes:png,jpg,Jpeg|max:10000',
        // ]);
        // $image = $request->LogoUrl;
        // if ($image) {
        //     $imageName = $image->getClientOriginalName();
        //     $image->move('images/CompanyLogo', $imageName);
        //     $formInput['LogoUrl'] = $imageName;
        // }
        //
        // if (Company::create($formInput)) {
        //     return redirect()->route('companies.create')->with('success', 'Company name was created successfully');
        // } else {
        //     return redirect()->back()->withInput()->with('error', 'Company name failed to save');
        // }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
      $user = auth()->user();
      $company = Company::find($id);

      return view('companies.edit', compact('company'));
    }


    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'Company' => 'required',
      ]);

      $user = auth()->user();
      $company = Company::find($id);

      $company->Company = $request->Company;

      // START LOGO
      if ($request->hasFile('Logo') && $request->file('Logo')->isValid()) {

          $file = $request->file('Logo');
          $filename = strtolower($company->Slug . '.' . $request->Logo->extension());

          if (!File::exists(public_path('images/logos')) && File::exists(public_path('images'))) {
              File::makeDirectory(public_path('images/logos'));
          }

          Image::make($file)->orientate()->resize(300, null, function ($constraint) {$constraint->aspectRatio();})->save('images/logos/' . $filename);
          // Name to be saved to DB
          $company->Logo = $filename;
      }
      $company->update();
      // END LOGO

      return redirect()->back()->with('success', 'The company was updated successfully');

    }


    public function destroy($id)
    {
        //
    }
}
