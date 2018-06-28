@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}

tfoot{
      display: table-header-group;
     }
  </style>
@endpush

@section('title')
  Schedule Training For Staff
@endsection

@section('page-title')
  Schedule Training For Staff
@endsection

@section('buttons')
  
@endsection 

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
      <div style="padding: 30px">
        
      </div><div class="clearfix"></div>
      <div style="padding: 30px">
         <ul class="nav nav-pills pull-right">
             <li role="presentation"><a href="#" style="color: #fff" class="btn btn-info btn-lg"  data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler2">Schedule New Training for Staff(s)</a></li>
         </ul>
      </div><div class="clearfix"></div>
  			<div class="card-title pull-left" style="font-size: 20px">Scheduled Training(s)</div><div class="clearfix"></div>
           <div class="row"><hr>
            <div id="policy_table"  style="background: #eee; padding: 10px">
              <div class="table-responsive">
              <table class="table tableWithExportOptions" id="transactions">
                <thead>
                  <tr>
                    <th>Agency</th>
                    <th>Training Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot class="thead">
                    <th>Agency</th>
                    <th>Training Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th class="hide">Edit</th>
                    <th class="hide">view</th>
                    <th class="hide">Delete</th>
                </tfoot>
                <tbody>
                 {{-- @foreach($courses as $course)
                 <tr>
                    <td>{{ $course->Agency}}</td>
                    <td>{{ $course->TrainingType }}</td>
                    <td>{{ $course->StartDate }}</td>
                    <td>{{ $course->EndDate }}</td>
                    <td><a href="#" class="btn btn-info" title="">Edit</a></td>
                    <td><a href="#" data-id="{{ $course->TrainingTypeRef }}" data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler3" class="btn btn-success view" title="">View</a></td>
                    <td><a href="#" class="btn btn-danger" title="">Delete</a></td>
                  </tr>
                 @endforeach --}}
                </tbody>
              </table>
            </div>
          </div>
           </div>
  	</div>
  	<!-- END PANEL -->


<div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 1000px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000" id="title">New Training Course</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                            {{-- {{ Form::open(['id'=>'training_agency', 'autocomplete' => 'off', 'role' => 'form']) }} --}}
                            {{ Form::open(['action' => 'TrainingController@post_training_course', 'autocomplete' => 'off','files'=>'true', 'role' => 'form']) }}
                              @include('training.schedule_training_form')
                            {{ Form::close() }}
                            
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
                {{-- {{ csrf_field() }} --}}
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>

      <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn3"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 800px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000" id="title">View Training Agency</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Agency</p>
                             <span id="agency"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Training Type</p>
                             <span id="training_type"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Start Date</p>
                             <span id="start_date"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">End Date</p>
                             <span id="end_date"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">State</p>
                             <span id="state"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Country</p>
                             <span id="country"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Course Outline</p>
                             <span id="country"></span>
                           </div>
                           <div class="col-md-8" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Venue</p>
                             <span id="venue"></span>
                           </div>
                           </div>
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
                {{-- {{ csrf_field() }} --}}
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
  $(document).ready(function() {
    
    $("#btnFillSizeToggler2").click(function(e){
        $('#title').text('New Training Agency.');
         $('#add_course').removeClass('hide');
         $('#edit_course').addClass('hide');
         $('#formy').removeClass('hide');
          $('#item_div').removeClass('hide');
    });


     $('.view').click(function(event) {
       var id = $(this).data('id');
       $.get('/get_clicked_course/'+id, function(data) {
         $('#agency').text(data.Agency);
         $('#training_type').text(data.TrainingType)
         $('#start_date').text(data.StartDate);
         $('#end_date').text(data.EndDate);
         $('#state').text(data.State);
         $('#country').text(data.Country);
         $('#course').text(data.CourseOutline);
         $('#venue').text(data.Venue);
         console.log(data);
       });
     });

  });
</script>


<script src="{{ asset('js/jquery.tabledit.js') }}"></script>
<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  // $('#transactions').editableTableWidget();
  // $(document).ready(function(){
     var settings = {
    "sDom": "<'exportOptions'T><'table-responsive't><'row'<p i>>",
    "sPaginationType": "bootstrap",
    "destroy": true,
    "scrollCollapse": true,
    "oLanguage": {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
     // "columnDefs": [
     //        {
     //            "targets": [ 3 ],
     //            "visible": false
     //        }
     //    ],
    "iDisplayLength": 20,
    "oTableTools": {
        "sSwfPath": "../assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
        "aButtons": [{
            "sExtends": "csv",
            "sButtonText": "<i class='pg-grid'></i>",
        }, {
            "sExtends": "xls",
            "sButtonText": "<i class='fa fa-file-excel-o'></i>",
        }, {
            "sExtends": "pdf",
            "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
        }, {
            "sExtends": "copy",
            "sButtonText": "<i class='fa fa-copy'></i>",
        }]
    },
    fnDrawCallback: function(oSettings) {
        $('.export-options-container').append($('.exportOptions'));
    }
};


var table = $('#transactions').DataTable(settings);
 $('#transactions tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#transactions tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="form-control" placeholder="' + $.trim(title) + '" />');
        });
 table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
  // });
</script>

@endpush


