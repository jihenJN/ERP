<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;


$connection = ConnectionManager::get('default');

$this->layout = 'AdminLTE.print';

function int2str($a)
{
    $joakim = explode('.', $a);
    if (isset($joakim[1]) && $joakim[1] != '') {
        return int2str($joakim[0]) . ' virgule ' . int2str($joakim[1]);
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
        font-size: 12px;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>

<?php
// Convertir la liste d'IDs en un tableau
$factureIdsList = explode(',', $factureIds);

foreach ($factureIdsList as $factureId) {
    $factureQuery = "SELECT * FROM factureclients 
                     LEFT JOIN clients ON factureclients.client_id = clients.id
                     LEFT JOIN depots ON factureclients.depot_id = depots.id
                     WHERE factureclients.id = $factureId";

    // Exécuter la requête
    $result = $connection->execute($factureQuery)->fetchAll('assoc');

    foreach ($result as $factureclient) {
        // debug($factureclient['id']);die;

?>
        <div style="display:flex;">
            <table border="1" cellpadding="0" cellspacing="0" style="border: 2px solid #002E50; border-left:none;border-right:none;border-collapse: collapse; width: 100%; ">


                <td align="center" style="width: 25%;border: none;">
                    <div>
                        <?php
                        echo $this->Html->image('logoSMBM.png', ['alt' => 'CakePHP', 'height' => '80px', 'width' => '100%']); ?>
                    </div>
                </td>
                <td align="center" style="width: 10%;border: none;">
                    <!-- <div>
            <?php
            echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); ?>

            </div> -->
                </td>
                <td align="center" style="width: 50%; border: none; color: #002E50; font-weight: bold;">
                    <?php echo $societefirst->adresseEntete; ?><br>
                </td>
                <td align="center" style="width: 25%;border: none;">
                    <div>
                        <?php
                        // echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); 
                        ?>

                    </div>
                </td>

                </td>
            </table>
        </div>
        <br>

        Date: <?php
                date_default_timezone_set('Africa/Tunis');

                echo date('d/m/Y H:i:s');
                ?>
        <br><br>

        <div align="center">
            <h3>
                <b style="margin-left:7% ;"> FACTURE N° : </b><?= h($factureclient['numero']) ?> <br>
            </h3>
        </div>
        <div style="display:flex;margin-bottom:3px;" align="center">
            <div style="display:flex;width: 1000%;">
                <div style="width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;padding-top:2px;padding-bottom:2px" align="left">
                    <br>
                    <b style="margin-left:7% ;"> Code: </b><?= h($factureclient['Code']) ?> <br>
                    <b style="margin-left:7% ;"> Matricule fiscale :</b><?= h($factureclient['Matricule_Fiscale']) ?> <br>
                    <b style="margin-left:7% ;"> Client : </b> <?php
                                                                if (isset($factureclient['client'])) {
                                                                    echo  h($factureclient['Raison_Sociale']);
                                                                } ?><br>
                    <b style="margin-left:7% ;"> Adresse :</b>
                    <!-- <p style="margin-left:7% ;margin-top: 1px;"> -->
                    <?= h($factureclient['Adresse']) ?>
                    <!-- </p> -->
                    <br>
                    <b style="margin-left:7% ;"> Tel : </b><?php
                                                            //   if (isset($factureclient['client'])) {
                                                            echo  h($factureclient['Tel']);
                                                            // } 
                                                            ?>
                </div>
            </div>
            <div style="display:flex ;width:1000%;margin-left:10%;">
                <div style="width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;padding-top:3px;padding-bottom:3px" align="left">
                    <?php
                    $bl = $connection->execute('SELECT * FROM bonlivraisons where bonlivraisons.typebl=1 and bonlivraisons.factureclient_id=' . $factureId . ';')->fetchAll('assoc');
                    $cmd = [];
                    if ($bl[0]['id'] != null) {
                        $cmd = $connection->execute('SELECT * FROM commandes where commandes.bonlivraison_id=' . $bl[0]['id'] . ';')->fetchAll('assoc');
                    }
                    $offre = [];
                    if ($cmd[0]['id'] != null) {
                        $offre = $connection->execute('SELECT * FROM bonlivraisons where bonlivraisons.typebl=2 and bonlivraisons.commande_id=' . $cmd[0]['id'] . ';')->fetchAll('assoc');
                    }
                    $integ = [];
                    if ($offre[0]['id'] != null) {
                        $integ = $connection->execute('SELECT * FROM bonlivraisons where bonlivraisons.typebl=4 and bonlivraisons.id_offredeprix=' . $offre[0]['id'] . ';')->fetchAll('assoc');
                    }

                    ?>
                    <!-- <b style="margin-left:7% ;"> Intégration N° : </b><?php echo ($integ[0]['numero']) ?>
            <br>
            <b style="margin-left:7% ;"> Offre de prix N° : </b><?php echo ($offre[0]['numero']) ?>
            <br>
            <b style="margin-left:7% ;"> BON DE COMMANDES N° : </b><?php echo ($cmd[0]['numero']) ?>
             <br> -->
                    <b style="margin-left:7% ;"> BON DE Livraison N° : </b><?php echo ($bl[0]['numero']) ?> <br>
                    <b style="margin-left:7% ;"> Date : </b><?= $this->Time->format(
                                                                $factureclient['date'],
                                                                'dd/MM/y'
                                                            ); ?> <br>
                    <!-- <b style="margin-left:7% ;"> Représentant : </b> <?php

                                                                            if (isset($factureclient['commercial_id'])) {
                                                                                $commercial = $connection->execute('SELECT * FROM commercials where commercials.id=' . $factureclient['commercial_id'] . ';')->fetchAll('assoc');

                                                                                echo ($commercial['name']);
                                                                            } ?><br> -->
                </div>
            </div>
        </div>
        <br>
        <!-- <br>
        <br> -->
        <div>
            <div class="panel-body">
                <div>
                    <table style="border:1px solid black;width: 100%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;" height="580px">
                        <thead>
                            <tr>
                                <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>CODE</strong></td>
                                <td align="center" style="width: 40%;border:1px solid black;background-color:#b5d6d3;"><strong>DESIGNATION</strong></td>
                                <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité</strong></td>
                                <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté</strong></td>
                                <!-- <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>ml</strong></td> -->
                                <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>P.U.H.T</strong></td>
                                <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>Remise</strong></td>
                                <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>Montant HT </strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nombreLignes = 0;
                          
                            $dd = "SELECT * FROM lignefactureclients 
                                    LEFT JOIN articles ON lignefactureclients.article_id = articles.id
                                    WHERE lignefactureclients.factureclient_id = " . $factureId;

                            $lignee = $connection->execute($dd)->fetchAll('assoc');
                            /// debug($lignee);die;
                            $nombreLignes = count($lignee);

                            foreach ($lignee as $lignecommande) :
                                //  debug($lignecommande);
                                $nombreLignes = $nombreLignes + 1;

                                $qte = $lignecommande['qte'];
                                $prix = $lignecommande['punht'];
                                $ml = $lignecommande['ml'];
                                $montant = $qte * $prix * $ml;
                            ?>
                                <tr class="tr">
                                    <td align="center" style="border:1px solid black;vertical-align:top;height:2% !important;">
                                        <?= ($lignecommande['Code']) ?>
                                    </td>

                                    <td align="left" style="border:1px solid black;vertical-align:top;">
                                        <div style="margin-left: 3%;"><?php
                                                                        //  if (isset($lignecommande->article)) {
                                                                        echo  h($lignecommande['Dsignation']);
                                                                        //}
                                                                        ?></div>
                                    </td>
                                    <td align="center" style="border:1px solid black;vertical-align:top;">
                                        <?php
                                        $unite = [];
                                        $article = $connection->execute('SELECT * FROM articles where articles.id=' . $lignecommande['article_id'] . ';')->fetch('assoc');
                                        if ($article['unite_id'] != '' && $article['unite_id']) {
                                            $unite = $connection->execute('SELECT * FROM unites where unites.id=' . $article['unite_id'] . ';')->fetchAll('assoc');

                                            echo ($unite[0]['name']);
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td align="center" style="border:1px solid black;vertical-align:top;">
                                        <?= $this->Number->format($lignecommande['qte']) ?>
                                    </td>

                                    <td align="left" style="border:1px solid black;vertical-align:top;text-align:left">
                                        <div style="margin-left: 25% ;"><?php  //$this->Number->format($lignecommande->punht) 
                                                                        ?>
                                            <?php // $this->Number->format($lignecommande->prix) 
                                            echo number_format(abs($lignecommande['punht']), 3, ',', ' '); ?></div>
                                    </td>


                                    <td align="center" style="border:1px solid black;vertical-align:top;">
                                        <?= $this->Number->format($lignecommande['remise']) ?> %
                                    </td>


                                    <td align="center" style="border:1px solid black;vertical-align:top;text-align:right">
                                        <div style="margin-right: 25%;">
                                            <?php // $this->Number->format($montant)
                                            echo number_format(abs($montant), 3, ',', ' '); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php $nombreLignes += 25;
                            endforeach; ?>
                            <?php

                            $rowHeight = 400;
                            $calcul = $rowHeight - $nombreLignes;
                            ?>
                            <tr style="height:<?php echo $calcul ?>px;">
                                <!-- <td style="border:1px solid black;vertical-align:top;"></td> -->
                                <!-- <td style="border:1px solid black;vertical-align:top;"></td> -->
                                <td style="border:1px solid black;vertical-align:top;"></td>
                                <td style="border:1px solid black;vertical-align:top;"></td>
                                <td style="border:1px solid black;vertical-align:top;"></td>
                                <td style="border:1px solid black;vertical-align:top;"></td>
                                <td style="border:1px solid black;vertical-align:top;"></td>
                                <td style="border:1px solid black;vertical-align:top;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div style="display:flex" align="center">
                        <div style="width: 58%;margin-right:10px;" align="left">
                            <table style="width: 100%;border-collapse: collapse;border-radius: 15px;">
                                <thead>
                                    <tr>
                                        <th align="center" style="width: 55%;border:1px solid black;background-color:#b5d6d3;"><strong>CACHET & SIGNATURE DU CLIENT</strong></th>
                                        <th align="center" style="width: 15%;border:1px solid black;background-color:#b5d6d3;"><strong>Taux </strong></th>
                                        <th align="center" style="width: 15%;border:1px solid black;background-color:#b5d6d3;"><strong>BASE</strong></th>
                                        <th align="center" style="width: 15%;border:1px solid black;background-color:#b5d6d3;"><strong>MONTANT</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $lignestable = TableRegistry::getTableLocator()->get('Lignefactureclients');

                                    $query = $lignestable->find();
                                    $query->select([
                                        'tva' => 'Lignefactureclients.tva',
                                        'base' => $query->func()->sum('(qte*ml*punht - (qte*ml*punht)* (remise / 100) + (qte*ml*punht - (qte*ml*punht)* (remise / 100)) * ifnull(fodec,0) / 100)'),
                                        'total' => $query->func()->sum('((qte*ml*punht - (qte*ml*punht)* (remise / 100) + (qte*ml*punht - (qte*ml*punht)* (remise / 100)) * ifnull(fodec,0) / 100)) * tva / 100')
                                    ])
                                        ->where(['Lignefactureclients.factureclient_id' =>$factureId])
                                        ->group('Lignefactureclients.tva');

                                    // Execute the query
                                    $results = $query->toArray();


                                    $fodquery = $lignestable->find();
                                    $fodquery->select([
                                        'fodec' => 'Lignefactureclients.fodec',
                                        'base' => $query->func()->sum('qte*ml*punht - (qte*ml*punht)* (remise / 100)'),
                                        'total' => $query->func()->sum('(qte*ml*punht - (qte*ml*punht)* (remise / 100)) *ifnull(fodec,0) / 100')
                                    ])
                                        ->where(['Lignefactureclients.factureclient_id' => $factureId])
                                        ->group('Lignefactureclients.fodec');

                                    // Execute the query
                                    $fodresults = $fodquery->toArray();
                                    // print_r($results);

                                    foreach ($results as $rrr) {
                                        if ($rrr->tva != 0) {
                                    ?>

                                            <tr class="tr">

                                                <td align="center" height="58px" style="border:1px solid black;">

                                                </td>

                                                <td align="center" style="border:1px solid black;">
                                                    <?= $this->Number->format($rrr->tva) ?>

                                                </td>
                                                <td align="center" style="border:1px solid black;">
                                                    <?php //$this->Number->format($rrr->base) 
                                                    ?>
                                                    <?php  // $this->Number->format($rrr->base)
                                                    echo number_format(abs($rrr->base), 3, ',', ' '); ?>


                                                </td>
                                                <td align="center" style="border:1px solid black;width: 20%;">
                                                    <?php // $this->Number->format($rrr->total) 
                                                    ?>
                                                    <?php // $this->Number->format($rrr->total)
                                                    echo number_format(abs($rrr->total), 3, ',', ' '); ?>
                                                </td>
                                            </tr>



                                    <?php }
                                    } ?>

                                    <?php
                                    foreach ($fodresults as $frrr) {
                                        if ($frrr->fodec != 0) {
                                    ?>

                                            <tr class="tr">

                                                <td align="center" height="20px" style="border:1px solid black;">

                                                </td>

                                                <td align="center" style="border:1px solid black;">
                                                    <?= $this->Number->format($frrr->fodec) ?>

                                                </td>
                                                <td align="center" style="border:1px solid black;">
                                                    <?= $this->Number->format($frrr->base) ?>


                                                </td>
                                                <td align="center" style="border:1px solid black;width: 20%;">
                                                    <?= $this->Number->format($frrr->total) ?>
                                                </td>
                                            </tr>


                                    <?php }
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                        <div style="width: 40%;border:1px solid black;" align="left" align="left">

                            <table style="width: 100%;border-collapse: collapse;border-radius: 15px;">

                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="margin-left: 6%;">Total Hors Taxes :</div>
                                        </td>
                                        <td align="right">
                                            <div style="margin-right: 10% ;"><?php // $this->Number->format($factureclient->totalht) 
                                                                                ?>
                                                <?php // $this->Number->format($rrr->total)
                                                echo number_format(abs($factureclient['totalht']), 3, ',', ' '); ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="margin-left: 6%;">Remise :</div>
                                        </td>
                                        <td align="right">
                                            <div style="margin-right: 10% ;"><?= $this->Number->format($factureclient['totalremise']) ?></div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div style="margin-left: 6%;">TVA :</div>
                                        </td>
                                        <td align="right">
                                            <div style="margin-right: 10% ;"><?php // $this->Number->format($factureclient->totaltva) 
                                                                                ?>
                                                <?php // $this->Number->format($rrr->total)
                                                echo number_format(abs($factureclient['totaltva']), 3, ',', ' '); ?></div>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td>
                                            <div style="margin-left: 6%;">Timbre:</div>
                                        </td>
                                        <td align="right">
                                            <div style="margin-right: 10% ;"><?php echo sprintf("%01.3f", $timbre) ?></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div style="margin-left: 6%;"><strong>TTC :</strong></div>
                                        </td>
                                        <td align="right">
                                            <div style="margin-right: 10% ;"><strong><?php // $this->Number->format($factureclient->totalttc) 
                                                                                        ?>
                                                    <?php // $this->Number->format($rrr->total)
                                                    echo number_format(abs($factureclient['totalttc']), 3, ',', ' '); ?>
                                                </strong></div>
                                        </td>
                                    </tr>
                                </tbody>


                            </table>
                            <?php
                            $baseht  = $factureclient['totalht'] + $factureclient['totalfodec'] + $factureclient['tpe'];
                            ?>




                        </div>


                    </div>
                </div>
            </div>
        </div>
     
        <div style="display:flex"  style="margin-top: 25%;">
            <!-- <div style="width:3%;border:1px solid black;border-radius: 15px;height:110px;background-color:#b5d6d3;">

              </div> -->
            <div style="width: 60%;">
                <strong>Arrêté la Présente Facture à la Somme de :</strong><br>
                <?php echo int2str($factureclient['totalttc'], 1, 1) ?>
            </div>
            <!-- <div style="width: 40%;border:1px solid black;border-radius: 15px;margin-left:10%;height:30px;background-color:#b5d6d3;">
            <br>
            <b style="margin-left:10% ;">NET A PAYER:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $this->Number->format($factureclient->totalttc) ?></b>
        </div> -->
        </div>
       
        <table>
            <tr>
                <td>
                    <p>
                        <Strong>Commentaire : </Strong><?php echo $factureclient['observation'] ?>

                    </p>
                </td>
            </tr>
        </table>

        </div>
        </div>

      

<?php
    }
}
?>