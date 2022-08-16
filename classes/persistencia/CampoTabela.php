<?php
/**
 * Representação de um campo de tabela de banco de dados
 * @author Rodrigo Oliveira de Medeiros
 * @package persistencia
 * @since 12/11/2008
 * @version 12/11/2008
 */
class CampoTabela{

	/**
	 * Nome do campo
	 * @var String
	 */
	private $sNome;
	/**
	 * Tipo do Campo
	 * @var String
	 */
	private $sTipo;
	/**
	 * Informa se é campo primário
	 * @var boolean
	 */
	private $bCampoPrimario;
	/**
	 * Informa se é campo auto-increment
	 * @var boolean
	 */
	private $bAuto;
	/**
	 * Informa se é campo nulo
	 * @var boolean
	 */
	private $bNulo;

	/**
	 * Método Construtor
	 * @return CampoTabela
	 */
	public function __construct(){


	}

	/**
	 * Método para recuperar o atributo $sNome
	 * @return String
	 */
	public function getNome(){
		return $this->sNome;

	}
	/**
	 * Método para setar o atributo $sNome
	 * @return void
	 * @param String $sNome
	 */
	public function setNome($sNome){
		$this->sNome = $sNome;
	}
	/**
	 * Método para recuperar o atributo $sTipo
	 * @return String
	 */
	public function getTipo(){
		return $this->sTipo;

	}
	/**
	 * Método para setar o atributo $sTipo
	 * @return void
	 * @param String $sTipo
	 */
	public function setTipo($sTipo){
		$this->sTipo = $sTipo;
	}
	/**
	 * Método para recuperar o atributo $bCampoPrimario
	 * @return boolean
	 */
	public function getCampoPrimario(){
		return $this->bCampoPrimario;

	}
	/**
	 * Método para setar o atributo $bCampoPrimario
	 * @return void
	 * @param String $bCampoPrimario
	 */
	public function setCampoPrimario($bCampoPrimario){
		$this->bCampoPrimario = $bCampoPrimario;
	}
	/**
	 * Método para recuperar o atributo $bAuto
	 * @return boolean
	 */
	public function getAuto(){
		return $this->bAuto;

	}
	/**
	 * Método para setar o atributo $bAuto
	 * @return void
	 * @param boolean $bAuto
	 */
	public function setAuto($bAuto){
		$this->bAuto = $bAuto;
	}


	/**
	 * Método para recuperar o atributo $bNulo
	 * @return boolean
	 */
	public function getNulo(){
		return $this->bNulo;

	}

    /**
     * Método para setar o atributo $bAuto
     * @param $bNulo
     * @return void
     */
	public function setNulo($bNulo){
		$this->bNulo = $bNulo;
	}


}
?>