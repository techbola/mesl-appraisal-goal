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
    <a data-toggle="tab" href="#operations">Operation</span></a>
  </li>
  <li>
    <a data-toggle="tab" href="#legal">Legal</span></a>
  </li>
</ul>

<div class="tab-content">

    <div id="general" class="tab-pane fade in active">

      {{-- START BLOCKS --}}
      <div class="row">

          <div class="col-sm-4">
            <a href="{{ route('bulletin_board') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/suitcase.svg') }}" alt="" width="40px" style="filter: sepia(0.3);">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Bulletin Board</div>
                  {{-- <h3 class="no-margin p-b-5 text-info bold">{{ count($bulletins) }}</h3> --}}
                </div>
              </div>
            </a>
          </div>
      
          <div class="col-sm-4">
            <a href="{{ route('events') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Event Scheduling</div>
                  {{-- <h3 class="no-margin p-b-5 text-info bold">{{ count($events) }}</h3> --}}
                </div>
              </div>
            </a>
          </div>
      
          <div class="col-sm-4">
            <a href="{{ route('todos') }}?date={{ date('Y-m-d') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Staff Anniversaries</div>
                </div>
              </div>
            </a>
          </div>
      
          <div class="col-sm-4">
            <a href="{{ route('todos') }}?date={{ date('Y-m-d') }}" class="no-color">
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

          <div class="col-sm-4">
            <a href="{{ route('memos.index') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/suitcase.svg') }}" alt="" width="40px" style="filter: sepia(0.3);">
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
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Requests</div>
                  {{-- - Travel, Procurement, Leave, Loan, Store --}}
                </div>
              </div>
            </a>
          </div>
      
          <div class="col-sm-4">
            <a href="{{ route('todos') }}?date={{ date('Y-m-d') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Todo List</div>
                </div>
              </div>
            </a>
          </div>
      
          <div class="col-sm-4">
            <a href="{{ route('business_contacts') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
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
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
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
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
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
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
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
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
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
    <div id="hr" class="tab-pane fade">
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
      <div class="col-sm-4">
          <a href="{{ route('staff.index') }}" class="no-color">
            <div class="card-box">
              <div class="inline m-r-10 m-t-10">
                <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
              </div>
              <div class="inline">
                <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Employee Search</div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('CourseDashboard') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Learning Management System</div>
                </div>
              </div>
            </a>
          </div>
        <div class="col-sm-4">
            <a href="" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Performance Management</div>
                </div>
              </div>
            </a>
          </div>
        <div class="col-sm-4">
            <a href="" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">User Profiling</div>
                </div>
              </div>
            </a>
          </div>
        <div class="col-sm-4">
            <a href="{{ route('ScheduleTraining') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Training Schedule</div>
                </div>
              </div>
            </a>
          </div>
        <div class="col-sm-4">
            <a href="{{ route('Policy') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Policies & Procedures</div>
                </div>
              </div>
            </a>
          </div>
    </div>
    <div id="it" class="tab-pane fade">
        <div class="col-sm-4">
            <a href="{{ route('company_menus') }}" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Menu Assignment</div>
                </div>
              </div>
            </a>
          </div>
    </div>
    <div id="it" class="tab-pane fade">
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
        <div class="col-sm-4">
            <a href="" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Service Desk</div>
                </div>
              </div>
            </a>
          </div>
        <div class="col-sm-4">
            <a href="" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Systems Monitoring</div>
                </div>
              </div>
            </a>
          </div>
    </div>
    <div id="finance" class="tab-pane fade">
        <div class="col-sm-4">
            <a href="" class="no-color">
              <div class="card-box">
                <div class="inline m-r-10 m-t-10">
                  <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                </div>
                <div class="inline">
                  <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Accounting</div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-sm-4">
              <a href="{{ route('assets') }}" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Fixed Asset Register</div>
                  </div>
                </div>
              </a>
            </div>
          <div class="col-sm-4">
              <a href="" class="no-color">
                <div class="card-box">
                  <div class="inline m-r-10 m-t-10">
                    <img class="icon" src="{{ asset('assets/img/icons/clipboard.svg') }}" alt="" width="40px">
                  </div>
                  <div class="inline">
                    <div class="font-title f16 bold m-b-10 text-uppercase hint-text">Payroll Processing</div>
                  </div>
                </div>
              </a>
            </div>


    </div>
    <div id="operations" class="tab-pane fade"></div>
    <div id="legal" class="tab-pane fade"></div>

</div>