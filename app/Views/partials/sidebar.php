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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Custom Styling */
        .main-content {
            margin-left: 16rem;
            /* Sidebar width */
            padding: 10px;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 16rem;
            /* Sidebar width */
            height: 100vh;
            background-color: #1f2937;
            /* Tailwind's blue-900 */
            color: white;
        }

        .sidebar .sidebar-item {
            padding: 10px 0;
            margin-left: 20px;
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            border-radius: 0.25rem;
        }

        .sidebar .sidebar-item:hover {
            background-color: #1e40af;
            /* Tailwind's blue-800 */
        }

        .sidebar .sidebar-item.active {
            background-color: #1e3a8a;
            /* Tailwind's blue-700 */
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
    </style>
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <ul class="sidebar">
        <li class="text-2xl font-bold text-center mb-10 mt-6">Admin</li>
        <li>
            <a href="/admin/dashboard" class="sidebar-item" data-path="/admin/dashboard">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="/admin/pesanan" class="sidebar-item" data-path="/admin/pesanan">
                <i class="fas fa-fw fa-cog"></i>
                <span>Pesanan Masuk</span>
            </a>
        </li>
        <li>
            <a href="/admin/pembayaran" class="sidebar-item" data-path="/admin/pembayaran">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Bukti Bayar Masuk</span>
            </a>
        </li>
        <li>
            <a href="/admin/menu/" class="sidebar-item" data-path="/admin/menu/">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Lihat Tambah Menu</span>
            </a>
        </li>
        <li>
            <a href="/admin/pembayaran/riwayat" class="sidebar-item" data-path="/admin/pembayaran/riwayat">
                <i class="fas fa-fw fa-table"></i>
                <span>Riwayat Pembayaran</span>
            </a>
        </li>
        <li>
            <a href="/admin/user" class="sidebar-item" data-path="/admin/user">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Pengguna</span>
            </a>
        </li>
        <li>
            <a href="/admin/penjualan" class="sidebar-item" data-path="/admin/penjualan">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Penjual</span>
            </a>
        </li>
        <li>
            <a href="/admin/penjualan/laporanPenjualan" class="sidebar-item" data-path="/admin/penjualan/laporanPenjualan">
                <i class="fas fa-fw fa-table"></i>
                <span>Laporan Penjual</span>
            </a>
        </li>
        <li class="mt-auto">
            <a href="/logout" class="sidebar-item">
                <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Your main content here -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            const currentPath = window.location.pathname;

            sidebarItems.forEach(item => {
                const itemPath = item.getAttribute('data-path');

                // Exact match check
                if (currentPath === itemPath) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }

                item.addEventListener('click', () => {
                    sidebarItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                });
            });
        });
    </script>
</body>

</html>