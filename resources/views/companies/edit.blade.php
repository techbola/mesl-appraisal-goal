@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-md-6 col-md-offset-3">

		<div class="card-box">
			<div class="card-title">
				Edit Company Details
			</div>

      <div class="m-b-30">
        @if ($company->Logo)
          <img src="{{ asset('images/logos/'.$company->Logo) }}" alt="" width="100px" style="border-radius:100%">
        @else
          <div class="text-muted f18 m-l-5 m-t-30">No logo uploaded yet.</div>
        @endif
      </div>

			<form action="{{ route('update_company', $company->CompanyRef) }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				@include('errors.list')
				<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="form-group">
									{{ Form::label('Company', 'Company Name') }}
									{{ Form::text('Company', $company->Company, ['class' => 'form-control', 'placeholder' => 'Enter Company Name']) }}
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div class="form-group">
									{{ Form::label('Logo', 'Company Logo') }}
									{{ Form::file('Logo', null, ['class' => 'form-control']) }}
									{{-- <input type="file" name="Logo" value=""> --}}
								</div>
							</div>
						</div>

						<input type="submit" class="btn btn-info btn-form btn-cons" value="Save">

				</div>
			</form>

		</div>

  </div>
</div>
@endsection
