
<?php
use Cake\Datasource\ConnectionManager;
require_once(ROOT . DS . 'vendor' . DS . 'tcpdf' . DS . 'tcpdf.php');
$connection = ConnectionManager::get('default');
/////////////////////////
// set document information
//debug($lignes);die;
$pdf = new \TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('atlanta');
$pdf->SetTitle('Exemple de document PDF');
// $pdf->SetSubject('Utilisation de TCPDF dans CakePHP');
// $pdf->SetKeywords('CakePHP, TCPDF, PDF');
 //$ent='entete.jpg'; 

  
// $pdf->SetHeaderData('logo.png', 45,'');      

//  $footer = 'atlanta';
 
// $aaa = "abc";
// $pdf->xfootertext = $footer;
// $pdf->xfootertext1 = '';
// $pdf->xfootertext2 = '';

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'ltr';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
// set font
$pdf->SetFont('dejavusans', 'A', 9);

// add a page
//$pdf->SetFont('dejavusans', '', 12);
$pdf->AddPage('L');
//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

//$pdf->SetFont('times', 'A', 11);
   
$cadre = 'style="position: relative; top: 0;"';
$cadrei = 'style="font-family:dejavusans, Helvetica, sans-serif;font-size:12px; border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;padding: 2px;"';
$cadre2 = 'style="font-family:dejavusans, Helvetica, sans-serif;font-size:15px; border-right:1px solid black;border-left:1px solid black;padding: 5px;"';
$cadre3 = 'style="font-family:dejavusans, Helvetica, sans-serif;font-size:10px; border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;padding: 5px;"';
$cadre4 = 'style="font-family:dejavusans, Helvetica, sans-serif;font-size:10px; border-right:1px solid black;border-left:1px solid black;"';
$cadre5 = 'style="font-family:dejavusans;font-size:14px;padding: 8px;"';
$cadre6 = 'style="font-family:dejavusans, Helvetica, sans-serif;font-size:13px; border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;padding: 5px;"';
$cadre7 = 'style="background-color: black; height: 60px;width:110%;margin-top:-30px;margin-left:-20px"';
$cad='style="position: relative; top: 0;"';
$stimage='style="position: absolute; top: 20px; left: 10%; transform: translateX(-50%); z-index: 1;"';
use App\Model\Table\SignaturesTable;

$session = $this->request->getSession();

$authData = $session->read('Auth');

if ($authData && is_object($authData)) {
    $personnelId = $authData->personnel_id;
    $signaturesTable = new SignaturesTable();
    $userSignature = $signaturesTable->find('all')
       ->where(['personnel_id' => $personnelId])
        ->first();
       // debug($userSignature->toArray());die;
}  
  $wr=$this->Url->build('/', ['fullBase' => true]) ;
// --------------------------------------------------------------------------
$imageUrl =$wr.'/webroot/img/logoggb.png';
$imageData = file_get_contents($imageUrl);
if ($imageData !== false) {
    $base64Image = 'data:image/png;base64,' . base64_encode($imageData);
}
$footerUrl = $wr.'/webroot/img/footer.png';
$footerData = file_get_contents($footerUrl);
if ($footerData !== false) {
    $base64footer = 'data:image/png;base64,' . base64_encode($footerData);
}


$tbl = '
<table cellpadding="0" cellspacing="0" style="width: 100%;">
    <tr>
        <!-- Black Background Div -->
        <td style="background-color: #000; width: 100%; padding: 0; height: 60px; position: relative;">
            <table cellpadding="0" cellspacing="0" style="width: 100%; position: absolute; top: 122px;">
                <tr>
                    <td >
                        <!-- Logo Section: Half Inside and Half Outside the Black Div -->
                        <img height="125px" width="140px" src="'.$wr.'/webroot/img/logoggb.png" />
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>


<!-- Main Content Section -->
<table cellpadding="0" cellspacing="0" style="width: 100%; margin: 30px;">
    <tr>
        <!-- Right-aligned Text Content -->
        <td style="width: 87%; margin-left: 75%; text-align: right; color: #103458; font-size: 1.3em;">
            <strong>Proposition commerciale</strong><br>
            <strong>Réf. :</strong> ' . $commandeclient->code . '<br>
            Date : ' . $commandeclient->date . '<br>
            Validité de l’offre : ' . $commandeclient->duree_validite . ' Jours<br>
            Code client : ' . $commandeclient->client->codeclient . '<br>
        </td>
    </tr>
</table>

<!-- Address Section -->
<table cellpadding="10" cellspacing="0" border="0" style="width: 100%; margin-top: 50px;">
    <tr>
        <!-- Émetteur Information (Left) -->
        <td  height="180px"  style="width: 47%; font-size: 1em;  position: relative;
        background-color: #E6E6E6;
        color: #000040;">
            <strong>' . $societes->nom . '</strong><br>
            ' . $societes->adresse . '<br><br>
            Tél.: ' . $societes->tel . '<br>
            Email : ' . $societes->mail . '<br>
            WEB : ' . $societes->site . '<br>
        </td>
        <td style="width: 5%; ">  </td>

        
        <!-- Adressé à: Information (Right) -->
        <td style="width: 47%; border: 1px solid gray; font-size: 1em;">
            <strong>Adressé à:</strong><br>
            ' . $commandeclient->client->nom . '<br>
            ' . $commandeclient->client->adresse . '<br>
        </td>
    </tr>
</table>
';


   
$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
ob_end_clean();
$pdf->Output('commande.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>