<?php

require_once('./model/modelProdutos.php');

class PRODUTO{

    public function mostrar(){
       $dados =  produtos_get();        
        header('Content-Type: application/json; charset=utf-8');      
        echo json_encode(array('status' => 'sucesso', 'dados' => $dados));        
    }

    public function inserir($parametros){
        
    }
}