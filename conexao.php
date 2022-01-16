<?php

    $servername = "localhost"; /* pode deixar localhost */

    $username = "root"; /* nome do usuario do banco de dados */ 

    $password = ""; /* senha do banco de dados caso exista senao deixa $password = "" */

    $dbname = "projeto"; /* nome do seu banco de dados*/

    $port = "3306"; /* nome do seu banco de dados*/

    // Criando a conexão com o banco de dados

    $strcon = new mysqli($servername, $username, $password, $dbname, $port);
    //$connect = new PDO("mysql:host=localhost;dbname=hnrtco66_fvgweb", $username, $password);

    // Checando a conexão com o banco de dados

    if ($strcon->connect_error) {

        die('Connect Error (' . $strcon->connect_errno . ') ' . $strcon->connect_error);

    } 

?>