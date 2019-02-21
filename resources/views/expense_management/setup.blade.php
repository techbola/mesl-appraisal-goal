@extends('layouts.master')
@section('title')
  Expense Mgmt.
@endsection

@section('page-title')
  Expense Mgmt (Map Staff as approvers to requests).
@endsection
 
@section('buttons')
  {{-- <a href="{{ route('expense_management.create') }}" class="btn btn-info btn-rounded pull-right" >New Exp. Request</a> --}}

@endsection
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/scroller/1.5.1/css/scroller.dataTables.min.css">
<style>
  .flags {
        float: right;
    position: absolute;
    right: -20%;
    top: 0;
  }
</style>
@endpush

@section('content')

  	<!-- START PANEL -->
    <div class="card-title pull-left">Approver Setup</div>
    <div class="clearfix"></div>
  	<div class="card-box">
      {{ Form::open(['action' => 'ExpenseManagementController@setup', 'files' => true]) }}
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group required">
              {{ Form::label('name','Select Staff') }}
              {{ Form::select('staff[]', $staff->pluck('FullName', 'UserID')->toArray(), null, ['class'=> "form-control select2", 'data-init-plugin' => "select2", 'data-placeholder' => " Select Staff", "required", 'multiple']) }}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group select2">
                {{ Form::label('roles', 'Select Approver Roles') }}
                {{ Form::select('roles[]', $approver_roles->pluck('ApproverRole', 'ApproverRoleRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => " Select Roles", 'data-init-plugin' => "select2", "multiple"]) }}
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-complete">Submit</button>
          </div>
        </div>
      {{ Form::close() }}


      <hr>

      <div class="clearfix"></div>
    <div class="panel-body">
      <table id="staff_table" class="table table-striped table-bordered">
        <thead>
          <th>Staff Name</th>
          <th>Approver Roles</th>
        </thead>
        <tbody>
          @foreach ($staff as $st)
            <tr>
              <td>{{ $st->FullName }}</td>
              <td>{!! implode(', ', $st->approver_role) !!}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{-- {{ $staffs->links() }} --}}
    </div>

    </div>


@endsection

@push('scripts')
  <script src="https://cdn.datatables.net/scroller/1.5.1/js/dataTables.scroller.min.js"></script>
  <script src="{{ asset('js/printThis.js') }}"></script>
  <script src="{{ asset('js/jquery-printme.min.js') }}"></script>
  <script>
    $(function(){

// trigger approve modal
$('#staff_table').DataTable();
$("table").on('click', '#approval', function(e) {

  e.preventDefault();
  $("[name=ExpenseManagementRef]").val($(this).data("eref"));
  $("[name=RequestListID]").val($(this).data("rlid"));
  $("[name=ApproverRoleID]").val($(this).data("approverid"));
  $('#show-expense').modal();

});

$("table").on('click', '#rejection', function(e) {

  e.preventDefault();
  $("[name=ExpenseManagementRef]").val($(this).data("eref"));
  $("[name=RequestListID]").val($(this).data("rlid"));
  $("[name=ApproverRoleID]").val($(this).data("approverid"));
  $('#show-expense-reject').modal();

});

$('.exp-files').click(function(e){
  e.preventDefault();
  let exp_ref = $(this).data('exp_ref');
  $.get('/expense_management/'+exp_ref+'/files', function(data) {
    // console.log(data);
    $("#show-expense-files tbody").html(' ');
    $.each(data, function(index, val) {
       $("#show-expense-files tbody").append(`
        <tr>
          <td>${val.DocName}</td>
          <td>${val.type}</td>
          <td>${val.upload_date}</td>
          <td>${val.initiator.first_name}</td>
          <td><a href="/download-document/${val.Filename}" class="small text-complete" data-toggle="tooltip" title="Download document">${val.Filename}<i class="fa fa-download m-l-5"></i></a</td>
        </tr>
      `);
    });
    
    $("#show-expense-files").modal('show');

  });

});

      $('.preview_exp').click(function(e) {
        e.preventDefault();
        let url = $(this).prop('href');
        let exp_path = '{{ asset('storage/expense_attachments') }}/';
          
          $("#show-exp").find('.exp-body').html(' ');
          $("#show-exp").find('.exp-comment').html(' ');
          $("#show-exp").find('.exp-approvers').html(' ');
           $('#show-exp .modal-footer .files').html(' ');
          $("#show-exp").find('.exp-approved').html(' ');
        $.get(url, function(data) {
          console.log('data',data);
          
          $("#show-exp").find('.exp-purpose').html(data.Description);
          $("#show-exp").find('.exp-approvers').html(data.approvers);

          $.each(data.expense_comments, function(index, val) {
             $("#show-exp").find('.exp-comment').append(`
              <div style="position: relative"> <i>${val.approved_by} &nbsp; <span class=""> (${val.ApprovedFlag == 1 ? `Approved` : `Rejected`} by: ${val.approver} @ ${val.approved_at})</span>: </i>${val.Comment}<div> 
              <div><i><b>FILES : &nbsp;</b></i> 
               ${val.files}
               ${val.ApprovedFlag == 1 ? `<div class="badge badge-success flags">Approved</div>` : `<div class="flags badge badge-danger">Declined</div>` }
              <div> 
              ${data.expense_comments.length != index + 1 ? '<hr>' : '' }
              
              
              `);
             
          });
          // activate modal
           if(data.approved === true){
              $("#show-exp").find('.exp-status').html('approved');
              $("#show-exp").find('.exp-status').addClass('badge-success');
              
              $("#show-exp").find('.exp-approved').html('<img src="{{ asset('images/checkmark.svg') }}" width="30">');
            } else {
              $("#show-exp").find('.exp-status').html(data.status);
              
            }
          $("#show-exp").modal('show');
          // list attachements
          if(data.attachments.length > 0 ){
            $.each(data.attachments, function(index, val) {
               $('#show-exp .modal-footer .files').append(`
                <a target="_blank" href="${ exp_path+val.attachment_location}">${val.Filename}</a>&nbsp;
              `);
            });
          }
        });
      });
    });

    function print_exp() {
        return $("#show-exp").printMe({
          "path": ["{{ asset('css/printmemo.css') }}"]
        }); 
    }

    // datatbles
    var data = [];
        for ( var i=0 ; i<50000 ; i++ ) {
            data.push( [ ] );
        }
         
        // $('#example').DataTable( {
        //     data:           ,
        //     deferRender:    true,
        //     scrollY:        200,
        //     scrollCollapse: true,
        //     scroller:       true
        // } );
    

  </script>
@endpush



