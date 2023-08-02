<!--    Autor - Stefan Curović 2020/0068    -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pregledaj naloge</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
   <link href=" <?php echo base_url() ?>/stil/styles.css" rel="stylesheet" />
</head>
<body style = "background-color: #333333;">
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
                          <b><a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Admin/pregledajNaloge"); ?>">Pregledaj naloge</a></b>
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


    <div class = "container text-center">
        <h2 class = "text-light" style = "margin-top: 5%;">Registrovani nalozi</h2>
        <table class = "table table-light table-striped text-center">
            <tr>
                <th>Ime i prezime</th>
                <th>Korisničko ime</th>
                <th>Kategorija</th>
                <th>Profil</th>
                <th>Suspenduj</th>
            </tr>
            <?php
                
                foreach ($korisnici as $korisnik) {
                        if($korisnik->Status == "Admin") continue;
                        echo 
                        "<tr>
                        <td>{$korisnik->Ime}</td>
                        <td>{$korisnik->KorIme}</td>
                        <td><b>{$korisnik->Status}</b></td>
                        <td><a href =". site_url("Admin/prikaziProfil/".$korisnik->ID).">Link do profila</a></td>";
                        if($korisnik->Status == "Suspendovan") {
                            echo "<td><a disabled class = \"btn btn-danger\">Suspendovan</a></td>";
                        }else if ($korisnik->Status == "Neautorizovan"){
                            echo "<td><a href=". site_url("Admin/autorizujNalog/".$korisnik->ID)." class = \"btn btn-success\">Autorizuj</a>".
                            "<a style=\"margin: 5px\" href=". site_url("Admin/odbijNalog/".$korisnik->ID)." class = \"btn btn-info\">Odbij</a></td>";
                        }else {
                            echo "<td><form action=". site_url("Admin/suspendujNalog/".$korisnik->ID)." method = \"GET\"><a onclick = \"suspenduj(this)\" class = \"btn btn-warning\">Suspenduj</a></td></form>";
                        }
                }
                ?>
        </table> 

    </div>


    <script>
        var kliknut;
        function suspenduj(elem)
        {
            kliknut = elem;
            //alert("Tu sam");
            if(elem.innerHTML == "Suspenduj"){
                elem.innerHTML = "<input name=\"BrSati\" type = 'number' placeholder = 'Unesite broj sati'><br><input name=\"Razlog\" style=\"margin: 5px\" placeholder = 'Unesite razlog suspenzije'><br><input type=\"submit\" value=\"Potvrdi\" style=\"margin: 5px\"><button style=\"margin: 5px\">Odustani</button>";
            }    
                
        }

    </script>
</body>
</html>