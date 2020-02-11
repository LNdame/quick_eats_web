@component('mail::message')
Hi {{$user->name. ' '. $user->surname}},
<br/>
Your Quick Eats Account has been successfully created.
<br/>
Please verify your account by clicking on the link below.<br/>
@component('mail::button', ['url' => $url])
Verify Account
@endcomponent

Thanks,<br/>
{{ config('app.name') }}
@endcomponent
