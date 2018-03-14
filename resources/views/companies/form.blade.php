@include('errors.list')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="form-group form-group-default required">
                    {{ Form::label('Company', 'Company Name') }}
						{{ Form::text('Company', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Name']) }}
                </div>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <div class="form-group form-group-default required">
                    {{ Form::label('LogoUrl', 'Company Logo') }}
                        {{ Form::file('LogoUrl', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
					 {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
                </div>
            </div>
        </div>
    </div>

 