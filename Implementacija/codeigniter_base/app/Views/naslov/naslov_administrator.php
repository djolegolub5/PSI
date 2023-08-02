<!--    Autor - Teodora Ristović - 2020/0566, Aleksa Trivić 2020/0198    -->

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pregled filma - <?php echo $naslov->Ime?></title>
    <link rel = "stylesheet" href = "ceo.css">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
     <link href=" <?php echo base_url() ?>/stil/uspeh.css" rel="stylesheet" />
</head>
<body>
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
<div class="container-fluid">

<div class="row stranica centrirano">
  <div class="col-sm-4" align="center">
      <img src="<?php if ($naslov->Slika==null) echo base_url().'assets/no_image.jpg';
                else echo base_url().'assets/'.$naslov->Slika?>" class="slike naslov" width="80%" style="margin-left:-10%;">
      <br>
  </div>
  <div class="col-sm-8"  style="margin-left:-3%; text-align: justify; margin-right: 5px;"><p>
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
      Cena naslova: <span><?php echo $naslov->Cena?></span>
    </div>
    <div style="font-size:20px" class="text-center">
      Poeni naslova: <span> <?php echo $naslov->BrPoena?> </span>
    </div>
  </div>



</div>
        <div class="row">
          <table align="center" class="stranica bg-dark">
              <form>
                <tr>
                    <td rowspan="2">
                        <?php
                        $where=site_url("Admin/obrisiNaslov/$naslov->Ime");
                        echo
                        "<a href=$where>
                            <button type='button' class='btn btn-lg' style='background-color:white; color:#333333;margin: 1%;'>Obriši naslov</button>
                        </a>"
                        ?>
                    </td>
                </tr>
                <tr>

                    <td></td>
                </tr>
          </form>
          </table>
      </div>


    </div>
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
                      <span class='small'>$komentar->Datum</span>
                      <a href='" . site_url("Admin/obrisiKomentar/{$komentar->ID}") . "'><button type='button' class='btn btn-lg btn-dark'>Obriši komentar</button></a>
                    </div>
                  </div>
                </div>
              </div>
                
                ";
   
            }
            ?>
          </div>
        </div>
      </section>
      <div class="row">
      <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; The golDen rASpberry, 2023</p></div>
    </footer>
    </div>
</body>
</html>