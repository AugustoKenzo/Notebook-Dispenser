<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
<?php
    require 'php/conexao/config.php';
    session_start();
    if(isset($_POST['email']) && !empty($_POST['email'])){
        if(isset($_POST['senha']) && !empty($_POST['senha'])){
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

           $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha AND status = 'Ativo' AND excluido=0";
           $sql = $pdo->prepare($sql);
           $sql->bindValue(":email", $email);
           $sql->bindValue(":senha", md5($senha));
           $sql->execute();

           $sql1 = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha AND status = 'Inativo' AND nivel='' AND excluido=0";
           $sql1 = $pdo->prepare($sql1);
           $sql1->bindValue(":email", $email);
           $sql1->bindValue(":senha", md5($senha));
           $sql1->execute();

           if($sql->rowCount() > 0){
               $data = $sql->fetch();
               $_SESSION['id'] = $data['id'];
               header("Location: php/menu.php");
           }else if($sql1->rowCount() > 0){
                $data = $sql->fetch();
                echo 'Conta ainda nao esta aprovada!'."<br>";
                echo "<a href='index.php'>Voltar para login</a>";
                exit;
           }else{
               echo 'Usuário ou senha estão incorretos'."<br>";
               echo "<a href='index.php'>Voltar para login</a>";
               exit;
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
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        #tamanho{
            max-width: 350px;
            -webkit-box-shadow: 10px 10px 22px -4px rgba(209,209,209,1);
            -moz-box-shadow: 10px 10px 22px -4px rgba(209,209,209,1);
            box-shadow: 10px 10px 22px -4px rgba(209,209,209,1);
        }
    </style>
    <title>Tela de Login</title>
</head>
<body>
<div class="container" id="tamanho" style="margin-top: 100px; border-radius: 15px; border: 2px solid #f3f3f3;">
    <div style="padding: 10px;">
        <center>
            <img src="img/cadeado.png" width="125px" height="125px">
        </center>
        <form method="post">
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" autocomplete="off" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" class="form-control" autocomplete="off" placeholder="Senha" required>
            </div>
            <div style="text-align: right;"><button type="submit" class="btn btn-success">Entrar</button></div>
        </form>
    </div>
</div>
<div style="margin-top: 10px;">
    <center>
        <small>Você não possui cadastro? Clique<a href="php/cadastro.php"> aqui</a></small>
    </center>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>