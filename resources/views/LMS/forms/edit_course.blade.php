{{ Form::open(['id'=>'edit_course_form','autocomplete' => 'off', 'role' => 'form', 'files'=>'true']) }}
<div class="row">
    <div style="padding: 20px">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('courses_name', 'Course Name' ) }}
      {{ Form::text('courses_name', null, ['class' => 'form-control','id'=>'edit_courses_name', 'placeholder' => 'Enter Course', 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('course_duration', 'Course Duration' ) }}
      {{ Form::text('course_duration', null, ['class' => 'form-control','id'=>'edit_course_duration', 'placeholder' => 'Enter Course Duration', 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('course_fee', 'Course fee' ) }}
      {{ Form::text('course_fee', null, ['class' => 'form-control', 'id'=>'edit_course_fee', 'placeholder' => 'Enter Course Fee', 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('category_ref', 'Course Category' ) }}
                    <select class="full-width" data-init-plugin="select2" id="edit_category_ref" name="category_ref">
                        <option value=" ">
                            Select Course
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('cover_page', 'Upload Course Cover Page' ) }}
      {{ Form::file('cover_page', null, ['class' => 'form-control','id'=>'edit_cover_page', 'placeholder' => 'Upload Cover Page', 'required']) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('description', 'Short Description on Course' ) }}
      {{ Form::textarea('description', null, ['class' => 'form-control', 'id'=>'edit_description', 'rows'=>'3','placeholder' => 'Course Description', 'required']) }}
                </div>
            </div>
            <input id="edit_course_ref" name="course_ref" type="hidden">
                <button class="btn btn-info btn-form pull-right" data-dismiss="modal" id="submit_edit_course_form" type="submit">
                    Save
                </button>
            </input>
        </div>
        {{ Form::close() }}
    </div>
    @push('scripts')
    <script>
        $('#submit_edit_course_form').click(function(event) {
       var form = $('#edit_course_form')[0]; 
        var formData = new FormData(form);
        $.ajax({
                   url: '/submit_edit_course_form',
                   data: formData,
                   type: 'POST',
                   contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                   processData: false, // NEEDED, DON'T OMIT THIS
                   success: function (data, status) 
                   {
                    if(status === 'success')
                      $('#course_body').html(' ');
                     $.each(data, function(index, val) {
               $('#course_body').append(`
                <tr>
                                <td>${val.courses_name} <span style="color:blue; font-weight:bold; font-size:12px">${val.course_code}</span></td>
                                <td><a href="#" onclick="module_question(${val.course_ref})" data-target="module_questionaire" data-toggle="modal" class="btn-xs btn btn-primary"><span>Add Module Test</span></a></td>
                                <td><a href="#" onclick="new_question(${val.course_ref}, '${val.courses_name}')" data-target="#questionaire" data-toggle="modal" class="btn-xs btn btn-warning"><span>Add Final Test</span></a></td>
                                <td><a href="#" onclick="view_course_test(${val.course_ref})" data-target="#view_modal_course" data-toggle="modal" class="btn-xs btn btn-success"><span>View</span></a></td>
                                <td><a href="#" onclick="edit_course_test(${val.course_ref})" data-target="#edit_modal_course" data-toggle="modal" class="btn-xs btn btn-info"><span>Edit</span></a></td>
                                <td><a href="#" onclick="delete_course_test(${val.course_ref})" data-target="#delete_modal_course" data-toggle="modal" class="btn-xs btn btn-danger"><span>Delete</span></a></td>
                              </tr>
                `);
              });
                   }
        });
     });
    </script>
    @endpush
</div>