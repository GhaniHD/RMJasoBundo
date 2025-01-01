<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css">
</head>

<body>
    <h1>Tambah Pesanan</h1>
    <?= \Config\Services::validation()->listErrors(); ?>
    <form action="<?= site_url('pesanan/store'); ?>" method="post">
        <?= csrf_field(); ?>
        <label>No. Pesanan:</label>
        <input type="text" name="no_pesanan" value="<?= old('no_pesanan'); ?>"><br>

        <label>ID User:</label>
        <select name="id_user" class="select2" style="width: 200px;">
            <!-- Populate with user options -->
        </select><br>

        <label>Kode Menu:</label>
        <select name="kd_menu" class="select2" style="width: 200px;">
            <!-- Populate with menu options -->
        </select><br>

        <label>Tanggal Pesan:</label>
        <input type="date" name="tgl_pesan" value="<?= old('tgl_pesan'); ?>"><br>

        <label>Tanggal Ambil:</label>
        <input type="date" name="tgl_ambil" value="<?= old('tgl_ambil'); ?>"><br>

        <label>Status Pesanan:</label>
        <input type="number" name="status_pesanan" value="<?= old('status_pesanan'); ?>"><br>

        <label>Status Pembayaran:</label>
        <input type="number" name="status_pembayaran" value="<?= old('status_pembayaran'); ?>"><br>

        <label>Metode Pengambilan:</label>
        <input type="number" name="metode_pengambilan" value="<?= old('metode_pengambilan'); ?>"><br>

        <label>Qty:</label>
        <input type="number" name="qty" value="<?= old('qty'); ?>"><br>

        <label>Harga Total:</label>
        <input type="number" name="harga_total" value="<?= old('harga_total'); ?>"><br>

        <button type="submit">Simpan</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
</body>

</html>