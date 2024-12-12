<?php
include("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["id"]) && is_numeric($_POST["id"])) {
        $id = $_POST["id"]; // ID dokter

        // Langkah 1: Hapus data di tabel detail_periksa
        $stmt1 = $mysqli->prepare("
            DELETE FROM detail_periksa 
            WHERE id_periksa IN (
                SELECT id 
                FROM periksa 
                WHERE id_daftar_poli IN (
                    SELECT id 
                    FROM daftar_poli 
                    WHERE id_jadwal IN (
                        SELECT id 
                        FROM jadwal_periksa 
                        WHERE id_dokter = ?
                    )
                )
            )
        ");
        if ($stmt1) {
            $stmt1->bind_param("i", $id);
            if (!$stmt1->execute()) {
                echo "Error: " . $stmt1->error;
            }
            $stmt1->close();
        } else {
            echo "Prepared statement failed: " . $mysqli->error;
        }

        // Langkah 2: Hapus data di tabel periksa
        $stmt2 = $mysqli->prepare("
            DELETE FROM periksa 
            WHERE id_daftar_poli IN (
                SELECT id 
                FROM daftar_poli 
                WHERE id_jadwal IN (
                    SELECT id 
                    FROM jadwal_periksa 
                    WHERE id_dokter = ?
                )
            )
        ");
        if ($stmt2) {
            $stmt2->bind_param("i", $id);
            if (!$stmt2->execute()) {
                echo "Error: " . $stmt2->error;
            }
            $stmt2->close();
        } else {
            echo "Prepared statement failed: " . $mysqli->error;
        }

        // Langkah 3: Hapus data di tabel daftar_poli
        $stmt3 = $mysqli->prepare("
            DELETE FROM daftar_poli 
            WHERE id_jadwal IN (
                SELECT id 
                FROM jadwal_periksa 
                WHERE id_dokter = ?
            )
        ");
        if ($stmt3) {
            $stmt3->bind_param("i", $id);
            if (!$stmt3->execute()) {
                echo "Error: " . $stmt3->error;
            }
            $stmt3->close();
        } else {
            echo "Prepared statement failed: " . $mysqli->error;
        }

        // Langkah 4: Hapus data di tabel jadwal_periksa
        $stmt4 = $mysqli->prepare("DELETE FROM jadwal_periksa WHERE id_dokter = ?");
        if ($stmt4) {
            $stmt4->bind_param("i", $id);
            if (!$stmt4->execute()) {
                echo "Error: " . $stmt4->error;
            }
            $stmt4->close();
        } else {
            echo "Prepared statement failed: " . $mysqli->error;
        }

        // Langkah 5: Hapus data di tabel dokter
        $stmt5 = $mysqli->prepare("DELETE FROM dokter WHERE id = ?");
        if ($stmt5) {
            $stmt5->bind_param("i", $id);
            if ($stmt5->execute()) {
                echo '<script>';
                echo 'alert("Data dokter berhasil dihapus!");';
                echo 'window.location.href = "../../dokter.php";';
                echo '</script>';
                exit();
            } else {
                echo "Error: " . $stmt5->error;
            }
            $stmt5->close();
        } else {
            echo "Prepared statement failed: " . $mysqli->error;
        }
    } else {
        echo "ID tidak valid!";
    }
}

$mysqli->close();