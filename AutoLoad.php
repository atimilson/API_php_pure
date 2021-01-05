<?php
include_once(__DIR__.'/conexao/conecta.class.php');

//Exibir erros
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
//Exibir erros

// AUTO LOAD DE CLASSES ####################
function my_autoload($Class)
{

    $cDir = ['controller','model'];
    $iDir = null;

    foreach ($cDir as $dirName) :
        if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.php') && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.php')) :
            include_once(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.php');
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir) :
        RespostaAndroid('erro', "Não foi possível incluir {$Class}.class.php " . E_USER_ERROR);
        die;
    endif;
}
spl_autoload_register('my_autoload');

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine)
{
    RespostaAndroid('erro', "NUMERO do erro: {$ErrNo} Erro na Linha: #{$ErrLine}  Mensagem: {$ErrMsg} Erro Arquivo: {$ErrFile}");
    die;
}
set_error_handler('PHPErro');


/**
 * Detecta e converte a Array para UTF8<br>
 */
function setArrayToUtf8($array)
{
    array_walk_recursive($array, function (&$item, $key) {
        if (!mb_detect_encoding($item, 'utf-8', true)) {
            $item = utf8_encode($item);
        }
    });
    return $array;
}

/**
 * Retorna um Json em formato UTF8 com a sintaxe Padrão!<br>
 *  <b>{"status":sucesso ou erro,</b>
 *  <b>"resultado":Retorno efetivo com os dados da consulta}</b>
 */
function RespostaAndroid($status, $Data)
{
    header('Content-Type: application/json; charset=utf-8');;
    echo json_encode(setArrayToUtf8(array("status" => $status, "RESULTADO" => $Data)));   
}


function Iif($fvalida, $fverdadeiro, $ffalso)
{
    if ($fvalida) {
        return $fverdadeiro;
    } else {
        return $ffalso;
    }
}

function StrLeft($T, $TAMANHO, $C)
{
    $T = trim($T);
    $TAMANHO = $TAMANHO - strlen($T);
    for ($i = 1; $i <= $TAMANHO; $i++) {
        $T = $C . $T;
    }
    return $T;
}

function StrRight($T, $TAMANHO, $C)
{
    $T = trim($T);
    $TAMANHO = $TAMANHO - strlen($T);
    for ($i = 1; $i <= $TAMANHO; $i++) {
        $T = $T . $C;
    }
    return $T;
}

function SoNumeros($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}

function Mostrar($conteudo, $parar = true)
{
    if (is_null($conteudo)) {
        echo 'Nenhum informação apra mostrar';
    } else {
        echo '<prep>';
        var_dump($conteudo);
        echo '</prep>';
    }
    if ($parar)
        die;
}

function ArredondaValor($valor, $casas = 2)
{
    $casas = (int) StrRight('1', $casas + 1, '0');
    return (floor($valor * $casas) / $casas);
}

function Arredonda($valor, $casas = 2)
{
    return  round($valor, $casas);
}

function CarregaImagem($Endereco = '')
{
    $base64 = '';
    if (file_exists($Endereco)) {
        $type = pathinfo($Endereco, PATHINFO_EXTENSION);
        $data = file_get_contents($Endereco);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
    return $base64;
}

function CarregaPdf($Endereco = '')
{
    $base64 = '';
    if (file_exists($Endereco)) {
        $type = pathinfo($Endereco, PATHINFO_EXTENSION);
        $data = file_get_contents($Endereco);
        $base64 = 'data:application/' . $type . ';base64,' . base64_encode($data);
    }
    return $base64;
}
