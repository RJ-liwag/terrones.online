<?php
include("header.php");
include "functions/rooms-cottages/get-rooms.php";
?>
<link rel="stylesheet" href="assets/css/form-modal.css">
<style>
    #carouselExampleControls img {
        height: 650px;
        /* Adjust this value as needed */
        object-fit: cover;
        /* Ensures images maintain aspect ratio */
        border: 5px solid #000;
        /* Adds a border (adjust color/size as needed) */
    }
</style>
<div id="carouselExampleControls">
    <div id="room_cottages" class="room_cottages slide rounded" data-bs-ride="room_cottages">
        <div class="room_cottages-inner">
            <div class="room_cottages-item rounded active d-block" data-bs-interval="5000">
                <img src="assets/img/carousel.png" class="active img-room-cottage"
                    style="width: 100%; justify-content:center; filter: brightness(70%) !important;">
                <div class="text-overlay">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-5 text-center">
    <h1 class="display-5 fw-bold text-success">Book Your Stay Here!</h1>
    <p class="fs-4 text-muted">Make your reservation now!</p>
</div>
<ul class="nav nav-pills nav-justified">
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="./room-cottage">Rooms</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="./room-cottage-c">Cottages</a>
    </li>
</ul>

<h3 class="d-flex justify-content-center">Cottages</h3>


<?php

