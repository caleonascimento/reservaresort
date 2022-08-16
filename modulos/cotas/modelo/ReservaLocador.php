<?php
 /**
  * @author Auto-Generated 
  * @SGBD mysql 
  * @tabela reserva_locador 
  */
 class ReservaLocador{
 	/**
	* @campo id
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nId;
	/**
	* @campo id_reserva_cota
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdReservaCota;
	/**
	* @campo id_usuario
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdUsuario;
	private $oReservaCota;
	private $oUsuario;
	
 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setId($nId) {
		$this->nId = $nId;
	 }
	 public function getId() {
		return $this->nId;
	 }
	 public function setIdReservaCota($nIdReservaCota) {
		$this->nIdReservaCota = $nIdReservaCota;
	 }
	 public function getIdReservaCota() {
		return $this->nIdReservaCota;
	 }
	 public function setIdUsuario($nIdUsuario) {
		$this->nIdUsuario = $nIdUsuario;
	 }
	 public function getIdUsuario() {
		return $this->nIdUsuario;
	 }
	public function setReservaCota($oReservaCota) {
		$this->oReservaCota = $oReservaCota;
	}
	public function getReservaCota() {
		$oController = new Controller();
		if($this->oReservaCota = $oController->recuperar('ReservaCota', array('id_reserva_cota'=>$this->getIdReservaCota())))
				return $this->oReservaCota[0];
		return false;
	}
	public function setUsuario($oUsuario) {
		$this->oUsuario = $oUsuario;
	}
	public function getUsuario() {
		$oController = new Controller();
		if($this->oUsuario = $oController->recuperar('Usuario', array('id_usuario'=>$this->getIdUsuario())))
				return $this->oUsuario[0];
		return false;
	}
 }
 ?>
