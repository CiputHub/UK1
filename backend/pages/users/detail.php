<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'users';
include '../../partials/sidebar.php';
?>

<!-- contect -->
 <div id="layoutSidenav_content">
 <div class="row px-5 mt-5  justify-content-center">
    <div class="col-9">
        <div class="card">
            
            <div class="card-body">
                    <h4 class="mb-3">Tambah Ulasan</h4>
                <?php
                include '../../action/visi_mission/show.php';
                ?>
                <form>
                      <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" aria-label="Default select example" name="category" disabled>
                            <option disabled <?= empty ($visi_mission->category) ? 'selected' : ''?>>
                            Pilih kategori</option>
                            <option value="visi"  <?= ($visi_mission->category == 'visi')? 'selected' : ''?>>visi</option>
                            <option value="misi" <?= ($visi_mission->category == 'misi')? 'selected' : ''?>>misi</option>
                         
                        </select>
                      </div>

                    <div class="mb-3">
                        <label for="textInput" class="form-label">Text</label>
                        <textarea disabled name="text" class="form-control" id="textInput" rows="5" ><?=$visi_mission->text?></textarea>  
                    </div>


                    
                    <a href="./index.php" class="btn btn-primary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
 </div>

    <?php
    include '../../partials/footer.php';
    include '../../partials/script.php';
    ?>