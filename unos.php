<?php
session_start();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos Vijesti</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo.png" alt="Le Parisien">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="unos.php">UNOS VIJESTI</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form enctype="multipart/form-data" method="post" action="insert.php">
            <div class="form-item">
                <span id="porukaTitle" class="bojaPoruke"></span>
                <input type="text" id="title" name="naslov" placeholder="Naslov" required><br>
            </div>
            <div class="form-item">
                <span id="porukaAbout" class="bojaPoruke"></span>
                <textarea id="about" name="sazetak" placeholder="Kratki sadržaj" required></textarea><br>
            </div>
            <div class="form-item">
                <span id="porukaContent" class="bojaPoruke"></span>
                <textarea id="content" name="tekst" placeholder="Cijeli sadržaj" required></textarea><br>
            </div>
            <div class="form-item">
                <span id="porukaSlika" class="bojaPoruke"></span>
                <input type="file" id="pphoto" name="slika" required><br>
            </div>
            <div class="form-item">
                <span id="porukaKategorija" class="bojaPoruke"></span>
                <select id="category" name="kategorija" required>
                    <option value="" disabled selected>Odabir kategorije</option>
                    <option value="Parisien">Parisien</option>
                    <option value="Vivre">Vivre</option>
                </select><br>
            </div>
            <center><button type="submit" id="slanje">Pošalji</button></center>
        </form>
    </main>
    <footer>
        <p>© Le Parisien</p>
    </footer>

    <script type="text/javascript">
        
        document.getElementById("slanje").onclick = function(event) {
            var slanjeForme = true;

            var poljeTitle = document.getElementById("title");
            var title = document.getElementById("title").value;
            if (title.length < 5 || title.length > 120) {
                slanjeForme = false;
                poljeTitle.style.border = "2px dashed red";
                document.getElementById("porukaTitle").innerHTML = "Naslov vjesti mora imati između 5 i 30 znakova!<br>";
            } else {
                poljeTitle.style.border = "2px solid green";
                document.getElementById("porukaTitle").innerHTML = "";
            }

            var poljeAbout = document.getElementById("about");
            var about = document.getElementById("about").value;
            if (about.length < 10 || about.length > 300) {
                slanjeForme = false;
                poljeAbout.style.border = "2px dashed red";
                document.getElementById("porukaAbout").innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
            } else {
                poljeAbout.style.border = "2px solid green";
                document.getElementById("porukaAbout").innerHTML = "";
            }

            var poljeContent = document.getElementById("content");
            var content = document.getElementById("content").value;
            if (content.length == 0) {
                slanjeForme = false;
                poljeContent.style.border = "2px dashed red";
                document.getElementById("porukaContent").innerHTML = "Sadržaj mora biti unesen!<br>";
            } else {
                poljeContent.style.border = "2px solid green";
                document.getElementById("porukaContent").innerHTML = "";
            }

            var poljeSlika = document.getElementById("pphoto");
            var pphoto = document.getElementById("pphoto").value;
            if (pphoto.length == 0) {
                slanjeForme = false;
                poljeSlika.style.border = "2px dashed red";
                document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena!<br>";
            } else {
                poljeSlika.style.border = "2px solid green";
                document.getElementById("porukaSlika").innerHTML = "";
            }


            var poljeCategory = document.getElementById("category");
            if (document.getElementById("category").selectedIndex == 0) {
                slanjeForme = false;
                poljeCategory.style.border = "2px dashed red";
                document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana!<br>";
            } else {
                poljeCategory.style.border = "2px solid green";
                document.getElementById("porukaKategorija").innerHTML = "";
            }

            if (slanjeForme != true) {
                event.preventDefault();
            }
        };
    </script>
</body>
</html>