@component('mail::message')
# Hi, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}

Use following OTP <b> {{ $otp }} </b> to verify your email.

Thanks,<br>
Team Bromi
@endcomponent
