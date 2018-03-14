@extends('layouts.master')

@section('content')
<div class="panel panel-transparent">
    <div class="panel-heading">
        <div class="panel-title">
            Create New Department
        </div>
    </div>
    <div class="panel-body">
        {{ Form::open(['action' => 'DepartmentController@store', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
		@include('departments.form', ['buttonText' => 'Create Department '])
		{{ Form::close() }}
    </div>
</div>
@endsection

@section('bottom-content')
<div class="container-fluid container-fixed-lg bg-white">
    <!-- START PANEL -->
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title">
                Department Listing
            </div>
            <div class="pull-right">
                <div class="col-xs-12">
                    <input class="search-table form-control pull-right" placeholder="Search" type="text">
                    </input>
                </div>
            </div>
            <div class="clearfix">
            </div>
        </div>
        <div class="panel-body">
            <table class="table tableWithSearch">
                <thead>
                    <th>
                        Department
                    </th>
                    <th>
                        Company
                    </th>
                    <th>
                        Subsidiary
                    </th>
                    <th>
                        Division
                    </th>
                    <th>
                        Group
                    </th>
                    <th colspan="2">
                    </th>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                    <tr>
                        <td>
                            {{ $department->Department }}
                        </td>
                        <td>
                            {{ $department->Company }}
                        </td>
                        <td>
                            {{ $department->Subsidiary }}
                        </td>
                        <td>
                            {{ $department->Division }}
                        </td>
                        <td>
                            {{ $department->GroupName }}
                        </td>
                        <td class="actions">
                            <a class="btn btn-sm btn-rounded btn-primary" href="{{ route('departments.edit',[$department->DepartmentRef]) }}">
                                Edit
                            </a>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END PANEL -->
</div>
@endsection
