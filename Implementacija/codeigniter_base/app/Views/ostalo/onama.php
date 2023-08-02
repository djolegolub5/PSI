<!--    Autor - Stefan Curović 2020/0068, Aleksa Trivić 2020/0198   -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta charset = "UTF-8">
    <title>O nama</title>
   <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href=" <?php echo base_url() ?>/stil/styles.css" rel="stylesheet" />
</head>
<body style = "background-color: #333333;">
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
                            <b><a class="nav-item nav-link " style = "color: white; font-size: 120%;" href="<?= site_url("$controller/onama")?>">O nama</a></b>
                          
                          <?php
                          switch($controller) {
                            case "Admin": echo '
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' . site_url("Admin/dodavanjeAnkete") . '">Napravi anketu</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' . site_url("Admin/dodavanjeKviza") . '">Napravi kviz</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' . site_url("Admin/pregledajNaloge") . '">Pregledaj naloge</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' . site_url("Admin/dodavanjeNaslova") . '">Dodaj naslov</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' . site_url("Admin/objavaRezultata") . '">Objava rezultata</a>
                             '; break;
                            case "Kriticar":
                                echo ' <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' .  site_url("$controller/Anketa") . '">Ankete</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' .  site_url("$controller/izaberiKviz") . '">Kvizovi</a>
                             '; break;
                            case "Registrovan":
                              echo ' <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' .  site_url("$controller/Anketa") . '">Ankete</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' .  site_url("$controller/izaberiKviz") . '">Kvizovi</a>
                                <a class = "nav-item nav-link" style = "color: gold; font-size: 120%;" href = "' . site_url("Registrovan/pretplata") . '">Pretplati se</a>
                             '; break;
                            case "Gost": echo ' <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' .  site_url("Gost/prijava") . '">Uloguj se</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="' .  site_url("Gost/registracija") . '">Registruj se</a>
                             '; break;
                            default: break;
                      
                          }
                          ?>
                        </div>
                </ul>
               
                    <?php
                    if($controller != "Gost") {
                        $profil=site_url("$controller/profil");
                        $podesavanja=site_url("$controller/podesavanja");
                        $odjava=site_url("$controller/odjava");

                        echo '
                         <form class="d-flex">
                        <div class="dropdown">
                            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" style="background-color:white; color:#333333;">
                                '.$ime.'
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="'.$profil.'" class="dropdown-item">Profil</a></li>
                                <li><a href="'.$podesavanja.'" class="dropdown-item">Podesavanja</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a href="'.$odjava.'" class="dropdown-item">Odjavi se</a></li>
                            </ul>
                        </div>
                    </form>';  
                    }
                    ?>
                   
            </div>
        </div>
    </nav>

    <br><br>
    <h2 class = "text-center text-light">
        Tim "The golDen rASpberry" se sastoji iz 4 člana:
    </h2>
    <br><br>
    <h5 class = "text-center text-light">
        Teodora Ristović, 2020/0566<br>
        Aleksa Trivić, 2020/0198<br>
        Đorđe Golubović, 2020/0112<br>
        Stefan Curović, 2020/0068<br>
    </h5>

    <br><br>

    <p class = "text-center text-light">
        "Virtuelni video klub" je projektni zadatak na predmetu Principi softverskog inženjerstva, koji je i dalje u fazi razvoja.

    </p>

    <div class = "text-center">
    <a class = "btn btn-success" href = "<?= site_url("$controller/pocetna") ?>" style = "margin: auto;">Povratak na početnu stranicu</a>
    </div>
    
    <footer class="py-5 bg-dark" style="position:absolute; bottom: 0; right: 0; left: 0;">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; The golDen rASpberry, 2023</p></div>
    </footer>
    
</body>
</html>