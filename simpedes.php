<?php
    session_start();
    if(!isset($_SESSION['password'])){
        header('Location: login.php');die;
    }
    else{
        if(!password_verify('sukubung42024', $_SESSION['password'])){
            header('Location: login.php');die;
        }
    }
    if(isset($_GET['logout']) || isset($_POST['logout']) ){
        session_reset();
        session_unset();
        header('Location: /');
        die;
    }
    include "koneksi.php";
    if(isset($_POST['update']) ){
        $id = $_POST['id'];
        $label = $_POST['label'];
        $value = $_POST['value'];

        $sql = "UPDATE `suku_bunga` SET `label` = '$label', `value` = '$value' WHERE `suku_bunga`.`id` = $id;";
        $result = mysqli_query($con, $sql);
        header('Location: /simpedes.php');        
    }
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRI Suku Bunga | Simpedes</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Suku Bunga (Simpedes)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto me-3">
                <a class="nav-link" href="/">Video</a>
                <a class="nav-link" href="/kurs.php">Nilai Tukar</a>
                <a class="nav-link" href="/deposito.php">Deposito</a>
                <a class="nav-link" href="/britama.php">Britama</a>
                <a class="nav-link active" href="/simpedes.php">Simpedes</a>
            </div>
            <div class="navbar-nav">
                <a class="btn btn-danger " href="/index.php?logout=true" >Logout</a>
            </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5" style="max-width: 300px;">
        <div class="row">
            <?php 
            $query = mysqli_query($con, "SELECT * FROM suku_bunga WHERE section = 'simpedes'");
            while($data = mysqli_fetch_object($query)){
            ?>
                <div class="col-auto p-3">
                    <div class="card p-3" >
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?=$data->id?>">
                            <div class="row">
                                <div class="col-12 p-1 pt-0 pb-0">
                                    <label>Label</label>
                                    <input class="form-control form-control-sm" value="<?= $data->label ?>" name="label">
                                </div>
                                <div class="col-12 p-1 pt-0 pb-0 mt-2">
                                    <label>Value</label>
                                    <input class="form-control form-control-sm" value="<?= $data->value ?>" name="value">
                                </div>
                            </div>
                            <div class="row ps-2 pe-2 mt-3">
                            <button class="btn btn-success" type="sumbit" name="update">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.7.1.min.js"></script>
</body>
</html>