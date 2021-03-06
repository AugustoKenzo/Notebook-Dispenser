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

            $dado = $sql->fetch();
            
        }
    } else{
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Editar Notebook</title>
    <style>
        #tamanhoContainer{
            width: 500px;
        }

        #botao{
            background-color: #FF1168;
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="container" style="margin-top: 40px;" id="tamanhoContainer">
    <h1>Formulário de Edição:</h1>
    <form method="post" action="_editar_note.php">
        <input type="text" style="display: none;" name='id' value='<?php echo $dado['id']?>'>
        Nome:<br>
        <input class="form-control" type="text" name="nome" value='<?php echo $dado['nome'];?>'><br>

        <div style="text-align: right;">
            <a href="todos_notes.php" class="btn btn-sm btn-primary" role="button">Voltar</a>
            <input type="submit" class="btn btn-sm" id="botao" value="Enviar">
        </div>
    </form>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>


