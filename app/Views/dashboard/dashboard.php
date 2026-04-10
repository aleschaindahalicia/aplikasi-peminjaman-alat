<h2>Dashboard</h2>

<div style="display:flex; gap:20px; margin-bottom:20px;">
    <div style="border:1px solid #ccc; padding:15px;">
        <h3>Total Alat</h3>
        <p><?= $totalAlat ?></p>
    </div>

    <div style="border:1px solid #ccc; padding:15px;">
        <h3>Total Kategori</h3>
        <p><?= $totalKategori ?></p>
    </div>

    <div style="border:1px solid #ccc; padding:15px;">
        <h3>Alat Tersedia</h3>
        <p><?= $alatTersedia ?></p>
    </div>

    <div style="border:1px solid #ccc; padding:15px;">
        <h3>Alat Dipinjam</h3>
        <p><?= $alatDipinjam ?></p>
    </div>
</div>

<a href="<?= base_url('/') ?>">➡️ Kelola Data Alat</a>