if ($cottage_query->num_rows > 0) {
    do {
        ?>
        <div class="container w-100 mt-3 mx-auto">
            <div class="row">
                <div class="col mt-3 p-3">
                    <img src="admin/assets/rooms-cottages/<?php echo $cottage_row['room_img'] ?>" class="shadow-sm bg-body rounded"
                        style="height:300px; width: 500px">
                </div>
                <div class="col mt-3 p-3">
                    <h5><?php echo $cottage_row["room_name"] ?></h5>
                    <p><?php echo $cottage_row["description"] ?></p>

                    <p class="demo mb-0">
                        <label class="">₱
                            <span><strong><?php echo $cottage_row["price"] ?></strong></span></label><br>
                        <label class="text-primary fw-bold">Pax Capacity :
                            <span><strong><?php echo $cottage_row["max_capacity"] ?></strong></span></label>
                    </p>
                    <div class="d-flex justify-content-start mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-id="<?php echo $cottage_row['room_id']; ?>" data-name="<?php echo $cottage_row['room_name']; ?>"
                            data-price="<?php echo $cottage_row['price']; ?>" data-pax="<?php echo $cottage_row['max_capacity']; ?>">
                            Make a reservation
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }while ($cottage_row = $cottage_query->fetch_array());
} else {
    // Display message if no active rooms are available
    echo '<div class="text-center mt-5"><h5>No active rooms available at the moment.</h5></div>';
}
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add reservation</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container" id="form_modal">
                    <div class="progress-bar">
                        <div class="step">
                            <p>
                                Availability
                            </p>
                            <div class="bullet">
                                <span>1</span>
                            </div>
                            <div class="check fas fa-check"></div>
                        </div>
                        <div class="step">
                            <p>
                                Info
                            </p>
                            <div class="bullet">
                                <span>2</span>
                            </div>
                            <div class="check fas fa-check"></div>
                        </div>
                        <div class="step">
                            <p>
                                contact
                            </p>
                            <div class="bullet">
                                <span>3</span>
                            </div>
                            <div class="check fas fa-check"></div>
                        </div>
                        <div class="step">
                            <p>
                                confirmation
                            </p>
                            <div class="bullet">
                                <span>4</span>
                            </div>
                            <div class="check fas fa-check"></div>
                        </div>
                    </div>
                    <div class="form-outer">
                        <form action="#">
                            <div class="page slide-page">
                                <div class="title">
                                    Basic Info:
                                </div>
                                <div class="field" style="margin-top: -20px; margin-bottom: 0;">
                                    <select id="tour_type" class="form-select form-select-sm"
                                        aria-label=".form-select-sm example">
                                        <option selected disabled>Tour Type</option>
                                        <option value="day">Day</option>
                                        <option value="night">Night</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <div class="label">
                                        No of Pax
                                    </div>
                                    <!-- <input id="rPax" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/^0[^.]/, '0');"> -->
                                    <input id="rPax" type="text"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </div>
                                <div class="field">
                                    <div class="label">
                                        Check In
                                    </div>
                                    <input id="checkin" type="date">
                                </div>
                                <div class="field">
                                    <div class="label">
                                        check Out
                                    </div>
                                    <input id="checkout" type="date">
                                </div>

                                <p id="pax_status"></p>
                                <p id="availability-status">checking room availability</p>
                                <div class="field">
                                    <button class="firstNext next bg-secondary">Next</button>
                                </div>
                            </div>
                            <div class="page">
                                <div class="title">
                                    Personal Info:
                                </div>
                                <div class="field">
                                    <div class="label">
                                        Name
                                    </div>
                                    <input id="rName" type="text">
                                </div>
                                <div class="field">
                                    <div class="label">
                                        Address
                                    </div>
                                    <input id="rAddress" type="text">
                                </div>
                                <div class="field btns">
                                    <button class="prev-1 prev">Previous</button>
                                    <button class="next-1 next">Next</button>
                                </div>
                            </div>
                            <div class="page">
                                <div class="title">Contact Info:</div>

                                <!-- Email Field -->
                                <div class="field">
                                    <div class="label">Email Address</div>
                                    <input id="rEmail" type="email" placeholder="example@email.com">
                                </div>

                                <!-- Phone Number Field -->
                                <div class="field">
                                    <div class="label">Phone Number</div>
                                    <input id="rPhone" type="text" placeholder="Enter 11-digit phone number">
                                </div>

                                <!-- Error Messages above the buttons -->
                                <div id="errorMessages" style="display: none; color: red; font-size: 0.9em;">
                                    <p id="emailError" class="d-none">Please check your email format.</p>
                                    <p id="phoneError" class="d-none">Please check your phone number.</p>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="field btns">
                                    <button class="prev-2 prev">Previous</button>
                                    <button class="next-2 bg-secondary next" disabled>Next</button>
                                </div>
                            </div>
                            <div class="page">
                                <div class="title">
                                    Summary:
                                </div>
                                <div class="container text-start">
                                    <div>
                                        <h5>Personal Information</h5>
                                    </div>
                                    <div>
                                        <p>Name: <span id="summaryName"></span></p>
                                    </div>
                                    <div>
                                        <p>Address: <span id="summaryAddress"></span></p>
                                    </div>
                                    <div>
                                        <h5>Contact Information</h5>
                                    </div>
                                    <div>
                                        <p>Email: <span id="summaryEmail"></span></p>
                                    </div>
                                    <div>
                                        <p>Contact No.: <span id="summaryPhone"></span></p>
                                    </div>
                                    <div>
                                        <h5>Reservation Information</h5>
                                    </div>
                                    <div>
                                        <p>Room Name: <span id="summaryRoomName"></span></p>
                                    </div>
                                    <div>
                                        <p>Check-in/ Check out Date: <span id="summaryCheckInOut"></span></p>
                                    </div>
                                    <div>
                                        <p>Tour Type: <span id="summaryTourType"></span></p>
                                    </div>
                                </div>

                                <div class="field btns">
                                    <button class="prev-3 prev">Previous</button>
                                    <button class="submit" id="roomSubmit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Wait for the DOM to load
    document.addEventListener("DOMContentLoaded", function () {
        // Select all buttons that trigger the modal
        const reservationButtons = document.querySelectorAll("[data-bs-target='#exampleModal']");

        // Add click event listener to each button
        reservationButtons.forEach(button => {
            button.addEventListener("click", function () {
                // Reset the modal fields
                document.querySelector("#form_modal form").reset();

                // Clear summary data (if needed)
                document.getElementById("summaryName").textContent = "";
                document.getElementById("summaryAddress").textContent = "";
                document.getElementById("summaryEmail").textContent = "";
                document.getElementById("summaryPhone").textContent = "";
                document.getElementById("summaryRoomName").textContent = "";
                document.getElementById("summaryCheckInOut").textContent = "";
                document.getElementById("summaryTourType").textContent = "";

                // Reset error messages
                document.getElementById("emailError").classList.add("d-none");
                document.getElementById("phoneError").classList.add("d-none");
                document.getElementById("errorMessages").style.display = "none";
            });
        });
    });
