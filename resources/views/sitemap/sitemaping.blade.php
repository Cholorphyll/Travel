<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sightmap Links</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  @for($i =1; $i <=$locationcount;$i++ ) 
    <p><a href="{{ url('/') }}/explore-locations{{ $i }}">{{ url('/') }}/explore-locations{{ $i }}</a></p>   
  @endfor
  @for ($i = 1; $i <= $Sightcount; $i++)
    <p><a href="{{ url('/') }}/explore-attractions{{ $i }}">{{ url('/') }}/explore-attractions{{ $i }}</a></p> 
 @endfor
 @for($i=1; $i <= $hotcount; $i++)
    <p><a href="{{ url('/') }}/hotel-listing{{ $i }}">{{ url('/') }}/hotel-listing{{ $i }}</a></p> 

 @endfor
 @for($i=1; $i <= $tpHdetailcount; $i++) 
    <p><a href="{{ url('/') }}/explore-hotel{{ $i }}">{{ url('/') }}/explore-hotel{{ $i }}</a></p> 
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>