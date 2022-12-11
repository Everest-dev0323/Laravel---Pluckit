<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($pages as $page)
    <url>
        <loc>{{url('page',['slug'=>$page->alias])}}</loc>
        <lastmod>{{date("Y-m-d")}}</lastmod>
    </url>
@endforeach
</urlset>