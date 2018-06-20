@extends('layouts.master')

@push('styles')
  <link href='https://fonts.googleapis.com/css?family=Jaldi:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="{{ asset('assets/plugins/cd/accordion/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/cd/accordion/style-white.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/loading/progress/loading-bar.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/pages/css/themes/light.css') }}">
@endpush

@section('content')

    {{-- START CARD --}}
    <div class="card-box  m-t-20" style="width: 100%">
        <div class="card-title pull-left">
            Individual Payroll Report.
        </div>
        <div class="pull-right">
            <div class="col-xs-12">
                {{-- <input type="text" class="search-table form-control pull-right" placeholder="Search" style="width: 200px; margin-left: 10px"> --}}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="panel">
             {{ Form::open(['action' => 'PayrollController@payslip_general_post', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
                   <div class="row">
                       <div class="col-sm-4 form-group">
                            {{ Form::label('StaffID', 'Staff') }}
                            {{ Form::select('StaffID', ['' => 'Select Staff'] + $employees->pluck('FullName', 'StaffRef')->toArray(), auth()->user()->id, ['class' => 'full-width', 'data-init-plugin' => "select2"] ) }}
                       </div>

                       <div class="col-sm-4 form-group">
                            {{ Form::label('PayMonth', 'Pay Month') }}
                            {{ Form::select('PayMonth', ['' => 'Select Month'] + $months->pluck('Months', 'MonthsRef')->toArray(), date('n'), ['class' => 'full-width', 'data-init-plugin' => "select2"] ) }}
                       </div>

                       <div class="col-sm-4 form-group">
                            {{ Form::label('PayYear', 'Pay Year') }}
                            {{ Form::select('PayYear', ['' => 'Select Year'] + $years->pluck('Year', 'Year')->toArray(), date('Y'), ['class' => 'full-width', 'data-init-plugin' => "select2"] ) }}
                       </div>
                   </div>

                   <div class="row">
                       <div class="col-sm-12">
                           {{ Form::submit('Search', ['class' => 'btn btn-complete']) }}
                       </div>
                   </div>
                {{ Form::close() }}
        </div>
    </div>
    {{-- END CARD --}}

  @endsection

  @push('scripts')
    <script src="{{ asset('assets/plugins/cd/accordion/main.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/plugins/loading/progress/loading-bar.min.js') }}" charset="utf-8"></script>
  @endpush