</script>

<!-- Include SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById("checkout").addEventListener("change", validateDates);
    document.getElementById("checkin").addEventListener("change", validateDates);

    function validateDates() {
        const checkin = new Date(document.getElementById("checkin").value);
        const checkout = new Date(document.getElementById("checkout").value);

        if (checkin && checkout) {
            if (checkout < checkin) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Dates',
                    text: 'Check-out date must be later than the check-in date.',
                });

                document.getElementById("checkout").value = "";
            }
        }
    }
</script>


<script>
    $(document).ready(function () {

        var today = new Date();
        var minDate = today.toJSON().split('T')[0];
        $('[type="date"]').attr('min', minDate);

        $('#exampleModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget);
            var roomId = button.data('id');
            var max_pax = button.data('pax');
            $(this).data('roomId', roomId);
            $(this).data('max_pax', max_pax);
        });

        $("#rPax").on('input', function () {
            var maxPax = $('#exampleModal').data('max_pax');
            var rPaxInput = parseInt($("#rPax").val());

            if (isNaN(rPaxInput)) {
                $('#pax_status').text('Please enter a valid number of pax.').addClass('text-danger').removeClass('text-success');
            } else if (rPaxInput > maxPax) {
                $('#pax_status').text('Number of pax cannot exceed ' + maxPax + '.').addClass('text-danger').removeClass('text-success');
            } else if (rPaxInput <= 0) {
                $('#pax_status').text('Number of pax must be greater than 0.').addClass('text-danger').removeClass('text-success');
            } else {
                $('#pax_status').text('Valid number of pax.').addClass('text-success').removeClass('text-danger');
            }
        });
        // Function to check availability
        function checkAvailability() {
            var roomId = $('#exampleModal').data('roomId');
            var checkIn = $('#checkin').val();
            var checkOut = $('#checkout').val();
            var tourType = $('#tour_type').find(":selected").val();
            var type = "cottage";

            if (checkIn && checkOut && tourType) {
                $.ajax({
                    url: 'functions/rooms-cottages/check-availability.php',
                    type: 'POST',
                    data: {
                        room_id: roomId,
                        check_in: checkIn,
                        check_out: checkOut,
                        tour_type: tourType,
                        type: type
                    },
                    success: function (response) {
                        if (response === "Unavailable") {
                            $('#availability-status').text('Room is unavailable for the selected dates.')
                                .removeClass('text-success')
                                .addClass('text-danger');

                            $('.firstNext').addClass('bg-secondary').attr('disabled', true);
                        } else if (response === 'Available') {
                            $('#availability-status').text('Room is available')
                                .removeClass('text-danger')
                                .addClass('text-success');

                            $('.firstNext').removeClass('bg-secondary').removeAttr('disabled');
                        }
                    }
                });
            }
        }

        // Trigger the availability check when the date or tour type is changed
        $('#checkin, #tour_type').on('change', function () {
            var checkInDate = $('#checkin').val();
            var tourType = $('#tour_type').val();

            if (checkInDate) {
                var checkIn = new Date(checkInDate);

                // Set the max range of check-out to 30 days from check-in
                var maxCheckOut = new Date(checkIn);
                maxCheckOut.setDate(maxCheckOut.getDate() + 30);
                var maxCheckOutFormatted = maxCheckOut.toISOString().split('T')[0];

                // Apply the max limit to the check-out field
                $('#checkout').attr('max', maxCheckOutFormatted);

                // If "night" tour type is selected
                if (tourType === 'night') {
                    // Set check-out to the day after check-in and reset it
                    var nextDay = new Date(checkIn);
                    nextDay.setDate(nextDay.getDate() + 1);
                    var nextDayFormatted = nextDay.toISOString().split('T')[0];

                    $('#checkout').val(nextDayFormatted); // Reset check-out to the next day
                    $('#checkout').attr('min', nextDayFormatted); // Set min to the next day
                } else {
                    // If not "night", allow check-out on the same day
                    $('#checkout').attr('min', checkInDate);
                    $('#checkout').val(''); // Clear check-out for other types
                }
            } else {
                // Reset min/max if no check-in date is selected
                $('#checkout').removeAttr('min max').val('');
            }

            checkAvailability();
        });

        $('#checkout').on('change', function () {
            var checkIn = $('#checkin').val();
            var checkOut = $('#checkout').val();

            // Disable "day" option if check-in and check-out dates are not the same
            if (checkIn && checkOut && checkIn !== checkOut) {
                $('#tour_type option[value="day"]').prop('disabled', true);
            } else {
                $('#tour_type option[value="day"]').prop('disabled', false);
            }

            checkAvailability();
        });



        $('form').on('submit', function (event) {
            event.preventDefault();
        });


        $('#exampleModal').on('hidden.bs.modal', function () {
            // Reset form fields
            $('#checkin').val('');
            $('#checkout').val('');
            $('#tour_type').val('day'); // Set default value for tour_type

            // Reset availability status
            $('#availability-status').text('Checking room availability').removeClass('text-success text-danger');

            // Re-enable disabled "Day" tour type option
            $('#tour_type option[value="day"]').prop('disabled', false);

            // Reset "Next" button state
            $('.firstNext').removeClass('bg-secondary').removeAttr('disabled');
        });

        // Function to check if the fields are filled
        function checkPersonalInfoFields() {
            var name = $('#rName').val().trim();
            var address = $('#rAddress').val().trim();


            // If both fields have values, enable the next button
            if (name !== '' && address !== '') {
                $('.next-1').removeClass('bg-secondary').attr('disabled', false); // Enable the button
            } else {
                $('.next-1').addClass('bg-secondary').attr('disabled', true); // Disable the button
            }
        }

        // Trigger the function on change of Name and Address fields
        $('#rName, #rAddress').on('change keyup', function () {
            checkPersonalInfoFields();
        });

        // Disable the next-1 button by default when the page loads
        $('.next-1').addClass('bg-secondary').attr('disabled', true);

        // Function to check if the fields are filled
        function validateContactFields() {
            const emailInput = document.getElementById('rEmail');
            const phoneInput = document.getElementById('rPhone');
            const emailError = document.getElementById('emailError');
            const phoneError = document.getElementById('phoneError');
            const nextButton = document.querySelector('.next-2');
            const errorMessages = document.getElementById('errorMessages');

            const emailValue = emailInput.value.trim();
            const phoneValue = phoneInput.value.trim();

            // Validate email format
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isEmailValid = emailPattern.test(emailValue);

            // Validate phone number (must be exactly 11 numeric digits)
            const numericValue = phoneValue.replace(/\D/g, ''); // Remove non-numeric characters
            const isPhoneValid = numericValue.length === 11;

            // Update phone input to show only numeric values (up to 11 digits)
            phoneInput.value = numericValue.slice(0, 11);

            // Show or hide email error message
            if (isEmailValid || emailValue === '') {
                emailError.classList.add('d-none');
            } else {
                emailError.classList.remove('d-none');
            }

            // Show or hide phone error message
            if (isPhoneValid || phoneValue === '') {
                phoneError.classList.add('d-none');
            } else {
                phoneError.classList.remove('d-none');
            }

            // Show or hide the error messages container
            if (emailError.classList.contains('d-none') && phoneError.classList.contains('d-none')) {
                errorMessages.style.display = 'none';
            } else {
                errorMessages.style.display = 'block';
            }

            // Enable or disable the "Next" button
            if (isEmailValid && isPhoneValid) {
                nextButton.classList.remove('bg-secondary');
                nextButton.removeAttribute('disabled');
            } else {
                nextButton.classList.add('bg-secondary');
                nextButton.setAttribute('disabled', true);
            }
        }

        // Attach event listeners to validate fields on input
        document.getElementById('rEmail').addEventListener('input', validateContactFields);
        document.getElementById('rPhone').addEventListener('input', validateContactFields);


        function updateSummary() {
            var name = $('#rName').val();
            var address = $('#rAddress').val();
            var email = $('#rEmail').val();
            var phone = $('#rPhone').val();
            var roomName = $('#exampleModal').data('roomName');
            var checkIn = $('#checkin').val();
            var checkOut = $('#checkout').val();
            var tourType = $('#tour_type').find(":selected").text();

            // Update the summary section with these values
            $('#summaryName').text(name);
            $('#summaryAddress').text(address);
            $('#summaryEmail').text(email);
            $('#summaryPhone').text(phone);
            $('#summaryRoomName').text(roomName);
            $('#summaryCheckInOut').text(checkIn + ' - ' + checkOut);
            $('#summaryTourType').text(tourType);
        }

        // When going to the next step before the summary, call updateSummary
        $('.next-2').on('click', function () {
            updateSummary();
        });

        // Make sure to capture the room name when the modal is shown
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var roomName = button.data('name');
            $(this).data('roomName', roomName); // Store the room name in the modal for later use
        });


        //add reservation

        $('#roomSubmit').on('click', function (event) {
            event.preventDefault();

            // Generate a random reference number
            var reference_number = 'REF-' + Math.random().toString(36).substr(2, 9).toUpperCase();

            // Get form values
            var name = $('#rName').val();
            var address = $('#rAddress').val();
            var email = $('#rEmail').val();
            var type = "cottage";
            var phone = $('#rPhone').val();
            var room_name = $('#exampleModal').data('roomName');
            var roomId = $('#exampleModal').data('roomId');
            var checkIn = $('#checkin').val();
            var checkOut = $('#checkout').val();
            var tourType = $('#tour_type').find(":selected").val();
            var rPax = $('#rPax').val();

            // Ensure required fields are filled
            if (name && address && email && phone && checkIn && checkOut && tourType) {
                Swal.fire({
                    title: 'Processing Reservation...',
                    text: 'Please wait.',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "functions/rooms-cottages/add-reservation.php",
                    type: "POST",
                    data: {
                        reference_number: reference_number,
                        name: name,
                        address: address,
                        email: email,
                        room_name: room_name,
                        type: type,
                        phone: phone,
                        room_id: roomId,
                        check_in: checkIn,
                        check_out: checkOut,
                        tour_type: tourType,
                        rPax: rPax
                    },
                    success: function (response) {
                        Swal.close();

                        if (response.trim() === 'success') {
                            Swal.fire({
                                icon: "success",
                                title: "Reservation Successful",
                                html: `Your Reference Number is: <strong>${reference_number}</strong><br><br>
                        <button id="copyRef" class="swal2-confirm swal2-styled" style="background-color: #3085d6;">Copy Reference Number and make a Screenshot of it!</button>`,
                                // showCancelButton: true,
                                // cancelButtonText: 'OK',
                                showConfirmButton: false,
                                didRender: function () {
                                    $('#copyRef').on('click', function () {
                                        navigator.clipboard.writeText(reference_number).then(() => {
                                            Swal.fire({
                                                icon: "success",
                                                title: "Copied!",
                                                text: "Reference number has been copied to clipboard.",
                                            }).then(() => {
                                                location.reload();
                                            });
                                        }).catch(err => {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Oops...",
                                                text: "Failed to copy the reference number.",
                                            });
                                        });
                                    });
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Submission Failed",
                                text: "Reservation was recorded, but email could not be sent.",
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.close();
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "An error occurred while submitting your reservation.",
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Missing Fields",
                    text: "Please fill in all required fields."
                });
            }
        });




    });
</script>

<script src="assets/js/form-modal.js"></script>
<?php
include("footer.php");
?>