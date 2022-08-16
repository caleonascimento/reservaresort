<?php         
$oController = new Controller();

switch($_POST['sOP']) {
    case "Logon" :

        //Valida os campos do formulário
        if (!isset($_POST['fLogin']) || !isset($_POST['fSenha']) || empty($_POST['fLogin']) || empty($_POST['fSenha'])) {
            $_SESSION['oMsg'] = (object) ['sMsg'=>"ATENÇÂO: Os campos usuário e senha devem ser preenchidos.", 'nType'=>1];
             header("Location: login.php");
             die();
        }

        //Valida Login e senha do usuário no banco
        if($oAcessoUsuario = $oController->recuperar("AcessoUsuario",["login"=>$_POST['fLogin'], 'senha'=>md5($_POST['fSenha'])])[0]) {
             //Grava o dia e hora do acesso
             $oAcessoUsuario->setUltimoAcessoBanco(date("d/m/Y H:i:s"));
             $oController->alterar($oAcessoUsuario);
             //Remove a senha do usuário da sessão
             $oAcessoUsuario->setSenha(null);
            
             //Grava o usuário na sessão 
             $_SESSION['oUsuario'] = $oAcessoUsuario; 
             autenticarUsuario();

        } else {
             $_SESSION['oMsg'] = (object) ['sMsg'=>"Usuário ou senha incorretos!", 'nType'=>1];
             header("Location: login.php");
             die();
        }

    break;
    case "Redefinir" :


        if(!empty(preg_replace('/([A-Za-z0-9])+/i',"", $_POST['fSenha']))) {
            $_SESSION['oMsg'] = (object) ['sMsg'=>"ATENÇÃO: O campo de contém caracteres especiais!", 'nType'=>1];
            header("Location: ".$_POST['fUri']);
            die();
        }

        if(empty($_POST['fSenha']) || !isset($_POST['fSenha'])) {
            $_SESSION['oMsg'] = (object) ['sMsg'=>"ATENÇÃO: O campo de senha deve ser preenchido.", 'nType'=>1];
            header("Location: ".$_POST['fUri']);
            die();
        }

        //Recupera o usuário pelo id
        if($oAcessoUsuario = $oController->recuperar("AcessoUsuario", ["id"=>$_POST['fId']])[0])  {
            $oAcessoUsuario->setSenha(md5($_POST['fSenha']));
            if($oController->alterar($oAcessoUsuario)) {
                $_SESSION['oMsg'] = (object) ['sMsg'=>"Senha alterada com sucesso!", 'nType'=>2];
                header("Location: login.php");
                die();
                // $_SESSION['oUsuario'] = $oAcessoUsuario; 
                // autenticarUsuario();
            } else {
                $_SESSION['oMsg'] = (object) ['sMsg'=>"Erro ao alterar ao redefinir!", 'nType'=>1];
                header("Location: ".$_POST['fUri']);
                die();
            }

        }

    break;

    case "Resetar":
        
        if(!isset($_POST['fEmail']) || empty($_POST['fEmail'])) {
            $_SESSION['oMsg'] = (object) ['sMsg'=>"ATENÇÃO: O campo de email deve ser preenchido.", 'nType'=>1];
            unset($_SESSION['oUsuario']);
            header("Location: login.php?action=resetSenha");
            die();
        }

         //Tenta recuperar o usuário através do email
        if( $oAcessoUsuario = $oController->recuperar("AcessoUsuario", ["email"=>$_POST['fEmail']])[0] ) {

                //Nome do usuário
                $sNome = $oAcessoUsuario->getNome();
                $sAssunto = "Redefinição de senha - ". SYSTEM_NAME;
                //Monta o link da recuperação de senha
                $slink = HTTP_SERVER.ROOT_PATH."login.php?action=alterarSenha&rdfs=".md5($oAcessoUsuario->getSenha())."&id=".$oAcessoUsuario->getId();  
               
                $oMailer = new Mailer();
                if($oMailer->enviar($sNome, $_POST['fEmail'], $sAssunto, "confirm", 
                    array(   'nome'=>$sNome,
                             'link'=> $slink
                    ))){
                        $_SESSION['oMsg'] = (object) [
                            'sMsg'=>"Um link foi gerado para redefinição de senha. Verifique o email informado para definir uma nova senha!", 
                            'nType'=>2];
                        header("Location: login.php");
                        die();
                }else {
                    $_SESSION['oMsg'] = (object) [
                        'sMsg'=>"Erro no envio do email, tente novamente mais tarde ou entre em contato com a equipe de suporte!", 
                        'nType'=>1];
                    header("Location: login.php?action=resetSenha");
                    die();
                }  
          
            //Caso não encontre o email cadastrado
        } else {
            $_SESSION['oMsg'] = (object) [
                'sMsg'=>"Email do do usuário não encontrado, verifique o email informado e tente novamente!", 
                'nType'=>1];
            header("Location: login.php?action=resetSenha");
            die();
        }

        break;

}

header("Location: ".ROOT_PATH);
exit();



function verificaSenhaAtualizada($oAcessoUsuario){
    if($oAcessoUsuario->getSenha() == md5($oAcessoUsuario->getLogin()))
        return false;
    else
        return true;
}


function autenticarUsuario() {
    $oController = new Controller();

    //Recupera o(s) grupo(s) que o usuário está vinculado
    $_SESSION['voGrupoUsuario'] = $oController->recuperar("AcessoGrupoUsuario", array('id_usuario'=>$_SESSION['oUsuario']->getId()));
    
    //Seta as permissões dos usuários na sessão
    $_SESSION['voPermissaoGrupo'] = array();

    //Pega todas as permissões vinculadas ao(s) grupo(s) do usuário
    foreach($_SESSION['voGrupoUsuario'] as $oGrupoUsuario)
        if($voPermissaoGrupo = $oController->recuperar("AcessoPermissaoGrupo", array('id_grupo'=>$oGrupoUsuario->getIdGrupo())))
            $_SESSION['voPermissaoGrupo'] = array_merge($_SESSION['voPermissaoGrupo'], $voPermissaoGrupo);

    //Pega todas as permissões abertas comuns para todos
    if($voPermissaoGeral = $oController->recuperar("AcessoPermissaoGrupo", array('id_grupo'=>'IS NULL')))
        $_SESSION['voPermissaoGrupo'] = array_merge($_SESSION['voPermissaoGrupo'], $voPermissaoGeral);

}

?>