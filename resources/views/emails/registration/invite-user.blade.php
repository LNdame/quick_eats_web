@component('mail::message')
    Hi {{$user->name. ' '. $user->surname}},
    <br/>
    Your company <b>{{$vendor->trading_name}}</b> has been invited to join QuickEats.<br/>
    Your initial password is <b>{{$password}}</b> and <br/>
    Your username is <b>{{$user->email}}</b>
    <br/>
    Please verify your account by clicking on the link below.<br/>
    @component('mail::button', ['url' => $url])
        Verify Account
    @endcomponent

Thanks,<br/>
{{ config('app.name') }}
@endcomponent
