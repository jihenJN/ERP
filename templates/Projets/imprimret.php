<?php $this->layout = 'AdminLTE.print'; ?>
<style>
    @media print {
  body {
    font-family: 'Times New Roman', Times;
    font-size: 16px;
  }
}
</style>

<?php
use Cake\Datasource\ConnectionManager;


?>
 <?php
 $connection = ConnectionManager::get('default');
?>
<?php  

// $pdf->SetFont('times', 'A', 11);
 $logo = $societe->logo;
 //$societe = ClassRegistry::init('Societe')->find('first',array('conditions'=>array('Societe.id'=>CakeSession::read('societe_id'))));
// $fournisseur = ClassRegistry::init('Fournisseur')->find('first',array('conditions'=>array('Fournisseur.id'=>$pieces['Reglementfournisseur']['fournisseur_id'])));
 $mf=explode('/',$fournisseur->compte_comptable);

$mm=explode(' ',$mf[2]);
$ms=explode('/',$societe->codetva);

$mms=explode(' ',$ms[3]);

           
$tbl = ' <table width="100%" border="0" >
    <tr>

        <td width="90%" align="center"> <font size="5px"> CERTFICAT DE RETENUE D\'IMPOT SUR LE REVENU OU D\'IMPOT SUR LES SOCIETES  </td>
    </tr>
    
    <tr>
    <td align="" width="30%"  ><font size="3px">REPUBLIQUE TUNISIENNE <BR>MINISTERE DE PLAN ET DES FINANCES<BR>DIRECTION GENERALE <BR>DE CONTROLE FISCAL </font> </td>

</tr>

</table>

 <br><br>

<br><br> 
<table border="1">
<tr><td colspan="4"><strong>A- PERSONNE OU ORGANISME PAYEUR </strong>
        <BR>
        <table  width="100%"><tr><td width="30%"></td>
        <td align="center"  width="70%">IDENTIFIANT<BR>
            <table border="1"  width="90%">
            <tr><td width="30%">Matricule fiscal</td><td width="20%">Code<br> T.V.A</td><td width="25%">Code <br>catégorie(2)</td><td width="25%">N°Etab secondaire</td></tr>
 <tr><td> '.$ms[0].'/'.$ms[1].'</td><td> '.$ms[2].' </td><td> '.$ms[3].'</td><td>'.$ms[4].' </td></tr>
            </table><br>
        </td>
        </tr>
        <tr><td colspan="2">Dénomination de la personne ou de l\'organisme payeur: <strong>'.$societe->nom.'</strong><br></td></tr>
        <tr><td colspan="2">Adresse professionnelle: '.$societe->adresse.'<br> </td></tr>
        </table>

</td></tr>
<tr><td width="55%"><strong>B- RETENUES EFFECTUEE SUR : </strong></td>
    <td  width="15%" align="center"><strong>MONTANT BRUT </strong></td>
    <td  width="15%"  align="center"><strong>RETENUE</strong></td>
    <td  width="15%"  align="center"><strong>MONTANT NET </strong></td>
</tr>';
$annee=date('Y',strtotime($reglement->Date));
// print_r($annee);

