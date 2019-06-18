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
<div class="panel panel-transparent">
    <div class="panel-heading">
        <div class="panel-title">
            <h3 style="font-weight: bold;">
                Course Dashboard
            </h3>
        </div>
    </div>
    {{-- Course Categori Menu --}}
    <div class="panel-body">
        <div class="row">
            <div class="pull-right">
                <a class="btn btn-lg btn-warning" data-target="#modalFillIn2" data-toggle="modal" href="#" id="new_course_category">
                    Add New Course Category
                </a>
                <a class="btn btn-lg btn-info" data-target="#modalFillIn2" data-toggle="modal" href="#" id="new_course">
                    Add New Course
                </a>
                <a class="btn btn-lg btn-success" data-target="#modalFillIn2" data-toggle="modal" href="#" id="new_Instructor">
                    Add New Instructor
                </a>
                <a class="btn btn-lg btn-primary" data-target="#modalFillIn2" data-toggle="modal" href="#" id="new_batch">
                    Add New Batch
                </a>
            </div>
        </div>
        <div class="clearfix">
        </div>
        <br>
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                                    <img alt="" class="icon" src="{{ asset('assets/img/icons/backend.png') }}" style="filter: brightness(0.92);" width="60px">
                                    </img>
                                </div>
                                <div class="inline">
                                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">
                                        Categories
                                    </div>
                                    <h3 class="no-margin p-b-5 text-info bold" id="course_category_count" style="padding: 0px 0px 0px 20px;">
                                        {{ $course_count }}
                                    </h3>
                                    <span>
                                        <a class="label label-inverse pull-right btn-rounded text-capitalize pull-right" href="#" id="show_category_table">
                                            See all
                                            <i class="fa fa-arrow-right m-l-5">
                                            </i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                                    <img alt="" class="icon" src="{{ asset('assets/img/icons/languages.png') }}" style="filter: brightness(0.92);" width="60px">
                                    </img>
                                </div>
                                <div class="inline">
                                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">
                                        Course
                                    </div>
                                    <h3 class="no-margin p-b-5 text-info bold" id="course_count" style="padding: 0px 0px 0px 20px;">
                                        {{ $course }}
                                    </h3>
                                    <span>
                                        <a class="label label-inverse pull-right btn-rounded text-capitalize pull-right" href="#" id="show_course_table">
                                            See all
                                            <i class="fa fa-arrow-right m-l-5">
                                            </i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                                    <img alt="" class="icon" src="{{ asset('assets/img/icons/presentation.png') }}" style="filter: brightness(0.92);" width="60px">
                                    </img>
                                </div>
                                <div class="inline">
                                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">
                                        Instructors
                                    </div>
                                    <h3 class="no-margin p-b-5 text-info bold" id="instructor_count" style="padding: 0px 0px 0px 20px;">
                                        {{ $instructor_count }}
                                    </h3>
                                    <span>
                                        <a class="label label-inverse pull-right btn-rounded text-capitalize pull-right" href="#" id="show_instructor_table">
                                            See all
                                            <i class="fa fa-arrow-right m-l-5">
                                            </i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                                    <img alt="" class="icon" src="{{ asset('assets/img/icons/students.png') }}" style="filter: brightness(0.92);" width="60px">
                                    </img>
                                </div>
                                <div class="inline">
                                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">
                                        Batches
                                    </div>
                                    <h3 class="no-margin p-b-5 text-info bold" id="batch_count" style="padding: 0px 0px 0px 20px;">
                                        {{ $batch_counter }}
                                    </h3>
                                    <span>
                                        <a class="label label-inverse pull-right btn-rounded text-capitalize pull-right" href="#" id="show_batch_table">
                                            See all
                                            <i class="fa fa-arrow-right m-l-5">
                                            </i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" style="overflow-y: scroll;max-height: 500px">
                    <div class="row">
                        <div class="card-box" id="table_container">
                            <div id="intro">
                                <iframe allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0" height="450" src="https://www.youtube.com/embed/zv5bpfxJ2xE" width="900">
                                </iframe>
                            </div>
                            <div class="hide" id="category_table">
                                <table class="table-hover table">
                                    <thead>
                                        <th>
                                            S/N
                                        </th>
                                        <th>
                                            Course Category
                                        </th>
                                        <th>
                                            Created By
                                        </th>
                                        <th colspan="2">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody id="category_body">
                                    </tbody>
                                </table>
                            </div>
                            <div class="hide" id="course_table">
                                <div class="pull-right">
                                    <a class="btn btn-sm btn-success" href="{{ Route('ViewEditQuestion') }}">
                                        View / Edit all Module & Final Test Questions
                                    </a>
                                    <a class="btn btn-sm btn-info" data-target="#modalFillIn3" data-toggle="modal" href="#" id="activate_material_modal">
                                        Add Course Material
                                    </a>
                                </div>
                                <table class="table-hover table">
                                    <thead>
                                        <th>
                                            Course Name
                                        </th>
                                        <th>
                                            Course Code
                                        </th>
                                        <th colspan="2">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody id="course_body">
                                    </tbody>
                                </table>
                            </div>
                            <div class="hide" id="instructor_table">
                                <table class="table-hover table">
                                    <thead>
                                        <th>
                                            S/N
                                        </th>
                                        <th>
                                            Instructor Name
                                        </th>
                                        <th>
                                            Phone
                                        </th>
                                        <th colspan="2">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody id="instructor_body">
                                    </tbody>
                                </table>
                            </div>
                            <div class="hide" id="batch_table">
                                <table class="table-hover table">
                                    <thead>
                                        <th>
                                            S/N
                                        </th>
                                        <th>
                                            Batch Code
                                        </th>
                                        <th>
                                            Course
                                        </th>
                                        <th colspan="2">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody id="batch_body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </br>
    </div>
