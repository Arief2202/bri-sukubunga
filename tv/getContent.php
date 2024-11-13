<?php
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if($ip != "::1" && $ip != "127.0.0.1"){
      http_response_code(404);
      die;
    }

    include "../koneksi.php";
    header("Content-Type: application/json");
    $datas = mysqli_fetch_object(mysqli_query($con, "SELECT * FROM `config` WHERE id = 1"));

    $depositos_query = mysqli_query($con, "SELECT * FROM suku_bunga WHERE section = 'deposito'");
    $depositos;
    while($dat = mysqli_fetch_object($depositos_query)) $depositos[] = $dat;
    
    $simpedes_query = mysqli_query($con, "SELECT * FROM suku_bunga WHERE section = 'simpedes'");
    $simpedes;
    while($dat = mysqli_fetch_object($simpedes_query)) $simpedes[] = $dat;
    
    $britama_query = mysqli_query($con, "SELECT * FROM suku_bunga WHERE section = 'britama'");
    $britama;
    while($dat = mysqli_fetch_object($britama_query)) $britama[] = $dat;

    $exrate_query = mysqli_query($con, "SELECT * FROM kurs");
    $exrate;
    while($dat = mysqli_fetch_object($exrate_query)) $exrate[] = $dat;

    $suku_bunga;
    echo json_encode([
        "config" => $datas,
        "deposito" => $depositos,
        "britama" => $britama,
        "simpedes" => $simpedes,
        "exchange_rate" => $exrate
    ]);
?>