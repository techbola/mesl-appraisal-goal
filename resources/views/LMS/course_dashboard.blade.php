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
			<h3 style="font-weight: bold;">Course Dashboard </h3>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="pull-right">
				<a href="#" id="new_course_category" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-lg btn-warning" >Add New Course Category</a>
				<a href="#" id="new_course" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-lg btn-info" >Add New Course</a>
				<a href="#" id="new_Instructor" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-lg btn-success" >Add New Instructor</a>
				<a href="#" id="new_batch" data-target="#modalFillIn2" data-toggle="modal" class="btn btn-lg btn-primary" >Add New Batch</a>
			</div>
		</div><div class="clearfix"></div><br>

		<div class="row">

			<div class="col-md-6">
				<div class="row">
					<div class="col-md-3">
                     <div class="card-box">
                       <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                         <img class="icon" src="{{ asset('assets/img/icons/backend.png') }}" alt="" width="60px" style="filter: brightness(0.92);">
                       </div>
                       <div class="inline">
                         <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Categories</div>
                         <h3 class="no-margin p-b-5 text-info bold" style="padding: 0px 0px 0px 20px;" id="course_category_count">{{ $course_count }}</h3>
                         <span><a href="#" id="show_category_table" class="label label-inverse pull-right btn-rounded text-capitalize pull-right">See all <i class="fa fa-arrow-right m-l-5"></i></a></span>
                       </div>
                     </div>
			</div>

				<div class="col-md-3">
                     <div class="card-box">
                       <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                         <img class="icon" src="{{ asset('assets/img/icons/languages.png') }}" alt="" width="60px" style="filter: brightness(0.92);">
                       </div>
                       <div class="inline">
                         <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Course</div>
                         <h3 class="no-margin p-b-5 text-info bold" style="padding: 0px 0px 0px 20px;" id="course_count">{{ $course }}</h3>
                          <span><a href="#" id="show_course_table" class="label label-inverse pull-right btn-rounded text-capitalize pull-right">See all <i class="fa fa-arrow-right m-l-5"></i></a></span>
                       </div>
                     </div>
			</div> 

			<div class="col-md-3">
                     <div class="card-box">
                       <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                         <img class="icon" src="{{ asset('assets/img/icons/presentation.png') }}" alt="" width="60px" style="filter: brightness(0.92);">
                       </div>
                       <div class="inline">
                         <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Instructors</div>
                         <h3 class="no-margin p-b-5 text-info bold" style="padding: 0px 0px 0px 20px;" id="instructor_count">{{ $instructor_count }}</h3>
                         <span><a href="#" id="show_instructor_table" class="label label-inverse pull-right btn-rounded text-capitalize pull-right">See all <i class="fa fa-arrow-right m-l-5"></i></a></span>
                       </div>
                     </div>
			</div>

			<div class="col-md-3">
                     <div class="card-box">
                       <div class="inline m-r-10 m-t-10" style="vertical-align:top">
                         <img class="icon" src="{{ asset('assets/img/icons/students.png') }}" alt="" width="60px" style="filter: brightness(0.92);">
                       </div>
                       <div class="inline">
                         <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Batches</div>
                         <h3 class="no-margin p-b-5 text-info bold" style="padding: 0px 0px 0px 20px;" id="batch_count">{{ $batch_counter }}</h3>
                         <span><a href="#" id="show_batch_table" class="label label-inverse pull-right btn-rounded text-capitalize pull-right">See all <i class="fa fa-arrow-right m-l-5"></i></a></span>
                       </div>
                     </div>
			</div>
				</div>
			</div>

			<div class="col-md-6" style="overflow-y: scroll;max-height: 500px">

				<div class="row">
					<div class="card-box" id="table_container">
					  <div id="intro">
						  <iframe width="560" height="315" src="https://www.youtube.com/embed/zv5bpfxJ2xE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					   </div>

             <div id="category_table" class="hide">
                <table class="table-hover table">
                  <thead>
                      <th>S/N</th>
                      <th>Course Category</th>
                      <th>Created By</th>
                      <th colspan="2">Action</th>
                  </thead>
                  <tbody id="category_body">
                  </tbody>
                </table>
             </div>

             <div id="course_table" class="hide">
              <div class="right">
                <a href="#" id="activate_material_modal" data-target="#modalFillIn3" data-toggle="modal" class="btn btn-xs btn-info pull-right">Add Course Material</a>
              </div>
                <table class="table-hover table">
                  <thead>
                      <th>Course Name</th>
                      <th>Course Code</th>
                      <th colspan="2">Action</th>
                  </thead>
                  <tbody id="course_body">
                  </tbody>
                </table>
             </div>

             <div id="instructor_table" class="hide">
                <table class="table-hover table">
                  <thead>
                      <th>S/N</th>
                      <th>Instructor Name</th>
                      <th>Phone</th>
                      <th colspan="2">Action</th>
                  </thead>
                  <tbody id="instructor_body">
                  </tbody>
                </table>
             </div>

             <div id="batch_table" class="hide">
                <table class="table-hover table">
                  <thead>
                      <th>S/N</th>
                      <th>Batch Code</th>
                      <th>Course</th>
                      <th colspan="2">Action</th>
                  </thead>
                  <tbody id="batch_body">
                  </tbody>
                </table>
             </div>

					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>


