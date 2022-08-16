<!-- start: header -->
<?php
//Configura o array para todos os tipos de notificações
$vTiposNotificacoes = array(
	"TAREFA" => ['titulo'=>"Tarefas", 'icone'=>"fas fa-tasks"], 
	"MENSAGEM" => ['titulo'=>"Mensagens", 'icone'=>"fas fa-envelope"],
	"ALERTA" => ['titulo'=>"Alertas", 'icone'=> "fas fa-bell"]);
?>

<header class="header">
				<div class="logo-container">
					<a href="#" class="logo">
						<img src="img/logo.png"  height="35" alt="Logo Principal" />
					</a>
					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="pages-search-results.html" class="search nav-form">
						<div class="input-group">
							<input type="text" class="form-control" name="q" id="q" placeholder="Buscar.. ">
							<span class="input-group-append">
								<button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
					<ul class="notifications">

						<?php foreach ($vTiposNotificacoes as $tipo => $vNotifTipo) { 
								//Pega o total de notificações não lidas (clicadas)
								$oTotalNotificacao = $this->executarQuery("SELECT COUNT(*) as total FROM notificacao WHERE tipo='".$tipo."' AND  ativo=1 AND (visualizada is NULL OR visualizada=0)")[0];
								//Pega todas as Notificações ativas
								$voNotificacao = $this->recuperar("Notificacao", ['tipo'=>$tipo, 'ativo'=>1], " ORDER BY id DESC, visualizada LIMIT 6");
							?>
							<li>
								<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
									<i class="<?php echo $vNotifTipo['icone'];?>"></i>
									<?php if($oTotalNotificacao->total){ ?>
											<span class="badge total<?php echo $tipo;?>"><?php echo $oTotalNotificacao->total;?></span>
									<?php } ?>
								</a>
				
								<div class="dropdown-menu notification-menu">
									<div class="notification-title">
									<?php if($oTotalNotificacao->total){ ?>
											<span class="float-right badge badge-default total<?php echo $tipo;?>" ><?php echo $oTotalNotificacao->total;?></span>
									<?php } ?>
										<?php echo $vNotifTipo['titulo'];?>
									</div>
				
									<div class="content">
										<ul>
											<?php foreach ($voNotificacao as $oNotificacao) {
												$bVisualizada = $oNotificacao->getVisualizada()?true:false;
												$sLink = ($bVisualizada)?($oNotificacao->getLink()?$oNotificacao->getLink():'#'):'#'; ?>
												<li>
													<a href="<?php echo $sLink;?>" class="clearfix <?php echo (!$bVisualizada)?'viewNotify':'';?>" data-id="<?php echo $oNotificacao->getId();?>"
															data-link="<?php echo $oNotificacao->getLink();?>" data-tipo="<?php echo $oNotificacao->getTipo();?>">
														<!-- <span class="title">Joseph Doe</span> -->
														<span class="message <?php echo (!$bVisualizada)?'font-weight-bold':'';?>">
															<?php echo substr($oNotificacao->getMensagem(),0, 80);?> 
															<?php echo (strlen($oNotificacao->getMensagem())>80)?"...":'';?>
														</span>
													</a>
												</li>
											<?php } ?>
										</ul>
				
										<hr />
				
										<div class="text-right">
											<a href="?action=AcessoUsuario.Notificacoes&tipo=<?php echo $tipo;?>" class="view-more">Ver todas</a>
										</div>
									</div>
								</div>
							</li>
						<?php } ?>	
					
					</ul>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="img/!logged-user.jpg" alt="Joseph Doe" class="rounded-circle" data-lock-picture="img/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?php echo $_SESSION['oUsuario']->getNome();?></span>
								<!-- <span class="role">administrator</span> -->
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled mb-2">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="?action=AcessoUsuario.viewUser"><i class="fas fa-user"></i> Meus Dados</a>
								</li>
							
								<li>
									<a role="menuitem" tabindex="-1" href="login.php"><i class="fas fa-power-off"></i> Sair</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>