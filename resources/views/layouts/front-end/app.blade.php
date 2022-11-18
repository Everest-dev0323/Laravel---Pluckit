<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="_token" content="{{csrf_token()}}">
		<title>{{ (!empty($content['meta_title'])) ? $content['meta_title']: '' }}</title>
		<link rel="shortcut icon" href="{{ ('/public') }}/front-assets/images/fevicon.png" type="image/x-icon">
        <meta name="description" content="{{ (!empty($content['meta_description'])) ? $content['meta_description'] : '' }}" />
        <meta name="keywords" content= "{{ (!empty($content['meta_keyword'])) ? $content['meta_keyword']: '' }}" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Global site tag (gtag.js) - Google Analytics -->
<!-- Global site tag (gtag.js) - Google Ads: 395654005 -->

<script async src="https://www.googletagmanager.com/gtag/js?id=AW-395654005"></script>
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-395654005');
</script>
<!-- Event snippet for Subscribe Business Sign Up Complete conversion page -->
<script> gtag('event', 'conversion', { 'send_to': 'AW-395654005/EE4rCPyzwf0BEPXm1LwB', 'value': 99.0, 'currency': 'AUD' });
</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}
// (window,document,'script',
// 'https://connect.facebook.net/en_US/fbevents.js');
//  fbq('init', '185826319987141');
// fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1"
src="https://www.facebook.com/tr?id=185826319987141&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
         <script>
             var BASE_URL="{{ url('/') }}";
         </script>
         @include('includes.front-end.header')
    </head>

    <body class="{{ !empty($content['route']) ? $content['route'] : '' }}">
        <div id="container">
		    @include('notification')
            @include('includes.front-end.navbar')
            @yield('content')
            @include('includes.front-end.footer')
            @yield('extracontent')
        </div>
    </body>
</html>
