@extends('layouts.master')

@section('page-title')
  Dashboard
@endsection

@section('content')
  {{-- <div class="text-center">
    <img src="{{ asset('assets/img/backgrounds/cavidel-slide.jpg') }}" alt="" width="95%">
  </div> --}}

  <style media="screen">
    img.icon {
      filter: sepia(0.3);
    }
  </style>

  {{-- START TOP BLOCKS --}}
  <div class="row">

    <div class="col-md-4">
      <div class="card-box">
        <div class="inline m-r-10 m-t-10" style="vertical-align:top">
          <img class="icon" src="{{ asset('assets/img/icons/suitcase.svg') }}" alt="" width="40px">
        </div>
        <div class="inline">
          <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Pending Meeting Actions</div>
          <h3 class="no-margin p-b-5 text-info bold">{{ $pending_meeting_actions }}</h3>
        </div>
        {{-- <div class="small">
          <span>Office</span>
          <span class=" text-success font-montserrat"><i class="fa fa-caret-up m-l-10"></i> 9%</span>
          <span class="m-l-20">Mate</span>
          <span class=" text-danger font-montserrat"><i class="fa fa-caret-up m-l-10"></i> 21%</span>
        </div> --}}
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-box">
        <div class="inline m-r-10 m-t-10" style="vertical-align:top">
          <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
        </div>
        <div class="inline">
          <div class="font-title f16 bold m-b-10 text-uppercase hint-text">To-Dos Today</div>
          <h3 class="no-margin p-b-5 text-info bold">{{ count($todos_today) }}</h3>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-box">
        <div class="inline m-r-10 m-t-10" style="vertical-align:top">
          <img class="icon" src="{{ asset('assets/img/icons/task.svg') }}" alt="" width="40px">
        </div>
        <div class="inline">
          <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Tasks</div>
          <h3 class="no-margin p-b-5 text-info bold">{{ count($tasks) }}</h3>
        </div>
      </div>
    </div>

  </div>
  {{-- END TOP BLOCKS --}}

  <div class="row">
    <div class="col-md-4">
      <div class="row">
        {{-- Events --}}
        <div class="col-md-12">
          <div class="card-box">
            <div class="card-title">Upcoming Events</div>

            <div class="my-list">
              @foreach ($events as $item)
                <li>
                  <div class="thumbnail-wrapper d24 circular">
                    {{-- <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->poster->avatar) }}"> --}}
                    <i class="fa fa-calendar"></i>
                  </div>

                  <div class="inline m-l-10">
                    <div class="" style="margin-top:0 !important">{{ $item->Event }}</div>
                    <div class="no-margin text-muted small">
                      {{ (Carbon::parse($item->StartDate)->isToday())? 'Today' : ''.Carbon::parse($item->StartDate)->format('jS M, Y') }} &mdash; {{ (Carbon::parse($item->EndDate)->isToday())? 'Today' : ''.Carbon::parse($item->EndDate)->format('jS M, Y') }}
                    </div>
                  </div>
                </li>
              @endforeach
            </div>

          </div>
        </div>
        {{-- End Events --}}

        {{-- Bulletins --}}
        <div class="col-md-12">
          <div class="card-box">
            <div class="card-title">Bulletin Board</div>

            <div class="my-list">
              @foreach ($bulletins as $item)
                <li>
                  <div class="thumbnail-wrapper d24 circular">
                    <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->poster->avatar) }}">
                  </div>

                  <div class="inline m-l-10">
                    <div class="" style="margin-top:0 !important">{{ $item->Title }}</div>
                    <div class="no-margin text-muted small">
                      <span>{{ $item->poster->FullName }}</span> &mdash; {{ ($item->CreatedDate->isToday())? 'Today' : ''.$item->CreatedDate->format('jS M, Y') }} at {{ $item->CreatedDate->format('g:ia') }}
                    </div>
                  </div>
                </li>
              @endforeach
            </div>

          </div>
        </div>
        {{-- End Bulletins --}}
      </div>
    </div>

    {{-- Todos Week --}}
    <div class="col-md-4">
      <div class="card-box">
        <div class="card-title">To-Dos This Week <span class="badge badge-info badge-sm badge-tab">{{ count($todos_week) }}</span></div>

        <div class="my-list">
          @foreach ($todos_week as $item)
            <li>
              {{-- <div class="thumbnail-wrapper d24 circular">
                <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->poster->avatar) }}">
              </div> --}}

              <div class="inline m-l-10">
                <div class="" style="margin-top:0 !important">{{ $item->Todo }}</div>
                <div class="no-margin text-muted small">
                  <span>{{ Carbon::parse($item->DueDate)->format('jS M, Y') }}</span>
                </div>
              </div>
            </li>
          @endforeach
        </div>

      </div>
    </div>
    {{-- End Todos Week --}}
  </div>


@endsection

@push('scripts')
  <script src="{{ asset('assets/plugins/feathericons/feather.min.js') }}" charset="utf-8"></script>
  <i data-feather="circle"></i>

<script>
  feather.replace()
</script>
@endpush
