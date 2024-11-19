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
        <button class="lisääNappi" onClick="lisääOpiskelija()">+</button>
        <button class="poistaNappi" onClick="poistaOpiskelija()">-</button>
        <button class="lisääNappi" onClick="lisääOpettaja()">+</button>
        <button class="poistaNappi" onClick="poistaOpettaja()">-</button>
        <button class="lisääNappi" onClick="lisääKurssi()">+</button>
        <button class="poistaNappi" onClick="poistaKurssi()">-</button>
        <button class="lisääNappi" onClick="lisääTila()">+</button>
        <button class="poistaNappi" onClick="poistaTila()">-</button>
    </div>

                    <!-----------------------Opiskelijat---------------------->

    <div class="content">
        <div class="Container">
            <div id="lisääOpiskelijaContent" style="display: none">
                <form action="lisaa.php" method="POST">
                    <input type="hidden" name="formType" value="opiskelija">
                    <input class="lisaaInput" type="text" name="Etunimi" placeholder="Etunimi">
                    <input class="lisaaInput" type="text" name="Sukunimi" placeholder="Sukunimi">
                    <p class="pieniDesc">Syntymäpäivä</p>
                    <input class="lisaaInput" type="date" name="Syntymäpäivä">
                    <select class="lisaaInput" name="Vuosikurssi"><br>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    <input class="lisaaInputNappi" type="submit" value="Lisää">
                </form>
            </div>
            <div id="poistaOpiskelijaContent" style="display: none">
                <form action="poista.php" method="POST">
                    <input type="hidden" name="formType" value="opiskelija">
                    <select class="lisaaInput" name="Opiskelijanumero">
                        <?php
                            $opiskelijat = $conn->query("SELECT * FROM `opiskelijat`")->fetchAll();
                            foreach ($opiskelijat as $opiskelija) {
                                echo "<option value='" . $opiskelija["Opiskelijanumero"] . "'>" . $opiskelija["Etunimi"] . " " . $opiskelija["Sukunimi"] . "</option>";
                            }
                        ?>
                    </select>
                    <input class="lisaaInputNappi" type="submit" value="Poista">
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
                        <a class='tunnus'>" . 
                        $opiskelija["Opiskelijanumero"] ." ". 
                        $opiskelija["Etunimi"] . "</a>" . 
                        "<a class='Info'>" .
                        $opiskelija["Sukunimi"] . "<br><br> Vuosikurssi ".
                        $opiskelija["Vuosikurssi"] . "<br><br> Syntymäpäivä ".
                        $opiskelija["Syntymäpäivä"];

                        // Napit
                        ?>
                        <p class="pieniDesc">Lisää kirjautuminen</p>
                        <div class="kurssikirjautuminen" style="display: block">
                            <form action="lisaa.php" method="POST">
                                <input type="hidden" name="formType" value="opiskelijanKurssikirjautuminen">
                                <input type="hidden" name="Opiskelija" value="<?php echo $opiskelija["Opiskelijanumero"] ?>">
                                <select class="lisaaInput" name="Kurssi">
                                    <?php
                                        $kurssit = $conn->query("SELECT * FROM `kurssit`")->fetchAll();
                                        foreach ($kurssit as $kurssi) {
                                            echo "<option value='" . $kurssi["Tunnus"] . "'>" . $kurssi["Nimi"] . "</option>";
                                        }
                                    ?>
                                </select>
                                <input class="lisaaInputNappi" type="submit" value="Lisää">
                            </form>
                        </div>
                        <?php
                        
                        echo "<button class='chickenButton' onclick='showChicken(this, \"opiskelija". $opiskelija["Opiskelijanumero"] ."\")'>Näytä kirjautumiset</button><br><br></a>";

                        $sql = "SELECT * FROM `Kurssikirjautumiset` WHERE `Opiskelija` = " . $opiskelija["Opiskelijanumero"];
                        $kirjautumiset = $conn->query($sql)->fetchAll();
                        echo "<div id='opiskelija" . $opiskelija["Opiskelijanumero"] . "' style='display: none;'>";
                        echo "<button class='chickenButton' onclick='hideChicken(this, \"opiskelija". $opiskelija["Opiskelijanumero"] ."\")'>Piilota kirjautumiset</button>";
                        foreach ($kirjautumiset as $kirjautuminen) {
                            $sql = "SELECT * FROM `kurssit` WHERE `Tunnus` = " . $kirjautuminen["Kurssi"];
                            $kurssit = $conn->query($sql)->fetchAll();
                            echo "<a class='pieniDesc'>
                            Nimi: " . $kurssit[0]["Nimi"] . "<br>" .
                            "Aloituspv: " . $kurssit[0]["Alkupäivä"] .
                            "<form action='poista.php' method='POST'>" .
                            "<input type='hidden' name='formType' value='poistaOpiskelijaKirjautuminen'>" .
                            "<input type='hidden' name='Opiskelija' value='" . $kirjautuminen["Opiskelija"] . "'>" .
                            "<input type='hidden' name='Kurssi' value='" . $kirjautuminen["Kurssi"] . "'>" .
                            "<input class='poistaInputNappi' type='submit' value='Poista'>" .
                            "</form><br></a>";
                            }
                        if (count($kirjautumiset) == 0) {
                            echo "<a class='pieniDesc'>Ei kirjautumisia</a>";
                        }
                        echo "</div></div>";
                        
                    }
                ?>
            </div>
        </div>

                        <!-----------------------Opettajat---------------------->
        
        <div class="Container">
            <div id="lisääOpettajaContent" style="display: none">
                <form action="lisaa.php" method="POST">
                    <input type="hidden" name="formType" value="opettaja">
                    <input class="lisaaInput" type="text" name="Etunimi" placeholder="Etunimi">
                    <input class="lisaaInput" type="text" name="Sukunimi" placeholder="Sukunimi">
                    <input class="lisaaInput" type="text" name="Aine" placeholder="Aine">
                    <input class="lisaaInputNappi" type="submit" value="Lisää">
                </form>
            </div>
            <div id="poistaOpettajaContent" style="display: none">
                <form action="poista.php" method="POST">
                    <input type="hidden" name="formType" value="opettaja">
                    <select class="lisaaInput" name="Tunnusnumero">
                        <?php
                            $opettajat = $conn->query("SELECT * FROM `opettajat`")->fetchAll();
                            foreach ($opettajat as $opettaja) {
                                echo "<option value='" . $opettaja["Tunnusnumero"] . "'>" . $opettaja["Etunimi"] . " " . $opettaja["Sukunimi"] . "</option>";
                            }
                        ?>
                    </select>
                    <input class="lisaaInputNappi" type="submit" value="Poista">
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
                    "<a class='Info'>" .
                    $opettaja["Sukunimi"] . "<br><br> Aine ".
                    $opettaja["Aine"];

                    echo "<button class='chickenButton' onclick='showChicken(this, \"opettaja". $opettaja["Tunnusnumero"] ."\")'>Näytä kurrsit</button></a>";

                    $sql = "SELECT * FROM `kurssit` WHERE `Opettaja` = " . $opettaja["Tunnusnumero"];
                    $kurssit = $conn->query($sql)->fetchAll();
                    echo "<div id='opettaja" . $opettaja["Tunnusnumero"] . "' style='display: none;'>";
                    echo "<button class='chickenButton' onclick='hideChicken(this, \"opettaja". $opettaja["Tunnusnumero"] ."\")'>Piilota kurrsit</button>";
                    foreach ($kurssit as $kurssi) {
                        echo "<a class='pieniDesc'>Nimi: " . $kurssi["Nimi"] . "<br>
                        Aloituspv: " . $kurssi["Alkupäivä"];
                        $sql = "SELECT * FROM `tilat` WHERE `Tunnus` = " . $kurssi["Tila"];
                        $tilat = $conn->query($sql)->fetchAll();
                        echo "<br> Tila: " . $tilat[0]["Nimi"] . "</a>";
                    }
                    if (count($kurssit) == 0) {
                        echo "<a class='pieniDesc'>Ei kursseja</a>";
                    }

                    echo "</div></div>";
                }
                ?>
            </div>
        </div>

                        <!-----------------------Kurssit---------------------->

        <div class="Container">
            <div id="lisääKurssiContent" style="display: none">
                <form action="lisaa.php" method="POST">
                    <input type="hidden" name="formType" value="kurssi">
                    <input class="lisaaInput" type="text" name="Nimi" placeholder="Nimi">
                    <input class="lisaaInput" type="text" name="Kuvaus" placeholder="Kuvaus">
                    <select class="lisaaInput" name="Opettaja">
                        <?php
                            $opettajat = $conn->query("SELECT * FROM `opettajat`")->fetchAll();
                            foreach ($opettajat as $opettaja) {
                                echo "<option value='" . $opettaja["Tunnusnumero"] . "'>" . $opettaja["Etunimi"] . " " . $opettaja["Sukunimi"] . "</option>";
                            }
                        ?>
                    </select>
                    <select class="lisaaInput" name="Tila">
                        <?php
                            $tilat = $conn->query("SELECT * FROM `tilat`")->fetchAll();
                            foreach ($tilat as $tila) {
                                echo "<option value='" . $tila["Tunnus"] . "'>" . $tila["Nimi"] . "</option>";
                            }
                        ?>
                    </select>
                    <p class="pieniDesc">Alku ja loppupäivä</p>
                    <input class="lisaaInput" type="date" name="Alkupäivä">
                    <input class="lisaaInput" type="date" name="Loppupäivä">
                    <input class="lisaaInputNappi" type="submit" value="Lisää">
                </form>
            </div>
            <div id="poistaKurssiContent" style="display: none">
                <form action="poista.php" method="POST">
                    <input type="hidden" name="formType" value="kurssi">
                    <select class="lisaaInput" name="Tunnus">
                        <?php
                            $kurssit = $conn->query("SELECT * FROM `kurssit`")->fetchAll();
                            foreach ($kurssit as $kurssi) {
                                echo "<option value='" . $kurssi["Tunnus"] . "'>" . $kurssi["Nimi"] . "</option>";
                            }
                        ?>
                    </select>
                    <input class="lisaaInputNappi" type="submit" value="Poista">
                </form>
            </div>
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
                        echo "<button class='chickenButton' onclick='showChicken(this, \"kurssi". $kurssi["Tunnus"] ."\")'>Näytä kirjautumiset</button></a>";

                        $sql = "SELECT * FROM `Kurssikirjautumiset` WHERE `Kurssi` = " . $kurssi["Tunnus"];
                        $kirjautumiset = $conn->query($sql)->fetchAll();
                        echo "<div id='kurssi" . $kurssi["Tunnus"] . "' style='display: none;'>";
                        echo "<button class='chickenButton' onclick='hideChicken(this, \"kurssi". $kurssi["Tunnus"] ."\")'>Piilota kirjautumiset</button>";
                        foreach ($kirjautumiset as $kirjautuminen) {
                            $sql = "SELECT * FROM `opiskelijat` WHERE `Opiskelijanumero` = " . $kirjautuminen["Opiskelija"];
                            $opiskelijat = $conn->query($sql)->fetchAll();
                            echo "<a>Nimi: " . $opiskelijat[0]["Etunimi"] . "<br>Vuosikurssi: " . $opiskelijat[0]["Vuosikurssi"] . "</a><br>";
                        }
                        echo "</div></div>";
                    }
                ?>
            </div>
        </div>





















                        <!-----------------------Tilat---------------------->

        <div class="Container">
            <div id="lisääTilaContent" style="display: none">
                <form action="lisaa.php" method="POST">
                    <input type="hidden" name="formType" value="tila">
                    <input class="lisaaInput" type="text" name="Nimi" placeholder="Nimi">
                    <input class="lisaaInput" type="text" name="Kapasiteetti" placeholder="Kapasiteetti">
                    <input class="lisaaInputNappi" type="submit" value="Lisää">
                </form>
            </div>
            <div id="poistaTilaContent" style="display: none">
                <form action="poista.php" method="POST">
                    <input type="hidden" name="formType" value="tila">
                    <select class="lisaaInput" name="Tunnus">
                        <?php
                            $tilat = $conn->query("SELECT * FROM `tilat`")->fetchAll();
                            foreach ($tilat as $tila) {
                                echo "<option value='" . $tila["Tunnus"] . "'>" . $tila["Nimi"] . "</option>";
                            }
                        ?>
                    </select>
                    <input class="lisaaInputNappi" type="submit" value="Poista">
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
                        "<a class='Info'> Kapasiteetti " .
                        $tila["Kapasiteetti"] . "<br>" .
                        "<br>Kurssit<br><br>";

                        $sql = "SELECT * FROM `kurssit` WHERE `Tila` = " . $tila["Tunnus"];
                        $kurssit = $conn->query($sql)->fetchAll();
                        
                        foreach ($kurssit as $kurssi) {
                            $sql = "SELECT * FROM `opettajat` WHERE `Tunnusnumero` = " . $kurssi["Opettaja"];
                            $opettaja = $conn->query($sql)->fetch();

                            echo $kurssi["Nimi"] . "<br>" .
                            $opettaja["Etunimi"] . "<br>" .
                            $kurssi["Alkupäivä"] . " " . $kurssi["Loppupäivä"] . "<br><br>";
                        }
                        if (count($kurssit) == 0) {
                            echo "Ei kursseja";
                        }
                        echo "</a></div>";
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

    function lisääKurssi() {
        var show = document.getElementById("lisääKurssiContent").style.display;
        if (show == "block") {
            document.getElementById("lisääKurssiContent").style.display = "none";
        } else {
            document.getElementById("lisääKurssiContent").style.display = "block";
        }
    }

    function lisääTila() {
        var show = document.getElementById("lisääTilaContent").style.display;
        if (show == "block") {
            document.getElementById("lisääTilaContent").style.display = "none";
        } else {
            document.getElementById("lisääTilaContent").style.display = "block";
        }
    }

    //                            ------------Poista napit--------------

    function poistaOpiskelija() {
        var show = document.getElementById("poistaOpiskelijaContent").style.display;
        if (show == "block") {
            document.getElementById("poistaOpiskelijaContent").style.display = "none";
        } else {
            document.getElementById("poistaOpiskelijaContent").style.display = "block";
        }
    }

    function poistaOpettaja() {
        var show = document.getElementById("poistaOpettajaContent").style.display;
        if (show == "block") {
            document.getElementById("poistaOpettajaContent").style.display = "none";
        } else {
            document.getElementById("poistaOpettajaContent").style.display = "block";
        }
    }

    function poistaKurssi() {
        var show = document.getElementById("poistaKurssiContent").style.display;
        if (show == "block") {
            document.getElementById("poistaKurssiContent").style.display = "none";
        } else {
            document.getElementById("poistaKurssiContent").style.display = "block";
        }
    }

    function poistaTila() {
        var show = document.getElementById("poistaTilaContent").style.display;
        if (show == "block") {
            document.getElementById("poistaTilaContent").style.display = "none";
        } else {
            document.getElementById("poistaTilaContent").style.display = "block";
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