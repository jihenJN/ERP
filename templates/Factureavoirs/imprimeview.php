<?php $this->layout = 'AdminLTE.print';

use Cake\Datasource\ConnectionManager;
?>
<style>
    @media print {

        html,
        body {
            height: 100vh;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
        }

    }
</style>
<?php
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
<br>
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
<?php //include('imprimeentetesirepbeton.php') 
?>
<!-- <br><br><br><br> <br><br> -->
<div style="display: flex; justify-content: space-between; align-items: flex-start; border-top: 0px solid black; border-bottom: 0px solid black; padding: 0px 0;">

    <table border="0" cellpadding="0" cellspacing="0" style="border: 0px solid black; width: 100%; ">

        <td align="center" style="width: 25%;border:0;">
            <div>
                <?php
                //echo $this->Html->image('logokids.png', ['alt' => 'CakePHP', 'height' => '80px', 'width' => '50%']); 
                ?>
            </div>
        </td>


        <td align="center" style="width: 50%;border:0;"><strong>
                <!-- La Société HAPPY KIDS CONFECTIONERY <br>
                CHOCOLATE BISCUITERIE & CONFISERIE<br>
                SUARL au capital de 30000 DT<br>
                ZI SOUASSI 5140<br>
                MF :</strong> 1779732/M/A/M/000
            <strong> RC : </strong> C 16221482022 &nbsp;&nbsp;&nbsp; -->

        </td>
        <td align="center" style="width: 25%;border:0;">
            <div>
                <?php
                // echo $this->Html->image('LOGOISO2023.JPG', ['alt' => 'CakePHP', 'height' => '80px', 'width' => '70%']); 
                ?>
            </div>
        </td>


    </table>
</div><br>
<!-- <h5 align="center"> www.toutenrouleau.tn</h5> -->
<div align="left">
    <h3><span style="margin-left:7%;">DATE : </span><?= $this->Time->format($facture->date, 'dd/MM/y'); ?></h3>
