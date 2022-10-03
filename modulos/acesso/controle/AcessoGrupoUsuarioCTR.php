<?php
class AcessoGrupoUsuarioCTR extends Controller implements IControle{

    private $_PATHVIEW = "modulos/acesso/visualizacao/acesso_grupo_usuario";

    public function preparaLista(){

        $_REQUEST['voAcessoGrupoUsuario'] = $this->recuperar("AcessoGrupoUsuario");

        include_once($this->_PATHVIEW . "/index.php");
        exit();

    }

    public function preparaFormulario(){
        $oAcessoGrupoUsuario = false;

        if($_REQUEST['sOP'] == "Alterar" || $_REQUEST['sOP'] == "Detalhar"){
            $nIdAcessoGrupoUsuario = ($_POST['fIdAcessoGrupoUsuario'][0]) ? $_POST['fIdAcessoGrupoUsuario'][0] : $_GET['nIdAcessoGrupoUsuario'];
            $oAcessoGrupoUsuario = $this->recuperar('AcessoGrupoUsuario', array('id_grupo_usuario'=>$nIdAcessoGrupoUsuario));
        }

        $_REQUEST['oAcessoGrupoUsuario'] = (@$_SESSION['oAcessoGrupoUsuario']) ? $_SESSION['oAcessoGrupoUsuario'] : $oAcessoGrupoUsuario[0];
        unset($_SESSION['oAcessoGrupoUsuario']);



        if($_REQUEST['sOP'] == "Detalhar")
            include_once($this->_PATHVIEW . "/detalhe.php");
        else
            include_once($this->_PATHVIEW . "/insere_altera.php");

        exit();

    }


    public function processaFormulario(){
        $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];

        if($sOP != "Excluir"){
            $oAcessoGrupoUsuario = new AcessoGrupoUsuario();

            $oAcessoGrupoUsuario->setIdGrupoUsuario(@$_POST['fIdGrupoUsuario']);
            $oAcessoGrupoUsuario->setIdGrupo($_POST['fIdGrupo']);
            $oAcessoGrupoUsuario->setIdUsuario($_POST['fIdUsuario']);
            $oAcessoGrupoUsuario->setInseridoPor(null);
            $oAcessoGrupoUsuario->setAlteradoPor(null);

            $_SESSION['oAcessoGrupoUsuario'] = $oAcessoGrupoUsuario;

            $oValidate = FabricaUtilitario::getUtilitario("Validate");
            $oValidate->check_4html = true;

            //$oValidate->add_number_field("IdGrupo", $oAcessoGrupoUsuario->getIdGrupo(), "number", "y");
            //$oValidate->add_number_field("IdUsuario", $oAcessoGrupoUsuario->getIdUsuario(), "number", "y");
            //$oValidate->add_text_field("InseridoPor", $oAcessoGrupoUsuario->getInseridoPor(), "text", "y");
            //$oValidate->add_text_field("AlteradoPor", $oAcessoGrupoUsuario->getAlteradoPor(), "text", "y");

            if (!$oValidate->validation()) {
                setMessage($oValidate->create_msg(), 1);
                $sHeader = "?action=AcessoGrupoUsuario.preparaFormulario&sOP=".$sOP."&nIdAcessoGrupoUsuario=".$_POST['fIdGrupoUsuario']."";
                header("Location: ".$sHeader);
                die();
            }
        }

        switch($sOP){
            case "Cadastrar":
                if($this->inserir($oAcessoGrupoUsuario)) {
                    unset($_SESSION['oAcessoGrupoUsuario']);
                    setMessage("Grupo adicionado com sucesso!", 2);
                    $sHeader = "?action=AcessoUsuario.preparaFormulario&sOP=Detalhar&nIdAcessoUsuario=".$_POST['fIdUsuario'];

                } else {
                    setMessage("Não foi possível vincular o usuário ao grupo!", 1);
                    $sHeader = "?action=AcessoUsuario.preparaFormulario&sOP=Detalhar&nIdAcessoUsuario=".$_POST['fIdUsuario'];
                }
                break;
            case "Alterar":
                if($this->alterar($oAcessoGrupoUsuario)){
                    unset($_SESSION['oAcessoGrupoUsuario']);
                    setMessage("Grupo de usuário alterado com sucesso!", 2);
                    $sHeader = "?action=AcessoGrupoUsuario.preparaLista";

                } else {
                    setMessage("Não foi possível alterar o grupo do usuario!", 1);
                    $sHeader = "?action=AcessoGrupoUsuario.preparaFormulario&sOP=".$sOP."&nIdAcessoGrupoUsuario=".$_POST['fIdGrupoUsuario']."";
                }
                break;
            case "Excluir":
                $bResultado = true;

                $vIdAcessoGrupoUsuario = explode("____",$_REQUEST['fIdAcessoGrupoUsuario']);
                foreach($vIdAcessoGrupoUsuario as $nIdAcessoGrupoUsuario)
                    $bResultado &= $this->excluirDesativar("AcessoGrupoUsuario", $nIdAcessoGrupoUsuario);

                if($bResultado){
                    setMessage("Grupo do usuário excluído com sucesso!", 2);
                    $sHeader = "?action=AcessoUsuario.preparaFormulario&sOP=Detalhar&nIdAcessoUsuario=".$_REQUEST['fIdUsuario'];
                } else {
                    setMessage("Não foi possível excluir o(s) Grupo!", 1);
                    $sHeader = "?action=AcessoUsuario.preparaFormulario&sOP=Detalhar&nIdAcessoUsuario=".$_REQUEST['fIdUsuario'];
                }
                break;
        }

        header("Location: ".$sHeader);

    }

}