@extends('layouts.master')

@section('content')
<div class="container-fluid container-fixed-lg bg-white">
	<!-- START PANEL -->
	<div class="panel panel-transparent">
		<div class="panel-heading">
			<div class="panel-title">
			Customer Listing
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="panel-body">
			 @foreach($customers as $customer)

             <div class="thumbnail-wrapper d48 circular bordered b-white">
            <img data-src-retina="../images/customers/{{ $customer->PassportLocation }}" data-src="../images/customers/{{ $customer->PassportLocation }}" src="../images/customers/{{ $customer->PassportLocation }}">
            </div><div class="clearfix"></div>
            <div class="row">
                <div class="col-md-3">
                    <h4>Lastname</h4>
                    <p><b>{{ $customer->LastName }}</b></p>
                </div>
                 <div class="col-md-3">
                    <h4>Middlename</h4>
                    <p><b>{{ $customer->MiddleName }}</b></p>
                </div>
                 <div class="col-md-3">
                    <h4>FIrstname</h4>
                    <p><b>{{ $customer->FirstName }}</b></p>
                </div>
                <div class="col-md-3">
                    <h4>Gender</h4>
                    <p><b>{{ $customer->Gender }}</b></p>
                </div><div class="clearfix"></div><hr>
                <div class="col-md-3">
                    <h4>Telephone</h4>
                    <p><b>{{ $customer->Telephone }}</b></p>
                </div>
                <div class="col-md-3">
                    <h4>Birthday</h4>
                    <p><b>{{ $customer->DOB }}</b></p>
                </div>
                <div class="col-md-3">
                    <h4>Local Government</h4>
                    <p><b>{{ $customer->LGA }}</b></p>
                </div>
                <div class="col-md-3">
                    <h4>State of Origin</h4>
                    <p><b>{{ $customer->StateOfOrigin }}</b></p>
                </div><div class="clearfix"></div><hr>
                <div class="col-md-3">
                    <h4>Email Address</h4>
                    <p><b>{{ $customer->Email }}</b></p>
                </div>
                <div class="col-md-3">
                    <h4>Occupation</h4>
                    <p><b>{{ $customer->Occupation }}</b></p>
                </div>
                 <div class="col-md-3">
                    <h4>Marital Status</h4>
                    <p><b>{{ $customer->Status }}</b></p>
                </div>
                <div class="col-md-3">
                    <h4>Nationality</h4>
                    <p><b>{{ $customer->Country }}</b></p>
                </div><div class="clearfix"></div><hr>
                <div class="col-md-6">
                    <h4>Home Address </h4>
                    <p><b>{{ $customer->HomeAddress  }}</b></p>
                </div>
                <div class="col-md-6">
                    <h4>Shop Address</h4>
                    <p><b>{{ $customer->ShopAddress }}</b></p>
                </div><div class="clearfix"></div><hr>
                 <div class="col-md-4">
                    <h4>Means of Identification</h4>
                    <p><b>{{ $customer->Identification }}</b></p>
                </div>
                <div class="col-md-4">
                    <h4>Customer Maiden Name</h4>
                    <p><b>{{ $customer->CustomerMaidenName }}</b></p>
                </div>
                 <div class="col-md-4">
                    <h4>Spouse Name</h4>
                    <p><b>{{ $customer->SpouseName }}</b></p>
                </div><div class="clearfix"></div><hr>
                 <div class="col-md-4">
                    <h4>Spouse Phone Number</h4>
                    <p><b>{{ $customer->SpousePhone }}</b></p>
                </div>
                 <div class="col-md-8">
                    <h4>Spouse Address</h4>
                    <p><b>{{ $customer->SpouseAddress }}</b></p>
                </div><div class="clearfix"></div><hr>
                 <div class="col-md-3">
                    <h4>Next of Kin Name</h4>
                    <p><b>{{ $customer->NextOfKinName }}</b></p>
                </div>
                  <div class="col-md-3">
                    <h4>Next of Kin Phone</h4>
                    <p><b>{{ $customer->NextOfKinPhone }}</b></p>
                </div>
                <div class="col-md-6">
                    <h4>Next of Kin Address</h4>
                    <p><b>{{ $customer->NextOfKinAddress }}</b></p>
                </div><div class="clearfix"></div><hr>
                 <div class="col-md-6">
                    <h4>BVN</h4>
                    <p><b>{{ $customer->BVN }}</b></p>
                </div>
            </div>
             @endforeach
		</div>
	</div>
	<!-- END PANEL -->
</div>
@endsection
