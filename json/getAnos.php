<?php

require_once '../banco/mysqlconecta.php';
require_once '../banco/mysqlexecuta.php';


$muni=$_GET[muni];

$sql = "SELECT YEAR(coleta_data) as ano FROM dados_coletados WHERE coleta_municipio=$muni GROUP BY YEAR(coleta_data) ORDER BY YEAR(coleta_data) ";
$res2 = \mysqlexecuta($id, $sql, $erro = 1);
$j=0;
while($row = mysqli_fetch_array($res2)){
    echo "<option value=\"$row[ano]\">$row[ano]</option>";    
}
