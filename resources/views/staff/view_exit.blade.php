@extends('layouts.master')

@push('styles')
	<style>
		.modal.fade.fill-in.in {
            background-color: rgba(107, 101, 101, 0.73);
        }

        thead tr {
      font-weight: bold;
      color: #000;
    }

    /* .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control, .select2 {
        font-weight: normal !important;
        color: #aaaaaa !important;
        font-family: "Karla", sans-serif !important;
    }

    .form-control{
        font-family: "Karla", sans-serif !important;
    }

    body {
        color: #444;
        background-color: #ebeff2 !important;
        font-size: 14px;
        font-family: "Karla", 'Helvetica Neue', Helvetica, Arial, sans-serif;
        zoom: 99%;
    } */
	</style>
@endpush

@section('content')
   <div class="card-box">
       <div class="card-title">Exit Interview Response</div>
        <div class="row m-b-10 m-t-20">
            <div class="col-md-4">
                <span class="bio-label">Staff Name</span>
                <h5>{{ $view->staff->FullName }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">Department</span>
                <h5>{{ $view->department->Department }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">Interview Date</span>
                <h5>{{ nice_date($view->InterviewDate) }}</h5>
            </div>
        </div>
        <hr>
        <div class="row m-b-10 m-t-20">
            <div class="col-md-4">
                <span class="bio-label">1. Reason for Leaving</span>
                <h5>{{ $view->exit_reason->ExitReason }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">2. If Relocating please specify reason why</span>
                <h5>{{ $view->relocation->RelocationReason }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">3. If applicable, what is your forwarding address</span>
                <h5>{{ $view->ForwardAddress }}</h5>
            </div>
        </div>
        <hr>
        <div class="row m-b-10 m-t-20">
            <div class="col-md-4">
                <span class="bio-label">4. What did you like least about your employment experience at the organization?</span>
                <h5>{{ $view->LeastEmployment }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">5. Why did you come to work for this organization?</span>
                <h5>{{ $view->WorkReason }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">6. What did you like most about your employment experience at the organization?</span>
                <h5>{{ $view->MostEmployment }}</h5>
            </div>
        </div>
        <hr>
        <div class="row m-b-10 m-t-20">
            <div class="col-md-4">
                <span class="bio-label">7. If accepting another employment please indicate your main reason</span>
                <h5>{{ $view->employment_reason->EmploymentReason }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">8. Would you consider working here again?</span>
                <h5>{{ $view->WorkAgain }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">9. I have a good working relationship with co-workers</span>
                <h5>{{ $view->options_rel->Options }}</h5>
            </div>
        </div>
        <hr>
        <div class="row m-b-10 m-t-20">
            <div class="col-md-4">
                <span class="bio-label">10. I had a good working relationship with my supervisor</span>
                <h5>{{ $view->options_sup->Options }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">11. Training or job development met expectations.</span>
                <h5>{{ $view->options_job->Options }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">12. Work Assignments were distributed evenly.</span>
                <h5>{{ $view->options_work_assignment->Options }}</h5>
            </div>
        </div>
        <hr>
        <div class="row m-b-10 m-t-20">
            <div class="col-md-4">
                <span class="bio-label">13. I had a clear understanding of my job duties.</span>
                <h5>{{ $view->options_job_understanding->Options }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">14. Working conditions met expectations.</span>
                <h5>{{ $view->options_work_condition->Options }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">15. The pay was fair for work required.</span>
                <h5>{{ $view->options_work_pay->Options }}</h5>
            </div>
        </div>
        <hr>
        <div class="row m-b-10 m-t-20">
            <div class="col-md-4">
                <span class="bio-label">16. The Benefits were competitive</span>
                <h5>{{ $view->options_work_benefit->Options }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">17. My work schedule met my needs.</span>
                <h5>{{ $view->options_work_schedule->Options }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">18. Overall, I was satisfied with my job.</span>
                <h5>{{ $view->options_work_satisfaction->Options }}</h5>
            </div>
        </div>
        <hr>
        <div class="row m-b-10 m-t-20">
            <div class="col-md-4">
                <span class="bio-label">19. Staff Comment</span>
                <h5>{{ $view->WorkComment }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">20. Outstanding Obligation</span>
                <h5>{{ $view->obligation->Obligation }}</h5>
            </div>
            <div class="col-md-4">
                <span class="bio-label">21. How do you intend to pay your outstanding obligation?</span>
                <h5>{{ $view->PayObligation }}</h5>
            </div>
        </div>
        <hr>
        <div class="row m-b-10 m-t-20">
            <div class="col-md-6">
                <span class="bio-label">22. Name of HR Officer</span>
                <h5>{{ $view->hr_officer->FullName }}</h5>
            </div>
        </div>
   </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>


    <script>
        
    </script>
@endpush