<?php

require_once('./model/modelProdutos.php');

class PRODUTO{
    private $model;

    function __construct() {
        $this->model = new Model_produtos();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 1000");
        header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
        header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
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
        $dados = $this->model->produto_delete($parametros);     
        header('Content-Type: application/json; charset=utf-8');      
        echo json_encode(array('status' => 'sucesso', 'dados' => $dados));
    }
}