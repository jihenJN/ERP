
<?php

App::import('Vendor', 'xtcpdf');
$pdf = new XTCPDF();

class MYPDF extends TCPDF {
var $xheadertext  = 'PDF created using CakePHP and TCPDF'; 
    var $xheadercolor = array(0,0,200); 
    //var $xfootertext  = 'Copyright Ã‚Â© %d XXXXXXXXXXX. <b>All rights reserved.</b>'; 
    var $xfooterfont  = PDF_FONT_NAME_MAIN ; 
    var $xfooterfontsize = 8 ;
    //Page header
    public function Header() {
        
    }

    // Page footer
    public function Footer() {
        $year = date('Y'); 
        $footertext = sprintf($this->xfootertext, $year); 
        $this->SetY(-20); 
        $this->SetTextColor(0, 0, 0); 
        $this->SetFont($this->xfooterfont,'',$this->xfooterfontsize);  
         $footertext1 = sprintf($this->xfootertext1, $year); 
        $this->SetY(-20); 
        $this->SetTextColor(0, 0, 0); 
        $this->SetFont($this->xfooterfont,'',$this->xfooterfontsize); 
         $footertext2 = sprintf($this->xfootertext2, $year); 
        $this->SetY(-20); 
        $this->SetTextColor(0, 0, 0); 
        $this->SetFont($this->xfooterfont,'',$this->xfooterfontsize); 
        $this->Cell(0,8, $footertext,'T',1,'L'); 
        $this->Cell(0,1, $footertext1,0,1,'L'); 
        $this->Cell(0,3, $footertext2,0,1,'L'); 
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Application');
$pdf->SetTitle('Historique Article');

$ent = 'entete.jpg';
$ModelSociete = ClassRegistry::init('Societe');
$soc = $ModelSociete->find('first');
$footer = '            SARL au Capital de:   ' . $soc['Societe']['capital'] . '           E-mail: ' . $soc['Societe']['mail'] . '           Code T.V.A: ' . $soc['Societe']['codetva'] . '             RIB: ' . $soc['Societe']['rib'];

$aaa = "abc";
$pdf->xfootertext = $footer;
$pdf->xfootertext1 = '';
$pdf->xfootertext2 = '';

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}
if($date1!="" ){
$date1=date('d/m/Y', strtotime(str_replace('-', '/',$date1)));
$m='de '.$date1;
}
if( $date2!=""){
$date2=date('d/m/Y', strtotime(str_replace('-', '/',$date2)));
$m=$m.' jusqu à '.$date2;
}else{
$date2="";
}
if($clientid!="" ){
$m=$m.' par client : '.$clients[$clientid];
}
if($articleid!="" ){
$m=$m.' de '.$articles[$articleid];
}
if($familleid!="" ){
$m=$m.' par famille : '.$familles[$familleid];
}
if($pointdeventeid!="" ){
$m=$m.' par point de vente : '.$pointdeventes[$pointdeventeid];
}
if($exerciceid!="" ){
$m=$m.' dans l\'année : '.$exercices[$exerciceid];
}
if($typeligneventeid!="" ){
$tabd=explode(",",$typeligneventeid);  
//debug($tabd);die;
    $ch="";
    foreach ($tabd as $k=>$type)  {
    if($k !=0){    
    if($k==1){
     $ch=$ch." ".$typeligneventes[$type]  ;
    }else{
     $ch=$ch." et ".$typeligneventes[$type]  ;   
    }
    }
    }
$m=$m.' de type : '.$ch;
}

// ---------------------------------------------------------

$pdf->AddPage('L');

//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('times', 'A', 9);
$logo=  CakeSession::read('logo');

$tbl .=' 

<table width="100%">
<tr>
    <td  width="55%">
        <IMG SRC="../webroot/img/'.$logo.'" >
    </td>
    <td  width="45%">
        <table width="100%">
            <tr>
            <br> 
                <td height="35px" align="left" ><strong>Vente Journalier  '.$m.'</strong></td> 
            </tr> 
        </table>
    </td>
</tr>
<br>
<tr>
    <td align="left" width="55%"  >' . $soc['Societe']['adresse'] . '</td>
    <td align="left" width="45%" ><strong>Tél : </strong>' . $soc['Societe']['tel'] . '</td>
</tr>
<tr>
    <td align="left" width="55%"  ><strong>TVA :</strong>' . $soc['Societe']['codetva'] . '</td>
    <td align="left" width="45%" ><strong>Fax :</strong>' . $soc['Societe']['fax'] . '</td>
</tr>
<tr>
    <td align="left" width="55%"  ><strong>R.C :</strong>' . $soc['Societe']['rc'] . '</td>
     <td align="left" width="45%" ><strong>Site web : </strong>' . $soc['Societe']['site'] . '</td>
</tr>
    
</table>
<br><br><br>
   
