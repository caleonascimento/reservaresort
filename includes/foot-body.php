                        </div>  <!-- col -->
                    </div>
                    <!-- row content-page -->
                </div>
                <!-- col-xl-12 col-xs-12 -->
            </section>
            <!-- content-body -->
        </div>
        <!-- inner-wrapper -->
    </section>
    <!--section body-->
    <?php include_once("includes/javascript.php"); ?>

    <section role="main" class="content-footer">
        <?php include_once('includes/footer.php'); ?>
    </section>

    <?php if (isset($_SESSION['oMsg'])) { 
              switch ($_SESSION['oMsg']->type) {
                    case 1: $sTitle = "Erro"; break;
                    case 2: $sTitle = "Sucesso"; break;
                    case 3: $sTitle = "Atenção"; break;
                    case 4: $sTitle = "Nota"; break;
                    case 5: $sTitle = "Nota"; break;
                    default: $sTitle = "Info"; break;
              }
              ?><script> 
                    msgNotify("<?php echo $sTitle;?>", "<?php echo $_SESSION['oMsg']->sMsg;?>", <?php echo $_SESSION['oMsg']->type;?>);
              </script><?php 

            unset($_SESSION['oMsg']);
          } 
      
    ?>
</body>