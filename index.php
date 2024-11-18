<?php include "dbyhteys.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Kurssienhallinta</title>
</head>
<body>
    <h1 id="header">Kurssienhallinta<h1>
    <div class="napit">
        <button class="nappi" onClick="lisääOpiskelija()">Lisää</button>
        <button class="nappi" onClick="lisääOpettaja()">Lisää</button>
        <button class="nappi" onClick="lisääKurssi()">Lisää</button>
        <button class="nappi" onClick="lisääTila()">Lisää</button>
    </div>
    <div class="content">
        <div class="Container">
            <div id="lisääOpiskelijaContent" style="display: none">
                <form action="lisaaOpiskelija.php" method="POST">
                    <input class="lisaaInput" type="text" name="Etunimi">
                    <input class="lisaaInput" type="text" name="Sukunimi">
                    <input class="lisaaInput" type="date" name="Syntymäpäivä">
                    <select class="lisaaInput" name="Vuosikurssi"><br>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    <input class="lisaaInputNappi" type="submit" value="Lisää">
                </form>
            </div>
            <div onClick="toggledisplayOpiskelijat()">
                <h1 class="Otsikko">Opiskelijat</h1>
                <img src="./svg/school.svg">
            </div>
            <div id="opiskelijat">
                <?php
                    $opiskelijat = $conn->query("SELECT * FROM `opiskelijat`")->fetchAll();
                    foreach ($opiskelijat as $opiskelija) {
                        echo "<div onClick='toggledisplayInfo(this)'>
                        <a class='tunnus'>" . $opiskelija["Opiskelijanumero"] ." ". $opiskelija["Etunimi"] . "</a>" . 
                        "<a class='Info'>" . $opiskelija["Sukunimi"] . "</a></div>";
                    }
                ?>
            </div>
        </div>
        <div class="Container">
            <div id="lisääOpettajaContent" style="display: none">
                <form action="lisaaOpettaja.php" method="POST">
                    <input class="lisaaInput" type="text" name="Etunimi">
                    <input class="lisaaInput" type="text" name="Sukunimi">
                    <input class="lisaaInput" type="text" name="Aine">
                    <input class="lisaaInputNappi" type="submit" value="Lisää">
                </form>
            </div>
            <div onClick="toggledisplayOpettajat()">
                <h1 class="Otsikko">Opettajat</h1>
                <img src="./svg/person.svg">
            </div>
            <div id="opettajat">
            <?php
                $opettajat = $conn->query("SELECT * FROM `opettajat`")->fetchAll();
                foreach ($opettajat as $opettaja) {
                    echo "<div onClick='toggledisplayInfo(this)'>
                    <a class='tunnus'>" . $opettaja["Tunnusnumero"] ." ". $opettaja["Etunimi"] . "</a>" . 
                    "<a class='Info'>" . $opettaja["Sukunimi"] . "</a></div>";
                }
                ?>
            </div>
        </div>
        <div class="Container">
            <div  onClick="toggledisplayKurssit()">
                <h1 class="Otsikko">Kurssit</h1>
                <img src="./svg/calendar.svg">
            </div>
                <div id="kurssit">
                <?php
                    $kurssit = $conn->query("SELECT * FROM `kurssit`")->fetchAll();
                    foreach ($kurssit as $kurssi) {
                        echo "<div onClick='toggledisplayInfo(this)'>
                        <a class='tunnus'>" . $kurssi["Tunnus"] . " " . $kurssi["Nimi"] . "</a>";
                        
                        $sql = "SELECT * FROM `opettajat` WHERE `Tunnusnumero` = " . $kurssi["Opettaja"];
                        $opettajat = $conn->query($sql)->fetchAll();
                        echo "<a class='Info'>" . $opettajat[0]["Etunimi"] . " " . $opettajat[0]["Sukunimi"] . "<br><br>";

                        echo $kurssi["Kuvaus"] . "<br><br>";

                        $sql = "SELECT * FROM `tilat` WHERE `Tunnus` = " . $kurssi["Tila"];
                        $tilat = $conn->query($sql)->fetchAll();
                        echo $tilat[0]["Nimi"] . "<br><br>";
                        echo $kurssi["Alkupäivä"] . " " . $kurssi["Loppupäivä"];
                        echo "<button onclick='showChicken(this, \"kurssi". $kurssi["Tunnus"] ."\")'>Näytä ilmoittautumiset</button></a>";

                        $sql = "SELECT * FROM `Kurssikirjautumiset` WHERE `Kurssi` = " . $kurssi["Tunnus"];
                        $ilmoittautumiset = $conn->query($sql)->fetchAll();
                        echo "<div id='kurssi" . $kurssi["Tunnus"] . "' style='display: none;'>";
                        echo "<button onclick='hideChicken(this, \"kurssi". $kurssi["Tunnus"] ."\")'>Piilota ilmoittautumiset</button>";
                        foreach ($ilmoittautumiset as $ilmoittautuminen) {
                            $sql = "SELECT * FROM `opiskelijat` WHERE `Opiskelijanumero` = " . $ilmoittautuminen["Opiskelija"];
                            $opiskelijat = $conn->query($sql)->fetchAll();
                            echo "<a>Nimi: " . $opiskelijat[0]["Etunimi"] . "<br>Vuosikurssi: " . $opiskelijat[0]["Vuosikurssi"] . "</a>";
                        }
                        echo "</div></div>";
                    }
                ?>

            </div>
        </div>
        <div class="Container">
            <div id="lisääTilaContent" style="display: none">
                <form action="lisaaTila.php" method="POST">
                    <input class="lisaaInput" type="text" name="Tunnus">
                    <input class="lisaaInput" type="text" name="Nimi">
                    <input class="lisaaInput" type="text" name="Kapasiteetti">
                    <input class="lisaaInputNappi" type="submit" value="Lisää">
                </form>
            </div>
            <div onClick="toggledisplayTilat()">
                <h1 class="Otsikko">Tilat</h1>
                <img src="./svg/room.svg">
            </div>
            <div id="tilat">
                <?php
                    $tilat = $conn->query("SELECT * FROM `tilat`")->fetchAll();
                    foreach ($tilat as $tila) {
                        echo "<div onClick='toggledisplayInfo(this)'>
                        <a class='tunnus'>" . $tila["Tunnus"] ." ". $tila["Nimi"] . "</a>" . 
                        "<a class='Info'> Kapasiteetti " . $tila["Kapasiteetti"] . "</a></div>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>

<script>

    //                            ------------Lisää napit--------------

    function lisääOpiskelija() {
        var show = document.getElementById("lisääOpiskelijaContent").style.display;
        if (show == "block") {
            document.getElementById("lisääOpiskelijaContent").style.display = "none";
        } else {
            document.getElementById("lisääOpiskelijaContent").style.display = "block";
        }
    }

    function lisääOpettaja() {
        var show = document.getElementById("lisääOpettajaContent").style.display;
        if (show == "block") {
            document.getElementById("lisääOpettajaContent").style.display = "none";
        } else {
            document.getElementById("lisääOpettajaContent").style.display = "block";
        }
    }

    // function lisääKurssi() {
    //     var show = document.getElementById("lisääKurssiContent").style.display;
    //     if (show == "block") {
    //         document.getElementById("lisääKurssiContent").style.display = "none";
    //     } else {
    //         document.getElementById("lisääKurssiContent").style.display = "block";
    //     }
    // }

    function lisääTila() {
        var show = document.getElementById("lisääTilaContent").style.display;
        if (show == "block") {
            document.getElementById("lisääTilaContent").style.display = "none";
        } else {
            document.getElementById("lisääTilaContent").style.display = "block";
        }
    }

    //                            --------Näytettää lisäinfot----------

    
    function showChicken(clickedElement, selector) {
        document.getElementById(selector).style.display = "block";
    }

    function hideChicken(clickedElement, selector) {
        document.getElementById(selector).style.display = "none";
    }
    
    function toggledisplayInfo(clickedElement) {
        var infoElement = clickedElement.querySelector(".Info");
        if (infoElement.classList.contains("show")) {
            infoElement.classList.remove("show");
        } else {
            infoElement.classList.add("show");
        }
    }
    
    function toggledisplayOpiskelijat() {
        var element = document.getElementById("opiskelijat");
        if (element.classList.contains("show")) {
            element.classList.remove("show");
        } else {
            element.classList.add("show");
        }
    }

    function toggledisplayOpettajat() {
        var element = document.getElementById("opettajat");
        if (element.classList.contains("show")) {
            element.classList.remove("show");
        } else {
            element.classList.add("show");
        }
    }

    function toggledisplayKurssit() {
        var element = document.getElementById("kurssit");
        if (element.classList.contains("show")) {
            element.classList.remove("show");
        } else {
            element.classList.add("show");
        }
    }

    function toggledisplayTilat() {
        var element = document.getElementById("tilat");
        if (element.classList.contains("show")) {
            element.classList.remove("show");
        } else {
            element.classList.add("show");
        }
    }
    
    </script>

</html>