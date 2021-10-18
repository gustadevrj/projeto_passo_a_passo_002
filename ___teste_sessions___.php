<?php

session_start();

echo("<br><b>SESSIONS</b><br>");

echo("<br><b>session_id:</b> " . session_id() . "<br>");

echo("<br>");
var_dump($_SESSION);
echo("<br>");

echo("<br><pre>");
print_r($_SESSION);
echo("</pre><br>");


//
echo("<hr>");

echo("<br><b>LIMPA SESSIONS</b><br>");


//
//unset($_SESSION["Categoria_ERRO"]);

//DEPOIS DO DESTROY, PRECISA FAZAR UM RELOAD NA PAGINA
//session_destroy();


echo("<br><b>session_id:</b> " . session_id() . "<br>");

echo("<br>");
var_dump($_SESSION);
echo("<br>");

echo("<br><pre>");
print_r($_SESSION);
echo("</pre><br>");

?>