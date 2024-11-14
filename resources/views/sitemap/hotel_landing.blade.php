<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   
    @foreach ($landing as $post)
        <url>
    <loc>{{ url('/') }}/ho-{{ $post->slugid }}-{{ $post->Slug }}?st={{$post->stars}}</loc>         
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>  
        </url>

        @php
        $amenities = explode(', ', $post->amenity_names);
        @endphp

        @foreach($amenities as $amenity)
        <url>
        <loc>{{ url('/') }}/ho-{{ $post->slugid }}-{{ $post->Slug }}?amenity={{$amenity}}</loc>         
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>  
        </url>       
        @endforeach
    @endforeach

    
</urlset> 