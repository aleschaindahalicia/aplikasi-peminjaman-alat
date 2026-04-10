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
            <h5 class="mb-0">Tambah Alat</h5>
        </div>

        <div class="card-body">

            <form action="<?= base_url('alat/store') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label">Nama Alat</label>
                    <input type="text" name="nama_alat" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="id_category" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach($category as $c) : ?>
                            <option value="<?= $c['id_category'] ?>">
                                <?= esc($c['nama_category']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Merk Alat</label>
                    <input type="text" name="merk_alat" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kondisi <span class="text-danger">*</span></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="kondisi" class="form-check-input" value="Baik" id="kondisiBaik">
                            <label class="form-check-label" for="kondisiBaik">Baik</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="kondisi" class="form-check-input" value="Rusak Ringan" id="kondisiRusakRingan">
                            <label class="form-check-label" for="kondisiRusakRingan">Rusak Ringan</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="kondisi" class="form-check-input" value="Rusak Berat" id="kondisiRusakBerat">
                            <label class="form-check-label" for="kondisiRusakBerat">Rusak Berat</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Alat</label>
                    <textarea name="deskripsi_alat" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="status" class="form-check-input" value="Tersedia" id="statusTersedia" checked>
                            <label class="form-check-label" for="statusTersedia">Tersedia</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="status" class="form-check-input" value="Tidak Tersedia" id="statusTidakTersedia">
                            <label class="form-check-label" for="statusTidakTersedia">Tidak Tersedia</label>
                        </div>
                    </div>
                    <div class="form-text">
                        <small class="text-muted">
                            Status "Dibooking" dan "Dipinjam" akan otomatis diatur oleh sistem. 
                            Alat dengan kondisi "Rusak Berat" akan otomatis berstatus "Tidak Tersedia"
                        </small>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="<?= base_url('/alat') ?>" class="btn btn-secondary">
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
