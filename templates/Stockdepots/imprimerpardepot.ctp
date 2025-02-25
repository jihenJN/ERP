
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

$pdf->AddPage('L');
//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('times', 'A', 9);
$logo=  CakeSession::read('logo');
$n='Etat du stock';
if(!empty($namedepot)){
    $n=$n.' du d&eacute;p&ocirc;t '.$namedepot;
}
$nbrdepot=count($depotalls);
$widharticle=100-(($nbrdepot*6)+21);
//debug($nbrdepot);
//debug($widharticle);die;
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
                <td height="35px" align="left" ><strong>'.$n.'</strong></td>
            </tr>
        </table>
    </td>
</tr>

</table>
<br><br>

 <table border="1" align="center" cellpadding="2" cellspacing="0"  width="100%" class="table" nobr="true">
   <tr bgcolor="#FFFFFF" align="center">
                        <th width="'.$widharticle.'%"   style="background-color:#b8b8b8" align="center" $zz height="10px" >Article</th>';
                        foreach ($depotalls as $depot){
                        $tbl .= '<th width="6%" style="background-color:#b8b8b8" align="center" $zz >'.$depot['Depot']['name'].'</th>';
                        }
                        $tbl .= '<th width="7%"  style="background-color:#b8b8b8" align="center" $zz >Qte ToT</th>

   </tr>';
        $tot_qte_the=0;
        $i=0;$total=0;$qte=0;
        $test=0;$nbr=27;
       // debug($commfournisseurs);die;
       foreach ($articless as $stockdepot){
            $articleanss=ClassRegistry::init('Article')->find('first', array('recursive'=>-1,'conditions' => array('Article.id' =>$stockdepot['Article']['id'])));

            $qte=$qte+$stockdepot[0]['qte'];
            $total=$total+($articleanss['Article']['prixht']*$stockdepot[0]['qte']);
            $i++;
            if($test==1){
            $nbr=31;
            }
            if($i==$nbr){
                $test++;
                $tbl .='</table>';
                $pdf->writeHTML($tbl, true, false, false, false, '');
                $pdf->AddPage('L');
                $i=0;
                $tbl='
 <table border="1" align="center" cellpadding="2" cellspacing="0"  width="100%" class="table" nobr="true">
                        <tr bgcolor="#FFFFFF" align="center">
                        <th width="'.$widharticle.'%"  style="background-color:#b8b8b8" align="center" $zz height="10px" >Article</th>';
                        foreach ($depotalls as $depot){
                        $tbl .= '<th width="6%" style="background-color:#b8b8b8" align="center" $zz >'.$depot['Depot']['name'].'</th>';
                        }
                        $tbl .= '<th width="7%" style="background-color:#b8b8b8" align="center" $zz >Qte ToT</th>

                        </tr>';
            }
   $chainearticle= $stockdepot['Article']['codeabarre']." ".$stockdepot['Article']['designiation'];
   $nbchaine=strlen($chainearticle);
   if($nbchaine>65){
       $i++;
   }
$tbl .=
    '<tr bgcolor="#FFFFFF" align="center">
        <td width="'.$widharticle.'%"  nobr="nobr" align="left" height="10px" $zz>'.$stockdepot['Article']['codeabarre']." ".$stockdepot['Article']['designiation'].'</td>';
		   $total=0;
foreach ($depotalls as $d=>$depot){
              /*  $obj = ClassRegistry::init('Stockdepot');
                $stckdepot=$obj->find('first',array('conditions'=>array('Stockdepot.article_id'=>$stockdepot['Article']['id'],'Stockdepot.depot_id'=>$depot['Depot']['id']),false));
                if(!empty($stckdepot)){
                $qtestock=$stckdepot['Stockdepot']['quantite'];
                }else{
                $qtestock=0;
                } */
	$datef=date('Y-m-d H:i:s');
	$st=ClassRegistry::init('Stockdepot')->query("select stockbassem(".$stockdepot['Article']['id'].",'".$datef."','0',".$depot['Depot']['id'].") as v"); //debug($st[0][0]['v']);die;*/*/*/*/*/
	//	debug($st[0][0]); die;
	if(!empty($st)){
		$qtestock= $st[0][0]['v'];//$this->qtestock($depotid,$articleid);
		//	echo $st[0][0]['v'];
		$total=$total+$st[0][0]['v'];
	}else{
		$qtestock=0;
	}

        $test=strpos($qtestock, ".");
                if($test==true){
                $qtestock= sprintf('%.3f',$qtestock);
                }else{
                $qtestock= $qtestock;
                echo $total;
                }
$tbl .= '<td width="6%" nobr="nobr" align="center"  $zz>'.$qtestock.'</td>';

    }
$tbl .= '<td width="7%" nobr="nobr" align="center"  $zz>'.$total.'</td>

    </tr>' ;
}
$d=@$d+3;
$tbl .= '

</table>';


$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
ob_end_clean();
$pdf->Output('etatstock.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
