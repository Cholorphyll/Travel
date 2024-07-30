var baseURL = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
var base_url = baseURL + '/';
//start search location


$(document).ready(function() {

  var locationid =  $('#locid').text(); 

  var sightlist =  $('.sightlist').text(); 

  if(sightlist =="sightlist"){
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: base_url + 'sightlist_saveNearbyhotel',
      data: {
      
        'locationid':locationid,
        '_token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
      
        var nearbyhotel = response.html;    
       
        $('#sim-hotel').html(nearbyhotel);
          
      }
    
    });
  }

});

var searchTimeout;

$(document).on('keyup', '#searchlocation', function() {
    var value = $(this).val();
    
    // Clear any previous search timeouts
    clearTimeout(searchTimeout);
    
    // Set a new search timeout
    searchTimeout = setTimeout(function() {
        performSearch(value);
    }, 500); // Adjust the debounce time as needed 
});

function performSearch(value) {
    if (value.length >= 1) {
        $("#cat-list").css("display", "block");
        $(".recent-his").css("display", "block");
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: base_url + 'list-location',
            data: {
                'search': value
            },
            success: function(response) {
                var resultList = $('#searchResults');
                resultList.empty();
                $('#loc-list').html("");
                $('#recent-search').addClass('d-none');
                $('#loc-list').html(response);
            }
        });
    } else {
        $(".recent-his").removeClass("d-none");
        $("#cat-list").css("display", "block");
        $(".recent-his").css("display", "block");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: base_url + 'recenthistory',
            data: {},
            success: function(response) {
                $('#recent-search').removeClass('d-none');
                var resultList = $('#searchResults');
                resultList.empty();
                $('#loc-list').html("");
                $('#loc-list').html(response);
            }
        });
    }
}



$(document).ready(function() {
  
  $('#searchlocation').on('click', function() {
   
    var value = $(this).val();
    if (value.length <= 0) {
      $("#recentSearchLocation").css("display", "block");

      $("#cat-list").css("display", "block");

      
    
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: base_url + 'recenthistory',
        data: {
          // Your data here
        },
        success: function(response) {
          $("#recentSearchLocation").css("display", "block");
          $(".recent-his").removeClass("d-none");
          var resultList = $('#searchResults');
          resultList.empty();
          $('#loc-list').html(response);
          
        }
      });
    }
  });
});





$(document).ready(function() {
  var searchResultsContainer = $('.recent-his');

  $(document).on('click', function(event) {
    var targetElement = $(event.target); 

 
    if (!targetElement.closest('.explore-search').length) {
      searchResultsContainer.hide(); 
    }
  });

  $('#searchlocation').on('click', function() {
    searchResultsContainer.show(); 
  });
});
  //end search

// start hotels search 

var searchTimeout;

$(document).on('keyup', '#searchhotel', function() {
    var value = $(this).val();

    // Clear any previous search timeouts
    clearTimeout(searchTimeout);
    
    // Set a new search timeout
    searchTimeout = setTimeout(function() {
        hotperformSearch(value);
    }, 500); // Adjust the debounce time as needed 
});

