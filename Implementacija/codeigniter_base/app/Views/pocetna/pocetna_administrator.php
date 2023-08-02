<!--    Autor - Teodora Ristović - 2020/0566    -->

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
        <style>
            body{
                overflow-x: hidden;
            }
        </style>
    </head>
    <body>
        <!-- Navigation-->

        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container px-4 px-lg-8">
                <a class="navbar-brand" href="#!">  
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">
                        <a href = "<?= site_url("Admin/pocetna") ?>">
                            <img src = "<?php echo base_url() ?>assets/logo.png" style = "height: 10vh;">
                        </a></li>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                               <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Admin/onama"); ?>">O nama</a>
                          <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Admin/dodavanjeAnkete"); ?>">Napravi anketu</a>
                          <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Admin/dodavanjeKviza"); ?>">Napravi kviz</a>
                          <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Admin/pregledajNaloge"); ?>">Pregledaj naloge</a>
                          <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Admin/dodavanjeNaslova"); ?>">Dodaj naslov</a>
                          <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Admin/objavaRezultata"); ?>">Objava rezultata</a>

                             
                            </div>
                        </div>
                    </ul>
                    <form class="d-flex">
                        <div class="dropdown">
                            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" style="background-color:white; color:#333333;">
                                <?php echo $ime;  ?>
                            </button>
                            <ul class="dropdown-menu">
                                 <li><a href="<?= site_url("Admin/profil")?>" class="dropdown-item" disabled>Profil</a></li>
                            <li><a href="<?= site_url("Admin/podesavanja")?>" class="dropdown-item" disabled>Podesavanja</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a href="<?= site_url("Admin/odjava")?>" class="dropdown-item">Odjavi se</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        
        <div class="row">
        <div style = "display: inline-block; width: 20%; margin-top: 3%;">
        <form action="<?= site_url("Admin/pregled") ?>" method="GET">
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
                <input class="form-check-input" type="checkbox" value="Romansa" name = "zanr[]" id="flexCheckChecked8">
                <label class="form-check-label" for="flexCheckChecked8">
                  Romansa
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Fantastika" name = "zanr[]" id="flexCheckChecked9">
                <label class="form-check-label" for="flexCheckChecked9">
                  Fantastika
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Drugi" name = "zanr[]" id="flexCheckChecked7">
                <label class="form-check-label" for="flexCheckChecked7">
                  Drugi
                </label>
              </div>
            </div>
            <div id = "pretraga-ocena" style = "margin-left: 20%; margin-top: 5%;">
                <h4>Minimalna ocena</h4>
                <label for="range-ocena" class="form-label" min="1" max="10"></label>
                <div>1 <input type="range" name = "ocena" class="form-range" id="range-ocena" value = "5" style = "width: 70%;" min=1 max=10 list ="markers" oninput="menjajOcenu()"> 10</div>
                Izabrali ste ocenu: <span id = "slajder">5</span><br/>
            </div>
            <div id = "pretraga-popularnih" style = "margin-left: 20%; margin-top: 5%;">
                <h4>Popularnost</h4>
                <input class="form-check-input" type="checkbox" value="Trend" name="Trend" id="flexCheckChecked8"onclick="ajaxUTrendu()">
                <label class="form-check-label" for="flexCheckChecked8">
                  U trendu
                </label>
            </div>

            <div id = "pretraga-popularnih" style = "margin-left: 20%; margin-top: 5%;">
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
            <br>
            <input type = "submit" class = "btn btn-primary" value = "Primeni" style = "margin-left: 20%; margin-bottom: 5%;">
  </form>
    </div>

        <!-- Section-->


        <section class="py-5" style = "display: inline-block; width: 75%;">
            <form action="<?= site_url("Admin/pregledPoNazivu") ?>" method="POST">
                <div class="input-group rounded">
                    <input id="naziv" type="search" class="form-control rounded" placeholder="Pretražite film ili seriju..." aria-label="Search" aria-describedby="search-addon" name="search" oninput="ajaxPretraga()"/>
                    <span class="input-group-text border-0" id="search-addon">
                       <input type="submit" value="Pretraga">
                    </span>
                </div>
                <div id="rezultat"></div>
            </form>

            <h1 style = "margin-top: 5%; text-align: center;">
                <?php echo $tekst ?>
            </h1>
            
            <div class="container px-4 px-lg-5 mt-5">
                
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center" id="centralni">
                <?php
                        $i = 0;
                        $maksNaslova = 12;
                        if($naslovi == null) echo "Ne postoje naslovi koji zadovoljavaju zahteve";
                        else{
                            $n = sizeof($naslovi);
                            for($j = 0; $j < $n; $j++) {
                                $k = rand(0, $n - 1);
                                $pom = $naslovi[$j];
                                $naslovi[$j] = $naslovi[$k];
                                $naslovi[$k] = $pom;
                            }
                          foreach ($naslovi as $naslov) {
                                  $slika = $naslov->Slika;
                                  $putanja;
                                  if(empty($slika)) { 
                                     $putanja = "'". base_url() . "assets/no_image.png'";
                                  }
                                  else {
                                    $putanja = "'". base_url() . "/assets/" . $slika ."'";
                                    header("Content-Type: image/jpg");
                                  }
                                  $where=site_url("Admin/naslov/$naslov->Ime");
                                  if($naslov->Zanr == "0") $naslov->Zanr = "";
                                  echo 
                                  "<div class=\"col mb-5\">
                                      <div class=\"card h-100\">
                                          
                                          <!-- Product image-->
                                          <img class=\"card-img-top\" src=$putanja alt=SLIKA>
                                          <!-- Product details-->
                                          <div class=\"card-body p-4\">
                                              <div class=\"text-center\">
                                                  <!-- Product name-->
                                                  <h5 class=\"fw-bolder\">{$naslov->Ime}</h5>
                                                  <!-- Product price-->
                                                  {$naslov->Zanr}<br>";
                                                  if($naslov->Kategorija=="Film"){
                                                      if($naslov->Trajanje == "0") echo "</div>"; else 
                                                    echo "{$naslov->Trajanje}min
                                                </div>";
                                                  }else {
                                                    if($naslov->BrSezona == "0") echo "</div>"; else
                                                    echo "{$naslov->BrSezona} sezona
                                                    </div>";
                                                  }
                                                  
                                              echo "
                                          </div>
                                          <!-- Product actions-->
                                          <div class=\"card-footer p-4 pt-0 border-top-0 bg-transparent\">
                                              <div class=\"text-center\"><a class=\"btn btn-outline-dark mt-auto\" href=$where>Izaberi</a></div>
                                          </div>
                                      </div>
                                  </div>";
                              
                              $i++;
                              if($i == $maksNaslova) break;
                              
                          }
                        }
                    ?>
                </div>
            </div>
        </section>
        </div>
        <div class="row">
          

        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; The golDen rASpberry, 2023</p></div>
        </footer>
       <script src = "js/scripts.js"></script>
       <script>
           /**
            * Funkcija za dinamički prikaz izabrane ocene na stranici
            * 
            * @param
            * @return void
            */
           
           function menjajOcenu() {
               document.getElementById("slajder").innerHTML = document.getElementById("range-ocena").value;
           }
           
           
           /**
            * Funkcija za asinhroni prikaz naslova sa imenom nalik unetom
            * 
            * @param
            * @return void
            */
           
           function ajaxPretraga(){
               var zahtev = new XMLHttpRequest();
               zahtev.onreadystatechange = function() {
                   if(this.readyState == 4 && this.status == 200) {
                       document.getElementById("rezultat").innerHTML = this.responseText;
                   }
               };
       
               zahtev.open("GET", "<?= site_url("Admin/ajaxPregledPoNazivu/")?>" + document.getElementById("naziv").value, true);
               zahtev.send();
           }
           
           
           /**
            * Funkcija za asinhroni prikaz naslova koji su u trendu
            * 
            * @param
            * @return void
            */
           
           function ajaxUTrendu() {
               var zahtev = new XMLHttpRequest();
               zahtev.onreadystatechange = function() {
                   if(this.readyState == 4 && this.status == 200) {
                       document.getElementById("centralni").innerHTML = this.responseText;
                    }
               };
               
               zahtev.open("GET", "<?= site_url("Admin/ajaxUTrendu") ?>", true);
               zahtev.send();
           }
       </script>
    </body>
</html>
