<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .image-preview {
            margin: 16px 0;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #6c757d;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <h1>Edit Menu</h1>
    <form action="/menu/update/<?= htmlspecialchars($menu['kd_menu']); ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="old_pic" value="<?= htmlspecialchars($menu['pic']); ?>">

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($menu['nama']); ?>">

        <label for="keterangan">Keterangan:</label>
        <textarea id="keterangan" name="keterangan"><?= htmlspecialchars($menu['keterangan']); ?></textarea>

        <label for="harga">Harga:</label>
        <input type="text" id="harga" name="harga" value="<?= htmlspecialchars($menu['harga']); ?>">

        <label for="pic">Gambar:</label>
        <input type="file" id="pic" name="pic">
        <div class="image-preview">
            <img src="<?= base_url($menu['pic']); ?>" alt="<?= htmlspecialchars($menu['nama']); ?>" width="100">
        </div>

        <button type="submit">Simpan</button>
        <a href="/admin/menu" class="back-button">Kembali</a>
    </form>
</body>

</html>