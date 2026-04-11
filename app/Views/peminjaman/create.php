<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pinjam Alat</title>

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
                            <h5 class="mb-0 text-white">Form Peminjaman Alat</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <!-- Detail Alat -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="text-center">
                                <div class="bg-primary rounded d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                    <i class="text-white" style="font-size: 3rem;">🔧</i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <h5 class="text-primary mb-3"><?= esc($alat['nama_alat']) ?></h5>
                            
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%" class="text-muted">Merk</th>
                                    <td><?= esc($alat['merk_alat']) ?></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Kondisi</th>
                                    <td><?= esc($alat['kondisi']) ?></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Deskripsi</th>
                                    <td><?= esc($alat['deskripsi_alat']) ?></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Status</th>
                                    <td>
                                        <span class="badge bg-success">Tersedia</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <form action="<?= base_url('peminjaman/store') ?>" method="post">
                        <?= csrf_field() ?>

                        <input type="hidden" name="id_alat" value="<?= $alat['id_alat'] ?>">

                        <div class="alert alert-info">
                            <h6 class="alert-heading">Konfirmasi Peminjaman</h6>
                            <p class="mb-0">Apakah Anda yakin ingin meminjam alat <strong><?= esc($alat['nama_alat']) ?></strong>?</p>
                            <hr>
                            <small class="mb-0">
                                • Alat akan berstatus "Dibooking" setelah pengajuan<br>
                                • Menunggu persetujuan dari petugas<br>
                                • Anda akan mendapat notifikasi status peminjaman
                            </small>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                Ajukan Peminjaman
                            </button>

                            <a href="<?= base_url('alat') ?>" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>

                <div class="card-footer text-end">
                    <small class="text-muted">
                        Form pengajuan peminjaman alat
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