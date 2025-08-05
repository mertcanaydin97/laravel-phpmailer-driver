@extends('emails.layouts.app')

@section('content')
    <h2>{{ __('phpmailer.welcome.title', ['app_name' => config('app.name')]) }}</h2>
    
    <p>{{ __('phpmailer.common.hello') }} {{ $name ?? 'there' }},</p>
    
    <p>{{ __('phpmailer.welcome.thank_you', ['app_name' => config('app.name')]) }}</p>
    
    <p>{{ __('phpmailer.welcome.get_started') }}</p>
    
    <ul style="margin: 20px 0; padding-left: 20px; color: #666666;">
        <li style="margin-bottom: 10px;">{{ __('phpmailer.welcome.steps.complete_profile') }}</li>
        <li style="margin-bottom: 10px;">{{ __('phpmailer.welcome.steps.explore_features') }}</li>
        <li style="margin-bottom: 10px;">{{ __('phpmailer.welcome.steps.connect_users') }}</li>
        <li style="margin-bottom: 10px;">{{ __('phpmailer.welcome.steps.check_documentation') }}</li>
    </ul>
    
    @if(isset($verificationUrl))
    <p>{{ __('phpmailer.welcome.verify_email') }}</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $verificationUrl }}" class="btn">{{ __('phpmailer.welcome.verify_button') }}</a>
    </div>
    @endif
    
    @if(isset($loginUrl))
    <p>{{ __('phpmailer.welcome.access_account') }}</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $loginUrl }}" class="btn">{{ __('phpmailer.welcome.access_button') }}</a>
    </div>
    @endif
    
    <p>{{ __('phpmailer.welcome.questions') }}</p>
    
    <p>{{ __('phpmailer.common.best_regards') }},<br>
    {{ __('phpmailer.welcome.team_signature', ['app_name' => config('app.name')]) }}</p>
@endsection 