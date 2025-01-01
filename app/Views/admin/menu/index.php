<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu</title>
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

        .card {
            margin-bottom: 1rem;
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
            <h1 class="mb-4">Daftar Menu</h1>

            <div class="mb-3">
                <button class="btn btn-primary" onclick="toggleForm()">Tambah Menu</button>
            </div>

            <!-- Form untuk menambahkan menu -->
            <div id="form-container" class="card" style="display: none;">
                <div class="card-header">Tambah Menu</div>
                <div class="card-body">
                    <?php if (isset($validation) && $validation->getErrors()) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($validation->getErrors() as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="/admin/menu/store" method="post" enctype="multipart/form-data" id="menu-form">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="<?= old('nama'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control"><?= old('keterangan'); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" id="harga" name="harga" class="form-control" value="<?= old('harga'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="pic">Gambar</label>
                            <input type="file" id="pic" name="pic" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

            <table id="menuTable" class="table table-striped table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Kode Menu</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menu as $item) : ?>
                        <tr>
                            <td><?= esc($item['kd_menu']); ?></td>
                            <td><?= esc($item['nama']); ?></td>
                            <td><?= esc($item['keterangan']); ?></td>
                            <td><?= esc($item['harga']); ?></td>
                            <td>
                                <?php if ($item['pic']) : ?>
                                    <img src="<?= base_url($item['pic']); ?>" alt="Gambar" width="50">
                                <?php else : ?>
                                    Tidak ada gambar
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm show-btn" data-menu="<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8'); ?>">Detail</button>
                                <button class="btn btn-warning btn-sm edit-btn" data-menu="<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8'); ?>">Edit</button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="<?= esc($item['kd_menu']); ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Show Menu -->
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Detail Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Kode Menu</th>
                            <td id="showKodeMenu"></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td id="showNama"></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td id="showKeterangan"></td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td id="showHarga"></td>
                        </tr>
                        <tr>
                            <th>Gambar</th>
                            <td id="showGambar"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Menu -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (isset($validation) && $validation->getErrors()) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($validation->getErrors() as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="post" enctype="multipart/form-data" id="edit-menu-form">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="kd_menu" id="editKdMenu">
                        <div class="form-group">
                            <label for="editNama">Nama</label>
                            <input type="text" id="editNama" name="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="editKeterangan">Keterangan</label>
                            <textarea id="editKeterangan" name="keterangan" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editHarga">Harga</label>
                            <input type="text" id="editHarga" name="harga" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="editPic">Gambar</label>
                            <input type="file" id="editPic" name="pic" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Menu -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus menu ini?</p>
                </div>
                <div class="modal-footer">
                    <form method="post" id="delete-menu-form">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="kd_menu" id="deleteKdMenu">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
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
            $('#menuTable').DataTable();

            // Show button logic
            $('.show-btn').on('click', function() {
                var menu = $(this).data('menu');
                $('#showKodeMenu').text(menu.kd_menu);
                $('#showNama').text(menu.nama);
                $('#showKeterangan').text(menu.keterangan);
                $('#showHarga').text(menu.harga);
                $('#showGambar').html(menu.pic ? `<img src="<?= base_url(); ?>/${menu.pic}" alt="Gambar" width="50">` : 'Tidak ada gambar');
                $('#showModal').modal('show');
            });

            // Edit button logic
            $('.edit-btn').on('click', function() {
                var menu = $(this).data('menu');
                $('#edit-menu-form').attr('action', `/admin/menu/update/${menu.kd_menu}`);
                $('#editKdMenu').val(menu.kd_menu);
                $('#editNama').val(menu.nama);
                $('#editKeterangan').val(menu.keterangan);
                $('#editHarga').val(menu.harga);
                $('#editModal').modal('show');
            });

            // Delete button logic
            $('.delete-btn').on('click', function() {
                var id = $(this).data('id');
                $('#delete-menu-form').attr('action', `/admin/menu/delete/${id}`);
                $('#deleteKdMenu').val(id);
                $('#deleteModal').modal('show');
            });
        });

        function toggleForm() {
            const formContainer = document.getElementById('form-container');
            formContainer.style.display = (formContainer.style.display === 'none' || formContainer.style.display === '') ? 'block' : 'none';
        }
    </script>
</body>

</html>