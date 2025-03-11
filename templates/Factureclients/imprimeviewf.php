<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

?>


<?php
$connection = ConnectionManager::get('default');
?>
<?php $this->layout = 'AdminLTE.print'; ?>
<?php
function int2str($a)
{
    $joakim = explode('.', $a);

    if (isset($joakim[1]) && $joakim[1] != '') {
        if (($joakim[1] != '000')) {
            if ($joakim[0] == '0') {
                return  'zero Dinars et ' . ($joakim[1]) . ' Millimes';
            }
            return int2str($joakim[0]) . ' Dinars et ' . ($joakim[1]) . ' Millimes';
        } else {
            return int2str($joakim[0]) . ' Dinars et 0 Millimes';
        }
    }


    if ($a == 0) return '';
    if ($a < 0) return 'moins ' . int2str(-$a);
    if ($a < 17) {
        switch ($a) {
            case 0:
                return 'zero';
            case 1:
                return 'un';
            case 2:
                return 'deux';
            case 3:
                return 'trois';
            case 4:
                return 'quatre';
            case 5:
                return 'cinq';
            case 6:
                return 'six';
            case 7:
                return 'sept';
            case 8:
                return 'huit';
            case 9:
                return 'neuf';
            case 10:
                return 'dix';
            case 11:
                return 'onze';
            case 12:
                return 'douze';
            case 13:
                return 'treize';
            case 14:
                return 'quatorze';
            case 15:
                return 'quinze';
            case 16:
                return 'seize';
        }
    } else if ($a < 20) {
        return 'dix-' . int2str($a - 10);
    } else if ($a < 100) {
        if ($a % 10 == 0) {
            switch ($a) {
                case 20:
                    return 'vingt';
                case 30:
                    return 'trente';
                case 40:
                    return 'quarante';
                case 50:
                    return 'cinquante';
                case 60:
                    return 'soixante';
                case 70:
                    return 'soixante-dix';
                case 80:
                    return 'quatre-vingt';
                case 90:
                    return 'quatre-vingt-dix';
            }
        } elseif (substr($a, -1) == 1) {
            if (((int)($a / 10) * 10) < 70) {
                return int2str((int)($a / 10) * 10) . '-et-un';
            } elseif ($a == 71) {
                return 'soixante-et-onze';
            } elseif ($a == 81) {
                return 'quatre-vingt-un';
            } elseif ($a == 91) {
                return 'quatre-vingt-onze';
            }
        } elseif ($a < 70) {
            return int2str($a - $a % 10) . '-' . int2str($a % 10);
        } elseif ($a < 80) {
            return int2str(60) . '-' . int2str($a % 20);
        } else {
            return int2str(80) . '-' . int2str($a % 20);
        }
    } else if ($a == 100) {
        return 'cent';
    } else if ($a < 200) {
        return int2str(100) . ' ' . int2str($a % 100);
    } else if ($a < 1000) {
        return int2str((int)($a / 100)) . ' ' . int2str(100) . ' ' . int2str($a % 100);
    } else if ($a == 1000) {
        return 'mille';
    } else if ($a < 2000) {
        return int2str(1000) . ' ' . int2str($a % 1000) . ' ';
    } else if ($a < 1000000) {
        return int2str((int)($a / 1000)) . ' ' . int2str(1000) . ' ' . int2str($a % 1000);
    }
}
?>


<style>
    body {
        font-size: 12px;
    }

    table {
        font-size: 14px;
    }


  
    .print-container {
        background-image: url('/img/imgdalanda.jpg') !important;
        background-size: cover;
        background-position: center;
        height: 1050px;
        /* Correspond à environ 297 mm */
        width: 800px;
        /* Correspond à environ 210 mm */
    }

    .page-break {
        page-break-before: always;
    }

    @media print {

        /* Masquer l'en-tête et le pied de page sur chaque page */
        .content {
            display: block !important;
            /* Afficher normalement */
            page-break-inside: avoid;
            /* Éviter les sauts de page à l'intérieur du contenu */
        }

        .page-break {
            page-break-before: always;
            /* Forcer un saut de page avant chaque section */
        }

        /* .table-container {
        max-height: 500px; 
        overflow-y: auto; 
         }*/
    }
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>

<?php

// $lignefactureclientsArray = $lignefactureclient->toArray();

