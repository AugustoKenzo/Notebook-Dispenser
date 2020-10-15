<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Relatorio</title>
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

            $sql = "SELECT * FROM problema";
            $sql = $pdo->prepare($sql);
            $sql->execute();

            $dado = $sql->fetchAll();
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
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Relatorio</title>
</head>
<body>
<div class="container" style="margin-top: 40px;">
    <table class="table" style="margin-top: 40px;">
        <h1>Relatorio</h1>

        <tr>
            <th>ID</th>
            <th>Aluno</th>
            <th>Notebook</th>
            <th>Dispenser</th>
            <th>Descrição do Problema</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        <?php
            foreach($dado as $item){
        ?>
        <tr>
            <th><?php echo $item['ID_Problema'];?></th>
            <th><?php echo $item['ID_Aluno'];?></th>
            <th><?php echo $item['ID_Notebook'];?></th>
            <th><?php echo $item['ID_Dispenser'];?></th>
            <th><?php echo $item['problema'];?></th>
            <th><?php echo $item['status'];?></th>
            <?php if($item['status'] != 'Resolvido'){?>
            <th><a role="button" class="btn btn-success btn-sm" style="color: white;" href="resolver.php?id=<?php echo $item['ID_Problema']?>&note=<?php echo $item['ID_Notebook']?>">Resolvido</a>
                <a role="button" class="btn btn-warning btn-sm" style="color: white;" href="manut.php?id=<?php echo $item['ID_Problema']?>&note=<?php echo $item['ID_Notebook']?>">Em manutenção</a>
            </th><?php }?>
        </tr>
            <?php }?>
    </table>
    
    <div style="text-align: right;">
        <a class="btn btn-sm btn-primary" role="button" href="menu.php">Voltar</a>
     </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>