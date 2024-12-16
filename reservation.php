<?php
include("header.php");
?>
<div class="container">

    <div class="card">
        <div class="card-body">
            <h1 class="text-center p-5 mx-5">Find Reservation</h1>
            <form class="needs-validation" novalidate>
                <!-- Reference no. input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="form2Example1" class="form-control" required />
                    <label class="form-label" for="form2Example1">Reference Number</label>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill up the form!
                    </div>
                </div>
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4"> 
                <input type="email" id="form2Example2" class="form-control" required />
                    <label class="form-label" for="form2Example2">Email address</label>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        Please fill up the form!
                    </div>
                </div>

                <!-- Submit button -->
                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4"
                    id="findReservation">Find my Reservation</button>
            </form>
        </div>
    </div>

    <div class="card d-none" id="reservationDetailsCard">
        <div class="card-body">
            <h1 class="text-center p-5 mx-5">RESERVATION DETAILS</h1>
            <h5 class="text-center" id="reference_number"></h5>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <img  id="img" class="shadow-sm bg-body rounded" style="height:300px; width: 500px">
                    </div>
                    <div class="col">
                        <p class="mb-0">Facility Name: <span id="room_name"></span></p>
                        <p class="mb-0">Check-In: <span id="check_in"></span></p>
                        <p class="mb-0">Check-out: <span id="check_out"></span></p>
                        <p class="mb-0">Tour Type: <span id="tour_type"></span></p>
                        <p class="mb-0">No. of Pax: <span id="no_pax"></span></p>
                        <p class="mb-0">Reserved By: <span id="name"></span></p>
                        <p class="mb-0">Reserved At: <span id="created_at"></span></p>
                        <p class="mb-0">Email: <span id="email"></span></p>
                        <p class="mb-0">Phone No.: <span id="phone"></span></p>
                        <!-- <p class="mb-0">Pax: <span >5</span></p> -->
                        <p class="mb-0">address: <span id="address"></span></p>
                        <p class="mb-0">Status: <span id="status"></span></p>
                        <p class="mb-0" hidden>Status: <span id="img_name"></span></p>

                        <button type="button" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-primary btn-block mb-4" id="cancelReservation">Cancel my Reservation</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading animation -->
    <div class="text-center d-none" id="loading">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p>Loading...</p>
    </div>

</div>

<script>
    $(document).ready(function () {
        'use strict';
        function validateEmail(email) {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        
            if (!emailRegex.test(email)) {
                return { isValid: false, message: "Invalid email format" };
            }
        
            const domain = email.split('@')[1];
        
            if (!domain || domain.split('.').length < 2) {
                return { isValid: false, message: "Invalid domain format" };
            }
        
            return { isValid: true, message: "Valid email format" };
        }


        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = $('.needs-validation');

        // Loop over them and prevent submission
        forms.each(function () {
            var form = $(this);


            // Bind click event to the button
            $('#findReservation').on('click', function (event) {
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    // Show loading animation
                    $('#loading').removeClass('d-none');

                    // Gather input data
                    var referenceNumber = $('#form2Example1').val();
                    var email = $('#form2Example2').val();
                    var emailResult = validateEmail(email);
                    
                    if (emailResult.isValid) {
                        // Make an AJAX request
                        $.ajax({
                            url: 'functions/rooms-cottages/get-reservation-details.php',
                            type: 'GET',
                            data: {
                                reference_number: referenceNumber,
                                email: email
                            },
                            dataType: 'json', // Specify the type of data you're expecting back
                            success: function (data) {
                                // Check if the response is valid and contains data
                                if (data.success) {
                                    // Update the reservation details in the HTML
                                    $('#reference_number').text(referenceNumber);
                                    $('#room_name').text(data.details.room_name);
                                    $('#check_in').text(data.details.check_in);
                                    $('#check_out').text(data.details.check_out);
                                    $('#tour_type').text(data.details.tour_type);
                                    $('#no_pax').text(data.details.no_pax);
                                    $('#name').text(data.details.name);
                                    $('#created_at').text(data.details.created_at);
                                    $('#email').text(data.details.email);
                                    $('#phone').text(data.details.phone);
                                    $('#address').text(data.details.address);
                                    $('#status').text(data.details.status);
                                    $('#img').attr('src', "admin/assets/rooms-cottages/"+data.details.img_name);
                                    // Hide loading animation
                                    $('#loading').addClass('d-none');
    
                                    // Show the reservation details card
                                    $('#reservationDetailsCard').removeClass('d-none');
    
                                    if ($("#status").text().trim() === "Cancelled" || $("#status").text().trim() === "Not Approved" || $("#status").text().trim() === "Pending" ) {
                                        $("#cancelReservation").prop("disabled", true); // Disable button if status is "Cancelled"
                                    } else {
                                        $("#cancelReservation").prop("disabled", false); // Enable button otherwise
                                    }
                                } else {
                                    // Handle error case (e.g., reservation not found)
                                    $('#loading').addClass('d-none');
                                    alert('Reservation not found or invalid details.');
                                }
                            },
                            error: function () {
                                // Hide loading animation and show error message
                                $('#loading').addClass('d-none');
                                alert('An error occurred while fetching the reservation details.');
                            }
                        });
                    } else {
                        $('#loading').addClass('d-none');
                        alert(emailResult.message);
                    }
                }

                form.addClass('was-validated');
            });
        });
        $('#cancelReservation').on('click', function (event) {
            var reference_number = $('#reference_number').html();

            Swal.fire({
                title: "Are you sure you want to cancel your reservation?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'functions/reservations/cancel-reservation.php',
                        type: 'POST',
                        data: {
                            reference_number: reference_number
                        },
                        success: function (response) {
                            // Check if the response from the server is exactly "Successful"
                            if (response.trim() === "Successful") {
                                Swal.fire({
                                    title: "Successful!",
                                    text: "Your Reservation has been Cancelled.",
                                    icon: "success"
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "There was an error cancelling your reservation.",
                                    icon: "error"
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                title: "Error!",
                                text: "An unexpected error occurred.",
                                icon: "error"
                            });
                        }
                    });

                }

            });



        });


    });
</script>


<?php
include("footer.php");
?>