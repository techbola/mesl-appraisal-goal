@component('mail::message')

Dear **{{$memo->initiator->FullName}}**,

{{-- @if(!is_null($current_approver)) --}}
**Your Memo has been approved.**
{{-- @endif --}}

**Memo Subject: **  {{ $memo->subject }}

**Date Created: **  {{ $memo->created_at }}
--------------------------------------------

**Approvers: **  {{ $memo->approvers() }}



Cheers.

@component('mail::button', ['url' => url('/memos')])
Go to Memos
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
