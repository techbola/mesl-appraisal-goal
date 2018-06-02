@include('errors.list')
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="form-group form-group-default required">
                {{ Form::label('Department', 'Enter Department Name') }}
						{{ Form::text('Department', null, ['class' => 'form-control', 'placeholder' => 'Enter Department Name']) }}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-group-default required">
            <label>Company Name</label>
            {{ Form::select('CompanyID', [ 0 =>  'Choose Company Name'] + $companies->pluck('Company', 'CompanyRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Company Name", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-group-default required">
            <label>Subsidiary Name</label>
            {{ Form::select('SubsidiaryID', [ 0 =>  'Choose Subsidiary Name'] + $subsidiaries->pluck('Subsidiary', 'SubsidiaryRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Subsidiary Name", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-group-default required">
            <label>Division Name</label>
            {{ Form::select('DivisionID', [ 0 =>  'Choose Division Name'] + $divisions->pluck('Division', 'DivisionRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Division Name", 'data-init-plugin' => "select2"]) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-group-default required">
            <label>Group Name</label>
            {{ Form::select('GroupID', [ 0 =>  'Choose Group Name'] + $groups->pluck('GroupName', 'GroupRef')->toArray(),null, ['class'=> "full-width",'data-placeholder' => "Select Group Name", 'data-init-plugin' => "select2"]) }}
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
