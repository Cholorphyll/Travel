var baseURL = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
var base_url = baseURL + '/';
//start search location


//home page search


//home page search 
var searchTimeout;

$(document).on('keyup', '.search_explore', function() {
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
                resultList.empty(); // Clear previous results
                $('#loc-list').html("");
                $('#recent-search').addClass('d-none');
                $('#loc-list').html(response); // Display new search results
            }
        });
    } else {
        // If the input is empty, show recent search history
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
                resultList.empty(); // Clear previous results
                $('#loc-list').html("");
                $('#loc-list').html(response); // Display recent search history
            }
        });
    }
}


$(document).ready(function() {
  
  $('.search_explore').on('click', function() {
   
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






//end home page search


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


//second function 
$(document).on('click', '.tr-more-price.tr', function() {
    const $this = $(this);
  
    const $priceListsSection = $this.closest('.tr-hotel-price-lists');
  
    if ($this.hasClass('active')) {
        // Hide the modal and remove active state if already active
        $this.removeClass('active');
        $(".more-options-modal").remove();
    } else {
  
        $(".tr-hotel-price-lists .tr-more-price.tr").removeClass('active');
        $(".tr-hotel-price-lists .more-options-modal").remove();
  
        $this.addClass('active');
        
  
        const $morePricesContainer = $priceListsSection.find('.more-prices-container');
        if ($morePricesContainer.length) {
            $morePricesContainer.hide(); // Hide the container
        }
  
    
        const $priceListsMore = $morePricesContainer.find('.tr-hotel-price-list').clone();
  
  
        $priceListsMore.each(function() {
            $(this).css('display', 'block'); // Remove any display: none
        });
  
   
        const $priceListsModal = $("<div class='more-options-modal'></div>");
        $priceListsSection.append($priceListsModal);
  
        
        const $modalContent = $("<div class='tr-hotel-price-lists'></div>");
        $priceListsModal.append($modalContent);
        $modalContent.append($priceListsMore);
  
     
        $priceListsModal.show();
    }
  });
  
  
  $(document).on('click', function(event) {
    if ($('.more-options-modal').length) {
        if (!$(event.target).closest('.more-options-modal, .tr-more-price.tr').length) {
            $('.tr-more-price.tr').removeClass('active');
            $(".more-options-modal").remove();
        }
    }
  });


//first function 


$(document).on('click', '.tr-more-prices.ls', function() {
    const $this = $(this);

    const $priceListsSection = $this.closest('.tr-hotel-price-lists');
  
    if ($this.hasClass('active')) {
        // Hide the modal and remove active state if already active
        $this.removeClass('active');
        $(".more-options-modals").remove();
    } else {
  
        $(".tr-hotel-price-lists .tr-more-prices").removeClass('active');
        $(".tr-hotel-price-lists .more-options-modals").remove();
  
        $this.addClass('active');
        
  
        const $morePricesContainer = $priceListsSection.find('.more-prices-containers');
        if ($morePricesContainer.length) {
            $morePricesContainer.hide(); // Hide the container
        }
  
    
        const $priceListsMore = $morePricesContainer.find('.tr-hotel-price-list').clone();
  
  
        $priceListsMore.each(function() {
            $(this).css('display', 'block'); // Remove any display: none
        });
  
   
        const $priceListsModal = $("<div class='more-options-modals'></div>");
        $priceListsSection.append($priceListsModal);
  
        
        const $modalContent = $("<div class='tr-hotel-price-lists'></div>");
        $priceListsModal.append($modalContent);
        $modalContent.append($priceListsMore);
  
     
        $priceListsModal.show();
    }
  });
  
  
  $(document).on('click', function(event) {
    if ($('.more-options-modals').length) {
        if (!$(event.target).closest('.more-options-modals, .tr-more-prices').length) {
            $('.tr-more-prices').removeClass('active');
            $(".more-options-modals").remove();
        }
    }
  });

//first function 
//open model
$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const openModal = urlParams.get('openModal');
    const token = urlParams.get('token');

    if (openModal) {
        $(`#${openModal}`).modal('show');       
        if (openModal == 'resetPswdModal' && token) {
            $('#token').val(token);
        }

        // Remove only the openModal parameter while keeping other parameters intact
        urlParams.delete('openModal');

        const cleanUrl = window.location.origin + window.location.pathname + '?' + urlParams.toString();
        window.history.replaceState({ path: cleanUrl }, '', cleanUrl);
    }
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
    var city = $('#location-name').text();
    // Clear any previous search timeouts
    clearTimeout(searchTimeout);
    
    // Set a new search timeout
    searchTimeout = setTimeout(function() {
        hotperformSearch(value,city);
    }, 500); // Adjust the debounce time as needed 
});

function hotperformSearch(value,city) {
    if (value.length >= 1) {
		 $(".tr-recent-searchs-modal").css("display", "block");
		 $("#recentSearchsDestination").css("display", "block");
        $("#hotel_loc_list").css("display", "block");
	
         //  $("#recentSearchsDestination").css("display", "block");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: base_url + 'list_hotelsloc',
            data: {
                'search': value,
                    'city':city
            },
            success: function(response) {
             
                $('#hotel_loc_list').empty(); // Clear the existing list
        
                // Check if the response contains data
                if (response.length > 0) {
                    var resultList = $('#hotel_loc_list');
    
                    // Iterate through the response data and populate the list
                    $.each(response, function (index, item) {
                        let svgIcon = '';
                        if (item.hotel == 1) {
                            svgIcon = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1522_9239)"><path d="M17.2159 4.44531H12.7715V5.55642H17.2159V17.2231H12.7715V18.3342H18.327V5.55642C18.327 5.26174 18.21 4.97912 18.0016 4.77075C17.7932 4.56238 17.5106 4.44531 17.2159 4.44531Z" fill="#222222"/><path d="M11.0507 1.66797H3.40629C3.09393 1.66797 2.79435 1.79206 2.57348 2.01293C2.3526 2.23381 2.22852 2.53338 2.22852 2.84575V18.3346H12.2285V2.84575C12.2285 2.53338 12.1044 2.23381 11.8836 2.01293C11.6627 1.79206 11.3631 1.66797 11.0507 1.66797ZM11.1174 17.2235H9.45074V15.5569H5.00629V17.2235H3.33963V2.84575C3.33963 2.83699 3.34135 2.82832 3.3447 2.82023C3.34805 2.81215 3.35296 2.8048 3.35915 2.79861C3.36534 2.79242 3.37269 2.7875 3.38078 2.78415C3.38887 2.7808 3.39754 2.77908 3.40629 2.77908H11.0507C11.0595 2.77908 11.0682 2.7808 11.0763 2.78415C11.0843 2.7875 11.0917 2.79242 11.0979 2.79861C11.1041 2.8048 11.109 2.81215 11.1123 2.82023C11.1157 2.82832 11.1174 2.83699 11.1174 2.84575V17.2235Z" fill="#222222"/><path d="M4.44043 4.44531H5.55154V5.55642H4.44043V4.44531Z" fill="#222222"/><path d="M6.66895 4.44531H7.78006V5.55642H6.66895V4.44531Z" fill="#222222"/><path d="M8.88965 4.44531H10.0008V5.55642H8.88965V4.44531Z" fill="#222222"/><path d="M4.44043 7.22461H5.55154V8.33572H4.44043V7.22461Z" fill="#222222"/><path d="M6.66895 7.22461H7.78006V8.33572H6.66895V7.22461Z" fill="#222222"/><path d="M8.88965 7.22266H10.0008V8.33377H8.88965V7.22266Z" fill="#222222"/><path d="M4.44043 10H5.55154V11.1111H4.44043V10Z" fill="#222222"/><path d="M6.66895 10H7.78006V11.1111H6.66895V10Z" fill="#222222"/><path d="M8.88965 10H10.0008V11.1111H8.88965V10Z" fill="#222222"/><path d="M4.44043 12.7793H5.55154V13.8904H4.44043V12.7793Z" fill="#222222"/><path d="M6.66895 12.7793H7.78006V13.8904H6.66895V12.7793Z" fill="#222222"/><path d="M8.88965 12.7773H10.0008V13.8885H8.88965V12.7773Z" fill="#222222"/><path d="M12.7715 7.22266H13.8826V8.33377H12.7715V7.22266Z" fill="#222222"/><path d="M15 7.22266H16.1111V8.33377H15V7.22266Z" fill="#222222"/><path d="M12.7715 10H13.8826V11.1111H12.7715V10Z" fill="#222222"/><path d="M15 10H16.1111V11.1111H15V10Z" fill="#222222"/><path d="M12.7715 12.7773H13.8826V13.8885H12.7715V12.7773Z" fill="#222222"/><path d="M15 12.7773H16.1111V13.8885H15V12.7773Z" fill="#222222"/></g><defs><clipPath id="clip0_1522_9239"><rect width="20" height="20" fill="white"/></clipPath></defs></svg>';
                        } else {
                            svgIcon = '<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_441_2146)"><path d="M13.125 6.73828C13.125 11.1133 7.5 14.8633 7.5 14.8633C7.5 14.8633 1.875 11.1133 1.875 6.73828C1.875 5.24644 2.46763 3.8157 3.52252 2.76081C4.57742 1.70591 6.00816 1.11328 7.5 1.11328C8.99184 1.11328 10.4226 1.70591 11.4775 2.76081C12.5324 3.8157 13.125 5.24644 13.125 6.73828Z" stroke="#5E5E5E" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.5 8.61328C8.53553 8.61328 9.375 7.77382 9.375 6.73828C9.375 5.70275 8.53553 4.86328 7.5 4.86328C6.46447 4.86328 5.625 5.70275 5.625 6.73828C5.625 7.77382 6.46447 8.61328 7.5 8.61328Z" stroke="#5E5E5E" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_441_2146"><rect width="15" height="15" fill="white" transform="translate(0 0.488281)"/></clipPath></defs></svg>';
                        }
                    
                        resultList.append(
                            '<li data-id="' + item.id + '" data-slug="' + item.id + '-' + item.Slug + '" data-hotel="' + item.hotel + '">' +
                                '<div class="tr-place-info">' +
                                    '<div class="tr-location-icon">' + svgIcon + '</div>' +
                                    '<div class="tr-location-info">' +
                                        '<div class="tr-hotel-name">' +
                                            '<span>' + item.value + '</span>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</li>'
                        );
                    });

                    var resultList = $('#hotel_loc_list');
                    var searchInput = $('#searchhotel');
                    var slugElement = $('#slug'); 
                    var locationid = $('#location_id'); 
                    var hotel = $('#hotel'); 
					var mobilelocation = $('.location-name-mobile');   
                    resultList.on('click', 'li', function () {
                        var hoteldata = $(this).data('hotel');     
                        hotel.text(hoteldata);
                        
                        var locationText = $(this).find('span').text();                      
                        var slug = $(this).data('slug');  
                        var id = $(this).data('id');                  
                        searchInput.val(locationText);   
						 mobilelocation.text(locationText);       
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
    }
    
       
//     else {
//         $(".hotel_recent_his").removeClass("d-none");
//         $("#hotel_loc_list").css("display", "block");
//       $("#recentSearchsDestination").css("display", "block");
//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             type: 'get',
//             url: base_url + 'recenthotels',
//             data: {},
//              success: function(response) {
                
//                 $('#hotel_loc_list').empty(); // Clear the existing list
        
//                 // Check if the response contains data
//                 if (response.length > 0) {
//                     var resultList = $('#hotel_loc_list');
    
//                     // Iterate through the response data and populate the list
//                     $.each(response, function (index, item) {
//                         resultList.append(
//                             '<li data-id="'+item.id +'" data-slug="'+item.id +'-'+ item.Slug + '">' +
//                             '<svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect y="0.5" width="32" height="32" rx="16" fill="#F7F7F7"/> <g clip-path="url(#clip0_1137_4833)">                            <path d="M16.0973 9.22852C19.0061 9.22852 21.43 11.6525 21.43 14.5612C21.43 16.7912 18.2304 21.1543 16.776 22.9965C16.5821 23.1904 16.3882 23.3844 16.0973 23.3844C15.8065 23.3844 15.6125 23.2874 15.4186 22.9965C13.9643 21.1543 10.7646 16.7912 10.7646 14.5612C10.7646 11.6525 13.1886 9.22852 16.0973 9.22852Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>                            <path d="M16.0971 15.9286C16.3081 15.9286 16.5171 15.887 16.712 15.8063C16.907 15.7255 17.0841 15.6072 17.2334 15.458C17.3826 15.3087 17.5009 15.1316 17.5817 14.9367C17.6624 14.7417 17.704 14.5327 17.704 14.3217C17.704 14.1107 17.6624 13.9018 17.5817 13.7068C17.5009 13.5118 17.3826 13.3347 17.2334 13.1855C17.0841 13.0363 16.907 12.9179 16.712 12.8372C16.5171 12.7564 16.3081 12.7148 16.0971 12.7148C15.6711 12.7148 15.2625 12.8841 14.9612 13.1853C14.66 13.4866 14.4907 13.8952 14.4907 14.3212C14.4907 14.7473 14.66 15.1559 14.9612 15.4571C15.2625 15.7584 15.6711 15.9286 16.0971 15.9286Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>    </g>  <defs>     <clipPath id="clip0_1137_4833">        <rect width="13.0893" height="15.998" fill="white" transform="translate(9.45557 8.5)"/>      </clipPath>    </defs>   </svg>' +
//                             // Your SVG path and elements here
//                             '</svg>' +
//                             '<span>' + item.value + '</span>' +
//                             '</li>'
//                         );
//                     });

//                     var resultList = $('#hotel_loc_list');
//                     var searchInput = $('#searchhotel');
//                     var slugElement = $('#slug'); 
//                     var locationid = $('#location_id'); 

//                     resultList.on('click', 'li', function () {
                   
//                         var locationText = $(this).find('span').text();                      
//                         var slug = $(this).data('slug');  
//                         var id = $(this).data('id');                  
//                         searchInput.val(locationText);                     
//                         slugElement.text(slug);
//                         locationid.text(id);
//                         $('.hotel_recent_his').addClass('d-none');
//                       $("#recentSearchsDestination").css("display", "block");
//                     });
    
//                     $('.hotel_recent_his').removeClass('d-none');
//                   $("#recentSearchsDestination").css("display", "block");
//                 } else {
                   
//                     resultList.append('<li><a href="#">No results found</a></li>');
//                 }
//             }
//             });
// }

}

//start recent history search 

// $(document).ready(function() {
  
//     $('#searchhotel').on('click', function() {
     
//       var value = $(this).val();
//       if (value.length <= 0) {
//         $("#hotel_loc_list").css("display", "block");
//        $("#recentSearchsDestination").css("display", "block");
//         $.ajax({
//           headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           },
//           type: 'get',
//           url: base_url + 'recenthotels',
//           data: {
           
//           },
//         success: function(response) {
                
//                 $('#hotel_loc_list').empty(); // Clear the existing list
        
//                 // Check if the response contains data
//                 if (response.length > 0) {
//                     var resultList = $('#hotel_loc_list');
    
//                     // Iterate through the response data and populate the list
//                     $.each(response, function (index, item) {
//                         resultList.append(
//                             '<li data-id="'+item.id +'" data-slug="'+item.id +'-'+ item.Slug + '">' +
//                             '<svg width="32" height="33" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg"> <rect y="0.5" width="32" height="32" rx="16" fill="#F7F7F7"/> <g clip-path="url(#clip0_1137_4833)">                            <path d="M16.0973 9.22852C19.0061 9.22852 21.43 11.6525 21.43 14.5612C21.43 16.7912 18.2304 21.1543 16.776 22.9965C16.5821 23.1904 16.3882 23.3844 16.0973 23.3844C15.8065 23.3844 15.6125 23.2874 15.4186 22.9965C13.9643 21.1543 10.7646 16.7912 10.7646 14.5612C10.7646 11.6525 13.1886 9.22852 16.0973 9.22852Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>                            <path d="M16.0971 15.9286C16.3081 15.9286 16.5171 15.887 16.712 15.8063C16.907 15.7255 17.0841 15.6072 17.2334 15.458C17.3826 15.3087 17.5009 15.1316 17.5817 14.9367C17.6624 14.7417 17.704 14.5327 17.704 14.3217C17.704 14.1107 17.6624 13.9018 17.5817 13.7068C17.5009 13.5118 17.3826 13.3347 17.2334 13.1855C17.0841 13.0363 16.907 12.9179 16.712 12.8372C16.5171 12.7564 16.3081 12.7148 16.0971 12.7148C15.6711 12.7148 15.2625 12.8841 14.9612 13.1853C14.66 13.4866 14.4907 13.8952 14.4907 14.3212C14.4907 14.7473 14.66 15.1559 14.9612 15.4571C15.2625 15.7584 15.6711 15.9286 16.0971 15.9286Z" stroke="#717171" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>    </g>  <defs>     <clipPath id="clip0_1137_4833">        <rect width="13.0893" height="15.998" fill="white" transform="translate(9.45557 8.5)"/>      </clipPath>    </defs>   </svg>' +
//                             // Your SVG path and elements here
//                             '</svg>' +
//                             '<span>' + item.value + '</span>' +
//                             '</li>'
//                         );
//                     });

//                     var resultList = $('#hotel_loc_list');
//                     var searchInput = $('#searchhotel');
//                     var slugElement = $('#slug'); 
//                     var locationid = $('#location_id'); 

//                     resultList.on('click', 'li', function () {
                   
//                         var locationText = $(this).find('span').text();                      
//                         var slug = $(this).data('slug');  
//                         var id = $(this).data('id');                  
//                         searchInput.val(locationText);                     
//                         slugElement.text(slug);
//                         locationid.text(id);
//                        $('.hotel_recent_his').addClass('d-none');
//                     });
    
//                     $('.hotel_recent_his').removeClass('d-none');
//                 } else {
                   
//                     resultList.append('<li><a href="#">No results found</a></li>');
//                 }
//             }
//         });
//       }
//     });
//   });

//end recent history search 

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
    var slug = $('#slug').text().trim();
   
        var hotel = $('#hotel').text();
        var checkin = $('.t-input-check-in').val();
        var checkout = $('.t-input-check-out').val();
        var currentDate = new Date();
        var cin = new Date();
        var cout = new Date();  
        var date = $('#checkInInput1').val();
       
          var sessionData = $('#sessionData').data() || {}; 
        var sessionCheckin = sessionData.checkin || ''; 
        var sessionCheckout = sessionData.checkout || ''; 
        var sessionGuest = sessionData.guest || ''; 
        var sessionRooms = sessionData.rooms || ''; 
        var sessionSlug = sessionData.slug || ''; 

        if (checkin == "" ){
            checkin = sessionCheckin;
        }        
        if (checkout == "" ){
            checkout = sessionCheckout;
        }
        if (checkin == "" || checkin == "null") {
            cin.setDate(currentDate.getDate() + 1);
            var formcin = cin.toISOString().split('T')[0];
            checkin = formcin;
        }
        if (checkout == "" || checkout == "null") {
            cout.setDate(currentDate.getDate() + 4);
            var formcout = cout.toISOString().split('T')[0];
            checkout = formcout;
        }
        var rooms = $('#totalRoom').val();
        if (rooms == '' || rooms ==undefined) {    
            rooms = 1;
        }

        var guest = $('#totalAdultsGuest').val();
        if (guest == undefined || guest == "" || guest == "NaN" || guest == NaN) {
            guest = 2;
        }

        var lid = $('.loc_id').text().trim();
        var locationid = $('#location_id').text().trim();
        if (locationid == '') {
            if (lid == "") {
                alert('Location is required.');
                return;
            }
        }

        var locname = $('#searchhotel').val().trim();
           
        if (hotel == 1) {
            var url = 'hd-' + slug + '?checkin=' + formattedCheckin + '&checkout=' + fcheckout;
            window.location.href = url;
        }
      
        if ( checkin != sessionCheckin || checkout != sessionCheckout  || guest != sessionGuest || rooms != sessionRooms || slug != sessionSlug ) {   
           
            let formattedCheckin = checkin.replace(/\s+/g, '-');
            let fcheckout = checkout.replace(/\s+/g, '-');

                var url = 'ho-' + slug +
                    '?checkin=' + formattedCheckin +
                    '&checkout=' + fcheckout +
                    '&locationid=' + locationid +
                    '&lid=' + lid +
                    '&rooms=' + rooms +
                    '&guest=' + guest;           
            window.location.href = url;
        } 
   
});


//search hotel list






//show more about
 

//second function for show more price hotel listing 
$(document).on('click', '.tr-more-prices.tr', function() {
  const $this = $(this);
  const $priceListsSection = $this.closest('.tr-hotel-price-lists.ls');

  if ($this.hasClass('active')) {
      // Hide the modal and remove active state if already active
      $this.removeClass('active');
      $(".more-options-modals").remove();
  } else {

      $(".tr-hotel-price-lists.ls .tr-more-prices.tr").removeClass('active');
      $(".tr-hotel-price-lists.ls .more-options-modals").remove();

      $this.addClass('active');
      

      const $morePricesContainer = $priceListsSection.find('.more-prices-containers');
      if ($morePricesContainer.length) {
          $morePricesContainer.hide(); // Hide the container
      }

  
      const $priceListsMore = $morePricesContainer.find('.tr-hotel-price-list').clone();


      $priceListsMore.each(function() {
          $(this).css('display', 'block'); // Remove any display: none
      });

 
      const $priceListsModal = $("<div class='more-options-modals'></div>");
      $priceListsSection.append($priceListsModal);

      
      const $modalContent = $("<div class='tr-hotel-price-lists ls'></div>");
      $priceListsModal.append($modalContent);
      $modalContent.append($priceListsMore);

   
      $priceListsModal.show();
  }
});


$(document).on('click', function(event) {
  if ($('.more-options-modals').length) {
      if (!$(event.target).closest('.more-options-modals, .tr-more-prices.tr').length) {
          $('.tr-more-prices.tr').removeClass('active');
          $(".more-options-modals").remove();
      }
  }
});
 //end hotel list more price

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

//hotel location search for stays


$(document).on('click', '.filter-chackinouts', function (event) {
  // Prevent the default form submission
  event.preventDefault();

  var hotel = $('#hotel').text();

  if (hotel == 1) {
      var slug = $('#slug').text().trim();
      var url = 'hd-' + slug;
  } else {
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
      if (rooms == '') {
          rooms = $('.totalRoom').text();
      }
       if (rooms == undefined || rooms == ""  || rooms == "NaN" || rooms == NaN) {
          rooms = 1;
      }
      var guest = $('.totalguests').val();
      if (guest != undefined) {
          guest = $('.totalguests').val().trim();
      }
      if (guest == undefined) {
          var totalAdultsGuestVal = $('#totalAdultsGuest').text();
          var totalChildrenGuestVal = $('#totalChildrenGuest').text();
          var totalChildrenInfantsVal = $('#totalChildrenInfants').text();
          guest = Number(totalAdultsGuestVal) + Number(totalChildrenGuestVal) + Number(totalChildrenInfantsVal);
      }
       if (guest == undefined || guest == ""  || guest == "NaN" || guest == NaN) {
          guest = 2;
      }

      var lid = $('.loc_id').text().trim();
      var slug = $('#slug').text().trim();
      var locationid = $('#location_id').text().trim();
      if (locationid == '') {
          if (lid == "") {
              alert('Location is required.');
              return;
          }
      }

      var locname = $('#searchhotel').val().trim();
      let formattedCheckin = checkin.replace(/\s+/g, '-');
      let fcheckout = checkout.replace(/\s+/g, '-');    
           var url = 'ho-'+slug +
          '?checkin=' + formattedCheckin +
          '&checkout=' + fcheckout +
          '&locationid=' + locationid +
          '&lid=' + lid +
          '&rooms=' + rooms +
          '&guest=' + guest;
  }

  // Open the URL in a new tab or navigate to it
  // window.open(url, '_blank');
  window.location.href = url;
});

// Also prevent the form from being submitted on submit event
$('#hotelForm3').on('submit', function(event) {
  event.preventDefault();
});

//end hotel location search for stays



/*
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

*/





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


