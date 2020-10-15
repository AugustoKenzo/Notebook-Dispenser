
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/theo.css">
    <script scr="https://code.jquery.com/jquery-3.5.1.js"></script>
    <title>Menu</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <a class="btn btn-danger" role="button" href="logout.php">Loggout</a>
    </form>
  </div>
</nav>

<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-sm-6" style="margin-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Notebook</h5>
                    <p class="card-text">Opção para adicionar notebooks em nosso estoque</p>
                    <a href="adicionar_produto.php" class="btn btn-primary">Cadastrar notebook</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6" style="margin-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista de Notebooks</h5>
                    <p class="card-text">Vizualizar, editar e excluir os notebooks</p>
                    <a href="listar_produtos.php" class="btn btn-primary">Notebooks</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6" style="margin-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista de Usuário</h5>
                    <p class="card-text">Vizualizar, editar e excluir usuários</p>
                    <a href="listar_usuario.php" class="btn btn-primary">Usuários</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6" style="margin-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Relatar um Problema</h5>
                    <p class="card-text">Indica notebooks com problema e descreve</p>
                    <button class="btn btn-primary" id="myBtn">Relatar</button>
                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2>Relatar</h2>
                            </div>
                            <form action="_inserir_relatorio.php" method="post">
                                <div class="modal-body">
                                    <table border="0">
                                        <tr>
                                            <td>Nr Dispenser: </td>
                                            <td><input class='inputTable' type="text" name="nrDispenser" required autocomplete="off" placeholder="Numero Dispenser"></td>
                                        </tr>
                                        <tr>
                                            <td>Nr Notebook: </td>
                                            <td><input class='inputTable' type="text" name="nrNotebook" required autocomplete="off" placeholder="Numero Notebook"></td>
                                        </tr>
                                        <tr>
                                            <td>Descrição: </td>
                                            <td ><textarea type="text" name="problema" required autocomplete="off" placeholder="Problema"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td align='right'><span class="close"><button class="btn btn-primary" type="submit" href="menu.php">Enviar</button></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--modal-->
                </div>
            </div>
        </div>

        <div class="col-sm-6" style="margin-top: 20px;">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Devolver Notebook</h5>
                <p class="card-text">Clique aqui para devolver um Notebook emprestado</p>
                <a href="adicionar_notebookDevolvido.php" class="btn btn-primary">Devolver Notebook</a>
            </div>
            </div>
        </div>


        <div class="col-sm-6" style="margin-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Usuários</h5>
                    <p class="card-text">Permite realizar o cadastro de novos usuários</p>
                    <a href="cadastro_usuario.php" class="btn btn-primary">Cadastrar Usuário</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6" style="margin-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Aprovar Usuários</h5>
                    <p class="card-text">Aprovar usuários cadastrados.</p>
                    <a href="aprovar_usuario.php" class="btn btn-primary">Aprovar Usuários</a>
                </div>
            </div>
        </div>

        <div class="col-sm-6" style="margin-top: 20px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Visualizar relatorios</h5>
                    <p class="card-text">Ve os problemas que professores/alunos identificaram</p>
                    <button class="btn btn-primary" id="myBtn2">Listar</button>
                    <!-- The Modal -->
                    <div id="myModal2" class="modal2">
                        <!-- Modal content -->
                        <div class="modal-content2">
                            <div class="modal-header">
                                <h2>Relatorios</h2>
                            </div>
                            <div class="container" style="margin-top: 40px;">
                            <h3>Listar Relatorio</h3>
                            <br>

                                <div style="text-align: right;">
                                    <a class="btn btn-sm btn-primary" role="button" href="menu.php">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- The Modal -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="js/theo.js"></script>

</body>
</html>
