<!--    Autor - Djordje Golubović 2020/0112    -->

<html>
    <title>Podešavanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <link href=" <?php echo base_url() ?>/stil/podesavanja.css" rel="stylesheet" />
    <meta charset = "UTF-8">

<body>

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
                          <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("$controller/onama")?>">O nama</a>
                          
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


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
            <h2 class="h3 mb-4 page-title text-center">Podešavanja</h2>
            <hr class="my-4">
            <div class="my-4">
                    <form action="<?= site_url("Registrovan/promena")?>" method="POST">
                    <div class="row align-items-center">
                        <div class="col-sm-4 text-center">
                            <div class="row align-items-center">

                            <div class="avatar avatar-xl">
                            <?php 
                            
                            $baze=base_url();
                            if ($slika==null) echo '<img src = "'.
                             $baze.'"assets/logo.png" style = "height: 10vh;">';
                            
                            else{
                                $putanja=$baze."assets/".$slika;
                                echo '<img src = "'.$putanja.'" style = "height: 10vh;">';
                            }
                            
                            ?>                            </div>
                        </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h4 class="mb-1"><?php echo $ime;  ?></h4>
                                    <p class="small mb-3"><span style="color:black"><?php echo $username;  ?></span></p>
                                </div>
                            </div>
                            </div>
                            

                        <div class="col-sm-3">
                            <div class="row align-items-center" align=center>

                            <a href="<?= site_url("Registrovan/brisanje")?>"><input type="button" class="btn btn-danger" value="Obriši profil"></a>
                        </div>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">Ime</label>
                            <input type="text" id="ime" name="ime" class="form-control" placeholder=<?php echo $ime;  ?> />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Prezime</label>
                            <input type="text" id="prezime" name="prezime" class="form-control" placeholder=<?php echo $prezime;  ?> />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder=<?php echo $email;  ?> />
                    </div>
                    <div class="form-group">
                        <label for="inputEmail4">Broj telefona</label>
                        <input type="text" class="form-control" id="telefon" id="telefon" placeholder=<?php echo $telefon;  ?> />
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label><?php
                    if(!empty($korisnicko)) {
                        echo "<span style = 'color: red; text-align: center;'>" . " ".$korisnicko . "</span><br>";
                    }?>
                        <input type="text" class="form-control" id="username" name="username" placeholder=<?php echo $username;  ?> />
                    </div>
                    <hr class="my-4" />
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPassword4">Stara lozinka</label><?php
                    if(!empty($stara)) {
                        echo "<span style = 'color: red; text-align: center;'>" . " ".$stara . "</span><br>";
                    }?>
                                <input type="password" class="form-control" id="stara" name="stara" />
                            </div>
                            <div class="form-group">
                                <label for="inputPassword5">Nova lozinka</label><?php
                    if(!empty($nova)) {
                        echo "<span style = 'color: red; text-align: center;'>" . " ".$nova . "</span><br>";
                    }?>
                                <input type="password" class="form-control" id="nova" name="nova" />
                            </div>
                            <div class="form-group">
                                <label for="inputPassword6">Potvrdi novu lozinku</label><?php
                    if(!empty($ponovo)) {
                        echo "<span style = 'color: red; text-align: center;'>" . " ".$ponovo . "</span><br>";
                    }?>
                                <input type="password" class="form-control" id="ponovo" name="ponovo" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">Zahtevi za lozinku</p>
                            <ul class="small text-muted pl-4 mb-0">
                                <li>Najmanje 8 karaktera</li>
                                <li>Minimum 1 slovo</li>
                                <li>Minimum 1 broj</li>
                                <li>Ne može biti ista kao prethodna lozinka</li>
                            </ul>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-dark" value="Sačuvaj promene" />
                </form>
            </div>
        </div>

    </div>
</body>
</html>