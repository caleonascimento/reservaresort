<?php
class UploadBD {
  var $error = 0;
  var $max_file = 20971520;

  
  public function setSizeMaxFile( $max_file ) {
      $this->max_file = $max_file;
  }

  public function getSizeMaxFile() {
      return $this->max_file;
  }
  
  public function convertBin($vFile){
    $fp = fopen($vFile['tmp_name'], 'rb');
    $content = base64_encode(fread($fp, $vFile['size']));
    fclose($fp);
    
    return $content;
  }
  
  public function pegaExtensao($vfile) {
    $sExtensao = pathinfo($vfile['name'], PATHINFO_EXTENSION);
    return $sExtensao;
  }
  
  public function Error($file){
    
    $file = (array)$file;
    $sum = 0;
    
    foreach ($file as $var) {
      $var = (array)$var;
      
      switch ($var['error']) {
        
        case(1):
          $this->error = "O arquivo ".$var['name']." enviado excede o tamanho máximo permitido.";
          break;
        
        case(2):
          $this->error = "O arquivo ".$var['name']." enviado excede o tamanho máximo permitido.";
          break;
        
        case(3):
          $this->error = "O upload do arquivo ".$var['name']." foi feito parcialmente.";
          break;
        
        case(4):
          $this->error = "Nenhum arquivo foi anexado.";
          break;
        
        case(6):
          $this->error = "Não foi possível enviar o arquivo ".$var['name'].".";
          break;
        
        case(7):
          $this->error = "Não foi possível enviar o arquivo ".$var['name'].".";
          break;
        
        case(8):
          $this->error = "Não foi possível enviar o arquivo ".$var['name'].".";
          break;
      }
      
      if ($var['size'] > $this->max_file) {
        $this->error = "O arquivo ". $var['name']." excede o tamanho máximo permitido de ".By2M($this->max_file);
      }
      $sum += 1;
    }
    
    return $this->error;
    
  }
}
?>