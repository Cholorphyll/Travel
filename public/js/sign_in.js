var baseURL = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window
    .location.port : '');
  var base_url = baseURL + '/';
    
  //   $(document).ready(function() {
  //   document.getElementById('changePictureLink').addEventListener('click', function(event) {
  //     event.preventDefault(); // Prevent the default action of the link
  //     document.getElementById('fileInput').click(); 
  //     var form = document.getElementById('changeimg');
  //     var submitButton = document.getElementById('uploadButton');
  //     if (form.style.display === 'none') {
  //         form.style.display = 'block'; // Show the form
  //         submitButton.style.display = 'block'; // Show the submit button
  //     } else {
  //         form.style.display = 'none'; // Hide the form
  //         submitButton.style.display = 'none'; // Hide the submit button
  //     }
  // });



  //   $('#changeimg').submit(function(event) {
  //     event.preventDefault();

  //     var formData = new FormData($(this)[0]); // Initialize FormData with the form


  //     $.ajax({
  //       headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //       },
  //       type: 'POST',
  //       url: base_url + 'changeprofileimg', 
  //       data: formData, 
  //       processData: false, 
  //       contentType: false, 
  //       success: function(response) {
  //         $('#exampleModalss').modal('hide');
  //         $('.getimge').html(response.image_result);
        
  //       },
  //       error: function(xhr, textStatus, errorThrown) {
  //         console.log(xhr.responseText);
  //       }
  //     });
  //   });
  // });


// $(document).ready(function() {
//   function attachChangePictureLinkEvent() {
//     document.getElementById('changePictureLink').addEventListener('click', function(event) {
//         event.preventDefault();
//       event.preventDefault(); // Prevent the default action of the link
//       document.getElementById('fileInput').click();
//       var form = document.getElementById('changeimg');
//       var submitButton = document.getElementById('uploadButton');
//       if (form.style.display === 'none') {
//           form.style.display = 'block'; // Show the form
//           submitButton.style.display = 'block'; // Show the submit button
//       } else {
//           form.style.display = 'none'; // Hide the form
//           submitButton.style.display = 'none'; // Hide the submit button
//       }
//     });
//   }

//   // Initial call to attach the event handler
//   attachChangePictureLinkEvent();

//   // Handle form submission
//   $('#changeimg').submit(function(event) {
//     event.preventDefault();

//     var formData = new FormData($(this)[0]); // Initialize FormData with the form

//     $.ajax({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       },
//       type: 'POST',
//       url: base_url + 'changeprofileimg',
//       data: formData,
//       processData: false,
//       contentType: false,
//       success: function(response) {
//         $('#exampleModalss').modal('hide');
//         $('.getimge').html(response.image_result);
//         // Update the profile picture
//         $('#profilePicture').attr('src', response.new_image_url);

//         // Reset the form
//         $('#changeimg')[0].reset();
//         $('#uploadButton').hide(); // Hide the submit button
//         $('#changeimg').hide(); // Hide the form

//         // Reattach the event handler
//         attachChangePictureLinkEvent();
//       },
//       error: function(xhr, textStatus, errorThrown) {
//         console.log(xhr.responseText);
//       }
//     });
//   });
// });

// $(document).ready(function() {
//   // Function to attach event listener to changePictureLink
//   function attachEventListener() {
//       $('#changePictureLink').on('click', function(event) {
//           event.preventDefault(); // Prevent the default action of the link
//           $('#fileInput').click(); 

//           // Toggle form and submit button display
//           $('#changeimg, #uploadButton').toggle();
//       });
//   }

//   // Initial attachment of event listener
//   attachEventListener();

//   // Handle form submission with jQuery
//   $('#changeimg').submit(function(event) {
//       event.preventDefault();

//       var formData = new FormData($(this)[0]); // Initialize FormData with the form

//       $.ajax({
//           headers: {
//               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           },
//           type: 'POST',
//           url: base_url + 'changeprofileimg', 
//           data: formData, 
//           processData: false, 
//           contentType: false, 
//           success: function(response) {
//               $('#exampleModalss').modal('hide');
//               $('.getimge').html(response.image_result);
              
//               // Reattach event listener after AJAX success
//               attachEventListener();
//           },
//           error: function(xhr, textStatus, errorThrown) {
//               console.log(xhr.responseText);
//           }
//       });
//   });
// });
$(document).ready(function() {
  // Function to attach event listener to changePictureLink
  
  // Handle form submission with jQuery
  $('#changeimg').submit(function(event) {
      event.preventDefault();

      var formData = new FormData($(this)[0]); // Initialize FormData with the form

      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          url: base_url + 'changeprofileimg', 
          data: formData, 
          processData: false, 
          contentType: false, 
          success: function(response) {
              $('#exampleModalss').modal('hide');
              $('.getimge').html(response.image_result);
              
              $('#uploadButton').css('display','none')
              attachEventListener();
              
              $('.navbar-nav').html(response.usernavimg);
              $('#changeimg, #uploadButton').show();
          },
          error: function(xhr, textStatus, errorThrown) {
              console.log(xhr.responseText);
          }
      });
  });
});





	  
	  $(document).ready(function() {

    function attachEventListener() {
        // Remove any existing click event listeners to prevent duplicate triggers
        $(document).off('click', '#changePictureLink').on('click', '#changePictureLink', function(event) {
            event.preventDefault(); 
            $('#fileInput').click();
            $('#changeimg, #uploadButton').toggle();
			$('#uploadButton').css('display','block');
			$('#changeimg').css('display','block');
			
        });
    }

    attachEventListener();

    $('#myForm').submit(function(event) {
        event.preventDefault();

        var formData = new FormData($(this)[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: base_url + 'updateprofile',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#exampleModalss').modal('hide');
                $('.getupdata').html(response.profile_data);
                $('.getimge').html(response.image_result);
                $('.navbar-nav').html(response.usernavimg);
                $('.user-msg').html('');

                // Reattach event listener after content update
                attachEventListener();
            },
            error: function(xhr, textStatus, errorThrown) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    if (errors.Username) {
                        $('.user-msg').html(errors.Username[0]).show().css('color', 'red');
                    } else {
                        $('.user-msg').html('').hide();
                    }
                } else {
                    console.log(xhr.responseText);
                }
            }
        });
    });
});


function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }


  function myFunctions() {
    var x = document.getElementById("myInput2");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

