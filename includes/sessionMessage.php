<?php
//Mensagens de request da sessão
function setMessage($sMsg, $nType=6) {
    $_SESSION['oMsg'] = (object)['type'=>$nType, 'sMsg'=>$sMsg];
}