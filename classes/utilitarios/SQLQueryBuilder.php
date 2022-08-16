<?php
/* ***********************************************************************************
    Created by: Caléo Reis Nascimento
    Date: 12/02/2020
    Description:
        Classe para monstar SQLs customizadas apartir de objetos e métodos. Esse modelo
        evita equivocos e erros em montagens de consultas sqls, como por exemplo uma
        query delete ou update sem a clausala where, a classe realiza validações e monta
        a sql retornando apenas uma string da query para ser executada pela classse
        responsável pelas consultas ao banco.
************************************************************************************* */

class SQLQueryBuilder {

    private $sQuery;
    private $vFieds;
    private $sTable;
    private $sWhere;
    private $sCompl;
    private $sOp;

    public function __construct($sTable=null) {
          $this->sQuery = null;
          $this->sTable = $sTable;
          $this->sWhere = null;
          $this->sOP = null;
          $this->sCompl = null;
    }

    //Método Select
    public function select($vFields=array('*')) {
        $this->sOP = "select";
        $this->vFields = $vFields;
        $this->sQuery = "SELECT ".$this->getFields();
        return $this;
    }

    //Este método é necessário caso o nome da tabela não tenha sido informado pelo construtor.
    public function from($sTable) {
         $this->sTable = $sTable;
         return $this;
    }

    /* ***********************************************************************
     Seta os campos de retorno da query através do array $vFields.
     O array pode ser chaveado ou não, quando chaveado pode ser definido um alias,
     quando não chaveado pode ser inserido um alias através de string.
     Segue o modelo das estrutras possíveis do parâmetro $vFields:
              array(
                    'field1'=>'alias',
                    "field2",
                    "field3 as alias2, field4 [,..]"
               )
    */
    private function getFields() {
        if(empty($this->vFields) || !is_array($this->vFields))
            return false;
        $sReturn = '';
        foreach($this->vFields as $sField=>$sAlias)
            if(!is_numeric($sField))
                $sReturn .= $sField.' as '.$sAlias.', ';
            else
                $sReturn .= $sAlias.', ';
        //Remove a ultima virgula
        return substr($sReturn, 0, -2);
    }

    /* ***********************************************************************************
    O método where monta a clausula quere da query através do argumento array $vWhere.
    O argumento deste método aceita um array com os dados em vários formatos diferentes.
    A estrutura do array pode ser enviada em 4 modos diferentes:
                array (
    Tipo 1:          "field1 <> value",
    Tipo 2:          array(
                          "column" => "columnName",       //* Paramêtro obrigatório
                          "operator" => "<>",            //Opcional (operador default "=")
                          "value" => value              //* Paramêtro obrigatório
                        ),
    Tipo 3:          "field2" => value,
    Tipo 4:          "field3" => array (
                                  "column" => "columnName", //Opcional (campo default "field3")
                                  "operator" => "<>",      //Opcional (operador default "=")
                                  "value" => value        //* Paramêtro obrigatório
                                  )
                  )
    */
    public function where($vWhere) {
        if(empty($vWhere) || !is_array($vWhere))
            return false;

        //Monta a clausula 'Where'
        foreach($vWhere as $field => $value){
            //Verifica se a chave é numérica, para os caso que a chave do array não é definida:
            if(is_numeric($field)) {
                //Verifica se o valor da chave é um array, para o 2° tipo de implementação do array, ex.: array(array()[,..]).
                if(is_array($value)) {
                    $col = $val = null;  //Iniciando variaveis auxiliares
                    $op = " = "; //Valor default para o operador
                    foreach($value as $k=>$v)
                         switch($k) {
                             case 'column':
                                $col = $v;
                             break;
                             case 'operator':
                                $op = $v;
                             break;
                             case 'value':
                                $val = "'".$v."'";
                             break;
                         }
                    //Nesse caso column e value são obrigatórios
                    if(empty($col) || empty($val))
                        return false;

                    $this->sWhere .= $col . $op . $val . " AND ";
                } else
                   $this->sWhere .= $value.' AND ';
            //Quando a chave do array é definida:
            } else {
                if(is_array($value)) {
                    $val = null;  //Iniciando variaveis auxiliares
                    $col = $field;
                    $op = " = "; //Valor default para o operador
                    foreach($value as $k=>$v)
                         switch($k) {
                             case 'column':
                                $col = $v;
                             break;
                             case 'operator':
                                $op = $v;
                             break;
                             case 'value':
                                $val = "'".$v."'";
                             break;
                         }
                    //Nesse caso apenas value é obrigatórios
                    if(empty($val))
                        return false;

                    $this->sWhere .= $col . $op . $val . " AND ";

                } else
                    $this->sWhere .= $field."='".$value."' AND ";
            }

        }
        //Adiciona a clausula 'WHERE' e remove o ultimo 'AND'
        $this->sWhere = " WHERE " . substr($this->sWhere, 0, -4);

        return $this;
    }

