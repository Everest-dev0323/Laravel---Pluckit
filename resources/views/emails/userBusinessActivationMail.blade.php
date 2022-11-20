<!DOCTYPE html>
<html>
<head>
    <title>Pluckit</title>
</head>

<body>
<h2>Hi {{$details['email']}}</h2>
<br/>
<h2>Welcome to Pluckit! </h2>
<br/>
Please click on the below link to verify your e-mail and get the access to your pluckit account
<br/>
<br/>
<a href="{{ url('user/verify', $details['token']) }}">Verify Email</a>
<br/>
<br/>
<b>
Thanks & Regards,<br/>
Team Pluckit</b>
</body>

</html>