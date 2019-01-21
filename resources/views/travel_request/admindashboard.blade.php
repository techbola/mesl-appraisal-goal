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

    table th, table td {
        width: 150px  !important;
    }

    .table {
      overflow: scroll;

    }
	</style>
@endpush

@section('content')

  <div class="card-box">
      <div class="card-title text-center">Employees Travel Requests</div>
      <hr>
    <div class="request-table table-responsive">
        <table class="table table-bordered" id="requestTable">
                <thead>
                    <tr>
                    <th style="width: 10px; word-break:break-all;">S/N</th>
                    <th>Staff Name</th>
                    <th>Travel Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure Date</th>
                    <th>Departure Time</th>
                    <th>Arrival Date</th>
                    <th>Arrival time</th>
                    <th>Travel Purpose</th>
                    <th>Travel Lodge</th>
                    <th>Travel Transporter</th>
                    <th>Approver Comment</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 0; ?>
                    @foreach($travel_requests as $travel_request)
                    <?php $count = $count + 1; ?>
                    <tr>
                    <th style="width: 10px;">{{ $count }}</th>
                    <td>{{ $travel_request->requester_name->FullName ?? '-'  }}</th>
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
                    <td style="width: 20%">
                        <a href="{{ route('approved', $travel_request->TravelRef) }}" type="submit" class="btn btn-sm btn-success toggler" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-send"></i></a>

                        <a href="{{ route('rejected', $travel_request->TravelRef) }}" type="submit" class="btn btn-sm btn-Danger" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa fa-user-times"></i></a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
  </div>

@endsection

@push('scripts')

<script>

      $(document).ready(function() {
    $('#requestTable').DataTable( {
        "scrollX": true
    } );
} );

</script>

@endpush