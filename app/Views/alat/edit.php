<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Alat</title>

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
            <h5 class="mb-0">Edit Data Alat</h5>
        </div>

        <div class="card-body">

            <form action="<?= base_url('alat/update/' . $alat['id_alat']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Alat <span class="text-danger">*</span></label>
                            <input type="text" name="nama_alat"
                                class="form-control"
                                value="<?= esc($alat['nama_alat']) ?>"
                                required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="id_category" class="form-select" required>
                                <?php foreach ($category as $c): ?>
                                    <option value="<?= $c['id_category'] ?>"
                                        <?= $alat['id_category'] == $c['id_category'] ? 'selected' : '' ?>>
                                        <?= esc($c['nama_category']) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Merk Alat</label>
                            <input type="text" name="merk_alat"
                                class="form-control"
                                value="<?= esc($alat['merk_alat']) ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kondisi <span class="text-danger">*</span></label>
                            <select name="kondisi" class="form-select" required>
                                <option value="Baik" <?= $alat['kondisi'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
                                <option value="Rusak Ringan" <?= $alat['kondisi'] == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
                                <option value="Rusak Berat" <?= $alat['kondisi'] == 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Alat</label>
                    <textarea name="deskripsi_alat" class="form-control" rows="3"><?= esc($alat['deskripsi_alat']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="Tersedia" <?= $alat['status'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                        <option value="Tidak Tersedia" <?= $alat['status'] == 'Tidak Tersedia' ? 'selected' : '' ?>>Tidak Tersedia</option>
                    </select>
                    <div class="form-text">
                        <small class="text-muted">
                            <strong>Tersedia:</strong> Alat dapat dipinjam | 
                            <strong>Tidak Tersedia:</strong> Alat tidak dapat digunakan (otomatis untuk kondisi Rusak Berat)
                        </small>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="<?= base_url('/alat') ?>" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>

        <div class="card-footer text-end">
            <small class="text-muted">
                Form perubahan data alat
            </small>
        </div>

    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>