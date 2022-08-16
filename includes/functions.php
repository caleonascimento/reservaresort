<?php

function maskData($sData){
    if ($sData)
        $sData = (strripos($sData, "/")) ? implode("-", array_reverse(explode("/", $sData))) : null;
    else
        $sData = null;

    return $sData;
}

function maskInvData($sDate,$bTime = false){
    try {
        $oDate = new DateTime($sDate);
        return ($bTime) ? $oDate->format('d/m/Y H:i:s') : $oDate->format('d/m/Y');
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function maskPerfil($nPerId){

    return ($nPerId) ? substr_replace($nPerId,'.',3,0) : null;

}

function maskcpf($cpf){
    if (empty($cpf)) {
        return false;
    }
    $cpf = trim($cpf);
    $cpf = str_replace(" ", "", $cpf);

    $ponto = strripos($cpf, ".");
    if($ponto == false){
        $parte_um = substr($cpf, 0, 3);
        $parte_dois = substr($cpf, 3, 3);
        $parte_tres = substr($cpf, 6, 3);
        $parte_quatro = substr($cpf, 9, 2);

        $montacpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";
    }

    elseif(is_string($cpf)){
        $montacpf = $cpf;
    }

    else{
        $montacpf = $cpf;
    }
    return $montacpf;
}

function maskTelefone($numero){
    $formata = substr($numero, 0, 2);
    $formata_2 = substr($numero, 3, 5);
    $formata_3 = substr($numero, 4, 4);
    return "(".$formata.") " . $formata_2 . "-". $formata_3;
}

function getBrowser() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
        '/msie/i'       =>  'Internet Explorer',
        '/firefox/i'    =>  'Firefox',
        '/safari/i'     =>  'Safari',
        '/chrome/i'     =>  'Chrome',
        '/edge/i'       =>  'Edge',
        '/opera/i'      =>  'Opera',
        '/netscape/i'   =>  'Netscape',
        '/maxthon/i'    =>  'Maxthon',
        '/konqueror/i'  =>  'Konqueror',
        '/mobile/i'     =>  'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}

function getOS() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }

    return $os_platform;

}