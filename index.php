<!DOCTYPE html>
<html lang="en">

<style>
.client_section {
    padding: 50px 0;
    background-color: rgb(188, 190, 191);
    color: #333;
}

.heading_container {
    text-align: center;
    margin-bottom: 40px;
}

.heading_container h2 {
    font-size: 32px;
    margin-bottom: 10px;
}

.testimonial-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 20px;
}

.card {
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-content {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 20px;
    padding: 20px;
}

.img-box {
    display: flex;
    align-items: center;
    justify-content: center;
}

.img-box img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
}

.text-content {
    text-align: left;
}

.text-content h6 {
    font-size: 18px;
    margin-bottom: 5px;
    font-weight: 600;
}

.location {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
}

.testimonial-text {
    font-size: 14px;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .card-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .img-box {
        justify-content: center;
        margin-bottom: 15px;
    }
}

</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Udinus Poliklinik</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="hold-transition login-page">
<div class="container-fluid flex flex-col justify-center items-center text-white p-5"
     style="height: 400px; background-image: url('assets/images/gedung1.png'); background-size: cover; background-position: center; position: relative;">
     <h1 class="font-weight-bold mb-3" style="color: black; font-family: 'Arial, sans-serif'; font-size: 36px; text-transform: uppercase; display: flex; align-items: center;">
    <img src="assets/images/icon_klinik.png" style="width: 40px; height: 40px; margin-right: 10px;">
    Udinus Poliklinik
</h1>

     <h5 style="color: black; font-weight: bold;">
    Sistem Informasi Layanan Kesehatan
</h5>
    <marquee style="position: absolute; top: 0; background-color: rgba(173, 216, 230, 0.5); color: red; width: 100%; padding: 10px; font-weight: bold;">
    Sehat Dimulai dari Diri Sendiri – Jaga Kebersihan dan Pola Hidup Sehat!
    </marquee>
</div>
    <div class="container mt-5">
        <div class="row justify-content-lg-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-hospital-user fa-fw mb-3 text-primary" style="font-size: 34px;"></i>
                        <h3 class="">Pasien</h3>
                        <p class="card-text">Untuk mendapatkan layanan kesehatan dari Udinus Poliklinik, silahkan login terlebih dahulu</p>
                        <a href="loginUser.php" class="btn btn-primary btn-block">Masuk</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                    <img src="assets/images/doctor.png" alt="Ikon Dokter" style="width: 30px; height: 34px;" class="mb-3 text-success">
                        <h3 class="">Dokter</h3>
                        <p class="card-text">Untuk memulai melayani pasien di Udinus Poliklinik, silahkan login terlebih dahulu</p>
                        <div class="d-grid">
                            <a href="login.php" class="btn btn-success btn-block">Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.login-box -->
        <section class="client_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Testimoni Pelayanan</h2>
        </div>
        <!-- Testimoni 1 -->
        <div class="testimonial-card my-4">
            <div class="card">
                <div class="card-content">
                    <div class="img-box">
                        <img src="assets/images/irsyad.jpg" alt="Client 1">
                    </div>
                    <div class="text-content">
                        <h6>Isyad</h6>
                        <p class="location">Semarang</p>
                        <p class="testimonial-text">Luarbiasa.. Pelayanan di Poliklinik Udinus sangat memuaskan</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimoni 2 -->
        <div class="testimonial-card my-4">
            <div class="card">
                <div class="card-content">
                    <div class="img-box">
                        <img src="assets/images/diana.jpg" alt="Client 2">
                    </div>
                    <div class="text-content">
                        <h6>Diana</h6>
                        <p class="location">Semarang</p>
                        <p class="testimonial-text">Aplikasi ini sangat membantu dan mudah digunakan.
                            <br>Semua informasi yang di butuhkan tersedia, dan prosesnya lebih efisien.<br>
                            Terima kasih atas inovasi ini!</p>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimoni 3 -->
        <div class="testimonial-card my-4">
            <div class="card">
                <div class="card-content">
                    <div class="img-box">
                        <img src="assets/images/ronal.jpg" alt="Client 2">
                    </div>
                    <div class="text-content">
                        <h6>Ronal</h6>
                        <p class="location">Semarang</p>
                        <p class="testimonial-text">Layanan terbaik yang pernah saya alami!<br>
                        Timnya sangat peduli dengan kebutuhan pelanggan,dan sangat dihargai.</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



        <!-- jQuery -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>