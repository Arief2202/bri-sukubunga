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
        $video_id = $_POST['video_id'];
        $playlist_id = $_POST['playlist_id'];
        $running_text = $_POST['running_text'];
        
        $sql = "UPDATE `config` SET `video_id` = '$video_id', `playlist_id` = '$playlist_id', `running_text` = '$running_text' WHERE `config`.`id` = $id;";
        $result = mysqli_query($con, $sql);
        header('Location: /');        
    }
    
    $query = mysqli_query($con, "SELECT * FROM config WHERE id =  1");
    $data_config = mysqli_fetch_object($query);
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRI Suku Bunga | Nilai Tukar</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Video Setting</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto me-3">
                <a class="nav-link active" href="/">Video</a>
                <a class="nav-link" href="/kurs.php">Nilai Tukar</a>
                <a class="nav-link" href="/deposito.php">Deposito</a>
                <a class="nav-link" href="/britama.php">Britama</a>
                <a class="nav-link" href="/simpedes.php">Simpedes</a>
            </div>
            <div class="navbar-nav">
                <a class="btn btn-danger " href="/index.php?logout=true" >Logout</a>
            </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 d-flex justify-content-center w-100" style="max-width: 400px;">
        <div class="row">
            <div class="col-auto p-3">
                <div class="card p-3" >
                    <form method="POST" action="">
                        <input type="hidden" name="id" value="<?=$data_config->id?>">
                        <div class="row">
                            <div class="col-12 p-1 pt-0 pb-0 d-flex justify-content-center mb-3">
                                <div class="videoSection" id="videoSection"></div>
                            </div>
                            <div class="col-12 p-1 pt-0 pb-0">
                                <label>Video ID</label>
                                <input class="form-control form-control-sm" value="<?= $data_config->video_id ?>" name="video_id">
                            </div>
                            <div class="col-12 p-1 pt-0 pb-0">
                                <label>Playlist ID</label>
                                <input class="form-control form-control-sm" value="<?= $data_config->playlist_id ?>" name="playlist_id">
                            </div>
                            <div class="col-12 p-1 pt-0 pb-0">
                                <label>Running Text</label>
                                <textarea class="form-control form-control-sm" name="running_text"><?= $data_config->running_text ?></textarea>
                            </div>
                        </div>
                        <div class="row ps-2 pe-2 mt-3">
                            <button class="btn btn-success" type="sumbit" name="update">Update</button>
                        </div>
                    </form>
                </div>
            </div>
                
        </div>
    </div>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery-3.7.1.min.js"></script>
<script>
      var video_id = "<?=$data_config->video_id?>";
      var playlist_id = "<?=$data_config->playlist_id?>";
      run_iframe(video_id, playlist_id);
    
      function run_iframe(video_id, playlist_id){        
        const list = document.querySelector('.videoSection');
        while (list.hasChildNodes()) {
          list.removeChild(list.firstChild);
        }        
        var iframe = null;
        iframe = document.createElement('iframe');
        iframe.setAttribute('src', 'https://www.youtube.com/embed/' + video_id + '?autoplay=1&' + playlist_id + '&showinfo=0&autohide=1&loop=1');
        iframe.setAttribute('frameborder', '0');
        iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
        iframe.setAttribute('allowfullscreen', '');
        iframe.setAttribute('style', 'width: 100%; aspect-ratio: 16 / 9;');
        list.appendChild(iframe);
      }
    </script>
</body>
</html>