<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Dapetin role user
$userRole = isset($_SESSION['user_role']) ? strtolower($_SESSION['user_role']) : null;
?>
<main class="main ">
    <!-- Sidebar Nav -->
  <aside id="sidebar" class="js-custom-scroll side-nav layoutSidenav">
        <ul id="sideNav" class="side-nav-menu side-nav-menu-top-level mb-0">
            <!-- Title -->
            <li class="sidebar-heading h6">Komponen</li>
            <!-- End Title -->

            <li class="side-nav-menu-item <?= ($current_dir == 'dashboard') ? 'active' : '' ?>">
                <a class="side-nav-menu-link media align-items-center sidebar-link" href="../dashboard/index.php">
                    <span class="side-nav-menu-icon d-flex mr-3">
                        <i class="gd-home"></i>
                    </span>
                    <span class="side-nav-fadeout-on-closed media-body">Dashboard</span>
                </a>
            </li>

            <?php if ($userRole === 'petugas' || $userRole === 'administrator'): ?>
            <li class="side-nav-menu-item <?= ($current_dir == 'data-buku') ? 'active' : '' ?>">
                <a class="side-nav-menu-link media align-items-center" href="../data-buku/index.php">
                    <span class="side-nav-menu-icon d-flex mr-3">
                        <i class="gd-book"></i>
                    </span>
                    <span class="side-nav-fadeout-on-closed media-body">Data Buku</span>
                </a>
            </li>
            <?php endif; ?>

    <?php if ($userRole === 'peminjam' || $userRole === 'administrator'): ?>
            <li class="side-nav-menu-item <?= ($current_dir == 'ulasan-buku') ? 'active' : '' ?>">
                <a class="side-nav-menu-link media align-items-center" href="../ulasan-buku/index.php">
                    <span class="side-nav-menu-icon d-flex mr-3">
                        <i class="fas fa-comment-dots"></i>
                    </span>
                    <span class="side-nav-fadeout-on-closed media-body">Ulasan Buku</span>
                </a>
            </li>
            <?php endif; ?>

<?php if ($userRole === 'peminjam'|| $userRole === 'petugas'): ?>
    <li class="side-nav-menu-item <?= ($current_dir == 'peminjaman') ? 'active' : '' ?>">
        <a class="side-nav-menu-link media align-items-center" href="../peminjaman/index.php">
            <span class="side-nav-menu-icon d-flex mr-3">
                <i class="fas fa-handshake"></i>
            </span>
            <span class="side-nav-fadeout-on-closed media-body">Peminjaman</span>
        </a>
    </li>
    <?php endif; ?>
<?php if ($userRole === 'peminjam'|| $userRole === 'petugas'): ?>
    <li class="side-nav-menu-item <?= ($current_dir == 'pengembalian') ? 'active' : '' ?>">
        <a class="side-nav-menu-link media align-items-center" href="../pengembalian/index.php">
            <span class="side-nav-menu-icon d-flex mr-3">
                <i class="fa-solid fa-hand-holding"></i>
            </span>
            <span class="side-nav-fadeout-on-closed media-body">Pengembalian</span>
        </a>
    </li>
    <?php endif; ?>

    <?php if ($userRole === 'peminjam'): ?>
            <!-- End Dashboard -->
            <li class="side-nav-menu-item <?= ($current_dir == 'koleksi') ? 'active' : '' ?>">
                <a class="side-nav-menu-link media align-items-center" href="../koleksi/index.php">
                    <span class="side-nav-menu-icon d-flex mr-3">
                       <i class="fas fa-folder-open"></i>
                    </span>
                    <span class="side-nav-fadeout-on-closed media-body">koleksi pribadi</span>
                </a>
            </li>
    <?php endif; ?>

    <?php if ($userRole === 'administrator' || $userRole === 'petugas'): ?>
            <li class="side-nav-menu-item <?= ($current_dir == 'kategori-relasi') ? 'active' : '' ?>">
                <a class="side-nav-menu-link media align-items-center" href="../kategori-relasi/index.php">
                    <span class="side-nav-menu-icon d-flex mr-3">
                       <i class="fas fa-tags"></i> 
                    </span>
                    <span class="side-nav-fadeout-on-closed media-body">Kategori</span>
                </a>
            </li>
            
            <?php endif; ?>

             <?php if ($userRole === 'administrator'): ?>
            <li class="side-nav-menu-item <?= ($current_dir == 'kategori-buku') ? 'active' : '' ?>">
                <a class="side-nav-menu-link media align-items-center" href="../kategori-buku/index.php">
                    <span class="side-nav-menu-icon d-flex mr-3">
                       <i class="fa-solid fa-layer-group"></i>
                    </span>
                    <span class="side-nav-fadeout-on-closed media-body">Type kategori</span>
                </a>
            </li> 
               <?php endif; ?>
            <!-- <li class="sidebar-heading h6">Examples</li> -->
            <!-- End Title -->

          <?php if ($userRole === 'administrator'): ?>
            <li class="side-nav-menu-item <?= ($current_dir == 'users') ? 'active' : '' ?>">
                <a class="side-nav-menu-link media align-items-center" href="../users/index.php">
                    <span class="side-nav-menu-icon d-flex mr-3">
                       <i class="fa-solid fa-circle-user"></i>
                    </span>
                    <span class="side-nav-fadeout-on-closed media-body">User</span>
                </a>
            </li>
              <?php endif; ?>
            <!-- End Settings -->
        </ul>
    </aside>
    <!-- End Sidebar Nav -->

    <div class="content">
        <div class="py-4 px-3 px-md-4">


        