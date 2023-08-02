<!--    Autor - Stefan Curović 2020/0068    -->

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
    <meta charset = "UTF-8">
    <title>Rezime forme</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <h1 style =  "text-align: center; color: white; font-size: 350%;">Rezime</h1>
    <section style = "text-align: center; color: white; font-size: 200%;">
        Tip forme: <?php echo $tip; ?><br>
        <?php if(!empty($tipKviza)) echo "Tip kviza: " . $tipKviza . "<br>"; ?>
        Ukupan broj pitanja: <?php if(!empty($brojPitanja)) echo $brojPitanja; ?><br>
        Autor forme: <?php if(!empty($ime)) echo $ime; ?><br><br>

        <?php  
            if(!empty($poruka)) echo "<span style = 'color: red; text-align: center;'>" . $poruka . "</span><br><br>";
        ?>
        
        Unesite datum do kad je forma validna:<br>
        <?php
            echo ' <form action = "' . site_url("Admin/dodajFormu") . '" method = "POST">';
        ?>
        <input type = "date" name="datumDo" style = "width: 30%;" required><br><br>
        <input type ="hidden" name="naslov" value="<?php echo $naslov; ?>">
        <input type ="hidden" name="tipForme" value="<?php echo $tip; ?>">
        <input type ="hidden" name ="podaci" value="<?php echo $podaci; ?>">
        <input type ="hidden" name ="pitanja" value="<?php echo $pitanja; ?>">
       <?php if($tip == "Kviz") {
           echo ' <input type ="hidden" name="tipKviza" value="' . $tipKviza . '">';
           echo ' <input type = "hidden" name = "pravila" value = "' . $pravila . '">';
       }?>
        <button type = "submit" class="btn btn-success" style = "text-align: center; font-size: 150%; font-weight: bold;">Objavi formu!</button><br>
        </form>
        <button class = "btn btn-danger" style = "text-align: center; font-size: 75%;" onclick = "povratak()">Povratak na kreiranje forme</button>
    </section>

    <script>
        function povratak()
        {
            location.replace("<?php
            if($tip == "Kviz")
                echo site_url("Admin/dodavanjeKviza");
            else
                echo site_url("Admin/dodavanjeAnkete");
            ?>");
        }
    </script>
    <br>
    <div class="row">
        <footer class="py-5 bg-dark">
          <div class="container"><p class="m-0 text-center text-white">Copyright &copy; The golDen rASpberry, 2023</p></div>
      </footer>
      </div>
</body>
</html>