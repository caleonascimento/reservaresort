<?php
/**
 * Classe para descrever persistencia de uma determinada classe
 * @author Rodrigo Oliveira de Medeiros
 * @package persistencia
 * @since 12/11/2008
 * @version 12/11/2008
 */
class Descritor{
	
	/**
	 * SGBD onde a classe persiste
	 * @var String
	 */
	private $sSGBD;
	/**
	 * Nome da classe
	 * @var String
	 */
	private $sClasse;
	/**
	 * Nome da tabela na base de dados
	 * @var String
	 */
	private $sTabela;
	/**
	 * Vetor de campos de tabela (indices correspondentes em $voAtributoClasse)
	 * @var CampoTabela[]
	 */
	private $voCampoTabela;
	/**
	 * Vetor de atributos de classe (indices correspondentes em $voCamposTabela)
	 * @var AtributoClasse[]
	 */
	private $voAtributoClasse;
	
	/**
	 * Método Construtor
	 * @return Descritor
	 */
	public function __construct(){
		
		
	}
	
	/**
	 * Método para recuperar o atributo $sSGBD
	 * @return String 
	 */
	public function getSGBD(){
		return $this->sSGBD;
		
	}
	/**
	 * Método para setar o atributo $sSGBD
	 * @return void 
	 * @param String $sSGBD
	 */
	public function setSGBD($sSGBD){
		$this->sSGBD = $sSGBD;
	}
	/**
	 * Método para recuperar o atributo $sClasse
	 * @return String 
	 */
	public function getClasse(){
		return $this->sClasse;
		
	}
	/**
	 * Método para setar o atributo $sClasse
	 * @return void 
	 * @param String $sClasse
	 */
	public function setClasse($sClasse){
		$this->sClasse = $sClasse;
	}
	/**
	 * Método para recuperar o atributo $sTabela
	 * @return String 
	 */
	public function getTabela(){
		return $this->sTabela;
		
	}
	/**
	 * Método para setar o atributo $sTabela
	 * @return void 
	 * @param String $sTabela
	 */
	public function setTabela($sTabela){
		$this->sTabela = $sTabela;
	}
	
	/**
	 * Método para recuperar o atributo $voCampoTabela
	 * @return CampoTabela[] 
	 */
	public function getCampoTabela(){
		return $this->voCampoTabela;
		
	}
	/**
	 * Método para setar o atributo $voCampoTabela
	 * @return void 
	 * @param CampoTabela[] $voCampoTabela
	 */
	public function setCampoTabela($voCampoTabela){
		$this->voCampoTabela = $voCampoTabela;
	}
	/**
	 * Método para recuperar o atributo $voAtributoClasse
	 * @return AtributoClasse[] 
	 */
	public function getAtributoClasse(){
		return $this->voAtributoClasse;
		
	}
	/**
	 * Método para setar o atributo $voAtributoClasse
	 * @return void 
	 * @param AtributoClasse[] $voAtributoClasse
	 */
	public function setAtributoClasse($voAtributoClasse){
		$this->voAtributoClasse = $voAtributoClasse;
	}
}
?>