<?php
 $voCota = @$_REQUEST['voCota'];
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
                     <h2 class="card-title">cota</h2>
               </header>
               <div class="card-body">
     		    <form method="post" action="" name="formCota" id="formCota" class="formulario">
     			 <div class='form-group col-md-3 select-acoes'>
     				 <select class="form-control Acoes" name="acoes" id="acoesCota" onChange="JavaScript: submeteForm('Cota')">
     					<option value="" selected>Ações...</option>
     					<option value="?action=Cota.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo cota</option>
     					<option value="?action=Cota.preparaFormulario&sOP=Alterar" lang="1">Alterar cota selecionado</option>
     					<option value="?action=Cota.preparaFormulario&sOP=Detalhar" lang="1">Detalhar cota selecionado</option>
     					<option value="?action=Cota.processaFormulario&sOP=Excluir" lang="2">Excluir cota(s) selecionado(s)</option>
     				</select>
     			 </div>
 			 <?php if(is_array($voCota)){ ?>                                          
 				   <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                        <thead>
                                            <tr>
                                               <th width="1%">
                                                     <a href="javascript: marcarTodosCheckBoxFormulario('Cota')"><i class="icon fa fa-check"></i></a>
                                               </th>
                                               
														 <th width="1%">Id</th>
														 <th>Numero</th>
														 <th>IdUsuario</th>
														 <th>IdUnidade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
 					 <?php foreach($voCota as $oCota){ ?>                                                  
 					        <tr>
                                                    <td><input onClick="JavaScript: atualizaAcoes('Cota')" type="checkbox" value="<?php echo $oCota->getId(); ?>" name="fIdCota[]" /></td>
                                                         						
									 <td><?php echo $oCota->getId(); ?></td>						
									 <td><?php echo $oCota->getNumero(); ?></td>						
									 <td><?php echo $oCota->getIdUsuario(); ?></td>						
									 <td><?php echo $oCota->getIdUnidade(); ?></td>
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