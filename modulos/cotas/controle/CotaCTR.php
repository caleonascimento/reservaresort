<?php
 class CotaCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/cotas/visualizacao/cota";
 
 	public function preparaLista(){
 		
 		$_REQUEST['voCota'] = $this->recuperar("Cota");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oCota = false;
 
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdCota = ($_POST['fIdCota'][0]) ? $_POST['fIdCota'][0] : $_GET['nIdCota'];
              $oCota = $this->recuperar('Cota', array('id'=>$nIdCota));
         }
 
         $_REQUEST['oCota'] = (@$_SESSION['oCota']) ? $_SESSION['oCota'][0] : $oCota[0];
         unset($_SESSION['oCota']);
 
         $_REQUEST['voUnidade'] = $this->recuperar("Unidade", array());
		$_REQUEST['voUsuario'] = $this->recuperar("Usuario", array());
		
 
         if($_REQUEST['sOP'] == "Detalhar")
             include_once($this->_PATHVIEW . "/detalhe.php");
         else
             include_once($this->_PATHVIEW . "/insere_altera.php");
 
         exit();
 
     }
 
 
     public function processaFormulario(){
         $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];
 
         if($sOP != "Excluir"){
            $oCota = new Cota();
             	
			$oCota->setId($_POST['fId']);
			$oCota->setNumero($_POST['fNumero']);
			$oCota->setIdUsuario($_POST['fIdUsuario']);
			$oCota->setIdUnidade($_POST['fIdUnidade']);
 
             $_SESSION['oCota'] = $oCota;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_text_field("Numero", $oCota->getNumero(), "text", "y");
			//$oValidate->add_number_field("IdUsuario", $oCota->getIdUsuario(), "number", "y");
			//$oValidate->add_number_field("IdUnidade", $oCota->getIdUnidade(), "number", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=Cota.preparaFormulario&sOP=".$sOP."&nIdCota=".$_POST['fId']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oCota)) {
                     unset($_SESSION['oCota']);
                     setMessage("cota inserido com sucesso!", 2);
                     $sHeader = "?action=Cota.preparaLista";
 
                 } else {
                     setMessage("Não foi possível inserir o cota!", 1);
                     $sHeader = "?action=Cota.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oCota)){
                     unset($_SESSION['oCota']);
                     setMessage("cota alterado com sucesso!", 2);
                     $sHeader = "?action=Cota.preparaLista";
 
                 } else {
                     setMessage("Não foi possível alterar o cota!", 1);
                     $sHeader = "?action=Cota.preparaFormulario&sOP=".$sOP."&nIdCota=".$_POST['fId']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdCota = explode("____",$_REQUEST['fIdCota']);
     		foreach($vIdCota as $nIdCota)
                         $bResultado &= $this->excluirDesativar("Cota", $nIdCota);
 
 
                 if($bResultado){
                     setMessage("cota(s) exclu&iacute;do(s) com sucesso!", 2);
                     $sHeader = "?action=Cota.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) cota!", 1);
                     $sHeader = "?action=Cota.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);
 
     }
 
 }
 
 
 ?>