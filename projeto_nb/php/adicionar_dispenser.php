<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        $id_user = $_SESSION['id'];

        $sql = "SELECT * FROM usuarios WHERE id = :id_user AND nivel = 'Administrador'";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id_user", $id_user);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = "SELECT * FROM turma WHERE status = '0' AND excluido=0";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            $turmas = $sql->fetchAll();
        }else{
            echo "<center><h1>Você não tem permissão</h1></center>";
            echo "<center><a href='menu.php' class='btn btn-sm btn-primary' role='button'>Voltar</a></center>";
            exit;
        }

    } else{
        header("Location: ../index.php");
    }
?>
</body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
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
    <h1>Formulário de Dispenser</h1>
    <form method="post" action="_adicionar_dispenser.php">

        Turma:
        <select name="turma" class="form-control" required>
            <?php
                foreach ($turmas as $turma ) {
                    ?>
                    <option><?php echo $turma['id'];?></option>
                    <?php
                }
            ?>
        </select> <br>

        <div class="form-group">
            Capacidade:<br>
            <input type="number" name="capacidade" min="1" max="60" class="form-control" required>
        </div>

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
