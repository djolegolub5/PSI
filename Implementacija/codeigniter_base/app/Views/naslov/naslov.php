<!--    Autor - Đorđe Golubović 2020/0112    -->


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pregled filma - <?php echo $naslov->Ime?></title>
    <link rel = "stylesheet" href = "ceo.css">
    <link rel="icon" type="image/x-icon" href=" <?php echo base_url() ?>assets/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href=" <?php echo base_url() ?>/stil/uspeh.css" rel="stylesheet" />
</head>
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
                                <li><a href="<?= site_url("$status/profil")?>" class="dropdown-item">Profil</a></li>
                                <li><a href="<?= site_url("$status/podesavanja")?>" class="dropdown-item">Podesavanja</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a href="<?= site_url("$status/odjava") ?>" class="dropdown-item">Odjavi se</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
<div class="container-fluid">
            <div class="row stranica centrirano">
                <div class="col-sm-4" align="center">

                  <img src="<?php if ($naslov->Slika==null) echo base_url().'assets/no_image.jpg';
                    else echo base_url().'assets/'.$naslov->Slika?>" class="slike naslov" width="80%" style="margin-left:-10%;">
                  <?php
                    if($status == "Kriticar") echo '
                    <br>

                    <div style = "font-size: 150%;">
                      <span>Ocenite naslov: &nbsp; &nbsp;</span>
                      <span class="fa fa-star" id = "zvezda1" onclick = "oceniKlik(1)" onmouseover = "oceni(1)" onmouseout = "ukloni()"></span>
                      <span class="fa fa-star" id = "zvezda2" onclick = "oceniKlik(2)" onmouseover = "oceni(2)" onmouseout = "ukloni()"></span>
                      <span class="fa fa-star" id = "zvezda3" onclick = "oceniKlik(3)" onmouseover = "oceni(3)" onmouseout = "ukloni()"></span>
                      <span class="fa fa-star" id = "zvezda4" onclick = "oceniKlik(4)" onmouseover = "oceni(4)" onmouseout = "ukloni()"></span>
                      <span class="fa fa-star" id = "zvezda5" onclick = "oceniKlik(5)" onmouseover = "oceni(5)" onmouseout = "ukloni()"></span>
                      <span class="fa fa-star" id = "zvezda6" onclick = "oceniKlik(6)" onmouseover = "oceni(6)" onmouseout = "ukloni()"></span>
                      <span class="fa fa-star" id = "zvezda7" onclick = "oceniKlik(7)" onmouseover = "oceni(7)" onmouseout = "ukloni()"></span>
                      <span class="fa fa-star" id = "zvezda8" onclick = "oceniKlik(8)" onmouseover = "oceni(8)" onmouseout = "ukloni()"></span>
                      <span class="fa fa-star" id = "zvezda9" onclick = "oceniKlik(9)" onmouseover = "oceni(9)" onmouseout = "ukloni()"></span>
                      <span class="fa fa-star" id = "zvezda10" onclick = "oceniKlik(10)" onmouseover = "oceni(10)" onmouseout = "ukloni()"></span>
                      </div>';
                   ?>
                    <br>
                    </div>
                    <br>
                <div class="col-sm-8"  style="margin-left:-3%; text-align: justify; margin-right: 5px;">
                  <br>
                  <p>
                    <?php 
                        echo "<h1><b>" . $naslov->Ime . " (" . $naslov->Godina . ")</b></h1>";
                        $opis = explode(";", $naslov->Opis);
                        $i = 0;
                        $glumci = []; $glumice = []; $reziseri = [];
                        foreach ($opis as $deo) {
                            if(str_contains($deo, " - actor")) array_push($glumci, explode(" - actor", $deo)[0]);
                            if(str_contains($deo, " - actress")) array_push($glumice, explode(" - actress", $deo)[0]);
                            if(str_contains($deo, " - director")) array_push($reziseri, explode(" - director", $deo)[0]);
                        }

                        if(sizeof($glumci) > 0) echo "<h3>Glumci:</h3>";    
                        foreach ($glumci as $glumac) {
                            echo $glumac . "<br>";
                        } 

                        if(sizeof($glumice) > 0) echo "<h3>Glumice:</h3>";    
                        foreach ($glumice as $glumica) {
                            echo $glumica . "<br>";
                        } 

                        if(sizeof($reziseri) > 1) echo "<h3>Režiseri:</h3>";    
                        else if(sizeof($reziseri) > 0) echo "<h3>Režiser:</h3>";
                        foreach ($reziseri as $reziser) {
                            echo $reziser . "<br>";
                        }     
                        if(sizeof($opis) == 1) echo $naslov->Opis;
                        echo "<br><br><h3>Ocena: " . $naslov->ProsOcena . "</h3>";
                    ?>
                  </p>
                  <br>
                  <div style="font-size:20px" class="text-center">
                    Cena za kupovinu naslova novcem: <span><?php echo $naslov->Cena?></span>
                  </div>
                  <div style="font-size:20px" class="text-center">
                    Cena za kupovinu naslova poenima: <span> <?php echo $naslov->BrPoena?> </span>
                  </div>
                  <div style="font-size:20px" class="text-center">
                    Cena za iznajmljivanje naslova novcem: <span><?php echo $naslov->CenaIznajmljivanje?></span>
                  </div>
                  <div style="font-size:20px" class="text-center">
                    Cena za iznajmljivanje naslova poenima: <span> <?php echo $naslov->PoeniIznajmljivanje?> </span>
                  </div>
                </div>
            </div>
        </div>
        
         <?php if (!$ima) {
             $transakcija= site_url("Registrovan/transakcija/$naslov->ID");
                     
             echo"
            
        <div class='row'>
          <table align='center' class='stranica bg-dark'>
            <form method='POST' action='$transakcija'>
              <tr>
                  <td> <input type='radio' name='zelja' class='biranje' required value='kupi'>&nbsp <h2 style='display:inline'> Kupi </h2></td>
                  <td> <input type='radio' name='placanje' class='biranje' required value='novac'>&nbsp <h2 style='display:inline'> Novac  &nbsp($korisnik->Novac)</h2></td>
                  <td rowspan='2'><a href='uspesna_transakcija.html'><input type='submit' class='btn btn-lg' style='background-color:white; color:#333333' value='Izvrši transakciju'></a></td>
              </tr>
              <tr>
                  <td> <input type='radio' name='zelja' class='biranje' value='iznajmi'>&nbsp <h2 style='display:inline'> Iznajmi </h2></td>
                  <td> <input type='radio' name='placanje' class='biranje' value='poeni'>&nbsp <h2 style='display:inline'> Poeni &nbsp($korisnik->BrPoena)</h2></td>
                  <td></td>
              </tr>

          </form>
          </table>
      </div>";
         }
    ?>


    <br><br>
    <h1 style = "text-align: center;">Komentari</h1>
    <section style="background-color: lightblue;">
       
        <div class="container my-5 py-5 text-dark">
          <div class="row d-flex justify-content-center">
            <div class="col-md-11 col-lg-9 col-xl-7">

            <?php foreach($komentari as $komentar) {
                $slika=$korisnici[$komentar->ID]->Slika;
                if ($slika==null) $slika=base_url()."assets/avatar.png";
                else {
                    $slika=base_url()."assets/".$slika;
                }
                
                echo "
                <div class='d-flex flex-start mb-4'>
                <img class='rounded-circle shadow-1-strong me-3'
                  src=$slika alt='avatar' width='65'
                  height='65' />
                <div class='card w-100'>
                  <div class='card-body p-4'>
                    <div class=''>
                      <h5>{$korisnici[$komentar->ID]->Ime}&nbsp{$korisnici[$komentar->ID]->Prezime}</h5>
                      <p>
                        $komentar->Komentar
                      </p>
                      <span class='small'>$komentar->Datum</p>

                      
                    </div>
                  </div>
                </div>
              </div>
                
                ";
   
            }
            
            
            if($status == "Kriticar") {
                echo '<div class="card-footer py-3 border-0" style="background-color: #f8f9fa; height: auto; overflow: auto;">
                <h4>Dodajte svoj komentar</h4>';
                
                if(!empty($greska)) {
                    echo "<span style = 'text-align: center; color: red'>" . $greska . "</span>";
                }
                
                if($slikaK == null) $slikaK=base_url()."assets/avatar.png";
                else {
                    $slikaK=base_url()."assets/".$slikaK;
                }
                echo '
                <form action="' . site_url("{$controller}/objavaKomentara/{$naslov->ID}") . '" method="POST">
                <div class="d-flex flex-start w-100">
                  <img class="rounded-circle shadow-1-strong me-3"
                    src="' . $slikaK . '" alt="avatar" width="40"
                    height="40" />
                  <div class="form-outline w-100">
                    <textarea class="form-control" id="unosKomentara" rows="4" name = "komentar"
                      style="background: #fff;" placeholder="Unesite komentar...">
                    </textarea>
                    <input type = "hidden" id = "zvezdice" name = "zvezdice" value = "0">
                  </div>
                </div>
                <div class="float-end mt-2 pt-1">
                  <input type="submit" class="btn btn-primary btn-lg btn-dark" onclick = "return objavi()" value = "Objavi komentar">
                </div>
                </div>';
                }
            ?>
            </div>
          </div>
        </div>
      </section>
      <div class="row">
      <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; The golDen rASpberry, 2023</p></div>
    </footer>
    </div>
  </div>
    
     <script>
      var ocenjen = false;

      function objavi()
      {
        if(document.getElementById("unosKomentara").value == "") {
          alert("Morate uneti komentar pre slanja recenzije!");
          return false;
        }
      }

      function oceniKlik(n)
      {
          ocenjen = true;
          for(var i = 1; i <= n; i++)
          {
            var ident = "zvezda" + i;
            document.getElementById(ident).style.color = "orange";
          }
          document.getElementById("zvezdice").value = n;
      }

      function oceni(n)
      {
          if(!ocenjen) {
          for(var i = 1; i <= n; i++)
          {
            var ident = "zvezda" + i;
            document.getElementById(ident).style.color = "orange";
          }
        }
      }

      function ukloni()
      {
        if(!ocenjen)
        {
          for(var i = 1; i <= 10; i++)
          {
            var ident = "zvezda" + i;
            document.getElementById(ident).style.color = "white"; 
          }
        }
      }

    </script>
</body>
</html>