{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="controls">
            <div class="form-group">
                {{ Form::label('HMOPlan', 'HMO Plan' ) }}
                {{ Form::text('HMOPlan', null, ['class' => 'form-control', 'placeholder' => 'Enter HMO Plan', 'required']) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="pull-right">
        <button class="btn btn-info" type="submit">Submit</button>
    </div>
</div>