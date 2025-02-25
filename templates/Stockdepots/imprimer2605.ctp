
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
//        $year = date('Y'); 
//        $footertext = sprintf($this->xfootertext, $year); 
//        $this->SetY(-20); 
//        $this->SetTextColor(0, 0, 0); 
//        $this->SetFont($this->xfooterfont,'',$this->xfooterfontsize);  
//         $footertext1 = sprintf($this->xfootertext1, $year); 
//        $this->SetY(-20); 
//        $this->SetTextColor(0, 0, 0); 
//        $this->SetFont($this->xfooterfont,'',$this->xfooterfontsize); 
//         $footertext2 = sprintf($this->xfootertext2, $year); 
//        $this->SetY(-20); 
//        $this->SetTextColor(0, 0, 0); 
//        $this->SetFont($this->xfooterfont,'',$this->xfooterfontsize); 
//        $this->Cell(0,8, $footertext,'T',1,'L'); 
//        $this->Cell(0,1, $footertext1,0,1,'L'); 
//        $this->Cell(0,3, $footertext2,0,1,'L'); 
    }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PARAMED');
$pdf->SetTitle('Facture Client');

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
if($date1!="" && $date2!=""){
$date1=date('d/m/Y', strtotime(str_replace('-', '/',$date1)));
$date2=date('d/m/Y', strtotime(str_replace('-', '/',$date2)));
$m=' de date validité entre  '.$date1.' et  '.$date2;
}
// ---------------------------------------------------------

$pdf->AddPage();
//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('times', 'A',9);
$logo=  CakeSession::read('logo');
$n='Etat du stock : '.date("d/m/Y");
if(!empty($namedepot)){
    $n=$n.' du d&eacute;p&ocirc;t '.$namedepot;
}
if($typeimpressionid ==0){
$w_art="50%";
$w_qte="10%";
$w_pmp="10%";
$w_t_pmp="10%";
$w_pa="10%";
$w_t_pa="10%";
}
if($typeimpressionid ==1){
$w_art="80%";
$w_qte="20%";
$w_pmp="0%";
$w_t_pmp="0%";
$w_pa="0%";
$w_t_pa="0%";
}
if($typeimpressionid ==2){
$w_art="70%";
$w_qte="10%";
$w_pmp="10%";
$w_t_pmp="10%";
$w_pa="0%";
$w_t_pa="0%";
}
if($typeimpressionid ==3){
$w_art="70%";
$w_qte="10%";
$w_pmp="0%";
$w_t_pmp="0%";
$w_pa="10%";
$w_t_pa="10%";
}

    /*    <IMG SRC="../webroot/img/'.$logo.'" >*/



$tbl .=' 

