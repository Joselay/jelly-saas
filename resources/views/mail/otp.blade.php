<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your OTP - Jelly</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');
    </style>
</head>
<body>
    <div>
        <div>
            <img src="https://i.ibb.co/D5BjHy5/jelly.png" alt="Jelly Logo">
        </div>
        <h3>Verify Your OTP</h3>
        <p>To proceed, please use the OTP code below. This code is valid for <strong>5 minutes</strong>.</p>
        <div>
            <h1>{{$otp}}</h1>
        </div>
        <p>If you did not request this code, please ignore this email or <a href="mailto:support@jellyapp.com">contact support</a>.</p>
        <div>
            <p>&copy; {{ date('Y') }} Jelly. All rights reserved.</p>
            <p>Need help? Visit our <a href="https://github.com/Joselay/jelly-saas">Support Center</a>.</p>
        </div>
    </div>
</body>
</html>