function hotperformSearch(value) {
    if (value.length >= 1) {
        $("#hotel_loc_list").css("display", "block");
           $("#recentSearchsDestination").css("display", "block");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: base_url + 'list_hotelsloc',
            data: {
                'search': value
            },
            success: function(response) {
                
                $('#hotel_loc_list').empty(); // Clear the existing list
        
                // Check if the response contains data
                if (response.length > 0) {
                    var resultList = $('#hotel_loc_list');
    
                    // Iterate through the response data and populate the list
                    $.each(response, function (index, item) {
                        resultList.append(
                              '<li data-id="'+item.id +'" data-slug="'+ item.Slug +'-'+ item.id + '"  data-hotel="'+item.hotel+'">' +
                            '<svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect y="0.5" width="32" height="32" rx="16" fill="#F7F7F7"/> <g clip-path="url(#clip0_1137_4833)">                            <path d="M16.0973 9.22852C19.0061 9.22852 21.43 11.6525 21.43 14.5612C21.43 16.7912 18.2304 21.1543 16.776 22.9965C16.5821 23.1904 16.3882 23.3844 16.0973 23.3844C15.8065 23.3844 15.6125 23.2874 15.4186 22.9965C13.9643 21.1543 10.7646 16.7912 10.7646 14.5612C10.7646 11.6525 13.1886 9.22852 16.0973 9.22852Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>                            <path d="M16.0971 15.9286C16.3081 15.9286 16.5171 15.887 16.712 15.8063C16.907 15.7255 17.0841 15.6072 17.2334 15.458C17.3826 15.3087 17.5009 15.1316 17.5817 14.9367C17.6624 14.7417 17.704 14.5327 17.704 14.3217C17.704 14.1107 17.6624 13.9018 17.5817 13.7068C17.5009 13.5118 17.3826 13.3347 17.2334 13.1855C17.0841 13.0363 16.907 12.9179 16.712 12.8372C16.5171 12.7564 16.3081 12.7148 16.0971 12.7148C15.6711 12.7148 15.2625 12.8841 14.9612 13.1853C14.66 13.4866 14.4907 13.8952 14.4907 14.3212C14.4907 14.7473 14.66 15.1559 14.9612 15.4571C15.2625 15.7584 15.6711 15.9286 16.0971 15.9286Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>    </g>  <defs>     <clipPath id="clip0_1137_4833">        <rect width="13.0893" height="15.998" fill="white" transform="translate(9.45557 8.5)"/>      </clipPath>    </defs>   </svg>' +
                            // Your SVG path and elements here
                            '</svg>' +
                            '<span>' + item.value + '</span>' +
                            '</li>'
                        );
                    });

                    var resultList = $('#hotel_loc_list');
                    var searchInput = $('#searchhotel');
                    var slugElement = $('#slug'); 
                    var locationid = $('#location_id'); 
    				var hotel = $('#hotel'); 
                    resultList.on('click', 'li', function () {
						var hoteldata = $(this).data('hotel');     
                        hotel.text(hoteldata);
						
                        var locationText = $(this).find('span').text();                      
                        var slug = $(this).data('slug');  
                        var id = $(this).data('id');                  
                        searchInput.val(locationText);                     
                        slugElement.text(slug);
                        locationid.text(id);
                        $('.hotel_recent_his').addClass('d-none');
                    });
    
                    $('.hotel_recent_his').removeClass('d-none');
                } else {
                   
                     $('#hotel_loc_list').html('<li>No results found</li>');
                }
            }
        });
    }else {
        $(".hotel_recent_his").removeClass("d-none");
        $("#hotel_loc_list").css("display", "block");
		 $("#recentSearchsDestination").css("display", "block");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: base_url + 'recenthotels',
            data: {},
             success: function(response) {
                
                $('#hotel_loc_list').empty(); // Clear the existing list
        
                // Check if the response contains data
                if (response.length > 0) {
                    var resultList = $('#hotel_loc_list');
    
                    // Iterate through the response data and populate the list
                    $.each(response, function (index, item) {
                        resultList.append(
                            '<li data-id="'+item.id +'" data-slug="'+item.id +'-'+ item.Slug + '">' +
                            '<svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect y="0.5" width="32" height="32" rx="16" fill="#F7F7F7"/> <g clip-path="url(#clip0_1137_4833)">                            <path d="M16.0973 9.22852C19.0061 9.22852 21.43 11.6525 21.43 14.5612C21.43 16.7912 18.2304 21.1543 16.776 22.9965C16.5821 23.1904 16.3882 23.3844 16.0973 23.3844C15.8065 23.3844 15.6125 23.2874 15.4186 22.9965C13.9643 21.1543 10.7646 16.7912 10.7646 14.5612C10.7646 11.6525 13.1886 9.22852 16.0973 9.22852Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>                            <path d="M16.0971 15.9286C16.3081 15.9286 16.5171 15.887 16.712 15.8063C16.907 15.7255 17.0841 15.6072 17.2334 15.458C17.3826 15.3087 17.5009 15.1316 17.5817 14.9367C17.6624 14.7417 17.704 14.5327 17.704 14.3217C17.704 14.1107 17.6624 13.9018 17.5817 13.7068C17.5009 13.5118 17.3826 13.3347 17.2334 13.1855C17.0841 13.0363 16.907 12.9179 16.712 12.8372C16.5171 12.7564 16.3081 12.7148 16.0971 12.7148C15.6711 12.7148 15.2625 12.8841 14.9612 13.1853C14.66 13.4866 14.4907 13.8952 14.4907 14.3212C14.4907 14.7473 14.66 15.1559 14.9612 15.4571C15.2625 15.7584 15.6711 15.9286 16.0971 15.9286Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>    </g>  <defs>     <clipPath id="clip0_1137_4833">        <rect width="13.0893" height="15.998" fill="white" transform="translate(9.45557 8.5)"/>      </clipPath>    </defs>   </svg>' +
                            // Your SVG path and elements here
                            '</svg>' +
                            '<span>' + item.value + '</span>' +
                            '</li>'
                        );
                    });

                    var resultList = $('#hotel_loc_list');
                    var searchInput = $('#searchhotel');
                    var slugElement = $('#slug'); 
                    var locationid = $('#location_id'); 

                    resultList.on('click', 'li', function () {
                   
                        var locationText = $(this).find('span').text();                      
                        var slug = $(this).data('slug');  
                        var id = $(this).data('id');                  
                        searchInput.val(locationText);                     
                        slugElement.text(slug);
                        locationid.text(id);
                        $('.hotel_recent_his').addClass('d-none');
						 $("#recentSearchsDestination").css("display", "block");
                    });
    
                    $('.hotel_recent_his').removeClass('d-none');
					 $("#recentSearchsDestination").css("display", "block");
                } else {
                   
                    resultList.append('<li><a href="#">No results found</a></li>');
                }
            }
            });
}
}

