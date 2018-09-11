@component('mail::message')
# Hi, {{ ucwords($client_details->Customer) ?? '-' }},

Please Find attached your receipt!



Thanks,<br>
{{ config('app.name') }}
@endcomponent