</div>
{{-- Edit Course Category --}}
<div class="page-content-wrapper ">
    <div class="content ">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade fill-in" id="editmodalcategory" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                <i class="pg-close" style="color: #fff">
                </i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 600px; padding: 20px">
                        <h5 style="font-weight: bold;">
                            Edit Course Category Details
                        </h5>
                        <hr>
                            <input class="form-control" id="category_name_edit" name="course_category_name" type="text">
                                <input id="edit_course_category_id" type="hidden">
                                    <br>
                                        <a class="btn-sm btn btn-success pull-right" href="#" id="category_edit_button" title="">
                                            Save
                                        </a>
                                        <div class="clearfix">
                                        </div>
                                    </br>
                                </input>
                            </input>
                        </hr>
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
<!-- View Courses -->
<div class="page-content-wrapper ">
    <div class="content ">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade fill-in" id="view_modal_course" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                <i class="pg-close" style="color: #fff">
                </i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 800px; padding: 20px">
                        @include('LMS.forms.view_course')
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
<!-- Edit Courses -->
<div class="page-content-wrapper ">
    <div class="content ">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade fill-in" id="edit_modal_course" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                <i class="pg-close" style="color: #fff">
                </i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 800px; padding: 20px">
                        @include('LMS.forms.edit_course')
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
<!-- Questionaire Modal -->
<div class="page-content-wrapper ">
    <div class="content ">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade fill-in" id="questionaire" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                <i class="pg-close" style="color: #fff">
                </i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 800px; padding: 20px">
                        <input id="questionaire_course_id" type="hidden">
                            @include('LMS.forms.questionaire')
                        </input>
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

<!--Delete Course -->
<div class="page-content-wrapper ">
    <div class="content ">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade fill-in" id="delete_modal_course" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"><i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 500px; padding: 20px">
                        <h5 style="font-weight: bold !important">
                            Delete Course.
                        </h5>
                        <hr>
                            Are you sure you want to delete these course ?
                            <input id="delete_course_id" type="hidden">
                                <span>
                                    <a class="btn btn-danger btn-xs pull-right" href="#" id="delete_course_button" title="">
                                        Delete
                                    </a>
                                </span>
                                <div class="clearfix">
                                </div>
                            </input>
                        </hr>
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


