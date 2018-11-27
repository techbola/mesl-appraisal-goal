@extends('layouts.master')

{{-- @section('title')
  Dashboard
@endsection --}}

{{-- @section('page-title')
  Dashboard
@endsection --}}

@section('no-subnav')
@endsection

@section('content')
  <style media="screen">
    .col-md-4 {
      /* width: 100%; */
    }
    .balloons {
      position: absolute;
      right: -30px;
      top: -10px;
      opacity: 0.3;
      zoom: 2;
    }
  </style>
  {{-- <div class="text-center">
    <img src="{{ asset('assets/img/backgrounds/cavidel-slide.jpg') }}" alt="" width="95%">
  </div> --}}


    <div>
      @include('dashboard.dashboard-tabs')
    </div>






@endsection

@push('scripts')
  <script src="{{ asset('assets/plugins/feathericons/feather.min.js') }}" charset="utf-8"></script>
  <i data-feather="circle"></i>

<script>
  feather.replace();
</script>

<script src="{{ asset('js/isotope/isotope.pkgd.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('js/isotope/packery-mode.pkgd.min.js') }}" charset="utf-8"></script>
<script>
  $('.grid').isotope({
    // options
    itemSelector: '.grid-item',
    layoutMode: 'packery',
    percentPosition: true,
    getSortData: {
      count: '[data-sort]',
    },
    sortBy: 'count',
    sortAscending: false
  });
</script>
@endpush
