@component('mail::message')

<p class="title-bg" style="text-align: center; padding: 3rem; font-size: 27px; background-color: #e1393b; color:#fff; font-weight: bold">
	Internal Memo
</p>

Dear **{{$memo->initiator->FullName}},**

{{-- @if(!is_null($current_approver))
Your Memo was recently approved by {{ $current_approver ?? '' }}
@endif --}}
This is to notify that your memo request has been re-routed:

-------------------------------------------------------------------

**Subject: **  {{ $memo->subject }}

**Purpose: **  {{ $memo->purpose }}

**Content: **  {!! $memo->body !!}

**Comment: ** {!! $memo->ApproverComment ?? '-' !!}

**Date Created: **  {{ $memo->created_at->toFormattedDateString() }}

**Approvers:**  {{ $memo->approvers() }}

--------------------------------------------------------------------



Cheers.

@component('mail::button', ['url' => url('/memos?tab=3')])
Go to Memo Inbox
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
