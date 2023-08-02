<!--    Autor - Aleksa Trivić - 2020/0198    -->

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Uspešno dodavanje naslova</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <link href=" <?php echo base_url() ?>/stil/uspeh.css" rel="stylesheet" />
</head>
<body style="background-color: black;">
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container px-8 px-lg-8">
                <a class="navbar-brand" href="#!">  
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href = "<?= site_url("Gost/pocetna") ?>">
                            <img src = "<?php echo base_url() ?>assets/logo.png" style = "height: 10vh;">
                        </a></li>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/onama") ?>">O nama</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/prijava") ?>">Uloguj se</a>
                                <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Gost/registracija") ?>">Registruj se</a>
                             
                            </div>
                    </ul>

                </div>
            </div>
        </nav>
        <div class="row centrirano align-items-centerX" style="height:700px">
            <div class="col-sm-12">
                <h1 style="color:white;">Uspesno ste se registrovali.</h1>
                <br>
                <h2><a href="<?= site_url("Gost/pocetna") ?>" class="naziv" >Vrati se na početnu stranicu.</a></h2>


            </div>



        </div>
        <div class="row">
            <footer class="py-5 bg-dark">
                <div class="container"><p class="m-0 text-center text-white">Copyright &copy; The golDen rASpberry, 2023</p></div>
            </footer>
        </div>
</body></html>