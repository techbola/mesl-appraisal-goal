<div class="modal fade" id="new_conv">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">Add New Conversation</h5>
      </div>
      <div class="modal-body">
        @include('errors.list')
        {!! Form::open(['route' => ['store_conversation', $contact->CustomerRef], 'role' => 'form']) !!}
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              {!! Form::label('Conversation') !!}
              {!! Form::textarea('Conversation', null, ['class'=>'form-control', 'placeholder'=>'Conversation', 'rows'=>'5']) !!}
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              {!! Form::label('AssignedStaff', 'Assign To') !!}
              {!! Form::select('AssignedStaff', [''=>'Select Staff'] + $staff->pluck('FullName', 'UserID')->toArray(), null, ['class'=>'full-width', 'data-init-plugin'=>'select2']) !!}
            </div>
          </div>

          <div class="col-md-5">
            {{ Form::label('VisitDate', 'Visit Date', ['class'=>'form-label']) }}
            <div class="input-group date dp">
              {{ Form::text('VisitDate', null, ['class' => 'form-control', 'placeholder' => 'Visit Date']) }}
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
        </div>
        <div class="text-right m-t-10">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_conv">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">Edit Conversation</h5>
      </div>
      <div class="modal-body">
        @include('errors.list')

      <form action="" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              {!! Form::label('Conversation') !!}
              {!! Form::textarea('Conversation', null, ['class'=>'form-control', 'placeholder'=>'Conversation', 'rows'=>'5']) !!}
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              {!! Form::label('AssignedStaff', 'Assign To') !!}
              {!! Form::select('AssignedStaff', [''=>'Select Staff'] + $staff->pluck('FullName', 'UserID')->toArray(), null, ['class'=>'full-width', 'data-init-plugin'=>'select2']) !!}
            </div>
          </div>

          <div class="col-md-5">
            {{ Form::label('VisitDate', 'Visit Date', ['class'=>'form-label']) }}
            <div class="input-group date dp">
              {{ Form::text('VisitDate', null, ['class' => 'form-control', 'placeholder' => 'Date']) }}
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
        </div>
        <div class="text-right m-t-10">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>


  <div class="modal fade" id="edit_contact">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h5 class="card-title">Edit Contact</h5>
        </div>
        <div class="modal-body">
          @include('errors.list')
          {!! Form::model($contact, ['route' => ['update_call_contact', $contact->CustomerRef], 'role' => 'form']) !!}
          <div class="row">
            <div class="col-md-6">
              <div class="">
                {!! Form::label('TitleID', 'Title', ['class'=>'form-label']) !!}
                {!! Form::select('TitleID', [''=>'Select Title']+$titles->pluck('Title', 'TitleRef')->toArray(), null, ['class'=>'full-width', 'data-init-plugin'=>'select2']) !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('Customer', 'Name') !!}
                {!! Form::text('Customer', null, ['class'=>'form-control', 'placeholder'=>'Enter Full Name']) !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('MobilePhone1', 'Mobile Phone') !!}
                {!! Form::text('MobilePhone1', null, ['class'=>'form-control', 'placeholder'=>'Mobile Phone 1']) !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                {!! Form::label('EstateID', 'Estate', ['class'=>'form-label']) !!}
                {!! Form::select('EstateID', [''=>'Select Estate']+$estates->pluck('ProjectName', 'BuildingProjectRef')->toArray(), null, ['class'=>'full-width', 'data-init-plugin'=>'select2']) !!}
              </div>
            </div>
            <div class="col-md-6">
              <div class="">
                {!! Form::label('HouseTypeID', 'House Type', ['class'=>'form-label']) !!}
                {!! Form::select('HouseTypeID', [''=>'Select House Type']+$housetypes->pluck('HouseType', 'HouseTypeRef')->toArray(), null, ['class'=>'full-width', 'data-init-plugin'=>'select2']) !!}
              </div>
            </div>
          </div>
          <div class="text-right m-t-10">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-info">Submit</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
