@push('styles')
@endpush

@include('errors.list')


    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          {{ Form::label('DocCategoryID', 'Document Category ') }}
          {{ Form::select('DocCategoryID', [ '' =>  'Document Category'] + $doc_cat_types->pluck('DocCategory','DocCategoryRef')->toArray(), 2, ['class' => 'full-width', 'data-init-plugin' => 'select2', 'data-placeholder' => 'Choose Document Category']) }}
        </div>
      </div>

      <div class="col-sm-6 hide report-date-wrapper">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('ReportDate', 'Reports\'s Date') }}
                <div class="input-group date dp">
                    {{ Form::text('ReportDate', null, ['class' => 'form-control', 'placeholder' => 'Report Date']) }}
                    <span class="input-group-addon">
                        <i class="fa fa-calendar">
                        </i>
                    </span>
                </div>
            </div>
        </div>
    </div>

      <div class="clearfix"></div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
              {{ Form::label('DocTypeID', 'Document Type ') }}
              {{ Form::select('DocTypeID', [ '' =>  'Document Type'] + $doctypes->pluck('DocType','DocTypeRef')->toArray(), null, ['class' => 'full-width', 'data-init-plugin' => 'select2', 'data-placeholder' => 'Choose Document Type']) }}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label('DocName', 'Document Name ') }}
                {{ Form::text('DocName', null, ['class' => 'form-control', 'placeholder' => 'Enter Document Name']) }}
            </div>
        </div>
    </div>

    <div class="row">
      {{-- Customers shouldn't use this (Also adjusted col-md of next column) --}}
      {{-- @if (!$user->hasRole('customer'))
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('StaffID', 'Staff Name ') }}
        {{ Form::select('StaffID', [ '' =>  'Select Staff'] + $staff->pluck('StaffName','StaffRef')->toArray(), null, ['class' => 'full-width', 'data-init-plugin' => 'select2', 'data-placeholder' => 'Select Staff']) }}
                </div>
            </div>
        </div>
      @endif --}}

        {{-- <div class="{{ (!$user->hasRole('customer'))? 'col-sm-6' : 'col-sm-12' }}"> --}}
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Upload Document') }}
                        {{-- {{ Form::file('Filename', null, ['class' => 'form-control', 'placeholder' => 'Upload Document']) }} --}}
                        {{-- {{ Form::file('Filename', null, ['class' => 'filestyle', 'placeholder' => 'Upload Document', 'data-buttonname' => 'btn-primary']) }} --}}
                        <input type="file" class="filestyle" name="Filename" data-placeholder="Upload Document" data-buttonname="btn-complete" data-buttonBefore="true">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
              {{ Form::label('Description', 'Document Description ') }}
              {{ Form::textarea('Description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description', 'rows'=>'3']) }}
            </div>
        </div>
    </div>

    <div class="row">
        {{-- <div class="col-sm-12">
            <div class="form-group">
              {{ Form::label('Roles', 'Assign To') }}
              {{ Form::select('Roles[]', [ 'all' =>  'Everyone'] + $roles->pluck('name','id')->toArray(), null, ['class' => 'full-width', 'data-init-plugin' => 'select2', 'data-placeholder' => 'Choose Document Type', 'multiple']) }}
            </div>
        </div> --}}
        <div class="col-sm-12">
            <div class="form-group">
              {{ Form::label('Staff', 'Assign Staff') }}
              {{ Form::select('Staff[]', [ 'all' =>  'Everyone'] + $staff->pluck('FullName','StaffRef')->toArray(), null, ['class' => 'full-width', 'data-init-plugin' => 'select2', 'data-placeholder' => 'Assign Staff', 'multiple']) }}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
              {{ Form::label('Departments', 'Assign Departments') }}
              {{ Form::select('Departments[]', $departments->pluck('Department','DepartmentRef')->toArray(), null, ['class' => 'full-width', 'data-init-plugin' => 'select2', 'data-placeholder' => 'Assign Department', 'multiple']) }}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
              {{ Form::label('ApproverID', 'Approver') }}
              {{ Form::select('ApproverID', [ '' =>  'Select Approver'] + $staff->pluck('FullName','UserID')->toArray(), null, ['class' => 'full-width', 'data-init-plugin' => 'select2', 'data-placeholder' => 'Choose Approver', 'required']) }}
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-info btn-form">Submit</button>



    @push('scripts')
      <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
      </script>


      <script>
        $(function(){
          let mds_data = {!! json_encode($mds_data) !!};
          let others_data = {!! json_encode($others_data) !!};
          $('#DocCategoryID').change(function(e) {
            e.preventDefault();
            let selected = $(this).val();
            let report_date_wrapper = $('.report-date-wrapper');
            // management report was selected
            if(selected == 1) {
              // show report date 
              report_date_wrapper.removeClass('hide');
              //  Reload content of Document Type based on the selected category
              $("#DocTypeID").empty();
              $("#DocTypeID").select2({
                data: mds_data
              });
            } else {
              report_date_wrapper.addClass('hide');
              $('#ReportDate').val(''); // reseted report date
              $("#DocTypeID").empty();
              $("#DocTypeID").select2({
                data: others_data
              });
            }
          });
        });
      </script>


    @endpush
