<?php
 class EmpreendimentoTipoUnidadeCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/empreendimento/visualizacao/empreendimento_tipo_unidade";
 
 	public function preparaLista(){
 		
 		$_REQUEST['voEmpreendimentoTipoUnidade'] = $this->recuperar("EmpreendimentoTipoUnidade");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oEmpreendimentoTipoUnidade = false;
 
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdEmpreendimentoTipoUnidade = ($_POST['fIdEmpreendimentoTipoUnidade'][0]) ? $_POST['fIdEmpreendimentoTipoUnidade'][0] : $_GET['nIdEmpreendimentoTipoUnidade'];
              $oEmpreendimentoTipoUnidade = $this->recuperar('EmpreendimentoTipoUnidade', array('id'=>$nIdEmpreendimentoTipoUnidade));
         }
 
         $_REQUEST['oEmpreendimentoTipoUnidade'] = (@$_SESSION['oEmpreendimentoTipoUnidade']) ? $_SESSION['oEmpreendimentoTipoUnidade'][0] : $oEmpreendimentoTipoUnidade[0];
         unset($_SESSION['oEmpreendimentoTipoUnidade']);
 
         $_REQUEST['voEmpreendimento'] = $this->recuperar("Empreendimento", array());

		
 
         if($_REQUEST['sOP'] == "Detalhar")
             include_once($this->_PATHVIEW . "/detalhe.php");
         else
             include_once($this->_PATHVIEW . "/insere_altera.php");
 
         exit();
 
     }
 
 
     public function processaFormulario(){
         $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];
 
         if($sOP != "Excluir"){
            $oEmpreendimentoTipoUnidade = new EmpreendimentoTipoUnidade();
             	
			$oEmpreendimentoTipoUnidade->setId($_POST['fId']);
			$oEmpreendimentoTipoUnidade->setIdEmpreendimento($_POST['fIdEmpreendimento']);
			$oEmpreendimentoTipoUnidade->setNome($_POST['fNome']);
 
             $_SESSION['oEmpreendimentoTipoUnidade'] = $oEmpreendimentoTipoUnidade;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_number_field("Id", $oEmpreendimentoTipoUnidade->getId(), "number", "y");
			//$oValidate->add_number_field("IdEmpreendimento", $oEmpreendimentoTipoUnidade->getIdEmpreendimento(), "number", "y");
			//$oValidate->add_text_field("Nome", $oEmpreendimentoTipoUnidade->getNome(), "text", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=EmpreendimentoTipoUnidade.preparaFormulario&sOP=".$sOP."&nIdEmpreendimentoTipoUnidade=".$_POST['fId']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oEmpreendimentoTipoUnidade)) {
                     unset($_SESSION['oEmpreendimentoTipoUnidade']);
                     setMessage("empreendimento_tipo_unidade inserido com sucesso!", 2);
                     $sHeader = "?action=EmpreendimentoTipoUnidade.preparaLista";
 
                 } else {
                     setMessage("Não foi possível inserir o empreendimento_tipo_unidade!", 1);
                     $sHeader = "?action=EmpreendimentoTipoUnidade.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oEmpreendimentoTipoUnidade)){
                     unset($_SESSION['oEmpreendimentoTipoUnidade']);
                     setMessage("empreendimento_tipo_unidade alterado com sucesso!", 2);
                     $sHeader = "?action=EmpreendimentoTipoUnidade.preparaLista";
 
                 } else {
                     setMessage("Não foi possível alterar o empreendimento_tipo_unidade!", 1);
                     $sHeader = "?action=EmpreendimentoTipoUnidade.preparaFormulario&sOP=".$sOP."&nIdEmpreendimentoTipoUnidade=".$_POST['fId']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdEmpreendimentoTipoUnidade = explode("____",$_REQUEST['fIdEmpreendimentoTipoUnidade']);
     		foreach($vIdEmpreendimentoTipoUnidade as $nIdEmpreendimentoTipoUnidade)
                         $bResultado &= $this->excluirDesativar("EmpreendimentoTipoUnidade", $nIdEmpreendimentoTipoUnidade);
 
 
                 if($bResultado){
                     setMessage("empreendimento_tipo_unidade(s) exclu&iacute;do(s) com sucesso!", 2);
                     $sHeader = "?action=EmpreendimentoTipoUnidade.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) empreendimento_tipo_unidade!", 1);
                     $sHeader = "?action=EmpreendimentoTipoUnidade.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);
 
     }
 
 }
 
 
 ?>