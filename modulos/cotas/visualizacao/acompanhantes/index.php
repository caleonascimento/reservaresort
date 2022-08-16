<?php
 $voAcompanhantes = @$_REQUEST['voAcompanhantes'];
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
                     <h2 class="card-title">acompanhantes</h2>
               </header>
               <div class="card-body">
     		    <form method="post" action="" name="formAcompanhantes" id="formAcompanhantes" class="formulario">
     			 <div class='form-group col-md-3 select-acoes'>
     				 <select class="form-control Acoes" name="acoes" id="acoesAcompanhantes" onChange="JavaScript: submeteForm('Acompanhantes')">
     					<option value="" selected>Ações...</option>
     					<option value="?action=Acompanhantes.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo acompanhantes</option>
     					<option value="?action=Acompanhantes.preparaFormulario&sOP=Alterar" lang="1">Alterar acompanhantes selecionado</option>
     					<option value="?action=Acompanhantes.preparaFormulario&sOP=Detalhar" lang="1">Detalhar acompanhantes selecionado</option>
     					<option value="?action=Acompanhantes.processaFormulario&sOP=Excluir" lang="2">Excluir acompanhantes(s) selecionado(s)</option>
     				</select>
     			 </div>
 			 <?php if(is_array($voAcompanhantes)){ ?>                                          
 				   <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                        <thead>
                                            <tr>
                                               <th width="1%">
                                                     <a href="javascript: marcarTodosCheckBoxFormulario('Acompanhantes')"><i class="icon fa fa-check"></i></a>
                                               </th>
                                               
														 <th width="1%">Id</th>
														 <th>Nome</th>
														 <th>Cpf</th>
														 <th>DataNasc</th>
														 <th>IdReservaLocador</th>
                                            </tr>
                                        </thead>
                                        <tbody>
 					 <?php foreach($voAcompanhantes as $oAcompanhantes){ ?>                                                  
 					        <tr>
                                                    <td><input onClick="JavaScript: atualizaAcoes('Acompanhantes')" type="checkbox" value="<?php echo $oAcompanhantes->getId(); ?>" name="fIdAcompanhantes[]" /></td>
                                                         						
									 <td><?php echo $oAcompanhantes->getId(); ?></td>						
									 <td><?php echo $oAcompanhantes->getNome(); ?></td>						
									 <td><?php echo $oAcompanhantes->getCpf(); ?></td>						
									 <td><?php echo $oAcompanhantes->getDataNascFormatado(); ?></td>						
									 <td><?php echo $oAcompanhantes->getIdReservaLocador(); ?></td>
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