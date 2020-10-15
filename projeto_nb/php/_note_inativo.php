<?php
    session_start();
    require 'conexao/config.php';
    if(isset($_POST['id_note'])){
        if(isset($_POST['id_disp'])){
            $id_note = $_POST['id_note'];
            $id_disp = $_POST['id_disp'];

            $sql = "SELECT * FROM dispenser WHERE id = :id_disp";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_disp", $id_disp);
            $sql->execute();

            $dispenser = $sql->fetch();

            $sql = "SET foreign_key_checks = 0";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            $sql = "UPDATE notebook SET note_dispenser = :id_disp, note_turma = :id_turma WHERE id = :id_note";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_disp", $id_disp);
            $sql->bindValue(":id_turma", $dispenser['dispenser_turma']);
            $sql->bindValue(":id_note", $id_note);
            $sql->execute();

            $sql = "UPDATE dispenser SET quantidade = quantidade + 1 WHERE id = :id_disp";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_disp", $id_disp);
            $sql->execute();

            $sql = "SET foreign_key_checks = 1";
            $sql = $pdo->prepare($sql);
            $sql->execute();
            header("Location: inserir_note_inativo.php");
        }
    }else{
        header("Location: menu.php");
    }
?>