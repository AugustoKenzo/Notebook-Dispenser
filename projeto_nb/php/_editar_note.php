<?php
    require 'conexao/config.php';
    if(isset($_POST['nome']) && !empty($_POST['nome'])){
        if(isset($_POST['fonte']) && !empty($_POST['fonte'])){
            $id_user = addslashes($_POST['id']);
            $nome = addslashes($_POST['nome']);

            $sql = "UPDATE notebook SET nome = :nome WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id_user);
            $sql->bindValue(":nome", $nome);
            $sql->execute();

            header("Location:todos_notes.php");
        }
    }
?>
