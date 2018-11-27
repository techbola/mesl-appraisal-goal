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
      @if(count($check) >= 1)
      <div style="padding: 30px">
         <ul class="nav nav-pills pull-right">
             <li role="presentation" class="active"><a href="{{ route('PolicyApprover') }}">Create New/View Policy Approvers</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicySegment') }}">Create New/View Policy Segments</a></li>
             <li role="presentation" class="active"><a href="{{ route('CreateNewPolicyStatement') }}">Create New/View Policy Statements</a></li>
             <li><a class="btn btn-info btn-sm" style="color: #fff" href="{{ route('CreateNewPolicy') }}">Create New/View Policies</a></li>
         </ul>
      </div><div class="clearfix"></div>
      @endif
  			<div class="card-title pull-left" style="font-size: 20px !important">Company Policies</div><div class="clearfix"></div>
           <div class="row"><hr>
               <div class="col-md-4">
                 <div class="form-group">
                    <div class="controls">
                        {{ Form::label('Select Policy' ) }}
                            {{ Form::select('PolicyID', [ '' =>  'Select Policy'] + $policies->pluck('Policy', 'PolicyRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose policy",'id'=>'policy_id', 'onchange' => 'get_segments()', 'data-init-plugin' => "select2", 'required']) }}
                    </div>
                  </div>

                  <div class="hide" id="segments" style="margin-top: 20px; padding: 20px; background: #dedede; ">
                    <h3>Segments</h3><hr>
                    <ol id="segments_list">
                      
                    </ol>
                  </div>        
              </div>

              <div class="col-md-8 hide" id="show_policy">
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

        function get_segments()
        {
          var policy_id = $('#policy_id').val();
          $.get('/policy_segments/'+policy_id, function(data, status) {
            console.log(data);
              $('#segments').removeClass('hide');
              $('#segments_list').html(' ');
               $.each(data, function(index, val) {
                    $('#segments_list').append("<li><a href='#' id='get_seg' onclick='get_statement()' data-id='"+val.SegmentRef+"'>" + val.Segment+ "</a></li>");
                });
          });
        }
      
        function get_statement()
        {
          // var policy = $(this.event.target).data('policy');
          var policy = $('#policy_id').val();
          var segment = $(this.event.target).data('id');

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


