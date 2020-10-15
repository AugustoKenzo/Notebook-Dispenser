<!DOCTYPE html>
<html lang="pt-br">
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
            $sql = "SELECT * FROM turma";
            $sql = $pdo->prepare($sql);
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $turmas = $sql->fetchAll();
            }
    
            if(isset($_POST['nome']) && !empty($_POST['nome'])){
                if(isset($_POST['email']) && !empty($_POST['email'])){
                    if(isset($_POST['senha']) && !empty($_POST['senha'])){
                        $nome = addslashes($_POST['nome']);
                        $email = addslashes($_POST['email']);
                        $senha = addslashes($_POST['senha']);
                        $turma = addslashes($_POST['turma']);
                        $nivel = addslashes($_POST['nivel']);
    
                        $sql = "SELECT * FROM usuarios WHERE email = :email";
                        $sql = $pdo->prepare($sql);
                        $sql->bindValue(":email", $email);
                        $sql->execute();
    
                        if($sql->rowCount() > 0){
                            echo "Já existe usuário cadastrado com esse e-mail."."<br>";
                            echo "<a href='cadastrar.php'>Voltar</a>";
                            exit;
                        }else{
    
                            if($turma == ''){
                                $sql = "INSERT INTO usuarios set nome = :nome , email = :email , senha = :senha ,
                                    status = 'Ativo', turma_usuario = NULL , nivel = :nivel";
                                $sql = $pdo->prepare($sql);
                                $sql->bindValue(":nome", $nome);
                                $sql->bindValue(":email", $email);
                                $sql->bindValue(":senha", md5($senha));
                                $sql->bindValue(":nivel", $nivel);
                                $sql->execute();
                            }else{
                                $sql = "INSERT INTO usuarios set nome = :nome , email = :email , senha = :senha ,
                                    status = 'Ativo', turma_usuario = :turma , nivel = :nivel";
                                $sql = $pdo->prepare($sql);
                                $sql->bindValue(":nome", $nome);
                                $sql->bindValue(":email", $email);
                                $sql->bindValue(":senha", md5($senha));
                                $sql->bindValue(":turma", $turma);
                                $sql->bindValue(":nivel", $nivel);
                                $sql->execute();
    
                            }
                            
                            echo "<script type='text/javascript'>alert('Cadastro realizado com Sucesso!');";
                            echo "javascript:window.location='cadastrar.php';</script>";
                            exit;
                        }
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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Cadastro</title>
    <style>
        #tamanhoContainer{
            width: 500px;
            margin-top: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container" id="tamanhoContainer">
        <h1>Cadastrar Usuário</h1>
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

                Nivel:<br>
            <select name="nivel" class="form-control">
                <option value="Administrador">Administrador</option>
                <option value="Professor">Professor</option>
                <option value="Aluno">Aluno</option>
            </select> <br>

            <div class="form-group">
            Turma:<br>
            <select name="turma" class="form-control">
            <option value="">Sem turma</option>
                <?php
                    foreach($turmas as $turma){
                    ?>
                     <option><?php echo $turma['id'];?></option>
                <?php }?>
            </select>
            </div>

            <div style="text-align: right;">
                <a href="menu.php" class="btn btn-sm btn-primary" role="button">Voltar para Menu</a>
                <input type="submit" class="btn btn-success" value="Enviar">
            </div>
        </form>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>    
</body>
</html>