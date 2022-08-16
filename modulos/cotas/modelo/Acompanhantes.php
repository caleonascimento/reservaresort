<?php
 /**
  * @author Auto-Generated 
  * @SGBD mysql 
  * @tabela acompanhantes 
  */
 class Acompanhantes{
 	/**
	* @campo id
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nId;
	/**
	* @campo nome
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sNome;
	/**
	* @campo cpf
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nCpf;
	/**
	* @campo data_nasc
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $dDataNasc;
	/**
	* @campo id_reserva_locador
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdReservaLocador;
	private $oReservaLocador;
	
 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setId($nId) {
		$this->nId = $nId;
	 }
	 public function getId() {
		return $this->nId;
	 }
	 public function setNome($sNome) {
		$this->sNome = $sNome;
	 }
	 public function getNome() {
		return $this->sNome;
	 }
	 public function setCpf($nCpf) {
		$this->nCpf = $nCpf;
	 }
	 public function getCpf() {
		return $this->nCpf;
	 }
	 public function setDataNasc($dDataNasc) {
		$this->dDataNasc = $dDataNasc;
	 }
	 public function getDataNasc() {
		return $this->dDataNasc;
	 }
	 public function getDataNascFormatado() {
		if($this->dDataNasc) {
			$oData = new DateTime($this->dDataNasc);
			 return $oData->format("d/m/Y");
		}
	 }
	 public function setDataNascBanco($dDataNasc=null) {
		 if($dDataNasc) {
			 $oData = DateTime::createFromFormat('d/m/Y', $dDataNasc);
			 $this->dDataNasc = $oData->format('Y-m-d') ;
		 } else 
				$this->dDataNasc = date("Y-m-d H:i:s");
		}
	 public function setIdReservaLocador($nIdReservaLocador) {
		$this->nIdReservaLocador = $nIdReservaLocador;
	 }
	 public function getIdReservaLocador() {
		return $this->nIdReservaLocador;
	 }
	public function setReservaLocador($oReservaLocador) {
		$this->oReservaLocador = $oReservaLocador;
	}
	public function getReservaLocador() {
		$oController = new Controller();
		if($this->oReservaLocador = $oController->recuperar('ReservaLocador', array('id_reserva_locador'=>$this->getIdReservaLocador())))
				return $this->oReservaLocador[0];
		return false;
	}
 }
 ?>
