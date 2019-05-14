<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('course_category_name', 'Course Category' ) }}
      {{ Form::text('course_category_name', null, ['class' => 'form-control', 'id'=>'course_input', 'placeholder' => 'Enter Course Category']) }}
        </div>
    </div>
</div>
<button class="btn btn-info btn-form pull-right" id="submit_course_category" type="submit">
    Add Course Category
</button>
<span class="hide" id="course_category_error" style="color:red">
    No Category to submit
</span>
