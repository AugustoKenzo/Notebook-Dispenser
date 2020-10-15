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
            if(isset($_POST['sala']) && !empty($_POST['sala'])){
                if(isset($_POST['curso']) && !empty($_POST['curso'])){
                    if(isset($_POST['periodo']) && !empty($_POST['periodo'])){
                        $sala = addslashes($_POST['sala']);
                        $curso = addslashes($_POST['curso']);
                        $periodo = addslashes($_POST['periodo']);
                        $turno = addslashes($_POST['turno']);
                        $ano = addslashes($_POST['ano']);

                        $sql1 = "SELECT * FROM turma WHERE turno = :turno AND ano = :ano AND sala = :sala";
                        $sql1 = $pdo->prepare($sql1);
                        $sql1->bindValue(":turno", $turno);
                        $sql1->bindValue(":ano", $ano);
                        $sql1->bindValue(":sala", $sala);
                        $sql1->execute();
                        if($sql1->rowCount() > 0){
                            echo "Já existe uma turma cadastrada com esses dados!"."<br>";
                            echo "<a href='adicionar_turma.php'>Voltar</a>";
                            exit;
                        }else{
                            $sql = "INSERT INTO turma SET sala = :sala, curso = :curso, periodo = :periodo, turno = :turno, ano = :ano";
                            $sql = $pdo->prepare($sql);
                            $sql->bindValue(":sala", $sala);
                            $sql->bindValue(":curso", $curso);
                            $sql->bindValue(":periodo", $periodo);
                            $sql->bindValue(":turno", $turno);
                            $sql->bindValue(":ano", $ano);
                            $sql->execute();
        
                        }
                        echo "<script type='text/javascript'>alert('Turma cadastrada com Sucesso!');";
                        echo "javascript:window.location='adicionar_turma.php';</script>";
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
    <style>
        #tamanhoContainer{
            width: 500px;
        }

        #botao{
            background-color: #FF1168;
            color: #ffffff;
        }
    </style>
    <title>Document</title>
</head>
<body>
<div class="container" style="margin-top: 40px;" id="tamanhoContainer">
    <h1>Formulário de Turma</h1>
    <form method="post" onsubmit="return confirm('Os dados estão corretos?');">
        Sala:<br>
        <input type="number" class="form-control" min='0' name='sala' required> <br>

        Curso:<br>
        <select name="curso" class="form-control" required>
                <option value="BES">BES</option>
                <option value="BCC">BCC</option>
                <option value="BSI">BSI</option>
        </select> <br>

        <div class="form-group">
            Periodo:<br>
            <select name="periodo" class="form-control" required>
                <?php
                    for($n=1;$n<=12;$n++){
                        ?>
                        <option><?php echo $n;?></option>
                        <?php
                    }
                ?>
            </select>
        </div> <br>

        Turno:<br>
        <select name="turno" class="form-control" required>
            <option value="Manha">Manhã</option>
            <option value="Tarde">Tarde</option>
            <option value="Noite">Noite</option>
        </select> <br>

        Ano:<br>
        <input type="number" class="form-control" min='2020' name='ano' required> <br> <br>

        <div style="text-align: right;">
            <a href="menu.php" class="btn btn-sm btn-primary" role="button">Voltar</a>
            <input type="submit" class="btn btn-sm" id="botao" value="Cadastrar Turma">
        </div>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
