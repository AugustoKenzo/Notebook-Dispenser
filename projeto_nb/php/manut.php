<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            if(isset($_GET['note']) && !empty($_GET['note'])){
                $id = $_GET['id'];
                $note = $_GET['note'];

                $sql = "SELECT * FROM problema WHERE ID_Problema = :id";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id", $id);
                $sql->execute();

                if($sql->rowCount() > 0){
                    $sql = "UPDATE problema SET status = 'Em manutenção' WHERE ID_Problema = :id";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":id", $id);
                    $sql->execute();

                    $sql = "UPDATE notebook SET status = 'MANUTENÇÃO' WHERE id = :id_note";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":id_note", $note);
                    $sql->execute();

                    header("Location: listar_problemas.php");
                }
            }
        }
    }
?>