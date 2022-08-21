<?php
 class UnidadeCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/cotas/visualizacao/unidade";
 
 	public function preparaLista(){
 		
 		$_REQUEST['voUnidade'] = $this->recuperar("Unidade");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oUnidade = false;
 
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdUnidade = ($_POST['fIdUnidade'][0]) ? $_POST['fIdUnidade'][0] : $_GET['nIdUnidade'];
              $oUnidade = $this->recuperar('Unidade', array('id'=>$nIdUnidade));
         }
 
         $_REQUEST['oUnidade'] = (@$_SESSION['oUnidade']) ? $_SESSION['oUnidade'][0] : $oUnidade[0];
         unset($_SESSION['oUnidade']);
 
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
            $oUnidade = new Unidade();
             	
			$oUnidade->setId($_POST['fId']);
			$oUnidade->setTipo($_POST['fTipo']);
			$oUnidade->setDescricao($_POST['fDescricao']);
			$oUnidade->setLotacao($_POST['fLotacao']);
			$oUnidade->setIdEmpreendimento($_POST['fIdEmpreendimento']);
 
             $_SESSION['oUnidade'] = $oUnidade;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_text_field("Tipo", $oUnidade->getTipo(), "text", "y");
			//$oValidate->add_text_field("Descricao", $oUnidade->getDescricao(), "text", "y");
			//$oValidate->add_number_field("Lotacao", $oUnidade->getLotacao(), "number", "y");
			//$oValidate->add_number_field("IdEmpreendimento", $oUnidade->getIdEmpreendimento(), "number", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=Unidade.preparaFormulario&sOP=".$sOP."&nIdUnidade=".$_POST['fId']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oUnidade)) {
                     unset($_SESSION['oUnidade']);
                     setMessage("unidade inserido com sucesso!", 2);
                     $sHeader = "?action=Unidade.preparaLista";
 
                 } else {
                     setMessage("Não foi possível inserir o unidade!", 1);
                     $sHeader = "?action=Unidade.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oUnidade)){
                     unset($_SESSION['oUnidade']);
                     setMessage("unidade alterado com sucesso!", 2);
                     $sHeader = "?action=Unidade.preparaLista";
 
                 } else {
                     setMessage("Não foi possível alterar o unidade!", 1);
                     $sHeader = "?action=Unidade.preparaFormulario&sOP=".$sOP."&nIdUnidade=".$_POST['fId']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdUnidade = explode("____",$_REQUEST['fIdUnidade']);
     		foreach($vIdUnidade as $nIdUnidade)
                         $bResultado &= $this->excluirDesativar("Unidade", $nIdUnidade);
 
 
                 if($bResultado){
                     setMessage("unidade(s) exclu&iacute;do(s) com sucesso!", 2);
                     $sHeader = "?action=Unidade.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) unidade!", 1);
                     $sHeader = "?action=Unidade.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);
 
     }
 
 }
 
 
 ?>