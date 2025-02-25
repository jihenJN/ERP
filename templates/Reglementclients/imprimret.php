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
$mf = explode('/', $client->Matricule_Fiscale);

$mm = explode(' ', $mf[2]);
$ms = explode('/', $societe->codetva);

$mms = explode(' ', $ms[3]);





$Matricule_Fiscale = $client->Matricule_Fiscale;
$parts = explode('/', $Matricule_Fiscale);

// Combine the first two parts
$combinedPart = $parts[0]; // "0002940X"
$part1 = $parts[1];
//var_dump($part1);
// Access the other parts
$part2 = $parts[2]; // "A"
$part3 = $parts[3]; // "M"
$part4 = $parts[4]; // "000"



$codetva = $societe->codetva;
$partss = explode('/', $codetva);

// Combine the first two parts
$combinedPart1 = $partss[0] . $partss[1]; // "0002940X"

// Access the other parts
$part33 = $partss[2]; // "A"
$part44 = $partss[3]; // "M"
$part52 = $partss[4]; // "000"


$connection = ConnectionManager::get('default');
$adressee = $connection->execute("SELECT * FROM adresselivraisonclients WHERE client_id = '" . $reglement->client_id . "'")->fetchAll('assoc');



$tbl = ' <table width="100%" border="0" >
    <tr>

        <td width="90%" align="center"> <font size="5px"> CERTFICAT DE RETENUE D\'IMPOT SUR LE REVENU OU D\'IMPOT SUR LES SOCIETES  </td>
    </tr>
    
    <tr>
    <td align="" width="30%"  ><font size="3px">REPUBLIQUE TUNISIENNE <BR>MINISTERE DE PLAN ET DES FINANCES<BR>DIRECTION GENERALE <BR>DE CONTROLE FISCAL </font> </td>

</tr>

</table>

 
<table border="1">
<tr><td colspan="4"><strong>A- PERSONNE OU ORGANISME PAYEUR </strong>
        <BR>
        <table  width="100%"><tr><td width="30%"></td>
        <td  width="70%"align="center">IDENTIFIANT
        <table border="1" width="90%">
        <tr><td width="30%">Matricule fiscal</td><td width="20%">Code<br> T.V.A</td><td width="25%">Code <br>catégorie(2)</td><td width="25%">N°Etab secondaire</td></tr>
        <tr><td  align="center"> <strong>' . $combinedPart . '</strong></td><td  align="center"><strong> ' . $part1 . ' </strong></td><td  align="center"><strong> ' . $part2 . '</strong></td><td  align="center"><strong>' . $part3 . ' </strong></td></tr>
        </table><br>
         </td>
        </tr>
        <tr><td colspan="2">Dénomination de la personne ou de l\'organisme payeur: <strong>' . $client->Raison_Sociale . '</strong><br></td></tr>
        <tr><td colspan="2">Adresse professionnelle: ' .  $adressee[0]['adresse']  . '<br> </td></tr>
        </table>

</td></tr>
<tr><td width="55%"><strong>B- RETENUES EFFECTUEE SUR : </strong></td>
    <td  width="15%" align="center"><strong>MONTANT BRUT </strong></td>
    <td  width="15%"  align="center"><strong>RETENUE</strong></td>
    <td  width="15%"  align="center"><strong>MONTANT NET </strong></td>
</tr>';
$annee = date('Y', strtotime($reglement->Date));
// print_r($annee);

