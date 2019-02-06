@extends('layouts.master')

@push('styles')

	<style>
		.modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
    }

    /* thead tr {
      font-weight: bold;
      color: #000;
    } */

    /* table th, table td {
        width: 150px  !important;
    }

    .table {
      overflow: scroll;

    } */

    thead tr {
          font-weight: bold;
          color: #000;
        }

        tbody tr td {
            font-size: 12px;
        }
	</style>
@endpush

@section('content')

  <div class="card-box">
      <div class="card-title text-center">Employees Travel Requests</div>
      <hr>
      <div class="clearfix"></div>
    <div class="request-table">
        <table class="table datatable table-bordered" id="requestTable">
                <thead>
                    <th width="10%">S/N</th>
                    <th width="24%">Staff Name</th>
                    <th>Travel Type</th>
                    <th width="24%">From</th>
                    <th width="24%">To</th>
                    <th width="24%">Departure Date</th>
                    <th>Departure Time</th>
                    <th width="24%">Arrival Date</th>
                    <th>Arrival time</th>
                    <th>Travel Purpose</th>
                    <th>Travel Lodge</th>
                    <th>Travel Transporter</th>
                    <th>Approver Comment</th>
                    <th width="24%">Action</th>
                </thead>
                <tbody>
                    <?php $count = 0; ?>
                    @foreach($travel_requests as $travel_request)
                    <?php $count = $count + 1; ?>
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $travel_request->requester_name->FullName ?? '-'  }}</td>
                        <td>{{ $travel_request->Travel_type->TravelType ?? '-' }}</td>
                        <td>{{ $travel_request->TravelType == 1 ? $travel_request->travel_from_state->State : $travel_request->travel_from_state->State ?? '-' }}</td>
                        <td>{{ $travel_request->TravelType == 1 ? $travel_request->travel_to_state->State : $travel_request->travel_to_country->Country ?? '-' }}</td>
                        <td>{{ $travel_request->DepartureDate }}</td>
                        <td>{{ $travel_request->DepartureTime }}</td>
                        <td>{{ $travel_request->ArrivalDate }}</td>
                        <td>{{ $travel_request->ArrivalTime }}</td>
                        <td>{{ $travel_request->travel_purpose->TravelPurpose ?? '-' }}</td>
                        <td>{{ $travel_request->travel_lodge->TravelLodge ?? '-' }}</td>
                        <td>{{ $travel_request->travel_transporter->Transporter ?? '-' }}</td>
                        <td>
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('ApproverComment', 'Approver Comment' ) }}
                                    {{ Form::text('ApproverComment', null, ['class' => 'form-control', 'placeholder' => 'Approver Comment', 'rows'=> '2']) }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <a style="margin-right: 10px; display: inline-block" href="{{ route('approved', $travel_request->TravelRef) }}" type="submit" class="btn btn-sm btn-success toggler" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-send"></i></a>

                            <a style="margin-right: 10px; display: inline-block" href="{{ route('rejected', $travel_request->TravelRef) }}" type="submit" class="btn btn-sm btn-Danger" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa fa-user-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
  </div>

@endsection

@push('scripts')

{{-- <script>

      $(document).ready(function() {
    $('#requestTable').DataTable( {
        "scrollX": true
    } );
} );

</script> --}}

@endpush
