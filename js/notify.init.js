/* **********************************************
    Name: 			UI Elements / Notifications 
    Porto Admin
    Notificações do Sistema
************************************************/

//Notificação padrão para outros tipos de mensagem .&nbsp;
function msgNotify(titulo, msg, tipo=6) {
     customNotify(msg, {title:titulo, type:tipo, position:"center"});
}

// Notificação para mensagens de erro padrão
function errorNotify(msg) {
    new PNotify({
        title: 'Erro',
        text: msg,
        type: 'error',
        addclass: 'stack-bar-top',
        width: "100%"
    });
}

/**
 * ********* Notificação Customizada **********
 * Método para customizar a mensagem de notificação
 * @param {String} msg Único item de preenchimento obrigatório.
 * @param {Object[]} params Através desse parâmentro é possível customizar a notificação.
 *          Segue abaixo as especificações do objeto:
 *          {
 *              title: <String>, //O titulo da notificação.
 *              type: <0|1|2|3|4|5>, //Define a cor da notificação de acordo com as classes pré-definidas.
 *              icon: <String|null|false> //Define o ícone da notificação podendo omiti-lo no caso de false ou deixar o ícone padrão no caso de null.
 *              position: <"left"|"center"|"right"> Define a posição de onde a mensagem vai ficar. Por padrão "right".
 *           }
 * 
 * //A classe "icon-nb" remove o circulo entorno do ícone
 *************************************************************************/
function customNotify(msg, params = {}) {
    
    //Variável de configuração da classe PNotify
    var configNotify = { text: msg, shadow: true, addclass: "notification-primary"};

    if(params.title)
        configNotify.title = params.title;
    
    //Seta o tipo da notificação
    if(params.type)
        switch (params.type) {
            case 1: 
                configNotify.addclass = "notification-error"; 
                configNotify.type = "error";
            break;
            case 2: 
                configNotify.addclass = "notification-success"; 
                configNotify.type="success"; 
            break;
            case 3: configNotify.addclass = "notification-warning"; break;
            case 4: 
                configNotify.addclass = "notification-primary"; 
                configNotify.type="custom"; 
            break;
            case 5:  configNotify.addclass = "notification-dark"; break; 
            default: 
                configNotify.addclass = "notification-info"; 
                configNotify.type='info'; 
            break;         
        }

    //Configura o ícone
    if(params.icon) 
         configNotify.icon = params.icon;
    else if(params.icon === false) { 
        configNotify.addclass += " ui-pnotify-no-icon"; 
        configNotify.icon = false;
    }    
    

    //Configura a posição da notificação na tela
    if(params.position)
        switch (params.position) {
            case "left": configNotify.addclass += " stack-topleft"; break;
            case "center": 
                configNotify.addclass += " stack-bar-top";
                configNotify.width = "100%";
            break;
        }
    
    new PNotify(configNotify);   
}            