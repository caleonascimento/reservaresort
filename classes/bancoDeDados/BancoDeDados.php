<?php

class BancoDeDados {

    private $sSGBD;
    private $sBanco;
    private $sServidor;
    private $sUsuario;
    private $sSenha;
    private $oPDO;

    public function __construct($sSGBD='mysql') {
        $this->sSGBD = $sSGBD;
        $this->sBanco = BANCO;
        $this->sServidor = SERVIDORBD;
        $this->sUsuario = USUARIOBD;
        $this->sSenha = SENHABD;
    }

   public function iniciaConexaoBanco() {
        try { 
            if(empty($this->oPDO)) { //MYSQL
                if($this->sSGBD == 'mysql'){
                    $this->oPDO = new PDO($this->sSGBD.":dbname=".$this->sBanco.";charset=utf8;host=".$this->sServidor,$this->sUsuario,$this->sSenha);
                }elseif($this->sSGBD == 'sqlsrv') //SQLSERVER
                    $this->oPDO = new PDO ("$this->sSGBD:Server=$this->sServidor;Database=$this->sBanco","$this->sUsuario","$this->sSenha");

                $this->oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                     
            }
            return true;
        } catch(PDOException $e) { 
            var_dump($e->getMessage()); 
            die();
            return false;  //Fazer método para tratar exceções futuramente e gerar log
        }
    }

    public function terminaConexaoBanco() {
        unset($this->oPDO);
    }

    public function recuperaRegistrosFuncaoDoBanco($sNomeProcedure, $sComplemento) {
        return $this->processarOperacao("RECUPERAR", $sNomeProcedure, '*', '('.$sComplemento.')');
    }

    /**
     * O argumento vArray por padrão retorna um objeto Statement, caso a variavel seja
     * setada como 'true' retorna um array de objetos.
     */
    public function executarSQL($sSql) {
        try {
            $result = false;
            $bReturn = (stripos($sSql, 'DELETE')===false && (stripos($sSql, 'UPDATE')===false)) ? true : false; //Habilita o retorno pelo método

            //var_dump($bReturn); die();
            if($this->iniciaConexaoBanco()) {
                  if($oStmt = $this->oPDO->query($sSql) )
                     if($bReturn)
                        while ($oReg = $oStmt->fetchObject())
                            $result[] = $oReg;

                $this->terminaConexaoBanco();
            }
            return $result;

        } catch (PDOException $e) {
           var_dump($e->getMessage()); die();
            //Fazer método para tratar exceções futuramente e gerar log
        }
    }
    /**
     *
     * Método para excluir da base de dados um Objeto
     *
     * @return boolean | array
     */
    public function executarProcedure($sQuery) {   
        try {
            if($this->iniciaConexaoBanco()) {
                if($stmt= $this->oPDO->prepare($sQuery)) {
                    $success = $stmt->execute();

                    $this->terminaConexaoBanco();

                    if($success) 
                        return true;
                    else 
                        return false;
                } else
                    return false;
            }
        } catch (PDOException $e) {
            var_dump($e->getMessage()); die();
        }
    }




    // Função genérica que faz a montagem e execução da query no drive PDO
    // Retorna um valor mixto ou false
    public function processarOperacao($sOperacao, $sTabela, $sCampos, $sComplemento=null, $vArquivos=array()) {
        try {
            $sOperacao = strtoupper($sOperacao); //Converte todos os caracteres para maiúsculo
            $result = false;
            if($this->iniciaConexaoBanco()) {
                switch($sOperacao) {
                    //---------------------------------------------------------------------
                    case "RECUPERAR":
                    /*if($sTabela != 'acesso_modulo_transacao') {
                        echo "SELECT $sCampos FROM $sTabela $sComplemento" . "<br>";
                        die();
                    }*/
                        if($oStmt = $this->oPDO->query("SELECT $sCampos FROM $sTabela $sComplemento")){
                            while ($oReg = $oStmt->fetchObject())
                                 $result[] = $oReg;
                               return $result;
                        }

                        break;
                    //---------------------------------------------------------------------
                    case "INSERIR":
                        //Verifica se algum arquivo está sendo inserido na base de dados
                        $sCampoArquivo = $sArquivo = '';
                        if($vArquivos) {
                            foreach($vArquivos as $nomeCampo=>$binArquivo) {
                                $sCampoArquivo .= ', '.$nomeCampo;
                                $sArquivo .= ", CONVERT(VARBINARY(max),'$binArquivo')";
                            }
                        }
                        $sSql = "INSERT INTO $sTabela ($sCampos $sCampoArquivo) VALUES ($sComplemento $sArquivo)";
                        //echo $sSql . "<br>"; die();
                        /*if($this->oPDO->query($sSql))
                            $result = $this->oPDO->lastInsertId();*/

                        $this->oStmt = $this->oPDO->query($sSql);
                  		$bResultado = ($this->oStmt) ? true : false;
                  		$nId = $this->oPDO->lastInsertId();
                  		$this->terminaConexaoBanco();

			                   //LogCaminho::escreverCaminho("INSERT INTO $sTabela($sCampos) VALUES ($sValores)");
               			if($nId)
               				return $nId;
               			else
               				return $bResultado;
                        break;
                    //---------------------------------------------------------------------
                    case "ALTERAR":
                        if(stristr($sComplemento, "WHERE"))
                            $sSql = "UPDATE $sTabela SET $sCampos $sComplemento";
                            if($this->oPDO->query($sSql))
                                $result = true;
                        break;
                    //---------------------------------------------------------------------
                    case "EXCLUIRFISICAMENTE":
                        if(stristr($sComplemento, "WHERE"))
                           $sSql = "DELETE FROM $sTabela $sComplemento";
                           // echo $sSql; die();
                            if($this->oPDO->query($sSql))
                                $result = true;
                        break;
                    //---------------------------------------------------------------------
                    case "INSERIR_ARQUIVO":   //Método não testado ainda... (não utilizado)
                        if($vArquivos) {
                            $sCampoArquivo = '';
                            $sArquivo = '';
                            foreach($vArquivos as $nomeCampo=>$binArquivo) {
                                $sCampoArquivo .= $nomeCampo.',';
                                $sArquivo .= "CONVERT(VARBINARY(max),'$binArquivo'),";
                            }
                            $sCampoArquivo = substr($sCampoArquivo, 0, -1);
                            $sArquivo = substr($sArquivo, 0, -1);

                            if($this->oPDO->query("INSERT INTO $sTabela($sCampos, $sCampoArquivo) VALUES ($sComplemento, CONVERT(VARBINARY(max),'$sArquivo'))"))
                                $result = $this->oPDO->lastInsertId();
                        }
                        break;
                    //---------------------------------------------------------------------
                    default:
                        return false;
                        break;
                }
                $this->terminaConexaoBanco();
            }
            return $result;

        } catch (PDOException $e) {
            //Fazer método para tratar exceções futuramente e gerar log
            var_dump($e->getMessage()); die();
        }
    }

}
?>
