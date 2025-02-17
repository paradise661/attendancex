<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>
</head>

<body style="font-family: Arial, sans-serif; padding: 20px; line-height: 1.5;">
    @if ($requestType == 'attendanceRequest')
        <h3>Subject: Attendance Request Submitted</h3>
        <p>{{ $user['first_name'] ?? ' ' }} has submitted an attendance request.</p>
    @else
        <h3>Subject: Leave Request Submitted</h3>
        <p>{{ $user['first_name'] ?? ' ' }} has submitted a leave request.</p>
    @endif
    <p>Please review and take the necessary action.</p>

    <p>Best regards,</p>
    <p><strong>Sajilo Attendance</strong></p>
</body>

</html>
