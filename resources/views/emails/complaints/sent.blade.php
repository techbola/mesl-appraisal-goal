@component('mail::message')

{{-- <p class="title-bg" style="text-align: center; padding: 3rem; font-size: 27px; background-color: #e1393b; color:#fff; font-weight: bold">
	Internal Memo
</p> --}}

Dear **{{$complaint->user->FullName}},**



-------------------------------------------------------------------

**Category: **  {{ $complaint->category->name }}

**Location: **  {{ $complaint->location->Location }}

**Content: **  {!! $complaint->complaints !!}

**Date Created: **  {{ $complaint->created_at->toFormattedDateString() }}

--------------------------------------------------------------------




Cheers.

@component('mail::button', ['url' => url('/facility-management/complaints?tab=3')])
Go to Memo Inbox
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
