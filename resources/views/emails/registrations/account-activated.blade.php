@component('mail::message')
Hi {{$user->name. ' '.$user->surname}}<br/>

Your account has been {{$status}}. For further enquiries contact admin, if there is any issue with the action.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
