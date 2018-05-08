@extends('layouts.master')

@section('title')
	Edit Amortisation
@endsection

@section('content')

  <style>
    .toggle_icon {
      font-size: 20px;
    }
  </style>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Edit Amortisation</h3>
    </div>
    <div class="panel-body">
      @include('errors.list')
      {!! Form::model($amort, ['route' => ['update_amort', $amort->MonthlyAmortRef] ]) !!}
      {{ method_field('PATCH') }}
      @include('amortisation.form')
      <div class="text-right m-t-10">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>

@endsection


@push('scripts')
  <script>
  // Asset Categories
  function new_item() {
    $('.select_item').removeAttr('name').hide();
    $('.input_item').prop('name', 'MonthlyAmortItem').show();
    $('.toggle_item').html('<i class="fa fa-times-circle text-danger"></i>').attr('onclick', 'choose_item()');
  }
  function choose_item() {
    $('select.select_item').attr('name', 'MonthlyAmortItemID');
    $('.select2-container.select_item').show();
    $('.input_item').removeAttr('name').hide();
    $('.toggle_item').html('<i class="fa fa-plus-circle text-success"></i>').attr('onclick', 'new_item()');
  }
  </script>
@endpush
