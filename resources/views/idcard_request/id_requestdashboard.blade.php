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

    {{-- ID card request Table --}}
    <div class="card-box">
        <div class="card-title pull-left">ID Card Requests</div>
        <div class="pull-right">
            <div class="col-xs-12">
                <input type="text" class="search-table form-control pull-right" placeholder="Search">
            </div>
        </div>
        <div class="clearfix"></div>
            
      <table class="table tableWithSearch table-bordered">
        <thead>
          <th width="10%">Staff Name</th>
          <th width="7%">Staff Number</th>
          <th width="7%">Staff Department</th>
          <th width="5%">Purpose</th>
          <th width="12%">Date Of Request</th>
          <th width="15%">Action</th>
        </thead>
        <tbody>
            @foreach($idcard_requests as $idcard_request)
                <tr>
                    <td>{{$idcard_request->StaffName}}</td>
                    <td>{{$idcard_request->staff_department->name}}</td>
                    <td>{{$idcard_request->IdPurpose}}</td>
                    <td>{{$idcard_request->RequestDate}}</td>
                    <td>{{$idcard_request->ExpectedDate}}</td>
                    <td>
                    {{-- <a onclick="confirm2('Send Request?', '', 'sendreq_{{ $idcard_request->IDcardRequestRef }}')" class="btn btn-xs btn-success"><i class="fa fa-share-square"></i> Onboard Staff</a>
                    <a href="/idcard_request/create/{{$idcard_request->IDcardRequestRef}}" type="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>

                    <form id="sendreq_{{ $idcard_request->IDcardRequestRef }}" action="{{ route('SendIDReq', $idcard_request->IDcardRequestRef) }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                    </form> --}}
                    </td>
                </tr>
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