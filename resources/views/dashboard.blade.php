@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@section('page-title')
  Dashboard
@endsection

@section('content')
  <style media="screen">
    .col-md-4 {
      /* width: 100%; */
    }
    .balloons {
      position: absolute;
      right: -30px;
      top: -10px;
      opacity: 0.05;
      zoom: 2;
    }
  </style>
  {{-- <div class="text-center">
    <img src="{{ asset('assets/img/backgrounds/cavidel-slide.jpg') }}" alt="" width="95%">
  </div> --}}


  {{-- START TOP BLOCKS --}}
  <div class="row">

    <div class="col-sm-4">
      <a href="{{ route('call-memo-actions') }}" class="no-color">
        <div class="card-box">
          <div class="inline m-r-10 m-t-10" style="vertical-align:top">
            <img class="icon" src="{{ asset('assets/img/icons/suitcase.svg') }}" alt="" width="40px" style="filter: sepia(0.3);">
          </div>
          <div class="inline">
            <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Meeting Actions</div>
            <h3 class="no-margin p-b-5 text-info bold">{{ $pending_meeting_actions }}</h3>
          </div>
          {{-- <div class="small">
            <span>Office</span>
            <span class=" text-success font-montserrat"><i class="fa fa-caret-up m-l-10"></i> 9%</span>
            <span class="m-l-20">Mate</span>
            <span class=" text-danger font-montserrat"><i class="fa fa-caret-up m-l-10"></i> 21%</span>
          </div> --}}
        </div>
      </a>
    </div>

    <div class="col-sm-4">
      <a href="{{ route('todos') }}?date={{ date('Y-m-d') }}" class="no-color">
        <div class="card-box">
          <div class="inline m-r-10 m-t-10" style="vertical-align:top">
            <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
          </div>
          <div class="inline">
            <div class="font-title f16 bold m-b-10 text-uppercase hint-text">To-Dos Today</div>
            <h3 class="no-margin p-b-5 text-info bold">{{ count($todos_today) }}</h3>
          </div>
        </div>
      </a>
    </div>

    <div class="col-sm-4">
      <a href="{{ route('projects') }}" class="no-color">
        <div class="card-box">
          <div class="inline m-r-10 m-t-10" style="vertical-align:top">
            <img class="icon" src="{{ asset('assets/img/icons/task.svg') }}" alt="" width="40px" style="filter: brightness(0.92);">
          </div>
          <div class="inline">
            <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Tasks</div>
            <h3 class="no-margin p-b-5 text-info bold">{{ count($tasks) }}</h3>
          </div>
        </div>
      </a>
    </div>

  </div>
  {{-- END TOP BLOCKS --}}

  <div class="row grid">
        {{-- Events --}}
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 grid-item" data-sort="{{ count($events) }}">
          <div class="card-box">
            <div class="card-title">
              Upcoming Events
              @if (count($events) > 0)
                <span class="badge badge-danger badge-sm badge-tab">{{ count($events) }}</span>
              @endif
              <a href="{{ route('events') }}" class="label label-inverse pull-right btn-rounded text-capitalize">See all <i class="fa fa-arrow-right m-l-5"></i></a>
            </div>

            <div class="my-list">
              @if (count($events) > 0) {{-- || count($birthdays) > 0 --}}

                @foreach ($events->take('3') as $item)
                  <li>
                    <div class="thumbnail-wrapper d24 circular">
                      {{-- <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->poster->avatar()) }}"> --}}
                      <i class="fa fa-calendar"></i>
                    </div>

                    <div class="table-cell p-l-10">
                      <div class="" style="margin-top:0 !important">{{ $item->Event }}</div>
                      <div class="no-margin text-muted small">
                        {{ (Carbon::parse($item->StartDate)->isToday())? 'Today' : ''.Carbon::parse($item->StartDate)->format('jS M, Y') }} — {{ (Carbon::parse($item->EndDate)->isToday())? 'Today' : ''.Carbon::parse($item->EndDate)->format('jS M, Y') }}
                      </div>
                    </div>
                  </li>
                @endforeach


                {{-- @if (count($birthdays) > 0)
                  <i class="fa fa-birthday-cake m-r-5"></i>
                  <span class="bold f14">Birthdays Today</span>
                @endif
                @foreach ($birthdays as $item)
                  @if (Carbon::parse($item->DateofBirth)->isBirthday())
                    <li>
                      <div class="thumbnail-wrapper d24 circular">
                        <!-- <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->user->avatar()) }}"> -->
                        <i class="fa fa-birthday-cake"></i>
                      </div>

                      <div class="table-cell p-l-10">
                        <div class="" style="margin-top:0 !important">{{ $item->FullName }}'s Birthday</div>
                        <div class="no-margin text-muted small">
                          {{ (Carbon::parse($item->DateofBirth)->isBirthday(Carbon::now()))? 'Today' : ''.Carbon::parse($item->DateofBirth)->format('jS M') }}
                        </div>
                      </div>
                    </li>
                  @endif
                @endforeach --}}

              @else
                @emptylist()
              @endif


            </div>

          </div>
        </div>
        {{-- End Events --}}

        {{-- Bulletins --}}
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 grid-item" data-sort="{{ count($bulletins) }}">
          <div class="card-box">
            <div class="card-title">
              Bulletin Board <span class="badge badge-danger badge-sm badge-tab">{{ count($bulletins) }}</span>
              <a href="{{ route('bulletin_board') }}" class="label label-inverse pull-right btn-rounded text-capitalize">See all <i class="fa fa-arrow-right m-l-5"></i></a>
            </div>

            <div class="my-list">
              @foreach ($bulletins->take('3') as $item)
                <li>
                  <div class="thumbnail-wrapper d24 circular">
                    <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->poster->avatar()) }}">
                  </div>

                  <div class="table-cell p-l-10">
                    <div class="" style="margin-top:0 !important">{{ $item->Title ?? '—' }}</div>
                    <div class="no-margin text-muted small">
                      <span>{{ ($item->poster)? $item->poster->FullName : ''}}</span> — @if(!empty($item->CreatedDate)){{ ($item->CreatedDate->isToday())? 'Today' : ''.$item->CreatedDate->format('jS M, Y') }} at {{ $item->CreatedDate->format('g:ia') }}@endif
                    </div>
                    <div class="small bg-light">
                      {!! str_limit(strip_tags($item->Body), 30) !!}
                    </div>
                  </div>
                </li>
              @endforeach
            </div>

          </div>
        </div>
        {{-- End Bulletins --}}

        {{-- Policies --}}
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 grid-item" data-sort="{{ count($policy_statements) }}">
          <div class="card-box">
            <div class="card-title">
              New Policies <span class="badge badge-danger badge-sm badge-tab">{{ count($policy_statements) }}</span>
              <a href="{{ route('Policy') }}" class="label label-inverse pull-right btn-rounded text-capitalize">See all <i class="fa fa-arrow-right m-l-5"></i></a>
            </div>

            <div class="my-list">
              @forelse ($policy_statements as $item)
                <li>

                  <div class="table-cell p-l-10">
                    <div class="" style="margin-top:0 !important">{{ ($item->segment)? $item->segment->Segment : '' }}</div>
                    <div class="no-margin text-muted small">
                      <span>{{ ($item->poster)? $item->poster->FullName : '' }}</span> — @if(!empty($item->EntryDate)){{ (Carbon::parse($item->EntryDate)->isToday())? 'Today' : ''.Carbon::parse($item->EntryDate)->format('jS M, Y') }}@endif
                    </div>
                    <div class="small bg-light">
                      {!! str_limit(strip_tags($item->Statement), 30) !!}
                    </div>
                  </div>
                </li>
              @empty
                @emptylist()
              @endforelse
            </div>

          </div>
        </div>
        {{-- End Policies --}}


      {{-- Todos Week --}}
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 grid-item" data-sort="{{ count($todos_week) }}">
        <div class="card-box">
        <div class="card-title">
          To-Dos This Week
          {{-- <span class="badge badge-danger badge-sm badge-tab">{{ count($todos_week) }}</span> --}}
          @if (count($todos_week) > 0)
            <span class="badge badge-danger badge-sm badge-tab">{{ count($todos_week) }}</span>
          @endif
          <a href="{{ route('todos') }}" class="label label-inverse pull-right btn-rounded text-capitalize">See all <i class="fa fa-arrow-right m-l-5"></i></a>
        </div>

        <div class="my-list">
          @forelse ($todos_week->take('5') as $item)
            <li>
              {{-- <div class="thumbnail-wrapper d24 circular">
                <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->poster->avatar()) }}">
              </div> --}}

              <div class="table-cell p-l-10">
                <div class="" style="margin-top:0 !important">{{ $item->Todo }}</div>
                <div class="no-margin text-muted small">
                  <span>{{ Carbon::parse($item->DueDate)->format('l, jS M, Y') }}</span>
                </div>
              </div>
            </li>
          @empty
            @emptylist()
          @endforelse
        </div>

      </div>
      </div>
      {{-- End Todos Week --}}

      {{-- Memos --}}
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 grid-item" data-sort="{{ count($unapproved_memos) }}">

        <div class="card-box">
          <div class="card-title">
            Unapproved Memos <span class="badge badge-danger badge-sm badge-tab">{{ count($unapproved_memos) }}</span>
            <a href="{{ route('memos_approvallist') }}" class="label label-inverse pull-right btn-rounded text-capitalize">See all <i class="fa fa-arrow-right m-l-5"></i></a>
          </div>

          {{-- <div class="my-list">
          @foreach ($unapproved_memos->take('3') as $item)
          <li>
          <div class="thumbnail-wrapper d24 circular">
          <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->sender->avatar()) }}">
        </div>

        <div class="table-cell p-l-10">
        <div class="" style="margin-top:0 !important">{{ $item->Subject }}</div>
        <div class="no-margin text-muted small">
        <span>{{ $item->sender->FullName }}</span> — {{ ($item->created_at->isToday())? 'Today' : ''.$item->created_at->format('jS M, Y') }} at {{ $item->created_at->format('g:ia') }}
      </div>
      <div class="small bg-light">
      {!! str_limit(strip_tags($item->Body), 30) !!}
    </div>
  </div>
