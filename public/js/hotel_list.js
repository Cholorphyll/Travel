var baseURL = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window
.location.port : '');
var base_url = baseURL + '/';



var fun;
var func;
  $(document).ready(function() {
     func ='withdate';
    var withdate =  $('#withdate').text();  
    if(withdate == 'withdate'){
    var locationid =  $('#Tplocid').text();      
    var checkin =  $('#Cin').text();  
    var checkout =  $('#Cout').text();  
    var rooms =  $('#rooms').text();  
    var guest =  $('#guest').text();  
	var Tid =  $('.Tid').text();  
    function updateSearchResultss(page) {
    $.ajax({
      type: 'Post',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: base_url + 'getfilteredhotellist',
      data: { 'locationid': locationid, 'checkin': checkin, 'checkout': checkout, 'rooms': rooms,'guest': guest,'page':page,'Tid':Tid},
      success: function(response) {
        
        $('.filter-listing').html(response);
    
        },
        });
        }

        // Initial request for the first page
        updateSearchResultss(1);

        // Event listener for pagination links
        $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
    //    updateSearchResultss(page);
	   if (func =='withdate') {
          updateSearchResultss(page);
      } else {
        fetchFiltered(page);
      }
        $('html, body').animate({ scrollTop: 190 }, 'slow');
        });
        }
        });

  
$(document).ready(function() {
  var locationid =  $('#Tplocid').text();  
	  var slugid =  $('#slugid').text();  
  
  $.ajax({
    type: 'Post',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: base_url + 'addHotleListingFaq',
    data: { 'locationid': locationid,'slugid':slugid},
    success: function(response) {
  
      var hotelfaq= response.html
      
      $('#faqdata').html(hotelfaq);
  
    },
  
   });
  });














   