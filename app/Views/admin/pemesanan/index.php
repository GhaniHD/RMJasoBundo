<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 16rem;
            height: 100vh;
            background-color: #1f2937;
            color: white;
            padding-top: 1rem;
        }

        .sidebar .sidebar-item {
            padding: 10px 0;
            margin-left: 20px;
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
        }

        .sidebar .sidebar-item:hover {
            background-color: #1e40af;
        }

        .sidebar .sidebar-item.active {
            background-color: #1e3a8a;
        }

        .sidebar .sidebar-item i {
            margin-right: 0.5rem;
        }

        .sidebar li {
            padding: 8px 0;
            border-bottom: 1px solid #333;
        }

        .sidebar li:last-child {
            border-bottom: none;
        }

        .main-content {
            margin-left: 16rem;
            padding: 10px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <?php echo view('partials/sidebar'); ?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <h1 class="mb-4">Daftar Pesanan</h1>
            <table id="pesananTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No. Pesanan</th>
                        <th>ID User</th>
                        <th>Kode Menu</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Ambil</th>
                        <th>Status Pesanan</th>
                        <th>Status Pembayaran</th>
                        <th>Metode Pengambilan</th>
                        <th>Qty</th>
                        <th>Harga Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesanan as $item) : ?>
                        <tr>
                            <td><?= esc($item['no_pesanan']); ?></td>
                            <td><?= esc($item['id_user']); ?></td>
                            <td><?= esc($item['kd_menu']); ?></td>
                            <td><?= esc($item['tgl_pesan']); ?></td>
                            <td><?= esc($item['tgl_ambil']); ?></td>
                            <td><?= esc($item['status_pesanan']); ?></td>
                            <td><?= esc($item['status_pembayaran']); ?></td>
                            <td><?= esc($item['metode_pengambilan']); ?></td>
                            <td><?= esc($item['qty']); ?></td>
                            <td><?= esc($item['harga_total']); ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm view-btn" data-id="<?= esc($item['id']); ?>" data-pesanan="<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8'); ?>">Lihat</button>
                                <button class="btn btn-warning btn-sm edit-btn" data-id="<?= esc($item['id']); ?>" data-status-pesanan="<?= esc($item['status_pesanan']); ?>" data-status-pembayaran="<?= esc($item['status_pembayaran']); ?>">Edit</button>
                                <a href="<?= site_url('admin/pesanan/delete/' . $item['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit Pesanan -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="" method="post">
                        <input type="hidden" name="id" id="orderId">
                        <div class="form-group">
                            <label for="statusPesanan">Status Pesanan:</label>
                            <select class="form-control" name="status_pesanan" id="statusPesanan">
                                <option value="1">Pending</option>
                                <option value="2">Proses</option>
                                <option value="3">Dikirim</option>
                                <option value="4">Dibatalkan</option>
                                <option value="5">Diambil</option>
                                <option value="6">Selesai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="statusPembayaran">Status Pembayaran:</label>
                            <select class="form-control" name="status_pembayaran" id="statusPembayaran">
                                <option value="1">Pending</option>
                                <option value="2">Lunas</option>
                                <option value="3">Gagal</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Lihat Pesanan -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>No. Pesanan</th>
                            <td id="viewNoPesanan"></td>
                        </tr>
                        <tr>
                            <th>ID User</th>
                            <td id="viewIdUser"></td>
                        </tr>
                        <tr>
                            <th>Kode Menu</th>
                            <td id="viewKodeMenu"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Pesan</th>
                            <td id="viewTanggalPesan"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Ambil</th>
                            <td id="viewTanggalAmbil"></td>
                        </tr>
                        <tr>
                            <th>Status Pesanan</th>
                            <td id="viewStatusPesanan"></td>
                        </tr>
                        <tr>
                            <th>Status Pembayaran</th>
                            <td id="viewStatusPembayaran"></td>
                        </tr>
                        <tr>
                            <th>Metode Pengambilan</th>
                            <td id="viewMetodePengambilan"></td>
                        </tr>
                        <tr>
                            <th>Qty</th>
                            <td id="viewQty"></td>
                        </tr>
                        <tr>
                            <th>Harga Total</th>
                            <td id="viewHargaTotal"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pesananTable').DataTable();

            // Edit button logic
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var statusPesanan = $(this).data('status-pesanan');
                var statusPembayaran = $(this).data('status-pembayaran');

                $('#orderId').val(id);
                $('#statusPesanan').val(statusPesanan);
                $('#statusPembayaran').val(statusPembayaran);

                // Set the form action dynamically
                $('#editForm').attr('action', '<?= site_url('admin/pesanan/update/'); ?>' + id);

                $('#editModal').modal('show');
            });

            // View button logic
            $('.view-btn').on('click', function() {
                var pesanan = $(this).data('pesanan');

                $('#viewNoPesanan').text(pesanan.no_pesanan);
                $('#viewIdUser').text(pesanan.id_user);
                $('#viewKodeMenu').text(pesanan.kd_menu);
                $('#viewTanggalPesan').text(pesanan.tgl_pesan);
                $('#viewTanggalAmbil').text(pesanan.tgl_ambil);
                $('#viewStatusPesanan').text(pesanan.status_pesanan);
                $('#viewStatusPembayaran').text(pesanan.status_pembayaran);
                $('#viewMetodePengambilan').text(pesanan.metode_pengambilan);
                $('#viewQty').text(pesanan.qty);
                $('#viewHargaTotal').text(pesanan.harga_total);

                $('#viewModal').modal('show');
            });
        });
    </script>
</body>

</html>