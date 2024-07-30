
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
  <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd">
  @for($i =1; $i <=$locationcount;$i++ )
  <sitemap> 
    <loc>{{ url('/') }}/explore-locations{{ $i }}-en-us.xml</loc> 
  </sitemap> 
  @endfor
  @for($i =1; $i <=$count_list_exp;$i++ )
  <sitemap> 
    <loc>{{ url('/') }}/explore-attractions-category{{ $i }}-en-us.xml</loc> 
  </sitemap> 
  @endfor
  @for ($i = 1; $i <= $Sightcount; $i++)
  <sitemap> 
    <loc>{{ url('/') }}/explore-attractions{{ $i }}-en-us.xml</loc> 
  </sitemap>
 @endfor
 @for($i=1; $i <= $hotcount; $i++)
 <sitemap> 
    <loc>{{ url('/') }}/hotel-listing{{ $i }}-en-us.xml</loc> 
  </sitemap>
 @endfor
 @for($i=1; $i <= $tpHdetailcount; $i++)
 <sitemap> 
    <loc>{{ url('/') }}/explore-hotel{{ $i }}-en-us.xml</loc> 
  </sitemap>
 @endfor
 @for($i=1; $i <= $landcnt; $i++)
 <sitemap> 
    <loc>{{ url('/') }}/hotel-landing{{ $i }}-en-us.xml</loc> 
  </sitemap>
 @endfor
 @for($i=1; $i <= $neibcont; $i++)
 <sitemap> 
    <loc>{{ url('/') }}/hotel-neighborhood{{ $i }}-en-us.xml</loc> 
  </sitemap>
 @endfor
 @for($i=1; $i <= $cont_explore_count; $i++)
 <sitemap> 
    <loc>{{ url('/') }}/country-explore{{ $i }}-en-us.xml</loc> 
  </sitemap>
 @endfor
 @for($i=1; $i <= $continent_expl_count; $i++)
 <sitemap> 
    <loc>{{ url('/') }}/continent-explore{{ $i }}-en-us.xml</loc> 
  </sitemap>
 @endfor
 @for($i =1; $i <=$restcount;$i++ )
  <sitemap> 
    <loc>{{ url('/') }}/restaurant-detail{{ $i }}-en-us.xml</loc> 
  </sitemap> 
  @endfor
 @for($i =1; $i <=$landing_rest_count;$i++ )
  <sitemap> 
    <loc>{{ url('/') }}/restaurant-landing{{ $i }}-en-us.xml</loc> 
  </sitemap> 
  @endfor
</sitemapindex>
