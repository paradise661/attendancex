<!-- resources/views/emails/send_otp.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Code</title>
</head>

<body style="font-family: Arial, sans-serif; padding: 20px; line-height: 1.5;">
    <p>Dear {{ $user->first_name ?? 'Employee' }},</p>

    <p>We are writing to inform you that you have requested an OTP (One-Time Password) for authentication purposes.
        Below is your OTP code:</p>

    <h3 style="color: #2d2d2d; font-size: 24px;">{{ $user->otp ?? '-' }}</h3>

    <p>Please enter this code to complete your verification process. The OTP is valid for a limited time and can only be
        used once.</p>

    <p>If you did not request this OTP or believe this is an error, please contact our support team immediately.</p>

    <p>Thank you for using our system.</p>

    <p>Best regards,</p>
    <p><strong>Sajilo Attendance</strong></p>
</body>

</html>
