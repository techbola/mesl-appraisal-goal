@extends('layouts.master')

@push('styles')
  <style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
}

tfoot{
      display: table-header-group;
     }
  </style>
@endpush

@section('title')
  Training Agency
@endsection

@section('page-title')
  Training Agency
@endsection

@section('buttons')
  
@endsection 

@section('content')

  	<!-- START PANEL -->
  	<div class="card-box">
      <div style="padding: 30px">
        
      </div><div class="clearfix"></div>
      <div style="padding: 30px">
         <ul class="nav nav-pills pull-right">
             <li role="presentation" class="active"><a href="#"  data-target="#modalFillIn2" data-toggle="modal" id="btnFillSizeToggler2">Create New Training Agency</a></li>
         </ul>
      </div><div class="clearfix"></div>
  			<div class="card-title pull-left" style="font-size: 20px">List of Training Agencies</div><div class="clearfix"></div>
           <div class="row"><hr>
            <div id="policy_table"  style="background: #eee; padding: 10px">
              <div class="table-responsive">
              <table class="table tableWithExportOptions" id="transactions">
                <thead>
                  <tr>
                    <th>Entry Date</th>
                    <th>Agency</th>
                    <th>Contact Person</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tfoot class="thead">
                    <th>Entry Date</th>
                    <th>Agency</th>
                    <th>Contact Person</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th class="hide">Edit</th>
                    <th class="hide">view</th>
                    <th class="hide">Delete</th>
                </tfoot>
                <tbody>
                 @foreach($agencies as $agency)
                 <tr>
                    <td>{{ $agency->EntryDate }}</td>
                    <td>{{ $agency->Agency }}</td>
                    <td>{{ $agency->NameContactPerson }}</td>
                    <td>{{ $agency->Mobile }}</td>
                    <td>{{ $agency->Email }}</td>
                    <td><a href="#" class="btn btn-info" title="">Edit</a></td>
                    <td><a href="#" data-id="{{ $agency->AgencyRef }}" data-target="#modalFillIn3" data-toggle="modal" id="btnFillSizeToggler3" class="btn btn-success view" title="">View</a></td>
                    <td><a href="#" class="btn btn-danger" title="">Delete</a></td>
                  </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
          </div>
           </div>
  	</div>
  	<!-- END PANEL -->


