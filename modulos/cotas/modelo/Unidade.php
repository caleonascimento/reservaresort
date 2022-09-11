<?php
 /**
  * @author Auto-Generated 
  * @SGBD mysql 
  * @tabela unidade 
  */
  class Unidade{
	/**
	 * @campo id
	 * @var number
	 * @primario true
	 * @nulo false
	 * @auto-increment true
	 */
	private $nId;
	/**
	 * @campo id_empreendimento
	* @var number
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $nIdEmpreendimento;
	/**
	* @campo id_tipo_unidade
	* @var number
	* @primario false
	* @nulo true
	* @auto-increment false
	*/
	private $nIdTipoUnidade;
	/**
	* @campo descricao
	* @var String
	* @primario false
	* @nulo false
	* @auto-increment false
	*/
	private $sDescricao;


	private $oEmpreendimento;
	private $oTipoUnidade;
	
 	
 	public function __construct(){
 		
 	}
 	
 	
	 public function setId($nId) {
		$this->nId = $nId;
	 }
	 public function getId() {
		return $this->nId;
	 }
	 public function setIdTipoUnidade($nIdTipoUnidade) {
		$this->nIdTipoUnidade = $nIdTipoUnidade;
	 }
	 public function getIdTipoUnidade() {
		return $this->nIdTipoUnidade;
	 }
	 public function setDescricao($sDescricao) {
		$this->sDescricao = $sDescricao;
	 }
	 public function getDescricao() {
		return $this->sDescricao;
	 }
	 public function setIdEmpreendimento($nIdEmpreendimento) {
		$this->nIdEmpreendimento = $nIdEmpreendimento;
	 }
	 public function getIdEmpreendimento() {
		return $this->nIdEmpreendimento;
	 }
	public function setEmpreendimento($oEmpreendimento) {
		$this->oEmpreendimento = $oEmpreendimento;
	}
	public function getEmpreendimento() {
		if($this->oEmpreendimento)
			return $this->oEmpreendimento;

		$oController = new Controller();
		if($this->oEmpreendimento = $oController->recuperar('Empreendimento', array('id'=>$this->nIdEmpreendimento)))
				return $this->oEmpreendimento[0];
		return false;
	}

	public function getTipoUnidade() {
		if(!$this->nIdTipoUnidade)
			return false;

		if($this->oTipoUnidade)	
			return $this->oTipoUnidade;

		$Controller = new Controller();
		if(!$this->oTipoUnidade = $Controller->recuperar("EmpreendimentoTipoUnidade", ['id'=>$this->nIdTipoUnidade]))
			return false;
		
		$this->oTipoUnidade = $this->oTipoUnidade[0];

		return $this->oTipoUnidade;
	}
 }
 ?>
