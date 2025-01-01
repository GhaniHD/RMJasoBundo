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

    <?= view('partials/navbar') ?>

    <section class="vh-100">
        <div class="container d-flex flex-column gap-3">
            <h3 class="mt-5 mb-3">Lengkapi data diri anda</h3>

            <div class="d-flex w-auto h-100" style="justify-content: space-between;">
                <!-- foto profil -->
                <aside class="d-flex flex-column">
                    <div class="foto-profile bg-secondary" id="profile-picture" style="width: 14rem; height: 14rem">
                        <img src="<?= base_url('uploads/profile/' . ($user['profile'] ?? 'default.jpg')) ?>"
                            alt="Foto Profil" id="profile-img" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <button class="btn btn-color mt-3" onclick="document.getElementById('profile-input').click()">Pilih
                        File</button>
                </aside>

                <!-- data diri -->
                <aside class="d-flex">
                    <form action="<?= base_url("/user/profile/update/") . session()->get('id_user') ?>" method="POST"
                        enctype="multipart/form-data" class="d-flex flex-column gap-4">

                        <?= csrf_field() ?>
                        <div class="form-group d-flex">
                            <label for="name">Nama Pengguna</label>
                            <input type="text" name="nama" class="form-control" id="name"
                                style="width: 18rem; height: 2rem; margin-left: 77px"
                                value="<?= old('nama', $userData['nama']) ?>">
                        </div>
                        <div class="form-group d-flex">
                            <label for="email">Alamat Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                style="width: 18rem; height: 2rem; margin-left: 103px;"
                                value="<?= old('email', $user['email']) ?>">
                        </div>
                        <div class="form-group d-flex">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" name="no_telp" class="form-control" id="no_telp"
                                style="width: 18rem; height: 2rem; margin-left: 84px;"
                                value="<?= old('no_telp', $userData['no_telp']) ?>">
                        </div>
                        <div class="form-group d-flex">
                            <label for="alamat">Alamat Lengkap</label>
                            <input type="text" name="alamat" class="form-control" id="alamat"
                                style="width: 18rem; height: 2rem; margin-left: 81px;"
                                value="<?= old('alamat', $userData['alamat']) ?>">
                        </div>
                        <div class="form-group d-flex">
                            <label for="kd_pos">Kode Pos</label>
                            <input type="text" name="kd_pos" class="form-control" id="kd_pos"
                                style="width: 18rem; height: 2rem; margin-left: 129px;"
                                value="<?= old('kd_pos', $userData['kd_pos']) ?>">
                        </div>
                        <div class="form-group d-flex">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                style="width: 18rem; height: 2rem; margin-left: 128px;">
                        </div>
                        <div class="form-group d-flex" style="gap: 3rem;">
                            <label for="confirm_password">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                                style="width: 18rem; height: 2rem; margin-left: 2px;">
                        </div>
                        <input type="file" id="profile-input" name="profile" style="display: none;" accept="image/*">
                        <div class="d-flex justify-content-end"><button class="btn btn-color">Simpan Data</button></div>
                    </form>
                </aside>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('profile-input').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('profile-img').src = e.target.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>