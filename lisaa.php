<?php
include 'dbyhteys.php';
session_start();

$formType = $_POST['formType'];

                    //-----------------------Opiskelija----------------------//

if ($formType === "opiskelija")
{
    $Etunimi = $_POST['Etunimi'];
    $Sukunimi = $_POST['Sukunimi'];
    $Syntymäpäivä = $_POST['Syntymäpäivä'];
    $Vuosikurssi = $_POST['Vuosikurssi'];
    
    $sql = "INSERT INTO opiskelijat (Etunimi, Sukunimi, Syntymäpäivä, Vuosikurssi)
            VALUES (:Etunimi, :Sukunimi, :Syntymapaiva, :Vuosikurssi);";    // näissä ei sitten saa olla ääkkösiä
    
    try {
        $query = $conn->prepare($sql);
        $query->execute([
        'Etunimi'=>$Etunimi,
        'Sukunimi'=>$Sukunimi,
        'Syntymapaiva'=>$Syntymäpäivä,
        'Vuosikurssi'=>$Vuosikurssi
        ]);
        var_dump($query);
    
        header('Location: index.php');
    } catch (PDOException $e) {
        die('Virhe: ' . $e->getMessage());
    }
}
                    //-----------------------Opettaja----------------------//

else if ($formType === "opettaja")
{
    $Etunimi = $_POST['Etunimi'];
    $Sukunimi = $_POST['Sukunimi'];
    $Aine = $_POST['Aine'];
    
    $sql = "INSERT INTO opettajat (Etunimi, Sukunimi, Aine)
            VALUES (:Etunimi, :Sukunimi, :Aine);";
    
    try {
        $query = $conn->prepare($sql);
        $query->execute(['Etunimi'=>$Etunimi,
        'Sukunimi'=>$Sukunimi,
        'Aine'=>$Aine
    ]);
    
        header('Location: index.php');
    } catch (PDOException $e) {
        die('Virhe: ' . $e->getMessage());
    }
}
                    //-----------------------Kurssi----------------------//

else if ($formType === "kurssi")
{
    $Nimi = $_POST['Nimi'];
    $Opettaja = $_POST['Opettaja'];
    $Kuvaus = $_POST['Kuvaus'];
    $Tila = $_POST['Tila'];
    $Alkupäivä = $_POST['Alkupäivä'];
    $Loppupäivä = $_POST['Loppupäivä'];
    
    
    $sql = "INSERT INTO kurssit (Nimi, Opettaja, Kuvaus, Tila, Alkupäivä, Loppupäivä)
            VALUES (:Nimi, :Opettaja, :Kuvaus, :Tila, :Alkupaiva, :Loppupaiva);";
    
    try {
        $query = $conn->prepare($sql);
        $query->execute([
        'Nimi'=>$Nimi,
        'Opettaja'=>$Opettaja,
        'Kuvaus'=>$Kuvaus,
        'Tila'=>$Tila,
        'Alkupaiva'=>$Alkupäivä,
        'Loppupaiva'=>$Loppupäivä
    ]);
    
    header('Location: index.php');
    } catch (PDOException $e) {
        die('Virhe: ' . $e->getMessage());
    }
}
                    //-----------------------Tila----------------------//
else if ($formType === "tila")
{
    $Nimi = $_POST['Nimi'];
    $Kapasiteetti = $_POST['Kapasiteetti'];
    
    $sql = "INSERT INTO tilat (Nimi, Kapasiteetti)
            VALUES (:Nimi, :Kapasiteetti);";
    
    try {
        $query = $conn->prepare($sql);
        $query->execute([
        'Nimi'=>$Nimi,
        'Kapasiteetti'=>$Kapasiteetti
    ]);
    
        header('Location: index.php');
    } catch (PDOException $e) {
        die('Virhe: ' . $e->getMessage());
    }
}
?>