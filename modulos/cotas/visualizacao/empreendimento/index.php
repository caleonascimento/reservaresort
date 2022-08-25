<?php
 $voEmpreendimento = @$_REQUEST['voEmpreendimento'];
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
                     <h2 class="card-title">Gerenciar Empreendimento</h2>
               </header>
               <div class="card-body">
     		    <form method="post" action="" name="formEmpreendimento" id="formEmpreendimento" class="formulario">
     			 <div class='form-group col-md-3 select-acoes'>
     				 <select class="form-control Acoes" name="acoes" id="acoesEmpreendimento" onChange="JavaScript: submeteForm('Empreendimento')">
     					<option value="" selected>Ações...</option>
     					<option value="?action=Empreendimento.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo empreendimento</option>
     					<option value="?action=Empreendimento.preparaFormulario&sOP=Alterar" lang="1">Alterar empreendimento selecionado</option>
     					<option value="?action=Empreendimento.preparaFormulario&sOP=Detalhar" lang="1">Detalhar empreendimento selecionado</option>
     					<option value="?action=Empreendimento.processaFormulario&sOP=Excluir" lang="2">Excluir empreendimento(s) selecionado(s)</option>
     				</select>
     			 </div>
 			 <?php if(is_array($voEmpreendimento) && count($voEmpreendimento)){ ?>                                          
 				   <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                        <thead>
                                            <tr>
                                               <th width="1%">
                                                     <a href="javascript: marcarTodosCheckBoxFormulario('Empreendimento')"><i class="icon fa fa-check"></i></a>
                                               </th>
                                               
														 <th width="1%">Id</th>
														 <th>Endereco</th>
														 <th>Cep</th>
														 <th>Tipo</th>
														 <th>Descricao</th>
                                            </tr>
                                        </thead>
                                        <tbody>
 					 <?php foreach($voEmpreendimento as $oEmpreendimento){ ?>                                                  
 					        <tr>
                                                    <td><input onClick="JavaScript: atualizaAcoes('Empreendimento')" type="checkbox" value="<?php echo $oEmpreendimento->getId(); ?>" name="fIdEmpreendimento[]" /></td>
                                                         						
									 <td><?php echo $oEmpreendimento->getId(); ?></td>						
									 <td><?php echo $oEmpreendimento->getEndereco(); ?></td>						
									 <td><?php echo $oEmpreendimento->getCep(); ?></td>						
									 <td><?php echo $oEmpreendimento->getTipo(); ?></td>						
									 <td><?php echo $oEmpreendimento->getDescricao(); ?></td>
                                                 </tr>
 					<?php } ?>                                  
 				      </tbody>
                                   </table>
 			 <?php } else { ?>
                        <table class="table table-bordered table-striped mb-0" >
                              <tr><td>Nem um item cadastrado.</td></tr>
                        </table>
                   
                 <?php } ?>          
                     </form>
               </div><!-- card-body -->
          </section><!-- card -->
 
 <?php include_once("includes/view/js_index.php")?>
 <?php include_once("includes/foot-body.php"); ?>
 </html>