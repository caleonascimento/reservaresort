<?php
//Os itens do menu devem ser incluidos nesse arquivo
include_once('includes/itens-menu.php');
?>
    <!-- start: sidebar -->
    <aside id="sidebar-left" class="sidebar-left" >
    
        <div class="sidebar-header">
            <div class="sidebar-title">
                Menu
            </div>
            <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>
    
        <div class="nano">
            <div class="nano-content">
                <nav id="menu" class="nav-main" role="navigation">
                
                    <ul class="nav nav-main">
                        <?php if($vvMenu) 
                                 foreach ($vvMenu as $item => $vAtrb) { 
                                     //Inserer a permissão de acesso, caso haja
                                     if(isset($vAtrb['accessAllowUri']) && !empty($vAtrb['accessAllowUri']))
                                        if(!FrontController::verificaPermissao($vAtrb['accessAllowUri']))
                                            continue;
                                        $sClass = "";
                                        if($vAtrb['subitem'])
                                            $sClass = "nav-parent "; 
                                            ?>
                                            <li class="<?php echo $sClass.$vAtrb['class'];?>">
                                                <a class="nav-link" href="<?php echo $vAtrb['link'];?>" target="<?php echo $vAtrb['target'];?>">
                                                    <i class="<?php echo $vAtrb['icon'];?>" aria-hidden="true"></i>
                                                    <span><?php echo $item;?></span>
                                                </a>   
                                            <?php if($vAtrb['subitem']) { ?>
                                                <ul class="nav nav-children">
                                                <?php foreach ($vAtrb['subitem'] as $subItem => $vSubAtrb) {
                                                        //Inserer a permissão de acesso, caso haja
                                                        if(isset($vSubAtrb['accessAllowUri']) && !empty($vSubAtrb['accessAllowUri']))
                                                            if(!FrontController::verificaPermissao($vSubAtrb['accessAllowUri']))
                                                                continue;
                                                          
                                                        $sClass2 = "";
                                                        if($vSubAtrb['subitem'])
                                                            $sClass2 = "nav-parent "; ?>   
                                                    <li class="<?php echo $sClass2.$vSubAtrb['class'];?>">
                                                        <a class="nav-link" href="<?php echo $vSubAtrb['link'];?>">
                                                            <?php echo $subItem;?>
                                                        </a>
                                                        <?php if($vSubAtrb['subitem']) { ?>
                                                            <ul class="nav nav-children">
                                                                <?php foreach ($vSubAtrb['subitem'] as $subItem2 => $vSubAtrb2) { 
                                                                        //Inserer a permissão de acesso, caso haja
                                                                        if(isset($vSubAtrb2['accessAllowUri']) && !empty($vSubAtrb2['accessAllowUri']))
                                                                            if(!FrontController::verificaPermissao($vSubAtrb2['accessAllowUri']))
                                                                                continue;
                                                                    ?>
                                                                        <li class="<?php echo $vSubAtrb2['class'];?>">
                                                                            <a class="nav-link" href="<?php echo $vSubAtrb2['link'];?>">
                                                                                <?php echo $subItem2;?>
                                                                            </a>
                                                                        </li>
                                                                <?php } ?>
                                                            </ul>
                                                        <?php } ?>
                                                    </li>
                                                <?php } ?>
                                                </ul>
                                            <?php } ?> 
                                            </li>  
                           <?php     
                                 } ?>
                    </ul>
                </nav>
    
                <hr class="separator" />
<!--
                <div class="sidebar-widget widget-tasks">
                    <div class="widget-header">
                        <h6>Projects</h6>
                        <div class="widget-toggle">+</div>
                    </div>
                    <div class="widget-content">
                        <ul class="list-unstyled m-0">
                            <li><a href="#">Porto HTML5 Template</a></li>
                            <li><a href="#">Porto Admin</a></li>
                        </ul>
                    </div>
                </div> 
    
                <hr class="separator" />
-->
<!--
                <div class="sidebar-widget widget-stats">
                    <div class="widget-header">
                        <h6>Company Stats</h6>
                        <div class="widget-toggle">+</div>
                    </div>
                    <div class="widget-content">
                        <ul>
                            <li>
                                <span class="stats-title">Stat 1</span>
                                <span class="stats-complete">85%</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
                                        <span class="sr-only">85% Complete</span>
                                    </div>
                                </div>
                            </li>
                        
                            <li>
                                <span class="stats-title">Stat 3</span>
                                <span class="stats-complete">2%</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                                        <span class="sr-only">2% Complete</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> 
-->
            </div>
    
            <script>
                // Maintain Scroll Position
                if (typeof localStorage !== 'undefined') {
                    if (localStorage.getItem('sidebar-left-position') !== null) {
                        var initialPosition = localStorage.getItem('sidebar-left-position'),
                            sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                        
                        sidebarLeft.scrollTop = initialPosition;
                    }
                }
            </script>
            
    
        </div>
    
    </aside>
    <!-- end: sidebar -->
