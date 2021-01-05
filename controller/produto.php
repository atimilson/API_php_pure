<?php

class Produto{
    private $model;

    function __construct() {
        $this->model = new ModelProdutos();
    }	

    public function mostrar($parametros){ 	
        RespostaAndroid('sucesso', $this->model->produtos_get($parametros));          
    }

    public function inserir($parametros){              
        RespostaAndroid('sucesso', $this->model->produto_insert($parametros));   
    }

    public function alterar($parametros){
        RespostaAndroid('sucesso', $this->model->produto_update($parametros));     
    }

    public function deletar($parametros){
        RespostaAndroid('sucesso', $this->model->produto_delete($parametros));
    }
}