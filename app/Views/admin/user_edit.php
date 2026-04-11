<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

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
            <h5 class="mb-0 text-white">Edit User: <?= esc($editUser['nama_user']) ?></h5>
        </div>

        <div class="card-body">

            <form action="<?= base_url('user/update/'.$editUser['id_user']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama_user"
                                value="<?= esc($editUser['nama_user']) ?>"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                value="<?= esc($editUser['email']) ?>"
                                class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Password (kosongkan jika tidak ingin diganti)
                            </label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp"
                                value="<?= esc($editUser['no_hp']) ?>"
                                class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"><?= esc($editUser['alamat']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role <span class="text-danger">*</span></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="role" class="form-check-input" value="Admin" id="editRoleAdmin" <?= $editUser['role']=='Admin'?'checked':'' ?>>
                            <label class="form-check-label" for="editRoleAdmin">Admin</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="role" class="form-check-input" value="Petugas" id="editRolePetugas" <?= $editUser['role']=='Petugas'?'checked':'' ?>>
                            <label class="form-check-label" for="editRolePetugas">Petugas</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="role" class="form-check-input" value="Peminjam" id="editRolePeminjam" <?= $editUser['role']=='Peminjam'?'checked':'' ?>>
                            <label class="form-check-label" for="editRolePeminjam">Peminjam</label>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="<?= base_url('/user') ?>" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>

        <div class="card-footer text-end">
            <small class="text-muted">
                Form edit data user
            </small>
        </div>

    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>