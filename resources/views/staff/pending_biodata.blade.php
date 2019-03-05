@extends('layouts.master')

@section('title')

@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Review Bio-Data Changes - <span class="text-primary">{{ $pending->user->FullName }}</span></div>

    <img src="{{ asset('images/avatars/'.($pending->user->avatar ?? 'default.png') ) }}" alt="" class="avatar inline-block" style="height:100px; width:100px;"> <br><br>

    <div>Staff Supervisor: <b>{{ $pending->supervisor->FullName ?? 'none' }}</b> | Department: <b>{{ $staff->department->Department ?? '-' }}</b></div>
    <table class="table table-condensed biodata_list table-striped">
      <thead>
        <tr>
          <th>Field</th>
          <th>Old Value</th>
          <th>New Value</th>
          <th width="5%">Actions</th>
        </tr>
      </thead>
      <tbody>
        {{-- {{ dd($pending->all()[0]->getAttributes()) }} --}}

        {{-- @foreach ($pending2->all()[0]->getAttributes() as $key=>$value)
          <tr>
            <td style="background-color:#ffffdd !important">{{ $key }}</td>
            <td>{{ $value }}</td>
            <td>{{ $value }}</td>
            <td></td>
          </tr>
        @endforeach --}}


        <tr>
          <td>First Name</td>
          <td>{{ $staff->FirstName ?? '-' }}</td>
          <td>{!! ($pending->FirstName != $staff->FirstName)? $pending->FirstName : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Middle Name</td>
          <td>{{ $staff->MiddleName ?? '-' }}</td>
          <td>{!! ($pending->MiddleName != $staff->MiddleName)? $pending->MiddleName : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Last Name</td>
          <td>{{ $staff->LastName ?? '-' }}</td>
          <td>{!! ($pending->LastName != $staff->LastName)? $pending->LastName : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Gender</td>
          <td>{{ $staff->gender->Gender ?? '-' }}</td>
          <td>{!! ($pending->Gender != $staff->Gender)? $pending->gender->Gender : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Personal Email</td>
          <td>{{ $staff->PersonalEmail ?? '-' }}</td>
          <td>{!! ($pending->PersonalEmail != $staff->PersonalEmail)? $pending->PersonalEmail : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>State of Origin</td>
          <td>{{ $staff->state_of_origin->State ?? '-' }}</td>
          <td>{!! ($pending->StateofOrigin != $staff->StateofOrigin)? $pending->state_of_origin->State : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>

        <tr>
          <td>City of Birth</td>
          <td>{{ $staff->CityOfBirth ?? '-' }}</td>
          <td>{!! ($pending->CityOfBirth != $staff->CityOfBirth)? $pending->CityOfBirth : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Country of Birth</td>
          <td>{{ $staff->country_of_birth->Country ?? '-' }}</td>
          <td>{!! ($pending->CountryOfBirth != $staff->CountryOfBirth)? $pending->country_of_birth->Country ?? '-' : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Country of Origin</td>
          <td>{{ $staff->country_of_origin->Country ?? '-' }}</td>
          <td>{!! ($pending->CountryOfOrigin != $staff->CountryOfOrigin)? $pending->country_of_origin->Country ?? '-' : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Religion</td>
          <td>{{ $staff->religion->Religion ?? '-' }}</td>
          <td>{!! ($pending->ReligionID != $staff->ReligionID)? $pending->religion->Religion ?? '-' : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>HMO</td>
          <td>{{ $staff->HMOID ?? '-' }}</td>
          <td>{!! ($pending->HMOID != $staff->HMOID)? $pending->HMOID : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>HMO Number</td>
          <td>{{ $staff->HMONumber ?? '-' }}</td>
          <td>{!! ($pending->HMONumber != $staff->HMONumber)? $pending->HMONumber : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>No. Of Children</td>
          <td>{{ $staff->NoofChildren ?? '-' }}</td>
          <td>{!! ($pending->NoofChildren != $staff->NoofChildren)? $pending->NoofChildren : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Marital Status</td>
          <td>{{ $staff->marital_status->MaritalStatus ?? '-' }}</td>
          <td>{!! ($pending->MaritalStatusID != $staff->MaritalStatusID)? $pending->marital_status->MaritalStatus ?? '-' : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Spouse Surname</td>
          <td>{{ $staff->SpouseSurname ?? '-' }}</td>
          <td>{!! ($pending->SpouseSurname != $staff->SpouseSurname)? $pending->SpouseSurname : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Spouse Othername</td>
          <td>{{ $staff->SpouseOthername ?? '-' }}</td>
          <td>{!! ($pending->SpouseOthername != $staff->SpouseOthername)? $pending->SpouseOthername : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Date of Birth</td>
          <td>{{ nice_date($staff->DateofBirth) ?? '-' }}</td>
          <td>{!! ($pending->DateofBirth != $staff->DateofBirth)? nice_date($pending->DateofBirth) : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Home Phone</td>
          <td>{{ $staff->HomePhone ?? '-' }}</td>
          <td>{!! ($pending->HomePhone != $staff->HomePhone)? $pending->HomePhone : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Employment Date</td>
          <td>{{ nice_date($staff->EmploymentDate) ?? '-' }}</td>
          <td>{!! ($pending->EmploymentDate != $staff->EmploymentDate)? nice_date($pending->EmploymentDate) : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Confirmation Date</td>
          <td>{{ nice_date($staff->ConfirmationDate) ?? '-' }}</td>
          <td>{!! ($pending->ConfirmationDate != $staff->ConfirmationDate)? nice_date($pending->ConfirmationDate) : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Residential Address</td>
          <td>{{ $staff->AddressLine1 ?? '-' }}</td>
          <td>{!! ($pending->AddressLine1 != $staff->AddressLine1)? $pending->AddressLine1 : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Next Of Kin</td>
          <td>{{ $staff->NextofKIN ?? '-' }}</td>
          <td>{!! ($pending->NextofKIN != $staff->NextofKIN)? $pending->NextofKIN : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Next Of Kin's Phone</td>
          <td>{{ $staff->NextofKIN_Phone ?? '-' }}</td>
          <td>{!! ($pending->NextofKIN_Phone != $staff->NextofKIN_Phone)? $pending->NextofKIN_Phone : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Next Of Kin's Email</td>
          <td>{{ $staff->NextofKIN_Email ?? '-' }}</td>
          <td>{!! ($pending->NextofKIN_Email != $staff->NextofKIN_Email)? $pending->NextofKIN_Email : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
       {{--  <tr>
          <td>Next Of Beneficiary</td>
          <td>{{ $staff->Beneficiary ?? '-' }}</td>
          <td>{!! ($pending->Beneficiary != $staff->Beneficiary)? $pending->Beneficiary : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Beneficiary Relationship</td>
          <td>{{ $staff->BeneficiaryRelationship ?? '-' }}</td>
          <td>{!! ($pending->BeneficiaryRelationship != $staff->BeneficiaryRelationship)? $pending->BeneficiaryRelationship : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Beneficiary Phone</td>
          <td>{{ $staff->BeneficiaryPhone ?? '-' }}</td>
          <td>{!! ($pending->BeneficiaryPhone != $staff->BeneficiaryPhone)? $pending->BeneficiaryPhone : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Beneficiary Email</td>
          <td>{{ $staff->Beneficiary_Email ?? '-' }}</td>
          <td>{!! ($pending->Beneficiary_Email != $staff->Beneficiary_Email)? $pending->Beneficiary_Email : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Beneficiary Address</td>
          <td>{{ $staff->Beneficiary_Address ?? '-' }}</td>
          <td>{!! ($pending->Beneficiary_Address != $staff->Beneficiary_Address)? $pending->Beneficiary_Address : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td> --}}
        </tr>
        <tr>
          <td>University Attended (1st Degree)</td>
          <td>{{ $staff->UniversityAttended1 ?? '-' }}</td>
          <td>{!! ($pending->UniversityAttended1 != $staff->UniversityAttended1)? $pending->UniversityAttended1 : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>University Attended (2nd Degree)</td>
          <td>{{ $staff->UniversityAttended2 ?? '-' }}</td>
          <td>{!! ($pending->UniversityAttended2 != $staff->UniversityAttended2)? $pending->UniversityAttended2 : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>University Attended (3rd Degree)</td>
          <td>{{ $staff->UniversityAttended3 ?? '-' }}</td>
          <td>{!! ($pending->UniversityAttended3 != $staff->UniversityAttended3)? $pending->UniversityAttended3 : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Professional Qualification (1st Degree)</td>
          <td>{{ $staff->ProfessionalQualification1 ?? '-' }}</td>
          <td>{!! ($pending->ProfessionalQualification1 != $staff->ProfessionalQualification1)? $pending->ProfessionalQualification1 : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Professional Qualification (2nd Degree)</td>
          <td>{{ $staff->ProfessionalQualification2 ?? '-' }}</td>
          <td>{!! ($pending->ProfessionalQualification2 != $staff->ProfessionalQualification2)? $pending->ProfessionalQualification2 : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Professional Qualification (3rd Degree)</td>
          <td>{{ $staff->ProfessionalQualification3 ?? '-' }}</td>
          <td>{!! ($pending->ProfessionalQualification3 != $staff->ProfessionalQualification3)? $pending->ProfessionalQualification3 : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>NYSC Year</td>
          <td>{{ $staff->NYSCYear ?? '-' }}</td>
          <td>{!! ($pending->NYSCYear != $staff->NYSCYear)? $pending->NYSCYear : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        </tr>
        <tr>
          <td>NYSC Number</td>
          <td>{{ $staff->NYSCNumber ?? '-' }}</td>
          <td>{!! ($pending->NYSCNumber != $staff->NYSCNumber)? $pending->NYSCNumber : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>NYSC Location</td>
          <td>{{ $staff->NYSCLocationID ?? '-' }}</td>
          <td>{!! ($pending->NYSCLocationID != $staff->NYSCLocationID)? $pending->nysc_location->State ?? '-' : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        
        
      </tbody>
    </table>

    <div class="text-center" style="margin: auto">
      <a class="btn btn-success btn-cons btn-lg m-r-20" onclick="confirm2('Approve Changes?', '', 'form_approve')">Approve</a>
      <a class="btn btn-danger btn-cons btn-lg" onclick="confirm2('Reject Changes?', '', 'form_reject')">Reject</a>

      <form id="form_approve" class="hidden" action="{{ route('approve_biodata', $pending->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
      </form>
      <form id="form_reject" class="hidden" action="{{ route('reject_biodata', $pending->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
      </form>
    </div>

  </div>
@endsection

@push('scripts')
<script>
  $(function(){
    $('.biodata_list').DataTable({
      paging: false
    });
  })
</script>
@endpush
