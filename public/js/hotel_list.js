var baseURL = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window
.location.port : '');
var base_url = baseURL + '/';




$(document).ready(function() { 

  var locationid = $('#Tplocid').text();      
  var checkin = $('#Cin').text();  
  var checkout = $('#Cout').text();  
  var rooms = $('#rooms').text();  
  var guest = $('#guest').text();  
  var Tid = $('.Tid').text();  
 var type = $('.ptype').text();
  if(type == 'withdate'){
  function updateSearchResults(page) {
    var func = 'withdate';
  
      $.ajax({
          type: 'POST',
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: base_url + 'getfilteredhotellist',
          data: {
              'locationid': locationid,
              'checkin': checkin,
              'checkout': checkout,
              'rooms': rooms,
              'guest': guest,
              'page': page,
              'Tid': Tid
          },
          success: function(response) {
              $('.filter-listing').html(response.html);
              $('.hotel_count').html(response.count_result + ' properties found');
        
         if (response.uniqueAgencies !=null) {        
          var agenciesHtml = '<h5>Booking providers</h5><ul>';        
          $.each(response.uniqueAgencies, function(index, agency) {
            agenciesHtml += '<li class="tr-filter-list hl-filter">' +
                      '<label class="tr-check-box">' +
                      '<input type="checkbox" name="agency" class="filter" value="' + agency + '">' +
                      agency +
                      '<span class="checkmark"></span>' +
                    '</label>' +
                  '</li>';
          });
          agenciesHtml += '</ul>';          
          $('#agencies').html(agenciesHtml);        
         }
        
                $('.hl-filter').change(function() {
                  fetchFiltered(1); 
                });

              // Reinitialize filter listeners
              initializeFilterListeners();
           //start new code
                 
                  $('#mapModal .tr-filters-section').empty(); 
                  $('#mapModal .tr-room-section-2').empty(); 
                  $('.tr-filters-section .tr-filter-lists').each(function() {
                      var FilterLists = $(this).clone();
                      $('#mapModal .tr-filters-section').append(FilterLists);
                  });
                  $('.tr-room-section-2 .tr-hotel-deatils').each(function() {
                      var HotelLists = $(this).clone();
                      $('#mapModal .tr-room-section-2').append(HotelLists);
                  });
                  $('#mapModal .carousel').each(function() {
            var currentId = $(this).attr('id');
            if (currentId) {
            var newId = currentId + '-1';
            $(this).attr('id', newId);
            $('#mapModal button[data-bs-target="#' + currentId + '"]').each(function() {
              $(this).attr('data-bs-target', '#' + newId);
            });
            }
          });

              //end new code
          },
          error: function() {
           //   alert('Failed to load results. Please try again.');
          }
      });
  }

  
  updateSearchResults(1);


  $(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var ptype = $('.page_type').text();
  
    if (ptype == 'getlist') {
        updateSearchResults(page);
    }else if(ptype == 'filter'){
      fetchFiltered(page);
    }
    $('html, body').animate({ scrollTop: $('.filter-listing').offset().top }, 'slow');
  });
  
    }
});




 
 var fun;
 var func;

 
//search hotel list
$(document).ready(function() {
    
  function debounce(func, wait) {
      let timeout;
      return function() {
          const context = this, args = arguments;
          clearTimeout(timeout);
          timeout = setTimeout(function() {
              func.apply(context, args);
          }, wait);
      };
  }


  const debouncedFetchFiltered = debounce(function() {
      fetchFiltered(1); 
  }, 800); 

  $('.min-range, .max-range').on('input', function() {
      updatePriceValues();
      debouncedFetchFiltered(); 
  });

  $('.hl-filter').change(function() {
      fetchFiltered(1); 
  });

  
});


 
$('.select-items div').on('click', function() {   
    const selectedValue = $(this).text();    
    $('#sort_by').val(selectedValue).trigger('change');
});



// Function to update the displayed min and max price
function updatePriceValues() {
  var minPrice = $('.min-range').val();
  var maxPrice = $('.max-range').val();
  
  $('.min-price-title').text('$' + minPrice);
  $('.max-price-title').text('$' + maxPrice);
}

