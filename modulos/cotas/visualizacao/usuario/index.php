<?php
 $voUsuario = @$_REQUEST['voUsuario'];
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
                     <h2 class="card-title">Gerenciar Usuario</h2>
               </header>
               <div class="card-body">
     		    <form method="post" action="" name="formUsuario" id="formUsuario" class="formulario">
     			 <div class='form-group col-md-3 select-acoes'>
     				 <select class="form-control Acoes" name="acoes" id="acoesUsuario" onChange="JavaScript: submeteForm('Usuario')">
     					<option value="" selected>Ações...</option>
     					<option value="?action=Usuario.preparaFormulario&sOP=Cadastrar" lang="0">Cadastrar novo usuario</option>
     					<option value="?action=Usuario.preparaFormulario&sOP=Alterar" lang="1">Alterar usuario selecionado</option>
     					<option value="?action=Usuario.preparaFormulario&sOP=Detalhar" lang="1">Detalhar usuario selecionado</option>
     					<option value="?action=Usuario.processaFormulario&sOP=Excluir" lang="2">Excluir usuario(s) selecionado(s)</option>
     				</select>
     			 </div>
				  <?php if(is_array($voUsuario) && count($voUsuario)){ ?>                                          
 				   <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
                                        <thead>
                                            <tr>
                                               <th width="1%">
                                                     <a href="javascript: marcarTodosCheckBoxFormulario('Usuario')"><i class="icon fa fa-check"></i></a>
                                               </th>
                                               
														 <th width="1%">Id</th>
														 <th>Nome</th>
														 <th>Cpf</th>
														 <th>Rg</th>
														 <th>Endereco</th>
														 <th>Cep</th>
														 <th>Fone</th>
														 <th>Email</th>
														 <th>DataNasc</th>
														 <th>Tipo</th>
														 <th>IdAcessoUsuario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
 					 <?php foreach($voUsuario as $oUsuario){ ?>                                                  
 					        <tr>
                                                    <td><input onClick="JavaScript: atualizaAcoes('Usuario')" type="checkbox" value="<?php echo $oUsuario->getId(); ?>" name="fIdUsuario[]" /></td>
                                                         						
									 <td><?php echo $oUsuario->getId(); ?></td>						
									 <td><?php echo $oUsuario->getNome(); ?></td>						
									 <td><?php echo $oUsuario->getCpf(); ?></td>						
									 <td><?php echo $oUsuario->getRg(); ?></td>						
									 <td><?php echo $oUsuario->getEndereco(); ?></td>						
									 <td><?php echo $oUsuario->getCep(); ?></td>						
									 <td><?php echo $oUsuario->getFone(); ?></td>						
									 <td><?php echo $oUsuario->getEmail(); ?></td>						
									 <td><?php echo $oUsuario->getDataNascFormatado(); ?></td>						
									 <td><?php echo $oUsuario->getTipo(); ?></td>						
									 <td><?php echo $oUsuario->getIdAcessoUsuario(); ?></td>
                                                 </tr>
							 <?php } ?>  
 					<?php } else { ?> 
						<table class="table table-bordered table-striped mb-0" >
                              <tr><td>Nem um usuario cadastrado.</td></tr>
                        </table>
						
 				      </tbody>
                                   </table>
 			 <?php } ?>          
                     </form>
               </div><!-- card-body -->
			   
          </section><!-- card -->
 
 <?php include_once("includes/view/js_index.php")?>
 <?php include_once("includes/foot-body.php")?>
 </html>