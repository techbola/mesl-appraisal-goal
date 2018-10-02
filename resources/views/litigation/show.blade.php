@extends('layouts.master')

@section('title')
  {{ $litigation->CaseNumber }}
@endsection

@section('page-title')
  Litigation Schedule For: <b>{{ $litigation->CaseNumber }}</b>
@endsection

@section('buttons')
  <a class="btn btn-sm btn-info " style="margin-right: 3px" href="/litigation">New Schedule</a> &nbsp;
  <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit_litigation"><i class="icon-pencil m-r-5"></i>Edit Schedule</a>
  {{-- <a href="" class="btn btn-sm btn-danger m-l-10" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a> --}}
@endsection

@section('content')

  <style>
    .brief * {
      font-size: 15px !important;
    }

    .progress {
      border-radius: 3px !important;
    }

    .modal {
      padding-left: 0 !important
    }

    #new_court .modal-content, #new_contact .modal-content {
      box-shadow: 0 0 50px #000;
    }

    .form-add-more{
      width: 20px;
      height: 20px;
      line-height: 20px;
      border-radius: 50%;
      text-align: center;
      padding: 0 !important;
      cursor: pointer;
    }
  </style>



  <div class="row">

    <div class="col-sm-12">
      <div class="card-box widget-inline">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted m-b-10">Case Number</div>
              <div class="f20"><b>{{ $litigation->CaseNumber ?? '-' }}</b>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted m-b-10">Parties</div>
              <div class="f20"><b>{{ $litigation->Parties ?? '-'}}</b></div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted m-b-10">Created On</div>
              <div class="f20"><b>{{ date('j M. Y', strtotime($litigation->StatusDate)) }}</b></div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="widget-inline-box text-center">
              <div class="text-muted m-b-10">Adjournment Date</div>
              <div class="f20"><b>{{ !is_null($litigation->AdjournmentDate) ? date('j M. Y', strtotime($litigation->AdjournmentDate)) : '-' ?? '-' }}</b></div>
            </div>
          </div>

          
        </div>

      </div>
    </div>
  </div>
  <!-- End Project Details -->


  {{-- START TABS --}}
  <ul class="nav nav-tabs outside">
    <li class="active"><a data-toggle="tab" href="#details">Litigation Details</a></li>
    <li><a data-toggle="tab" href="#status">Status Updates <span class="badge badge-info badge-sm m-l-5">{{ count($litigation->comments) }}</span></a> </li>
    <li>
      <a data-toggle="tab" href="#files">Files <span class="badge badge-inverse badge-tab">{{-- count($litigation->files) --}}</span></a>
    </li>
  </ul>
  <div class="tab-content">
    <div id="details" class="tab-pane fade in active">
      @include('litigation.details')
    </div>
    <div id="status" class="tab-pane fade">
      <div class="card-box">
        @foreach($statuses->sortByDesc('created_at') as $status)
          <div class="pull-right">
            <span class="text-info"><b>{{ date('j M. Y @ H:i', strtotime($status->created_at)) }}</b></span> <br><br>
            <div class="action-buttons">
            
              <a class="btn btn-sm btn-outline text-info lt-status-editor" data-stref="{{ $status->LitigationStatusRef }}">
                <i class="fa fa-edit"></i>
              </a>

              <a class="btn btn-sm btn-outline text-danger lt-status-deleter" data-stref="{{ $status->LitigationStatusRef }}">
                <i class="fa fa-trash"></i>
              </a>


            </div>
          </div>
          <div class="div clearfix"></div>
          {!! $status->LitigationStatus ?? '-' !!} 
          @if (!$loop->last)
              <hr>
          @endif
        @endforeach
      </div>
    </div>
    <div id="files" class="tab-pane fade">
      @include('litigation.files')
    </div>
  </div>
  {{-- END TABS --}}

  <!-- EDIT Modal -->
  <div class="modal fade slide-up" id="edit_litigation" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Edit Project</h5>
          </div>
          <div class="modal-body">
            {{ Form::model($litigation, ['route' => ['litigation.update', $litigation->LitigationRef], 'method'=>'patch']) }}
              @include('litigation.form')
              <button type="submit" class="btn btn-info btn-form">Submit</button>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- END EDIT MODAL --}}


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



  {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/css/summernote.css') }}" />
  <script src="{{ asset('assets/plugins/summernote/js/summernote.min.js') }}" charset="utf-8"></script> --}}
  <script>
    $('.summernote').summernote();
  </script>

  <script>
    $('#file_upload_form').on('submit', function(){
      $('#spinner').show();
    });

    $('.lt-status-deleter').click(function(e) {
      e.preventDfault();
      $.post('/litigation/delete-status', {id: $(this).data('stref')}, function(data, textStatus, xhr) {
        if(data.success == true){
          $(this).remove();
        }
      });
    });

    $('.lt-status-editor').click(function(e) {
      e.preventDfault();
      
      $.post('/litigation/edit-status', {id: $(this).data('stref')}, function(data, textStatus, xhr) {
        if(data.success == true){
          $(this).find('').html(data.data.LitigationStatus);
        }
      });
    });

    $('.add-more-courts').click(function(e){
          e.preventDefault();
          $('#new_court').show();
          $('#new_court').modal('show');
          
        });

        var form1 = $("#courts-form");
          form1.submit(function(e) {
            e.preventDefault();
            $.post('/courts', {
              Court: $('#Court').val(),
              Location: $('#Location').val()
            }, function(data, textStatus, xhr) {
              if(data.success === true){
                $('#CourtID').append('<option selected value="'+ data.data.ContactRef +'">' +  data.data.Contact + ' - ' + data.data.Location  + '</option>');
                 $('#new_court').hide();
                 $('#Court').val('');
                 $('#Location').val('');
                 $('#new_court').modal('handleUpdate');
              }
            });
          });

        $('.add-more-contacts').click(function(e){
          e.preventDefault();
          $('#new_contact').show();
          $('#new_contact').modal('show');
         
        });

         var form2 = $("#contacts-form");
          form2.submit(function(e) {
            e.preventDefault();
            $.post('/contact-post-ajax', 
              form2.serialize()
            , function(data, textStatus, xhr) {
              if(data.success === true){
                $('#ContactID').append('<option selected value="'+ data.data.CustomerRef +'">' +  data.data.Customer   + '</option>');
                 $('#new_contact').hide();
                 $('#new_contact').modal('hide');
                 $('#Court').val('');
                 $('#Location').val('');
                 $('#new_contact').modal('handleUpdate');
              }
            });
          });

        $('#new_schedule').on('hidden.bs.modal', function (e) {
          $('#new_court').modal('hide');
           $('#new_contact').modal('hide');
           // $('#new_contact').modal('hide');
        });  
  </script>
@endpush