// Function to fetch filtered data
function fetchFiltered(page) {
  var func = 'filter';

  var locationid = $('#Tplocid').text();
  var Cin = $('#Cin').text();
  var Cout = $('#Cout').text();
  var guest = $('#guest').text();
  var rooms = $('#rooms').text();
  
  // Fetching the min and max price values from the sliders
  var priceFrom = $('.min-range').val();
  var priceTo = $('.max-range').val();

  // Show loading spinner
  // $('.filter-listing').html('<div class="spinner-border text-secondary" style="margin-left: 537px;" role="status"><h1></h1<span class="visually-hidden">Loading...</span></div>');
  $('.filter-listing').html('<div class="tr-hotel-deatils" data-type="no-data"><div class="tr-hotal-image"><div class="tr-no-data-text animated-bg-1 w-100 h-230"></div></div><div class="tr-hotel-deatil"><div class="tr-heading-with-rating"><div class="tr-no-data-text animated-bg-1 w-50 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-25 h-24 mb-12 ml-20"></div></div><div class="tr-no-data-text animated-bg-1 w-25 h-15 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-40 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-100 h-20 mt-41 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-80 h-20 mb-12"></div></div><div class="tr-hotel-price-section"><div class="tr-hotel-price-lists"><div class="tr-hotel-price-list"><div class="tr-row mb-12"><div class="tr-no-data-text animated-bg-1 w-50 h-15"></div><div class="tr-no-data-text animated-bg-1 w-25 h-15"></div></div><div class="tr-no-data-text animated-bg-1 w-50 h-15 mb-12"></div><div class="tr-row"><div class="tr-no-data-text animated-bg-1 w-30 h-20"></div><div class="tr-no-data-text animated-bg-1 w-50 h-20"></div></div></div></div></div></div><div class="tr-hotel-deatils" data-type="no-data"><div class="tr-hotal-image"><div class="tr-no-data-text animated-bg-1 w-100 h-230"></div></div><div class="tr-hotel-deatil"><div class="tr-heading-with-rating"><div class="tr-no-data-text animated-bg-1 w-50 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-25 h-24 mb-12 ml-20"></div></div><div class="tr-no-data-text animated-bg-1 w-25 h-15 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-40 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-100 h-20 mt-41 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-80 h-20 mb-12"></div></div><div class="tr-hotel-price-section"><div class="tr-hotel-price-lists"><div class="tr-hotel-price-list"><div class="tr-row mb-12"><div class="tr-no-data-text animated-bg-1 w-50 h-15"></div><div class="tr-no-data-text animated-bg-1 w-25 h-15"></div></div><div class="tr-no-data-text animated-bg-1 w-50 h-15 mb-12"></div><div class="tr-row"><div class="tr-no-data-text animated-bg-1 w-30 h-20"></div><div class="tr-no-data-text animated-bg-1 w-50 h-20"></div></div></div></div></div></div><div class="tr-hotel-deatils" data-type="no-data"><div class="tr-hotal-image"><div class="tr-no-data-text animated-bg-1 w-100 h-230"></div></div><div class="tr-hotel-deatil"><div class="tr-heading-with-rating"><div class="tr-no-data-text animated-bg-1 w-50 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-25 h-24 mb-12 ml-20"></div></div><div class="tr-no-data-text animated-bg-1 w-25 h-15 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-40 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-100 h-20 mt-41 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-80 h-20 mb-12"></div></div><div class="tr-hotel-price-section"><div class="tr-hotel-price-lists"><div class="tr-hotel-price-list"><div class="tr-row mb-12"><div class="tr-no-data-text animated-bg-1 w-50 h-15"></div><div class="tr-no-data-text animated-bg-1 w-25 h-15"></div></div><div class="tr-no-data-text animated-bg-1 w-50 h-15 mb-12"></div><div class="tr-row"><div class="tr-no-data-text animated-bg-1 w-30 h-20"></div><div class="tr-no-data-text animated-bg-1 w-50 h-20"></div></div></div></div></div></div><div class="tr-hotel-deatils" data-type="no-data"><div class="tr-hotal-image"><div class="tr-no-data-text animated-bg-1 w-100 h-230"></div></div><div class="tr-hotel-deatil"><div class="tr-heading-with-rating"><div class="tr-no-data-text animated-bg-1 w-50 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-25 h-24 mb-12 ml-20"></div></div><div class="tr-no-data-text animated-bg-1 w-25 h-15 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-40 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-100 h-20 mt-41 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-80 h-20 mb-12"></div></div><div class="tr-hotel-price-section"><div class="tr-hotel-price-lists"><div class="tr-hotel-price-list"><div class="tr-row mb-12"><div class="tr-no-data-text animated-bg-1 w-50 h-15"></div><div class="tr-no-data-text animated-bg-1 w-25 h-15"></div></div><div class="tr-no-data-text animated-bg-1 w-50 h-15 mb-12"></div><div class="tr-row"><div class="tr-no-data-text animated-bg-1 w-30 h-20"></div><div class="tr-no-data-text animated-bg-1 w-50 h-20"></div></div></div></div></div></div><div class="tr-hotel-deatils" data-type="no-data"><div class="tr-hotal-image"><div class="tr-no-data-text animated-bg-1 w-100 h-230"></div></div><div class="tr-hotel-deatil"><div class="tr-heading-with-rating"><div class="tr-no-data-text animated-bg-1 w-50 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-25 h-24 mb-12 ml-20"></div></div><div class="tr-no-data-text animated-bg-1 w-25 h-15 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-40 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-100 h-20 mt-41 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-80 h-20 mb-12"></div></div><div class="tr-hotel-price-section"><div class="tr-hotel-price-lists"><div class="tr-hotel-price-list"><div class="tr-row mb-12"><div class="tr-no-data-text animated-bg-1 w-50 h-15"></div><div class="tr-no-data-text animated-bg-1 w-25 h-15"></div></div><div class="tr-no-data-text animated-bg-1 w-50 h-15 mb-12"></div><div class="tr-row"><div class="tr-no-data-text animated-bg-1 w-30 h-20"></div><div class="tr-no-data-text animated-bg-1 w-50 h-20"></div></div></div></div></div></div><div class="tr-hotel-deatils" data-type="no-data"><div class="tr-hotal-image"><div class="tr-no-data-text animated-bg-1 w-100 h-230"></div></div><div class="tr-hotel-deatil"><div class="tr-heading-with-rating"><div class="tr-no-data-text animated-bg-1 w-50 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-25 h-24 mb-12 ml-20"></div></div><div class="tr-no-data-text animated-bg-1 w-25 h-15 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-40 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-100 h-20 mt-41 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-80 h-20 mb-12"></div></div><div class="tr-hotel-price-section"><div class="tr-hotel-price-lists"><div class="tr-hotel-price-list"><div class="tr-row mb-12"><div class="tr-no-data-text animated-bg-1 w-50 h-15"></div><div class="tr-no-data-text animated-bg-1 w-25 h-15"></div></div><div class="tr-no-data-text animated-bg-1 w-50 h-15 mb-12"></div><div class="tr-row"><div class="tr-no-data-text animated-bg-1 w-30 h-20"></div><div class="tr-no-data-text animated-bg-1 w-50 h-20"></div></div></div></div></div></div><div class="tr-hotel-deatils" data-type="no-data"><div class="tr-hotal-image"><div class="tr-no-data-text animated-bg-1 w-100 h-230"></div></div><div class="tr-hotel-deatil"><div class="tr-heading-with-rating"><div class="tr-no-data-text animated-bg-1 w-50 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-25 h-24 mb-12 ml-20"></div></div><div class="tr-no-data-text animated-bg-1 w-25 h-15 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-40 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-100 h-20 mt-41 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-80 h-20 mb-12"></div></div><div class="tr-hotel-price-section"><div class="tr-hotel-price-lists"><div class="tr-hotel-price-list"><div class="tr-row mb-12"><div class="tr-no-data-text animated-bg-1 w-50 h-15"></div><div class="tr-no-data-text animated-bg-1 w-25 h-15"></div></div><div class="tr-no-data-text animated-bg-1 w-50 h-15 mb-12"></div><div class="tr-row"><div class="tr-no-data-text animated-bg-1 w-30 h-20"></div><div class="tr-no-data-text animated-bg-1 w-50 h-20"></div></div></div></div></div></div><div class="tr-hotel-deatils" data-type="no-data"><div class="tr-hotal-image"><div class="tr-no-data-text animated-bg-1 w-100 h-230"></div></div><div class="tr-hotel-deatil"><div class="tr-heading-with-rating"><div class="tr-no-data-text animated-bg-1 w-50 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-25 h-24 mb-12 ml-20"></div></div><div class="tr-no-data-text animated-bg-1 w-25 h-15 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-40 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-100 h-20 mt-41 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-80 h-20 mb-12"></div></div><div class="tr-hotel-price-section"><div class="tr-hotel-price-lists"><div class="tr-hotel-price-list"><div class="tr-row mb-12"><div class="tr-no-data-text animated-bg-1 w-50 h-15"></div><div class="tr-no-data-text animated-bg-1 w-25 h-15"></div></div><div class="tr-no-data-text animated-bg-1 w-50 h-15 mb-12"></div><div class="tr-row"><div class="tr-no-data-text animated-bg-1 w-30 h-20"></div><div class="tr-no-data-text animated-bg-1 w-50 h-20"></div></div></div></div></div></div><div class="tr-hotel-deatils" data-type="no-data"><div class="tr-hotal-image"><div class="tr-no-data-text animated-bg-1 w-100 h-230"></div></div><div class="tr-hotel-deatil"><div class="tr-heading-with-rating"><div class="tr-no-data-text animated-bg-1 w-50 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-25 h-24 mb-12 ml-20"></div></div><div class="tr-no-data-text animated-bg-1 w-25 h-15 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-40 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-100 h-20 mt-41 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-80 h-20 mb-12"></div></div><div class="tr-hotel-price-section"><div class="tr-hotel-price-lists"><div class="tr-hotel-price-list"><div class="tr-row mb-12"><div class="tr-no-data-text animated-bg-1 w-50 h-15"></div><div class="tr-no-data-text animated-bg-1 w-25 h-15"></div></div><div class="tr-no-data-text animated-bg-1 w-50 h-15 mb-12"></div><div class="tr-row"><div class="tr-no-data-text animated-bg-1 w-30 h-20"></div><div class="tr-no-data-text animated-bg-1 w-50 h-20"></div></div></div></div></div></div><div class="tr-hotel-deatils" data-type="no-data"><div class="tr-hotal-image"><div class="tr-no-data-text animated-bg-1 w-100 h-230"></div></div><div class="tr-hotel-deatil"><div class="tr-heading-with-rating"><div class="tr-no-data-text animated-bg-1 w-50 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-25 h-24 mb-12 ml-20"></div></div><div class="tr-no-data-text animated-bg-1 w-25 h-15 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-40 h-24 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-100 h-20 mt-41 mb-12"></div><div class="tr-no-data-text animated-bg-1 w-80 h-20 mb-12"></div></div><div class="tr-hotel-price-section"><div class="tr-hotel-price-lists"><div class="tr-hotel-price-list"><div class="tr-row mb-12"><div class="tr-no-data-text animated-bg-1 w-50 h-15"></div><div class="tr-no-data-text animated-bg-1 w-25 h-15"></div></div><div class="tr-no-data-text animated-bg-1 w-50 h-15 mb-12"></div><div class="tr-row"><div class="tr-no-data-text animated-bg-1 w-30 h-20"></div><div class="tr-no-data-text animated-bg-1 w-50 h-20"></div></div></div></div></div></div>');

  var amenities = [];
  $('.mnt input[name="mnt"]:checked').each(function() {
      amenities.push($(this).val());
  });
  var amenitiesList = amenities.join(',');
  //special mnt
  var spamenities = [];
  $('.mnt input[name="smnt"]:checked').each(function() {
      spamenities.push($(this).val());
  });
  var spamenitiesList = spamenities.join(',');
  //stars
  var st=[]
  var starRating = $('.star-rating input[name="rating"]:checked').each(function(){
    st.push($(this).val());
  })
  var st =  st.join(',');
  //hotel type
  var ht=[]
  var hoteltype = $('.hoteltype input[name="hoteltypes"]:checked').each(function(){
    ht.push($(this).val());
  })
  var hotelaa =  ht.join(',');
 //agency
 var agency=[]
 var agencies = $('.agencies input[name="agency"]:checked').each(function(){
  agency.push($(this).val());
 })
 var agencydt =  agency.join(',');
 var sortBy = $('.custom-select .same-as-selected').text(); 
  $.ajax({
      type: 'post',
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: base_url + 'hotel_all_filters',
      data: {
          'priceFrom': priceFrom,
          'priceTo': priceTo,
          'mnt': amenitiesList, 
          'locationid': locationid,
          'Cin': Cin,
          'Cout': Cout,
          'guest': guest,
          'rooms': rooms,
          'starRating':st,
          'hoteltype':hotelaa,
          'Smnt':spamenitiesList,
          'agency':agencydt,
       'sort_by': sortBy,
          'page': page,
          '_token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
       
         $('.hotel_count').text(response.resultcount + ' properties found');
         
         $('.filter-listing').html(response.result);
           //start new code
                 
              $('#mapModal .tr-filters-section').empty(); 
              $('#mapModal .tr-room-section-2').empty(); 
              $('.tr-filters-section .tr-filter-lists').each(function() {
                  var FilterLists = $(this).clone();
                  $('#mapModal .tr-filters-section').append(FilterLists);
              });
              $('.tr-room-section-2 .tr-hotel-deatils').each(function() {
                  var HotelLists = $(this).clone();
                  $('#mapModal .tr-room-section-2').append(HotelLists);
              });
              $('#mapModal .carousel').each(function() {
          var currentId = $(this).attr('id');
          if (currentId) {
          var newId = currentId + '-1';
          $(this).attr('id', newId);
          $('#mapModal button[data-bs-target="#' + currentId + '"]').each(function() {
            $(this).attr('data-bs-target', '#' + newId);
          });
          }
        });
          //end new code
          //.trigger('change')
      }
  });   
}
//end search hotel list





