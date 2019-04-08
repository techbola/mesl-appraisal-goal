{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <div class="controls">
            <div class="form-group">
                {{ Form::label('PFA', 'PFA name' ) }}
                {{ Form::text('PFA', null, ['class' => 'form-control', 'placeholder' => 'Add PFA', 'required']) }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="pull-right">
        <button class="btn btn-info" type="submit">Submit</button>
    </div>
</div>