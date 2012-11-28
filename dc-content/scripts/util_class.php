<?
/*****************************************************************
 * HOTCLASS - CLASSE PADROES DA AREA LOCAL
 * Criado em: 20/10/2006
 * Modificado: 01/06/2010
 * Por: Jonatan S. da Costa   
 * 
 * --- FUNCOES ---------------------------------------------------- 
 * function AlinhaStr($str, $tamanho, $alinhamento='LEFT', $caracter=' ')
 * function Capitalize($texto)
 * function Formata_Mascara($campo,$mascara)
 * function Captura_IP()
 * function Muda_Formato_Data($data,$tipo=M)
 * function Muda_Formato_Valor($valor,$tipo,$casas_decimais=2,$cifrao="")
 * function Coalesce()    
 * function resumeTexto($texto,$inicio,$tamanho)
 * function buscaPrimeiroNome($texto)
 * function listaArquivos($pasta)
 *****************************************************************/
 
class THotUtil {
 
  /*----------------------------------------------------------------------------
   FUNCAO PARA LISTAR ARQUIVOS DE UM DIRETORIO
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->listaArquivos('/pasta_inicial');
  --------------------------------------------------------------------------*/  
  function listaArquivos($pasta) {
    /*--------------------------------------------------------------------------
     PASTA = PASTA INICIAL AONDE FARÁ A VARREDURA    
    --------------------------------------------------------------------------*/
    if (!file_exists($pasta))
      return null;
    
    $iterator = new DirectoryIterator($pasta);
    foreach ( $iterator as $entry ) {
      if (!$iterator->isDot())
      $array[] = $entry->getFilename();
    }
    return $array;
  }


  /*----------------------------------------------------------------------------
   FUNCAO PARA GERAR UM TEXTO LIMPO PRA VIRAR URL
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->limpaURL('texto para virar url');
  --------------------------------------------------------------------------*/  
  /*function limpaURL($texto) {
    /*--------------------------------------------------------------------------
     TEXTO = TEXTO QUE VIRARA URL    
    -------------------------------------------------------------------------- 
    $texto = html_entity_decode($texto);
    $texto = mb_strtolower($texto);
    //tirando os acentos
    $texto = str_replace('[aáàãâä]','a',$texto);
    $texto = str_replace('[eéèêë]','e',$texto);
    $texto = str_replace('[iíìîï]','i',$texto);
    $texto = str_replace('[oóòõôö]','o',$texto);
    $texto = str_replace('[uúùûü]','u',$texto);
    //parte que tira o cedilha e o ñ
    $texto = str_replace('[ç]','c',$texto);
    $texto = str_replace('[ñ]','n',$texto);
    //trocando espaço em branco por underline
    $texto = str_replace('( )','-',$texto);
    //tirando outros caracteres invalidos
    $texto = str_replace('[^a-z0-9\-]','',$texto);
    //trocando duplo espaço (underline) por 1 underline só
    $texto = str_replace('--','-',$texto);
    
    return $texto;
  }*/
	
	function limpaURL($string){
		$a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>';
		$b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                              ';
		$string = $string;
		$string = strtr($string, $a, $b);
		$string = strip_tags(trim($string));
		$string = str_replace(" ","-",$string);
    $string = str_replace("----","-",$string);
    $string = str_replace("---","-",$string);
    $string = str_replace("--","-",$string);
		return strtolower($string);
	}
	// exemplo de uso
	//$posts = slug($_POST['input']);

  /*----------------------------------------------------------------------------
   FUNCAO PARA DIVIDIR A URL EM UM ARRAY $PG
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->preparaURL('http://www.arealocal.com.br/minha/url/noticia/',2,'pagina_inicial');
  --------------------------------------------------------------------------*/ 
  function preparaURL($url,$inicio,$pg_inicial) {
    /*--------------------------------------------------------------------------
     URL        = URL COMPLETA
     INICIO     = POSICAO INICIAL QUE VALERÁ COMO URL - GERALMENTE 1 OU 2
     PG_INICIAL = PAGINA INICIAL SE NÃO TIVER NENHUMA URL    
    --------------------------------------------------------------------------*/  
    if ($retira = strpos($url, '?'))
      $url = substr($url,0,$retira-1);

    $url = explode('/', $url);
    for ($k=$inicio;$k<count($url); $k++) {
    	$pg[] = $this->limpaURL($url[$k]);
    }
    $pg[0] = $this->Coalesce($pg[0],$pg[0],$pg_inicial);
    return $pg;
  }


