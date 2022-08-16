<?php
 /**
  * @author Auto-Generated 
  * @package fachada 
  * @SGBD mysql 
  * @tabela acesso_permissao_grupo 
  */
 class AcessoPermissaoGrupo{
 	/**
	* @campo id_permissao_grupo
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nIdPermissaoGrupo;
	/**
	* @campo id_grupo
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdGrupo;
	/**
	* @campo id_modulo_transacao
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdModuloTransacao;
	/**
	* @campo permissao
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sPermissao;
	private $oAcessoGrupo;
	private $oAcessoModuloTransacao;
	
 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setIdPermissaoGrupo($nIdPermissaoGrupo) {
		$this->nIdPermissaoGrupo = $nIdPermissaoGrupo;
	 }
	 public function getIdPermissaoGrupo() {
		return $this->nIdPermissaoGrupo;
	 }
	 public function setIdGrupo($nIdGrupo) {
		$this->nIdGrupo = $nIdGrupo;
	 }
	 public function getIdGrupo() {
		return $this->nIdGrupo;
	 }
	 public function setIdModuloTransacao($nIdModuloTransacao) {
		$this->nIdModuloTransacao = $nIdModuloTransacao;
	 }
	 public function getIdModuloTransacao() {
		return $this->nIdModuloTransacao;
	 }
	 public function setPermissao($sPermissao) {
		$this->sPermissao = $sPermissao;
	 }
	 public function getPermissao() {
		return ($this->sPermissao) ? true : false;
	 }
	public function setAcessoGrupo($oAcessoGrupo) {
		$this->oAcessoGrupo = $oAcessoGrupo;
	}
	public function getAcessoGrupo() {
		$oController = new Controller();
		if($this->oAcessoGrupo = $oController->recuperar('AcessoGrupo', array('id_grupo'=>$this->getIdGrupo())))
				return $this->oAcessoGrupo[0];
		return false;
	}
	public function setAcessoModuloTransacao($oAcessoModuloTransacao) {
		$this->oAcessoModuloTransacao = $oAcessoModuloTransacao;
	}
	public function getAcessoModuloTransacao() {
		$oController = new Controller();
		if($this->oAcessoModuloTransacao = $oController->recuperar('AcessoModuloTransacao', array('id_modulo_transacao'=>$this->getIdModuloTransacao())))
				return $this->oAcessoModuloTransacao[0];
		return false;
	}
 }
 ?>
