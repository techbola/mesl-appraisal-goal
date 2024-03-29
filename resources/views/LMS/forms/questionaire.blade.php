<div class="row">
    <div style="padding: 20px">
        <h3>
            Create New Question For
            <span id="questionaire_course_name" style="color: green; font-weight: 900">
            </span>
        </h3>
        <hr>
            {{ Form::open(['id'=>'questionaire_form','autocomplete' => 'off', 'role' => 'form']) }}
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Question', 'Question' ) }}
				      {{ Form::textarea('Question', null, ['class' => 'summernote form-control','rows' => 3, 'id'=>'question', 'placeholder' => 'Be expressive']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input id="A" name="Final_Answer" type="radio" value="A">
                        <label for="A">
                            Click if correct answer is A
                        </label>
                        {{ Form::text('Answer_A', null, ['class' => 'form-control', 'id'=>'option_a', 'placeholder' => 'Question A']) }}
                    </input>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input id="B" name="Final_Answer" type="radio" value="B">
                        <label for="B">
                            Click if correct answer is B
                        </label>
                        {{ Form::text('Answer_B', null, ['class' => 'form-control', 'id'=>'option_b', 'placeholder' => 'Question B']) }}
                    </input>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input id="C" name="Final_Answer" type="radio" value="C">
                        <label for="C">
                            Click if correct answer is C
                        </label>
                        {{ Form::text('Answer_C', null, ['class' => 'form-control', 'id'=>'option_c', 'placeholder' => 'Question C']) }}
                    </input>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input id="D" name="Final_Answer" type="radio" value="D">
                        <label for="D">
                            Click if correct answer is D
                        </label>
                        {{ Form::text('Answer_D', null, ['class' => 'form-control', 'id'=>'option_d', 'placeholder' => 'Question D']) }}
                    </input>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('Explanation', 'Explanation' ) }}
				      {{ Form::textarea('Explanation', null, ['class' => 'summernote form-control','rows' => 3, 'id'=>'explanation', 'placeholder' => 'Be expressive']) }}
                </div>
            </div>
            <input id="questionaire_course_ref" name="CourseID" type="hidden">
                <div class="row">
                    <div class="pull-right">
                        <button class="btn btn-primary btn-sm" id="submit_question" type="submit">
                            Submit
                        </button>
                    </div>
                </div>
                <br>
                    <p class="hide" id="answer_notification" style="font-weight: 600; color: red">
                        Please make sure all answer input and correct answer field are filled
                    </p>
                    <div class="hide" id="question_limit" style="background: #ccc; padding: 20px">
                        <p class="pull-right" style="font-weight: 600; color: green">
                            <span id="limit">
                            </span>
                            is required,
                            <span id="count_rem">
                            </span>
                            question are available for the course.
                        </p>
                        <div class="clearfix">
                        </div>
                    </div>
                    {{ Form::close() }}
                </br>
            </input>
        </hr>
    </div>
</div>
@push('scripts')
<script>
    $('#submit_question').click(function(event) {
			event.preventDefault();
			var id = $('#questionaire_course_ref').val();
			var question = $('#question').val();
			var a = $('#option_a').val();
			var b = $('#option_b').val();
			var c = $('#option_c').val();
			var d = $('#option_d').val();
			var explanation = $('#explanation').val();
			var answer = $('#Final_Answer').val();

			if(a === "" || b === "" || c === "" || d === "" || explanation === "" || answer === "")
			{
				$('#answer_notification').removeClass('hide');
			}else{
				$('#answer_notification').addClass('hide');
				 var button = $('#submit_question');
                    $.ajax({
                      url: '/post_submit_record',
                      type: 'POST',
                      data: $('#questionaire_form').serialize(),
                      beforeSend: function(){
                        button.attr('disabled', 'disabled');
                        button.html('<p><i style="font-size: 16px" class="fa fa-circle-o-notch fa-spin"></i> Saving Question...</p>');
                    }
                    })
                    .done(function(data, status) {
                     	$.get('/get_question_limit/'+id, function(data) {
				          $('#question_limit').removeClass('hide');
				          var count = data.question_count;
				          var limit = data.limit;
				          $('#limit').html(limit); 
				          $('#count_rem').html(count);
				        });
				        $('#questionaire_form')[0].reset();
				        $('#question').summernote('reset');
				        $('#explanation').summernote('reset');

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
