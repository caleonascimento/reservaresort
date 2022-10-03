<?php
 class ReservaLocadorCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/cotas/visualizacao/reserva_locador";
 
 	public function preparaLista(){
 		
 		$_REQUEST['voReservaLocador'] = $this->recuperar("ReservaLocador");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oReservaLocador = false;
 
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdReservaLocador = ($_POST['fIdReservaLocador'][0]) ? $_POST['fIdReservaLocador'][0] : $_GET['nIdReservaLocador'];
              $oReservaLocador = $this->recuperar('ReservaLocador', array('id'=>$nIdReservaLocador));
         }
 
         $_REQUEST['oReservaLocador'] = (@$_SESSION['oReservaLocador']) ? $_SESSION['oReservaLocador'][0] : $oReservaLocador[0];
         unset($_SESSION['oReservaLocador']);
 
         $_REQUEST['voReservaCota'] = $this->recuperar("ReservaCota", array());

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
            $oReservaLocador = new ReservaLocador();
             	
			$oReservaLocador->setId($_POST['fId']);
			$oReservaLocador->setIdReservaCota($_POST['fIdReservaCota']);
			$oReservaLocador->setIdUsuario($_POST['fIdUsuario']);
 
             $_SESSION['oReservaLocador'] = $oReservaLocador;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_number_field("IdReservaCota", $oReservaLocador->getIdReservaCota(), "number", "y");
			//$oValidate->add_number_field("IdUsuario", $oReservaLocador->getIdUsuario(), "number", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=ReservaLocador.preparaFormulario&sOP=".$sOP."&nIdReservaLocador=".$_POST['fId']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oReservaLocador)) {
                     unset($_SESSION['oReservaLocador']);
                     setMessage("reserva_locador inserido com sucesso!", 2);
                     $sHeader = "?action=ReservaLocador.preparaLista";
 
                 } else {
                     setMessage("Não foi possível inserir o reserva_locador!", 1);
                     $sHeader = "?action=ReservaLocador.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oReservaLocador)){
                     unset($_SESSION['oReservaLocador']);
                     setMessage("reserva_locador alterado com sucesso!", 2);
                     $sHeader = "?action=ReservaLocador.preparaLista";
 
                 } else {
                     setMessage("Não foi possível alterar o reserva_locador!", 1);
                     $sHeader = "?action=ReservaLocador.preparaFormulario&sOP=".$sOP."&nIdReservaLocador=".$_POST['fId']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdReservaLocador = explode("____",$_REQUEST['fIdReservaLocador']);
     		foreach($vIdReservaLocador as $nIdReservaLocador)
                         $bResultado &= $this->excluirDesativar("ReservaLocador", $nIdReservaLocador);
 
 
                 if($bResultado){
                     setMessage("reserva_locador(s) exclu&iacute;do(s) com sucesso!", 2);
                     $sHeader = "?action=ReservaLocador.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) reserva_locador!", 1);
                     $sHeader = "?action=ReservaLocador.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);
 
     }
 
 }
 
 
 ?>