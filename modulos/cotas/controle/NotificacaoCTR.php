<?php
 class NotificacaoCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/cotas/visualizacao/notificacao";
 
 	public function preparaLista(){
 		
 		$_REQUEST['voNotificacao'] = $this->recuperar("Notificacao");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oNotificacao = false;
 
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdNotificacao = ($_POST['fIdNotificacao'][0]) ? $_POST['fIdNotificacao'][0] : $_GET['nIdNotificacao'];
              $oNotificacao = $this->recuperar('Notificacao', array('id'=>$nIdNotificacao));
         }
 
         $_REQUEST['oNotificacao'] = (@$_SESSION['oNotificacao']) ? $_SESSION['oNotificacao'][0] : $oNotificacao[0];
         unset($_SESSION['oNotificacao']);
 
         $_REQUEST['voAcessoUsuario'] = $this->recuperar("AcessoUsuario", array());
		
 
         if($_REQUEST['sOP'] == "Detalhar")
             include_once($this->_PATHVIEW . "/detalhe.php");
         else
             include_once($this->_PATHVIEW . "/insere_altera.php");
 
         exit();
 
     }
 
 
     public function processaFormulario(){
         $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];
 
         if($sOP != "Excluir"){
            $oNotificacao = new Notificacao();
             	
			$oNotificacao->setId($_POST['fId']);
			$oNotificacao->setIdUsuario($_POST['fIdUsuario']);
			$oNotificacao->setTipo($_POST['fTipo']);
			$oNotificacao->setMensagem($_POST['fMensagem']);
			$oNotificacao->setVisualizada($_POST['fVisualizada']);
			$oNotificacao->setLink($_POST['fLink']);
			$oNotificacao->setAtivo($_POST['fAtivo']);
			$oNotificacao->setGeracaoBanco($_POST['fGeracao']);
 
             $_SESSION['oNotificacao'] = $oNotificacao;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_number_field("IdUsuario", $oNotificacao->getIdUsuario(), "number", "y");
			//$oValidate->add_text_field("Tipo", $oNotificacao->getTipo(), "text", "y");
			//$oValidate->add_text_field("Mensagem", $oNotificacao->getMensagem(), "text", "y");
			//$oValidate->add_number_field("Visualizada", $oNotificacao->getVisualizada(), "number", "y");
			//$oValidate->add_text_field("Link", $oNotificacao->getLink(), "text", "y");
			//$oValidate->add_number_field("Ativo", $oNotificacao->getAtivo(), "number", "y");
			//$oValidate->add_date_field("Geracao", $oNotificacao->getGeracao(), "date", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=Notificacao.preparaFormulario&sOP=".$sOP."&nIdNotificacao=".$_POST['fId']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oNotificacao)) {
                     unset($_SESSION['oNotificacao']);
                     setMessage("notificacao inserido com sucesso!", 2);
                     $sHeader = "?action=Notificacao.preparaLista";
 
                 } else {
                     setMessage("Não foi possível inserir o notificacao!", 1);
                     $sHeader = "?action=Notificacao.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oNotificacao)){
                     unset($_SESSION['oNotificacao']);
                     setMessage("notificacao alterado com sucesso!", 2);
                     $sHeader = "?action=Notificacao.preparaLista";
 
                 } else {
                     setMessage("Não foi possível alterar o notificacao!", 1);
                     $sHeader = "?action=Notificacao.preparaFormulario&sOP=".$sOP."&nIdNotificacao=".$_POST['fId']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdNotificacao = explode("____",$_REQUEST['fIdNotificacao']);
     		foreach($vIdNotificacao as $nIdNotificacao)
                         $bResultado &= $this->excluirDesativar("Notificacao", $nIdNotificacao);
 
 
                 if($bResultado){
                     setMessage("notificacao(s) exclu&iacute;do(s) com sucesso!", 2);
                     $sHeader = "?action=Notificacao.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) notificacao!", 1);
                     $sHeader = "?action=Notificacao.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);
 
     }
 
 }
 
 
 ?>