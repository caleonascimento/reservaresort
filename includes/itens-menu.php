<?php 
/**
 * Menu dinâmico ---------------------------------------------------
 * Para qualquer alteração no menu deve-se alterar o array $vvMenu,
 * onde dados da configuração podem ser setados nos atributos: 
 * link, icon, target, class e subitem. Podendo atingir até 3 níveis.
 * 
 * "Menu nvl1" => [
 *       'link'=>"#",
 *       'icon'=>"",
 *       'target'=>"",
 *       'class'=>"",
 *       'subitem'=> [
 *             "Menu nvl2" => [ 
 *                     'link'=>"#",
 *                      'target'=>"",
 *                      'class'=>"", 
 *                      'subitem'=> [ 
 *                            "Menu nvl3" => [
 *                                  'link'=>"#",
 *                                  'target'=>"",
 *                                  'class'=>""
 *                             ]
 *                       ]
 *             ]
 *       ]
 * ]
 */

$vvMenu = array(
        "Home" => [ 
            'link'=>ROOT_PATH,
            'icon'=>"fas fa-home",
            'target'=>"",
            'class'=>"",
            'subitem'=>[]
    ],

    // ---- Incluir aqui novos itens

    "Empreendimentos" => [
        'link'=> "#",
        'icon'=> "fas fa-university",
        'target'=> "",
        'class'=>"",
        'subitem'=> [
            "Gerenciar Empreendimento" => [
                'link'=> "?action=Empreendimento.preparaLista",
                'target'=> "",
                'class'=>"",
                'subitem'=> []                    
            ],"Gerenciar Cotas" => [
                'link'=> "?action=Cota.preparaLista",
                'target'=> "",
                'class'=>"",
                'subitem'=> []                                    
            ],"Gerenciar Usuario" => [
                'link'=> "?action=Usuario.preparaLista",
                'target'=> "",
                'class'=>"",
                'subitem'=> [],
                        ]
                    ]          
                ],
        "Reservas" => [
            'link'=> "#",
            'icon'=> "fas fa-marker",
            'target'=> "",
            'class'=>"",
            'subitem'=> [
                "Calendario" => [
                    'link'=> "?action=Calendario.preparaLista",
                    'target'=> "",
                    'class'=>"",
                    'subitem'=> []
            ],"Unidade" => [
                'link'=> "?action=Unidade.preparaLista",
                'target'=> "",
                'class'=>"",
                'subitem'=> [],
                    ]
                ]
            ],
     //-------------------------------
// Empreendimento.preparaFormulario&sOP=Cadastrar 

    "Acesso" => [
        'link'=>"#",
        'icon'=>"fa fa-cog",
        'target'=>"",
        'class'=>"",
        'accessAllowUri' => "?action=AcessoGrupo.preparaLista", 
        'subitem'=>[
            'Gerenciar Perfis' => [
                'link'=>"?action=AcessoGrupo.preparaLista",
                'target'=>"",
                'class'=>"",
                'accessAllowUri' => "",
                'subitem'=> []
            ],
            'Gerenciar Páginas e Transações' => [
                'link'=>"?action=AcessoModuloTransacao.preparaLista",
                'target'=>"",
                'class'=>"",
                'accessAllowUri' => "?action=AcessoModuloTransacao.preparaLista", 
                'subitem'=> []
            ],
            'Gerenciar Usuários' => [
                'link'=>"?action=AcessoUsuario.preparaLista",
                'target'=>"",
                'class'=>"",
                'accessAllowUri' => "?action=AcessoUsuario.preparaLista", 
                'subitem'=> []
            ]
        ]
    ]
);

?>