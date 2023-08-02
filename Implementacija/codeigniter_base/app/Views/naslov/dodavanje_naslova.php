<!--    Autor - Teodora Ristović - 2020/0566    -->

<html>


    <title>Dodavanje naslova</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src=" <?php echo base_url() ?>/js/dodavanje_naslova.js"></script>
    <link href=" <?php echo base_url() ?>/stil/podesavanja.css" rel="stylesheet"/>
    <body style="background-color: #333333;" onload = "init()">
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
                          <b><a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Admin/dodavanjeNaslova"); ?>">Dodaj naslov</a></b>
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
      <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100 text-center">
        <div class="col-xl-9" >

          <div class="card" style="border-radius: 15px;">
            <div class="card-body" align="center">
                
                <h3 class="mb-5 text-center" style="color: black; margin-top:5%">Dodavanje naslova</h3>
                <hr>
              <form method = "POST" action="<?= site_url("Admin/dodajNaslov") ?>" enctype="multipart/form-data">
                <div class="row align-items-center pt-4 pb-3">

                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Naziv naslova:</h6>

                  </div>
                  
                  <div class="col-md-9 pe-5">

                    <input type="text" class="form-control form-control-lg" required name="naslov" />

                  </div>
                </div>

                <hr class="mx-n3">

                <div class="row align-items-center pt-4 pb-3">

                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Godina: </h6>

                  </div>
                  
                  <div class="col-md-9 pe-5">

                    <input type="text" class="form-control form-control-lg" required name="godina" />

                  </div>
                </div>
                <hr class="mx-n3">

                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Kategorija naslova:</h6>

                  </div>
                  <div class="col-md-9 pe-5">
                    <table id = "katTable">
                      <tr>
                        <td><input type="radio" name="kategorija" id = "serija" value = "Serija" onclick="dodaj(0)"></td>
                        <td id = "serijaRow">&nbspSerija</td>
                      </tr>
                      <tr>
                        <td><input type="radio" name="kategorija" id = "film" value = "Film" onclick="dodaj(1)"></td>
                        <td id = "filmRow">&nbspFilm</td>
                      </tr>
                    </table>

                  </div>
                </div>
                <hr class="mx-n3">
                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Žanr naslova:</h6>

                  </div>
                  <div class="col-md-9 pe-5">

                    <table>
                      <tr>
                        <td><input type="checkbox" value ="Triler" name="zanr[]" checked></td>
                        <td>&nbsp Triler</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value="Krimi" name="zanr[]" ></td>
                        <td>&nbsp Krimi</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value="Misterija" name="zanr[]" ></td>
                        <td>&nbsp Misterija</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value ="Drama" name="zanr[]" ></td>
                        <td>&nbsp Drama</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value = "Horor" name="zanr[]" ></td>
                        <td>&nbsp Horor</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value = "Romansa" name="zanr[]" ></td>
                        <td>&nbsp Romansa</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value = "Fantastika" name="zanr[]" ></td>
                        <td>&nbsp Fantastika</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value = "Dokumentarni" name="zanr[]" ></td>
                        <td>&nbsp Dokumentarni</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value = "Komedija" name="zanr[]" ></td>
                        <td>&nbsp Komedija</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value = "Akcija" name="zanr[]" ></td>
                        <td>&nbsp Akcija</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value = "Avantura" name="zanr[]" ></td>
                        <td>&nbsp Avantura</td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" value = "Naučna fantastika" name="zanr[]" ></td>
                        <td>&nbsp Naučna fantastika</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <hr class="mx-n3">
                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Cena usluge kupovine naslova:</h6>

                  </div>
                  <div class="col-md-9 pe-5">

                    <input type="number" name = "cena" class="form-control form-control-lg" required>

                  </div>
                </div>
                <hr class="mx-n3">
                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Cena usluge kupovine naslova izražena u broju poena:</h6>

                  </div>
                  <div class="col-md-9 pe-5">

                    <input type="number" name= "poeni" class="form-control form-control-lg" required />

                  </div>
                </div>
                <hr class="mx-n3">
                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Broj poena koji se dobija prilikom kupovine naslova:</h6>

                  </div>
                  <div class="col-md-9 pe-5">

                    <input type="number" name= "poeniNakonKupovine" class="form-control form-control-lg" required />

                  </div>
                </div>
                <hr class="mx-n3">
                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Pristupni link:</h6>

                  </div>
                  <div class="col-md-9 pe-5">

                    <input type="text" name="link" class="form-control form-control-lg" required />

                  </div>
                </div>
                <hr class="mx-n3">

                <div class="row align-items-center pt-4 pb-3">

                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Opis: </h6>

                  </div>
                  
                  <div class="col-md-9 pe-5">

                    <input type="text" class="form-control form-control-lg" name="opis" required  />

                  </div>
                </div>
                <hr class="mx-n3">
                <div class="row align-items-center py-3">
                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Naslovna fotografija:</h6>

                  </div>
                  <div class="col-md-9 pe-5">

                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="slika" accept="image/jpg, image/jpeg, image/png"/>
                    <div class="small text-muted mt-2">Zakači naslovnu fotografiju. Maksimalna velicina - 50MB.</div>

                  </div>
                </div>
                <hr>
              <div class="px-5 py-4">
                <a href="uspesno_dodavanje_naslova.html">
                  <input type="submit" value ="Dodaj naslov" class="btn btn-primary btn-lg btn-dark"/>
                </a>
              </div>
            </form>
  
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </section>
</body>
  </html>