 <table border="1" align="center" cellpadding="2" cellspacing="0"  width="100%" class="table" >       
   <tr bgcolor="#FFFFFF" align="center">
                        <th width="8%" align="center" $zz height="30px" ><strong>Date</strong></th>
                        <th width="10%" align="center" $zz ><strong>Action</strong></th>
                        <th width="5%" align="center" $zz ><strong>Mg</strong></th>
                        <th width="10%" align="center" $zz ><strong>N° Bon</strong></th>
                        <th width="17%" align="center" $zz ><strong>Nom / Raison social</strong></th>
                        <th width="40%" align="center" $zz ><strong>Article</strong></th>
                        <th width="5%" align="center" $zz ><strong>Entrée</strong></th>
                        <th width="5%" align="center" $zz ><strong>Sortie</strong></th>
                        
                        
   </tr>';
        $i=0;$style="";  
        $nb=0;
        $tot_ht=0;
        $tot_ttc=0;
        $tot_remise=0;
        $tot_fodec=0;
        $tot_tva=0;
              foreach ($historiquearticles as $k=>$historiquearticle){
         if(!empty($historiquearticle['Historiquearticle']['date'])){
        $date=date("d-m-Y",strtotime(str_replace('/','-',$historiquearticle['Historiquearticle']['date'])));
    }else{
        $date="";
    }                  
            
      if (!empty($historiquearticle['Historiquearticle']['client']))   {  $cfu= $historiquearticle['Historiquearticle']['client']; }
    if (!empty($historiquearticle['Historiquearticle']['fournisseur'])) {$cfu= $historiquearticle['Historiquearticle']['fournisseur']; }
    if (!empty($historiquearticle['Historiquearticle']['utilisateur']))   {  $cfu= $historiquearticle['Historiquearticle']['utilisateur']; }      
            
      if($historiquearticle['Historiquearticle']['mode']=="Entree"){
    $qteent= $historiquearticle['Historiquearticle']['qte'];
    }
    if($historiquearticle['Historiquearticle']['mode']=="Sortie"){
    $qtesortie= $historiquearticle['Historiquearticle']['qte'];
    } 
              
                  
                  
       
               
        $tbl .= 
    '<tr align="center">    
        <td width="8%" nobr="nobr" align="center"  $zz><strong>'.$date.'</strong></td>
        <td width="10%" nobr="nobr" align="center"  $zz>'.$historiquearticle['Historiquearticle']['type'].'</td>
        <td width="5%" nobr="nobr" align="center"  $zz>'.$historiquearticle['Historiquearticle']['depot'].'</td>
        <td width="10%" nobr="nobr" align="center"  $zz>'.$historiquearticle['Historiquearticle']['numero'].'</td>
        <td width="17%" nobr="nobr" align="left"  $zz>'.$cfu.'</td>
        <td width="40%" nobr="nobr" align="left"  $zz>'.$historiquearticle['Historiquearticle']['article'].'</td>    
        <td width="5%" nobr="nobr" align="center"  $zz>'.$qteent.'</td>
        <td width="5%" nobr="nobr" align="right"  $zz>'.$qtesortie.'</td>
    </tr>' ;     
}

$tbl .= '</table>';
    

$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
ob_end_clean();
$pdf->Output('historique_article.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>