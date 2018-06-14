@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}
  </style>
@endpush

@section('title')
  Create Policy Statement
@endsection

@section('page-title')
  Create Policy Statement
@endsection

@section('buttons')
  
@endsection

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
      <div style="padding: 30px">
         <ul class="nav nav-pills pull-right">
             <a href="#" data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler2" class="btn btn-lg btn-info">Add Policy Statement</a>
         </ul>
      </div><div class="clearfix"></div>
  			<div class="card-title pull-left" >List Policy Statement</div><div class="clearfix"></div>
           <div class="row" >
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
                    <td><p class="m-b-5" style="display: inline-block;">{{ str_limit(strip_tags($segment->Statement), 50, '...') }}</p></td>
                    <td>{{ $segment->first_name }}  {{ $segment->last_name }}</td>
                    <td><a href="#" id="edit_modal" data-id="{{ $segment->StatementRef }}" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-success btn-sm" title="">Edit Policy</a></td>
                    <td><a href="#" id="delete_modal" data-id="{{ $segment->StatementRef }}"  data-target="#modalFillIn2" data-toggle="modal" class="btn btn-danger btn-sm" title="">Delete</a></td>
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
                <div style="background: #fff; width: 1000px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" id="title" style="color: #000">New policy Segment</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                              <div id="item_div">
                              <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('policy' ) }}
                                               {{ Form::select('PolicyID', [ '' =>  'Select Policy'] + $policies->pluck('Policy', 'PolicyRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Choose policy",'id'=>'policy_id', 'onchange'=>'getSegment()', 'data-init-plugin' => "select2", 'required']) }}
                                       </div>
                                  </div>
                              </div>

                               <div class="col-sm-6">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('policy Segment' ) }}
                                              <select name="SegmentID" class="full-width" id="get_segment" data-init-plugin='select2'>
                                                <option value="">Select Segment</option>
                                              </select>
                                       </div>
                                  </div>
                              </div>

                                  <div class="col-sm-12">
                                      <div class="form-group">
                                          <div class="controls">
                                              {{ Form::label('Statement', 'Statement') }}
                                              {{ Form::textarea('Statement', null, ['class' => 'summernote form-control','id'=>'get_statement','rows' => 3, 'placeholder' => 'Be expressive']) }}
                                         </div>
                                      </div>
                                  </div> 
                                </div>

                              <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-info pull-right" id="add_policy_statement" data-dismiss="modal" value="Add New Policy Segment">
                                <input type="submit" class="btn btn-sm btn-success pull-right hide" id="edit_policy_segment" value="Edit Policy Segment">
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

   $(document).on('click', '#btnFillSizeToggler2', function(event) {
    $('#title').text('Add New Policy');
     $('#edit_policy_segment').addClass('hide');
    $('#add_policy_statement').removeClass('hide');
    $('#delete_policy_segment').addClass('hide');
    $('#item_div').removeClass('hide');
    $('#item').val(' ');
  });


      $(document).on('click', '#edit_modal', function(event) {
          $('#title').text('Edit Policy');
          $('#edit_policy_segment').removeClass('hide');
          $('#add_policy_statement').addClass('hide');
          $('#delete_policy_segment').addClass('hide');
          var id = $(this).data('id');
           var segment = $(this).data('segment');
          $('#xyz').text(id);
           $('#item').val(segment);

           $.get('/get_statement_record/'+id, function(data, status) {
              $('#item_div .note-editable').html(data.Statement);
              // console.log(data.Statement);
           });

          $('#item_div').removeClass('hide');
    });

  $(document).on('click', '#delete_modal', function(event) {
        $('#title').text('Are you sure you want to delete these Policy Segment?');
         $('#delete_policy_segment').removeClass('hide');
         $('#add_policy_statement').addClass('hide');
         $('#edit_policy_segment').addClass('hide');
         var id = $(this).data('id');
         $('#xyz').text(id);
         $('#item_div').addClass('hide');

    });


  $(document).on('click', '#delete_policy_segment', function(event) {
    var id = $('#xyz').text();
    $.get('/delete_policy_statement/'+id,  function(data, status) {
      console.log(status);
     $('#policy_table').load(location.href + ' #policy_table');
    });
  });

  $(document).on('click', '#edit_policy_segment', function(event) {
    var policy = $('#policy_id').val();
    var segment = $('#get_segment').val();
    var statement = $('#get_statement').val();
    var id = $('#xyz').text();
    $.post('/Update_Policy_statement/'+id, {'PolicyID': policy, 'SegmentID': segment,'Statement': statement, '_token':$('input[name=_token]').val()}, function(data, textStatus, xhr) {
     console.log(data);
     $('#policy_table').load(location.href + ' #policy_table');
    });
  });



  function getSegment()
  {
    var policy = $('#policy_id').val();
    $('#get_segment').html(' ');
    $.post('/get_newSegment/'+policy, function(data, status) {
                $.each(data, function(index, val) {
                    $('#get_segment').append("<option value='"+val.SegmentRef+"'>" + val.Segment+ "</option>");
                });

            });
  }
</script>

<script>
  
  $('#add_policy_statement').click(function(event) {
    var policy = $('#policy_id').val();
    var segment = $('#get_segment').val();
    var statement = $('#get_statement').val();
    $.post('/Post_Policy_statement', {'PolicyID': policy, 'SegmentID': segment,'Statement': statement, '_token':$('input[name=_token]').val()}, function(data, textStatus, xhr) {
     console.log(data);
     $('#policy_table').load(location.href + ' #policy_table');
     
    });
  });

</script>

@endpush