<div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 1000px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000" id="title">New Training Agency</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                            {{ Form::open(['id'=>'training_agency', 'autocomplete' => 'off', 'role' => 'form']) }}
                              <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Agency Name' ) }}
                                               {{ Form::text('Agency', null, ['class' => 'form-control', 'id'=>'item', 'placeholder' => 'Add Agency Name', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                              <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Agency Contact Person' ) }}
                                               {{ Form::text('NameContactPerson', null, ['class' => 'form-control', 'id'=>'item', 'placeholder' => 'Contact person', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                              <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Agency Contact Person Mobile' ) }}
                                               {{ Form::text('Mobile', null, ['class' => 'form-control', 'id'=>'item', 'placeholder' => 'Contact Mobile Number', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                               <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Agency Phone Number' ) }}
                                               {{ Form::text('Phone', null, ['class' => 'form-control', 'id'=>'item', 'placeholder' => 'Company Phone Number', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                               <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Email' ) }}
                                               {{ Form::text('Email', null, ['class' => 'form-control', 'id'=>'item', 'placeholder' => 'Company Email Address', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                               <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('State' ) }}
                                               {{ Form::select('State', [ 0 =>  'Select Company State'] + $states->pluck('State', 'StateRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Company State", 'data-init-plugin' => "select2"]) }}
                                       </div>
                                  </div>
                              </div>


                               <div class="col-sm-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('Country' ) }}
                                               {{ Form::select('Country', [ 0 =>  'Select Company Country'] + $countries->pluck('Country', 'CountryRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Company Country", 'data-init-plugin' => "select2"]) }}
                                       </div>
                                  </div>
                              </div>

                              <div class="col-sm-8">
                                   <div class="form-group">
                                       <div class="controls">
                                           {{ Form::label('company Address' ) }}
                                               {{ Form::text('Address1', null, ['class' => 'form-control', 'id'=>'item', 'placeholder' => 'Company Address', 'required']) }}
                                       </div>
                                  </div>
                              </div>

                              <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-info pull-right" id="add_agency"  value="Add New Agency">
                                <input type="submit" class="btn btn-sm btn-success pull-right hide" id="edit_agency" data-dismiss="modal" value="Save Agency">
                                <input type="submit" class="btn btn-sm btn-danger pull-right hide" id="delete_agency" data-dismiss="modal" value="Delete Agency">
                              </div><p id="xyz" class="hide"></p>
                            {{ Form::close() }}
                            
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
                {{-- {{ csrf_field() }} --}}
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
        </div>
      </div>

      <div class="page-content-wrapper ">
<div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn3"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 800px; padding: 30px">
                <div class="modal-header">
                  <h5 class="text-left p-b-5"><span class="semi-bold" style="color: #000" id="title">View Training Agency</span></h5>
                </div>
                <div class="modal-body">
                  <div class="row">
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Agency</p>
                             <span id="agency_name"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Contact Person</p>
                             <span id="contact_person"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Mobile Number</p>
                             <span id="mobile"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Phone Number</p>
                             <span id="phone"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Email</p>
                             <span id="email"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">State</p>
                             <span id="state"></span>
                           </div>
                           <div class="col-md-4" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Country</p>
                             <span id="country"></span>
                           </div>
                           <div class="col-md-8" style="margin-bottom: 10px">
                            <p style="font-weight: bold; font-size: 15px">Address</p>
                             <span id="address"></span>
                           </div>
                  </div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
                {{-- {{ csrf_field() }} --}}
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
    
    $("#btnFillSizeToggler2").click(function(e){
        $('#title').text('New Training Agency.');
         $('#add_agency').removeClass('hide');
         $('#edit_agency').addClass('hide');
         $('#formy').removeClass('hide');
          $('#item_div').removeClass('hide');
    });

     $('#add_agency').click(function(event) {
        $.post('/post_training_agency', $('#training_agency').serialize(), function(data, status) {
        console.log(status);
     $('#policy_table').load(location.href + ' #policy_table');
      });
    });

     $('.view').click(function(event) {
       var id = $(this).data('id');
       $.get('/get_clicked_agency/'+id, function(data) {
         $('#agency_name').text(data.Agency);
         $('#contact_person').text(data.NameContactPerson);
         $('#mobile').text(data.Mobile);
         $('#phone').text(data.Phone);
         $('#email').text(data.Email);
         $('#state').text(data.State);
         $('#country').text(data.Country);
         $('#address').text(data.Address1);
         console.log(data);
       });
     });

  });
</script>


<script src="{{ asset('js/jquery.tabledit.js') }}"></script>
<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  // $('#transactions').editableTableWidget();
  // $(document).ready(function(){
     var settings = {
    "sDom": "<'exportOptions'T><'table-responsive't><'row'<p i>>",
    "sPaginationType": "bootstrap",
    "destroy": true,
    "scrollCollapse": true,
    "oLanguage": {
        "sLengthMenu": "_MENU_ ",
        "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
    },
     // "columnDefs": [
     //        {
     //            "targets": [ 3 ],
     //            "visible": false
     //        }
     //    ],
    "iDisplayLength": 20,
    "oTableTools": {
        "sSwfPath": "../assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
        "aButtons": [{
            "sExtends": "csv",
            "sButtonText": "<i class='pg-grid'></i>",
        }, {
            "sExtends": "xls",
            "sButtonText": "<i class='fa fa-file-excel-o'></i>",
        }, {
            "sExtends": "pdf",
            "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
        }, {
            "sExtends": "copy",
            "sButtonText": "<i class='fa fa-copy'></i>",
        }]
    },
    fnDrawCallback: function(oSettings) {
        $('.export-options-container').append($('.exportOptions'));
    }
};


var table = $('#transactions').DataTable(settings);
 $('#transactions tfoot th').each(function(key, val) {
            var title = $(this).text();
            if (key === $('#transactions tfoot th')) {
                return false
            }
            $(this).html('<input type="text" class="form-control" placeholder="' + $.trim(title) + '" />');
        });
 table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
  // });
</script>

@endpush


