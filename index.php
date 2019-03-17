<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Icon Web -->
    <link rel="shortcut icon" href="clapperboard.png" type="image/x-icon">

    <!-- Title Web -->
    <title>Cari Film</title>

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
            <h1 class="display-4">Welcome Cari Film!</h1>
            <p class="lead">Website untuk mencari Film. Website ini menggunakan The Movie Database API</p>
            <hr class="my-4">
            <h5>Cari Movie</h5>
            <form action="#">
            <input type="text" name="query" plaaceholder="judul">
            <input type="submit" value="submit" class="btn btn-primary btn-lg">
            </form>
        </div>
    </div>

    <!-- Hasil Pencarian Pesawat -->
    <div class="container">
        <h3>Hasil Pencarian</h3>
        <div class="hasil">
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
        
        <!-- GET DATA from API themovie -->
        <?php
            //untuk mengambil data yang di input
            if(!empty($_GET['query'])){
            $query = $_GET['query'];
            
            // mengambil data dari API themovie
            $string = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=70cdeab72720dc1a144f4d142a9189c6&language=en-US&query=".$query."&include_adult=false");
            $json = json_decode($string, true);

            for($i=0;$i <count($json['results']); $i++){
            
            //mengambil judul
            $title = $json['results'][$i]['title'];
            //mengambil tanggal rilis
            $release_date = $json['results'][$i]['release_date'];
            // mengambil rating
            $rate = $json['results'][$i]['vote_average'];
            //mengambil sinopsis
            $sinopsis = $json['results'][$i]['overview'];
            //mengambil img
            $img = "https://image.tmdb.org/t/p/w500".$json['results'][$i]['poster_path']."";

            // membuat isi yang di tampilkan.
            echo
                '<div class="card" style="padding:20px 50px;">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="'.$img.'" alt="gambar" style="width:100%;">                        
                        </div>
                        <div class="col-sm-10">
                           <div class="row"><h5>'.$title.' </h5> ( '.date_format(date_create($release_date),"d / m / Y").' )</div>
                           <div class="text-success row"><h6>Rating : '.$rate.'</h6></div>
                           <div class="row">
                                <p style="font-weight:bold">Sinopsis</p>
                                <p>'.$sinopsis.'</p>
                           </div>
                        </div> 
                        '.
                    '<br />
                    </div>
                </div>';
            }
        }
        ?>
        </div>
    </div>
</body>
</html>