@extends('emails.layouts.app')

@section('content')
    <h2>{{ $title ?? 'Notification' }}</h2>
    
    <p>Hi {{ $name ?? 'there' }},</p>
    
    <p>{{ $message ?? 'You have a new notification from ' . config('app.name') . '.' }}</p>
    
    @if(isset($details))
    <div style="background-color: #f8f9fa; border-left: 4px solid #667eea; padding: 15px; margin: 20px 0; border-radius: 0 5px 5px 0;">
        <h3 style="margin: 0 0 10px 0; color: #333333; font-size: 18px;">Details:</h3>
        <p style="margin: 0; color: #666666;">{{ $details }}</p>
    </div>
    @endif
    
    @if(isset($actionUrl) && isset($actionText))
    <p>Click the button below to take action:</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $actionUrl }}" class="btn">{{ $actionText }}</a>
    </div>
    @endif
    
    @if(isset($additionalInfo))
    <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 5px; padding: 15px; margin: 20px 0;">
        <h4 style="margin: 0 0 10px 0; color: #856404;">Additional Information:</h4>
        <p style="margin: 0; color: #856404;">{{ $additionalInfo }}</p>
    </div>
    @endif
    
    <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
    
    <p>Best regards,<br>
    The {{ config('app.name') }} Team</p>
@endsection 