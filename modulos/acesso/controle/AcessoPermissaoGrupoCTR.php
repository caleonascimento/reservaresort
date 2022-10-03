<?php
 class AcessoPermissaoGrupoCTR extends Controller implements IControle{
 	
 	private $_PATHVIEW = "modulos/acesso/visualizacao/acesso_permissao_grupo";
 
 	public function preparaLista(){

 		$_REQUEST['voAcessoPermissaoGrupo'] = $this->recuperar("AcessoPermissaoGrupo");
 		
 		include_once($this->_PATHVIEW . "/index.php");
 		exit();

 	}

     public function preparaFormulario() {
        try {
             $oAcessoPermissaoGrupo = false;

             $nIdAcessoGrupo = ($_POST['fIdAcessoGrupo'][0]) ? $_POST['fIdAcessoGrupo'][0] : $_GET['nIdAcessoGrupo'];
             //Recupera o objeto do grupo
             if(!$oAcessoGrupo = $this->recuperar('AcessoGrupo', array('id_grupo'=>$nIdAcessoGrupo)))
                 throw new exception("Grupo inválido ou não informado.");

             //Pega toda as permissões do grupo
             $voAcessoPermissaoGrupo = $this->recuperar('AcessoPermissaoGrupo', array('id_grupo'=>$nIdAcessoGrupo));

             //Salvando dados na sessão
             $_REQUEST['oAcessoGrupo'] = (@$_SESSION['oAcessoGrupo']) ? $_SESSION['oAcessoGrupo'] : $oAcessoGrupo[0];
             $_REQUEST['voAcessoPermissaoGrupo'] = (@$_SESSION['voAcessoPermissaoGrupo']) ? $_SESSION['voAcessoPermissaoGrupo'] : $voAcessoPermissaoGrupo[0];
             unset($_SESSION['voAcessoPermissaoGrupo']);

             //Recupera todos os grupos para listar no select
             $_REQUEST['voAcessoGrupo'] = $this->recuperar("AcessoGrupo", array());

             //Recupera todo o mapeamento do sistema para montar a arvore de inputs
    		if( $oAcessoModuloTransacao = $this->recuperar("AcessoModuloTransacao", array('id_modulo_transacao_0'=>'is NULL'))[0])
                  $sListInputs = $this->imprimirPermissoesInput($oAcessoModuloTransacao, $voAcessoPermissaoGrupo);



             if($_REQUEST['sOP'] == "Detalhar")
                 include_once($this->_PATHVIEW . "/detalhe.php");

             exit();
        } catch(Exception $e) {
            setMessage($e->getMessage(), 1);
            $sHeader = "?action=AcessoPermissaoGrupo.preparaLista";
        }
     }
 

     public function processaFormulario(){
        try {  

             $sOP = (array_key_exists('sOP',$_POST)) ? $_POST['sOP'] : $_GET['sOP'];

             if(!isset($_POST['fIdGrupo']))
                 throw new exception("Grupo não informado.");

             //$voPermissoes = $this->recuperar("AcessoPermissaoGrupo", array('id_grupo'=>$_POST['fIdGrupo']));

             //Exclui todas as permissões deste grupo
             $this->executarQuery('DELETE FROM acesso_permissao_grupo WHERE id_grupo = '.$_POST['fIdGrupo']);

             //Verifica se foi setada permissões positivas e insere no banco
             if(isset($_POST['amtIdAllow']))
                foreach($_POST['amtIdAllow'] as $nIdAcessoModuloTransacao) {
                     $oAcessoPermissaoGrupo = new AcessoPermissaoGrupo();
                     $oAcessoPermissaoGrupo->setIdGrupo($_POST['fIdGrupo']);
                     $oAcessoPermissaoGrupo->setIdModuloTransacao($nIdAcessoModuloTransacao);
                     $oAcessoPermissaoGrupo->setPermissao(1);
                     $this->inserir($oAcessoPermissaoGrupo);
                }
             //Verifica se foi setada permissões negativas e insere no banco
             if(isset($_POST['amtIdDeny']))
                foreach($_POST['amtIdDeny'] as $nIdAcessoModuloTransacao) {
                     $oAcessoPermissaoGrupo = new AcessoPermissaoGrupo();
                     $oAcessoPermissaoGrupo->setIdGrupo($_POST['fIdGrupo']);
                     $oAcessoPermissaoGrupo->setIdModuloTransacao($nIdAcessoModuloTransacao);
                     $oAcessoPermissaoGrupo->setPermissao(0);
                     $this->inserir($oAcessoPermissaoGrupo);
                }

                setMessage("Permissões alteradas com sucesso.", 2);
                header("Location: ?action=AcessoGrupo.preparaLista");
                die();

        } catch(Exception $e) {
            setMessage($e->getMessage(), 1);
            $sHeader = "?action=AcessoPermissaoGrupo.preparaLista";
        }

 
     }

     public function imprimirPermissoesInput($oAcessoModuloTransacao) {

         $nId = $oAcessoModuloTransacao->getIdModuloTransacao();
         $nIdPai = $oAcessoModuloTransacao->getIdModuloTransacaoPai();
         $stipo = $oAcessoModuloTransacao->getTipo() == 0 ? 'modulo':'';
         $span = '';
         if($voAcessoModuloTransacao = $oAcessoModuloTransacao->getAcessoModuloTransacaoChild())
            $span = '<span class="collapse-sinal" id="collapse-sinal-'.$nId.'">'.($nIdPai?'+':'-').'</span>';
         $sListInputs = '
                            <li class="">
                                <div class="row">
                                    <div class="checkbox-custom checkbox-primary check-allow">
        								<input type="checkbox" name="amtIdAllow[]" id="a_'.$nId.'" class="check Allow checkPai-a_'.$nIdPai.'" value="'.$nId.'" />
        								<label for="a_'.$nId.'"></label>
        						    </div>
                                    <div class="checkbox-custom checkbox-danger check-deny">
        								<input type="checkbox" name="amtIdDeny[]" id="d_'.$nId.'" class="check Deny checkPai-d_'.$nIdPai.'" value="'.$nId.'" />
        								<label for="d_'.$nId.'" class="label-check"></label>
        						    </div>
                                    <div>
                                    <a class="accordion-toggle '.$stipo.'" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$nId.'" data-id="'.$nId.'" >
                                    	 ' . $oAcessoModuloTransacao->getTitulo() . '
                                    </a>'.$span.'
                                    </div>
                                </div>';
         if($voAcessoModuloTransacao)
             foreach($voAcessoModuloTransacao as $oAcessoModuloTransacao1)
                 $sListInputs .= '  <ul id="collapse'.$nId.'" class="collapse '.($nIdPai?'':'show').' ul-list">
                                        ' . $this->imprimirPermissoesInput($oAcessoModuloTransacao1) . '
                                    </ul>';


         $sListInputs .= '
                            </li>
                         ';
         return $sListInputs;
     }



 }
 
 
 ?>