<div class="row hidden">

  <div class="col-md-4">
    <div class="form-group">
      <label>First Name</label>
      <input type="text" class="form-control" placeholder="First name" name="FirstName">
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-group">
      <label>Middle Name</label>
      <input type="text" class="form-control" placeholder="Middle name" name="MiddleName">
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-group">
      <label>Last Name</label>
      <input type="text" class="form-control" placeholder="Last name" name="LastName">
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-group">
      <label>Gender</label>
      <select class="full-width" name="GenderID" data-init-plugin="select2">
        <option value="">Select one</option>
        @foreach ($genders as $gender)
          <option value="{{ $gender->GenderRef }}">{{ $gender->Gender }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-group">
      <label>Phone</label>
      <input type="tel" class="form-control" id="" placeholder="Your phone number" name="Phone">
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-group">
      <label>Email</label>
      <input type="email" class="form-control" id="" placeholder="Email address" name="Email">
    </div>
  </div>

</div>

{{-- Row 2 --}}
<div class="row hidden">

  <div class="col-md-6">
    <div class="form-group">
      <label>Nationality</label>
      <select class="form-control select2" name="CountryID" data-init-plugin="select2">
        <option value="">Select Country</option>
        @foreach ($countries as $country)
          <option value="{{ $country->CountryRef }}">{{ $country->Country }}</option>
        @endforeach
      </select>
    </div>
  </div>


  <div class="col-md-6">
    <div class="form-group">
      <label>Birth Date</label>
      <div class="input-group date dp">
        <input type="text" class="form-control" name="BirthDate" value="">
        <span class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </span>
      </div>
    </div>
  </div>


</div>
{{-- End First Row --}}
