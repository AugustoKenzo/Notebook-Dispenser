<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
    

<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_POST['nome']) && !empty($_POST['nome'])){
        if(isset($_POST['email']) && !empty($_POST['email'])){
            if(isset($_POST['senha']) && !empty($_POST['senha'])){
                $nome = addslashes($_POST['nome']);
                $senha = addslashes($_POST['senha']);
                $email = addslashes($_POST['email']);
                $curso = $_POST['curso'];
                $turno = $_POST['turno'];
                $periodo = $_POST['periodo'];

                $sql3 = "SELECT id FROM turma WHERE curso = '$curso' AND turno = '$turno' AND periodo = '$periodo' AND excluido=0";
                $sql3 = $pdo->prepare($sql3);
                $sql3->execute();

                $dado3 = $sql3->fetch();

                if($sql3->rowCount() > 0){
                    $sql = "SELECT * FROM usuarios WHERE email = :email";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":email", $email);
                    $sql->execute();

                    if($sql->rowCount() > 0){
                        echo "Já existe um usúario com esse e-mail"."<br>";
                        echo "<a href='cadastro.php'>Voltar para cadastro</a>";
                        exit;
                    }else{
                        $sql = "INSERT INTO usuarios set nome = :nome, email = :email, senha = :senha, status = 'Inativo', turma_usuario = :turma";
                        $sql = $pdo->prepare($sql);
                        $sql->bindValue(":nome", $nome);
                        $sql->bindValue(":email", $email);
                        $sql->bindValue(":turma", $dado3['id']);
                        $sql->bindValue(":senha", md5($senha));
                        $sql->execute();
                        echo "Cadastro realizado com sucesso! Aguarde aprovação."."<br>";
                        echo "<a href='cadastro.php'>Voltar para cadastro</a>";
                        exit;
                    }
                }else{
                    echo "A turma que você informou não existe"."<br>";
                    echo "<a href='cadastro.php'>Voltar para cadastro</a>";
                    exit;
                }

            }
        }
    }
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        #tamanhoContainer{
            width: 500px;
        }

    </style>
</head>
<body>
<div class="container" style="margin-top: 10px; margin-bottom:20px;" id="tamanhoContainer">
    <h1>Formulário de Cadastro</h1>
    <form method="post" onsubmit="return confirm('Os dados estão corretos?');">
        <div class="form-group">
            Nome:<br>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="form-group">
            E-mail:<br>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            Senha:<br>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <div class="form-group">
            Curso:<br>
            <select name="curso" class="form-control" required>
                <option value="BES">BES</option>
                <option value="BCC">BCC</option>
                <option value="BSI">BSI</option>
            </select>
        </div>

        <div class="form-group">
            Turno:<br>
            <select name="turno" class="form-control" required>
                <option value="Manha">Manhã</option>
                <option value="Tarde">Tarde</option>
                <option value="Noite">Noite</option>
            </select>
        </div>

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
        </div>

        <div style="text-align: right;">
            <a href="../index.php" class="btn btn-sm btn-primary" role="button">Voltar para login</a>
            <input type="submit" class="btn btn-success" value="Enviar">
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
