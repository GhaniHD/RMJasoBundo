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

        .nav-link.active {
            color: #D2B88D !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg">
        <div class="container">
            <h2><a class="navbar-brand px-4" href="/">JasoBundo</a></h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu Katering</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Lihat Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/pembayaran">Upload Pembayaran</a>
                    </li>
                </ul>
                <form class="d-flex justify-content-end px-4">
                    <a href="/user/keranjang" class="btn btn-color position-relative me-3">
                        <i class="fas fa-cart-shopping"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                            1
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-color dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profil">Profil <span class="position-absolute p-1 bg-danger border border-light rounded-circle"><span class="visually-hidden"></span></span></a></li>
                            <li><a class="dropdown-item" href="/transaksi">Transaksi<span class="position-absolute p-1 bg-danger border border-light rounded-circle"><span class="visually-hidden"></span></span></a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <section class="vh-100">
        <div class="container d-flex flex-column gap-3">
            <h3 class="mt-5 mb-3">Lengkapi data diri anda</h3>

            <div class="d-flex  w-auto h-100" style="justify-content: space-between;">
                <!-- foto profil -->
                <aside class="d-flex flex-column">
                    <div class="foto-profile bg-secondary" style="width: 14rem; height: 14rem">

                    </div>
                    <button class="btn btn-color mt-3">Pilih File</button>
                </aside>

                <!-- data diri -->
                <aside class="d-flex">
                    <form action="" class="d-flex flex-column gap-4">
                        <div class="form-group d-flex">
                            <label for="name">nama pengguna</label>
                            <input type="text" class="form-control" id="name" style="width: 18rem; height: 2rem; margin-left: 77px">
                        </div>
                        <div class="form-group d-flex">
                            <label for="email">alamat email</label>
                            <input type="email" class="form-control" id="email" style="width: 18rem; height: 2rem; margin-left: 103px;">
                        </div>
                        <div class="form-group d-flex">
                            <label for="text">nomor telepon</label>
                            <input type="text" class="form-control" id="email" style="width: 18rem; height: 2rem; margin-left: 87px;">
                        </div>
                        <div class="form-group d-flex">
                            <label for="text">password</label>
                            <input type="text" class="form-control" id="email" style="width: 18rem; height: 2rem; margin-left: 126px;">
                        </div>
                        <div class="form-group d-flex" style="gap: 3rem;">
                            <label for="text">konfirmasi password</label>
                            <input type="text" class="form-control" id="email" style="width: 18rem; height: 2rem;">
                        </div>
                        <div class="d-flex justify-content-end"><button class="btn btn-color">Simpan Data</button></div>
                    </form>
                </aside>
            </div>
        </div>
    </section>

    <script>
        // Fungsi untuk menambahkan kelas 'active' ke link yang sesuai
        function setActiveLink() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        }

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', setActiveLink);
    </script>
</body>

</html>