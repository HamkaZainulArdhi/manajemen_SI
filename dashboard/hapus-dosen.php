<?php
include '../fuction.php';

$id = $_GET['id'];

// Hapus guru berdasarkan ID
$stmt = $conn->prepare("DELETE FROM teachers WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: dosen.php");
} else {
    echo "Gagal menghapus data.";
}
?>