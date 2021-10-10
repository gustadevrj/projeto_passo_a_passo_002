<?php

//******************************
//utf8 - utf8mb4
//echo("<br>mb_internal_encoding: " . mb_internal_encoding() . "<br>");

//header('Content-Type: text/html; charset=UTF-8');

// Diz para o PHP que estamos usando strings UTF-8 até o final do script
//mb_internal_encoding('UTF-8');

// Diz para o PHP que nós vamos enviar uma saída UTF-8 para o navegador
//mb_http_output('UTF-8');
//******************************

session_start();

echo("<br><b><a href='http://www.projeto_teste_002.com.br'>www.projeto_teste_002.com.br</a></b><br>");

echo("<br><b><a href='http://localhost/phpmyadmin/index.php' target='_blank'>PHP MyAdmin</a></b><br>");

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//DOCUMENT_ROOT
//$_SERVER["DOCUMENT_ROOT"] = "C:\\xampp\\htdocs\\UDEMY\\projeto_teste_002";

//C:/xampp/htdocs/UDEMY/projeto_teste_001
//$_SERVER["DOCUMENT_ROOT"] = "C:/xampp/htdocs/UDEMY/projeto_teste_002";


//DocumentRoot "C:/xampp/htdocs/UDEMY/projeto_teste_002"
//<Directory "C:/xampp/htdocs/UDEMY/projeto_teste_002">


echo("<br><b>DIRECTORY SEPARATOR: " . DIRECTORY_SEPARATOR . "</b>");
echo("<br><b>DOCUMENT_ROOT:</b> " . $_SERVER["DOCUMENT_ROOT"] . "<br>");
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

//COMPOSER
require_once("vendor/autoload.php");

use \Slim\Slim;

//SLIM
$app = new Slim();

//MODO DEBUG
$app->config("debug", true);

//
require_once("functions.php");


/*
*********************************************
*********************************************
>>>FORMATACAO DE ROTAS (PADRAO CakePHP)

Formatar URLs na Seguinte Forma:

/controlador/ação/param1/param2

Onde Ação é a Função a Ser Chamada Dentro do Controlador.

Exemplo Pratico:

www.ourstore.com/books/list/fantasy

No Formato de URL Clássico Antigo, Seria:

www.ourstore.com/books_controller.php?action=list&category=fantasy
*********************************************
*********************************************
*/


//ROTAS
/*
require_once("site.php");
require_once("admin.php");
require_once("admin-users.php");
require_once("admin-categories.php");
require_once("admin-products.php");
require_once("admin-orders.php");
*/

require_once("site.php");

//EXECUTA
$app->run();

?>