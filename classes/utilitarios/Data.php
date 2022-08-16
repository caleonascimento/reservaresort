<?php
class Data{

	/**
	* nDia
	* @access private
	*/
	var $nDia;
	/**
	* nMes
	* @access private
	*/
	var $nMes;
	/**
	* nAno
	* @access private
	*/
	var $nAno;
	/**
	* dData
	* @access private
	*/
	var $dData;
	/**
	* sFormato
	* @access private
	*/
	var $sFormato;
	/**
	* sSeparador
	* @access private
	*/
	var $sSeparador;


	/**
	* Construtor de Data
	* @param $dData dData
	* @param $sFormato sFormato
	*/
	function Data($dData = "",$sFormato = "d/m/Y"){
		if($dData) {
			$this->setData($dData,$sFormato);
		}
	}
	/**
	* Formatar Data
	* @param $dData dData
	* @param $sFormato sFormato
	* @return $dData dData
	*/
	function formatarData($dData = "",$sFormato = "d/m/Y"){
		if($dData) {
			$this->setData($dData,$sFormato);
		}
		return $this->dData;
	}
	

	/**
	* Recupera o valor do atributo $nDia.
	* @return $nDia nDia
	*/
	function getDia(){
		return $this->nDia;
	}

	/**
	* Atribui valor ao atributo $nDia.
	* @param $nDia nDia
	* @access public
	*/
	function setDia($nDia){
		$this->nDia = $nDia;
	}

	/**
	* Recupera o valor do atributo $nMes.
	* @return $nMes nMes
	*/
	function getMes(){
		return $this->nMes;
	}

	/**
	* Atribui valor ao atributo $nMes.
	* @param $nMes nMes
	* @access public
	*/
	function setMes($nMes){
		$this->nMes = $nMes;
	}

	/**
	* Recupera o valor do atributo $nAno.
	* @return $nAno nAno
	*/
	function getAno(){
		return $this->nAno;
	}

	/**
	* Atribui valor ao atributo $nAno.
	* @param $nAno nAno
	* @access public
	*/
	function setAno($nAno){
		$this->nAno = $nAno;
	}

	/**
	* Recupera o valor do atributo $dData.
	* @return $dData dData
	*/
	function getData(){
		return $this->dData;
	}

	/**
	* Atribui valor ao atributo $dData.
	* @param $dData dData
	* @access public
	*/
	function setData($dData = "",$sFormato = "d/m/Y"){
		if($this->validaFormato($sFormato)){
			$vData = split($this->getSeparador(),$dData);
			$vFormato = split($this->getSeparador(),$sFormato);

			foreach($vFormato as $nIndice => $sAtributo){
				switch($sAtributo){
					case "d":
						$this->setDia($vData[$nIndice]);
					break;
					case "m":
						$this->setMes($vData[$nIndice]);
					break;
					case "Y":
						$this->setAno($vData[$nIndice]);
					break;
				}
			}
			$vPadraoFormato = array("/d/","/m/","/Y/");
			$vValoresData = array($this->getDia(),$this->getMes(),$this->getAno());
			$this->dData = preg_replace($vPadraoFormato,$vValoresData,$sFormato);
			$this->setFormato($sFormato);
		}
	}

	/**
	* Recupera o valor do atributo $sFormato.
	* @return $sFormato sFormato
	*/
	function getFormato(){
		return $this->sFormato;
	}

	/**
	* Atribui valor ao atributo $sFormato.
	* @param $sFormato sFormato
	* @access public
	*/
	function setFormato($sFormato = "d/m/Y"){
		if($this->validaFormato($sFormato)){
			$vPadraoFormato = array("/d/","/m/","/Y/");
			$vValoresData = array($this->getDia(),$this->getMes(),$this->getAno());
			$this->dData = preg_replace($vPadraoFormato,$vValoresData,$sFormato);
			$this->sFormato = $sFormato;
		}
	}

	/**
	* Recupera o valor do atributo $sSeparador.
	* @return $sSeparador sSeparador
	*/
	function getSeparador(){
		return $this->sSeparador;
	}

