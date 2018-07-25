<div class="row">
  {{-- <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('Customer', 'Name') !!}
      {!! Form::text('Customer', null, ['class'=>'form-control', 'placeholder'=>'Enter Full Name']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('Position') !!}
      {!! Form::text('Position', null, ['class'=>'form-control', 'placeholder'=>'Position']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('Department') !!}
      {!! Form::text('Department', null, ['class'=>'form-control', 'placeholder'=>'Department']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('Organization') !!}
      {!! Form::text('Organization', null, ['class'=>'form-control', 'placeholder'=>'Organization']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('Address') !!}
      {!! Form::textarea('Address', null, ['class'=>'form-control', 'placeholder'=>'Address', 'rows'=>'2']) !!}
    </div>
  </div>


</div>
<div class="row">

  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('MobilePhone1', 'Mobile Phone 1') !!}
      {!! Form::text('MobilePhone1', null, ['class'=>'form-control', 'placeholder'=>'Mobile Phone 1']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('MobilePhone2', 'Mobile Phone 2') !!}
      {!! Form::text('MobilePhone2', null, ['class'=>'form-control', 'placeholder'=>'Mobile Phone 2']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('OfficePhone1', 'Office Phone 1') !!}
      {!! Form::text('OfficePhone1', null, ['class'=>'form-control', 'placeholder'=>'Office Phone 1']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('OfficePhone2', 'Office Phone 2') !!}
      {!! Form::text('OfficePhone2', null, ['class'=>'form-control', 'placeholder'=>'Office Phone 2']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('DirectLine') !!}
      {!! Form::text('DirectLine', null, ['class'=>'form-control', 'placeholder'=>'Direct Line']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('Fax') !!}
      {!! Form::text('Fax', null, ['class'=>'form-control', 'placeholder'=>'Fax']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('OfficeEmail') !!}
      {!! Form::email('OfficeEmail', null, ['class'=>'form-control', 'placeholder'=>'Office Email']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('PersonalEmail') !!}
      {!! Form::email('PersonalEmail', null, ['class'=>'form-control', 'placeholder'=>'Personal Email']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('Skype') !!}
      {!! Form::text('Skype', null, ['class'=>'form-control', 'placeholder'=>'Skype']) !!}
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      {!! Form::label('Website') !!}
      {!! Form::text('Website', null, ['class'=>'form-control', 'placeholder'=>'Website']) !!}
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      {!! Form::label('Others') !!}
      {!! Form::textarea('Others', null, ['class'=>'form-control', 'placeholder'=>'Others', 'rows'=>'2']) !!}
    </div>
  </div> --}}

<div id="contact-box" class="m-b-10">
  <div class="pull-right pointer">
    <a onclick="new_contact()">+ Add New Contact</a>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      {!! Form::label('ContactID', 'Contact') !!}
      {!! Form::select('ContactID', [''=>'Select Contact']+$contacts_all->pluck('Customer', 'CustomerRef')->toArray(), null, ['class'=>'full-width', 'data-init-plugin'=>'select2']) !!}
    </div>
  </div>
</div>

<div class="col-md-12">
  <div class="form-group">
    {!! Form::label('Conversation') !!}
    {!! Form::textarea('Conversation', null, ['class'=>'form-control', 'placeholder'=>'Conversation', 'rows'=>'5']) !!}
  </div>
</div>

<div class="col-md-5">
  {{ Form::label('Date', 'Date', ['class'=>'form-label']) }}
  <div class="input-group date dp">
    {{ Form::text('Date', null, ['class' => 'form-control', 'placeholder' => 'Date']) }}
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
  </div>
</div>
<div class="col-md-3">
  <label for=""></label>
  <div class="checkbox check-success">
    <input type="checkbox" name="SiteVisit" id="SiteVisit">
    <label for="SiteVisit">Site Visit</label>
  </div>
</div>
<div class="col-md-4">
  <label for=""></label>
  <div class="checkbox check-success">
    <input type="checkbox" name="VisitCompleted" id="VisitCompleted">
    <label for="VisitCompleted">Visit Completed</label>
  </div>
</div>

{{-- <button id="btn" type="button" class="btn btn-default" onclick="new_contact()">
  Switch
</button> --}}

  {{-- <div class="checkbox">
    <input type="checkbox" name="accept" id="checkbox2">
    {{ Form::checkbox('AccountFlag') }}
    <label for="AccountFlag">Account Flag</label>
  </div> --}}

</div>
