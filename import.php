<?php

$output = '';

if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
    $valid_extension = array('xml');
    $file_data = explode('.', $_FILES['file']['name']);
    $file_extension = end($file_data);
    if (in_array($file_extension, $valid_extension)) {
        try {


            $data = simplexml_load_file($_FILES['file']['tmp_name']);

            $connect = new PDO('mysql:host=localhost;dbname=projeto', 'root', '');

            $query = "INSERT INTO curso(codigo, nome) 
        VALUES (:codigo, :nome) 
        ON DUPLICATE KEY UPDATE nome = :nome, codigo = :codigo;";

            $statement = $connect->prepare($query);

            for ($i = 0; $i < count($data); $i++) {
                $statement->execute(
                    array(
                        ':codigo'   => $data->curso[$i]->codigo,
                        ':nome'  => $data->curso[$i]->nome
                    )
                );
            }

            $result = $statement->fetchAll();

            if (isset($result)) {
                echo '<p id="message" class="text-success"> Sucesso </p>';
            }
        } catch (PDOException $e) {
            echo '<p id="message" class="text-danger"> ' . $e . 'Ocorreu um erro </p>';
        }
    } else {
        echo '<p id="message" class="text-danger"> Selecione um arquivo válido </p>';
    }
} else {
    echo '<p id="message" class="text-danger"> Selecione um arquivo </p>';
}
