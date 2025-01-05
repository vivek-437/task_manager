<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'Welcome to Our Platform' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f6f9;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2 class="text-center">Welcome to Our Platform !</h2>

        <p class="text-center">Thank you for registering with us. We are excited to have you on board!</p>

        <p class="text-center">Here are your account details:</p>
        <ul>
            {{ $body }}
        </ul>

        <p class="text-center">For your security, we recommend changing your password after logging in for the first time.</p>

        <div class="text-center mt-4">
            <a href="https://your-website-link.com" class="btn-custom" target="_blank">Go to Website</a>
        </div>

        <div class="footer">
            <p>If you have any questions or need assistance, feel free to contact us.</p>
            <p>Thank you for choosing us!</p>
        </div>
    </div>
</body>
</html>
