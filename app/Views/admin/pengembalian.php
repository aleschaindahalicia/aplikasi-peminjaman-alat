<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pengembalian</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>

<body class="bg-light">

<?= $this->include('layouts/navbar') ?>

<div class="container">

    <div class="card shadow fade-in">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Pengembalian</h5>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-sm btn-secondary">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Alat</th>
                            <th>Email Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($pengembalian as $p): ?>
                        <tr>
                            <td><?= $p['id_peminjaman'] ?></td>
                            <td><?= esc($p['nama_alat']) ?></td>
                            <td><?= esc($p['email']) ?></td>
                            <td><?= date('d/m/Y', strtotime($p['tanggal_pinjam'])) ?></td>
                            <td>
                                <span class="badge bg-warning"><?= esc($p['status']) ?></span>
                            </td>
                            <td>
                                <a href="<?= base_url('petugas/validasi/'.$p['id_peminjaman']) ?>" class="btn btn-sm btn-primary">
                                    Validasi Pengembalian
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-end">
            <small class="text-muted">
                Manajemen data pengembalian alat
            </small>
        </div>
    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>