@extends('layouts.master')

@section('title')

@endsection

@section('content')
  <div class="card-box">
    <div class="card-title">Review Bio-Data Changes - <span class="text-primary">{{ $pending->user->FullName }}</span></div>

    <img src="{{ asset('images/avatars/'.($pending->user->avatar ?? 'default.png') ) }}" alt="" class="avatar inline-block" style="height:100px; width:100px;">

    <table class="table table-condensed table-striped">
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
          <td>{!! ($pending->CountryOfBirth != $staff->CountryOfBirth)? $pending->country_of_birth->Country : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Country of Origin</td>
          <td>{{ $staff->country_origin->Country ?? '-' }}</td>
          <td>{!! ($pending->CountryOfOrigin != $staff->CountryOfOrigin)? $pending->country_origin->Country : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Religion</td>
          <td>{{ $staff->religion->Religion ?? '-' }}</td>
          <td>{!! ($pending->ReligionID != $staff->ReligionID)? $pending->religion->Religion : '<em class="text-muted">Unchanged</em>' !!}</td>
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
          <td>{{ $staff->MaritalStatus ?? '-' }}</td>
          <td>{!! ($pending->MaritalStatus != $staff->MaritalStatus)? $pending->MaritalStatus : '<em class="text-muted">Unchanged</em>' !!}</td>
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
          <td>{{ $staff->DateofBirth ?? '-' }}</td>
          <td>{!! ($pending->DateofBirth != $staff->DateofBirth)? $pending->DateofBirth : '<em class="text-muted">Unchanged</em>' !!}</td>
          <td></td>
        </tr>
        <tr>
          <td>Home Phone</td>
          <td>{{ $staff->HomePhone ?? '-' }}</td>
          <td>{!! ($pending->HomePhone != $staff->HomePhone)? $pending->HomePhone : '<em class="text-muted">Unchanged</em>' !!}</td>
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
