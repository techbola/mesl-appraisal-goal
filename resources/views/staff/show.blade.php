@extends('layouts.master')

@section('content')
<div class="container-fluid container-fixed-lg bg-white">
    <!-- START PANEL -->
    <div class="panel panel-transparent">
        <div class="panel-body">
            @foreach($details as $detail)
            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <h3>
                        Bio - Data
                    </h3>
                    <div class="pull-right">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-cons" id="show-modal">
                                <i class="fa fa-plus">
                                </i>
                                <a href="{{ route('staff.bio_data_details',[$detail->StaffRef]) }}" title="">
                                    <span style="color : #fff">
                                        Edit Details
                                    </span>
                                </a>
                            </button>
                        </div>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Lastname
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->name }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Middlename
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->MiddleName }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Firstname
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->FirstName }}
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Staff Number
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->EmployeeNumber }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Job Title
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->JobTitle }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                No Of Leave Days
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->LeaveDays }}
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Company Email Address
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->email }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Personal Email Address
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->PersonalEmail }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Date of Birth
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->DateofBirth }}
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Mobile Number
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->MobilePhone }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Home Telephone Number
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->HomePhone }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Office Telephone Number
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->WorkPhone }}
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Address 1
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->AddressLine1 }}
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Address 2
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->AddressLine2 }}
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Religion
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->Religion }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Town / City
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->TownCity }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                State Of Origin
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->State }}
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Country
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->Country }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Marital Status
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->MaritalStatus }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Number of Children
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->NoofChildren }}
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <h3>
                            HMO Details
                        </h3><hr>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                HMO
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->HMO }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                HMO Plan
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->HMOPlan }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                HMO Number
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->HMONumber}}
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <h3>
                            Next of Kin & Beneficiary Details
                        </h3><hr>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Name of Next Of Kin
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->NextofKIN }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Next of Kin Phone Number
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->NextofKIN_Phone }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Next of Kin Email Address
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->NextofKIN_Email}}
                            </h5>
                        </div>
                        <div class="col-md-12">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Next of Kin Address
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->NextofKIN_Address}}
                            </h5>
                        </div><br><hr>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Name of Beneficiary
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->Beneficiary }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Beneficiary Phone Number
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->Beneficiary_Phone }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Beneficiary Email Address
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->Beneficiary_Email}}
                            </h5>
                        </div>
                        <div class="col-md-12">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Beneficiary Address
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->Benficiary_Address}}
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <h3>
                            Company Details
                        </h3><hr>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Employment Date
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->EmploymentDate }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Confirmation Date
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->ConfirmationDate }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Employment Status
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->EmploymentStatus}}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Department
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->Department}}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Unit
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->Unit }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Role
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->name }}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Position
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->Position}}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Grade Level
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->GradeLevel}}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Bank Name
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->BankName}}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Bank Account Number
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->BankAcctNumber}}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Pension Fund Administrator
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->PFA}}
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <label for="" style="font-weight: bold; font-size: 17px;">
                                Pension RSA Number
                            </label>
                            <h5 style="color : #6D5CAE">
                                {{ $detail->PensionRSANumber}}
                            </h5>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- END PANEL -->
    </div><br><br><br>
    @endsection
</div>