$(document).ready(function() {
  
    $('#searchhotel').on('click', function() {
     
      var value = $(this).val();
      if (value.length <= 0) {
        $("#hotel_loc_list").css("display", "block");
       $("#recentSearchsDestination").css("display", "block");
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'get',
          url: base_url + 'recenthotels',
          data: {
           
          },
        success: function(response) {
                
                $('#hotel_loc_list').empty(); // Clear the existing list
        
                // Check if the response contains data
                if (response.length > 0) {
                    var resultList = $('#hotel_loc_list');
    
                    // Iterate through the response data and populate the list
                    $.each(response, function (index, item) {
                        resultList.append(
                            '<li data-id="'+item.id +'" data-slug="'+item.id +'-'+ item.Slug + '">' +
                            '<svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect y="0.5" width="32" height="32" rx="16" fill="#F7F7F7"/> <g clip-path="url(#clip0_1137_4833)">                            <path d="M16.0973 9.22852C19.0061 9.22852 21.43 11.6525 21.43 14.5612C21.43 16.7912 18.2304 21.1543 16.776 22.9965C16.5821 23.1904 16.3882 23.3844 16.0973 23.3844C15.8065 23.3844 15.6125 23.2874 15.4186 22.9965C13.9643 21.1543 10.7646 16.7912 10.7646 14.5612C10.7646 11.6525 13.1886 9.22852 16.0973 9.22852Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>                            <path d="M16.0971 15.9286C16.3081 15.9286 16.5171 15.887 16.712 15.8063C16.907 15.7255 17.0841 15.6072 17.2334 15.458C17.3826 15.3087 17.5009 15.1316 17.5817 14.9367C17.6624 14.7417 17.704 14.5327 17.704 14.3217C17.704 14.1107 17.6624 13.9018 17.5817 13.7068C17.5009 13.5118 17.3826 13.3347 17.2334 13.1855C17.0841 13.0363 16.907 12.9179 16.712 12.8372C16.5171 12.7564 16.3081 12.7148 16.0971 12.7148C15.6711 12.7148 15.2625 12.8841 14.9612 13.1853C14.66 13.4866 14.4907 13.8952 14.4907 14.3212C14.4907 14.7473 14.66 15.1559 14.9612 15.4571C15.2625 15.7584 15.6711 15.9286 16.0971 15.9286Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>    </g>  <defs>     <clipPath id="clip0_1137_4833">        <rect width="13.0893" height="15.998" fill="white" transform="translate(9.45557 8.5)"/>      </clipPath>    </defs>   </svg>' +
                            // Your SVG path and elements here
                            '</svg>' +
                            '<span>' + item.value + '</span>' +
                            '</li>'
                        );
                    });

                    var resultList = $('#hotel_loc_list');
                    var searchInput = $('#searchhotel');
                    var slugElement = $('#slug'); 
                    var locationid = $('#location_id'); 

                    resultList.on('click', 'li', function () {
                   
                        var locationText = $(this).find('span').text();                      
                        var slug = $(this).data('slug');  
                        var id = $(this).data('id');                  
                        searchInput.val(locationText);                     
                        slugElement.text(slug);
                        locationid.text(id);
                       $('.hotel_recent_his').addClass('d-none');
                    });
    
                    $('.hotel_recent_his').removeClass('d-none');
                } else {
                   
                    resultList.append('<li><a href="#">No results found</a></li>');
                }
            }
        });
      }
    });
  });
