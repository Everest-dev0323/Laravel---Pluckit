<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($category as $cat)
    <url>
        <loc>{{ url('/search?cat='.$cat->name.'&hid_type=category') }}</loc>
        <lastmod>{{date("Y-m-d")}}</lastmod>
    </url>
@endforeach
</urlset>