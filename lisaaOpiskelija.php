<?php
include 'dbyhteys.php';
session_start();
$Etunimi = $_POST['Etunimi'];
$Sukunimi = $_POST['Sukunimi'];
$Syntymäpäivä = $_POST['Syntymäpäivä'];
$Vuosikurssi = $_POST['Vuosikurssi'];

var_dump($_POST);

$sql = "INSERT INTO opiskelijat (Etunimi, Sukunimi, Syntymäpäivä, Vuosikurssi)
        VALUES (:Etunimi, :Sukunimi, :Syntymäpäivä, :Vuosikurssi);";

try {
    $query = $conn->prepare($sql);
    $query->execute(['Etunimi'=>$Etunimi,
    'Sukunimi'=>$Sukunimi,
    'Syntymäpäivä'=>$Syntymäpäivä,
    'Vuosikurssi'=>(int)$Vuosikurssi
]);

    header('Location: index.php');
} catch (PDOException $e) {
    die('Virhe: ' . $e->getMessage());
}
?>