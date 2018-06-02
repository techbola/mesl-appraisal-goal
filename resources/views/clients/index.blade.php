@extends('layouts.master')

@section('title')
  Clients Management
@endsection

@section('content')
  <div class="clearfix m-b-20">
    <button class="c-btn c-btn--info pull-right" data-toggle="modal" data-target="#new_client">New Client</button>
  </div>

  <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Clients Management</div>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>
    </div>

    <table class="table tableWithSearch table-striped table-condensed">
      <thead>
        <tr>
          <th>Client Name</th>
          <th>Projects</th>
          <th>Date Added</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($clients as $client)
          <tr>
            <td>{{ $client->Name }}</td>
            <td>{{ count($client->projects) }}</td>
            <td>{{ $client->created_at ?? '' }}</td>
          </tr>
        @endforeach
      </tbody>

    </table>

  </div>

  {{-- MODALS --}}
  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_client" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Add New Client</h5>
          </div>
          <div class="modal-body">
            <form action="{{ route('clients.store') }}" method="post">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="req">Client Name / Title</label>
                    <input type="text" class="form-control" name="Name" placeholder="Eg. Microsoft Limited" required>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-info btn-form">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
