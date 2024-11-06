<?php
    include "../koneksi.php";
    
    $query = mysqli_query($con, "SELECT * FROM config WHERE id =  1");
    $data_config = mysqli_fetch_object($query);
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
      .video-desc {
        display: block;
        width: 90%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        font-size:12px;
        font-weight:500;
        color:white;
      }
      .title-page {
        font-size:20px;
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
      .table tbody tr td{
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
    </style>
  </head>
  <body>
    <div class="container">

      <div class="row mt-2">
        <div class="col-7">
          <img src="/img/logo_bri.png" width="100%" alt="">
        </div>
        <div class="col-5 p-0 m-0">
          <div class="me-2 ps-2 pe-2 pt-1 pb-1" style="background-color:#ffff2f;border-radius:10px;">
            <div class="row">
              <div class="col-12">
                <div class="d-flex justify-content-center">
                  <div id="jam" style="font-size:20px; font-weight:700;"></div>
                </div>
              </div>
              <div class="col-12">
                <div class="d-flex justify-content-center">
                  <div id="tanggal" style="font-size:14px; font-weight:700;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-2" style="overflow:hidden;border-radius:10px;border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;">
        <!-- <iframe style="width: 100%; aspect-ratio: 16 / 9;" src="https://www.youtube.com/embed/ZqpHojVtVCE?playlist=ZqpHojVtVCE&showinfo=0&autohide=1&loop=1" allow="autoplay; encrypted-media" frameborder="0" id="youtube-video"></iframe> -->
          <div class="autoplay"></div>
      </div>
      <div class="w-100 p-1" style="background-color:#6e91b1; border-radius:5px;">
        <span class="video-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod minima ab hic recusandae. Laboriosam numquam facere alias debitis natus ipsum quae perferendis quibusdam quidem, ab odit! Laudantium odio autem veniam non doloremque aliquam, voluptate ex, incidunt repellat suscipit unde nostrum ipsam sint deserunt ea doloribus molestias quasi aut vero provident accusantium perspiciatis dolorum assumenda aperiam. Consectetur earum doloribus voluptatum consequuntur harum ea fuga maiores reprehenderit minima. Tempora excepturi, iusto magnam accusamus laboriosam ipsam aliquam illum, aperiam velit iste harum nam doloribus voluptatem facere, ducimus voluptates quibusdam. Officia excepturi eius, blanditiis voluptatum reprehenderit sit esse quis tempore dicta, voluptatem consequatur aspernatur.</span>
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

                    <div class="col-5 row">
                      <div class="col-12 p-0 m-0">
                          <img src="/img/flag/<?=$currency->flag?>" style="width:40px;" alt="">
                      </div>
                      <div class="col-12 p-0 m-0" style="font-size:12px; font-weight:700;">
                        <div class="d-flex justify-content-center me-1">
                          <?=$currency->currency?>
                        </div>
                      </div>
                    </div>

                    <div class="col p-0 m-0">
                      
                    <div class="row ps-3 pe-0 w-100">
                      <div class="col-12 p-0 m-0">
                        <div class="row p-0 m-0">
                          <div class="col-6 p-0 m-0">
                            Nilai / Value
                          </div>
                          <div class="col-6 p-0 m-0">
                            <div class="d-flex justify-content-end">
                            <?=$currency->value?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 p-0 m-0">
                        <div class="row p-0 m-0">
                          <div class="col-6 p-0 m-0">
                            Beli / Buy
                          </div>
                          <div class="col-6 p-0 m-0">
                            <div class="d-flex justify-content-end">
                            Rp. <?=number_format($currency->buy, 2, ',', '.');?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 p-0 m-0">
                        <div class="row p-0 m-0">
                          <div class="col-6 p-0 m-0">
                            Jual / Sell
                          </div>
                          <div class="col-6 p-0 m-0">
                            <div class="d-flex justify-content-end">
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
                    <div class="col-6" style="color:#233d90; font-size:22px; font-weight:800;">
                      Deposito
                    </div>
                    <div class="col-6 d-flex justify-content-end" style="color:#233d90; font-size:22px; font-weight:800;">
                      Rupiah
                    </div>
                  </div>
                  <table class="table mt-2" style="width: 100%;">
                    <tbody>
                      <tr>
                        <th class="ps-3">1 Bulan</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">3 Bulan</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">6 Bulan</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">12 Bulan</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">24 Bulan</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
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
                    <div class="col-6" style="color:#233d90; font-size:22px; font-weight:800;">
                      Britama
                    </div>
                    <!-- <div class="col-6 d-flex justify-content-end" style="color:#233d90; font-size:22px; font-weight:800;">
                      Rupiah
                    </div> -->
                  </div>
                  <table class="table mt-2" style="width: 100%;">
                    <tbody>
                      <tr>
                        <th class="ps-3">0 S/D 1 JUTA </th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">> 1 JUTA S/D 50 JUTA</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">> 50 JUTA S/D < 500 JUTA</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">> 500 JUTA S/D 1 MILYAR</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">> 1 MILYAR</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
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
                    <div class="col-6" style="color:#233d90; font-size:22px; font-weight:800;">
                      Simpedes
                    </div>
                    <!-- <div class="col-6 d-flex justify-content-end" style="color:#233d90; font-size:22px; font-weight:800;">
                      Rupiah
                    </div> -->
                  </div>
                  <table class="table mt-2" style="width: 100%;">
                    <tbody>
                      <tr>
                        <th class="ps-3">0 S/D 1 JUTA </th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">> 1 JUTA S/D 50 JUTA</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">> 50 JUTA S/D < 500 JUTA</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">> 500 JUTA S/D 1 MILYAR</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
                      <tr>
                      <th class="ps-3">> 1 MILYAR</th>
                        <td class="d-flex justify-content-end pe-3">3,35 %</td>
                      </tr>
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
      <div style="position:absolute; bottom:2px; right:5px; font-size:12px;font-weight:500;color:#444444;"><div id="ip"></div></div>
      
      <?php
      }
      ?>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script>
      
      var iframe = null;
      iframe = document.createElement('iframe');
      iframe.setAttribute('src', `https://www.youtube.com/embed/ZqpHojVtVCE?autoplay=1&playlist=ZqpHojVtVCE&showinfo=0&autohide=1&loop=1`);
      iframe.setAttribute('frameborder', '0');
      iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
      iframe.setAttribute('allowfullscreen', '');
      iframe.setAttribute('style', 'width: 100%; aspect-ratio: 16 / 9;');
      document.querySelector('.autoplay').appendChild(iframe);
  
      document.addEventListener("keypress", function(event) {
        // if(iframe == null){
          run_iframe();
        // }
      });
    
    function run_iframe(){        
        document.querySelector('.autoplay').appendChild(iframe);
      }

      updateTime();
      function updateTime(){
        var currentdate = new Date();
        var month = ["Januari", "Februari",  "Maret",  "April",  "Mei",  "Juni",  "Juli",  "Agustus",  "September",  "Oktober",  "November",  "Desember"];
        document.getElementById("jam").innerHTML = currentdate.getHours() + ":" + (currentdate.getMinutes() < 10 ? "0" : "") + currentdate.getMinutes() + ":" + (currentdate.getSeconds() < 10 ? "0" : "") + currentdate.getSeconds();
        document.getElementById("tanggal").innerHTML = currentdate.getDate() + " " + month[currentdate.getMonth()] + " " + currentdate.getFullYear();
        
        <?php
        if($data_config->enable_ajax_ip == 1){
        ?>

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("ip").innerHTML = this.responseText;
          }
        xhttp.open("GET", "/getip.php", true);
        xhttp.send();
        
        <?php } ?>
        // run_iframe();
      }
      
      setInterval(updateTime, 1000);
    </script>
  </body>
</html>