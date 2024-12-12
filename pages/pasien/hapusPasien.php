<?php
include("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input ID
    if (!empty($_POST["id"]) && is_numeric($_POST["id"])) {
        $id = intval($_POST["id"]); // ID pasien

        // Mulai transaksi
        $mysqli->begin_transaction();

        try {
            // Cek apakah ID pasien ada
            $stmtCheck = $mysqli->prepare("SELECT id FROM pasien WHERE id = ?");
            if ($stmtCheck) {
                $stmtCheck->bind_param("i", $id);
                $stmtCheck->execute();
                $stmtCheck->store_result();
                if ($stmtCheck->num_rows === 0) {
                    throw new Exception("ID pasien tidak ditemukan.");
                }
                $stmtCheck->close();
            } else {
                throw new Exception("Error in prepared statement: " . $mysqli->error);
            }

            // Langkah 1: Hapus data di tabel detail_periksa
            $stmt1 = $mysqli->prepare("
                DELETE FROM detail_periksa 
                WHERE id_periksa IN (
                    SELECT id 
                    FROM periksa 
                    WHERE id_daftar_poli IN (
                        SELECT id FROM daftar_poli WHERE id_pasien = ?
                    )
                )
            ");
            if ($stmt1) {
                $stmt1->bind_param("i", $id);
                $stmt1->execute();
                $stmt1->close();
            } else {
                throw new Exception("Error in prepared statement detail_periksa: " . $mysqli->error);
            }

            // Langkah 2: Hapus data di tabel periksa
            $stmt2 = $mysqli->prepare("
                DELETE FROM periksa 
                WHERE id_daftar_poli IN (
                    SELECT id FROM daftar_poli WHERE id_pasien = ?
                )
            ");
            if ($stmt2) {
                $stmt2->bind_param("i", $id);
                $stmt2->execute();
                $stmt2->close();
            } else {
                throw new Exception("Error in prepared statement periksa: " . $mysqli->error);
            }

            // Langkah 3: Hapus data di tabel daftar_poli
            $stmt3 = $mysqli->prepare("DELETE FROM daftar_poli WHERE id_pasien = ?");
            if ($stmt3) {
                $stmt3->bind_param("i", $id);
                $stmt3->execute();
                $stmt3->close();
            } else {
                throw new Exception("Error in prepared statement daftar_poli: " . $mysqli->error);
            }

            // Langkah 4: Hapus data di tabel pasien
            $stmt4 = $mysqli->prepare("DELETE FROM pasien WHERE id = ?");
            if ($stmt4) {
                $stmt4->bind_param("i", $id);
                $stmt4->execute();
                $stmt4->close();

                // Commit transaksi
                $mysqli->commit();

                // Berhasil, arahkan kembali
                echo '<script>';
                echo 'alert("Data pasien berhasil dihapus!");';
                echo 'window.location.href = "../../pasien.php";';
                echo '</script>';
                exit();
            } else {
                throw new Exception("Error in prepared statement pasien: " . $mysqli->error);
            }
        } catch (Exception $e) {
            // Rollback jika terjadi kesalahan
            $mysqli->rollback();
            echo '<script>';
            echo 'alert("Error: ' . addslashes($e->getMessage()) . '");';
            echo 'window.history.back();';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'alert("ID tidak valid!");';
        echo 'window.history.back();';
        echo '</script>';
    }
}

// Tutup koneksi
$mysqli->close();
?>
