@extends('layouts.master')

@push('styles')
  <style>

  </style>
@endpush

@section('title')
  Staff Course Dashboard
@endsection

@section('page-title')
  Staff Course Dashboard
@endsection

@section('buttons')

@endsection

@section('content')

  	<!-- START PANEL -->
    @if(count($course_details) >= 1)
        <div class="row">
          <h3 style="font-weight: bold !important">New Courses</h3><hr>
          @foreach($course_details as $course_detail)
          <div class="col-md-6 card-box">
            <div class="row">
              <div class="col-md-4">
                 <img class="icon" src="{{ asset('storage/course_images/'.$course_detail->cover_page)}}" alt="" width="150px" style="filter: brightness(0.92);">
              </div>

              <div class="col-md-8">
                <h4>{{ $course_detail->courses_name }}</h4>
                <p><span style="color:red">{{ $course_detail->batch_code }}</span> | <span style="color:green">{{ $course_detail->duration }} Course</span> | <span style="color:#af560a"> Priority : {{ $course_detail->priority }}</span> | <span style="color:#3e97f3"> Start- Date : {{ $course_detail->start_date }}</span> | <span style="color:#830892"> End- Date : {{ $course_detail->end_date }}</span></p>
                {{ $course_detail->description }}
               <br><br>
                <a href="#" id="activate_course" data-id="{{ $course_detail->batch_ref }}" class="btn btn-lg btn-info pull-right" title="">Activate Course</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    @endif
  	<!-- END PANEL -->

    <!-- START PANEL -->
    @if(count($active_courses) >= 1)
        <div class="row">
          <h3 style="font-weight: bold !important">Latest Activities</h3><hr>
          @foreach($active_courses as $active_course)
          <div class="col-md-6 card-box">
            <div class="row">
              <div class="col-md-4">
                 <img class="icon" src="{{ asset('storage/course_images/'.$active_course->cover_page)}}" alt="" width="150px" style="filter: brightness(0.92);">
              </div>

              <div class="col-md-8">
                <h4>{{ $active_course->courses_name }}</h4>
                <p><span style="color:red">{{ $active_course->batch_code }}</span> | <span style="color:green">{{ $active_course->duration }} Course</span> | <span style="color:#af560a"> Priority : {{ $active_course->priority }}</span> | <span style="color:#3e97f3"> Start- Date : {{ $active_course->start_date }}</span> | <span style="color:#830892"> End- Date : {{ $active_course->end_date }}</span></p>
                {{ $active_course->description }}
               <br><br>
               {{-- progress bar --}}
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 15%; float: left;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>
                <br><br>
                <a href="{{ route('ShowCourse',[$active_course->batch_ref]) }}" class="btn btn-lg btn-warning pull-right" title="">Continue Course</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    @endif
    <!-- END PANEL -->

    <!-- START PANEL -->
     @if(count($completed_courses) >= 1)
        <div class="row">
          <h3 style="font-weight: bold !important">Completed Courses</h3><hr>
          @foreach($completed_courses as $completed_course)
          <div class="col-md-6 card-box">
            <div class="row">
              <div class="col-md-4">
                 <img class="icon" src="{{ asset('storage/course_images/'.$completed_course->cover_page)}}" alt="" width="150px" style="filter: brightness(0.92);">
              </div>

              <div class="col-md-8">
                <h4>{{ $completed_course->courses_name }}</h4>
                <p><span style="color:red">{{ $completed_course->batch_code }}</span> | <span style="color:green">{{ $completed_course->duration }} Course</span> | <span style="color:#af560a"> Priority : {{ $completed_course->priority }}</span> | <span style="color:#3e97f3"> Start- Date : {{ $completed_course->start_date }}</span> | <span style="color:#830892"> End- Date : {{ $completed_course->end_date }}</span></p>
                {{ $completed_course->description }}
               <br><br>
                <a href="{{ route('ShowCourse',[]) }}" class="btn btn-lg btn-info pull-right" title="">Activate Course</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    @endif
    <!-- END PANEL -->

@endsection
@push('scripts')
  <script>

      $('#activate_course').click(function(event) {

        var id = $(this).data('id');
        $.get('/activate_course/' +id, function(data) {
          if(data.success){
            window.location.href = data[0].data.link
          }
        });
      });

  </script>
@endpush



