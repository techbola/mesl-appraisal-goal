@extends('layouts.master')

@push('styles')
  <link href='https://fonts.googleapis.com/css?family=Jaldi:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('assets/plugins/cd/accordion/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/cd/accordion/style-white.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/loading/progress/loading-bar.css') }}">
@endpush

@section('content')
  <style media="screen">
  .bio-label {
    font-weight: bold;
    font-size: 15px;
  }
  /* .card-box:nth-child(odd) {

  } */
  .ldBar {
    width:40px !important;
    height: 40px !important;
    margin:auto;
    position: absolute;
    right: 50px;
    top: 0;
    z-index: 9999;
    font-size: 15px;
  }
  </style>

    {{-- START CARD --}}
    <div class="card-box">
      <div class="p-l-20 p-r-20">
        <div class="card-title pull-left">
          {{ $staff->FullName }}'s BioData
        </div>
        <div class="pull-right">
          <a href="{{ route('staff.edit_biodata',[$detail->StaffRef]) }}" title="" class="btn btn-info btn-cons" id="show-modal">
            <i class="fa fa-plus"></i>
            Edit Details
          </a>
        </div>
        <div class="clearfix"></div>

        <div class="m-b-10">
          <img src="{{ asset('images/avatars/'.$staff->user->avatar()) }}" class="avatar" height="120px" width="120px">
        </div>

        <table class="table table-striped table-condensed hidden">
          <tr>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
          </tr>
          <tr>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
          </tr>
        </table>

        <div class="row m-b-10 m-t-20">
          <div class="col-md-4">
            <span class="bio-label">First Name</span>
            <h5>{{ $staff->FirstName }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Middle Name</span>
            <h5>{{ $staff->MiddleName }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Last Name</span>
            <h5>{{ $staff->LastName }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">Personal Email</span>
            <h5>{{ $staff->PersonalEmail ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Date of Birth</span>
            <h5>{{ $staff->DateofBirth ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Home Phone</span>
            <h5>{{ $staff->HomePhone ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">Mobile Phone</span>
            <h5>{{ $staff->MobilePhone ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Work Phone</span>
            <h5>{{ $staff->WorkPhone ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Religion</span>
            <h5>{{ $detail->Religion ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">Marital Status</span>
            <h5>{{ $detail->MaritalStatus ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">No. Of Children</span>
            <h5>{{ $staff->NoofChildren ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Town / City</span>
            <h5>{{ $detail->TownCity ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">State</span>
            <h5>{{ $detail->State ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Country</span>
            <h5>{{ $detail->Country ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Address 1</span>
            <h5>{{ $detail->AddressLine1 ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Address 2</span>
            <h5>{{ $detail->AddressLine2 ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">HMO</span>
            <h5>{{ $detail->HMO ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">HMO Plan</span>
            <h5>{{ $detail->HMOPlan ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">HMO Number</span>
            <h5>{{ $detail->HMONumber ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">Next Of Kin</span>
            <h5>{{ $detail->NextofKIN ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Next Of Kin Phone</span>
            <h5>{{ $detail->NextofKIN_Phone ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Next Of Kin Email</span>
            <h5>{{ $detail->NextofKIN_Email ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">Beneficiary</span>
            <h5>{{ $detail->Beneficiary ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Beneficiary Phone</span>
            <h5>{{ $detail->Beneficiary_Phone ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Beneficiary Email</span>
            <h5>{{ $detail->Beneficiary_Email ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <span class="bio-label">Beneficiary Address</span>
            <h5>{{ $detail->Beneficiary_Address ?? '&mdash;' }}</h5>
          </div>
        </div>

      </div>
    </div>
    {{-- END CARD --}}

    {{-- START PROJECTS --}}
    <div class="row">
      <div class="col-md-7">

        <ul class="cd-accordion-menu animated">
          @foreach ($staff->projects_extended as $project)
            <li class="has-children">
              <input type="checkbox" name ="project_{{ $project->ProjectRef }}" id="project_{{ $project->ProjectRef }}">
              <label for="project_{{ $project->ProjectRef }}">
                {{ $project->Project }}
                {{-- Start Project Progress --}}
                <div class="progress">
                  <div class="progress progress-striped active progress-md m-b-0">
                      <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $project->progress_percent }};">
                        {{ $project->progress_percent }}
                      </div>
                  </div>
                </div>
                {{-- End Project Progress --}}
              </label>
              <ul>
                @foreach ($project->tasks as $task)
                  <li class="has-children">
                    <input type="checkbox" name ="task_{{ $task->TaskRef }}" id="task_{{ $task->TaskRef }}">
                    <label for="task_{{ $task->TaskRef }}">
                      {{ $task->Task }}
                        {{-- Circle Progress count --}}
                        <div class="ldBar label-center" data-value="{{ $task->progress }}" data-preset="circle" data-stroke="#39b54a" data-stroke-trail="#777" data-stroke-width="5" data-stroke-trail-width="1"></div>
                        {{-- End Circle progress count --}}
                    </label>
                    <ul>
                      {{-- <i class="fa {{ ($step->Done)? 'fa-check text-success' : 'fa-ellipsis-h text-inverse' }} m-r-5"></i> --}}
                      @foreach ($task->steps as $step)
                        <li><a href="#0" style="{{ ($step->Done)? 'text-decoration:line-through;color:#777' : '' }}">{{ $step->Step }}</a></li>
                      @endforeach
                    </ul>
                  </li>
                @endforeach
              </ul>
            </li>
          @endforeach
        </ul>

      </div>
    </div>

    <ul class="cd-accordion-menu animated hidden">
  		<li class="has-children">
  			<input type="checkbox" name ="group-1" id="group-1">
  			<label for="group-1">Group 1</label>

      		<ul>
      			<li class="has-children">
      				<input type="checkbox" name ="sub-group-1" id="sub-group-1">
    					<label for="sub-group-1">Sub Group 1</label>

        					<ul>
        						<li><a href="#0">Image</a></li>
        						<li><a href="#0">Image</a></li>
        						<li><a href="#0">Image</a></li>
        					</ul>
          			</li>
          			<li class="has-children">
          				<input type="checkbox" name ="sub-group-2" id="sub-group-2">
    					<label for="sub-group-2">Sub Group 2</label>

    					<ul>
    						<li class="has-children">
    							<input type="checkbox" name ="sub-group-level-3" id="sub-group-level-3">
    							<label for="sub-group-level-3">Sub Group Level 3</label>

    							<ul>
    								<li><a href="#0">Image</a></li>
    								<li><a href="#0">Image</a></li>
    							</ul>
    						</li>
    						<li><a href="#0">Image</a></li>
    					</ul>
          			</li>
          			<li><a href="#0">Image</a></li>
    				<li><a href="#0">Image</a></li>
          		</ul>
    		</li>

    		<li class="has-children">
    			<input type="checkbox" name ="group-2" id="group-2">
    			<label for="group-2">Group 2</label>

    			<ul>
    				<li><a href="#0">Image</a></li>
    				<li><a href="#0">Image</a></li>
    			</ul>
    		</li>

    		<li class="has-children">
    			<input type="checkbox" name ="group-3" id="group-3">
    			<label for="group-3">Group 3</label>

    			<ul>
    				<li><a href="#0">Image</a></li>
    				<li><a href="#0">Image</a></li>
    			</ul>
    		</li>

    		<li class="has-children">
    			<input type="checkbox" name ="group-4" id="group-4">
    			<label for="group-4">Group 4</label>

    			<ul>
    				<li class="has-children">
    					<input type="checkbox" name ="sub-group-3" id="sub-group-3">
    					<label for="sub-group-3">Sub Group 3</label>

    					<ul>
    						<li><a href="#0">Image</a></li>
    						<li><a href="#0">Image</a></li>
    					</ul>
    				</li>
    				<li><a href="#0">Image</a></li>
    				<li><a href="#0">Image</a></li>
    			</ul>
    		</li>
    	</ul> <!-- cd-accordion-menu -->
    {{-- END PROJECTS --}}

  @endsection

  @push('scripts')
    <script src="{{ asset('assets/plugins/cd/accordion/main.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/plugins/loading/progress/loading-bar.min.js') }}" charset="utf-8"></script>
  @endpush
