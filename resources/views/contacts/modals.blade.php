<div class="modal fade" id="new_contact" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">New Business Contact</h5>
      </div>
      <div class="modal-body">
        @include('errors.list')
        {!! Form::open(['action' => 'CustomerController@save_contact', 'role' => 'form']) !!}
        @include('contacts.form')
        <div class="text-right m-t-10">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Submit</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="view_contact" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="card-title">@{{ contact.Customer }}</h5>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <tr>
            <td>Position</td>
            <td>@{{ contact.Position }}</td>
          </tr>
          <tr>
            <td>Department</td>
            <td>@{{ contact.Department }}</td>
          </tr>
          <tr>
            <td>Organization</td>
            <td>@{{ contact.Organization }}</td>
          </tr>
          <tr>
            <td>OfficeEmail</td>
            <td>@{{ contact.OfficeEmail }}</td>
          </tr>
          <tr>
            <td>PersonalEmail</td>
            <td>@{{ contact.PersonalEmail }}</td>
          </tr>
          <tr>
            <td>Address</td>
            <td>@{{ contact.Address }}</td>
          </tr>
          <tr>
            <td>Mobile Phone 1</td>
            <td>@{{ contact.MobilePhone1 }}</td>
          </tr>
          <tr>
            <td>Mobile Phone 2</td>
            <td>@{{ contact.MobilePhone2 }}</td>
          </tr>
          <tr>
            <td>Office Phone 1</td>
            <td>@{{ contact.OfficePhone1 }}</td>
          </tr>
          <tr>
            <td>Office Phone 2</td>
            <td>@{{ contact.OfficePhone2 }}</td>
          </tr>
          <tr>
            <td>DirectLine</td>
            <td>@{{ contact.DirectLine }}</td>
          </tr>
          <tr>
            <td>Fax</td>
            <td>@{{ contact.Fax }}</td>
          </tr>
          <tr>
            <td>Skype</td>
            <td>@{{ contact.Skype }}</td>
          </tr>

        </table>
      </div>
    </div>
  </div>
</div>
