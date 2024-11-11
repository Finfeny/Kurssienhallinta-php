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
    <div class="content">
        <div class="Container" onClick="toggledisplayOpiskelijat()">
            <!-- <div class="" id="opiskelijat" onClick="document.getElementById('opiskelijat').innerHTML = 'HElp'"></div> -->
        <h1 class="Otsikko">Opiskelijat</h1>
            <img src="./svg/school.svg">
            <div id="opiskelijat">
                <?php
                    $opiskelijat = $conn->query("SELECT * FROM `opiskelijat`")->fetchAll();
                    foreach ($opiskelijat as $opiskelija) {
                        echo "<a class='tunnus'>" . $opiskelija["Opiskelijanumero"] ." ". $opiskelija["Etunimi"] . "</a>" . "<a>". $opiskelija["Sukunimi"] . "</a>";
                    }
                ?>
            </div>
        </div>
        <div class="Container" onClick="toggledisplayOpettajat()">
            <h1 class="Otsikko">Opettajat</h1>
            <img src="./svg/person.svg">
            <div id="opettajat">
            <?php
                    $opettajat = $conn->query("SELECT * FROM `opettajat`")->fetchAll();
                    foreach ($opettajat as $opettaja) {
                        echo "<a class='tunnus'>" . $opettaja["Tunnusnumero"] ." ". $opettaja["Etunimi"] . "<br>". $opettaja["Sukunimi"] . "</a>";
                    }
                ?>
            </div>
        </div>
        <div class="Container" onClick="toggledisplayKurssit()">
            <h1 class="Otsikko">Kurssit</h1>
            <img src="./svg/calendar.svg">
            <div id="kurssit">
                <?php
                    $kurssit = $conn->query("SELECT * FROM `kurssit`")->fetchAll();
                    foreach ($kurssit as $kurssi) {
                        echo "<a class='tunnus'>" . $kurssi["Nimi"] . "</a>";
                    }
                ?>
            </div>
        </div>
        <div class="Container" onClick="toggledisplayTilat()">
            <h1 class="Otsikko">Tilat</h1>
            <img src="./svg/room.svg">
            <div id="tilat">
                <?php
                    $tilat = $conn->query("SELECT * FROM `tilat`")->fetchAll();
                    foreach ($tilat as $tila) {
                        echo "<a class='tunnus'>" . $tila["Nimi"] . "</a>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>










<script>

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