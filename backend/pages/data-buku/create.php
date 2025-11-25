<?php
session_name("backendSession");
session_start();
include '../../app.php'; 
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'data-buku';
include '../../partials/sidebar.php';
?>

<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h4 class="mb-3">Tambah Buku</h4>
      <form action="../../action/data-buku/store.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label>Judul</label>
          <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Penulis</label>
          <input type="text" name="penulis" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Penerbit</label>
          <input type="text" name="penerbit" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tahun Terbit</label>
          <input type="number" name="tahun_terbit" class="form-control" required min="1900" max="2099">
        </div>

        <div class="mb-3">
                        <label for="coverInput" class="form-label"></label>
                        <input type="file" name="cover" class="form-control" id="coverInput" required></input>
                    </div>
      
                    
         <div class="mb-3">
          <label>Sinopsis</label>
          <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
        </div>

         <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="Stok" class="form-control" min="0" required>
        </div>

      



        <button type="submit" class="btn btn-primary" name="tombol">Tambah</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>

<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
