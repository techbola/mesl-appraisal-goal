@extends('layouts.master')

@section('content')
<div class="row" style="margin-top: 20px">
    <div class="col-md-3">
      <div class="card-box">
            <div class="row">
                <h3>Question Status</h3><hr>
                <div id="question_status">
                  @foreach($counter_status as $counter)
                    @if($counter->Status == 1)
                      <div class="col-md-2">
                        <button type="button" data-id="{{ $counter->ExamCollationRef }}" class="badge badge-success question_status_button">{{ $counter->SerialNumber }}</button>
                      </div>
                    @elseif($counter->Status == 0)
                        <div class="col-md-2">
                        <button type="button" data-id="{{ $counter->ExamCollationRef }}"  class="badge badge-warning question_status_button">{{ $counter->SerialNumber }}</button>
                      </div>
                    @endif
                  @endforeach
                </div>
            </div>
      </div>
    </div>

    <div class="col-md-9">
        <div class="row">
          <div class="card-box">
            <div id="final_exam_content">
            <h3>Questions for <span style="font-weight: 600">{{ $course_details->courses_name }}</span>.</h3><hr>
            {{ Form::open(['id' => 'submit_exam_form', 'autocomplete' => 'off', 'role' => 'form']) }}
              <input type="hidden" value="{{ $exam_question->CourseID }}" id="course_ref">
            <div id="question_body"> 
               <span style="font-weight : 800" class="text-success"> Question :  {{ $exam_question->SerialNumber }}</span><br>
                  <p style="font-weight: 600">{!! $exam_question->question->Question !!}</p><hr><br>

                  <span style="font-weight : 800" class="text-success"> Answer : </span><br>
                  <div class="radio radio-success">
                    <p>
                      <input type="radio" value="A" name="Answer" id="A_{{ $exam_question->ExamCollationRef }}">
                      <label for="A_{{ $exam_question->ExamCollationRef }}">{{ $exam_question->question->Answer_A }}</label>
                    </p>
                    <p>
                      <input type="radio" value="B" name="Answer" id="B_{{ $exam_question->ExamCollationRef }}">
                      <label for="B_{{ $exam_question->ExamCollationRef }}">{{ $exam_question->question->Answer_B }}</label>
                    </p>
                    <p>
                      <input type="radio" value="C" name="Answer" id="C_{{ $exam_question->ExamCollationRef }}">
                      <label for="C_{{ $exam_question->ExamCollationRef }}">{{ $exam_question->question->Answer_C }}</label>
                    </p>
                    <p>
                      <input type="radio" value="D" name="Answer" id="D_{{ $exam_question->ExamCollationRef }}">
                      <label for="D_{{ $exam_question->ExamCollationRef }}">{{ $exam_question->question->Answer_D }}</label>
                    </p>
                    <hr>
                    <input type="hidden" name="ExamCollationRef" value="{{ $exam_question->ExamCollationRef }}">
                    <div id="exam-controller">
                      @if($exam_question->SerialNumber - 1 >= 1 )
                       <a href="#" class="btn btn btn-rounded btn-default btn-outline m-r-5" id="previous" data-prev="{{ $exam_question->SerialNumber - 1}}"><i class="ti-arrow-left text-success m-r-5"></i>Previous</a>
                      @endif
                      @if( count($counter_status) >  ($exam_question->SerialNumber))
                        <a href="#" class="btn btn btn-rounded pull-right btn-default btn-outline m-r-5" id="next-question" data-next="{{ $exam_question->SerialNumber }}" ><i class="ti-arrow-right text-success m-r-5"></i>Next</a><div class="clearfix"></div>
                      @elseif(count($counter_status) ==  ($exam_question->SerialNumber))
                        <a href="#" class="btn btn btn-rounded pull-right btn-default btn-outline m-r-5" id="last_question" data-finish="{{ $exam_question->SerialNumber }}" ><i class="ti-arrow-right text-success m-r-5"></i>Complete Examination</a><div class="clearfix"></div>
                      @endif
                    </div>
                  </div>
            </div>
            {{ Form::close() }}
          </div>

          <!--Final Examination Result-->
          <div id="exam_result" class="hide">
          </div><div class="clearfix"></div>

        </div>
        </div>
    </div>
