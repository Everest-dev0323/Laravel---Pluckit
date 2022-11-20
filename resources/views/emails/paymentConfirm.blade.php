<!DOCTYPE html>
<html>
<head>
    <title>Pluckit</title>
</head>

<body>
<h2>Dear {{ $user->name }}</h2>
<br/>
<h2>Thank you for registering with pluckit!</h2>
<br/>
We have received your payment for {{ $product->name }} that you have submitted. The payment has been authorized and approved. You will receive the invoice of the payment shortly.
<br/>
<br/>
If you have any questions, feel free to contact us at 
<br/>
<a href="mail:info@pluckit.com">info@pluckit.com</a>
<br/>
<br/>
<b>
Cheers,<br/>
The Pluckit team.</b>
</body>

</html>