if ($annee <= 2020) {
    $tbl .= '
<tr><td height="25px">*Honoraires, commissions, courtages, vacations et loyers (5%) </td>
    <td align="right"> ';
    if ($pieces->to_id == 4) {
        $tbl .= $pieces['montant_brut'];
    }
    $tbl .= ' </td>
    <td align="right"> ';
    if ($pieces->to_id == 4) {
        $tbl .= $pieces['montant'];
    }
    $tbl .= ' </td>
    <td align="right"> ';
    if ($pieces->to_id == 4) {
        $tbl .= $pieces['montant_net'];
    }
    $tbl .= ' </td>
</tr>';


    $tbl .= '
<tr><td height="25px">*Redevances  </td>
    <td align="right">';
    if ($pieces->to_id == 5) {
        $tbl .= $pieces['montant_brut'];
    }
    $tbl .= ' </td>
    <td align="right"> ';
    if ($pieces->to_id == 5) {
        $tbl .= $pieces['montant'];
    }
    $tbl .= ' </td>
    <td align="right"> ';
    if ($pieces->to_id == 5) {
        $tbl .= $pieces['montant_net'];
    }
    $tbl .= ' </td>
</tr>';
} else 
if ($annee > 2020) {

    $tbl .= '
<tr><td height="25px">*Marchés (1.0%) </td>
    <td align="right">';
    if ($pieces->to_id == 1) {
        $tbl .= $pieces['montant_brut'];
    }
    $tbl .= ' </td>
    <td align="right"> ';
    if ($pieces->to_id == 1) {
        $tbl .= $pieces['montant'];
    }
    $tbl .= ' </td>
    <td align="right"> ';
    if ($pieces->to_id == 1) {
        $tbl .= $pieces['montant_net'];
    }
    $tbl .= ' </td>
</tr>';
    $tbl .= '
<tr><td height="25px">*Honoraires, commissions, courtages, vacations et loyers (15%) </td>
    <td align="right"> ';
    if ($pieces->to_id == 3) {
        $tbl .= $pieces['montant_brut'];
    }
    $tbl .= ' </td>
    <td align="right"> ';
    if ($pieces->to_id == 3) {
        $tbl .= $pieces['montant'];
    }
    $tbl .= ' </td>
    <td align="right"> ';
    if ($pieces->to_id == 3) {
        $tbl .= $pieces['montant_net'];
    }
    $tbl .= ' </td>
</tr>';
    $tbl .= '
<tr><td height="25px">*Honoraires régime réel (5%) </td>
    <td align="right"> ';
    if ($pieces->to_id == 3) {
        $tbl .= $pieces['montant_brut'];
    }
    $tbl .= ' </td>
    <td align="right"> ';
    if ($pieces->to_id == 3) {
        $tbl .= $pieces['montant'];
    }
    $tbl .= ' </td>
    <td align="right"> ';
    if ($pieces->to_id == 3) {
        $tbl .= $pieces['montant_net'];
    }
    $tbl .= ' </td>
</tr>';
}
$tbl .= '
<tr><td height="25px">*Revenus des comptes spéciaux d\'épargne ouverts auprès des banques</td>
    <td> </td>
    <td> </td>
    <td> </td>
</tr>
<tr><td height="25px">*Revenus des capitaux mobiliers </td>
    <td> </td>
    <td> </td>
    <td> </td>
</tr>
<tr><td height="25px">*Revenus des bons de caisse au porteur</td>
    <td> </td>
    <td> </td>
    <td> </td>     
</tr>
<tr><td align="center" height="25px"><strong>Total Général  </strong></td>
    <td align="right" ><strong> ' . $pieces['montant_brut'] . ' </strong> </td>
    <td align="right" ><strong>' . $pieces['montant'] . ' </strong> </td>
    <td align="right"> <strong>' . $pieces['montant_net'] . ' </strong> </td>
</tr>

<tr>
<td  align="center" height="25px" style="border: 0px solid black;"></td>
    <td align="right"  style="border: 0px solid black;"> ' . 'F N° ' . $ligne->factureclient->numero . '  </td>
    <td align="right" style="border: 0px solid black;" >' .   $this->Time->format($ligne->factureclient->date, 'dd/MM/y') . '  </td>
    <td align="right" style="border: 0px solid black;"> <strong>' . '' . ' </strong> </td>
</tr>
<tr><td colspan="4"><strong>C- BENIFICIAIRE </strong><br>
    N° de la carte d\'identité <br> ou de passeport :  <br> ou de séjour pour les étrangers
     
        <table width="100%"><tr><td width="30%"></td>
        <td align="center"  width="70%">IDENTIFIANT<BR>
        <table border="1"  width="90%">
        <tr><td width="30%">Matricule fiscal</td><td width="20%">Code<br> T.V.A</td><td width="25%">Code <br>catégorie(2)</td><td width="25%">N°Etab secondaire</td></tr>
        <tr><td  align="center"> <strong>' . $ms[0] . '' . $ms[1] . '</strong></td><td  align="center"><strong> ' . $ms[2] . ' </strong></td  align="center"><td> <strong>' . $ms[3] . '</strong></td><td  align="center"><strong>' . $ms[4] . ' </strong></td></tr>
        </table><br>
           </td>
     
        </tr>
        <tr><td colspan="2">Nom Prénom ou raison sociale: <strong>' . $societe->nom  . '</strong><br></td></tr>
        <tr><td colspan="2">Adresse  : ' . $societe->adresse . '<br></td></tr>
        <tr><td colspan="2">Adresse de résidence :  <br></td></tr>
        </table>
</td></tr>
<tr><td colspan="4"><table><tr><td width="15%"></td>
                    <td width="75%" align="center">
                    
                    Je soussigné certifié exacts les renseignements figurants sur le présents<br>
                    certificat et m\'expose aux sanctions prévues par la loi pour toute inexactitude<br>
                    Le <strong>' . $reglement->Date. '<br><br><br></strong></td>
                        <td width="20%"></td></tr></table><br><br><br>
</td></tr>

</table>

 ';

echo $tbl;
?>