//end search

$(document).ready(function() {
    // Show the popup when the search input is focused
    $('#searchhotel').focus(function() {
        $('.hotel_recent_his').removeClass('d-none');
    });

    // Hide the popup when the user clicks outside of it
    $(document).mouseup(function(e) {
        var container = $('.hotel_recent_his');
        var searchInput = $('#searchhotel');
        
        if (!container.is(e.target) && !searchInput.is(e.target) && container.has(e.target).length === 0) {
            $('.hotel_recent_his').addClass('d-none');
        }
    });
});

$(document).on('click', '.custom-link', function(event) {
    event.preventDefault(); // Prevent the default link behavior
    var url = $(this).attr('href');
    // Handle the link click, e.g., by navigating to the URL
    window.location.href = url;
});
//end hotel search



//search hotel list

$(document).on('click', '.filter-chackinout', function () {

    var hotel = $('#hotel').text();

   if(hotel == 1){     
      var slug = $('#slug').text().trim();     
      var url = 'hd-'+ slug ;
   }else{
    var checkin = $('.t-input-check-in').val();
    var checkout = $('.t-input-check-out').val();
    var currentDate = new Date();
    var cin = new Date();
    var cout = new Date();

    if (checkin == "" || checkin == "null") {
        cin.setDate(currentDate.getDate() + 1);
        var formcin = cin.toISOString().split('T')[0];
        checkin = formcin;
    }
    if (checkout == '' || checkout == 'null') {
        cout.setDate(currentDate.getDate() + 4);
        var formcout = cout.toISOString().split('T')[0];
        checkout = formcout;
    }

    var rooms = $('#totalroom').text().trim();
    if(rooms ==''){   
       rooms = $('.totalRoom').text()
    }
    var guest = $('.totalguests').val();
    if(guest !=undefined){
      var guest = $('.totalguests').val().trim();
      }
    if (guest == undefined) {
      var totalAdultsGuestVal = $('#totalAdultsGuest').text();
      var totalChildrenGuestVal = $('#totalChildrenGuest').text();
      var totalChildrenInfantsVal = $('#totalChildrenInfants').text();
       guest = Number(totalAdultsGuestVal) + Number(totalChildrenGuestVal) + Number(totalChildrenInfantsVal);

    } 
    if(guest == undefined){
        guest = 2;
    }


    var lid = $('.loc_id').text().trim();
  
    var slug = $('#slug').text().trim();
    var locationid = $('#location_id').text().trim();
    if (locationid == '') {
        if (lid == "") {
            alert('Location is required.')
            return;
        }
    }
	
	 
    var locname = $('#searchhotel').val().trim();
    let formattedCheckin = checkin.replace(/\s+/g, '-');
    let fcheckout = checkout.replace(/\s+/g, '-');
    // Build the URL for the filter_availble_hotel.html page with query parameters
    var url = 'ho' +
       '?checkin=' + formattedCheckin +
        '&checkout=' + fcheckout +
        '&locationid=' + locationid +
        '&lid=' + lid +
        '&rooms=' + rooms +
        '&guest=' + guest +
        '&slug=' + slug;

   }
   
    // Open the URL in a new tab
    // window.open(url, '_blank');
    window.location.href = url;
});

