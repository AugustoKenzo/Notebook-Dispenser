<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id_disp = $_GET['id'];

            $sql = "SELECT * FROM dispenser WHERE id = :id_disp";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_disp", $id_disp);
            $sql->execute();

            if($sql->rowCount() > 0){
                $sql = "UPDATE dispenser set status = 'BLOQUEADO' WHERE id = :id_disp";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id_disp", $id_disp);
                $sql->execute();
                
                header("Location: desbloquear.php");
            }else{
                header("Location: desbloquear.php");
            }
        }
    }