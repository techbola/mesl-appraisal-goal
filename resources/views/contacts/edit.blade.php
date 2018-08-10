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
                 $('#new_rel').hide();
                 $('#Court').val('');
                 $('#Location').val('');
                 $('#new_rel').modal('handleUpdate');
              }
            });
          });
        });

  });
</script>
@endpush
