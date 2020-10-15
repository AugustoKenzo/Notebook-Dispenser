<!DOCTYPE html>
<html lang="en">
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
        $id = $_SESSION['id'];
        $sql4 = "SELECT turma_usuario FROM usuarios WHERE id = '$id'";
        $sql4 = $pdo->prepare($sql4);
        $sql4->execute();
        $dados = $sql4->fetch();

        $sql = "SELECT D.id , D.dispenser_turma, N.nome, N.id as NID FROM dispenser D JOIN notebook N ON D.id = N.note_dispenser WHERE D.dispenser_turma = :turma_usuario AND N.excluido = 0";
        $sql = $pdo->prepare($sql);
        $sql->bindValue("turma_usuario", $dados['turma_usuario']);
        $sql->execute();
        $dado = $sql->fetchAll();


        if(isset($_POST['problema']) && !empty($_POST['problema'])){
            $id_note = addslashes($_POST['id_note']);
            $problema = addslashes($_POST['problema']);

            $sql = "SELECT * FROM notebook WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id", $id_note);
            $sql->execute();
            $dados = $sql->fetch();

            $sql = "SELECT * FROM dispenser WHERE id = :note_dispenser";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":note_dispenser", $dados['note_dispenser']);
            $sql->execute();
            $dados = $sql->fetch();

            $sql2 = "INSERT INTO problema set ID_Aluno = :id_aluno, ID_Notebook = :id_note, ID_Dispenser = :id_disp, problema = :problema, status = 'Não resolvido';";
            $sql2 = $pdo->prepare($sql2);
            $sql2->bindValue(":id_aluno", $id);
            $sql2->bindValue(":id_note", $id_note);
            $sql2->bindValue(":id_disp", $dados['id']);
            $sql2->bindValue(":problema", $problema);
            $sql2->execute();
            echo "Problema relatado com sucesso :D."."<br>";
            echo "<a href='menu.php'>Voltar para pagina inicial.</a>";
            exit;
        }
    }
?>
</body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Relatar problema</title>
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
    <h1>Relatar problema:</h1>
    <form method="post" onsubmit="return confirm('Deseja mesmo enviar?');">
        Nome do Notebook: <br>
        <select name="id_note" class="form-control">
            <?php
                foreach($dado as $note){
                    ?>
                        <option value="<?php echo $note['NID']?>"><?php echo $note['nome']?></option>
                    <?php
                }
            ?>
        </select> <br> <br>

        Relatar problema: <br>
        <textarea name="problema" class="form-control"></textarea><br>
        
        <div style="text-align: right;">
            <a href="menu.php" class="btn btn-sm btn-primary" role="button">Voltar</a>
            <input type="submit" class="btn btn-sm" id="botao" value="Enviar">
        </div>
    </form>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>