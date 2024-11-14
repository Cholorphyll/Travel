

var baseURL = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
var base_url = baseURL + '/';

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










$(document).ready(function () {
    $('input').val('')
});

$('.bloglistingcarousel').each(function () {
    var slider = $(this);
    slider.slick({
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        mobileFirst: true,
        arrows: false,
        responsive: [{
            breakpoint: 480,
            settings: "unslick"
        }]
    });

});












const minus = $('.roomsdecrement');
const input = $('.roominputfield');

// const adultincrement = $('.adultincrement')
// const childreincrement = $('.childreincrement')
// var totalPoints = childronnum + adultrnum;
// var childronnum = 0;
// var adultrnum = 0;
// const totalguests = $('.totalguests');
// // const plus = $('.increment');
// // const reset = $('.Reset');
// // const apply = $('.apply');
// // const totalguests = $('.totalguests');
const roomincrement = $('.roomincrement')
const inputrooms = $('#inputRooms');
const roomcount = $('.roomcount');

roomincrement.click(function () {
    var value = $(this).siblings(input).val();
    value++;
    console.log(value);

    $(this).siblings(input).val(value);
    $('.roomcount').text(value)
})

// input.text(0);

minus.click(function () {

    var value = $(this).siblings(input).val();
    if (value > 1) {
        value--;
    }
    $(this).siblings(input).val(value);
    $('.roomcount').text(value)
});


// adultincrement.click(function () {
//     var value = $(this).siblings(input).val();
//     value++;
//     $(this).siblings(input).val(value);
//     adultrnum = value;
//     totalPoints = childronnum + adultrnum
//     totalguests.text(totalPoints);
// })
// childreincrement.click(function () {
//     var value = $(this).siblings(input).val();
//     value++;
//     $(this).siblings(input).val(value);
//     childronnum = value;
//     totalPoints = childronnum + adultrnum
//     totalguests.text(totalPoints);
// })


// $(reset).click(function (e) {
//     e.preventDefault();
//     input.val(0)
//     $('#inputRooms').val(0)
//     childronnum.parseFloat($(this).val()) + totalPoints
// });


// $(apply).click(function (e) {
//     e.preventDefault();
//     var totalPoints = 0;
//     $('.counter .inputfield').each(function () {
//         totalPoints = parseFloat($(this).val()) + totalPoints;
//     });
//     totalguests.text(totalPoints - 1);
//     roomcount.text(inputrooms.val())
// });// $('.checkin').click(function (e) {
//     e.preventDefault();
//     $(this).addClass('active-border');
//     $('.checkout').removeClass('active-border');

// });
// $('.checkout').click(function (e) {
//     e.preventDefault();
//     $('.checkin').removeClass('active-border');
//     $(this).removeClass('disabled');
//     $(this).addClass('active-border');
// });


// $('.view-more').click(function (e) {
//     e.preventDefault();
//     $('input[name="datefilter"]').data('daterangepicker').show();

// });




if ($(window).width() < 606) {
    $('.typeahed').click(function (e) {
        e.preventDefault();
        $('.other-sections').hide();
        $(this).addClass('unstyletypehead');
    });

    $(document).click(function (event) {
        var $target = $(event.target);
        if (!$target.closest('.typeahed').length) {
            $('.other-sections').show();
            $('.typeahed').removeClass('unstyletypehead');
        }
    });
}


jQuery(document).ready(function () {

    jQuery('.more').readmore({
        speed: 300,
        collapsedHeight: 140,
        moreLink: '<a href="#" class="text-decoration-none d-inline-block mt-34"><b class="fw-500 fs12">View more <img src="images/arrow-down.svg" class="ml-10" alt=""></b></a>',
        lessLink: '<a href="#" class="text-decoration-none d-inline-block mt-34"><b class="fw-500 fs12">View less <img src="images/uparrow.png" class="ml-10" alt=""></b></a>',
        heightMargin: 16
    });

});

