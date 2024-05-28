<?php

$localhost = "localhost";
$user = 'root';
$pass = "";
$nomeBanco = 'lighter';

try {
    $pdo = new PDO("mysql:host=$localhost;dbname=$nomeBanco", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    echo 'ERRO: ' . $e->getMessage();
}

?>
