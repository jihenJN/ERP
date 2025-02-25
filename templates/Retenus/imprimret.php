<?php $this->layout = 'AdminLTE.print'; ?>
<style>
    @media print {
        body {
            font-family: 'Times New Roman', Times;
            font-size: 16px;
        }

        .page-break {
            page-break-before: always;
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

$lignepieceArray = $pieces->toArray();
// var_dump($lignebonlivraisonsArray);

$maxLinesPerPage = 2;
$totalLines = count($lignepieceArray);

$totalPages = ceil($totalLines / $maxLinesPerPage);
$page = 0;
?>

<?php for ($page = 0; $page < $totalPages; $page++) : ?>
    <?php


    $logo = $societe->logo;

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
    $adressee = $connection->execute("SELECT * FROM adresselivraisonclients WHERE client_id = '" . $retenu->client_id . "'")->fetchAll('assoc'); ?>

    <section class="content" style="font-family: 'Times New Roman', Times, serif;<?php echo $page > 0 ? ' page-break' : ''; ?>">

        <?php $tbl = '
<table width="100%" border="0">

    <tr>
        <td width="30%">
            <font size="3px" style="font-size: 14px; line-height: 1.5;">
                RÉPUBLIQUE TUNISIENNE <br>
                MINISTÈRE DE PLAN ET DES FINANCES <br>
                DIRECTION GÉNÉRALE <br>
                DE CONTRÔLE FISCAL
            </font>
        </td>
    </tr>
        <tr>
        <td width="90%" align="center"  width="100%" align="center" style="padding-top: 20px;">
            <font size="5px">CERTIFICAT DE RETENUE D\'IMPÔT SUR LE REVENU OU D\'IMPÔT SUR LES SOCIÉTÉS</font>
        </td>
    </tr><br>
    <tr>
        <td align="center"  align="center" style="padding-top: 20px;">   RETENU EFFECTUEE LE :  ' . htmlspecialchars($this->Time->format($retenu->date, 'dd/MM/y'), ENT_QUOTES, 'UTF-8') . '</td>
        <br>
        
   </tr>
   <tr><td align="center">OU PENDANT (1) </td></tr>
</table>

<table border="1">
    <tr>
        <td colspan="5"><strong>A- PERSONNE OU ORGANISME PAYEUR</strong></td>
    </tr>
    <tr>
        <td colspan="5">
            <table width="100%">
                <tr>
                    <td width="30%"></td>
                    <td width="70%" align="center">
                        IDENTIFIANT
                        <table border="1" width="90%">
                            <tr>
                                <td width="30%">Mat. Fiscal</td>
                                <td width="20%">Code<br>Cod. T.V.A</td>
                                <td width="25%">Code<br>Cod. Cat.</td>
                                <td width="25%">N° Étab</td>
                            </tr>
                            <tr>
                                <td align="center"><strong>' . htmlspecialchars($combinedPart . $part1, ENT_QUOTES, 'UTF-8') . '</strong></td>
                                <td align="center"><strong>' . htmlspecialchars($part2, ENT_QUOTES, 'UTF-8') . '</strong></td>
                                <td align="center"><strong>' . htmlspecialchars($part3, ENT_QUOTES, 'UTF-8') . '</strong></td>
                                <td align="center"><strong>' . htmlspecialchars($part4, ENT_QUOTES, 'UTF-8') . '</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Nomination de la personne ou de l\'organisme payeur: <strong>' . htmlspecialchars($client->Raison_Sociale, ENT_QUOTES, 'UTF-8') . '</strong></td>
                </tr>
                <tr>
                    <td colspan="2">Adresse : ' . htmlspecialchars($adressee[0]['adresse'], ENT_QUOTES, 'UTF-8') . '</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="45%"><strong>B- RETENUES EFFECTUÉES SUR :</strong></td>
        <td width="5%" align="center"><strong>%</strong></td>
        <td width="15%" align="center"><strong>MT BRUT</strong></td>
        <td width="15%" align="center"><strong>RETENUE</strong></td>
        <td width="15%" align="center"><strong>MT NET</strong></td>
    </tr>';
        $ttbrut = 0;
        $ttmnt = 0;
        $ttnet = 0;

        $start = $page * $maxLinesPerPage;
        //  var_dump($page);
        $end = min(($page + 1) * $maxLinesPerPage, $totalLines);
        // var_dump($totalLines);
        $pp = 0;
        for ($i = $start; $i < $end; $i++) {
            $pp++;
            $lignep = $lignepieceArray[$i];
            $to_id = $lignep->to_id;
            $totalttc = $lignep->totalttc;
            $montant_net = $lignep->montant_net;
            $montant = $lignep->montant;
            $numero =  $lignep->factureclient->numero;


            if ($to_id == '1') {
                $taux = 1;
            }
            if ($to_id == '2') {
                $taux = 3;
            }
            if ($to_id == '3') {
                $taux = 10;
            };
            if ($to_id == '4') {
                $taux = 5;
            }
            if ($to_id == '5') {
                $taux = 1.5;
            };
            if ($to_id == '6') {
                $taux = 0.5;
            }
            if ($to_id == '7') {
                $taux = 15;
            }
            if ($to_id == '8') {
                $taux = 0;
            }
            $brut = $totalttc;

            $ttbrut += $brut;
            $ttmnt += $montant;
            $ttnet += $montant_net;
            $tbl .= '
        <tr>
            <td align="right">' .
                'Facture Comptant N°: ' . htmlspecialchars($numero, ENT_QUOTES, 'UTF-8') .
                ' Du: ' . htmlspecialchars($this->Time->format($retenu->date, 'dd/MM/y'), ENT_QUOTES, 'UTF-8') .
                '</td>
            <td align="right">' .  $taux . '</td>
            <td align="right">' . htmlspecialchars($totalttc, ENT_QUOTES, 'UTF-8') . '</td>
            <td align="right">' . htmlspecialchars($montant, ENT_QUOTES, 'UTF-8') . '</td>
            <td align="right">' . htmlspecialchars(number_format($montant_net, 3, '.', ''), ENT_QUOTES, 'UTF-8') . '</td>
        </tr>';
        }

    // var_dump($pp);
        if ($pp > $maxLinesPerPage) {
            $rest = $maxLinesPerPage - $pp;
            $h = 25 * $rest; ?>
            <?php $tbl .= ' 
            <tr height="' . $h . 'px">

            <td align="right">' .
                'Facture Comptant N°: ' . htmlspecialchars($numero, ENT_QUOTES, 'UTF-8') .
                ' Du: ' . htmlspecialchars($this->Time->format($retenu->date, 'dd/MM/y'), ENT_QUOTES, 'UTF-8') .
                '</td>
            <td align="right">' .  $taux . '</td>
            <td align="right">' . htmlspecialchars($totalttc, ENT_QUOTES, 'UTF-8') . '</td>
            <td align="right">' . htmlspecialchars($montant, ENT_QUOTES, 'UTF-8') . '</td>
            <td align="right">' . htmlspecialchars(number_format($montant_net, 3, '.', ''), ENT_QUOTES, 'UTF-8') . '</td>
        </tr>'; ?>

        <?php   }  ?>

        <?php     //var_dump($page);
        //  echo $page .'=='. ($totalPages - 1) ;
        //if ($page == ($totalPages - 1)) {

        ?>
            <?php $tbl .= '

     
        <tr>
            <td align="center" colspan="2"><strong>' .
                'Total :' .
                '</strong></td>
            <td align="right">' . htmlspecialchars($ttbrut, ENT_QUOTES, 'UTF-8') . '</td>
            <td align="right">' . htmlspecialchars($ttmnt, ENT_QUOTES, 'UTF-8') . '</td>
            <td align="right">' . htmlspecialchars(number_format($ttnet, 3, '.', ''), ENT_QUOTES, 'UTF-8') . '</td>
        </tr>' ?>

        <?php  //}      ?>
        <?php $tbl .= '
        <td colspan="5"><strong>C- BÉNÉFICIAIRE</strong><br>
            N° de la carte d\'identité<br> ou de passeport :<br> ou de séjour pour les étrangers
            <table width="100%">
                <tr>
                    <td width="30%"></td>
                    <td align="center" width="70%">
                        IDENTIFIANT
                        <table border="1" width="90%">
                            <tr>
                      
                                <td width="30%">Mat. Fiscal</td>
                                <td width="20%">Code<br>Cod. T.V.A</td>
                                <td width="25%">Code<br>Cod. Cat.</td>
                                <td width="25%">N° Étab</td>
                            </tr>
                            <tr>
                                <td align="center"><strong>' . htmlspecialchars($ms[0] . $ms[1], ENT_QUOTES, 'UTF-8') . '</strong></td>
                                <td align="center"><strong>' . htmlspecialchars($ms[2], ENT_QUOTES, 'UTF-8') . '</strong></td>
                                <td align="center"><strong>' . htmlspecialchars($ms[3], ENT_QUOTES, 'UTF-8') . '</strong></td>
                                <td align="center"><strong>' . htmlspecialchars($ms[4], ENT_QUOTES, 'UTF-8') . '</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Nom, Prénom ou raison sociale: <strong>' . htmlspecialchars($societe->nom, ENT_QUOTES, 'UTF-8') . '</strong></td>
                </tr>
                <tr>
                    <td colspan="2">Adresse: ' . htmlspecialchars($societe->adresse, ENT_QUOTES, 'UTF-8') . '</td>
                </tr>
                <tr>
                    <td colspan="2">Adresse de résidence:</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="5">
            <table>
                <tr>
                    <td width="15%"></td>
                    <td width="75%" align="center">
                        Je soussigné certifie exacts les renseignements figurant sur le présent<br>
                        certificat et m\'expose aux sanctions prévues par la loi pour toute inexactitude.<br>
                       
                    </td>
                    <td width="20%"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>';

        echo $tbl;
        ?>
    </section>
<?php endfor; ?>