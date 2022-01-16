<?php
session_start();


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Teste PHP</title>
</head>

<body>

    <div class="container " style="display: flex; justify-content: center; align-items: center; height: 100vh">

        <div class="container">
            <div class="row">
                <?php
                if (isset($_SESSION['nao_autenticado'])) :
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p>Usuário ou senha <strong>inválidos!</strong></p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php
                endif;
                unset($_SESSION['nao_autenticado']);
                ?>
                <form action="logar.php" method="POST" class="login">

                    <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                            <label> E-MAIL</label>
                            <input type="text" name="login" id="login" class="form-control shadow-sm p-3 mb-2 bg-body rounded" placeholder=" E-mail " required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                            <label> SENHA </label>
                            <input autocomplete="off" type="password" name="senha" id="senha" class="form-control shadow-sm p-3 mb-2 bg-body rounded" placeholder="Senha" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class=" mt-2 col-md-6 offset-md-3">
                            <input autocomplete="off" type="submit" value="Login" class="col-12 shadow-sm btn btn-primary bg-gradient" name="" style="display: block; justify-content: center; align-items: center; width: 100%">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class=" mt-2 col-md-6 offset-md-3">
                    <a class="mt-2 col-12 shadow-sm btn btn-primary bg-gradient" type="button" data-bs-toggle="modal" data-bs-target="#cadastromedico">Cadastrar</a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cadastromedico" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Cadastrar novo usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="salvaUsuario.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nome">Qual seu nome?</label>
                                <input autocomplete="off" type="text" required="required" id="nome" name="nome" id="nome" class="form-control" placeholder="nome">
                            </div>

                            <div class="form-group mt-2">
                                <label for="email">Digite seu e-mail</label>
                                <input autocomplete="off" required="required" type="text" id="email" name="email" id="crmModal" class="form-control" placeholder="email">
                            </div>

                            <div class="form-group mt-2">
                                <label for="senha">Digite uma senha</label>
                                <input autocomplete="off" maxlength="8" required="required" type="password" id="senha" name="senha" id="crmModal" class="form-control" placeholder="senha">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnSalvar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" name="inseriruser" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>