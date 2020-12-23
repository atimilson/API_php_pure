<?php

require_once('./model/modelProdutos.php');

class PRODUTO{
    private $model;

    function __construct() {
        $this->model = new Model_produtos();
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
		header("Access-Control-Allow-Headers: Content-Type, Authorization");
    }	

    public function mostrar($parametros){
        $dados =  $this->model->produtos_get($parametros); 
        header('Content-Type: application/json; charset=utf-8');  		
        echo json_encode(array('status' => 'sucesso', 'dados' => $dados));          
    }

    public function inserir($parametros){              
        $dados = $this->model->produto_insert($parametros);     
        header('Content-Type: application/json; charset=utf-8');  	
        echo json_encode(array('status' => 'sucesso', 'dados' => $dados));          
    }

    public function alterar($parametros){
        $dados = $this->model->produto_update($parametros);     
        header('Content-Type: application/json; charset=utf-8');      
        echo json_encode(array('status' => 'sucesso', 'dados' => $dados));
    }

    public function deletar($parametros){
      //  $dados = $this->model->produto_delete($parametros);     
        header('Content-Type: application/json; charset=utf-8');      
        echo json_encode(array('status' => 'sucesso', 'dados' => $dados));
    }
}