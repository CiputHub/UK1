<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'pengembalian';
include '../../partials/sidebar.php';

// pagination
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$qCount = "SELECT COUNT(*) AS total FROM pengembalian";
$resCount = mysqli_query($connect, $qCount);
$totalData = mysqli_fetch_assoc($resCount)['total'];
$totalPages = ceil($totalData / $limit);

$q = "
    SELECT p.*, u.NamaLengkap, b.Judul 
    FROM pengembalian p
    LEFT JOIN peminjaman pm ON p.PeminjamanID = pm.PeminjamanID
    LEFT JOIN user u ON pm.UserID = u.UserID
    LEFT JOIN buku b ON pm.BukuID = b.BukuID
    ORDER BY p.PengembalianID DESC
    LIMIT $limit OFFSET $offset
";
$result = mysqli_query($connect, $q) or die(mysqli_error($connect));
?>
<main>
<div class="container-fluid px-4 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Tabel Pengembalian</h4>
        <a href="create.php" class="btn btn-primary">Tambah</a>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Kondisi</th>
                        <th>Dokumentasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = $offset+1;
                while($row = $result->fetch_object()): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row->NamaLengkap ?? '-' ?></td>
                        <td><?= $row->Judul ?? '-' ?></td>
                        <td><?= $row->TanggalPengembalian ?></td>
                        <td><?= ucfirst($row->KondisiBuku) ?></td>
                        <td>
                            <?php if ($row->Dokumentasi): ?>
                                <img src="../../uploads/pengembalian/<?= $row->Dokumentasi ?>" 
                                     alt="foto" width="80">
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="detail.php?id=<?= $row->PengembalianID ?>" class="btn btn-success btn-sm">Detail</a>
                            <a href="edit.php?id=<?= $row->PengembalianID ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="../../action/pengembalian/delete.php?id=<?= $row->PengembalianID ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin mau hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php 
                $no++;
                endwhile; ?>
                </tbody>
            </table>

            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $page<=1?'disabled':'' ?>">
                        <a class="page-link" href="?page=<?= $page-1 ?>">Previous</a>
                    </li>
                    <?php for($i=1;$i<=$totalPages;$i++): ?>
                        <li class="page-item <?= $i==$page?'active':'' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $page>=$totalPages?'disabled':'' ?>">
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
