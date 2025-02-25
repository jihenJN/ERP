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
        font-size: 12px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
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
               // echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); ?>

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
        <?php if ($bonlivraison->typebl == 1) { ?>
            <b> BON DE Livraison N°: </b><?php echo ($bonlivraison->numero) ?>
        <?php } ?>
        <?php if ($bonlivraison->typebl == 2) { ?>
            <b> Facture Proforma </b><?php echo ($bonlivraison->numero) ?>
        <?php } ?>
        <?php if ($bonlivraison->typebl == 4) { ?>
            <b> Intégration N°: </b><?php echo ($bonlivraison->numero) ?>
        <?php } ?>
    </h3>
</div>

<div style="display:flex;margin-bottom:3px;" align="center">
    <div style="display:flex;width: 1000%;">
        <div style="width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;" align="left">
            <br>
            <b style="margin-left:7% ;"> Code: </b><?= h($bonlivraison->client->Code) ?> <br>
            <b style="margin-left:7% ;"> Matricule fiscale :</b><?= h($bonlivraison->client->Matricule_Fiscale) ?> <br>
            <b style="margin-left:7% ;"> Client : </b> <?php
                                                        if (isset($bonlivraison->client)) {
                                                            echo  h($bonlivraison->client->Raison_Sociale);
                                                        } ?><br>
           <b style="margin-left:7% ;"> Adresse :</b>
            <!-- <p style="margin-left:7% ;margin-top: 1px;"> -->
                <?= h($bonlivraison->client->Adresse) ?>
            <!-- </p> -->
            <br>
            <b style="margin-left:7% ;"> Tel : </b><?php
                                                        if (isset($bonlivraison->client)) {
                                                            echo  h($bonlivraison->client->Tel);
                                                        } ?>
        </div>
    </div>

    <div style="display:flex ;width:1000%;margin-left:10%;">
        <div style="width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;" align="left">
            <br>
            <?php if ($bonlivraison->typebl == 1) { ?>

                <?php

                $cmd = $connection->execute('SELECT * FROM commandes where commandes.bonlivraison_id=' . $bonlivraison->id . ';')->fetchAll('assoc');
                $offre = [];
                if ($cmd[0]['id'] != null) {
                    $offre = $connection->execute('SELECT * FROM bonlivraisons where bonlivraisons.typebl=2 and bonlivraisons.commande_id=' . $cmd[0]['id'] . ';')->fetchAll('assoc');
                }
                $integ = [];
                if ($offre[0]['id'] != null) {
                    $integ = $connection->execute('SELECT * FROM bonlivraisons where bonlivraisons.typebl=4 and bonlivraisons.id_offredeprix=' . $offre[0]['id'] . ';')->fetchAll('assoc');
                }

                ?>
                <b style="margin-left:7% ;"> Intégration N° : </b><?php echo ($integ[0]['numero']) ?>
                <br>
                <b style="margin-left:7% ;"> Offre de prix N° : </b><?php echo ($offre[0]['numero']) ?>
                <br>

                <b style="margin-left:7% ;"> BON DE COMMANDES N° : </b><?php echo ($cmd[0]['numero']) ?>
                <!-- <br> -->
                <!-- <b style="margin-left:7% ;"> BON DE Livraison N° : </b><?= h($bonlivraison->numero) ?> -->
            <?php } ?>
            <?php if ($bonlivraison->typebl == 2) {
                $integ = $connection->execute('SELECT * FROM bonlivraisons where bonlivraisons.typebl=4 and bonlivraisons.id_offredeprix=' . $bonlivraison->id . ';')->fetchAll('assoc');

            ?>
                <b style="margin-left:7% ;"> Facture Proforma N° : </b><?php echo ($bonlivraison->numero) ?>
                <!-- <br> -->

                <!-- <b style="margin-left:7% ;"> Offre de prix N° : </b><?= h($bonlivraison->numero) ?> -->
            <?php } ?>
            <?php if ($bonlivraison->typebl == 4) { ?>
                <!-- <b style="margin-left:7% ;"> Intégration N° : </b><?= h($bonlivraison->numero) ?> -->
            <?php } ?>
            <br>
            <b style="margin-left:7% ;"> Date : </b><?= $this->Time->format(
                                                        $bonlivraison->date,
                                                        'dd/MM/y'
                                                    ); ?> <br>
        </div>
    </div>
