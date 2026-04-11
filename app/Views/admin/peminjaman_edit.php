<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status Peminjaman</title>

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
            <h5 class="mb-0 text-white">Edit Status Peminjaman</h5>
        </div>

        <div class="card-body">

            <!-- Detail Peminjaman -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%" class="text-muted">ID Peminjaman</th>
                            <td><?= esc($edit['id_peminjaman']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Nama Alat</th>
                            <td><?= esc($edit['nama_alat']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Peminjam</th>
                            <td><?= esc($edit['email']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Tanggal Pinjam</th>
                            <td><?= esc($edit['tanggal_pinjam']) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted">Status Saat Ini</th>
                            <td>
                                <span class="badge bg-<?= $edit['status'] == 'Menunggu' ? 'warning' : ($edit['status'] == 'Dipinjam' ? 'primary' : ($edit['status'] == 'Ditolak' ? 'danger' : 'success')) ?>">
                                    <?= esc($edit['status']) ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <form action="<?= base_url('admin/peminjaman/update/'.$edit['id_peminjaman']) ?>" method="post">
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="Menunggu" <?= $edit['status']=='Menunggu'?'selected':'' ?>>Menunggu</option>
                        <option value="Dipinjam" <?= $edit['status']=='Dipinjam'?'selected':'' ?>>Dipinjam</option>
                        <option value="Ditolak" <?= $edit['status']=='Ditolak'?'selected':'' ?>>Ditolak</option>
                        <option value="Dikembalikan" <?= $edit['status']=='Dikembalikan'?'selected':'' ?>>Dikembalikan</option>
                    </select>
                </div>

                <!-- Textarea Alasan Penolakan -->
                <div class="mb-3" id="alasanDiv" style="display: <?= $edit['status']=='Ditolak'?'block':'none' ?>">
                    <label for="alasan_penolakan" class="form-label">Alasan Penolakan</label>
                    <textarea class="form-control" name="alasan_penolakan" id="alasan_penolakan"><?= esc($edit['alasan_penolakan']) ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

            <script>
            document.getElementById('status').addEventListener('change', function() {
                document.getElementById('alasanDiv').style.display = this.value === 'Ditolak' ? 'block' : 'none';
            });
            </script>

        </div>

        <div class="card-footer text-end">
            <small class="text-muted">
                Form edit status peminjaman
            </small>
        </div>

    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>