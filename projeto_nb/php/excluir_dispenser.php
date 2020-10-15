<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = addslashes($_GET['id']);
               
            $sql = "SET foreign_key_checks = 0";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            $sql = "UPDATE turma SET status = '0', id_dispenser = '' WHERE id_dispenser=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();

            $sql = "UPDATE notebook SET note_dispenser = '0', note_turma = '' WHERE note_dispenser=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();

            $sql = "DELETE FROM dispenser WHERE id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();
        
            $sql = "SET foreign_key_checks = 1";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            header("Location: listar_dispenser.php");
        }
    } else{
        header("Location: ../index.php");
    }
?>
