@extends('layouts.master')

@section('title')
	Todo List
@endsection

@section('page-title')
	Todo List
@endsection

@section('buttons')
		<a href="{{ route('todos') }}" class="btn btn-info btn-rounded">Todo List</a>
		<button class="btn btn-info btn-rounded" data-toggle="modal" data-target="#new_todo">+ New Todo</button>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/fullcalendar.css') }}">
@endpush

@section('content')
  <div class="card-box">
    <div id="calendar"></div>
  </div>

  {{-- MODALS --}}
  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_todo" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Add New Todo</h5>
          </div>
          <div class="modal-body">
            <form action="{{ route('save_todo') }}" method="post">
              {{ csrf_field() }}
              @include('todos.form')

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@push('scripts')
  <script src="{{ asset('assets/plugins/fullcalendar/lib/moment.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('assets/plugins/fullcalendar/fullcalendar.js') }}" charset="utf-8"></script>

  <script>
    $(function() {

      $('#calendar').fullCalendar({
        events: '{{ url('/') }}/get_todos',
        header: {
          left:   'title',
          center: '',
          right:  'listDay,basicWeek,month,listYear today prev,next'
        },
        buttonText: {
          today:    'Today',
          month:    'Month',
          listDay:     'Today',
          basicWeek: 'Week',
          year: 'Year'
        },
        eventClick: function(myevent, jsEvent, view) {

          // alert('Event: ' + myevent.title);
          // alert('Event: ' + myevent.ref);
          // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
          // alert('View: ' + view.name);

          // $(this).css('border-color', 'red');

        },
        eventMouseover: function(myevent){

        },
        // Before it's loaded
        eventRender: function(myevent, element) {
          // var url = '{{ url('/') }}/event/'+myevent.ref;
					var url = '';
          element.attr('href', url).attr('data-toggle', 'tooltip').attr('title', myevent.description).css('padding', '3px');
           element.tooltip({
             title: myevent.title.toString(),
             placement: 'bottom'
           });
         },

				 selectable: true,

				 dayClick: function(date, jsEvent, view) {

			     // alert('Clicked on: ' + date.format());
					 window.location.href = '{{ url('/') }}/todos/?date='+date.format();

					 // $(this).css('background-color', 'red');

			   }

      });

    });
  </script>

  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
  <link href="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
  <script>
    $(function(){
        var options = {
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            autoclose: true,
        };
        $('.dp').datepicker(options);
    });

    $('.timepicker').timepicker().on('show.timepicker', function(e) {
        var widget = $('.bootstrap-timepicker-widget');
        widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
        widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
        widget.attr("style", "z-index: 9999999 !important; box-shadow: 0 6px 12px rgba(0,0,0,.175); border: 1px solid #ccc");
    });
  </script>
@endpush