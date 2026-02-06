<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi WhatsApp</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
            padding: 40px 20px;
            text-align: center;
        }
        .email-header img {
            max-width: 180px;
            height: auto;
            margin-bottom: 20px;
        }
        .email-header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .email-body {
            padding: 40px 30px;
        }
        .email-body h2 {
            color: #333333;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .email-body p {
            color: #666666;
            line-height: 1.6;
            margin-bottom: 15px;
            font-size: 15px;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #FF6B35;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 5px 0;
            color: #333333;
        }
        .info-box strong {
            color: #FF6B35;
        }
        .verify-button {
            display: inline-block;
            background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            margin: 25px 0;
            transition: transform 0.2s;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }
        .verify-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .alternative-link {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            word-break: break-all;
        }
        .alternative-link p {
            font-size: 12px;
            color: #999999;
            margin-bottom: 10px;
        }
        .alternative-link a {
            color: #FF6B35;
            font-size: 13px;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .email-footer p {
            color: #999999;
            font-size: 13px;
            margin: 5px 0;
        }
        .warning-text {
            color: #dc3545;
            font-size: 13px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('images/logos/broliving.svg') }}" alt="BRO Living">
            <h1>Verifikasi Email</h1>
        </div>

        <div class="email-body">
            <h2>Halo, {{ $submission->full_name }}!</h2>

            <p>Thanks for your interest in BRO Living. We need to verify your Email:</p>

            <div class="info-box">
                <p><strong>Name:</strong> {{ $submission->full_name }}</p>
                <p><strong>Email:</strong> {{ $submission->email }}</p>
                <p><strong>Phone Number:</strong> {{ $submission->phone_number }}</p>
                @if($submission->company_name)
                <p><strong>Company:</strong> {{ $submission->company_name }}</p>
                @endif
            </div>

            <p>Please click the button below to verify your email:</p>

            <div class="button-container">
                <a href="{{ $verificationUrl }}" class="verify-button">
                    <i class="fas fa-check-circle me-2"></i>This is Me
                </a>
            </div>

            <div class="alternative-link">
                <p>Or use this link:</p>
                <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a>
            </div>

            <p class="warning-text">
                <strong>⚠️ Warning:</strong> This verification link will expire in 24 hours.
            </p>

            <p style="margin-top: 30px;">If you did not request this verification, please ignore this email.</p>
        </div>

        <div class="email-footer">
            <p><strong>BRO Living</strong></p>
            <p>hello@brolivingid.com | 081234567890 | Pati</p>
            <p style="margin-top: 15px; font-size: 12px;">
                © {{ date('Y') }} Rajawali Perkasa Furniture. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
