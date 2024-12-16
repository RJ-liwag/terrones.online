<?php
include("header.php");
?>


<div class="video-container">
  <video class="montage-clip w-100 p-3" src="assets/video/montageclip.mp4" controls></video>
</div>


<style>
 .video-container {
  /* Center the container horizontally */
  margin: 0 auto;
  /* Adjust width as needed (optional) */
  width: 100% !important;
  height: 80% !important;
  display: flex !important;
  justify-content: center !important;
}
.montage-clip{
    border-radius: 30px !important;
}
</style>


<?php
include("footer.php");
?>