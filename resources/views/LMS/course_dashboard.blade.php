@extends('layouts.master')

@push('styles')
	<style>
		.modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}
	</style>
@endpush

@section('content')
<div class="panel panel-transparent">
	<div class="panel-heading">
		<div class="panel-title">
			<h3 style="font-weight: bold;">Course Dashboard</h3>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="pull-right">
				<a href="#" id="new_course" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-lg btn-warning" >Add New Course Category</a>
				<a href="#" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-lg btn-info" >Add New Course</a>
				<a href="#" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-lg btn-success" >Add New Instructor</a>
				<a href="#" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-lg btn-primary" >Add New Batch</a>
			</div>
		</div><div class="clearfix"></div><br>

		<div class="row">

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
                     <div class="card-box">
                       <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                         <img class="icon" src="{{ asset('assets/img/icons/backend.png') }}" alt="" width="60px" style="filter: brightness(0.92);">
                       </div>
                       <div class="inline">
                         <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Categories</div>
                         <h3 class="no-margin p-b-5 text-info bold" style="padding: 0px 0px 0px 20px;">4</h3>
                         <span><a href="{{ route('events') }}" class="label label-inverse pull-right btn-rounded text-capitalize pull-right">See all <i class="fa fa-arrow-right m-l-5"></i></a></span>
                       </div>
                     </div>
			</div>

				<div class="col-md-3">
                     <div class="card-box">
                       <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                         <img class="icon" src="{{ asset('assets/img/icons/languages.png') }}" alt="" width="60px" style="filter: brightness(0.92);">
                       </div>
                       <div class="inline">
                         <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Course</div>
                         <h3 class="no-margin p-b-5 text-info bold" style="padding: 0px 0px 0px 20px;">4</h3>
                          <span><a href="{{ route('events') }}" class="label label-inverse pull-right btn-rounded text-capitalize pull-right">See all <i class="fa fa-arrow-right m-l-5"></i></a></span>
                       </div>
                     </div>
			</div> 

			<div class="col-md-3">
                     <div class="card-box">
                       <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                         <img class="icon" src="{{ asset('assets/img/icons/presentation.png') }}" alt="" width="60px" style="filter: brightness(0.92);">
                       </div>
                       <div class="inline">
                         <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Instructors</div>
                         <h3 class="no-margin p-b-5 text-info bold" style="padding: 0px 0px 0px 20px;">4 </h3>
                         <span><a href="{{ route('events') }}" class="label label-inverse pull-right btn-rounded text-capitalize pull-right">See all <i class="fa fa-arrow-right m-l-5"></i></a></span>
                       </div>
                     </div>
			</div>

			<div class="col-md-3">
                     <div class="card-box">
                       <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                         <img class="icon" src="{{ asset('assets/img/icons/students.png') }}" alt="" width="60px" style="filter: brightness(0.92);">
                       </div>
                       <div class="inline">
                         <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Batches</div>
                         <h3 class="no-margin p-b-5 text-info bold" style="padding: 0px 0px 0px 20px;">4 </h3>
                         <span><a href="{{ route('events') }}" class="label label-inverse pull-right btn-rounded text-capitalize pull-right">See all <i class="fa fa-arrow-right m-l-5"></i></a></span>
                       </div>
                     </div>
			</div>
				</div>
			</div>

			<div class="col-md-6">

				<div class="row">
					<div class="card-box">
					<div id="intro">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/zv5bpfxJ2xE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					  </div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>


<div class="page-content-wrapper ">
     <div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 600px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left semi-bold" id="title">Add Process Risk & Control</h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                          {{ Form::open(['id'=>'_form','autocomplete' => 'off', 'role' => 'form']) }}
                          	<div id="course">
                          		 @include('LMS.forms.add_course')
                          	</div>
                          {{ Form::close() }}
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>
@endsection

@push('scripts')
	<script>
		.$(document).ready(function() {

			$(document).on('click', '.', function(event) {
				
			});
			
		});
	</script>
@endpush

