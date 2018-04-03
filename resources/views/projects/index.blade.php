@extends('layouts.master')

@section('title')
  Project Management
@endsection

@section('page-title')
  Projects Management
@endsection

@section('buttons')
  <button class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#new_project">New Project</button>
@endsection

@section('content')
  <style>
    .progress {
      border-radius: 3px !important;
    }
  </style>

  {{-- <div class="clearfix m-b-20">
    <button class="c-btn c-btn--info pull-right" data-toggle="modal" data-target="#new_project">New Project</button>
  </div> --}}
  <!-- START PANEL -->
  <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Projects</div>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>
    </div>
    <table class="table tableWithSearch table-striped">
      <thead>
        <th>Project Title</th>
        <th>Assignees</th>
        <th>Supervisor</th>
        <th>Tasks</th>
        <th>Progress</th>
        <th>Status</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach ($projects as $project)
          <tr>
          <td><a href="{{ route('view_project', $project->ProjectRef) }}">{{ $project->Project}}</a></td>
          <td>
            {{ $project->assignees_list() }}
          </td>
          <td>{{ $project->supervisor->FullName }}</td>
          <td>{{ count($project->tasks) }}</td>
          <td>
            <div class="progress">
              <div class="progress progress-striped active progress-md m-b-0">
                  <div class="progress-bar progress-bar-success" role="progressbar" style="width: 100%{{-- $progress --}};">
                    100%
                      {{-- $progress --}}
                  </div>
              </div>
            </div>
          </td>
          <td><span class="label label-{{ $project->status->color }}">{{ $project->status->name ?? '' }}</label></td>
          <td class="actions">

          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- END PANEL -->


  {{-- MODALS --}}
  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_project" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Create New Project</h5>
            {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
          </div>
          <div class="modal-body">

            <form action="{{ route('store_project') }}" method="post">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Project Title</label>
                    <input type="text" class="form-control" name="Project" placeholder="Project" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    {{ Form::label('Supervisor') }}
          					{{ Form::select('SupervisorID', [''=>'Select Supervisor'] + $supervisors->pluck('FullName', 'StaffRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Supervisor", 'data-init-plugin' => "select2", 'required']) }}
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    {{ Form::label('StartDate', 'Start Date' ) }}
                    <div class="input-group date dp">
                      {{ Form::text('StartDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Start Date', 'required']) }}
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    {{ Form::label('EndDate', 'End Date' ) }}
                    <div class="input-group date dp">
                      {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date', 'required']) }}
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>

                {{-- <div class="col-md-12">
                  <div class="form-group">
                    {{ Form::label('Assignees') }}
          					{{ Form::select('Assignees[]', $assignees->pluck('FullName', 'StaffRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Assignees", 'data-init-plugin' => "select2", 'required', 'multiple']) }}
                  </div>
                </div> --}}
                <div class="col-md-12">
                  <div class="form-group">
                    {{ Form::label('Customer') }}
          					{{ Form::select('CustomerID', [''=>'Select Customer'] + $customers->pluck('Customer', 'CustomerRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Customer", 'data-init-plugin' => "select2", 'required']) }}
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    {{ Form::label('Description', 'Description / Project Details' ) }}
                    {{ Form::textarea('Description', null, ['class' => 'form-control', 'placeholder' => 'Enter project details and instructions.', 'rows' => '4']) }}
                  </div>
                </div>

                {{-- <div class="col-md-6">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" name="email" placeholder="Email Address" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="req">Role</label>
                    {{ Form::select('role', [ '' =>  'Select Role'] + $roles->pluck('name', 'id')->toArray(),null, ['class'=> "form-control select2", 'data-init-plugin' => "select2"]) }}
                  </div>
                </div>
                @if (auth()->user()->is_superadmin)
                  <div class="col-md-6">
                    <div class="form-group">
                      {{ Form::label('CompanyID', 'Company') }}
                      {{ Form::select('CompanyID', [ '' =>  'Select Company'] + $companies->pluck('Company', 'CompanyRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2", 'required']) }}
                    </div>
                  </div>
                @endif --}}

              </div>
              <button type="submit" class="btn btn-info btn-form">Submit</button>
            </form>

          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  <!-- /.modal-dialog -->


@endsection

@push('scripts')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
  <script>
    $(function(){
        var options = {
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            autoclose: true,
        };
        $('.dp').datepicker(options);
    });
  </script>
@endpush
