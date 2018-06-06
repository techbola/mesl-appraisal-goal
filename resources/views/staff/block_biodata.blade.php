{{-- Start Profile --}}
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
    <h5>{{ $staff->Religion ?? '&mdash;' }}</h5>
  </div>
</div>

<div class="row m-b-10">
  <div class="col-md-4">
    <span class="bio-label">Marital Status</span>
    <h5>{{ $staff->MaritalStatus ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">No. Of Children</span>
    <h5>{{ $staff->NoofChildren ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">Town / City</span>
    <h5>{{ $staff->TownCity ?? '&mdash;' }}</h5>
  </div>
</div>

<div class="row m-b-10">
  <div class="col-md-4">
    <span class="bio-label">State</span>
    <h5>{{ $staff->State ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">Country</span>
    <h5>{{ $staff->Country ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">Address 1</span>
    <h5>{{ $staff->AddressLine1 ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">Address 2</span>
    <h5>{{ $staff->AddressLine2 ?? '&mdash;' }}</h5>
  </div>
</div>

<div class="row m-b-10">
  <div class="col-md-4">
    <span class="bio-label">HMO</span>
    <h5>{{ $staff->HMO ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">HMO Plan</span>
    <h5>{{ $staff->HMOPlan ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">HMO Number</span>
    <h5>{{ $staff->HMONumber ?? '&mdash;' }}</h5>
  </div>
</div>

<div class="row m-b-10">
  <div class="col-md-4">
    <span class="bio-label">Next Of Kin</span>
    <h5>{{ $staff->NextofKIN ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">Next Of Kin Phone</span>
    <h5>{{ $staff->NextofKIN_Phone ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">Next Of Kin Email</span>
    <h5>{{ $staff->NextofKIN_Email ?? '&mdash;' }}</h5>
  </div>
</div>

<div class="row m-b-10">
  <div class="col-md-4">
    <span class="bio-label">Beneficiary</span>
    <h5>{{ $staff->Beneficiary ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">Beneficiary Phone</span>
    <h5>{{ $staff->Beneficiary_Phone ?? '&mdash;' }}</h5>
  </div>
  <div class="col-md-4">
    <span class="bio-label">Beneficiary Email</span>
    <h5>{{ $staff->Beneficiary_Email ?? '&mdash;' }}</h5>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <span class="bio-label">Beneficiary Address</span>
    <h5>{{ $staff->Beneficiary_Address ?? '&mdash;' }}</h5>
  </div>
</div>
{{-- End Profile --}}
