<?php

require_once '../banco/mysqlconecta.php';
require_once '../banco/mysqlexecuta.php';
#$muni=1;
$muni=$_GET['muni'];
$ano=2014;
echo "{";
echo "\n";
echo "\"cols\":[";
echo "{\"id\":\"\",\"label\":\"Dia\",\"pattern\":\"\",\"type\":\"date\"},";
echo "\n";
echo "{\"id\":\"\",\"label\":\"Nivel\",\"pattern\":\"\",\"type\":\"number\"}";
echo "\n";
echo "]";
echo ",";
#linhas
$cons=" AND YEAR(coleta_data)=$ano";
$sql = "SELECT YEAR(coleta_data) ano,MONTH(coleta_data) mes,DAY(coleta_data) dia,coleta_data,coleta_valo FROM dados_coletados WHERE coleta_municipio=$muni $cons ORDER BY coleta_data";
$res2 = \mysqlexecuta($id, $sql, $erro = 1);
$j = 0;
echo "\"rows\": [";
echo "\n";
while ($row = mysqli_fetch_array($res2)) {
    echo "{\"c\":[";
    echo "{\"v\":\"Date($row[ano],$row[mes],$row[dia])\",\"f\":null},";
    #echo "{\"v\":\"$row[coleta_data]\",\"f\":null},";
    echo "{\"v\":$row[coleta_valo],\"f\":null}";
    echo "]},";
    echo "\n";
    #echo "$row[coleta_data] $row[coleta_valo]<br>";
}
echo "]";
echo "}";
