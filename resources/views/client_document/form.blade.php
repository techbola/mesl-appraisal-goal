@include('errors.list')
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('UploadDate', 'Upload Date') }}
                        {{ Form::text('UploadDate', \Carbon\Carbon::now(), ['class' => 'form-control','Readonly']) }}
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('PatientName', 'Patient Name') }}
                <p class="form-control text-primary">
                    {{ $client_details->Name }}
                </p>
            </div>
        </div>
    </div>

      <div class="col-sm-4">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('DocType_id', 'Document Type') }}
                        {{ Form::select('DocType_id', [ '' =>  'Select Document Typee'] + $doc_type->pluck('DocType', 'DocTypeRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Document Type", 'data-init-plugin' => "select2", 'required']) }}
            </div>
        </div>
    </div>
   
</div>

<div class="row">
     <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Description', 'Description') }}
                        {{ Form::textarea('Description', null, ['class' => 'form-control', 'rows' => '1']) }}
            </div>
        </div>
    </div>
    
      <div class="col-sm-6">
        <div class="form-group">
            <div class="controls">
                {{ Form::label('Filename', 'Choose Document') }}
                        {{ Form::file('Filename', null, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
</div>

    <input type="hidden" name="ClientID" value="{{ $client_details->ClientRef }}">
    <input type="hidden" name="Initiator" value="{{ Auth::user()->last_name}} {{ Auth::user()->first_name}}">
    <input type="hidden" name="StaffID" value="{{ Auth::user()->id}}">
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="controls">
                <div class="m-t-25">
                </div>
                {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete pull-right' ]) }}
            </div>
        </div>
    </div>
</div>