<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
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
            <h1 class="mb-4">Laporan Penjualan</h1>
            <table id="laporanTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pesanan</th>
                        <th>Tanggal Masukan</th>
                        <th>Modal</th>
                        <th>Keuntungan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penjualan as $item): ?>
                        <tr>
                            <td><?= esc($item['no']); ?></td>
                            <td><?= esc($item['no_pesanan']); ?></td>
                            <td><?= esc($item['tgl_masukan']); ?></td>
                            <td><?= esc($item['modal']); ?></td>
                            <td><?= esc($item['keuntungan']); ?></td>
                            <td>
                                <button class="btn btn-info btn-sm detail-btn"
                                    data-no_pesanan="<?= esc($item['no_pesanan']); ?>"
                                    data-tgl_masukan="<?= esc($item['tgl_masukan']); ?>"
                                    data-modal="<?= esc($item['modal']); ?>"
                                    data-keuntungan="<?= esc($item['keuntungan']); ?>" data-toggle="modal"
                                    data-target="#detailModal">Detail</button>
                                <button class="btn btn-primary btn-sm print-btn"
                                    data-no_pesanan="<?= esc($item['no_pesanan']); ?>"
                                        data-tgl_masukan="<?= esc($item['tgl_masukan']); ?>"
                                        data-modal="<?= esc($item['modal']); ?>"
                                        data-keuntungan="<?= esc($item['keuntungan']); ?>">Cetak</button>
                                </td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="detailNoPesanan">No Pesanan:</label>
                        <input type="text" class="form-control" id="detailNoPesanan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detailTglMasukan">Tanggal Masukan:</label>
                        <input type="text" class="form-control" id="detailTglMasukan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detailModal">Modal:</label>
                        <input type="text" class="form-control" id="detailModalInput" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detailKeuntungan">Keuntungan:</label>
                        <input type="text" class="form-control" id="detailKeuntungan" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#laporanTable').DataTable();

            // Handle Detail button click
            $('#laporanTable').on('click', '.detail-btn', function () {
                var btn = $(this);
                $('#detailNoPesanan').val(btn.data('no_pesanan'));
                $('#detailTglMasukan').val(btn.data('tgl_masukan'));
                $('#detailModalInput').val(btn.data('modal'));
                $('#detailKeuntungan').val(btn.data('keuntungan'));
                $('#detailModal').modal('show');
            });

            // Handle Print button click
            $('#laporanTable').on('click', '.print-btn', function () {
                var btn = $(this);
                var noPesanan = btn.data('no_pesanan');
                var tglMasukan = btn.data('tgl_masukan');
                var modal = btn.data('modal');
                var keuntungan = btn.data('keuntungan');

                var printWindow = window.open('', '', 'height=600,width=800');
                printWindow.document.write('<html><head><title>Cetak Laporan Penjualan</title></head><body>');
                printWindow.document.write('<h1>Detail Penjualan</h1>');
                printWindow.document.write('<p><strong>No Pesanan:</strong> ' + noPesanan + '</p>');
                printWindow.document.write('<p><strong>Tanggal Masukan:</strong> ' + tglMasukan + '</p>');
                printWindow.document.write('<p><strong>Modal:</strong> ' + modal + '</p>');
                printWindow.document.write('<p><strong>Keuntungan:</strong> ' + keuntungan + '</p>');
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
            });
        });
    </script>
</body>

</html>
