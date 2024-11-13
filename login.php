<?php
session_start();
if(isset($_SESSION['password']) && password_verify('sukubung42024', $_SESSION['password'])){
    header('Location: /');die;
}
$wrongPassword = false;
if(isset($_POST['password'])){
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if(password_verify('sukubung42024', $pass)){
        $_SESSION['password'] = $pass;
        header('Location: /');die;
    }
    else $wrongPassword = true;
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRI Suku Bunga | Login</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="h-100">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card p-3">
            <form method="POST" action="">
                <div class="mb-3">
                    <div class="text-center card-title">
                        <label for="exampleInputPassword1" class="form-label"><b>Password</b></label>
                    </div>
                    <input name="password" id="password" type="password" class="form-control <?php if($wrongPassword) echo "is-invalid" ?>" id="exampleInputPassword1">
                    <div class="invalid-feedback">Wrong Password !</div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.7.1.min.js"></script>
</body>
</html>