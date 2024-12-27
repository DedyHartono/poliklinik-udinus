<?php
session_start();

// Gunakan path relatif untuk koneksi.php
include('C:/Program Files/XAMPP/htdocs/poliklinik-udinus/config/koneksi.php');

// Debugging untuk memeriksa sesi
if (isset($_SESSION['akses']) && $_SESSION['akses'] == "dokter" && isset($_SESSION['id'])) {
    $dokter_id = $_SESSION['id']; // Ambil user_id dari session

    // Ambil data dokter dari database
    $query = "SELECT * FROM dokter WHERE id = '$dokter_id'";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $dokter = mysqli_fetch_assoc($result);

        if (!$dokter) {
            echo "Dokter tidak ditemukan.";
            exit();
        }
    } else {
        echo "Error: " . mysqli_error($mysqli);
        exit();
    }
} else {
    echo "Akses ditolak. Pastikan Anda sudah login sebagai dokter.";
    exit();
}

// Cek apakah formulir telah disubmit
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    // Update data dokter dengan prepared statement
    $update_query = "UPDATE dokter SET nama = ?, alamat = ?, no_hp = ? WHERE id = ?";

    if ($stmt = mysqli_prepare($mysqli, $update_query)) {
        mysqli_stmt_bind_param($stmt, "sssi", $nama, $alamat, $no_hp, $dokter_id); // Binding parameter
        if (mysqli_stmt_execute($stmt)) {
            // Setelah berhasil update, ambil data dokter terbaru dari database
            $query = "SELECT * FROM dokter WHERE id = '$dokter_id'";
            $result = mysqli_query($mysqli, $query);
            if ($result) {
                $dokter = mysqli_fetch_assoc($result);
                // Perbarui data sesi
                $_SESSION['username'] = $dokter['nama'];
                $_SESSION['password'] = $dokter['password'];
                $_SESSION['id_poli'] = $dokter['id_poli'];
                $_SESSION['dokter_nama'] = $dokter['nama']; // Update nama dokter di session
                $_SESSION['dokter_alamat'] = $dokter['alamat']; // Update alamat di session
                $_SESSION['dokter_no_hp'] = $dokter['no_hp']; // Update no_hp di session
            }

            echo "<script>alert('Profil berhasil diperbarui'); window.location = 'dashboard_dokter.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui profil');</script>";
        }
    } else {
        echo "<script>alert('Gagal menyiapkan query');</script>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<html lang="en" style="height: auto;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Udinus Poliklinik</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="sidebar-mini sidebar-closed sidebar-collapse" style="height: auto;">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>

                <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">9</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">27 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 9 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 17 friend requests
                            <span class="float-right text-muted text-sm">4 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 1 new reports
                            <span class="float-right text-muted text-sm">9 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav> <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <!-- <a href="index3.html" class="brand-link">
        <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            <?php echo htmlspecialchars($dokter['nama'] ?? 'Nama tidak tersedia'); ?>
                        </a>
                    </div>

                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="sidebar-search-results">
                        <div class="list-group"><a href="#" class="list-group-item">
                                <div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div>
                                <div class="search-path"></div>
                            </a></div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Menu
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="dashboard_dokter.php" class="nav-link">
                                        <i class="fas fa-solid fas fa-th nav-icon"></i>
                                        <p>Dashboard <span class="right badge badge-success">Dokter</span></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="jadwalPeriksa.php" class="nav-link">
                                        <i class="fas fa-solid fa-hospital-user nav-icon"></i>
                                        <p>Jadwal Praktek Dokter <span class="right badge badge-success">Dokter</span></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="periksaPasien.php" class="nav-link">
                                        <i class="fas fa-solid fa-stethoscope nav-icon"></i>
                                        <p>Periksa Pasien <span class="right badge badge-success">Dokter</span></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="riwayatPasien.php" class="nav-link">
                                        <i class="fas fa-solid fa-book-medical nav-icon"></i>
                                        <p>Riwayat Pasien <span class="right badge badge-success">Dokter</span></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="editDokter.php" class="nav-link">
                                        <i class="fas fa-user nav-icon"></i>
                                        <p>Edit Profil <span class="right badge badge-success">Dokter</span></p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="pages/logout/logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside> <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 681.2px;">
            <!-- Content Header (Page header) -->
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Edit Profil</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
                                <li class="breadcrumb-item active">Edit Profil</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <h3 style="text-align: center; font-weight: bold;">Data Dokter</h3>
                            </div>
                            <!-- /.card-header -->


                            <body>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">

                                        <?php if (isset($dokter)) { ?>
                                            <form method="POST" action="editDokter.php">
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($dokter['nama']); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea class="form-control" id="alamat" name="alamat" required><?php echo htmlspecialchars($dokter['alamat']); ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_hp">Nomor Telepon</label>
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($dokter['no_hp']); ?>" required>
                                                </div>
                                                <button type="submit" name="update" class="btn btn-primary">Perbarui Profil</button>
                                            </form>
                                        <?php } else { ?>
                                            <p>Data profil dokter tidak ditemukan.</p>
                                        <?php } ?>
                                </div>
                            </body>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content --> <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Halo</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <div id="sidebar-overlay"></div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>


</body>

</html>