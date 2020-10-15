<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = addslashes($_GET['id']);

            $sql = "UPDATE usuarios SET excluido=0 WHERE id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();

            header("Location: usuarios_excluidos.php");
        }
    } else{
        header("Location: ../index.php");
    }
?>
