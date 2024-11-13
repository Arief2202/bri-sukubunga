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
    $query = mysqli_query($con, "SELECT * FROM config WHERE id =  1");
    $data_config = mysqli_fetch_object($query);
    
    $depositos_query = mysqli_query($con, "SELECT * FROM suku_bunga WHERE section = 'deposito'");
    $simpedes_query = mysqli_query($con, "SELECT * FROM suku_bunga WHERE section = 'simpedes'");    
    $britama_query = mysqli_query($con, "SELECT * FROM suku_bunga WHERE section = 'britama'");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BRI Suku Bunga</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body{
        background: #98b0bc;
        background: linear-gradient(0deg, #869aa3 50%, #ffffff 100%);
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
      }
      .running-text {
        display: block;
        width: 100%;
        /* overflow: hidden; */
        white-space: nowrap;
        /* text-overflow: ellipsis; */
        font-size:3vw;
        font-weight:500;
        color:white;
      } 
      .title-page {
        font-size:5vw;
        font-weight:700;
        color:white;
      }
      .table tbody tr th, .table tbody tr td{
        color:white;
        background-color: transparent;
        border-color: transparent;
        padding: 0;
        margin: 0;
      }
      .table tbody tr th{
        font-size: 4vw;
      }
      .table tbody tr td{
        font-size: 4vw;
        font-weight: 700;
      }
      .table tbody tr:nth-child(odd) {
        background-color: rgba(0, 0, 0, 0.2);
      }

      #mute {
        cursor:pointer;
        padding: 10px 20px;
        background:#000;
        color: #fff;
        border-radius: 4px;
        display: inline-block;
      }

      .content-title{
        font-size: 2.2vw;
      }
      .content-value{
        font-size: 2.2vw;
      }
    </style>
  </head>
  <body>
    <div class="container w-100">

      <div class="row mt-2">
        <div class="col-7">
          <img src="/img/logo_bri.png" alt="" style="width:43vw;">
        </div>
        <div class="col-5 p-0 m-0">
          <div class="me-2 ps-2 pe-2 pt-1 pb-1" style="background-color:#ffff2f;border-radius:10px;">
            <div class="row">
              <div class="col-12">
                <div class="d-flex justify-content-center">
                  <div id="jam" style="font-size:4vw; font-weight:700;"></div>
                </div>
              </div>
              <div class="col-12">
                <div class="d-flex justify-content-center">
                  <div id="tanggal" style="font-size:3vw; font-weight:700;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-2" style="overflow:hidden;border-radius:10px;border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;">
        <!-- <iframe style="width: 100%; aspect-ratio: 16 / 9;" src="https://www.youtube.com/embed/ZqpHojVtVCE?playlist=ZqpHojVtVCE&showinfo=0&autohide=1&loop=1" allow="autoplay; encrypted-media" frameborder="0" id="youtube-video"></iframe> -->
          <div class="videoSection" id="videoSection"></div>
      </div>

      <div class="w-100 mt-2 p-1" style="background-color:#6e91b1; border-radius:5px;" id="scroll-container">
        <marquee scrollamount="10" class="running-text"><?=$data_config->running_text?></marquee>
      </div>

      <div class="mt-1">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
          <div class="carousel-inner">


            <div class="carousel-item active">
              <div>
                <div class="title-page">Nilai Tukar / Exchange Rate</div>
              </div>
              <div class="row pe-2 ps-2 pb-2">
                <?php 
                  $result = mysqli_query($con, "SELECT * FROM kurs");

                  while($currency = mysqli_fetch_object($result)){
                ?>
                <div class="col-6 d-flex justify-content-center m-0 ps-1 pe-1">
                  <div class="row p-1 mt-2 pe-0" style="font-size:8.5px; color:white; background-color:#6e91b1; border-radius:5px; width:100%">

                    <div class="col-4 row mt-1">
                      <div class="col-12 p-0 m-0">
                        <div class="d-flex justify-content-center">
                            <img class="exchange-rate-flag" src="/img/flag/<?=$currency->flag?>" style="width:8vw;" alt="">
                        </div>
                      </div>
                      <div class="col-12 p-0 m-0" style="font-size:3vw; font-weight:700;">
                        <div class="d-flex justify-content-center exchange-rate-currency">
                          <?=$currency->currency?>
                        </div>
                      </div>
                    </div>

                    <div class="col p-0 m-0">
                      
                    <div class="row ps-3 pe-0 w-100">
                      <div class="col-12 p-0 m-0">
                        <div class="row p-0 m-0">
                          <div class="col-6 p-0 m-0 content-title">
                            Nilai / Value
                          </div>
                          <div class="col-6 p-0 m-0">
                            <div class="d-flex justify-content-end content-value exchange-rate-value">
                            <?=$currency->value?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 p-0 m-0">
                        <div class="row p-0 m-0">
                          <div class="col-6 p-0 m-0 content-title">
                            Beli / Buy
                          </div>
                          <div class="col-6 p-0 m-0">
                            <div class="d-flex justify-content-end content-value exchange-rate-buy">
                            Rp. <?=number_format($currency->buy, 2, ',', '.');?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 p-0 m-0">
                        <div class="row p-0 m-0">
                          <div class="col-6 p-0 m-0 content-title">
                            Jual / Sell
                          </div>
                          <div class="col-6 p-0 m-0">
                            <div class="d-flex justify-content-end content-value exchange-rate-sell">
                            Rp. <?=number_format($currency->sell, 2, ',', '.');?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>

            <div class="carousel-item">
              <div>
                <div class="title-page">Suku Bunga (% P/A)</div>
                
                <div class="w-100 p-0 mt-3" style="background-color:#6e91b1; border-radius:5px;">
                  <div class="row ps-2 pe-2 pt-1">
                    <div class="col-6" style="color:#233d90; font-size:5vw; font-weight:800;">
                      Deposito
                    </div>
                    <div class="col-6 d-flex justify-content-end" style="color:#233d90; font-size:5vw; font-weight:800;">
                      Rupiah
                    </div>
                  </div>
                  <table class="table mt-2" style="width: 100%;">
                    <tbody>
                      <?php while($dat = mysqli_fetch_object($depositos_query)) { ?>
                      <tr>
                        <th class="ps-3 deposito-label"><?=$dat->label?></th>
                        <td class="d-flex justify-content-end pe-3 deposito-value"><?=$dat->value?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>

            <div class="carousel-item">
              <div>
                <div class="title-page">Suku Bunga (% P/A)</div>
                
                <div class="w-100 p-0 mt-3" style="background-color:#6e91b1; border-radius:5px;">
                  <div class="row ps-2 pe-2 pt-1">
                    <div class="col-6 p-2 ps-3">
                        <img src="/img/britama.png" alt="" style="width:30vw;">
                    </div>
                  </div>
                  <table class="table mt-2" style="width: 100%;">
                    <tbody>
                      <?php while($dat = mysqli_fetch_object($britama_query)) { ?>
                      <tr>
                        <th class="ps-3 britama-label"><?=$dat->label?></th>
                        <td class="d-flex justify-content-end pe-3 britama-value"><?=$dat->value?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>

            <div class="carousel-item">
              <div>
                <div class="title-page">Suku Bunga (% P/A)</div>
                
                <div class="w-100 p-0 mt-3" style="background-color:#6e91b1; border-radius:5px;">
                  <div class="row ps-2 pe-2 pt-1">
                    <div class="col-6 ps-3 pt-3 pb-1">
                        <img src="/img/simpedes.png" alt="" style="width:30vw;">
                    </div>
                  </div>
                  <table class="table mt-2" style="width: 100%;">
                    <tbody>
                      <?php while($dat = mysqli_fetch_object($simpedes_query)) { ?>
                      <tr>
                        <th class="ps-3 simpedes-label"><?=$dat->label?></th>
                        <td class="d-flex justify-content-end pe-3 simpedes-value"><?=$dat->value?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>

      <?php
        if($data_config->enable_ajax_ip == 1){
        ?>
      <div style="position:absolute; bottom:2px; right:5px; font-size:2vw;font-weight:500;color:#555555;"><div id="ip"></div></div>
      
      <?php
      }
      ?>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script>
      function formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
        try {
          decimalCount = Math.abs(decimalCount);
          decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

          const negativeSign = amount < 0 ? "-" : "";

          let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
          let j = (i.length > 3) ? i.length % 3 : 0;

          return "Rp. " + negativeSign +
            (j ? i.substr(0, j) + thousands : '') +
            i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) +
            (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
          console.log(e)
        }
      };

      var video_id = "<?=$data_config->video_id?>";
      var playlist_id = "<?=$data_config->playlist_id?>";

  
      document.addEventListener("keypress", function(event) {
        run_iframe(video_id, playlist_id);
      });
    
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

      $(document).ready(function(){
        run_iframe(video_id, playlist_id);

        setInterval(function(){
            
          var currentdate = new Date();
          var month = ["Januari", "Februari",  "Maret",  "April",  "Mei",  "Juni",  "Juli",  "Agustus",  "September",  "Oktober",  "November",  "Desember"];
          document.getElementById("jam").innerHTML = currentdate.getHours() + ":" + (currentdate.getMinutes() < 10 ? "0" : "") + currentdate.getMinutes() + ":" + (currentdate.getSeconds() < 10 ? "0" : "") + currentdate.getSeconds();
          document.getElementById("tanggal").innerHTML = currentdate.getDate() + " " + month[currentdate.getMonth()] + " " + currentdate.getFullYear();
          const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            response = JSON.parse(this.responseText);
            
            document.querySelector('.running-text').innerHTML = response['config']['running_text'];
            
            if(video_id != response['config']['video_id'] || playlist_id != response['config']['playlist_id']){
              video_id = response['config']['video_id'];
              playlist_id = response['config']['playlist_id'];
              run_iframe(video_id, playlist_id);
            }
            
            for(var a = 0; a<document.querySelectorAll('.deposito-label').length; a++){
              document.querySelectorAll('.deposito-label')[a].innerHTML = response['deposito'][a]['label'];
              document.querySelectorAll('.deposito-value')[a].innerHTML = response['deposito'][a]['value'];
            }
            for(var a = 0; a<document.querySelectorAll('.britama-label').length; a++){
              document.querySelectorAll('.britama-label')[a].innerHTML = response['britama'][a]['label'];
              document.querySelectorAll('.britama-value')[a].innerHTML = response['britama'][a]['value'];
            }
            for(var a = 0; a<document.querySelectorAll('.simpedes-label').length; a++){
              document.querySelectorAll('.simpedes-label')[a].innerHTML = response['simpedes'][a]['label'];
              document.querySelectorAll('.simpedes-value')[a].innerHTML = response['simpedes'][a]['value'];
            }

            for(var a = 0; a<document.querySelectorAll('.exchange-rate-flag').length; a++){

              document.querySelectorAll('.exchange-rate-flag')[a].src = "/img/flag/"+response['exchange_rate'][a]['flag'];
              document.querySelectorAll('.exchange-rate-currency')[a].innerHTML = response['exchange_rate'][a]['currency'];
              document.querySelectorAll('.exchange-rate-value')[a].innerHTML = response['exchange_rate'][a]['value'];
              document.querySelectorAll('.exchange-rate-buy')[a].innerHTML = formatMoney(response['exchange_rate'][a]['buy']);
              document.querySelectorAll('.exchange-rate-sell')[a].innerHTML = formatMoney(response['exchange_rate'][a]['sell']);
            }
          }
          // run_iframe("5QLF3pfZv5Q", "list=PLC6gYrTu9CFpDDQCUn1UKkLlgKFXBMk31");
          xhttp.open("GET", "/tv/getContent.php", true);
          xhttp.send();          
        }, 1000);
      });
    </script>
  </body>
</html>