</div>
<!-- <h3 align="left" style="margin-left:4% ;"> Facture Avoir N° <?php echo $facture->numero ?></h3> -->
<div style="display:flex;margin-bottom:3px;margin-left:25px;" align="center">
    <div style="display:flex ;width:90%;margin-right:2%;" align="right">
        <div style="width: 90%;border:1px solid black;border-radius: 15px;" align="left">
            <br>
            <!-- <b style="margin-left:7% ;"> Date Facture: </b><?= $this->Time->format(
                                                                    $facture->date,
                                                                    'dd/MM/y'
                                                                ); ?> <br> -->
            <h2 style="font: size 45px;margin-top:45px;" align="center"> Facture Avoir N° <?php echo $facture->numero ?></h3>


                <?php

                $paiement_id = $facture->client->paiement_id;
                if (!empty($paiement_id)) {

                    $connection = ConnectionManager::get('default');
                    $paiementname = $connection->execute("SELECT name FROM paiements WHERE id = " . $paiement_id . ";")->fetchAll('assoc');
                }
                ?>
                <?php

                $client_id = $facture->client_id;
                if (!empty($client_id)) {

                    $connection = ConnectionManager::get('default');
                    $adres = $connection->execute("SELECT adresse FROM adresselivraisonclients WHERE client_id = " . $client_id . ";")->fetchAll('assoc');
                }

                ?>




                <br>
        </div>
    </div>

    <div style="display:flex;width: 90%;">
        <div style="width: 90%;border:1px solid black;border-radius: 15px;" align="left">
            <br>
            <?php if ($facture->client_id == 12) { ?>
                <b style="margin-left:7% ;"> Nom: </b><?php
                                                        if (isset($facture->numeroidentite)) {
                                                            echo h($facture->nomprenom);
                                                        } ?> <br>
                <b style="margin-left:7% ;"> Identifiant:</b><?php
                                                                if (isset($facture->numeroidentite)) {
                                                                    echo h($facture->numeroidentite);
                                                                } ?> <br>
                <b style="margin-left:7% ;"> Adresse : </b> <?php
                                                            if (isset($facture->adressediv)) {
                                                                echo  h($facture->adressediv);
                                                            } ?><br>
            <?php } else { ?>

                <b style="margin-left:7% ;"> Code Client : </b><?= h($facture->client->Code) ?> <br>

                <b style="margin-left:7% ;"> Nom Client : </b> <?php
                                                                if (isset($facture->client)) {
                                                                    echo  h($facture->client->Raison_Sociale);
                                                                } ?><br>
                <!-- <b style="margin-left:7% ;"> Adresse : </b>

            <?php
                foreach ($adres as $adresss) {
                    echo $adresss['adresse'] . '&nbsp;' . '&nbsp;';
                }
            ?> -->
                <?php
                $adresse = h($facture->client->Adresse);
                $words = explode(' ', $adresse);

                // If the address has more than 6 words, insert a line break after the 6th word
                if (count($words) > 6) {
                    $firstLine = implode(' ', array_slice($words, 0, 6));
                    $remaining = implode(' ', array_slice($words, 6));
                } else {
                    $firstLine = $adresse;
                    $remaining = '';
                }
                ?>

                <p style="margin-left: 7%;">
                    <strong>Adresse:</strong> <span><?= $firstLine ?></span>
                    <?php if ($remaining) : ?>
                        <br>
                        <span style="margin-left: 18.2%;"><?= $remaining ?></span>
                    <?php endif; ?>
                </p>
                <br>

                <b style="margin-left:7%;"> Tel : </b><?= h($facture->client->Tel) ?><br>
                <!-- <b style="margin-left:7%;"> Fax : </b><?= h($facture->client->Fax) ?><br> -->
                <b style="margin-left:7%;"> Email : </b><?= h($facture->client->Email) ?><br>

                <b style="margin-left:7% ;"> Matricule Fiscal : </b><?= h($facture->client->Matricule_Fiscale) ?>
            <?php } ?>
        </div>
    </div>
</div>



