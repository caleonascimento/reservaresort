<?php
 /**
  * @author Auto-Generated 
  * @package fachada 
  * @SGBD mysql 
  * @tabela acesso_grupo 
  */
 class AcessoGrupo{
 	/**
	* @campo id_grupo
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nIdGrupo;
	/**
	* @campo id_grupo_pai
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdGrupoPai;
	/**
	* @campo nome
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sNome;
	/**
	* @campo ativo
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nAtivo;
	private $oAcessoGrupo;
	
 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setIdGrupo($nIdGrupo) {
		$this->nIdGrupo = $nIdGrupo;
	 }
	 public function getIdGrupo() {
		return $this->nIdGrupo;
	 }
	 public function setIdGrupoPai($nIdGrupoPai) {
		$this->nIdGrupoPai = $nIdGrupoPai;
	 }
	 public function getIdGrupoPai() {
		return $this->nIdGrupoPai;
	 }
	 public function setNome($sNome) {
		$this->sNome = $sNome;
	 }
	 public function getNome() {
		return $this->sNome;
	 }
	 public function setAtivo($nAtivo) {
		$this->nAtivo = $nAtivo;
	 }
	 public function getAtivo() {
		return $this->nAtivo;
	 }
	public function setAcessoGrupo($oAcessoGrupo) {
		$this->oAcessoGrupo = $oAcessoGrupo;
	}
	public function getAcessoGrupo() {
		$oController = new Controller();
		if($this->oAcessoGrupo = $oController->recuperar('AcessoGrupo', array('id_grupo'=>$this->getIdGrupoPai())))
		    return $this->oAcessoGrupo[0];
        return false;
	}
 }
 ?>
