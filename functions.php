<?php
// Mulai sesi jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Memuat data tugas dari file data.php
include 'data.php';

// Fungsi untuk menambahkan tugas baru ke dalam daftar
function tambahTugas($judul) {
    $_SESSION['tasks'][] = ['judul' => $judul, 'status' => 'belum'];
}

// Fungsi untuk menghapus tugas berdasarkan index-nya
function hapusTugas($index) {
    unset($_SESSION['tasks'][$index]);
    $_SESSION['tasks'] = array_values($_SESSION['tasks']);
}

// Fungsi untuk mengubah status tugas (belum ⇄ selesai)
function toggleStatus($index) {
    if ($_SESSION['tasks'][$index]['status'] === 'belum') {
        $_SESSION['tasks'][$index]['status'] = 'selesai';
    } else {
        $_SESSION['tasks'][$index]['status'] = 'belum';
    }
}

// Fungsi untuk mengedit judul tugas berdasarkan index
function editTugas($index, $judulBaru) {
    $_SESSION['tasks'][$index]['judul'] = $judulBaru;
}