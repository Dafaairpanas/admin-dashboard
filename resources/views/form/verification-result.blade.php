<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - BRO Living</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/images/BroLogo.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            /* background: linear-gradient(135deg, #3D2314 0%, #5a3820 100%); */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles */
        body::before,
        body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        body::before {
            width: 400px;
            height: 400px;
            background: #FF8300;
            top: -100px;
            right: -100px;
        }

        body::after {
            width: 300px;
            height: 300px;
            background: #FF8300;
            bottom: -50px;
            left: -50px;
        }

        .verification-card {
            background: #F5F5F5;
            border-radius: 24px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
            max-width: 550px;
            width: 100%;
            padding: 50px 40px;
            text-align: center;
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icon-container {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            position: relative;
            animation: scaleIn 0.5s ease-out 0.2s both;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .success-icon {
            background: linear-gradient(135deg, #FF8300 0%, #ff9d33 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(255, 131, 0, 0.4);
        }

        .success-icon::before {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            border: 3px solid #FF8300;
            border-radius: 50%;
            opacity: 0.3;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.3;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.1;
            }
        }

        .error-icon {
            background: linear-gradient(135deg, #d93025 0%, #ff5252 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(217, 48, 37, 0.4);
        }

        .verification-card h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #3D2314;
            letter-spacing: -0.5px;
        }

        .verification-card > p {
            color: #3D2314;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 30px;
            opacity: 0.8;
        }

        .info-box {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin: 30px 0;
            text-align: left;
            border: 2px solid #E3E3E3;
            transition: all 0.3s ease;
        }

        .info-box:hover {
            border-color: #FF8300;
            box-shadow: 0 5px 20px rgba(255, 131, 0, 0.1);
        }

        .info-box p {
            margin: 12px 0;
            color: #3D2314;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-box p:first-child {
            margin-top: 0;
        }

        .info-box p:last-child {
            margin-bottom: 0;
        }

        .info-box strong {
            color: #FF8300;
            font-weight: 600;
            min-width: 100px;
            display: inline-block;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #28a745 0%, #34ce57 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .status-badge i {
            font-size: 14px;
        }

        .btn-custom {
            background: linear-gradient(135deg, #FF8300 0%, #ff9d33 100%);
            color: white;
            border: none;
            padding: 16px 50px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(255, 131, 0, 0.3);
            margin-top: 10px;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(255, 131, 0, 0.4);
            color: white;
        }

        .btn-custom:active {
            transform: translateY(-1px);
        }

        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #E3E3E3, transparent);
            margin: 30px 0;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .verification-card {
                padding: 40px 25px;
            }

            .verification-card h1 {
                font-size: 26px;
            }

            .icon-container {
                width: 100px;
                height: 100px;
                font-size: 50px;
            }

            .btn-custom {
                padding: 14px 40px;
                font-size: 15px;
            }

            .info-box {
                padding: 20px;
            }

            .info-box p {
                font-size: 14px;
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .info-box strong {
                min-width: auto;
            }
        }

        /* Loading animation for icon */
        .icon-container i {
            animation: iconBounce 0.6s ease-out 0.4s both;
        }

        @keyframes iconBounce {
            0% {
                transform: scale(0.3);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="verification-card">
        <div class="icon-container {{ $success ? 'success-icon' : 'error-icon' }}">
            @if($success)
                <i class="fas fa-check-circle"></i>
            @else
                <i class="fas fa-times-circle"></i>
            @endif
        </div>

        <h1>{{ $title }}</h1>
        <p>{{ $message }}</p>

        @if($success && isset($submission))
            <div class="divider"></div>

            <div class="info-box">
                <p>
                    <strong><i class="fas fa-user"></i> Name:</strong>
                    <span>{{ $submission->full_name }}</span>
                </p>
                <p>
                    <strong><i class="fas fa-envelope"></i> Email:</strong>
                    <span>{{ $submission->email }}</span>
                </p>
                <p>
                    <strong><i class="fab fa-whatsapp"></i> Phone:</strong>
                    <span>{{ $submission->phone_number }}</span>
                </p>
                <p>
                    <strong><i class="fas fa-check-double"></i> Status:</strong>
                    <span class="status-badge">
                        <i class="fas fa-shield-check"></i>
                        Verified
                    </span>
                </p>
            </div>

            <div class="divider"></div>
        @endif

        <a href="{{ url('/') }}" class="btn-custom">
            <i class="fas fa-home"></i>
            Back to Home
        </a>
    </div>
</body>
</html>
