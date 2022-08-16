<?php
 class AcessoModuloTransacaoCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/acesso/visualizacao/acesso_modulo_transacao";

 	public function preparaLista(){
 		
 		$_REQUEST['voAcessoModuloTransacao'] = $this->recuperar("AcessoModuloTransacao", array('id_modulo_transacao_pai'=>'IS NULL'));
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oAcessoModuloTransacao = false;
         $voAcessoModuloTransacao = array();

         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
             $nIdAcessoModuloTransacao = (isset($_POST['fIdAcessoModuloTransacao']) && !empty($_POST['fIdAcessoModuloTransacao'])) ? $_POST['fIdAcessoModuloTransacao'] : $_GET['nIdAcessoModuloTransacao'];
             $oAcessoModuloTransacao = $this->recuperar('AcessoModuloTransacao', array('id_modulo_transacao'=>$nIdAcessoModuloTransacao));
                 //$voAcessoModuloTransacao = $oAcessoModuloTransacao[0]->getAcessoModuloTransacaoChild();  //Pega os filhos  da 1º geração
                //$voAcessoModuloTransacao = $this->recuperar('AcessoModuloTransacao', array('id_modulo_transacao_0'=>$nIdAcessoModuloTransacao));

         }

         $_REQUEST['oAcessoModuloTransacao'] = (@$_SESSION['oAcessoModuloTransacao']) ? $_SESSION['oAcessoModuloTransacao']: $oAcessoModuloTransacao[0];
         unset($_SESSION['oAcessoModuloTransacao']);
 
         $_REQUEST['voAcessoModuloTransacao'] = $this->recuperar("AcessoModuloTransacao", array());

		
 
         if($_REQUEST['sOP'] == "Detalhar")
             include_once($this->_PATHVIEW . "/detalhe.php");
         else
             include_once($this->_PATHVIEW . "/insere_altera.php");
 
         exit();

     }

 
     public function processaFormulario(){
         $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];
 
         if($sOP != "Excluir"){
            $oAcessoModuloTransacao = new AcessoModuloTransacao();

			$oAcessoModuloTransacao->setIdModuloTransacao($_POST['fIdModuloTransacao']);
			$oAcessoModuloTransacao->setIdModuloTransacao0($_POST['fIdModuloTransacao0']);
			$oAcessoModuloTransacao->setIdModuloTransacaoPai($_POST['fIdModuloTransacaoPai']);
			$oAcessoModuloTransacao->setNome($_POST['fNome']);
			$oAcessoModuloTransacao->setTitulo($_POST['fTitulo']);
			$oAcessoModuloTransacao->setTipo($_POST['fTipo']);
			$oAcessoModuloTransacao->setMenu($_POST['fMenu']);
			$oAcessoModuloTransacao->setInseridoPor(null);
			$oAcessoModuloTransacao->setAlteradoPor(null);
 
             $_SESSION['oAcessoModuloTransacao'] = $oAcessoModuloTransacao;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_number_field("IdModuloTransacaoPai", $oAcessoModuloTransacao->getIdModuloTransacaoPai(), "number", "y");
			//$oValidate->add_text_field("Nome", $oAcessoModuloTransacao->getNome(), "text", "y");
			//$oValidate->add_text_field("Titulo", $oAcessoModuloTransacao->getTitulo(), "text", "y");
			//$oValidate->add_number_field("Tipo", $oAcessoModuloTransacao->getTipo(), "number", "y");
			//$oValidate->add_text_field("Menu", $oAcessoModuloTransacao->getMenu(), "text", "y");
			//$oValidate->add_text_field("InseridoPor", $oAcessoModuloTransacao->getInseridoPor(), "text", "y");
			//$oValidate->add_text_field("AlteradoPor", $oAcessoModuloTransacao->getAlteradoPor(), "text", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=AcessoModuloTransacao.preparaFormulario&sOP=Detalhar&nIdAcessoModuloTransacao=".$_POST['fIdModuloTransacao0'];
                 header("Location: ".$sHeader);
                 die();
             }
         }

         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oAcessoModuloTransacao)) {
                     unset($_SESSION['oAcessoModuloTransacao']);
                     setMessage("Dados inseridos com sucesso!", 2);
                     $sHeader = "?action=AcessoModuloTransacao.preparaFormulario&sOP=Detalhar&nIdAcessoModuloTransacao=".$_POST['fIdModuloTransacao0'];

                 } else {
                     setMessage("N&atilde;o foi poss&iacute;vel inserir os dados!", 1);
                     $sHeader = "?action=AcessoModuloTransacao.preparaFormulario&sOP=Detalhar&nIdAcessoModuloTransacao=".$_POST['fIdModuloTransacao0'];
                 }
             break;
             case "Alterar":
                 if($this->alterar($oAcessoModuloTransacao)){
                     unset($_SESSION['oAcessoModuloTransacao']);
                     setMessage("Dados alterados com sucesso!", 2);
                     $sHeader = "?action=AcessoModuloTransacao.preparaLista";
 
                 } else {
                     setMessage("N&atilde;o foi poss&iacute;vel alterar os dados!", 1);
                     $sHeader = "?action=AcessoModuloTransacao.preparaFormulario&sOP=".$sOP."&nIdAcessoModuloTransacao=".$_POST['fIdModuloTransacao']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdAcessoModuloTransacao = explode("____",$_REQUEST['fIdAcessoModuloTransacao']);
     				foreach($vIdAcessoModuloTransacao as $nIdAcessoModuloTransacao)
                         $bResultado &= $this->excluirDesativar("AcessoModuloTransacao", $nIdAcessoModuloTransacao);
 
 
                 if($bResultado){
                     setMessage("acesso_modulo_transacao(s) exclu&iacute;do(s) com sucesso!", 2);
                     $sHeader = "?action=AcessoModuloTransacao.preparaLista";
                 } else {
                     setMessage("N&atilde;o foi poss&iacute;vel excluir o(s) acesso_modulo_transacao!", 1);
                     $sHeader = "?action=AcessoModuloTransacao.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);

     }

     public function gerarTreeNodesJson($oAcessoModuloTransacao, $vTreeNodes=array()) {

         $bOpened = false;

         //Seta um ícone de acordo com o tipo de nó
         //Verifica se é o nó raiz
         if(empty($oAcessoModuloTransacao->getIdModuloTransacaoPai())) {
             $nIdPai = "#";
             $sClassIcon = "far fa-folder";
             $bOpened = true;
         } else {
             $nIdPai = $oAcessoModuloTransacao->getIdModuloTransacaoPai();
             switch($oAcessoModuloTransacao->getTipo()) {
                case 0: //Módulo
                    $sClassIcon = "fas fa-folder";
                break;
                case 1: //Controle
                    $sClassIcon = "far fa-copyright";//"fas fa-clipboard-list";        
                break;
                case 2: //Transação
                    $sClassIcon = "far fa-file-alt";
                break;
                case 3: //Operação
                    $sClassIcon = "fas fa-cogs";
                break;
             }
          }

         //Insere os dados do nó no array json
         $vTreeNodes[] = array('id'=>$oAcessoModuloTransacao->getIdModuloTransacao(), "parent"=>$nIdPai, "text"=>$oAcessoModuloTransacao->getTitulo(), 'icon'=>$sClassIcon, 'state'=>array('opened'=>$bOpened));

         //Verifica se o elemento do nó possui filhos
         if($voAcessoModuloTransacao = $oAcessoModuloTransacao->getAcessoModuloTransacaoChild())
              foreach($voAcessoModuloTransacao as $oAcessoModuloTransacao)
                 $vTreeNodes = $this->gerarTreeNodesJson($oAcessoModuloTransacao, $vTreeNodes);

         return $vTreeNodes;
     }
 
 }
 
 
 ?>