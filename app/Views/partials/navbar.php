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
            <h2><a class="navbar-brand px-4" href="/user/dashboard">JasoBundo</a></h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/menu">Menu Katering</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/pesanan">Lihat Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/pembayaran">Upload Pembayaran</a>
                    </li>
                </ul>
                <form class="d-flex justify-content-end px-4">
                    <a href="/user/keranjang" class="btn btn-color position-relative me-3">
                        <i class="fas fa-cart-shopping"></i>
                        </span>
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-color dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/user/profile">Profil <span
                                        class="position-absolute p-1 bg-danger border border-light rounded-circle"><span
                                            class="visually-hidden"></span></span></a></li>
                            <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </nav>

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