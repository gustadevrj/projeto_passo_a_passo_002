<?php


/*
*********************************************
*********************************************
>>>FORMATACAO DE ROTAS (PADRAO CakePHP)

Formatar URLs na Seguinte Forma:

/controlador/a??o/param1/param2

Onde A??o ? a Fun??o a Ser Chamada Dentro do Controlador.

Exemplo Pratico:

www.ourstore.com/books/list/fantasy

No Formato de URL Cl?ssico Antigo, Seria:

www.ourstore.com/books_controller.php?action=list&category=fantasy
*********************************************
*********************************************
*/


use \Vendor\Page;

use \Vendor\Model\Categoria;

//ROTA RAIZ
$app->get("/", function(){
	echo("<br><b>>>>ROTA RAIZ</b><br><hr>");

	$page = new Page();

	$page->setTpl("index", array(
		"conteudo"=>"", 
		"texto"=>""
	));

	exit;
});

//ROTA PASSANDO PARAMETRO PARA HTML
$app->get("/rota_parametro_html", function(){
	echo("<br><b>>>>ROTA PASSANDO PARAMETRO PARA HTML</b><br><hr>");

	//
	$conteudo = array(
		"001"=>"Bernardo", 
		"002"=>"Gustavo"
	);

	$page = new Page();

	$page->setTpl("index", array(
		"conteudo"=>$conteudo, 
		"texto"=>"Texto Passado para o HTML"
	));

	exit;
});

//ROTA RECEBENDO PARAMETRO VIA QUERYSTRING
$app->get("/rota_parametro_querystring/:name", function($name){
	echo("<br><b>>>>ROTA RECEBENDO PARAMETRO VIA QUERYSTRING</b><br><hr>");

	echo("<br><font color='GREEN'><b> * * * Oi, " . strtoupper($name) . " ! ! !</b></font><br>");

	$page = new Page();

	$page->setTpl("index", array(
		"conteudo"=>"", 
		"texto"=>""
	));

	exit;
});

//ROTA FORMULARIO GET
$app->get("/rota_formulario_post", function(){
	echo("<br><b>>>>ROTA FORMULARIO POST</b><br><hr>");

	if (!isset($_SESSION['msg']) || !$_SESSION['msg'] === '' || !$_SESSION['msg'] === NULL){
		$msg = "";
	}
	else{
		$msg = $_SESSION["msg"];
		$_SESSION["msg"] = NULL;
	}

	$page = new Page();

	$page->setTpl("rota_formulario_post", array(
		"msg"=> $msg
	));

	exit;
});

//ROTA RESPOSTA FORMULARIO POST
$app->post("/rota_resposta_formulario_post", function(){
	echo("<br><b>>>>ROTA RESPOSTA FORMULARIO POST</b><br><hr>");

	//
	if (!isset($_POST['texto']) || $_POST['texto'] === ''){
		$_SESSION["msg"] = "Digite Alguma Coisa!";
		header("Location: /rota_formulario_post");
		exit;
	}
	else{
		$texto = strtoupper($_POST['texto']);
	}

	$page = new Page();

	$page->setTpl("rota_resposta_formulario_post", [
		"texto"=>$texto 
	]);

	exit;
});

//ROTA FORMULARIO GET
$app->get("/rota_formulario_get", function(){
	echo("<br><b>>>>ROTA FORMULARIO GET</b><br><hr>");

	if (!isset($_SESSION['msg']) || !$_SESSION['msg'] === '' || !$_SESSION['msg'] === NULL){
		$msg = "";
	}
	else{
		$msg = $_SESSION["msg"];
		$_SESSION["msg"] = NULL;
	}

	$page = new Page();

	$page->setTpl("rota_formulario_get", array(
		"msg"=> $msg
	));

	exit;
});

//ROTA RESPOSTA FORMULARIO GET
$app->get("/rota_resposta_formulario_get", function(){
	echo("<br><b>>>>ROTA RESPOSTA FORMULARIO GET</b><br><hr>");

	//
	if (!isset($_GET['texto']) || $_GET['texto'] === ''){
		$_SESSION["msg"] = "Digite Alguma Coisa!";
		header("Location: /rota_formulario_get");
		exit;
	}
	else{
		$texto = strtoupper($_GET['texto']);
	}

	$page = new Page();

	$page->setTpl("rota_resposta_formulario_get", [
		"texto"=>$texto 
	]);

	exit;
});