//search hotel list






//show more about
 
//show more about


  function fetchFiltered(page){
	  
    // $priceFrom = $("#rangeSliderExample5MinResult").slider("values", 0);
    // $priceTo = $("#rangeSliderExample5MaxResult").slider("values", 1);
    $priceFrom = $("#rangeSliderExample5MinResult").text();
    $priceTo = $("#rangeSliderExample5MaxResult").text();
    var locationid=$('#Tplocid').text();
    var Cin=$('#Cin').text();
    var Cout=$('#Cout').text();
    var guest=$('#guest').text();
    var rooms=$('#rooms').text();
// Assuming you want to add the spinner HTML to an element with the class 'filter-listing'
$('.filter-listing').html('<div class="spinner-border text-secondary" style="margin-left: 537px;" role="status"><span class="visually-hidden">Loading...</span></div>');

    // var typeval = [];
    
    // $('.filter-drop-down.type input[type=checkbox]:checked').each(function() {
    //   typeval.push($(this).val());
    // });
    // var hoteltp = typeval.join(',');
  
    var ut=[]
    $('.user-rating input[name="use_rat"]:checked').each(function() {
      ut.push($(this).val()); 
    });
    var userrating =  ut.join(',');
  
    var st=[]
    var starRating = $('.star-rating input[name="rating"]:checked').each(function(){
      st.push($(this).val());
    })
    var st =  st.join(',');


    var ht=[]
    var hoteltype = $('#hoteltype input[name="hoteltypes"]:checked').each(function(){
      ht.push($(this).val());
    })
    var hotelaa =  ht.join(',');
  
    $('input[name="mnt"]:checked').each(function () {
      var labelText = $(this).next('label').text().trim();
  
  });
  
  var mnt=[]
  var amenities = $('.mnts input[name="mnt"]:checked').each(function(){
    mnt.push($(this).val());
  })
  var mnts = mnt.join(',');
  
  var Smnt=[]
  var s_mnt = $('.mnts input[name="special_mnt"]:checked').each(function(){
    Smnt.push($(this).val());
  })

  var Spec_mnt = Smnt.join(',');

  
    var distance = $('.rangevalue').text();
  
  
  var address = $('#address').val();
  
  
    var nabour =[]
    $('.neighbourhoods input[type=checkbox]:checked').each(function() {
      nabour.push($(this).val()); 
    });
    var neibourhood = nabour.join(',');
      func = 'filter_date';
    $.ajax({
      type:'post',
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    
      url: base_url + 'hotel_all_filters',
      data: { 'priceFrom': $priceFrom,'priceTo':$priceTo,'hoteltype':hotelaa,'neibourhood':neibourhood,'distance':distance,'starRating':st,'userrating':userrating,'locationid':locationid,'mnt':mnts,'address':address,'Cin':Cin,'Cout':Cout,'guest':guest,'rooms':rooms,'Smnt':Spec_mnt,'page': page,
      '_token': $('meta[name="csrf-token"]').attr('content')},  
      success: function(response){
       
        $('.filter-listing').html(response);
       
      }
    });
  
  
  }

//start withoutdate filter

