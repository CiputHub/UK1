<?php 
session_name("frontend_session");
session_start(); 
include '../config/connection.php';

if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['user_nama'])) {
        $namaUser = $_SESSION['user_nama'];
    } else {
        $qUser = "SELECT * FROM user WHERE UserID = ".$_SESSION['user_id']." LIMIT 1";
        $resUser = mysqli_query($connect, $qUser);
        $dataUser = mysqli_fetch_assoc($resUser);

        // cek kolom sesuai database (NamaLengkap)
        $namaUser = $_SESSION['nama'] ?? 'User';


    }
    $initial = strtoupper(substr($namaUser, 0, 1));
}
?>

<!-- Navbar Start -->
 
<div class="container-fluid bg-secondary px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="nav-bar">
        <nav class="navbar navbar-expand-lg bg-primary navbar-dark px-4 py-lg-0">
            <h4 class="d-lg-none m-0">Menu</h4>
            <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                
                <!-- Menu utama -->
                <div class="navbar-nav me-auto">
                
                    <a href="#home" class="nav-item nav-link">Beranda</a>
                    <a href="#buku" class="nav-item nav-link">Buku Terbaru</a>
                    <a href="#reviews" class="nav-item nav-link">Ulasan Terbaru</a>
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="koleksipribadi.php" class="nav-item nav-link">Koleksi Pribadi</a>
                    <?php endif; ?>
                </div>

                <!-- Login/Logout -->
                <div class="d-flex ms-auto align-items-center">
                    <?php if (isset($_SESSION['user_id'])): ?>
                  

<div class="dropdown">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" 
       id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
        
        <!-- Avatar huruf awal -->
        <div class="rounded-circle bg-light text-primary fw-bold d-flex align-items-center justify-content-center me-2" 
             style="width:40px; height:40px;">
            <?= $initial ?>
        </div>

        <!-- Nama lengkap -->
        <span class="d-none d-lg-inline"><?= htmlspecialchars($namaUser ?? 'NamaLengkap') ?></span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
        <!-- <li><a class="dropdown-item" href="./auth/profil.php">Profil</a></li> -->
        <li><a class="dropdown-item text-danger" href="./auth/logout.php" 
               onclick="return confirm('Yakin mau logout?')">Logout</a></li>
    </ul>
</div>

                    
                    <?php else: ?>
                        <a href="./auth/login.php" class="btn btn-outline-light ms-3">Login</a>
                        <a href="./auth/register.php" class="btn btn-outline-success ms-2">Register</a>
                    <?php endif; ?>
                </div>

            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->


<script>
// Ambil semua link navbar yang internal (#)
const navLinks = document.querySelectorAll('.navbar-nav a[href^="#"]');

function onScroll() {
    const scrollPos = window.scrollY + 100; // offset sedikit agar lebih rapi
    navLinks.forEach(link => {
        const section = document.querySelector(link.getAttribute('href'));
        if(section) {
            if(scrollPos >= section.offsetTop && scrollPos < section.offsetTop + section.offsetHeight) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        }
    });
}

// Trigger saat scroll dan saat load awal
window.addEventListener('scroll', onScroll);
window.addEventListener('load', onScroll);
</script>
