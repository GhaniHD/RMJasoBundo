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
                No. Pesanan: <?= esc($pembayaran['no_pesanan']); ?>
            </div>
            <div class="card-body">

                <h5 class="card-title">ID User: <?= esc($pembayaran['id']); ?></h5>
                <p class="card-text">No. Pesanan: <?= esc($pembayaran['no_pesanan']); ?></p>
                <p class="card-text">Bukti Pembayaran: <img src="uploads/pembayaran/<?= base_url(esc($pembayaran['bukti_pembayaran'])) ?>" alt="<?= esc($pembayaran['no_pesanan']); ?>" style="width:80px; height:80px ;
                    /* center */
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                    " /></p>
                <p class="card-text">Status: <?= esc($pembayaran['checked']); ?></p>
                <a href="<?= site_url('admin/pembayaran'); ?>" class="btn btn-primary">Kembali</a>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>