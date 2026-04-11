<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Saya</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>

<body class="bg-light">

<?= $this->include('layouts/navbar') ?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

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
                    <h5 class="mb-0 text-white">Informasi Profile</h5>
                </div>

                <div class="card-body">

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="text-center">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="text-white" style="font-size: 2rem;">👤</i>
                                </div>
                                <h6 class="mt-2 mb-0"><?= esc($user['nama_user']) ?></h6>
                                <small class="text-muted"><?= esc($user['role']) ?></small>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%" class="text-muted">Email</th>
                                    <td><?= esc($user['email']) ?></td>
                                </tr>

                                <tr>
                                    <th class="text-muted">Nama Lengkap</th>
                                    <td><?= esc($user['nama_user']) ?: '-' ?></td>
                                </tr>

                                <tr>
                                    <th class="text-muted">No HP</th>
                                    <td><?= esc($user['no_hp']) ?: '-' ?></td>
                                </tr>

                                <tr>
                                    <th class="text-muted">Alamat</th>
                                    <td><?= esc($user['alamat']) ?: '-' ?></td>
                                </tr>

                                <tr>
                                    <th class="text-muted">Role</th>
                                    <td>
                                        <span class="badge bg-<?= $user['role'] == 'Admin' ? 'danger' : ($user['role'] == 'Petugas' ? 'warning' : 'primary') ?>">
                                            <?= esc($user['role']) ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="<?= base_url('profile/edit') ?>" class="btn btn-primary">
                            Edit Profile
                        </a>
                    </div>

                </div>

                <div class="card-footer text-end">
                    <small class="text-muted">
                        Informasi profile pengguna
                    </small>
                </div>

            </div>

        </div>
    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>