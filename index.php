<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Icon Web -->
    <link rel="shortcut icon" href="airplane.png" type="image/x-icon">

    <!-- Title Web -->
    <title>Tiket Murah</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- CSS -->
    <style>
    </style>
</head>
<body>
    <!-- Jumbotron Bootstrap -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Welcome To Tiket Murah!</h1>
            <p class="lead">Website untuk mencari Tiket Murah. Website ini menggunakan Tiket.com API</p>
            <hr class="my-4">
            <h5>CARI TIKET</h5>
            <form action="#">
            <label for="a">tujuan</label>
            <select name="a" id="tujuan" data-style="btn-new">
                <option value="CGK">CGK - Jakarta</option>
                <option value="DPS">DPS - Bali</option>
                <option value="JOG">JOG - Yogyakarta</option>
            </select>
            <label for="d">dari</label>
            <select name="d" id="dari">
                <option value="CGK">CGK - Jakarta</option>
                <option value="DPS">DPS - Bali</option>
            </select>
            <label for="adult">Penumpang</label>
            <select name="adult" id="penumpang">
                <option value="1">1 Dewasa</option>
                <option value="2">2 Dewasa</option>
            </select>
            <input type="date" name="date">
            <input type="date" name="ret_date">        
            <input type="submit" value="submit" class="btn btn-primary btn-lg">
            <input type="hidden" name="output" value="json">
            <input type="hidden" name="v" value="1">
            <input type="hidden" name="infant" value="0">
            <input type="hidden" name="child" value="0">
            <input type="hidden" name="token" value="21dcf8e7dd032744361f322c60943b374bfe3fca">
            </form>
        </div>
    </div>

    <!-- Hasil Pencarian Pesawat -->
    <div class="container">
        <h3>Hasil Pencarian</h3>
        <div class="hasil">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- GET DATA from API TIKET.COM -->
        <?php
            if(!empty($_GET['a'])){
            $string = file_get_contents("http://api-sandbox.tiket.com/search/flight?a=".$_GET['a']."&d=".$_GET['d']."&date=".$_GET['date']."&ret_date=".$_GET['a']);
            // $string = file_get_contents("muti.json");
            $json = json_decode($string, true);

            echo '
                <p class="lead">Ditemukan '
                    .count($json['returns']['result']).
                ' dari Hasil Pencarian Tiket Pesawat dari '
                    .$json['search_queries']['from'].
                ' menuju '
                    .$json['search_queries']['to'].
                ' tanggal '
                    .$json['search_queries']['date'].
                '</p>
            ';

            print_r($json);
            $no=1;
            for($i=0;$i <count($json['returns']['result']); $i++){

                $detail_info = $json['returns']['result'][$i]['flight_infos']['flight_info'][0];
                $detail_pesawat = $json['returns']['result'][$i];

                $nama = $detail_info['airlines_name'];
                $img = $detail_info['img_src'];
                $harga = $detail_pesawat['price_value'];
                $flight_number = $detail_info['flight_number'];
                $deperatur = $detail_info['simple_departure_time'];
                $arrival = $detail_info['simple_arrival_time'];

            echo
                '<div class="card" style="padding:20px 50px;">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="'.$img.'" alt="gambar">                        
                        </div>
                        <div class="col-sm-10">
                           <div class="row"><h5>'.$nama.' </h5> ('.$flight_number.')</div>
                           <div class="text-success row"><h6>Rp '.number_format($harga,2,',','.').'</h6></div>
                           <div class="row">'.$deperatur.' - '.$arrival.'</div>
                        </div> 
                        '.
                    '<br />
                    </div>
                </div>';
            }
            ;}
        ?>
        </div>
    </div>
</body>
</html>