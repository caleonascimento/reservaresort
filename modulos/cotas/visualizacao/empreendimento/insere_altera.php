<?php
 $sOP = $_REQUEST['sOP'];
 $oEmpreendimento = $_REQUEST['oEmpreendimento'];
 #GET_VETOR_OBJETOS#
 
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


		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type='text/javascript' src='http://files.rafaelwendel.com/jquery.js'></script>
        <script type='text/javascript' src='cep.js'></script>
     </head>
	 	
 
     <?php include_once("includes/head-body.php"); ?>
 
 	       <!-- start: page -->
 		<div class="row mt-5">
 		   <div class="col-lg-12">
 			 <form id="summary-form" action="?action=Empreendimento.processaFormulario" class="form-horizontal" name="formEmpreendimento" method="post">
 				 <input type="hidden" name="sOP" value="<?php echo $sOP; ?>" />
                                  <input type="hidden" name="fId" value="<?php echo (is_object($oEmpreendimento)) ? $oEmpreendimento->getId() : ""; ?>" />
 				 <section class="card">
 					 <header class="card-header">
 						 <div class="card-actions">
 							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 							<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
 						</div>
 						<h2 class="card-title"><?php echo $sOP; ?> Empreendimento </h2>
 						<!--<p class="card-subtitle"> Validation summary will display an error list above the form. </p>-->
 					</header>
 					<div class="card-body"> 						
							<input type='hidden' name='fId' value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getId() : ""; ?>'/>
							<div class="row form-group">

								<div class="col-lg-7">
									<label class="col-form-label" for="Nome">Nome:<span class="required">*</span></label>
									<input class="form-control" type='text' id='Nome' placeholder='Nome' name='fNome'  required   value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getNome() : ""; ?>' title="Este campo é obrigatório." />
								</div>
							</div>
							<div class="row form-group">

								<div class="col-lg-3">
									<label class="col-form-label" for="Cep">CEP:<span class="required">*</span></label>
									<input class="form-control" type='text' id='cep' placeholder='CEP' name='fCep'  required   value='<?php echo ($oCliente) ? $oCliente->getCep() : ""; ?>' title="Cep é obrigatório." />
								</div>

								<div class="col-lg-4">
									<label class="form-label" for="Tipo">Tipo:<span class="required">*</span></label>
									<select class="form-control" type='text' id='Tipo' placeholder='Tipo' name='fTipo'  required  onKeyPress="TodosNumero(event);" value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getTipo() : ""; ?>' title="Este campo é obrigatório." />
										<option value="">Selecione</option>
										<option value="1">Resort</option>
										<option value="2">Residencial</option>
									</select>
								</div>
							</div>
							<div class="row form-group">
								
								<div class="col-lg-7">
									<label class="form-label" for="Endereco">Endereço:<span class="required">*</span></label>
									<input class="form-control" type='text' id='Logradouro' placeholder='Endereco' name='fEndereco'  required  onKeyPress="TodosNumero(event);" value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getEndereco() : ""; ?>' title="Este campo é obrigatório." />
								</div>
								
							</div>
							<div class="row form-group">

								<div class="col-lg-7">
									<label class="col-form-label" for="Descricao">Descricao:</label>
									<input class="form-control" type='text' id='Descricao' placeholder='Descricao' name='fDescricao' value='<?php echo ($oEmpreendimento) ? $oEmpreendimento->getDescricao() : ""; ?>' title="Este campo é obrigatório." />
								</div>

							</div>

							<div class="row">
								<div class="col-7">
									<header class="card-header">
										<h2 class="card-title">Tipos de Unidades</h2>
									</header>
								</div>
							</div>
							<div class="row">
								<div class="col-7">
								<table class="table table-bordered table-striped mb-0" >
                                        <thead>
                                            <tr>
                                               <th width="1%">
                                                     <a href="javascript: marcarTodosCheckBoxFormulario('Empreendimento')">
                                                            <i class="icon fa fa-check"></i>
                                                      </a>
                                               </th>
                                               <th>Nome</th>
                                                <th width="1%">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<tr>
												<td><input type="hidden" name=""></td>
												<td><input type="text" class="form-control"></td>
												<td><a href="#">+</a></td>
											</tr>
										</tbody>
								</table>
								</div>
							</div>
 					</div>
					
					

					<footer class="card-footer">
 						<div class="row justify-content-end">
 							<div class="col-sm-9">
 								<button type="button" class="btn btn-default" onclick="history.back(-1)"><i class="fa fa-reply fa-sm" aria-hidden="true"></i> Voltar</button>
 								<button class="btn btn-primary" type="submit"><?php echo $sOP; ?></button>
 							</div>
 						</div>
 					</footer>
 				</section>
 			</form>
 		  </div>
 	       </div>
 	      <!-- end: page -->
 
   <?php include_once("includes/foot-body.php"); ?>
  </html>

 
<script> type="text/javascript">
     

	 $(document).ready(function() {
		 $("#cep").mask("99.999-999");
 
 
		 function limpa_formulário_cep() {
			 // Limpa valores do formulário de cep.
			 $("#Logradouro").val("");
			 $("#Bairro").val("");
			 $("#Cidade").val("");
			 $("#Uf").val("");
		 }
 
		 //Quando o campo cep perde o foco.
		 $("#cep").blur(function() {
 
			 //Nova variável "cep" somente com dígitos.
			 var cep = $(this).val().replace(/\D/g, '');
 
			 //Verifica se campo cep possui valor informado.
			 if (cep != "") {
 
				 //Expressão regular para validar o CEP.
				 var validacep = /^[0-9]{8}$/;
 
				 //Valida o formato do CEP.
				 if(validacep.test(cep)) {
 
					 //Preenche os campos com "..." enquanto consulta webservice.
					 $("#Logradouro").val("...");
					 $("#Bairro").val("...");
					 $("#Cidade").val("...");
					 $("#Uf").val("...");
 
 
					 //Consulta o webservice viacep.com.br/
					 $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
						 console.log(dados)
						 if (!("erro" in dados)) {
							 //Atualiza os campos com os valores da consulta.
							 $("#Logradouro").val(dados.logradouro + ",  " + dados.bairro + " - "+ dados.localidade + "/"+ dados.uf);						
						 } //end if.
						 else {
							 //CEP pesquisado não foi encontrado.
							 limpa_formulário_cep();
							 alert("CEP não encontrado.");
						 }
					 });
				 } //end if.
				 else {
					 //cep é inválido.
					 limpa_formulário_cep();
					 alert("Formato de CEP inválido.");
				 }
			 } //end if.
			 else {
				 //cep sem valor, limpa formulário.
				 limpa_formulário_cep();
			 }
		 });
	 });

  </script>