$(document).on('click', '.add-rest-review', function () {
    $('.loadResult').removeClass('hide');

    var desc = $('.review_desc').val();
    if (desc == "") {
        var activeElement = $(".rev-desc.active");
        desc = activeElement.text();
    }
    var isValid = true;
    var name = $('.name').val();
    if(name==""){
        $('.name-error').text('Name is required.').css('color', 'red');
        isValid = false;
    }
    var email = $('.email').val();
    if(email==""){
        $('.email-error').text('Email is required.').css('color', 'red');
        isValid = false;
    } else {      
        var emailPattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;    
        if (!email.match(emailPattern)) {
            $('.email-error').text('Invalid email format.').css('color', 'red');
            isValid = false;
        } else {      
            $('.email-error').text(''); 
        }
    }

    if(!isValid){
        return;
    }
    $('.email-error').text('');

    $('.name-error').text('');

    $('.name-error').text('Please wait..').css('color', 'green');
    var formData = new FormData();
    var files = $('#files')[0].files;
    var restid = $('.rest_id').text();
    for (var i = 0; i < files.length; i++) {
        formData.append('files[]', files[i]);
    }
    var rating = $('.page-item.active').text();

    formData.append('name',name);
    formData.append('email',email);
    formData.append('desc', desc);
    formData.append('rating',rating);
    formData.append('restid',restid)

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'post',
        url: base_url + 'add_rest_review',
        data: formData, 
        contentType: false,
        processData: false, 
        success: function (response) {
            $('#exampleModal').modal('hide');
            $('.name').val('');
            $('.email').val('');
            $(".pip").text('');
            $('.review-update').html(response);
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
});


$(document).ready(function() {
    $('.pagination.star-rating .page-item a.page-link').on('click', function() {  

        $('.pagination.star-rating .page-item').removeClass('active');       
    
        $(this).closest('.page-item').addClass('active');
    });
});





function updateMapWithFilteredData(getrest) {
  
    for (var key in markers) {
      map.removeLayer(markers[key]);
    }
    markers = {};   
 
    var newLocations = [];
    getrest.forEach(function(data) {
      if (data.Latitude && data.Longitude) {
        var marker = new L.Marker([parseFloat(data.Latitude), parseFloat(data.Longitude)]);
        marker.addTo(map);
        markers[data.RestaurantId] = marker;
        newLocations.push([parseFloat(data.Latitude), parseFloat(data.Longitude)]);
      }
    });
     
    var group = new L.featureGroup(newLocations);
    map.fitBounds(group.getBounds());
  }
  
  
  // Event handler for the click event
  $(document).on('click', '.filter_restbycat', function() {
    var cat = $(this).text();
    var locid = $(this).data('id');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'post',
      url: base_url + 'filterrestbycat',
      data: {
        'catid': cat,
        'locationId': locid,
        '_token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        $('.get_result').html(response.htmlView); // Update HTML view
        var mapData = JSON.parse(response.mapData); // Parse JSON data for map
        updateMapWithFilteredData(mapData);
      },
      error: function(error) {
        console.error('Error fetching filtered data:', error);
      }
    });
  });

//listing view more hide and show
  const viewMore = document.getElementById('viewMore');
  const hiddenResults = document.getElementById('hiddenResults');

  if (viewMore) {
      viewMore.addEventListener('click', function () {
          if (hiddenResults.style.display === 'none') {
              hiddenResults.style.display = 'block';           
              viewMore.querySelector('u').textContent = 'View Less'; 
          } else {
              hiddenResults.style.display = 'none';            
              viewMore.querySelector('u').textContent = 'View More';
          }
      });
  }


// inf scroll
let page = 1;
let loading = false;
var locid = $('#locid').text();
var slug = $('#slug').text();
   
// Function to load more content
function loadMoreContent() {
    if (!loading) {
        loading = true; 
        document.getElementById('loading').style.display = 'block';

        // Make an AJAX request to load more data
    // Make an AJAX request to load more data
fetch(base_url + `load-more-attractions?page=${page}&locid=${locid}&slug=${slug}`)
.then((response) => response.json())
.then((data) => {
    // Append the new HTML content to the container
    document.getElementById('getcatfilterdata').insertAdjacentHTML('beforeend', data.html);

    // Increment the page number
    page++;

    // Hide the loading indicator
    document.getElementById('loading').style.display = 'none';

    loading = false;
  if (data.mapData) {

        var mapData = JSON.parse(data.mapData); // Parse JSON data for map
        updateMapWithFilteredDataas(mapData);
    } else {
        // Handle the case where mapData is not present in the response
        console.error('No mapData in the response');
    }
})
.catch((error) => {
    console.error('Error loading more content:', error);
    loading = false;
});
    }
}

