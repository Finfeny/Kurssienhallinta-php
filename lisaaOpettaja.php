<?php
include 'dbyhteys.php';
session_start();
$Etunimi = $_POST['Etunimi'];
$Sukunimi = $_POST['Sukunimi'];
$Aine = $_POST['Aine'];

var_dump($_POST);

$sql = "INSERT INTO opettajat (Etunimi, Sukunimi, Aine)
        VALUES (:Etunimi, :Sukunimi, :Aine);";

try {
    $query = $conn->prepare($sql);
    $query->execute(['Etunimi'=>$Etunimi,
    'Sukunimi'=>$Sukunimi,
    'Aine'=>$Aine
]);

    // header('Location: index.php');
} catch (PDOException $e) {
    die('Virhe: ' . $e->getMessage());
}
?>