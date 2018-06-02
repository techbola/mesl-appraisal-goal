@include('errors.list')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Gender', 'Gender Name') }}
						{{ Form::text('Gender', null, ['class' => 'form-control', 'placeholder' => 'Enter Gender Name']) }}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    <div class="m-t-25"></div>
					 {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
                </div>
            </div>
        </div>
    </div>

 