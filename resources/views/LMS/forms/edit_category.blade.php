<div class="row">
	<div style="padding: 20px">
		{{ Form::open(['id'=>'edit_course_category_form','autocomplete' => 'off', 'role' => 'form']) }}
                   <div class="row">
                   		<div class="col-md-12">
                            <div class="form-group">
                              {{ Form::label('course_category_name', 'Course Category' ) }}
                              {{ Form::text('course_category_name', null, ['class' => 'form-control', 'id'=>'course_category_name', 'placeholder' => 'Enter Course Category', 'required']) }}
                            </div>
                        </div>
                        <input type="hidden" name="course_category_ref" id="course_category_ref">
                         <button type="submit" onclick ="submit_edit_course_category()" class="btn btn-info btn-form pull-right" data-dismiss="modal">Add Course Category</button>
                   </div>            
        {{ Form::close() }}
	</div>
</div>
@push('scripts')
	<script>
       function edit_course_category(id)
         {
            $('#edit_title').html('Edit Course Category');
            $('#course_category_modal_div').removeClass('hide');
            $('#course_modal_div').addClass('hide');
            var ref = id;
            $.get('/get_category_edit_data/' +ref, function(data, status) {
            	if(status == 'success')
            	{
            		$('#course_category_name').val(data.course_category_name);
            	}
            	$('#course_category_ref').val(ref);
            });
         }


         function submit_edit_course_category()
         {
         	$.post('/submit_course_category_edit_form', $('#edit_course_category_form').serialize(), function(data, status) {
         		if(status =='success')
         		{

         			 $.get('/get_course_category_list', function(data, status) {
           if(status === 'success'){
            $('#category_body').html(' ');
            var id = 1;
              $.each(data, function(index, val) {
               $('#category_body').append(`
                <tr>
                  <td>${id++}</td>
                  <td>${val.course_category_name}</td>
                  <td>${val.last_name} ${val.first_name}</td>
                  <td><a href="#" onclick="edit_course_category(${val.course_category_ref})" data-target="#editmodal" data-toggle="modal" ><span style="color:blue">Edit</span></a></td>
                  <td><span style="color:red">Delete</span></td>
                </tr>
                `);
              });
            }
          });
         		 
         		    $("#edit_course_category_form")[0].reset();
         	    }
         	});
         	return false;
         }
	</script>
@endpush