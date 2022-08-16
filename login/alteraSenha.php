<!doctype html>
<html class="fixed" lang="pt-br">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">
    <title><?php echo SYSTEM_NAME;?></title>
    <meta name="keywords" content="<?php echo KEYWORDS;?>" />
    <meta name="description" content="<?php echo DESCRIPTION;?>">
    <meta name="author" content="<?php echo AUTHOR;?>">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="vendor/animate/animate.css">

    <link rel="stylesheet" href="vendor/font-awesome/css/all.min.css" />
    <link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="css/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="css/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">


    <style>
        .btn-white {
            background-color: #fff;
        }
    </style>

    <!-- Head Libs -->
    <script src="vendor/modernizr/modernizr.js"></script>

</head>
<body>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo float-left">
            <img src="img/logo.png" height="54" alt="Intranet/SEPLAD" />
        </a>

        <div class="panel card-sign">
            <div class="card-title-sign mt-3 text-right">
                <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Redefinição de senha</h2>
            </div>
            <div class="card-body">
                <form action="login.php?action=processaLogin" method="post" id = "formAlteraSenha">

                    <input type="hidden" name="sOP" value="Redefinir">
                    <input type="hidden" name="fId" id="id" value="<?php echo $_GET['id'];?>">
                    <input type="hidden" name="fUri" value="<?php echo $_SERVER['REQUEST_URI'];?>">

                    <?php if ($sMessage){ ?>
                        <div class="alert <?php echo $sMsgClass;?>">
                            <p><?php echo $sMessage; ?></p>
                        </div>
                    <?php } ?>

                    <div class="form-group mb-3">
                        <div class="clearfix">
                            <label class="float-left" for="Senha">Nova Senha</label>
                            <!-- <a tabindex="3" href="pages-recover-password.html" class="float-right">Esqueceu a senha?</a> -->
                        </div>
                        <div class="input-group">
                            <input name="fSenha" id="Senha" type="password" class="form-control form-control-lg" tabindex="2" onkeyup = "verificaSenha(this)" style="border-right-width: 0px;"/>
                            <span class="input-group-append">
                                <span class="input-group-text" style = "background-color:#fff; border: 1px solid #ced4da; border-right-width: 0px;">
                                    <span class="btn btn-white btn-xs btn-aTec" onclick = "mostraSenha()"><i class="fas fa-eye" id = "eye"></i></span>
                                </span>
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <span class="text-primary" style = "color:#491217">A nova senha deverá conter de <b>8 a 20 caracteres</b>, compostos de <b>letras e números</b>.</span>
                        </div>
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-primary mt-2" onClick="return submitSenha(this)" id="enviar" disabled>Alterar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3">&copy; Copyright <?php echo date("Y"); ?>. <?php echo COPYRIGHT;?> Todos os direitos reservados.</p>
    </div>
</section>
<!-- end: page -->

<!-- Vendor -->
<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="vendor/popper/umd/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.js"></script>
<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="vendor/common/common.js"></script>
<script src="vendor/nanoscroller/nanoscroller.js"></script>
<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="js/theme.js"></script>

<!-- Theme Custom -->
<script src="js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="js/theme.init.js"></script>

<script type = "text/javascript">



    var mostraSenha = () => {
        senha = document.getElementById("Senha");
        eye = document.getElementById("eye");

        if(senha.type == "password") {
            senha.type = "text";
            eye.classList.remove("fa-eye");
            eye.classList.add("fa-eye-slash");
        } else {
            senha.type = "password";
            eye.classList.remove("fa-eye-slash");
            eye.classList.add("fa-eye");
            
        }

    
    };

    

    var submitSenha = function(input) {
         sSenha =  document.getElementById("Senha").value;
        if(sSenha.match(/([^A-Za-z0-9])+/gi) != null) {
            alert("Não são permitidos caracteres especiais!");
        } else {
            if((sSenha.match(/([A-Za-z])+/gi) != null) && (sSenha.match(/([0-9])+/gi) != null))
                return true;
            else {  
                alert("A senha deve conter letras e números! ");    
                input.value = "";
            }   
        }

        return false;

    };

    var verificaSenha = (input) => {
        if(input.value.length > 7) 
            document.getElementById("enviar").disabled = "";

    };

</script>
</body>
</html>
