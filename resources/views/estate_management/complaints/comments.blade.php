@extends('layouts.master')
@section('buttons')
  <a href="{{ route('estate-management.complaints.index') }}" class="btn btn-info btn-rounded pull-right" >Complaints List</a>
@endsection
@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
  			<div class="card-title pull-left">Discussion</div>
  			<div class="clearfix"></div>
  			@foreach($complaint_discussions as $cd)
        <div>
         <div class="row">
            <div class="col-sm-7">
              <span class="commenter badge badge-info">{{ $cd->department->Department }}</span> <br><br>
              {!! $cd->comment !!}
              <b>Cost:</b> {{ nairazify(number_format($cd->cost, 2)) }} <br>
              <p>Attachments</p>
              @foreach(collect($comments->where('id',$cd->id)->first()->attachments)->all() as $v)
              <span><a href="{{ asset('storage/complaint_attachments/'.$v->attachment_location) }}"></a></span>
              @endforeach
            </div>


            <div class="col-sm-5">
              <span>
                <i class="test-info">
                  {{ \Carbon\Carbon::parse($cd->created_at)->diffForHumans() }}
                </i>
              </span>
            </div>
         </div>
        </div> <hr>
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



