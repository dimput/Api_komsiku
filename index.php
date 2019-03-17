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
            <h1 class="display-4">Welcome Cari Film!</h1>
            <p class="lead">Website untuk mencari Film. Website ini menggunakan The Movie Database API</p>
            <hr class="my-4">
            <h5>CARI Movie</h5>
            <form action="#">
            <label for="query">Judul</label>
                <input type="text" name="query">
            <input type="submit" value="submit" class="btn btn-primary btn-lg">
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
            if(!empty($_GET['query'])){
            $query = $_GET['query'];

            $string = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=70cdeab72720dc1a144f4d142a9189c6&language=en-US&query=".$query."&include_adult=false");
            // $string = file_get_contents("muti.json");
            $json = json_decode($string, true);

            // print_r($json);
            $no=1;
            for($i=0;$i <count($json['results']); $i++){
            $title = $json['results'][$i]['title'];
            $release_date = $json['results'][$i]['release_date'];
            $rate = $json['results'][$i]['vote_average'];
            $sinopsis = $json['results'][$i]['overview'];
            $img = "https://image.tmdb.org/t/p/w500".$json['results'][$i]['poster_path']."";

            echo
                '<div class="card" style="padding:20px 50px;">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="'.$img.'" alt="gambar" style="width:100%;">                        
                        </div>
                        <div class="col-sm-10">
                           <div class="row"><h5>'.$title.' </h5> ('.$release_date.')</div>
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
            ;}
        ?>
        </div>
    </div>
</body>
</html>