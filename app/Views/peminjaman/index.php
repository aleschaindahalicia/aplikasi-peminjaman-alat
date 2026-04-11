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
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0 text-white">Data Peminjaman Saya</h5>
                </div>
                <div class="col-auto">
                </div>
            </div>
        </div>

        <div class="card-body">

            <!-- Form Pencarian -->
            <form method="get" action="<?= base_url('peminjaman') ?>" class="row g-2 mb-4">
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Cari nama alat..."
                        value="<?= isset($_GET['keyword']) ? esc($_GET['keyword']) : '' ?>">
                </div>

                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">
                        Cari
                    </button>
                </div>

                <div class="col-md-auto">
                    <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Alat</th>
                            <th>Status</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (empty($peminjaman)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Belum ada data peminjaman
                            </td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($peminjaman as $p): ?>
                            <tr>
                                <td><?= esc($p['id_peminjaman']) ?></td>
                                <td><?= esc($p['nama_alat']) ?></td>

                                <td>
                                    <?php if ($p['status'] == 'Dipinjam'): ?>
                                        <span class="badge bg-warning">Dipinjam</span>

                                    <?php elseif ($p['status'] == 'Menunggu'): ?>
                                        <span class="badge bg-info">Menunggu Persetujuan</span>

                                    <?php elseif ($p['status'] == 'Dibooking'): ?>
                                        <span class="badge bg-primary">Sedang Dibooking</span>

                                    <?php elseif ($p['status'] == 'Menunggu Pengembalian'): ?>
                                        <span class="badge bg-secondary">Menunggu Validasi Petugas</span>

                                    <?php elseif ($p['status'] == 'Dikembalikan'): ?>
                                        <span class="badge bg-success">Selesai</span>

                                    <?php elseif ($p['status'] == 'Ditolak'): ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                        <?php if (!empty($p['alasan_penolakan'])): ?>
                                            <br>
                                            <small class="text-muted" style="font-weight: normal;">
                                                <?= esc($p['alasan_penolakan']) ?>
                                            </small>
                                        <?php endif; ?>

                                    <?php else: ?>
                                        <span class="badge bg-secondary">
                                            <?= esc($p['status']) ?>
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td><?= esc($p['tanggal_pinjam']) ?></td>
                                <td><?= esc($p['tanggal_kembali']) ?: '-' ?></td>

                                <td>
                                    <?php if ($p['status'] == 'Dipinjam'): ?>
                                        <a href="<?= base_url('peminjaman/kembalikan/'.$p['id_peminjaman']) ?>"
                                           class="btn btn-sm btn-primary"
                                           onclick="return confirm('Yakin ingin mengajukan pengembalian?')">
                                            Ajukan Pengembalian
                                        </a>

                                    <?php elseif ($p['status'] == 'Menunggu'): ?>
                                        <span class="text-muted">
                                            Menunggu Persetujuan
                                        </span>

                                    <?php elseif ($p['status'] == 'Dibooking'): ?>
                                        <span class="text-muted">
                                            Sedang Dibooking
                                        </span>

                                    <?php elseif ($p['status'] == 'Menunggu Pengembalian'): ?>
                                        <span class="text-muted">
                                            Menunggu Validasi Petugas
                                        </span>

                                    <?php elseif ($p['status'] == 'Dikembalikan'): ?>
                                        <span class="text-success">
                                            ✓ Selesai
                                        </span>

                                    <?php elseif ($p['status'] == 'Ditolak'): ?>
                                        <span class="text-danger">
                                            ✗ Ditolak
                                        </span>
                                        <?php if (!empty($p['alasan_penolakan'])): ?>
                                            <br>
                                            <small class="text-muted">
                                                <strong>Alasan:</strong> <?= esc($p['alasan_penolakan']) ?>
                                            </small>
                                        <?php endif; ?>

                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
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
                Riwayat peminjaman alat Anda
            </small>
        </div>

    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
