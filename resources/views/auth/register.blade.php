@extends('layouts.static2')

@section('content')
  @php
    $genders = MESL\Gender::all();
  @endphp
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <div class="panel-title">Company Registration</div>
                </div>
                <div class="panel-body">
                  @include('errors.list')
                    <form action="{{ route('register_company') }}" method="POST">
                      {{ csrf_field() }}

                      @include('layouts.partials.alerts')

                      <div class="title-text m-l-5">Company Details</div>

                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                              {{ Form::label('Company Name', null, ['class' => 'req']) }}
                              {{ Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Name of your company']) }}
                          </div>
                        </div>
                      </div>

                      <hr>

                      <div class="title-text m-l-5">Company Admin</div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              {{ Form::label('First Name', null, ['class' => 'req']) }}
                              {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Your First', 'required']) }}
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                              {{ Form::label('Last Name', null, ['class' => 'req']) }}
                              {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name', 'required']) }}
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                              {{ Form::label('Email', null, ['class' => 'req']) }}
                              {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Your Email', 'required']) }}
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                              {{ Form::label('Phone Number', null, ['class' => 'req']) }}
                              {{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Your Phone Number', 'required']) }}
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                              {{ Form::label('Password', null, ['class' => 'req']) }}
                              {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Choose a password', 'required']) }}
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                              {{ Form::label('Confirm Password', null, ['class' => 'req']) }}
                              {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm password', 'required']) }}
                          </div>
                        </div>



                        {{-- <div class="col-sm-6">
                          <div class="form-group">
                              {{ Form::label('Gender', null, ['class' => 'req']) }}
                              {{ Form::select('gender', $genders->pluck('Gender', 'GenderRef')->toArray(), null, ['placeholder' => 'Select gender', 'class'=>'form-control select2', 'data-init-plugin' => "select2"]) }}
                          </div>
                        </div> --}}

                      </div>


                      {{--

                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            {{ Form::label('Bank Account No.') }}
                            {{ Form::text('nuban', null, ['class' => 'form-control', 'placeholder' => 'Your Bank Account Number']) }}
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            {{ Form::label('Bank Name') }}
                            {{ Form::select('bank', $banks->pluck('Bank', 'BankRef')->toArray(), null, ['placeholder' => 'Select Bank', 'class'=>'form-control select2', 'data-init-plugin' => "select2"]) }}
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            {{ Form::label('Bank Account Type') }}
                            {{ Form::select('account_type', ['10'=>'Savings Account', '20'=>'Current Account'], null, ['placeholder' => 'Select Type', 'class'=>'form-control select2', 'data-init-plugin' => "select2"]) }}
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            {{ Form::label('Bank Account Currency') }}
                            {{ Form::select('currency', $currencies->pluck('Currency', 'CurrencyRef')->toArray(), null, ['placeholder' => 'This Bank Account\'s Currency', 'class'=>'form-control select2', 'data-init-plugin' => "select2"]) }}
                          </div>
                        </div>

                      </div> --}}

                      <div class="text-center" style="width:100%; max-width:300px; margin:auto">
                        <input type="submit" class="c-btn c-btn--info c-btn--large btn-cons btn-lg btn-block m-t-20" value="Submit">
                        {{-- <a href="#" class="btn btn-success btn-cons btn-lg btn-block m-t-20">Submit</a> --}}
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
