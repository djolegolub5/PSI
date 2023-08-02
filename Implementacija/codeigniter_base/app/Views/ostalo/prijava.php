<!--    Autor - Aleksa Trivić 2020/0198    -->

<html>
    <title>Prijava</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<body style="background-color: black;">


  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container px-4 px-lg-5">
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
                      <b><a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/prijava") ?>">Uloguj se</a></b>
                      <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/registracija") ?>">Registruj se</a>
                     
                    </div>
            </ul>

        </div>
    </div>
</nav>



    <section class="vh-100" style="background-color: black;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
                <form method ="POST" action="<?= site_url("Gost/loginProvera") ?>">
                  <h3 class="mb-5">Logovanje</h3>
                  <?php
                    if(!empty($poruka)) {
                        echo "<span style = 'color: red; text-align: center;'>" . $poruka . "</span><br>";
                    }
                  
                  
                  ?>
                  <div class="form-outline mb-4">
                    <input type="text" id="loginEmail" name ="username" class="form-control form-control-lg" placeholder="Username" required>
                  </div>
      
                  <div class="form-outline mb-4">
                    <input type="password" id="loginPassword" name="password" class="form-control form-control-lg" placeholder="Lozinka" required>
                  </div>
      
                  <!-- Checkbox -->
 
      
                  <input class="btn btn-primary btn-lg btn-block btn-dark" type="submit" value="Uloguj se">
                </form>
      
      
                </div>
              </div>
            </div>
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