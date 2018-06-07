@extends('layouts.master')
@section('title')
  Estate Management
@endsection

@section('page-title')
  Complaints
@endsection

@section('buttons')
  <a href="{{ route('estate-management.complaints.create') }}" class="btn btn-info btn-rounded pull-right" >Log Complaints</a>
@endsection

@section('content')

  	<!-- START PANEL -->
    <div class="card-title pull-left">All Complaints</div>
    <div class="pull-right">
      <div class="col-xs-12">
        <input type="text" class="search-table form-control pull-right" placeholder="Search">
      </div>
    </div>
    <div class="clearfix"></div>
  	<div class="">

      <ul class="nav nav-tabs outside">
        <li class="active"><a data-toggle="tab" href="#unapproved">Unsent Complaints &nbsp; <span class="badge badge-warning"></span></a></li>
        <li><a data-toggle="tab" href="#approved">Sent Complaints &nbsp; <span class="badge badge-success"></span></a></li>
        <li><a data-toggle="tab" href="#inbox">Complaints Inbox &nbsp; <span class="badge badge-danger"></span></a></li>
      </ul>
      <div class="tab-content">
        <div id="unapproved" class="tab-pane fade in active">
          
            <div class="card-box ">
                <table class="table tableWithSearch">
                  <thead>
                    <th>Client's Name</th>
                    <th>Allocation</th>
                    <th>Location</th>
                    <th>Complaints</th>
                    <th>Status</th>
                    <th>Actions</th>

                  </thead>
                  <tbody>
                   @foreach($complaints as $comp)
                   <tr>
                     <td>{{ $comp->client->Name }}</td>
                     <td>{{ $comp->allocation }}</td>
                     <td>{{ $comp->location->Location }}</td>
                     <td>{!! $comp->complaints !!}</td>
                     <td>
                       <span class="badge">Not Sent</span>
                     </td>
                     <td class="actions" width="130">
                       @if(!$comp->sent())
                        <a href="{{ route('estate-management.complaints.edit', ['id' => $comp->id ]) }}" class="btn btn-sm btn-info">Edit </a>
                        <a href="{{ route('estate-management.send-complaints', ['id' => $comp->id]) }}" class="btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send</a>
                        @else
                        <a href="{{ route('estate-management.complaints.edit', ['id' => $comp->id ]) }}" class="btn btn-sm disabled ">Edit </a>
                        <a href="{{ route('estate-management.send-complaints', ['id' => $comp->id]) }}" class="btn btn-sm disabled m-r-5" data-toggle="tooltip" title="">Sent </a>
                        @endif
                     </td>
                   </tr>
                   @endforeach
                  </tbody>
                </table>
            </div>
        </div>

        <div id="approved" class="tab-pane fade">

          
          <div class="card-box">
          </div>

        </div>

        <div id="inbox" class="tab-pane fade">

          
          <div class="card-box">
          
          </div>

        </div>
      </div>
  			

  	</div>
  	<!-- END PANEL -->


 



@endsection

@push('scripts')
  <script src="{{ asset('js/printThis.js') }}"></script>
  <script>
    $(function(){
    });



  </script>
@endpush



