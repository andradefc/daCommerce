<?php $dc_site->get_header(); ?>				
<h1>Registre-se</h1>
<?php
if(isset($_POST["registrar"])){
	$username = $_POST["nome"];
	$email    = $_POST["email"];
	$password = md5($_POST["senha"]);
	$idade    = $_POST["idade"];

	if(!$em->getRepository('Entities\User')->findOneBy(array('user_email' => $email))) {

		$user = new \Entities\User($username, $email, $password, 3, $idade);
		$em->persist($user);

		if($user){
			echo '<div class="sucesso">Cadastrado com sucesso!</div>';
		}else{
			echo '<div class="erro">Erro ao cadastrar</div>';
		}

		$em->flush();

	}else{
		echo '<div class="alerta">Este e-mail já está em uso</div>';
	}
}
?>
<form action="" method="post">
	<input type="text" name="nome" placeholder="Nome Completo:" />
	<input type="text" name="email" placeholder="E-mail:" />
	<input type="password" name="senha" placeholder="Senha:" />
	<input type="text" name="idade" placeholder="Idade:" />
	<input type="submit" name="registrar" value="Registrar" />
	<input type="reset" value="Limpar" />
</form>
<?php $dc_site->get_footer(); ?>