<?php
include("header.php");
include("conn.php"); // Ensure this file has your database connection
?>

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner shadow-lg mb-5 bg-body rounded">
    <div class="carousel-item active">
      <img class="d-block w-100 bg-picture" src="assets/img/carousel.png" alt="First slide">
      <div class="text-overlay-index">
        <h2 class="fs-1 text-uppercase">Terrones Resort</h2>
        <p>Experience the comfort and relaxation</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 bg-picture" src="assets/img/pool.jpg" alt="Second slide">
      <div class="text-overlay-index">
        <h2 class="fs-1 text-uppercase">Terrones Resort</h2>
        <p>Experience the comfort and relaxation</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 bg-picture" src="assets/img/carousel.png" alt="Third slide">
      <div class="text-overlay-index">
        <h2 class="fs-1 text-uppercase">Terrones Resort</h2>
        <p>Experience the comfort and relaxation</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container reservation_frame mt-5">
  <div id="second_section" class="second_section">
    <h1 class="text-center title-second-secion mt-2">The Terrones Resort</h1>
    <hr class="hr hr-blurry w-100 m-auto"
      style="height:5px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(0, 192, 56), rgba(0, 0, 0, 0)) !important;">
    <div id="text_description">
      <p class="text-center mt-2">The Terrones Resort is a public resort offering an escape to nature.
        <br> Bask in the warmth of the sun whilst surrounded by luscious greenery and towering trees.
        <br>A hidden gem in Purok 4, Brgy San Vicente Sto Tomas Batangas.
      </p>
    </div>
    <div id="picture_with_description" class="picture_with_description p-2 ms-5 mt-5 me-5">
      <div class="picture">
        <img src="assets/img/carousel.png" class="picture w-100 img-fluid shadow-lg mb-5 bg-white rounded" alt="...">
      </div>
      <div class="desctipion ms-3">Guests can enjoy the serene environment, take a refreshing dip in the pool, or relax
        in the comfortable seating area shaded by a canopy. With a blend of nature and modern amenities, Terrones Resort
        provides a peaceful retreat for families, friends, and solo travelers alike
      </div>
    </div>
    <div class="container d-flex justify-content-center mb-5 mt-5">
      <div class="bar bg-success text-white card mt-5 text-center">
        <div class="card-body">Feel free to explore our rooms and facilities. We offer you our best services!</div>
      </div>
    </div>
  </div>
</div>

<!-- Announcements Section -->
<div class="container mb-5">
  <div id="second_section" class="second_section">
    <h1 class="text-center mt-2">Announcements</h1>
    <hr class="hr hr-blurry w-50 m-auto"
      style="height:5px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(22, 157, 242), rgba(0, 0, 0, 0)) !important;">

    <!-- Scrollable Row -->
    <div class="row overflow-auto flex-nowrap" style="white-space: nowrap;">
      <?php
      // Query to fetch announcements from the database
      $query = "SELECT * FROM announcements ORDER BY date_posted DESC";
      $result = $mysqli->query($query);

      // Check if there are any announcements
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $announcement_id = $row['id'];
          $title = $row['title'];
          $content = $row['content'];
          $date_posted = $row['date_posted'];
          $expiry_date = $row['expiry_date'];

          // Format dates
          $formatted_date = date('F j, Y', strtotime($date_posted));
          $formatted_date2 = date('F j, Y', strtotime($expiry_date));

          // Skip expired announcements
          if (strtotime($expiry_date) > strtotime(date("Y-m-d"))) {
      ?>
            <!-- Announcement Card -->
            <div class="col-md-12 mb-4 d-inline-block" style="float: none;">
              <div class="card w-100 shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-center"><?php echo htmlspecialchars($title); ?></h5>
                  <!-- <p class="card-text text-center text-muted"><?php echo $formatted_date; ?></p> -->
                  <p class="card-text text-center text-wrap"><?php echo htmlspecialchars($content); ?></p>
                  <!-- <p class="card-text text-muted">Until: <?php echo $formatted_date2; ?></p> -->
                </div>
              </div>
            </div>
      <?php
          }
        }
      } else {
        echo "<p class='text-center col-12'>No announcements available.</p>";
      }
      ?>
    </div>
  </div>
</div>




<style>
  /* Reviews container */
  #reviews {
    display: flex;
    flex-wrap: nowrap;
    gap: 20px;
    overflow-x: auto;
    padding: 20px 0;
    max-width: 100%;
  }

  /* Card Styling */
  .card {
    flex: 0 0 auto;
    width: 300px;
    height: 350px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .card-body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .card-title {
    font-size: 1.3rem;
    font-weight: bold;
    color: #222;
    margin-bottom: 0.8rem;
  }

  .card-text {
    font-size: 0.95rem;
    color: #333;
  }

  .card-text.text-muted {
    font-size: 0.85rem;
    color: #777;
  }

  /* Hover effect */
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  /* Custom scrollbar */
  #reviews::-webkit-scrollbar {
    height: 8px;
  }

  #reviews::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.3);
    border-radius: 10px;
  }

  #reviews::-webkit-scrollbar-track {
    background: #f0f0f0;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    #reviews {
      gap: 15px;
    }

    .card {
      width: 90%;
      max-width: 300px;
    }
  }
</style>

