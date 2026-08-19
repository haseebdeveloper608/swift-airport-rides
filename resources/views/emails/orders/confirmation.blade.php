<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111;">
    <h1>Thank you for your booking!</h1>
    <p>Hi {{ $order->first_name }},</p>
    <p>Your booking for <strong>{{ $order->car_name }}</strong> from <strong>{{ $order->pickup }}</strong> to <strong>{{ $order->dropoff }}</strong> has been confirmed.</p>
    <p>
        Pickup date: {{ optional($order->pickup_date)->format('j M Y') ?? 'N/A' }}<br>
        Pickup time: {{ $order->pickup_time ?? 'N/A' }}<br>
        Total paid: £{{ number_format($order->amount, 2) }}
    </p>
    <p>We will contact you with driver details shortly. If you have any questions, reply to this email.</p>
    <p>Safe travels,<br>Heathrow Airport Rides</p>
</body>
</html>
