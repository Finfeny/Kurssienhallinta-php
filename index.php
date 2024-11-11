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
            <div id="opiskelijat" style="display: none">
                <?php
                    $opiskelijat = $conn->query("SELECT * FROM `opiskelijat`")->fetchAll();
                    foreach ($opiskelijat as $opiskelija) {
                        echo "<a>" . $opiskelija["Etunimi"] . "</a>";
                    }
                ?>
            </div>
        </div>
        </div>
    </div>
</body>










<script>
    
    function toggledisplayOpiskelijat() {
        if (document.getElementById("opiskelijat").style.display === "none") {
            document.getElementById("opiskelijat").style.display = "block";
        }
        else {
            document.getElementById("opiskelijat").style.display = "none";
        }
    }

    function toggledisplayOpiskelijat() {
        if (document.getElementById("opiskelijat").style.display === "none") {
            document.getElementById("opiskelijat").style.display = "block";
        }
        else {
            document.getElementById("opiskelijat").style.display = "none";
        }
    }

    function toggledisplayOpettajat() {
        if (document.getElementById("opettajat").style.display === "none") {
            document.getElementById("opettajat").style.display = "block";
        }
        else {
            document.getElementById("opettajat").style.display = "none";
        }
    }

    function toggledisplayKurssit() {
        if (document.getElementById("kurssit").style.display === "none") {
            document.getElementById("kurssit").style.display = "block";
        }
        else {
            document.getElementById("kurssit").style.display = "none";
        }
    }

    function toggledisplayTilat() {
        if (document.getElementById("tilat").style.display === "none") {
            document.getElementById("tilat").style.display = "block";
        }
        else {
            document.getElementById("tilat").style.display = "none";
        }
    }
    
    </script>
<!-- <div class="Container" onClick="toggledisplayOpettajat()">
            <h1 class="Otsikko">Opettajat</h1>
            <img src="./svg/person.svg">
            <div id="opettajat" style="display: none">
                <?php
                    $opettajat = $conn->query("SELECT * FROM `opettajat`")->fetchAll();
                    foreach ($opettajat as $opettaja) {
                        echo $opettaja["Etunimi"];
                        ?><br><?php
                    }
                ?>
            </div>
        </div>
        <div class="Container" onClick="toggledisplayKurssit()">
            <h1 class="Otsikko">Kurssit</h1>
            <img src="./svg/calendar.svg">
            <div id="kurssit" style="display: none">
                <?php
                    $kurssit = $conn->query("SELECT * FROM `kurssit`")->fetchAll();
                    foreach ($kurssit as $kurssi) {
                        echo $kurssi["Nimi"];
                        ?><br><?php
                    }
                ?>
            </div>
        </div>
        <div class="Container" onClick="toggledisplayTilat()">
            <h1 class="Otsikko">Tilat</h1>
            <img src="./svg/room.svg">
            <div id="tilat" style="display: none">
                <?php
                    $tilat = $conn->query("SELECT * FROM `tilat`")->fetchAll();
                    foreach ($tilat as $tila) {
                        echo $tila["Nimi"];
                        ?><br><?php
                    }
                ?>
            </div> -->

</html>