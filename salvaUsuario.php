<?php

if (isset($_POST['inseriruser'])) {

    require 'conexao.php';

    //echo $_SESSION['usuario'];

    $nome = $_POST['nome'];

    $email = $_POST['email'];

    $senha = $_POST['senha'];

    $sql = "INSERT INTO usuario (nome, email, pass) 
    VALUES ('$nome','$email',md5('$senha'));";

    //echo $sql;

    $queryrodou = mysqli_query($strcon, $sql);

    if ($queryrodou) {
        header('Location: index.php');
    } else {
?>
        <script>
            alert('erro ao inserir usuario');
        </script>
<?php
    }
}
?>