function fetchFilteres_without_date(page){
    fun = 'fetch_without_date';
    $priceFrom = $("#rangeSliderExample5MinResult").text();
    $priceTo = $("#rangeSliderExample5MaxResult").text();
    var locationid=$('#Tplocid').text();

    var Cin=$('#Cin').text();
    var Cout=$('#Cout').text();
    var guest=$('#guest').text();
    var rooms=$('#rooms').text();
    
   
  
    var ut=[]
    $('.user-rating input[name="use_rat"]:checked').each(function() {
      ut.push($(this).val()); 
    });
    var userrating =  ut.join(',');
  
    var st=[]
    var starRating = $('.star-rating input[name="rating"]:checked').each(function(){
      st.push($(this).val());
    })
    var st =  st.join(',');


    var ht=[]
    var hoteltype = $('#hoteltype input[name="hoteltypes"]:checked').each(function(){
      ht.push($(this).val());
    })
    var hotelaa =  ht.join(',');
  
    $('input[name="mnt"]:checked').each(function () {
      var labelText = $(this).next('label').text().trim();
  
  });
  
  var mnt=[]
  var amenities = $('.mnts input[name="mnt"]:checked').each(function(){
    mnt.push($(this).val());
  })
  var mnts = mnt.join(',');
  
  var Smnt=[]
  var s_mnt = $('.mnts input[name="special_mnt"]:checked').each(function(){
    Smnt.push($(this).val());
  })

  var Spec_mnt = Smnt.join(',');

  
    var distance = $('.rangevalue').text();
  
  
  var address = $('#address').val();
  
  
    var nabour =[] 
    $('.neighbourhoods input[type=checkbox]:checked').each(function() {
      nabour.push($(this).val()); 
    });
    var neibourhood = nabour.join(',');
  
    $.ajax({
      type:'post',
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
     //hotel_all_filters
      url: base_url + 'hotel_all_filters_without_date',
      data: { 'priceFrom': $priceFrom,'priceTo':$priceTo,'hoteltype':hotelaa,'neibourhood':neibourhood,'distance':distance,'starRating':st,'userrating':userrating,'locationid':locationid,'mnt':mnts,'address':address,'Cin':Cin,'Cout':Cout,'guest':guest,'rooms':rooms,'Smnt':Spec_mnt,'page': page,
      '_token': $('meta[name="csrf-token"]').attr('content')},  
      success: function(response){
       
        $('.filter-listing').html(response);
       
      }
    });
  
  
  }


//end withoutdate filter






const data = ["red", "blue", "green", "yellow", "purple", "orange", "black", "white", "brown"];

const autocomplete = document.getElementById("autocompleteFive");
const resultsHTML = document.getElementById("results");


autocomplete.oninput = function () {
    let results = [];
    const userInput = this.value;
    resultsHTML.innerHTML = "";
    if (userInput.length > 0) {
        results = getResults(userInput);
        resultsHTML.style.display = "block";
        for (i = 0; i < results.length; i++) {
            resultsHTML.innerHTML += "<li>" + `<svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect y="0.5" width="32" height="32" rx="16" fill="#F7F7F7"/>
            <g clip-path="url(#clip0_1137_4833)">
            <path d="M16.0973 9.22852C19.0061 9.22852 21.43 11.6525 21.43 14.5612C21.43 16.7912 18.2304 21.1543 16.776 22.9965C16.5821 23.1904 16.3882 23.3844 16.0973 23.3844C15.8065 23.3844 15.6125 23.2874 15.4186 22.9965C13.9643 21.1543 10.7646 16.7912 10.7646 14.5612C10.7646 11.6525 13.1886 9.22852 16.0973 9.22852Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16.0971 15.9286C16.3081 15.9286 16.5171 15.887 16.712 15.8063C16.907 15.7255 17.0841 15.6072 17.2334 15.458C17.3826 15.3087 17.5009 15.1316 17.5817 14.9367C17.6624 14.7417 17.704 14.5327 17.704 14.3217C17.704 14.1107 17.6624 13.9018 17.5817 13.7068C17.5009 13.5118 17.3826 13.3347 17.2334 13.1855C17.0841 13.0363 16.907 12.9179 16.712 12.8372C16.5171 12.7564 16.3081 12.7148 16.0971 12.7148C15.6711 12.7148 15.2625 12.8841 14.9612 13.1853C14.66 13.4866 14.4907 13.8952 14.4907 14.3212C14.4907 14.7473 14.66 15.1559 14.9612 15.4571C15.2625 15.7584 15.6711 15.9286 16.0971 15.9286Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <defs>
            <clipPath id="clip0_1137_4833">
            <rect width="13.0893" height="15.998" fill="white" transform="translate(9.45557 8.5)"/>
            </clipPath>
            </defs>
            </svg><div style=""><span style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;color: #4A4A4A;font-size: 14px;font-weight: 400;">`+ results[i] + "</span></div></li>";
        }
    }
};

