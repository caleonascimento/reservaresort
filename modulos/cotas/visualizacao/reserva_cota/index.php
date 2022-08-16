<?php
 $voReservaCota = @$_REQUEST['voReservaCota'];
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
                     <h2 class="card-title">reserva_cota</h2>
               </header>
               <div class="card-body">
     		    <form method="post" action="" name="formReservaCota" id="formReservaCota" class="formulario">
     			 <div class='form-group col-md-3 select-acoes'>
     				 <select class="form-control Acoes" name="acoes" id="acoesReservaCota" onChange="JavaScript: submeteForm('ReservaCota')">
     					<option value="" selected>Ações...</option>
     					<option value="?action=ReservaCota.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo reserva_cota</option>
     					<option value="?action=ReservaCota.preparaFormulario&sOP=Alterar" lang="1">Alterar reserva_cota selecionado</option>
     					<option value="?action=ReservaCota.preparaFormulario&sOP=Detalhar" lang="1">Detalhar reserva_cota selecionado</option>
     					<option value="?action=ReservaCota.processaFormulario&sOP=Excluir" lang="2">Excluir reserva_cota(s) selecionado(s)</option>
     				</select>
     			 </div>
 			 <?php if(is_array($voReservaCota)){ ?>                                          
 				   <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                        <thead>
                                            <tr>
                                               <th width="1%">
                                                     <a href="javascript: marcarTodosCheckBoxFormulario('ReservaCota')"><i class="icon fa fa-check"></i></a>
                                               </th>
                                               
														 <th width="1%">Id</th>
														 <th>PeriodoIni</th>
														 <th>PeriodoFim</th>
														 <th>IdCota</th>
														 <th>Locacao</th>
                                            </tr>
                                        </thead>
                                        <tbody>
 					 <?php foreach($voReservaCota as $oReservaCota){ ?>                                                  
 					        <tr>
                                                    <td><input onClick="JavaScript: atualizaAcoes('ReservaCota')" type="checkbox" value="<?php echo $oReservaCota->getId(); ?>" name="fIdReservaCota[]" /></td>
                                                         						
									 <td><?php echo $oReservaCota->getId(); ?></td>						
									 <td><?php echo $oReservaCota->getPeriodoIniFormatado(); ?></td>						
									 <td><?php echo $oReservaCota->getPeriodoFimFormatado(); ?></td>						
									 <td><?php echo $oReservaCota->getIdCota(); ?></td>						
									 <td><?php echo $oReservaCota->getLocacao(); ?></td>
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