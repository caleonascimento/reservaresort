<?php
 /**
  * @author Auto-Generated 
  * @package fachada 
  * @SGBD mysql 
  * @tabela acesso_grupo_usuario 
  */
 class AcessoGrupoUsuario{
 	/**
	* @campo id_grupo_usuario
	* @var number
	* @primario true
	* @nulo false
	* @auto-increment true
	*/
	private $nIdGrupoUsuario;
	/**
	* @campo id_grupo
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdGrupo;
	/**
	* @campo id_usuario
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdUsuario;
	/**
	* @campo inserido_por
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sInseridoPor;
	/**
	* @campo alterado_por
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sAlteradoPor;
	
 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setIdGrupoUsuario($nIdGrupoUsuario) {
		$this->nIdGrupoUsuario = $nIdGrupoUsuario;
	 }
	 public function getIdGrupoUsuario() {
		return $this->nIdGrupoUsuario;
	 }
	 public function setIdGrupo($nIdGrupo) {
		$this->nIdGrupo = $nIdGrupo;
	 }
	 public function getIdGrupo() {
		return $this->nIdGrupo;
	 }
	 public function setIdUsuario($nIdUsuario) {
		$this->nIdUsuario = $nIdUsuario;
	 }
	 public function getIdUsuario() {
		return $this->nIdUsuario;
	 }
	 public function setInseridoPor($sInseridoPor) {
		$this->sInseridoPor = $sInseridoPor;
	 }
	 public function getInseridoPor() {
		return $this->sInseridoPor;
	 }
	 public function setAlteradoPor($sAlteradoPor) {
		$this->sAlteradoPor = $sAlteradoPor;
	 }
	 public function getAlteradoPor() {
		return $this->sAlteradoPor;
	 }

     public function getGrupo() {
         $oController = new Controller();
         if($voGrupo = $oController->recuperar("AcessoGrupo", array('id_grupo'=>$this->nIdGrupo)))
            return $voGrupo[0];
         return false;
     }
 }
 ?>
