<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengembalian Alat</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?= $this->include('layouts/navbar') ?>

<div class="container">

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Daftar Pengembalian</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Alat</th>
                            <th>Email Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($pengembalian as $p): ?>
                        <tr>
                            <td><?= $p['id_peminjaman'] ?></td>
                            <td><?= $p['nama_alat'] ?></td>
                            <td><?= $p['email'] ?></td>
                            <td><?= $p['tanggal_pinjam'] ?></td>
                            <td><?= $p['tanggal_kembali'] ?></td>

                            <td>
                                <?php if ($p['status'] == 'Menunggu Pengembalian'): ?>
                                    <span class="badge bg-warning text-dark">Menunggu Pengembalian</span>

                                <?php elseif ($p['status'] == 'Dikembalikan'): ?>
                                    <span class="badge bg-success">Dikembalikan</span>

                                <?php else: ?>
                                    <span class="badge bg-secondary"><?= $p['status'] ?></span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if ($p['status'] == 'Menunggu Pengembalian'): ?>
                                    
                                    <a href="<?= base_url('petugas/validasi/'.$p['id_peminjaman']) ?>" 
                                       class="btn btn-sm btn-primary">
                                       Validasi
                                    </a>

                                <?php elseif ($p['status'] == 'Dikembalikan'): ?>

                                    <a href="<?= base_url('petugas/laporan/pengembalian/'.$p['id_peminjaman']) ?>" 
                                       class="btn btn-sm btn-success"
                                       target="_blank">
                                       Cetak Laporan
                                    </a>

                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>