  /*----------------------------------------------------------------------------
   FUNCAO PARA RESUMIR UM TEXTO COM ...
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->resumeTexto('Texto para resumir',1,100);
  ----------------------------------------------------------------------------*/ 
  function resumeTexto($texto,$inicio,$tamanho) {
    /*--------------------------------------------------------------------------
     TEXTO   = TEXTO ORIGINAL PARA RESUMIR
     INICIO  = POSIÇÃO INICIAL DO INICIO DO RESUMO
     TAMANHO = TAMANHO DO RESUMO    
    --------------------------------------------------------------------------*/  
    $resumo = substr($texto, $inicio, $tamanho);
    if (strlen($texto) > strlen($resumo)) {
      $complemento = '...';
      return substr($resumo,0,strrpos($resumo, " ")) . $complemento;
    }else{
      return $resumo;
    }
  }
  
  /*----------------------------------------------------------------------------
   FUNCAO PARA BUSCAR PRIMEIRA PALAVRA ...
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->buscaPrimeiroNome('Texto para buscar',1);
  ----------------------------------------------------------------------------*/ 
  function buscaPrimeiroNome($texto) {
    /*--------------------------------------------------------------------------
     TEXTO   = TEXTO ORIGINAL PARA RESUMIR
    --------------------------------------------------------------------------*/ 
    $final  = strpos($texto, " ");
    $final  = $this->Coalesce($final,strlen($texto));
    $tamanho = $final;
    $resumo = substr($texto, $inicio, $tamanho);
    return $resumo;
  }


  /*----------------------------------------------------------------------------
   FUNCAO PARA RETONAR O PRIMEIRO VALOR NÃO NULO DO ARRAY
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->Coalesce('Texto para resumir',1,100);
  ----------------------------------------------------------------------------*/ 
  function Coalesce() {
    /*--------------------------------------------------------------------------
     PARAMETROS = INDETERMINADOS, SEPARADOS POR VIRGULA    
    --------------------------------------------------------------------------*/
     for ($i=0;$i<func_num_args();$i++){
       $arg = func_get_arg($i);
       if (($arg != null)&&($arg != "")){
         return $arg;
       }
     }
     return null;
  }



  /*----------------------------------------------------------------------------
   FUNCAO PARA ALINHAR CARACTERES A STRING
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->AlinhaStr('AURELIO',5,'LEFT','0');
  --------------------------------------------------------------------------*/  
  function AlinhaStr($str, $tamanho, $alinhamento='LEFT', $caracter=' ') {
    /*--------------------------------------------------------------------------
     STR         = TEXTO PARA ALINHAR
     TAMANHO     = TAMANHO PRETENDIDO
     ALINHAMENTO = LEFT, RIGHT, CENTER
     CARACTER    = SERA ADICONADO NAS SOBRAS     
    --------------------------------------------------------------------------*/
    
    $tamAtual    = strlen($str);
    $quantChar   = max(($tamanho-$tamAtual),0);
    $alinhamento = strtoupper($alinhamento);
    
    if ($alinhamento=='LEFT') {
      
      return substr($str . str_repeat($caracter,$quantChar),0,$tamanho);
    	
    }else
    if ($alinhamento=='RIGHT') {
  
      return substr(str_repeat($caracter,$quantChar) . $str,0,$tamanho);
  
    }else
    if ($alinhamento=='CENTER') {
  
      return substr((substr(str_repeat($caracter,intval($quantChar/2)),0)) . $str . (substr(str_repeat($caracter,$quantChar-intval($quantChar/2)),0)) , 0,$tamanho);
    
    }
  
  }

  /*----------------------------------------------------------------------------
   FUNCAO PARA CAPITALIZAR TEXTO
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->Capitalize($texto);
  --------------------------------------------------------------------------*/  
  function Capitalize($texto) {
    /*--------------------------------------------------------------------------
     TEXTO = DATA EM STRING
    --------------------------------------------------------------------------*/
    $this->texto = $texto;
    $this->de_preposicoes = array(" Do "," De "," Em "," E "," Ao "," Com "," A "," Da ", "Ii", "Iii", "IIi", " Iv");
    $this->para_preposicoes = array(" do "," de "," em "," e "," ao "," com "," a "," da ", "II", "III", "III", " IV");
    return @str_replace($this->de_preposicoes,$this->para_preposicoes,ucwords(mb_strtolower($this->texto)));
  }

