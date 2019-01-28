<style>
  .nav-tabs-simple>li.active>a {
      border: none !important;
  }
  .font-title {
    font-size: 14px !important;
  }
</style>

<ul class="nav nav-tabs nav-tabs-sm nav-tabs-simple bg-white m-b-20">
  <li class="active"><a data-toggle="tab" href="#general">General</a></li>
  <li><a data-toggle="tab" href="#personal">Personal</a></li>
  @if (in_array($my_dept, $depts['hr']) || $user->hasRole('admin'))
    <li><a data-toggle="tab" href="#hr">HR</a></li>
  @endif

  @if (in_array($my_dept, $depts['it']) || $user->hasRole('admin') || $user->hasRole('admin'))
    <li><a data-toggle="tab" href="#it">IT</span></a></li>
  @endif

  @if (in_array($my_dept, $depts['finance']) || $user->hasRole('admin') || $user->hasRole('admin'))
    <li><a data-toggle="tab" href="#finance">Finance</span></a></li>
  @endif

  @if (in_array($my_dept, $depts['operations']) || $user->hasRole('admin') || $user->hasRole('admin'))
    <li><a data-toggle="tab" href="#operations">Operations</span></a></li>
  @endif

  @if (in_array($my_dept, $depts['legal']) || $user->hasRole('admin') || $user->hasRole('admin'))
    <li><a data-toggle="tab" href="#legal">Legal</span></a></li>
  @endif

  @if (in_array($my_dept, $depts['sales']) || $user->hasRole('admin') || $user->hasRole('admin'))
    <li><a data-toggle="tab" href="#sales">Sales</span></a></li>
  @endif

  @if (in_array($my_dept, $depts['admin']) || $user->hasRole('admin') || $user->hasRole('admin'))
    <li><a data-toggle="tab" href="#admin">Admin</span></a></li>
  @endif

  @if (in_array($my_dept, $depts['risk']) || $user->hasRole('admin') || $user->hasRole('admin'))
    <li><a data-toggle="tab" href="#risk">Risk Mgt</span></a></li>
  @endif
  {{-- <li>
    <a data-toggle="tab" href="#business">Business Risk</span></a>
  </li> --}}
</ul>