	/**
	* Atribui valor ao atributo $sSeparador.
	* @param $sSeparador sSeparador
	* @access public
	*/
	function setSeparador($sSeparador = "/"){
		$this->sSeparador = $sSeparador;
	}

	/**
	* Recupera o valor do m�s por extenso.
	* @access public
	*/
	function getMesExtenso(){
		switch($this->nMes){
			case 1:
				$sMes = "Janeiro";
			break;
			case 2:
				$sMes = "Fevereiro";
			break;
			case 3:
				$sMes = "Março";
			break;
			case 4:
				$sMes = "Abril";
			break;
			case 5:
				$sMes = "Maio";
			break;
			case 6:
				$sMes = "Junho";
			break;
			case 7:
				$sMes = "Julho";
			break;
			case 8:
				$sMes = "Agosto";
			break;
			case 9:
				$sMes = "Setembro";
			break;
			case 10:
				$sMes = "Outubro";
			break;
			case 11:
				$sMes = "Novembro";
			break;
			case 12:
				$sMes = "Dezembro";
			break;
		}
		return $sMes;
	}

	/**
	* Valida o atributo $sFormato.
	* @param $sFormato sFormato
	* @access public
	*/
	function validaFormato($sFormato = "d/m/Y"){
		if(!preg_match("/^[d,m,Y]+(\W)[d,m,Y]+(\W)[d,m,Y]$/",$sFormato,$vSeparador))
			return false;

		if($vSeparador[1] != $vSeparador[2])
			return false;

		$this->setSeparador($vSeparador[1]);
		return true;
	}

	/**
	* Valida a Data.
	* @access public
	*/
	function validaData(){
		return checkdate((int) $this->getMes(),(int) $this->getDia(),(int) $this->getAno());
	}

	/**
	* Calcula a diferen�a entre duas datas, necessariamente em formato americano.
	* @param $dDataInicial dDataInicial
	* @param $dDataFinal dDataFinal
	* @access public
	*/
	static function calculaDiferenca($dDataInicial,$dDataFinal){
		// PEGA AS DATAS INICIAL E FINAL EM TIMESTAMP E CALCULA O N�MERO DE SEGUNDOS ENTRE AS DATAS
		$nDataInicial = strtotime($dDataInicial);
		$nDataFinal = strtotime($dDataFinal);
		$nSegundos = $nDataFinal - $nDataInicial;

		// CALCULA A QUANTIDADE DE DIAS DIVIDINDO OS SEGUNDOS PELO N�MERO DE SEGUNDOS DE UM DIA
		// COM O RESTO DOS SEGUNDOS CALCULA A QUANTIDADE DE HORAS E ASSIM SUCESSIVAMENTE
		//  AT� SE OBTER O N�MERO DE SEGUNDOS
		$nDias    = round($nSegundos / 86400);
		$nSegundos = $nSegundos % 86400;
		$nHoras   = round($nSegundos / 3600);
		$nSegundos = $nSegundos % 3600;
		$nMinutos = round($nSegundos / 60);
		$nSegundos = $nSegundos % 60;

		$vResultado['DIAS'] = $nDias;
		$vResultado['HORAS'] = $nHoras;
		$vResultado['MINUTOS'] = $nMinutos;
		$vResultado['SEGUNDOS'] = $nSegundos;

		return $vResultado;
	}

	/**
	* Calcula a idade.
	* @access public
	*/
	function calculaIdade(){
		$nMes = $this->getMes();
		$nDia = $this->getDia();
		$nAno = $this->getAno();
		if (checkdate($nMes,$nDia,$nAno)){
			$nDiaAtual = date("d");
			$nMesAtual = date("m");
			$nAnoAtual = date("Y");
			$nIdadeTemp = $nAnoAtual - $nAno;
			if($nMesAtual < $nMes){
				$nIdadeTemp--;
			} elseif($nMesAtual == $nMes){
				if ($nDiaAtual < $nDia){
					$nIdadeTemp--;
				}
			}
			return $nIdadeTemp;
		}
		return false;
	}

