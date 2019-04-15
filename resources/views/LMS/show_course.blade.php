@extends('layouts.master')

@push('styles')
  <style>
.modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
    }
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
            <div class="col-md-12">
                <div class="sm-m-l-5 sm-m-r-5">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($courses->course_module as $course)
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                            <a class="collapsed" style="margin-bottom: -26px; margin-top: -16px" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{ $course->ModuleRef }}" aria-expanded="false" aria-controls="collapse_{{ $course->ModuleRef }}">
                              <h5 style="font-weight: 900 !important; color: #fb5201;">{{ $course->Module }}</h5>
                            </a>
                          </h4>
                      </div>
                      <div id="collapse_{{ $course->ModuleRef }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                          @foreach($course->course_material as $course_material)
                            <p style="font-weight: bold; font-size: 13px"><a href="#" class="material_id" title="" data-id ="{{ $course_material->course_material_ref }}">{{ $loop->index + 1 }}. {{ $course_material->material_name }}</a></p>
                          @endforeach

                          @if(count($course->module_question) > 0)
                            <span class="pull-right">
                              <a href="#" class="btn-success btn-sm btn" onclick="get_module_question({{ $course->ModuleRef }})" title="">Module Test</a>
                            </span>
                          @endif
                        </div><div class="clearfix"></div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
        </div><hr>

      {{--   <div>
          <h4 style="color: #fb5201; font-weight: 900 !important">Summary & Reviews</h4>
          <ul>
            <li>Summary</li>
            <li>Reviews</li>
          </ul>
        </div><hr> --}}

        <div>
          <h4 style="color: #fb5201; font-weight: 900 !important">Final Test</h4><hr>
          <p><a href="#" class="btn btn-warning btn-lg" id="examination_button">Start Test</a></p>
        </div><hr>

        <div class="hide" id="">
          <h4 style="color: #fb5201; font-weight: 900 !important">Test Score(s)</h4>
          <div>
            
          </div>
        </div>
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
            <div>
               <a href="#" class="btn btn-info btn-lg">Previous</a>&nbsp
              <a href="#" class="btn btn-success btn-lg pull-right" id="next_question">Next</a>
            </div><div class="clearfix"></div>
          {{ Form::close() }}
       </div>

       <!-- Module Exam Questions-->
       <div class="hide" id="module_examination_questions">
        {{ Form::open(['id'=>'module_test_form','autocomplete' => 'off', 'role' => 'form']) }}
            <div id="module_question_main" style="padding:40px">
            </div>
            <div>
              <button type="submit" class="btn btn-success btn-lg pull-right" id="module_next_question">Submit Module Test</button>
            </div><div class="clearfix"></div>
          {{ Form::close() }}
       </div>

       <!-- Review Test -->
       <div id="exam_review" class="hide">
         <h3 style="font-weight: 900 !important;"> Review your test result(s).</h3><hr>
         <div id="exam_review_questions">
           
         </div>
       </div>

       <!--Exam Result Page-->

       <div class="hide text-center" id="exam_completion" >
         <h2 style="font-weight: 900 !important">Test Result</h2><hr>
         <h2 style="color: green; font-weight: 900 !important">This is a complete result with all test executed</h2><br>
         <h3 style="font-weight: 900 !important" id="status">
           <span style="border-style: solid; border-width: 3px; padding: 15px" id="status_style">Test score 
             <span id="real_score"></span>% -  <span id="result_status"></span>
           </span>
         </h3><br><br>

         <div id="retake_test">
           <p><a href="#" class="btn btn-lg btn-warning" id="review_test">Review Test</a> &nbsp&nbsp <a href="#" class="btn btn-lg btn-primary" data-target="#retake_modal" data-toggle="modal" id="retake_new_test">Retake test</a></p>
         </div>
         {{-- <table class="table table-hover">
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
         </table> --}}<br><br>
       </div>
     </div>
   </div>
 </div>

 {{-- Delete Course Category div --}}

