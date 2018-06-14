@extends('layouts.master')

@push('styles')
<style>
  .panel-group .panel-heading .panel-title>a {
    color: #626262;
    font-size: 16px;
    font-weight: bold;
    display: block;
    opacity: 1;
}

hr {
    margin-top: -8px !important;
}
</style>
@endpush

@section('title')
  Policies
@endsection

@section('page-title')
  Policies
@endsection

@section('buttons')
  
@endsection
s
@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
      <div style="padding: 30px">
         <ul class="nav nav-pills pull-right">
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicy') }}">Create Policy</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicySegment') }}">Create Policy Segment</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicyStatement') }}">Create Policy Statement</a></li>
         </ul>
      </div><div class="clearfix"></div>
  			<div class="card-title pull-left" style="font-size: 20px !important">Policies</div><div class="clearfix"></div>
           <div class="row">
               <div class="col-md-6">
                <div class="sm-m-l-5 sm-m-r-5">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($policies as $policy)
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $policy->Policy }}" aria-expanded="false" aria-controls="collapseOne">
                             {{ $policy->Policy }}
                            </a>
                          </h4>
                      </div>
                      <div id="collapse{{ $policy->Policy }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $policy->Policy }}">
                        <div class="panel-body">
                           <ul>
                            @foreach($policy->policy_segments as $segment)
                             <li><a href="#" data-policy="{{ $policy->PolicyRef }}" data-segment="{{ $segment->SegmentRef }}" id="get_data" onclick="get_statement()"  title="">{{ $segment->Segment }}</a></li>
                            @endforeach
                           </ul>
                        </div>
                      </div>
                    </div>
                     @endforeach
                  </div>
                </div>
              </div>

              <div class="col-md-6 hide" id="show_policy">
                <div style="padding: 20px; background: #eee">
                  <span class="pull-right" id="date"></span><div class="clearfix"></div>
                  <h1 id="policy" style="font-weight: bold; font-size: 30px"></h1>
                  <h4 id="segment"></h4><hr>
                  <p id="body" class="m-b-5" style="display: inline-block;"></p>
                  <p id="creator" style="font-style:italic;font-weight: bold" class="pull-right">Created by : </p><div class="clearfix"></div>
                </div>
              </div>

           </div>
  	</div>
  	<!-- END PANEL -->
@endsection

@push('scripts')

  <script>
      
        function get_statement()
        {
          var policy = $(this.event.target).data('policy');
          var segment = $(this.event.target).data('segment');

          $.get('/statement_result/'+policy+'/'+segment, function(data, status) {
                console.log(data); 
                $('#show_policy').removeClass('hide');
                $('#date').text(data.EntryDate); 
                $('#policy').text(data.Policy);  
                $('#segment').text(data.Segment);
                $('#body').html(data.Statement);
                $('#creator').text(data.first_name + ' ' + data.last_name);     
          });
        }

  </script>

@endpush


