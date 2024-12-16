<?php
include("header.php");
?>


<h3 class="aboutus-txt d-flex justify-content-center mt-4 text-uppercase">Contact us</h3>
<hr class="hr hr-blurry m-auto" style="height:5px; width: 500px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(60, 179, 113), rgba(0, 0, 0, 0)) !important;">
<span class="description-text d-flex justify-content-center">You can send your inquries by sending a message below</span>


<div class="d-flex justify-content-center p-5 mt-4">
  <div class="reach-us-info shadow p-3 mb-5 bg-body rounded">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.888582461144!2d121.16680407509644!3d14.083753886343644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd6f3ab5f20451%3A0x915016586abe97d6!2sThe%20Terrones%20Resort!5e0!3m2!1sen!2sph!4v1720179291004!5m2!1sen!2sph" class="p-2" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="contact-info">
      <div class="form-group mt-3">
        <label for="" class="text-dark contact_txt card-title">Contact Information</label>
      </div>
      <div class="form-group mb-2 mt-2">
        <label for="" class="form-text text-card text-dark contact_txt">Address</label><br>
        <span class="form-text text-dark"><i class="fa-solid fa-location-dot"></i> Purok 4, Brgy San Vicente Sto Tomas Batangas</span>
      </div>
      <div class="form-group mb-2 mt-2">
        <label for="" class="contact_txt form-text text-card text-dark">Call us</label><br>
        <span class="form-text text-dark"><i class="fa-solid fa-phone"></i> 0966 837 9975</span>
      </div>
      <div class="form-group mb-2 mt-2">
        <label for="" class="contact_txt form-text text-card text-dark">E-mail</label><br>
        <span class="form-text text-dark"><i class="fa-solid fa-envelope"></i> terronesresort3@gmail.com</span>
      </div>
      <div class="form-group mb-2 mt-2">
        <label for="" class="contact_txt form-text text-card text-dark">Facebook</label><br>
        <a href="https://www.facebook.com/profile.php?id=61552554914330"><span class="form-text text-primary text-decoration-underline"><i class="fa-brands fa-facebook me-1"></i>https://www.facebook.com/people/The-Terrones-Resort</span></a>
      </div>
    </div>
  </div>

  <div class="contact-us-info ms-5 shadow p-3 mb-5 bg-body rounded">
    <h4 class="mb-4">Send a Message</h4>
    <form class="row g-3 needs-validation" novalidate method="post" action="functions\contact-us\add-inquries.php" id="contact-form">
      <div class="row-md-6">
        <label for="validationCustom03" class="form-label text-dark">Name</label>
        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Ex. Juan M. Dela Cruz" required>
        <div class="invalid-feedback">
          Please provide a valid name.
        </div>
      </div>
      <!-- <div class="row-md-6">
        <label for="validationCustom03" class="form-label text-dark">E-mail</label>
        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="example123@gmail.com" required>
        <div class="invalid-feedback">
          Please provide a valid name.
        </div>
      </div> -->
      <div class="row-md-6">
        <label for="validationCustom03" class="form-label text-dark">E-mail</label>
        <input
          type="email"
          class="form-control"
          id="user_email"
          name="user_email"
          placeholder="example123@gmail.com"
          required>
        <small class="form-text text-muted">Format: example@example.com</small>
        <span id="email-error" class="text-danger" style="display: none;">Please enter a valid email address.</span>
      </div>
      <script>
        const emailInput = document.getElementById('user_email');
        const emailErrorSpan = document.getElementById('email-error');

        emailInput.addEventListener('input', function() {
          const value = this.value;
          const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

          if (!emailRegex.test(value) && value.length > 0) {
            emailErrorSpan.style.display = 'block';
          } else {
            emailErrorSpan.style.display = 'none';
          }
        });

        emailInput.addEventListener('blur', function() {
          const value = this.value;

          if (!emailRegex.test(value) && value.length > 0) {
            emailErrorSpan.style.display = 'block';
          } else {
            emailErrorSpan.style.display = 'none';
          }
        });
      </script>
      <div class="row-md-6">
        <label for="validationCustom03" class="form-label text-dark">Phone Number</label>
        <!-- <input type="tel" class="form-control" id="user_mobileno" name="user_mobileno" pattern="^\d{3}[\s.-]\d{3}[\s.-]\d{4}$" placeholder="Enter phone number (e.g. 123-456-7890)" required> -->
        <input
          type="tel"
          class="form-control"
          id="user_mobileno"
          name="user_mobileno"
          pattern="^09\d{9}$"
          maxlength="11"
          placeholder="Enter phone number (e.g. 09123456789)"
          required>
        <small class="form-text text-muted">Starts with "09" followed by 9 digits.</small>
        <span id="phone-error" class="text-danger" style="display: none;">Please enter a valid PH phone number (e.g., 09123456789).</span>
        <script>
          const phoneInput = document.getElementById('user_mobileno');
          const errorSpan = document.getElementById('phone-error');

          phoneInput.addEventListener('input', function() {
            let value = this.value;
            value = value.replace(/\D/g, '');

            if (value.length > 11) {
              value = value.slice(0, 11);
            }
            this.value = value;

            if (!/^09\d{9}$/.test(value) && value.length > 0) {
              errorSpan.style.display = 'block';
            } else {
              errorSpan.style.display = 'none';
            }
          });

          phoneInput.addEventListener('blur', function() {
            if (!/^09\d{9}$/.test(this.value) && this.value.length > 0) {
              errorSpan.style.display = 'block';
            } else {
              errorSpan.style.display = 'none';
            }
          });
        </script>
        <div class="invalid-feedback">
          Please provide a valid number.
        </div>
      </div>
      <div class="row-md-6">
        <label for="validationCustom03" class="form-label text-dark">Subject</label>
        <input type="text" class="form-control" id="user_subject" name="user_subject" required>
        <div class="invalid-feedback">
          Please provide a subject/reason.
        </div>
      </div>
      <div class="row-md-6">
        <label for="validationCustom03" class="form-label text-dark">Message</label>
        <textarea class="form-control text-message" name="user_message" id="user_message" required></textarea>
        <div class="invalid-feedback">
          Please provide a message.
        </div>
      </div>
      <div class="col-12 mt-3">
        <button class="btn btn-primary btn_submit_inqury" id="btn_submit_inqury" type="submit">Submit</button>
      </div>
    </form>

  </div>
