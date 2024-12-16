<?php include 'assets/libraries/custom-links.php';
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
?>

<head>
  <script src="assets/js/custom-script.js"></script>

  <title>Terrones Resort</title>

</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light no-room-styles sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="./">
      <img src="assets/img/TerrenesLogo.png" alt="Logo" width="50" height="44" class="ms-4 d-inline-block"><a href="./" class="text-dark fw-bold h-font" style="font-size:20px;">Terrones Resort</a>
    </a>
    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navrespo">
      <span class="navbar-toggler-icon dark"></span>
    </button>
    <div class="collapse navbar-collapse ms-5" id="navrespo">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <a class="nav-link ms-3 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="./">Home</a>
        <a class="nav-link ms-3 <?php echo basename($_SERVER['PHP_SELF']) == 'room-cottage.php' ? 'active' : ''; ?>" href="./room-cottage">Rooms/Cottages</a>
        <a class="nav-link ms-3 <?php echo basename($_SERVER['PHP_SELF']) == 'reservation.php' ? 'active' : ''; ?>" href="./reservation">Find Reservation</a>
        <a class="nav-link ms-3 <?php echo basename($_SERVER['PHP_SELF']) == 'contact-us.php' ? 'active' : ''; ?>" href="./contact-us">Contact Us</a>
        <a class="nav-link ms-3" <?php echo basename($_SERVER['PHP_SELF']) == 'take-a-tour.php' ? 'active' : ''; ?> href="./take-a-tour">Take a tour</a>
      </ul>
    </div>
  </div>
</nav>