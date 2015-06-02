<?php

require_once '../banco/mysqlconecta.php';
require_once '../banco/mysqlexecuta.php';


$sql = "SELECT municipio_nome FROM `municipios` ORDER BY municipio_nome";
$res = \mysqlexecuta($id, $sql, $erro = 1);
echo "<select>";
while($row = mysqli_fetch_array($res)){
    #echo "$row[municipio_nome]<br>";
    echo "<option value=\"\">$row[municipio_nome]</option>";
}
echo "</select>";