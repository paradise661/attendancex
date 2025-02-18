<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Status Update</title>
</head>

<body style="font-family: Arial, sans-serif; padding: 20px; line-height: 1.5;">
    <p>Dear {{ $data->employee->first_name ?? '' }},</p>

    @if ($requestType == 'attendanceRequest')
        <p>We are writing to inform you that your attendance request for the date
            <strong>{{ $data->date ?? '' }}</strong> has been <strong>{{ $data->status ?? '' }}</strong>.
        </p>
    @else
        <p>We are writing to inform you that your leave request for the date <strong>
                {{ $data->from_date == $data->to_date ? $data->from_date : "{$data->from_date} to {$data->to_date}" }}</strong>
            has been <strong>{{ $data->status ?? '' }}</strong>.</p>
    @endif

    @if ($data->status === 'Approved')
        <p>Your request has been thoroughly reviewed and approved. You are now authorized to proceed with your work or
            leave as planned.</p>
    @elseif($data->status === 'Rejected')
        <p>Regrettably, your request has been rejected. Should you have any questions or require clarification, we
            kindly request you to contact the HR department.</p>
    @else
        <p>Your request is currently under review. You will be notified as soon as a decision has been made.</p>
    @endif

    <p>Thank you for utilizing the <strong>Sajilo Attendance</strong> system. Should you need further assistance, please
        do not hesitate to reach out to our support team.</p>

    <p>Best regards,</p>
    <p><strong>Sajilo Attendance Team</strong></p>
</body>

</html>
