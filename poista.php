<?php
include 'dbyhteys.php';
session_start();

$formType = $_POST['formType'];

                    //-----------------------Opiskelija----------------------//

if ($formType === "opiskelija")
{
    $Opiskelijanumero = $_POST['Opiskelijanumero'];

    $sql = "DELETE FROM opiskelijat WHERE Opiskelijanumero = :Opiskelijanumero;";

    try {
        $query = $conn->prepare($sql);
        $query->execute([
        'Opiskelijanumero'=>$Opiskelijanumero
        ]);

        header('Location: index.php');
    } catch (PDOException $e) {
        die('Virhe: ' . $e->getMessage());
    }
}

if ($formType === "poistaOpiskelijaKirjautuminen")
{
    var_dump($_POST);
    $Opiskelija = $_POST['Opiskelija'];
    $Kurssi = $_POST['Kurssi'];

    $sql = "DELETE FROM kurssikirjautumiset WHERE Opiskelija = :Opiskelija AND Kurssi = :Kurssi;";

    try {
        $query = $conn->prepare($sql);
        $query->execute([
        'Opiskelija'=>$Opiskelija,
        'Kurssi'=>$Kurssi
        ]);

        header('Location: index.php');
    } catch (PDOException $e) {
        die('Virhe: ' . $e->getMessage());
    }
}

                    //-----------------------Opettaja----------------------//

if ($formType === "opettaja")
{
    $Tunnusnumero = $_POST['Tunnusnumero'];

    $sql = "DELETE FROM opettajat WHERE Tunnusnumero = :Tunnusnumero;";

    try {
        $query = $conn->prepare($sql);
        $query->execute([
        'Tunnusnumero'=>$Tunnusnumero
        ]);

        header('Location: index.php');
    } catch (PDOException $e) {
        die('Virhe: ' . $e->getMessage());
    }
}

                    //-----------------------Kurssi----------------------//

if ($formType === "kurssi")
{
    $Tunnus = $_POST['Tunnus'];

    $sql = "DELETE FROM kurssit WHERE Tunnus = :Tunnus;";

    try {
        $query = $conn->prepare($sql);
        $query->execute([
        'Tunnus'=>$Tunnus
        ]);

        header('Location: index.php');
    } catch (PDOException $e) {
        die('Virhe: ' . $e->getMessage());
    }
}

                    //-----------------------Suoritus----------------------//

if ($formType === "tila")
{
    $Tunnus = $_POST['Tunnus'];

    $sql = "DELETE FROM tilat WHERE Tunnus = :Tunnus;";

    try {
        $query = $conn->prepare($sql);
        $query->execute([
        'Tunnus'=>$Tunnus
        ]);

        header('Location: index.php');
    } catch (PDOException $e) {
        die('Virhe: ' . $e->getMessage());
    }
}