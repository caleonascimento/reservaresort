<?php 
require_once("env.php");
require_once $_SERVER["DOCUMENT_ROOT"].ROOT_PATH."classes/vendor/autoload.php";


class Mailer {
    const USERNAME = MAIL_USERNAME;
    const PASSWORD = MAIL_PASS;
    const NAME_FROM = MAIL__FROM;
    const REPLY = MAIL__REPLY;

    public function enviar($sNome, $sEmail, $sAssunto, $tplName, $data = array())
    { 
        $config = array(
            "base_url"      => null,
            "tpl_dir"       => EMAIL_TPL,
            "cache_dir"     => EMAIL_TPL_CACHE,
            "debug"         => true // set to false to improve the speed
        );

        \Rain\Tpl::configure($config);

        $tpl = new \Rain\Tpl();

        foreach ($data as $key => $value) {
            $tpl->assign($key, $value);
        }

        $tpl->assign("sys_name", SYSTEM_NAME);

        //E-mail template
        $html = $tpl->draw($tplName, true);

        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->CharSet = 'UTF-8';

        $mail->IsSMTP();

        $mail->SMTPAuth  = true;

        $mail->Host = 'mx.sistemas.pa.gov.br';

        $mail->Port  = '465';

        $mail->SMTPSecure = 'ssl';

        $mail->Username  = Mailer::USERNAME;

        $mail->Password  = Mailer::PASSWORD;

        $mail->From  = Mailer::USERNAME;

        $mail->FromName  = utf8_decode(Mailer::NAME_FROM);

        //E-mail de resposta
        $mail->addReplyTo(Mailer::REPLY, Mailer::NAME_FROM);

        $mail->isHTML();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        //Subject e-mail
        $mail->Subject = $sAssunto;

        $mail->msgHTML($html);

        //Receiver data
        $mail->AddAddress($sEmail,utf8_decode($sNome));

        try{

            $mail->send();

            echo "E-mail enviado!";
            return true;

        } catch (Exception $e) {

            return $e;

        }

    }

}