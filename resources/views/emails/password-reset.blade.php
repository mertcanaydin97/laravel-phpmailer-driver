@extends('emails.layouts.app')

@section('content')
    <h2>{{ __('phpmailer.password_reset.title') }}</h2>
    
    <p>{{ __('phpmailer.common.hello') }} {{ $name ?? 'there' }},</p>
    
    <p>{{ __('phpmailer.password_reset.received_request', ['app_name' => config('app.name')]) }}</p>
    
    <p>{{ __('phpmailer.password_reset.click_button', ['expires_in' => $expiresIn ?? '60 minutes']) }}</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $resetUrl }}" class="btn">{{ __('phpmailer.password_reset.reset_button') }}</a>
    </div>
    
    <p style="font-size: 14px; color: #888888;">
        {{ __('phpmailer.password_reset.fallback_text') }}<br>
        <a href="{{ $resetUrl }}" style="color: #667eea; word-break: break-all;">{{ $resetUrl }}</a>
    </p>
    
    <p>{{ __('phpmailer.password_reset.security_notice', ['expires_in' => $expiresIn ?? '60 minutes']) }}</p>
    
    <p>{{ __('phpmailer.password_reset.questions') }}</p>
    
    <p>{{ __('phpmailer.common.best_regards') }},<br>
    {{ __('phpmailer.password_reset.team_signature', ['app_name' => config('app.name')]) }}</p>
    
    <hr style="border: none; border-top: 1px solid #e9ecef; margin: 30px 0;">
    
    <p style="font-size: 12px; color: #888888;">
        {{ __('phpmailer.password_reset.automated_message', ['email' => $email]) }}
    </p>
@endsection 