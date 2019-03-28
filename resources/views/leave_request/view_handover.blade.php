@extends('layouts.master')

@push('styles')
  <style>
    .tooltip-inner {
    max-width: 200px;
    padding: 20px;
    color: #fff;
    text-align: center;
    text-decoration: none;
    background-color: red;
    border-radius: 4px;
}
  </style>  
@endpush

@section('title')
  Handover
@endsection

@section('page-title')
  Handover
@endsection

@section('buttons')
  <a href="{{ route('LeaveRequest') }}" class="btn btn-info btn-rounded pull-right" >Leave Handover</a>
@endsection

@section('content')


   <table class="table tableWithSearch table-bordered">
                <thead>
                  <th width="10%">Task</th>
                  <th width="10%">Description</th>
                  <th width="10%">Completion Date</th>

                </thead>
                <tbody>

                  @foreach($handover_notes as $lr)
                      
                      <td >{{$lr->Task}}</td>
                      <td >{{$lr->Description}}</td>
                      <td >{{nice_date($lr->StartDate)}}</td>
                     
                    </tr>
                    @endforeach
                </tbody>
              </table>

     
   
@endsection

@push('scripts')
  <script>
    $(jQuery(document)).ready(function($) {
     $('#test').tooltip('show');
    });
  </script>
@endpush