<table width="100%">
<tr>
    <td  width="55%">
    </td>
    <td  width="45%">
        <table width="100%">
            <tr>
            <br> 
                <td height="35px" align="left" ><strong>'.$n.'</strong></td> 
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
   
 <table border="1" align="center" cellpadding="2" cellspacing="0"  width="100%" class="table" nobr="true">       
   <tr bgcolor="#FFFFFF" align="center">
                        <th width="'.$w_art.'" style="background-color:#b8b8b8" align="center" $zz height="10px" ><strong>Article</strong></th>
                        <th width="'.$w_qte.'" style="background-color:#b8b8b8" align="center" $zz ><strong>Quantite</strong></th>';
                         if(CakeSession::read('imp_val_inventaire')==1){ 
                        if($typeimpressionid !=1 && $typeimpressionid !=3){
                        $tbl .='
						<th width="'.$w_pmp.'" style="background-color:#b8b8b8" align="center" $zz ><strong>Prix Vente</strong></th>
						<th width="'.$w_pmp.'" style="background-color:#b8b8b8" align="center" $zz ><strong>Prix Achat</strong></th>
						<th width="'.$w_pmp.'" style="background-color:#b8b8b8" align="center" $zz ><strong>TOT Vente </strong></th>
                                <th width="'.$w_t_pmp.'" style="background-color:#b8b8b8" align="center" $zz ><strong>TOT Achat</strong></th>';
                         }}
                        //if($typeimpressionid !=1 && $typeimpressionid !=2){
                        //$tbl .='<th width="'.$w_pa.'" style="background-color:#b8b8b8" align="center" $zz ><strong>D Prix d\'achat</strong></th>
                            //    <th width="'.$w_t_pa.'" style="background-color:#b8b8b8" align="center" $zz ><strong>TOT DPA</strong></th>';
                       // }
  $tbl .=' </tr>';
        $tot_qte_the=0;
        $i=0;$total=0;$qte=0;
        $total=0;
        $dernierprix=0;
        $nb_ligne=42;
       // debug($commfournisseurs);die;
       foreach ($stockdepots as $stockdepot){
            $articleanss=ClassRegistry::init('Article')->find('first', array('recursive'=>-1,'conditions' => array('Article.id' =>$stockdepot['Article']['id'])));

           $qteall=ClassRegistry::init('Stockdepot')->query("select stockbassem('".$stockdepot['Article']['id']."','".date('Y-m-d')."','0','".$depotid."') as v");;
           $qtestock=sprintf('%.2f',$qteall[0][0]['v']);
           $total=$total+($stockdepot[0]['prix']*$qtestock);

           $qte=$qte+$qtestock;
            if(empty($stockdepot[0]['prix'])) {
            $stockdepot[0]['prix']=0;
            }  
            if(empty($stockdepot[0]['dernierprix'])) {
                $stockdepot[0]['dernierprix']=0;
            }  
            $totalv=$totalv+($articleanss['Article']['prixvente']*$qtestock);
            $totala=$totala+($articleanss['Article']['coutrevient']*$qtestock);
             $dernierprix=$dernierprix+($stockdepot[0]['dernierprix']*$qtestock);
            $i++;
            if($i >$nb_ligne){
                $nb_ligne=48;
                $tbl .='</table>';
                $pdf->writeHTML($tbl, true, false, false, false, '');
                $pdf->AddPage('P');
                $i=0;
                $tbl='
                    
                    <table border="1" align="center" cellpadding="2" cellspacing="0"  width="100%" class="table" nobr="true">       
                   <tr bgcolor="#FFFFFF" align="center">
                       <th width="'.$w_art.'" style="background-color:#b8b8b8" align="center" $zz height="10px" ><strong>Article</strong></th>
                        <th width="'.$w_qte.'" style="background-color:#b8b8b8" align="center" $zz ><strong>Quantite</strong></th>';
                        if(CakeSession::read('imp_val_inventaire')==1){ 
                        if($typeimpressionid !=1 && $typeimpressionid !=3){
                        $tbl .='
						<th width="'.$w_pmp.'" style="background-color:#b8b8b8" align="center" $zz ><strong>Prix Vente</strong></th>
						<th width="'.$w_pmp.'" style="background-color:#b8b8b8" align="center" $zz ><strong>Prix Achat</strong></th>
						<th width="'.$w_pmp.'" style="background-color:#b8b8b8" align="center" $zz ><strong>TOT Vente </strong></th>
                                <th width="'.$w_t_pmp.'" style="background-color:#b8b8b8" align="center" $zz ><strong>TOT Achat</strong></th>';
                           }}
//                        if($typeimpressionid !=1 && $typeimpressionid !=2){
//                        $tbl .='<th width="'.$w_pa.'" style="background-color:#b8b8b8" align="center" $zz ><strong>D Prix d\'achat</strong></th>
//                                <th width="'.$w_t_pa.'" style="background-color:#b8b8b8" align="center" $zz ><strong>TOT DPA</strong></th>';
//                        }   
                  $tbl .=' </tr>';
            }
                $cond1f = 'Commande.validite_id <>3';
                $lignecommandes=ClassRegistry::init('Lignecommande')->find('all', array('fields'=>array('sum(Lignecommande.quantite) as qte')
                ,'conditions' => array('Lignecommande.article_id' =>$stockdepot['Article']['id'],@$cond1f,'Commande.exercice_id >=2017')
                ,'group'=>array('Lignecommande.article_id')));
                $commandeclts =ClassRegistry::init('Lignecommandeclient')->find('all', array('fields'=>array('sum(Lignecommandeclient.quantite) as qte'),'conditions' => array('Lignecommandeclient.id > ' => 0,'Lignecommandeclient.article_id' =>$stockdepot['Article']['id'],@$cond1c, @$cond3c, @$cond4c )
                ,'group'=>array('Lignecommandeclient.article_id')));
                //debug($commandeclts);
                if(!empty($lignecommandes)){
                $qtecom_entre=$lignecommandes[0][0]['qte'];
                }else{
                $qtecom_entre=0;
                }
                if(!empty($commandeclts)){
                $qtecom_sortie=$commandeclts[0][0]['qte'];
                }else{
                $qtecom_sortie=0;
                }
                $qte_theorique=$qtestock-$qtecom_sortie+$qtecom_entre;
                $tot_qte_the=$tot_qte_the+$qte_theorique;
                $test=strpos($qtecom_entre, ".");
                if($test==true){
                $qteth= sprintf('%.3f',$qtecom_entre);
                }else{
                $qteth= $qtecom_entre;    
                }
                $test=strpos($qtestock, ".");
                if($test==true){
                $qt= sprintf('%.3f',$qtestock);
                }else{
                $qt= $qtestock;
                }
   $chainearticle= $stockdepot['Article']['code']." : ".$stockdepot['Article']['name'];             
   $nbchaine=strlen($chainearticle);
   if($nbchaine>53){
       $i++;
   }
   if($nbchaine>106){
       $i++;
   }
               
        $tbl .= 
    '<tr bgcolor="#FFFFFF" align="center">    
        <td width="'.$w_art.'" nobr="nobr" align="left" height="10px" $zz>'.$stockdepot['Article']['code']." ".$stockdepot['Article']['name'].'</td>
        <td width="'.$w_qte.'" nobr="nobr" align="right"  $zz>'.$qt.'</td>';
        if(CakeSession::read('imp_val_inventaire')==1){ 
        if($typeimpressionid !=1 && $typeimpressionid !=3){
        $tbl .='<td width="'.$w_pmp.'" nobr="nobr" align="right"  $zz>'.number_format($articleanss['Article']['prixvente'],3,'.',' ').'</td> ';
        $tbl .='<td width="'.$w_pmp.'" nobr="nobr" align="right"  $zz>'.number_format($articleanss['Article']['coutrevient'],3,'.',' ').'</td> ';
        $tbl .='<td width="'.$w_t_pmp.'" nobr="nobr" align="right"  $zz>'.number_format($articleanss['Article']['prixvente']*$stockdepot[0]['qte'],3,'.',' ').'</td> '; 
        $tbl .='<td width="'.$w_t_pmp.'" nobr="nobr" align="right"  $zz>'.number_format($articleanss['Article']['coutrevient']*$stockdepot[0]['qte'],3,'.',' ').'</td> '; 
        }}
        //if($typeimpressionid !=1 && $typeimpressionid !=2){
//        $tbl .='<td width="'.$w_pa.'" nobr="nobr" align="right"  $zz>'.number_format($stockdepot[0]['dernierprix'],3,'.',' ').'</td> '; 
//        $tbl .='<td width="'.$w_t_pa.'" nobr="nobr" align="right"  $zz>'.number_format($stockdepot[0]['dernierprix']*$stockdepot[0]['qte'],3,'.',' ').'</td> '; 
        //}
    $tbl .='</tr>' ;     
	
	
	$pv+=$articleanss['Article']['prixvente']; 
	$cr+=$articleanss['Article']['coutrevient']; 
	$tpv+=$articleanss['Article']['prixvente']*$stockdepot[0]['qte']; 
	$tcr+=$articleanss['Article']['coutrevient']*$stockdepot[0]['qte']; 
}

