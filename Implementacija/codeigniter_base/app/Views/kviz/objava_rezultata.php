<!--    Autor - Stefan Curović 2020/0068    -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta charset = "UTF-8">
    <title>Rezultati</title>
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
                          <b><a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Admin/objavaRezultata"); ?>">Objava rezultata</a></b>

                             
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
<br>
    <h1 class = "text-center text-light">Odaberite kategoriju kviza</h1>
    <div class = "container-fluid text-center" style = "margin-top: 10%;">
    <div class="karta card col-lg-3 col-sm-3" style="width: 18rem; display: inline-block; margin-right: 5%;">
        <img src="<?php echo base_url() ?>assets/aktivni.jpg" class="card-img-top" alt="Aktivni kvizovi" height="300vh">
        <div class="card-body" style = "border: solid black 2px;">
          <h5 class="card-title">Aktivni kvizovi</h5>
          <p class="card-text">Kvizovi koji se i dalje mogu popunjavati od strane takmičara.</p>
          <a href="<?= site_url("Admin/aktivni")?>" class="btn btn-primary">Prikaži</a>
        </div>
      </div>

      <div class="karta card col-lg-3 col-sm-3" style="width: 18rem; display: inline-block; margin-right: 5%;">
        <img src="<?php echo base_url() ?>assets/istekli.png" class="card-img-top" alt="Istekli kvizovi" height="300vh">
        <div class="card-body" style = "border: solid black 2px;">
          <h5 class="card-title">Istekli kvizovi</h5>
          <p class="card-text">Kvizovi koji čekaju Vaše odobrenje za objavu rang liste.</p>
          <a href="<?= site_url("Admin/istekli")?>" class="btn btn-primary">Prikaži</a>
        </div>
      </div>

      <div class="karta card col-lg-3 col-sm-3" style="width: 18rem; display: inline-block;">
        <img src="<?php echo base_url() ?>assets/zavrseni.webp" class="card-img-top" alt="Završeni kvizovi" height="300vh">
        <div class="card-body" style = "border: solid black 2px;">
          <h5 class="card-title">Završeni kvizovi</h5>
          <p class="card-text">Arhiva svih do sada završenih kvizova.</p>
          <a href="<?= site_url("Admin/zavrseni")?>" class="btn btn-primary">Prikaži</a>
        </div>
      </div>
    </div>
    
</body>
</html>