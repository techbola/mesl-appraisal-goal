@component('mail::message')
Title : Memo Approval.

Dear {{$memo->initiator->FullName}},

{{-- @if(!is_null($current_approver)) --}}
Your Memo was recently approved.
{{-- @endif --}}

**Memo Subject: **  {{ $memo->subject }}

**Date Created: **  {{ $memo->created_at }}
--------------------------------------------

**Approvers: **  {{ $memo->approvers() }}

@if(!is_null($next_approver))
**Next Approver:** {{ $next_approver->fullName }}.
@else
**Your memo has been approved successfully but awaits your recipients final confirmation** .
@endif


Cheers.

@component('mail::button', ['url' => url('/memos?tab=3')])
Go to Memo Inbox
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
