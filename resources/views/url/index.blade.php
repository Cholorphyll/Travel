<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Travel Urls!</title>
  </head>
  <body>
  <div class="container-sm" style="max-width: 950px;">
    <h6 class="m-3" style="float: right;"><a href="{{route('add_url')}}">Add url+</a></h6>
    <div class="col-md-6 mt-3">
      Search URL
      <input type="text" class="form-control " style="float: right;" id="searchdata">
    </div>
  <table class="table getdata">
  <thead>
    <tr>
      <th scope="col">Url</th>
      <th scope="col">FAQ</th>
      <th scope="col">Descriptions</th>
      <th scope="col">Data Entry</th>
    </tr>
  </thead>
  <tbody>
  
  @if(!$getweb->isEmpty())   
      @foreach($getweb as $getweb)  
    <tr>
    
      <td>{{$getweb->url}}</td>
      <!-- <td><input type="checkbox" class="update-checkbox" data-url-id="{{ $getweb->id }}" data-column="faq" {{ $getweb->faq == 1 ? 'checked' : '' }}></td>
            <td><input type="checkbox" class="update-checkbox" data-url-id="{{ $getweb->id }}" data-column="description" {{ $getweb->description == 1 ? 'checked' : '' }}></td>
            <td><input type="checkbox" class="update-checkbox" data-url-id="{{ $getweb->id }}" data-column="dataEntry" {{ $getweb->dataEntry == 1 ? 'checked' : '' }}></td>  -->
            
            <td>
                <input type="checkbox" class="update-checkbox" data-url-id="{{ $getweb->id }}" data-column="faq" {{ $getweb->faq == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <input type="checkbox" class="update-checkbox" data-url-id="{{ $getweb->id }}" data-column="description" {{ $getweb->description == 1 ? 'checked' : '' }}>
            </td>
            <td>
                <input type="checkbox" class="update-checkbox" data-url-id="{{ $getweb->id }}" data-column="dataEntry" {{ $getweb->dataEntry == 1 ? 'checked' : '' }}>
            </td>
         
    </tr>
    @endforeach
    @else
    <td>Not available</td>
    @endif
 
  </tbody>
</table>
  </div>

 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 
  </body>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script>
$(document).on('keyup', '#searchdata', function () {
    var value = jQuery('#searchdata').val();
  alert(value);
  
})

</script>
  <script>
(function($) {
   
    $(document).ready(function() {
      
        // ('.update-checkbox').on('change', function() {
          $(document).on('change', '.update-checkbox', function() {
            var urlId = $(this).data('url-id');
            var column = $(this).data('column');
            var value = this.checked ? 1 : 0;

            // AJAX request
            $.ajax({
                url: '{{ route('url_udate') }}',
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'url_id': urlId,
                    'column': column,
                    'value': value
                },
                success: function(response) {
                    
                    $('.getdata').html(response);
                },
                error: function(error) {
                    console.error('Update failed');
                }
            });
        });
    });
})(jQuery.noConflict());

</script>


</html>