<div class="page-content-wrapper ">
     <div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="retake_modal"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">

                <div style="background: #fff; width: 400px; padding: 20px">
                  <p>Are you sure you want to retake this test ?</p>
                  <input type="hidden" id="delete_course_category_id">
                  <a href="#" class="btn-sm btn btn-danger pull-right" id="retake_cat" title="">Retake test</a>
                  <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
                </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- Modal -->
</div>

@endsection

@push('scripts')
 <script>
         $('.material_id').click(function(event) {
          $('#examination').addClass('hide');
          $('#exam_completion').addClass('hide');
          $('#exam_review').addClass('hide');
          $('#module_examination_questions').addClass('hide');
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
          $('#exam_review').addClass('hide');
          $('#module_examination_questions').addClass('hide');
          $('#examination_questions').addClass('hide');
          $('#examination').removeClass('hide');     
         });


          // Examination Section
          $('#proceed_to_exam').click(function(event) {
              var course_ref = $('#course_new_id').val();
              var batch_ref = $('#batch_id').val();
              $.get('/find_new_question/'+course_ref+'/'+batch_ref, function(data) {

                if(data.final == 1)
                {
                  $('#examination').addClass('hide');
                  $('#examination_questions').addClass('hide');
                  $('#show_material_info').addClass('hide');
                  $('#exam_review').addClass('hide');
                  $('#module_examination_questions').addClass('hide');
                  $('#exam_completion').removeClass('hide');

                    var pass_score = data.pass_mark;
                    var mark = data.final_score;
                         $('#real_score').html(data.final_score);

                         if(mark < pass_score){
                          $("#status_style").css("color", "red");
                          $('#result_status').html('Fail');
                          $("#status").css("color", "red");
                          $('#retake_test').removeClass('hide');
                         }else{
                          $("#status_style").css("color", "green");
                          $('#result_status').html('Pass');
                          $("#status").css("color", "green");
                          $('#retake_test').addClass('hide');
                         }
                }else{
                  $('#examination').addClass('hide');
                  $('#show_material_info').addClass('hide');
                  $('#exam_completion').addClass('hide');
                  $('#exam_review').addClass('hide');
                  $('#module_examination_questions').addClass('hide');
                  $('#examination_questions').removeClass('hide');

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
                        $('#exam_review').addClass('hide');
                        $('#module_examination_questions').addClass('hide');
                        $('#exam_completion').removeClass('hide');

                        var pass_score = data.pass_mark;
                    var mark = data.final_score;
                         $('#real_score').html(data.final_score);

                         if(mark < pass_score){
                          $("#status_style").css("color", "red");
                          $('#result_status').html('Fail');
                          $("#status").css("color", "red");
                          $('#retake_test').removeClass('hide');
                         }else{
                          $("#status_style").css("color", "green");
                          $('#result_status').html('Pass');
                          $("#status").css("color", "green");
                          $('#retake_test').addClass('hide');
                         }
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

          $('#review_test').click(function(event) {
            var course_ref = $('#course_new_id').val();
            var batch_ref = $('#batch_id').val();
            $('#show_material_info').addClass('hide');
            $('#exam_completion').addClass('hide');
            $('#examination_questions').addClass('hide');
            $('#examination').addClass('hide');
            $('#module_examination_questions').addClass('hide');
            $('#exam_review').removeClass('hide'); 
            $.get('/get_exam_review_questions/'+course_ref+'/'+batch_ref, function(data) {
              var id = 1;
              $('#exam_review_questions').html('');
              $.each(data, function(index, val) {
                if(val.Final_Answer == 'A')
                {
                  var ans = val.Answer_A;
                }else if(val.Final_Answer == 'B')
                {
                  var ans = val.Answer_B;
                }else if(val.Final_Answer == 'C')
                {
                  var ans = val.Answer_C;
                }else{
                  var ans = val.Answer_D;
                }
                $('#exam_review_questions').append(`
                    <p style="font-weight: 600">${val.Question}</p>
                    <p><span style="font-weight : 600; color:red"> Chosen answer : ${val.Answer}</span> &nbsp &nbsp &nbsp <span style="font-weight : 600; color:green">Correct Answer : ${val.Final_Answer}</span> &nbsp &nbsp &nbsp <span style="font-weight : 600; color:blue"> : ${ans}</span></p>
                    <h3>Explanation : </h3>
                    <p style="font-weight : 600; color:brown">${val.Explanation}</p>
                    <br><hr><br>
                  `);
              });
            });
            
          });


          $('#retake_cat').click(function(event) {
            
            var course_ref = $('#course_new_id').val();
            var batch_ref = $('#batch_id').val();
            $.get('/reset_exam_question/'+course_ref+'/'+batch_ref, function(data, status) {
              if(status == 'success'){
                $('#show_material_info').addClass('hide');
                $('#exam_completion').addClass('hide');
                $('#examination_questions').addClass('hide');
                $('#exam_review').addClass('hide'); 
                $('#module_examination_questions').addClass('hide');
                $('#examination').removeClass('hide');
              }
              $('#retake_modal').modal('toggle');
            });
          });

          function get_module_question(id)
          {
              var r = confirm("Do you want to take this module test ?");
              if (r == true) {
                  var ref = $('#course_new_id').val();
                      $('#show_material_info').addClass('hide');
                      $('#exam_completion').addClass('hide');
                      $('#examination_questions').addClass('hide');
                      $('#exam_review').addClass('hide'); 
                      $('#examination').addClass('hide');
                      $('#module_examination_questions').removeClass('hide');
                  $.get('/get_course_module_questions/'+id+"/"+ref, function(data) {
                    var id = 1;
                      $.each(data, function(index, val) {
                          $('#module_question_main').append(`
                            <span style="font-weight : 700"> Question :  ${id++}</span><br>
                            <p style="font-weight: 600">${val.Question}</p><br>

                            <span style="font-weight : 700"> Answer : </span><br>
                            <div class="radio radio-success">
                              <p>
                                <input type="radio" value="A" name="Answer[${index}]" id="A_${val.ModuleQuestionRef}">
                                <label for="A_${val.ModuleQuestionRef}">${val.Answer_A}</label>
                              </p>
                              <p>
                                <input type="radio" value="B" name="Answer[${index}]" id="B_${val.ModuleQuestionRef}">
                                <label for="B_${val.ModuleQuestionRef}">${val.Answer_B}</label>
                              </p>
                              <p>
                                <input type="radio" value="C" name="Answer[${index}]" id="C_${val.ModuleQuestionRef}">
                                <label for="C_${val.ModuleQuestionRef}">${val.Answer_C}</label>
                              </p>
                              <p>
                                <input type="radio" value="D" name="Answer[${index}]" id="D_${val.ModuleQuestionRef}">
                                <label for="D_${val.ModuleQuestionRef}">${val.Answer_D}</label>
                              </p>
                            </div>
                            <input type="hidden" value="${val.ModuleQuestionRef}" name="QuestionID[${index}]">
                            <hr>
                        `);
                      });
                  });
              }
          }

          $('#module_next_question').click(function(event) {
            event.preventDefault();
             var button = $('#module_next_question');
                    $.ajax({
                      url: '/post_module_examination/',
                      type: 'POST',
                      data: $('#module_test_form').serialize(),
                      beforeSend: function(){
                        button.attr('disabled', 'disabled');
                        button.html('<p><i style="font-size: 16px" class="fa fa-circle-o-notch fa-spin"></i> Processing next question and compiling result ...</p>');
                    }
                    })
                    .done(function(data, status) {
                     
                    })
                    .fail(function() {
                    })
                    .always(function() {
                       button.removeAttr('disabled');
                       button.text("Submit Module Test");
                       });
          });

          

        var progress_status = prog_count()
        $('.prog').change(function(e){
            progress_status = prog_count - 1
        });

        var checked_boxes = $('input:prog:checked').length;




 </script>
@endpush



