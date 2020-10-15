<?php

try {
    $pdo = new PDO("mysql:dbname=projeto_nb;host=localhost:3307","root","");
} catch (PDOException $e) {
    echo "Falhou: ".$e->getMessage();
}
?>