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

        $sql = "SELECT * FROM acoes_aluno";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $dado = $sql->fetchAll();

        $sql = "SELECT * FROM acoes_aluno WHERE id_turma = :id_turma";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id_turma", $dado2['turma_usuario']);
        $sql->execute();

        $dado3 = $sql->fetchAll();
    } else{
        header("Location: login.php");
        exit;
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Histórico</title>
</head>
<body>
<div class="container" style="margin-top: 40px;">
    <h1>Histórico de Empréstimos/Devoluções</h1>
    <table class='table' style="margin-top: 40px;">
        <tr>
            <th>ID USUARIO</th>
            <th>NOME USUARIO</th>
            <th>ID NOTEBOOK</th>
            <th>ID DISPENSER</th>
            <th>FONTE</th>
            <th>EMPRÉSTIMO</th>
            <th>DEVOLUÇÃO</th>
        </tr>

        <?php
            if($dado2['nivel'] == 'Administrador'){
                foreach($dado as $item){

                    
                ?>
        <tr>
            <th><?php echo $item['id_usuario'];?></th>
            <th><?php echo $item['nome_usuario'];?></th>
            <th><?php echo $item['id_notebook'];?></th>
            <th><?php echo $item['id_dispenser'];?></th>
            <th>ID: <?php echo $item['fonte'];?></th>
            <th><?php echo $item['data_emp'];?></th>

            <?php if($item['data_dev'] == '0000-00-00 00:00:00'):?>

            <th>Não devolvido</th>

            <?php else:?>

                <th><?php echo $item['data_dev'];?></th>
                
            <?php endif;?>
        </tr>
        <?php
                }
            }
            else{
                foreach($dado3 as $item){
                    ?>
                        <tr>
                            <th><?php echo $item['id_usuario'];?></th>
                            <th><?php echo $item['nome_usuario'];?></th>
                            <th><?php echo $item['id_notebook'];?></th>
                            <th><?php echo $item['id_dispenser'];?></th>
                            <th>ID: <?php echo $item['fonte'];?></th>
                            <th><?php echo $item['data_emp'];?></th>
                            <?php if($item['data_dev'] == '0000-00-00 00:00:00'):?>
                            <th>Não devolvido</th>
                            <?php else:?>
                                <th><?php echo $item['data_dev'];?></th>
                            <?php endif;?>
                        </tr>
                    <?php
                }
            }
            ?>
        <div style="text-align: right;">
                <a class="btn btn-sm btn-primary" role="button" href="menu.php">Voltar</a>
        </div>
    </table>

    <br>
    
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>