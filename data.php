<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [
        ['judul' => 'Membuat to-do list dengan PHP', 'status' => 'selesai'],
        ['judul' => 'Upload project ke GitHub', 'status' => 'selesai'],
        ['judul' => 'MUpload project ke GitHub', 'status' => 'belum selesai'],
    ];
}
?>