<!--Delete Course Category -->
<div class="page-content-wrapper ">
    <div class="content ">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade fill-in" id="delete_course_category" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                <i class="pg-close" style="color: #fff">
                </i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 800px; padding: 20px">
                        <h5 style="font-weight: bold !important">
                            Delete Course category.
                        </h5>
                        <hr>
                            Are you sure you want to delete these course category ?
                            <input id="delete_course_category_ref" type="hidden">
                                <span>
                                    <a class="btn btn-danger btn-xs pull-right" href="#" id="delete_cat" title="">
                                        Delete
                                    </a>
                                </span>
                                <div class="clearfix">
                                </div>
                            </input>
                        </hr>
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
<!--Module Questionaire Modal -->
<div class="page-content-wrapper ">
    <div class="content ">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade fill-in" id="module_questionaire" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                <i class="pg-close" style="color: #fff">
                </i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 800px; padding: 20px">
                        @include('LMS.forms.module_questionaire')
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
        <div aria-hidden="true" class="modal fade fill-in" id="modalFillIn2" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                <i class="pg-close" style="color: #fff">
                </i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 800px; padding: 15px">
                        <div class="modal-header">
                            <h5 class="text-left semi-bold" id="title">
                            </h5>
                        </div>
                        <hr>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="hide" id="category_form">
                                        {{ Form::open(['id'=>'course_category','autocomplete' => 'off', 'role' => 'form']) }}
                               @include('LMS.forms.add_course_category')
                        {{ Form::close() }}
                                    </div>
                                    <div class="hide" id="course_form">
                                        {{ Form::open(['id'=>'course','autocomplete' => 'off', 'role' => 'form', 'files'=>'true']) }}
                               @include('LMS.forms.add_course')
                      {{ Form::close() }}
                                    </div>
                                    <div class="hide" id="instructor_form">
                                        {{ Form::open(['id'=>'instructor','autocomplete' => 'off', 'role' => 'form']) }}
                               @include('LMS.forms.add_instructor')
                      {{ Form::close() }}
                                    </div>
                                    <div class="hide" id="batch_form">
                                        {{ Form::open(['id'=>'batch','autocomplete' => 'off', 'role' => 'form']) }}
                               @include('LMS.forms.add_batch')
                      {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </hr>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Modal -->
    </div>
</div>
<div class="page-content-wrapper ">
    <div class="content ">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade fill-in" id="modalFillIn3" role="dialog" style="display: none;">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                <i class="pg-close" style="color: #fff">
                </i>
            </button>
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div style="background: #fff; width: 850px; padding: 15px">
                        <div class="modal-header">
                            <h5 class="text-left semi-bold">
                                Add Material(s)
                            </h5>
                        </div>
                        <hr>
                            <div class="modal-body">
                                <div class="row">
                                    {{ Form::open(['id'=>'submit_course_material_form','autocomplete' => 'off', 'role' => 'form', 'files'=>'true']) }}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('course_id', 'Select Course' ) }}
                                            <select class="full-width" data-init-plugin="select2" id="material_course" name="course_id" onchange="mat()">
                                                <option value=" ">
                                                    Select Course
                                                </option>
                                                @foreach($course_names as $course_name)
                                                <option value="{{ $course_name->course_ref }}">
                                                    {{ $course_name->courses_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('ModuleID', 'Select Course Module' ) }}
                                            <select class="full-width" data-init-plugin="select2" id="course_module" name="module_id">
                                                <option value=" ">
                                                    Select Course
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('material_type', 'Course Material Type' ) }}
                                            <select class="full-width" data-init-plugin="select2" id="material_type" name="material_type" onchange="material()">
                                                <option value=" ">
                                                    Select Course
                                                </option>
                                                <option value="1">
                                                    Document
                                                </option>
                                                <option value="2">
                                                    Video
                                                </option>
                                                <option value="3">
                                                    Youtube
                                                </option>
                                                <option value="4">
                                                    Audio
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 hide" id="material_title">
                                        <div class="form-group">
                                            {{ Form::label('material_name', 'Title of Material' ) }}
                           {{ Form::text('material_name', null, ['class' => 'form-control', 'placeholder' => 'Type Material Title', 'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-12 hide" id="video">
                                        <div class="form-group">
                                            {{ Form::label('video_link', 'Upload Course Video' ) }}
                           {{ Form::file('video_link', null, ['class' => 'form-control','id'=>'video_link', 'placeholder' => 'Upload Cover Page', 'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-12 hide" id="document">
                                        <div class="form-group">
                                            {{ Form::label('document_link', 'Upload Course Document' ) }}
                           {{ Form::file('document_link', null, ['class' => 'form-control','id'=>'document_link', 'placeholder' => 'Upload Cover Page', 'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-12 hide" id="youtube">
                                        <div class="form-group">
                                            {{ Form::label('youtube_link', 'Paste Youtube Link' ) }}
                           {{ Form::text('youtube_link', null, ['class' => 'form-control','id'=>'youtube_link', 'placeholder' => 'Paste Youtube Link', 'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-12 hide" id="audio">
                                        <div class="form-group">
                                            {{ Form::label('audio_link', 'Upload Audio file' ) }}
                          {{ Form::file('audio_link', null, ['class' => 'form-control','id'=>'audio_link', 'placeholder' => 'upload cover page', 'required']) }}
                                        </div>
                                    </div>
                                    <button class="btn btn-info btn-form pull-right hide" id="submit_material" type="submit">
                                        Add New Course Material
                                    </button>
                                    {{ Form::close() }}
                                    <div class="hide" id="material_table">
                                        <hr>
                                            <br>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <th>
                                                            S/N
                                                        </th>
                                                        <th>
                                                            Material Name
                                                        </th>
                                                        <th>
                                                            Type
                                                        </th>
                                                        <th>
                                                            Module
                                                        </th>
                                                        <th>
                                                            Action
                                                        </th>
                                                    </thead>
                                                    <tbody id="course_material_list">
                                                    </tbody>
                                                </table>
                                            </br>
                                        </hr>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </hr>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Modal -->
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('#new_course_category').click(function(event) {
        $('#title').html('Add New Course Category');
        $('#category_form').removeClass('hide');
        $('#course_form').addClass('hide');
        $('#instructor_form').addClass('hide');
        $('#batch_form').addClass('hide');
        $('#course_input').val(' ');
      });


      $('#submit_course_category').click(function(event) {
        event.preventDefault();
        var input = $('#modalFillIn2 #course_input').val();
        if(!input)
        {
          $('#course_category_error').removeClass('hide');
        }else{
          $.post('/submit_new_category', $('#course_category').serialize(), function(data, status) {
            if(status === 'success'){
              $('#course_category_count').html(data);
              var id = 1;
              $.get('/get_course_category_list', function(data, status) {
               if(status === 'success'){
                $('#category_body').html(' ');
                  $.each(data, function(index, val) {
                   $('#category_body').append(`
                    <tr>
                      <td>${id++}</td>
                      <td>${val.course_category_name}</td>
                      <td>${val.last_name} ${val.first_name}</td>
                      <td><a href="#" onclick="edit_course_category(${val.course_category_ref})" data-target="#editmodalcategory" data-toggle="modal" ><span style="color:blue">Edit</span></a></td>
                      <td><span style="color:red"><a href="#" onclick="delete_course_category(${val.course_category_ref})" data-target="#delete_course_category" data-toggle="modal" title="">Delete</a></span></td>
                    </tr>
                    `);
                  });
                 }
                });
              }
          });
          $('#modalFillIn2').modal('toggle');
        }   
      });

      $('#show_category_table').click(function(event) {
          $('#intro').addClass('hide');
          $('#course_table').addClass('hide');
          $('#instructor_table').addClass('hide');
          $('#batch_table').addClass('hide');
          $('#category_table').removeClass('hide');
          var id = 1;
          $.get('/get_course_category_list', function(data, status) {
           if(status === 'success'){
            $('#category_body').html(' ');
              $.each(data, function(index, val) {
               $('#category_body').append(`
                <tr>
                  <td>${id++}</td>
                  <td>${val.course_category_name}</td>
                  <td>${val.last_name} ${val.first_name}</td>
                  <td><a href="#" onclick="edit_course_category(${val.course_category_ref})" data-target="#editmodalcategory" data-toggle="modal" ><span style="color:blue">Edit</span></a></td>
                  <td><span style="color:red"><a href="#" onclick="delete_course_category(${val.course_category_ref})" data-target="#delete_course_category" data-toggle="modal" title="">Delete</a></span></td>
                </tr>
                `);
              });
            }
          });
      });
</script>
<script>
    $('#new_course').click(function(event) {
        $('#title').html('Add New Course');
        $('#course_form').removeClass('hide');
        $('#category_form').addClass('hide');
        $('#instructor_form').addClass('hide');
        $('#batch_form').addClass('hide');
        $.get('/get_c_category', function(data) {
          $.each(data, function(index, val) {
            $('#category_ref').append(`
            <option value="${val.course_category_ref}">${val.course_category_name}</option>}
            `);
          });
        });
      });

      $('#submit_course').click(function(event) {
        var form = $('#course')[0];
        var formData = new FormData(form);
        $.ajax({
                   url: '/submit_new_course',
                   data: formData,
                   type: 'POST',
                   contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                   processData: false, // NEEDED, DON'T OMIT THIS
                   success: function (data, status) {
                    if(status === 'success')
                    {
                    $('#course_count').html(data);
                      $.get('/get_course_list', function(data, status) {
                         if(status === 'success'){
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
                    }
                    $("#course")[0].reset();
              $("#category_ref").select2().val("").trigger('change');
                   }
        });
      });

      $('#show_course_table').click(function(event) {
          $('#intro').addClass('hide');
          $('#category_table').addClass('hide');
          $('#instructor_table').addClass('hide');
          $('#batch_table').addClass('hide');
          $('#course_table').removeClass('hide');
          $.get('/get_course_list', function(data, status) {
           if(status === 'success'){
            $('#course_body').html(' ');
              $.each(data, function(index, val) {
               $('#course_body').append(`
                <tr>
                  <td>${val.courses_name} <span style="color:blue; font-weight:bold; font-size:12px">${val.course_code}</span></td>
                  <td><a href="#" onclick="module_question(${val.course_ref})" data-target="#module_questionaire" data-toggle="modal" class="btn-xs btn btn-primary"><span>Add Module Test</span></a></td>
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
<script>
    $('#new_Instructor').click(function(event) {
        $('#title').html('Add New Course Instructor');
        $('#instructor_form').removeClass('hide')
        $('#course_form').addClass('hide');
        $('#category_form').addClass('hide');
        $('#batch_form').addClass('hide');
      });


    function find_instructor()
    {
      var id = $('#instructor_type').val();
      if(id == 1)
      {
        $('#internal').addClass('hide');
        $('#staff_name').removeClass('hide');
      }else
      {
        $('#internal').removeClass('hide');
        $('#staff_name').addClass('hide');
      }
    }

    function users_details()
    {
      var id = $('#user_name').val();
      $.get('/get_staff_details/'+id, function(data, status) {
        $('#MobilePhone').val(data.MobilePhone);
        $('#email').val(data.email);
        $('#company').val(data.Company);
        $('#company_address').val(data.Address);
        var name = $('#user_name option:selected').text();
        $('#get_instructor_name').val(name);
      });
    }

    function typed_name()
    {
      var name = $('#typed').val();
       $('#get_instructor_name').val(name);
    }

    $('#submit_new_instructor').click(function(event) {
      $.post('/submit_new_instructor', $('#instructor').serialize(), function(data, status) {
         if(status === 'success'){
              $('#instructor_count').html(data);
              $("#instructor")[0].reset();
              $("#user_name").select2().val("").trigger('change');
              $("#instructor_type").select2().val("").trigger('change');

              var id = 1;
              $.get('/get_instructor_list', function(data, status) {
               if(status === 'success'){
                $('#instructor_body').html(' ');
                  $.each(data, function(index, val) {
                   $('#instructor_body').append(`
                    <tr>
                      <td>${id++}</td>
                      <td>${val.instructor_name}</td>
                      <td>${val.phone}</td>
                      <td><span style="color:blue">Edit</span></td>
                      <td><span style="color:red">Delete</span></td>
                    </tr>
                    `);
                  });
                }
              });
            }
      });
    });

    $('#show_instructor_table').click(function(event) {
          $('#intro').addClass('hide');
          $('#category_table').addClass('hide');
          $('#course_table').addClass('hide');
          $('#batch_table').addClass('hide');
          $('#instructor_table').removeClass('hide');
          var id = 1;
          $.get('/get_instructor_list', function(data, status) {
           if(status === 'success'){
            $('#instructor_body').html(' ');
              $.each(data, function(index, val) {
               $('#instructor_body').append(`
                <tr>
                  <td>${id++}</td>
                  <td>${val.instructor_name}</td>
                  <td>${val.phone}</td>
                  <td><span style="color:blue">Edit</span></td>
                  <td><span style="color:red">Delete</span></td>
                </tr>
                `);
              });
            }
          });
      });
</script>
<script>
    $('#new_batch').click(function(event) {
        $('#title').html('Add New Batch');
        $('#batch_form').removeClass('hide');
        $('#instructor_form').addClass('hide');
        $('#course_form').addClass('hide');
        $('#category_form').addClass('hide');
      });

      function get_duration()
      {
        var id = $('#send_duration').val();
        $.get('/get_course_duration/' +id, function(data, status) {
           if(status === 'success'){
              $('#insert_duration').val(data.course_duration);
            }
        });
      }

      $('#submit_new_batch').click(function(event) {
        $.post('/submit_new_batch', $('#batch').serialize(), function(data, status) {
          if(status == 'success'){
          $('#batch_count').html(data);
              $("#instructor_type").select2().val("").trigger('change');
            $("#send_duration").select2().val("").trigger('change');
              $("#priority").select2().val("").trigger('change');


            var id = 1;
            $.get('/get_batch_list', function(data, status) {
             if(status === 'success'){
              $('#batch_body').html(' ');
                $.each(data, function(index, val) {
                 $('#batch_body').append(`
                  <tr>
                    <td>${id++}</td>
                    <td>${val.batch_code}</td>
                    <td>${val.courses_name}</td>
                    <td><span style="color:blue">Edit</span></td>
                    <td><span style="color:red">Delete</span></td> 
                  </tr>
                  `);
                });
              }
            });
          }
        });
      });

      $('#show_batch_table').click(function(event) {
          $('#intro').addClass('hide');
          $('#category_table').addClass('hide');
          $('#course_table').addClass('hide');
          $('#instructor_table').addClass('hide');
          $('#batch_table').removeClass('hide');
          var id = 1;
          $.get('/get_batch_list', function(data, status) {
           if(status === 'success'){
            $('#batch_body').html(' ');
              $.each(data, function(index, val) {
               $('#batch_body').append(`
                <tr>
                  <td>${id++}</td>
                  <td>${val.batch_code}</td>
                  <td>${val.courses_name}</td>
                  <td><span style="color:blue">Edit</span></td>
                  <td><span style="color:red">Delete</span></td>
                </tr>
                `);
              });
            }
          });
      });
</script>
<script>
    $('#activate_material_modal').click(function(event) {
     $('#material_table').addClass('hide');
     $("#material_course").select2().val(" ").trigger('change');
     $("#material_type").select2().val(" ").trigger('change');
    });

    function mat()
    {
      var id = $('#material_course').val();
      $('#material_table').removeClass('hide');
      $.get('/get_course_material_list/' +id, function(data, status) {
          if(status === 'success'){
            $('#course_module').html('');
            $('#course_module').html('<option value="">Select Module</option>');
            $.each(data.module, function(index, val) {
              $('#course_module').append(`
                <option value="${val.ModuleRef}">${val.Module}</option>
                `);
            });

            $('#course_material_list').html(' ');
            var count = 1;
              $.each(data.material, function(index, val) {
                if (val.material_type == 1) 
                {
                    var test = 'Document';
                }else if(val.material_type == 2)
                {
                    var test = 'Video';
                }else if(val.material_type == 3)
                {
                    var test = 'Youtube';
                }else if(val.material_type == 4)
                {
                    var test = 'Audio';
                }
               $('#course_material_list').append(`
                <tr>
                  <td>${count++}</td>
                  <td>${val.material_name}</td>
                  <td>${test}</td>
                  <td>Module ${val.module_id}</td>
                  <!--<td><span class="btn btn-xs btn-info">Edit</span></td>-->
                  <td><span class="btn btn-xs btn-danger" onclick="delete_course_material(${val.course_material_ref})">Delete</span></td>
                </tr>
                `);
              });
            }
      });
    }


    function material()
    {
      var id = $('#material_type').val();
      if(id == 1)
      {
        $('#document').removeClass('hide');
        $('#submit_material').removeClass('hide');
        $('#video').addClass('hide');
        $('#youtube').addClass('hide');
        $('#audio').addClass('hide');
        $('#material_title').removeClass('hide')
      } else if(id == 2)
      {
        $('#document').addClass('hide');
        $('#submit_material').removeClass('hide');
        $('#video').removeClass('hide');
        $('#youtube').addClass('hide');
        $('#audio').addClass('hide');
        $('#material_title').removeClass('hide')
      }

      else if(id == 3)
      {
        $('#document').addClass('hide');
        $('#submit_material').removeClass('hide');
        $('#video').addClass('hide');
        $('#youtube').removeClass('hide');
        $('#audio').addClass('hide');
        $('#material_title').removeClass('hide')
      }
      else if(id == 4)
      {
        $('#document').addClass('hide');
        $('#submit_material').removeClass('hide');
        $('#video').addClass('hide');
        $('#youtube').addClass('hide');
        $('#audio').removeClass('hide');
        $('#material_title').removeClass('hide')
      }

    }

    $('#submit_material').click(function(event) {
      var course = $('#material_course').val();
      var mat = $('#material_type').val();

      if( course == "" || mat == "")
      {
        alert('Please make sure you re-select the course or material type. Thanks');
      }else{
         var form = $('#submit_course_material_form')[0];
        var formData = new FormData(form);
        $.ajax({
                   url: '/submit_course_material',
                   data: formData,
                   type: 'POST',
                   contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                   processData: false, // NEEDED, DON'T OMIT THIS
                   success: function (data, status) {
                    if(status === 'success')
                    console.log(data);
                    $("#submit_course_material_form")[0].reset();
                    $('#course_material_list').html(' ');
                        var count = 1;
                          $.each(data, function(index, val) {
                            if (val.material_type == 1) 
                            {
                                var test = 'Document';
                            }else if(val.material_type == 2)
                            {
                                var test = 'Video';
                            }else if(val.material_type == 3)
                            {
                                var test = 'Youtube';
                            }else if(val.material_type == 4)
                            {
                                var test = 'Audio';
                            }
                           $('#course_material_list').append(`
                            <tr>
                              <td>${count++}</td>
                              <td>${val.material_name}</td>
                              <td>${test}</td>
                              <td>Module ${val.module_id}</td>
                              <!--<td><span class="btn btn-xs btn-info">Edit</span></td>-->
                              <td><span class="btn btn-xs btn-danger" onclick="delete_course_material(${val.course_material_ref})">Delete</span></td>
                            </tr>
                            `);
                          });
                   }
        });
      }       
    });
</script>

<script>
    function edit_course_test(id)
    {
       var ref = id;
       $('#edit_title').html('Edit Course');
       $('#course_category_modal_div').addClass('hide');
       $('#course_modal_div').removeClass('hide');

       $.get('/get_c_category', function(data) {
          $.each(data, function(index, val) {
            $('#edit_category_ref').append(`
            <option value="${val.course_category_ref}">${val.course_category_name}</option>}
            `);
          });
        });

       $.get('/get_course_details/'+ref, function(data, status) {
         $('#edit_courses_name').val(data.courses_name);
         $('#edit_course_duration').val(data.course_duration);
         $('#edit_course_fee').val(data.course_fee);
         $('#edit_modal_course select[name="category_ref"]').val(data.category_ref).trigger('change');
         $('#edit_cover_page').val(data.cover_page);
         $('#edit_course_ref').val(data.course_ref);
         $('#edit_description').val(data.description);
       });
    }
    
    function delete_course_category(id)
    {
      $('#delete_course_category_ref').val(id);
    }


    function delete_course_test(id)
    {
      $('#delete_course_id').val(id);
    }

     $('#delete_course_button').click(function(event) {
      var ref = $('#delete_course_id').val();
      $.get('/delete_course/'+ref, function(data) {
        var id = 1;
        var count = data.length;
            $('#course_body').html(' ');
              $.each(data, function(index, val) {
               $('#course_body').append(`
                <tr>
                   <td>${val.courses_name} <span style="color:blue; font-weight:bold; font-size:12px">${val.course_code}</span></td>
                  <td><a href="#" onclick="module_question(${val.course_ref})" data-target="#module_questionaire" data-toggle="modal" class="btn-xs btn btn-primary"><span>Add Module Test</span></a></td>
                  <td><a href="#" onclick="new_question(${val.course_ref}, '${val.courses_name}')" data-target="#questionaire" data-toggle="modal" class="btn-xs btn btn-warning"><span>Add Final Test</span></a></td>
                  <td><a href="#" onclick="view_course_test(${val.course_ref})" data-target="#view_modal_course" data-toggle="modal" class="btn-xs btn btn-success"><span>View</span></a></td>
                  <td><a href="#" onclick="edit_course_test(${val.course_ref})" data-target="#edit_modal_course" data-toggle="modal" class="btn-xs btn btn-info"><span>Edit</span></a></td>
                  <td><a href="#" onclick="delete_course_test(${val.course_ref})" data-target="#delete_modal_course" data-toggle="modal" class="btn-xs btn btn-danger"><span>Delete</span></a></td>
                </tr>
                `);
              });
            $('#course_count').html(count);
            $('#delete_modal_course').modal('toggle');
      });
    });

    $('#delete_cat').click(function(event) {
      event.preventDefault();
      var ref = $('#delete_course_category_ref').val();
      $.get('/delete_course_category/'+ref, function(data) {
        var id = 1;
        var count = data.length;
            $('#category_body').html(' ');
              $.each(data, function(index, val) {
               $('#category_body').append(`
                <tr>
                  <td>${id++}</td>
                  <td>${val.course_category_name}</td>
                  <td>${val.last_name} ${val.first_name}</td>
                  <td><a href="#" onclick="edit_course_category(${val.course_category_ref})" data-target="#editmodalcategory" data-toggle="modal" ><span style="color:blue">Edit</span></a></td>
                  <td><span style="color:red"><a href="#" onclick="delete_course_category(${val.course_category_ref})" data-target="#delete_course_category" data-toggle="modal" title="">Delete</a></span></td>
                </tr>
                `);
              });
            $('#course_category_count').html(count);
            $('#delete_course_category').modal('toggle');
      });
    });

    function view_course_test(ref)
    {
      $.get('/view_course_details/'+ref, function(data) {
        $('#new_view_course').html(data.courses_name);
        $('#new_view_category').html(data.course_category_name);
        $('#new_view_duration').html(data.course_duration);
        $('#new_view_course_fee').html(data.course_fee);
        $('#new_view_course_code').html(data.course_code);
        $('#new_view_description').html(data.description);
        $('#new_view_cover_page').html(data.cover_page);
      });
    }

    function new_question(id, name)
    {
        $('#questionaire_course_name').html(name);
        $('#questionaire_course_id').val(id);
        $('#questionaire_course_ref').val(id);
        $.get('/get_question_limit/'+id, function(data) {
          $('#question_limit').removeClass('hide');
          var count = data.question_count;
          var limit = data.limit;
          $('#limit').html(limit); 
          $('#count_rem').html(count);
        });
    }

    function module_question(id)
    {
      $.get('/get_all_course_module/'+id, function(data) {
        $('#module_question_selection').html("");
        $('#module_question_selection').html('<option value="">Select Course Module Option</option>');
        $.each(data.modules, function(index, val) {
           $('#module_question_selection').append(`
              <option value="${val.ModuleRef}">${val.Module}</option>
            `);
        });

        $('#module_questionaire_course_name').html(data.courses.courses_name);
        $('#module_questionaire_course_ref').val(id);

      });
    }

    function edit_course_category(id)
    {
      $('#edit_course_category_id').val(id);
      $.get('/get_course_cateory_details/'+id, function(data) {
        $('#category_name_edit').val(data.course_category_name);
      });
    }

    $('#category_edit_button').click(function(event) {
      event.preventDefault();
      var ref= $('#edit_course_category_id').val();
      var name = $('#category_name_edit').val();
      $.get('/post_edited_course_category/'+ref+'/'+name, function(data) {
        var id = 1;
         $('#category_body').html('');
                  $.each(data, function(index, val) {
                   $('#category_body').append(`
                    <tr>
                      <td>${id++}</td>
                      <td>${val.course_category_name}</td>
                      <td>${val.last_name} ${val.first_name}</td>
                      <td><a href="#" onclick="edit_course_category(${val.course_category_ref})" data-target="#editmodalcategory" data-toggle="modal" ><span style="color:blue">Edit</span></a></td>
                      <td><span style="color:red"><a href="#" onclick="delete_course_category(${val.course_category_ref})" data-target="#delete_course_category" data-toggle="modal" title="">Delete</a></span></td>
                    </tr>
                    `);
                  });
      });
      $('#editmodalcategory').modal('toggle');
    });
</script>
@endpush
