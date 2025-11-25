<?php
session_name("backendSession");
session_start();
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'data-buku';
include '../../partials/sidebar.php';
?>

<!-- contect -->
<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
                <h4>Edit Data Buku</h4>
      
                  <?php
                include '../../action/data-buku/show.php';
                ?>
              <form action="../../action/data-buku/update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="BukuID" value="<?= $item->BukuID ?>">

                <div class="mb-3">
                    <label for="JudulInput" class="form-label">Judul</label>
                    <input type="text" name="Judul" class="form-control" id="JudulInput" placeholder="Masukan judul..." required value="<?= $item->Judul ?>">
                </div>

                <div class="mb-3">
                    <label for="PenulisInput" class="form-label">Penulis</label>
                    <input type="text" name="Penulis" class="form-control" id="PenulisInput" placeholder="Masukan penulis..." value="<?= $item->Penulis ?>">
                </div>

                <div class="mb-3">
                    <label for="PenerbitInput" class="form-label">Penerbit</label>
                    <input type="text" name="Penerbit" class="form-control" id="PenerbitInput" placeholder="Masukan penerbit..." value="<?= $item->Penerbit ?>">
                </div>

                <div class="mb-3">
                    <label for="tahun_terbitInput" class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" id="tahun_terbitInput" placeholder="Masukan tahun terbit..." value="<?= $item->tahun_terbit ?>">
                </div>

                <div class="mb-3">
                        <img class="w-25" src="../../../uploads/cover/<?=$item->cover?>" alt="">
                        <label for="coverInput" class="form-label"></label>
                        <input type="file" name="cover" class="form-control" id="coverInput"></input>
                    </div>

                <div class="mb-3">
                    <label for="deskripsiInput" class="form-label">Sinopsis</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsiInput" placeholder="Masukan sinopsis..." rows="5"><?=$item->deskripsi?></textarea>
                </div>

                <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="Stok" class="form-control" min="0" value="<?= $item->Stok ?>">
        </div>

            

                <button type="submit" class="btn btn-primary me-3" name="tombol">Edit</button>
                <a href="./index.php" class="btn btn-secondary">Kembali</a>
            </form>

            </div>
        </div>
    </div>


    <?php
    include '../../partials/script.php';
    include '../../partials/footer.php';
    ?>