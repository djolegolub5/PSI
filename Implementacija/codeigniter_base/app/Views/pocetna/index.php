<!--    Autor - Aleksa Trivić 2020/0198    -->

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
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="pocetna_neulogovan.html">
                        <a href = "<?= site_url("Gost/pocetna") ?>">
                            <img src = "<?php echo base_url() ?>assets/logo.png" style = "height: 10vh;">
                        </a></li>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/onama") ?>">O nama</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/prijava") ?>">Uloguj se</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/registracija") ?>">Registruj se</a>
                             
                            </div>
                    </ul>

                </div>
            </div>
        </nav>
        
        <!-- Header-->
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                            <img src = "<?php echo base_url() ?>assets/carousel_neulogovani.png" style = "height: 25vh; width: 250vh">
              </div>
              <div class="carousel-item">
                <img src="<?php echo base_url() ?>assets/slika1.png" class="d-block w-100" alt="Treca slika" style = "height: 25vh;">
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

        <!-- Section-->


        <section class="py-5" style = "display: inline-block; width: 75%; margin-left:12%" align="center">

        
            <h1 style = "margin-top: 5%; text-align: center;">
                Preporučujemo za Vas
            </h1>

            
            
            <div class="container px-4 px-lg-5 mt-5">
                <h4 class = "text-danger"><i>Morate biti ulogovani za detaljniji pregled naslova.</i></h4><br><br>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                        $i = 0;
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
                                if ($i>=12) break;
                                $slika = $naslov->Slika;
                                $putanja;
                                if(empty($slika)) { 
                                  $putanja = "'". base_url() . "assets/no_image.png'";
                                }
                                else {
                                  $putanja = "'". base_url() . "assets/" . $slika ."'";
                                  header("Content-Type: image/jpg");
                                }                 
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
                                                    if ($naslov->Kategorija == "Film"){
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
                                        </div>
                                    </div>";

                                $i++;
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
