<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at top left, #212c3d 0%, #171a21 100%);
            color: #afafaf;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Motiva Sans", Sans-serif;
        }
        .login-box {
            background: rgba(24, 26, 30, 0.8);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            border-radius: 4px;
        }
        h2 { color: #fff; text-transform: uppercase; letter-spacing: 2px; font-weight: 300; margin-bottom: 30px; }
        .form-label { color: #1999ff; text-transform: uppercase; font-size: 0.8rem; font-weight: bold; }
        .form-control { background-color: #32353c !important; border: none !important; color: #fff !important; border-radius: 2px; padding: 10px; }
        .form-control:focus { box-shadow: 0 0 5px #1999ff; }
        .btn-steam { background: linear-gradient(to right, #06bfff 0%, #2d73ff 100%); border: none; color: white; padding: 12px; width: 100%; margin-top: 20px; border-radius: 2px; font-weight: bold; }
        .btn-steam:hover { background: linear-gradient(to right, #41beff 0%, #568eff 100%); }
        .footer-links { margin-top: 20px; font-size: 0.85rem; }
        .footer-links a { color: #66c0f4; text-decoration: none; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Sign In</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger py-2" style="background: #4d1c1c; border: none; color: #ff8888; font-size: 0.8rem;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-4">
            <label class="form-label">Account Name</label>
            <input type="text" name="username" class="form-control" required value="<?= old('username') ?>">
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="remember" name="remember">
            <label class="form-check-label" for="remember" style="font-size: 0.85rem;">Remember me</label>
        </div>

        <button type="submit" class="btn btn-steam">Sign In</button>
    </form>

    <div class="footer-links text-center">
        <a href="#">Forgot your password?</a>
    </div>
</div>

</body>
</html>