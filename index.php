<?php 
require_once('./AutoLoad.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

$url = explode('/',$req['url']);
$classe = ucfirst($url[0]);   
$metodo = $url[1]; 
$url = array_splice($url, 0, 2);
$parametros = array($url);
parse_str(file_get_contents("php://input"),$post_vars);
            
try { 
    switch ($_SERVER["REQUEST_METHOD"])
    {                       
        case 'GET': 
            call_user_func_array(array(new $classe, $metodo), array($parametros));
        break;
        case 'POST':
        case 'PUT':
        case 'OPTIONS':
            call_user_func_array(array(new $classe, $metodo), array($post_vars));
        break;
        default:       
            header("HTTP/1.0 405 Method Not Allowed");
            echo json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
            die();
        break;  
    }                   
} catch (Exception $e) {
    header("HTTP/1.0 405 Method Not Allowed");
    return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
}	




