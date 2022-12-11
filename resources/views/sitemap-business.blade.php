<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($business_listings as $business)
    <url>
        <loc>{{url('business',['slug'=>$business->business_slug])}}</loc>
        <lastmod>{{date("Y-m-d")}}</lastmod>
    </url>
@endforeach
    
</urlset>