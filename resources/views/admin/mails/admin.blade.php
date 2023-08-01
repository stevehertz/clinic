<x-mail::message>
# Welcome

<p>An Account has been create for you to help in process managements in Sais eye clinic.</p>

<p>Your login details are:</p>

<p>Email: <strong>{{ $details['email'] }}</strong></p>
<p>Password: <strong>{{ $details['email'] }}</strong></p>

<p> Click on the link below to login </>
<x-mail::button :url="{{ $details['login'] }}">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