if($annee<=2020)
{
$tbl.='
<tr><td height="30px">*Honoraires, commissions, courtages, vacations et loyers (5%) </td>
    <td align="right"> '; if($pieces->to_id==4){ $tbl.=$pieces['montant_brut'] ;} $tbl.=' </td>
    <td align="right"> '; if($pieces->to_id==4){ $tbl.=$pieces['montant'] ;} $tbl.=' </td>
    <td align="right"> '; if($pieces->to_id==4){ $tbl.=$pieces['montant_net'] ;} $tbl.=' </td>
</tr>';


$tbl.='
<tr><td height="30px">*Redevances (Retenue sur marché 1.5%) </td>
    <td align="right">'; if($pieces->to_id==5){ $tbl.=$pieces['montant_brut'] ;} $tbl.=' </td>
    <td align="right"> '; if($pieces->to_id==5){ $tbl.=$pieces['montant'] ;} $tbl.=' </td>
    <td align="right"> '; if($pieces->to_id==5){ $tbl.=$pieces['montant_net'] ;} $tbl.=' </td>
</tr>';
}
else 
if($annee>2020)
{
$tbl.='
<tr><td height="30px">*Honoraires, commissions, courtages, vacations et loyers (10%) </td>
    <td align="right"> '; if($pieces->to_id==3){ $tbl.=$pieces['montant_brut'] ;} $tbl.=' </td>
    <td align="right"> '; if($pieces->to_id==3){ $tbl.=$pieces['montant'] ;} $tbl.=' </td>
    <td align="right"> '; if($pieces->to_id==3){ $tbl.=$pieces['montant_net'] ;} $tbl.=' </td>
</tr>';


$tbl.='
<tr><td height="30px">*Redevances (Retenue sur marché 1%) </td>
    <td align="right">'; if($pieces->to_id==1){ $tbl.=$pieces['montant_brut'] ;} $tbl.=' </td>
    <td align="right"> '; if($pieces->to_id==1){ $tbl.=$pieces['montant'] ;} $tbl.=' </td>
    <td align="right"> '; if($pieces->to_id==1){ $tbl.=$pieces['montant_net'] ;} $tbl.=' </td>
</tr>';
}
$tbl.='
<tr><td height="30px">*Revenus des comptes spéciaux d\'épargne ouverts auprès des banques</td>
    <td> </td>
    <td> </td>
    <td> </td>
</tr>
<tr><td height="30px">*Revenus des capitaux mobiliers (Intérets débiteurs 20%)</td>
    <td> </td>
    <td> </td>
    <td> </td>
</tr>
<tr><td height="30px">*Revenus des bons de caisse au porteur</td>
    <td> </td>
    <td> </td>
    <td> </td>
</tr>
<tr><td align="right" height="30px"><strong>Total Géneral  </strong></td>
    <td align="right" ><strong> '.$pieces['montant_brut'].' </strong> </td>
    <td align="right" ><strong>'.$pieces['montant'].' </strong> </td>
    <td align="right"> <strong>'.$pieces['montant_net'].' </strong> </td>
</tr>
<tr><td colspan="4"><strong>C- BENIFICIAIRE </strong><br>
    N° de la carte d\'identité <br> ou <br> de séjour pour les étrangers
      <BR>
        <table width="100%"><tr><td width="30%"></td>
        <td  width="70%"align="center">IDENTIFIANT<BR>
            <table border="1" width="90%">
            <tr><td width="30%">Matricule fiscal</td><td width="20%">Code<br> T.V.A</td><td width="25%">Code <br>catégorie(2)</td><td width="25%">N°Etab secondaire</td></tr>
            <tr><td> '.$mf[0] .'</td><td> '.$mf[1].' </td><td> '.$mf[2].'</td><td>'.$mf[3].' </td></tr>
            </table><br>
        </td>
        </tr>
        <tr><td colspan="2">Nom Prénom ou raison sociale: <strong>'.$fournisseur->name.'</strong><br></td></tr>
        <tr><td colspan="2">Adresse  : '.$fournisseur->site.'<br></td></tr>
        <tr><td colspan="2">Adresse de résidence : '.$fournisseur->adresse.' <br></td></tr>
        </table>
</td></tr>
<tr><td colspan="4"><table><tr><td width="15%"></td>
                    <td width="65%" align="center">
                    Je soussigné certifié exacts les renseignements figurants sur le présents<br>
                    certificat et m\'expose aux sanctions prévues par la loi pour toute inexactitude<br>
                    A Sfax Le <strong>'.$this->Time->format($reglement->Date,'dd/MM/y').'<br><br><br></strong></td>
                        <td width="20%"></td></tr></table>
</td></tr>

</table>

 ';

 echo $tbl;
?>