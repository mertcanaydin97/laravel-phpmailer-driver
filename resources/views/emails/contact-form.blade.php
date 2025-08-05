@extends('emails.layouts.app')

@section('content')
    <h2>New Contact Form Submission</h2>
    
    <p>Hi {{ $recipientName ?? 'there' }},</p>
    
    <p>You have received a new contact form submission from your website. Here are the details:</p>
    
    <div style="background-color: #f8f9fa; border: 1px solid #e9ecef; border-radius: 5px; padding: 20px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #333333;">Contact Information</h3>
        
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #333333; width: 30%;">Name:</td>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; color: #666666;">{{ $name ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #333333;">Email:</td>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; color: #666666;">
                    <a href="mailto:{{ $email ?? '' }}" style="color: #667eea;">{{ $email ?? 'Not provided' }}</a>
                </td>
            </tr>
            @if(isset($phone))
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #333333;">Phone:</td>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; color: #666666;">{{ $phone }}</td>
            </tr>
            @endif
            @if(isset($subject))
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #333333;">Subject:</td>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; color: #666666;">{{ $subject }}</td>
            </tr>
            @endif
            <tr>
                <td style="padding: 8px 0; font-weight: 600; color: #333333;">Date:</td>
                <td style="padding: 8px 0; color: #666666;">{{ $submittedAt ?? date('F j, Y \a\t g:i A') }}</td>
            </tr>
        </table>
    </div>
    
    @if(isset($message))
    <div style="background-color: #ffffff; border: 1px solid #e9ecef; border-radius: 5px; padding: 20px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #333333;">Message</h3>
        <div style="color: #666666; line-height: 1.6; white-space: pre-wrap;">{{ $message }}</div>
    </div>
    @endif
    
    @if(isset($additionalData) && count($additionalData) > 0)
    <div style="background-color: #f8f9fa; border: 1px solid #e9ecef; border-radius: 5px; padding: 20px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #333333;">Additional Information</h3>
        
        <table style="width: 100%; border-collapse: collapse;">
            @foreach($additionalData as $key => $value)
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #333333; width: 30%;">{{ ucfirst(str_replace('_', ' ', $key)) }}:</td>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; color: #666666;">{{ $value }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif
    
    @if(isset($replyUrl))
    <p>Click the button below to reply to this message:</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $replyUrl }}" class="btn">Reply to Message</a>
    </div>
    @endif
    
    @if(isset($adminUrl))
    <p>View in admin panel:</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $adminUrl }}" class="btn">View in Admin</a>
    </div>
    @endif
    
    <p>This is an automated message from your contact form. Please respond to the sender directly using the email address provided above.</p>
    
    <p>Best regards,<br>
    {{ config('app.name') }} Contact System</p>
@endsection 