<?php

class GeraPdf {

    public function config($html){

        define('_MPDF_PATH', '../../../classes/mpdf/');

        include(_MPDF_PATH.'mpdf.php');

        $mpdf=new mPDF('utf-8', 'A4-L','9','', 0, '', 2, 0, 15, 15, 9);

        $rodape = "Página {PAGENO} de {nb}";

        $mpdf->SetHTMLFooter($rodape);

        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }

}
?>