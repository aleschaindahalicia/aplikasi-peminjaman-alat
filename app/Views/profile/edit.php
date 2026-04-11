<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>

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
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0 text-white">Edit Profile</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form action="<?= base_url('profile/update') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           value="<?= esc($user['email']) ?>"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text"
                                           name="nama_user"
                                           class="form-control"
                                           value="<?= esc($user['nama_user']) ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text"
                                   name="no_hp"
                                   class="form-control"
                                   value="<?= esc($user['no_hp']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat"
                                      class="form-control"
                                      rows="3"><?= esc($user['alamat']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-select" disabled>
                                <option value="Admin" <?= $user['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="Petugas" <?= $user['role'] == 'Petugas' ? 'selected' : '' ?>>Petugas</option>
                                <option value="Peminjam" <?= $user['role'] == 'Peminjam' ? 'selected' : '' ?>>Peminjam</option>
                            </select>
                            <div class="form-text">
                                <small class="text-muted">Role tidak dapat diubah. Hubungi admin untuk perubahan role.</small>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>

                            <a href="<?= base_url('profile') ?>" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>

                <div class="card-footer text-end">
                    <small class="text-muted">
                        Form edit informasi profile
                    </small>
                </div>

            </div>

            <!-- Card Ubah Password -->
            <div class="card shadow fade-in mt-4">
                <div class="card-header">
                    <h5 class="mb-0">🔒 Ubah Password</h5>
                </div>

                <div class="card-body">

                    <form action="<?= base_url('profile/update-password') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Password Lama <span class="text-danger">*</span></label>
                            <input type="password" name="old_password" class="form-control" required>
                            <div class="form-text">
                                <small class="text-muted">Masukkan password lama Anda</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Password Baru <span class="text-danger">*</span></label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                    <div class="form-text">
                                        <small class="text-muted">Masukkan ulang password baru</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h6 class="alert-heading">ℹ️ Informasi</h6>
                            <ul class="mb-0">
                                <li>Gunakan kombinasi huruf dan angka untuk keamanan lebih baik</li>
                            </ul>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-warning">
                                Ubah Password
                            </button>
                        </div>

                    </form>

                </div>

                <div class="card-footer text-end">
                    <small class="text-muted">
                        Ubah password untuk keamanan akun Anda
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