<div class="tab-content" style="min-height: 300px">

    <div id="general" class="tab-pane fade in active">

      {{-- START BLOCKS --}}
      <div class="row">

          <div class="col-sm-6">
            <a href="{{ route('bulletin_board') }}" class="no-color">
              <div class="card-box" style="min-height:400px">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/megaphone.png') }}" alt="" width="40px" style="filter: sepia(0.3);">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Bulletin Board</div>
                  {{-- <h3 class="no-margin p-b-5 text-info bold">{{ count($bulletins) }}</h3> --}}
                </div>
                {{-- Start List --}}
                <div class="my-list m-t-15">
                  @foreach ($bulletins->take('3') as $item)
                    <li>
                      <div class="thumbnail-wrapper d24 circular">
                        <img width="40" height="40" alt="" src="{{ asset('images/avatars/'.$item->poster->avatar()) }}">
                      </div>

                      <div class="table-cell p-l-10" style="width:500px">
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
                {{-- End List --}}
              </div>
            </a>
          </div>


          <div class="col-sm-6">


            <div class="col-sm-12">
              <a href="{{ route('events') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/calendar.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Upcoming Events</div>
                  </div>

                  {{-- Start List --}}
                  <div class="my-list m-t-15">
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
                    @endif
                  {{-- End List --}}
                </div>
              </a>
            </div>

          </div>




          <div class="col-sm-12">
            <a href="javascript:void(0)" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/gift.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Birthdays Today</div>
                </div>


                <div class="my-list m-t-15">
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
            </a>
          </div>

          <div class="col-sm-12">
            <a href="javascript:void(0)" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/gift.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Staff Anniversaries</div>
                </div>
              </div>
            </a>
          </div>



          {{-- <div class="col-sm-4">
            <a href="{{ route('my_documents') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/file.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Document Management</div>
                </div>
              </div>
            </a>
          </div> --}}

          {{-- <div class="col-sm-4">
            <a href="javascript:void(0)" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Reports</div>
                </div>
              </div>
            </a>
          </div> --}}



        </div>
        {{-- END BLOCKS --}}

    </div>
    <div id="personal" class="tab-pane fade">
      {{-- START BLOCKS --}}
      <div class="row">


          <div class="col-sm-4">
            <a href="{{ route('memos.index') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/document.png') }}" alt="" width="40px" style="filter: sepia(0.3);">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Internal Memo</div>
                  {{-- <h3 class="no-margin p-b-5 text-info bold">{{ count($bulletins) }}</h3> --}}
                </div>
              </div>
            </a>
          </div>


          <div class="col-sm-4">
            <a href="{{  route('LeaveRequest') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/contact.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Requests</div>
                  {{-- - Travel, Procurement, Leave, Loan, Store --}}
                </div>

                <div class="dropdown pull-right">
                    <button class="btn btn-xs btn-grey dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" onclick="card_submenus(this)">
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#">Leave</a></li>
                      <li><a href="#">Loan</a></li>
                      <li><a href="#">Travel</a></li>
                      <li><a href="#">Procurement</a></li>
                      <li><a href="#">Store</a></li>
                    </ul>
                </div>

              </div>
            </a>
          </div>


          <div class="col-sm-4">
            <a href="{{ route('todos') }}?date={{ date('Y-m-d') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/todos.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">To-do List</div>
                </div>
              </div>
            </a>
          </div>


          <div class="col-sm-4">
            <a href="{{ route('business_contacts') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/interview.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Meeting Notes</div>
                </div>
              </div>
            </a>
          </div>


          <div class="col-sm-4">
            <a href="{{ route('notes') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/notes.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Sticky Notes</div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-sm-4">
            <a href="{{ route('inbox') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/email.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Messaging</div>
                </div>
              </div>
            </a>
          </div>

          <div class="col-sm-4">
            <a href="{{ route('individual-payslip') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/cheque.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Payslip</div>
                </div>
              </div>
            </a>
          </div>


          <div class="col-sm-4">
            <a href="{{ route('business_contacts') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/contacts.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Business Contacts</div>
                </div>
              </div>
            </a>
          </div>

        </div>
        {{-- END BLOCKS --}}
    </div>

    @if (in_array($my_dept, $depts['hr']) || $user->hasRole('admin'))
      <div id="hr" class="tab-pane fade">

        @if (in_array('LeaveApproval', $user->menu_routes()) || $user->hasRole('admin'))
          <div class="col-sm-4">
            <a href="{{ route('LeaveApproval') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Leave Management</div>
                </div>
              </div>
            </a>
          </div>
        @endif

        @if (in_array('staff_search', $user->menu_routes()) || $user->hasRole('admin'))
          <div class="col-sm-4">
            <a href="{{ route('staff_search') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/searching.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Employee Search</div>
                </div>
              </div>
            </a>
          </div>
        @endif
        @if (in_array('CourseDashboard', $user->menu_routes()) || $user->hasRole('admin'))
          <div class="col-sm-4">
            <a href="{{ route('CourseDashboard') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/video-player.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Learning Management System</div>
                </div>
              </div>
            </a>
          </div>
        @endif

          {{-- <div class="col-sm-4">
            <a href="javascript:void(0)" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/performance.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Performance Management</div>
                </div>
              </div>
            </a>
          </div> --}}

          @if (in_array('ScheduleTraining', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('ScheduleTraining') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/presentation2.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Training Schedule</div>
                  </div>
                </div>
              </a>
            </div>
          @endif

          @if (in_array('Policy', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('Policy') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/policy.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Policies & Procedures</div>
                  </div>
                </div>
              </a>
            </div>
          @endif

          @if (in_array('payroll.details', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('payroll.details') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/cheque.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Payroll Processing</div>
                  </div>
                </div>
              </a>
            </div>
          @endif
      </div>
    @endif

    @if (in_array($my_dept, $depts['it']) || $user->hasRole('admin'))
      <div id="it" class="tab-pane fade">

          @if (in_array('company_menus', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('company_menus') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/user.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Menu Assignment</div>
                  </div>
                </div>
              </a>
            </div>
          @endif

          @if (in_array('activity_log', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('activity_log') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Audit Log</div>
                  </div>
                </div>
              </a>
            </div>
          @endif
          {{-- <div class="col-sm-4">
              <a href="javascript:void(0)" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/telemarketer.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Service Desk</div>
                  </div>
                </div>
              </a>
            </div> --}}

          {{-- <div class="col-sm-4">
              <a href="javascript:void(0)" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/development.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Systems Monitoring</div>
                  </div>
                </div>
              </a>
            </div> --}}

          @if (in_array('staff.index', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('staff.index') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/hierarchy.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">User Profiling</div>
                  </div>
                </div>
              </a>
            </div>
          @endif
          @if (in_array('roles.create', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('roles.create') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/roles.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Create Roles</div>
                  </div>
                </div>
              </a>
            </div>
          @endif
          @if (in_array('company_menus', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('company_menus') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/key.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Assign Menu</div>
                  </div>
                </div>
              </a>
            </div>
          @endif
          @if (in_array('pending_biodata_list', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('pending_biodata_list') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/approved.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Approve Biodata</div>
                  </div>
                </div>
              </a>
            </div>
          @endif
          @if ($user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('menus.index') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/menu.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Create Menus</div>
                  </div>
                </div>
              </a>
            </div>
          @endif
      </div>
    @endif

    @if (in_array($my_dept, $depts['finance']) || $user->hasRole('admin'))
      <div id="finance" class="tab-pane fade">

            @if (in_array('showDetails', $user->menu_routes()) || $user->hasRole('admin'))
              <div class="col-sm-4">
                <a href="{{ route('showDetails') }}" class="no-color">
                  <div class="card-box">
                    <div class="inline m-r-10 m-t-10">
                      <img class="icon" src="{{ asset('assets/img/icons/budget.png') }}" alt="" width="40px">
                    </div>
                    <div class="inline">
                      <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Accounting</div>
                    </div>
                  </div>
                </a>
              </div>
            @endif
            @if (in_array('assets', $user->menu_routes()) || $user->hasRole('admin'))
              <div class="col-sm-4">
                <a href="{{ route('assets') }}" class="no-color">
                  <div class="card-box">
                    <div class="inline m-r-10 m-t-10">
                      <img class="icon" src="{{ asset('assets/img/icons/house.png') }}" alt="" width="40px">
                    </div>
                    <div class="inline">
                      <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Fixed Asset Register</div>
                    </div>
                  </div>
                </a>
              </div>
            @endif
            @if (in_array('SearchClient', $user->menu_routes()) || $user->hasRole('admin'))
              <div class="col-sm-4">
                <a href="{{ route('SearchClient') }}" class="no-color">
                  <div class="card-box">
                    <div class="inline m-r-10 m-t-10">
                      <img class="icon" src="{{ asset('assets/img/icons/files.png') }}" alt="" width="40px">
                    </div>
                    <div class="inline">
                      <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Customer Data</div>
                    </div>
                  </div>
                </a>
              </div>
            @endif

            @if (in_array('ars_recon', $user->menu_routes()) || $user->hasRole('admin'))
              <div class="col-sm-4">
                <a href="{{ route('ars_recon') }}" class="no-color">
                  <div class="card-box">
                    <div class="inline m-r-10 m-t-10">
                      <img class="icon" src="{{ asset('assets/img/icons/budget.png') }}" alt="" width="40px">
                    </div>
                    <div class="inline">
                      <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Reconciliation</div>
                    </div>
                  </div>
                </a>
              </div>
            @endif

            @if (in_array('trial_balance3', $user->menu_routes()) || $user->hasRole('admin'))
              <div class="col-sm-4">
                <a href="{{ route('trial_balance3') }}" class="no-color">
                  <div class="card-box">
                    <div class="inline m-r-10 m-t-10">
                      <img class="icon" src="{{ asset('assets/img/icons/document.png') }}" alt="" width="40px">
                    </div>
                    <div class="inline">
                      <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Management Report</div>
                    </div>
                  </div>
                </a>
              </div>
            @endif

            @if (in_array('SearchVendors', $user->menu_routes()) || $user->hasRole('admin'))
              <div class="col-sm-4">
                  <a href="{{ route('SearchVendors') }}" class="no-color">
                    <div class="card-box">
                      <div class="inline m-r-10 m-t-10">
                        <img class="icon" src="{{ asset('assets/img/icons/files.png') }}" alt="" width="40px">
                      </div>
                      <div class="inline">
                        <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Vendor Data</div>
                      </div>
                    </div>
                  </a>
              </div>
            @endif


      </div>
    @endif

    @if (in_array($my_dept, $depts['operations']) || $user->hasRole('admin'))
      <div id="operations" class="tab-pane fade">
        @if (in_array('projects', $user->menu_routes()) || $user->hasRole('admin'))
          <div class="col-sm-4">
            <a href="{{ route('projects') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/project.png') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Project Management</div>
                </div>
              </div>
            </a>
          </div>
        @endif

          {{-- <div class="col-sm-4">
              <a href="javascript:void(0)" class="no-color">
                  <div class="card-box">
                    <div class="inline m-r-10 m-t-10">
                      <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                    </div>
                    <div class="inline">
                      <div class="font-title f16 bold m-b-10 text-uppercase hint-text">CMMS</div>

                    </div>

                    <div class="dropdown pull-right">
                        <button class="btn btn-xs btn-grey dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" onclick="card_submenus(this)">
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                          <li><a href="#">Work Order</a></li>
                          <li><a href="#">Asset Tracking</a></li>
                          <li><a href="#">Maintenance Scheduling</a></li>
                          <li><a href="#">Inventory Control</a></li>
                          <li><a href="#">Service History</a></li>
                        </ul>
                      </div>

                  </div>
                </a>
            </div> --}}

          {{-- <div class="col-sm-4">
              <a href="javascript:void(0)" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/development.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Control Systems Management</div>
                  </div>
                </div>
              </a>
            </div> --}}
      </div>
    @endif

    @if (in_array($my_dept, $depts['legal']) || $user->hasRole('admin'))
      <div id="legal" class="tab-pane fade">
            {{-- <div class="col-sm-4">
              <a href="javascript:void(0)" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/mace.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Litigation Schedule</div>
                  </div>
                </div>
              </a>
            </div> --}}

            @if (in_array('litigation.index', $user->menu_routes()) || $user->hasRole('admin'))
              <div class="col-sm-4">
                <a href="{{ route('litigation.index') }}" class="no-color">
                  <div class="card-box">
                    <div class="inline m-r-10 m-t-10">
                      <img class="icon" src="{{ asset('assets/img/icons/diploma.png') }}" alt="" width="40px">
                    </div>
                    <div class="inline">
                      <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Contracts</div>
                    </div>
                  </div>
                </a>
              </div>
            @endif
      </div>
    @endif

    @if (in_array($my_dept, $depts['sales']) || $user->hasRole('admin'))
      <div id="sales" class="tab-pane fade">
        <div class="row">
        </div>
      </div>
    @endif

    @if (in_array($my_dept, $depts['admin']) || $user->hasRole('admin'))
      <div id="admin" class="tab-pane fade">
        <div class="row">
        </div>
      </div>
    @endif

    @if (in_array($my_dept, $depts['risk']) || $user->hasRole('admin'))
      <div id="risk" class="tab-pane fade">
        <div class="row">
        </div>
      </div>
    @endif

</div>

<script>
    function card_submenus(e){
     $(e).closest('.dropdown').find('ul').toggleClass('inline-block');
     $(e).closest('.dropdown').find('ul').css( 'min-width', '100%' );
   }
 </script>
