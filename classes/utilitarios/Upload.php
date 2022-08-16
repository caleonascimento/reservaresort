<?php
class Upload
{
    private $arquivo_permissao;
    private $sDir;
    private $max_filesize;
    private $idioma;
    private $error = 0;
    private $file_type;
    private $file_name;
    private $file_size;
    private $nAltura;
    private $nLargura;
    private $temp;

    function __construct($permissao = "", $max_file = 1200000000, $sDir = "arquivos", $idioma = "portugues")
    {
        if (empty($permissao))
            $permissao = ["application/pdf"];
        $this->arquivo_permissao = $permissao;

        $this->max_filesize = $max_file;
        $this->sDir = $sDir;
        $this->idioma = $idioma;
    }

    function pegaExtensao($file)
    {
        return strtolower(strrchr($file, '.'));
    }

    function putFile($oFileName, $oFileType, $oFileSize, $oFileTmpName, $sArqDescricao){
        //var_dump($this->file_name = $sArqDescricao . $this->pegaExtensao($oFileName));
        $this->file_type = strtok($oFileType, ";");
        $this->file_size = $oFileSize;
        $this->temp = $oFileTmpName;  //upload para o diretorio temp
        
        $this->file_name = $sArqDescricao . $this->pegaExtensao($oFileName);
       
        $this->sDir; //$sDiretorio . "/";
        if ($this->file_type != $this->arquivo_permissao)
            $this->Error(1);

        if ($this->file_size <= 0 || $this->file_size > $this->max_filesize)
            $this->Error(2);

        if (!$this->error) {
            $filename = basename($this->file_name);

            if (!is_dir($this->sDir))
                die("Diretório inexistente");

            if (!empty($this->sDir))
                $sArquivo = $this->sDir . "/" . $this->file_name;
            else
                $sArquivo = $this->file_name;

                

            if (!is_uploaded_file($this->temp)) $this->Error(3);

            if (!move_uploaded_file($this->temp, $sArquivo)) {
                $this->Error(4);
            } else {
                return ['erro' => $this->error, 'url' => $sArquivo,'doc_url' => $this->sDir];
            }
            return false;
        } else {
            return ['erro' => $this->error, 'url' => ''];
        }

        die();
    }

    function verificaTamanhodaImagem($oFile, $nLargura, $nAltura)
    {
        $this->nLargura = $nLargura;
        $this->nAltura =  $nAltura;

        switch ($oFile['type']) {
            case "image/jpeg":
            case "image/jpg":
                $img = imagecreatefromjpeg($oFile['tmp_name']);
                break;
            case "image/gif":
                $img = imagecreatefromgif($oFile['tmp_name']);
                break;
            case "image/png":
                $img = imagecreatefrompng($oFile['tmp_name']);
                break;
            default:
                $this->Error(4);
        }

        $x = (isset($img)) ? imagesx($img) : '';
        if ($this->nLargura  != $x) {
            $this->Error(7);
        }

        $y = (isset($img)) ? imagesy($img) : '';
        if ($this->nAltura  != $y) {
            $this->Error(6);
        }

        if ($this->error) {
            echo "<script>alert('" . $this->error . "');</script>";
            return false;
        } else {
            return true;
        }
    }



    function Error($op)
    {

        switch ($op) {

            case 0:
                return true;
                break;
            case 1:
                $this->error = "Erro 1: Este tipo de arquivo não tem permissão para upload : {$this->file_type}.";
                break;
            case 2:
                $this->error = "Erro 2: Erro no tamanho do arquivo: " . number_format(($this->file_size / 1024 / 1024), 2, ',', '.') . " mb. Tamanho Maximo é " . number_format(($this->max_filesize / 1024 / 1024), 2, ',', '.') . "mb !";
                break;
            case 3:
                $this->error = "Erro 3: Ocorreu um erro na transfêrencia do arquivo: {$this->file_name}.";
                break;
            case 4:
                $this->error = "Erro 4: Ocorreu um erro na transfêrencia de {$this->temp} para {$this->file_name}.";
                break;
            case 5:
                $this->error = "Erro 5: Já existe um arquivo com este nome, renomeie o arquivo {$this->file_name} e tente novamente! ";
                break;
            case 6:
                $this->error = "Erro 6: A altura do arquivo deve ser {$this->nAltura} px";
                break;
            case 7:
                $this->error = "Erro 7: A largura do arquivo deve ser {$this->nLargura} px";
                break;
        }

        return $this->error;
    }
}
?>