  /*----------------------------------------------------------------------------
   FUNCAO PARA FORMATAR UMA MASCARA
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->Formata_Mascara('89160000','##.###-###');
  --------------------------------------------------------------------------*/  
  function Formata_Mascara($campo,$mascara) {
    /**/
    $this->campo     = $campo;
    $this->mascara   = $mascara;
    $this->resultado = "";
    $contador = 0;
    for ($k=0; $k <= strlen($this->mascara); $k++) {
      if ($this->mascara[$k] == "#") {
        $this->resultado .= $this->campo[$contador];
        $contador++;
      }else{
        $this->resultado .= $this->mascara[$k];  
      } 
    }
    return $this->resultado;       
  }

  /*----------------------------------------------------------------------------
   FUNCAO PARA CAPTURAR ENDERECO IP
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->Captura_IP();
  --------------------------------------------------------------------------*/  
  function Captura_IP() {
    unset($this->ip);
    unset($this->proxy);
    if (getenv(HTTP_X_FORWARDED_FOR)) {
      if (getenv(HTTP_CLIENT_IP)) {
        $this->ip = getenv(HTTP_CLIENT_IP);
      } else {
        $this->ip = getenv(HTTP_X_FORWARDED_FOR);
      }
      $this->proxy = getenv(REMOTE_ADDR);
    } else {
      $this->ip = getenv(REMOTE_ADDR);
    }
    /*------------------------------------------------------------------------
     RETURNA STRING COM PAGINACAO PRONTA
    ------------------------------------------------------------------------*/         
    return $this->proxy . (!empty($this->proxy) ? '-' : '') . $this->ip;
  }
  
  /*----------------------------------------------------------------------------
   FUNCAO PARA MUDAR FORMATO DA DATA
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->Muda_Formato_Data('20/10/2006','G');
  ----------------------------------------------------------------------------*/    
  function Muda_Formato_Data($data,$tipo=M) {
    /*--------------------------------------------------------------------------
     DATA = DATA EM STRING
     TIPO:
       TIPO G = FORMATA PARA GRAVAR AAAA/MM/DD
       TIPO M = FORMATA PARA MOSTRAR  DD/MM/AAAA
     ABAIXO VARIAVEIS RECEBIDAS    
    --------------------------------------------------------------------------*/
    $this->data = $data;
    $this->tipo = $tipo;
    
    if (!empty($this->data)) {
      /*--------------------------------------------------------------------------
       SE FOR PARA GRAVAR
      --------------------------------------------------------------------------*/
      if ($this->tipo == "G") {
        if (strpos($this->data," ") != 0) {
           $data_f   = explode("/",substr($this->data,0,strpos($this->data," ")));
           $data_h   = substr($this->data,strpos($this->data," "));
        }else{
          $data_f   = explode("/",$this->data);
        }
        if (checkdate($data_f[1],$data_f[0],$data_f[2])){
          $this->data = trim($data_f[2]."-".$data_f[1]."-".$data_f[0].$data_h);
          return $this->data;
        }else{
          $this->data = null;
          return $this->data;
        }
      }else
      /*--------------------------------------------------------------------------
       SE FOR PARA MOSTRAR
      --------------------------------------------------------------------------*/
      if ($this->tipo == "M") {
        if (strpos($this->data," ") != 0) {
           $data_f   = explode("-",substr($this->data,0,strpos($this->data," ")));
           $data_h   = substr($this->data,strpos($this->data," "),6);
        }else{
          $data_f   = explode("-",$this->data);
        }
        $this->data   = trim($data_f[2]."/".$data_f[1]."/".$data_f[0].$data_h);
        return $this->data;
      }
    }else{
      $this->data = null;
      return $this->data;
    }
  } 
  
  
  
