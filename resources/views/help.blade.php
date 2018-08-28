@extends('layouts.master')

@section('content')
  <div class="card-box">
    <div class="card-title">User Guide</div>
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <iframe src = "{{ asset('/assets/plugins/ViewerJS/#/docs/documentation.pdf') }}" width="100%" height="700" allowfullscreen webkitallowfullscreen></iframe>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $('#spinner').show();
    setTimeout(function(){
      $('#spinner').hide();
    }, 8000);
  </script>
@endpush
