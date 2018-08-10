@extends('layouts.master')

@section('content')
<div class="card-box">
    <div class="panel-heading">
        <div class="panel-title">
            Edit Reciept
        </div>
    </div>
    <div class="panel-body">
        {{ Form::model($entry, ['action' => ['CashEntryController@update_imprest', $entry->CashEntryRef ], 'autocomplete' => 'off', 'role' => 'form']) }}
        {{ method_field('PATCH') }}
        @include('cash_entries.Imprest_form', ['buttonText' => 'Save'])
        {{ Form::close() }}
    </div>
</div>
@endsection