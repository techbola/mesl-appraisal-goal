@extends('layouts.master')

@section('title')
	Estate Info
@endsection

@section('page-title')
	Estate Info
@endsection

@section('buttons')
	<a href="{{ route('estate_allocation') }}" class="btn btn-sm btn-info">Estate Allocation</a>
	<a href="{{ route('estate_status_report') }}" class="btn btn-sm btn-info m-l-5">Estate Status Report</a>
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Estate Units Info</div>
    <div id="update_msg" style="padding:10px"></div>

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Estate</label>
          <select id="estates" class="full-width" data-init-plugin="select2">
            <option value="">Select Estate</option>
            @foreach ($estates as $estate)
              <option value="{{ $estate->BuildingProjectRef }}">{{ $estate->ProjectName }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Blocks</label>
          <select id="blocks" class="full-width" data-init-plugin="select2">
            <option value="">Select Block</option>
          </select>
        </div>
      </div>
    </div>

    <form id="update_form" action="{{ route('update_estate_info') }}" method="post">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
      {{-- <ul id="unit_list" class="my-list">

      </ul> --}}
      <table id="unit_list" class="table table-striped table-bordered">
        <thead>
          <th>Unit</th>
          <th>Allotee Name</th>
          <th>Info</th>
        </thead>
        <tbody>

        </tbody>
      </table>

      <button type="submit" name="update_btn" class="btn btn-lg btn-success btn-cons m-t-10">Update</button>

    </form>

  </div>
@endsection

@push('scripts')
  <script>
    $('#estates').on('change', function() {
      var estate = $(this).val();
      // console.log(estate);
      $('#spinner').show();
      $.get('/get_blocks/'+ estate, function(data, status){
        console.log(data);
        $('#blocks').html('<option value="">Select Block</option>');
        data.forEach(function(block){
          $('#blocks').append(`
            <option value="${block.Block}">${block.Block}</option>
          `);
        });
        $('#spinner').hide();

      });
    });

    $('#blocks').on('change', function() {
      var estate = $('#estates').val();
      var block = $(this).val();
      // console.log(block);
      $('#spinner').show();
      $.get('/get_units/'+ estate +'/'+block, function(data, status){
        $('#unit_list tbody').empty();
        data.forEach(function(unit){
          console.log(unit);
          $('#unit_list tbody').append(`
            <tr>
              <td>${unit.Unit}</td>
              <td>${unit.AllotteeName}</td>
              <td>
                <select class="units full-width" data-init-plugin="select2" name="Units[${unit.AllocationRef}]">
                  <option value="">Select status</option>
                  ${ Object.keys(unit.statuses).map(function (status) {
                      if(unit.EstateInfoID==unit.statuses[status].EstateInfoRef) var is_selected = 'selected';
                      else var is_selected = '';
                      return "<option "+is_selected+" value='" + unit.statuses[status].EstateInfoRef + "'>" + unit.statuses[status].EstateInfo + "</option>"
                  }) }
                </select>
              </td>
            </tr>
          `);
        });

				$('.units').select2();
        $('#spinner').hide();
      });
    });
  </script>

  <script>
    $('#update_form').on('submit', function(e) {
      e.preventDefault();
      $('#spinner').show();
      $.post('/update_estate_info', $('#update_form').serialize(), function(data, status){
        $('#update_msg').html('<div class="alert alert-success m-b-10"><span class="fa fa-check m-r-5"></span>'+data+'</div>');
        $('#spinner').hide();
      });
    })
  </script>
@endpush
