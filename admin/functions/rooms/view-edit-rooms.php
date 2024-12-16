<?php

include '../../../conn.php';

$room_id = $_POST['room_id'];

$sql = $mysqli->prepare("SELECT * FROM rooms WHERE room_id = ?");
$sql->bind_param('i', $room_id); // 'i' specifies that $room_id is an integer
$sql->execute();
$result = $sql->get_result();

while ($row = $result->fetch_array()) {
    $room_name = $row['room_name'];
    $price = $row['price'];
    $max_capacity = $row['max_capacity'];
    $description = $row['description'];
    $room_img = $row['room_img'];
}

$sql->close();
$mysqli->close();
?>


<!-- Edit Modal  -->

<div class="container-fluid">
    <div>
        <input type="hidden" name="edit_room_id" id="edit_room_id" value="<?php echo $room_id ?>">
        <div class="mb-2 d-flex justify-content-center mt-2">
            <img id="selectedImage" src="assets/rooms-cottages/<?php echo $room_img ?>" alt="example placeholder"
                style="width: 200px;" />
        </div>
        <div class="d-flex justify-content-center">
            <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                <label class="form-label text-white m-1" for="room_img">Choose Photo</label>
                <input type="file" class="form-control d-none" id="room_img" name="room_img">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="form-label text-dark m-1">Room Name</label>
                <input type="text" class="form-control" id="edit_room_name" name="edit_room_name"
                    value="<?php echo $room_name ?>">
            </div>
            <div class="col">
                <label class="form-label text-dark m-1">Price</label>
                <input type="text" class="form-control" id="edit_price" name="edit_price" value="<?php echo $price ?>">
                <script>
                    document.getElementById('edit_price').addEventListener('blur', function () {
                        let value = parseFloat(this.value);
                        if (!isNaN(value)) {
                            this.value = value.toFixed(2);
                        } else {
                            this.value = '';
                        }
                    });
                </script>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="form-label text-dark m-1">Capacity</label>
                <input type="text" class="form-control" id="edit_max_capacity" name="edit_max_capacity"
                    value="<?php echo $max_capacity ?>">
            </div>
            <div class="col">
                <label for="exampleDataList" class="form-label">Status</label>
                <input class="form-control" list="datalistOptions" id="statusInput">
                <datalist id="datalistOptions">
                    <option value="Active"></option>
                    <option value="For Maintenance"></option>
                </datalist>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <label class="form-label text-dark m-1">Description</label>
                <textarea type="text" class="form-control" id="edit_description"
                    name="edit_description"><?php echo $description ?></textarea>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary btn_room_edit">Save Changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
</div>
</div>
</div>


<script>

    // Listen for changes to the input field associated with the datalist
    document.getElementById('statusInput').addEventListener('input', function () {
        let selectedStatus = this.value.trim();

        // Log or use the selected value
        console.log("Selected Status:", selectedStatus);

        // Validate if the selected value matches any option in the datalist
        const datalistOptions = Array.from(document.querySelectorAll('#datalistOptions option')).map(option => option.value);
        if (!datalistOptions.includes(selectedStatus)) {
            console.log("Invalid selection");
            this.value = ""; // Clear the input if invalid
        }
    });

    $(document).on('click', '.btn_room_edit', function (e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Reset previous validation errors
        $(".error-text").remove();
        $(".is-invalid").removeClass("is-invalid");

        var formData = new FormData();
        var isValid = true; // Validation flag

        function addField(fieldName, selector, isRequired = false, isNumeric = false) {
            var value = $(selector).val().trim();

            // Validate required fields
            if (isRequired && (value === undefined || value === "")) {
                isValid = false;
                showValidationError(selector, `${fieldName} is required.`);
                return;
            }

            // Validate numeric fields
            if (isNumeric && (isNaN(value) || Number(value) <= 0)) {
                isValid = false;
                showValidationError(selector, `${fieldName} must be a positive number.`);
                return;
            }

            // Append to formData if valid
            if (value !== undefined && value !== "") {
                formData.append(fieldName, value);
                console.log(fieldName + ": " + value); // Log the field name and value
            }
        }

        // Show validation error
        function showValidationError(selector, message) {
            $(selector).addClass("is-invalid");
            $(selector).after(`<small class="text-danger error-text">${message}</small>`);
        }

        // Validate and add fields
        addField("room_id", "#edit_room_id", true); // Required field
        addField("status", "#statusInput", true); // Required field
        addField("room_name", "#edit_room_name", true); // Required field
        addField("price", "#edit_price", true, true); // Required and numeric
        addField("max_capacity", "#edit_max_capacity", true, true); // Required and numeric
        addField("description", "#edit_description", true); // Required field

        // Validate image
        const edit_room_img = document.querySelector("#room_img");
        if (edit_room_img.files.length > 0) {
            formData.append("room_img", edit_room_img.files[0]);
            console.log("room_img: " + edit_room_img.files[0].name);
        } else {
            console.log("No file selected.");
        }

        // If form is invalid, stop here
        if (!isValid) {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please fix the highlighted errors and try again.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Proceed with AJAX request if validation passes
        $.ajax({
            type: 'POST',
            url: 'functions/rooms/update-room.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $('.loading-ui').hide();
                if (data.trim() === "Successful") {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Request has been successfully submitted!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Submission of the request was unsuccessful!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error processing your request.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>