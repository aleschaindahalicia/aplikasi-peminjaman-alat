<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Alat</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>

<body class="bg-light">

<?= $this->include('layouts/navbar') ?>

<div class="container">

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    
    <div class="card shadow fade-in">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Kategori Alat</h5>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-sm btn-secondary">
                Kembali ke Dashboard
            </a>
        </div>

        <div class="card-body">

            <!-- Form Pencarian dan Tombol Tambah -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <?php if (session()->get('role') == 'Admin'): ?>
                        <a href="<?= base_url('category/create') ?>" class="btn btn-primary">Tambah</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <?php if (session('role') === 'Admin'): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($category as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <td><?= $row['nama_category'] ?></td>

                            
                            <?php if (session()->get('role') == 'Admin'): ?>
                            <td>
                                <a href="<?= base_url('category/edit/' . $row['id_category']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= base_url('category/delete/' . $row['id_category']) ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                            <?php endif; ?>
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
