<?php 
/**
 * 1. Verificar se a url possui alguma ocorrencia de '&';
 * 2. Separa a url a partir dos '&' em um vetor
 * 3. busca a parte do vetor que possui sOP e action
 * 4. Monta o array com action e sOP
 */


define('ROOT_PATH',               "/ModAdminPanel_v1/Sistema/");

/**
 * NOTAS DO BREADCRUMB
 * O breadcrumb é montado automaticamente através do array '$vvBreadcrumb', 
 * é recuperada a url da requisição e verificado nas url's do array abaixo.
 * Um item pode ser adicionado em qualquer nível dentro de Home, basta adicionar 
 * dentro de 'subitens'=>array() um conjunto de dados: 
 *              ['label' => "",
 *              'icon' => '',
 *              'url' => "",
 *              'subitens' => array() ]
 * Podendo inserir em vários níveis dependendo da estrutura organizacional das páginas.
 */
$vvBreadcrumb = array( 
         'label' => "Home",
         'icon' => 'fas fa-home',
         'url' => ROOT_PATH,

         //Adicionar novos itens a partir do array abaixo:
         'subitens' => array([
                        'label' => "Acesso",
                        'icon' => 'fa fa-cog',
                        'url' => "?action=AcessoGrupo.preparaLista",

                        'subitens' => array(
                                            [
                                             'label' => "Configurar Perfíl",
                                             'url' => "?action=AcessoPermissaoGrupo.preparaFormulario&sOP=Detalhar&nIdAcessoGrupo="
                                            ],
                                            [
                                             'label' => "Alterar Grupo de Usuários",
                                             'url' => "?action=AcessoGrupo.preparaFormulario&sOP=Alterar"
                                            ],
                                            [
                                             'label' => "Gerenciar Páginas e Transações",
                                             'url' => "?action=AcessoModuloTransacao.preparaLista"
                                            ],
                                            [
                                              'label' => "Cadastrar Grupo de Usuários",
                                              'url' => "?action=AcessoGrupo.preparaFormulario&sOP=Cadastrar"  
                                            ],
                                            [
                                             'label' => "Gerenciar Usuários",
                                             'url' => "?action=AcessoUsuario.preparaLista"
                                             ])
                         ]
                      // Segue abaixo o modelo para dicionar novos itens:
                      //,['label' => "",
                      //  'icon' => '',
                      //  'url' => "",
                      //  'subitens' => array(
                      //                ['label' => "",
                      //                 'url' => "",
                      //                 'icon' => '',
                      //                 'subitens' => array()]
                      //   )
                      // ]
                         )
);


/**
 * Tree Search Recursive
 * Retorna o caminho do conjunto de chaves do array para o breadcrumb da página acessada, caso ela esteja mapeada no array '$vvBreadcrumb'.
 */
function searchTree($needle, $haystack) {
    //Formata matriz para array unidimencional
    $vColumns = array_map('urlFormat', array_column($haystack, 'url'));
    //Busca o item no array
    $key = array_search($needle, $vColumns);

    //Caso o item não seja encontrado, varre a cada item do array iniciando busca em profundidade na matriz
    if($key === false) {
        foreach (array_keys($vColumns) as $k1) 
            //Verifica se o elemento possui subitens, caso sim inicia uma recursão para o array do item
            if( isset($haystack[$k1]['subitens']) && is_array($haystack[$k1]['subitens']) && !empty($haystack[$k1]['subitens']) ) 
                if($nKey = searchTree($needle, $haystack[$k1]['subitens'])) 
                    return [$k1=>$nKey];
                    
            //Caso não encontre nada em nenhum dos itens da dimensão corrente do array retorna falso
            return false;
    //Caso encontre o $needle no array retorna um conjunto chave valor
    } else 
        return [$key=>true]; 
 }


//Monta e imprime o BreadCrumb 
 function breadcrumb($vvBCrumb, $vvPKeys) {
     $vItem = $vvBCrumb[key($vvPKeys)];

     $icon = (!empty($vItem['icon']))?'<i class="'.$vItem['icon'].'"></i> ':'';

     $url = (!empty($vItem['url']))? $vItem['url'] : '#';

      echo "<li><a href='".$url."'>".$icon. $vItem['label'] ."</a></li>";

     $vValue = current($vvPKeys);
     if(is_array($vValue) && !empty($vValue))
            breadcrumb($vItem['subitens'], $vValue);
 }

 //Função para formatar a url de dentro do array no padrão ?action=[]&sOP=[] ignorando outros argumentos
 function urlFormat($sUrl) {
    $action = $sOP = "";
    $vAux = explode("&", substr($sUrl, 1, strlen($sUrl)));
    foreach ($vAux as $sItem) 
        if((strpos($sItem, 'action=')!== false))
             $action = $sItem;
        elseif((strpos($sItem, 'sOP=')!== false))
             $sOP = '&'.$sItem;

    return '?'.$action.$sOP;
 }

//----------------------------------------------------------------------------------------
//Pega a url atual e formata no mesmo padrão do array ?action=[]&sOP=[] ignorando outros argumentos
$sCurrentUrl = "?action=".$_GET['action']. ($_REQUEST['sOP']?"&sOP=".$_REQUEST['sOP']:'');
$vvPathKeys = searchTree($sCurrentUrl, $vvBreadcrumb['subitens']);
?>

<div class="right-wrapper text-right pr-5">
  <?php if($vvBreadcrumb) { ?>
        <ol class="breadcrumbs">
            <li>
                <a href="<?php echo $vvBreadcrumb['url'];?>">
                    <i class="fas fa-home"></i>
                    <?php echo $vvBreadcrumb['label'];?>
                </a>
            </li>
            <?php breadcrumb($vvBreadcrumb['subitens'], $vvPathKeys);?>
        </ol>
  <?php } ?>



</div>