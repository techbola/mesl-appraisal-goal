<div class="card-box">
  <div class="clearfix">
    <div class="card-title pull-left">Project Files</div>
    <a data-toggle="modal" data-target="#upload_file" class="btn btn-info btn-sm pull-right">+ Upload file</a>
  </div>

  <table class="table table-bordered tableWithSearch">
    <thead>
      <th>File</th>
      <th>Upload Date</th>
      <th>Uploaded By</th>
      <th>Actions</th>
    </thead>
    <tbody>
      @foreach ($project->files as $file)
        <tr>
          <td>{{ $file->Filename }}</td>
          <td>{{ $file->created_at }}</td>
          <td>{{ $file->uploader->FullName }}</td>
          <td class="actions">
            <a href="{{ route('download_file', ['project_files', $file->Filename]) }}" class="btn btn-xs btn-inverse"><i class="fa fa-download"></i> Download</a>

            @can ('project-supervisor', $project)
              <a class="btn btn-xs btn-danger" onclick="confirm2('Delete this file?', '', 'delete_file_{{ $file->FileRef }}')"><i class="fa fa-trash"></i> Delete</a>
              <form class="hidden" id="delete_file_{{ $file->FileRef }}" action="{{ route('delete_project_file', $file->FileRef) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
              </form>
            @endcan
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</div>



<div class="modal fade" id="upload_file" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Upload File</h4>
      </div>
      <div class="modal-body">
        <form id="file_upload_form" action="{{ route('upload_project_file', $project->ProjectRef) }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group">
            <label>File</label>
            <input type="file" class="filestyle" name="Filename" data-placeholder="Upload File" data-buttonname="btn-info" data-buttonBefore="true">
          </div>
          <div class="text-right m-t-20">
            <button type="button" class="btn btn-inverse m-r-10" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info">Upload</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
