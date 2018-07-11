@push('styles')
@endpush

@include('errors.list')

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

    {{-- <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
              {{ Form::label('Upload Document') }}
              <input type="file" class="filestyle" name="Filename" data-placeholder="Upload Document" data-buttonname="btn-complete" data-buttonBefore="true">
            </div>
        </div>
    </div> --}}

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
    </div>

    <button type="submit" class="btn btn-info btn-form">Submit</button>



    @push('scripts')
      <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
      </script>
    @endpush
