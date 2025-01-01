<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/310ccd6629.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style>
        h2 {
            margin-bottom: 20px;
            color: #007bff;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #f1f1f1;
            color: #212529;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .actions img {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .actions img:hover {
            opacity: 0.7;
        }

        .status-selesai {
            color: #28a745;
            font-weight: bold;
        }

        .status-proses {
            color: #ffc107;
            font-weight: bold;
        }

        .status-lunas {
            color: #28a745;
            font-weight: bold;
        }

        .status-belum-lunas {
            color: #dc3545;
            font-weight: bold;
        }

        .badge-status {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .badge-selesai {
            background-color: #28a745;
            color: #fff;
        }

        .badge-proses {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-lunas {
            background-color: #28a745;
            color: #fff;
        }

        .badge-belum-lunas {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>
    <?= view('partials/navbar') ?>

    <div class="container">
        <h1 class="h3 py-4 mt-2 mb-2">Riwayat Pemesanan</h1>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pesananTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pesanan</th>
                                <th>Kode Menu</th>
                                <th>Qty</th>
                                <th>Harga Total</th>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Ambil</th>
                                <th>Metode Pengambilan</th>
                                <th>Status Pesanan</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pesanan)): ?>
                                <?php foreach ($pesanan as $key => $value): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $value['no_pesanan'] ?></td>
                                        <td><?= $value['kd_menu'] ?></td>
                                        <td><?= $value['qty'] ?></td>
                                        <td><?= $value['harga_total'] ?></td>
                                        <td><?= $value['tgl_pesan'] ?></td>
                                        <td><?= $value['tgl_ambil'] ?></td>
                                        <td><?= $value['metode_pengambilan'] ?></td>
                                        <td><?= $value['status_pesanan'] ?></td>
                                        <td><?= $value['status_pembayaran'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10">Tidak ada pesanan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#pesananTable').DataTable();
        });
    </script>
</body>

</html>
