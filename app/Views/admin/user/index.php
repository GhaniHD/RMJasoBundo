<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna</title>
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
            <h1 class="mb-4">Manajemen Pengguna</h1>
            <table id="userTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kode Pos</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= esc($user['id_user']); ?></td>
                            <td><?= esc($user['email']); ?></td>
                            <td><?= esc($user['level']); ?></td>
                            <td><?= esc($user['nama']); ?></td>
                            <td><?= esc($user['alamat']); ?></td>
                            <td><?= esc($user['kd_pos']); ?></td>
                            <td><?= esc($user['no_telp']); ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm detail-btn" data-id="<?= $user['id_user']; ?>" data-email="<?= $user['email']; ?>" data-level="<?= $user['level']; ?>" data-nama="<?= $user['nama']; ?>" data-alamat="<?= $user['alamat']; ?>" data-kd_pos="<?= $user['kd_pos']; ?>" data-no_telp="<?= $user['no_telp']; ?>">Detail</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="detailEmail">Email:</label>
                        <input type="email" class="form-control" id="detailEmail" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detailLevel">Level:</label>
                        <input type="text" class="form-control" id="detailLevel" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detailNama">Nama:</label>
                        <input type="text" class="form-control" id="detailNama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detailAlamat">Alamat:</label>
                        <textarea class="form-control" id="detailAlamat" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="detailKdPos">Kode Pos:</label>
                        <input type="text" class="form-control" id="detailKdPos" readonly>
                    </div>
                    <div class="form-group">
                        <label for="detailNoTelp">No. Telepon:</label>
                        <input type="text" class="form-control" id="detailNoTelp" readonly>
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
            $('#userTable').DataTable();

            // Detail button logic
            $('.detail-btn').on('click', function() {
                var email = $(this).data('email');
                var level = $(this).data('level');
                var nama = $(this).data('nama');
                var alamat = $(this).data('alamat');
                var kd_pos = $(this).data('kd_pos');
                var no_telp = $(this).data('no_telp');

                $('#detailEmail').val(email);
                $('#detailLevel').val(level);
                $('#detailNama').val(nama);
                $('#detailAlamat').val(alamat);
                $('#detailKdPos').val(kd_pos);
                $('#detailNoTelp').val(no_telp);

                $('#detailModal').modal('show');
            });
        });
    </script>
</body>

</html>