	/**
	* Avan�a a data de acordo com o n�mero de dias passado como par�metro.
	* @param $nDias nDias
	* @access public
	*/
	function avancaData($nDias){

		// TROCA O FORMATO PARA O PADR�O AMERICANO E SOMA OS DIAS
		$sFormatoOriginal = $this->getFormato();
		$this->setFormato("m/d/Y");
		$dDataTimestamp = strtotime($this->getData());
		$nDias *= 86400;
		$dDataTimestampFinal = $dDataTimestamp + $nDias;

		// RETORNA PARA O FORMATO ORIGINAL E SETA O ATRIBUTO $dData
		$vPadraoFormato = array("/d/","/m/","/Y/");
		$vFormatoStrtime = array("%d","%m","%Y");
		$sFormatoStrtime = preg_replace($vPadraoFormato,$vFormatoStrtime,$sFormatoOriginal);
		$this->setData(strftime($sFormatoStrtime,$dDataTimestampFinal),$sFormatoOriginal);
	}

	/**
	* Retorna o mes base anterior
	* @param $sMesBaseAtual sMesBaseAtual
	* @access public
	*/
	function retornaMesBaseAnterior($sMesBaseAtual){
		$aMesBaseAtual = explode("/",$sMesBaseAtual);

		$nMes = (int) $aMesBaseAtual[0];
		$nAno = (int) $aMesBaseAtual[1];

		if ($nMes == 1) {
			$sMes = "12";
			$nAno = $nAno - 1;
		} else {
			$nMes--;
			if ($nMes < 10) {
				$sMes = "0" . $nMes;
			} else {
				$sMes = $nMes;
			}
		}

		if ($nAno < 10) {
			$sAno = "0" . $nAno;
		} else {
			$sAno = $nAno;
		}

		return "$sMes/$sAno";
	}


	/**
	* Retorna a mesma data do pr�ximo M�s.
	* @param $nData nData
	* @access public
	*/
	function retornaProximoMesAno($sMesAno){
		$aMesAno = explode("/",$sMesAno);

		$nMes = (int) $aMesAno[0];
		$nAno = (int) $aMesAno[1];

		if ($nMes == 12) {
			$sMes = "01";
			$nAno = $nAno + 1;
		} else {
			$nMes++;
			if ($nMes < 10) {
				$sMes = "0" . $nMes;
			} else {
				$sMes = $nMes;
			}
		}

		if ($nAno < 10) {
			$sAno = "0" . $nAno;
		} else {
			$sAno = $nAno;
		}

		return "$sMes/$sAno";
	}

	/**
	* Retorna a mesma data do pr�ximo Semestre.
	* @param $nData nData
	* @access public
	*/
	function retornaProximoSemestre($sMesAno){
		$aMesAno = explode("/",$sMesAno);

		$nMes = (int) $aMesAno[0];
		$nAno = (int) $aMesAno[1];


		$nMes += 6; // Adicionando 6 meses

		if ($nMes == 12) {
			$sMes = "01";
			$nAno = $nAno + 1;
		} else {
			$nMes++;
			if ($nMes < 10) {
				$sMes = "0" . $nMes;
			} else {
				$sMes = $nMes;
			}
		}

		if ($nAno < 10) {
			$sAno = "0" . $nAno;
		} else {
			$sAno = $nAno;
		}

		return "$sMes/$sAno";
	}

	function recuperaDiaDaSemana($nDia) {
		switch ($nDia) {
			case 0:
				$sDiaSemana = "Domingo";
			break;
			case 1:
				$sDiaSemana = "Segunda-Feira";
			break;
			case 2:
				$sDiaSemana = "Ter�a-Feira";
			break;
			case 3:
				$sDiaSemana = "Quarta-Feira";
			break;
			case 4:
				$sDiaSemana = "Quinta-Feira";
			break;
			case 5:
				$sDiaSemana = "Sexta-Feira";
			break;
			case 6:
				$sDiaSemana = "S�bado";
			break;
		}
		return $sDiaSemana;
	}


}
?>