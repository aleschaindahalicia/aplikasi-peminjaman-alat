<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar User</title>

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

    <div class="card shadow fade-in mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Daftar User</h5>
        </div>

        <div class="card-body">

            <!-- Form Pencarian dan Tombol Tambah -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <form method="get" action="<?= base_url('user') ?>" class="row g-2">
                        <div class="col-md-8">
                            <input type="text" name="keyword" class="form-control"
                                placeholder="Cari nama atau email..."
                                value="<?= isset($_GET['keyword']) ? esc($_GET['keyword']) : '' ?>">
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>

                        <div class="col-auto">
                            <a href="<?= base_url('user') ?>" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                </div>
                
                <div class="col-md-4 text-end">
                    <a href="<?= base_url('user/create') ?>" class="btn btn-success">
                        Tambah User
                    </a>
                </div>
            </div>

            <!-- Tabel Data User -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; foreach($user as $u): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($u['nama_user']) ?></td>
                            <td><?= esc($u['email']) ?></td>
                            <td><?= esc($u['no_hp']) ?></td>
                            <td><?= esc($u['alamat']) ?></td>
                            <td>
                                <span class="badge bg-<?= $u['role'] == 'Admin' ? 'danger' : ($u['role'] == 'Petugas' ? 'warning' : 'primary') ?>">
                                    <?= esc($u['role']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('user/edit/'.$u['id_user']) ?>"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="<?= base_url('user/delete/'.$u['id_user']) ?>"
                                   onclick="return confirm('Yakin hapus user ini?')"
                                   class="btn btn-sm btn-danger">
                                    Hapus
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
                Manajemen data user
            </small>
        </div>

    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>