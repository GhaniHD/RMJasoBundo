<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- MDBootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .cascading-right {
            margin-right: -50px;
        }

        @media (max-width: 991.98px) {
            .cascading-right {
                margin-right: 0;
            }
        }

        .card {
            max-width: 400px;
            margin: auto;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .btn-color {
            background-color: #D2B88D;
            /* Warna krem */
            color: white;
            /* Warna teks hitam, sesuaikan jika diperlukan */
        }
    </style>
</head>

<body>
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start">
        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="card cascading-right bg-body-tertiary" style="backdrop-filter: blur(30px);">
                <div class="card-body p-5 shadow-5 text-center">
                    <h2 class="fw-bold mb-5">Sign up now</h2>
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div>
                            <ul>
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('register') ?>" method="post">
                        <?= csrf_field() ?>
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" id="form3Example3" name="email" class="form-control" placeholder="email"
                                required>
                            <label class="form-label" for="form3Example3">Email </label>
                        </div>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="form3Example3" name="nama" class="form-control"
                                placeholder="username" required>
                            <label class="form-label" for="form3Example3">Username </label>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="tel" id="form3Example3" name="no_telp" class="form-control"
                                placeholder="nomer telpon" required>
                            <label class="form-label" for="form3Example3">Nomer Telepon</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" id="form3Example4" name="password" class="form-control" required>
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" id="form3Example4" name="password_confirm" class="form-control"
                                required>
                            <label class="form-label" for="form3Example4">Re-password</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-color btn-block mb-4">
                            Sign up
                        </button>
                    </form>
                    <p>Sudah punya akun? <a href="<?= base_url('login') ?>">Login di sini</a></p>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->

    <!-- MDBootstrap JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
</body>

</html>