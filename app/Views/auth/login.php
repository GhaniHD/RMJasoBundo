<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container-fluid {
            height: 100vh;
        }

        .row {
            height: 100%;
            display: flex;
        }

        .text-black {
            color: #000;
        }

        .h-custom-2 {
            height: calc(100% - 6rem);
        }

        .form-control {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .form-outline {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-outline input {
            width: 100%;
            padding: 1rem;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }

        .form-outline label {
            position: absolute;
            top: 50%;
            left: 0.75rem;
            transform: translateY(-50%);
            background-color: #fff;
            padding: 0 0.25rem;
            pointer-events: none;
            transition: all 0.3s;
        }

        .form-outline input:focus+label,
        .form-outline input:not(:placeholder-shown)+label {
            top: 0;
            transform: translateY(-100%);
            font-size: 0.75rem;
            color: #495057;
        }

        .btn {
            padding: 0.75rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            color: #fff;
            background-color: #007BFF;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color:  #f8d7da;
        }

        .vh-100 {
            height: 100vh;
        }

        .h1 {
            font-size: 2rem;
        }

        .fw-bold {
            font-weight: bold;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .pb-3 {
            padding-bottom: 1rem;
        }

        .text-center {
            text-align: center;
        }

        .link-info {
            color: #D2B88D ;
        }

        .link-info:hover {
            color: #138496;
        }

        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
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
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">
                    <div class="px-5 ms-xl-4">
                        <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
                        <span class="h1 fw-bold mb-0">JasoBundo.</span>
                    </div>

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form action="<?= base_url('login') ?>" method="post" style="width: 23rem;">
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                            <?= csrf_field() ?>

                            <?php if (session()->getFlashdata('errors')): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>

                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control"
                                    value="<?= old('email') ?>" required>
                                <label class="form-label" for="email">Email address</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control" required>
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <div class="pt-1 mb-4">
                                <button class="btn btn-color btn-lg btn-block" type="submit">Login</button>
                            </div>

                            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                            <p>Don't have an account? <a href="<?= base_url('register') ?>" class="link-info">Register
                                    here</a></p>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="/img/bg.png"
                        alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>