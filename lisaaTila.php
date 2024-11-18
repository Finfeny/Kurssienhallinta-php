<?php
include 'dbyhteys.php';
session_start();
$Sukunimi = $_POST['Nimi'];
$Syntymäpäivä = $_POST['Kapasiteetti'];

var_dump($_POST);

$sql = "INSERT INTO tilat (Nimi, Kapasiteetti)
        VALUES (:Nimi, :Kapasiteetti);";

try {
    $query = $conn->prepare($sql);
    $query->execute([
    'Nimi'=>$Nimi,
    'Kapasiteetti'=>$Kapasiteetti
]);

    // header('Location: index.php');
} catch (PDOException $e) {
    die('Virhe: ' . $e->getMessage());
}
?>