<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset
 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
 xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
 xmlns:xhtml="http://www.w3.org/1999/xhtml"
 xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">  
    @foreach ($Location as $post)
        <url>
            <loc>{{ url('/') }}/cont-{{ $post->CountryCollaborationId }}-{{ str_replace(' ', '-', $post->Name) }}</loc>           
           
        </url>
    @endforeach
</urlset> 
