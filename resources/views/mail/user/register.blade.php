<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Sajilo Attendance</title>
</head>

<body style="font-family: Arial, sans-serif; padding: 20px; line-height: 1.5;">
    <p>Dear {{ $user['first_name'] ?? '' }},</p>

    <p>Welcome to <strong>Sajilo Attendance</strong>! You have been successfully registered in our attendance system.
        You can use our mobile app to check in and track your attendance seamlessly.</p>

    <p><strong>Your login credentials:</strong></p>
    <div style="border: 1px solid #ddd; padding: 10px; background-color: #f9f9f9; display: inline-block;">
        <p><strong>Email:</strong> {{ $user['email'] ?? '' }}</p>
        <p><strong>Password:</strong> {{ $user['plain_password'] ?? '' }}</p>
    </div>

    <p>To log in, download the <strong>Sajilo Attendance App</strong> and enter your credentials:
    </p>

    <p>For security reasons, please change your password after your first login.</p>

    <p>If you have any issues, feel free to contact support.</p>

    <p>Best regards,</p>
    <p><strong>Sajilo Attendance Team</strong></p>
</body>

</html>