</div> 
@endsection

@push('scripts')
  <script>
    $('body').on('click', '#next-question', function(e) {
      e.preventDefault();
        var ref = $(this).data('next');
        var course_ref = $('#course_ref').val();
        var button = $('#next-question');
        $.ajax({
                      url: '/post_final_exam_result/'+ref+'/'+course_ref,
                      type: 'POST',
                      data: $('#submit_exam_form').serialize(),
                      beforeSend: function(){
                       button.attr('disabled', 'disabled');
                       button.html('<p><i class="fa fa-spinner fa-pulse"></i> Processing...</p>');
                    }
                    })
                    .done(function(data, status) {
                          // Append New Question Status
                          $('#question_status').html('');
                          $.each(data.counters, function(index, val) {
                            var dc;
                            if(val.Status == 1) 
                                {
                                   dc = `<div class="col-md-2">
                                            <button type="button" data-id="${val.ExamCollationRef}" class="badge badge-success question_status_button">${val.SerialNumber}</button>
                                          </div>
                                          `;
                                }else if(val.Status == 0){
                                  dc = `<div class="col-md-2">
                                            <button type="button" data-id="${val.ExamCollationRef}" class="badge badge-warning question_status_button">${val.SerialNumber}</button>
                                        </div>
                                  `;
                                }
                            $('#question_status').append(`
                               ${dc}
                            `);
                          });
                          // Appending New Question And Question Controller
                          var new_question_previous;
                          var new_question_next;

                          if((data.question.SerialNumber - 1) >= 1){
                            new_question_previous = `<a href="#" class="btn btn btn-rounded btn-default btn-outline m-r-5" id="previous" data-prev="${data.question.SerialNumber - 1}"><i class="ti-arrow-left text-success m-r-5"></i>Previous</a>
                            `;
                          }

                          if((data.counters.length) > (data.question.SerialNumber)){
                            new_question_next = `<a href="#" class="btn btn btn-rounded btn-default pull-right btn-outline m-r-5" id="next-question" data-next="${data.question.SerialNumber}"><i class="ti-arrow-right text-success m-r-5"></i>Next</a>
                            `;
                          }else if((data.counters.length) == (data.question.SerialNumber))
                          {
                             new_question_next = `<a href="#" class="btn btn btn-rounded pull-right btn-default btn-outline m-r-5" id="last_question" data-finish="${data.question.SerialNumber }" ><i class="ti-arrow-right text-success m-r-5"></i>Complete Examination</a><div class="clearfix"></div>
                             `;
                          }

                          // Append New Question
                          $('#question_body').html('');
                          $('#question_body').append(`
                              <span style="font-weight : 800" class="text-success"> Question :  ${data.question.SerialNumber}</span><br>
                              <p style="font-weight: 600">${data.question.question.Question}</p><hr><br>

                              <span style="font-weight : 800" class="text-success"> Answer : </span><br>
                              <div class="radio radio-success">
                                <p>
                                  <input type="radio" value="A" name="Answer" id="A_${data.question.ExamCollationRef}">
                                  <label for="A_${data.question.ExamCollationRef }">${data.question.question.Answer_A }</label>
                                </p>
                                <p>
                                  <input type="radio" value="B" name="Answer" id="B_${ data.question.ExamCollationRef}">
                                  <label for="B_${data.question.ExamCollationRef }">${data.question.question.Answer_B}</label>
                                </p>
                                <p>
                                  <input type="radio" value="C" name="Answer" id="C_${data.question.ExamCollationRef}">
                                  <label for="C_${data.question.ExamCollationRef}">${data.question.question.Answer_C}</label>
                                </p>
                                <p>
                                  <input type="radio" value="D" name="Answer" id="D_${data.question.ExamCollationRef}">
                                  <label for="D_${data.question.ExamCollationRef}">${data.question.question.Answer_D}</label>
                                </p>
                                <hr>
                                <input type="hidden" name="ExamCollationRef" value="${data.question.ExamCollationRef}">
                                <div id="exam-controller">
                                </div>
                            </div>
                          `);

                          $('#exam-controller').append(`
                              ${new_question_previous}
                              ${new_question_next}
                            `);
                    })
                    .fail(function(errors) {
                      alert('Error Encountered');
                    })
                    .always(function() {
                       button.removeAttr('disabled');
                       button.text("Next");
                       });
      });


