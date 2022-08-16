<?php
/**
 * Representa��o de um atributo de uma classe
 * @author Rodrigo Oliveira de Medeiros
 * @package persistencia
 * @since 12/11/2008
 * @version 12/11/2008
 */
class AtributoClasse{
	
	/**
	 * Nome do atributo
	 * @var String
	 */
	private $sNome;
	
	/**
	 * M�todo Construtor
	 * @return AtributoClasse
	 */
	public function __construct(){
		
		
	}
	
	/**
	 * M�todo para recuperar o atributo $sNome
	 * @return String 
	 */
	public function getNome(){
		return $this->sNome;
		
	}
	/**
	 * M�todo para setar o atributo $sNome
	 * @return void 
	 * @param String $sNome
	 */
	public function setNome($sNome){
		$this->sNome = $sNome;
	}
}
?>