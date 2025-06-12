<?php
// Mulai session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inisialisasi data tugas awal jika belum ada di session
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [
        ['judul' => 'Membuat to-do list dengan PHP', 'status' => 'selesai'],
        ['judul' => 'Upload project ke GitHub', 'status' => 'selesai'],
        ['judul' => 'MUpload project ke GitHub', 'status' => 'belum selesai'],
    ];
}
?>