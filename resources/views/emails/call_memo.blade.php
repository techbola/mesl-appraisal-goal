@component('mail::message')
# Hi,

You are receiving this meeting note because you were part of the meeting with {{ $memo->customer->Customer }}.<br>

Please see the attached file for the detailed meeting note.

# Summary

<b>Attendeees:</b> {{ $memo->Attendees ?? '—' }}.
<br>
<b>Meeting Date:</b> {{ $memo->MeetingDate ?? '—' }}.
<br>
<b>Location:</b> {{ $memo->Location ?? '—' }}.
<br>
<b>Handouts:</b> {{ $memo->Handouts ?? '—' }}.

@foreach ($memo->discussions as $discuss)

  @component('mail::panel')
    <b>Discussion Point:</b> {!! $discuss->DiscussionPoint !!}
  @endcomponent

@endforeach


Thanks,<br>
{{ config('app.name') }}
@endcomponent
