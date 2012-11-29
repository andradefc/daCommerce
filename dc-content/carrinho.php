<?php 

if(isset($_POST["addCarrinho"])){
	$_SESSION["carrinho"][$_POST["id"]] = $_POST["qtd"];
}

if($url[1] == "remove"){
	unset($_SESSION["carrinho"][$url[2]]);
}

if($url[1] == "limpar"){
	unset($_SESSION["carrinho"]);
}

header("Location: ".DC_BASE."carrinho-de-compra");

?>