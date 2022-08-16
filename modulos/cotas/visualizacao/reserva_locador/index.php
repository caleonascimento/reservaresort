<?php
 $voReservaLocador = @$_REQUEST['voReservaLocador'];
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
                     <h2 class="card-title">reserva_locador</h2>
               </header>
               <div class="card-body">
     		    <form method="post" action="" name="formReservaLocador" id="formReservaLocador" class="formulario">
     			 <div class='form-group col-md-3 select-acoes'>
     				 <select class="form-control Acoes" name="acoes" id="acoesReservaLocador" onChange="JavaScript: submeteForm('ReservaLocador')">
     					<option value="" selected>Ações...</option>
     					<option value="?action=ReservaLocador.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo reserva_locador</option>
     					<option value="?action=ReservaLocador.preparaFormulario&sOP=Alterar" lang="1">Alterar reserva_locador selecionado</option>
     					<option value="?action=ReservaLocador.preparaFormulario&sOP=Detalhar" lang="1">Detalhar reserva_locador selecionado</option>
     					<option value="?action=ReservaLocador.processaFormulario&sOP=Excluir" lang="2">Excluir reserva_locador(s) selecionado(s)</option>
     				</select>
     			 </div>
 			 <?php if(is_array($voReservaLocador)){ ?>                                          
 				   <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                        <thead>
                                            <tr>
                                               <th width="1%">
                                                     <a href="javascript: marcarTodosCheckBoxFormulario('ReservaLocador')"><i class="icon fa fa-check"></i></a>
                                               </th>
                                               
														 <th width="1%">Id</th>
														 <th>IdReservaCota</th>
														 <th>IdUsuario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
 					 <?php foreach($voReservaLocador as $oReservaLocador){ ?>                                                  
 					        <tr>
                                                    <td><input onClick="JavaScript: atualizaAcoes('ReservaLocador')" type="checkbox" value="<?php echo $oReservaLocador->getId(); ?>" name="fIdReservaLocador[]" /></td>
                                                         						
									 <td><?php echo $oReservaLocador->getId(); ?></td>						
									 <td><?php echo $oReservaLocador->getIdReservaCota(); ?></td>						
									 <td><?php echo $oReservaLocador->getIdUsuario(); ?></td>
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