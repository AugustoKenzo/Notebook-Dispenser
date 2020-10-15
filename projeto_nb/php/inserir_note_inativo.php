<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        $sql = "SELECT * FROM notebook WHERE note_dispenser = '' AND note_turma = ''";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $dado1 = '';
        $dado2 = '';

        if($sql->rowCount() == 1){
            $dado1 = $sql->fetch();
        }elseif($sql->rowCount() > 1){
            $dado2 = $sql->fetchAll();
        }

        $sql = "SELECT * FROM dispenser WHERE quantidade < 30";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $dado3 = '';
        $dado4 = '';

        if($sql->rowCount() == 1){
            $dado3 = $sql->fetch();
        }elseif($sql->rowCount() > 1){
            $dado4 = $sql->fetchAll();
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
    <h1>Inserir Notebook Inativo:</h1>
    <form method="post" action="_note_inativo.php">
        
        ID do Notebook: <br>
        <select name="id_note" class="form-control">
            <?php
            if($dado1 == ''){
                foreach($dado2 as $note){
                    ?>
                        <option><?php echo $note['id']?></option>
                    <?php
                }
            }else{
                ?>
                <option><?php echo $dado1['id']?></option>
                <?php
            }
            ?>
        </select> <br> <br>

        ID do Dispenser: <br>
        <select name="id_disp" class="form-control">
            <?php
            if($dado3 == ''){
                foreach($dado4 as $note){
                    ?>
                        <option><?php echo $note['id']?></option>
                    <?php
                }
            }else{
                ?>
                <option><?php echo $dado3['id']?></option>
                <?php
            }
            ?>
        </select> <br> <br>
        
        <div style="text-align: right;">
            <a href="menu.php" class="btn btn-sm btn-primary" role="button">Voltar</a>
            <input type="submit" class="btn btn-sm" id="botao" value="Enviar">
        </div>
    </form>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>