<div class="page-content-wrapper ">
     <div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn2"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 800px; padding: 15px">
                <div class="modal-header">
                  <h5 class="text-left semi-bold" id="title"></h5>
                </div><hr>
                <div class="modal-body">
                  <div class="row">

                    <div id='category_form' class="hide">
                      {{ Form::open(['id'=>'course_category','autocomplete' => 'off', 'role' => 'form']) }}
                               @include('LMS.forms.add_course_category')
                        {{ Form::close() }}
                    </div>

                    <div id='course_form' class="hide">
                      {{ Form::open(['id'=>'course','autocomplete' => 'off', 'role' => 'form', 'files'=>'true']) }}
                               @include('LMS.forms.add_course')
                      {{ Form::close() }}
                    </div>

                    <div id='instructor_form' class="hide">
                      {{ Form::open(['id'=>'instructor','autocomplete' => 'off', 'role' => 'form']) }}
                               @include('LMS.forms.add_instructor')
                      {{ Form::close() }}
                    </div>

                    <div id='batch_form' class="hide">
                      {{ Form::open(['id'=>'batch','autocomplete' => 'off', 'role' => 'form']) }}
                               @include('LMS.forms.add_batch')
                      {{ Form::close() }}
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
      </div>

      <div class="page-content-wrapper ">
     <div class="content ">
          <!-- Modal -->
          <div class="modal fade fill-in" id="modalFillIn3"  role="dialog" aria-hidden="true" style="display: none;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="pg-close" style="color: #fff"></i>
            </button>
            <div class="modal-dialog ">
              <div class="modal-content">
                <div style="background: #fff; width: 650px; padding: 15px">
                <div class="modal-header">
                  <h5 class="text-left semi-bold">Add Material(s)</h5>
                </div><hr>
                <div class="modal-body">
                  <div class="row">
                    {{ Form::open(['id'=>'submit_course_material_form','autocomplete' => 'off', 'role' => 'form', 'files'=>'true']) }}
                    <div class="col-md-6">
                         <div class="form-group">
                           {{ Form::label('course_id', 'Select Course' ) }}
                              <select name="course_id" class="full-width" id="material_course" onchange="mat()" data-init-plugin="select2">
                             <option value=" ">Select Course</option>
                             @foreach($course_names as $course_name)
                               <option value="{{ $course_name->course_ref }}">{{ $course_name->courses_name }}</option>
                             @endforeach
                           </select>
       
                         </div>
                       </div>

                       <div class="col-md-6">
                          <div class="form-group">
                            {{ Form::label('material_type', 'Course Material Type' ) }}
                            <select name="material_type" class="full-width" id="material_type" onchange="material()" data-init-plugin="select2">
                              <option value=" ">Select Course</option>
                              <option value="1">Document</option>
                              <option value="2">Video</option>
                              <option value="3">Youtube</option>
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

                       <button type="submit" id="submit_material" class="btn btn-info btn-form pull-right hide" data-dismiss="modal">Add New Course</button>

                       {{ Form::close() }}

                       <div id="material_table" class="hide">
                           <hr><br>
                           <table class="table table-hover">
                            <thead>
                                 <th>S/N</th>
                                 <th>Material Name</th>
                                 <th>Type</th>
                                 <th colspan="2">Action</th>
                            </thead>
                            <tbody id="course_material_list">
                            </tbody>
                           </table>
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
             $.post('/submit_new_category', $('#course_category').serialize(), function(data, status) {
            if(status === 'success'){
              $('#course_category_count').html(data);
            }
        });

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

      $('#new_course').click(function(event) {
        $('#title').html('Add New Course');
        $('#course_form').removeClass('hide');
        $('#category_form').addClass('hide');
        $('#instructor_form').addClass('hide');
        $('#batch_form').addClass('hide');
        $.get('/get_c_category', function(data) {
          $('#category_ref').append(`
            <option value="${data.course_category_ref}">${data.course_category_name}</option>}
            `);
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
                    console.log(data);
                  $('#course_count').html(data);
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
                  <td>${val.courses_name}</td>
                  <td>${val.course_code}</td>
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
          $('#batch_count').html(data);
          $("#batch")[0].reset();
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
    });

    function mat()
    {
      var id = $('#material_course').val();
      $('#material_table').removeClass('hide');
      $.get('/get_course_material_list/' +id, function(data, status) {
          if(status === 'success'){
            $('#course_material_list').html(' ');
            var count = 1;
              $.each(data, function(index, val) {
               $('#course_material_list').append(`
                <tr>
                  <td>${count++}</td>
                  <td>${val.material_name}</td>
                  <td>${val.material_type}</td>
                  <td><span style="color:blue">Edit</span></td>
                  <td><span style="color:red">Delete</span></td>
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
        $('#material_title').removeClass('hide')
      } else if(id == 2)
      {
        $('#document').addClass('hide');
        $('#submit_material').removeClass('hide');
        $('#video').removeClass('hide');
        $('#youtube').addClass('hide');
        $('#material_title').removeClass('hide')
      }

      else if(id == 3)
      {
        $('#document').addClass('hide');
        $('#submit_material').removeClass('hide');
        $('#video').addClass('hide');
        $('#youtube').removeClass('hide');
        $('#material_title').removeClass('hide')
      }
    }

    $('#submit_material').click(function(event) {
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
                   }
        });
    });

  </script>

@endpush

