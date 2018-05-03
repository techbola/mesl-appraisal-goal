@include('errors.list')
    <div class="row">
        <div class="col-sm-6">
             <div class="form-group">
            {{ Form::label('startdate', 'Start Date') }}
            <div class="input-group date dp">
                {{ Form::text('startdate', null, ['class' => 'form-control', 'placeholder' => 'Start Bill Date']) }}
                <span class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
                </span>
            </div>
        </div>
        </div>
        <div class="col-sm-6">
             <div class="form-group">
            {{ Form::label('enddate', 'End Date') }}
            <div class="input-group date dp">
                {{ Form::text('enddate', null, ['class' => 'form-control', 'placeholder' => 'End Bill Date']) }}
                <span class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
                </span>
            </div>
        </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <div class="controls pull-right">
                    <div class="m-t-25"></div>
					 {{ Form::submit( $buttonText, [ 'class' => 'btn btn-primary' ]) }}
                </div>
            </div>
        </div>
    </div>

     @push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>
<script>
    $(function(){
        var options = {
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        };
        $('.dp').datepicker({autoclose:true});
    })
</script>
@endpush