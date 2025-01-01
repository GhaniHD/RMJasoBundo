<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Page Wrapper -->
    <div id="wrapper" class="flex">

        <!-- Sidebar -->
        <?php echo view('partials/sidebar'); ?>

        <!-- Content Wrapper -->
        <div class="flex-1 flex flex-col">
            <!-- Main Content -->
            <main class="flex-1 bg-gray-100 p-6">
                <div class="mb-4">
                    <h1 class="text-2xl font-semibold text-gray-800">Manage Facility</h1>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Card Example -->
                    <a href="/admin/pesanan/">
                        <div class="bg-white shadow-md rounded-md overflow-hidden">
                            <div class="flex items-center justify-between p-4 bg-blue-900 text-white">
                                <h6 class="font-semibold">Pesanan Masuk</h6>
                            </div>
                            <div class="flex w-full h-full justify-center">
                                <img src="/img/pesanan_masuk.png" alt="" class="w-64 h-64 object-cover">
                            </div>
                        </div>
                    </a>


                    <a href="/admin/pesanan/">
                        <div class="bg-white shadow-md rounded-md overflow-hidden">
                            <div class="flex items-center justify-between p-4 bg-blue-900 text-white">
                                <h6 class="font-semibold">Konfirmasi Pesanan</h6>

                            </div>
                            <div class="flex w-full h-full justify-center">
                                <img src="/img/konfirmasi_pesanan.png" alt="" class="w-60 h-64 object-cover">
                            </div>
                        </div>
                    </a>

                    <a href="/admin/menu/">
                        <div class="bg-white shadow-md rounded-md overflow-hidden">
                            <div class="flex items-center justify-between p-4 bg-blue-900 text-white">
                                <h6 class="font-semibold">Tambah Menu</h6>

                            </div>
                            <div class="flex w-full h-full justify-center">
                                <img src="/img/tambah_menu.png" alt="" class="w-64 h-64 object-cover">
                            </div>
                        </div>
                    </a>

                    <a href="/admin/user">
                        <div class="bg-white shadow-md rounded-md overflow-hidden">
                            <div class="flex items-center justify-between p-4 bg-blue-900 text-white">
                                <h6 class="font-semibold">Data Pengguna</h6>

                            </div>
                            <div class="flex w-full h-full justify-center">
                                <img src="/img/data_pengguna.png" alt="" class="w-64 h-64 object-cover">
                            </div>
                        </div>
                    </a>

                    <a href="/admin/penjualan/">
                        <div class="bg-white shadow-md rounded-md overflow-hidden">
                            <div class="flex items-center justify-between p-4 bg-blue-900 text-white">
                                <h6 class="font-semibold">Data Penjualan</h6>

                            </div>
                            <div class="flex w-full h-full justify-center">
                                <img src="/img/data_penjualan.png" alt="" class="w-72 h-72 object-cover">
                            </div>
                        </div>
                    </a>

                    <a href="/admin/penjualan/laporanPenjualan">
                        <div class="bg-white shadow-md rounded-md overflow-hidden">
                            <div class="flex items-center justify-between p-4 bg-blue-900 text-white">
                                <h6 class="font-semibold">Laporan Penjualan</h6>

                            </div>
                            <div class="flex w-full h-full justify-center">
                                <img src="/img/laporan_penjualan.png" alt="" class="w-72 h-72 object-cover">
                            </div>
                        </div>
                    </a>
                </div>
            </main>
        </div>
    </div>

    <!-- Logout Modal -->
    <!-- <div class="fixed inset-0 z-50 flex items-center justify-center hidden" id="logoutModal">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h5 class="text-xl font-semibold mb-4">Ready to Leave?</h5>
            <p class="mb-4">Select "Logout" below if you are ready to end your current session.</p>
            <div class="flex justify-end">
                <button class="bg-gray-500 text-white px-4 py-2 rounded mr-2"
                    onclick="document.getElementById('logoutModal').classList.add('hidden')">Cancel</button>
                <a href="logout.html" class="bg-blue-500 text-white px-4 py-2 rounded">Logout</a>
            </div>
        </div>
    </div> -->

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.js"></script>
</body>

</html>