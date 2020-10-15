<?php

    require 'conexao/config.php';

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = addslashes($_GET['id']);
        $status = addslashes($_GET['status']);
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = "UPDATE usuarios SET status = 'Ativo' WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id",$id);
            $sql->execute();

            if($status == 'Administrador'){
                $sql = "UPDATE usuarios SET nivel = 'Administrador' WHERE id = :id";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id",$id);
                $sql->execute();
            }else if($status == 'Professor'){
                $sql = "UPDATE usuarios SET nivel = 'Professor' WHERE id = :id";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id",$id);
                $sql->execute();
            }else if($status == 'Aluno'){
                $sql = "UPDATE usuarios SET nivel = 'Aluno' WHERE id = :id";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id",$id);
                $sql->execute();
            }
        }else{
            header("Location: aprovar.php");
        }
    }else{
        header("Location: aprovar.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprovado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <center>
    <div class="container">
        <h1><?php echo $status?> aprovado com sucesso!</h1> <br>
        <a href="aprovar_usuario.php">Voltar</a>
    </div>
    </center>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>