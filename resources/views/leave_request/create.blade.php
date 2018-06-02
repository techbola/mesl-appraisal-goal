@extends('layouts.master')

@section('content')
<div class="panel panel-white">
	<div class="panel-heading">
		<div class="panel-title">
			Request For Leave
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-10">
		{{ Form::open(['action' => 'LeaveRequestController@store_leave_request', 'autocomplete' => 'off', 'role' => 'form']) }}
		@include('leave_request.form', ['buttonText' => 'Request For Leave'])
		{{ Form::close() }}
		</div>

			<div class="col-md-2">
                    <!-- START WIDGET D3 widget_graphTileFlat-->
                    <div class="widget-8 panel no-border bg-primary no-margin widget-loader-bar" style="height: 105px">
                      <div class="container-xs-height full-height">
                        <div class="row-xs-height">
                          <div class="col-xs-height col-top">
                            <div class="panel-heading top-left top-right">
                              <div class="panel-title text-black hint-text">
                                <span class="font-montserrat fs-11 all-caps" style="color: #fff">Annual Leave Days 
                                                    </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row-xs-height ">
                          <div class="col-xs-height col-top relative">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="p-l-20"  style="margin-left: 50px">
                                  <h1 class="no-margin text-white" id="leavedays">{{ $leavedays->LeaveDays }}</h1>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- END WIDGET -->
                  </div><br>	

                   <div class="widget-8 panel no-border bg-danger no-margin widget-loader-bar" style="height: 105px">
                      <div class="container-xs-height full-height">
                        <div class="row-xs-height">
                          <div class="col-xs-height col-top">
                            <div class="panel-heading top-left top-right">
                              <div class="panel-title text-black hint-text">
                                <span class="font-montserrat fs-11 all-caps" style="color: #fff">Remaining Leave Days
                                                    </span>
                              </div>
                            </div>
                          </div>
                        </div><br>
                        <div class="row-xs-height ">
                          <div class="col-xs-height col-top relative">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="p-l-20"  style="margin-left: 50px">
                                  <h2 class="no-margin text-white" id="leave_left">{{ $remaining_days }}</h2>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- END WIDGET -->
                  </div>	
			</div>
	</div>
</div>
@endsection


