@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@section('page-title')
  Dashboard
@endsection

@section('buttons')
<a href="{{ route('admin-home') }}" class="btn btn-complete">Dashboard</a>
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
      opacity: 0.05;
      zoom: 2;
    }

    .style2 .title {
      font-size: 20px;
    font-family: 'Karla', sans-serif;
    font-weight: 600;
    margin-top: 3px;
    margin-bottom: 3px;
    color: #000;
    letter-spacing: 1px;
    text-transform: uppercase;
    }

    .style2 .help-text {
      color: #777;
      font-size: 12px;
      display: block;
    }

    .style2 .pl-indicator {
          font-family: 'Karla', sans-serif;
          vertical-align: middle;
          font-weight: 600;
    }
    .pl-indicator i {
          vertical-align: middle;
    }

    .card-img img {
          width: 60px;
          margin: auto;
    /* padding: 2px; */
    /* border: 1px solid #0099ff; */
    /*border-radius: 100%;*/
    }
  </style>
  {{-- <div class="text-center">
    <img src="{{ asset('assets/img/backgrounds/cavidel-slide.jpg') }}" alt="" width="95%">
  </div> --}}


  {{-- START TOP BLOCKS --}}
  <div class="row">

    <div class="col-sm-4">
      <a href="#" class="no-color">
        <div class="card-box text-center style2">
          <div class="card-img">
            <img src="{{ asset('images/dash-home.png') }}" alt="">
          </div>
          <h2 class="title"><sup>₦</sup>{{-- (number_format($outstanding_bills, 2)) --}} <small class="hide">Mm</small></h2>
          <span class="help-text">Receivables</span>
          <span class="pl-indicator text-danger hide">
            <i class="glyphicon glyphicon-triangle-bottom"></i> 80%
          </span>
        </div>
      </a>
    </div>

    <div class="col-sm-4">
      <a href="#" class="no-color">
        <div class="card-box text-center style2">
          <div class="card-img">
            <img src="{{ asset('images/dash-finance.png') }}" alt="">
          </div>
          <h2 class="title"><sup>₦</sup>{{-- (number_format(abs($netflow),2)) --}} <small class="text-success hide">Cr</small></h2>
          <span class="help-text">Net CashFlow</span>
          <span class="pl-indicator text-success hide">
            <i class="glyphicon glyphicon-triangle-top"></i> 109%
          </span>
        </div>
      </a>
    </div>

    <div class="col-sm-4">
      <a href="#" class="no-color">
        <div class="card-box text-center style2">
          <div class="card-img">
            <img src="{{ asset('images/dash-audit.png') }}" alt="">
          </div>
          <h2 class="title">Projects.</h2>
          <span class="pl-indicator text-info">
            <i class="glyphicon glyphicon-users"></i> -
          </span>
        </div>
      </a>
    </div>

  </div>



   <div class="row">

    <div class="col-sm-4">
      <a href="{{ route('payroll.details') }}" class="no-color">
        <div class="card-box text-center style2">
          <div class="card-img">
            <img src="{{ asset('images/dash-hr.png') }}" alt="">
          </div>
          <h2 class="title">HR Reports</h2>
          <span class="help-text">HR</span>
          <span class="pl-indicator text-info">
            <i class="glyphicon glyphicon-users"></i> {{ number_format($staff_total) }} Staff
          </span>
        </div>
      </a>
    </div>

    <div class="col-sm-4">
      <a href="#" class="no-color">
        <div class="card-box text-center style2">
          <div class="card-img">
            <img src="{{ asset('images/dash-legal.png') }}" alt="">
          </div>
          <h2 class="title">Legal</h2>
          <span class="help-text">Legal</span>
          <span class="pl-indicator text-info">
            <i class="glyphicon glyphicon-users"></i>{{-- number_format($files_total) --}}  Case Files
          </span>
        </div>
      </a>
    </div>

     <div class="col-sm-4">
      <a href="#" class="no-color">
        <div class="card-box text-center style2">
          <div class="card-img">
            <img src="{{ asset('images/dash-audit.png') }}" alt="">
          </div>
          <h2 class="title">Audit Rep.</h2>
          <span class="help-text">Audit</span>
          <span class="pl-indicator text-info">
            <i class="glyphicon glyphicon-users"></i> Complaince
          </span>
        </div>
      </a>
    </div>

  </div>
  {{-- END TOP BLOCKS --}}



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
