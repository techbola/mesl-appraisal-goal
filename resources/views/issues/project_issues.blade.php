@extends('layouts.master')

@section('title')
  Issues In {{ $project->Project }}
@endsection

@section('page-title')
  Issues In {{ $project->Project }}
@endsection

@section('buttons')
  <button class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#new_issue" @click="new_issue()">New Issue</button>
@endsection

@section('content')

{{-- <div id="vue"> --}}

  <div class="card-box">
    <div class="clearfix">
      <div class="card-title pull-left">Resolved Issues In Project: <span class="text-info m-l-5 text-capitalize">{{ $project->Project }}</span> </div>
      <div class="pull-right">
        <div class="col-xs-12">
          <input type="text" class="search-table form-control pull-right" placeholder="Search">
        </div>
      </div>
    </div>

    <table class="table tableWithSearch table-striped">
      <thead>
        <tr>
          <th>Title</th>
          <th>Project</th>
          <th>Description</th>
          <th>Created By</th>
          <th>Date Created</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($issues as $issue)
          <tr>
            <td>{{ $issue->Name }}</td>
            <td>{{ $issue->project->Project ?? '' }}</td>
            <td>{{ str_limit($issue->Description, 10) }}</td>
            <td>{{ $issue->poster->FullName }}</td>
            <td>{{ $issue->created_at ?? '' }}</td>
            <td>
              {{-- <i class="fa fa-pencil text-warning"></i> --}}
              <a href="{{ route('view_issue', $issue->id) }}" class="btn btn-xs btn-info">View</a>
              <a href="javascript:void(0)" data-toggle="modal" data-target="#edit_issue" @click="edit_issue({{ json_encode($issue) }})" class="btn btn-xs btn-inverse">Edit</a>
            </td>
          </tr>
        @endforeach
      </tbody>

    </table>

  </div>

  @include('issues.modals')

{{-- </div> --}}
@endsection

@push('scripts')
  
  <script>
  var base = "{{ url('/') }}";
  new Vue({
    // el: '#vue',
    el: '#app',
    data: {
      issue: {
        id: '',
        Name: '',
        Description: '',
        Solution: '',
        action: '{{ url('/').'/update_issue/' }} @{{ issue.id }}'
      }
    },
    methods: {
      edit_issue(issue) {
        this.issue = issue;
        console.log(issue);
        $('#issue_form_edit').attr('action', base + '/update_issue/' + issue.id);
        // $('#issue_form').prepend('{{ method_field("PATCH") }}');
        $('#issue_form_edit').find('.note-editable').prepend(issue.Solution);

        // if(this.product.supplier_id == undefined) {
        //   document.getElementById('edit_supplier').removeAttribute('name');
        //   document.getElementById('edit_select_supplier').style.display = 'none';
        // } else {
        //   document.getElementById('edit_supplier').setAttribute('name', 'supplier');
        //   document.getElementById('edit_select_supplier').style.display = 'block';
        // }
      },
      new_issue(){
        // $('#issue_form').find('input[name=_method]').remove();
        // $('#issue_form').attr('action', base + '/save_issue/' + '{{-- $category->id --}}');
        // $('#issue_form')[0].reset();
        // $('.note-editable').empty();
      }

    }

  });
</script>
@endpush
