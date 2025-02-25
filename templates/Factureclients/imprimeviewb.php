<?php $this->layout = 'AdminLTE.print'; ?>
<?php
error_reporting(E_ERROR | E_PARSE);

use Cake\Datasource\ConnectionManager;

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
<!-- <div class="box-body" hidden>
    <?php //include('imprimeentetesirepbeton.php'); 
    ?>   
</div> -->

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
<h3 align="left" style="margin-left:4% ;"> Facture N° <?php echo $factureclient->numero ?></h3>
<div style="display:flex;margin-bottom:3px;margin-left:25px;" align="center">
    <div style="display:flex ;width:90%;margin-right:2%;" align="right">
        <div style="width: 90%;border:1px solid black;border-radius: 15px;" align="left">
            <br>
            <b style="margin-left:7% ;"> Date Facture: </b><?= $this->Time->format(
                                                                $factureclient->date,
                                                                'dd/MM/y'
                                                            ); ?> <br>

            <?php

            $paiement_id = $factureclient->client->paiement_id;
            if (!empty($paiement_id)) {

                $connection = ConnectionManager::get('default');
                $paiementname = $connection->execute("SELECT name FROM paiements WHERE id = " . $paiement_id . ";")->fetchAll('assoc');
            }
            ?>
            <?php

            $client_id = $factureclient->client_id;
            if (!empty($client_id)) {

                $connection = ConnectionManager::get('default');
                $adres = $connection->execute("SELECT adresse FROM adresselivraisonclients WHERE client_id = " . $client_id . ";")->fetchAll('assoc');
            }

            ///
            $factureclient_id = $factureclient->id;
            if (!empty($factureclient_id)) {

                $connection = ConnectionManager::get('default');
                $bl = $connection->execute("SELECT factureclient_id FROM bonlivraisons WHERE factureclient_id = " . $factureclient_id . ";")->fetchAll('assoc');
                //debug($bl);
            }
            ?>
            <!-- <b style="margin-left:7% ;"> Mode de Paiement : </b><?= h($paiementname[0]['name']) ?>  -->
            <!-- <?php if (!empty($bl)) {
                        $blInfo = $bl[0]; ?>
                
                <b style="margin-left:7% ;"> N° BL : </b> <?php echo $factureclient->numerobl ?><br>
                <b style="margin-left:7% ;"> Date BL : </b> <?= $this->Time->format(
                                                                $factureclient->datebl,
                                                                'dd/MM/y'
                                                            ); ?>
            <?php } ?> -->




            <br>
        </div>
    </div>

    <div style="display:flex;width: 90%;">
        <div style="width: 90%;border:1px solid black;border-radius: 15px;" align="left">
            <br>
            <b style="margin-left:7% ;"> Code Client : </b><?= h($factureclient->client->Code) ?> <br>

            <b style="margin-left:7% ;"> Nom Client : </b> <?php
                                                            if (isset($factureclient->client)) {
                                                                echo  h($factureclient->client->Raison_Sociale);
                                                            } ?><br>
            <b style="margin-left:7% ;"> Adresse : </b>

            <!-- <?= h($factureclient->client->adresse1) ?> -->
            <?php
            foreach ($adres as $adresss) {
                echo $adresss['adresse'] . '&nbsp;' . '&nbsp;';
            }
            ?>
            <br>

            <b style="margin-left:7%;"> Tel : </b><?= h($factureclient->client->Tel) ?><br>
            <!-- <b style="margin-left:7%;"> Fax : </b><?= h($factureclient->client->Fax) ?><br> -->
            <b style="margin-left:7%;"> Email : </b><?= h($factureclient->client->Email) ?><br>

            <b style="margin-left:7% ;"> Matricule Fiscal : </b><?= h($factureclient->client->Matricule_Fiscale) ?>

        </div>
    </div>
</div>
<style>
    .saut-page {
        page-break-before: always; /* Force un saut de page avant l'élément */
        /* ou */
        /* page-break-after: always; // Force un saut de page après l'élément */
    }
