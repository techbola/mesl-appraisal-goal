@extends('layouts.master')

@push('styles')
  <style>

  </style>
@endpush

@section('title')
  Course Activities
@endsection

@section('page-title')
  Course Activities
@endsection

@section('buttons')

@endsection


@section('content')

 <div class="row">
   <div class="col-md-4">
    <input type="hidden" value="{{ $course_details->course_ref }}" id="course_new_id">
    <input type="hidden" value="{{ $id }}" id="batch_id">
     <div class="card-box" style="padding: 20px">
      <div class="text-center">
        <img src="{{ asset('storage/course_images/'.$course_details->cover_page)}}" alt="logo" width="200" height="200">
        <h3 style="font-weight: bold">{{ $course_details->courses_name }}</h3><hr>
      </div>
       <div>
          <h4 style="color: #fb5201; font-weight: 900 !important">Introduction</h4>
          <p>{{ $course_details->description }}</p>
        </div><hr>

        <div>
          <h4 style="color: #fb5201; font-weight: 900 !important">Course Tutorials</h4>
          <ul style="list-style: none !important">
            @foreach($course_materials as $course_material)
            <li>
                <div class="form-check">
                    <input class="form-check-input prog" type="checkbox" value="" name="checkbox" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1" name="checkbox">
                        <a class="material_id" href="#"  data-id ="{{ $course_material->course_material_ref }}" title="">{{ $course_material->material_name }}</a>
                    </label>
                </div>
            </li>
            @endforeach
          </ul>
        </div><hr>

        <div>
          <h4 style="color: #fb5201; font-weight: 900 !important">Summary & Reviews</h4>
          <ul>
            <li>Summary</li>
            <li>Reviews</li>
          </ul>
        </div><hr>

        <div>
          <h4 style="color: #fb5201; font-weight: 900 !important">Questions</h4>
          <p><a href="#" class="btn btn-warning btn-lg" id="examination_button">Start Test</a></p>
        </div><hr>
     </div>
   </div>

   <div class="col-md-8">
     <div class="card-box" style="padding: 20px">

       <!--Course Material View div -->
       <div id='show_material_info' class="hide">
       </div>

       <!--Examination View div -->
       <div id='examination' class="hide">
          <div class="row" style="padding: 20px">
              <h5 style="font-weight: 900 !important">Examination Instructions</h5><hr>
                <p><span style="font-weight: 900 !important">Step 1.</span><br> <span style="font-weight: bold;">Do Not Use the "Back" Button on Your Browser During the Test once you have begun taking the quiz. Instead, use the scroll bar to move back to check earlier questions. Don't close the window of the test for any reason.</span></p>

                <p><span style="font-weight: 900 !important">Step 2.</span><br> <span style="font-weight: bold;">Review All of Your Answers Before Submitting the Quiz. Make sure you have not accidentally changed your response to a question or made a typographic mistake.</span></p>

                <div class="pull-right">
                  <a href="#" class="btn btn-warning btn-lg" id="proceed_to_exam">Proceed to Test</a>
                </div><div class="clearfix"></div>
          </div>
       </div>

       <!-- Exam Questions-->
       <div class="hide" id="examination_questions">
        {{ Form::open(['id'=>'test_form','autocomplete' => 'off', 'role' => 'form']) }}
            <div id="question_main">
            </div>
            <div class="pull-right"> 
              <a href="#" class="btn btn-success btn-lg" id="next_question">Next</a>
            </div><div class="clearfix"></div>
          {{ Form::close() }}
       </div>

       <div class="hide" id="exam_completion">
         <h3 style="font-weight: 900 !important">Test Result</h3><hr>
         <table class="table table-hover">
           <thead>
             <tr>
               <th>S/N</th>
               <th>Choosen Answer</th>
               <th>Correct Answer</th>
             </tr>
           </thead>
           <tbody id="test_result_body">
           </tbody>
           <tfoot id="test_foot">
           </tfoot>
         </table>
       </div>
     </div>
   </div>
 </div>

@endsection

