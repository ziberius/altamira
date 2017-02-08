<?php

ini_set("allow_url_fopen", 1);

function moneda($valor) {
//	$url = "http://indicadoresdeldia.cl/";
//	$palabra = "$valor";
//	$x = 1;
//	$fd = @fopen($url, "r");
//	
//	while ($line=@fgets($fd,1000)){
//		$pos = strpos ($line, $palabra);
//		if ($pos){
//			$glosa = " ";
//			$line2=fgets($fd,1000);
//			$valor_actual = strip_tags($glosa.trim($line2));
//		}
//	}
//	@fclose ($fd);
//	return $valor_actual;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, "http://indicadoresdeldia.cl/webservice/indicadores.json");
    $result = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($result);
    return $json->indicador->uf;
}
