@extends('layouts.master')

@section('title')
	Edit Contact
@endsection

{{-- @section('page-title')
	Business Contacts
@endsection --}}

@section('content')

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

	<div class="row">
	  <div class="col-md-8 col-md-offset-2">
			<div class="card-box">
				@include('errors.list')
		    <div class="card-title">Edit Contact</div>
				{{ Form::model($person, ['route' => ['update_contact', $person->CustomerRef ], 'role' => 'form']) }}
				{{ method_field('PATCH') }}
				@include('contacts.form')
				<button type="submit" class="btn btn-info">Submit</button>
				{{ Form::close() }}
		  </div>
	  </div>
	</div>

	<div class="modal fade" id="new_rel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">New Relationship Type</h5>
      </div>
      <div class="modal-body">
        @include('errors.list')
       <form action="{{ route('business-rel-types.store') }}" id="bus_rel_form" method="post">
              {{ csrf_field() }}
        @include('business_rel_type.form')
        <div class="text-right m-t-10">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>


@endsection


@push ('scripts')
<script>
  $(function(){

    // relationship types
        $('.add-more-courts').click(function(e){
          e.preventDefault();
          $('#new_rel').show();
          $('#new_rel').modal('show');
          var form = $("#bus_rel_form");
          form.submit(function(e) {
            e.preventDefault();
            $.post('/business-rel-types', {
              RelationshipType: $('#RelationshipType').val(),
              Description: $('#Description').val()
            }, function(data, textStatus, xhr) {
              if(data.success === true){
                $('#RelationshipTypeID').append('<option selected value="'+ data.data.BusinessRelationshipTypeRef +'">' +  data.data.RelationshipType  + '</option>');
                $('#new_rel').modal('hide');
                 $('#new_rel').hide();
                 $('#RelationshipType').val('');
                 $('#Description').val('');
                 $('#new_rel').modal('handleUpdate');
              }
            });
          });
        });

  });
</script>
@endpush
