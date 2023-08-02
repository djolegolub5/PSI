<!--    Autor - Aleksa Trivić - 2020/0198    -->

<html>

        <title>Registracija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <body style="background-color: black">

        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container px-8 px-lg-8">
                <a class="navbar-brand" href="#!">  
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= site_url("Gost/pocetna") ?>">
                            <img src = "<?php echo base_url() ?>assets/logo.png" style = "height: 10vh;">
                        </a></li>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                              <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/onama") ?>">O nama</a>
                              <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/prijava") ?>">Uloguj se</a>
                              <b><a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/registracija") ?>">Registruj se</a></b>
                             
                            </div>
                    </ul>

                </div>
            </div>
        </nav>


<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100 text-center">
        <div class="col-xl-9" >

          <form method = "POST" action="<?= site_url("Gost/dodajNalog") ?>" enctype="multipart/form-data">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body" align="center">
                  
                  <h3 class="mb-5 text-center" style="color: black; margin-top:5%">Registracija</h3>
                  
                  <?php
                    if(!empty($poruka)) {
                        echo "<span style = 'color: red; text-align: center;'>" . $poruka . "</span><br>";
                    }
                  
                  
                  ?>

                <div class="row align-items-center pt-4 pb-3">

                  <div class="col-md-3 ps-5">
    
                    <h6 class="mb-0">Ime:</h6>
    
                  </div>
                  <div class="col-md-9 pe-5">
    
                    <input type="text" name="ime" class="form-control form-control-lg" required/>
    
                  </div>
                </div>
                <hr class="mx-n3">

                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">
    
                    <h6 class="mb-0">Prezime:</h6>
    
                  </div>
                  <div class="col-md-9 pe-5">
    
                    <input type="text" name="prezime" class="form-control form-control-lg" required />
    
                  </div>
                </div>
                <hr class="mx-n3">
                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">
    
                    <h6 class="mb-0">Username:</h6>
    
                  </div>
                  <div class="col-md-9 pe-5">
    
                    <input type="text" name="username" class="form-control form-control-lg" required />
    
                  </div>
                </div>
                <hr class="mx-n3">
                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">
    
                    <h6 class="mb-0">Lozinka:</h6>
    
                  </div>
                  <div class="col-md-9 pe-5">
    
                    <input type="password" name="lozinka"  class="form-control form-control-lg" required />
    
                  </div>
                </div>
                <label style="color: red; margin-left: 10%"> 
                    Lozinka mora da sadrži barem jedno slovo, barem jedan broj i dužina lozinke mora biti minimalno 8 karaktera
                </label>
                <hr class="mx-n3">
                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">
    
                    <h6 class="mb-0">Datum rodjenja:</h6>
    
                  </div>
                  <div class="col-md-9 pe-5">
    
                    <input type="date" name="datum" class="form-control form-control-lg" required />
    
                  </div>
                </div>
                <hr class="mx-n3">
                
    
                <div class="row align-items-center py-3">
                  <div class="col-md-3 ps-5">
    
                    <h6 class="mb-0">Email:</h6>
    
                  </div>
                  <div class="col-md-9 pe-5">
    
                    <input type="email" name="mejl" class="form-control form-control-lg" placeholder="example@example.com" required />
    
                  </div>
                </div>
    
                <hr class="mx-n3">
                <div class="row align-items-center pt-4 pb-3">
                  <div class="col-md-3 ps-5">
    
                    <h6 class="mb-0">Broj telefona:</h6>
    
                  </div>
                  <div class="col-md-9 pe-5">
    
                    <input type="text" name="telefon" class="form-control form-control-lg" placeholder="example: +38163271688" required>
    
                  </div>
                </div>
                <hr class="mx-n3">
                <div class="row align-items-center py-3">
                  <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Profilna fotografija:</h6>

                  </div>
                  <div class="col-md-9 pe-5">

                    <input class="form-control form-control-lg" id="formFileLg" type="file" name="slika" accept="image/jpg, image/jpeg, image/png"/>
                    <div class="small text-muted mt-2">Zakači profilnu fotografiju. Maksimalna velicina - 50MB.</div>

                  </div>
                </div>
                <hr class="mx-n3">
    
                
      
                <div class="px-5 py-4">
                  <input type="submit" class="btn btn-primary btn-lg btn-dark" value="Registruj se">
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
