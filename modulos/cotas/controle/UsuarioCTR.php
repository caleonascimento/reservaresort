<?php
 class UsuarioCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/cotas/visualizacao/usuario";
 
 	public function preparaLista(){
 		
 		$_REQUEST['voUsuario'] = $this->recuperar("Usuario");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oUsuario = false;
 
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdUsuario = ($_POST['fIdUsuario'][0]) ? $_POST['fIdUsuario'][0] : $_GET['nIdUsuario'];
              $oUsuario = $this->recuperar('Usuario', array('id'=>$nIdUsuario));
         }
 
        //  $_REQUEST['oUsuario'] = (@$_SESSION['oUsuario']) ? $_SESSION['oUsuario'][0] : $oUsuario[0];
        //  unset($_SESSION['oUsuario']);
 
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
            $oUsuario = new Usuario();
             	
			$oUsuario->setId($_POST['fId']);
			$oUsuario->setNome($_POST['fNome']);
			$oUsuario->setCpf($_POST['fCpf']);
			$oUsuario->setRg($_POST['fRg']);
			$oUsuario->setEndereco($_POST['fEndereco']);
			$oUsuario->setCep($_POST['fCep']);
			$oUsuario->setFone($_POST['fFone']);
			$oUsuario->setEmail($_POST['fEmail']);
			// $oUsuario->setDataNascBanco($_POST['fDataNasc']);
			$oUsuario->setTipo($_POST['fTipo']);
			$oUsuario->setIdAcessoUsuario($_POST['fIdAcessoUsuario']);
 
             $_SESSION['oUsuario'] = $oUsuario;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_text_field("Nome", $oUsuario->getNome(), "text", "y");
			//$oValidate->add_text_field("Cpf", $oUsuario->getCpf(), "text", "y");
			//$oValidate->add_text_field("Rg", $oUsuario->getRg(), "text", "y");
			//$oValidate->add_text_field("Endereco", $oUsuario->getEndereco(), "text", "y");
			//$oValidate->add_text_field("Cep", $oUsuario->getCep(), "text", "y");
			//$oValidate->add_text_field("Fone", $oUsuario->getFone(), "text", "y");
			//$oValidate->add_text_field("Email", $oUsuario->getEmail(), "text", "y");
			//$oValidate->add_date_field("DataNasc", $oUsuario->getDataNasc(), "date", "y");
			//$oValidate->add_number_field("Tipo", $oUsuario->getTipo(), "number", "y");
			//$oValidate->add_number_field("IdAcessoUsuario", $oUsuario->getIdAcessoUsuario(), "number", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=Usuario.preparaFormulario&sOP=".$sOP."&nIdUsuario=".$_POST['fId']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oUsuario)) {
                     unset($_SESSION['oUsuario']);
                     setMessage("usuario inserido com sucesso!", 2);
                     $sHeader = "?action=Usuario.preparaLista";
 
                 } else {
                     setMessage("Não foi possível inserir o usuario!", 1);
                     $sHeader = "?action=Usuario.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oUsuario)){
                     unset($_SESSION['oUsuario']);
                     setMessage("usuario alterado com sucesso!", 2);
                     $sHeader = "?action=Usuario.preparaLista";
 
                 } else {
                     setMessage("Não foi possível alterar o usuario!", 1);
                     $sHeader = "?action=Usuario.preparaFormulario&sOP=".$sOP."&nIdUsuario=".$_POST['fId']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdUsuario = explode("____",$_REQUEST['fIdUsuario']);
     		foreach($vIdUsuario as $nIdUsuario)
                         $bResultado &= $this->excluirDesativar("Usuario", $nIdUsuario);
 
 
                 if($bResultado){
                     setMessage("usuario(s) exclu&iacute;do(s) com sucesso!", 2);
                     $sHeader = "?action=Usuario.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) usuario!", 1);
                     $sHeader = "?action=Usuario.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);
 
     }
 
 }
 
 
 ?>