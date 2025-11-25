<?php
include '../config/connection.php';

// ambil data about (karena biasanya cuma ada 1 record)
$qAbout = "SELECT * FROM abouts LIMIT 1";
$result_about = mysqli_query($connect, $qAbout) or die(mysqli_error($connect));
$about = $result_about->fetch_object();

$qSocialmedia = "SELECT * FROM social_media";
$result_social_media = mysqli_query($connect, $qSocialmedia) or die(mysqli_error($connect));
?>

<!-- Hero Section -->
<!-- Hero Section -->
<section id="hero" class="hero d-flex align-items-center text-white">
  <video autoplay muted loop playsinline class="position-absolute w-100 h-100 object-fit-cover">
    <source src="../storages/about/<?= $about->school_video ?>" type="video/mp4">
    Browser anda tidak mendukung video.
  </video>

  

  <div class="container d-flex flex-column justify-content-center align-items-center text-center">
    <h1 class="fw-bold display-4 mb-3"><?= $about->school_name ?></h1>
    <!-- <p class="lead mb-4"><?= $about->school_tagline ?></p> -->
       <!-- Jam & Tanggal -->
    <div class="stats-item text-center mb-4">
      <h1 id="jam" style="font-size: 52px; font-weight: bold;">--:--:--</h1>
      <p id="tanggal" style="font-size: 18px; margin-top: 5px;">--</p>
    </div>
    <div class="d-flex align-items-center gap-3">
      <a href="#contact" class="btn btn-success btn-lg px-4">Hubungi Kami</a>
      <div class="social-links d-flex gap-3">
        <?php while($s = $result_social_media->fetch_object()): ?>
          <a href="<?= $s->link_url ?>" target="_blank" class="fs-3 text-white">
            <i class="<?= $s->icon ?>"></i>
          </a>
        <?php endwhile; ?>
      </div>
    </div>
  </div>

 <!-- overlay -->
  <div class="overlay position-absolute top-0 start-0 w-100 h-100" 
       style="background: rgba(0,0,0,0.5);"></div>
</section>

<script>
  function updateTime() {
    const now = new Date();
    const jam = now.toLocaleTimeString('id-ID', { hour12: false });
    const tanggal = now.toLocaleDateString('id-ID', {
      weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
    document.getElementById('jam').innerText = jam;
    document.getElementById('tanggal').innerText = tanggal;
  }
  setInterval(updateTime, 1000);
  updateTime();
</script>

<style>
  #hero {
    position: relative;
    height: 100vh;
    overflow: hidden;
  }
  #hero video {
    z-index: 0;
  }
  #hero .overlay {
    z-index: 1;
  }
  #hero .container {
    z-index: 2;
  }
  #hero h1, 
  #hero p, 
  #hero a, 
  #hero .social-links a {
    color: #fff;
    text-shadow: 0 2px 6px rgba(0,0,0,0.6);
  }
  #hero .social-links a:hover {
    color: #0d6efd; /* biru bootstrap */
  }
</style>
