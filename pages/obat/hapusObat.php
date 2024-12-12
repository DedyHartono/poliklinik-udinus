<?php
include("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST["id"];

    // Mulai transaksi
    $mysqli->begin_transaction();

    try {
        // Hapus data terkait di tabel detail_periksa
        $query1 = "DELETE FROM detail_periksa WHERE id_obat = $id";
        $mysqli->query($query1);

        // Hapus data di tabel obat
        $query2 = "DELETE FROM obat WHERE id = $id";
        $mysqli->query($query2);

        // Commit transaksi
        $mysqli->commit();

        // Berhasil, redirect kembali ke halaman index atau sesuaikan dengan kebutuhan Anda
        echo '<script>';
        echo 'alert("Data obat berhasil dihapus!");';
        echo 'window.location.href = "../../obat.php";';
        echo '</script>';
        exit();
    } catch (Exception $e) {
        // Rollback jika terjadi kesalahan
        $mysqli->rollback();
        echo "Error: " . $e->getMessage();
    }
}

// Tutup koneksi
$mysqli->close();
?>
