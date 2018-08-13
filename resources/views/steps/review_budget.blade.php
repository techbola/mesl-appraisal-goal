@extends('layouts.master')

@section('title')
  Review Budget
@endsection

@section('page-title')
  <span class="">Budget Review For Project Steps</span>
@endsection

@section('content')

  <style media="screen">
    tbody > tr > td {
      font-size: 12px !important;
    }
  </style>

  {{-- START TABS --}}
  {{-- <ul class="nav nav-tabs outside">
    <li class="active"><a data-toggle="tab" href="#complete">Completed Milestones</a></li>
    <li><a data-toggle="tab" href="#incomplete">Incomplete Milestones</a></li>
  </ul>
  <div class="tab-content">
    <div id="complete" class="tab-pane fade in active">
    </div>
    <div id="incomplete" class="tab-pane fade">

      @include('steps.incomplete_milestones')

    </div>
  </div> --}}
  {{-- END TABS --}}



  <form action="" method="GET" onsubmit="$('#spinner').show()">
    <div class="row m-b-20">
      <div class="col-md-3 col-md-offset-2">
        <div class="form-group">
          <label for="">Project</label>
          <select class="full-width select2" data-init-plugin="select2" name="project">
            <option value="">Select Project</option>
            @foreach ($projects as $project)
              <option value="{{ $project->ProjectRef }}" {{ ($project_id == $project->ProjectRef)? 'selected':'' }}>{{ $project->Project }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Milestone Status</label>
          <select class="full-width select2" data-init-plugin="select2" name="status">
            <option value="1" {{ ($status=='1')? 'selected':'' }}>Completed</option>
            <option value="0" {{ ($status=='0')? 'selected':'' }}>Not Completed</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <label></label>
        <button type="submit" class="btn btn-info m-t-25 btn-cons">Fetch</button>
        {{-- <a href="{{ url()->current() }}" class="btn btn-inverse m-t-25 btn-cons" onclick="$('#spinner').show()">Reset</a> --}}
      </div>
    </div>
  </form>


  <div class="card-box">
    <div class="card-title">Budget Review</div>
    <div class="checkbox check-info pull-left">
      <input type="checkbox" id="select-all">
      <label for="select-all">Bulk Select</label>
    </div>
    @if ($status != '0')
      <button style="margin-left: 10px" class="approve-btn btn btn-sm btn-success">Approve</button>
    @endif
    <button style="margin-left: 10px" class="reject-btn btn btn-sm btn-danger">Reject</button>

    <table class="table table-bordered tableWithSearch">
      <thead>
        <th width="4%"></th>
        <th>Task</th>
        <th width="15%">Milestone</th>
        <th>Project Manager</th>
        <th>Vendor</th>
        <th>Budget Cost</th>
        {{-- <th>Start Date</th>
        <th>End Date</th> --}}
        <th>Variation</th>
        <th>Total</th>
        <th>Actions</th>
        <th>Payment Status</th>
      </thead>
      <tbody>
        @foreach ($updates as $update)
          <tr>
            <td>
              @if ($update->Status == NULL)
                <div class="checkbox check-info">
                  <input type="checkbox" id="select-all-child-{{ $update->id }}" class="select-all-child" value="{{ $update->id }}">
                  <label for="select-all-child-{{ $update->id }}" class="m-0 p-0"></label>
                </div>
              @endif
            </td>
            <td>
              {{ $update->step->task->Task }}
            </td>
            <td>{{ $update->step->Step ?? '' }}</td>
            <td>{{ $update->step->task->project->supervisor->FullName ?? '&mdash;' }}</td>
            <td>{{ $update->step->task->project->vendor->Customer ?? '&mdash;' }}</td>
            <td>{{ nairazify(number_format($update->BudgetCost)) }}</td>
            {{-- <td>{{ $update->step->StartDate ?? '' }}</td>
            <td>{{ $update->step->EndDate ?? '' }}</td> --}}
            <td>{{ ngn($update->Variation) ?? '&mdash;' }}</td>
            <td class="bold">{{ ngn($update->BudgetCost + $update->Variation) ?? '&mdash;' }}</td>
            <td class="actions">
              @if ($update->Status == NULL)
                @if ($status != '0')
                  <a class="btn btn-xs btn-success" onclick="confirm2('Approve this budget?', '', 'approve_budget_{{ $update->id }}')">Approve</a>
                  <form class="hidden" id="approve_budget_{{ $update->id }}" action="{{ route('approve_step_budget', $update->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                  </form>
                @endif
                <a class="btn btn-xs btn-danger" onclick="confirm2('Reject this budget?', 'The initiator would be able to submit another request.', 'reject_budget_{{ $update->id }}')">Reject</a>

                <form class="hidden" id="reject_budget_{{ $update->id }}" action="{{ route('reject_step_budget', $update->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                </form>
              @elseif($update->Status == '1')
                <span class="text-success">Approved</span>
              @elseif($update->Status == '0')
                <span class="text-danger">Rejected</span>
              @endif
            </td>
            <td>
              @if ($update->PaymentRejectedFlag == '1')
                <span class="text-danger">Declined</span><br>
                "<span>{{ $update->Comment }}</span>"
              @else
                <span class="">In Progress</span>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection

@push('scripts')
  <script>

    $(function(){
      $("#select-all").click(function() {
          $('.select-all-child').prop('checked', this.checked);
          // $('tbody td div .select-all-child').attr('checked', 'checked').trigger('change');
      });

      $(".select-all-child").click(function(){

          if($(".select-all-child").length == $(".select-all-child:checked").length) {
              $("#select-all").prop("checked", "checked");
          } else {
              $("#select-all").removeAttr("checked");
          }
      });
    });


    // Approval button script
   $('.approve-btn').click(function(e) {
       e.preventDefault();
       var that = $(this);
       var checked_docs = $('.select-all-child:checked');
       var checked_docs_array = [];
       $.each(checked_docs, function(index, val) {
            checked_docs_array.push(parseInt($(val).prop('value')));
       });
       console.log(checked_docs_array)
     var ApprovedDate = "{{ \Carbon\Carbon::now() }}";
     var ApprovedBy = {{ auth()->user()->id }};
       alert('Are You sure you want to approve these budgets?');

       $.ajax({
           url: '/bulk_approve_budget',
           type: 'POST',
           data: {
              _token:  '{{ csrf_token() }}',
              _method:  'PATCH',
              ApprovedBy: {{ auth()->user()->id }},
              budget_ids: checked_docs_array,
              ApprovedDate: ApprovedDate,
          },
          beforeSend: function(){
              // show button animation
              // that.text('Approving ...');
          }
       })
       .done(function(res, status, xhr) {
         console.log(res);
           if(xhr.status == 200) {
              window.location.href  = "{{ route('review_step_budget') }}";

           } else {
              alert('Approval failed');
              return false
           }
       })
       .fail(function() {
           console.log("error");
       });
   });


   $('.reject-btn').click(function(e) {
      e.preventDefault();
      var checked_docs = $('.select-all-child:checked');
      var checked_docs_array = [];
      $.each(checked_docs, function(index, val) {
           checked_docs_array.push(parseInt($(val).prop('value')));
      });
      var RejectedDate = "{{ \Carbon\Carbon::now() }}";
      var RejectedBy = {{ auth()->user()->id }};
      alert('Are You sure you want to reject this budget?');
      $('#spinner').show();

      $.ajax({
          url: 'bulk_reject_budget',
          type: 'POST',
          data: {
             _token:  '{{ csrf_token() }}',
             _method:  'PATCH',
             budget_ids: checked_docs_array,
             RejectedBy: {{ auth()->user()->id }},
             RejectedDate: RejectedDate,
         },
      })
      .done(function(res, status, xhr) {
          // Navigate to the list after succesful posting to the server
          if(xhr.status == 200) {
             window.location.href  = "{{ route('review_step_budget') }}";
          } else {
             alert('Rejection failed');
             return false
          }

      })
      .fail(function() {
          console.log("error");
      });

  });
  </script>
@endpush