autocomplete.onclick = function () {
    let results = [];
    if (!resultsHTML.hasChildNodes()) {
        let retrievedObject = localStorage.getItem('testObject');
        results = JSON.parse(retrievedObject);
        // results = getResults(userInput);
        resultsHTML.style.display = "block";
        for (i = 0; i < results.length; i++) {
            resultsHTML.innerHTML += "<li>" + `<svg xmlns="http://www.w3.org/2000/svg" width="34" height="35" viewBox="0 0 34 35" fill="none">
            <rect y="0.880859" width="33.2389" height="33.2389" rx="16.6194" fill="#F7F7F7"/>
            <path d="M19.5039 17.5009H16.6211V12.9707" stroke="#222222" stroke-width="1.07743" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16.6193 24.5024C20.486 24.5024 23.6205 21.3678 23.6205 17.5012C23.6205 13.6345 20.486 10.5 16.6193 10.5C12.7527 10.5 9.61816 13.6345 9.61816 17.5012C9.61816 21.3678 12.7527 24.5024 16.6193 24.5024Z" stroke="#717171" stroke-width="1.07743" stroke-linecap="round" stroke-linejoin="round"/>
            </svg><div style=""><span style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;color: #4A4A4A;font-size: 14px;font-weight: 400;">`+  results[i] + "</span></div></li>";
        }
    }
};

function getResults(input) {
    const dataFilter = data.filter(m => m.toLowerCase().includes(input.toLowerCase()));
    let retrievedObject = localStorage.getItem('testObject');
    retrievArray = JSON.parse(retrievedObject);

    if (retrievArray != null) {
        retrievArray.filter(m => m.toLowerCase().includes(input.toLowerCase()));
    }
    else {
        retrievArray = [];
    }

    let results = [...new Set([...retrievArray, ...dataFilter])];
    return results;
}

resultsHTML.onclick = function (event) {
    const setValue = event.target.innerText;
    autocomplete.value = setValue;
    let retrievedObject = localStorage.getItem('testObject');
    let array = JSON.parse(retrievedObject);
    if (array == null) array = [setValue];
    if (!array.some(m => m == setValue)) {
        array.push(setValue)
    }
    localStorage.setItem('testObject', JSON.stringify(array));

    this.innerHTML = "";
};
const autoCompleteJS2 = new autoComplete({
  selector: "#autoCompletethree",
  placeHolder: "Search for Food...",
  data: {
      src: ["Sauce - Thousand Island", "Wild Boar - Tenderloin", "Goat - Whole Cut"],
      cache: true,
  },
  resultsList: {
      element: (list, data) => {
          if (!data.results.length) {
              // Create "No Results" message element
              const message = document.createElement("div");
              // Add class to the created element
              message.setAttribute("class", "no_result");
              // Add message text content
              message.innerHTML = `<span>Found No Results for "${data.query}"</span>`;
              // Append message element to the results list
              list.prepend(message);
          }
      },
      noResults: true,
  },
  resultItem: {
      element: (item, data) => {
          // Modify Results Item Style
          item.style = "display: flex;text-transform: capitalize;align-items: center;";
          // Modify Results Item Content
          item.innerHTML = `    <svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect y="0.5" width="32" height="32" rx="16" fill="#F7F7F7"/>
<g clip-path="url(#clip0_1137_4833)">
<path d="M16.0973 9.22852C19.0061 9.22852 21.43 11.6525 21.43 14.5612C21.43 16.7912 18.2304 21.1543 16.776 22.9965C16.5821 23.1904 16.3882 23.3844 16.0973 23.3844C15.8065 23.3844 15.6125 23.2874 15.4186 22.9965C13.9643 21.1543 10.7646 16.7912 10.7646 14.5612C10.7646 11.6525 13.1886 9.22852 16.0973 9.22852Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16.0971 15.9286C16.3081 15.9286 16.5171 15.887 16.712 15.8063C16.907 15.7255 17.0841 15.6072 17.2334 15.458C17.3826 15.3087 17.5009 15.1316 17.5817 14.9367C17.6624 14.7417 17.704 14.5327 17.704 14.3217C17.704 14.1107 17.6624 13.9018 17.5817 13.7068C17.5009 13.5118 17.3826 13.3347 17.2334 13.1855C17.0841 13.0363 16.907 12.9179 16.712 12.8372C16.5171 12.7564 16.3081 12.7148 16.0971 12.7148C15.6711 12.7148 15.2625 12.8841 14.9612 13.1853C14.66 13.4866 14.4907 13.8952 14.4907 14.3212C14.4907 14.7473 14.66 15.1559 14.9612 15.4571C15.2625 15.7584 15.6711 15.9286 16.0971 15.9286Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</g>
<defs>
<clipPath id="clip0_1137_4833">
<rect width="13.0893" height="15.998" fill="white" transform="translate(9.45557 8.5)"/>
</clipPath>
</defs>
</svg>
<div style="margin-left: 16px;"><span style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;color: #B0B0B0;font-size: 14px;font-weight: 400;">${data.match}
</span>
<span style="display: flex; align-items: center;color: #B0B0B0;font-size: 12px;font-weight: 400;">
${data.key}
</span>  </div>`;
      },
      highlight: true
  },
  events: {
      input: {
          selection: (event) => {
              const selection = event.detail.selection.value;
              autoCompleteJS2.input.value = selection;
          }
      }
  }
});







