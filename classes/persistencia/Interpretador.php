<?php
class Interpretador{

    /**
     * Variavel Descritor
     * @var Descritor
     */
    private $oDescritor;
    /**
     * Variavel Objeto
     * @var Object
     */
    private $oObjeto;

    /**
     * Método Construtor retornando um objeto Interpretador com o atributo $oDescritor setado
     * @return Interpretador
     * @param Object $oObjeto
     */
    public function __construct($oObjeto){
        $this->recuperarDescricaoClasse($oObjeto);
        $this->oObjeto = $oObjeto;
    }

    public function setTabela($tabela) {
            $this->oDescritor->setTabela($tabela);
    }
    /**
     * Método para recuperar descrição de persistencia
     * @return void
     * @param Object $oObjeto
     */
    private function recuperarDescricaoClasse($oObjeto){
        $voCampoTabela = array();
        $voAtributoClasse = array();
        $bAchouTabela = false;
        $bAchouSGBD = false;
        $this->oDescritor = new Descritor();
        $oReflectionObject = new ReflectionObject($oObjeto);

        $this->oDescritor->setClasse($oReflectionObject->getName());
        $sComentarioClasse = $oReflectionObject->getDocComment();

        $vComentarioClasse = explode("\n",$sComentarioClasse);

        foreach($vComentarioClasse as $sLinhaComentario){
            $sLinhaComentario = trim($sLinhaComentario);
            if(substr($sLinhaComentario,0,1) == "*"){
                $sLinhaComentario = substr($sLinhaComentario,1,strlen($sLinhaComentario));
                $sLinhaComentario = trim($sLinhaComentario);

                $vLinhaComentario = explode(" ",$sLinhaComentario);

                foreach($vLinhaComentario as $sParteComentario){
                    $sParteComentario = trim($sParteComentario);

                    if($bAchouTabela){
                        $this->oDescritor->setTabela($sParteComentario);
                        $bAchouTabela = false;
                    }
                    if($sParteComentario == "@tabela")
                        $bAchouTabela = true;

                    if($bAchouSGBD){
                        $this->oDescritor->setSGBD($sParteComentario);
                        $bAchouSGBD = false;
                    }
                    if($sParteComentario == "@SGBD")
                        $bAchouSGBD = true;
                }
            }
        }


        $voReflectionProperty = $oReflectionObject->getProperties();
        foreach($voReflectionProperty as $oReflectionProperty){
            $oAtributoClasse = new AtributoClasse();
            $oCampoTabela = new CampoTabela();
            $bAchouVar = false;
            $bAchouCampo = false;
            $bAchouPrimario = false;
            $bAchouAuto = false;
            $bAchouNulo = false;

            $oAtributoClasse->setNome($oReflectionProperty->getName());

            $sComentarioAtributo = $oReflectionProperty->getDocComment();
            $vComentarioAtributo = explode("\n",$sComentarioAtributo);
            foreach($vComentarioAtributo as $sLinhaComentario){
                $sLinhaComentario = trim($sLinhaComentario);
                if(substr($sLinhaComentario,0,1) == "*"){
                    $sLinhaComentario = substr($sLinhaComentario,1,strlen($sLinhaComentario));
                    $sLinhaComentario = trim($sLinhaComentario);
                    $vLinhaComentario = explode(" ",$sLinhaComentario);
                    foreach($vLinhaComentario as $sParteComentario){
                        $sParteComentario = trim($sParteComentario);
                        if($bAchouVar){
                            $oCampoTabela->setTipo($sParteComentario);
                            $bAchouVar = false;
                        }
                        if($sParteComentario == "@var")
                            $bAchouVar = true;

                        if($bAchouCampo){
                            $oCampoTabela->setNome($sParteComentario);
                            $bAchouCampo = false;
                        }
                        if($sParteComentario == "@campo")
                            $bAchouCampo = true;

                        if($bAchouPrimario){
                            $oCampoTabela->setCampoPrimario(($sParteComentario == "true") ? true : false);
                            $bAchouPrimario = false;
                        }
                        if($sParteComentario == "@primario")
                            $bAchouPrimario = true;

                        if($bAchouAuto){
                            $oCampoTabela->setAuto(($sParteComentario == "true") ? true : false);
                            $bAchouAuto = false;
                        }
                        if($sParteComentario == "@auto-increment")
                            $bAchouAuto = true;

                        if($bAchouNulo){
                            $oCampoTabela->setNulo(($sParteComentario == "true") ? true : false);
                            $bAchouNulo = false;
                        }
                        if($sParteComentario == "@nulo")
                            $bAchouNulo = true;
                    }
                }
            }
            if($oCampoTabela->getNome() && $oCampoTabela->getTipo()){
                array_push($voAtributoClasse,$oAtributoClasse);
                array_push($voCampoTabela,$oCampoTabela);
            }
        }
        $this->oDescritor->setAtributoClasse($voAtributoClasse);
        $this->oDescritor->setCampoTabela($voCampoTabela);

    }
    /**
     * Método para recuperar o SGBD onde o objeto ser? persistido
     *
     * @return String
     */
    public function recuperarSGBD(){
        if($this->oDescritor)
            return $this->oDescritor->getSGBD();
        return false;
    }
    /**
     * Método para recuperar a tabela no banco do objeto a ser persistido
     *
     * @return String
     */
    public function recuperarTabela(){
        if($this->oDescritor)
            return $this->oDescritor->getTabela();
        return false;
    }
    /**
     * Método para recuperar a string de campos no banco de dados correspondente ao objeto a ser persistido
     *
     * @return String
     */
    public function recuperarCamposInserir(){
        if($this->oDescritor){
            foreach($this->oDescritor->getCampoTabela() as $oCampoTabela){
                if(!$oCampoTabela->getAuto()){
                    $sCamposInserir .= $sVirgula.$oCampoTabela->getNome();
                    $sVirgula = ",";
                }
            }
            return $sCamposInserir;
        }
        return "";
    }
    /**
     * Método para recuperar a string de valores de campos no banco de dados correspondentes ao objeto a ser persistido
     *
     * @return String
     */
    public function recuperarCamposInserirValores(){
        if($this->oDescritor){
            foreach($this->oDescritor->getCampoTabela() as $nIndice => $oCampoTabela){
                if(!$oCampoTabela->getAuto()){
                    $voAtributoClasse = $this->oDescritor->getAtributoClasse();
                    $oAtributoClasse = $voAtributoClasse[$nIndice];
                    $sNomeMetodo = "get".substr($oAtributoClasse->getNome(),1,strlen($oAtributoClasse->getNome())-1);
                    $sValor = $this->oObjeto->$sNomeMetodo();

                    $sAspas = "";
                    if($oCampoTabela->getTipo() == "String"){
                        if(!$sValor){
                            $sAspas = "";
                            $sValor = "null";
                        }else{
                            $sAspas = "'";
                        }

                        $sValor = str_replace("'","",$sValor);

                    }elseif($oCampoTabela->getTipo() == "data"){
                        if(!$sValor){
                            $sAspas = "";
                            $sValor = "null";
                        }else{
                            $sAspas = "'";
                        }

                    }elseif($oCampoTabela->getTipo() == "number" && $sValor == ""){
                        $sValor = "null";

                    }elseif($oCampoTabela->getTipo() == "zero" && ($sValor == "")||($sValor == "null")){
                        $sValor = "0";

                    }elseif($oCampoTabela->getTipo() == "boolean" && $sValor == ""){
                        $sValor = "null";
                    }

                    $sCamposInserirValores .= $sVirgula.$sAspas.$sValor.$sAspas;

                    $sVirgula = ",";
                }
            }
            return $sCamposInserirValores;
        }
        return "";
    }
    /**
     * Método para recuperar a string de valores de campos no banco de dados correspondentes ao objeto a ser persistido
     *
     * @return String
     *
     */
    public function recuperarCamposAlterar(){
        $sCamposAlterar =  $sVirgula = '';
        if($this->oDescritor){
            foreach($this->oDescritor->getCampoTabela() as $nIndice => $oCampoTabela){
                $voAtributoClasse = $this->oDescritor->getAtributoClasse();
                $oAtributoClasse = $voAtributoClasse[$nIndice];
                $sNomeMetodo = "get".substr($oAtributoClasse->getNome(),1,strlen($oAtributoClasse->getNome())-1);
                $sValor = $this->oObjeto->$sNomeMetodo();

      /*
        NOTA de Alteração:
        Data: 24/01/2020 - Caléo Reis
        Foram comentados os campos que atribuiam o valor nulo para os SET da query UPDATE,
        essas alterações permitem que seja setado apenas os campos que serão alterados na query,
        pois anteriormente caso setado apenas uma variavel na alteração as outras eram incluidas na query com valor null.
        Caso essas alterações apresentem algum problema basta descomenta-las.
       */
                $sAspas = "";
                if($oCampoTabela->getTipo() == "String"){
                    if(!$sValor){
                        //$sAspas = "";
                        //$sValor = "null";
                    }else{
                        $sAspas = "'";
                    }
                    $sValor = str_replace("'","",$sValor);
                }elseif($oCampoTabela->getTipo() == "data"){
                    if(!$sValor){
                        //$sAspas = "";
                        //$sValor = "null";
                    }else{
                       $sAspas = "'";
                    }
                }elseif($oCampoTabela->getTipo() == "number" && $sValor === ""){
                        //$sValor = "null";
                }elseif($oCampoTabela->getTipo() == "zero" && ($sValor == "")||($sValor == "null")){
                        $sValor = "0";
                }elseif($oCampoTabela->getTipo() == "boolean" && $sValor == ""){
                        //$sValor = "null";
                }

                if(!$oCampoTabela->getCampoPrimario() && $sValor != NULL && $sValor != ""){
                    $sCamposAlterar .= $sVirgula.$oCampoTabela->getNome()."=".$sAspas.$sValor.$sAspas;
                    $sVirgula = ",";
                }
            }
            return $sCamposAlterar;
        }
        return "";
    }

