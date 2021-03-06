<!DOCTYPE html>
<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        $id = $_SESSION['id'];
        $sql2 = "SELECT * FROM usuarios WHERE id = :id";
        $sql2 = $pdo->prepare($sql2);
        $sql2->bindValue(":id", $id);
        $sql2->execute();

        $dado2 = $sql2->fetch();

        $sql = "SELECT D.id, D.dispenser_turma, N.nome, N.id, N.status, N.note_dispenser as ND FROM notebook N JOIN dispenser D ON D.id = N.note_dispenser WHERE D.dispenser_turma = :turma_usuario";
        $sql = $pdo->prepare($sql);
        $sql->bindValue("turma_usuario", $dado2['turma_usuario']);
        $sql->execute();
        $dado = $sql->fetchAll();

    } else{
        header("Location: index.php");
        exit;
    }

    
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Lista de Notebooks</title>
</head>
<body>
<div class="container" style="margin-top: 40px;">
<h1>Lista de Notebooks da Turma</h1>
    <div style="text-align: right;">
        <a class="btn btn-sm btn-primary" role="button" href="menu.php">Voltar</a>
     </div>
     
    <table class="table" style="margin-top: 40px;">
        <tr>
            <th>CÓDIGO</th>
            <th>NOME</th>
            <th>Situação</th>
            <th>Dispenser</th>
            <?php if($dado2['nivel'] == 'Administrador'):?>
            <th colspan=3>AÇÕES</th>
            <?php endif;?>
        </tr>

        <?php
                foreach($dado as $item){
                ?>
        <tr>
            <th><?php echo $item['id'];?></th>
            <th><?php echo $item['nome'];?></th>
            <th><?php echo $item['status'];?></th>
            <th><?php echo $item['ND'];?></th>
            <?php if($dado2['nivel'] == 'Administrador'):?>
            <th><a href="editar_note.php?id=<?php echo $item['id']?>">EDITAR</a></th>
            <?php endif;?>
        </tr>
        <?php
                }
            ?>
    </table>

    
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>