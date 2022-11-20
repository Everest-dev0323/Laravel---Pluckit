<!DOCTYPE html>
<html>
<head>
    <title>Pluckit</title>
</head>

<body>
<h2>Hi Admin</h2>
<br/>
Below is the message sent using contact form of pluckit.com.au
<br/>
<br/>
Name: {{ $details['name'] }}<br/>
Email: {{ $details['email'] }}<br/>
Phone Number: {{ !empty($details['phone']) ? $details['phone'] : '' }}<br/>
Message: {{ $details['message'] }}
<br/>
<br/>
<b>
Thanks & Regards,<br/>
Team Pluckit</b>
</body>

</html>