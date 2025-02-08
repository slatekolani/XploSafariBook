<!DOCTYPE html>
<html>
<head>
    <title>New Tour Booking</title>
</head>
<body>
    <h1>New Tour Booking</h1>
    <p>A new booking has been made. Here are the details:</p>
    <ul>
        <li>Tourist Name: {{ $data['tourist_name'] }}</li>
        <li>Phone Number: {{ $data['phone_number'] }}</li>
        <li>Email Address: <a href="mailto:{{ $data['email_address'] }}">{{$data['email_address']}}</a></li>
        <li>Collection Station: {{ $data['collection_station'] }}</li>
        <li>Message: {{ $data['message'] }}</li>
    </ul>
    <p>Please check the admin panel for more details.</p>
</body>
</html>
