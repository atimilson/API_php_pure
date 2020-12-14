<?php 
require_once('./conexao/conecta.class.php');


function produtos_get(){
    $stmp = CON::getInstance()->prepare('select * from produto');
    $stmp->execute();
    return $stmp->fetchAll(PDO::FETCH_ASSOC);
}

/*$stmp = CON::getInstance()->prepare('select now()');

$stmp->execute();

while ($a = $stmp->fetch()) {
    # code...
    print_r($a);
}
*/