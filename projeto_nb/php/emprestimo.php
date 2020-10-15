<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_POST['id']) && !empty($_POST['id'])){
        if(isset($_POST['note'])){
            if(isset($_POST['fonte'])){
                $id = $_POST['id'];
                $note = $_POST['note'];
                $fonte = $_POST['fonte'];

                $sql="SELECT * FROM usuarios WHERE id = :id";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id", $id);
                $sql->execute();

                $user = $sql->fetch();

                $sql="SELECT * FROM notebook WHERE id = :id";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id", $note);
                $sql->execute();

                $not = $sql->fetch();
                
                $sql = "INSERT INTO acoes_aluno SET id_usuario = :id_user, nome_usuario = :nome,
                id_dispenser = :dispenser, id_notebook = :id_note,fonte = :fonte, id_turma = :user_turma,
                data_emp = NOW(), data_dev = '0000-00-00 00:00:00'";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id_user", $id);
                $sql->bindValue(":id_note", $note);
                $sql->bindValue(":nome", $user['nome']);
                $sql->bindValue(":user_turma", $user['turma_usuario']);
                $sql->bindValue(":dispenser", $not['note_dispenser']);
                $sql->bindValue(":fonte", $fonte);
                $sql->execute();
               

                $sql = "UPDATE notebook SET status = 'EM USO' WHERE id = :id";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id", $note);
                $sql->execute();

                $sql = "UPDATE fonte SET status = 'EM USO' WHERE id = :id";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id", $fonte);
                $sql->execute();
                header("Location: menu.php");
            }
        }
    }else{
        header("Location: ../index.php");
    }
?>