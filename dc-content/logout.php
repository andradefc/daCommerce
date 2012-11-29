<?php

if($url[0] == "logout"){
	unset($_SESSION["logged"]);
	header("Location: index");
}

?>