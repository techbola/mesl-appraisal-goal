@extends('layouts.master')
@section('content')
  {{-- <div class="text-center">
    <img src="{{ asset('assets/img/backgrounds/cavidel-slide.jpg') }}" alt="" width="95%">
  </div> --}}

  <div class="row">

    {{-- <div class="col-md-4">
      <!-- START WIDGET widget_statTile-->
      <div class="widget-10 panel no-border bg-white no-margin widget-loader-bar">
        <div class="panel-heading top-left top-right ">
          <div class="panel-title text-black hint-text">
            <span class="font-montserrat fs-11 all-caps">Weekly Sales <i class="fa fa-chevron-right"></i></span>
          </div>
          <div class="panel-controls">
            <ul>
              <li><a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="panel-body p-t-40">
          <div class="row">
            <div class="col-sm-12">
              <h4 class="no-margin p-b-5 text-danger semi-bold">APPL 2.032</h4>
              <div class="pull-left small">
                <span>WMHC</span>
                <span class=" text-success font-montserrat"><i class="fa fa-caret-up m-l-10"></i> 9%</span>
              </div>
              <div class="pull-left m-l-20 small">
                <span>HCRS</span>
                <span class=" text-danger font-montserrat"><i class="fa fa-caret-up m-l-10"></i> 21%</span>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="p-t-10 full-width">
            <a href="#" class="btn-circle-arrow b-grey"><i class="pg-arrow_minimize text-danger"></i></a>
            <span class="hint-text small">Show more</span>
          </div>
        </div>
      </div>
      <!-- END WIDGET -->
    </div> --}}

    <div class="col-md-4">
      <div class="card-box">
        <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Pending Meeting Actions</div>
        <h3 class="no-margin p-b-5 text-info semi-bold">{{ $pending_meeting_actions }}</h3>
        {{-- <div class="small">
          <span>WMHC</span>
          <span class=" text-success font-montserrat"><i class="fa fa-caret-up m-l-10"></i> 9%</span>
          <span class="m-l-20">HCRS</span>
          <span class=" text-danger font-montserrat"><i class="fa fa-caret-up m-l-10"></i> 21%</span>
        </div> --}}
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-box">
        <div class="font-title f16 bold m-b-10 text-uppercase hint-text">To-Dos Today</div>
        <h3 class="no-margin p-b-5 text-info semi-bold">{{ count($todos_today) }}</h3>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-box">
        <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Tasks</div>
        <h3 class="no-margin p-b-5 text-info semi-bold">{{ count($tasks) }}</h3>
      </div>
    </div>

  </div>

@endsection
