@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    <style>
        textarea {
        max-height: 50px;
        resize: none;
    }
    </style>
    @endpush
@extends('layouts.master')

@section('content')
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title">
                Search Statement of Result Using Date Range 
            </div>
        </div>
        <div class="panel-body">
            {{ Form::open(['action' => 'TransactionController@printStatement', 'autocomplete' => 'off','role' => 'form']) }}
            <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('CustomerName', 'Customer Account') }}
                           {{ Form::select('GLRef', [ '' =>  'Select Customer Account'] + $customer_details->pluck('CUST_ACCT', 'GLRef')->toArray(),null, ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('StartDate', 'Start Date') }}
                            <div class="input-group date dp">
                                {{ Form::text('StartDate', null, ['class' => 'form-control', 'placeholder' => 'Start Date']) }}
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar">
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="controls">
                            {{ Form::label('EndDate', 'End Date') }}
                            <div class="input-group date dp">
                                {{ Form::text('EndDate', null, ['class' => 'form-control', 'placeholder' => 'End Date']) }}
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar">
                                    </i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="pull-right">
                    {{ Form::submit( 'Search', [ 'class' => 'btn btn-complete ' ]) }}
                {{-- {{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent ' ]) }} --}}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    @endsection

 @push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script>
        $(function(){
            var options = {
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            };
            $('.dp').datepicker({autoclose:true});
        })
    </script>
    @endpush
</link>