// Function to check if the user has scrolled to the bottom of the page
function checkScroll() {
    const contentContainer = document.getElementById('getcatfilterdata');
    if (contentContainer) {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = contentContainer.scrollHeight;
        const clientHeight = document.documentElement.clientHeight;

        if (scrollTop + clientHeight >= scrollHeight - 200) {
            loadMoreContent();
        }
    }
}


window.addEventListener('scroll', checkScroll);

document.querySelector('.tr-load-more').addEventListener('click', function() {
    loadMoreContent();
});

loadMoreContent();

function updateMapWithFilteredDataas(getrest) {
    var newLocations = [];

    // Add existing markers to the list of new locations
    for (var key in markers) {
        if (markers.hasOwnProperty(key)) {
            var existingMarker = markers[key];
            var existingLatLng = existingMarker.getLatLng();
            newLocations.push([existingLatLng.lat, existingLatLng.lng]);
        }
    }

    var iconUrl = 'public/js/images/3.svg';

    getrest.forEach(function(data) {
        if (data.Latitude && data.Longitude) {
            var marker;
            if (data.ismustsee == 1) {
                marker = new L.Marker([parseFloat(data.Latitude), parseFloat(data.Longitude)], {
                    icon: L.icon({
                        iconUrl: iconUrl,
                        iconSize: [52, 53],
                    })
                });
            } else {
                marker = new L.Marker([parseFloat(data.Latitude), parseFloat(data.Longitude)]);
            }

            var markerId = data.SightId; // Unique identifier for the marker

            // Check if a marker with the same SightId already exists
            if (!markers.hasOwnProperty(markerId)) {
                marker.on('mouseover', function(e) {
                    showLocationdata(e, data.name, data.recmd, data.cat, data.tm, data.cityName, data.imagePath);
                });

                marker.on('mouseout', function() {
                    map.closePopup();
                });

                marker.addTo(map);
                markers[markerId] = marker; // Store the marker in the markers object
            }

            newLocations.push([parseFloat(data.Latitude), parseFloat(data.Longitude)]);
        }
    });

    // Create a feature group and fit bounds
    if (newLocations.length > 0) {
        var group = new L.featureGroup(newLocations.map(latlng => L.marker(latlng)));
        map.fitBounds(group.getBounds());
    }
}

function showLocationdata(e, name, recmd, cat, tm, cityName, imagePath) {
    var marker = e.target;
    var popupContent = `
     <div class="tr-map-tooltip tr-explore-listing" style="top: -214px !important;
    right: -1px;">
    <div class="tr-historical-monument">
      <div class="tr-heading-with-distance">
        <div class="tr-category">${cat}</div>      
      </div>
      <div class="tr-image">
        <a href="javascript:void(0);">
          <img loading="lazy" src="${imagePath}" alt="" height="109" width="280">
        </a>
      </div>
      <div class="tr-details">
        <h3><a href="javascript:void(0);" target="_blank">${name}</a></h3>
        <div class="tr-location">${cityName || ''}</div>
        <div class="tr-like-review">
          <div class="tr-heart">
            <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M5.99604 2.28959C5.02968 1.20745 3.41823 0.916356 2.20745 1.90727C0.996677 2.89818 0.826217 4.55494 1.77704 5.7269L5.99604 9.63412L10.215 5.7269C11.1659 4.55494 11.0162 2.88776 9.78463 1.90727C8.55304 0.92678 6.96239 1.20745 5.99604 2.28959Z"
                fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </div>
          <div class="tr-ranting-percent">${recmd || ''}</div>
        </div>
      </div>
      <div class="tr-more-inform">
        <ul>
          <li><span>Open</span>${tm || ''}</li>         
        </ul>
      </div>
    </div>
  </div>`;
    marker.bindPopup(popupContent, { offset: L.point(0, -20) }).openPopup();
}



// $(function () {
//   $('input[name="datefilter"]').daterangepicker({
//       autoUpdateInput: true,
//       "opens": "center",
//       "autoApply": true,
//       locale: {
//           cancelLabel: 'Clear'
//       }
//   });

//   $('.checkin input').on('apply.daterangepicker', function (ev, picker) {
//       $(this).val(picker.startDate.format('MM/DD/YYYY'));
//       $('#checkout').val(picker.endDate.format('MM/DD/YYYY'));
//       $('.checkout').removeClass('active-border');
//       $('.checkin').removeClass('active-border');

//   });

//   $('input[name="datefilter"]').on('cancel.daterangepicker', function (ev, picker) {
//       $(this).val('');
//   });




// });