</style>
<div style="margin-left:25px;">

    <div class="panel-body">
        <div>
            <?php
            $factureclient_id = $factureclient->id;

            $connection = ConnectionManager::get('default');
            $statement = $connection->prepare("SELECT factureclient_id FROM bonlivraisons WHERE factureclient_id = :factureclient_id");
            $statement->bindValue('factureclient_id', $factureclient_id);
            $statement->execute();
            $test = $statement->fetchAll('assoc');
            // debug($test[0]['factureclient_id']);
            if (empty($test) || $test[0]['factureclient_id'] == 0) {

            ?>
                <table style="border:1px solid black;width: 95%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;">
                    <thead>
                        <tr>
                            <td align="center" style="width: 3%;border:1px solid black;background-color:#b5d6d3;"><strong>CODE </strong></td>

                            <td align="center" style="width: 22%;border:1px solid black;background-color:#b5d6d3;"><strong>Désignation</strong></td>
                            <!-- <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité</strong></td> -->

                            <td align="center" style="width: 5%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté</strong></td>
                            <!-- <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité</strong></td> -->
                            <!-- <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Fod</strong></td> -->
                            <td align="center" style="width: 9%;border:1px solid black;background-color:#b5d6d3;"><strong>P.U.H.T</strong></td>


                            <td align="center" style="width: 13%;border:1px solid black;background-color:#b5d6d3;"><strong>Montant HT</strong></td>
                            <?php if ($factureclient->totalremise != 0) { ?>
                                <td align="center" style="width: 3%;border:1px solid black;background-color:#b5d6d3;"><strong>Remise </strong></td>
                            <?php } ?>
                            <td align="center" style="width: 13%;border:1px solid black;background-color:#b5d6d3;"><strong> Net HT</strong></td>
                            <!-- <td align="center" style="width: 7%;border:1px solid black;background-color:#b5d6d3;"><strong>TVA </strong></td> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totpuhtfodec = 0;
                        $nombreLignes = 0;
                        ?>
                        <?php //debug($lignefactureclient->toarray());
                        foreach ($lignefactureclient as $lignecommande) :
                            // debug($lignecommande);


                            $nombreLignes = $nombreLignes + 1;
                            $qte = $lignecommande->qte;
                            $prix = (float) $lignecommande->punht;
                            $montant = $qte * $prix;
                            $fodec = $lignecommande->fodec;
                            $remise = $lignecommande->remise;
                            $tva = $lignecommande->tva;
                            $montant_exclude_remise = $montant + $montant * $remise / 100;

                            if ($fodec != 0) {
                                $totphtfodec = $totphtfodec + $montant_exclude_remise;
                            }
                            $connection = ConnectionManager::get('default');
                            $query = $connection->newQuery();
                            $query->select([
                                'tva',
                                'SUM(CASE WHEN tva = 12 THEN montantht ELSE 0 END) AS tva_12_total',
                                'SUM(CASE WHEN tva = 7 THEN montantht ELSE 0 END) AS tva_7_total',
                                'SUM(CASE WHEN tva = 19 THEN montantht ELSE 0 END) AS tva_19_total',
                                'SUM(CASE WHEN tva = 22.5 THEN montantht ELSE 0 END) AS tva_22_5_total',
                                'SUM(CASE WHEN tva = 0 THEN montantht ELSE 0 END) AS tva_0_total'
                            ])
                                ->from('lignefactureclients')
                                ->where(['factureclient_id' => $id])
                                ->group(['tva']);

                            $results = $query->execute()->fetchAll('assoc');
                        ?>
                            <tr class="tr" height="25px">
                                <td align="left" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;">
                                    <div style="margin-left: 3%;"><?php
                                                                    if (isset($lignecommande->article)) {
                                                                        echo  h($lignecommande->article->Code);
                                                                    }
                                                                    ?></div>
                                </td>
                                <td align="left" style="border: 1px solid black; border-top: none; border-bottom: none; vertical-align: top;">
                                    <div style="margin-left: 3%;">
                                        <?php
                                        if (isset($lignecommande->article)) {
                                            echo h($lignecommande->article->Dsignation);
                                        }
                                        ?>
                                    </div>
                                </td>



                                <td hidden align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;">
                                    <?php $unite_id = $lignecommande->article->unitearticle_id; ?>

                                    <?php
                                    $connection = ConnectionManager::get('default');
                                    $unitename = $connection->execute("SELECT name FROM unitearticles WHERE id = " . $unite_id . ";")->fetchAll('assoc');
                                    echo ($unitename[0]['name']);
                                    ?>
                                </td>
                             
                                <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;">
                                    <?php // $this->Number->format($lignecommande->qte)
                                    echo number_format(abs($lignecommande->qte), 4, ',', ' ');  ?>
                                </td>

                                <td align="center" hidden style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;">
                                    <?= $this->Number->format($lignecommande->fodec) ?>
                                </td>
                                <td align="left" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;text-align:left">
                                    <div style="margin-left: 25% ;"><?php // $this->Number->format($lignecommande->punht) 
                                                                    echo number_format(abs($lignecommande->punht), 4, ',', ' '); ?></div>
                                </td>

                                <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;text-align:right">
                                    <div style="margin-right: 25%;"><?php // $this->Number->format($lignecommande->ttc)
                                                                    echo number_format(abs($lignecommande->prixht), 4, ',', ' '); ?></div>
                                </td>

                                <?php if ($factureclient->totalremise != 0) { ?>
                                    <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;">
                                        <?php if ($lignecommande->remise != 0) { ?>
                                            <?= $this->Number->format($lignecommande->remise) ?>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                                <td hidden align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;">
                                    <?= $this->Number->format($lignecommande->tva)  ?> %
                                </td>
                                <td align="center" style="border:1px solid black;  border-top: none; border-bottom: none; vertical-align:top;text-align:right">
                                    <div style="margin-right: 25%;"> <?php // $this->Number->format($lignecommande->montantht) 
                                                                        echo number_format(abs($lignecommande->montantht), 4, ',', ' '); ?> </div>
                                </td>
                            </tr>
                        <?php $nombreLignes += 25;
						
						if($nombreLignes>450) { $nombreLignes=0; echo "</table>";?>
						
						<div class="saut-page"  ></div>
<br><br><br><br> <br><br><br><br><br><br><br><br><br>
<h3 align="left" style="margin-left:4% ;"> Facture N° <?php echo $factureclient->numero ?></h3>

			<div style="display:flex;width: 90%;">
			 
			 <div style="display:flex ;width:90%;margin-right:2%;" align="right">
        <div style="width: 90%;border:1px solid black;border-radius: 15px;" align="left">
            <br>
            <b style="margin-left:7% ;"> Date Facture: </b><?= $this->Time->format(
                                                                $factureclient->date,
                                                                'dd/MM/y'
                                                            ); ?> <br>

            <?php

            $paiement_id = $factureclient->client->paiement_id;
            if (!empty($paiement_id)) {

                $connection = ConnectionManager::get('default');
                $paiementname = $connection->execute("SELECT name FROM paiements WHERE id = " . $paiement_id . ";")->fetchAll('assoc');
            }
            ?>
            <?php

            $client_id = $factureclient->client_id;
            if (!empty($client_id)) {

                $connection = ConnectionManager::get('default');
                $adres = $connection->execute("SELECT adresse FROM adresselivraisonclients WHERE client_id = " . $client_id . ";")->fetchAll('assoc');
            }

            ///
            $factureclient_id = $factureclient->id;
            if (!empty($factureclient_id)) {

                $connection = ConnectionManager::get('default');
                $bl = $connection->execute("SELECT factureclient_id FROM bonlivraisons WHERE factureclient_id = " . $factureclient_id . ";")->fetchAll('assoc');
                //debug($bl);
            }
            ?>
            <!-- <b style="margin-left:7% ;"> Mode de Paiement : </b><?= h($paiementname[0]['name']) ?>  -->
            <!-- <?php if (!empty($bl)) {
                        $blInfo = $bl[0]; ?>
                
                <b style="margin-left:7% ;"> N° BL : </b> <?php echo $factureclient->numerobl ?><br>
                <b style="margin-left:7% ;"> Date BL : </b> <?= $this->Time->format(
                                                                $factureclient->datebl,
                                                                'dd/MM/y'
                                                            ); ?>
            <?php } ?> -->




            <br>
        </div>
    </div>
        <div style="width: 90%;border:1px solid black;border-radius: 15px;" align="left">
            <br>
            <b style="margin-left:7% ;"> Code Client : </b><?= h($factureclient->client->Code) ?> <br>

            <b style="margin-left:7% ;"> Nom Client : </b> <?php
                                                            if (isset($factureclient->client)) {
                                                                echo  h($factureclient->client->Raison_Sociale);
                                                            } ?><br>
            <b style="margin-left:7% ;"> Adresse : </b>

            <!-- <?= h($factureclient->client->adresse1) ?> -->
            <?php
            foreach ($adres as $adresss) {
                echo $adresss['adresse'] . '&nbsp;' . '&nbsp;';
            }
            ?>
            <br>

            <b style="margin-left:7%;"> Tel : </b><?= h($factureclient->client->Tel) ?><br>
            <!-- <b style="margin-left:7%;"> Fax : </b><?= h($factureclient->client->Fax) ?><br> -->
            <b style="margin-left:7%;"> Email : </b><?= h($factureclient->client->Email) ?><br>

            <b style="margin-left:7% ;"> Matricule Fiscal : </b><?= h($factureclient->client->Matricule_Fiscale) ?>

        </div>
  

  </div>
                <table style="border:1px solid black;width: 95%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;">
 <tr>
                            <td align="center" style="width: 3%;border:1px solid black;background-color:#b5d6d3;"><strong>CODE </strong></td>

                            <td align="center" style="width: 22%;border:1px solid black;background-color:#b5d6d3;"><strong>Désignation</strong></td>
                            <!-- <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité</strong></td> -->

                            <td align="center" style="width: 5%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté</strong></td>
                            <!-- <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité</strong></td> -->
                            <!-- <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Fod</strong></td> -->
                            <td align="center" style="width: 9%;border:1px solid black;background-color:#b5d6d3;"><strong>P.U.H.T</strong></td>


                            <td align="center" style="width: 13%;border:1px solid black;background-color:#b5d6d3;"><strong>Montant HT</strong></td>
                            <?php if ($factureclient->totalremise != 0) { ?>
                                <td align="center" style="width: 3%;border:1px solid black;background-color:#b5d6d3;"><strong>Remise </strong></td>
                            <?php } ?>
                            <td align="center" style="width: 13%;border:1px solid black;background-color:#b5d6d3;"><strong> Net HT</strong></td>
                            <!-- <td align="center" style="width: 7%;border:1px solid black;background-color:#b5d6d3;"><strong>TVA </strong></td> -->
                        </tr>
						<!-- Utilisez une balise vide avec la classe saut-page pour le saut de page -->
   
						<?php
						
						}
                        endforeach; ?>

                        <?php
                        //   $rowHeight = 30;
                        $rowHeight = 80;
                        $calcul = $rowHeight - $nombreLignes;
                        // $calcul = (450 - $nombreLignes * $rowHeight) / $nombreLignes;
                        ?>
                        <tr style="height:<?php echo $calcul ?>px;">
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"><?php //echo $nombreLignes; ?></td>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <?php if ($factureclient->totalremise != 0) { ?>
                                <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <?php } ?>
                            <!-- <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td> -->
                            <!-- <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td> -->
                        </tr>
                    </tbody>
                </table>
                <?php
                // var_dump($factureclient->client->typeexoneration_id);
                if ($factureclient->client->typeexoneration_id == 1) { ?>
                    <br>
                    <p>Vente en suspension de TVA selon autorisation N°<strong> <?= $factureclient->numeroautorisation; ?></strong> et bon de commande N° <strong><?= $factureclient->numerobc; ?></strong></p>
                <?php } else { ?>

                <?php  } ?>
            <?php } else {
            ?>
                <br>
                <table style="border:1px solid black;width: 95%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;">
                    <thead>
                        <tr>
                            <!-- Your existing header columns -->
                            <td align="center" style="width: 5%;border:1px solid black;background-color:#b5d6d3;"><strong>Code</strong></td>

                            <td align="center" style="width: 40%;border:1px solid black;background-color:#b5d6d3;"><strong>Article</strong></td>
                            <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté</strong></td>
                            <!-- <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté KG</strong></td> -->
                            <td align="center" style="width: 12%;border:1px solid black;background-color:#b5d6d3;"><strong>P.U HT</strong></td>
                            <td align="center" style="width: 12%;border:1px solid black;background-color:#b5d6d3;"><strong>Total Ht</strong></td>
                            <?php if ($factureclient->totalremise != 0) { ?>
                                <td align="center" style="width: 3%;border:1px solid black;background-color:#b5d6d3;"><strong>Remise </strong></td>
                            <?php } ?>
                            <td align="center" style="width: 12%;border:1px solid black;background-color:#b5d6d3;"><strong>Net HT</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totpuhtfodec = 0;
                       
                        $nombreLignes = 0;
                        foreach ($lignefactureclient as $lignecommande) :
                            $factureclient_id = $lignecommande['factureclient_id'];
                            $lignebonlivraison_id = $lignecommande['lignebonlivraison_id'];
                            $bonlivraison_id = $lignecommande['bonlivraison_id'];
                            $connection = ConnectionManager::get('default');
                            $blstatement = $connection->prepare("SELECT * FROM bonlivraisons WHERE id =" . $bonlivraison_id);

                            $blstatement->execute();
                            $numbl = $blstatement->fetchAll('assoc');

                        ?>
                            <tr style="height:<?php echo $calcul ?>px;">
                                <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                                <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"><b><?php echo 'Bl N°:' . $numbl[0]['numero']; ?> =====> <?php echo date('d/m/Y', strtotime($numbl[0]['date'])); ?></b></td>
                                <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                                <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                                <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                                <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                                <?php if ($factureclient->totalremise != 0) { ?>
                                    <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                                <?php } ?>
                                <!-- <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td> -->
                                <!-- <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td> -->
                            </tr>


                            <?php
                            $bl2 = $connection->execute(

                                "SELECT  * FROM lignefactureclients,lignebonlivraisons WHERE 
								lignefactureclients.lignebonlivraison_id=lignebonlivraisons.id and 
								factureclient_id=" . $factureclient_id . " and  
								lignebonlivraisons.bonlivraison_id=" . $bonlivraison_id . "    ;"

                            )->fetchAll('assoc');

                         
                            foreach ($bl2 as $bonl) {
                            $nombreLignes += 25;

                                // debug($bonl);

                                $art = $connection->execute(

                                    "SELECT  * FROM articles WHERE 
								 id=" . $bonl['article_id'] . "      ;"

                                )->fetchAll('assoc');

                            ?>
                                <tr class="tr">
                                    <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;">
                                        <?php
                                        if (isset($bonl['article_id'])) {
                                            echo h($art[0]['Code']);
                                        }
										
										///echo "-".$nombreLignes;
                                        ?>
                                    </td>

                                    <td style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;">
                                        <?php
                                        if (isset($bonl['article_id'])) {
                                            echo h($art[0]['Dsignation']);
                                        }
                                        ?>

                                    </td>
                                    <td nowrap align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"><?php //echo $bonl['qte']; ?> <?php 
                                    echo number_format(abs($bonl['qte']), 4, ',', ' '); ?></td>
                                    <!-- <td nowrap align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"><?php //echo $bonl['qtekg'];
                                    // echo number_format(abs($bonl['qtekg']), 4, ',', ' '); ?></td> -->
                                    <td align="center" nowrap style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"><?php echo number_format(abs($bonl['punht']), 4, ',', ' '); ?></td>
                                    <td align="center" nowrap style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"><?php echo number_format(abs($bonl['prixht']), 4, ',', ' '); ?></td>
                                    <?php if ($factureclient->totalremise != 0) { ?>
                                        <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;">
                                            <?php if ($bonl['remise'] != 0) { ?>
                                                <?= $this->Number->format($bonl['remise']) ?>
                                            <?php }else{
                                                echo '0';
                                            } ?>
                                        </td>
                                    <?php } ?> <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"><?php echo number_format(abs($bonl['ttc']), 4, ',', ' '); ?></td>
                                </tr>


                        <?php


 // echo($nombreLignes);
	if($nombreLignes>550) { $nombreLignes=0; echo "</table>";?>
						
						<div class="saut-page"  ></div>
<br><br><br><br> <br><br><br><br><br><br><br><br><br>
<h3 align="left" style="margin-left:4% ;"> Facture N° <?php echo $factureclient->numero ?></h3>

			
              <div style="display:flex;width: 90%;">
			  <div style="display:flex ;width:90%;margin-right:2%;" align="right">
        <div style="width: 90%;border:1px solid black;border-radius: 15px;" align="left">
            <br>
            <b style="margin-left:7% ;"> Date Facture: </b><?= $this->Time->format(
                                                                $factureclient->date,
                                                                'dd/MM/y'
                                                            ); ?> <br>

            <?php

            $paiement_id = $factureclient->client->paiement_id;
            if (!empty($paiement_id)) {

                $connection = ConnectionManager::get('default');
                $paiementname = $connection->execute("SELECT name FROM paiements WHERE id = " . $paiement_id . ";")->fetchAll('assoc');
            }
            ?>
            <?php

            $client_id = $factureclient->client_id;
            if (!empty($client_id)) {

                $connection = ConnectionManager::get('default');
                $adres = $connection->execute("SELECT adresse FROM adresselivraisonclients WHERE client_id = " . $client_id . ";")->fetchAll('assoc');
            }

            ///
            $factureclient_id = $factureclient->id;
            if (!empty($factureclient_id)) {

                $connection = ConnectionManager::get('default');
                $bl = $connection->execute("SELECT factureclient_id FROM bonlivraisons WHERE factureclient_id = " . $factureclient_id . ";")->fetchAll('assoc');
                //debug($bl);
            }
            ?>
            <!-- <b style="margin-left:7% ;"> Mode de Paiement : </b><?= h($paiementname[0]['name']) ?>  -->
            <!-- <?php if (!empty($bl)) {
                        $blInfo = $bl[0]; ?>
                
                <b style="margin-left:7% ;"> N° BL : </b> <?php echo $factureclient->numerobl ?><br>
                <b style="margin-left:7% ;"> Date BL : </b> <?= $this->Time->format(
                                                                $factureclient->datebl,
                                                                'dd/MM/y'
                                                            ); ?>
            <?php } ?> -->




            <br>
        </div>
    </div>
        <div style="width: 90%;border:1px solid black;border-radius: 15px;" align="left">
            <br>
            <b style="margin-left:7% ;"> Code Client : </b><?= h($factureclient->client->Code) ?> <br>

            <b style="margin-left:7% ;"> Nom Client : </b> <?php
                                                            if (isset($factureclient->client)) {
                                                                echo  h($factureclient->client->Raison_Sociale);
                                                            } ?><br>
            <b style="margin-left:7% ;"> Adresse : </b>

            <!-- <?= h($factureclient->client->adresse1) ?> -->
            <?php
            foreach ($adres as $adresss) {
                echo $adresss['adresse'] . '&nbsp;' . '&nbsp;';
            }
            ?>
            <br>

            <b style="margin-left:7%;"> Tel : </b><?= h($factureclient->client->Tel) ?><br>
            <!-- <b style="margin-left:7%;"> Fax : </b><?= h($factureclient->client->Fax) ?><br> -->
            <b style="margin-left:7%;"> Email : </b><?= h($factureclient->client->Email) ?><br>

            <b style="margin-left:7% ;"> Matricule Fiscal : </b><?= h($factureclient->client->Matricule_Fiscale) ?>

        </div>
    </div>
	<br><br> 
                <table style="border:1px solid black;width: 95%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;">
 <tr>
                            <td align="center" style="width: 3%;border:1px solid black;background-color:#b5d6d3;"><strong>CODE </strong></td>

                            <td align="center" style="width: 22%;border:1px solid black;background-color:#b5d6d3;"><strong>Désignation</strong></td>
                            <!-- <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité</strong></td> -->

                            <td align="center" style="width: 5%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté</strong></td>
                            <!-- <td align="center" style="width: 5%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté/rlx</strong></td> -->
                            <!-- <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité</strong></td> -->
                            <!-- <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Fod</strong></td> -->
                            <td align="center" style="width: 9%;border:1px solid black;background-color:#b5d6d3;"><strong>P.U.H.T</strong></td>


                            <td align="center" style="width: 13%;border:1px solid black;background-color:#b5d6d3;"><strong>Montant HT</strong></td>
                            <?php if ($factureclient->totalremise != 0) { ?>
                                <td align="center" style="width: 3%;border:1px solid black;background-color:#b5d6d3;"><strong>Remise </strong></td>
                            <?php } ?>
                            <td align="center" style="width: 13%;border:1px solid black;background-color:#b5d6d3;"><strong> Net HT</strong></td>
                            <!-- <td align="center" style="width: 7%;border:1px solid black;background-color:#b5d6d3;"><strong>TVA </strong></td> -->
                        </tr>
						<!-- Utilisez une balise vide avec la classe saut-page pour le saut de page -->

						<?php
						   $nombreLignes += 25;
						}
                            }
							
						
                        endforeach; ?>

                        <?php
                        //   $rowHeight = 30;
                        $rowHeight = 100;


                        $calcul = $rowHeight - $nombreLignes;
                        // $calcul = (450 - $nombreLignes * $rowHeight) / $nombreLignes;
                        ?>
                        <tr style="height:<?php echo $calcul ?>px;">
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"><?php //echo $nombreLignes;
                                                                                                                                            ?></td>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <?php if ($factureclient->totalremise != 0) { ?>
                                <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td>
                            <?php } ?>
                            <!-- <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td> -->
                            <!-- <td align="center" style="border:1px solid black; border-top: none; border-bottom: none; vertical-align:top;"></td> -->
                        </tr>
                    </tbody>
                </table>
                <?php
                // var_dump($factureclient->client->typeexoneration_id);
                if ($factureclient->client->typeexoneration_id == 1) { ?>
                    <br>
                    <p>Vente en suspension de TVA selon autorisation N°<strong> <?= $factureclient->numeroautorisation; ?></strong> et bon de commande N° <strong><?= $factureclient->numerobc; ?></strong></p>
                <?php } else { ?>

                <?php  } ?>



            <?php }
            if ($nombreLignes > 100) {
            ?>
                <!--<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br> <br><br><br>-->
            <?php } ?>
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
                            $sql = $connection->execute("SELECT SUM(qte * punht) AS total FROM lignefactureclients WHERE factureclient_id = " . $factureclient->id)->fetchAll('assoc');

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
                                                                        echo number_format(abs($sql[0]['total']), 4, ',', ' ');  ?> </div>
                                </td>
                            </tr>
                            <?php  ///debug($factureclient->toarray());
                            if ($factureclient->totalremise != 0) { ?>
                                <tr>
                                    <td style="border:1px solid black;">
                                        <div style="margin-left: 6%;"><strong> Remise </strong></div>
                                    </td>
                                    <td style="border:1px solid black;" align="right">
                                        <div style="margin-right: 10% ;"><?php
                                                                            // $this->Number->format($commande->remise) commande->brut
                                                                            echo number_format(abs($factureclient->totalremise), 4, ',', ' ');  ?></div>
                                    </td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td style="border:1px solid black;">
                                    <div style="margin-left: 6%;"><strong> NET HT</strong></div>
                                </td>
                                <td style="border:1px solid black;" align="right">
                                    <div style="margin-right: 10% ;"><?php //$this->Number->format($commande->total)
                                                                        echo number_format(abs($factureclient->totalht), 4, ',', ' '); ?></div>
                                </td>
                            </tr>

                            <!-- <tr>
                                <td style="border:1px solid black;">
                                    <div style="margin-left: 6%;"><strong>T,FODEC</strong></div>
                                </td>
                                <td style="border:1px solid black;" align="right">
                                    <div style="margin-right: 10% ;"><?php //$totphtfodec = $totphtfodec * 1 / 100;
                                                                        //echo $totphtfodec  
                                                                        ?>
                                        <?php // $this->Number->format($commande->fodec) 
                                        echo number_format(abs($factureclient->totalfodec), 4, ',', ' '); ?> </div>
                                </td>
                            </tr> -->
                            <tr>
                                <td style="border:1px solid black;">
                                    <div style="margin-left: 6%;"><strong>T,TVA</strong></div>
                                </td>
                                <td style="border:1px solid black;" align="right">
                                    <div style="margin-right: 10% ;"><?php //$this->Number->format($commande->tva)  
                                                                        echo number_format(abs($factureclient->totaltva), 4, ',', ' '); ?> </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid black;">
                                    <div style="margin-left: 6%;"><strong> Timbre </strong></div>
                                </td>
                                <td style="border:1px solid black;" align="right">
                                    <div style="margin-right: 10% ;"><?php // $this->Number->format($commande->totalttc) 
                                                                        // echo number_format(abs($factureclient->timbre), 3, ',', ' ');
                                                                        echo  $timbre; ?></div>
                                </td>
                            </tr>
                            <tr>    
                                <td style="border:1px solid black;">
                                    <div style="margin-left: 6%;"><strong> NET A PAYER </strong></div>
                                </td>
                                <td style="border:1px solid black;" align="right">
                                    <div style="margin-right: 10% ;"><?php // $this->Number->format($commande->totalttc) 
                                                                        echo number_format(abs($factureclient->totalttc), 4, ',', ' '); ?></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>
</div>