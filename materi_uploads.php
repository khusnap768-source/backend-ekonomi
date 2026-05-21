<?php
require_once 'db.php';

// biar Flutter / web bisa akses
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ambil data judul dari Flutter
    $judul = $_POST['judul'];

    // ambil file gambar
    $imageName = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // lokasi simpan gambar
    $folder = "../uploads/" . $imageName;

    // pindahkan file ke folder uploads
    move_uploaded_file($tmpName, $folder);

    // simpan ke database
    $query = "INSERT INTO materi (judul, gambar)
              VALUES (:judul, :gambar)";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':judul', $judul);
    $stmt->bindParam(':gambar', $imageName);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Materi berhasil ditambahkan"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Gagal menyimpan"
        ]);
    }
}
?>