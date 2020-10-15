<?php
    require 'conexao/config.php';
    if(isset($_POST['nome']) && !empty($_POST['nome'])){
        $id_user = addslashes($_POST['id']);
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $nivel = $_POST['nivel'];
        $turma = $_POST['turma'];

        // $sql = "SET foreign_key_checks = 0";
        // $sql = $pdo->prepare($sql);
        // $sql->execute();

        if($turma == ''){
            $sql = "UPDATE usuarios SET nome = :nome,nivel = :nivel, email = :email, turma_usuario = NULL WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id_user);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":nivel", $nivel);
            $sql->execute();
        }else{
            $sql = "UPDATE usuarios SET nome = :nome,nivel = :nivel, email = :email, turma_usuario = :turma WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id_user);
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":nivel", $nivel);
            $sql->bindValue(":turma", $turma);
            $sql->execute();
        }

        // $sql = "SET foreign_key_checks = 1";
        // $sql = $pdo->prepare($sql);
        // $sql->execute();

        header("Location:listar_usuarios.php");
    }
?>