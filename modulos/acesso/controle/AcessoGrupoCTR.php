<?php
 class AcessoGrupoCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/acesso/visualizacao/acesso_grupo";
 
 	public function preparaLista(){    

 		$_REQUEST['voAcessoGrupo'] = $this->recuperar("AcessoGrupo");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oAcessoGrupo = false;
 
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdAcessoGrupo = ($_POST['fIdAcessoGrupo'][0]) ? $_POST['fIdAcessoGrupo'][0] : $_GET['nIdAcessoGrupo'];
              if(!$oAcessoGrupo = $this->recuperar('AcessoGrupo', array('id_grupo'=>$nIdAcessoGrupo))) {
                 setMessage("ERRO: Grupo de usuário não encontrado!", 1);
                 header("Location: ?action=AcessoGrupo.preparaLista");
                 die();
              }

         }
 
         $_REQUEST['oAcessoGrupo'] = (@$_SESSION['oAcessoGrupo']) ? $_SESSION['oAcessoGrupo'][0] : $oAcessoGrupo[0];
         unset($_SESSION['oAcessoGrupo']);

         $_REQUEST['voAcessoGrupo'] = $this->recuperar("AcessoGrupo", array());


 
         if($_REQUEST['sOP'] == "Detalhar")
             include_once($this->_PATHVIEW . "/detalhe.php");
         else
             include_once($this->_PATHVIEW . "/insere_altera.php");
 
         exit();
 
     }
 
 
     public function processaFormulario(){
         $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];
 
         if($sOP != "Excluir"){
            $oAcessoGrupo = new AcessoGrupo();
             	
			$oAcessoGrupo->setIdGrupo($_POST['fIdGrupo']);
			$oAcessoGrupo->setIdGrupoPai($_POST['fIdGrupoPai']);
			$oAcessoGrupo->setNome($_POST['fNome']);
			$oAcessoGrupo->setAtivo($_POST['fAtivo']);
 
             $_SESSION['oAcessoGrupo'] = $oAcessoGrupo;
 
             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_number_field("IdGrupoPai", $oAcessoGrupo->getIdGrupoPai(), "number", "y");
			//$oValidate->add_text_field("Nome", $oAcessoGrupo->getNome(), "text", "y");
			//$oValidate->add_number_field("Ativo", $oAcessoGrupo->getAtivo(), "number", "y");

             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=AcessoGrupo.preparaFormulario&sOP=".$sOP."&nIdAcessoGrupo=".$_POST['fIdGrupo']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oAcessoGrupo)) {
                     unset($_SESSION['oAcessoGrupo']);
                     setMessage("Grupo de Usuários inserido com sucesso!", 2);
                     $sHeader = "?action=AcessoGrupo.preparaLista";
                 } else {
                    setMessage("Não foi possível inserir o Grupo de Usuários!", 1);
                     $sHeader = "?action=AcessoGrupo.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oAcessoGrupo)){
                     unset($_SESSION['oAcessoGrupo']);
                     setMessage("Grupo de Usuários alterado com sucesso!", 2);
                     $sHeader = "?action=AcessoGrupo.preparaLista";
                 } else {
                    setMessage("Não foi possível alterar o Grupo de Usuários!", 1);
                     $sHeader = "?action=AcessoGrupo.preparaFormulario&sOP=".$sOP."&nIdAcessoGrupo=".$_POST['fIdGrupo']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdAcessoGrupo = explode("____",$_REQUEST['fIdAcessoGrupo']);
     			 foreach($vIdAcessoGrupo as $nIdAcessoGrupo)
                         $bResultado &= $this->excluirDesativar("AcessoGrupo", $nIdAcessoGrupo);
 
                 if($bResultado){
                     setMessage("Grupo de Usuários(s) excluído(s) com sucesso!", 2);
                     $sHeader = "?action=AcessoGrupo.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) Grupo de Usuários!", 1);
                     $sHeader = "?action=AcessoGrupo.preparaLista";
                 }
             break;
         }
 
         header("Location: ".$sHeader);
 
     }
 
 }
 
 
 ?>