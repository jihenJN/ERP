<?php

use Cake\Datasource\ConnectionManager;
?>


<?php
$connection = ConnectionManager::get('default');
?>
<?php $this->layout = 'AdminLTE.print'; ?>
<style>
    @media print {

        html,
        body {
            height: 100vh;
            margin: 2px !important;
            padding: 0 !important;
            /* overflow: hidden; */
        }

    }
</style>
<style>
    .pp {
        page-break-inside: auto;
    }

    tr {
        page-break-inside: avoid;
    }

    td {
        page-break-inside: avoid;
    }
</style>
<?php


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
             <?php echo $societes->nom; ?>&nbsp;&nbsp; au Capital : <?php echo $societes->capital; ?> <br>
             <?php echo $societes->adresse; ?> - Tél : <?php echo $societes->tel; ?>  -Fax : <?php echo $societes->fax; ?><br>
            TVA : <?php echo $societes->codetva; ?> - E-mail : <?php echo $societes->mail; ?><br>
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


<div align="center">
    <h3>
        <b> BON DE COMMANDE N° : </b><?= h($commande->numero) ?> <br>
    </h3>
</div>


Date: <?php
        date_default_timezone_set('Africa/Tunis');

        echo date('d/m/Y H:i:s');
        ?>
<br><br>
<div style="display:flex;margin-bottom:3px;" align="center">
    <div style="display:flex;width: 1000%;">
        <div style="font-size:14px!important;width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;" align="left">
            <br>
            <?php if ($commande->client_id == 12) { ?>
                <b style="margin-left:3% ;"> Nom: </b><?php
                                                        if (isset($commande->numeroidentite)) {
                                                            echo h($commande->nomprenom);
                                                        } ?> <br>
                <b style="margin-left:3% ;"> Identifiant:</b><?php
                                                                if (isset($commande->numeroidentite)) {
                                                                    echo h($commande->numeroidentite);
                                                                } ?> <br>
                <b style="margin-left:3% ;"> Adresse : </b> <?php
                                                            if (isset($commande->adressediv)) {
                                                                echo  h($commande->adressediv);
                                                            } ?><br>


            <?php } else { ?>
                <b style="margin-left:3% ;"> Code: </b><?= h($commande->client->Code) ?> <br>
                <b style="margin-left:3% ;"> Matricule fiscale :</b><?= h($commande->client->Matricule_Fiscale) ?> <br>
                <b style="margin-left:3% ;"> Client : </b> <?php
                                                            if (isset($commande->client)) {
                                                                echo  h($commande->client->Raison_Sociale);
                                                            } ?><br>
                <b style="margin-left:3% ;"> Adresse :</b>

                <?= h($commande->client->Adresse) ?>

                <br>
                <b style="margin-left:3% ;"> Tel : </b><?php
                                                        if (isset($commande->client)) {
                                                            echo  h($commande->client->Tel);
                                                        } ?>
            <?php } ?>
        </div>
    </div>
    <div style="display:flex ;width:1000%;margin-left:10%;">
        <div style="font-size:14px!important;width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;" align="left">
            <br>
            <?php $offre = $connection->execute('SELECT * FROM bonlivraisons where bonlivraisons.typebl=2 and bonlivraisons.commande_id=' . $commande->id . ';')->fetchAll('assoc');
            $integ = [];
            if ($offre[0]['id'] != null) {
                $integ = $connection->execute('SELECT * FROM bonlivraisons where bonlivraisons.typebl=4 and bonlivraisons.id_offredeprix=' . $offre[0]['id'] . ';')->fetchAll('assoc');
            }

            ?>
            <!-- <b style="margin-left:7% ;"> Intégration N° : </b><?php echo ($integ[0]['numero']) ?> -->
         
            <?php

            ?>
            <b style="margin-left:3% ;"> Facture Proforma N° : </b><?php echo ($offre[0]['numero']) ?>
            <br>
            <!-- <b style="margin-left:7% ;"> BON DE COMMANDES N° : </b><?= h($commande->numero) ?> <br> -->
            <b style="margin-left:3% ;"> Date : </b><?= $this->Time->format(
                                                        $commande->date,
                                                        'dd/MM/y'
                                                    ); ?> <br>
            <!-- <b style="margin-left:7% ;"> Commercial : </b><?php
                                                                if (isset($commande->commercial_id)) {
                                                                    echo  h($commande->commercial->name);
                                                                } ?> <br> -->
            <b style="margin-left:3% ;"> Observation :</b>
            <p style="margin-left:3% ;margin-top: 1px;">
                <?= h($commande->observation) ?>
            </p>

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
                        <td align="center" style="width: 10%;border:1px solid black;background-color:#b5d6d3;"><strong>CODE</strong></td>
                        <td align="center" style="width: 40%;border:1px solid black;background-color:#b5d6d3;"><strong>DESIGNATION</strong></td>
                        <td align="center" style="width: 15%;border:1px solid black;background-color:#b5d6d3;"><strong>Unité</strong></td>
                        <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>Qté</strong></td>
                        <!-- <td align="center" style="width: 8%;border:1px solid black;background-color:#b5d6d3;"><strong>ml</strong></td> -->

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lignecommandes as $lignecommande) :
                        $qte = $lignecommande->qte;
                        $prix = $lignecommande->prix;
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
                                if (isset($lignecommande->article->unitearticle_id) && ($lignecommande->article->unitearticle_id != 0)) {
                                    $unite = $connection->execute('SELECT * FROM unitearticles where unitearticles.id=' . $lignecommande->article->unitearticle_id . ';')->fetchAll('assoc');
                                    //  debug( $unite);
                                    echo ($unite[0]['name']);
                                } else echo ''; ?>
                            </td>
                            <td align="center" style="border:1px solid black;vertical-align:top;">
                                <?= $this->Number->format($lignecommande->qte) ?>
                            </td>

                            <!-- <td align="center" style="border:1px solid black;vertical-align:top;">
                                <?= $this->Number->format($lignecommande->ml * $lignecommande->qte) ?>
                            </td> -->

                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <!-- <td style="border:1px solid black;vertical-align:top;"></td> -->
                        <!-- <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td>
                        <td style="border:1px solid black;vertical-align:top;"></td> -->
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

                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr">
                                <td align="center" height="90px" style="border:1px solid black;" rowspan="2">

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


<table class="pp">
    <tr>
        <td>
            <p>
                <Strong>Commentaire : </Strong><?php echo $commande->observation ?>

            </p>
        </td>
    </tr>
</table>