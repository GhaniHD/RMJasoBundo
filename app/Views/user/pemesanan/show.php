<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Detail Pesanan</h1>
        <div class="card">
            <div class="card-header">
                No. Pesanan: <?= esc($pesanan['no_pesanan']); ?>
            </div>
            <div class="card-body">
                <h5 class="card-title">ID User: <?= esc($pesanan['id_user']); ?></h5>
                <p class="card-text">Kode Menu: <?= esc($pesanan['kd_menu']); ?></p>
                <p class="card-text">Tanggal Pesan: <?= esc($pesanan['tgl_pesan']); ?></p>
                <p class="card-text">Tanggal Ambil: <?= esc($pesanan['tgl_ambil']); ?></p>
                <p class="card-text">Status Pesanan: <?= esc($pesanan['status_pesanan']); ?></p>
                <p class="card-text">Status Pembayaran: <?= esc($pesanan['status_pembayaran']); ?></p>
                <p class="card-text">Metode Pengambilan: <?= esc($pesanan['metode_pengambilan']); ?></p>
                <p class="card-text">Qty: <?= esc($pesanan['qty']); ?></p>
                <p class="card-text">Harga Total: <?= esc($pesanan['harga_total']); ?></p>
                <a href="<?= site_url('/pesanan'); ?>" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>