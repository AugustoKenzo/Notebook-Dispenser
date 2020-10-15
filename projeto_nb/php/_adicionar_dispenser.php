<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    

<?php
    session_start();
    require 'conexao/config.php';
    if(isset($_POST['turma']) && isset($_POST['capacidade'])){
        $id = $_POST['turma'];
        $cap = $_POST['capacidade'];

        $sql = "INSERT INTO dispenser SET dispenser_turma = :id, capacidade = :cap";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":cap", $cap);
        $sql->execute();

        echo "<script type='text/javascript'>alert('Dispenser cadastrado com Sucesso!');";
        echo "javascript:window.location='adicionar_dispenser.php';</script>";
    }else{
        header("Location: menu.php");
    }
?>
</body>
</html>