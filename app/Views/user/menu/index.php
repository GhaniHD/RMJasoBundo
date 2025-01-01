<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
            height: 100%;
            min-height: 450px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }


        .card-body p {
            margin: 0;
        }

        .btn-color {
            background-color: #D2B88D;
            /* Warna krem */
            color: white;
            /* Warna teks hitam, sesuaikan jika diperlukan */
        }
    </style>
</head>

<body>
    <?= view('partials/navbar') ?>

    <div class="container">
        <h1 class="h3 py-4 mt-2 mb-2">Menu Katering</h1>
        <div class="card-container">
            <?php foreach ($menu as $item): ?>
                <div class="card">
                    <img src="<?= base_url($item['pic']); ?>" class="card-img-top" alt="<?= $item['nama']; ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $item['nama']; ?></h5>
                        <p class="card-text"><?= $item['keterangan']; ?></p>
                        <p class="card-text">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></p>
                        <form action="<?= base_url('user/pesanan/tambah') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="kd_menu" value="<?= $item['kd_menu'] ?>">
                            <button type="submit" class="btn btn-color">Pesan Sekarang</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>