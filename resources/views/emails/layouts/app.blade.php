<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <style>
        /* Reset styles */
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        /* Base styles */
        body {
            margin: 0 !important;
            padding: 0 !important;
            background-color: #f4f4f4 !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }

        /* Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        /* Header */
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            text-align: center;
        }

        .email-header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .email-header p {
            color: #e8e8e8;
            margin: 10px 0 0 0;
            font-size: 16px;
        }

        /* Content */
        .email-content {
            padding: 40px 30px;
        }

        .email-content h2 {
            color: #333333;
            margin: 0 0 20px 0;
            font-size: 24px;
            font-weight: 600;
        }

        .email-content p {
            margin: 0 0 20px 0;
            color: #666666;
            font-size: 16px;
            line-height: 1.6;
        }

        /* Button */
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
        }

        .btn:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }

        /* Footer */
        .email-footer {
            background-color: #f8f9fa;
            padding: 30px 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }

        .email-footer p {
            margin: 0 0 10px 0;
            color: #6c757d;
            font-size: 14px;
        }

        .social-links {
            margin: 20px 0 0 0;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
        }

        .social-links a:hover {
            color: #667eea;
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }
            
            .email-content {
                padding: 20px 15px !important;
            }
            
            .email-header {
                padding: 20px 15px !important;
            }
            
            .email-header h1 {
                font-size: 24px !important;
            }
            
            .email-content h2 {
                font-size: 20px !important;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>{{ config('app.name') }}</h1>
            <p>{{ config('app.description', __('phpmailer.layout.app_description')) }}</p>
        </div>

        <!-- Content -->
        <div class="email-content">
            @yield('content')
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('phpmailer.common.copyright') }}</p>
            <p>{{ __('phpmailer.common.email_sent_to') }} {{ $email ?? 'you' }}.</p>
            
            @if(isset($unsubscribeUrl))
            <p><a href="{{ $unsubscribeUrl }}" style="color: #6c757d; text-decoration: none;">{{ __('phpmailer.common.unsubscribe') }}</a></p>
            @endif
            
            <div class="social-links">
                @if(config('app.social.facebook'))
                <a href="{{ config('app.social.facebook') }}">{{ __('phpmailer.layout.social_links.facebook') }}</a>
                @endif
                @if(config('app.social.twitter'))
                <a href="{{ config('app.social.twitter') }}">{{ __('phpmailer.layout.social_links.twitter') }}</a>
                @endif
                @if(config('app.social.linkedin'))
                <a href="{{ config('app.social.linkedin') }}">{{ __('phpmailer.layout.social_links.linkedin') }}</a>
                @endif
            </div>
        </div>
    </div>
</body>
</html> 