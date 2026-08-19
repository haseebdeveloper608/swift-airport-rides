<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Contact Inquiry</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1f2937;">
    <h2 style="margin-bottom: 16px;">New Contact Inquiry</h2>
    <p><strong>From:</strong> {{ $contactMessage->first_name }} {{ $contactMessage->last_name }}</p>
    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
    <p><strong>Phone:</strong> {{ $contactMessage->phone ?? 'N/A' }}</p>
    <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
    <p><strong>Message:</strong></p>
    <p style="padding: 12px; background: #f8fafc; border-radius: 8px;">{{ $contactMessage->message }}</p>
</body>
</html>
