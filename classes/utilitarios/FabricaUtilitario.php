<?php
class FabricaUtilitario implements IUtilitario{
	
	public function __construct(){
	
	}
	
	public static function getUtilitario($sUtilitario){
		switch($sUtilitario){
			case "Upload":
				return new Upload();
			break;
			case "Validate":
				return new Validate();
			break;
			case "Data":
				return new Data();
			break;
		}
	}
}
?>