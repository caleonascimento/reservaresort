<?php
 $voNotificacao = @$_REQUEST['voNotificacao'];
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
                     <h2 class="card-title">notificacao</h2>
               </header>
               <div class="card-body">
     		    <form method="post" action="" name="formNotificacao" id="formNotificacao" class="formulario">
     			 <div class='form-group col-md-3 select-acoes'>
     				 <select class="form-control Acoes" name="acoes" id="acoesNotificacao" onChange="JavaScript: submeteForm('Notificacao')">
     					<option value="" selected>Ações...</option>
     					<option value="?action=Notificacao.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo notificacao</option>
     					<option value="?action=Notificacao.preparaFormulario&sOP=Alterar" lang="1">Alterar notificacao selecionado</option>
     					<option value="?action=Notificacao.preparaFormulario&sOP=Detalhar" lang="1">Detalhar notificacao selecionado</option>
     					<option value="?action=Notificacao.processaFormulario&sOP=Excluir" lang="2">Excluir notificacao(s) selecionado(s)</option>
     				</select>
     			 </div>
 			 <?php if(is_array($voNotificacao)){ ?>                                          
 				   <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                        <thead>
                                            <tr>
                                               <th width="1%">
                                                     <a href="javascript: marcarTodosCheckBoxFormulario('Notificacao')"><i class="icon fa fa-check"></i></a>
                                               </th>
                                               
														 <th width="1%">Id</th>
														 <th>Usuário</th>
														 <th>Tipo</th>
														 <th>Mensagem</th>
														 <th>Visualizada?</th>
														 <th>Link</th>
														 <th>Ativa?</th>
														 <th>Criação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
 					 <?php foreach($voNotificacao as $oNotificacao){ ?>                                                  
 					        <tr>
                                                    <td><input onClick="JavaScript: atualizaAcoes('Notificacao')" type="checkbox" value="<?php echo $oNotificacao->getId(); ?>" name="fIdNotificacao[]" /></td>
                                                         						
									 <td><?php echo $oNotificacao->getId(); ?></td>						
									 <td><?php echo $oNotificacao->getIdUsuario(); ?></td>						
									 <td><?php echo $oNotificacao->getTipo(); ?></td>						
									 <td><?php echo $oNotificacao->getMensagem(); ?></td>						
									 <td><?php echo $oNotificacao->getVisualizada(); ?></td>						
									 <td><?php echo $oNotificacao->getLink(); ?></td>						
									 <td class="text-center"><?php echo ($oNotificacao->getAtivo())?Sim:Não; ?></td>						
									 <td><?php echo $oNotificacao->getGeracaoFormatado(); ?></td>
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