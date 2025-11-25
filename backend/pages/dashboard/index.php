<?php 
session_name("backendSession");
session_start();


// Anti-back + cek login
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../user/login.php';
    </script>";
    exit();
}

include '../../app.php'; 
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'dashboard';
include '../../partials/sidebar.php';



// Total Buku
$qBuku = mysqli_query($connect, "SELECT COUNT(*) as total FROM buku");
$totalBuku = mysqli_fetch_assoc($qBuku)['total'];

// Total User
$qUser = mysqli_query($connect, "SELECT COUNT(*) as total FROM user");
$totalUser = mysqli_fetch_assoc($qUser)['total'];

// Total Koleksi
$qKoleksi = mysqli_query($connect, "SELECT COUNT(*) as total FROM koleksipribadi");
$totalKoleksi = mysqli_fetch_assoc($qKoleksi)['total'];

// Total Peminjaman
$qPeminjaman = mysqli_query($connect, "SELECT COUNT(*) as total FROM peminjaman");
$totalPeminjaman = mysqli_fetch_assoc($qPeminjaman)['total'];

// Total Ulasan
$qUlasan = mysqli_query($connect, "SELECT COUNT(*) as total FROM ulasanbuku");
$totalUlasan = mysqli_fetch_assoc($qUlasan)['total'];


// data pie chart: jumlah buku per kategori
$qKategori = mysqli_query($connect, "
    SELECT k.NamaKategori, COUNT(r.BukuID) as jumlah
    FROM kategoribuku k
    LEFT JOIN kategoribuku_relasi r ON r.KategoriID = k.KategoriID
    LEFT JOIN buku b ON b.BukuID = r.BukuID
    GROUP BY k.KategoriID
");
$kategoriLabels = [];
$kategoriData = [];
while ($row = mysqli_fetch_assoc($qKategori)) {
    $kategoriLabels[] = $row['NamaKategori'];
    $kategoriData[] = $row['jumlah'];
}

// Query statistik peminjaman per bulan
$qStat = mysqli_query($connect, "
    SELECT MONTH(TanggalPeminjaman) as bulan, COUNT(*) as total
    FROM peminjaman
    GROUP BY MONTH(TanggalPeminjaman)
    ORDER BY bulan ASC
");

$bulan = [];
$total = [];

while ($row = mysqli_fetch_assoc($qStat)) {
    // Konversi angka bulan ke nama bulan (1 → Januari)
    $namaBulan = date("F", mktime(0, 0, 0, $row['bulan'], 1));
    $bulan[] = $namaBulan;
    $total[] = $row['total'];
}

$userole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Guest';
?>

<main>
<div class="container-fluid px-4 mt-4">
    <!-- <h3 class="mb-4">Dashboard </h3> -->


    <div class="container-fluid mt-3">
  <div class="row">
    <!-- Welcome Card -->
   <div class="col-md-12 mb-4">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body text-center">
      <h3 class="card-title mb-3">Selamat Datang 👋</h3>
      <p class="card-text text-muted">
        Anda login sebagai: <strong class="text-primary"><?= htmlspecialchars($userole) ?></strong>
      </p>
      <p class="card-text text-muted">
        Ini adalah halaman dashboard sederhana kami.  
        Silakan pilih menu di samping untuk mulai mengelola data.
      </p>
    </div>
  </div>
</div>
  </div>

 <div class="row">
  <!-- Total Buku -->
  <div class="col-md-3">
    <div class="card mb-3 shadow-sm border-0" style="background-color:#2962ff; color:white;">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div class="icon-box">
          <i class="fas fa-book fa-3x"></i>
        </div>
        <div class="text-right">
          <h6 class="mb-0">Total Buku</h6>
          <h3 class="mb-0">
            <?php
            $qBuku = mysqli_query($connect, "SELECT COUNT(*) as total FROM buku");
            echo mysqli_fetch_assoc($qBuku)['total'];
            ?>
          </h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Peminjaman -->
  <div class="col-md-3">
    <div class="card mb-3 shadow-sm border-0" style="background-color:#00c853; color:white;">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div class="icon-box">
          <i class="fas fa-handshake fa-3x"></i>
        </div>
        <div class="text-right">
          <h6 class="mb-0">Total Peminjaman</h6>
          <h3 class="mb-0">
            <?php
            $qPinjam = mysqli_query($connect, "SELECT COUNT(*) as total FROM peminjaman");
            echo mysqli_fetch_assoc($qPinjam)['total'];
            ?>
          </h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Kategori -->
  <div class="col-md-3">
    <div class="card mb-3 shadow-sm border-0" style="background-color:#ffca28; color:white;">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div class="icon-box">
          <i class="fas fa-tags fa-3x"></i>
        </div>
        <div class="text-right">
          <h6 class="mb-0">Total Kategori</h6>
          <h3 class="mb-0">
            <?php
            $qKategori = mysqli_query($connect, "SELECT COUNT(*) as total FROM kategoribuku");
            echo mysqli_fetch_assoc($qKategori)['total'];
            ?>
          </h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Total Ulasan -->
  <div class="col-md-3">
    <div class="card mb-3 shadow-sm border-0" style="background-color:#e53935; color:white;">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div class="icon-box">
          <i class="fas fa-comment-dots fa-3x"></i>
        </div>
        <div class="text-right">
          <h6 class="mb-0">Total Ulasan</h6>
          <h3 class="mb-0">
            <?php
            $qUlasan = mysqli_query($connect, "SELECT COUNT(*) as total FROM ulasanbuku");
            echo mysqli_fetch_assoc($qUlasan)['total'];
            ?>
          </h3>
        </div>
      </div>
    </div>
  </div>
</div>


   <div class="row mt-4">
    <!-- Pie Chart -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <strong>Distribusi Buku per Kategori</strong>
            </div>
            <div class="card-body">
                <canvas id="pieChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Bar Chart -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <strong>Statistik Peminjaman Per Bulan</strong>
            </div>
            <div class="card-body" style="height:350px;">
                <canvas id="chartPeminjaman"></canvas>
            </div>
        </div>
    </div>
</div>



    </div>
</div>
</main>

<?php
include '../../partials/script.php';
include '../../partials/footer.php';
?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart
    const pieCtx = document.getElementById('pieChart');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: <?= json_encode($kategoriLabels) ?>,
            datasets: [{
                data: <?= json_encode($kategoriData) ?>,
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#20c997']
            }]
        }
    });


const ctx = document.getElementById('chartPeminjaman').getContext('2d');
new Chart(ctx, {
    type: 'bar', // bisa ganti 'line' kalau mau
    data: {
        labels: <?php echo json_encode($bulan); ?>,
        datasets: [{
            label: 'Jumlah Peminjaman',
            data: <?php echo json_encode($total); ?>,
            backgroundColor: '#42a5f5'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    }
});
</script>
