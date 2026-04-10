<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Petugas</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>

<body class="bg-light">

<?= $this->include('layouts/navbar') ?>

<div class="container">

    <!-- Welcome Card -->
    <div class="card dashboard-card shadow fade-in mb-4">
        <div class="card-body">
            <h3 class="card-title">Dashboard Petugas</h3>

            <p class="card-text">
                Selamat datang,
                <strong><?= explode('@', session()->get('email'))[0] ?></strong>
            </p>

            <p class="card-text">
                Login sebagai:
                <span class="badge bg-success">
                    <?= session()->get('role') ?>
                </span>
            </p>
        </div>
    </div>

    <div class="row">

        <!-- Menu Utama -->
        <div class="col-md-6 mb-3">
            <div class="card dashboard-card shadow fade-in">
                <div class="card-header">
                    Menu Petugas
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="<?= base_url('alat') ?>" class="text-decoration-none">
                            Kelola Data Alat
                        </a>
                    </li>

                    <li class="list-group-item">
                        <a href="<?= base_url('petugas/peminjaman') ?>" class="text-decoration-none">
                            Data Peminjaman
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <!-- Profil -->
        <div class="col-md-6 mb-3">
            <div class="card dashboard-card shadow fade-in">
                <div class="card-header">
                    Profil
                </div>

                <div class="card-body">
                    <p>
                        Role:
                        <strong><?= session()->get('role') ?></strong>
                    </p>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>