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
      <div class="card-title text-center">Employees Travel Requests awaiting final approval</div>
      <hr>
      <div class="clearfix"></div>
    <div class="request-table">
        <table class="table datatable table-bordered" id="requestTable">
               <thead>
                    <th>S/N</th>
                    <th>Date Created</th>
                    <th>Staff Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                    <th>Travel Purpose</th>
                    <th>Approver Comment</th>
                    <th>Action</th>
                </thead>
                 <tfoot class="thead">
                    <th>S/N</th>
                    <th>Date Created</th>
                    <th>Staff Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure Date</th>
                    <th>Arrival Date</th>
                    <th>Travel Purpose</th>
                    <th>Approver Comment</th>
                    <th>Action</th>
                </tfoot>
                <tbody>
                    <?php $count = 0;?>
                    @foreach($travel_requests as $travel_request)
                    @if($travel_request->RequestApprovedd !== "1")

                    <tr>
                        <td><?php $count = $count + 1;?></td>
                        <td>{{ nice_date($travel_request->RequestDate) }}</td>
                        <td>{{ $travel_request->requester_name->FullName ?? '-'  }}</td>
                        <td>{{ $travel_request->TravelType == 1 ? $travel_request->travel_from_state->State : $travel_request->travel_from_state->State ?? '-' }}</td>
                        <td>{{ $travel_request->TravelType == 1 ? $travel_request->travel_to_state->State : $travel_request->travel_to_country->Country ?? '-' }}</td>
                        <td>{{ $travel_request->DepartureDate }}</td>
                        <td>{{ $travel_request->ArrivalDate }}</td>
                        <td>{{ $travel_request->travel_purpose->TravelPurpose ?? '-' }}</td>
                        <td>
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('ApproverComment', 'Approver Comment' ) }}
                                    {{ Form::text('ApproverComment', null, ['class' => 'form-control', 'placeholder' => 'Approver Comment', 'rows'=> '2']) }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <a style="margin-right: 10px; display: inline-block" href="{{ route('admin-approved', $travel_request->TravelRef) }}" type="submit" class="btn btn-sm btn-success toggler" data-toggle="tooltip" data-placement="top" title="Approve"><i class="fa fa-send"></i></a>

                            <a style="margin-right: 10px; display: inline-block" href="{{ route('admin-rejected', $travel_request->TravelRef) }}" type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Reject"><i class="fa fa-user-times"></i></a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
        </table>
    </div>
  </div>

   <div class="modal fade" role="dialog" id="myModal">
      <div class="modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Select Approvers where required</h4> <hr>
            <div class="alert alert-info text-left">Select approver(s) where additional approval is required; otherwise, submit to route directly to Admin.</div>
          </div>
          <div class="modal-body">
           <form id="approvers-form" method="post">
            {{ csrf_field() }}
               <div class="row">
                   <label for="textarea">Comment</label>
                   <textarea name="ApproverComment" class="form-control" cols="30"></textarea>
               </div>
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
      </form>
    </div><!-- /.modal -->

@endsection

@push('scripts')

<script>
    var table = $('#requestTable').DataTable();

      $('#requestTable tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#requestTable tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="my-input input-sm" placeholder="' + $.trim(title) + '" />');
        });
 table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
$('#requestTable tfoot tr').appendTo('#requestTable thead');
</script>

@endpush
