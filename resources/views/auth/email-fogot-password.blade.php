@component('mail::message')
    @component('mail::panel')
        # Forgot Your password?
    @endcomponent

    Hi, {{ $name }}.
    There was a request to change your password!
    If did not make this request, just ignore this email. Otherwise, please click the button below to change your password:

    @component('mail::button', ['url' => url('reset-password/' . $token)])
        Reset Password
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
