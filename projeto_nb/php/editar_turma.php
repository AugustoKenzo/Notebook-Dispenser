<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = addslashes($_GET['id']);

            $sql = "SELECT * FROM turma WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();

            $dado = $sql->fetch();
            
        }
    } else{
        header("Location: ../index.php");
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
    <form method="post" action="_editar_turma.php">
        <input type="text" style="display: none;" name='id' value='<?php echo $dado['id']?>'>
        Sala:<br>
        <input class="form-control" type="number" min='1' name="sala" value='<?php echo $dado['sala'];?>'><br>

        Curso:<br>
        <select name="curso" class="form-control">
                <option value="BES">BES</option>
                <option value="BCC">BCC</option>
                <option value="BSI">BSI</option>
        </select><br>

        Periodo:<br>
        <select name="periodo" class="form-control">
                <?php
                    for($n=1;$n<=12;$n++){
                        ?>
                        <option><?php echo $n;?></option>
                        <?php
                    }
                ?>
        </select> <br>

        Turno:<br>
        <select name="turno" class="form-control">
            <option value="Manha">Manhã</option>
            <option value="Tarde">Tarde</option>
            <option value="Noite">Noite</option>
        </select> <br> 
    
        Ano:<br>
        <input class="form-control" type="number" min='2020' name="ano" value='<?php echo $dado['ano'];?>'><br>

        <div style="text-align: right;">
            <a href="todas_turmas.php" class="btn btn-sm btn-primary" role="button">Voltar</a>
            <input type="submit" class="btn btn-sm" id="botao" value="Enviar">
        </div>
    </form>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>