<?php
class FactoryControle{

    public function __construct(){

    }

    public function getObject($sClasse){
        eval("\$oControle = new ".$sClasse."CTR();");
        return $oControle;
    }
}
?>