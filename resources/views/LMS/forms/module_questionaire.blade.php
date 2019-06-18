<div class="row">
	<div style="padding: 20px">
		<h3>Create New Question For <span id="module_questionaire_course_name" style="color: green; font-weight: 900"></span></h3><hr>

		{{ Form::open(['id'=>'module_questionaire_form','autocomplete' => 'off', 'role' => 'form']) }}

				 <div class="col-md-12">
				    <div class="form-group">
				      {{ Form::label('Module', 'Select Course Module' ) }}
				      <select name="ModuleID" id="module_question_selection" class="full-width" data-init-plugin="select2">
				      	<option value="">Select Course Module Option</option>

				      </select>
				    </div>
				  </div>

                  <div class="col-md-12">
				    <div class="form-group">
				      {{ Form::label('Question', 'Question' ) }}
				      {{ Form::textarea('Question', null, ['class' => 'summernote form-control','rows' => 3, 'id'=>'module_question', 'placeholder' => 'Be expressive']) }}
				    </div>
				  </div>

				  <div class="col-md-6">
				    <div class="form-group">
				      <input type="radio" value="A" name="Final_Answer" id="module_A">
				      <label for="A">Click if correct answer is A</label>
				      {{ Form::text('Answer_A', null, ['class' => 'form-control', 'id'=>'module_option_a', 'placeholder' => 'Question A']) }}
				    </div>
				  </div>

				  <div class="col-md-6">
				    <div class="form-group">
				      <input type="radio" value="B" name="Final_Answer" id="module_B">
				      <label for="B">Click if correct answer is B</label>
				      {{ Form::text('Answer_B', null, ['class' => 'form-control', 'id'=>'module_option_b', 'placeholder' => 'Question B']) }}
				    </div>
				  </div>

				  <div class="col-md-6">
				    <div class="form-group">
				      <input type="radio" value="C" name="Final_Answer" id="module_C">
				      <label for="C">Click if correct answer is C</label>
				      {{ Form::text('Answer_C', null, ['class' => 'form-control', 'id'=>'module_option_c', 'placeholder' => 'Question C']) }}
				    </div>
				  </div>

				  <div class="col-md-6">
				    <div class="form-group">
				      <input type="radio" value="D" name="Final_Answer" id="module_D">
				      <label for="D">Click if correct answer is D</label>
				      {{ Form::text('Answer_D', null, ['class' => 'form-control', 'id'=>'module_option_d', 'placeholder' => 'Question D']) }}
				    </div>
				  </div>

				  <div class="col-md-12">
				    <div class="form-group">
				      {{ Form::label('Explanation', 'Explanation' ) }}
				      {{ Form::textarea('Explanation', null, ['class' => 'summernote form-control','rows' => 3, 'id'=>'module_explanation', 'placeholder' => 'Be expressive']) }}
				    </div>
				  </div>

				  <input type="hidden" name="CourseID" id="module_questionaire_course_ref">

				  <div class="row">
					  <div class="pull-right">
					  		<button type="submit" class="btn btn-primary  btn-sm" id="submit_module_question">Submit</button>
					  </div>					  
				  </div><br>
				  <p style="font-weight: 600; color: red" class="hide" id="module_answer_notification">Please make sure module, answer, option or explanation field is well addressed</p>
				 {{--  <div style="background: #ccc; padding: 20px" id='question_limit' class="hide">
					  		<p style="font-weight: 600; color: green" class="pull-right"><span id="limit"></span> is required,  <span id="count_rem"></span> question are available for the course.</p><div class="clearfix"></div>
					  </div> --}}

        {{ Form::close() }}

	</div>
	
</div>

@push('scripts')
	<script>
		$('#submit_module_question').click(function(event) {
			event.preventDefault();
			var id = $('#module_questionaire_course_ref').val();
			var question = $('#module_question').val();
			var a = $('#module_option_a').val();
			var b = $('#module_option_b').val();
			var c = $('#module_option_c').val();
			var d = $('#module_option_d').val();
			var explanation = $('#module_explanation').val();
			var answer = $('#module_Final_Answer').val();
			var module = $('#module_question_selection').val();

			if(a === "" || b === "" || c === "" || d === "" || explanation === "" || answer === "" || module === "")
			{
				$('#module_answer_notification').removeClass('hide');
			}else{
				$('#module_answer_notification').addClass('hide');
				 var button = $('#submit_module_question');
                    $.ajax({
                      url: '/post_module_question_record',
                      type: 'POST',
                      data: $('#module_questionaire_form').serialize(),
                      beforeSend: function(){
                        button.attr('disabled', 'disabled');
                        button.html('<p><i style="font-size: 16px" class="fa fa-circle-o-notch fa-spin"></i> Saving Question...</p>');
                    }
                    })
                    .done(function(data, status) {
                    	
				        $('#module_questionaire_form')[0].reset();
				        $("#module_question_selection").select2().val("").trigger('change');
				        $('#module_question').summernote('reset');
				        $('#module_explanation').summernote('reset');

                    })
                    .fail(function() {
                     alert('Cannot submit question.')
                    })
                    .always(function() {
                       button.removeAttr('disabled');
                       button.text("Submit");
                       });
			}

		});
	</script>
@endpush