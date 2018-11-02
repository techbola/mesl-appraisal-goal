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
     <div class="card-box" style="padding: 20px">
      <div class="text-center">
        <img src="{{ asset('storage/course_images/'.$course_details->cover_page)}}" alt="logo" width="200" height="200">
        <h3 style="font-weight: bold">{{ $course_details->courses_name }}</h3><hr>
      </div>
       <div>
          <h4 style="color: #5198cd">Introduction</h4>
          <p>{{ $course_details->description }}</p>
        </div><hr>

        <div>
          <h4 style="color: #5198cd">Course Tutorials</h4>
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
          <h4 style="color: #5198cd">Summary & Reviews</h4>
          <ul>
            <li>Summary</li>
            <li>Reviews</li>
          </ul>
        </div><hr>

        <div>
          <h4 style="color: #5198cd">Questions</h4>
          <p style="font-weight: bold">Question</p>
        </div><hr>
     </div>
   </div>

   <div class="col-md-8">
     <div class="card-box" style="padding: 20px">
       <div id='show_material_info'>

       </div>
     </div>
   </div>
 </div>

@endsection

@push('scripts')
 <script>

   $('.material_id').click(function(event) {
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


        var progress_status = prog_count()
        $('.prog').change(function(e){
            progress_status = prog_count - 1
        });

        var checked_boxes = $('input:prog:checked').length;




 </script>
@endpush