    //Nao terminado...
    public function _or($vWhere) {
         $this->sWhere .= "OR (";

         foreach($vWhere as $field => $value) {
               $this->sWhere .= $field."=".$value;
         }
         $this->sWhere .= ")";
         return $this;
    }

    /* *********************************************************************************
    Método Insert
    Este método recebe como argumento um array no formato 'chave'=>valor, onde 'chave' é o
    nome da coluna (campo da tabela). O segundo parametro é opcional, porém caso não
    informado subentende-se que ele foi informado no construtor.
    */
    public function insert($vFields, $sTable=null) {
        if(empty($vFields) || !is_array($vFields))
            return false;

        if(!empty($sTable))
            $this->sTable = $sTable;

        $this->sOP = "insert";
        $sFields = $sValues = '';
        foreach($vFields as $sField=>$sValue) {
             $sFields .= $sField.',';
             $sValues .= "'".$sValue."',";
        }
        $this->sQuery = "INSERT INTO ";
        $this->sCompl = "(".substr($sFields,0,-1).") VALUES (".substr($sValues,0,-1).")";
    }

    //Método Update
    //O argumento $vFields é uma variável no formato array('key'=>value).
    public function update($vFields) {
        if(empty($vFields) || !is_array($vFields))
            return false;

        $this->sOP = "update";
        $this->sQuery = " SET ";
        $sFields = $sValues = '';
        foreach($vFields as $sField=>$sValue)
              $this->sQuery .= $sField . "= '".$sValue."', ";
        //Remove a ultima virgula
        $this->sQuery =  substr($this->sQuery, 0, -2);
    }

    //Método Delete
    public function delete($vWhere=null) {
        $this->sOP = "delete";
        if($vWhere)
             $this->where($vWhere);
         $this->sQuery = "DELETE ";
    }

    /* *******************************************************************************
       Método Exec (Procedure):
       Este método gera uma query para executar procedure no formato "EXEC tabela ['complem1 complem2 ...']".
       Os parâmetros da procedure não são obrigatórios, porém é caso não sejam informados
       é necessário ainda informar a tabela no construtor da classe.  O primeiro parâmetro
       $vFields é uma variável no formato array(valor [, '@campo'=>"valor"])
    */
    public function procedure($vFields=null, $sTable=null) {
        $this->sOP = "procedure";
        $this->sCompl = null;

        if(!empty($sTable))
            $this->sTable = $sTable;

        if($vFields && is_array($vFields)) {
            foreach($vFields as $key=>$sValue)
                if(is_numeric($key))
                    $this->sCompl .= $sValue.', ';
                else
                   $this->sCompl .= $key . "='".$sValue."', ";
        }
        $this->sQuery = "EXEC ";
        $this->sCompl = ' '.substr($this->sCompl, 0, -2);
    }

    /* ********************************************************************************
        Método monta a ordenação da consulta adicionando a clausula ORDER BY campo1 [,...]
        ao final da consulta.
        O argumento $vFields é aceito somente como um array no formato:
        array("campo1" [, 'campo2'=>"ASC|DESC"])
    */
    public function orderBy($vFields) {
         if(empty($vFields) || !is_array($vFields))
             return false;

         foreach($vFields as $k=>$v)
             if(is_numeric($k))
                 $this->sCompl .= $v.', ';
             else
                $this->sCompl .= $k.' '.$v.', ';
         //Remove a ultima virgula
         $this->sCompl = substr($this->sCompl, 0, -2);
         $this->sCompl = " ORDER BY ".$this->sCompl;
    }


    /* *********************************************************************************
    */
    public function join() {

    }

    /* *********************************************************************************
        Para incluir a clausula UNION os campos de retorno da sql devem ser os mesmos para
        todas as querys unificadas, assim o método deve garantir que o alias dos campos de
        retorno da sql tenham o mesmo nome e a mesma quantidade de campos.
        O argumento do método deve receber um objeto instanciado da mesma classe
    */
    public function union($oSQLQueryBuilder) {

    }


    //Método build faz as devidas validações e monta a query retornando uma string da mesma.
    public function build() {
        if(empty($this->sQuery) || empty($this->sTable))
            return false;

        switch($this->sOP) {
            case 'select':
                 $sReturn = $this->sQuery." FROM ".$this->sTable.$this->sWhere.$this->sCompl;
            break;
            case 'insert':
                $sReturn = $this->sQuery.$this->sTable.$this->sCompl;
            break;
            case 'update':
                if(empty($this->sWhere))
                    return false;
                $sReturn = "UPDATE ".$this->sTable.$this->sQuery.$this->sWhere;
            break;
            case 'delete':
                if(empty($this->sWhere))
                    return false;
                $sReturn = $this->sQuery." FROM ".$this->sTable.$this->sWhere;
            break;
            case 'procedure':
                $sReturn = $this->sQuery.$this->sTable.$this->sCompl;
            break;
        }

        unset($this->sWhere);
        unset($this->sCompl);

        return $sReturn;
    }
}
?>