<div class="card-box">
  <h4 class="card-title"><b>Task Updates</b></h4>

  <!-- Show scrollbar if updates are more than 3 -->
  <div class="inbox-widget<?php if(count($task->updates) > 6){ echo ' nicescroll mx-box'; } ?>" style="overflow-y: auto;max-height: 300px;">

    @if ($task->updates)
      @foreach ($task->updates as $chat)
        <div class="inbox-item m-r-10">

          <div class="inbox-item-img"><img src="{{ asset('images/avatars/'.$chat->staff->user->avatar()) }}" class="img-circle m-r-5" alt=""></div>
          <p class="inbox-item-author text-muted">
              <a href="">{{ $chat->staff->FullName }}</a>
              @if($project->supervisor && $chat->staff->StaffRef == $project->supervisor->StaffRef)
                <i class="fa fa-shield m-l-5" data-toggle="tooltip" title="Supervisor" data-placement="right"></i>
              @endif
          </p>

          <p class="inbox-item-text f13">
            <!-- Start: Delete Update -->
            <?php if (Session::get('is_admin')) { ?>
              <a href=""<i class="ion-close-round pull-right text-danger" onclick="return confirm('Are you sure you want to delete this update?')"></i></a>
            <?php } ?>
            <!-- End: Delete Update -->
            {{ $chat->Body }}
          </p>
          <p class="inbox-item-date">{{ $chat->created_at->diffForHumans() ?? '' }}</p>
        </div>
      @endforeach

    @else
      <div class="text-center text-uppercase text-muted">No Messages Yet</div>
    @endif

  </div>
  <!-- Update Posting Permissions: ADMIN / PROJECT SUPERVISOR / TEAM MEMBERS -->

  <form action="{{ route('save_projectchat') }}" method="post" class="m-t-20">
    {{ csrf_field() }}
    <textarea name="Body" rows="4" class="form-control"></textarea>
    <input type="submit" value="Submit" class="btn btn-info m-t-20">
    <input type="hidden" name="TaskID" value="{{ $task->TaskRef }}">
  </form>
</div>
