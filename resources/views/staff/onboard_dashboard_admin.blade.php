@extends('layouts.master')

@push('styles')

	<style>
		.modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
    }

    thead tr {
      font-weight: bold;
      color: #000;
    }

	</style>
@endpush

@section('content')
<div class="card-box">
        <div class="card-title pull-left">Staff Onboarding Requests</div>
        <div class="pull-right">
            <div class="col-xs-12">
                <input type="text" class="search-table form-control pull-right" placeholder="Search">
            </div>
        </div>
        <div class="clearfix"></div>
            
      <table class="table tableWithSearch table-bordered">
        <thead>
          <th width="10%">Employee</th>
          <th width="7%">Department</th>
          <th width="7%">Employment</th>
          <th width="5%">Resumption</th>
          <th width="12%">Office Assets</th>
          <th width="15%">Action</th>
        </thead>
        <tbody>

          @foreach($staff_onboards as $staff_onboard)
            @if($staff_onboard->ApprovalStatus2 !== "0")  
              <tr>
                <td>{{$staff_onboard->StaffName}}</td>
                  <td>{{$staff_onboard->staff_department->name}}</td>
                  <td>{{$staff_onboard->StaffType}}</td>
                  <td>{{$staff_onboard->ResumptionDate}}</td>
                  <td>
                    {{$staff_onboard->OfficeSpace}}, {{$staff_onboard->OfficeTable}}, {{$staff_onboard->BusinessCard}}
                  </td>
                <td>
                    {{-- <button type="submit" class="btn btn-xs btn-success">Onboard Staff</button> {{ route('SendOnboarding', $staff_onboard->StaffOnboardRef) }} --}}
                    <a href="{{ url('admin_onboard_mail')}}/ {{$staff_onboard->StaffOnboardRef }}" class="btn btn-xs btn-success">
                      <i class="fa fa-share-square"></i> Mark as Done
                    </a>
                </td>
              </tr>
            @endif
            @endforeach
        </tbody>
      </table> 
</div>





@endsection


@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>

<script>
    

     $(document).ready(function() {
    $('#travelTable').DataTable( {
        "scrollX": true
    } );
} );


</script>

@endpush