<div style="margin-left:25px;">
    <div class="panel-body">
        <div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="text-align: left; font: size 18px;margin-left:1%;">
                    <!-- <strong> Chauffeur:</strong> <?php if (isset($bonlivraison->chauffeur)) {
                                                            echo h($bonlivraison->chauffeur->name);
                                                        } ?> -->
                </div>
                <div style="text-align: center;font: size 18px;">
                    <!-- <strong> Véhicule:</strong> <?php if (isset($bonlivraison->vehicule)) {
                                                            echo h($bonlivraison->vehicule->matricule);
                                                        } ?> -->
                </div>
                <div style="text-align: right;font: size 18px;margin-right:7%;">
                    <strong> Lignes: </strong><?php
                                                $lignebonlivraisonsArray = $lignefactures->toArray();
                                                echo $nombreLignes = count($lignebonlivraisonsArray); ?>
                </div>
            </div>
            <table style="border:1px solid black;width: 95%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;">
                <thead>
                    <tr>
                        <td align="center" style="width: 3%;border:1px solid black;background-color:#b5d6d3;"><strong>Code Article </strong></td>

                        <td align="center" style="width: 22%;border:1px solid black;background-color:#b5d6d3;"><strong>Désignation</strong></td>
                        <!-- <td align="center" style="width: 5%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité </strong></td> -->

                        <!-- <td align="center" style="width: 5%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté</strong></td> -->
                        <td align="center" style="width: 5%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté Av</strong></td>
                        <td align="center" style="width: 12%;border:1px solid black;background-color:#b5d6d3;"><strong>TVA</strong></td>

                        <!-- <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité</strong></td> -->
                        <!-- <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Fod</strong></td> -->
                        <td align="center" style="width: 9%;border:1px solid black;background-color:#b5d6d3;"><strong>Prix U.HT</strong></td>


                        <?php if ($facture->totalrem != 0) { ?>
                            <td align="center" style="width: 3%;border:1px solid black;background-color:#b5d6d3;"><strong>Remise</strong></td>
                        <?php } ?>
                        <td align="center" style="width: 12%;border:1px solid black;background-color:#b5d6d3;"><strong> Total HT</strong></td>

                        <!-- <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Remise</strong></td>
                        <td align="center" style="width: 7%;border:1px solid black;background-color:#b5d6d3;"><strong>TVA </strong></td>
                        <td align="center" style="width: 15%;border:1px solid black;background-color:#b5d6d3;"><strong> Mont TTC </strong></td> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $totpuhtfodec = 0;
                    $nombreLignes = 0;
                    $sum = 0;
                    // debug($lignecommandes->toarray());
                    ?>

                    <?php foreach ($lignefactures as $lignecommande) :
                        $nombreLignes = $nombreLignes + 1;
                        $tvaa = $lignecommande->tva;
                        //  debug($tvaa);
                        $qte = $lignecommande->qterlx;
                        $qtekg = $lignecommande->quantite;
                        $prix = (float) $lignecommande->prix;
                        $montant = $qtekg * $prix;
                        $fodec = $lignecommande->fodec;
                        $remise = $lignecommande->remise;
                        $tva = $lignecommande->tva_id;
                        $montant_exclude_remise = $montant + $montant * $remise / 100;
                        $sum += $lignecommande->remise;
                        // debug($sum);
                        if ($fodec != 0) {
                            $totphtfodec = $totphtfodec + $montant_exclude_remise;
                        }
                        $connection = ConnectionManager::get('default');
                        $query = $connection->newQuery();
                        $query->select([
                            'tva',
                            'SUM(CASE WHEN tva_id = 12 THEN montantht ELSE 0 END) AS tva_12_total',
                            'SUM(CASE WHEN tva_id = 7 THEN montantht ELSE 0 END) AS tva_7_total',
                            'SUM(CASE WHEN tva_id = 19 THEN montantht ELSE 0 END) AS tva_19_total',
                            'SUM(CASE WHEN tva_id = 22.5 THEN montantht ELSE 0 END) AS tva_22_5_total',
                            'SUM(CASE WHEN tva_id = 0 THEN montantht ELSE 0 END) AS tva_0_total'
                        ])
                            ->from('lignefactureavoirs')
                            ->where(['factureavoir_id' => $lignecommande->id])
                            ->group(['tva_id']);
                        $results = $query->execute()->fetchAll('assoc');
                        //debug($query);
                    ?>

                        <?php if ($lignecommande->quantite != 0 || $lignecommande->qterlx != 0) { ?>
                            <tr class="tr" height="25px">
                                <td align="left" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;">
                                    <div style="margin-left: 3%;"> <?php
                                                                    if (isset($lignecommande->article)) {
                                                                        echo  h($lignecommande->article->Code);
                                                                    }
                                                                    ?></div>
                                </td>
                                <td align="left" style="border:1px solid black;  border-top: none; border-bottom: none; vertical-align:top;">

                                    <div style="margin-left: 3%;"><?php
                                                                    if (isset($lignecommande->article)) {
                                                                        echo  h($lignecommande->article->Dsignation);
                                                                    }
                                                                    ?></div>
                                </td>
                                <!-- <td align="center" style="border:1px solid black;  border-top: none; border-bottom: none; vertical-align:top;">
                                <?php $unite_id = $lignecommande->article->unitearticle_id; ?>

                                <?php
                                $connection = ConnectionManager::get('default');
                                // $unitename = $connection->execute("SELECT name FROM unitearticles WHERE id = " . $unite_id . ";")->fetchAll('assoc');
                                // echo ($unitename[0]['name']);
                                ?>
                            </td> -->



                                <td align="center" style="border:1px solid black;  border-top: none; border-bottom: none; vertical-align:top;">
                                    <?php // $this->Number->format($lignecommande->qtekg)
                                    echo number_format(abs($lignecommande->quantite), 3, ',', ' ');  ?>
                                </td>
                                <td hidden align="center" style="border:1px solid black;  border-top: none; border-bottom: none; vertical-align:top;">
                                    <?php //$this->Number->format($lignecommande->qte) 
                                    echo number_format(abs($lignecommande->qterlx), 3, ',', ' ');  ?>
                                </td>
                                <!-- <td align="center" style="border:1px solid black;  border-top: none; border-bottom: none; vertical-align:top;">
                                <?= $this->Number->format($lignecommande->fodec) ?>
                            </td> -->
                                <td align="left" style="border:1px solid black;  border-top: none; border-bottom: none; vertical-align:top;text-align:left">
                                    <div style="margin-left: 25% ;"> <?php // $this->Number->format($lignecommande->prix) 
                                                                        echo number_format(abs($lignecommande->prix), 3, ',', ' ');  ?>
                                    </div>
                                </td>


                                <!--<td hidden align="center" style="border:1px solid black;  border-top: none; border-bottom: none; vertical-align:top;">
                                <?= $this->Number->format($lignecommande->remiseclient) ?> %
                            </td>
                            <td align="center" style="border:1px solid black;  border-top: none; border-bottom: none;  vertical-align:top;">
                                <?= $this->Number->format($lignecommande->tva_id) ?>
                            </td> -->
                                <td align="center" style="border:1px solid black;  border-top: none; border-bottom: none; vertical-align:top;text-align:right">
                                    <div style="margin-right: 25%;"> <?php //$this->Number->format($lignecommande->ttc) 
                                                                        echo number_format(abs($lignecommande->totalttc), 3, ',', ' ');  ?> </div>
                                </td>
                                <?php if ($facture->totalrem != 0) { ?>
                                    <td align="center" style="border:1px solid black;  border-top: none; border-bottom: none;  vertical-align:top;">
                                        <!-- <?= $this->Number->format($lignecommande->remise) ?> % -->
                                        <?php if ($lignecommande->remise != 0) { ?>
                                            <div style="margin-right: 25%;"> <?= $this->Number->format($lignecommande->remise) ?> </div>
                                        <?php } ?>
                                    </td>
                                <?php } ?>

                                <td align="center" style="border:1px solid black;  border-top: none; border-bottom: none; vertical-align:top;text-align:right">
                                    <div style="margin-right: 25%;"> <?php //$this->Number->format($lignecommande->montantht)
                                                                        echo number_format(abs($lignecommande->totalht), 3, ',', ' ');
                                                                        ?> </div>
                                </td>

                            </tr>
                        <?php } ?>
                    <?php
                        $nombreLignes += 25;
                    endforeach; ?>
                    <?php
                    //  $rowHeight = 30;
                    // $calcul = (450 - $nombreLignes * $rowHeight) / $nombreLignes;
                    $rowHeight = 500;
                    $calcul = $rowHeight - $nombreLignes;
                    ?>
                    <tr style="height:<?php echo $calcul ?>px;">
                        <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                        <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                        <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                        <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                        <?php if ($facture->totalrem != 0) { ?>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                        <?php } ?>
                        <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                        <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                        <!--<td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                        <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                        <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                     -->

                    </tr>
                </tbody>
            </table>
            <br>

            <?php
            // debug($commande);
            ?>
            <div style="display:flex" align="center">

                <div style="width: 60%; margin-right: 20px; display: flex; align-items: center;">
                    <div style="width: 40%; text-align: center; margin-top: 10px;">

                        <div>
                            Direction
                        </div>
                    </div>
                    <div style="margin-left: 50px; margin-top: 10px; width: 20%;">
                        <div> Client</div>
                    </div>

                </div>

                <div style="width: 40%;margin-right: 38px;" align="left" align="left">
                    <br><br>
                    <table style="width: 100%;border-collapse: collapse;border-radius: 15px;">
                        <tbody>
                            <?php
                            $connection = ConnectionManager::get('default');
                            $sql = $connection->execute("SELECT SUM(quantite * prix) AS total FROM lignefactureavoirs WHERE factureavoir_id = " . $facture->id)->fetchAll('assoc');

                            if (!empty($sql)) {
                                // echo $sql[0]['total'];
                            } else {
                                // echo "Aucun résultat trouvé.";
                            }
                            ?>
                            <tr>

                                <td style="border:1px solid black;">
                                    <div style="margin-left: 6%;"><strong>Total HT </strong></div>
                                </td>
                                <td align="right" style="border:1px solid black;">

                                    <div style="margin-right: 10% ;"><?php // $this->Number->format($commande->brut) 
                                                                        echo number_format(abs($sql[0]['total']), 3, ',', ' ');  ?> </div>
                                </td>
                            </tr>
                            <?php  // debug($facture->toarray());
                            if ($facture->totalrem != 0) { ?>
                                <tr>
                                    <td style="border:1px solid black;">
                                        <div style="margin-left: 6%;"><strong> Remise </strong></div>
                                    </td>
                                    <td style="border:1px solid black;" align="right">
                                        <div style="margin-right: 10% ;"><?php
                                                                            // $this->Number->format($commande->remise) commande->brut
                                                                            echo number_format(abs($facture->totalrem), 3, ',', ' ');  ?></div>
                                    </td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td style="border:1px solid black;">
                                    <div style="margin-left: 6%;"><strong> NET HT</strong></div>
                                </td>
                                <td style="border:1px solid black;" align="right">
                                    <div style="margin-right: 10% ;"><?php //$this->Number->format($commande->total)
                                                                        echo number_format(abs($facture->totalht), 3, ',', ' '); ?></div>
                                </td>
                            </tr>

                            <tr>
                                <td style="border:1px solid black;">
                                    <div style="margin-left: 6%;"><strong>T,FODEC</strong></div>
                                </td>
                                <td style="border:1px solid black;" align="right">
                                    <div style="margin-right: 10% ;"><?php //$totphtfodec = $totphtfodec * 1 / 100;
                                                                        //echo $totphtfodec  
                                                                        ?>
                                        <?php // echo $this->Number->format($facture->fodec) ;
                                        echo number_format(abs($facture->fodec), 3, ',', ' '); ?> </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid black;">
                                    <div style="margin-left: 6%;"><strong>T,TVA</strong></div>
                                </td>
                                <td style="border:1px solid black;" align="right">
                                    <div style="margin-right: 10% ;"><?php //$this->Number->format($commande->tva)  
                                                                        echo number_format(abs($facture->tva), 3, ',', ' '); ?> </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="border:1px solid black;">
                                    <div style="margin-left: 6%;"><strong> NET A PAYER </strong></div>
                                </td>
                                <td style="border:1px solid black;" align="right">
                                    <div style="margin-right: 10% ;"><?php // $this->Number->format($commande->totalttc) 
                                                                        echo number_format(abs($facture->totalttc), 3, ',', ' '); ?></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- <br> <br>
    <div style="display:flex">
        <div style="width: 40%;">
            <strong>Arrêté la Présente Commande à la Somme de :</strong><br>
            <?php echo int2str($commande->totalttc + 1, 1, 1) ?>
        </div>
        <div style=" margin-left:50px ;width: 20%;">
            Signature Client       
        </div>
        <div style="width: 20%;">    
            La societe SIREP BETON
            <div align="center">
                Cachet et signature
            </div>
        </div>
    </div> -->


</div>
<!-- <p> - Nos prix seront révisible a toute augmentation des matiére premiére (ciment, Gravier, Sable, et énergie) </p> -->
</div> <br> <br> <br> <br> <br> <br> <br> <br>
<!-- <div class="box">
    <p align="centrer"> SARL. au capital de 1.284.000 Dinars - Usine : Route de Gabés GP1 - PK 396 Ghannouche </p>
</div> -->