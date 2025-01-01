<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_token() ?>"> <!-- Include CSRF token if needed -->
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

        .table thead th {
            vertical-align: middle;
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .order-info {
            font-size: 0.9em;
            color: #6c757d;
        }
    </style>
</head>

<body class="bg-light">
    <?= view('partials/navbar') ?>
    <div class="container py-4 mb-4 mt-2">
        <h1 class="h3 mb-4">Upload Bukti Pembayaran</h1>
        <div class="row">
            <!-- Left -->
            <div class="col-lg-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="container">
                            <aside class="d-flex flex-column">
                                <div class="foto-pembayaran bg-secondary" id="pembayaran-picture"
                                    style="width: 14rem; height: 14rem">
                                    <img src="" alt="Foto Pembayaran" id="pembayaran-img"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <button class="btn btn-color mt-3" style="width: 8rem; text-align:center"
                                    onclick="document.getElementById('pembayaran-input').click()">Pilih File</button>
                            </aside>

                            <form id="paymentForm" enctype="multipart/form-data">
                                <div class="form-group mb-3">
                                    <label class="mb-1 px-1" for="rekeningPembayaran">Nomor Rekening Pembayaran</label>
                                    <input type="text" class="form-control" id="rekeningPembayaran"
                                        value="<?= env('ENV_NomorRekening') ?>" readonly>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="mb-1 px-1" for="nomorPesanan">Nomor Pesanan</label>
                                    <input type="text" class="form-control" id="nomorPesanan"
                                        oninput="fetchOrderDetails()">
                                </div>
                                <div id="dynamicInputs">
                                    <!-- Form input dinamis akan ditambahkan di sini -->
                                </div>
                                <div id="orderDetails" style="display: none;">
                                    <!-- Detail pesanan akan dimasukkan di sini -->
                                    <table class="table table-bordered mt-4">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Info Pesanan</th>
                                                <th>Qty</th>
                                                <th>Tanggal Pesan</th>
                                                <th>Tanggal Ambil</th>
                                                <th>Harga Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orderDetailsBody">
                                            <!-- Order details will be appended here -->
                                        </tbody>
                                    </table>
                                </div>

                                <button type="button" class="btn btn-secondary" onclick="addInput()">Tambah
                                    Input</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right -->
            <div class="col-lg-3">
                <div class="card position-sticky top-0">
                    <div class="p-3 bg-light bg-opacity-10">
                        <h6 class="card-title mb-3">Order Summary</h6>
                        <form id="uploadForm" action="<?= base_url('user/pembayaran/uploadAction') ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="container">
                                <input type="file" name="bukti_pembayaran" id="pembayaran-input" style="display: none;"
                                    accept="image/*" onchange="previewImage(event)">
                                <div class="d-flex justify-content-between mb-4 small">
                                    <span>TOTAL</span> <strong class="text-dark" id="totalHarga">Rp 0</strong>
                                    <input type="text" style="display: none;" value="" id="inputTotal"
                                        name="totalHarga">
                                </div>
                                <div id="hiddenInputsContainer">
                                    <!-- Hidden inputs untuk nomor pesanan akan ditambahkan di sini -->
                                </div>
                                <button class="btn btn-color w-100 mt-2" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let inputCount = 1;

        function addInput() {
            inputCount++;
            const container = document.getElementById('dynamicInputs');
            const newInput = document.createElement('div');
            newInput.className = 'form-group mb-3';
            newInput.innerHTML = `
                <label class="mb-1 px-1" for="nomorPesanan${inputCount}">Nomor Pesanan ${inputCount}</label>
                <input type="text" name="nomorPesanan[]" class="form-control" id="nomorPesanan${inputCount}" oninput="fetchOrderDetails()">
            `;
            container.appendChild(newInput);
        }

        async function fetchOrderDetails() {
            const nomorPesananElements = document.querySelectorAll('[id^="nomorPesanan"]');
            const nomorPesananData = Array.from(nomorPesananElements).map(el => el.value.trim()).filter(value => value !== '');

            if (nomorPesananData.length > 0) {
                try {
                    const response = await fetch(`<?= base_url('user/pesanan/detail') ?>`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            nomorPesanan: nomorPesananData
                        })
                    });

                    const result = await response.json();
                    if (response.ok) {
                        const orderDetailsBody = document.getElementById('orderDetailsBody');
                        orderDetailsBody.innerHTML = '';
                        let totalHarga = 0;
                        const hiddenInputsContainer = document.getElementById('hiddenInputsContainer');
                        hiddenInputsContainer.innerHTML = '';
                        result.data.forEach((detail, index) => {

                            const hargaTotal = parseFloat(detail.harga_total.replace(/[^\d.-]/g, ''));
                            totalHarga += hargaTotal;
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'no_pesanan[]';
                            hiddenInput.value = detail.no_pesanan;
                            hiddenInputsContainer.appendChild(hiddenInput);

                            const detailRow = document.createElement('tr');
                            detailRow.innerHTML = `
                                <td>${index + 1}</td>
                                <td>
                                    <div>Nomor Pesanan: <span class="font-weight-bold">${detail.no_pesanan}</span></div>
                                    <div class="order-info">Metode Pengambilan: ${detail.metode_pengambilan}</div>
                                    <div class="order-info">Status Pembayaran: ${detail.status_pembayaran}</div>
                                    <div class="order-info">Status Pesanan: ${detail.status_pesanan}</div>
                                </td>
                                <td class="text-center">${detail.qty}</td>
                                <td class="text-center">${detail.tgl_pesan}</td>
                                <td class="text-center">${detail.tgl_ambil}</td>
                                <td class="text-right">Rp ${detail.harga_total}</td>
                            `;
                            orderDetailsBody.appendChild(detailRow);
                        });

                        const totalRow = document.getElementById('totalHarga');
                        totalRow.textContent = `Rp ${totalHarga.toLocaleString()}`;

                        const inputTotal = document.getElementById('inputTotal');
                        inputTotal.value = totalHarga.toFixed(2);

                        document.getElementById('orderDetails').style.display = 'block';
                    } else {
                        alert('Terjadi kesalahan: ' + result.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan: ' + error.message);
                }
            }
        }

        function previewImage(event) {
            const output = document.getElementById('pembayaran-img');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>

</html>