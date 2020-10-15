<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimo/Devolução</title>
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
</head>
<body>
<div class="container" style="margin-top: 40px;" id="tamanhoContainer">
<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        $id = $_SESSION['id'];
        $sql4 = "SELECT turma_usuario FROM usuarios WHERE id = '$id'";
        $sql4 = $pdo->prepare($sql4);
        $sql4->execute();
        $dados = $sql4->fetch();


        $sql = "SELECT D.id, D.dispenser_turma, N.nome, N.id as NID FROM dispenser D JOIN notebook N ON D.id = N.note_dispenser WHERE D.dispenser_turma = :turma_usuario AND excluido = 0 AND D.status = 'LIBERADO'";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":turma_usuario", $dados['turma_usuario']);
        $sql->execute();
        $dado = $sql->fetchAll();

        if($sql->rowCount() == 0){
            echo "<center><h1>Dispenser Bloqueada!</h1></center>";
            echo "<br>";
            echo "<center><a href='menu.php' class='btn btn-sm btn-primary' role='button'>Voltar</a></center>";

            exit;
        }


        foreach ($dado as $d) {
            // $sql = "SELECT * FROM notebook WHERE status = 'LIVRE' AND note_turma = :turma_usuario AND excluido = 0";
            // $sql = $pdo->prepare($sql);
            // $sql->bindValue(":turma_usuario", $dados['turma_usuario']);
            // $sql->bindValue(":dispenser_turma", $d['dispenser_turma']);
            // $sql->execute();

            // echo "<pre>";
            // print_r($d['dispenser_turma']);
            // exit();

            // $dado_note = $sql->fetchAll();

            // echo "<pre>";
            // print_r($dado_note);
            // exit();

            $sql = "SELECT *, N.id as NID FROM notebook N
            JOIN dispenser D ON D.id = N.note_dispenser 
            WHERE D.status = 'LIBERADO'
            AND N.status = 'LIVRE'
            AND dispenser_turma = :turma_usuario";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":turma_usuario", $dados['turma_usuario']);
            $sql->execute();

            $dado_note = $sql->fetchAll();

            // echo "<pre>";
            // print_r($dado_note);
            // exit();

            $sql = "SELECT *, F.numero as FN, F.id as FID FROM fonte F
            JOIN dispenser D ON D.id = F.fonte_dispenser 
            WHERE D.status = 'LIBERADO'
            AND F.status = 'LIVRE'
            AND dispenser_turma = :turma_usuario";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":turma_usuario", $dados['turma_usuario']);
            $sql->execute();

            $dado_fonte = $sql->fetchAll();

            // $sql = "SELECT * FROM fonte WHERE status = 'LIVRE' AND fonte_turma = :turma_usuario AND excluido = 0 AND fonte_dispenser = :id_dispenser";
            // $sql = $pdo->prepare($sql);
            // $sql->bindValue(":turma_usuario", $dados['turma_usuario']);
            // $sql->bindValue(":id_dispenser", $d['id']);
            // $sql->execute();
        }
        
        
    } else{
        header("Location: ../index.php");
        exit;
    }

    $id = $_SESSION['id'];
    $sql2 = "SELECT * FROM acoes_aluno WHERE id_usuario = :id AND data_dev = '0000-00-00 00:00:00'";
    $sql2 = $pdo->prepare($sql2);
    $sql2->bindValue(":id", $id);
    $sql2->execute();

    if($sql2->rowCount() > 0){
        $dados2 = $sql2->fetch();

        $sql = "SELECT * FROM notebook WHERE id = :id_notebook";
        $sql = $pdo->prepare($sql);
        $sql->bindValue("id_notebook", $dados2['id_notebook']);
        $sql->execute();

        $notecrook = $sql->fetch();

        $sql = "SELECT * FROM fonte WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue("id", $dados2['fonte']);
        $sql->execute();

        $fonte = $sql->fetch();
        ?>
            <form action="devolucao.php" method="post">
                <h1>Devolução</h1>
                Notebook:
                <select name="note" class="form-control">
                     <option value="<?php echo $notecrook['id']?>">Dispenser <?php echo $notecrook['note_dispenser']?> - <?php echo $notecrook['nome']?></option>
                </select> <br> <br>

                Fonte: 
                <select name="fonte" class="form-control">
                    <option value="<?php echo $dados2['fonte']?>">Dispenser <?php echo $fonte['fonte_dispenser']?> - Fonte <?php echo $fonte['numero']?></option>
                </select> <br> <br>

                <input style='display: none;' type="text" name='id' value='<?php echo $id;?>'>
                <div style="text-align: right;">
                    <a href="menu.php" class="btn btn-sm btn-primary" role="button">Voltar</a>
                    <input type="submit" class="btn btn-sm" id="botao" value="Enviar">
                </div>
                
            </form>
        <?php
    }else{
        ?>
        <form action="emprestimo.php" method="post">
                <h1>Empréstimo</h1>
                Notebook:
                <select name="note" class="form-control">
                    <?php
                        foreach ($dado_note as $note) {
                            ?>
                            <option value="<?php echo $note['NID']?>">Dispenser <?php echo $note['note_dispenser']?>  - <?php echo $note['nome']?></option>
                            <?php
                        }
                    ?>
                     
                </select> <br> <br>

                Fonte: 
                <select name="fonte" class="form-control">
                <?php
                        foreach ($dado_fonte as $fonte) {
                            ?>
                            <option value="<?php echo $fonte['FID']?>">Dispenser <?php echo $fonte['fonte_dispenser']?> - Fonte <?php echo $fonte['FN']?> </option>
                            <?php
                        }
                    ?>
                </select> <br> <br>

                <input style='display: none;' type="text" name='id' value='<?php echo $id;?>'>

                <div style="text-align: right;">
                    <a href="menu.php" class="btn btn-sm btn-primary" role="button">Voltar</a>
                    <input type="submit" class="btn btn-sm" id="botao" value="Enviar">
                </div>
                
            </form>
        <?php
    }
?>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>




