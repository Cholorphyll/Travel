var baseURL = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
var base_url = baseURL + '/';



// start search
$(document).ready(function() {
  var locationIdValue = $('#locid').text();

  $.ajax({
    type: 'GET',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: base_url + 'addLocationfaqfont',
    data: { 'locationIdValue': locationIdValue},
    success: function(response) {
        $('#faqdata').html(response);
     
    },
    error: function(xhr, status, error) {
      // Handle the error
      console.log(error);
    }
  });
});



$(document).on('click', '.filter_sightbycat', function () {
  var catid = $(this).data('catid');
  var names = $(this).data('name');
  var locationId = $('#locid').text();
  var delcatid = $(this).data('delcatid');
  var clearfilter = $(this).data('clear_all');


  $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'post',
      url: base_url + 'filtersightbycat',
      data: {
          'catid': catid,
          'locationId': locationId,'names':names,'delcatid':delcatid,'clearfilter':clearfilter,
          '_token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
          $('#getcatfilterdata').html(response.html);
          var mapData = JSON.parse(response.mapData);
          // Modify the map markers/icons using the response.mapData
          updateMapWithFilteredDataaa(mapData);
      }
  });
});

function updateMapWithFilteredDataaa(getrest) {
  if (!Array.isArray(getrest)) {
      console.error('getrest is not an array');
      return;
  }

  // Remove all existing markers from the map
  var newLoc = [];
  for (var key in markers) {
      if (markers.hasOwnProperty(key)) {
          var existingMarker = markers[key];
          map.removeLayer(existingMarker);
          delete markers[key];
      }
  }

  var iconUrl = 'public/js/images/highlight-loc.png';

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

          marker.on('mouseover', function(e) {
              showLocationName(e, data.name, data.recmd,data.cat,data.tm, );
          });

          marker.on('mouseout', function(e) {
              map.closePopup();
          });

          marker.addTo(map);
          markers[data.SightId] = marker;
          newLoc.push([parseFloat(data.Latitude), parseFloat(data.Longitude)]);
      }
  });

  var group = new L.featureGroup(newLoc);
  map.fitBounds(group.getBounds());
}

function showLocationName(e, name, recommend,cat,tm ) {
  var marker = e.target;

  // Create the popup content with the name and recommend value
  var popupContent = '<strong>' + name + '</strong>' +
    '<br>Recommendss: ' + recommend + '<br>'+cat + '<br>' + tm ;

  marker.bindPopup(popupContent, { offset: L.point(0, -20) }).openPopup();
}




//end code map 



 var categoryElements = document.querySelectorAll(".filter_sightbycat");
 categoryElements.forEach(function(element) {
   element.addEventListener("click", function() {
     var categoryId = this.getAttribute("data-catid");

     // Swap category positions
     var container = document.querySelector(".container");
     var slideElements = document.querySelectorAll(".slide");

     // Find the index of the clicked category
     var clickedIndex = Array.from(slideElements).findIndex(function(slideElement) {
       return slideElement.contains(element);
     });

     // Move the clicked category to the first position
     container.insertBefore(slideElements[clickedIndex], slideElements[0]);

     // Output the new order of categories
     console.log("New Order:", Array.from(slideElements).map(function(slideElement) {
       return slideElement.textContent.trim();
     }));

     // Add your code to display relevant content based on the new order
   });
 });








//start code sight search where
var searchTimeouts;

$(document).on('keyup', '.serch_sights', function() {
    var value = $(this).val();
    var locationId = $('#locid').text();

    clearTimeout(searchTimeouts);

    searchTimeouts = setTimeout(function() {
        performSightSearch(value, locationId); 
    }, 500);
});


function performSightSearch(value, locationId) {
    if (value.length >= 1) {
        if (value != "") {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: base_url + 'search_sights',
                data: {
                    'val': value,
                    'locationId': locationId,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                  $('#getcatfilterdata').html(response.html);
                    var mapData = JSON.parse(response.mapData);
                    updatemapdata(mapData);
                  
                }
            });
        }
    }
}




