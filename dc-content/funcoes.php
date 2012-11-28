<?php
function ativaLink($pag){
	global $pg;
	if($pg[0] == $pag){
		return "ativo";
	}
}
?>