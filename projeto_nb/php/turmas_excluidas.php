<!DOCTYPE html>
<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        $sql = "SELECT * FROM turma WHERE excluido=1";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $dado = $sql->fetchAll();
    } else{
        header("Location: login.php");
        exit;
    }

    $id = $_SESSION['id'];
    $sql2 = "SELECT * FROM usuarios WHERE id = :id";
    $sql2 = $pdo->prepare($sql2);
    $sql2->bindValue(":id", $id);
    $sql2->execute();

    $dado2 = $sql2->fetch();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Sua turma</title>
</head>
<body>
<div class="container" style="margin-top: 40px;">
<h1>Lista de Turmas cadastradas</h1>
<a href="turmas_excluidas.php">Turmas excluidas</a>
    <table class="table" style="margin-top: 40px;">
        <tr>
            <th>CODIGO</th>
            <th>TURNO</th>
            <th>CURSO</th>
            <th>PERIODO</th>
            <th>SALA</th>
            <th>ANO</th>
            <?php if($dado2['nivel'] == 'Administrador'):?>
            <th colspan=3>AÇÕES</th>
            <?php endif;?>
        </tr>

        <?php
                foreach($dado as $item){
                ?>
        <tr>
            <th><?php echo $item['id'];?></th>
            <th><?php echo $item['turno'];?></th>
            <th><?php echo $item['curso'];?></th>
            <th><?php echo $item['periodo'];?>º</th>
            <th><?php echo $item['sala'];?></th>
            <th><?php echo $item['ano'];?></th>
            <?php if($dado2['nivel'] == 'Administrador'):?>
            <th><a role="button" class="btn btn-success btn-sm" style="color: white;" href="reativar_turma.php?id=<?php echo $item['id']?>">Re-ativar</a></th>
            <?php endif;?>
        </tr>
        <?php
                }
            ?>
    </table>

    <div style="text-align: right;">
        <a class="btn btn-sm btn-primary" role="button" href="todas_turmas.php">Voltar</a>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>