</div>
<br>
<div>
    <div class="panel-body">
        <div>
            <table style="border:1px solid black;width: 100%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;" height="450px">
                <thead>
                    <tr>
                        <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>CODE</strong></td>
                        <td align="center" style="width: 40%;border:1px solid black;background-color:#b5d6d3;"><strong>DESIGNATION</strong></td>
                        <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité</strong></td>
                        <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté</strong></td>
                        <!-- <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>ml</strong></td> -->
                        <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>P.U.H.T</strong></td>
                        <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>Remise</strong></td>

                        <td align="center" style="width: 13%;border:1px solid black;background-color:#b5d6d3;"><strong>Montant HT </strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lignebonlivraisons as $lignecommande) :
                         //  debug( $lignecommande);
                        $qte = $lignecommande->qte;
                        $prix = $lignecommande->punht;
                        $ml = $lignecommande->ml;
                        $montant = $qte * $prix * $ml;
                    ?>
                        <tr class="tr">
                            <td align="center" style="border:1px solid black;vertical-align:top;height:2% !important;">
                                <?= ($lignecommande->article->Code) ?>
                            </td>
                            <td align="left" style="border:1px solid black;vertical-align:top;">
                                <div style="margin-left: 3%;"><?php
                                                                if (isset($lignecommande->article)) {
                                                                    echo  h($lignecommande->article->Dsignation);
                                                                }
                                                                ?></div>
                            </td>
                            <td align="center" style="border:1px solid black;vertical-align:top;">
                                <?php
                                $unite = [];
                                // print_r($lignecommande->article);
                                if (isset($lignecommande->article->unite_id) && ($lignecommande->article->unite_id != 0)) {
                                    $unite = $connection->execute('SELECT * FROM unites where unites.id=' . $lignecommande->article->unite_id . ';')->fetchAll('assoc');

                                    echo ($unite[0]['name']);
                                } else echo ''; ?>
                            </td>
                            <td align="center" style="border:1px solid black;vertical-align:top;">
                                <?= $this->Number->format($lignecommande->qte) ?>
                            </td>

                            <!-- <td align="center" style="border:1px solid black;vertical-align:top;">
                                <?= $this->Number->format($lignecommande->ml * $lignecommande->qte) ?>
                            </td> -->
                            <td align="left" style="border:1px solid black;vertical-align:top;text-align:left">
                                <div style="margin-left: 25% ;"><?php
                                // $this->Number->format($lignecommande->punht) 
                                echo number_format(abs($lignecommande->punht), 3, ',', ' '); ?></div>
                            </td>


                            <td align="center" style="border:1px solid black;vertical-align:top;">
                                <?= $this->Number->format($lignecommande->remise) ?> %
                            </td>

                            <td align="center" style="border:1px solid black;vertical-align:top;text-align:right">
                                <div style="margin-right: 25%;"><?php // $this->Number->format($montant)  
                                 echo number_format(abs($montant), 3, ',', ' ');?></div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <!-- <td style="border:1px solid black;vertical-align:top;"></td> -->
                        <td style="border:1px solid black;vertical-align:top;"></td>
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
                            <?php $lignestable = TableRegistry::getTableLocator()->get('Lignebonlivraisons');

                            $query = $lignestable->find();
                            $query->select([
                                'tva' => 'Lignebonlivraisons.tva',
                                'base' => $query->func()->sum('(qte*ml*punht - (qte*ml*punht)* (remise / 100) + (qte*ml*punht - (qte*ml*punht)* (remise / 100)) * ifnull(fodec,0) / 100)'),
                                'total' => $query->func()->sum('((qte*ml*punht - (qte*ml*punht)* (remise / 100) + (qte*ml*punht - (qte*ml*punht)* (remise / 100)) * ifnull(fodec,0) / 100)) * tva / 100')
                            ])
                                ->where(['Lignebonlivraisons.bonlivraison_id' => $bonlivraison->id])
                                ->group('Lignebonlivraisons.tva');

                            // Execute the query
                            $results = $query->toArray();


                            $fodquery = $lignestable->find();
                            $fodquery->select([
                                'fodec' => 'Lignebonlivraisons.fodec',
                                'base' => $query->func()->sum('qte*ml*punht - (qte*ml*punht)* (remise / 100)'),
                                'total' => $query->func()->sum('(qte*ml*punht - (qte*ml*punht)* (remise / 100)) *ifnull(fodec,0) / 100')
                            ])
                                ->where(['Lignebonlivraisons.bonlivraison_id' => $bonlivraison->id])
                                ->group('Lignebonlivraisons.fodec');

                            // Execute the query
                            $fodresults = $fodquery->toArray();
                            // print_r($results);

                            foreach ($results as $rrr) {
                                if ($rrr->tva != 0) {
                            ?>

                                    <tr class="tr">

                                        <td align="center" height="20px" style="border:1px solid black;">

                                        </td>

                                        <td align="center" style="border:1px solid black;">
                                            <?= $this->Number->format($rrr->tva)
                                             //echo number_format(abs($rrr->tva), 3, ',', ' ');?>

                                        </td>
                                        <td align="center" style="border:1px solid black;">
                                            <?php  // $this->Number->format($rrr->base)
                                             echo number_format(abs($rrr->base), 3, ',', ' '); ?>


                                        </td>
                                        <td align="center" style="border:1px solid black;width: 20%;">
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

                                        <!-- <td align="center" style="border:1px solid black;">
                                            <?= $this->Number->format($frrr->fodec) ?>

                                        </td> -->
                                        <td align="center" style="border:1px solid black;">
                                            <?php // $this->Number->format($frrr->base) 
                                             echo number_format(abs($frrr->base), 3, ',', ' ');?>


                                        </td>
                                        <td align="center" style="border:1px solid black;width: 20%;">
                                            <?php //$this->Number->format($frrr->total)
                                              echo number_format(abs($frrr->total), 3, ',', ' ');
                                             ?>
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
                                    <div style="margin-right: 10% ;"><?php // $this->Number->format($bonlivraison->totalht) 
                                      echo number_format(abs($bonlivraison->totalht), 3, ',', ' ');?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="margin-left: 6%;">Remise :</div>
                                </td>
                                <td align="right">
                                    <div style="margin-right: 10% ;"><?php // $this->Number->format($bonlivraison->totalremise) 
                                      echo number_format(abs($bonlivraison->totalremise), 3, ',', ' ');?></div>
                                </td>
                            </tr>
                           
                            <!-- <tr>
                                <td>
                                    <div style="margin-left: 6%;">Fodec :</div>
                                </td>
                                <td align="right">
                                    <div style="margin-right: 10% ;"><?= $this->Number->format($bonlivraison->totalfodec) ?></div>
                                </td>
                            </tr> -->

                            <tr>
                                <td>
                                    <div style="margin-left: 6%;">TVA :</div>
                                </td>
                                <td align="right">
                                    <div style="margin-right: 10% ;"><?php // $this->Number->format($bonlivraison->totaltva) 
                                     echo number_format(abs($bonlivraison->totaltva), 3, ',', ' ');?></div>
                                </td>
                            </tr>

                         

                            <tr>
                                <td>
                                    <div style="margin-left: 6%;"><strong>TTC :</strong></div>
                                </td>
                                <td align="right">
                                    <div style="margin-right: 10% ;"><strong><?php // $this->Number->format($bonlivraison->totalttc) 
                                        echo number_format(abs($bonlivraison->totalttc), 3, ',', ' ');?></strong></div>
                                </td>
                            </tr>
                        </tbody>


                    </table>
                    <!-- <?php
                            $baseht  = $bonlivraison->total + $bonlivraison->fodec + $bonlivraison->tpe;
                            ?>




                </div>
                
                <!-- <div style="width: 40%;border:1px solid black;" align="left">
                    <?php
                    $baseht  = $bonlivraison->totalht + $bonlivraison->totalfodec + $bonlivraison->tpe;
                    ?>
                    <br>
                    <b style="margin-left:7% ;"> Total Hors Taxes: </b><?= $this->Number->format($bonlivraison->totalht) ?> <br>
                    <b style="margin-left:7% ;"> Base Hors Taxes: </b><?= $this->Number->format($baseht) ?> <br>
                    <b style="margin-left:7% ;"> TTC : </b><?= $this->Number->format($bonlivraison->totalttc) ?> <br>
                    <b style="margin-left:7% ;"> Total Remise: </b><?= $this->Number->format($bonlivraison->totalremise) ?> <br>
                    <b style="margin-left:7% ;"> Total Fodec: </b><?= $this->Number->format($bonlivraison->totalfodec) ?> <br>
                    <b style="margin-left:7% ;"> Total TVA:</b><?= $this->Number->format($bonlivraison->totaltva) ?> <br>
                    <b style="margin-left:7% ;"> Total TPE:</b><?= $this->Number->format($bonlivraison->tpe) ?> <br>
                    <b style="margin-left:7% ;"> Escompte:</b><?= $this->Number->format($bonlivraison->escompte) ?> <br>

                </div> -->
                </div>
            </div>
        </div>
        <br>
        <div style="display:flex">

            <div style="width: 40%;">
                <strong>Arrêté la Présente 
        <?php if ($bonlivraison->typebl == 1) { ?>
            <b> BON DE Livraison N°: </b><?php echo ($bonlivraison->numero) ?>
        <?php } ?>
        <?php if ($bonlivraison->typebl == 2) { ?>
            <b> Devis </b><?php echo ($bonlivraison->numero) ?>
        <?php } ?>
        <?php if ($bonlivraison->typebl == 4) { ?>
            <b> Intégration N°: </b><?php echo ($bonlivraison->numero) ?>
        <?php } ?> à la Somme de :</strong><br>
                <?php echo int2str($bonlivraison->totalttc, 1, 1) ?>
            </div>
            <!-- <div style="width: 40%;border:1px solid black;border-radius: 15px;margin-left:10%;height:30px;background-color:#b5d6d3;">
                <br>
                <b style="margin-left:10% ;">NET A PAYER:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $this->Number->format($bonlivraison->totalttc) ?></b>
            </div> -->
        </div>
        <!--    <br>
    <div style="width: 100%;border:0px solid black;border-radius: 15px;height:40px;">
        <br>

    </div>-->
    </div>
</div>
<br>

<table>
    <tr>
        <td>
            <p>
                <Strong>Commentaire : </Strong><?php echo $bonlivraison->observation ?>

            </p>
        </td>
    </tr>
</table>