function updatemapdata(getrest) {
  // Check if the provided data is an array
  if (!Array.isArray(getrest)) {
    console.error('getrest is not an array');
    return;
  }

  // Create an array to store new marker coordinates
  var newLoc = [];

  // Iterate over the data to create markers
  getrest.forEach(function(data) {
    if (data.Latitude && data.Longitude) {
      var marker;
      if (data.ismustsee == 1) {
        marker = L.marker([parseFloat(data.Latitude), parseFloat(data.Longitude)], {
          icon: L.icon({
            iconUrl: 'public/js/images/highlight-loc.png',
            iconSize: [52, 53]
          })
        });
      } else {
        marker = L.marker([parseFloat(data.Latitude), parseFloat(data.Longitude)]);
      }

      marker.bindPopup('<b>' + data.name + '</b><br>' + data.recmd + '<br>' + data.cat);

      // Add the marker to the map
      marker.addTo(map);

      // Push the coordinates to newLoc array
      newLoc.push([parseFloat(data.Latitude), parseFloat(data.Longitude)]);
    }
  });

  // If there are new markers, fit the map bounds to the new markers
  if (newLoc.length > 0) {
    var group = new L.featureGroup(newLoc);
    map.fitBounds(group.getBounds());

    // Remove all existing markers
    map.eachLayer(function(layer) {
      if (layer instanceof L.Marker) {
        map.removeLayer(layer);
      }
    });
  } else {
    // If there are no new markers, remove all existing markers
    map.eachLayer(function(layer) {
      if (layer instanceof L.Marker) {
        map.removeLayer(layer);
      }
    });
  }
}
//end code sight search where





// Add event listeners to stars
const stars = document.querySelectorAll('.stars');

stars.forEach((star, index) => {
    star.addEventListener('click', function() {
        for (let i = 0; i <= 5; i++) {
             stars[i].classList.replace('far', 'fas');
             if (i <= index ) {
               stars[i].classList.replace('far', 'fas');
             } else {
                 stars[i].classList.replace('fas', 'far');
             }
        }

    });
});

// $.noConflict();
// $(document).ready(function () {
//     $('.logo-carousel').slick({
//         slidesToShow: 4,
//         infinite: false,
//         slidesToScroll: 1,
//         autoplay: false,
//         autoplaySpeed: 100,
//         arrows: true,
//         dots: false,
//         pauseOnHover: false,
//         responsive: [{
//             breakpoint: 768,
//             settings: {
//                 slidesToShow: 2
//             }
//         }, {
//             breakpoint: 520,
//             settings: {
//                 slidesToShow: 2
//             }
//         }]
//     });
// });




let serchInput = document.querySelector("header .search-box input");
let serchBox = document.querySelector("header .search-box");
let serchClose = document.querySelector("header  .close");
let serchinfo = document.querySelector("header .search-info");
let serchBoxinfo = document.querySelector("header .search-box-info");

// if (serchClose.classList.contains("d-none")) {
//   serchBox.addEventListener("click", () => {
//     serchInput.focus();
//     serchBox.classList.add("active");
//     serchinfo.classList.add("d-none");
//     serchBoxinfo.classList.remove("d-none");
//     serchInput.classList.remove("fs-22");
//     serchInput.classList.add("fs-16");
//     serchClose.classList.remove("d-none");
//     serchBox.classList.remove("justify-content-center");
//     serchInput.placeholder ="Where are you going?";

//   });
// } else {
//   serchBox.addEventListener("click", () => {
//     serchInput.blur();
//   });
// }
// serchInput.addEventListener("blur", () => {
//   serchBox.classList.add("justify-content-center");
//   serchInput.placeholder = placeholderValue;

//   serchBox.classList.remove("active");
//   serchInput.classList.add("fs-22");
//   serchInput.classList.remove("fs-16");
//   serchBoxinfo.classList.add("d-none");
//   serchinfo.classList.remove("d-none");
//   serchClose.classList.add("d-none");
// });
// serchClose.addEventListener("click", () => {
//   serchInput.blur();
//   serchBox.classList.remove("active");
// });



