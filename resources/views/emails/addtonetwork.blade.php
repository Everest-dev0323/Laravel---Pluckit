<!DOCTYPE html>
<html>
<head>
    <title>Pluckit</title>
</head>

<body>
<h2>Hi {{ $user->name }}</h2>
<br/>
<br/>
{{ !empty($fromUser) ? $fromUser->name : '-' }} has added you to their Pluckit Network.
<br/>
<br/>
<a href="{{ url('home').'?login=1' }}">Click Here</a> to check
<br/>
<br/>
<b>
Cheers,<br/>
Team Pluckit</b>
</body>

</html>