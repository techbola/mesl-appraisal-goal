@extends('layouts.master')

@section('title')
  KnowledgeBase Categories
@endsection

@section('page-title')
  KnowledgeBase Categories
@endsection

@section('buttons')
  <button class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#new_cat">New Category</button>
@endsection

@section('content')

  <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Categories / Projects</div>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>
    </div>

    <table class="table tableWithSearch table-striped table-condensed">
      <thead>
        <tr>
          <th>Category Name</th>
          <th>Items</th>
          <th>Created By</th>
          <th>Date Created</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($categories as $category)
          <tr>
            <td>{{ $category->Name }}</td>
            <td>{{ count($category->items) }}</td>
            <td>{{ $category->poster->FullName }}</td>
            <td data-sort="{{ $category->created_at }}">{{ $category->created_at? $category->created_at->format('Y-m-d') : '' }}</td>
          </tr>
        @endforeach
      </tbody>

    </table>

  </div>

  {{-- MODALS --}}
  <!-- Modal -->
  <div class="modal fade slide-up disable-scroll" id="new_cat" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog ">
      <div class="modal-content-wrapper">
        <div class="modal-content">
          <div class="modal-header clearfix text-left">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
            </button>
            <h5>Add New Category</h5>
          </div>
          <div class="modal-body">
            <form action="{{ route('save_kb_cat') }}" method="post">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="req">Category Name</label>
                    <input type="text" class="form-control" name="Name" placeholder="Eg. The OfficeMate Project" required>
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
