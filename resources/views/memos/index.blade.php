@extends('layouts.master')
@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Your Memos</div>
  			<div class="pull-right">
  				<div class="col-xs-12">
  					<input type="text" class="search-table form-control pull-right" placeholder="Search">
  				</div>
  			</div>
  			<div class="clearfix"></div>
  			
        <table class="table tableWithSearch table-bordered">
          <thead>
            <th width="10%">Subject</th>
            <th width="10%">Purpose</th>
            <th width="20%">Body</th>
            <th width="10%">Status</th>
            <th width="5%">Actions</th>

          </thead>
          <tbody>
            @foreach ($memos as $memo)
              <tr>
                <td>{{ $memo->subject }}</td>
                <td>{{ $memo->purpose }}</td>
                <td>{{ str_limit($memo->body,20, '...') }}</td>
                <td>
                    @if($memo->status() == 1) <!-- approved -->
                        <label class="label label-success">Approved</label>
                    @else
                        <label class="label label-default">{{ $memo->status() }}</label>    
                    @endif
                </td>
                <td class="actions">
                  @if(!$memo->sent())
                  <a href="{{ route('send_memo', ['id' => $memo->id]) }}" class="btn btn-sm btn-inverse m-r-5" data-toggle="tooltip" title="">Send</a>
                  @else
                  <a href="{{ route('send_memo', ['id' => $memo->id]) }}" class="btn btn-sm disabled m-r-5" data-toggle="tooltip" title="">Sent <i cla></i></a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

  	</div>
  	<!-- END PANEL -->



@endsection



