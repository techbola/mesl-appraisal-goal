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

        tbody tr td {
            font-size: 12px;
        }
	</style>
@endpush

@section('content')
    <ul class="nav nav-tabs outside">
        <li class="active">
            <a data-toggle="tab" href="#exit-request">
                Exit Interview Form &nbsp; <span class="badge badge-warning"></span>
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#exit-table">
                Exit table &nbsp; <span class="badge badge-success">
                    {{-- {{ count() }} --}}
                </span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="exit-request" class="tab-pane fade in active">
            <div class="clearfix"></div>
            <form action="" method="POST" class="form">
                {{ csrf_field() }}
                <div class="card-box">
                    <div class="card-title">Staff Exit Request</div>
                </div>

                <div id="exit-table" class="tab-pane fade">        
                    <div class="clearfix"></div>
                    <div class="card-box">
                        <table class="table tableWithSearch table-bordered">
                            <thead>
                                <th width="10%">Employee</th>
                                <th width="7%">Department</th>
                                <th width="7%">Employment</th>
                                <th width="5%">Resumption</th>
                                <th width="12%">Workspace</th>
                                <th width="12%">Office Assets</th>
                                <th width="15%">Admin</th>
                                <th width="15%">IT</th>
                                <th width="15%">Action</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
  </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script>
        
    </script>
@endpush