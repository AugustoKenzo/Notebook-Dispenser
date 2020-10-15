<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Desbloquear</title>
</head>

<body>
<?php
    require 'conexao/config.php';
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id_disp = $_GET['id'];

            $sql = "SELECT * FROM notebook WHERE note_dispenser = :id_disp AND status = 'EM USO'";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":id_disp", $id_disp);
            $sql->execute();

            if($sql->rowCount() > 0){

                $sql = "SELECT * FROM acoes_aluno WHERE id_dispenser = :id_disp AND data_dev = '0000-00-00 00:00:00'";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id_disp", $id_disp);
                $sql->execute();

                $dados = $sql->fetchAll();

                echo "<center><h1 style='margin-top: 50px;'>Ainda há notebooks faltando</h1><center>";
                echo "<a role='button' style='margin-top: 20px; font-size: 16px;' class='btn btn-success btn-sm' style='color: white;' href='bloquear2.php?id=$id_disp'>Confirmar</a>  ";
                echo "<a role='button' style='margin-top: 20px; font-size: 16px;' class='btn btn-primary btn-sm' style='color: white;' href='desbloquear.php'>Voltar </a>";

                echo "<table class='table container' style='margin-top: 40px; max-width: 600px;'>";
                    echo "<tr>";
                        echo "<th> Nome Aluno </th>";
                        echo "<th> Notebook </th>";
                    echo "</tr>";


                foreach($dados as $d){    
                        echo "<tr>";
                            echo "<td>";
                            echo $d['nome_usuario'];
                            echo "</td>";

                            echo "<td>ID: ";
                            echo $d['id_notebook'];
                            echo "</td>";
                        echo "</tr>";
                }
                echo "</table>";
            
            }else{
                $sql = "SELECT * FROM dispenser WHERE id = :id_disp";
                $sql = $pdo->prepare($sql);
                $sql->bindValue(":id_disp", $id_disp);
                $sql->execute();

                if($sql->rowCount() > 0){
                    $sql = "UPDATE dispenser set status = 'BLOQUEADO' WHERE id = :id_disp";
                    $sql = $pdo->prepare($sql);
                    $sql->bindValue(":id_disp", $id_disp);
                    $sql->execute();
                    
                    header("Location: desbloquear.php");
                }else{
                    header("Location: desbloquear.php");
                }
            }

            
        }else{
            header("Location: desbloquear.php");
        }
    }else{
        header("Location: ../index.php");
    }
?>
</body>