</div>




<script>
  (function() {
    'use strict';

    var form = document.getElementById('contact-form');

    form.addEventListener('submit', function(event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        Swal.fire({
          title: 'Oops!',
          text: 'All fields are required, please double check!',
          icon: 'error',
          confirmButtonColor: '#e08e0b',
          confirmButtonText: 'OK'
        });

        form.classList.add('was-validated');
        return;
      }

      event.preventDefault();

      const formData = new FormData(form);

      fetch('functions/contact-us/add-inquries.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          if (data == "Successful") {
            Swal.fire({
              title: 'Success!',
              text: 'Request has been successfully submitted!',
              icon: 'success',
              confirmButtonColor: '#28a745',
              confirmButtonText: 'OK'
            }).then(() => {

              form.reset();
              window.location.reload();
            });
          } else {
            Swal.fire({
              title: 'Error!',
              text: 'Submission of the request was unsuccessful!',
              icon: 'error',
              confirmButtonColor: '#e08e0b',
              confirmButtonText: 'OK'
            });
          }
        })
        .catch(error => {
          console.error('Error:', error);
          Swal.fire({
            title: 'Error!',
            text: 'An error occurred during submission. Please try again later.',
            icon: 'error',
            confirmButtonColor: '#e08e0b',
            confirmButtonText: 'OK'
          });
        });
    });
  })();
</script>


<?php
include("footer.php");
?>