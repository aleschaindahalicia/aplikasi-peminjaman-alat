<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengembalian Alat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            font-size: 13px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 10px;
        }

        .info-section {
            margin: 30px 0;
            border: 2px solid #333;
            padding: 20px;
        }

        .info-row {
            display: flex;
            margin-bottom: 12px;
        }

        .info-label {
            width: 200px;
            font-weight: bold;
        }

        .info-value {
            flex: 1;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }

        .signature {
            text-align: center;
            width: 250px;
        }

        .signature-line {
            margin-top: 70px;
            border-top: 2px solid #333;
            padding-top: 5px;
        }

        .no-print {
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
            }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
            🖨️ Cetak Laporan
        </button>
    </div>

    <div class="header">
        <h1>LAPORAN PENGEMBALIAN ALAT</h1>
        <h2>Sistem Peminjaman Alat</h2>
        <p>Dicetak pada: <?= date('d F Y, H:i') ?> WIB</p>
    </div>

    <div class="info-section">
        <h3 style="margin-bottom: 20px; text-align: center; text-decoration: underline;">DETAIL PENGEMBALIAN</h3>
        
        <div class="info-row">
            <div class="info-label">ID Peminjaman</div>
            <div class="info-value">: <?= esc($pengembalian['id_peminjaman']) ?></div>
        </div>

        <div class="info-row">
            <div class="info-label">Nama Alat</div>
            <div class="info-value">: <?= esc($pengembalian['nama_alat']) ?></div>
        </div>

        <div class="info-row">
            <div class="info-label">Nama Peminjam</div>
            <div class="info-value">: <?= esc($pengembalian['email']) ?></div>
        </div>

        <div class="info-row">
            <div class="info-label">Tanggal Peminjaman</div>
            <div class="info-value">: <?= date('d F Y', strtotime($pengembalian['tanggal_pinjam'])) ?></div>
        </div>

        <div class="info-row">
            <div class="info-label">Tanggal Pengembalian</div>
            <div class="info-value">: <?= $pengembalian['tanggal_kembali'] ? date('d F Y', strtotime($pengembalian['tanggal_kembali'])) : '-' ?></div>
        </div>

        <div class="info-row">
            <div class="info-label">Lama Peminjaman</div>
            <div class="info-value">: 
                <?php 
                if ($pengembalian['tanggal_kembali']) {
                    $tgl_pinjam = new DateTime($pengembalian['tanggal_pinjam']);
                    $tgl_kembali = new DateTime($pengembalian['tanggal_kembali']);
                    $diff = $tgl_pinjam->diff($tgl_kembali);
                    echo $diff->days . ' hari';
                } else {
                    echo '-';
                }
                ?>
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">Status</div>
            <div class="info-value">: <span class="status-badge"><?= esc($pengembalian['status']) ?></span></div>
        </div>
    </div>

    <div style="margin-top: 30px; padding: 15px; background-color: #f8f9fa; border-left: 4px solid #28a745;">
        <p style="margin: 0;"><strong>Catatan:</strong></p>
        <p style="margin: 5px 0 0 0;">Alat telah dikembalikan dalam kondisi baik dan telah divalidasi oleh petugas.</p>
    </div>

    <div class="footer">
        <div class="signature">
            <p>Mengetahui,</p>
            <p><strong>Kepala Bagian</strong></p>
            <div class="signature-line">
                <p>(...........................)</p>
            </div>
        </div>

        <div class="signature">
            <p>Petugas yang Memvalidasi,</p>
            <div class="signature-line">
                <p><strong><?= esc(session()->get('email')) ?></strong></p>
            </div>
        </div>
    </div>

</body>
</html>
