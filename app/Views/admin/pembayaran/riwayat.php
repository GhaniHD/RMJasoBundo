<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembayaran</title>
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
            <h1 class="mb-4">Daftar Pembayaran</h1>
            <table id="pembayaranTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>No Pesanan</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembayaran as $item) : ?>
                        <tr>
                            <td><?= esc($item['id']); ?></td>
                            <td><?= esc($item['no_pesanan']); ?></td>
                            <td>
                                <img src="<?= base_url('uploads/pembayaran/ ' . esc($item['bukti_pembayaran'])) ?>" alt="<?= esc($item['no_pesanan']); ?>" style="width:80px; height:80px; display: block; margin-left: auto; margin-right: auto;" />
                            </td>
                            <td><?= esc($item['checked']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="post">
                            <input type="hidden" name="id" id="orderId">
                            <div class="form-group">
                                <label for="checked">Status Pembayaran:</label>
                                <select class="form-control" name="checked" id="checked">
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
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pembayaranTable').DataTable();

            // Edit button logic
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var checked = $(this).data('checked');

                $('#orderId').val(id);
                $('#checked').val(checked);

                $('#editForm').attr('action', '<?= site_url('admin/pembayaran/update/'); ?>' + id);

                $('#editModal').modal('show');
            });
        });
    </script>
</body>

</html>