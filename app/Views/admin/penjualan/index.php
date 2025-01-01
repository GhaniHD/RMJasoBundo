<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Penjualan</title>
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
            <h1 class="mb-4">Daftar Penjualan</h1>
            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#addModal">Tambah Penjualan</button>
            <table id="penjualanTable" class="table table-striped table-bordered">
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
                    <?php foreach ($penjualan as $item) : ?>
                        <tr>
                            <td><?= esc($item['no']); ?></td>
                            <td><?= esc($item['no_pesanan']); ?></td>
                            <td><?= esc($item['tgl_masukan']); ?></td>
                            <td><?= esc($item['modal']); ?></td>
                            <td><?= esc($item['keuntungan']); ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm edit-btn" data-no="<?= esc($item['no']); ?>" data-no_pesanan="<?= esc($item['no_pesanan']); ?>" data-tgl_masukan="<?= esc($item['tgl_masukan']); ?>" data-modal="<?= esc($item['modal']); ?>" data-keuntungan="<?= esc($item['keuntungan']); ?>" data-toggle="modal" data-target="#editModal">Edit</button>
                                <a href="#" class="btn btn-danger btn-sm delete-btn" data-no="<?= esc($item['no']); ?>" data-toggle="modal" data-target="#confirmDeleteModal">Hapus</a>
                                <button class="btn btn-info btn-sm detail-btn" data-no_pesanan="<?= esc($item['no_pesanan']); ?>" data-tgl_masukan="<?= esc($item['tgl_masukan']); ?>" data-modal="<?= esc($item['modal']); ?>" data-keuntungan="<?= esc($item['keuntungan']); ?>" data-toggle="modal" data-target="#detailModal">Detail</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addForm" action="<?= site_url('admin/penjualan/store'); ?>" method="post">
                        <div class="form-group">
                            <label for="noPesanan">No Pesanan:</label>
                            <select class="form-control select2" name="no_pesanan" id="noPesanan" required>
                                <option value="">Pilih No Pesanan</option>
                                <?php foreach ($pesanan as $item) : ?>
                                    <option value="<?= esc($item['no_pesanan']); ?>">
                                        <?= esc($item['no_pesanan']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tglMasukan">Tanggal Masukan:</label>
                            <input type="date" class="form-control" name="tgl_masukan" id="tglMasukan" required>
                        </div>
                        <div class="form-group">
                            <label for="modal">Modal:</label>
                            <input type="number" class="form-control" name="modal" id="modal" required>
                        </div>
                        <div class="form-group">
                            <label for="keuntungan">Keuntungan:</label>
                            <input type="number" class="form-control" name="keuntungan" id="keuntungan" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="" method="post">
                        <input type="hidden" name="no" id="editNo" value="">
                        <div class="form-group">
                            <label for="editNoPesanan">No Pesanan:</label>
                            <select class="form-control select2" name="no_pesanan" id="editNoPesanan" required>
                                <?php foreach ($pesanan as $item) : ?>
                                    <option value="<?= esc($item['no_pesanan']); ?>">
                                        <?= esc($item['no_pesanan']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editTglMasukan">Tanggal Masukan:</label>
                            <input type="date" class="form-control" name="tgl_masukan" id="editTglMasukan" required>
                        </div>
                        <div class="form-group">
                            <label for="editModal">Modal:</label>
                            <input type="number" class="form-control" name="modal" id="editModalInput" required>
                        </div>
                        <div class="form-group">
                            <label for="editKeuntungan">Keuntungan:</label>
                            <input type="number" class="form-control" name="keuntungan" id="editKeuntungan" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
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
            </div>
        </div>
    </div>

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus item ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#penjualanTable').DataTable();

            // Handle Edit button click
            $('#penjualanTable').on('click', '.edit-btn', function() {
                var btn = $(this);
                $('#editNo').val(btn.data('no'));
                $('#editNoPesanan').val(btn.data('no_pesanan')).trigger('change');
                $('#editTglMasukan').val(btn.data('tgl_masukan'));
                $('#editModalInput').val(btn.data('modal'));
                $('#editKeuntungan').val(btn.data('keuntungan'));
                $('#editForm').attr('action', '<?= site_url('admin/penjualan/update'); ?>/' + btn.data('no'));
            });

            // Handle Detail button click
            $('#penjualanTable').on('click', '.detail-btn', function() {
                var btn = $(this);
                $('#detailNoPesanan').val(btn.data('no_pesanan'));
                $('#detailTglMasukan').val(btn.data('tgl_masukan'));
                $('#detailModalInput').val(btn.data('modal'));
                $('#detailKeuntungan').val(btn.data('keuntungan'));
                $('#detailModal').modal('show');
            });

            // Handle Delete button click
            $('#penjualanTable').on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var btn = $(this);
                var deleteUrl = '<?= site_url('admin/penjualan/delete'); ?>/' + btn.data('no');
                $('#confirmDeleteBtn').attr('href', deleteUrl);
                $('#confirmDeleteModal').modal('show');
            });
        });
    </script>
</body>

</html>
