<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('courses_name', 'Course Name' ) }}
      {{ Form::text('courses_name', null, ['class' => 'form-control','id'=>'courses_name', 'placeholder' => 'Enter Course', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('course_duration', 'Course Duration' ) }}
      {{ Form::text('course_duration', null, ['class' => 'form-control','id'=>'course_duration', 'placeholder' => 'Enter Course Duration', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('course_fee', 'Course fee' ) }}
      {{ Form::text('course_fee', null, ['class' => 'form-control', 'id'=>'course_fee', 'placeholder' => 'Enter Course Fee', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('category_ref', 'Course Category' ) }}
            <select class="full-width" data-init-plugin="select2" id="category_ref" name="category_ref">
                <option value=" ">
                    Select Course
                </option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('final_question_limit', 'Question Limit' ) }}
      {{ Form::text('final_question_limit', null, ['class' => 'form-control','id'=>'question_limit', 'placeholder' => 'Input Question Limit', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('exam_duration', 'Examination Duration (in minutes)
            ' ) }}
      {{ Form::text('exam_duration', null, ['class' => 'form-control','id'=>'question_limit', 'placeholder' => 'Input Question Limit', 'required']) }}
        </div>
    </div>
    <div class="clearfix">
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('Module_No', 'Number of Course Module' ) }}
      {{ Form::number('Module_No', null, ['class' => 'form-control', 'id'=>'module_no', 'placeholder' => 'Enter Number of Course Module', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('course_pass_mark', 'Pass Mark (in percentage)' ) }}
      {{ Form::number('course_pass_mark', null, ['class' => 'form-control','id'=>'cover_page', 'placeholder' => 'Enter Pass mark', 'required']) }}
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
<button class="btn btn-info btn-form pull-right" data-dismiss="modal" id="submit_course" type="submit">
    Add New Course
</button>
