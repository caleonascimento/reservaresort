<?php
 class AcessoUsuarioCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/acesso/visualizacao/acesso_usuario";

    public function viewUser() {
        $oAcessoUsuario = $this->recuperar('AcessoUsuario', array('id'=>$_SESSION['oUsuario']->getId()))[0];

        include_once($this->_PATHVIEW . "/view_user.php");
 		exit();
    }

    public function notificacoes() {

        //Verifica se o tipo de notificação foi setado
        if(!$_GET['tipo'] ){
            header("Location: ?");
            die();
        }
        //Pega todas as notificações ativas
        $voNotificacoes = $this->recuperar("Notificacao", ['id_usuario'=>$_SESSION['oUsuario']->getId(), 'tipo'=>$_GET['tipo'], 'ativo'=>1], "ORDER BY id DESC");
        //Caso haja alguma notificação seta todas como visualizadas
        if($voNotificacoes)
            $this->executarQuery("UPDATE notificacao SET visualizada=1 AND ativo=1 AND tipo='".$_GET['tipo']."'");     

        include_once("modulos/main/notificacoes.php");
 		exit();
       
    }
 
 	public function preparaLista(){
 		
 		$_REQUEST['voAcessoUsuario'] = $this->recuperar("AcessoUsuario");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();
 	
 	}
 
     public function preparaFormulario(){
         $oAcessoUsuario = false;
 
         if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
              $nIdAcessoUsuario = (@$_POST['fIdAcessoUsuario'][0]) ? $_POST['fIdAcessoUsuario'][0] : $_GET['nIdAcessoUsuario'];
              $oAcessoUsuario = $this->recuperar('AcessoUsuario', array('id'=>$nIdAcessoUsuario))[0];
         }
 
         $_REQUEST['oAcessoUsuario'] = (@$_SESSION['oAcessoUsuario']) ? $_SESSION['oAcessoUsuario'] : $oAcessoUsuario;
         unset($_SESSION['oAcessoUsuario']);

         if($_REQUEST['sOP'] == "Detalhar") {
             if(!$oAcessoUsuario){
                setMessage("ID não informado ou inválido!", 1);
                 header("Location: ?action=AcessoUsuario.preparaLista");
                 die();
             }
             $voAcessoGrupo = $this->recuperar("AcessoGrupo");
             $voAcessoGrupoUsuario = $this->recuperar('AcessoGrupoUsuario', array('id_usuario'=>$nIdAcessoUsuario));
             include_once($this->_PATHVIEW . "/detalhe.php");
         } else
             include_once($this->_PATHVIEW . "/insere_altera.php");
 
         exit();

     }
 
 
     public function processaFormulario(){
         $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];
 
         if($sOP != "Excluir"){
            $oAcessoUsuario = new AcessoUsuario();
             	
			$oAcessoUsuario->setId($_POST['fId']);
			$oAcessoUsuario->setNome($_POST['fNome']);
			$oAcessoUsuario->setLogin($_POST['fLogin']);
			$oAcessoUsuario->setEmail($_POST['fEmail']);
			$oAcessoUsuario->setSenha(md5( $_POST['fSenha']));
			$oAcessoUsuario->setGeracaoBanco($_POST['fGeracao']);
 
             $_SESSION['oAcessoUsuario'] = $oAcessoUsuario;

             $oValidate = FabricaUtilitario::getUtilitario("Validate");
             $oValidate->check_4html = true;
 
             //$oValidate->add_text_field("Login", $oAcessoUsuario->getLogin(), "text", "y");
			//$oValidate->add_text_field("Senha", $oAcessoUsuario->getSenha(), "text", "y");
			//$oValidate->add_date_field("Geracao", $oAcessoUsuario->getGeracao(), "date", "y");
			//$oValidate->add_date_field("UltimoAcesso", $oAcessoUsuario->getUltimoAcesso(), "date", "y");

 
             if (!$oValidate->validation()) {
                 setMessage($oValidate->create_msg(), 1);
                 $sHeader = "?action=AcessoUsuario.preparaFormulario&sOP=".$sOP."&nIdAcessoUsuario=".$_POST['fId']."";
                 header("Location: ".$sHeader);
                 die();
             }
         }
 
         switch($sOP){
             case "Cadastrar":
                 if($this->inserir($oAcessoUsuario)) {
                     unset($_SESSION['oAcessoUsuario']);
                     setMessage("Usuário inserido com sucesso!", 2);
                     $sHeader = "?action=AcessoUsuario.preparaLista";
 
                 } else {
                     setMessage("Não foi possível inserir o Usuário!", 1);
                     $sHeader = "?action=AcessoUsuario.preparaFormulario&sOP=".$sOP;
                 }
             break;
             case "Alterar":
                 if($this->alterar($oAcessoUsuario)){
                     unset($_SESSION['oAcessoUsuario']);
                     setMessage("Usuário alterado com sucesso!", 2);
                     $sHeader = "?action=AcessoUsuario.preparaLista";

                 } else {
                    setMessage("Não foi possível alterar o Usuário!", 1);
                     $sHeader = "?action=AcessoUsuario.preparaFormulario&sOP=".$sOP."&nIdAcessoUsuario=".$_POST['fId']."";
                 }
             break;
             case "Excluir":
                 $bResultado = true;
 
                 $vIdAcessoUsuario = explode("____",$_REQUEST['fIdAcessoUsuario']);
     				foreach($vIdAcessoUsuario as $nIdAcessoUsuario)
                         $bResultado &= $this->excluirDesativar("AcessoUsuario", $nIdAcessoUsuario);

 
                 if($bResultado){
                     setMessage("Usuário(s) excluído(s) com sucesso!", 2);
                     $sHeader = "?action=AcessoUsuario.preparaLista";
                 } else {
                     setMessage("Não foi possível excluir o(s) Usuário!", 1);
                     $sHeader = "?action=AcessoUsuario.preparaLista";
                 }
             break;
         }

         header("Location: ".$sHeader);

     }

 }

?>