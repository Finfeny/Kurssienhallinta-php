<?php
    $host="localhost"
    $user="root"
    $password=""
    $db="kurssienhallinta"

    $conn = new mysqli($host, $user, $password);
    var_dump($conn)
?>

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
        <div class="Container" onClick="toggledisplay()">
        <!-- <div class="Container" id="opiskelijat" onClick="document.getElementById('opiskelijat').innerHTML = 'HElp'"> -->
        <h1 class="Otsikko">Opiskelijat</h1>
            <img src="./svg/school.svg">
            <div id="opiskelijat" style="display: none">
                <?php  ?>
            </div>
        </div>
        <!-- <div class="Container">
            <h1 class="Otsikko">Opettajat</h1>
            <img src="./svg/person.svg">
        </div>
        <div class="Container">
            <h1 class="Otsikko">Kurssit</h1>
            <img src="./svg/calendar.svg">
        </div>
        <div class="Container">
            <h1 class="Otsikko">Tilat</h1>
            <img src="./svg/room.svg">
        </div> -->
    </div>
</body>

<script>

    function toggledisplay() {
        if (document.getElementById("opiskelijat").style.display === "none") {
            document.getElementById("opiskelijat").style.display = "block";
        }
        else {
            document.getElementById("opiskelijat").style.display = "none";
        }
    }

</script>

</html>