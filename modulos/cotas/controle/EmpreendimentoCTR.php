<?php
 class EmpreendimentoCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/cotas/visualizacao/empreendimento";
 
 	public function preparaLista(){
 		
 		$_REQUEST['voEmpreendimento'] = $this->recuperar("Empreendimento");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oEmpreendimento = false;
        
        
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdEmpreendimento = ($_POST['fIdEmpreendimento'][0]) ? $_POST['fIdEmpreendimento'][0] : $_GET['nIdEmpreendimento'];
              $oEmpreendimento = $this->recuperar('Empreendimento', array('id'=>$nIdEmpreendimento));
         }
 
         $_REQUEST['oEmpreendimento'] = (@$_SESSION['oEmpreendimento']) ? $_SESSION['oEmpreendimento'][0] : $oEmpreendimento[0];
         unset($_SESSION['oEmpreendimento']);
 
         
 
         if($_REQUEST['sOP'] == "Detalhar")
             include_once($this->_PATHVIEW . "/detalhe.php");
         else
             include_once($this->_PATHVIEW . "/insere_altera.php");
 
         exit();
 
     }
 
 
     public function processaFormulario(){
         $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];
 
         if($sOP != "Excluir"){
            $oEmpreendimento = new Empreendimento();
             	
			$oEmpreendimento->setId($_POST['fId']);
            $oEmpreendimento->setNome($_POST['fNome']);
			$oEmpreendimento->setEndereco($_POST['fEndereco']);
			$oEmpreendimento->setCep($_POST['fCep']);
			$oEmpreendimento->setTipo($_POST['fTipo']);
			$oEmpreendimento->setDescricao($_POST['fDescricao']);
 
             $_SESSION['oEmpreendimento'] = $oEmpreendimento;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_text_field("Endereco", $oEmpreendimento->getEndereco(), "text", "y");
			//$oValidate->add_text_field("Cep", $oEmpreendimento->getCep(), "text", "y");
			//$oValidate->add_number_field("Tipo", $oEmpreendimento->getTipo(), "number", "y");
			//$oValidate->add_text_field("Descricao", $oEmpreendimento->getDescricao(), "text", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=Empreendimento.preparaFormulario&sOP=".$sOP."&nIdEmpreendimento=".$_POST['fId']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oEmpreendimento)) {
                     unset($_SESSION['oEmpreendimento']);
                     setMessage("empreendimento inserido com sucesso!", 2);
                     $sHeader = "?action=Empreendimento.preparaLista";
 
                 } else {
                     setMessage("Não foi possível inserir o empreendimento!", 1);
                     $sHeader = "?action=Empreendimento.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oEmpreendimento)){
                     unset($_SESSION['oEmpreendimento']);
                     setMessage("empreendimento alterado com sucesso!", 2);
                     $sHeader = "?action=Empreendimento.preparaLista";
 
                 } else {
                     setMessage("Não foi possível alterar o empreendimento!", 1);
                     $sHeader = "?action=Empreendimento.preparaFormulario&sOP=".$sOP."&nIdEmpreendimento=".$_POST['fId']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdEmpreendimento = explode("____",$_REQUEST['fIdEmpreendimento']);
     		foreach($vIdEmpreendimento as $nIdEmpreendimento)
                         $bResultado &= $this->excluirDesativar("Empreendimento", $nIdEmpreendimento);
 
 
                 if($bResultado){
                     setMessage("empreendimento(s) exclu&iacute;do(s) com sucesso!", 2);
                     $sHeader = "?action=Empreendimento.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) empreendimento!", 1);
                     $sHeader = "?action=Empreendimento.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);
 
     }
 
 }
 
 
 ?>