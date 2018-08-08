@extends('layouts.master')

@section('title')
  Litigation Schedule
@endsection

@section('page-title')
  Litigation Schedule
@endsection

@section('buttons')
  <button class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#new_schedule">New Schedule</button>
@endsection

@section('content')
  <style>
    .progress {
      border-radius: 3px !important;
    }

    .modal {
      padding-left: 0 !important
    }

    #new_court .modal-content {
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

  {{-- <div class="clearfix m-b-20">
    <button class="c-btn c-btn--info pull-right" data-toggle="modal" data-target="#new_schedule">New Project</button>
  </div> --}}
  <!-- START PANEL -->
  <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Schedules</div>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>
    </div>
    <table class="table tableWithSearch table-striped table-bordered">
      <thead>
        <th>Case Number</th>
        <th>Parties</th>
        <th>Court &amp; Location</th>
        <th>Status</th>
        {{-- <th>Actions</th> --}}
      </thead>
      <tbody>
        @foreach ($litigations->load('comments') as $litigation)
          <tr>
          <td><b><a href="{{ route('litigation.show', ['id' => $litigation->LitigationRef]) }}">{{ $litigation->CaseNumber }}</a></b></td>
          <td>{{ $litigation->Parties }}</td>
          <td>{{ $litigation->court->Court }}</td>
          <td>
            {!! $litigation->readable_status() !!}
          </td>
          {{-- <td class="actions">

          </td> --}}
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- END PANEL -->


  {{-- MODALS --}}
  <!-- Modal -->
  <div class="modal fade slide-up" id="new_schedule" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>New Schedule</h5>
            {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
          </div>
          <div class="modal-body">

            <form action="{{ route('litigation.store') }}" method="post">
              {{ csrf_field() }}
              @include('litigation.form')
              <button type="submit" class="btn btn-info btn-form">Submit</button>
            </form>

          </div>
        </div>
      </div>
      <!-- /.modal-content -->


      <!-- Modal -->
  <div class="modal fade stick-up" id="new_court" role="dialog" aria-hidden="false" style="padding-left: 0 !important">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" onclick="$('#new_court').hide()"  aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>New Court &amp; Location</h5>
            {{-- <p class="p-b-10">We need payment information inorder to process your order</p> --}}
          </div>
          <div class="modal-body">

            <form action="{{ route('courts.store') }}" id="courts-form" method="post">
              {{ csrf_field() }}
              @include('courts.form')
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

        $('.form-add-more').click(function(e){
          e.preventDefault();
          $('#new_court').show();
          $('#new_court').modal('show');
          var form = $("#courts-form");
          form.submit(function(e) {
            e.preventDefault();
            $.post('/courts', {
              Court: $('#Court').val(),
              Location: $('#Location').val()
            }, function(data, textStatus, xhr) {
              if(data.success === true){
                $('#CourtID').append('<option selected value="'+ data.data.CourtRef +'">' +  data.data.Court  + '</option>');
                 $('#new_court').hide();
                 $('#Court').val('');
                 $('#Location').val('');
                 $('#new_court').modal('handleUpdate');
              }
            });
          });
        });

        $('#new_schedule').on('hidden.bs.modal', function (e) {
          $('#new_court').modal('hide');
        });

        
    });
  </script>
@endpush
