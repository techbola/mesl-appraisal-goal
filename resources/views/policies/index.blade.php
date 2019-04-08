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

.form-add-more{
      width: 20px;
      height: 20px;
      line-height: 20px  !important;
      border-radius: 50%;
      text-align: center;
      padding: 0 !important;
      cursor: pointer;
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
                        {{ Form::label('Select Policy' ) }} <span style="padding: 0 !important" class="form-add-more add-policy badge badge-success" data-toggle="modal" data-target="policy_setup"><i style="line-height: 20px" class="fa fa-plus"></i></span>
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
    
    {{-- Modal --}}
    <div class="modal fade" id="policy_setup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Policy</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <hr>
          <div class="modal-body">
              <form action="" method="POST" id="policy-form">
                  {{ csrf_field() }}
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <div class="controls">
                                  {{ Form::label('Policy', 'Policy' ) }}
                                  {{ Form::text('Policy', null, ['class' => 'form-control', 'placeholder' => 'Add Policy', 'required']) }}
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="pull-right">
                          <button class="btn btn-info" type="submit">Submit</button>
                      </div>
                  </div>
              </form>
          </div>
          </div>
      </div>
  </div>

@endsection

@push('scripts')

  <script>

$('.add-policy').click(function(e){
        e.preventDefault();
        $('#policy_setup').show();
        $('#policy_setup').modal('show');
        
    });

    var form1 = $("#policy-form");
        form1.submit(function(e) {
        e.preventDefault();
        $.post('/api/add_policy', {
          Policy: $('#Policy').val()
        }, function(data, textStatus, xhr) {
            if(data.success === true){
            $('#policy_id').append('<option selected value="'+ data.data.PolicyRef +'">' +  data.data.Policy +'</option>');
            $('#policy_setup').modal('hide');
            swal(
                'Success',
                data.data.Policy + ' was added to the list',
                'success'
            )
                $('#Policy').val('');
                
            }
        });
    });

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


