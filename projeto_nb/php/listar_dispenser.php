<!DOCTYPE html>
<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        

    } else{
        header("Location: index.php");
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
    <title>Lista de Notebooks</title>
</head>
<body>
<div class="container" style="margin-top: 40px;">
    <div style="text-align: right;">
        <a class="btn btn-sm btn-primary" role="button" href="menu.php">Voltar</a>
     </div>
    <table class="table" style="margin-top: 40px;">
        <h1>Dispensers Cadastrados</h1>
        <tr>
            <th>ID DISPENSER</th>
            <th>TURMA</th>
            <th>QUANTIDADE NOTES</th>
            <?php if($dado2['nivel'] == 'DB'):?>
            <th colspan=3>AÇÕES</th>
            <?php endif;?>
        </tr>

        <?php
            $sql = "SELECT D.id, D.dispenser_turma, COUNT(N.id) FROM dispenser D 
                    LEFT JOIN notebook N ON D.id = N.note_dispenser GROUP BY D.id";
            $sql = $pdo->prepare($sql);
            $sql->execute();
            $dado = $sql->fetchAll();

            foreach($dado as $d){
                ?>
                <tr>
                    <td><?php echo $d['id']?></td>
                    <td><?php echo $d['dispenser_turma']?></td>
                    <td><?php echo $d['COUNT(N.id)']?></td>
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