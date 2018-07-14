<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('courses_name', 'Course Name' ) }}
      {{ Form::text('courses_name', null, ['class' => 'form-control','id'=>'courses_name', 'placeholder' => 'Enter Course', 'required']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('course_duration', 'Course Duration' ) }}
      {{ Form::text('course_duration', null, ['class' => 'form-control','id'=>'course_duration', 'placeholder' => 'Enter Course Duration', 'required']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('course_fee', 'Course fee' ) }}
      {{ Form::text('course_fee', null, ['class' => 'form-control', 'id'=>'course_fee', 'placeholder' => 'Enter Course Fee', 'required']) }}
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      {{ Form::label('category_ref', 'Course Category' ) }}
      <select name="category_ref" class="full-width" id="category_ref" data-init-plugin="select2">
      	<option value=" ">Select Course</option>
      	@foreach($categories as $category)
      		<option value="{{ $category->course_category_ref }}">{{ $category->course_category_name }}</option>
      	@endforeach
      </select>
       
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-group">
      {{ Form::label('cover_page', 'Upload Course Cover Page' ) }}
      {{ Form::file('cover_page', null, ['class' => 'form-control','id'=>'cover_page', 'placeholder' => 'Upload Cover Page', 'required']) }}
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('description', 'Short Description on Course' ) }}
      {{ Form::textarea('description', null, ['class' => 'form-control', 'id'=>'description', 'rows'=>'3','placeholder' => 'Course Description', 'required']) }}
    </div>
  </div>

</div>
<button type="submit" id="submit_course" class="btn btn-info btn-form pull-right" data-dismiss="modal">Add New Course</button>
