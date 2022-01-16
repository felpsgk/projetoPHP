
<?php

if (isset($_GET['atualizar'])) {
    $cep = $_GET['atualizar'];
    $url = "viacep.com.br/ws/" . $cep . "/json";
    //echo $url;
    $ch = curl_init($url);
    
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    
    $result = json_decode(curl_exec($ch));
    
    //var_dump($result);
    
    $local = array(
        $result->logradouro,
        $result->bairro,
        $result->localidade,
        $result->uf,
       $result->complemento,
    );

    echo json_encode($local);
}


?>