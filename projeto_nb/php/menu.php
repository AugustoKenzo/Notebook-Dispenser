<?php
    session_start();
    require 'conexao/config.php';
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id",$id);
        $sql->execute();

        $dado = $sql->fetch();
        
    } else{
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Menu</title>
    <style>

    .row{
        margin-bottom: 10px;
        margin: 0 auto;
    }

    .title{
      margin-left: -80px;
    }

    @media screen and (max-width: 600px) {
      .nome{
        width: 100%;
        text-align:center;
      }

      .title{
        margin-left: 0;
        width: 100%;
        text-align:center;
        margin-top: -5px;
        margin-bottom: 5px;
      }

      .deslogar{
        width: 100%;
      }
    }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="nome">
    <span class="navbar-brand mb-0 h1">Bem-vindo <?php echo $dado['nome']?></span>
  </div>

  <div class="title">
    <p class="navbar-brand mb-0 h1">NDispenser</p>
  </div><!--title-->
  
  <div class="deslogar">
    <a class="btn btn-danger deslogar" href="logout.php" role="button">Deslogar</a>
  </div>
</nav>

  <br> 

  <div class="container-fluid" id="tamanhoContainer">
    <div class="row">
      <?php if($dado['nivel'] == 'Administrador'){?>
        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Aprovar Usuários</h5>
              <p class="card-text">O administrador pode aprovar usuários não ativos.</p>
              <a href="aprovar_usuario.php" class="btn btn-primary">Aprovar</a>
            </div>
          </div>
        </div>
      <?php }?>

      <?php if($dado['nivel'] == 'Professor'){?>
      <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Desbloquear Dispenser</h5>
              <p class="card-text">Desbloqueie aqui a dispenser da sua sala.</p>
              <a href="desbloquear.php" class="btn btn-primary">Desbloquear</a>
            </div>
          </div>
        </div>
        <?php }?>


        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lista de usuários</h5>
              <p class="card-text">Aqui está a lista de todos os usuários ativos.</p>
              <a href="listar_usuarios.php" class="btn btn-primary">Ver lista</a>
            </div>
          </div>
        </div>

        <?php if($dado['nivel'] == 'Administrador'){?>
        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Adicionar notebooks</h5>
              <p class="card-text">O administrador pode adicionar notebooks.</p>
              <a href="adicionar_notebook.php" class="btn btn-primary">Adicionar notebook</a>
            </div>
          </div>
        </div>
        <?php }?>
        
        <?php if($dado['nivel'] == 'Aluno' || $dado['nivel'] == 'Professor'){?>
        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lista de Notebooks</h5>
              <p class="card-text">Aqui está a lista de todos os notebooks da sua turma.</p>
              <a href="listar_notebook.php" class="btn btn-primary">Ver lista</a>
            </div>
          </div>
        </div>
        <?php }?>
        
        <?php if($dado['nivel'] == 'Aluno'){?>
        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Empréstimo/Devolução</h5>
              <p class="card-text">O aluno pode realizar seus empréstimos/devoluções.</p>
              <a href="emp_dev.php" class="btn btn-primary">Emprestar</a>
            </div>
          </div>
        </div>
        <?php }?>

        <?php if($dado['nivel'] == 'Aluno' || $dado['nivel'] == 'Professor'){?>
        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Sua turma</h5>
              <p class="card-text">Aqui está a turma em qual você está registrado.</p>
              <a href="listar_turmas.php" class="btn btn-primary">Ver turma</a>
            </div>
          </div>
        </div>
        <?php }?>

        <?php if($dado['nivel'] == 'Administrador'){?>
        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cadastrar Dispenser</h5>
              <p class="card-text">O administrador pode cadastrar uma nova dispenser.</p>
              <a href="adicionar_dispenser.php" class="btn btn-primary">Cadastrar</a>
            </div>
          </div>
        </div>
        <?php }?>

        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lista de Dispensers</h5>
              <p class="card-text">Aqui está a lista de todos os dispensers.</p>
              <a href="listar_dispenser.php" class="btn btn-primary">Ver lista</a>
            </div>
          </div>
        </div>
        
        <?php if($dado['nivel'] == 'Administrador'){?>
        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cadastrar Turma</h5>
              <p class="card-text">O administrador pode cadastrar uma nova turma.</p>
              <a href="adicionar_turma.php" class="btn btn-primary">Cadastrar</a>
            </div>
          </div>
        </div>

        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Notebooks Cadastrados</h5>
              <p class="card-text">Lista de todos os notebooks cadastrados no sistema.</p>
              <a href="todos_notes.php" class="btn btn-primary">Ver lista</a>
            </div>
          </div>
        </div>
        <?php }?>
        <?php if($dado['nivel'] == 'Professor' || $dado['nivel'] == 'Administrador'){?>
        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Histórico de Empréstimos</h5>
              <p class="card-text">Lista de emprestimos/devoluções de notebooks.</p>
              <a href="historico.php" class="btn btn-primary">Ver lista</a>
            </div>
          </div>
        </div>
        <?php }?>

        

        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lista de Turmas</h5>
              <p class="card-text">Aqui está a lista de todas as turmas.</p>
              <a href="todas_turmas.php" class="btn btn-primary">Ver lista</a>
            </div>
          </div>
        </div>

        <?php if($dado['nivel'] == 'Administrador'){?>
        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Visualizar problema</h5>
              <p class="card-text">O administrador pode visualizar problemas com notebook.</p>
              <a href="listar_problemas.php" class="btn btn-primary">Ver lista</a>
            </div>
          </div>
        </div>

        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cadastrar Novo Usuario</h5>
              <p class="card-text">O administrador pode cadastrar um novo usuario.</p>
              <a href="cadastrar.php" class="btn btn-primary">Cadastrar</a>
            </div>
          </div>
        </div>
        <?php }?>

        <?php if($dado['nivel'] == 'Aluno'){?>
        <div class="col-sm-6" style="margin-top: 20px;">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Relatar problema</h5>
              <p class="card-text">O aluno pode relatar problema de seus empréstimos/devoluções/notebooks/dispensers.</p>
              <a href="inserir_problema.php" class="btn btn-primary">Reportar</a>
            </div>
          </div>
        </div>
        <?php }?>
      </div><!--row-->
  </div><!--container-->


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>

