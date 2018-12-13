<style>
  .nav-tabs-simple>li.active>a {
      border: none !important;
  }
  .font-title {
    font-size: 14px !important;
  }
</style>

<ul class="nav nav-tabs nav-tabs-simple bg-white m-b-20">
  <li class="active"><a data-toggle="tab" href="#general">General</a></li>
  <li><a data-toggle="tab" href="#personal">Personal</a></li>
  <li><a data-toggle="tab" href="#hr">HR</a></li>
  <li>
    <a data-toggle="tab" href="#it">IT</span></a>
  </li>
  <li>
    <a data-toggle="tab" href="#finance">Finance</span></a>
  </li>
  <li>
    <a data-toggle="tab" href="#operations">Operations</span></a>
  </li>
  <li>
    <a data-toggle="tab" href="#legal">Legal</span></a>
  </li>
</ul>

<div class="tab-content" style="min-height: 300px">

    <div id="general" class="tab-pane fade in active">

      {{-- START BLOCKS --}}
      <div class="row">

          @if ( in_array('bulletin_board', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('bulletin_board') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/megaphone.png') }}" alt="" width="40px" style="filter: sepia(0.3);">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Bulletin Board</div>
                    {{-- <h3 class="no-margin p-b-5 text-info bold">{{ count($bulletins) }}</h3> --}}
                  </div>
                </div>
              </a>
            </div>
          @endif

          @if ( in_array('events', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
              <a href="{{ route('events') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/calendar.png') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Event Scheduling</div>
                    {{-- <h3 class="no-margin p-b-5 text-info bold">{{ count($events) }}</h3> --}}
                  </div>
                </div>
              </a>
            </div>
          @endif

          <div class="col-sm-4">
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

          @if (in_array('my_documents', $user->menu_routes()) || $user->hasRole('admin'))
            <div class="col-sm-4">
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
            </div>
          @endif

          <div class="col-sm-4">
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
          </div>

        </div>
        {{-- END BLOCKS --}}

    </div>
    <div id="personal" class="tab-pane fade">
      {{-- START BLOCKS --}}
      <div class="row">

          @if (in_array('memos.index', $user->menu_routes()) || $user->hasRole('admin'))
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
          @endif

          @if (in_array('LeaveRequest', $user->menu_routes()) || $user->hasRole('admin'))
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
          @endif

          @if (in_array('todos', $user->menu_routes()) || $user->hasRole('admin'))
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
          @endif

          @if (in_array('business_contacts', $user->menu_routes()) || $user->hasRole('admin'))
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
          @endif

          @if (in_array('notes', $user->menu_routes()) || $user->hasRole('admin'))
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
          @endif

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

          @if (in_array('business_contacts', $user->menu_routes()) || $user->hasRole('admin'))
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
          @endif

        </div>
        {{-- END BLOCKS --}}
    </div>
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

        <div class="col-sm-4">
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
        </div>

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
    </div>
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

        @if (in_array('my_documents', $user->menu_routes()) || $user->hasRole('admin'))
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
        <div class="col-sm-4">
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
          </div>
        <div class="col-sm-4">
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
          </div>

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
    </div>
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

        <div class="col-sm-4">
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


          </div>
        <div class="col-sm-4">
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
          </div>
    </div>
    <div id="legal" class="tab-pane fade">
        <div class="col-sm-4">
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
          </div>
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

</div>

<script>
    function card_submenus(e){
     $(e).closest('.dropdown').find('ul').toggleClass('inline-block');
     $(e).closest('.dropdown').find('ul').css( 'min-width', '100%' );
   }
 </script>
