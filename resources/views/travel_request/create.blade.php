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

    .form-add-more{
      width: 20px;
      height: 20px;
      line-height: 20px;
      border-radius: 50%;
      text-align: center;
      padding: 0 !important;
      cursor: pointer;
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
        <li>
            <a data-toggle="tab" href="#sent-status">
                Sent Requests &nbsp; <span class="badge badge-success"> {{ count($sent_requests) }}</span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="onboarding-request" class="tab-pane fade in active">
            <div class="clearfix"></div>
            <div class="card-box">
                <div class="card-title">Travel Request</div>
                @include('errors.list')
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

                                 <div class="col-sm-3">
                                    <div class="form-group">
                                    {{ Form::label('DepartureDate', 'Departure Date' ) }}
                                    <div class="input-group date dp">
                                        {{ Form::text('DepartureDate', null, ['class' => 'form-control', 'placeholder' => 'Departure Date', 'required', 'id' => 'departure_date']) }}
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
    

                                <div class="col-sm-3">
                                    <div class="form-group">
                                    {{ Form::label('ArrivalDate', 'Arrival Date' ) }}
                                    <div class="input-group date dp2">
                                        {{ Form::text('ArrivalDate', null, ['class' => 'form-control', 'placeholder' => 'Arrival Date', 'required', 'id' => 'arrival_date']) }}
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
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
                                        {{ Form::label('PurposeID', 'Travel Purpose' ) }} <span style="padding: 0 !important" class="form-add-more add-purpose badge badge-success" data-toggle="modal" data-target="travel_purpose_setup"><i class="fa fa-plus"></i></span>
                                        <select name="PurposeID" class="full-width" style="display: none" id="travel_purpose" data-init-plugin="select2">
                                            @foreach($purpose as $item)
                                                <option value="{{ $item->TravelPurposeRef }}">{{ $item->TravelPurpose }}</option>
                                            @endforeach
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
                                        {{ Form::label('TravelMode', 'Travel mode' ) }} <span style="padding: 0 !important" class="form-add-more add-mode badge badge-success" data-toggle="modal" data-target="travel_mode_setup"><i class="fa fa-plus"></i></span>
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
                                            {{ Form::label('PreferredTransporter', 'Preffered Transporter' ) }} <span style="padding: 0 !important" class="form-add-more add-transporter badge badge-success" data-toggle="modal" data-target="transporter_setup"><i class="fa fa-plus"></i></span>
                                            <select name="PreferredTransporter" class="full-width" data-init-plugin="select2" id="preffered_transporter">
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
                                        {{ Form::label('Lodging', 'Lodging' ) }} <span style="padding: 0 !important" class="form-add-more add-lodge badge badge-success" data-toggle="modal" data-target="lodging_setup"><i class="fa fa-plus"></i></span>
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
                
                            {{-- <div class="col-md-3">
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
                            </div> --}}
                
                            <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="controls">
                                            {{ Form::label('ReferenceLetter', 'Supporting Document' ) }}
                                            {{ Form::file('ReferenceLetter', null, ['class' => 'form-control', 'placeholder' => 'Upload Reference Letter', 'rows'=> '2']) }}
                                        </div>
                                    </div>
                            </div>
                
                
                        </div>

                        <div class="card-section p-l-5">List Of Travellers</div>
                        <div class="">
                            <div class="btn-group" data-toggle="buttons" style="position: relative;">
                              <label class="btn staff_option_label btn-complete active">
                                <input type="radio" name="staff_options" id="staff_option" checked> Staff
                              </label>
                              <label class="btn staff_option_label btn-complete">
                                <input type="radio" name="staff_options" id="non_staff_option"> Non Staff
                              </label>
                            </div> <br> <br>

                            <div class="travellers-wrapper">
                                <div class="staff_option_template">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                 <label for="TravellerStaffID">Select Staff</label>
                                                {{ Form::select('TravellerStaffID[]', [ '' =>  'Select Staff'] + $staffs->pluck('FullName', 'StaffRef')->toArray(), null, ['class'=> "form-control full-width select2", 'data-init-plugin' => "select2"]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                           
                                            <div class="form-group">
                                                 <label for="TravellerCompany">Company</label>
                                                {{ Form::text('TravellerCompany[]', null, ['class'=> "form-control", 'placeholder' => 'Enter Company\'s Name' ]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-3 ">
                                            <div class="form-group">
                                                 <label for="TravellerPhone">Phone</label>
                                                {{ Form::text('TravellerPhone[]', null, ['class'=> "form-control", 'placeholder' => 'Enter Phone Number','minlength' => 11, 'maxlength' => 11, 'pattern'=> "\d+"]) }}
                                            </div>
                                        </div>



                                    </div>
                                    <div class="to-be-inserted"></div>
                                    <div class="form-group">
                                                <button type="button" style="margin-left: 7px"  class="add_staff_node btn btn-sm btn-info"><i class="fa fa-plus"></i></button>
                                            </div>
                                </div>  

                                <div class="non_staff_option_template">
                                    <div class="row">
                                        <div class="col-sm-3">
                                           
                                            <div class="form-group">
                                                 <label for="TravellerFullName">FullName</label>
                                                {{ Form::text('TravellerFullName[]', null, ['class'=> "form-control", 'placeholder' => 'Enter Non Staff\'s Full Name' ]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                           
                                            <div class="form-group">
                                                 <label for="TravellerCompany">Company</label>
                                                {{ Form::text('TravellerCompany[]', null, ['class'=> "form-control", 'placeholder' => 'Enter Company\'s Name' ]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-3 ">
                                            <div class="form-group">
                                                 <label for="TravellerPhone">Phone</label>
                                                {{ Form::text('TravellerPhone[]', null, ['class'=> "form-control", 'placeholder' => 'Enter Phone Number', 'minlength' => 11, 'maxlength' => 11,  'pattern'=> "\d+"]) }}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="to-be-inserted"></div>
                                    <div class="form-group">
                                                <button type="button" style="margin-left: 7px"  class="add_non_staff_node btn btn-sm btn-info"><i class="fa fa-plus"></i></button>
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
        


        <div id="onboarding-status" class="tab-pane ">        
                <div class="clearfix"></div>
            <div class="card-box">
                <div class="request-table table-responsive">
                    <table class="table tableWithSearch table-bordered" id="travelTable">
                        <thead>
                            <th width="5px">S/N</th>
                            <th style="width: 80px; word-break:break-all;">From</th>
                            <th style="width: 80px; word-break:break-all;">To</th>
                            <th>Travellers</th>
                            <th style="width: 120px; word-break:break-all;">Departure Date</th>
                            <th style="width: 80px; word-break:break-all;">Travel Purpose</th>
                            <th style="width: 80px; word-break:break-all;">Action</th>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            @foreach($travel_requests as $travel_request)
                                <?php $count = $count + 1; ?>
                                <tr>
                                    <th>{{ $count }}</th>
                                    <td>{{ $travel_request->TravelType == 1 ? $travel_request->travel_from_state->State : $travel_request->travel_from_state->State ?? '-' }}</td>
                                    <td>{{ $travel_request->TravelType == 1 ? $travel_request->travel_to_state->State : $travel_request->travel_to_country->Country ?? '-' }}</td>
                                    <td>
                                        @foreach($travel_request->travellers as $tr)

                                        @if($tr->StaffID != NULL)
                                        <span class="badge">
                                            <b>MESL STAFF:</b> {{ $tr->internel_traveller->FullName }}
                                        </span>
                                        @endif

                                        @if($tr->FullName != NULL)
                                        <span class="badge">
                                            <b>Visitor: </b>{{ $tr->FullName }}
                                        </span>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $travel_request->DepartureDate }}</td>
                                    <td>{{ $travel_request->travel_purpose->TravelPurpose ?? '-' }}</td>
                                    <td style="width: 20%">
                                        <span data-toggle="tooltip" data-placement="top" title="Edit">
                                                <button style="margin-right: 10px; display: inline-block" type="edit" class="btn btn-sm btn-primary toggler" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="edit_travelrequest( {{$travel_request->TravelRef}}); edit_travel_type()" @if($travel_request->SentForApproval) disabled @endif><i class="fa fa-edit"></i></button>
                                        </span>
            
                                        <a style="margin-right: 10px; display: inline-block" href="{{ route('delete', $travel_request->TravelRef) }}" type="edit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                
                                        <a href="{{ route('sendapproval', $travel_request->TravelRef) }}" type="submit" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Send for Approval" @if($travel_request->SentForApproval) disabled @endif><i class="fa fa-share-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    
            
        </div>

         <div id="sent-status" class="tab-pane ">        
                <div class="clearfix"></div>
            <div class="card-box">
                <div class="request-table table-responsive">
                    <table class="table tableWithSearch table-bordered" id="travelTable">
                        <thead>
                            <th width="5px">S/N</th>
                            <th style="width: 80px; word-break:break-all;">From</th>
                            <th style="width: 80px; word-break:break-all;">To</th>
                            <th>Travellers</th>
                            <th style="width: 120px; word-break:break-all;">Departure Date</th>
                            <th style="width: 80px; word-break:break-all;">Travel Purpose</th>
                            <th style="width: 80px; word-break:break-all;">Action</th>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            @foreach($sent_requests as $travel_request)
                                <?php $count = $count + 1; ?>
                                <tr>
                                    <th>{{ $count }}</th>
                                    <td>{{ $travel_request->TravelType == 1 ? $travel_request->travel_from_state->State : $travel_request->travel_from_state->State ?? '-' }}</td>
                                    <td>{{ $travel_request->TravelType == 1 ? $travel_request->travel_to_state->State : $travel_request->travel_to_country->Country ?? '-' }}</td>
                                    <td>
                                        @foreach($travel_request->travellers as $tr)

                                        @if($tr->StaffID != NULL)
                                        <span class="badge">
                                            <b>MESL STAFF:</b> {{ $tr->internel_traveller->FullName }}
                                        </span>
                                        @endif

                                        @if($tr->FullName != NULL)
                                        <span class="badge">
                                            <b>Visitor: </b>{{ $tr->FullName }}
                                        </span>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $travel_request->DepartureDate }}</td>
                                    <td>{{ $travel_request->travel_purpose->TravelPurpose ?? '-' }}</td>
                                    <td style="width: 20%">
                                        <span data-toggle="tooltip" data-placement="top" title="Edit">
                                                <button style="margin-right: 10px; display: inline-block" type="edit" class="btn btn-sm btn-primary toggler" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="edit_travelrequest( {{$travel_request->TravelRef}})" @if($travel_request->SentForApproval) disabled @endif><i class="fa fa-edit"></i></button>
                                        </span>
            
                                        <a style="margin-right: 10px; display: inline-block" href="{{ route('delete', $travel_request->TravelRef) }}" type="edit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                
                                        <a href="{{ route('sendapproval', $travel_request->TravelRef) }}" type="submit" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Send for Approval" @if($travel_request->SentForApproval) disabled @endif><i class="fa fa-share-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    
            
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
                                                <select name="TravelType" class="full-width" data-init-plugin="select2" id="travel_type_edit"  onchange="edit_travel_type()">
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
                                                    <select name="TravelFromCountry" class="full-width travel_from_country" style="display: none" data-init-plugin="select2" id="travel_from2" onchange="">
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
                                                    <select name="TravelToCountry" class="full-width travel_to_country" style="display: none" data-init-plugin="select2" id="travel_to2" onchange="">
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
                                                    {{ Form::label('PurposeID', 'Travel Purpose' ) }}
                                                    <select name="PurposeID" class="full-width" style="display: none" id="travel_purpose1" data-init-plugin="select2">
                                                        @foreach($purpose as $item)
                                                            <option value="{{ $item->TravelPurposeRef }}">{{ $item->TravelPurpose }}</option>
                                                        @endforeach
                                                    </select>
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

                                    {{-- <div class="col-md-3">
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
                                    </div> --}}

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="controls">
                                                {{ Form::label('ReferenceLetter', 'Reference Letter' ) }}
                                                {{ Form::file('ReferenceLetter', null, ['class' => 'form-control', 'id' => 'reference_letter1', 'placeholder' => 'Upload Reference Letter', 'rows'=> '2']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="card-section p-l-5">List Of Travellers</div>
                                    <div class="">
                                        <div class="btn-group" data-toggle="buttons" style="position: relative;">
                                            <label class="btn staff_option_label btn-complete active">
                                            <input type="radio" name="staff_options" id="staff_option" checked> Staff
                                            </label>
                                            <label class="btn staff_option_label btn-complete">
                                            <input type="radio" name="staff_options" id="non_staff_option"> Non Staff
                                            </label>
                                        </div> <br> <br>

                                        <div class="travellers-wrapper">
                                            <div class="staff_option_template">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                                <label for="TravellerStaffID">Select Staff</label>
                                                            {{ Form::select('TravellerStaffID[]', [ '' =>  'Select Staff'] + $staffs->pluck('FullName', 'StaffRef')->toArray(), null, ['class'=> "form-control full-width select2", 'id' => 'full_name', 'data-init-plugin' => "select2"]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        
                                                        <div class="form-group">
                                                                <label for="TravellerCompany">Company</label>
                                                            {{ Form::text('TravellerCompany[]', null, ['class'=> "form-control", 'id' => 'company_name', 'placeholder' => 'Enter Company\'s Name' ]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 ">
                                                        <div class="form-group">
                                                                <label for="TravellerPhone">Phone</label>
                                                            {{ Form::text('TravellerPhone[]', null, ['class'=> "form-control",'id' => 'staff_phone_number', 'placeholder' => 'Enter Phone Number','minlength' => 11, 'maxlength' => 11, 'pattern'=> "\d+"]) }}
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="to-be-inserted"></div>
                                                <div class="form-group">
                                                            <button type="button" style="margin-left: 7px"  class="add_staff_node btn btn-sm btn-info"><i class="fa fa-plus"></i></button>
                                                        </div>
                                            </div>  

                                            <div class="non_staff_option_template">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        
                                                        <div class="form-group">
                                                                <label for="TravellerFullName">FullName</label>
                                                            {{ Form::text('TravellerFullName[]', null, ['class'=> "form-control",'id' => 'non_staff_name', 'placeholder' => 'Enter Non Staff\'s Full Name' ]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        
                                                        <div class="form-group">
                                                                <label for="TravellerCompany">Company</label>
                                                            {{ Form::text('TravellerCompany[]', null, ['class'=> "form-control",'id' => 'non_staff_company', 'placeholder' => 'Enter Company\'s Name' ]) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 ">
                                                        <div class="form-group">
                                                                <label for="TravellerPhone">Phone</label>
                                                            {{ Form::text('TravellerPhone[]', null, ['class'=> "form-control",'id' => 'non_staff_number', 'placeholder' => 'Enter Phone Number', 'minlength' => 11, 'maxlength' => 11,  'pattern'=> "\d+"]) }}
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="to-be-inserted"></div>
                                                <div class="form-group">
                                                            <button type="button" style="margin-left: 7px"  class="add_non_staff_node btn btn-sm btn-info"><i class="fa fa-plus"></i></button>
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
      <!-- Modal -->

      {{-- Travel-purpose-setup --}}
      <div class="modal fade" id="travel_purpose_setup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Travel Purpose</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>
            <div class="modal-body">
                <form action="" method="POST" id="travel-purpose-form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('TravelPurpose', 'Travel Purpose' ) }}
                                    {{ Form::text('TravelPurpose', null, ['class' => 'form-control', 'placeholder' => 'Add Travel Purpose', 'required']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Everything works but form input not appending --}}

                    <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                       </div>
                </form>
            </div>
            </div>
        </div>
    </div>


    {{-- Travel-mode-setup --}}
    <div class="modal fade" id="travel_mode_setup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Travel Mode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>
            <div class="modal-body">
                <form action="" method="POST" id="travel-mode-form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('TravelMode', 'Travel Mode' ) }}
                                    {{ Form::text('TravelMode', null, ['class' => 'form-control', 'placeholder' => 'Add Travel Mode', 'required']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Everything works but form input not appending --}}

                    <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                       </div>
                </form>
            </div>
            </div>
        </div>
    </div>


    {{-- Travel-lodge-setup --}}
    <div class="modal fade" id="lodging_setup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Travel Lodge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>
            <div class="modal-body">
                <form action="" method="POST" id="travel-lodge-form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('TravelLodge', 'Travel Lodge' ) }}
                                    {{ Form::text('TravelLodge', null, ['class' => 'form-control', 'placeholder' => 'Add Travel Lodge', 'required']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Everything works but form input not appending --}}

                    <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="transporter_setup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Travel Transporter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <hr>
            <div class="modal-body">
                <form action="" method="POST" id="travel-transport-form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="controls">
                                    {{ Form::label('Transporter', 'Travel Transporter' ) }}
                                    {{ Form::text('Transporter', null, ['class' => 'form-control', 'placeholder' => 'Add Travel Transporter', 'required']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--Everything works but form input not appending --}}

                    <div class="row">
                            <div class="pull-right">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
            </div>
        </div>
    </div>
      
        


@endsection


@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
</script>

<script>

$('.add-transporter').click(function(e){
        e.preventDefault();
        $('#transporter_setup').show();
        $('#transporter_setup').modal('show');
        
    });

    var form1 = $("#travel-transport-form");
        form1.submit(function(e) {
        e.preventDefault();
        $.post('/api/add_travel_transport', {
            Transporter: $('#Transporter').val()
        }, function(data, textStatus, xhr) {
            if(data.success === true){
            $('#preffered_transporter').append('<option selected value="'+ data.data.TransporterRef +'">' +  data.data.Transporter +'</option>');
            $('#transporter_setup').modal('hide');
            swal(
                'Success',
                data.data.Transporter + ' was added to the list',
                'success'
            )
                $('#Transporter').val('');
                
            }
        });
    });

$('.add-purpose').click(function(e){
        e.preventDefault();
        $('#travel_purpose_setup').show();
        $('#travel_purpose_setup').modal('show');
        
    });

    var form1 = $("#travel-purpose-form");
        form1.submit(function(e) {
        e.preventDefault();
        $.post('/api/add_travel_purpose', {
            TravelPurpose: $('#TravelPurpose').val()
        }, function(data, textStatus, xhr) {
            if(data.success === true){
            $('#travel_purpose').append('<option selected value="'+ data.data.TravelPurposeRef +'">' +  data.data.TravelPurpose +'</option>');
            $('#travel_purpose_setup').modal('hide');
            swal(
                'Success',
                data.data.TravelPurpose + ' was added to the list',
                'success'
            )
                $('#TravelPurpose').val('');
                
            }
        });
    });


    $('.add-mode').click(function(e){
        e.preventDefault();
        $('#travel_mode_setup').show();
        $('#travel_mode_setup').modal('show');
        
    });

    var form1 = $("#travel-mode-form");
        form1.submit(function(e) {
        e.preventDefault();
        $.post('/api/add_travel_mode', {
            TravelMode: $('#TravelMode').val()
        }, function(data, textStatus, xhr) {
            if(data.success === true){
            $('#travel_mode').append('<option selected value="'+ data.data.TravelModeRef +'">' +  data.data.TravelMode +'</option>');
            $('#travel_mode_setup').modal('hide');
            swal(
                'Success',
                data.data.TravelMode + ' was added to the list',
                'success'
            )
                $('#TravelMode').val('');
                
            }
        });
    });


    $('.add-lodge').click(function(e){
        e.preventDefault();
        $('#lodging_setup').show();
        $('#lodging_setup').modal('show');
        
    });

    var form1 = $("#travel-lodge-form");
        form1.submit(function(e) {
        e.preventDefault();
        $.post('/api/add_travel_lodge', {
            TravelLodge: $('#TravelLodge').val()
        }, function(data, textStatus, xhr) {
            if(data.success === true){
            $('#Lodging').append('<option selected value="'+ data.data.TravelLodgeRef +'">' +  data.data.TravelLodge +'</option>');
            $('#lodging_setup').modal('hide');
            swal(
                'Success',
                data.data.TravelLodge + ' was added to the list',
                'success'
            )
                $('#TravelLodge').val('');
                
            }
        });
    });
    
    
    
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

    function edit_travel_type()
    {
      var id = $('#travel_type_edit').val();
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

        $('#travel_type_edit').val(data.TravelType).trigger('change');

        $('#travel_from1').val(data.TravelFromState).trigger('change');

        $('#travel_to1').val(data.TravelToState).trigger('change');

        $('#travel_from2').val(data.TravelFromCountry).trigger('change');

        $('#travel_to2').val(data.TravelToCountry).trigger('change');

        $('#departure_date_edit').val(data.DepartureDate);

        $('#departure_time').val(data.DepartureTime);

        $('#arrival_time').val(data.ArrivalTime);

        $('#arrival_date_edit').val(data.ArrivalDate); 

         var options = {
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            startDate: data.ArrivalDate,
            autoclose: true,
        };
        $('.dp3').datepicker(options);

        $('#travel_purpose1').val(data.PurposeID).trigger('change');

        $('#purpose_description').val(data.PurposeDescription);

        $('#travel_mode1').val(data.TravelMode).trigger('change');

        $('#preferred_transporter').val(data.PreferredTransporter).trigger('change'); 

        $('#other_transporter').val(data.OtherTransporter);

        $('#lodging').val(data.Lodging).trigger('change');

        $('#destination_address').val(data.DestinationAddress);

        $('#approver').val(data.Approver).trigger('change');

        $('#reference_letter1').val(data.ReferenceLetter);

        $('#full_name').val(data.TravellerStaffID).trigger('change');

        $('#company_name').val(data.TravellerCompany);

        $('#staff_phone_number').val(data.TravellerPhone);

        $('#non_staff_name').val(data.TravellerStaffID).trigger('change');

        $('#non_staff_compnay').val(data.TravellerCompany);

        $('#non_staff_number').val(data.TravellerPhone);



        $('#TravelRef').val(data.TravelRef);

        $('#form-edit').prop('action', '/submit_travel_request');
});
}

$(".non_staff_option_template").hide();
$('.staff_option_label').click(function(e) {
    // e.preventDefault();
    if($('#staff_option:checked').length > 0 || $('#staff_option').is(':checked')) {
    
        $(".staff_option_template").hide();
        $(".non_staff_option_template").show();
    } 
    if($('#non_staff_option:checked').length > 0 || $('#non_staff_option').is(':checked')) {
       
        $(".non_staff_option_template").hide();
        $(".staff_option_template").show();
    }

});


var staff_option_temp = `
<div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                 <label for="TravellerStaffID">Select Staff</label>
                                                {{ Form::select('TravellerStaffID[]', [ '' =>  'Select Staff'] + $staffs->pluck('FullName', 'StaffRef')->toArray(), null, ['class'=> "form-control full-width select2", 'data-init-plugin' => "select2"]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                           
                                            <div class="form-group">
                                                 <label for="TravellerCompany">Company</label>
                                                {{ Form::text('TravellerCompany[]', null, ['class'=> "form-control", 'placeholder' => 'Enter  Staff\'s Company' ]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-3 ">
                                            <div class="form-group">
                                                 <label for="TravellerPhone">Phone</label>
                                                {{ Form::text('TravellerPhone[]', null, ['class'=> "form-control", 'placeholder' => 'Enter Phone Number', 'minlength' => 11, 'maxlength' => 11, 'pattern'=> "\d+"]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <button type="button" style="margin-top: 30px"  class="remove_staff_node btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>


                                    </div>`;

 var non_staff_option_temp = `
<div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                 <label for="TravellerStaffID">Select Staff</label>
                                                 {{ Form::text('TravellerFullName[]', null, ['class'=> "form-control", "required", 'placeholder' => 'Enter Non Staff\'s Full Name' ]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                           
                                            <div class="form-group">
                                                 <label for="TravellerCompany">Company</label>
                                                {{ Form::text('TravellerCompany[]', null, ['class'=> "form-control", 'placeholder' => 'Enter Company\'s Name' ]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-3 ">
                                            <div class="form-group">
                                                 <label for="TravellerPhone">Phone</label>
                                                {{ Form::text('TravellerPhone[]', null, ['class'=> "form-control", 'placeholder' => 'Enter Phone Number', 'minlength' => 11, 'maxlength' => 11, 'pattern'=> "\d+"]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <button type="button" style="margin-top: 30px"  class="remove_staff_node btn btn-sm btn-danger"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>


                                    </div>`;                                   
$(".add_staff_node").click(function(e) {
    e.preventDefault();
    $('.staff_option_template').find('.to-be-inserted').append(staff_option_temp);
    $('.staff_option_template').find('select').select2();
});

$(".add_non_staff_node").click(function(e) {
    e.preventDefault();
    $('.non_staff_option_template').find('.to-be-inserted').append(non_staff_option_temp);
    $('.non_staff_option_template').find('select').select2();
});

$('body').on('click', '.remove_staff_node', function(e) {
    e.preventDefault();
    console.log('delete me')
    $(this).closest('.row').remove();
});

// make request queue tab active if url query says so

function activate_travel_request_queue(){
    let url = new URL(window.location.href);
    let queue = url.searchParams.get('queue'); 
    if(queue != null && queue == 1) {
        $('a[href="#onboarding-status"]').tab('show');
    }
}

$(document).ready(function() {
    activate_travel_request_queue();

     var options = {
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            startDate: '{{ date('Y-m-d') }}',
            autoclose: true,
        };
        $('.dp').datepicker(options);

        

        
});

window.enddate = function() {
            var options2 = {
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            startDate: $('#departure_date').val(),
            autoclose: true,
        };
        $('.dp2').datepicker(options2);
        }

        window.enddate2 = function() {
            $('#arrival_date_edit').val('');
            var options3 = {
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            startDate: $('#departure_date_edit').val(),
            autoclose: true,
        };
        $('.dp4').datepicker(options3);
        }

        $('#departure_date').change(function(e) {
            // e.preventDefault();
            window.enddate();
        });

        $('#departure_date_edit').change(function(e) {
            // e.preventDefault();
            $('#arrival_date_edit').parent().removeClass('dp3');
            window.enddate2();
        });



    




</script>

@endpush