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
                        <input type="file" class="filestyle" name="Filename[]" data-placeholder="Upload Document" data-buttonname="btn-complete" data-buttonBefore="true" multiple>
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
    </div>

    <button style="margin-left: 7px" type="button" class="btn btn-info btn-md" data-dismiss="modal" aria-hidden="true">Done</button>



    @push('scripts')
      <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
      </script>
    @endpush
