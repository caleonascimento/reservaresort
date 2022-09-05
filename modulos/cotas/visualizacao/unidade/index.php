<?php
 $voUnidade = @$_REQUEST['voUnidade'];
 ?>
     
     <!doctype html>
     <html class="fixed sidebar-left-collapsed" lang="pt-br">
     <head>
         <!-- Basic -->
         <meta charset="UTF-8">
     
         <title><?php echo SYSTEM_NAME. ' - '. SYSTEM_INITIALS; ?></title>
         <meta name="keywords" content="<?php echo KEYWORDS; ?>" />
         <meta name="description" content="<?php echo DESCRIPTION; ?>">
         <meta name="author" content="<?php echo AUTHOR; ?>">
         <?php include_once("includes/head.php"); ?>
         <!-- css custon -->
     </head>
     
     <?php include_once("includes/head-body.php"); ?>
 
   	<!-- start: page (main content) -->
         <section class="card">
               <header class="card-header">
                     <h2 class="card-title"><?php echo $oEmpreedimento->getNome();?></h2>
                     <h3>Gerenciar Unidades</h3>
               </header>
               <div class="card-body">
     		    <form method="post" action="" name="formUnidade" id="formUnidade" class="formulario">
     			 <div class='form-group col-md-3 select-acoes'>
     				 <select class="form-control Acoes" name="acoes" id="acoesUnidade" onChange="JavaScript: submeteForm('Unidade')">
     					<option value="" selected>Ações...</option>
     					<option value="?action=Unidade.preparaFormulario&sOP=Cadastrar&idEmpreendimento=<?php echo $_REQUEST['id'];?>" lang="0">Cadastrar novo unidade</option>
     					<option value="?action=Unidade.preparaFormulario&sOP=Alterar" lang="1">Alterar unidade selecionado</option>
     					<option value="?action=Unidade.preparaFormulario&sOP=Detalhar" lang="1">Detalhar unidade selecionado</option>
     					<option value="?action=Unidade.processaFormulario&sOP=Excluir" lang="2">Excluir unidade(s) selecionado(s)</option>
     				</select>
     			 </div>
 			 <?php if(is_array($voUnidade)){ ?>                                          
 				   <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                        <thead>
                                            <tr>
                                               <th width="1%">
                                                     <a href="javascript: marcarTodosCheckBoxFormulario('Unidade')"><i class="icon fa fa-check"></i></a>
                                               </th>
                                               
														 <th width="1%">Id</th>
														 <th>Tipo</th>
														 <th>Descricao</th>
														 <th>Lotacao</th>
														 <th>IdEmpreendimento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
 					 <?php foreach($voUnidade as $oUnidade){ ?>                                                  
 					        <tr>
                                                    <td><input onClick="JavaScript: atualizaAcoes('Unidade')" type="checkbox" value="<?php echo $oUnidade->getId(); ?>" name="fIdUnidade[]" /></td>
                                                         						
									 <td><?php echo $oUnidade->getId(); ?></td>						
									 <td><?php echo $oUnidade->getTipo(); ?></td>						
									 <td><?php echo $oUnidade->getDescricao(); ?></td>						
									 <td><?php echo $oUnidade->getLotacao(); ?></td>						
									 <td><?php echo $oUnidade->getIdEmpreendimento(); ?></td>
                                                 </tr>
 					<?php } ?>                                  
 				      </tbody>
                                   </table>
 			 <?php } ?>          
                     </form>
               </div><!-- card-body -->
          </section><!-- card -->
 
 <?php include_once("includes/view/js_index.php")?>
 <?php include_once("includes/foot-body.php"); ?>
 </html>