//show selected filtes 



document.addEventListener('DOMContentLoaded', function() {
  initializeFilterListeners();

  // Add click event listener for .tr-filter-selected to handle cross click
  document.addEventListener('click', function(event) {
      if (event.target.closest('.tr-filter-selected')) {
          handleSelectedFilterClick(event);
      }
  });
});

function initializeFilterListeners() {
  const filterSections = document.querySelectorAll('.tr-filters-section');

  filterSections.forEach(function(section) {
      const checkboxes = section.querySelectorAll('.filter');
      const sectionId = section.getAttribute('data-section');

      checkboxes.forEach(function(checkbox) {
          checkbox.removeEventListener('change', handleCheckboxChange); // Remove previous handler
          checkbox.addEventListener('change', function() {
              handleCheckboxChange(checkbox, sectionId);
          });
      });
  });
}

function handleCheckboxChange(checkbox, sectionId) {
  // Update selected data
  updateSelectedData(sectionId);

  // Fetch filtered results
  fetchFiltered(1);
}

function updateSelectedData(sectionId) {
  const sections = document.querySelectorAll('.tr-filters-section');
  
  sections.forEach(function(section) {
      const checkboxes = section.querySelectorAll('.filter');
      const sectionId = section.getAttribute('data-section');
      const selectedDataElement = document.querySelector(`.selected-data[data-section="${sectionId}"]`);
      if (selectedDataElement) {
          selectedDataElement.innerHTML = ''; // Clear previous data

          checkboxes.forEach(function(checkbox) {
              if (checkbox.checked) {
                  const labelText = checkbox.closest('label').textContent.trim();
                  const div = document.createElement('div');
                  div.classList.add('tr-filter-selected');
                  div.textContent = labelText;
                  div.setAttribute('data-value', checkbox.value); // Store the value for reference
                  selectedDataElement.appendChild(div);
              }
          });
      }
  });
}

