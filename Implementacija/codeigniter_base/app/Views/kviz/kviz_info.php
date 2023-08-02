<!--    Autor - Đorđe Golubović - 2020/0112    -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacije o kvizu</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 <link href=" <?php echo base_url() ?>/stil/uspeh.css" rel="stylesheet" />


</head>
<body style="background-color: #333333;">

        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">  
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">
                        <a href = "<?= site_url("Registrovan/pocetna") ?>">
                            <img src = "<?php echo base_url() ?>assets/logo.png" style = "height: 10vh;">
                        </a></li>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                              <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Registrovan/onama")?>">O nama</a>
                              <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Registrovan/anketa")?>">Ankete</a>
                              <b><a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Registrovan/izaberiKviz")?>">Kvizovi</a></b>
                              <?php
                                if($controller == "Registrovan") {
                                    echo '<a class = "nav-item nav-link" style = "color: gold; font-size: 120%;" href = "' . site_url("Registrovan/pretplata") . '">Pretplati se</a>';
                                }
                              
                              ?>
                            </div>
                    </ul>
                    <form class="d-flex">
                        <div class="dropdown">
                            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" style="background-color:white; color:#333333;">
                                <?php echo $ime;  ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?= site_url("Registrovan/profil")?>" class="dropdown-item">Profil</a></li>
                                <li><a href="<?= site_url("Registrovan/podesavanja")?>" class="dropdown-item">Podesavanja</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a href="<?= site_url("Registrovan/odjava") ?>" class="dropdown-item">Odjavi se</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    <div class="row centrirano" style="height:700px">
        <div class="col-sm-12">
            <h1 style="color:white;">Informacije o kvizu:</h1>
            <br>
            <h2 style="color:white">Broj pitanja:<div> <?php echo $brPitanja;  ?> </div></h2>
            <h2 style="color:white"><br>Bodovanje:<div> <?php
             $pravila = explode(';', $kviz->Pravila);
             $bodovi = explode(',', $pravila[0]); 
             $nagrade = explode(',', $pravila[1]);
             
             for($i = 0; $i < sizeof($bodovi); $i++) {
                 echo "<br>" . ($i + 1) . ". " . $bodovi[$i] . "";
             }
             echo "</h2></div><br><h2 style = 'color: white'>Nagrade:<div>";
             for($i = 0; $i < sizeof($nagrade); $i++) {
                 echo "<br>" . ($i + 1) . ". " . $nagrade[$i] . " poena";
             }
             
             ?> </h2></div>
            <br>
            <div class="text-center"><a class="btn btn-light btn-lg mt-auto" href="<?= site_url('Registrovan/prikaz_kviza/'.$kviz->ID) ?>">Započni kviz</a></div><br>


        </div>



    </div>
    <div class="row">
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; The golDen rASpberry, 2023</p></div>
        </footer>
    </div>
</div>
</body>
</html>