@push('scripts')
 <script>
         $('.material_id').click(function(event) {
          $('#examination').addClass('hide');
          $('#exam_completion').addClass('hide');
          $('#examination_questions').addClass('hide');
          $('#show_material_info').removeClass('hide');
           var id = $(this).data('id');
           $.get('/course_material_with_id/' +id, function(data, status) {
                if(status === 'success' ){
                  if(data.material_type == 1)
                  {
                    $('#show_material_info').html(' ');
                    $('#show_material_info').append(`
                        <iframe src = "{{ asset('/assets/plugins/ViewerJS/#/storage/Course_Docs/') }}/${data.document_link}" width="100%" height="700" allowfullscreen webkitallowfullscreen></iframe>
                      `)
                  } else if(data.material_type == 2)
                  {
                    $('#show_material_info').html(' ');
                    $('#show_material_info').append(`
                       <iframe width="100%" height="315" src="${data.video_link}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                      `)
                  }else if(data.material_type == 3)
                  {
                    $('#show_material_info').html(' ');
                    $('#show_material_info').append(`
                       <iframe style="width : 100%" height="400" src="${data.youtube_link}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                      `)
                    }else if(data.material_type == 4)
                  {
                    $('#show_material_info').html(' ');
                    $('#show_material_info').append(`
                          <audio controls="controls" id="audio-player" style="width : 100%" height="400" >
                              <source src= "{{ asset('/storage/course_audio') }}/${data.audio_link}" type="audio/mpeg">
                          </audio>

                      `)
                  }
                }
              });
         });

         // Exaination Instruction div
         $('#examination_button').click(function(event) {
          $('#show_material_info').addClass('hide');
          $('#exam_completion').addClass('hide');
          $('#examination_questions').addClass('hide');
          $('#examination').removeClass('hide');     
         });


          // Examination Section
          $('#proceed_to_exam').click(function(event) {
              var course_ref = $('#course_new_id').val();
              var batch_ref = $('#batch_id').val();
              $('#show_material_info').addClass('hide');
              $('#exam_completion').addClass('hide');
                $('#examination').addClass('hide'); 
                $('#examination_questions').removeClass('hide');
                $('#question_main').html('');
              $.get('/find_new_question/'+course_ref+'/'+batch_ref, function(data) {
                var total_done = data.total.length;
                $('#question_main').append(`

                  <h5 style="font-weight: 900 !important; color = grren;">Examination Questions ${total_done + 1} / ${data.limit}</h5><div class="clearfix"></div><hr>
            <span style="font-weight : 700"> Question : </span><br>
            <p style="font-weight: 600">${data.question.Question}</p><br>

            <span style="font-weight : 700"> Answer : </span><br>
            <div class="radio radio-success">
              <p>
                <input type="radio" value="A" name="Answer" id="A">
                <label for="A">${data.question.Answer_A}</label>
              </p>
              <p>
                <input type="radio" value="B" name="Answer" id="B">
                <label for="B">${data.question.Answer_B}</label>
              </p>
              <p>
                <input type="radio" value="C" name="Answer" id="C">
                <label for="C">${data.question.Answer_C}</label>
              </p>
              <p>
                <input type="radio" value="D" name="Answer" id="D">
                <label for="D">${data.question.Answer_D}</label>
              </p>
            </div>
            <input type="hidden" name="QuestionID" id="answered_question_id" value="${data.question.QuestionRef}">
            <span style="color:red; font-size 11px; font-weight: 600" class="hide" id="answer_notification">Please select the correct answer from the option provided.</span>

                  `);
              });
          });

          $('#next_question').click(function(event) {
            event.preventDefault();
            var batch = $('#batch_id').val();
            var question_id = $('#answered_question_id').val();
            var answer = $('input[name=Answer]:checked').val();
            var course_ref = $('#course_new_id').val();
            
            if(batch === "" || question_id === "" || !answer)
            {
              $('#answer_notification').removeClass('hide');
            }else{
              $('#answer_notification').addClass('hide');
              var button = $('#next_question');
                    $.ajax({
                      url: '/process_examination_question/'+batch+'/'+course_ref,
                      type: 'POST',
                      data: $('#test_form').serialize(),
                      beforeSend: function(){
                        button.attr('disabled', 'disabled');
                        button.html('<p><i style="font-size: 16px" class="fa fa-circle-o-notch fa-spin"></i> Processing next question and compiling result ...</p>');
                    }
                    })
                    .done(function(data, status) {
                      $('#question_main').html('');
                      if(data.final == 1)
                      {
                        $('#examination').addClass('hide');
                        $('#exam_completion').addClass('hide');
                        $('#examination_questions').addClass('hide');
                        $('#show_material_info').addClass('hide');
                        $('#exam_completion').removeClass('hide');

                        $.get('/get_final_test_result/'+batch+'/'+course_ref, function(data) {
                          var id = 1;
                          $('#test_result_body').html('');
                          $.each(data.result, function(index, val) {
                            $('#test_result_body').append(`
                              <tr>
                                  <td>${id++}</td>
                                  <td>${val.Answer}</td>
                                  <td>${val.Final_Answer}</td>
                              </tr>
                              `);
                          });

                          $('#test_foot').html('');
                          $('#test_foot').append(`
                              <tr>
                                  <td></td>
                                  <td><span style="color : green; font-weight: 900">Passed : ${data.passed}</span></td>
                                  <td><span style="color : red; font-weight: 900">Failed : ${data.failed}</span></td>
                              </tr>
                            `);
                        });
                      }else{
                        var total_done = data.total.length;
                          $('#question_main').append(`
                            <h5 style="font-weight: 900 !important; color = grren;">Examination Questions ${total_done + 1} / ${data.limit}</h5><div class="clearfix"></div><hr>
                      <span style="font-weight : 700"> Question : </span><br>
                      <p style="font-weight: 600">${data.question.Question}</p><br>

                      <span style="font-weight : 700"> Answer : </span><br>
                      <div class="radio radio-success">
                        <p>
                          <input type="radio" value="A" name="Answer" id="A">
                          <label for="A">${data.question.Answer_A}</label>
                        </p>
                        <p>
                          <input type="radio" value="B" name="Answer" id="B">
                          <label for="B">${data.question.Answer_B}</label>
                        </p>
                        <p>
                          <input type="radio" value="C" name="Answer" id="C">
                          <label for="C">${data.question.Answer_C}</label>
                        </p>
                        <p>
                          <input type="radio" value="D" name="Answer" id="D">
                          <label for="D">${data.question.Answer_D}</label>
                        </p>
                      </div>
                      <input type="hidden" name="QuestionID" id="answered_question_id" value="${data.question.QuestionRef}">
                      <span style="color:red; font-size 11px; font-weight: 600" class="hide" id="answer_notification">Please select the correct answer from the option provided.</span>

                            `);
                      }

                    })
                    .fail(function() {
                    })
                    .always(function() {
                       button.removeAttr('disabled');
                       button.text("Submit");
                       });
            }

          });



        var progress_status = prog_count()
        $('.prog').change(function(e){
            progress_status = prog_count - 1
        });

        var checked_boxes = $('input:prog:checked').length;




 </script>
@endpush



