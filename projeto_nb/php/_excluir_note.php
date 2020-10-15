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

            $sql = "UPDATE notebook SET excluido=1, status = 'EXCLUIDO' WHERE id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();


            header("Location: todos_notes.php");
        }
    } else{
        header("Location: ../index.php");
    }
?>
