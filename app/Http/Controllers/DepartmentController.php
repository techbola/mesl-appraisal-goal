<?php

namespace App\Http\Controllers;

use App\Company;
use App\Department;
use App\Division;
use App\Group;
use App\Subsidiary;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = Department::all();
        return view('departments.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies    = Company::all();
        $subsidiaries = Subsidiary::all();
        $divisions    = Division::all();
        $groups       = Group::all();
        $departments  = \DB::table('tblDepartment')
            ->leftJoin('tblCompany', 'tblDepartment.CompanyID', '=', 'tblCompany.CompanyRef')
            ->leftJoin('tblSubsidiary', 'tblDepartment.SubsidiaryID', '=', 'tblSubsidiary.SubsidiaryRef')
            ->leftJoin('tblDivision', 'tblDepartment.DivisionID', '=', 'tblDivision.DivisionRef')
            ->leftJoin('tblGroup', 'tblDepartment.GroupID', '=', 'tblGroup.GroupRef')
            ->get();
        return view('departments.create', compact('departments', 'companies', 'subsidiaries', 'divisions', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departments = new Department($request->all());
        $this->validate($request, [
            'CompanyID'    => 'required',
            'Department'   => 'required',
            'SubsidiaryID' => 'required',
            'DivisionID'   => 'required',
            'GroupID'      => 'required',
        ]);
        if ($departments->save()) {
            return redirect()->route('departments.create')->with('success', 'Departments was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Departments failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department   = Department::where('DepartmentRef', $id)->first();
        $companies    = Company::all();
        $subsidiaries = Subsidiary::all();
        $divisions    = Division::all();
        $groups       = Group::all();
        $departments  = \DB::table('tblDepartment')
            ->leftJoin('tblCompany', 'tblDepartment.CompanyID', '=', 'tblCompany.CompanyRef')
            ->leftJoin('tblSubsidiary', 'tblDepartment.SubsidiaryID', '=', 'tblSubsidiary.SubsidiaryRef')
            ->leftJoin('tblDivision', 'tblDepartment.DivisionID', '=', 'tblDivision.DivisionRef')
            ->leftJoin('tblGroup', 'tblDepartment.GroupID', '=', 'tblGroup.GroupRef')
            ->get();
        return view('departments.edit', compact('department', 'departments', 'companies', 'subsidiaries', 'divisions', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $departments = \DB::table('tblDepartment')->where('DepartmentRef', $id);
        if ($departments->update($request->except(['_token', '_method']))) {
            return redirect()->route('departments.create')->with('success', 'Department was updated successfully');
        } else {
            return back()->withInput()->with('error', 'Department failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departments = Department::find($id);
        if ($departments->delete()) {
            return redirect()->route('departments.create')->with('success', 'Department was deleted successfully');
        } else {
            return back()->withInput()->with('error', 'Department failed to delete');
        }
    }
}
