<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jaso Bundo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/310ccd6629.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
    <style>
        .btn-color {
            background-color: #D2B88D;
            color: white;
        }
    </style>
</head>

<body class="bg-light">
    <?= view('partials/navbar') ?>

    <div class="container">
        <h1 class="h3 py-4 mt-2 mb-2">Keranjang</h1>
        <div class="row">
            <div class="col-sm-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <form id="keranjangForm" action="<?= base_url('user/pesanan/simpanPesanan') ?>" method="post">
                            <?= csrf_field() ?>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>#</th>
                                        <th>Info Barang</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($keranjangItems as $index => $item) : ?>
                                        <?php
                                        if (isset($_SESSION['success'])) {
                                            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                                        }
                                        $subtotal = $item['qty'] * $item['harga']; // Menghitung subtotal
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="itemCheckbox" data-id="<?= $item['id'] ?>" data-subtotal="<?= $subtotal ?>" name="items[]" value="<?= $item['id'] ?>">
                                            </td>
                                            <td width="35px"><?= $index + 1 ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-3 d-flex justify-content-center">
                                                        <img src="<?= base_url($item['pic']) ?>" height="75" alt="">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <h6><?= $item['nama'] ?></h6>
                                                        <div>Rp <?= number_format($item['harga'], 0, ',', '.') ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="80px">
                                                <input type="number" class="form-control form-control-sm qtyInput" value="<?= $item['qty'] ?>" name="qty[<?= $item['id'] ?>]" data-price="<?= $item['harga'] ?>" disabled>


                                            </td>
                                            <td>
                                                <input type="number" style="display: none;" name="harga_total[<?= $item['id'] ?>]" value="<?= $subtotal ?>">
                                                <input type="number" style="display: none;" name="kd_menu[<?= $item['id'] ?>]" value="<?= $item['kd_menu'] ?>">
                                                Rp <?= number_format($subtotal, 0, ',', '.') ?>
                                            </td>
                                            <td>
                                                <button type="submit" formaction="<?= base_url('user/keranjang/update/' . $item['id']) ?>" class="btn btn-sm btn-success">Edit</button>
                                                <a href="<?= base_url('user/keranjang/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>


            <!--  -->


            <div class="col-sm-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="py-2 mb-2 px-2">Total :</h3>
                        <h4 class="mb-4 px-2" id="totalHarga">Rp 0</h4>
                        <hr>
                        <div class="mb-3">
                            <label for="metodePengambilan" class="form-label">Metode Pengambilan</label>
                            <select class="form-select" id="metodePengambilan" required>
                                <option value="" disabled selected>Pilih metode pengambilan</option>
                                <option value="1">Delivery</option>
                                <option value="2">Ambil di Tempat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggalPengambilan" class="form-label">Tanggal Pengambilan</label>
                            <input type="date" class="form-control" id="tanggalPengambilan" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="button" id="bayarButton" class="btn btn-color d-grid">Bayar</button>
                            *Kemungkinan gratis ongkir untuk wilayah Jawa Timur dan sekitarnya.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="py-2 mb-2 px-2 text-center">+62 822 3064 8094</h5>
                        <hr>
                        Hubungi contact berikut untuk informasi terkait pengiriman atau pembayaran.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const itemCheckboxes = document.querySelectorAll('.itemCheckbox');
            const qtyInputs = document.querySelectorAll('.qtyInput');
            const selectAllCheckbox = document.getElementById('selectAll');
            const totalHargaElement = document.getElementById('totalHarga');
            const bayarButton = document.getElementById('bayarButton');
            const metodePengambilan = document.getElementById('metodePengambilan');
            const tanggalPengambilan = document.getElementById('tanggalPengambilan');
            const keranjangForm = document.getElementById('keranjangForm');

            function updateTotal() {
                let total = 0;
                itemCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        total += parseFloat(checkbox.dataset.subtotal);
                        checkbox.closest('tr').querySelector('.qtyInput').disabled = false;
                    } else {
                        checkbox.closest('tr').querySelector('.qtyInput').disabled = true;
                    }
                });
                totalHargaElement.textContent = 'Rp ' + total.toLocaleString('id-ID');
            }

            function removeEmptyRows() {
                qtyInputs.forEach(input => {
                    if (parseInt(input.value) === 0) {
                        input.closest('tr').remove(); // Menghapus baris jika qty adalah 0
                    }
                });
            }

            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotal);
            });

            selectAllCheckbox.addEventListener('change', function() {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
                updateTotal();
            });

            bayarButton.addEventListener('click', function() {
                // Validasi input
                if (!metodePengambilan.value || !tanggalPengambilan.value) {
                    alert('Mohon lengkapi semua informasi.');
                    return;
                }

                // Konfirmasi
                const confirmation = confirm('Apakah Anda yakin ingin mengirimkan pesanan ini?');
                if (confirmation) {
                    // Jika konfirmasi, tambahkan data tambahan ke form
                    const hiddenInput1 = document.createElement('input');
                    hiddenInput1.type = 'hidden';
                    hiddenInput1.name = 'metode_pengambilan';
                    hiddenInput1.value = metodePengambilan.value;
                    keranjangForm.appendChild(hiddenInput1);

                    const hiddenInput2 = document.createElement('input');
                    hiddenInput2.type = 'hidden';
                    hiddenInput2.name = 'tanggal_pengambilan';
                    hiddenInput2.value = tanggalPengambilan.value;
                    keranjangForm.appendChild(hiddenInput2);

                    // Kirimkan form
                    keranjangForm.submit();
                }
            });

            updateTotal();
            removeEmptyRows(); // Hapus baris dengan qty kosong saat halaman dimuat
        });
    </script>
</body>

</html>