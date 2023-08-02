<!--    Autor - Stefan Curović 2020/0068    -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta charset = "UTF-8">
    <title>Napravite novi kviz</title>
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
                          <b> <a class="nav-item nav-link" style = "color: white; font-size: 120%;" href="<?= site_url("Admin/dodavanjeKviza"); ?>">Napravi kviz</a></b>
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
    <h1 class = "text-center text-light">Kreiranje novog kviza</h1>
    <div class = "container-fluid">

<form action = "<?= site_url("Admin/formaRezime")?>" method = "POST" onsubmit = "return sacuvaj()" enctype="multipart/form-data">
    <section class = "col-md-3 text-light" style = "display: inline-block;  overflow: hidden;">
        <button type="button" class="btn btn-light" style = "width: 5vw; height: 10vh; font-size: 200%;" onclick = "jedan(1)">•</button><br><br>
        <button type="button" class="btn btn-light" style = "width: 5vw; height: 10vh; font-size: 200%;" onclick = "jedan(2)">☐</button><br><br>
        <button type="button" class="btn btn-light" style = "width: 5vw; height: 10vh; font-size: 200%;" onclick = "jedan(3)">☰</button><br><br>
        <button type="button" class="btn btn-light" style = "width: 5vw; height: 10vh; font-size: 200%;" onclick = "dopuna(4)">_</button><br><br>
        <button type="button" class="btn btn-light" style = "width: 5vw; height: 10vh; font-size: 200%;" onclick = "slika(5)">?</button>
       
    </section>
    <section id = "sadrzaj" class = "col-md-6 align-top" style = "display: inline-block; margin-top: 3%; overflow: hidden;">
        <input type ="hidden" name="tipForme" value="Kviz">
        <input type ="hidden" id ="pitanjaPodaci" name ="pitanjaPodaci" value = "abc">
        <input type = "text" placeholder="Naslov" name="naslov" style = "width: 100%; text-align: center; font-size: 200%;" required>

    </section>

    <section class = "col-md-2 align-top" style = "display: inline-block; overflow: hidden; margin-left: 5%;">
        <div id = "divPravila"><button class = "btn btn-warning text-center" style = "font-weight: bold; width: 50%;" onclick = "pravila()">Pravila</button></div><br><br>
        <button class = "btn btn-success text-center" style = "font-weight: bold; width: 50%;" onclick = "sacuvaj()">Sačuvaj</button><br><br>
        <button class = "btn btn-danger text-center" style = "font-weight: bold; width: 50%;" onclick = "otkazi()">Otkaži</button>
    </section> 
</form>
</div>

