<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .actions img {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .actions img:hover {
            opacity: 0.7;
        }

        .details {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?= view('partials/navbar') ?>

    <div class="container mt-4">
        <h2>Keranjang Pesanan</h2>
        <div class="row">
            <div class="col-lg-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Qty</th>
                            <th>Total Harga</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($pesanan as $key => $value) {
                        ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['kd_menu'] ?></td>
                                <td><?= $value['qty'] ?></td>
                                <td><?= $value['harga_total'] ?></td>
                                <td class="actions">
                                    <img src="refresh.png" alt="Perbarui">
                                    <img src="delete.png" alt="Hapus">
                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="details">
                    <div><strong>Detail Pesanan</strong></div>
                    <div>Jumlah Item: </div>
                    <div>Total Tagihan: </div>
                    <button class="btn btn-primary mt-2">Cek Keluar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>