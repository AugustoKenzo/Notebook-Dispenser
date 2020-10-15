<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = addslashes($_GET['id']);

            $sql = "SELECT * FROM notebook WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();

            $dado_note = $sql->fetch();

            $sql = "UPDATE notebook SET excluido=0 WHERE id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();

            $sql = "UPDATE dispenser SET quantidade = quantidade + 1 WHERE id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $dado_note['note_dispenser']);
            $sql->execute();

            header("Location: notebooks_excluidos.php");
        }
    } else{
        header("Location: ../index.php");
    }
?>
