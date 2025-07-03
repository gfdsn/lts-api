<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Your Password - LTS</title>
    <style>
        /* Reset styles for email clients */
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

        /* Main styles */
        body {
            margin: 0 !important;
            padding: 0 !important;
            background-color: #f9fafb;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            text-align: center;
            padding: 48px 32px 32px;
        }

        .logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        .content {
            padding: 0 32px 48px;
            text-align: center;
        }

        .reset-title {
            font-size: 32px;
            font-weight: 600;
            color: #1f2937;
            margin: 0 0 24px 0;
        }

        .reset-text {
            font-size: 18px;
            line-height: 1.6;
            color: #6b7280;
            margin: 0 auto 32px;
            max-width: 480px;
        }

        .button-container {
            margin: 32px 0;
        }

        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #fb923c 0%, #ef4444 100%);
            color: #ffffff !important;
            text-decoration: none;
            font-weight: 500;
            font-size: 18px;
            padding: 16px 32px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }

        .reset-button:hover {
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }

        .expiry-text {
            font-size: 14px;
            color: #9ca3af;
            margin: 24px auto 0;
            max-width: 400px;
        }

        .security-notice {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 6px;
            padding: 16px;
            margin: 24px 0;
        }

        .security-notice-text {
            font-size: 14px;
            color: #92400e;
            margin: 0;
        }

        .divider {
            border-top: 1px solid #e5e7eb;
            margin: 32px 0 24px;
        }

        .no-action-text {
            font-size: 14px;
            color: #9ca3af;
        }

        .trouble-section {
            border-top: 1px solid #f3f4f6;
            margin-top: 24px;
            padding-top: 16px;
        }

        .trouble-text {
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 8px;
        }

        .url-text {
            font-size: 12px;
            color: #9ca3af;
            word-break: break-all;
        }

        .footer {
            background-color: #f9fafb;
            padding: 24px 32px;
            text-align: center;
        }

        .footer-text {
            font-size: 12px;
            color: #9ca3af;
            margin: 0 0 8px 0;
        }

        .footer-links {
            font-size: 12px;
        }

        .footer-link {
            color: #9ca3af;
            text-decoration: none;
            margin: 0 8px;
        }

        .footer-link:hover {
            color: #6b7280;
        }

        /* Mobile responsiveness */
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0 16px;
            }

            .header {
                padding: 32px 24px 24px;
            }

            .content {
                padding: 0 24px 32px;
            }

            .reset-title {
                font-size: 28px;
            }

            .reset-text {
                font-size: 16px;
            }

            .reset-button {
                font-size: 16px;
                padding: 14px 28px;
            }

            .footer {
                padding: 20px 24px;
            }
        }
    </style>
</head>
<body>
<div style="background-color: #f9fafb; padding: 48px 16px;">
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo-container">
                <img src="{{ $message->embed($logo) }}" alt="LTS Logo" class="logo">
            </div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <h2 class="reset-title">Reset Your Password</h2>

            <p class="reset-text">
                We received a request to reset your password for your LTS account. Click the button below to create a new password.
            </p>

            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button">
                    Reset Password
                </a>
            </div>

            <p class="expiry-text">This password reset link will expire in 1 hour for security reasons.</p>

            <div class="security-notice">
                <p class="security-notice-text">
                    <strong>Security Notice:</strong> If you didn't request this password reset, please ignore this email. Your account remains secure.
                </p>
            </div>

            <div class="divider"></div>

            <div class="trouble-section">
                <p class="trouble-text">
                    If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser.
                </p>
                <p class="url-text">{{ $resetUrl }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-text">© {{ date('Y') }} LTS. All rights reserved.</p>
        </div>
    </div>
</div>
</body>
</html>
