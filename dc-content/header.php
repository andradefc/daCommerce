<?php
	include "scripts/util_class.php";
	include "funcoes.php";

	$util = new THotUtil; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>daCommerce - Compra Coletiva</title>

	<base href="<?= DC_BASE ?>" />

	<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="dc-content/css/default.css" />

	<script type="text/javascript" src="dc-content/js/jquery.js"></script>
	<script type="text/javascript" src="dc-content/js/funcoes.js"></script>
</head>
<body>

	<div id="wrap">
		<div id="container">
			<div id="header">
				<div class="header_bar">
					<span class="phone">(47) 3525-3333</span>
					<ul>
						<li><a href="" title="">Empresa</a></li>
						<li>|</li>
						<li><a href="" title="">Como funciona</a></li>
						<li>|</li>
						<li><a href="" title="">Como comprar</a></li>
						<li>|</li>
						<li><a href="" title="">Contato</a></li>
					</ul>
					<div class="search">
						<form action="" method="get">
							<input type="text" name="s" value="O que você está procurando? Zend?" />
							<input type="submit" value="" />
						</form>
					</div><!-- .search -->
				</div><!-- .header_bar -->
				<div class="header_body">
					<a href="index" title="daCommerce" class="header_logo">
						<img src="dc-content/imagens/header/logomarca.png" alt="daCommerce" />
					</a>
					<div class="header_right">
						<span>Bom dia, seja bem vindo!</span>
						<ul>
							<li class="login"><a href="" title=""  class="bt_login"><img src="imagens/icones/login.png" alt="Conectar" />Conectar</a>
								<ul>
									<li>
										<h3>Conecte-se!</h3>
										<p>Você precisa estar logado para fazer compras no site!</p>
										<form action="<?= DC_ADMIN ?>dc-login-action" method="post" id="formLogin">
											<input type="hidden" name="redirect" value="<?= DC_BASE ?>" />
											<input type="text" name="username" value="Usuário" />
											<input type="password" name="password" value="Senha" />
											<input type="submit" name="loginForm" value="Conectar" />
										</form>
									</li>
								</ul>
							</li>
							<li><a href="" title=""><img src="imagens/icones/registre-se.png" alt="Registre-se" />Registre-se</a></li>
							<li>
								<div class="carrinho">
									<img src="imagens/icones/carrinho.png" alt="Carrinho de Compras" style="margin:7px 5px 0 0;" />
									Seu carrinho está vazio!
								</div><!-- .carrinho -->
							</li>
						</ul>
					</div><!-- .header_right -->
					<div class="nav">
						<ul id="menu">
							<li><a href="" title=""><img src="imagens/icones/home.png" alt="Home" /></a></li>
							<li><a href="quem-somos" title="">Quem Somos</a></li>
							<li><a href="como-funciona" title="">Como Funciona</a></li>
							<li><a href="como-comprar" title="">Como Comprar</a></li>
							<li><a href="entre-em-contato" title="">Entre em Contato</a></li>
						</ul><!-- ul#menu -->
					</div><!-- .nav -->
				</div><!-- .header_body -->
			</div><!-- #header -->

			<div id="maincolumn">