<!--    Autor - Aleksa Trivić 2020/0198    -->


<?php
    if(empty($this->session->korisnik)) {
        header("Location: " . site_url("Gost/pocetna"));
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Virtuelni video klub - Dobrodošli!</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
                <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href=" <?php echo base_url() ?>/stil/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->

       <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container px-8 px-lg-8">
            <a class="navbar-brand" href="#!">  
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= site_url("$controller/pocetna") ?>">
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
        
        <!-- Header-->
        <header class="bg-light py-5">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                <img src="<?php echo base_url() ?>assets/logocrni.png" class="d-block w-100" alt="Prva slika" style = "height: 25vh; padding-left: 2%;">
                  </div>
                  <div class="carousel-item">
                <img src="<?php echo base_url() ?>assets/slika1.png" class="d-block w-100" alt="Prva slika" style = "height: 25vh; padding-left: 2%;">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(100%)"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(100%)"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </header>

       
        <div style = "display: inline-block; width: 20%;">
        <form action="<?= site_url("Registrovan/pregled") ?>" method="GET">
            <u><h3 style = "margin-left: 10%;"><b>Pretraga</b></h3></u>
            <div id = "pretraga-zanr" style = "margin-left: 20%;">
            <h4>Žanr</h4>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Akcija" name = "zanr[]" id="flexCheckChecked1">
                <label class="form-check-label" for="flexCheckChecked1">
                 Akcija
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Triler" name = "zanr[]" id="flexCheckChecked2">
                <label class="form-check-label" for="flexCheckChecked2">
                  Triler
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Drama" name = "zanr[]" id="flexCheckChecked3">
                <label class="form-check-label" for="flexCheckChecked3">
                  Drama
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Horor" name = "zanr[]" id="flexCheckChecked4">
                <label class="form-check-label" for="flexCheckChecked4">
                  Horor
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Komedija" name = "zanr[]" id="flexCheckChecked5">
                <label class="form-check-label" for="flexCheckChecked5">
                  Komedija
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Naučna fantastika" name = "zanr[]" id="flexCheckChecked6">
                <label class="form-check-label" for="flexCheckChecked6">
                  Naučna fantastika
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Avantura" name = "zanr[]" id="flexCheckChecked6">
                <label class="form-check-label" for="flexCheckChecked6">
                  Avantura
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Drugi" name = "zanr[]" id="flexCheckChecked7">
                <label class="form-check-label" for="flexCheckChecked7">
                  Drugi
                </label>
              </div>
            </div>
            <div id = "pretraga-ocena" style = "margin-left: 20%;">
                <h4>Minimalna ocena</h4>
                <label for="range-ocena" class="form-label" min="1" max="10"></label>
                1 <input type="range" name = "ocena" class="form-range" id="range-ocena" value = "5" style = "width: 70%;" min=1 max=10 list ="markers" oninput="this.nextElementSibling.value = this.value"> 10
                Izabrali ste ocenu: <output id = "slajder">5</output> <br/>
            </div>
            <div id = "pretraga-popularnih" style = "margin-left: 20%;">
                <h4>Popularnost</h4>
                <input class="form-check-input" type="checkbox" value="Trend" name="Trend" id="flexCheckChecked8">
                <label class="form-check-label" for="flexCheckChecked8">
                  U trendu
                </label>
            </div>

            <div id = "pretraga-popularnih" style = "margin-left: 20%;">
                <h4>Vrsta</h4>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Film" name = "kategorija[]" id="flexCheckChecked9">
                    <label class="form-check-label" for="flexCheckChecked9">
                      Film
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Serija" name = "kategorija[]" id="flexCheckChecked10">
                    <label class="form-check-label" for="flexCheckChecked10">
                      Serija
                    </label>
                  </div>
            </div>
            
            <input type = "submit" class = "btn btn-primary" value = "Primeni" style = "margin-left: 20%; margin-bottom: 5%;">
  </form>
    </div>

        <!-- Section-->


        <section class="py-5" style = "display: inline-block; width: 75%;">
            <div class="input-group rounded">
                <input type="search" class="form-control rounded" placeholder="Pretražite film ili seriju..." aria-label="Search" aria-describedby="search-addon" />
                <span class="input-group-text border-0" id="search-addon">
                  <button>Pretraga</button>
                </span>
              </div>
        
            <h1 style = "margin-top: 5%; text-align: center;">
                Preporučujemo za Vas
            </h1>

            
            
            <div class="container px-4 px-lg-5 mt-5">
                
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <!-- za svakii naslov ce da se pravi ovo posebno -->
                    <?php
                        if($naslovi == null) echo "Ne postoje naslovi koji zadovoljavaju zahteve";
                        else  {
                            foreach ($naslovi as $naslov) {
                                    echo 
                                    "<div class=\"col mb-5\">
                                        <div class=\"card h-100\">
                                            
                                            <!-- Product image-->
                                            <img class=\"card-img-top\" src=\"".base_url()."assets/jaws.jpg\" alt=\"...\"/>
                                            <!-- Product details-->
                                            <div class=\"card-body p-4\">
                                                <div class=\"text-center\">
                                                    <!-- Product name-->
                                                    <h5 class=\"fw-bolder\">{$naslov->Ime}</h5>
                                                    <!-- Product price-->
                                                    {$naslov->Zanr}<br>
                                                    {$naslov->Trajanje}min
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class=\"card-footer p-4 pt-0 border-top-0 bg-transparent\">
                                                <div class=\"text-center\"><a class=\"btn btn-outline-dark mt-auto\" href=naslov.html>Pogledaj</a></div>
                                            </div>
                                        </div>
                                    </div>";
                                }
                                
                        }
                      
                    ?>
                    
                </div>
            </div>
        </section>
        <div class="row">
          

        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; The golDen rASpberry, 2023</p></div>
        </footer>
       <script src = "skripta/skripta.js"></script>
    </body>
    
</html>
