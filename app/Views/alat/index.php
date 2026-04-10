<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Alat</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>

<body class="bg-light">

<?= $this->include('layouts/navbar') ?>

<div class="container">

    <div class="card shadow fade-in">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Alat</h5>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-sm btn-secondary">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div class="card-body">

            <!-- Form Pencarian dan Tombol Tambah -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="get" action="<?= base_url('alat') ?>" class="row g-2">
                        <div class="col-md-8">
                            <input type="text" name="keyword" class="form-control"
                                placeholder="Cari alat..."
                                value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">
                                Cari
                            </button>
                        </div>

                        <div class="col-auto">
                            <a href="<?= base_url('alat') ?>" class="btn btn-secondary">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-6 text-end">
                    <?php if (session('role') === 'Admin'): ?>
                        <a href="<?= base_url('alat/create') ?>" class="btn btn-success">
                            Tambah Alat
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alat</th>
                            <th>Kategori</th>
                            <th>Merek</th>
                            <th>Kondisi</th>
                            <th>Deskripsi Alat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; foreach ($alat as $a): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($a['nama_alat']) ?></td>
                            <td><?= esc($a['nama_category'] ?? '-') ?></td>
                            <td><?= esc($a['merk_alat']) ?></td>
                            <td><?= esc($a['kondisi']) ?></td>
                            <td><?= esc($a['deskripsi_alat']) ?></td>

                            <td>
                                <?php if ($a['status'] == 'Tersedia'): ?>
                                    <span class="badge bg-success">Tersedia</span>
                                <?php elseif ($a['status'] == 'Dibooking'): ?>
                                    <span class="badge bg-warning">Dibooking</span>
                                <?php elseif ($a['status'] == 'Dipinjam'): ?>
                                    <span class="badge bg-danger">Dipinjam</span>
                                <?php elseif ($a['status'] == 'Tidak Tersedia'): ?>
                                    <span class="badge bg-secondary">Tidak Tersedia</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?= esc($a['status']) ?></span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if (session('role') === 'Admin'): ?>

                                    <a href="<?= base_url('alat/edit/'.$a['id_alat']) ?>"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <a href="<?= base_url('alat/delete/'.$a['id_alat']) ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin hapus alat?')">
                                        Hapus
                                    </a>

                                <?php elseif (session('role') === 'Peminjam' && $a['status'] == 'Tersedia'): ?>

                                    <a href="<?= base_url('peminjaman/create/'.$a['id_alat']) ?>"
                                       class="btn btn-sm btn-primary">
                                        Pinjam
                                    </a>

                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="card-footer text-end">
            <small class="text-muted">
                Manajemen data alat
            </small>
        </div>

    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
