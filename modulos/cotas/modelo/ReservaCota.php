<?php
 /**
  * @author Auto-Generated 
  * @SGBD mysql 
  * @tabela reserva_cota 
  */
 class ReservaCota{
 	/**
	* @campo id
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nId;
	/**
	* @campo periodo_ini
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $dPeriodoIni;
	/**
	* @campo periodo_fim
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $dPeriodoFim;
	/**
	* @campo id_cota
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdCota;
	/**
	* @campo locacao
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sLocacao;
	private $oCota;
	
 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setId($nId) {
		$this->nId = $nId;
	 }
	 public function getId() {
		return $this->nId;
	 }
	 public function setPeriodoIni($dPeriodoIni) {
		$this->dPeriodoIni = $dPeriodoIni;
	 }
	 public function getPeriodoIni() {
		return $this->dPeriodoIni;
	 }
	 public function getPeriodoIniFormatado() {
		if($this->dPeriodoIni) {
			$oData = new DateTime($this->dPeriodoIni);
			 return $oData->format("d/m/Y");
		}
	 }
	 public function setPeriodoIniBanco($dPeriodoIni=null) {
		 if($dPeriodoIni) {
			 $oData = DateTime::createFromFormat('d/m/Y', $dPeriodoIni);
			 $this->dPeriodoIni = $oData->format('Y-m-d') ;
		 } else 
				$this->dPeriodoIni = date("Y-m-d H:i:s");
		}
	 public function setPeriodoFim($dPeriodoFim) {
		$this->dPeriodoFim = $dPeriodoFim;
	 }
	 public function getPeriodoFim() {
		return $this->dPeriodoFim;
	 }
	 public function getPeriodoFimFormatado() {
		if($this->dPeriodoFim) {
			$oData = new DateTime($this->dPeriodoFim);
			 return $oData->format("d/m/Y");
		}
	 }
	 public function setPeriodoFimBanco($dPeriodoFim=null) {
		 if($dPeriodoFim) {
			 $oData = DateTime::createFromFormat('d/m/Y', $dPeriodoFim);
			 $this->dPeriodoFim = $oData->format('Y-m-d') ;
		 } else 
				$this->dPeriodoFim = date("Y-m-d H:i:s");
		}
	 public function setIdCota($nIdCota) {
		$this->nIdCota = $nIdCota;
	 }
	 public function getIdCota() {
		return $this->nIdCota;
	 }
	 public function setLocacao($sLocacao) {
		$this->sLocacao = $sLocacao;
	 }
	 public function getLocacao() {
		return $this->sLocacao;
	 }
	public function setCota($oCota) {
		$this->oCota = $oCota;
	}
	public function getCota() {
		$oController = new Controller();
		if($this->oCota = $oController->recuperar('Cota', array('id_cota'=>$this->getIdCota())))
				return $this->oCota[0];
		return false;
	}
 }
 ?>