</li>
@endforeach
</div> --}}

@emptylist()

</div>
      </div>
      {{-- End Memos --}}



      {{-- Birthdays --}}
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 grid-item" data-sort="{{ count($birthdays) }}">
        <div class="card-box" style="position: relative; overflow: hidden;">
        <div class="card-title">Birthdays Today <span class="badge badge-danger badge-sm badge-tab">{{ count($birthdays) }}</span></div>

        <div class="balloons">
          <img src="{{ asset('images/site/balloons.png') }}" alt="">
        </div>

        <div class="my-list">
          @foreach ($birthdays as $item)
            {{-- @if (Carbon::parse($item->DateofBirth)->isBirthday()) --}}
              <li>
                <div class="thumbnail-wrapper d24 circular">
                  <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->user->avatar()) }}">
                  {{-- <i class="fa fa-birthday-cake"></i> --}}
                </div>

                <div class="table-cell p-l-10">
                  <div class="" style="margin-top:0 !important">{{ $item->FullName }} <i class="fa fa-birthday-cake m-l-5"></i></div>
                  <div class="no-margin text-muted small">
                    {{ (Carbon::parse($item->DateofBirth)->isBirthday(Carbon::now()))? 'Today' : ''.Carbon::parse($item->DateofBirth)->format('jS M') }}
                  </div>
                </div>
              </li>
            {{-- @endif --}}
          @endforeach
        </div>

      </div>
      </div>
      {{-- End Birthdays --}}

      {{-- Messages --}}
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 grid-item" data-sort="{{ count($messages) }}">
        <div class="card-box">
          <div class="card-title">
            New Messages <span class="badge badge-danger badge-sm badge-tab">{{ count($messages) }}</span>
            <a href="{{ route('inbox') }}" class="label label-inverse pull-right btn-rounded text-capitalize">See all <i class="fa fa-arrow-right m-l-5"></i></a>
          </div>

          <div class="my-list">
            @forelse ($messages->take('3') as $item)
              <li>
                <a href="{{ route('view_message', ['id'=>($item->ParentID)? $item->ParentID : $item->MessageRef, 'reply'=>$item->MessageRef] ) }}" class="no-color">
                  <div class="thumbnail-wrapper d24 circular">
                    <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->sender->avatar())  }}">
                  </div>

                  <div class="table-cell p-l-10">
                    <div class="" style="margin-top:0 !important">{{ $item->Subject }}</div>
                    <div class="no-margin text-muted small">
                      <span>{{ $item->sender->FullName }}</span> — {{ ($item->created_at->isToday())? 'Today' : ''.$item->created_at->format('jS M, Y') }} at {{ $item->created_at->format('g:ia') }}
                    </div>
                    <div class="small bg-light">
                      {!! str_limit(strip_tags($item->Body), 30) !!}
                    </div>
                  </div>

                </a>
              </li>
            @empty
              @emptylist()
            @endforelse
          </div>

        </div>
      </div>
      {{-- End Messages --}}

      {{-- Leave Requests --}}
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 grid-item" data-sort="{{ count($leave_requests) }}">
        <div class="card-box">
          <div class="card-title">Leave Requests <span class="badge badge-danger badge-sm badge-tab">{{ count($leave_requests) }}</span></div>

          <div class="my-list">
            @forelse ($leave_requests as $item)
              <li>
                <div class="thumbnail-wrapper d24 circular">
                  <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->requester->avatar()) }}">
                </div>

                <div class="table-cell p-l-10">
                  <div class="" style="margin-top:0 !important">{{ $item->requester->FullName }}</div>
                  <div class="no-margin text-muted small">
                    <span>From <b>{{ Carbon::parse($item->StartDate)->format('jS M, Y') }}</b> To <b>{{ Carbon::parse($item->ReturnDate)->format('jS M, Y') }}</b></span>
                  </div>
                  <div class="label label-inverse m-t-5">{{ $item->NumberofDays }} Days</div>
                </div>
              </li>
            @empty
              @emptylist()
            @endforelse
          </div>

        </div>
      </div>
      {{-- End Leave Requests --}}

  </div> {{-- Close Row --}}


@endsection

@push('scripts')
  <script src="{{ asset('assets/plugins/feathericons/feather.min.js') }}" charset="utf-8"></script>
  <i data-feather="circle"></i>

<script>
  feather.replace();
</script>

<script src="{{ asset('js/isotope/isotope.pkgd.min.js') }}" charset="utf-8"></script>
<script src="{{ asset('js/isotope/packery-mode.pkgd.min.js') }}" charset="utf-8"></script>
<script>
  $('.grid').isotope({
    // options
    itemSelector: '.grid-item',
    layoutMode: 'packery',
    percentPosition: true,
    getSortData: {
      count: '[data-sort]',
    },
    sortBy: 'count',
    sortAscending: false
  });
</script>
@endpush
