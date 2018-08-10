@extends('layouts.master')

@section('title')
  Review Budget
@endsection

@section('page-title')
  <span class="">Budget Review For Project Steps</span>
@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Budget Review</div>
    <div class="checkbox check-info">
        <input type="checkbox" id="select-all">
        <label for="select-all">Bulk Select</label>
      </div>
      <button style="margin-left: 10px" class="approve-btn btn btn-sm btn-success">Approve</button>
      <button style="margin-left: 10px" class="reject-btn btn btn-sm btn-danger">Reject</button>

    <table class="table table-bordered tableWithSearch">
      <thead>
        <th width="5%"></th>
        <th>Project / Task</th>
        <th>Milestone</th>
        <th>Project Manager</th>
        <th>Budget Cost</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Variation</th>
        <th>Actions</th>
      </thead>
      <tbody>
        @foreach ($updates as $update)
          <tr>
            <td>
              @if ($update->Status == NULL)
                <div class="checkbox check-info">
                  <input type="checkbox" id="select-all-child-{{ $update->id }}" class="select-all-child" value="{{ $update->id }}">
                  <label for="select-all-child-{{ $update->id }}"></label>
                </div>
              @endif
            </td>
            <td class="small">
              <b>Project:</b> {{ $update->step->task->project->Project }}<br>
              <b>Task:</b> {{ $update->step->task->Task }}
            </td>
            <td>{{ $update->step->Step ?? '' }}</td>
            <td>{{ $update->step->task->project->supervisor->FullName ?? '' }}</td>
            <td>{{ nairazify(number_format($update->BudgetCost)) }}</td>
            <td>{{ $update->step->StartDate ?? '' }}</td>
            <td>{{ $update->step->EndDate ?? '' }}</td>
            <td>{{ ngn($update->Variation) ?? '&mdash;' }}</td>
            <td class="actions">
              @if ($update->Status == NULL)
                <a class="btn btn-sm btn-success" onclick="confirm2('Approve this budget?', '', 'approve_budget')">Approve</a>
                <a class="btn btn-sm btn-danger" onclick="confirm2('Reject this budget?', 'The initiator would be able to submit another request.', 'reject_budget')">Reject</a>

                <form class="hidden" id="approve_budget" action="{{ route('approve_step_budget', $update->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                </form>
                <form class="hidden" id="reject_budget" action="{{ route('reject_step_budget', $update->id) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                </form>
              @elseif($update->Status == '1')
                <span class="text-success">Approved</span>
              @elseif($update->Status == '0')
                <span class="text-danger">Rejected</span>
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

      $.ajax({
          url: 'bulk_reject_budget',
          type: 'POST',
          data: {
             _token:  '{{ csrf_token() }}',
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
