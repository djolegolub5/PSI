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
        <title>Vaši naslovi</title>
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
                              <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Registrovan/izaberiKviz")?>">Kvizovi</a>
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
        
        <!-- Header-->

     

        <!-- Section-->

         

            
            
            <div class="container px-4 px-lg-5 mt-5">
                
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <!-- za svakii naslov ce da se pravi ovo posebno -->
                    <?php
                    
                        if($naslovi == null) echo "Ne postoje naslovi.";
                        else  {
                            $i = 0;
                            foreach ($naslovi as $naslov) {
                                $slika=null;
                                if ($naslov->Slika==null) $slika=base_url()."assets/no_image.jpg";
                                else $slika=base_url().'assets/'.$naslov->Slika;
                                $where=$naslov->Link;
                                    echo 
                                    "<div class=\"col mb-5\">
                                        <div class=\"card h-100\">
                                            
                                            <!-- Product image-->
                                            <img class=\"card-img-top\" src=$slika alt='SLIKA'>
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
                                                <div class=\"text-center\"><a class=\"btn btn-outline-dark mt-auto\" href=$where>Gledaj</a></div>
                                            </div>
                                        </div>
                                    </div>";
                                }
                                $i++;
                          }
                      echo "<br><br><br>";
                    ?>

                </div>
            </div>
            
        
        <div class="row">
          

        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; The golDen rASpberry, 2023</p></div>
        </footer>
       <script src = "skripta/skripta.js"></script>
    </body>
    
</html>
