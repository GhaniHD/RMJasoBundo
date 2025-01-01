<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard - Menu Management</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Custom Styling */
        .main-content {
            margin-left: 16rem;
            /* Sidebar width */
            padding: 20px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 0.375rem;
            /* Tailwind's rounded-md */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            font-size: 1.125rem;
            /* Tailwind's text-lg */
            font-weight: 600;
            margin-bottom: 1.25rem;
            /* Tailwind's mb-5 */
            border-bottom: 2px solid #e2e6e9;
            padding-bottom: 0.625rem;
            /* Tailwind's pb-2.5 */
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toggle-button,
        .search-button {
            background-color: #007bff;
            /* Tailwind's blue-600 */
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            /* Tailwind's rounded-md */
            cursor: pointer;
            font-size: 1rem;
            /* Tailwind's text-base */
            transition: background-color 0.3s ease;
        }

        .toggle-button:hover,
        .search-button:hover {
            background-color: #0056b3;
            /* Tailwind's blue-800 */
        }

        .search-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
        }

        .search-input {
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            /* Tailwind's rounded-md */
            width: 250px;
            margin-right: 10px;
        }

        .form-group {
            margin-bottom: 1rem;
            /* Tailwind's mb-4 */
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            /* Tailwind's mb-2 */
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            /* Tailwind's rounded-md */
            box-sizing: border-box;
            background: #f8f9fa;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .error-container {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 0.5rem;
            border-radius: 0.375rem;
            /* Tailwind's rounded-md */
            margin-bottom: 1rem;
            /* Tailwind's mb-4 */
        }

        .error-container ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .error {
            color: #e74c3c;
            font-size: 0.875rem;
            /* Tailwind's text-sm */
            margin-top: 0.25rem;
            /* Tailwind's mt-1 */
        }

        .submit-button {
            background-color: #28a745;
            /* Tailwind's green-600 */
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            /* Tailwind's rounded-md */
            cursor: pointer;
            font-size: 1rem;
            /* Tailwind's text-base */
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #218838;
            /* Tailwind's green-700 */
        }

        .table-container {
            margin-top: 1.25rem;
            /* Tailwind's mt-5 */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 0.375rem;
            /* Tailwind's rounded-md */
            overflow: hidden;
        }

        th,
        td {
            padding: 0.75rem;
            /* Tailwind's p-3 */
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <?= view('partials/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search...">
                    <button class="search-button">Search</button>
                </div>
                <div class="header-buttons">
                    <button class="toggle-button" onclick="toggleForm()">Tambah Menu</button>
                </div>
            </div>

            <!-- Form untuk menambahkan menu -->
            <div id="form-container" class="card" style="display: none;">
                <div class="card-header">Tambah Menu</div>

                <?php if (isset($validation) && $validation->getErrors()): ?>
                    <div class="error-container">
                        <ul>
                            <?php foreach ($validation->getErrors() as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="/admin/menu/store" method="post" enctype="multipart/form-data" id="menu-form">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="<?= old('nama'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan"><?= old('keterangan'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" id="harga" name="harga" value="<?= old('harga'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="pic">Gambar</label>
                        <input type="file" id="pic" name="pic">
                    </div>
                    <button type="submit" class="submit-button">Simpan</button>
                </form>
            </div>

            <!-- Tabel Daftar Menu -->
            <div class="card table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($menu)): ?>
                            <?php foreach ($menu as $item): ?>
                                <tr>
                                    <td><?= esc($item['nama']) ?></td>
                                    <td><?= esc($item['keterangan']) ?></td>
                                    <td><?= esc($item['harga']) ?></td>
                                    <td>
                                        <?php if ($item['pic']): ?>
                                            <img src="<?= esc($item['pic']) ?>" alt="<?= esc($item['nama']) ?>"
                                                style="width: 100px; height: auto;">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/menu/edit/<?= $item['id'] ?>" class="button">Edit</a>
                                        <a href="/menu/delete/<?= $item['id'] ?>" class="button"
                                            onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No data found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function toggleForm() {
            const formContainer = document.getElementById('form-container');
            formContainer.style.display = (formContainer.style.display === 'none' || formContainer.style.display === '') ? 'block' : 'none';
        }
    </script>
</body>

</html>