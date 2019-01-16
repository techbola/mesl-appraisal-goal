@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    @endpush
    @include('errors.list')
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('client_id', 'RESPONSIBLE UNIT') }}
                    <select class="remote-select full-width" name="client_id" id="client_id">
                        <option value="0">-- Select Unit--</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('location_id', 'LOCATION') }}
                    {{ Form::select('location_id',[ '' => 'Select Location'] + $locations->pluck('name','id')->toArray(),null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Location', 'required']) }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('allocation', 'REQUEST TYPE') }}
                    {{ Form::text('allocation', null, ['class' => 'form-control', 'placeholder' => 'e.g Reconnection, Power Supply, Installation etc...', 'required']) }}
                </div>
            </div>
        </div> 
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('complaints', 'Complaints') }}
                    {{ Form::textarea('complaints', null, ['class' => 'summernote form-control','rows' => 3, 'placeholder' => 'Purpose of this memo']) }}
                </div>
            </div>
        </div>
    </div>

    <!-- action buttons -->
    <div class="row">
        <div class="pull-right">
            {{ Form::submit( $buttonText, [ 'class' => 'btn btn-complete ' ]) }}
        </div>
    </div>
    @push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script>
        $(function(){
			$('.dp').datepicker();
            $('.remote-select').select2({
                allowClear: true,
                placeholder: "SELECT UNIT",
                ajax: { 
                    url: "/customer-list",
                    dataType: 'json',
                    delay: 100,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
		})
    </script>
    @endpush
</link>