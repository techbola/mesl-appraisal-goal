@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}
  </style>
@endpush

@section('title')
  Create Policy Segment
@endsection

@section('page-title')
  Create Policy Segment
@endsection

@section('buttons')
  
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
      <div style="padding: 30px">
         <ul class="nav nav-pills pull-right">
             <a href="#" data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-lg btn-info">Add Policy Segment</a>
         </ul>
      </div><div class="clearfix"></div>
  			<div class="card-title pull-left" >List Policy Segments</div><div class="clearfix"></div>
           <div class="row">
            <div id="policy_table">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th></th>
                    <th>Entry Date</th>
                    <th>Policy</th>
                    <th>Segment</th>
                    <th>Entered By</th>
                    <th colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($segments as $segment)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $segment->EntryDate }}</td>
                    <td>{{ $segment->Policy }}</td>
                    <td>{{ $segment->Segment }}</td>
                    <td>{{ $segment->first_name }}  {{ $segment->last_name }}</td>
                     <td><a href="#" id="edit_modal" data-id="{{ $segment->SegmentRef }}" data-segment="{{ $segment->Segment }}" data-target="#modalFillIn2" data-toggle="modal"  class="btn btn-success btn-sm"  title="">Edit Policy</a></td>
                    <td><a href="#" id="delete_modal" data-id="{{ $segment->SegmentRef }}" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-danger btn-sm" title="">Delete</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
           </div>
  	</div> 
  	<!-- END PANEL -->


    <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 600px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000" id="title">New policy Segment</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">

                            <div id="item_div">
                              <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('policy' ) }}
                                               {{ Form::select('PolicyID', [ '' =>  'Select Policy'] + $policies->pluck('Policy', 'PolicyRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose policy",'id'=>'policy_id', 'data-init-plugin' => "select2", 'required']) }}
                                       </div>
                                  </div>
                              </div>

                               <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('policy Segment' ) }}
                                               {{ Form::text('Segment', null, ['class' => 'form-control', 'id'=>'item', 'placeholder' => 'Input Policy Segment', 'required']) }}
                                       </div>
                                  </div>
                              </div>
                            </div>
                              <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-info pull-right" id="add_policy_segment" data-dismiss="modal" value="Add New Policy Segment">
                                <input type="submit" class="btn btn-sm btn-success pull-right hide" id="edit_policy_segment" data-dismiss="modal" value="Edit Policy Segment">
                                <input type="submit" class="btn btn-sm btn-danger pull-right hide" id="delete_policy_segment" data-dismiss="modal" value="Delete Policy Segment">
                              </div><p id="xyz" class="hide"></p>
                            
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
                {{ csrf_field() }}
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>
@endsection

@push('scripts')

<script>

  $(document).ready(function() {

     $(document).on('click', '#btnFillSizeToggler2', function(event) {
    $('#title').text('Add New Policy');
     $('#edit_policy_segment').addClass('hide');
    $('#add_policy_segment').removeClass('hide');
    $('#delete_policy_segment').addClass('hide');
    $('#item_div').removeClass('hide');
    $('#item').val(' ');
  });


      $(document).on('click', '#edit_modal', function(event) {
          $('#title').text('Edit Policy');
          $('#edit_policy_segment').removeClass('hide');
          $('#add_policy_segment').addClass('hide');
          $('#delete_policy_segment').addClass('hide');
          var id = $(this).data('id');
           var segment = $(this).data('segment');
          $('#xyz').text(id);
           $('#item').val(segment);
          $('#item_div').removeClass('hide');
    });

       $(document).on('click', '#delete_modal', function(event) {
        $('#title').text('Are you sure you want to delete these Policy Segment?');
         $('#delete_policy_segment').removeClass('hide');
         $('#add_policy_segment').addClass('hide');
         $('#edit_policy_segment').addClass('hide');
         var id = $(this).data('id');
         $('#xyz').text(id);
         $('#item_div').addClass('hide');

    });

      
   $("#add_policy_segment").click(function(e){
         var policy = $('#policy_id').val();
          var segment = $('#item').val();
          $.post('/Post_Policy_segment', {'PolicyID': policy, 'Segment': segment, '_token':$('input[name=_token]').val()}, function(data, textStatus, xhr) {
           console.log(data);
           $('#policy_table').load(location.href + ' #policy_table');
        });  
    });


    $("#delete_policy_segment").click(function(e){
    // $(document).on('click', '#delete_policy_segment', function(event) {
    var id = $('#xyz').text();
    $.get('/delete_policy_segment/'+id,  function(data, status) {
      console.log(status);
     $('#policy_table').load(location.href + ' #policy_table');
    });
  });

    $("#edit_policy_segment").click(function(e){
    // $(document).on('click', '#edit_policy_segment', function(event) {
    var id = $('#xyz').text();
    var segment = $('#item').val();
    var policy = $('#policy_id').val();
    $.get('/update_policy_segment/'+id+'/'+segment+'/'+policy,  function(data, status) {
      console.log(status);
     $('#policy_table').load(location.href + ' #policy_table');
    });
  });

    

  });

</script>

@endpush


