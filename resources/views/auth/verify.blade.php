@extends('layouts.app')

@section('content')
    <style>
        .verification-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            padding: 40px;
            text-align: center;
            animation: slideUp 0.6s ease-out;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            margin-top: 50px;
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

        .email-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.4);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(102, 126, 234, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }

        .email-icon i {
            color: white;
            font-size: 32px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 15px;
        }

        .subtitle {
            font-size: 16px;
            color: #718096;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .alert {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            animation: slideDown 0.5s ease-out;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert i {
            font-size: 18px;
        }

        .message {
            color: #4a5568;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .resend-form {
            margin-top: 20px;
        }

        .resend-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .resend-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .resend-button:active {
            transform: translateY(0);
        }

        .footer-text {
            margin-top: 30px;
            color: #a0aec0;
            font-size: 14px;
        }

        .decorative-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 60px;
            height: 60px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 40px;
            height: 40px;
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 80px;
            height: 80px;
            bottom: 15%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @media (max-width: 480px) {
            .verification-container {
                padding: 30px 25px;
                margin: 10px;
            }

            .title {
                font-size: 24px;
            }

            .subtitle {
                font-size: 14px;
            }

            .resend-button {
                padding: 12px 25px;
                font-size: 14px;
            }
        }

        /* Loading animation for button */
        .loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .loading::after {
            content: '';
            width: 20px;
            height: 20px;
            margin-left: 10px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="decorative-elements">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>

    <div class="verification-container">
        <div class="email-icon">
            <i class="fas fa-envelope"></i>
        </div>

        <h1 class="title">Verify Your Email</h1>
        <p class="subtitle">We've sent a verification link to your email address</p>

        <!-- Success Alert (show this when session('resent') is true) -->
        <!-- <div class="alert">
                        <i class="fas fa-check-circle"></i>
                        <span>A fresh verification link has been sent to your email address.</span>
                    </div> -->

        <div class="message">
            Before proceeding, please check your email for a verification link.
            If you didn't receive the email, you can request a new one below.
        </div>

        <form class="resend-form" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="resend-button" onclick="handleResend(this)">
                <i class="fas fa-paper-plane"></i>
                Send New Link
            </button>
        </form>

        <p class="footer-text">
            Didn't receive anything? Check your spam folder or contact support.
        </p>
    </div>

    <script>
        function handleResend(button) {
            // Add loading state
            button.classList.add('loading');
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

            // Reset after form submission (this won't execute if page redirects)
            setTimeout(() => {
                button.classList.remove('loading');
                button.innerHTML = '<i class="fas fa-paper-plane"></i> Send New Link';
            }, 3000);
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.verification-container');

            container.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });

            container.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
@endsection
