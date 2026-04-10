<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('/dashboard') ?>">Sistem Peminjaman</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/dashboard') ?>">
                         Dashboard
                    </a>
                </li>

                <!-- Menu untuk semua role -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('alat') ?>">
                         Daftar Alat
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('category') ?>">
                         Daftar Kategori
                    </a>
                </li>

                <!-- Menu khusus Admin -->
                <?php if (session('role') === 'Admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/user') ?>">
                            Kelola User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/peminjaman') ?>">
                             Data Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('activity-log') ?>">
                             Activity Log
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Menu khusus Petugas -->
                <?php if (session('role') === 'Petugas'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('petugas/peminjaman') ?>">
                             Data Peminjaman
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Menu khusus Peminjam -->
                <?php if (session('role') === 'Peminjam'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('peminjaman') ?>">
                             Peminjaman Saya
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="ms-auto">
                <!-- User Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2">👤 <?= explode('@', session()->get('email'))[0] ?></span>
                        <span class="badge bg-success"><?= session()->get('role') ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <h6 class="dropdown-header">
                                Selamat datang, <?= explode('@', session()->get('email'))[0] ?>
                            </h6>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('/profile') ?>">
                                 Profile Saya
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="<?= base_url('/logout') ?>">
                                 Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>