<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="image/png" />
    <title>Confirmação de Cadastro</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
        }

        img {
            max-width: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        .image-fix {
            display: block;
        }

        .collapse {
            margin: 0;
            padding: 0;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
            height: 100%;
            text-align: center;
            color: #747474;
            background-color: #ffffff;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Open Sans', sans-serif;
            line-height: 1.1;
        }

        h1 small,
        h2 small,
        h3 small,
        h4 small,
        h5 small,
        h6 small {
            font-size: 60%;
            line-height: 0;
            text-transform: none;
        }

        h1 {
            font-weight: 200;
            font-size: 44px;
        }

        h2 {
            font-weight: 200;
            font-size: 32px;
            margin-bottom: 14px;
        }

        h3 {
            font-weight: 500;
            font-size: 27px;
        }

        h4 {
            font-weight: 500;
            font-size: 23px;
        }

        h5 {
            font-weight: 900;
            font-size: 17px;
        }

        h6 {
            font-weight: 900;
            font-size: 14px;
            text-transform: uppercase;
        }

        .collapse {
            margin: 0 !important;
        }

        td,
        div {
            font-family: 'Open Sans', sans-serif;
            text-align: center;
        }

        p,
        ul {
            margin-bottom: 10px;
            font-weight: normal;
            font-size: 14px;
            line-height: 1.6;
        }

        p.lead {
            font-size: 17px;
        }

        p.last {
            margin-bottom: 0px;
        }

        ul li {
            margin-left: 5px;
            list-style-position: inside;
        }

        a {
            color: #747474;
            text-decoration: none;
        }

        a img {
            border: none;
        }

        .head-wrap {
            width: 100%;
            margin: 0 auto;
            background-color: #f9f8f8;
            border-bottom: 1px solid #d8d8d8;
        }

        .head-wrap * {
            margin: 0;
            padding: 0;
        }

        .header-background {
            background: repeat-x url(https://www.filepicker.io/api/file/wUGKTIOZTDqV2oJx5NCh) left bottom;
        }

        .header {
            height: 42px;
        }

        .header .content {
            padding: 0;
        }

        .header .brand {
            font-size: 16px;
            line-height: 42px;
            font-weight: bold;
        }

        .header .brand a {
            color: #464646;
        }

        .body-wrap {
            width: 100%;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .soapbox .soapbox-title {
            font-size: 32px;
            color: #464646;
            padding-top: 15px;
        }

        .content .status-container.single .status-padding {
            width: 80px;
        }

        .content .status {
            width: 90%;
        }

        .content .status-container.single .status {
            width: 300px;
        }

        .status {
            border-collapse: collapse;
            margin-left: 15px;
            color: #656565;
        }

        .status .status-cell {
            border: 1px solid #b3b3b3;
            height: 50px;
        }

        .status .status-cell.success,
        .status .status-cell.active {
            height: 65px;
        }

        .status .status-cell.success {
            background: #f2ffeb;
            color: #51da42;
        }

        .status .status-cell.success .status-title {
            font-size: 15px;
        }

        .status .status-cell.active {
            background: #fffde0;
            width: 135px;
        }

        .status .status-title {
            font-size: 16px;
            font-weight: bold;
            line-height: 23px;
        }

        .status .status-image {
            vertical-align: text-bottom;
        }

        .body .body-padded,
        .body .body-padding {
            padding-top: 34px;
        }

        .body .body-padding {
            width: 41px;
        }

        .body-padded,
        .body-title {
            text-align: left;
        }

        .body .body-title {
            font-weight: bold;
            font-size: 19px;
            color: #464646;
        }

        .body .body-text .body-text-cell {
            text-align: left;
            font-size: 16px;
            line-height: 1.6;
            padding: 9px 0 17px;
        }

        .body .body-text-cell a {
            color: #464646;
            text-decoration: underline;
        }

        .body .body-signature-block .body-signature-cell {
            padding: 25px 0 30px;
            text-align: left;
        }

        .body .body-signature {
            font-family: 'Open Sans', sans-serif;
            font-weight: bold;
        }

        .footer-wrap {
            width: 100%;
            margin: 0 auto;
            clear: both !important;
            border-top: 3px solid rgb(0, 51, 102);
            font-size: 12px;
            color: #656565;
            line-height: 30px;

        }

        .footer-wrap .container {
            padding: 14px 0;
        }

        .footer-wrap .container .content {
            padding: 0;
        }

        .footer-wrap .container .footer-lead {
            font-size: 14px;
        }

        .footer-wrap .container .footer-lead a {
            font-size: 14px;
            font-weight: bold;
            color: #535353;
        }

        .footer-wrap .container a {
            font-size: 12px;
            color: #656565;
        }

        .footer-wrap .container a.last {
            margin-right: 0;
        }

        .footer-wrap .footer-group {
            display: inline-block;
        }

        .container {
            display: block !important;
            max-width: 100% !important;
            clear: both !important;
            text-align: center;
        }

        .content {
            padding: 0;
            max-width: 100%;
            margin: 0 auto;
            display: block;
        }

        .content table {
            width: 100%;
        }


        .clear {
            display: block;
            clear: both;
        }

        table.full-width-gmail-android {
            width: 100% !important;
        }

        .logo {
            width: 100%;
            height: auto;
            background: rgb(16, 104, 193);
            border-bottom: 3px solid rgb(0, 51, 102);
        }

        .logo img {
            width: 25%;
            padding: 10px;
            margin: 0 auto;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.875rem 1.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            margin-top: 20px;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            margin-right: 3.333%;
            text-decoration: none;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-primary:focus,
        .btn-primary.focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
        }

        .btn-primary.disabled,
        .btn-primary:disabled {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:not(:disabled):not(.disabled):active,
        .btn-primary:not(:disabled):not(.disabled).active,
        .show>.btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #0062cc;
            border-color: #005cbf;
        }

        .btn-primary:not(:disabled):not(.disabled):active:focus,
        .btn-primary:not(:disabled):not(.disabled).active:focus,
        .show>.btn-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
        }

        .btn.btn-xs {
            font-size: 11.2px;
            font-size: 0.7rem;
            padding: 3.2px 8px;
            padding: 0.2rem 0.5rem;
            margin: 5px;
        }

        .btn-danger {
            background-color: #d2322d;
            border-color: #d2322d #d2322d #a82824;
            color: #FFF;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-warning {
            background-color: #ed9c28;
            border-color: #ed9c28 #ed9c28 #d18211;
            color: #FFF;
        }
        a.btn {
            text-decoration: none  !important;
            color: #FFF !important;
        }
        .fs-1 {
            font-size: 11px;
        }

    </style>

    <style type="text/css" media="only screen">
        @media only screen {

            table[class*="head-wrap"],
            table[class*="body-wrap"],
            table[class*="footer-wrap"] {
                width: 100% !important;
            }

            td[class*="container"] {
                margin: 0 auto !important;
            }

        }

        @media only screen and (max-width: 505px) {

            *[class*="w320"] {
                width: 320px !important;
            }

            table[class="soapbox"] td[class*="soapbox-title"],
            table[class="body"] td[class*="body-padded"] {
                padding-top: 24px;
            }
        }

    </style>
</head>

<body bgcolor="#ffffff">

<div align="center">
    <div class="logo"><img src="http://177.74.2.213/seplad/img/logo_seplad_branco.png" alt="Logo Seplad"></div>
    <table class="body-wrap w320">
        <tr>
            <td></td>
            <td class="container">
                <div class="content">
                    <table cellspacing="0">
                        <tr>
                            <td>
                                <table class="soapbox">
                                    <tr>
                                        <td class="soapbox-title">Redefinição de senha</td>
                                    </tr>
                                </table>
                                <h5><?php echo htmlspecialchars( $sys_name, ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                                <table class="body">
                                    <tr>
                                        <td class="body-padding"></td>
                                        <td class="body-padded">
                                            <div class="body-title">Olá <?php echo htmlspecialchars( $nome, ENT_COMPAT, 'UTF-8', FALSE ); ?>,</div>
                                            <table class="body-text">
                                                <tr>
                                                    <td class="body-text-cell">
                                                        Foi solicitado pelo site uma redefinição de senha para seu usuário. <br>
                                                        <i>Caso não tenha sido você, desconsidere este email. </i>
                                                        
                                                    </td>
                                                </tr>
                                                <tr >
                                                    <td class="body-text-cell"> Acesse o link abaixo para redefinição de senha:</td>
                                                </tr>
                                                <tr>
                                                    <td class="body-text-cell"><a class="btn btn-primary" href="<?php echo htmlspecialchars( $link, ENT_COMPAT, 'UTF-8', FALSE ); ?>">Redefinir Senha</a></td>
                                                </tr>
                                            </table>

                                            
                                                    
                                                                                       
                                            <br>
                                            <br>
                                            Atenciosamente   
                                            
                                            <br><br>
                                            
                                           
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <div class="footer-wrap w320 full-width-gmail-android" align="center">
        <div class="container">
            <div class="content footer-lead">
                <p ><b>Secretaria de Estado de Planejamento e Administração</b> <a href="https://seplad.pa.gov.br/">SEPLAD</a></p>
                <p class="fs-1">R. Boaventura da Silva, 401/403 Umarizal, Belém - PA, 66053-050</p> 
                <p class="fs-1">Travessa do Chaco, 2350 · Belém - Pará - Brasil - CEP: 66093-542</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
