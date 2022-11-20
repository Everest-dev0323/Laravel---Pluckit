<!DOCTYPE html>
<html>
<head>
    <title>Pluckit</title>
</head>

<body>
<h2>Hi {{$user['email']}}</h2>
<br/>
<h2>Welcome to Pluckit! </h2>
<br/>
Please click on the below link to reset your password
<br/>
<br/>
<a href="{{ url('user/reset-password/'.$code) }}">Reset Password</a>
<br/>
<br/>
<b>
Thanks & Regards,<br/>
Team Pluckit</b>
</body>

</html>