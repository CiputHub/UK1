<?php
session_name("backendSession");
session_start();
include '../../app.php'; 
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'data-buku';
include '../../partials/sidebar.php';

// --- Pagination setup ---
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// hitung total data
$qCount = "SELECT COUNT(*) AS total FROM buku";
$resCount = mysqli_query($connect, $qCount);
$totalData = mysqli_fetch_assoc($resCount)['total'];
$totalPages = ceil($totalData / $limit);

// ambil data sesuai halaman
$qBuku = "SELECT * FROM buku LIMIT $limit OFFSET $offset";
$result = mysqli_query($connect, $qBuku) or die(mysqli_error($connect));
?>

<main>
<div class="container-fluid px-4 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Tabel Buku</h4>
        <a href="create.php" class="btn btn-primary">Tambah </a>
    </div>

    <div class="card mb-4 shadow-sm border-0 rounded-3">
        <div class="card-body">
            <table id="tabelBuku" class="table table-bordered border-dark text-center align-middle table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun Terbit</th>
                      
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $offset + 1;
                    while($item = $result->fetch_object()):
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td>
                            <img src="../../../uploads/cover/<?= $item->cover?>" alt="gambar" width="100" height="100">
                        </td>
                        <td style="width: 30%;"><?= $item->Judul ?></td>
                        <td style="width: 15%;"><?= $item->Penulis ?></td>
                        <td style="width: 10%;"><?= $item->tahun_terbit ?></td>
                        
                        <td>
                            <a href="./detail.php?id=<?= $item->BukuID ?>" class="btn btn-success btn-sm">Detail</a>
                            <a href="./edit.php?id=<?= $item->BukuID ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="../../action/data-buku/delete.php?BukuID=<?= $item->BukuID ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin mau hapus data ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                    endwhile;
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page-1 ?>">Previous</a>
                    </li>

                    <?php for($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page+1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
</main>

<?php
include '../../partials/script.php';
include '../../partials/footer.php';
?>
