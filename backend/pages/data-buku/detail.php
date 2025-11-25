<?php
session_name("backendSession");
session_start();
include '../../app.php'; 
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'data-buku';
include '../../partials/sidebar.php';

// ambil data dari action show
include '../../action/data-buku/show.php';
?>

<!-- content -->

<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
  
      <h4 class="mb-4">Detail Data Buku</h4>
          <form>
           <div class="container-fluid mt-3">

  <div class="row mb-2">
    <div class="col-sm-3 fw-bold">Judul</div>
    <div class="col-sm-9"><?= $item->Judul ?></div>
  </div>

  <div class="row mb-2">
    <div class="col-sm-3 fw-bold">Penulis</div>
    <div class="col-sm-9"><?= $item->Penulis ?></div>
  </div>

  <div class="row mb-2">
    <div class="col-sm-3 fw-bold">Penerbit</div>
    <div class="col-sm-9"><?= $item->Penerbit ?></div>
  </div>

  <div class="row mb-2">
    <div class="col-sm-3 fw-bold">Tahun Terbit</div>
    <div class="col-sm-9"><?= $item->tahun_terbit ?></div>
  </div>

  <div class="row mb-3">
    <div class="col-sm-3 fw-bold">Cover</div>
    <div class="col-sm-9">
      <img class="img-fluid rounded border" style="max-width:200px;" 
           src="../../../uploads/cover/<?= $item->cover ?>" alt="">
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-sm-3 fw-bold">Sinopsis</div>
    <div class="col-sm-9"><?= nl2br($item->deskripsi) ?></div>
  </div>

  <div class="row mb-2">
    <div class="col-sm-3 fw-bold">Stok</div>
    <div class="col-sm-9"><?= $item->Stok ?></div>  
  </div>



  <div class="mt-3">
    <a href="./index.php" class="btn btn-primary">Kembali</a>
  </div>
</div>


          
          </form>
        </div>
      </div>
    </div>
 

  <?php
  include '../../partials/script.php';
  include '../../partials/footer.php';
  ?>
