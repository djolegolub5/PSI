<!--    Autor - Djordje Golubović 2020/0112   -->


<html>
    <title>Profil</title>
    <link rel="stylesheet" href="profil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <body class="pozadina">
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
<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100" >
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-7">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
              <?php
                $putanja;
                if(empty($slika)) { 
                  $putanja = "'". base_url() . "assets/avatar.png'";
                }
                else {
                  $putanja = "'". base_url() . "assets/" . $slika ."'";
                  header("Content-Type: image/jpg");
                }
                echo "
                <img src= {$putanja}
                  alt=\"Generic placeholder image\" class=\"img-fluid img-thumbnail mt-4 mb-2\"
                  style=\"width: 150px; height:200px; z-index: 1\">";
                ?>
              </div>
              <div class="ms-3" style="margin-top: 130px;">
                <h5> <?php echo $ime;  ?></h5>
                <p> <?php echo $username;  ?></p>
              </div>
            </div>
            <div class="p-4 text-black" style="background-color: #f8f9fa;">
              <div class="d-flex justify-content-end text-center py-1">
                <div>
                  <p class="mb-1 h5"><?php echo $poeni;  ?></p>
                  <p class="small text-muted mb-0">Poeni</p>
                </div>
                <div class="px-3">
                  <p class="mb-1 h5"><?php echo $novac;  ?></p>
                  <p class="small text-muted mb-0">Novac</p>
                </div>
                <div>
                  <p class="mb-1 h5"><?php echo $broj_filmova;  ?></p>
                  <p class="small text-muted mb-0">Naslovi</p>
                </div>
                <div style="margin-left: 30px;" id="dugme">
                    <button type="button" class="btn btn-basic btn-outline-secondary"><a href="<?= site_url("Registrovan/uplataNovca")?>" style="color:grey">Uplati novac</a></button>
                </div>
              </div>
              

             
            </div>
            <div class="card-body p-4 text-black">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0">Naslovi</p>
                <p class="mb-0"><a href="<?= site_url("Registrovan/svi_naslovi")?>" class="text-muted">Prikaži sve</a></p>
              </div>
                <?php
                
                $prvi="";
                $drugi="";
                $treci="";
                $cetvrti="";
                
                for ($i=0;$i<sizeof($naslovi);$i++){
                    if ($i==0){
                        if ($naslovi[$i]->Slika==null)$prvi=base_url().'assets/no_image.jpg';
                        else $prvi=base_url().'assets/'.$naslovi[$i]->Slika;
                    }
                    else if ($i==1){
                        if ($naslovi[$i]->Slika==null)$drugi=base_url().'assets/no_image.jpg';
                        else $drugi=base_url().'assets/'.$naslovi[$i]->Slika;                  
                    }
                    else if ($i==2){
                        if ($naslovi[$i]->Slika==null)$treci=base_url().'assets/no_image.jpg';
                        else $treci=base_url().'assets/'.$naslovi[$i]->Slika;          
                    }
                    else{
                        if ($naslovi[$i]->Slika==null)$cetvrti=base_url().'assets/no_image.jpg';
                        else $cetvrti=base_url().'assets/'.$naslovi[$i]->Slika;                         
                    }
                }

                if(sizeof($naslovi)== 0) echo "Još ne poseduje nijedan naslov.";
                
                echo"
                <table align=center>
                    <tr>
                        <td>";if ($prvi!="") echo "<img src=$prvi alt=SLIKA style='width:250px; height:350px' >"; echo"</td>
                        <td>";if ($drugi!="") echo"<img src=$drugi alt=SLIKA style='width:250px; height:350px'>"; echo"</td>
                    </tr>
                    <tr>
                        <td>"; if ($treci!="") echo"<img src=$treci alt=SLIKA style='width:250px; height:350px'>"; echo"</td>
                        <td>"; if ($cetvrti!="") echo "<img src=$cetvrti alt=SLIKA style='width:250px; height:350px'>"; echo"</td>
                    </tr>
                </table>
                "
              ?>
                
              
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  </section></html>