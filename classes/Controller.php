<?php

class Controller {


    /**
     * Método privado para uso exclusivo dos métodos dessa classe.
     * Este método monta uma string com a clausula WHERE para consulta na base de dados a
     * partir de array passado, podendo ser chamado por qualquer método que recebe um
     * array das clausulas de consulta na base de dados.
     *
     * @return String
     */
    protected function montaArrayComplemento($vWhere) {
        if(!$vWhere)
            return false;
        
        $sComplemento = '';

        //Monta a clausula 'Where'
        foreach($vWhere as $k => $v)
            //Caso o valor da clausula não seja nulo.
            if(!stripos($v, "null"))
                $sComplemento .= $k ."='". $v ."' AND ";
            else
                $sComplemento .= $k.' '.$v.' AND ';
        //Formata a clausula 'Where' removendo o ultimo 'AND' e adicionando o 'WHERE'
        $sComplemento = " WHERE " . substr($sComplemento, 0, -4);

        return $sComplemento;
    }

    /**
     *
     * Método para inserir na base de dados um Objeto
     *
     * @return array | boolean
     */
    public function recuperar($sNomeClasse, $vWhere=null, $sOrderBy='', $sCampos=null) {
        eval('$oObjetoClasse = new $sNomeClasse();');
        $oPersistencia = new Persistencia($oObjetoClasse);
        $sComplemento = !empty($vWhere)?$this->montaArrayComplemento($vWhere):'';
        $sComplemento .= ' '.$sOrderBy;          
        if($voObjetoClasse = $oPersistencia->consultar($sCampos, $sComplemento))
            return $voObjetoClasse;
        return false;
    }

    /**
     *
     * Método para inserir na base de dados um Objeto
     *
     * @return int | boolean
     */
    public function inserir($oObjeto) {
        $oPersistencia = new Persistencia($oObjeto);
        if($nId = $oPersistencia->inserir())
            return $nId;
        return false;
    }

    /**
     *
     * Método para alterar na base de dados um Objeto
     *
     * @return boolean
     */
    public function alterar($oObjeto) { 
        $oPersistencia = new Persistencia($oObjeto);
        if($oPersistencia->alterar())
            return true;
        return false;
    }

    /**
     *
     * Método para excluir da base de dados um Objeto
     *
     * @return boolean
     */
    public function excluir($sNomeClasse, $nId) {
        eval('$oObjetoClasse = new $sNomeClasse();');
        $oPersistencia = new Persistencia($oObjetoClasse);
        if($oPersistencia->excluir($nId))
            return true;
        return false;
    }

    /**
     *
     * Método para excluir da base de dados um Objeto
     *
     * @return boolean | array
     */
    public function executarQuery($sQuery) {   
        if($voResult = Persistencia::executar($sQuery))
            return $voResult;
        return false;
    }

    /**
     *
     * Método para excluir da base de dados um Objeto
     *
     * @return boolean | array
     */
    public function executarProcedure($sQuery) {   
        if($voResult = Persistencia::executarProcedure($sQuery))
            return $voResult;
        return false;
    }


    /*
     * Este método exclui fisicamente um registro caso o usuário tenha o perfil de administrador,
     * caso ele não possua esse perfil tenta fazer a exclusão lógica verificanso se a classe possui
     * um campo com sufixo _ativo ou _inativo, caso a tabela não possua esses campos faz a exclusão fisica.

     * NOTA Essa função foi feita para substituir a exclusão lógica realizada pelos métodos da versão anterior do fachada,
     * pois o método anterior exigia que todas as tabelas possuissem o campo 'aco_Inativa', padrão que não é mais utilizado pelas tabelas.
     */
    public function excluirDesativar($sNomeClasse, $nId) {       //implementar array $vWhere como argumento também..
        eval('$oObjetoClasse = new $sNomeClasse();');
        
        $oPersistencia = new Persistencia($oObjetoClasse);
//var_dump($oObjetoClasse, $oPersistencia); die();
//Rever esse if, aparentemente defasado
        if($_SESSION['oUsuario#SISTEMA#'] && $_SESSION['oUsuario#SISTEMA#']->getCodGrupoUsuario() == '1')
            if($oPersistencia->excluir($nId)) 
                return true;
//----------------------------------
        if($oPersistencia->excluirDesativar($nId))
            return true;
        
        return false;
    }


}
?>