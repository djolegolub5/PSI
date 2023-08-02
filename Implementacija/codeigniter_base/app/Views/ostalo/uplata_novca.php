<!--    Autor - Teodora Ristović - 2020/0566    -->

<html>

    <title>Uplata novca</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href=" <?php echo base_url() ?>/stil/podesavanja.css" rel="stylesheet" />
    <body style="background-color: #333333;">

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
      <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100 text-center">
        <div class="col-xl-9" >

          <div class="card" style="border-radius: 15px;">
            <div class="card-body" align="center">
                
                <h3 class="mb-5 text-center" style="color: black; margin-top:5%">Uplata novca</h3>
                <div class="container p-0">
                    <div class="card px-4">
                    
                        <form  method="GET" action="<?= site_url("Registrovan/uplati") ?>">
                            <p class="h8 py-3">Detalji uplate</p>
                            <div class="row gx-3">
                                <div class="col-12">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Ime i prezime</p>
                                        <input class="form-control mb-3" type="text" placeholder="Name" name = "ImePrezime" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Broj kartice</p>
                                        <input class="form-control mb-3" type="text" placeholder="1234 5678 435678" name="BrKartice" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Važi do</p>
                                        <input class="form-control mb-3" type="text" placeholder="MM/YYYY"  name = "VaziDo" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">CVV</p>
                                        <input class="form-control mb-3 pt-2 " type="password"  name = "CVV" placeholder="***" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Država</p>
                                        <input class="form-control mb-3 pt-2 " type="text"  name = "Drzava" placeholder="Srbija" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Grad</p>
                                        <input class="form-control mb-3 pt-2 " type="text"  name = "Grad" placeholder="Beograd" required>
                                    </div>
                                </div>

                                <div class="col-12 mb-2 p-2">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Suma</p>
                                        <select class="form-select"  name="Suma"  aria-label="Default select example">
                                            <option value = "1">500RSD</option>
                                            <option value="2">1000RSD</option>
                                            <option value="3">1500RSD</option>
                                            <option value="4">2000RSD</option>
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check pt-2">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Prihvatam uslove korišćenja i sve polise privatnosti sajta Virtuelni Video Klub.
                                        </label>
                                    </div>
                                    <input type="submit" value ="Izvrši" class="btn btn-outline-secondary mt-3 mb-3">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
  
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </section>
        
</body>
  </html>
