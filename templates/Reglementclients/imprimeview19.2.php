<?php $this->layout = 'AdminLTE.print'; ?>
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
    <!-- <div style="margin-left:1%">
        <?php
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '70px', 'width' => '110px']); ?>
    </div>
    <div style="width: 40%;margin-left:2% ;text-align:center" align="center">

        Comptoir de Diffusion et de Fabrication
        <br>
        de Produits d'entretien SARL
    </div>
    <div style="width: 50%;margin-left:8%" align="left">
        <h5>
            <b>Siége Social:</b>3 Rue Mustapha Sfar Tunis Bélvédére 1002 <br>
            <b>Usine:</b>Rte Fouchana Chebedda Naassen 1135 Tunisie <br>
            <b>Tel:</b>+216 71 398 404/<b>Fax:</b>+216 71 398 137<br>
            <b>E-mail:</b>codifa@gnet.tn/<b>WEB:</b> www.codifa.tn <br>
            <b>R.C:</b>B0128802005/<b>M.F:</b>02940/X/A/M/000<br>
            <b>CCB:</b>01100028110500554697 ATB Rue du Plastique-Mégrine
        </h5>
    </div> -->
</div>
<br><br><br><br><br><br><br><br><br>


<?php if ($type == 2) {
    //debug($reglement);
?>

    <!-- <div style="display:flex" align="center">





        <div style="display:flex;width: 1000%;">
            <div style="width: 10000%;" class="box" align="left">
                <b> Reglement Factue client N° : </b><?= h($reglement->numeroconca) ?> <br>
                <b> Date : </b><?= h($this->Time->format($reglement->Date, 'd/MM/y'));
                                ?> <br>

            </div>
        </div>

        <div style="display:flex ;width:1000%;margin-left:10%">

            <div style="width: 10000%;" class="box" align="left"> <b> Client : </b> <?php
                                                                                    if (isset($reglement->client)) {
                                                                                        echo  h($reglement->client->Raison_Sociale);
                                                                                    } ?><br>
                <b> Téléphone: </b><?= h($reglement->client->Tel) ?> <br>
                <b> Adresse: </b><?= h($reglement->client->AdresseL) ?> <br>



            </div>
        </div>
    </div> -->






    <div style="display:flex;margin-bottom:3px;" align="center">
        <div style="display:flex;width: 1000%;">
            <div style="width: 10000%;border:1px solid black;border-radius: 15px;" align="left">
                <br>
                <b style="margin-left:7% ;"> Client: </b><?php
                                                            if (isset($reglement->client)) {
                                                                echo  h($reglement->client->Raison_Sociale);
                                                            } ?><br>
                <b style="margin-left:7% ;">Téléphone: </b><?= h($reglement->client->Tel) ?> <br>

                <div style="margin-left:7% ;"> <!-- Use a div for the address -->
                    <b> Adresse :</b>
                    <div style="display: flex; flex-wrap: wrap; align-items: baseline;">
                        <?= h($reglement->client->Adresse1) ?>
                    </div><br><br>
                </div>

            </div>
        </div>
        <div style="display:flex ;width:1000%;margin-left:10%;">
            <div style="width: 10000%;border:1px solid black;border-radius: 15px;" align="left">
                <br>
                <b style="margin-left:7% ;"> Reglement Factue client N° : </b><?= h($reglement->numeroconca) ?> <br>
                <b style="margin-left:7% ;"> Date : </b><?= $this->Time->format(
                                                            $reglement->Date,
                                                            'dd/MM/y'
                                                        ); ?> <br>
            </div>
        </div>
    </div>




    <br><br>










    <div class="box">
        <div class="panel-body">
            <div>
                <table border="1" style="width: 100%;">
                    <thead>
                        <tr>

                            <td align="center" style="width: 20%;background-color:#e6ebe3;"><strong>type</strong></td>
                            <td align="center"style="background-color:#e6ebe3;"><strong>Date</strong></td>
                            <td align="center"style="background-color:#e6ebe3;"><strong>Facture N°</strong></td>
                            <td align="center"style="background-color:#e6ebe3;"><strong>Total TTC</strong></td>
                            <td align="center"style="background-color:#e6ebe3;"><strong>Montant Réglé </strong></td>
                            <td align="center"style="background-color:#e6ebe3;"><strong>Reste</strong></td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $s = 0;
                        foreach ($lignesreg as $lignereglement) :
                            // debug($lignereglement);
                            if (($lignereglement->factureclient_id != 0) && ($lignereglement->factureclient_id != null)) {
                                $reste = ($lignereglement->factureclient->totalttc ) - $lignereglement->factureclient->Montant_Regler;
                                $s += $lignereglement->factureclient->totalttc;
                        ?>

                                <tr class="tr">

                                    <td><?php
                                        echo  h('Facture client');

                                        ?></td>
                                    <td align="center">
                                        <?php echo $this->Time->format($lignereglement->factureclient->date, 'dd/MM/y HH:mm:ss')  ?>
                                    </td>
                                    <td align="center">
                                        <?= $lignereglement->factureclient->numero ?>
                                    </td>
                                    <td align="center">
                                        <?= $lignereglement->factureclient->totalttc  ?>
                                    </td>
                                    <td align="center">
                                        <?= $lignereglement->factureclient->Montant_Regler ?>
                                    </td>
                                    <td align="center">
                                        <?= $this->Number->format($reste) ?>
                                    </td>

                                </tr>
                            <?php } else if (($lignereglement->factureavoir_id != 0) && ($lignereglement->factureavoir_id != null)) {
                                $reste1 = ($lignereglement->factureavoir->totalttc) - $lignereglement->factureavoir->montant_regle;
                                $s -= $lignereglement->factureavoir->totalttc;
                            ?>
                                <tr class="tr">

                                    <td> <?php if ($lignereglement->factureavoir->typef == 1) {
                                            ?> avoir financière
                                    <?php } else if ($lignereglement->factureavoir->typef == 2) {
                                    ?>
                                         avoir marchandise

                                    <?php  }
                                    ?></td>
                                    <td align="center">

                                        <?php echo $this->Time->format($lignereglement->factureavoir->date, 'dd/MM/y HH:mm:ss')  ?>

                                    </td>
                                    <td align="center">
                                        <?php echo ($lignereglement->factureavoir->numero) ?>
                                    </td>
                                    <td align="center">
                                        <?= $this->Number->format($lignereglement->factureavoir->totalttc) ?>
                                    </td>
                                    <td align="center">
                                        <?= $this->Number->format($lignereglement->factureavoir->montant_regle) ?>
                                    </td>
                                    <td align="center">
                                        <?= $this->Number->format($reste1) ?>
                                    </td>

                                </tr>


                            <?php } else if (($lignereglement->facturepublicitaire_id != 0) && ($lignereglement->facturepublicitaire_id != null)) {
                                $reste1 = ($lignereglement->facturepublicitaire->netapayer) - $lignereglement->facturepublicitaire->montant_regle;
                                $s -= $lignereglement->facturepublicitaire->netapayer;
                            ?>
                                <tr class="tr">

                                    <td><?php
                                        echo  h('Facture publicitaire');

                                        ?></td>
                                    <td align="center">
                                        <?php echo $this->Time->format($lignereglement->facturepublicitaire->date, 'dd/MM/y HH:mm:ss')  ?>

                                    </td>
                                    <td align="center">
                                        <?php echo ($lignereglement->facturepublicitaire->numero) ?>
                                    </td>
                                    <td align="center">
                                        <?= $this->Number->format($lignereglement->facturepublicitaire->netapayer) ?>
                                    </td>
                                    <td align="center">
                                        <?= $this->Number->format($lignereglement->facturepublicitaire->montant_regle) ?>
                                    </td>
                                    <td align="center">
                                        <?= $this->Number->format($reste1) ?>
                                    </td>

                                </tr>
                            <?php } ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="center" colspan="4"><strong>Total factures</strong></td>
                            <td align="center" colspan="2">

                                <?= h($s) ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="4"><strong>Montant à payer</strong></td>
                            <td align="center" colspan="2">
                                <?= h($reglement->Montant) ?>

                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="4"><strong>Differance echange</strong></td>
                            <td align="center" colspan="2">
                                <?= h($reglement->differance) ?>

                            </td>
                        </tr>

                    </tfoot>
                </table>



            </div>
        </div>
    </div>

    <section class="content-header">
        <h1 class="box-title"><?php echo __('Mode de Réglement'); ?></h1>
    </section>

    <section class="content" style="width: 99%">
        <div class="row">
            <div class="box box-primary">

                <div class="panel-body">
                    <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless" id="addtable">

                            <?php $read = "";
                            $i = 1;
                            // debug($piecereglementclients->toarray());
                            foreach ($piecereglementclients as $i => $piece) {
                                /// debug($piece);
                            ?>
                                <tr>
                                    <td colspan="8" style="vertical-align: top;">
                                        <table>
                                            <tr <?php if (($piece->paiement_id == 7) || ($piece->paiement_id == 6)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                                <td>Mode de paiement :</td>
                                                <td><?php
                                                    echo  $piece->paiement->name
                                                    ?>

                                                </td>

                                            </tr>
                                            <tr <?php if ($piece->factureavoir_id == null) { ?> style="display:none ; " <?php } ?>>
                                                <td> Facture :</td>

                                                <td>
                                                    <?php echo $piece->factureavoir->numero . '-' . $piece->factureavoir->totalttc ?>

                                                </td>
                                            </tr>
                                            <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trmontantbrut<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbruta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbruta" table="piece" class="modecheque">Montant brut :</td>
                                                <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbrutb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbrutb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                echo $piece->montant_brut
                                                                                                                                                                                                                                ?> </td>
                                            </tr>
                                            <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trtaux<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxa<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxa" table="piece" class="modecheque">Taux :</td>
                                                <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                            echo $piece->to->name
                                                                                                                                                                                                            ?> </td>
                                            </tr>
                                            <tr <?php if (($piece->paiement_id == 7) || ($piece->paiement_id == 6)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                                <td>Montant</td>
                                                <td><?php
                                                    echo $piece->montant
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trmontantnet<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantneta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantneta" table="piece" class="modecheque">Montant Net</td>
                                                <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantnetb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantnetb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                echo  $piece->montant_net
                                                                                                                                                                                                                                ?> </td>
                                            </tr>
                                            <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i ?>][trechance]" id="trechancea<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Echéance</td>
                                                <td name="data[piece][<?php echo $i ?>][trechance]" id="trechanceb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                                echo $piece->echance
                                                                                                                                                                                                ?> </td>
                                            </tr>

                                            <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trbanque<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Banque </td>
                                                <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                            echo  $piece->banque->name

                                                                                                                                                                                            ?></td>
                                            </tr>


                                            <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="numpiece<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i ?>][trnuma]" id="trnuma<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Numero piéce</td>
                                                <td name="data[piece][<?php echo $i ?>][trnumb]" id="trnumb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                        echo  $piece->num ?> </td>
                                            </tr>



                                        </table>







                                    </td>




                                </tr>
                            <?php } ?>
                            </tbody>
                        </table><br>
                    </div>
                </div>
            </div>
        </div>


    </section>
<?php } else if ($type == 1) {
    //debug($reglement);
?>
    <!-- 
    <div style="display:flex" align="center">





        <div style="display:flex;width: 1000%;">
            <div style="width: 10000%;" class="box" align="left">
                <b> Reglement bon livraisaon client N° : </b><?= h($reglement->numeroconca) ?> <br>
                <b> Date : </b><?= h($this->Time->format($reglement->Date, 'd/MM/y'));
                                ?> <br>

            </div>
        </div>

        <div style="display:flex ;width:1000%;margin-left:10%">

            <div style="width: 10000%;" class="box" align="left"> <b> Client : </b> <?php
                                                                                    if (isset($reglement->client)) {
                                                                                        echo  h($reglement->client->Raison_Sociale);
                                                                                    } ?><br>
                <b> Téléphone: </b><?= h($reglement->client->Tel) ?> <br>
                <b> Adresse: </b><?= h($reglement->client->AdresseL) ?> <br>



            </div>
        </div>
    </div> -->






    <div style="display:flex;margin-bottom:3px;" align="center">
        <div style="display:flex;width: 1000%;">
            <div style="width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;" align="left">
                <br>
                <b style="margin-left:7% ;"> Client: </b><?php
                                                            if (isset($reglement->client)) {
                                                                echo  h($reglement->client->Raison_Sociale);
                                                            } ?><br>
                <b style="margin-left:7% ;">Téléphone: </b><?= h($reglement->client->Tel) ?> <br>

                <div style="margin-left:7% ;"> <!-- Use a div for the address -->
                    <b> Adresse :</b>
                    <div style="display: flex; flex-wrap: wrap; align-items: baseline;">
                        <?= h($reglement->client->Adresse1) ?>
                    </div>
                </div>

            </div>
        </div>
        <div style="display:flex ;width:1000%;margin-left:10%;">
            <div style="width: 10000%;border:1px solid black;border-radius: 15px;background-color:#e6ebe3;" align="left">
                <br>
                <b style="margin-left:7% ;"> Reglement bon livraisaon client N° : </b><?= h($reglement->numeroconca) ?> <br>
                <b style="margin-left:7% ;"> Date : </b><?= $this->Time->format(
                                                            $reglement->Date,
                                                            'dd/MM/y'
                                                        ); ?> <br>
            </div>
        </div>
    </div>




    <br><br>




    <div class="box">
        <div class="panel-body">
            <div>
                <table border="1" style="width: 100%;">
                    <thead>
                        <tr>

                            <td align="center" style="width: 20%;"><strong>type</strong></td>
                            <td align="center"><strong>Date</strong></td>
                            <td align="center"><strong>Bon livraison N°</strong></td>
                            <td align="center"><strong>Total TTC</strong></td>
                            <td align="center"><strong>Montant Réglé </strong></td>
                            <td align="center"><strong>Reste</strong></td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $s = 0;
                        foreach ($lignesreg as $lignereglement) :
                            // debug($lignereglement);
                            if (($lignereglement->bonlivraison_id != 0) && ($lignereglement->bonlivraison_id != null)) {
                                $reste = ($lignereglement->bonlivraison->totalttc) - $lignereglement->bonlivraison->Montant_Regler;
                                $s += $lignereglement->bonlivraison->totalttc;
                        ?>

                                <tr class="tr">

                                    <td><?php
                                        echo  h('Bon livrason client');

                                        ?></td>
                                    <td align="center">
                                        <?php echo $this->Time->format($lignereglement->bonlivraison->date, 'dd/MM/y HH:mm:ss')  ?>
                                    </td>
                                    <td align="center">
                                        <?= $lignereglement->bonlivraison->numero ?>
                                    </td>
                                    <td align="center">
                                        <?= $lignereglement->bonlivraison->totalttc ?>
                                    </td>
                                    <td align="center">
                                        <?= $lignereglement->bonlivraison->Montant_Regler ?>
                                    </td>
                                    <td align="center">
                                        <?= $this->Number->format($reste) ?>
                                    </td>

                                </tr>
                            <?php } ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td align="center" colspan="4"><strong>Total factures</strong></td>
                            <td align="center" colspan="2">

                                <?= h($s) ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="4"><strong>Montant à payer</strong></td>
                            <td align="center" colspan="2">
                                <?= h($reglement->Montant) ?>

                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="4"><strong>Differance echange</strong></td>
                            <td align="center" colspan="2">
                                <?= h($reglement->differance) ?>

                            </td>
                        </tr>

                    </tfoot>
                </table>



            </div>
        </div>
    </div>

    <section class="content-header">
        <h1 class="box-title"><?php echo __('Mode de Réglement'); ?></h1>
    </section>

    <section class="content" style="width: 99%">
        <div class="row">
            <div class="box box-primary">

                <div class="panel-body">
                    <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless" id="addtable">

                            <?php $read = "";
                            $i = 1;
                        
                            foreach ($piecereglementclients as $i => $piece) {
                                
                            ?>
                                <tr>
                                    <td colspan="8" style="vertical-align: top;">
                                        <table>
                                            <tr <?php if (($piece->paiement_id == 7) || ($piece->paiement_id == 6)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                                <td>Mode de paiement :</td>
                                                <td><?php
                                                    echo  $piece->paiement->name
                                                    ?>

                                                </td>

                                            </tr>
                                            <tr <?php if ($piece->factureavoir_id == null) { ?> style="display:none ; " <?php } ?>>
                                                <td> Facture :</td>

                                                <td>
                                                    <?php echo $piece->factureavoir->numero . '-' . $piece->factureavoir->totalttc ?>

                                                </td>
                                            </tr>
                                            <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trmontantbrut<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbruta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbruta" table="piece" class="modecheque">Montant brut :</td>
                                                <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbrutb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbrutb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                echo $piece->montant_brut
                                                                                                                                                                                                                                ?> </td>
                                            </tr>
                                            <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trtaux<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxa<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxa" table="piece" class="modecheque">Taux :</td>
                                                <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                            echo $piece->to->name
                                                                                                                                                                                                            ?> </td>
                                            </tr>
                                            <tr <?php if (($piece->paiement_id == 7) || ($piece->paiement_id == 6)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                                <td>Montant</td>
                                                <td><?php
                                                    echo $piece->montant
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trmontantnet<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantneta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantneta" table="piece" class="modecheque">Montant Net</td>
                                                <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantnetb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantnetb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                echo  $piece->montant_net
                                                                                                                                                                                                                                ?> </td>
                                            </tr>
                                            <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i ?>][trechance]" id="trechancea<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Echéance</td>
                                                <td name="data[piece][<?php echo $i ?>][trechance]" id="trechanceb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                                echo $piece->echance
                                                                                                                                                                                                ?> </td>
                                            </tr>

                                            <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trbanque<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Banque </td>
                                                <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                            echo  $piece->banque->name

                                                                                                                                                                                            ?></td>
                                            </tr>


                                            <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="numpiece<?php echo $i  ?>">
                                                <td name="data[piece][<?php echo $i ?>][trnuma]" id="trnuma<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Numero piéce</td>
                                                <td name="data[piece][<?php echo $i ?>][trnumb]" id="trnumb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                        echo  $piece->num ?> </td>
                                            </tr>



                                        </table>







                                    </td>




                                </tr>
                            <?php } ?>
                            </tbody>
                        </table><br>
                    </div>
                </div>
            </div>
        </div>


    </section>
<?php } ?>