<?php
 class ReservaCotaCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/cotas/visualizacao/reserva_cota";
 
 	public function preparaLista(){
 		
 		$_REQUEST['voReservaCota'] = $this->recuperar("ReservaCota");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oReservaCota = false;
 
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdReservaCota = ($_POST['fIdReservaCota'][0]) ? $_POST['fIdReservaCota'][0] : $_GET['nIdReservaCota'];
              $oReservaCota = $this->recuperar('ReservaCota', array('id'=>$nIdReservaCota));
         }
 
         $_REQUEST['oReservaCota'] = (@$_SESSION['oReservaCota']) ? $_SESSION['oReservaCota'][0] : $oReservaCota[0];
         unset($_SESSION['oReservaCota']);
 
         $_REQUEST['voCota'] = $this->recuperar("Cota", array());

		
 
         if($_REQUEST['sOP'] == "Detalhar")
             include_once($this->_PATHVIEW . "/detalhe.php");
         else
             include_once($this->_PATHVIEW . "/insere_altera.php");
 
         exit();
 
     }
 
 
     public function processaFormulario(){
         $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];
 
         if($sOP != "Excluir"){
            $oReservaCota = new ReservaCota();
             	
			$oReservaCota->setId($_POST['fId']);
			$oReservaCota->setPeriodoIniBanco($_POST['fPeriodoIni']);
			$oReservaCota->setPeriodoFimBanco($_POST['fPeriodoFim']);
			$oReservaCota->setIdCota($_POST['fIdCota']);
			$oReservaCota->setLocacao($_POST['fLocacao']);
 
             $_SESSION['oReservaCota'] = $oReservaCota;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_date_field("PeriodoIni", $oReservaCota->getPeriodoIni(), "date", "y");
			//$oValidate->add_date_field("PeriodoFim", $oReservaCota->getPeriodoFim(), "date", "y");
			//$oValidate->add_number_field("IdCota", $oReservaCota->getIdCota(), "number", "y");
			//$oValidate->add_text_field("Locacao", $oReservaCota->getLocacao(), "text", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=ReservaCota.preparaFormulario&sOP=".$sOP."&nIdReservaCota=".$_POST['fId']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oReservaCota)) {
                     unset($_SESSION['oReservaCota']);
                     setMessage("reserva_cota inserido com sucesso!", 2);
                     $sHeader = "?action=ReservaCota.preparaLista";
 
                 } else {
                     setMessage("Não foi possível inserir o reserva_cota!", 1);
                     $sHeader = "?action=ReservaCota.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oReservaCota)){
                     unset($_SESSION['oReservaCota']);
                     setMessage("reserva_cota alterado com sucesso!", 2);
                     $sHeader = "?action=ReservaCota.preparaLista";
 
                 } else {
                     setMessage("Não foi possível alterar o reserva_cota!", 1);
                     $sHeader = "?action=ReservaCota.preparaFormulario&sOP=".$sOP."&nIdReservaCota=".$_POST['fId']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdReservaCota = explode("____",$_REQUEST['fIdReservaCota']);
     		foreach($vIdReservaCota as $nIdReservaCota)
                         $bResultado &= $this->excluirDesativar("ReservaCota", $nIdReservaCota);
 
 
                 if($bResultado){
                     setMessage("reserva_cota(s) exclu&iacute;do(s) com sucesso!", 2);
                     $sHeader = "?action=ReservaCota.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) reserva_cota!", 1);
                     $sHeader = "?action=ReservaCota.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);
 
     }
 
 }
 
 
 ?>