// $maxLinesPerPage = 22;
// $totalLines = count($lignefactureclientsArray);
// // var_dump($totalLines);

// $totalPages = ceil($totalLines / $maxLinesPerPage);


$lignefactureclientsArray = $lignefactureclient->toArray();

$filteredLines = array_filter($lignefactureclientsArray, function ($line) {
    return $line['qte'] != 0;
});

$maxLinesPerPage = 22;
$totalLines = count($filteredLines);
$totalPages = ceil($totalLines / $maxLinesPerPage);

// var_dump($totalLines);

?>

<?php for ($page = 0; $page < $totalPages; $page++) : ?>
    <div class="print-container">

        <section class="content" style="font-family: 'Times New Roman', Times, serif;<?php echo $page > 0 ? ' page-break' : ''; ?>">

            <div style="display:flex;">
                <table cellpadding="0" cellspacing="0" style="margin-top:4%; border: 0px solid #002E50; border-left:none; border-right:none; border-collapse: collapse; width: 100%;">
                    <tbody>
                        <tr>
                            <td align="center" style="width: 35%;border: none;"></td>
                            <td align="center" style="width: 30%;border: none;height:4% !important;">
                                <b style="font-size: 18px!important; display: block; margin-bottom: 0.5em;">
                                    <?php echo 'FACTURE COMPTANT'; ?>
                                </b>
                                <b style="font-size: 16px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">
                                    <?php echo 'N° : ' . '' . $factureclient->numero; ?>
                                </b>
                                <b style="font-size: 16px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">
                                    <?php echo '' . $this->Time->format($factureclient->date, 'dd/MM/y'); ?>
                                </b>
                            </td>
                            <?php
                            // Vérifie si l'objet client est défini
                            if (isset($factureclient->client)) {
                                // Si l'ID du client est 546, on affiche NomPrenom
                                if ($factureclient->client_id == 12) {
                                    $nom_prenom = h($factureclient->nomprenom);

                                    // Teste si NomPrenom a moins de 6 mots
                                    if (str_word_count($nom_prenom) < 6) {
                                        $nom_prenom .= str_repeat('<br>', 2); // Ajouter 2 sauts de ligne si moins de 6 mots
                                    }

                                    $raison_sociale = $nom_prenom;
                                } else {
                                    // Sinon, on affiche Raison_Sociale et on ajuste en fonction du nombre de mots
                                    $raison_sociale = h($factureclient->client->Raison_Sociale);

                                    if (str_word_count($raison_sociale) < 6) {
                                        $raison_sociale .= str_repeat('<br>', 2); // Ajouter 2 sauts de ligne si moins de 6 mots
                                    }
                                }
                            } else {
                                $raison_sociale = ''; // Si aucun client n'est défini
                            }
                            ?>
                            <td class="client-info" style="width: 35%; border: none; font-size: 15px; height: 70px; vertical-align: top;">
                                <b style="font-size: 18px; font-weight: bold; display: block; margin-bottom: 0.5em;">
                                    &nbsp;<?php echo $raison_sociale; ?>
                                </b>
                                <b style="font-size: 16px; font-weight: normal; display: block; margin-bottom: 0.5em;">
                                    &nbsp;<?php if (isset($factureclient->client)) {
                                                if ($factureclient->client_id != 12) {
                                                    echo h($factureclient->client->Adresse);
                                                } else {
                                                    echo h($factureclient->adressediv);
                                                }
                                            } //echo h($bonlivraison->client->Adresse); 
                                            ?>
                                </b>
                                <b style="font-size: 16px; font-weight: normal; display: block; margin-bottom: 0.5em;">
                                    &nbsp;<?php
                                            if ($factureclient->client_id != 12) {
                                                echo 'M.F : ';
                                                if (!empty($factureclient->client)) {
                                                    echo h($factureclient->client->Matricule_Fiscale);
                                                }
                                            } else {
                                                echo 'I.D : ';
                                                if (!empty($factureclient->client)) {
                                                    echo h($factureclient->numeroidentite);
                                                }
                                            }
                                            ?> </b>
                            </td>
                            <!-- <td align="left" style="width: 35%;border: none;font-size: 15px;height:4% !important;">
                                <b style="font-size: 18px!important;  display: block; margin-bottom: 0.5em;">&nbsp;
                                    <?php if (isset($factureclient->client)) {
                                        echo  h($factureclient->client->Raison_Sociale);
                                    } ?>
                                </b>
                                <b style="font-size: 16px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                                    <?php if (isset($factureclient->client)) {
                                        echo  h($factureclient->client->Adresse);
                                    } ?>
                                </b>
                                <b style="font-size: 16px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                                    <?php echo 'M.F : ';
                                    if (isset($factureclient->client)) {
                                        echo  h($factureclient->client->Matricule_Fiscale);
                                    } ?>
                                </b> -->
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
            <div style="margin-top: -17.6%;">
                <table style="border-width: 0px;  width: 100%; border-collapse: collapse; margin-top:31%;">
                    <thead>

                    </thead>

                    <tbody>
                        <?php
                        $start = $page * $maxLinesPerPage;
                        //  var_dump($page);
                        $end = min(($page + 1) * $maxLinesPerPage, $totalLines);
                        //  var_dump($end);
                        $pp = 0;
                        for ($i = $start; $i < $end; $i++) :
                            $pp++;
                            $lignecommande = $lignefactureclientsArray[$i];
                            ///  debug( $lignecommande);
                            $qte = $lignecommande->qte;
                            $prix = $lignecommande->punht;
                            $ml = $lignecommande->ml;
                            $montant = $qte * $prix * $ml;
                        ?>
                            <tr height="25px" style="font-size: 15px!important;">

                                <td align="left" style="vertical-align:top; width:50%;">
                                    <b style="text-align: left;font-weight: normal;margin-left: 1% !important;">
                                        <?php
                                        if (isset($lignecommande->article)) {
                                            echo  h($lignecommande->article->Dsignation);
                                        }
                                        ?>
                                    </b>
                                </td>

                                <td align="center" style="vertical-align:top;width:6%">
                                    <b style="margin-left: -135% !important;font-weight: normal;">
                                        <?php
                                        $unite = [];
                                        if (isset($lignecommande->article->unite_id) && ($lignecommande->article->unite_id != 0)) {
                                            $unite = $connection->execute('SELECT * FROM unites where unites.id=' . $lignecommande->article->unite_id . ';')->fetchAll('assoc');
                                            if ($unite[0]['name'] = 'Piéce') {
                                                echo 'P';
                                            } else {
                                                echo ($unite[0]['name']);
                                            }
                                        } else echo ' '; ?>
                                    </b>
                                </td>
                                <td align="center" style=" vertical-align:top;text-align:center;width:10%">
                                    <b style="font-weight: normal;margin-left: -40% !important;">
                                        <?= $this->Number->format($lignecommande->qte) ?>
                                    </b>
                                </td>


                                <td align="center" style=" vertical-align:top;text-align:center;width:15%">
                                    <b style="margin-left: 1% !important;font-weight: normal;">
                                        <?php
                                        // $this->Number->format($lignecommande->punht) 
                                        echo number_format(abs($lignecommande->punht), 3, ',', ' '); ?>
                                    </b>
                                </td>


                                <td align="center" style="vertical-align:top;width:9.5%;">
                                    <b style="font-weight: normal;padding-right: 40% !important;">
                                        <?php
                                        if ($lignecommande->remise === 0 || empty($lignecommande->remise)) {
                                            echo ' ';
                                        } else {
                                            echo $this->Number->format($lignecommande->remise) . '%';
                                        }
                                        ?>

                                    </b>
                                </td>

                                <td align="center" style="vertical-align:top;text-align:right;width:15%">
                                    <b style="font-weight: normal;margin-left: -10.5% !important;"> <?php // $this->Number->format($montant)  
                                                                                                    echo number_format(abs($montant), 3, ',', ' '); ?></b>
                                </td>
                            </tr>
                        <?php endfor; ?>
                        <style>
                            .fixed-height-row {
                                height: 30px;
                            }
                        </style>
                        <?php
                        if ($page == ($totalPages - 1)) {

                        ?>
                            <tr class="fixed-height-row">
                                <td style="text-align:left;width:50%;">
                                    <?php if (!empty($factureclient->observation)) : ?>
                                        <b><?php echo $factureclient->observation; ?></b>
                                    <?php else : ?>
                                        <b>&nbsp;</b>
                                    <?php endif; ?>
                                </td>
                                <td colspan="5"></td>

                            </tr>
                        <?php }   ?>
                        <?php if ($pp < 22) {
                            $rest = 22 - $pp;
                            $h = 25 * $rest;
                            $hh = $h - 30;
                            // var_dump($pp) 
                        ?>
                            <tr height="<?php echo $hh ?>px">

                                <td align="left" style="vertical-align:top; width:50%">

                                </td>

                                <td align="center" style="vertical-align:top;width:6%">

                                </td>
                                <td align="center" style=" vertical-align:top;text-align:center;width:10%">

                                </td>


                                <td align="center" style=" vertical-align:top;text-align:center;width:15%">

                                </td>


                                <td align="left" style="vertical-align:top;width:9.5%;">

                                </td>

                                <td align="center" style="vertical-align:top;text-align:rightmyyy;width:15%">

                                </td>
                            </tr>
                            <!-- <tr>
                                <td colspan="6" style="text-align:left;">
                                    <b><?php //echo $factureclient->observation; 
                                        ?></b>
                                </td>
                            </tr> -->
                        <?php   }  ?>


                    </tbody>
                </table>

            </div>
            <?php     //var_dump($page);
            //  echo $page .'=='. ($totalPages - 1) ;
            if ($page == ($totalPages - 1)) {

            ?>
                <div style="display:flex; margin-left:8%;">

                    <table style="width: 60%;border-collapse: collapse;border-radius: 15px;margin-top:6%;">
                        <thead>
                        </thead>
                        <tbody>
                            <?php $lignestable = TableRegistry::getTableLocator()->get('Lignefactureclients');
                            $query = $lignestable->find();
                            $query->select([
                                'tva' => 'Lignefactureclients.tva',
                                'base' => $query->func()->sum('(qte*ml*punht)'),
                                'total' => $query->func()->sum('((qte*ml*punht - (qte*ml*punht)* (remise / 100) + (qte*ml*punht - (qte*ml*punht)* (remise / 100)) * ifnull(fodec,0) / 100)) * tva / 100')
                            ])
                                ->where(['Lignefactureclients.factureclient_id' => $factureclient->id])
                                ->group('Lignefactureclients.tva');

                            // Execute the query
                            $results = $query->toArray();
                            $fodquery = $lignestable->find();
                            $fodquery->select([
                                'fodec' => 'Lignefactureclients.fodec',
                                'base' => $query->func()->sum('qte*ml*punht - (qte*ml*punht)* (remise / 100)'),
                                'total' => $query->func()->sum('(qte*ml*punht - (qte*ml*punht)* (remise / 100)) *ifnull(fodec,0) / 100')
                            ])
                                ->where(['Lignefactureclients.factureclient_id' => $factureclient->id])
                                ->group('Lignefactureclients.fodec');

                            // Execute the query
                            // $fodresults = $fodquery->toArray();
                            // print_r($results);
                            foreach ($results as $rrr) {
                                if ($rrr->tva != 0) {
                            ?>
                                    <tr class="tr">
                                        <td align="center" height="15px">

                                        </td>
                                        <td align="left" height="15px">
                                            &nbsp;&nbsp;
                                            <b style="margin-left: 18% !important; font-weight: normal; font-size:15px; margin-top:-21.2px; display: block; margin-bottom: 10px;">
                                                <?= $this->Number->format($rrr->tva) ?>
                                            </b>
                                            <b style="margin-left: 18% !important; font-weight: normal; font-size:15px; display: block; margin-top: -0.2px;">
                                                <?php echo number_format(abs($rrr->base), 3, ',', ' '); ?>
                                            </b>
                                        </td>

                                        <!-- <td align="left">
                                    &nbsp;&nbsp;
                                    <b style="margin-left: 27% !important;font-weight: normal;font-size:14px;margin-top:-9px;">

                                        <?= $this->Number->format($rrr->tva) ?>
                                    </b>
                                    <br> &nbsp;&nbsp;
                                    <b style="margin-left: 27% !important;font-weight: normal;font-size:14px;margin-top:15px;">
                                        <?php echo number_format(abs($rrr->total), 3, ',', ' '); ?>
                                    </b>
                                </td> -->
                                        <td align="center">
                                            <b style="margin-left:65%;font-weight: normal;">
                                                <?php
                                                //echo number_format(abs($rrr->base), 3, ',', ' '); 
                                                ?>
                                            </b>
                                        </td>
                                        <td align="center">
                                            <b style="margin-left:14%;font-weight: normal;">
                                                <?php // $this->Number->format($rrr->total)
                                                //echo number_format(abs($rrr->total), 3, ',', ' '); 
                                                ?>
                                            </b>
                                        </td>
                                        <td align="center">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                            <?php }
                            } ?>
                            <?php
                            foreach ($fodresults as $frrr) {
                                if ($frrr->fodec != 0) {
                            ?>
                                    <tr class="tr">
                                        <td align="center" height="20px">
                                        </td>
                                        <td align="center">
                                            <b style="margin-left: 100% !important;font-weight: normal;">

                                                <?php
                                                //echo number_format(abs($frrr->base), 3, ',', ' '); 
                                                ?>
                                            </b>
                                        </td>
                                        <td align="center" style="width: 20%;">
                                            <b style="font-weight: normal;">
                                                <?php
                                                //echo number_format(abs($frrr->total), 3, ',', ' ');
                                                ?>
                                            </b>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <table style="width: 55%; border-collapse: collapse; border-radius: 15px; margin-top: 2.7%; margin-left: 40%!important;">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: left; width: 50%; vertical-align: top;">
                                    <br>

                                    <b style=" width: 100px;margin-left:-10!important; line-height: 1.2;">
                                        <?php if ($factureclient->totalremise != 0) { ?>
                                            <?php echo 'Rem Mt:'; ?> <?php } ?><br></b>

                                    <b style="width: 100px;margin-left:-10!important; line-height: 1.2;"><?php echo 'Total HT:'; ?><br></b>
                                    <b style="width: 100px;margin-left:-10!important; line-height: 1.2;"><?php echo 'Total TVA:'; ?><br></b>
                                    <b style="width: 100px;margin-left:-10!important; line-height: 1.2;"><?php echo 'Timbre:';
                                                                                                            ?><br></b>
                                    <b><br></b>
                                </td>
                                <td style="text-align: left; width: 50%; vertical-align: top;">
                                    <br>

                                    <b style="display: inline-block; width: 130px; text-align: right; line-height: 1.2;">
                                        <?php if ($factureclient->totalremise != 0) { ?>
                                            <?php echo number_format(abs($factureclient->totalremise), 2, ',', ' '); ?><?php } ?><br>
                                    </b>

                                    <b style="display: inline-block; width: 130px; text-align: right; line-height: 1.2;">
                                        <?php echo number_format(abs($factureclient->totalht), 2, ',', ' '); ?><br>
                                    </b>
                                    <b style="display: inline-block; width: 130px; text-align: right; line-height: 1.2;">
                                        <?php echo number_format(abs($factureclient->totaltva), 2, ',', ' '); ?><br>
                                    </b>
                                    <b style="display: inline-block; width: 130px; text-align: right;line-height:1.2;">
                                        <?php echo number_format(abs($factureclient->timbre->timbre), 3, ',', ' '); ?><br>
                                    </b>

                                    <!-- <b style="display: inline-block; width: 130px; text-align: right; line-height: 1.5;">
                                        <?php //echo $timbre; 
                                        ?><br>
                                    </b> -->
                                    <b style="font-size: 16px!important; margin-top: -6.6px!important; font-weight: bold; display: inline-block; width: 130px; text-align: right;">
                                        <br><?php echo number_format(abs($factureclient->totalttc), 3, ',', ' '); ?>
                                    </b>
                                </td>
                            </tr>
                        </tbody>
                    </table>



                </div>
                <table style="width: 65%;border-collapse: collapse;border-radius: 15px;margin-top:-5%;margin-left:-3%;">
                    <thead>
                    </thead>
                    <tbody>
                        <?php
                        ?>
                        <tr class="tr">
                            <td align="center" height="20px">
                                <?php ///echo  'Arrêté  le présent BL  à la somme de :'; 
                                ?>
                            </td>
                        </tr>
                        <tr class="tr">

                            <td align="center" height="20px">
                                <b style="font-weight: normal;margin-top:-5% !important;font-size: 18px;!important"> <?php echo int2str($factureclient->totalttc, 1, 1) ?></b>
                            </td>

                        </tr>
                        <?php
                        ?>

                    </tbody>
                </table>
            <?php }
            ?>

        </section>

    </div>
<?php endfor; ?>