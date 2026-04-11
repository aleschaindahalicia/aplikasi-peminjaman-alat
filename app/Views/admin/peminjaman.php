<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Peminjaman</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>

<body class="bg-light">

<?= $this->include('layouts/navbar') ?>

<div class="container">

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif ?>

    <div class="card shadow fade-in">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Data Peminjaman</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <form method="get" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari apa aja... (alat, kategori, user, status)"
                            value="<?= $_GET['search'] ?? '' ?>">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </form>
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Alat</th>
                            <th>Merk</th>
                            <th>Kategori</th>
                            <th>Peminjam</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Alasan Penolakan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (empty($peminjaman)): ?>
                        <tr>
                            <td colspan="10" class="text-center text-muted">
                                Belum ada data peminjaman
                            </td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($peminjaman as $p): ?>
                            <tr>
                                <td><?= esc($p['id_peminjaman']) ?></td>
                                <td><?= esc($p['nama_alat']) ?></td>
                                <td><?= esc($p['merk_alat']) ?></td>
                                <td><?= esc($p['nama_category']) ?></td>

                                <td>
                                    <?= esc($p['nama_user']) ?><br>
                                    <small class="text-muted"><?= esc($p['email']) ?></small>
                                </td>

                                <td><?= esc($p['tanggal_pinjam']) ?></td>
                                <td><?= esc($p['tanggal_kembali']) ?: '-' ?></td>

                                <td>
                                    <?php
                                    $badgeClass = match($p['status']) {
                                        'Menunggu' => 'bg-warning',
                                        'Dipinjam' => 'bg-primary',
                                        'Ditolak' => 'bg-danger',
                                        'Dikembalikan' => 'bg-success',
                                        'Dibooking' => 'bg-info',
                                        'Menunggu Pengembalian' => 'bg-secondary',
                                        default => 'bg-secondary',
                                    };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>">
                                        <?= esc($p['status']) ?>
                                    </span>
                                </td>

                                <td><?= esc($p['alasan_penolakan']) ?: '-' ?></td>

                                <td>
                                    <a href="<?= base_url('admin/peminjaman/edit/'.$p['id_peminjaman']) ?>"
                                    class="btn btn-sm btn-warning">
                                        Edit Status
                                    </a>

                                    <a href="<?= base_url('admin/peminjaman/delete/'.$p['id_peminjaman']) ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin hapus peminjaman ini?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>

        <div class="card-footer text-end">
            <small class="text-muted">
                Manajemen data peminjaman alat
            </small>
        </div>

    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
