@extends('layouts.master')
@section('buttons')
  <a href="{{ route('estate-management.complaints.index') }}" class="btn btn-info btn-rounded pull-right" >Complaints List</a>
@endsection
@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Discussion on: </div>
  			<div class="clearfix"></div>
  			@foreach($complaint_discussions as $cd)
        <p>
          <span class="commenter text-info">{{ $cd->id }}</span>
          {!! $cd->comment !!}
        </p> <hr>
        @endforeach
			 
  	</div>

  	<div class="card-box hide">
  		<div class="pull-right">
			<div class="col-xs-12">
				<input type="text" class="search-table form-control pull-right" placeholder="Search">
			</div>
		</div>
		<div class="clearfix"></div>
  	</div>
  	<!-- END PANEL -->

@endsection

@push('scripts')
  
@endpush



