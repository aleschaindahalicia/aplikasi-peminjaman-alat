<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola User</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?= $this->include('layouts/navbar') ?>

<div class="container">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 text-white">Daftar User</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($user as $u): ?>
                        <tr>
                            <td><?= $u['id_user'] ?></td>
                            <td><?= $u['email'] ?></td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    <?= $u['role'] ?>
                                </span>
                            </td>

                            <td>
                                <a href="#"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <a href="#"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin hapus?')">
                                    Hapus
                                </a>
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
