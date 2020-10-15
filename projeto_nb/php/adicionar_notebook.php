<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
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
            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                if(isset($_POST['fonte']) && !empty($_POST['fonte'])){
                    $nome = addslashes($_POST['nome']);
                    $fonte = addslashes($_POST['fonte']);
                    $disp = addslashes($_POST['dispenser']);

                    $sql = "SELECT * FROM notebook N LEFT JOIN fonte F ON N.note_dispenser = F.fonte_dispenser WHERE N.nome = :nome AND N.note_dispenser = :disp AND F.numero = :fonte AND F.fonte_dispenser = :disp";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":nome", $nome);
                    $sql->bindValue(":fonte", $fonte);
                    $sql->bindValue(":disp", $disp);
                    $sql->execute();

                    if($sql->rowCount() > 0){
                        echo "Já existe um notebook cadastrado com esses dados"."<br>";
                        echo "<a href='adicionar_notebook.php'>Voltar</a>";
                        exit;
                    }else{
                        $sql1 = "SELECT * FROM dispenser WHERE id = '$disp'";
                        $sql1 = $pdo->prepare($sql1);
                        $sql1->execute();
                        
                        $dado = $sql1->fetch();

        
                        $sql = "INSERT INTO notebook SET nome = :nome, status = 'LIVRE', note_dispenser = :id_dispenser, note_turma = :turma";
                        $sql = $pdo->prepare($sql);
                        $sql->bindValue(":nome", $nome);
                        $sql->bindValue(":turma", $dado['dispenser_turma']);
                        $sql->bindValue(":id_dispenser", $disp);
                        $sql->execute();

                        $sql = "INSERT INTO fonte SET numero = :numero, fonte_dispenser = :id_dispenser, fonte_turma = :turma";
                        $sql = $pdo->prepare($sql);
                        $sql->bindValue(":numero", $fonte);
                        $sql->bindValue(":turma", $dado['dispenser_turma']);
                        $sql->bindValue(":id_dispenser", $disp);
                        $sql->execute();

                        echo "<script type='text/javascript'>alert('Notebook cadastrado com Sucesso!');";
                        echo "javascript:window.location='adicionar_notebook.php';</script>";
                    }
                }
            }
        }else{
            echo "<center><h1>Você não tem permissão</h1></center>";
            echo "<center><a href='menu.php' class='btn btn-sm btn-primary' role='button'>Voltar</a></center>";
            exit;
        }
    }else{
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
    <h1>Formulário do Notebook</h1>
    <form method="post" onsubmit="return confirm('Os dados estão corretos?');">
        Nome do Produto:<br>
        <input type="text" class="form-control" name="nome" autocomplete=off required><br><br>

        Fonte:<br>
        <input type="number" class="form-control" min='1' name="fonte" required><br><br>

        Dispenser: <br>
        <select name="dispenser" class="form-control" required>
            <?php

                $sql = "SELECT * FROM dispenser";
                $sql = $pdo->prepare($sql);
                $sql->execute();

                $dispenser = $sql->fetchAll();

                foreach($dispenser as $d){
                    $sql = "SELECT * FROM notebook WHERE note_dispenser = :disp AND excluido=0";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":disp", $d['id']);
                    $sql->execute();

                    $note = $sql->rowCount();
                    if($d['capacidade'] > $note){
                        ?>
                            <option><?php echo $d['id']?></option>
                        <?php
                    }
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
