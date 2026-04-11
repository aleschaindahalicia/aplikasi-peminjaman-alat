<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Alat</title>

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
            <h5 class="mb-0 text-white">Tambah Kategori</h5>
        </div>

        <div class="card-body">

            <form action="<?= base_url('category/store') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_category" class="form-control" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="<?= base_url('/category') ?>" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>

        <div class="card-footer text-end">
            <small class="text-muted">
                Form penambahan data alat baru
            </small>
        </div>

    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
