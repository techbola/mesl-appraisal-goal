@extends('layouts.master')
@section('buttons')
  <a href="{{ route('memos.index') }}" class="btn btn-info btn-rounded pull-right" >My Memos</a>
@endsection
<style>
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
@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Create Memo</div>
  			<div class="clearfix"></div>
  			
  			{{ Form::open(['action' => 'MemoController@store', 'autocomplete' => 'off', 'files' => true, 'novalidate' => 'novalidate', 'role' => 'form']) }}
				@include('memos.form', ['buttonText' => 'Create Memo'])
			{{ Form::close() }}

  	</div>

  	<div class="card-box hide">
  		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
  	</div>
  	<!-- END PANEL -->

    <div class="modal fade" id="req_setup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <hr>
      <div class="modal-body">
        <form action="" method="POST" id="req-form">
          {{ csrf_field() }}
           <div class="row">  
            <div class="col-sm-12 form-group"> 
                <input type=" text" id="request_item" placeholder="Enter Request Type" name="request" class="form-control">
            </div>
          </div>
          <button type="submit" class="btn btn-info">Submit</button>
        </form>
      </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
<script>  
$(function(){
  $('.add-req').click(function(e){
          e.preventDefault();
          console.log('clicked')
          $('#req_setup').show();
          $('#req_setup').modal('show');
          
        });

        var form1 = $("#req-form");
          form1.submit(function(e) {
            e.preventDefault();
            $.post('/api/add_req_setup', {
              name: $('#request_item').val()
            }, function(data, textStatus, xhr) {
              if(data.success === true){
                $('#request_type_id').append('<option selected value="'+ data.data.id +'">' +  data.data.name +'</option>');
                $('#req_setup').modal('hide');
                swal(
                  'Success',
                  data.data.name + ' was added to the list',
                  'success'
                )
                 $('#request_item').val('');
                 
              } else {
                swal(
                  'error',
                  data.data.name + ' has already been taken.',
                  'error'
                )
              }
            });
          });

})
</script>
@endpush