//##############################
//##############################
//CLASSE CATEGORIA
//##############################
//##############################


/*
*********************************************
*********************************************
>>>FORMATACAO DE ROTAS (PADRAO CakePHP)

Formatar URLs na Seguinte Forma:

/controlador/a??o/param1/param2

Onde A??o ? a Fun??o a Ser Chamada Dentro do Controlador.

Exemplo Pratico:

www.ourstore.com/books/list/fantasy

No Formato de URL Cl?ssico Antigo, Seria:

www.ourstore.com/books_controller.php?action=list&category=fantasy
*********************************************
*********************************************
*/


//ROTA CLASSE CATEGORIA CRUD - LISTAGEM - GET
$app->get("/categoria/listagem", function(){
	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - LISTAGEM</b><br><hr>");

	//
	$categorias = Categoria::listAll();

	$page = new Page();

	$page->setTpl("categoria_listagem", array(
		"pesquisa"=>"", 
		"categorias"=>$categorias, 
		"msg_erro"=>Categoria::getMsgErro(), 
		"msg_sucesso"=>Categoria::getMsgSucesso() 
	));

	exit;
});

//ROTA CLASSE CATEGORIA CRUD - PESQUISA - POST
$app->post("/categoria/pesquisa", function(){
	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - PESQUISA</b><br><hr>");

	//
	$pesquisa = (isset($_POST["pesquisa"])) ? $_POST["pesquisa"] : "";

	//
	$categorias = Categoria::pesquisar((string)$pesquisa);

	//PARAMETRO DE PESQUISA VEIO VAZIO
	if ($pesquisa == NULL){
		header("Location: /categoria/listagem");
		exit;
	}

	$page = new Page([
		"header"=>false, 
		"footer"=>false
	]);

	$page->setTpl("categoria_listagem", array(
		"pesquisa"=>$pesquisa, 
		"categorias"=>$categorias, 
		"msg_erro"=>Categoria::getMsgErro(), 
		"msg_sucesso"=>Categoria::getMsgSucesso() 
	));

	exit;
});

//ROTA CLASSE CATEGORIA CRUD - INSERIR - GET
$app->get("/categoria/inserir", function(){
	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - INSERIR</b><br><hr>");

	//
	$categoria = "";
	$descricao = "";

	//VALIDA DADOS DO FORMULARIO/SESSIONS
	if(isset($_SESSION["categoria"]) && isset($_SESSION["descricao"])){
		if((($_SESSION["categoria"] != "") || ($_SESSION["categoria"] != NULL)) || (($_SESSION["descricao"] != "") || ($_SESSION["descricao"] != NULL))){
			$categoria = $_SESSION["categoria"];
			$descricao = $_SESSION["descricao"];

			$_SESSION["categoria"] = NULL;
			$_SESSION["descricao"] = NULL;
		}
	}

	$page = new Page([
		"header"=>false, 
		"footer"=>false
	]);

	$page->setTpl("categoria_inserir", array(
		"msg_erro"=>Categoria::getMsgErro(), 
		"msg_sucesso"=>Categoria::getMsgSucesso(), 
		"categoria"=>$categoria, 
		"descricao"=>$descricao 
	));

	exit;
});

//ROTA CLASSE CATEGORIA CRUD - INSERIR - POST
$app->post("/categoria/inserir", function(){
	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - INSERIR</b><br><hr>");

	//
	//var_dump($_POST);

	//
	$categoria = new Categoria();

	$categoria->setData($_POST);

	$categoria->inserir();

	if(($_SESSION["categoria"] == NULL) || ($_SESSION["descricao"] == NULL)){
		header("Location: /categoria/inserir");
		exit;
	}
	else{
		$_SESSION["categoria"] = NULL;
		$_SESSION["descricao"] = NULL;

		header("Location: /categoria/listagem");
		exit;
	}
});

