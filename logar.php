<?php
session_start();

require 'conexao.php';

if (isset($_POST['login']) || !empty($_POST['login']) || isset($_POST['senha']) || !empty($_POST['senha'])) //Neste caso > 0 é só uma verificação se a chave do usuário é valida
{
    $email = mysqli_real_escape_string($strcon, $_POST['login']);
    $senha = mysqli_real_escape_string($strcon, $_POST['senha']);

    echo $email;
    echo $senha;

    $selecionaId = "SELECT id FROM `usuario` WHERE email = '$email' AND pass = md5('$senha')";

    $resultado = mysqli_query($strcon, $selecionaId);

    $row = mysqli_num_rows($resultado);


    if ($row == 1) {

        $id = mysqli_fetch_array($resultado);
        $int = $id['id'];
        $sql = "UPDATE `usuario` SET `ativo` = '1' WHERE `usuario`.`id` = '$int'";
        mysqli_query($strcon, $sql);

        $ativo = "SELECT ativo FROM `usuario` WHERE id = '$int' AND pass = md5('$senha')";
        $resultadoAtivo = mysqli_query($strcon, $ativo);

        $idAtivo = mysqli_fetch_array($resultadoAtivo);

        $int = $idAtivo['ativo'];

        if ($int == 1) {
            $_SESSION['usuario'] = $email;
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['nao_autenticado'] = true;
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['nao_autenticado'] = true;
        header('Location: login.php');
        exit();
    }
}