    /**
     * Este método genérico monta uma clausula Where com o id primário único do campo da tabela para
     * os casos de chamadas genéricas à classe onde não se sabe qual o nome do campo primário.
     * Para estes casos a classe deve ser instanciado vazia e o id passado posteriormente para o método.
     */
    public function montaWhereIdCampo($nId) {
         if(!$this->oDescritor || !$this->getDescritor()->getCampoTabela()[0]->getCampoPrimario())
             return false;
         return "WHERE ".$this->getDescritor()->getCampoTabela()[0]->getNome()."=".$nId;
    }

    //Método genérico para setar o ID na classe objeto diretamente
    public function setId($nId) {
         if(!$this->oDescritor || !$this->getDescritor()->getCampoTabela()[0]->getCampoPrimario())
             return false;
         $oAtributoClasse = $this->getDescritor()->getAtributoClasse()[0]; //Pega o atributo da classe
         $sNomeMetodo = "set".substr($oAtributoClasse->getNome(),1,strlen($oAtributoClasse->getNome())-1); //Monta o método set para o atributo
         $this->getObjeto()->$sNomeMetodo($nId);
    }

    /**
     * Método para recuperar a string de valores de campos no banco de dados correspondentes ao objeto a ser persistido
     *
     * @return String
     */
    public function recuperarWhereCamposPrimario(){
        $sWhereCamposPrimario = false;
        $sAnd = '';
        if($this->oDescritor)
            foreach($this->oDescritor->getCampoTabela() as $nIndice => $oCampoTabela) {
                $voAtributoClasse = $this->oDescritor->getAtributoClasse();
                $oAtributoClasse = $voAtributoClasse[$nIndice];
                $sNomeMetodo = "get".substr($oAtributoClasse->getNome(),1,strlen($oAtributoClasse->getNome())-1);
                $sValor = $this->oObjeto->$sNomeMetodo();
                $sAspas = "";
                if($oCampoTabela->getTipo() == "String")
                    $sAspas = "'";

                if($oCampoTabela->getCampoPrimario() && $sValor){
                    $sWhereCamposPrimario .= $sAnd.$oCampoTabela->getNome()."=".$sAspas.$sValor.$sAspas;
                    $sAnd = " AND ";
                }
            }
        if($sWhereCamposPrimario)
             $sWhereCamposPrimario = "WHERE ".$sWhereCamposPrimario;

        return $sWhereCamposPrimario;
    }
    /**
     * Recupera vetor de objetos de acordo com uma consulta no banco
     *
     *
     */
    public function recuperarVetorObjetos($rsBanco) {
        if($this->oDescritor && $rsBanco){
            $voObjeto = array();
            foreach($rsBanco as $oReg){
                $sNomeClasse = $this->oDescritor->getClasse();
                $oObj = new $sNomeClasse();
                foreach($this->oDescritor->getCampoTabela() as $nIndice => $oCampoTabela){
                    $voAtributoClasse = $this->oDescritor->getAtributoClasse();
                    $oAtributoClasse = $voAtributoClasse[$nIndice];
                    $sNomeMetodo = "set".substr($oAtributoClasse->getNome(),1,strlen($oAtributoClasse->getNome())-1);
                    $sNomeCampo = $oCampoTabela->getNome();
                    $oObj->$sNomeMetodo($oReg->$sNomeCampo);
                }
                array_push($voObjeto,$oObj);
            }
            return $voObjeto;
        }
        return false;
    }

    public function getDescritor(){
        return $this->oDescritor;
    }

    public function getObjeto(){
        return $this->oObjeto;
    }

    //Verifica e recupera o indice do campo com o nome: _ativo(a) ou _inativo(a), quando a tabela possuir.
    public function recuperarIndiceCampoAtivoInativo() {
         foreach($this->getDescritor()->getCampoTabela() as $i=>$oCampoTabela)
            if(stristr($oCampoTabela->getNome(), "ativ") && ($oCampoTabela->getTipo() == "number" || $oCampoTabela->getTipo() == "boolean" || $oCampoTabela->getTipo() == "int" || $oCampoTabela->getTipo() == "bit"))
                return $i;
         return false;
    }

}
?>