  /*----------------------------------------------------------------------------
   FUNCAO PARA MUDAR FORMATO DA VALOR
   -----------------------------------------------------------------------------
   MODO DE USAR:
   $util = new THotUtil;
   $util->Muda_Formato_Valor('200,00','G',2,"R$");
  ----------------------------------------------------------------------------*/   
  function Muda_Formato_Valor($valor,$tipo,$casas_decimais=2,$cifrao="") {
    /*--------------------------------------------------------------------------
     VALOR = VALOR EM STRING
     TIPO:
       TIPO G = FORMATA PARA GRAVAR 0,000.00
       TIPO M = FORMATA PARA MOSTRAR  0.000,00
     CASAS DECIMAIS = NUMERO DE CASAS, PADRAO 2
     CIFRAO = INCLUI CIFRAO
     
     ABAIXO VARIAVEIS RECEBIDAS    
    --------------------------------------------------------------------------*/
    $this->valor = $valor;
    $this->tipo  = $tipo;
    $this->casas_decimais = $casas_decimais;
    $this->cifrao = $cifrao;
    
    if (!empty($valor)) {
      /*--------------------------------------------------------------------------
       SE FOR PARA GRAVAR
      --------------------------------------------------------------------------*/
      if ($this->tipo == "G") {
        if (is_numeric($this->valor)) {
          return $this->valor;
        }else{
          $valor_temp  = str_replace(".","#",$this->valor);
          $valor_temp2 = str_replace(",",".",$valor_temp);
          $valor_f     = str_replace("#",",",$valor_temp2);
          if (is_numeric($valor_f)) {
            $this->valor = $valor_f;
            return $this->valor;
          }else{
            $this->valor = null;
            return $this->valor;
          }
        }
      }else
      /*--------------------------------------------------------------------------
       SE FOR PARA MOSTRAR
      --------------------------------------------------------------------------*/      
      if ($this->tipo == "M") {
        $this->valor = $this->cifrao . (!empty($this->cifrao) ? " " : "") . number_format($this->valor, $this->casas_decimais, ',', '.');
        return $this->valor;
      }
    }else{
      $this->valor = null;
      return $this->valor;
    }
  }  
	
	function antiSql($texto){
		// Lista de palavras para procurar
		$check[1] = chr(34); // símbolo "
		$check[2] = chr(39); // símbolo '
		$check[3] = chr(92); // símbolo /
		$check[4] = chr(96); // símbolo `
		$check[5] = "drop table";
		$check[6] = "update";
		$check[7] = "alter table";
		$check[8] = "drop database";	
		$check[9] = "drop";
		$check[10] = "select";
		$check[11] = "delete";
		$check[12] = "insert";
		$check[13] = "alter";
		$check[14] = "destroy";
		$check[15] = "table";
		$check[16] = "database";
		$check[17] = "union";
		$check[18] = "TABLE_NAME";
		$check[19] = "1=1";
		$check[20] = 'or 1';
		$check[21] = 'exec';
		$check[22] = 'INFORMATION_SCHEMA';
		$check[23] = 'like';
		$check[24] = 'COLUMNS';
		$check[25] = 'into';
		$check[26] = 'VALUES';
		
		// Cria se as variáveis $y e $x para controle no WHILE que fará a busca e substituição
		$y = 1;
		$x = sizeof($check);
		// Faz-se o WHILE, procurando alguma das palavras especificadas acima, caso encontre alguma delas, este script substituirá por um espaço em branco " ".
		while($y <= $x){
				 $target = strpos($texto,$check[$y]);
				if($target !== false){
					$texto = str_replace($check[$y], "", $texto);
				}
			$y++;
		}
		// Retorna a variável limpa sem perigos de SQL Injection
		return addslashes(strip_tags(trim($texto)));
	}


	function antiSqlTexto($texto){
		// Lista de palavras para procurar
		$check[1] = chr(34); // símbolo "
		$check[2] = chr(39); // símbolo '
		$check[3] = chr(92); // símbolo /
		$check[4] = chr(96); // símbolo `
		$check[5] = "drop table";
		$check[6] = "update";
		$check[7] = "alter table";
		$check[8] = "drop database";	
		$check[9] = "drop";
		$check[10] = "select";
		$check[11] = "delete";
		$check[12] = "insert";
		$check[13] = "alter";
		$check[14] = "destroy";
		$check[15] = "table";
		$check[16] = "database";
		$check[17] = "union";
		$check[18] = "TABLE_NAME";
		$check[19] = "1=1";
		$check[20] = 'exec';
		$check[21] = 'INFORMATION_SCHEMA';
		$check[22] = 'COLUMNS';
		$check[23] = 'into';
		$check[24] = 'VALUES';
		
		// Cria se as variáveis $y e $x para controle no WHILE que fará a busca e substituição
		$y = 1;
		$x = sizeof($check);
		// Faz-se o WHILE, procurando alguma das palavras especificadas acima, caso encontre alguma delas, este script substituirá por um espaço em branco " ".
		while($y <= $x){
				 $target = strpos($texto,$check[$y]);
				if($target !== false){
					$texto = str_replace($check[$y], "", $texto);
				}
			$y++;
		}
		// Retorna a variável limpa sem perigos de SQL Injection
		return addslashes(trim($texto));
	}
	
}

?>
