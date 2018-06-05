<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('Todo', 'Todo Item' ) }}
      {{-- <input type="text" class="form-control" name="Event" placeholder="Enter event title" required> --}}
      {{ Form::text('Todo', null, ['class' => 'form-control', 'placeholder' => 'Enter todo', 'required']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('DueDate', 'Due Date' ) }}
      <div class="input-group date dp">
        {{ Form::text('DueDate', date('Y-m-d'), ['class' => 'form-control', 'placeholder' => 'Due Date', 'required']) }}
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('UserID', 'Assign To') }}
      {{-- <span class="help">Leave empty to assign to yourself.</span> --}}
      {{ Form::select('UserID', [ '' =>  'Select Staff'] + $staffs->pluck('FullName', 'UserID')->toArray(), auth()->id(), ['class'=> "full-width", 'data-init-plugin' => "select2"]) }}
    </div>
  </div>


  {{-- <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('Description', 'Description' ) }}
      {{ Form::textarea('Description', null, ['class' => 'form-control', 'placeholder' => 'Enter todo description', 'rows' => '4']) }}
    </div>
  </div> --}}


</div>
<button type="submit" class="btn btn-info btn-form">Submit</button>
