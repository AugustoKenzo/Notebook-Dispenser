<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_POST['id']) && !empty($_POST['id'])){
        if(isset($_POST['note'])){
            if(isset($_POST['fonte'])){
                $id = $_POST['id'];
                $note = $_POST['note'];
                $fonte = $_POST['fonte'];

                $sql = "UPDATE acoes_aluno set data_dev = NOW() WHERE id_usuario = '$id'";
                $sql = $pdo->prepare($sql);
                $sql->execute();

                $sql = "UPDATE notebook SET status = 'LIVRE' WHERE id = :id_note";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id_note", $note);
                $sql->execute();

                $sql = "UPDATE fonte SET status = 'LIVRE' WHERE id = :id";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id", $fonte);
                $sql->execute();
                header("Location:menu.php");
            }
        }
    }else{
        header("Location: login.php");
    }
?>