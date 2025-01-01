<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Maknaan</title>
    <!-- Menggunakan Bootstrap 5 untuk mendukung kedua kartu -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya untuk Kartu Pertama */
        .card-type-1 {
            position: relative;
            overflow: hidden;
            height: 300px;
            cursor: pointer;
        }

        .card-type-1 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.2s;
        }

        .card-type-1:hover img {
            transform: scale(1.05);
        }

        .card-type-1 .card-body {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));
            color: white;
            padding: 15px;
        }

        .card-type-1 .card-body h5,
        .card-type-1 .card-body p {
            color: white;
        }

        /* Gaya untuk Kartu Kedua */
        .card-type-2 {
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 450px;
        }

        .card-type-2 .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-type-2 .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* Menampilkan 4 kartu per baris */
            gap: 1rem;
        }

        .card-type-2 .card-body p {
            margin: 0;
        }

        .btn-color {
            background-color: #D2B88D;
            color: white;
        }

        .see-all-button {
            position: absolute;
            bottom: -50px;
            right: 15px;
            display: none;
        }
    </style>
</head>

<body>
    <?= view('partials/navbar') ?>

    <!-- Container untuk Kartu Pertama -->
    <div class="container mt-5 position-relative">
        <h1 class="h3 py-4 mt-2 mb-2">Dashboard</h1>
        <div class="row" id="card-section">
            <div class="col-md-3">
                <div class="card card-type-1">
                    <a href="keranjang">
                        <img src="img/kentang.jpg" class="card-img-top" alt="Image 1">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">Card 1</h5>
                        <p class="card-text">Description for card 1.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-type-1">
                    <a href="keranjang">
                        <img src="img/kentang.jpg" class="card-img-top" alt="Image 2">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">Card 2</h5>
                        <p class="card-text">Description for card 2.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-type-1">
                    <a href="keranjang">
                        <img src="img/kentang.jpg" class="card-img-top" alt="Image 3">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">Card 3</h5>
                        <p class="card-text">Description for card 3.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-type-1">
                    <a href="keranjang">
                        <img src="img/kentang.jpg" class="card-img-top" alt="Image 4">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">Card 4</h5>
                        <p class="card-text">Description for card 4.</p>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-color see-all-button" id="see-all-button" onclick="location.href='/menu'">Lihat
            Semua</button>
    </div>

    <!-- Container untuk Kartu Kedua -->
    <div class="container">
        <h1 class="h3 py-4 mt-4 mb-2">Menu Pesan Sekarang</h1>
        <div class="card-container">
            <div class="card card-type-2">
                <img src="/img/kentang.jpg" class="card-img-top" alt="">
                <div class="card-body text-center">
                    <h5 class="card-title">Kentang Goreng</h5>
                    <p class="card-text">Ini kentang</p>
                    <p class="card-text">Rp 20.000</p>
                    <a href="#" class="btn btn-color">Pesan Sekarang</a>
                </div>
            </div>
            <!-- Tambahkan lebih banyak kartu di sini untuk melihat tampilan empat kartu per baris -->
            <div class="card card-type-2">
                <img src="/img/kentang.jpg" class="card-img-top" alt="">
                <div class="card-body text-center">
                    <h5 class="card-title">Kentang Rebus</h5>
                    <p class="card-text">Ini kentang rebus</p>
                    <p class="card-text">Rp 15.000</p>
                    <a href="#" class="btn btn-color">Pesan Sekarang</a>
                </div>
            </div>
            <div class="card card-type-2">
                <img src="/img/kentang.jpg" class="card-img-top" alt="">
                <div class="card-body text-center">
                    <h5 class="card-title">Kentang Panggang</h5>
                    <p class="card-text">Ini kentang panggang</p>
                    <p class="card-text">Rp 25.000</p>
                    <a href="#" class="btn btn-color">Pesan Sekarang</a>
                </div>
            </div>
            <div class="card card-type-2">
                <img src="/img/kentang.jpg" class="card-img-top" alt="">
                <div class="card-body text-center">
                    <h5 class="card-title">Kentang Asin</h5>
                    <p class="card-text">Ini kentang asin</p>
                    <p class="card-text">Rp 18.000</p>
                    <a href="#" class="btn btn-color">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap dan logika tombol "Lihat Semua" -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var cardSection = document.getElementById('card-section');
            var cards = cardSection.getElementsByClassName('col-md-3');
            var seeAllButton = document.getElementById('see-all-button');

            if (cards.length > 4) {
                seeAllButton.style.display = 'block';
            }
        });
    </script>
</body>

</html>