function handleSelectedFilterClick(event) {
  const clickedElement = event.target.closest('.tr-filter-selected');
  
  if (clickedElement) {
      const filterValue = clickedElement.getAttribute('data-value');
      
      // Uncheck the filter in all sections
      document.querySelectorAll('.filter').forEach(function(checkbox) {
          if (checkbox.value === filterValue) {
              checkbox.checked = false; // Uncheck the checkbox
              handleCheckboxChange(checkbox, checkbox.closest('.tr-filters-section').getAttribute('data-section'));
          }
      });

      // Remove the clicked filter item from the selected data
      clickedElement.remove();
  }
}


//end selected filters


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





 //hotel list data
 function chechavail(){
        if(window.matchMedia('(min-width: 769px)').matches){
                $('.tr-view-availability-btn').on('click', function() {
                    $('html, body').animate({ scrollTop: $('#checkInInput3').offset().top - 160 }, 500);
                    calendarsBox3();
        });
        };
    }
             
    function mobilecheckavail(){
        $(document).ready(function() {
        $('.tr-mobile-when, .tr-view-availability-btn').click(function() {
            $('html, body').animate({ scrollTop: $('.tr-search-hotel').offset().top - 75 }, 500);
            $(".tr-form-booking-date").addClass("open");
            setTimeout(function() {
            if($(".tr-form-booking-date").hasClass('open')){
                $('#checkInInput3').click();
                $('#checkInInput3').focus();
                $('.custom-calendar').show();
            }
            }, 100);
        });
        });     
    }

    $(document).ready(function() { 
      var locationid = $('.slugid').text(); 
      var lname = $('.lname').text();       
      var type = $('.ptype').text();
      var st = $('.filter-st').text();   	
      var amenity = $('.filter-amenity').text();
      if (type == 'withoutdate') {
          function hotellisting(page) {
              $.ajax({
                  type: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: base_url + 'getwithoutdatedata',
                  data: {
                      'locationid': locationid,
                      'lname': lname,
                      'amenity':amenity,
                      'starrating':st,
                      'page': page
                  },

                  success: function(response) {
                      $('.filter-listing').html(response);
            chechavail();
                  // Read More, 3 list show - Common
                  $('.list-content').each(function () {
                    var $container = $(this);
                    var $content = $container.find('ul li');
                    var $toggleButton = $container.find('.toggle-list');
                    var limit = 2;
                    $content.slice(0, limit).addClass('visible');
                    $toggleButton.on('click', function () {
                      if ($toggleButton.text() === 'Read More') {
                        $content.addClass('visible');
                        $toggleButton.text('Read Less');
                      } else {
                        $content.slice(limit).removeClass('visible');
                        $toggleButton.text('Read More');
                      }
                    });
                    if ($content.length <= limit) {
                      $toggleButton.hide();
                    }
                  });
                  // Read More, Paragraph - Common Code
                  $(document).ready(function () {
                    $(".paragraph-content").each(function () {
                      var $contentPara = $(this).find(".para-content");
                      var $toggleParaButton = $(this).find(".toggle-para");
                      var originalContent = $contentPara.html();
                      var wordsArray = originalContent.split(" ");
                      var limit = 70;
                      if (wordsArray.length > limit) {
                        var visibleText = wordsArray.slice(0, limit).join(" ") + "...";
                        $contentPara.html(visibleText);
                        $toggleParaButton.on("click", function () {
                          if ($toggleParaButton.text() === "Read More") {
                            $contentPara.html(originalContent);
                            $toggleParaButton.text("Read Less");
                          } else {
                            $contentPara.html(visibleText);
                            $toggleParaButton.text("Read More");
                          }
                        });
                      } else {
                        $toggleParaButton.hide();
                      }
                    });
                  });
                      mobilecheckavail();
                  },
                  error: function() {
                      // Handle error here
                  }
              });
          }
      
          // Initial load
          hotellisting(1);
      
          $(document).on('click', '.pagination a', function(e) {
              e.preventDefault();
              var page = $(this).attr('href').split('page=')[1];
              hotellisting(page);
              $('html, body').animate({ scrollTop: $('.filter-listing').offset().top }, 'slow');
          });
      }
  });


