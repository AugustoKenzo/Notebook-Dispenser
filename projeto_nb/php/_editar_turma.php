<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        if(isset($_POST['id']) && !empty($_POST['id'])){
            if(isset($_POST['sala']) && !empty($_POST['sala'])){
                if(isset($_POST['ano']) && !empty($_POST['ano'])){
                    $id_turma = $_POST['id'];
                    $sala = $_POST['sala'];
                    $curso = $_POST['curso'];
                    $periodo = $_POST['periodo'];
                    $turno = $_POST['turno'];
                    $ano = $_POST['ano'];

                    $sql = "SELECT * FROM turma WHERE sala = :sala AND curso = :curso AND 
                    periodo = :periodo AND ano = :ano AND turno = :turno";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":sala", $sala);
                    $sql->bindValue(":curso", $curso);
                    $sql->bindValue(":periodo", $periodo);
                    $sql->bindValue(":turno", $turno);
                    $sql->bindValue(":ano", $ano);
                    $sql->execute();

                    $dado = $sql->fetch();

                    if($sql->rowCount() > 0 && $dado['id'] != $id_turma){
                        echo 'Não foi possivel realizar essa edição'."<br>";
                        echo 'Já existe uma turma cadastrada com esses dados.'."<br>";
                        echo '<a href="todas_turmas.php">Voltar</a>'."<br>";
                    }else{
                        $sql = "UPDATE turma set sala = :sala, curso = :curso, 
                        periodo = :periodo, ano = :ano, turno = :turno WHERE id = :id_turma";
                        $sql = $pdo->prepare($sql);
                        $sql->bindValue(":sala", $sala);
                        $sql->bindValue(":curso", $curso);
                        $sql->bindValue(":periodo", $periodo);
                        $sql->bindValue(":turno", $turno);
                        $sql->bindValue(":ano", $ano);
                        $sql->bindValue(":id_turma", $id_turma);
                        $sql->execute();
                        header("Location: todas_turmas.php");
                    }
                }
            }
        }
    } else{
        header("Location: ../index.php");
    }
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
