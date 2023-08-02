<!--    Autor - Đorđe Golubović - 2020/0112    -->


<html>
    <title>Anketa</title>
    <meta charset="UTF-8">

    <link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

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
                              <b><a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Registrovan/izaberiKviz")?>">Kvizovi</a></b>
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
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-holder">
                                            <div class="form-content">
                                                <div class="form-items">
                                                    <?php echo "<h3>$forma->Naslov</h3>" ?>
                                                    <p>Popuni kviz.</p>
                                                    <form method="POST" action="<?= site_url("Registrovan/popunjen_kviz/$forma->ID") ?>">

                                                        <hr>

                                                        <?php
                                                        $i = 1;
                                                        $brojPitanja = count($pitanja);

                                                        foreach ($pitanja as $pitanje) {
                                                            $tekst = $pitanje->Tekst;
                                                            $drugitekst = "";
                                                            if($pitanje->Tip == "TEKST"){
                                                                $drugitekst=" ___________ ".$pitanje->DrugiTekst;
                                                                $tekst = $tekst.$drugitekst;
                                                            }
                                                            echo
                                                            "<div class='row'>
                                                        <div class='col-md-10'>
                                                            <span>
                                                                <p>$tekst</p>
                                                            </span>
                                                        </div>
                                                        <div class='col-md-2'>

                                                            <span>({$i}/{$brojPitanja})</span>


                                                        </div>
                                                    </div>";
                                                            $i = $i + 1;


                                                            if ($pitanje->Tip == "SELECT") {
                                                                echo "<div class='row'>

                                                        <div class='col-sm-12'>
                                                            <select class='form-select mt-3' name=$pitanje->ID>
                                                                <option selected disabled value='' checked >Izaberi stavku.</option>";
                                                                foreach ($odgovori[$pitanje->ID] as $odgovor) {
                                                                    echo "<option value=$odgovor->ID name=$pitanje->ID>$odgovor->Tekst</option>";
                                                                }
                                                                echo"
                                                            </select>
                                                        </div>
                                                    </div><hr>";
                                                            } else if ($pitanje->Tip == "CHECK") {
                                                                echo "<div class='row'>

                                                       <div class='col-sm-12' aria-required='true'>";
                                                                foreach ($odgovori[$pitanje->ID] as $odgovor) {
                                                                    echo "<input type='checkbox' name=$pitanje->ID[] value=$odgovor->ID>&nbsp $odgovor->Tekst<br>";
                                                                }
                                                                echo"
                                                        </div>
                                                    </div><hr>";
                                                            } else if ($pitanje->Tip == "RADIO") {
                                                                echo "<div class='row'>

                                                       <div class='col-sm-12' aria-required='true'>";
                                                                foreach ($odgovori[$pitanje->ID] as $odgovor) {
                                                                    echo "<input type='radio' name=$pitanje->ID value=$odgovor->ID>&nbsp $odgovor->Tekst<br>";
                                                                }
                                                                echo"
                                                        </div>
                                                    </div><hr>";
                                                            } else if ($pitanje->Tip == "TEKST") {

                                                                echo "<div class='row'>
                                                        <div class='col-sm-12'>
                                                            <input class='form-control' type='text' name='$pitanje->ID'
                                                                >

                                                        </div>
                                                    </div>    ";
                                                                
                                                                echo"
                                                        
                                                    <hr>";
                                                            } else {

                                                                echo"
                                                      <div class='row'>

                                                        <div class='col-sm-9'>

                                                            <img src=" . base_url() . "/assets/" . "$pitanje->Slika
                                                                alt='$pitanje->DrugiTekst'
                                                                width='100%'>

                                                        </div>
                                                        <div class='col-sm-2'>

                                                            <textarea rows='4' cols='12' name=$pitanje->ID></textarea>

                                                        </div>
                                                    </div>";
                                                                echo"
                                                        
                                                    <hr>";
                                                            }
                                                        }
                                                        ?>


                                                        <input type="hidden" value="<?php echo time()?>" name='vreme'>
                                                        <div class="form-button mt-3">
                                                         <input type="submit"
                                                            class="btn btn-primary btn-dark" value="Završi kviz">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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