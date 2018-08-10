<div class="card-box">
  <table class="table table-bordered tableWithSearch">
    <thead>
      <tr>
        <th>Project</th>
        <th>Task</th>
        <th>Milestone</th>
        <th>Project Manager</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($incomplete_steps as $step)
        <tr>
          <td>{{ $step->task->project->Project ?? '' }}</td>
          <td>{{ $step->task->Task ?? '' }}</td>
          <td>{{ $step->Step ?? '' }}</td>
          <td>{{ $step->task->project->supervisor->FullName ?? '' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
