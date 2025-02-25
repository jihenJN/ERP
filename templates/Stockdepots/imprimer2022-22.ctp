
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
$pdf->SetTitle('Etat de stock');

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
    $n=$n.' du <br> '.$namedepot;
}
if($typeimpressionid ==0){
$w_art="50%";
$w_qte="10%";
$w_pmp="20%";
$w_t_pmp="20%";
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


$n='Etat du stock : '.date("d/m/Y");
if(!empty($namedepot)){
    $n=$n.' du d&eacute;p&ocirc;t '.$namedepot;
}
$array_entete .=' 


<table width="100%">

                <tr>
                    <td width="45%">
                        <table>
                            <tr>
                                <td style="font-size:15;" align="left"><strong>' . $soc['Societe']['nom'] . '</strong></td>
                            </tr>
                            <tr>
                            <td  align="left">' . $soc['Societe']['adresse'] . '</td>
                            </tr>
                            <tr>
                            <td align="left"   ><b> ' . $soc['Societe']['codetva'] . '</b> </td>
                            </tr>
                             <tr>
                            <td align="left"   ><b>  R.C. : ' . $soc['Societe']['rc'] . ' </b></td>
                            </tr>
                            <tr>
                            <td align="left"   > Tél : ' . $soc['Societe']['tel'] . '</td>
                            </tr>
                            <tr>
                            <td align="left"   > Fax : ' . $soc['Societe']['fax'] . ' </td>
                            </tr>
                            <tr>
                            <td align="left"   > Email : ' . $soc['Societe']['mail'] . '</td>
                            </tr>
                             <tr>
                            <td align="left"   >Site web : ' . $soc['Societe']['site'] . ' </td>
                            </tr>
                           
                        </table>
                    </td>

                    <td width="55%">
                        <br><br><br>
                        <table>
                            <tr>
                                <td align="centre" width="100%" style="font-size:16;"  ><strong>'.$n.' </strong></td>
                                
                            </tr>
                            
                            
                        </table>
                    </td>
                </tr>
            </table>

           


            ';

$tbl .=' <p>'.$array_entete.'</p>';

$tbl .=' 
 
<br><br><br>
   
 <table border="1" align="center" cellpadding="2" cellspacing="0"  width="100%" class="table" nobr="true">       
   <tr bgcolor="#FFFFFF" align="center"><th   style="background-color:#b8b8b8" align="center" $zz width="15%" ><strong>Code</strong></th>
         <th style="background-color:#b8b8b8" align="center" $zz width="45%" ><strong>Article</strong></th>
            
                       <th  style="background-color:#b8b8b8" align="center" $zz width="15%" ><strong>Qté</strong></th>
                       <th  style="background-color:#b8b8b8" align="center" $zz width="10%" ><strong>Prix unitaire</strong></th>
                        
                       <th  style="background-color:#b8b8b8" align="center" $zz ><strong>Total TTC </strong></th>              
							';
                      
  $tbl .=' </tr>';
        $tot_qte_the=0;
        $i=0;$total=0;$qte=0;
        $total=0;
        $dernierprix=0;
        $nb_ligne=39;
       // debug($commfournisseurs);die;
       foreach ($stockdepots as $stockdepot){
		   
		   
		   
		   
            $articleanss=ClassRegistry::init('Article')->find('first', array('recursive'=>0,'conditions' => array('Article.id' =>$stockdepot['Article']['id'])));
            
            //$qte=$qte+$stockdepot[0]['qte'];
			
			   $qteall = ClassRegistry::init('Stockdepot')->query("select stockbassem('" . $stockdepot['Article']['id'] . "','" . date('Y-m-d H:i:s') . "','0','" . $depotid . "') as v");;
		   $qte = sprintf('%.2f', $qteall[0][0]['v']);
		   
            if(empty($stockdepot[0]['prix'])) {
            $stockdepot[0]['prix']=0;
            }  
            if(empty($stockdepot[0]['dernierprix'])) {
                $stockdepot[0]['dernierprix']=0;
            }  
            $total=$total+($articleanss['Article']['prixvente']*$stockdepot[0]['qte']);
            $dernierprix=$dernierprix+($stockdepot[0]['dernierprix']*$stockdepot[0]['qte']);
            $i++;
         if(($kk==30 && $p==0 ) ||($kk==34 && $p!=0) ){
        $n=0;
        $tbl .= '  </table>';
        $pdf->writeHTML($tbl, true, false, false, false, '');
        $pdf->AddPage('P');
        $p++;
        $hauteur=565-(30*$kk) ;
        $kk=0; $tbl = '</table>
                    
                    <table border="1" align="center" cellpadding="2" cellspacing="0"  width="100%" class="table" nobr="true">       
                   <tr bgcolor="#FFFFFF" align="center">
				   							<th   style="background-color:#b8b8b8" align="center" $zz width="15%" ><strong>Code</strong></th>

                        <th style="background-color:#b8b8b8" align="center" $zz width="45%" ><strong>Article</strong></th>
                       
                       <th  style="background-color:#b8b8b8" align="center" $zz width="15%" ><strong>Qté</strong></th>
                       <th  style="background-color:#b8b8b8" align="center" $zz width="10%" ><strong>Prix unitaire</strong></th>
                        
                       <th  style="background-color:#b8b8b8" align="center" $zz ><strong>Total TTC </strong></th>              ';
  
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
                $qte_theorique=$stockdepot[0]['qte']-$qtecom_sortie+$qtecom_entre;            
                $tot_qte_the=$tot_qte_the+$qte_theorique;
                $test=strpos($qtecom_entre, ".");
                if($test==true){
                $qteth= sprintf('%.3f',$qtecom_entre);
                }else{
                $qteth= $qtecom_entre;    
                }
                $test=strpos($stockdepot[0]['qte'], ".");
                if($test==true){
                $qt= sprintf('%.3f',$stockdepot[0]['qte']);   
                }else{
                $qt= $stockdepot[0]['qte'];    
                }
   $chainearticle= $stockdepot['Article']['code']." : ".$stockdepot['Article']['name'];             
   $nbchaine=strlen($chainearticle);
   if($nbchaine>53){
       $i++;
   }
   if($nbchaine>106){
       $i++;
   }
     $qteall = ClassRegistry::init('Stockdepot')->query("select stockbassem('" . $stockdepot['Article']['id'] . "','" . date('Y-m-d H:i:s') . "','0','" . $depotid . "') as v");;
		   $qt = sprintf('%.2f', $qteall[0][0]['v']);
		   
            if($qt<0) $qt=0; 
if($qt>0){			
        $tbl .= 
    '<tr bgcolor="#FFFFFF" align="center">     <td   nobr="nobr" align="right" width="15%"  $zz>'.$articleanss['Article']['code'].'</td>
        <td width="45%" nobr="nobr" align="left" height="32px" $zz>'. $stockdepot['Article']['name'].'</td>
 
        <td width="15%" nobr="nobr" align="center" height="10px" $zz>'.$qt.'</td>
        <td width="10%" nobr="nobr" align="right" height="10px" $zz>'.$articleanss['Article']['prixvente'].'</td>
        ';
      $tbl .='<td   nobr="nobr" align="right"  $zz>'.number_format($articleanss['Article']['prixvente']*$qt,3,'.',' ').'</td> 
	 '; 
 
    $tbl .='</tr>' ;     
	   }}
/*
$tbl .= '
  <tr bgcolor="#FFFFFF" align="center">    
        <td width="55%" nobr="nobr" align="right" height="10px" $zz>Total</td>
     ';
        
 
        $tbl .='<td colspan="5" nobr="nobr" align="right"  $zz>'.number_format($total,3,'.',' ').'</td>';
              
//        if($typeimpressionid !=1 && $typeimpressionid !=2){
//        $tbl .='<td width="'.$w_pa.'" nobr="nobr" align="right" height="10px" $zz></td>';
//        $tbl .='<td width="'.$w_t_pa.'" nobr="nobr" align="right"  $zz>'.number_format($dernierprix,3,'.',' ').'</td>'; 
//        }
   $tbl .=' </tr>* ;*/
 $tbl .=' </table>';
    

$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
ob_end_clean();
$pdf->Output('etatstock.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>