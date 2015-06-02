<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function mysqlexecuta($id,$sql,$erro = 1) {
    if(empty($sql) OR !($id))
       return 0; //Erro n
     if (!($res = mysqli_query($id,$sql))) {

      if($erro)
        echo "Ocorreu um erro na execução do Comando SQL no banco de dados. Favor";
      exit;
     }
     return $res;
}