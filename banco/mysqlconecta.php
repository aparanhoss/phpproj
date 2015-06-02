<?php

$dbname = "cotas_rios"; // Indique o nome do banco de dados que
$usuario = "cordec"; // Indique o nome do usuário que tem
$password = "sudam";
/*
  if(!($id = mysql_connect("localhost",$usuario,$password))){
  echo "Não Foi Possivel estabelecer conexao";
  exit;
  }
  if(!($con=mysql_select_db($dbname,$id))) {
  echo "Não foi possível estabelecer uma conexão com o gerenciador MySQL. Favor Contactar o Administrador";
  exit;
  }

 */

if (!($id = mysqli_connect('localhost', $usuario, $password, $dbname))) {
    echo "Não Foi Possivel estabelecer conexao";
    exit;
}

mysqli_query($id, 'CREATE TEMPORARY TABLE `table`');
mysqli_query($id, 'SET character_set_results=utf8');
