<div class="card-box">
  <table class="table table-bordered tableWithSearch">
    <thead>
      <tr>
        <th>Project</th>
        <th>Task</th>
        <th>Milestone</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($incomplete_steps as $step)
        <tr>
          <td>{{ $step->task->project->Project ?? '' }}</td>
          <td>{{ $step->task->Task ?? '' }}</td>
          <td>{{ $step->Step ?? '' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
