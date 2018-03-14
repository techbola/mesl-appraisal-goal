@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    @endpush
@include('errors.list')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('Country', 'Country Name') }}
						{{ Form::text('Country', null, ['class' => 'form-control', 'placeholder' => 'Enter Posting Type']) }}
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

    @push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script>
        $(function(){
			$('.dp').datepicker();
		})
    </script>
    @endpush
</link>