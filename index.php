<?php
session_start();
include 'functions.php';

$editIndex = isset($_GET['edit']) ? (int)$_GET['edit'] : -1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tambah'])) {
        tambahTugas($_POST['judul']);
    } elseif (isset($_POST['hapus'])) {
        hapusTugas($_POST['hapus']);
    } elseif (isset($_POST['toggle'])) {
        toggleStatus($_POST['toggle']);
    } elseif (isset($_POST['save'])) {
        editTugas($_POST['index'], $_POST['judul_baru']);
    }
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ToDo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="text-center mb-4">📝 ToDo List</h1>

    <!-- Form Tambah -->
    <form method="post" class="d-flex gap-2 mb-4">
        <input type="text" name="judul" class="form-control" placeholder="Tulis tugas baru..." required>
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
    </form>

    <!-- Daftar Tugas -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Status</th>
                    <th>Judul Tugas</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                <tr>
                    <!-- Toggle Status -->
                    <td class="text-center">
                        <form method="post">
                            <input type="hidden" name="toggle" value="<?= $index ?>">
                            <input type="checkbox" onchange="this.form.submit()" <?= $task['status'] === 'selesai' ? 'checked' : '' ?>>
                        </form>
                    </td>

                    <!-- Edit Tugas -->
                    <td>
                        <?php if ($editIndex === $index): ?>
                            <form method="post" class="d-flex gap-2">
                                <input type="hidden" name="index" value="<?= $index ?>">
                                <input type="text" name="judul_baru" class="form-control" value="<?= htmlspecialchars($task['judul']) ?>" required>
                                <button type="submit" name="save" class="btn btn-warning">Save</button>
                                <a href="index.php" class="btn btn-secondary">Batal</a>
                            </form>
                        <?php else: ?>
                            <span class="<?= $task['status'] === 'selesai' ? 'text-decoration-line-through text-muted' : '' ?>">
                                <?= htmlspecialchars($task['judul']) ?>
                            </span>
                        <?php endif; ?>
                    </td>

                    <!-- Status Badge -->
                    <td>
                        <span class="badge bg-warning text-dark">
                            <?= $task['status'] === 'selesai' ? 'Selesai' : 'Belum selesai' ?>
                        </span>
                    </td>

                    <!-- Tombol Aksi -->
                    <td>
                        <div class="d-flex gap-2">
                            <form method="post">
                                <button type="submit" name="hapus" value="<?= $index ?>" class="btn btn-danger btn-sm">🗑 Hapus</button>
                            </form>
                            <?php if ($editIndex !== $index): ?>
                            <form method="get">
                                <input type="hidden" name="edit" value="<?= $index ?>">
                                <button type="submit" class="btn btn-secondary btn-sm">✏️ Edit</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