$(document).ready(function () {



    const input = $('.inputfield');

    const totalguests = $('.totalguests');



    $(".adults").each(function (index) {
        $('.incdec').on("click", function (event) {

            event.stopImmediatePropagation();
            let value = 0;
            value = $(this).siblings(input).next().val();

            ++value;
            $(this).siblings(input).next().val(value);

            if (event.currentTarget.id.includes("children")) {
                if (value == 1) {
                    $("#childrenDetails").append(`<div class="mb-25" style="border-top:1px solid #707070;">
                        <p class="person px-24" style="margin-top:20px;">AGE</p>
                    </div>`);
                }
                $("#childrenDetails").append(`<div
                    class="adults px-24 counter d-flex justify-content-between align-items-center mb-25">
                    <div>
                        <p class="person">CHILD ${value}</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <select name="age" id="age">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>`);
            }

            var sum = 0;
            $('.inputfield').each(function () {
                sum += +$(this).val();
            });

            $(".totalguests").val(sum);

            $(".guest").text(sum);



        });
    });

    $(".adults").each(function (index) {
        $('.decrement').on("click", function (event) {
            event.stopImmediatePropagation();
            let value = 0;
            value = $(this).siblings(input).val();

            --value;
            $(this).siblings(input).val(value);
            if (event.currentTarget.id.includes("children")) {
                $("#childrenDetails").children("div:last").remove();
                if (value == 0) {
                    $("#childrenDetails").empty();
                }
            }


            var sum = 0;
            $('.inputfield').each(function () {
                sum += +$(this).val();
            });
            $(".totalguests").val(sum);

        });
    });




    $('.dropdown-custom-toggle').click(function (e) {
        e.preventDefault();
        $('.custom-dropdown-menu').toggleClass('show');
        $('.dropdown-custom').addClass('active');
        $('.t-datepicker-day').remove()
        $('.t-datepicker').removeClass('t-datepicker-open');


    });


    $('.search-filter').click(function (e) {
        e.preventDefault();
        $(this).removeClass('remove-highlight');
    });
    $('.dropdown-custom').click(function (e) {
        e.preventDefault();
        $('.search-filter').removeClass('remove-highlight');
    });

    $(window).click(function () {
        $('.custom-dropdown-menu').removeClass('show');
        $('.dropdown-custom').removeClass('active');
    });

    $('.dropdown-custom').click(function (event) {
        event.stopPropagation();
    });

    // $('.search-filter').click(function (event) {
    //     event.stopPropagation();
    // });



});






$(document).click(function (event) {
    var $target = $(event.target);
    if (!$target.closest('.search-filter').length) {
        $('.search-filter').addClass('remove-highlight');
    }
});


