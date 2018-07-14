<div class="row">
  <div class="col-md-12">
    <div class="form-group">
      {{ Form::label('course_category_name', 'Course Category' ) }}
      {{ Form::text('course_category_name', null, ['class' => 'form-control', 'id'=>'course_input', 'placeholder' => 'Enter Course Category', 'required']) }}
    </div>
  </div>
</div>
<button type="submit" id="submit_course_category" class="btn btn-info btn-form pull-right" data-dismiss="modal">Add Course Category</button>
