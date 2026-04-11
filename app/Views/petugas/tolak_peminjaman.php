<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tolak Peminjaman</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>

<body class="bg-light">

<?= $this->include('layouts/navbar') ?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif ?>

            <div class="card shadow fade-in">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white">⚠️ Tolak Peminjaman</h5>
                </div>

                <div class="card-body">

                    <div class="alert alert-warning">
                        <h6 class="alert-heading">Informasi Peminjaman</h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <th width="40%">Nama Alat</th>
                                <td><?= esc($peminjaman['nama_alat']) ?></td>
                            </tr>
                            <tr>
                                <th>Peminjam</th>
                                <td><?= esc($peminjaman['email']) ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pinjam</th>
                                <td><?= date('d/m/Y', strtotime($peminjaman['tanggal_pinjam'])) ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span class="badge bg-warning"><?= esc($peminjaman['status']) ?></span></td>
                            </tr>
                        </table>
                    </div>

                    <form action="<?= base_url('petugas/proses-tolak/'.$peminjaman['id_peminjaman']) ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea name="alasan_penolakan" class="form-control" rows="4" required placeholder="Masukkan alasan mengapa peminjaman ditolak..."></textarea>
                        </div>

                        <div class="alert alert-danger">
                            <strong>Perhatian:</strong> Setelah ditolak, status alat akan kembali menjadi "Tersedia" dan peminjam akan melihat alasan penolakan.
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-danger">
                                Tolak Peminjaman
                            </button>

                            <a href="<?= base_url('petugas/peminjaman') ?>" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>

                <div class="card-footer text-end">
                    <small class="text-muted">
                        Form penolakan peminjaman alat
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
