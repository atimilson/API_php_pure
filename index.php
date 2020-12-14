<?php 
require_once('./controller/produto.php');

class Rest{
    public static function open($req){
        $url = explode('/',$req['url']);
        $classe = ucfirst($url[0]);       
        array_shift($url);
        $metodo = $url[0];        
        array_shift($url);
        $parametros = array();
        $parametros = $url;
            
        try {
            if (class_exists($classe)) {
                if (method_exists($classe, $metodo)) {
                    $request_method=$_SERVER["REQUEST_METHOD"];
                    
                    switch ($request_method)
                    {                       
                        case 'GET': 
                            $retorno = call_user_func_array(array(new $classe, $metodo), array($parametros));
                        break;
                        case 'POST':
                            parse_str(file_get_contents("php://input"),$post_vars);
                            call_user_func_array(array(new $classe, $metodo), array($post_vars));
                        break;
                        case 'PUT':
                            parse_str(file_get_contents("php://input"),$post_vars);                            
                            call_user_func_array(array(new $classe, $metodo), array($post_vars));
                        break;
                        case 'DELETE':
                            call_user_func_array(array(new $classe, $metodo), array($parametros));
                        break;
                        default:       
                            header("HTTP/1.0 405 Method Not Allowed");
                            echo json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
                            die();
                        break;                               
                        
                    }                   
                } else {
                    return json_encode(array('status' => 'erro', 'dados' => 'Método inexistente!'));
                }
            } else {
                return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
            }
        } catch (Exception $e) {
			return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
		}	
    }
}

if (isset($_REQUEST)) {
    Rest::open($_REQUEST);
}