<script>
    var brojPitanja = 0;
    var podaci = [];
    var otvorenaPravila = false;
     var elPitanje = 8, elPonudjen = 3, elSpec = 2;

    function jedan(tip) //korisniku ce se prikazivati tip odabranog pitanja, a adminu je taj prikaz isti za prve tri opcije
    {
        var stariPodaci = [];
        if(brojPitanja > 0) {
            stariPodaci.push(document.getElementsByName("naslov")[0].value);
            for(var i = 1; i <= brojPitanja; i++) {

                stariPodaci.push(document.getElementsByName("pitanje" + i)[0].value);
   
                for(var j = 1; j <= podaci[i-1][1]; j++) {
                    stariPodaci.push(document.getElementsByName(i + "," + j + "t")[0].value);
                    if(podaci[i-1][2] < 4) stariPodaci.push(document.getElementsByName(i + "," + j)[0].value);
                }
            }
        }
        
        brojPitanja++;
        podaci.push([brojPitanja, 1, tip]);
        var x = brojPitanja;
        document.getElementById("sadrzaj").innerHTML += "<div id = 'dp" + brojPitanja + "'<br><br><input type = 'text' placeholder = 'Pitanje' name = 'pitanje" + brojPitanja + "' style = 'width: 70%; font-size: 150%;' required><br><br><input type = 'text' placeholder = 'Ponudjen odgovor' name = '" + brojPitanja + "," + podaci[brojPitanja - 1][1] + 
                "' style = 'width: 70%; font-size: 150%;' required><input type = 'checkbox' name = '" + brojPitanja + "," + podaci[brojPitanja - 1][1] +  "t'><input type = 'button' style = 'width: 5%; font-size: 200%; margin-left: 5%;'; value = '+' onclick = 'josJedan(" + x + ")'><input type = 'button' style = 'width: 5%; font-size: 200%; margin-left: 5%;'; value = '-1' onclick = 'minusJedan(" + x + ")'></div><br>";
    
        if(brojPitanja > 1) {
            document.getElementsByName("naslov")[0].value = stariPodaci.shift();  
            for(var i = 1; i < brojPitanja; i++) {
                document.getElementsByName("pitanje" + i)[0].value = stariPodaci.shift();
                for(var j = 1; j <= podaci[i-1][1]; j++) {
                   document.getElementsByName(i + "," + j + "t")[0].value = stariPodaci.shift();
                    if(podaci[i-1][2] < 4) document.getElementsByName(i + "," + j)[0].value = stariPodaci.shift();
                }
            }
        }
    }

    function josJedan(broj)
    {
        podaci[broj-1][1]++;
        var stariPodaci = [];
        stariPodaci.push(document.getElementsByName("naslov")[0].value);
         
        for(var i = 1; i <= brojPitanja; i++) {
           
            stariPodaci.push(document.getElementsByName("pitanje" + i)[0].value);

            for(var j = 1; j <= podaci[i-1][1]; j++) {
                if(j == podaci[i-1][1] && i == broj) continue;
                stariPodaci.push(document.getElementsByName(i + "," + j + "t")[0].value);
                if(podaci[i-1][2] < 4) stariPodaci.push(document.getElementsByName(i + "," + j)[0].value);
            }
        }
        
        document.getElementById("dp" + broj).innerHTML += "<input type = 'text' placeholder = 'Ponudjen odgovor' name = '" + broj + "," + podaci[broj - 1][1] + "' style = 'width: 70%; font-size: 150%;' required><input type = 'checkbox' name = '" + broj + "," + podaci[broj - 1][1] +  "t'><br>";   
    
        document.getElementsByName("naslov")[0].value = stariPodaci.shift();  
        for(var i = 1; i <= brojPitanja; i++) {
            document.getElementsByName("pitanje" + i)[0].value = stariPodaci.shift();
            for(var j = 1; j <= podaci[i-1][1]; j++) {
               if(j == podaci[i-1][1] && i == broj) continue;
               document.getElementsByName(i + "," + j + "t")[0].value = stariPodaci.shift();
               if(podaci[i-1][2] < 4) document.getElementsByName(i + "," + j)[0].value = stariPodaci.shift();
            }
        }
    }

    function dopuna(tip)
    {
        var stariPodaci = [];
        if(brojPitanja > 0) {
            stariPodaci.push(document.getElementsByName("naslov")[0].value);
            for(var i = 1; i <= brojPitanja; i++) {

                stariPodaci.push(document.getElementsByName("pitanje" + i)[0].value);
   
                for(var j = 1; j <= podaci[i-1][1]; j++) {
                    stariPodaci.push(document.getElementsByName(i + "," + j + "t")[0].value);
                    if(podaci[i-1][2] < 4) stariPodaci.push(document.getElementsByName(i + "," + j)[0].value);
                }
            }
        }
        
        brojPitanja++;
        podaci.push([brojPitanja, 1, tip]);
        var x = brojPitanja;
        document.getElementById("sadrzaj").innerHTML += "<div id = 'dp" + brojPitanja + "'<br><br><input type = 'text' placeholder = 'Prvi deo' name = 'pitanje" + brojPitanja + "' style = 'width: 70%; font-size: 150%;' required><br><input type = 'text' placeholder = 'Drugi deo' name = 'dopunad" + brojPitanja + "' style = 'width: 70%; font-size: 150%;' required><br><input type = 'text' placeholder = 'Resenje' name = '" + brojPitanja + "," + podaci[brojPitanja - 1][1] + "t' style = 'width: 70%; font-size: 150%;' required><input type = 'button' style = 'width: 10%; font-size: 200%; margin-left: 5%;'; value = '+' onclick = 'josJednoResenje(" + x + ")'><input type = 'button' style = 'width: 5%; font-size: 200%; margin-left: 2%;'; value = '-1' onclick = 'minusJedan(" + x + ")'></div><br>";
    
        if(brojPitanja > 1) {
            document.getElementsByName("naslov")[0].value = stariPodaci.shift();  
            for(var i = 1; i < brojPitanja; i++) {
                document.getElementsByName("pitanje" + i)[0].value = stariPodaci.shift();
                for(var j = 1; j <= podaci[i-1][1]; j++) {
                   document.getElementsByName(i + "," + j + "t")[0].value = stariPodaci.shift();
                   if(podaci[i-1][2] < 4) document.getElementsByName(i + "," + j)[0].value = stariPodaci.shift();
                }
            }
        }
    }
    
    function josJednoResenje(broj)
    {
        podaci[broj-1][1]++;
        var stariPodaci = [];
        stariPodaci.push(document.getElementsByName("naslov")[0].value);
         
        for(var i = 1; i <= brojPitanja; i++) {
           
            stariPodaci.push(document.getElementsByName("pitanje" + i)[0].value);

            for(var j = 1; j <= podaci[i-1][1]; j++) {
                if(j == podaci[i-1][1] && i == broj) continue;
                stariPodaci.push(document.getElementsByName(i + "," + j + "t")[0].value);
                if(podaci[i-1][2] < 4) stariPodaci.push(document.getElementsByName(i + "," + j)[0].value);
            }
        }
        
        document.getElementById("dp" + broj).innerHTML += "<input type = 'text' placeholder = 'Resenje' name = '" + broj + "," + podaci[broj - 1][1] + "t' style = 'width: 70%; font-size: 150%;' required><br>";
        
        document.getElementsByName("naslov")[0].value = stariPodaci.shift();  
        for(var i = 1; i <= brojPitanja; i++) {
            document.getElementsByName("pitanje" + i)[0].value = stariPodaci.shift();
            for(var j = 1; j <= podaci[i-1][1]; j++) {
               if(j == podaci[i-1][1] && i == broj) continue;
               document.getElementsByName(i + "," + j + "t")[0].value = stariPodaci.shift();
               if(podaci[i-1][2] < 4) document.getElementsByName(i + "," + j)[0].value = stariPodaci.shift();
            }
        }
    }

    function slika(tip)
    {
        var stariPodaci = [];
        if(brojPitanja > 0) {
            stariPodaci.push(document.getElementsByName("naslov")[0].value);
            for(var i = 1; i <= brojPitanja; i++) {

                stariPodaci.push(document.getElementsByName("pitanje" + i)[0].value);
   
                for(var j = 1; j <= podaci[i-1][1]; j++) {
                    stariPodaci.push(document.getElementsByName(i + "," + j + "t")[0].value);
                    if(podaci[i-1][2] < 4) stariPodaci.push(document.getElementsByName(i + "," + j)[0].value);
                }
            }
        }
        
        brojPitanja++;
        podaci.push([brojPitanja, 1, tip]);
        var x = brojPitanja;
        document.getElementById("sadrzaj").innerHTML += "<div id = 'dp" + brojPitanja + "'<br><br><span class = 'text-light' style = 'font-size: 150%;'>Slika pitanja:</span> <input type='file' accept = 'image/jpg, image/jpeg, image/png' style = 'width: 70%;' name = 'slika" + brojPitanja + "' required><br><input type = 'text' placeholder = 'Pitanje' name = 'pitanje" + brojPitanja + "' style = 'width: 70%; font-size: 150%;' required><input type = 'text' placeholder = 'Resenje' name = '" + brojPitanja + "," + podaci[brojPitanja - 1][1] + "t' style = 'width: 70%; font-size: 150%;' required><input type = 'button' style = 'width: 10%; font-size: 200%; margin-left: 5%;'; value = '+' onclick = 'josJednoResenje(" + x + ")'><input type = 'button' style = 'width: 5%; font-size: 200%; margin-left: 2%;'; value = '-1' onclick = 'minusJedan(" + x + ")'></div><br>";
    
        if(brojPitanja > 1) {
            document.getElementsByName("naslov")[0].value = stariPodaci.shift();  
            for(var i = 1; i < brojPitanja; i++) {
                document.getElementsByName("pitanje" + i)[0].value = stariPodaci.shift();
                for(var j = 1; j <= podaci[i-1][1]; j++) {
                   document.getElementsByName(i + "," + j + "t")[0].value = stariPodaci.shift();
                    if(podaci[i-1][2] < 4) document.getElementsByName(i + "," + j)[0].value = stariPodaci.shift();
                }
            }
        }
    }

    function pravila()
    {
        var dp = document.getElementById("divPravila");
        var bodovi = [];
        if(!otvorenaPravila)
        {
            otvorenaPravila = true;
            dp.innerHTML += "<br><br><input type = 'radio' name = 'tipKviza' id = 'po1' value = 'Domaci' required><label for='po1' style = 'color: white;'>Domaća kinematografija</label><br><input type = 'radio' name = 'tipKviza' id = 'po2' value = 'Strani' required><label for='po2' style = 'color: white;'>Strana kinematografija</label><br><br><h5 style = 'color: white;'>Bodovanje</h5>";
            dp.innerHTML += "<table class = table table-light table-striped style = 'border: solid white 2px;'>";
            for(var i = 0; i < brojPitanja; i++)
            {
               dp.innerHTML += "<tr><td><span style = 'color: white;'>" + (i+1) + "</span></td><td><input type = 'number' style = 'width: 20%;' name = 'poeni" + i + "' required></td></tr><br>";
            }
            dp.innerHTML += "</table>";
            dp.innerHTML += "<br><br><h5 style = 'color: white;'>Nagrade</h5><p class = 'text-light'>I mesto: &nbsp; <input type = 'number' style = 'width : 20%;' name = 'nagrade1' required><br>II mesto: <input type = 'number' style = 'width : 20%; margin-left: 1.2%;' name = 'nagrade2' required><br>III mesto: <input type = 'number' style = 'width : 20%;' name = 'nagrade3' required><br></p>";
        }
        else
        {
            otvorenaPravila = false;
            dp.innerHTML = "<button class = 'btn btn-warning text-center' style = 'font-weight: bold; width: 50%;' onclick = 'pravila()'>Pravila</button>";
        }
    }

    function minusJedan(broj)
    {
        var el = document.getElementById("dp" + broj);
        if(podaci[broj-1][1] > 1) {
            if(podaci[broj-1][2] < 4) {
                for(var i = 0; i < elPonudjen; i++) {
                    el.removeChild(el.lastChild);
                }
            }
            else {
                for(var i = 0; i < elSpec; i++) {
                    el.removeChild(el.lastChild);
                }
            }
            podaci[broj-1][1]--;
        }
        else {
            for(var i = 0; i < elPitanje; i++) {
                 el.removeChild(el.lastChild);
            }
            podaci.splice(broj-1, 1);
            brojPitanja--;
            
            document.getElementById("sadrzaj").removeChild(el);
        }
    }

    function sacuvaj()
    {
        if(document.getElementById("divPravila").childNodes.length == 1)
        {
            alert("Morate uneti pravila kviza!");
            return false;
            
        }
        if(brojPitanja == 0)
        {
            alert("Morate uneti pitanja pre čuvanja forme!");
            return false;
        }
        document.getElementById("pitanjaPodaci").value = JSON.stringify(podaci);
       
    }

    function otkazi()
    {
        location.replace("<?= site_url("Admin/pocetna")?>");
    }

</script>
</body>
</html>