$('body').on('click', '.question_status_button', function(e) {
        e.preventDefault();
        var ref = $(this).data('id');
        var course_ref = $('#course_ref').val();
        $.get('/get_status_questions/'+ref+'/'+course_ref, function(data) {
           // Appending New Question And Question Controller
            var new_question_previous;
            var new_question_next;

            if((data.question.SerialNumber - 1) >= 1){
              new_question_previous = `<a href="#" class="btn btn btn-rounded btn-default btn-outline m-r-5" id="previous" data-prev="${data.question.SerialNumber - 1}"><i class="ti-arrow-left text-success m-r-5"></i>Previous</a>
              `;
            }

            if((data.counters.length) > (data.question.SerialNumber)){
              new_question_next = `<a href="#" class="btn btn btn-rounded btn-default pull-right btn-outline m-r-5" id="next-question" data-next="${data.question.SerialNumber}"><i class="ti-arrow-right text-success m-r-5"></i>Next</a>
              `;
            }else if((data.counters.length) == (data.question.SerialNumber))
            {
               new_question_next = `<a href="#" class="btn btn btn-rounded pull-right btn-default btn-outline m-r-5" id="last_question" data-finish="${data.question.SerialNumber }" ><i class="ti-arrow-right text-success m-r-5"></i>Complete Examination</a><div class="clearfix"></div>
               `;
            }

          // Append New Question
          $('#question_body').html('');
                $('#question_body').append(`
                    <span style="font-weight : 800" class="text-success"> Question :  ${data.question.SerialNumber}</span><br>
                    <p style="font-weight: 600">${data.question.question.Question}</p><hr><br>

                    <span style="font-weight : 800" class="text-success"> Answer : </span><br>
                    <div class="radio radio-success">
                      <p>
                        <input type="radio" value="A" name="Answer" id="A_${data.question.ExamCollationRef}">
                        <label for="A_${data.question.ExamCollationRef }">${data.question.question.Answer_A }</label>
                      </p>
                      <p>
                        <input type="radio" value="B" name="Answer" id="B_${ data.question.ExamCollationRef}">
                        <label for="B_${data.question.ExamCollationRef }">${data.question.question.Answer_B}</label>
                      </p>
                      <p>
                        <input type="radio" value="C" name="Answer" id="C_${data.question.ExamCollationRef}">
                        <label for="C_${data.question.ExamCollationRef}">${data.question.question.Answer_C}</label>
                      </p>
                      <p>
                        <input type="radio" value="D" name="Answer" id="D_${data.question.ExamCollationRef}">
                        <label for="D_${data.question.ExamCollationRef}">${data.question.question.Answer_D}</label>
                      </p>
                      <hr>
                      <input type="hidden" name="ExamCollationRef" value="${data.question.ExamCollationRef}">
                      <div id="exam-controller">
                      </div>
          </div>
        `);

        $('#exam-controller').append(`
          ${new_question_previous}
          ${new_question_next}
        `);

        });
    });

    $('body').on('click', '#previous', function(e) {
        e.preventDefault();
        var ref = $(this).data('prev');
        var course_ref = $('#course_ref').val();
        $.get('/get_status_questions/'+ref+'/'+course_ref, function(data) {
           // Appending New Question And Question Controller
            var new_question_previous;
            var new_question_next;

            if((data.question.SerialNumber - 1) >= 1){
              new_question_previous = `<a href="#" class="btn btn btn-rounded btn-default btn-outline m-r-5" id="previous" data-prev="${data.question.SerialNumber - 1}"><i class="ti-arrow-left text-success m-r-5"></i>Previous</a>
              `;
            }

            if((data.counters.length) > (data.question.SerialNumber)){
              new_question_next = `<a href="#" class="btn btn btn-rounded btn-default pull-right btn-outline m-r-5" id="next-question" data-next="${data.question.SerialNumber}"><i class="ti-arrow-right text-success m-r-5"></i>Next</a>
              `;
            }else if((data.counters.length) == (data.question.SerialNumber))
            {
               new_question_next = `<a href="#" class="btn btn btn-rounded pull-right btn-default btn-outline m-r-5" id="last_question" data-finish="${data.question.SerialNumber }" ><i class="ti-arrow-right text-success m-r-5"></i>Complete Examination</a><div class="clearfix"></div>
               `;
            }

          // Append New Question
          $('#question_body').html('');
                $('#question_body').append(`
                    <span style="font-weight : 800" class="text-success"> Question :  ${data.question.SerialNumber}</span><br>
                    <p style="font-weight: 600">${data.question.question.Question}</p><hr><br>

                    <span style="font-weight : 800" class="text-success"> Answer : </span><br>
                    <div class="radio radio-success">
                      <p>
                        <input type="radio" value="A" name="Answer" id="A_${data.question.ExamCollationRef}">
                        <label for="A_${data.question.ExamCollationRef }">${data.question.question.Answer_A }</label>
                      </p>
                      <p>
                        <input type="radio" value="B" name="Answer" id="B_${ data.question.ExamCollationRef}">
                        <label for="B_${data.question.ExamCollationRef }">${data.question.question.Answer_B}</label>
                      </p>
                      <p>
                        <input type="radio" value="C" name="Answer" id="C_${data.question.ExamCollationRef}">
                        <label for="C_${data.question.ExamCollationRef}">${data.question.question.Answer_C}</label>
                      </p>
                      <p>
                        <input type="radio" value="D" name="Answer" id="D_${data.question.ExamCollationRef}">
                        <label for="D_${data.question.ExamCollationRef}">${data.question.question.Answer_D}</label>
                      </p>
                      <hr>
                      <input type="hidden" name="ExamCollationRef" value="${data.question.ExamCollationRef}">
                      <div id="exam-controller">
                      </div>
          </div>
        `);

        $('#exam-controller').append(`
          ${new_question_previous}
          ${new_question_next}
        `);

        });
    });

    // On click of finish button to process final result
    $('body').on('click', '#last_question', function(e) {
      e.preventDefault();
      var ref = $(this).data('finish');
      var course_ref = $('#course_ref').val();
        $.post('/submit_last_questions_answer/'+ref+'/'+course_ref,$('#submit_exam_form').serialize(), function(data, status) {
            if (status == 'success') 
            {
              // Append New Question Status
              $('#question_status').html('');
              $.each(data.counters, function(index, val) {
              var dc;
                if(val.Status == 1) 
                  {
                    dc = `<div class="col-md-2">
                          <button type="button" data-id="${val.ExamCollationRef}" class="badge badge-success question_status_button">${val.SerialNumber}</button>
                          </div>
                          `;
                  }else if(val.Status == 0){
                    dc = `<div class="col-md-2">
                          <button type="button" data-id="${val.ExamCollationRef}" class="badge badge-warning question_status_button">${val.SerialNumber}</button>
                          </div>
                          `;
                      }
                  // Append Result to div    
                  $('#question_status').append(`
                     ${dc}
                  `);
                });

                var new_question_previous;
                var new_question_next;
                // Confirm previous button
                if((data.question.SerialNumber - 1) >= 1){
                  new_question_previous = `<a href="#" class="btn btn btn-rounded btn-default btn-outline m-r-5" id="previous" data-prev="${data.question.SerialNumber - 1}"><i class="ti-arrow-left text-success m-r-5"></i>Previous</a>
                  `;
                }
                // confirm if button is next or finish
                if((data.counters.length) > (data.question.SerialNumber)){
                  new_question_next = `<a href="#" class="btn btn btn-rounded btn-default pull-right btn-outline m-r-5" id="next-question" data-next="${data.question.SerialNumber}"><i class="ti-arrow-right text-success m-r-5"></i>Next</a>
                  `;
                } else if((data.counters.length) == (data.question.SerialNumber))
                {
                   new_question_next = `<a href="#" class="btn btn btn-rounded pull-right btn-default btn-outline m-r-5" id="last_question" data-finish="${data.question.SerialNumber }" ><i class="ti-arrow-right text-success m-r-5"></i>Complete Examination</a><div class="clearfix"></div>
                   `;
                }

                // Append New Question
                $('#question_body').html('');
                  $('#question_body').append(`
                      <span style="font-weight : 800" class="text-success"> Question :  ${data.question.SerialNumber}</span><br>
                      <p style="font-weight: 600">${data.question.question.Question}</p><hr><br>

                      <span style="font-weight : 800" class="text-success"> Answer : </span><br>
                      <div class="radio radio-success">
                        <p>
                          <input type="radio" value="A" name="Answer" id="A_${data.question.ExamCollationRef}">
                          <label for="A_${data.question.ExamCollationRef }">${data.question.question.Answer_A }</label>
                        </p>
                        <p>
                          <input type="radio" value="B" name="Answer" id="B_${ data.question.ExamCollationRef}">
                          <label for="B_${data.question.ExamCollationRef }">${data.question.question.Answer_B}</label>
                        </p>
                        <p>
                          <input type="radio" value="C" name="Answer" id="C_${data.question.ExamCollationRef}">
                          <label for="C_${data.question.ExamCollationRef}">${data.question.question.Answer_C}</label>
                        </p>
                        <p>
                          <input type="radio" value="D" name="Answer" id="D_${data.question.ExamCollationRef}">
                          <label for="D_${data.question.ExamCollationRef}">${data.question.question.Answer_D}</label>
                        </p>
                        <hr>
                        <input type="hidden" name="ExamCollationRef" value="${data.question.ExamCollationRef}">
                        <div id="exam-controller">
                        </div>
                      </div>
                `);

                $('#exam-controller').append(`
                  ${new_question_previous}
                  ${new_question_next}
                `);

                swal({
                    title: "Thank You.",
                    text: "Proceed to result page by clicking on the proceed button below !",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#ff9800",
                    confirmButtonText: "Proceed",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.get('/show_final_result/'+course_ref, function(data, status) {
                          $('#final_exam_content').addClass('hide');
                          $('#exam_result').removeClass('hide');
                          var bar;
                          if(data.course.course_pass_mark <= data.result)
                          {
                            bar = `<div class="progress-bar progress-bar-success active progress-bar-striped" style="width: ${data.result}%;" role="progressbar">${data.result}%</div>
                            `;
                          }else{
                            bar = `<div class="progress-bar progress-bar-danger active progress-bar-striped" style="width: ${data.result}%;" role="progressbar">${data.result}%</div>
                            `;
                          }

                          $('#exam_result').html('');
                          if(status == 'success')
                          {
                            $('#exam_result').append(`

                              <div class="col-md-8 col-md-offset-2">
                                <h1>Examination Result</h1><hr>
                                <p style="font-size: 18px">Course : <span class="text-success">${data.course.courses_name}</span></p>
                                <p style="font-size: 18px">Pass Mark : <span class="text-success">${data.course.course_pass_mark}%</span></p>
                                <p style="font-size: 18px">Examination Score : 
                                  <span>
                                    <div class="progress progress-lg">
                                        ${bar}
                                    </div>
                                  </span>
                                </p><br><hr>
                                <div class="pull-right">
                                  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Confirm</button>
                                  <button type="submit" class="btn btn-warning waves-effect waves-light m-r-10">Retake Examination</button>
                                </div>
                              </div>

                              `);
                          }
                        });
                        swal("Success", "Click Ok to view Result", "success");
                    } else {
                            swal("Cancelled", "Why !!!, Please feel free to make an attempt)", "error");
                    }
                });
            }
          });
        });

  </script>
@endpush
