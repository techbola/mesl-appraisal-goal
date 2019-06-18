@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    @endpush
@include('errors.list')
    <div class="row">
        <div class="col-sm-6">
                <div class="form-group">
                    <div class="controls">
                    {{ Form::label('Holiday', 'Holiday') }}
                    <div class="input-group date dp">
                     {{ Form::text('Holiday', null, ['class' => 'form-control', 'placeholder' => 'Holiday']) }}
                        <span class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </span>

                </div>
            </div>
                </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('HolidayName', 'Holiday Name') }}
                    {{ Form::text('HolidayName', null, ['class' => 'form-control', 'placeholder' => 'e.g EID KABIR']) }}
                </div>
            </div>
        </div>
    </div>

    <!-- action buttons -->
    <div class="row">
        <div class="pull-right">
                {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
				{{-- {{ Form::reset('reset fields',[ 'class' => 'btn btn-transparent ' ]) }} --}}
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script>
        $(function(){
            var options = {
                todayHighlight: true,
                autoclose: true,
                format: 'yyyy-mm-dd'
            };
			$('.dp').datepicker(options);
		})
    </script>
    @endpush
</link>