<?php
 class UnidadeCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/cotas/visualizacao/unidade";
 
 	public function preparaLista(){
        $location = "?action=Empreendimento.preparaLista";
        try {
            if(!isset($_REQUEST['id']) || (isset($_REQUEST['id']) && empty($_REQUEST['id'])))
                throw new Exception("Id do empreendimento inválido!", 1);
            if(!$oEmpreedimento = $this->recuperar("Empreendimento", ['id'=>$_REQUEST['id']]))
                throw new Exception("Empreendimento inválido ou não encontrado!", 1);

            $oEmpreedimento = $oEmpreedimento[0];

    
    
            $_REQUEST['voUnidade'] = $this->recuperar("Unidade");
            
            include_once($this->_PATHVIEW . "/index.php");
            exit();
                
        } catch (Exception $e) {
            setMessage($e->getMessage(), 1);
            header("Location:".$location);
            exit;
        }

        // if(!isset($_REQUEST['id']) || (isset($_REQUEST['id']) && empty($_REQUEST['id']))){
        //     setMessage("Id do empreendimento inválido!", 1);
        //     header("Location:?action=Empreendimento.preparaLista");
        //     exit;
        // }
        // if(!$oEmpreedimento = $this->recuperar("Empreendimento", ['id'=>$_REQUEST['id']])) {
        //     setMessage("Id do empreendimento inválido!", 1);
        //     header("Location:?action=Empreendimento.preparaLista");
        //     exit;
        // }
        // $oEmpreedimento = $oEmpreedimento[0];

        
 		
 		// $_REQUEST['voUnidade'] = $this->recuperar("Unidade");
 		
 		// include_once($this->_PATHVIEW . "/index.php");
 		// exit();
 	
 	}
 
     public function preparaFormulario(){
        $location = "?action=Empreendimento.preparaLista";

        try {
            if(!isset($_REQUEST['idEmpreendimento']) || (isset($_REQUEST['idEmpreendimento']) && empty($_REQUEST['idEmpreendimento'])))
                throw new Exception("Id do empreendimento inválido!", 1);
            if(!$oEmpreedimento = $this->recuperar("Empreendimento", ['id'=>$_REQUEST['idEmpreendimento']]))
                throw new Exception("Id do empreendimento inválido!", 1);
                
            $oEmpreedimento = $oEmpreedimento[0];
            $idEmpreendimento = $_REQUEST['idEmpreendimento'];

            //Pega os tipos de unidades do empreendimento
            $voTipoUnidades = $oEmpreedimento->getTipoUnidades();
            
            $oUnidade = false;

            if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
                $nIdUnidade = ($_POST['fIdUnidade'][0]) ? $_POST['fIdUnidade'][0] : $_GET['nIdUnidade'];
                if(!$oUnidade = $this->recuperar('Unidade', array('id'=>$nIdUnidade)))
                    throw new Exception("Id da unidade inválido!", 1);             
            }

            $_REQUEST['oUnidade'] = (@$_SESSION['oUnidade']) ? $_SESSION['oUnidade'] : $oUnidade;
            unset($_SESSION['oUnidade']);
   
           
            if($_REQUEST['sOP'] == "Detalhar")
                include_once($this->_PATHVIEW . "/detalhe.php");
            else
                include_once($this->_PATHVIEW . "/insere_altera.php");
    
            exit();

        //Tratamento de erros         
        } catch(Exception $e) {
            setMessage($e->getMessage(), 1);
            header("Location:".$location);
            exit;
        }

        // if(!isset($_REQUEST['idEmpreendimento']) || (isset($_REQUEST['idEmpreendimento']) && empty($_REQUEST['idEmpreendimento']))){
        //     setMessage("Id do empreendimento não encontrado!", 1);
        //     header("Location:?action=Empreendimento.preparaLista");
        //     exit;
        // }
        // $idEmpreendimento = $_REQUEST['idEmpreendimento'];
        // $oEmpreedimento = $this->recuperar("Empreendimento", ['id'=>$idEmpreendimento])[0];
        // if (!$oEmpreedimento) {
        //      setMessage("Empreendimento não encontrado!", 1);
        //      header("Location:?action=Empreendimento.preparaLista");
        //      exit;
        // }

        //Pega os tipos de unidades do empreendimento
        // $voTipoUnidades = $oEmpreedimento->getTipoUnidades();
         
        //  $oUnidade = false;
 
        //  if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
        //       $nIdUnidade = ($_POST['fIdUnidade'][0]) ? $_POST['fIdUnidade'][0] : $_GET['nIdUnidade'];
        //       if(!$oUnidade = $this->recuperar('Unidade', array('id'=>$nIdUnidade)))

              
        //  }

        //  $_REQUEST['oUnidade'] = (@$_SESSION['oUnidade']) ? $_SESSION['oUnidade'] : $oUnidade;
        //  unset($_SESSION['oUnidade']);

		
 
        //  if($_REQUEST['sOP'] == "Detalhar")
        //      include_once($this->_PATHVIEW . "/detalhe.php");
        //  else
        //      include_once($this->_PATHVIEW . "/insere_altera.php");
 
        //  exit();
 
     }
 
 
     public function processaFormulario(){
         $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];
 
         if($sOP != "Excluir"){
            $oUnidade = new Unidade();
             	
			$oUnidade->setId($_POST['fId']);
			$oUnidade->setIdTipoUnidade($_POST['fIdTipoUnidade']);
			$oUnidade->setDescricao($_POST['fDescricao']);
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
                     setMessage("Unidade cadastrada com sucesso!", 2);
                     $sHeader = "?action=Unidade.preparaLista&id=".$oUnidade->getIdEmpreendimento();
 
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