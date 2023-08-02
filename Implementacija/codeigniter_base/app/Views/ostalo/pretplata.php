<!--    Autor - Stefan Curović 2020/0068    -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">

    <title>Pretplata za kritičara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/logo.png" />

</head>
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
                              <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Registrovan/onama")?>">O nama</a>
                              <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Registrovan/anketa")?>">Ankete</a>
                              <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Registrovan/izaberiKviz")?>">Kvizovi</a>
                              <?php
                                if($controller == "Registrovan") {
                                    echo '<b><a class = "nav-item nav-link" style = "color: gold; font-size: 120%;" href = "' . site_url("Registrovan/pretplata") . '">Pretplati se</a></b>';
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
    

    <section class="p-4 p-md-5">
  <div class="row d-flex justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-5">
      <div class="card rounded-3">
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <?php
                if(!empty($poruka)) {
                    echo "<span style = 'color: red' text-align: center;'>" . $poruka . "</span>";
                }
            ?>
            <h3>Pretplata za kritičara</h3>
            <h6>Plaćanje</h6>
          </div>
          <form action="<?= site_url("Registrovan/potvrdiPretplatu/1") ?>" method = "POST">
            
            <div class = "row">
                <h5 class = "text-center">Ovde možete kupiti ili produžiti svoju pretplatu za Kritičara, odabirom jednog od naših paketa. Ocenjujte, komentarišite i uživajte u bogatijem sadržaju po povoljnim cenama!</h5>
                <br><br><br><br>
                <div class="card col-md-3" >
                   
                    <div class="card-body text-center">
                      <h5 class="card-title">Mesec dana - 299RSD ili 250 POENA</h5>
                      <p class="card-text">Oprobajte se u novoj ulozi!</p>
                    </div>
                </div>

                <div class="card col-md-3 text-center">
                   
                    <div class="card-body">
                      <h5 class="card-title">Tri meseca - 699RSD ili 600 POENA</h5>
                      <p class="card-text">Uvek sigurna opcija!</p>
                    </div>
                </div>

                <div class="card col-md-3 text-center">
                   
                    <div class="card-body">
                      <div class="badge bg-primary text-light position-absolute" style="top: 1px; right: 1px">+200 POENA!</div>
                      <h5 class="card-title">Šest meseci - 1399RSD ili 1200 POENA</h5>
                      <p class="card-text">Najpopularnija opcija!</p>
                    </div>
                </div>

                <div class="card col-md-3 text-center">
                   
                    <div class="card-body">
                      <div class="badge bg-primary text-light position-absolute" style="top: 1px; right: 1px">+500 POENA!</div>
                      <h5 class="card-title">Godinu dana - 2599RSD ili 2000 POENA</h5>
                      <p class="card-text">Samo za najbolje kritičare!</p>
                    </div>
                </div>
                  
            </div>
            <br><br>

            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name = "opcija1" id="select1">
                <option value="0" selected>Odaberite željeni paket:</option>
                <option value="1">Mesec dana - 299RSD</option>
                <option value="2">Tri meseca - 699RSD</option>
                <option value="3">Šest meseci + 200 POENA - 1399RSD</option>
                <option value="4">Godinu dana + 500 POENA - 2599RSD</option>
            </select>

            <p class="fw-bold mb-4">Informacije o kartici</p>

            <div class="form-outline mb-4">
              <input type="text" id="formControlLgXsd" class="form-control form-control-lg" name ="ImePrezime" required
                placeholder="Petar Petrović" />
              <label class="form-label" for="formControlLgXsd">Ime na kartici</label>
            </div>

            <div class="row mb-4">
              <div class="col-7">
                <div class="form-outline">
                  <input type="text" id="formControlLgXM" class="form-control form-control-lg" name ="BrKartice" required
                    placeholder="1111 2222 3333 4444" />
                  <label class="form-label" for="formControlLgXM">Broj kartice</label>
                </div>
              </div>
              <div class="col-3">
                <div class="form-outline">
                  <input type="text" id="formControlLgExpk" class="form-control form-control-lg" name="VaziDo" required
                    placeholder="MM/YYYY" />
                  <label class="form-label" for="formControlLgExpk">Rok važenja</label>
                </div>
              </div>
              <div class="col-2">
                <div class="form-outline">
                    <input type="text" id="formControlLgcvv" class="form-control form-control-lg" name="CVV" required
                    placeholder="123" />
                  <label class="form-label" for="formControlLgcvv">CVV</label>
                </div>
              </div>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="formControlLgXsd2" class="form-control form-control-lg" name="Drzava" required
                  placeholder="" />
                <label class="form-label" for="formControlLgXsd2">Država</label>
            </div>
            <div class="form-outline mb-4">
                <input type="text" id="formControlLgXsd3" class="form-control form-control-lg" name="Grad" required
                  placeholder="" />
                <label class="form-label" for="formControlLgXsd3">Grad</label>
            </div>

            <div class="form-outline mb-4">
                <input type="checkbox" id="formControlLgXsd4" required />
                <label class="form-label" for="formControlLgXsd4">Prihvatam uslove korišćenja i sve polise privatnosti sajta Virtuelni Video Klub.</label>
            </div>

            <input type ="submit" onclick="return predjiNaUplatu(1)" class="btn btn-success btn-lg btn-block" value="Potvrdi uplatu">
          </form>
        </div>
      </div>
    </div>
  </div>
  <br><br>
  <h1 class="text-center">ILI</h1>
  
  <br><br>

  <form action="<?= site_url("Registrovan/potvrdiPretplatu/2") ?>" method = "POST" class = "text-center">
      <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name = "opcija2" id="select2">
                <option value="0" selected>Odaberite željeni paket:</option>
                <option value="1">Mesec dana - 299RSD</option>
                <option value="2">Tri meseca - 699RSD</option>
                <option value="3">Šest meseci + 200 POENA - 1399RSD</option>
                <option value="4">Godinu dana + 500 POENA - 2599RSD</option>
            </select>
    <input type = "submit" onclick="return predjiNaUplatu(2)" class = "btn btn-secondary" value = "PLATI NOVCEM SA NALOGA" style = "font-size: 200%; font-weight: bold; border-radius: 10%;">
    <br>
    <span style = "font-size: 150%;">(Trenutan novac koji posedujete je: <?php echo $novac; ?>)</span>

  </form>
  <br><br>
  <h1 class="text-center">ILI</h1>
  <br><br>

  <form action="<?= site_url("Registrovan/potvrdiPretplatu/3") ?>" method = "POST" class = "text-center">
      <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name = "opcija3" id="select3">
                <option value="0" selected>Odaberite željeni paket:</option>
                <option value="1">Mesec dana - 299 POENA</option>
                <option value="2">Tri meseca - 699 POENA</option>
                <option value="3">Šest meseci + 200 POENA - 1399 POENA</option>
                <option value="4">Godinu dana + 500 POENA - 2599 POENA</option>
            </select>
    <input type = "submit" onclick="return predjiNaUplatu(3)" class = "btn btn-warning" value = "PLATI POENIMA SA NALOGA" style = "font-size: 200%; font-weight: bold; border-radius: 10%;">
    <br>
    <span style = "font-size: 150%;">(Trenutan broj poena koji posedujete je: <?php echo $poeni; ?>)</span>

  </form>
</section>
        
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; The golDen rASpberry, 2023</p></div>
        </footer>

        
<script>
    
    function predjiNaUplatu(tip) {
        if(document.getElementById("select" + tip).value == 0) {
            alert("Morate izabrati neku od ponudjenih opcija!");
            return false;
        }
       
    }
            
            
</script>
</body>
</html>