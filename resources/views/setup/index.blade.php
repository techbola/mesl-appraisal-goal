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

    /* table th, table td {
        width: 80px  !important;
    } */
	</style>
@endpush

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


<div class="row">
    <div class="col-sm-4">
        <a href="#" data-toggle="modal" data-target="#admin-setup">
            <div class="card-box text-center style2">
            <div class="card-img">
                <i class="fa fa-wrench"></i>
            </div>
            <h6 class="bold theme-primary">Admin Setup</h2>
            </div>
        </a>
    </div>

    <div class="col-sm-4">
        <a href="#" data-toggle="modal" data-target="#tr-setup">
            <div class="card-box text-center style2">
            <div class="card-img">
                <i class="fa fa-wrench"></i>
            </div>
            <h6 class="bold theme-primary">Travel Request Setup</h2>
            </div>
        </a>
    </div>
    <div class="col-sm-4">
        <a href="#"  data-toggle="modal" data-target="#hr-setup">
            <div class="card-box text-center style2">
            <div class="card-img">
                <i class="fa fa-wrench"></i>
            </div>
            <h6 class="bold theme-primary">HR Setup</h2>
            </div>
        </a>
    </div>
</div>


  {{--Admin setup Modals --}}
<div class="modal fade" id="admin-setup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><strong>Admin Setups</strong></h4>
        </div>
        <div class="modal-body">
            <table class="table tableWithSearch table-bordered">
                <thead>
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Policy Setup</strong></td>
                        <td><a href="/setup/policy" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                    <tr>
                        <td><strong>Level Setup</strong></td>
                        <td><a href="/setup/level" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                    <tr>
                        <td><strong>Deduction Setup</strong></td>
                        <td><a href="/setup/deduction" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

{{-- Travel request setup modal --}}

<div class="modal fade" id="tr-setup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><strong>Travel Request Setups</strong></h4>
        </div>
        <div class="modal-body">
            <table class="table tableWithSearch table-bordered">
                <thead>
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Travel Lodge Setup</strong></td>
                        <td><a href="/setup/travel_lodge" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                    <tr>
                        <td><strong>Travel Mode Setup</strong></td>
                        <td><a href="/setup/travel_mode" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                    <tr>
                        <td><strong>Travel Purpose Setup</strong></td>
                        <td><a href="/setup/travel_purpose" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                    <tr>
                        <td><strong>Travel Transport Setup</strong></td>
                        <td><a href="/setup/travel_transport" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>


{{-- hr setup modal --}}
<div class="modal fade" id="hr-setup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><strong>HR Setups</strong></h4>
        </div>
        <div class="modal-body">
            <table class="table tableWithSearch table-bordered">
                <thead>
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Department Setup</strong></td>
                        <td><a href="/setup/department" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                    <tr>
                        <td><strong>Bank Setup</strong></td>
                        <td><a href="/setup/bank_setup" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                    <tr>
                        <td><strong>Location Setup</strong></td>
                        <td><a href="/setup/Location" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>

                    <tr>
                        <td><strong>Staff Type Setup</strong></td>
                        <td><a href="/setup/staff_type" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                    <tr>
                        <td><strong>PFA Setup</strong></td>
                        <td><a href="/setup/pfa" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                    <tr>
                        <td><strong>HMO Setup</strong></td>
                        <td><a href="/setup/hmo" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                    <tr>
                        <td><strong>HMO Plan Setup</strong></td>
                        <td><a href="/setup/hmo_plan" target="_blank" class="btn btn-info">View Setup</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>

<script>


</script>
