var url = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
var base_url = url + '/';  
 
$(document).ready(function() {
  var data = $('.locids').text();    
  
  $.ajax({
      type: 'POST',
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: base_url + 'stays_locdata',
      data: { 'data': data },
      success: function(response) {
          $('.getdata').html(response);
      },
  });

  // Use event delegation to handle clicks on dynamically loaded elements
  $('.getdata').on('click', '.tr-city-wise-hotel-list .tr-city-name', function() {
      var hotelLists = $(this).next('.tr-hotel-lists');
      if (hotelLists.hasClass('open')) {
          hotelLists.removeClass('open');
      } else {
          $('.tr-hotel-lists').removeClass('open'); // Close other hotel lists
          hotelLists.addClass('open'); // Open the clicked one
      }
  });
});