<div class="container my-5">
  <h1 class="text-center">Post Reviews</h1>
  <hr class="hr hr-blurry w-50 m-auto"
    style="height:5px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgb(22, 157, 242), rgba(0, 0, 0, 0));">

  <div class="text-center my-4">
    <button class="btn btn-danger rounded-circle " data-bs-toggle="modal" data-bs-target="#reviewModal">Add a Review</button>
  </div>

  <!-- Reviews Display Section -->
  <div id="reviews">
    <!-- Reviews will be populated dynamically here -->
  </div>
</div>


<!-- Modal for Review Submission -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reviewModalLabel">Submit Your Review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="reviewForm">
          <div class="mb-3">
            <label for="confirmed_refnos" class="form-label">Reference Number</label>
            <input type="text" class="form-control" id="confirmed_refnos" required>
          </div>
          <div class="mb-3">
            <label for="userName" class="form-label">Name</label>
            <input type="text" class="form-control" id="userName" required>
          </div>
          <div class="mb-3">
            <label for="reviewText" class="form-label">Your Review</label>
            <textarea class="form-control" id="reviewText" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select class="form-select" id="rating" required>
              <option value="5">★★★★★ - Excellent</option>
              <option value="4">★★★★☆ - Good</option>
              <option value="3">★★★☆☆ - Average</option>
              <option value="2">★★☆☆☆ - Poor</option>
              <option value="1">★☆☆☆☆ - Terrible</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary w-100" disabled>Submit Review</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $("#confirmed_refnos").keyup(function() {
      var reference_number = $(this).val();
      var $submitButton = $("button[type='submit']");
      var $statusLabel = $("#statusLabel");

      if ($statusLabel.length === 0) {
        $statusLabel = $('<div id="statusLabel" class="mt-2"></div>');
        $(this).after($statusLabel);
      }

      if (reference_number) {
        $.ajax({
          url: "get-reference_no.php",
          type: "POST",
          data: {
            confirmed_refnos: reference_number
          },
          dataType: "json",
          success: function(response) {
            if (response.success) {
              $statusLabel.text(response.message).css("color", "green");
              $submitButton.prop("disabled", false);
            } else {
              $statusLabel.text(response.message).css("color", "red");
              $submitButton.prop("disabled", true);
            }
          },
          error: function() {
            $statusLabel.text("Error connecting to the server").css("color", "red");
            $submitButton.prop("disabled", true);
          }
        });
      } else {
        $statusLabel.text("").remove();
        $submitButton.prop("disabled", true);
      }
    });
  });
</script>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.all.min.js"></script>

<?php
include("footer.php");
?>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const reviewsContainer = document.getElementById('reviews');

    function createReviewCard(name, comment, rating, date) {
      const formattedDate = new Date(date).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });

      return `
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">${name}</h5>
        <p class="card-text text-muted">Rating: ${'★'.repeat(rating)}${'☆'.repeat(5 - rating)}</p>
        <p class="card-text">${comment}</p>
        <p class="card-text text-muted">Posted on: ${formattedDate}</p>
      </div>
    </div>
  `;
    }

    function loadReviews() {
      reviewsContainer.innerHTML = '<p class="text-center">Loading reviews...</p>';

      fetch('reviews_page.php')
        .then(response => response.json())
        .then(data => {
          reviewsContainer.innerHTML = '';
          if (data.length > 0) {
            data.forEach(review => {
              reviewsContainer.innerHTML += createReviewCard(review.name, review.comment, review.rating, review.date);
            });
          } else {
            reviewsContainer.innerHTML = '<p class="text-center text-muted">No reviews available yet.</p>';
          }
        })
        .catch(error => {
          reviewsContainer.innerHTML = '<p class="text-center text-muted">Failed to load reviews. Please try again later.</p>';
          console.error('Error loading reviews:', error);
        });
    }

    window.onload = loadReviews;



    // Create the HTML for each review card
    function createReviewCard(name, comment, rating, date) {
      return `
      <div class="card shadow-sm mb-3">
        <div class="card-body reviews-body">
          <h5 class="card-title">${name}</h5>
          <p class="card-text">${comment}</p>
          <div>Rating: ${'★'.repeat(rating)}${'☆'.repeat(5 - rating)}</div>
          <small class="text-muted">Posted on ${new Date(date).toLocaleDateString()}</small>
        </div>
      </div>
    `;
    }

    // Handle the review form submission
    document.getElementById('reviewForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const userName = document.getElementById('userName').value;
      const reviewComment = document.getElementById('reviewText').value;
      const rating = document.getElementById('rating').value;

      fetch('submit_review.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            name: userName,
            comment: reviewComment,
            rating: parseInt(rating)
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            reviewsContainer.innerHTML += createReviewCard(userName, reviewComment, parseInt(rating), new Date());
            document.getElementById('reviewForm').reset(); // Reset the form
            bootstrap.Modal.getInstance(document.getElementById('reviewModal')).hide(); // Hide the modal

            // Show SweetAlert success message
            Swal.fire({
              title: 'Success!',
              text: 'Your review was submitted successfully.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              // Reload the page after clicking "OK"
              window.location.reload();
            });
          } else {
            // Show error if review submission failed
            Swal.fire({
              title: 'Error!',
              text: data.comment || 'Failed to submit review',
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        })
        .catch(error => {
          console.error('Error submitting review:', error);
          Swal.fire({
            title: 'Error!',
            text: 'There was an error submitting your review.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        });
    });
    loadReviews(); // Load reviews on page load
  });
</script>