$tbl .= '
  <tr bgcolor="#FFFFFF" align="center">    
        <td width="'.$w_art.'" nobr="nobr" align="right" height="10px" $zz>Total</td>
        <td width="'.$w_qte.'" nobr="nobr" align="right"  $zz></td>';
        if(CakeSession::read('imp_val_inventaire')==1){ 
        if($typeimpressionid !=1 && $typeimpressionid !=3){
        $tbl .='<td width="'.$w_pmp.'" nobr="nobr" align="right"  $zz>'.number_format($pv,3,'.',' ').'</td>';    
              $tbl .='<td width="'.$w_pmp.'" nobr="nobr" align="right"  $zz>'.number_format($cr,3,'.',' ').'</td>'; 
			    $tbl .='<td width="'.$w_t_pmp.'" nobr="nobr" align="right"  $zz>'.number_format($tpv,3,'.',' ').'</td>';
  
        $tbl .='<td width="'.$w_t_pmp.'" nobr="nobr" align="right"  $zz>'.number_format($tcr,3,'.',' ').'</td>';
        }}
//        if($typeimpressionid !=1 && $typeimpressionid !=2){
//        $tbl .='<td width="'.$w_pa.'" nobr="nobr" align="right" height="10px" $zz></td>';
//        $tbl .='<td width="'.$w_t_pa.'" nobr="nobr" align="right"  $zz>'.number_format($dernierprix,3,'.',' ').'</td>'; 
//        }
   $tbl .=' </tr>
</table>';
    

$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
ob_end_clean();
$pdf->Output('etatstock.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>