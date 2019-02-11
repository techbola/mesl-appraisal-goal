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

    <ul class="nav nav-tabs outside">
        <li class="active">
            <a data-toggle="tab" href="#onboarding-request">
                    Travel Request Form &nbsp; <span class="badge badge-warning"></span>
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#onboarding-status">
                Travel Requests &nbsp; <span class="badge badge-success"> {{ count($travel_requests) }}</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="onboarding-request" class="tab-pane fade in active">
            <div class="clearfix"></div>
            <div class="card-box">
                <div class="card-title">Travel Request</div>
                <form action="{{ route('storerequest') }}" method="POST" class="form">
                    {{ csrf_field() }}
                        <div class="row">                                
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('TravelType', 'Travel Type' ) }}
                                        <select name="TravelType" class="full-width" data-init-plugin="select2" id="travel_type"  onchange="find_travel_type()">
                                            <option value="">Select Travel Type</option>
                                            <option value="1">Local</option>
                                            <option value="2">International</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <div class="travel_from_state hide">
                                            <label for="TravelFromState">Travel From</label>
                                            <select name="TravelFromState" class="full-width travel_from_state" style="display: none" data-init-plugin="select2" id="travel_from_state" onchange="">
                                                @foreach($states as $state)
                                                    <option value="{{ $state->StateRef }}">{{ $state->State }}</option>
                                                @endforeach
                                            </select>
                                        </div>
            
                                        <div class="travel_from_country hide">
                                            <label for="TravelFromCountry">Travel From</label>
                                            <select name="TravelFromCountry" class="full-width travel_from_country" style="display: none" data-init-plugin="select2" id="travel_from_country" >
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->countryRef }}">{{ $country->Country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <div class="travel_to_state hide">
                                            <label for="TravelToState">Travel To</label>
                                            <select name="TravelToState" class="full-width travel_to_state" style="display: none" data-init-plugin="select2" id="travel_to_state" onchange="">
                                                @foreach($states as $state)
                                                    <option value="{{ $state->StateRef }}">{{ $state->State }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                
                                        <div class="travel_to_country hide">
                                            <label for="TravelToCountry">Travel To</label>
                                            <select name="TravelToCountry" class="full-width travel_to_country" style="display: none" data-init-plugin="select2" id="travel_to_country" >
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->CountryRef }}">{{ $country->Country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    
                        <br>
                
                        <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('DepartureDate', 'Departure Date') }}
                                            <div class="input-group">
                                                {{ Form::Date('DepartureDate', null, ['class' => 'form-control', 'placeholder' => 'Departure Date', 'required']) }}
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('DepartureTime', 'Departure Time' ) }}
                                            {{ Form::time('DepartureTime', null, ['class' => 'form-control', 'placeholder' => 'Departure Time']) }}
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('ArrivalDate', 'Arrival Date') }}
                                            <div class="input-group ">
                                                {{ Form::date('ArrivalDate', null, ['class' => 'form-control', 'placeholder' => 'Arrival Date', 'required']) }}
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar">
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('ArrivalTime', 'Arrival Time' ) }}
                                            {{ Form::time('ArrivalTime', null, ['class' => 'form-control', 'placeholder' => 'Arrival Time']) }}
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <br>
                
                        <div class="row">
                
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        {{ Form::label('Purpose', 'Travel Purpose' ) }}
                                        <select name="Purpose" class="full-width" data-init-plugin="select2" id="travel_purpose" onchange="">
                                            <option value=" ">Select Travel Purpose</option>
                                            <option value="1">Training</option>
                                            <option value="2">Conference</option>
                                            <option value="3">Meeting</option>
                                            <option value="4">Vacation</option>
                                            <option value="5">Medical</option>
                                            <option value="6">Systems Review</option>
                                            <option value="7">Study Tour</option>
                                            <option value="8">Feasibility Study</option>
                                            <option value="9">Recruitment</option>
                                            <option value="10">Business Development</option>
                                            <option value="11">Awards</option>
                                            <option value="12">Interviews</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-md-6">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('PurposeDescription', 'Purpose Description' ) }}
                                        {{ Form::textarea('PurposeDescription', null, ['class' => 'form-control', 'placeholder' => 'Purpose Description', 'rows'=> '1']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="controls">
                                        <div class="form-group">
                                        {{ Form::label('TravelMode', 'Travel mode' ) }}
                                        <select name="TravelMode" class="full-width" data-init-plugin="select2" id="travel_mode" onchange="">
                                            <option value=" ">Select Travel Mode</option>
                                            @foreach($travelmodes as $travelmode)
                                                <option value="{{ $travelmode->TravelModeRef }}">{{ $travelmode->TravelMode }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-md-4">
                                    <div class="controls">
                                        <div class="form-group">
                                            {{ Form::label('PreferredTransporter', 'Preffered Transporter' ) }}
                                            <select name="PreferredTransporter" class="full-width" data-init-plugin="select2" id="preffered_transporter" onchange="">
                                                    <option value=" ">Select Transport Type</option>
                                                @foreach($transports as $transport)
                                                    <option value="{{ $transport->TransporterRef }}">{{ $transport->Transporter }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-md-4">
                                    <div class="controls">
                                        <div class="form-group">
                                            {{ Form::label('OtherTransporter', 'Other Transporter' ) }}
                                            {{ Form::textarea('OtherTransporter', null, ['class' => 'form-control', 'placeholder' => 'Other Transporter', 'rows'=> '1']) }}
                                        </div>
                                    </div>
                                </div>
                        </div>
                
                        <br>
                
                        <div class="row">
                            <div class="col-md-3">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('Lodging', 'Lodging' ) }}
                                        <select name="Lodging" class="full-width" data-init-plugin="select2" id="Lodging" onchange="">
                                            <option value=" ">Preffered Lodge Type</option>
                                            @foreach($lodges as $lodge)
                                                <option value="{{ $lodge->TravelLodgeRef }}">{{ $lodge->TravelLodge }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('DestinationAddress', 'Destination Address' ) }}
                                            {{ Form::text('DestinationAddress', null, ['class' => 'form-control', 'placeholder' => 'Destination Address']) }}
                                        </div>
                                    </div>
                            </div>
                
                            <div class="col-md-3">
                                <div class="controls">
                                    <div class="form-group">
                                        {{ Form::label('Approver', 'Approver' ) }}
                                        <select name="Approver" class="full-width" data-init-plugin="select2" id="Approver" onchange="">
                                                <option value=" ">Select Approver</option>
                                            @foreach($staffs as $staff)
                                                <option value="{{ $staff->StaffRef }}">{{ $staff->FullName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('ReferenceLetter', 'Reference Letter' ) }}
                                            {{ Form::file('ReferenceLetter', null, ['class' => 'form-control', 'placeholder' => 'Upload Reference Letter', 'rows'=> '2']) }}
                                        </div>
                                    </div>
                            </div>
                
                
                        </div>
                
                        <br>
                
                        <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        


        <div id="onboarding-status" class="tab-pane fade">        
                <div class="clearfix"></div>
            <div class="card-box">
                <div class="request-table table-responsive">
                    <table class="table tableWithSearch table-bordered" id="travelTable">
                        <thead>
                            <th width="5px">S/N</th>
                            <th style="width: 120px; word-break:break-all;">Travel Type</th>
                            <th style="width: 80px; word-break:break-all;">From</th>
                            <th style="width: 80px; word-break:break-all;">To</th>
                            <th style="width: 120px; word-break:break-all;">Departure Date</th>
                            <th style="width: 80px; word-break:break-all;">Departure Time</th>
                            <th style="width: 80px; word-break:break-all;">Arrival Date</th>
                            <th style="width: 80px; ">Arrival time</th>
                            <th style="width: 80px; word-break:break-all;">Travel Purpose</th>
                            <th style="width: 80px; ">Travel Lodge</th>
                            <th style="width: 80px; word-break:break-all;">Travel Transporter</th>
                            <th style="width: 80px; word-break:break-all;">Action</th>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            @foreach($travel_requests as $travel_request)
                                <?php $count = $count + 1; ?>
                                <tr>
                                    <th>{{ $count }}</th>
                                    <td>{{ $travel_request->Travel_type->TravelType ?? '-' }}</td>
                                    <td>{{ $travel_request->TravelType == 1 ? $travel_request->travel_from_state->State : $travel_request->travel_from_state->State ?? '-' }}</td>
                                    <td>{{ $travel_request->TravelType == 1 ? $travel_request->travel_to_state->State : $travel_request->travel_to_country->Country ?? '-' }}</td>
                                    <td>{{ $travel_request->DepartureDate }}</td>
                                    <td>{{ $travel_request->DepartureTime }}</td>
                                    <td>{{ $travel_request->ArrivalDate }}</td>
                                    <td>{{ $travel_request->ArrivalTime }}</td>
                                    <td>{{ $travel_request->travel_purpose->TravelPurpose ?? '-' }}</td>
                                    <td>{{ $travel_request->travel_lodge->TravelLodge ?? '-' }}</td>
                                    <td>{{ $travel_request->travel_transporter->Transporter ?? '-' }}</td>
                                    <td style="width: 20%">
                                        <span data-toggle="tooltip" data-placement="top" title="Edit">
                                                <button style="margin-right: 10px; display: inline-block" type="edit" class="btn btn-sm btn-primary toggler" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="edit_travelrequest( {{$travel_request->TravelRef}})"><i class="fa fa-edit"></i></button>
                                        </span>
            
                                        <a style="margin-right: 10px; display: inline-block" href="{{ route('delete', $travel_request->TravelRef) }}" type="edit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                
                                        <a href="{{ route('sendapproval', $travel_request->TravelRef) }}" type="submit" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Send for Approval"><i class="fa fa-share-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    
            <div class="container">
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"       aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <br>
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalCenterTitle"><strong>Edit Travel Request</strong></h3>
                            </div>
                            <br>
                            <div class="modal-body">
                            <form action="" method="POST" id="form-edit">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="TravelRef" name="TravelRef" value="">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        {{ Form::label('TravelType', 'Travel Type' ) }}
                                                        <select name="TravelType" class="full-width" data-init-plugin="select2" id="travel_type1"  onchange="find_travel_type()">
                                                            <option value="">Select Travel Type</option>
                                                            <option value="1">Local</option>
                                                            <option value="2">International</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <div class="travel_from_state hide">
                                                            <label for="TravelFromState">Travel From</label>
                                                            <select name="TravelFromState" class="full-width travel_from_state" style="display: none" data-init-plugin="select2" id="travel_from1" onchange="">
                                                                @foreach($states as $state)
                                                                    <option value="{{ $state->StateRef }}">{{ $state->State }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
    
                                                        <div class="travel_from_country hide">
                                                            <label for="TravelFromCountry">Travel From</label>
                                                            <select name="TravelFromCountry" class="full-width travel_from_country" style="display: none" data-init-plugin="select2" id="travel_from1" onchange="">
                                                                @foreach($states as $state)
                                                                    <option value="{{ $state->StateRef }}">{{ $state->State }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <div class="travel_to_state hide">
                                                            <label for="TravelTo">Travel To</label>
                                                            <select name="TravelToState" class="full-width travel_to_state" style="display: none" data-init-plugin="select2" id="travel_to1" onchange="">
                                                                @foreach($states as $state)
                                                                    <option value="{{ $state->StateRef }}">{{ $state->State }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                
                                                        <div class="travel_to_country hide">
                                                            <label for="TravelToCountry">Travel To</label>
                                                            <select name="TravelToCountry" class="full-width travel_to_country" style="display: none" data-init-plugin="select2" id="travel_to1" >
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country->CountryRef }}">{{ $country->Country }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                            <br>
                                    
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        {{ Form::label('DepartureDate', 'Departure Date') }}
                                                        <div class="input-group">
                                                            {{ Form::Date('DepartureDate', null, ['class' => 'form-control', 'id' => 'departure_date', 'placeholder' => 'Departure Date', 'required']) }}
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar">
                                                                </i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        {{ Form::label('DepartureTime', 'Departure Time' ) }}
                                                        {{ Form::time('DepartureTime', null, ['class' => 'form-control', 'id' => 'departure_time', 'placeholder' => 'Departure Time']) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        {{ Form::label('ArrivalDate', 'Arrival Date') }}
                                                        <div class="input-group">
                                                            {{ Form::Date('ArrivalDate', null, ['class' => 'form-control', 'id' => 'arrival_date', 'placeholder' => 'Arrival Date', 'required']) }}
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar">
                                                                </i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        {{ Form::label('ArrivalTime', 'Arrival Time' ) }}
                                                        {{ Form::time('ArrivalTime', null, ['class' => 'form-control', 'id' => 'arrival_time', 'placeholder' => 'Arrival Time']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <br>
                                    
                                        <div class="row">
                                
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        {{ Form::label('Purpose', 'Travel Purpose' ) }}
                                                        <select name="Purpose" class="full-width" data-init-plugin="select2" id="travel_purpose1" onchange="">
                                                            <option value=" ">Select Travel Purpose</option>
                                                            <option value="1">Training</option>
                                                            <option value="2">Conference</option>
                                                            <option value="3">Meeting</option>
                                                            <option value="4">Vacation</option>
                                                            <option value="5">Medical</option>
                                                            <option value="6">Systems Review</option>
                                                            <option value="7">Study Tour</option>
                                                            <option value="8">Feasibility Study</option>
                                                            <option value="9">Recruitment</option>
                                                            <option value="10">Business Development</option>
                                                            <option value="11">Awards</option>
                                                            <option value="12">Interviews</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="controls">
                                                    <div class="form-group">
                                                        {{ Form::label('PurposeDescription', 'Purpose Description' ) }}
                                                        {{ Form::textarea('PurposeDescription', null, ['class' => 'form-control', 'id' => 'purpose_description', 'placeholder' => 'Purpose Description', 'rows'=> '1']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
    
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="controls">
                                                    <div class="form-group">
                                                        {{ Form::label('TravelMode', 'Travel mode' ) }}
                                                        <select name="TravelMode" class="full-width" data-init-plugin="select2" id="travel_mode1" onchange="">
                                                            <option value=" ">Select Travel Mode</option>
                                                            @foreach($travelmodes as $travelmode)
                                                                <option value="{{ $travelmode->TravelModeRef }}">{{ $travelmode->TravelMode }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="controls">
                                                    <div class="form-group">
                                                        {{ Form::label('PreferredTransporter', 'Preffered Transporter' ) }}
                                                        <select name="PreferredTransporter" class="full-width" data-init-plugin="select2" id="preferred_transporter" onchange="">
                                                                <option value=" ">Select Transport Type</option>
                                                            @foreach($transports as $transport)
                                                                <option value="{{ $transport->TransporterRef }}">{{ $transport->Transporter }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="controls">
                                                    <div class="form-group">
                                                        {{ Form::label('OtherTransporter', 'Other Transporter' ) }}
                                                        {{ Form::textarea('OtherTransporter', null, ['class' => 'form-control', 'id' => 'other_transporter', 'placeholder' => 'Other Transporter', 'rows'=> '1']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <br>
                                    
    
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="controls">
                                                    <div class="form-group">
                                                        {{ Form::label('Lodging', 'Lodging' ) }}
                                                        <select name="Lodging" class="full-width" data-init-plugin="select2" id="lodging" onchange="">
                                                            <option value=" ">Preffered Lodge Type</option>
                                                            @foreach($lodges as $lodge)
                                                                <option value="{{ $lodge->TravelLodgeRef }}">{{ $lodge->TravelLodge }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        {{ Form::label('DestinationAddress', 'Destination Address' ) }}
                                                        {{ Form::textarea('DestinationAddress', null, ['class' => 'form-control', 'id' => 'destination_address', 'placeholder' => 'Destination Address', 'rows'=> '2']) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="controls">
                                                    <div class="form-group">
                                                        {{ Form::label('Approver', 'Approver' ) }}
                                                        <select name="Approver" class="full-width" data-init-plugin="select2" id="approver" onchange="">
                                                            <option value=" ">Select Approver</option>
                                                            @foreach($staffs as $staff)
                                                                <option value="{{ $staff->StaffRef }}">{{ $staff->FullName }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        {{ Form::label('ReferenceLetter', 'Reference Letter' ) }}
                                                        {{ Form::file('ReferenceLetter', null, ['class' => 'form-control', 'id' => 'reference_letter1', 'placeholder' => 'Upload Reference Letter', 'rows'=> '2']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                            <br>
                                    
                                        <div class="row">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit changes</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
      
      <!-- Modal -->
      
      
        


@endsection


@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>

<script>
    
    
    
    function find_travel_type()
    {
      var id = $('#travel_type').val();
      if(id == 1)
      {
        $('.travel_from_country').addClass('hide');
        $('.travel_from_state').removeClass('hide');
        $('.travel_to_country').addClass('hide');
        $('.travel_to_state').removeClass('hide');
      }else{
        $('.travel_from_country').addClass('hide');
        $('.travel_from_state').removeClass('hide');
        $('.travel_to_country').removeClass('hide');
        $('.travel_to_state').addClass('hide');
      }
    }


     $(function(){
        var options = {
            todayHighlight: true,
            autoclose:true,
            format: 'yyyy-mm-dd'
        };
        //  $('.dp').datepicker({autoclose:true});
        //  $('.dp-departure-date').datepicker({autoclose:true, format: 'yyyy-mm-dd', startDate: '2018-01-01'});
        //  $('.dp-arrival-date').datepicker({autoclose:true, format: 'yyyy-mm-dd', startDate: '2018-01-01'});
    });


    function edit_travelrequest(id)
    {
      
      $.get('/edit_travel_request/'+id, function(data, status) {

        $('#travel_type1').val(data.TravelType).trigger('change');

        $('#travel_from1').val(data.TravelFromState).trigger('change');

        $('#travel_to1').val(data.TravelToState).trigger('change');

        $('#travel_from1').val(data.TravelFromCountry).trigger('change');

        $('#travel_to1').val(data.TravelToCountry).trigger('change');

        $('#departure_date').val(data.DepartureDate);

        $('#departure_time').val(data.DepartureTime);

        $('#arrival_time').val(data.ArrivalTime);

        $('#arrival_date').val(data.ArrivalDate); 

        $('#travel_purpose1').val(data.Purpose).trigger('change');

        $('#purpose_description').val(data.PurposeDescription);

        $('#travel_mode1').val(data.TravelMode).trigger('change');

        $('#preferred_transporter').val(data.PreferredTransporter).trigger('change'); 

        $('#other_transporter').val(data.OtherTransporter);

        $('#lodging').val(data.Lodging).trigger('change');

        $('#destination_address').val(data.DestinationAddress);

        $('#approver').val(data.Approver).trigger('change');

        $('#reference_letter1').val(data.ReferenceLetter);

        $('#TravelRef').val(data.TravelRef);

        $('#form-edit').prop('action', '/submit_travel_request');
});
}

//      $(document).ready(function() {
//     $('#travelTable').DataTable( {
//         "scrollX": true
//     } );
// } );


    




</script>

@endpush