//ROTA CLASSE CATEGORIA CRUD - ALTERAR - GET
$app->get("/categoria/alterar/:id_categoria", function($id_categoria){
	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - ALTERAR</b><br><hr>");

	//
	$categoria = "";
	$descricao = "";

	//VALIDA DADOS DO FORMULARIO/SESSIONS
	if(isset($_SESSION["categoria"]) && isset($_SESSION["descricao"])){
		if((($_SESSION["categoria"] != "") || ($_SESSION["categoria"] != NULL)) || (($_SESSION["descricao"] != "") || ($_SESSION["descricao"] != NULL))){
			$categoria = $_SESSION["categoria"];
			$descricao = $_SESSION["descricao"];

			$_SESSION["categoria"] = NULL;
			$_SESSION["descricao"] = NULL;
		}
	}

	//
	$categoria = Categoria::pegaCategoriaPorID((int)$id_categoria);

	$page = new Page([
		"header"=>false, 
		"footer"=>false
	]);

	$page->setTpl("categoria_alterar", array( 
		"categoria"=>$categoria->getValues(), 
		"msg_erro"=>Categoria::getMsgErro(), 
		"msg_sucesso"=>Categoria::getMsgSucesso() 
	));

	exit;
});

//ROTA CLASSE CATEGORIA CRUD - ALTERAR - POST
$app->post("/categoria/alterar/:id_categoria", function($id_categoria){
	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - ALTERAR</b><br><hr>");

	//
	$categoria = Categoria::pegaCategoriaPorID((int)$id_categoria);

	$categoria->setData($_POST);

	$categoria->alterar();

	if(($_SESSION["categoria"] == NULL) || ($_SESSION["descricao"] == NULL)){
		header("Location: /categoria/alterar/$id_categoria");
		exit;
	}
	else{
		$_SESSION["categoria"] = NULL;
		$_SESSION["descricao"] = NULL;

		header("Location: /categoria/listagem");
		exit;
	}

	header("Location: /categoria/listagem");

	exit;
});

//ROTA CLASSE CATEGORIA CRUD - EXCLUIR - GET
$app->get("/categoria/excluir/:id_categoria", function($id_categoria){
	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - EXCLUIR</b><br><hr>");

	//
	$categoria = Categoria::excluir((int)$id_categoria);

	header("Location: /categoria/listagem");

	exit;
});

//ROTA CLASSE CATEGORIA CRUD - DETALHE - GET
$app->get("/categoria/detalhe/:id_categoria", function($id_categoria){
	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - DETALHE</b><br><hr>");

	//
	$categoria = Categoria::retornaDados((int)$id_categoria);

	$page = new Page([
		"header"=>false, 
		"footer"=>false
	]);

	$page->setTpl("categoria_detalhe", array(
		"categoria"=>$categoria->getValues(), 
		"pesquisa"=>"", 
		"msg_erro"=>Categoria::getMsgErro(), 
		"msg_sucesso"=>Categoria::getMsgSucesso() 
	));

	exit;
});


//##############################
//##############################
//CLASSE PRODUTO
//##############################
//##############################


/*
*********************************************
*********************************************
>>>FORMATACAO DE ROTAS (PADRAO CakePHP)

Formatar URLs na Seguinte Forma:

/controlador/a??o/param1/param2

Onde A??o ? a Fun??o a Ser Chamada Dentro do Controlador.

Exemplo Pratico:

www.ourstore.com/books/list/fantasy

No Formato de URL Cl?ssico Antigo, Seria:

www.ourstore.com/books_controller.php?action=list&category=fantasy
*********************************************
*********************************************
*/


//ROTA CLASSE PRODUTO CRUD - LISTAGEM - GET
$app->get("/produto/listagem", function(){
	echo("<br><b>>>>ROTA CLASSE PRODUTO - CRUD - LISTAGEM</b><br><hr>");

	//
	//echo("<br><font color='RED'><b>(A FAZER ! ! !)</b></font><br>");

	//
	$msg_erro = "ROTA CLASSE PRODUTO - CRUD - (A FAZER ! ! !)";

	$page = new Page();

	$page->setTpl("index", array(
		"conteudo"=>"", 
		"texto"=>$msg_erro 
	));

	exit;
});


?>