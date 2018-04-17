@extends('layouts.master')

@section('title')
  Issues In {{ $category->Category }}
@endsection

@section('page-title')
  Issues In {{ $category->Category }}
@endsection

@section('buttons')
  <button class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#new_issue">New Issue</button>
@endsection

@section('content')

  <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">List Of Issue Resolutions In <span class="text-info">{{ $category->Category }}</span> </div>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>
    </div>

    <table class="table tableWithSearch table-striped table-condensed">
      <thead>
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Description</th>
          <th>Created By</th>
          <th>Date Created</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($issues as $issue)
          <tr>
            <td>{{ $issue->Item }}</td>
            <td>{{ $issue->category->Category }}</td>
            <td>{{ str_limit($issue->Description) }}</td>
            <td>{{ $issue->poster->FullName }}</td>
            <td>{{ $issue->created_at ?? '' }}</td>
          </tr>
        @endforeach
      </tbody>

    </table>

  </div>

  {{-- MODALS --}}
  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_issue" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Add New Issue</h5>
          </div>
          <div class="modal-body">
            <form action="{{ route('save_issue', $category->id) }}" method="post">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="req">Issue Title</label>
                    <input type="text" class="form-control" name="Item" placeholder="Enter Issue Title" required>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="req">Description</label>
                    <textarea class="form-control" name="Description" rows="3" width="100%"></textarea>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="req">Solution</label>
                    <textarea class="form-control summernote" name="Solution"></textarea>
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
