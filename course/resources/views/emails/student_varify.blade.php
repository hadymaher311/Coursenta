@component('mail::message')
# Hello {{ $student->name }}
Varify your email


@component('mail::button', ['url'=> route('varifiedEmailStu', ['email' => $student->email, 'token' => $student->varify_token])])
Varify
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent