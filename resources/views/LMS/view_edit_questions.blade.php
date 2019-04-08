@extends('layouts.master')
@push('styles')
<style>
    .modal.fade.fill-in.in {
    background-color: rgba(107, 101, 101, 0.73);
    }

    thead tr {
      font-weight: bold;
      color: #000;
    }
</style>
@endpush
@section('content')
<div class="card-box">
    <div class="row">
        <div class="col-md-4">
            <div style="padding: 20px; background-color: #eee; margin-bottom: 10px">
                <h5 style="font-weight: 900 !important">
                    Courses Final Exam Questions
                </h5>
                <hr>
                    {{ Form::open(['id'=>'course_name_form','autocomplete' => 'off', 'role' => 'form']) }}
                    <select class="full-width" data-init-plugin="select2" id="courses_name">
                        <option value=" ">
                            Select Courses
                        </option>
                        @foreach($courses as $course)
                        <option value="{{ $course->course_ref }}">
                            {{ $course->courses_name }}
                        </option>
                        @endforeach
                    </select>
                    <div style="margin-top: 10px">
                        <button class="btn btn-primary btn-sm pull-right" id="submit_course_name" type="submit">
                            Submit
                        </button>
                        <div class="clearfix">
                        </div>
                    </div>
                    {{ Form::close() }}
                </hr>
            </div>
            <div style="padding: 20px; background-color: #eee">
                <h5 style="font-weight: 900 !important">
                    Courses Module Exam Questions
                </h5>
                <hr>
                    {{ Form::open(['id'=>'course_module_form','autocomplete' => 'off', 'role' => 'form']) }}
                    <div class="form-group">
                        <select class="full-width" data-init-plugin="select2" id="selected_course_name" onchange="module_course_name()">
                            <option value=" ">
                                Select Courses
                            </option>
                            @foreach($courses as $course)
                            <option value="{{ $course->course_ref }}">
                                {{ $course->courses_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="full-width" data-init-plugin="select2" id="course_module">
                            <option value=" ">
                                Select Course Module
                            </option>
                        </select>
                    </div>
                    <div style="margin-top: 10px">
                        <button class="btn btn-primary btn-sm pull-right" id="submit_course_module" type="submit">
                            Submit
                        </button>
                        <div class="clearfix">
                        </div>
                    </div>
                    {{ Form::close() }}
                </hr>
            </div>
        </div>
        <div class="col-md-8">
            <div style="padding: 20px; background-color: #eee">
                <div class="hide" id="course_div">
                </div>
                <div class="hide" id="module_div">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content-wrapper ">
    <div class="content ">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade fill-in" id="edit_modal_module" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                <i class="pg-close" style="color: #fff">
                </i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 800px; padding: 20px">
                        <div class="row">
                            <div style="padding: 20px">
                                <h3 id="course_title">
                                </h3>
                                <hr>
                                    {{ Form::open(['id'=>'edit_questionaire_form','autocomplete' => 'off', 'role' => 'form']) }}
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
                                    <input id="questionaire_course_ref" type="hidden">
                                        <input id="modal_type" type="hidden">
                                            <div class="row">
                                                <div class="pull-right">
                                                    <button class="btn btn-primary btn-sm" id="submit_edited_question" type="submit">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                            <br>
                                                <p class="hide" id="edit_answer_notification" style="font-weight: 600; color: red">
                                                    Please make sure all answer input and correct answer field are filled
                                                </p>
                                                {{ Form::close() }}
                                            </br>
                                        </input>
                                    </input>
                                </hr>
                            </div>
                        </div>
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
<div class="page-content-wrapper ">
    <div class="content ">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade fill-in" id="delete_modal_module" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                <i class="pg-close" style="color: #fff">
                </i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 400px; padding: 20px">
                        <div class="row">
                            <div style="padding: 20px">
                                <h3>
                                    Edit Course Module Question.
                                </h3>
                            </div>
                            <hr>
                                <input id="course_module_delete_ref" type="hidden">
                                    <p>
                                        Are you sure you want to delete these question ?
                                    </p>
                                    <button class="btn btn-sm btn-danger pull-right" id="delete_module_question" type="submit">
                                        Yes, Delete
                                    </button>
                                </input>
                            </hr>
                        </div>
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
    function module_course_name()
    {
        var ref = $('#selected_course_name').val();
        $.get('/get_course_module_for_edit/'+ref, function(data) {
            $('#course_module').html('');
            $('#course_module').html('<option value=" ">Select Course Module</option>');
            $.each(data, function(index, val) {
                 $('#course_module').append(`
                    <option value="${val.ModuleRef}">${val.Module}</option>
                    `);
            });
        });
    }

    $('#submit_course_module').click(function(event) {
        event.preventDefault();
        $('#course_div').addClass('hide');
        $('#module_div').removeClass('hide');
        var course_ref = $('#selected_course_name').val();
        var module_ref = $('#course_module').val();
        $.get('/search_course_module/'+course_ref+'/'+module_ref, function(data) {
            $('#module_div').html('');
            var id = 1;
            $.each(data, function(index, val) {
                $('#module_div').append(`
                        <div>
                            <p style="font-weight:900 !important">${id++}. ${val.Question} </p>
                            <span style="font-weight : bold; font-size:12px;">A. ${val.Answer_A}</span><br>
                            <span style="font-weight : bold; font-size:12px;">B. ${val.Answer_B}</span><br>
                            <span style="font-weight : bold; font-size:12px;">C. ${val.Answer_C}</span><br>
                            <span style="font-weight : bold; font-size:12px;">D. ${val.Answer_D}</span><br>
                            <p style="color:blue"> Correct Answer : ${val.Final_Answer}</p>
                            <p style="color:green"> Explanation : ${val.Explanation}</p><br>
                            <div class="pull-right">
                                <a href="#" class="btn btn-sm btn-success" onclick="module_edit(${val.ModuleQuestionRef})" data-target="#edit_modal_module" data-toggle="modal">Edit</a>  <a href="#" class="btn btn-sm btn-danger" onclick="module_delete(${val.ModuleQuestionRef})" data-target="#delete_modal_module" data-toggle="modal">Delete</a>
                            </div><div class="clearfix"></div>
                        </div><hr>
                    `);
            });
        });
    });

    function module_edit(id)
    {
        $.get('/get_module_question_by_id/'+id, function(data) {
            $("#edit_modal_module #question").summernote('code', data.Question);
            $('#option_a').val(data.Answer_A);
            $('#option_b').val(data.Answer_B);
            $('#option_c').val(data.Answer_C);
            $('#option_d').val(data.Answer_D);
            $('#questionaire_course_ref').val(id);
            $('#course_title').val('Edit Course Module Question');
            $('#modal_type').val('1');

            let answer_radio = $('[name=Final_Answer]');
            let answer_radio_value = answer_radio.val();
            if($('[name="Final_Answer"]').val() == data.Final_Answer){
                $('[name="Final_Answer"]').removeAttr('checked');
                $('[name="Final_Answer"]').prop('checked', 'checked');
                
            }
            $("#edit_modal_module #explanation").summernote('code', data.Explanation);
        });
    }

    $('#submit_edited_question').click(function(event) {
        event.preventDefault();
        var ref = $('#questionaire_course_ref').val();
        var modal_type = $('#modal_type').val();
        if(modal_type == 1)
        {
            alert(1);
        }
        // $.post('/post_editted_course_module/'+ref, $('#edit_questionaire_form').serialize(), function(data) {
        //     $('#module_div').html('');
        //     var id = 1;
        //     $.each(data, function(index, val) {
        //         $('#module_div').append(`
        //                 <div>
        //                     <p style="font-weight:900 !important">${id++}. ${val.Question} </p>
        //                     <span style="font-weight : bold; font-size:12px;">A. ${val.Answer_A}</span><br>
        //                     <span style="font-weight : bold; font-size:12px;">B. ${val.Answer_B}</span><br>
        //                     <span style="font-weight : bold; font-size:12px;">C. ${val.Answer_C}</span><br>
        //                     <span style="font-weight : bold; font-size:12px;">D. ${val.Answer_D}</span><br>
        //                     <p style="color:blue"> Correct Answer : ${val.Final_Answer}</p>
        //                     <p style="color:green"> Explanation : ${val.Explanation}</p><br>
        //                     <div class="pull-right">
        //                         <a href="#" class="btn btn-sm btn-success" onclick="module_edit(${val.ModuleQuestionRef})" data-target="#edit_modal_module" data-toggle="modal">Edit</a>  <a href="#" class="btn btn-sm btn-danger" onclick="module_delete(${val.ModuleQuestionRef})" data-target="#delete_modal_module" data-toggle="modal">Delete</a>
        //                     </div><div class="clearfix"></div>
        //                 </div><hr>
        //             `);
        //     });
        //     $('#edit_modal_module').modal('toggle');
        // });
    });

    function module_delete(id)
    {
        $('#course_module_delete_ref').val(id);
    }

    $('#delete_module_question').click(function(event) {
        event.preventDefault();
        var ref = $('#course_module_delete_ref').val();
        $.get('/delete_module_question/'+ref, function(data) {
            $('#module_div').html('');
            var id = 1;
            $.each(data, function(index, val) {
                $('#module_div').append(`
                        <div>
                            <p style="font-weight:900 !important">${id++}. ${val.Question} </p>
                            <span style="font-weight : bold; font-size:12px;">A. ${val.Answer_A}</span><br>
                            <span style="font-weight : bold; font-size:12px;">B. ${val.Answer_B}</span><br>
                            <span style="font-weight : bold; font-size:12px;">C. ${val.Answer_C}</span><br>
                            <span style="font-weight : bold; font-size:12px;">D. ${val.Answer_D}</span><br>
                            <p style="color:blue"> Correct Answer : ${val.Final_Answer}</p>
                            <p style="color:green"> Explanation : ${val.Explanation}</p><br>
                            <div class="pull-right">
                                <a href="#" class="btn btn-sm btn-success" onclick="module_edit(${val.ModuleQuestionRef})" data-target="#edit_modal_module" data-toggle="modal">Edit</a>  <a href="#" class="btn btn-sm btn-danger" onclick="module_delete(${val.ModuleQuestionRef})" data-target="#delete_modal_module" data-toggle="modal">Delete</a>
                            </div><div class="clearfix"></div>
                        </div><hr>
                    `);
            });
            $('#delete_modal_module').modal('toggle');
        });
    });

    $('#submit_course_name').click(function(event) {
        event.preventDefault();
        var ref = $('#courses_name').val();
        $('#module_div').addClass('hide');
        $('#course_div').removeClass('hide');
        $.get('/search_course_question/'+ref, function(data) {
             $('#course_div').html('');
            var id = 1;
            $.each(data, function(index, val) {
                $('#course_div').append(`
                        <div>
                            <p style="font-weight:900 !important">${id++}. ${val.Question} </p>
                            <span style="font-weight : bold; font-size:12px;">A. ${val.Answer_A}</span><br>
                            <span style="font-weight : bold; font-size:12px;">B. ${val.Answer_B}</span><br>
                            <span style="font-weight : bold; font-size:12px;">C. ${val.Answer_C}</span><br>
                            <span style="font-weight : bold; font-size:12px;">D. ${val.Answer_D}</span><br>
                            <p style="color:blue"> Correct Answer : ${val.Final_Answer}</p>
                            <p style="color:green"> Explanation : ${val.Explanation}</p><br>
                            <div class="pull-right">
                                <a href="#" class="btn btn-sm btn-success" onclick="course_edit(${val.QuestionRef})" data-target="#edit_modal_module" data-toggle="modal">Edit</a>  <a href="#" class="btn btn-sm btn-danger" onclick="course_delete(${val.QuestionRef})" data-target="#delete_modal_module" data-toggle="modal">Delete</a>
                            </div><div class="clearfix"></div>
                        </div><hr>
                    `);
            });
        });
    });

    function course_edit(id)
    {
        $.get('/get_editted_question/'+id, function(data) {
            $("#edit_modal_module #question").summernote('code', data.Question);
            $('#option_a').val(data.Answer_A);
            $('#option_b').val(data.Answer_B);
            $('#option_c').val(data.Answer_C);
            $('#option_d').val(data.Answer_D);
            $('#questionaire_course_ref').val(id);
            
            let answer_radio = $('[name=Final_Answer]');
            let answer_radio_value = answer_radio.val();
            if($('[name="Final_Answer"]').val() == data.Final_Answer){
               $('[name="Final_Answer"]').removeAttr('checked');
               $('[name="Final_Answer"]').prop('checked', 'checked');
                
            }
            $("#edit_modal_module #explanation").summernote('code', data.Explanation);
        });
    }
</script>
@endpush
