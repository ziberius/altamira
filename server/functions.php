<?php

ini_set("allow_url_fopen", 1);

function moneda($valor) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, "http://indicadoresdeldia.cl/webservice/indicadores.json");
    $result = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($result);
    return $json->indicador->uf;
}
