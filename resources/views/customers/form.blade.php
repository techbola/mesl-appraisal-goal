@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
@endpush

@include('errors.list')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
              {{ Form::label('First Name') }}
              {{ Form::text('FirstName', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name']) }}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
              {{ Form::label('Last Name') }}
              {{ Form::text('LastName', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name']) }}
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
          <div class="form-group">
            {{ Form::label('Telephone','Phone Number') }}
            {{ Form::text('Telephone',null, ['class'=> "form-control",'placeholder' => "Enter Customer Phone Number"]) }}
          </div>
      </div>

      <div class="col-sm-6">
          <div class="form-group">
            {{ Form::label('Email', 'Email Address') }}
            {{ Form::email('Email', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Email']) }}
          </div>
      </div>

      <div class="col-sm-12">
          <div class="form-group">
            {{ Form::label('CountryID', 'Country') }}
            {{ Form::select('CountryID', [ '' =>  'Select Country'] + $countries->pluck('Country', 'CountryRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
          </div>
      </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
              {{ Form::label('Office Address', 'Office Address') }}
              {{ Form::textarea('OfficeAddress', null, ['class' => 'form-control', 'placeholder' => 'Enter Office Address', "rows"=>"3"]) }}
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
      <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('Contact 1 Name') }}
            {{ Form::text('Contact1Name', null, ['class' => 'form-control', 'placeholder' => 'Enter contact 1 name']) }}
          </div>
      </div>
      <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('Contact 1 Phone') }}
            {{ Form::text('Contact1Phone', null, ['class' => 'form-control', 'placeholder' => 'Enter contact 1 phone']) }}
          </div>
      </div>
      <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('Contact 1 Email') }}
            {{ Form::email('Contact1Email', null, ['class' => 'form-control', 'placeholder' => 'Enter contact 1 email']) }}
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('Contact 2 Name') }}
            {{ Form::text('Contact2Name', null, ['class' => 'form-control', 'placeholder' => 'Enter contact 2 name']) }}
          </div>
      </div>
      <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('Contact 2 Phone') }}
            {{ Form::text('Contact2Phone', null, ['class' => 'form-control', 'placeholder' => 'Enter contact 2 phone']) }}
          </div>
      </div>
      <div class="col-sm-4">
          <div class="form-group">
            {{ Form::label('Contact 2 Email') }}
            {{ Form::email('Contact2Email', null, ['class' => 'form-control', 'placeholder' => 'Enter contact 2 email']) }}
          </div>
      </div>
    </div>


<!-- action buttons -->
<div class=" pull-right">
  <div class="form-group">
    <div class="m-t-25"></div>
    {{ Form::submit( $buttonText, [ 'class' => 'btn btn-info btn-cons' ]) }}
  </div>
</div>
<div class="clearfix"></div>

@push('scripts')
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
  </script>
  <script>
      $(function(){
      $('.dp').datepicker();
  })
  </script>
@endpush
