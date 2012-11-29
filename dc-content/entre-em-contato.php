<?php $dc_site->get_header(); ?>				
<h1>Entre em Contato</h1>
<?php
if(isset($_POST["enviar"])){
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$assunto = $_POST["assunto"];
	$mensagem = $_POST["mensagem"];

	$msg = '
		Nome: '.$nome.'<br />
		E-mail: '.$email.'<br />
		Assunto: '.$assunto.'<br />
		Mensagem: '.$mensagem.'<br />
	';

	$headers = "From: $nome <$email>";

	mail("gabriel@arealocal.com.br", $email, $assunto, $headers);

}
?>
<form action="" method="post">
	<input type="text" name="nome" placeholder="Nome Completo:" />
	<input type="text" name="email" placeholder="E-mail:" />
	<input type="password" name="senha" placeholder="Assunto:" />
	<textarea name="mensagem" placeholder="Mensagem:"></textarea>
	<input type="submit" name="enviar" value="Enviar" />
	<input type="reset" value="Limpar" />
</form>
<?php $dc_site->get_footer(); ?>