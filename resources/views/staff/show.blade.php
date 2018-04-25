@extends('layouts.master')

@section('content')
  <style media="screen">
  .bio-label {
    font-weight: bold;
    font-size: 15px;
  }
  /* .card-box:nth-child(odd) {

  } */
  </style>

    {{-- START CARD --}}
    <div class="card-box">
      <div class="p-l-20 p-r-20">
        <div class="card-title pull-left">
          {{ $staff->FullName }}'s BioData
        </div>
        <div class="pull-right">
          <a href="{{ route('staff.edit_biodata',[$detail->StaffRef]) }}" title="" class="btn btn-info btn-cons" id="show-modal">
            <i class="fa fa-plus"></i>
            Edit Details
          </a>
        </div>
        <div class="clearfix"></div>

        <div class="m-b-10">
          <img src="{{ asset('images/avatars/'.$staff->user->avatar()) }}" class="avatar" height="120px" width="120px">
        </div>

        <table class="table table-striped table-condensed hidden">
          <tr>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
          </tr>
          <tr>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
            <td>
              <span class="bio-label">First Name</span>
              <h5>{{ $staff->FirstName }}</h5>
            </td>
          </tr>
        </table>

        <div class="row m-b-10 m-t-20">
          <div class="col-md-4">
            <span class="bio-label">First Name</span>
            <h5>{{ $staff->FirstName }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Middle Name</span>
            <h5>{{ $staff->MiddleName }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Last Name</span>
            <h5>{{ $staff->LastName }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">Personal Email</span>
            <h5>{{ $staff->PersonalEmail ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Date of Birth</span>
            <h5>{{ $staff->DateofBirth ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Home Phone</span>
            <h5>{{ $staff->HomePhone ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">Mobile Phone</span>
            <h5>{{ $staff->MobilePhone ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Work Phone</span>
            <h5>{{ $staff->WorkPhone ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Religion</span>
            <h5>{{ $detail->Religion ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">Marital Status</span>
            <h5>{{ $detail->MaritalStatus ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">No. Of Children</span>
            <h5>{{ $staff->NoofChildren ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Town / City</span>
            <h5>{{ $detail->TownCity ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">State</span>
            <h5>{{ $detail->State ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Country</span>
            <h5>{{ $detail->Country ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Address 1</span>
            <h5>{{ $detail->AddressLine1 ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Address 2</span>
            <h5>{{ $detail->AddressLine2 ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">HMO</span>
            <h5>{{ $detail->HMO ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">HMO Plan</span>
            <h5>{{ $detail->HMOPlan ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">HMO Number</span>
            <h5>{{ $detail->HMONumber ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">Next Of Kin</span>
            <h5>{{ $detail->NextofKIN ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Next Of Kin Phone</span>
            <h5>{{ $detail->NextofKIN_Phone ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Next Of Kin Email</span>
            <h5>{{ $detail->NextofKIN_Email ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row m-b-10">
          <div class="col-md-4">
            <span class="bio-label">Beneficiary</span>
            <h5>{{ $detail->Beneficiary ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Beneficiary Phone</span>
            <h5>{{ $detail->Beneficiary_Phone ?? '&mdash;' }}</h5>
          </div>
          <div class="col-md-4">
            <span class="bio-label">Beneficiary Email</span>
            <h5>{{ $detail->Beneficiary_Email ?? '&mdash;' }}</h5>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <span class="bio-label">Beneficiary Address</span>
            <h5>{{ $detail->Beneficiary_Address ?? '&mdash;' }}</h5>
          </div>
        </div>

      </div>
    </div>
    {{-- END CARD --}}

  @endsection
