<?php
 class AcompanhantesCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/cotas/visualizacao/acompanhantes";
 
 	public function preparaLista(){
 		
 		$_REQUEST['voAcompanhantes'] = $this->recuperar("Acompanhantes");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oAcompanhantes = false;
 
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdAcompanhantes = ($_POST['fIdAcompanhantes'][0]) ? $_POST['fIdAcompanhantes'][0] : $_GET['nIdAcompanhantes'];
              $oAcompanhantes = $this->recuperar('Acompanhantes', array('id'=>$nIdAcompanhantes));
         }
 
         $_REQUEST['oAcompanhantes'] = (@$_SESSION['oAcompanhantes']) ? $_SESSION['oAcompanhantes'][0] : $oAcompanhantes[0];
         unset($_SESSION['oAcompanhantes']);
 
         $_REQUEST['voReservaLocador'] = $this->recuperar("ReservaLocador", array());

		
 
         if($_REQUEST['sOP'] == "Detalhar")
             include_once($this->_PATHVIEW . "/detalhe.php");
         else
             include_once($this->_PATHVIEW . "/insere_altera.php");
 
         exit();
 
     }
 
 
     public function processaFormulario(){
         $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];
 
         if($sOP != "Excluir"){
            $oAcompanhantes = new Acompanhantes();
             	
			$oAcompanhantes->setId($_POST['fId']);
			$oAcompanhantes->setNome($_POST['fNome']);
			$oAcompanhantes->setCpf($_POST['fCpf']);
			$oAcompanhantes->setDataNascBanco($_POST['fDataNasc']);
			$oAcompanhantes->setIdReservaLocador($_POST['fIdReservaLocador']);
 
             $_SESSION['oAcompanhantes'] = $oAcompanhantes;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_text_field("Nome", $oAcompanhantes->getNome(), "text", "y");
			//$oValidate->add_number_field("Cpf", $oAcompanhantes->getCpf(), "number", "y");
			//$oValidate->add_date_field("DataNasc", $oAcompanhantes->getDataNasc(), "date", "y");
			//$oValidate->add_number_field("IdReservaLocador", $oAcompanhantes->getIdReservaLocador(), "number", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=Acompanhantes.preparaFormulario&sOP=".$sOP."&nIdAcompanhantes=".$_POST['fId']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oAcompanhantes)) {
                     unset($_SESSION['oAcompanhantes']);
                     setMessage("acompanhantes inserido com sucesso!", 2);
                     $sHeader = "?action=Acompanhantes.preparaLista";
 
                 } else {
                     setMessage("Não foi possível inserir o acompanhantes!", 1);
                     $sHeader = "?action=Acompanhantes.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oAcompanhantes)){
                     unset($_SESSION['oAcompanhantes']);
                     setMessage("acompanhantes alterado com sucesso!", 2);
                     $sHeader = "?action=Acompanhantes.preparaLista";
 
                 } else {
                     setMessage("Não foi possível alterar o acompanhantes!", 1);
                     $sHeader = "?action=Acompanhantes.preparaFormulario&sOP=".$sOP."&nIdAcompanhantes=".$_POST['fId']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdAcompanhantes = explode("____",$_REQUEST['fIdAcompanhantes']);
     		foreach($vIdAcompanhantes as $nIdAcompanhantes)
                         $bResultado &= $this->excluirDesativar("Acompanhantes", $nIdAcompanhantes);
 
 
                 if($bResultado){
                     setMessage("acompanhantes(s) exclu&iacute;do(s) com sucesso!", 2);
                     $sHeader = "?action=Acompanhantes.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) acompanhantes!", 1);
                     $sHeader = "?action=Acompanhantes.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);
 
     }
 
 }
 
 
 ?>