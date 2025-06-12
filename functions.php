<?php
// Mulai sesi
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Memuat data tugas
include 'data.php';

// Fungsi untuk menambahkan tugas baru ke dalam daftar
function tambahTugas($judul) {
    $_SESSION['tasks'][] = ['judul' => $judul, 'status' => 'belum'];
}

// Menghapus tugas 
function hapusTugas($index) {
    unset($_SESSION['tasks'][$index]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']);
}

// mengubah status tugas 
function toggleStatus($index) {
    if ($_SESSION['tasks'][$index]['status'] === 'belum') {
        $_SESSION['tasks'][$index]['status'] = 'selesai';
    } else {
        $_SESSION['tasks'][$index]['status'] = 'belum';
    }
}

function editTugas($index, $judulBaru) {
    $_SESSION['tasks'][$index]['judul'] = $judulBaru;
}
