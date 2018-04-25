<div class="modal fade" id="new_contact">
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
        <table class="table table-striped table-bordered">
          <tr>
            <th width="40%">Position</th>
            <td>@{{ contact.Position }}</td>
          </tr>
          <tr>
            <th>Department</th>
            <td>@{{ contact.Department }}</td>
          </tr>
          <tr>
            <th>Organization</th>
            <td>@{{ contact.Organization }}</td>
          </tr>
          <tr>
            <th>OfficeEmail</th>
            <td>@{{ contact.OfficeEmail }}</td>
          </tr>
          <tr>
            <th>PersonalEmail</th>
            <td>@{{ contact.PersonalEmail }}</td>
          </tr>
          <tr>
            <th>Address</th>
            <td>@{{ contact.Address }}</td>
          </tr>
          <tr>
            <th>Mobile Phone 1</th>
            <td>@{{ contact.MobilePhone1 }}</td>
          </tr>
          <tr>
            <th>Mobile Phone 2</th>
            <td>@{{ contact.MobilePhone2 }}</td>
          </tr>
          <tr>
            <th>Office Phone 1</th>
            <td>@{{ contact.OfficePhone1 }}</td>
          </tr>
          <tr>
            <th>Office Phone 2</th>
            <td>@{{ contact.OfficePhone2 }}</td>
          </tr>
          <tr>
            <th>DirectLine</th>
            <td>@{{ contact.DirectLine }}</td>
          </tr>
          <tr>
            <th>Fax</th>
            <td>@{{ contact.Fax }}</td>
          </tr>
          <tr>
            <th>Skype</th>
            <td>@{{ contact.Skype }}</td>
          </tr>
          <tr>
            <th>Account Flag</th>
            <td v-html="contact.AccountFlag"></td>
          </tr>

        </table>
      </div>
    </div>
  </div>
</div>
