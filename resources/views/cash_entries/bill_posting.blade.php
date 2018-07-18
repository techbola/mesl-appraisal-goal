@extends('layouts.master')

@section('content')
<div class="container-fluid container-fixed-lg bg-white">
    <!-- START PANEL -->
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title">
                Bill Posting
            </div>
            <div class="pull-right">
                <div class="col-xs-12">
                    <input class="search-table form-control pull-right" placeholder="Search" type="text">
                    </input>
                </div>
            </div>
            <div class="clearfix">
            </div>
        </div>
        {{ Form::open(['action' => 'CashEntryController@post_bill', 'autocomplete' => 'off', 'novalidate' => 'novalidate', 'role' => 'form']) }}
            <input type="submit" name="" class="btn btn-sm btn-primary btn-rounded" value="Post Bill(s)">
        <div class="panel-body">
            <table class="table tableWithSearch">
                <thead>
                    <th><input type="checkbox" name='showhide' onchange="checkAll(this)"/></th>
                    <th>GL Ref</th>
                    <th>Billing Date</th>
                    <th>Bill code</th>
                    <th>Patient Name</th>
                    <th>Staff Name</th>
                    <th>Bill Amount</th>
                </thead>
                <tbody>
                   @foreach($postedbills as $postedbill)
                        <tr>
                            <td><input type="checkbox" name="BillPost[]" id="ticked" value="{{ $postedbill->GroupID }}" ></td>
                            <td>{{ $postedbill->GLRef }}</td>
                            <td>{{ $postedbill->BillingDate }}</td>
                            <td>{{ $postedbill->GroupID }}</td>
                            <td>{{ $postedbill->Fullname }}</td>
                            <td>{{ $postedbill->StaffName }}</td>
                            <td>&#8358;{{ number_format($postedbill->Price,2) }}</td>
                            
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
     {{ Form::close() }}
</div>
@endsection

    @push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>
<script>
   function checkAll(e) {
   var checkboxes = document.getElementsByid('ticked');
 
   if (e.checked) {
     for (var i = 0; i < checkboxes.length; i++) { 
       checkboxes[i].checked = true;
     }
   } else {
     for (var i = 0; i < checkboxes.length; i++) {
       checkboxes[i].checked = false;
     }
   }
 }
</script>
@endpush

