@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/datepicker3.css') }}" media="screen" rel="stylesheet" type="text/css">
    @endpush
    @include('errors.list')
    
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('complaint_category_id', 'Complaints Category') }}
                    {{ Form::select('complaint_category_id',[ '' => 'Select Complaint Category'] + $categories->pluck('name','id')->toArray(),null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select category', 'required']) }}
                </div>
            </div>
        </div> 

        <div class="col-sm-6">
            <div class="form-group">
                <div class="controls">
                    {{ Form::label('recipient_id', 'Recipients') }}
                    {{ Form::select('recipient_id',[ '' => 'Select Recipient'] + $employees->pluck('FullName','StaffRef')->toArray(),null, ['class' => 'full-width','data-init-plugin' => "select2", 'data-placeholder' => 'Select Recipeint', 'required']) }}
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