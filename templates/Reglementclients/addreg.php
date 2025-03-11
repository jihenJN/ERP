<?php

use Cake\Datasource\ConnectionManager;
?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reglementclient $reglementclient
 * @var \Cake\Collection\CollectionInterface|string[] $utilisateurs
 */
?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('dalanda'); ?>



<?php if ($type == 1) { ?>
    <section class="content-header">
        <h1>
            Ajout Réglement bon livraison
            <small><?php echo __(''); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'index/1']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
        </ol>
    </section>
<?php }  ?>





<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <?= $this->Form->create($reglementclient, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]) ?>
                <div class="box-body">



                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="col-xs-6">
                                <?php
                                echo $this->Form->control('numeroconca', ['label' => 'Numero', 'value' => $code, 'readonly' => 'readonly']);
                                echo $this->Form->control('type', ['label' => 'Type', 'value' => $type, 'type' => 'hidden']);

                                ?></div>

                            <div class="col-xs-6">
                                <?php
                                echo $this->Form->control('date', ['empty' => true, 'value' => date("Y-m-d"), 'type' => 'date', 'class' => 'form-control', 'id' => 'date']);

                                ?>
                            </div>
                        </div>
                        <?php if ($type == 2) { ?>
                            <div class="col-xs-5">

                                <div class="form-group input select required">

                                    <label class="control-label" for="client_id">Clients</label>

                                    <select name="client_id" id="client_id" class="form-control select2 control-label clientreglement2 " value='<?php $this->request->getQuery('client_id') ?>'>
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                        <?php foreach ($clients as $id => $client) { ?>
                                            <option <?php if ($client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($type == 1) { ?>
                            <div class="col-xs-5">

                                <div class="form-group input select required">

                                    <label class="control-label" for="client_id">Clients</label>

                                    <select name="client_id" id="client_id" class="form-control select2 control-label clientreglement1 " value='<?php $this->request->getQuery('client_id') ?>'>
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                        <?php foreach ($clients as $id => $client) { ?>
                                            <option <?php if ($client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('nomprenom', ['value' => $bonlivraisonsinf->nomprenom, 'readonly' => 'readonly', 'label' => 'Nom / Prénom', 'required' => 'off', 'class' => 'form-control  ']); ?>

                        </div>
                        <div class="col-xs-2">
                            <?php echo $this->Form->control('numeroidentite', ['value' => $bonlivraisonsinf->numeroidentite, 'readonly' => 'readonly', 'label' => 'Numéro identité', 'required' => 'off', 'class' => 'form-control ']); ?>

                        </div>
                        <div class="col-xs-2">
                            <?php echo $this->Form->control('adressediv', ['value' => $bonlivraisonsinf->adressediv, 'readonly' => 'readonly', 'label' => 'Adresse', 'required' => 'off', 'class' => 'form-control ']); ?>

                        </div>
                    </div>



                    <br>

                    <?php if ($client_id != 0) { ?>

                        <section class="content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-body">

                                            <table id="exemple1" class="table table-bordered table-striped">

                                                <div style="text-align: right;">
                                                    <button id="cocherTout" style="background-color: #4CAF50; color: white; border: 1px solid #4CAF50;">Cocher Tout</button>
                                                    <button id="decocherTout" style="background-color: #f44336; color: white; border: 1px solid #f44336;">Décocher Tout</button>
                                                </div>

                                                <?php if ($type == 1) { ?>
                                                    <!-- <td><strong> Solde Debut</strong></td>
                                                    <td align="center" style="color: #cd5b45 ;"><strong> <?php
                                                                                                            echo $compte->soldedebut;  ?></strong>
                                                    </td> -->
                                                    <tr style="color: #dc143c;">
                                                        <th><strong> Bon de livraison </strong>
                                                        </th>
                                                    </tr>
                                                    <tr style="background-color: #3C8DBC; color: white;">
                                                        <td hidden>id</td>
                                                        <td>Type</td>

                                                        <td>N° Bon de livraison</td>
                                                        <td>Date</td>
                                                        <td>Total TTC</td>

                                                        <td>Montant réglé</td>
                                                        <td></td>

                                                        <td>Reste</td>

                                                        <td></td>
                                                    </tr>


                                                    <tbody>

                                                        <?php    $i=-1;
                                                        //debug($livraisons->toArray()); 
                                                        if (!empty($livraisons)) {

                                                            foreach ($livraisons as $livraison) {
                                                                $i++;

                                                                ///   debug($livraison);

                                                                $connection = ConnectionManager::get('default');
                                                                $mon = $connection->execute("select montantreglerbl(" . $livraison->id . ") as mont")->fetchAll('assoc');
                                                                //debug($livraison);
                                                                //debug($mon);


                                                                if ($mon[0]['mont'] == null) {
                                                                    $montreg = 0;
                                                                } else {
                                                                    $montreg = $mon[0]['mont'];
                                                                }

                                                                $reste = $livraison->totalttc - $montreg;
                                                                //debug($montreg);
                                                                if ($mon[0]['mont'] != $livraison->totalttc) {
                                                        ?>

                                                                    <tr>
                                                                        <td hidden><?= h($livraison->id) ?></td>
                                                                        <td>Bon livraison</td>

                                                                        <td><?= h($livraison->numero) ?></td>
                                                                        <td> <?= $this->Time->format($livraison->date, 'dd/MM/y'); ?></td>
                                                                        <td><?= h($livraison->totalttc) ?></td>
                                                                        <td><?= h($montreg) ?></td>
                                                                        <td></td>

                                                                        <td>
                                                                            <?php
                                                                            echo $this->Form->control('rest', array('value' => $reste, 'index' => $i,  'id' => 'reste' . $i, 'label' => '', 'class' => 'form-control getrest number', 'readonly' => 'readonly'));
                                                                            ?>
                                                                        </td>

                                                                        <td>
                                                                            <input type="checkbox" name="data[Lignereglementclient][<?php echo $i; ?>][bonreception_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class="afficheinputmontantreglementclient2 chekreglementfac1 calculmontantt1" value="<?php echo $livraison->id ?>" mnttounssi="<?php echo $livraison->totalttc; ?>" mnt="<?php echo $reste; ?>" checked>

                                                                            <?php
                                                                            echo $this->Form->input('Montanttt', array('value' => $reste, 'style' => 'display:none;background-color: #9bc4e2; font-weight: bold;"', 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '',  'type' => 'text', 'class' => 'form-control testmontantreglementclient  chekreglementfac1 checkmaxfac1 number calculmontantt1 '));
                                                                            ?>
                                                                        </td>
                                                                        <td style="display: none;">
                                                                            <?php echo $reste; ?>
                                                                        </td>
                                                                    </tr>
                                                            <?php }
                                                            } ?>
                                                            <input type="hidden" name="max" value="<?php echo @$i; ?>" id="max"> <?php } ?>















                                                        <tr id="totalbon" style="color: #3C8DBC ; font-weight: bold;">
                                                            <td colspan="6"> Total Bonlivraisons</td>
                                                            <td colspan="3">
                                                                <input type="text" name="data[Reglementclient][ttpayer]" id="ttpayer" class="form-control" value="0.000" readonly>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>

                                         
                                                    <!-- <th><strong> Montant </strong> </th>

                                                        </tr> -->
                                                    <tr id="montantpayer" style="color:#3C8DBC; font-weight: bold;">
                                                        <td colspan="6">Montant à payer</td>
                                                        <td colspan="3">
                                                            <?php
                                                            echo $this->Form->input('Montant', array('value' => "0.000",  'name' => 'data[Reglementclient][Montant]', 'id' => 'mtotal', 'label' => '',  'type' => 'text', 'class' => 'form-control', 'readonly' => 'readonly'));
                                                            ?>
                                                            <!-- <input type="text" name="data[Reglementclient][Montant]" id="Montant" class="form-control "  value="0.000" readonly> -->

                                                        </td>
                                                    </tr>


                                                    <tr style="color:#3C8DBC; font-weight: bold;">
                                                        <td colspan="6">Ecart</td>
                                                        <td colspan="3">
                                                            <!-- <input type="checkbox" name="diff" id="diff" index="<?php echo $i; ?>" class="" value="1"> -->
                                                            <input type="checkbox" name="diff" class="reginverse" id="diff" value="0">

                                                            <input type="text" name="differance" id="difference" class="form-control difference " value="0.000" readonly>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                        </section>


                        <section class="content-header">
                            <div style="display: flex;align-items: center;justify-content: space-between; ">

                                <h1 class="box-title"><?php echo __('Mode de Réglement'); ?></h1>
                                <!-- <div>
                                                <h5>Montant Total</h1>
                                                <input id="mtotal" readonly class="form-control" type="text">
                                        </div> -->
                            </div>

                        </section>

                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box box-">
                                    <div class="box-header with-border">
                                        <a class="btn btn-primary ajouterligne  reglclientchekajoutligne checkmaxfac1 " table="addtable" index="index" tr='type' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                            <i class="fa fa-plus-circle "></i> Ajouter ligne </a>

                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                                <tr class="type" style="display: none ">
                                                    <td colspan="8" style="vertical-align: top;">
                                                        <table>
                                                            <tr>
                                                                <td>Mode de paiement </td>
                                                                <td>



                                                                    <select table="pieceregelemnt" index="" champ="paiement_id" id="paiement_id" class="modereglement2 fac  montantbrut form-control">
                                                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                        <?php foreach ($paiements as $id => $paiement) {
                                                                        ?>
                                                                            <option value="<?php echo $id; ?>"><?php echo  $paiement ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                    <?php echo $this->Form->control('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'pieceregelemnt', 'index' => '', 'type' => 'hidden', 'class' => 'form', 'label' => '')); ?>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbruta" table="piece" style="display:none" class="modecheque">Montant brut</td>
                                                                <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbrutb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                                        echo $this->Form->control('montant_brut', array('readonly', 'class' => 'form-control montantbrut', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantbrut', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant_brut]'));
                                                                                                                                                                                                        ?> </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Montant</td> <!-- mnt bl -->
                                                                <td>
                                                                    <?php
                                                                    echo $this->Form->control('montant', array('class' => 'form-control differance', 'label' => '', 'index' => 0, 'champ' => 'montant', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant]'));
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxa" table="piece" style="display:none" class="modecheque">Taux</td>
                                                                <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                        echo $this->Form->control('valeur_id', array('class' => ' form-control differance montantbrut  tauxx ', 'value' => 1, 'label' => '', 'index' => 0, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][taux]', 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                        ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantneta" table="piece" style="display:none" class="modecheque">Montant Net </td>
                                                                <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantnetb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                                    echo $this->Form->control('montant_net', array('readonly', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant_net]'));
                                                                                                                                                                                                    ?> </td>
                                                            </tr>

                                                            <tr>
                                                                <td name="data[piece][0][trechance]" id="" index="0" champ="trechancea" table="piece" style="display:none" class="modecheque">Echéance </td>
                                                                <td name="data[piece][0][trechance]" id="" index="0" champ="trechanceb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                                echo $this->Form->control('echance', array('class' => 'form-control ', 'label' => '', 'type' => 'date', 'index' => 0, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][echance]'));
                                                                                                                                                                                                ?> </td>
                                                            </tr>

                                                            <tr>
                                                                <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanquea" table="piece" style="display:none" class="modecheque">Banque </td>
                                                                <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanqueb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                            echo  $this->Form->control('banque_id', array('class' => 'form-control  getcomptes', 'options' => $banques, 'id' => 'banque_id', 'empty' => 'veuillez choisir', 'label' => '', 'index' => 0, 'champ' => 'banque_id', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][banque_id]'));
                                                                                                                                                                                            ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td name="data[piece][0][trcompte]" id="" index="0" champ="trcomptea" table="piece" style="display:none" class="modecheque">Compte</td>
                                                                <td name="data[piece][0][trcompte]" id="" index="0" champ="trcompteb" table="piece" style="display:none" class="modecheque">
                                                                    <div id="divsous" champ="divsous">

                                                                        <?php echo $this->Form->control('comptee', array(
                                                                            'div' => 'form-group',
                                                                            'between' => '<div class="col-sm-10">',
                                                                            'after' => '</div>',
                                                                            'class' => 'form-control ',
                                                                            'empty' => 'veuillez choisir',
                                                                            'label' => '',
                                                                            'index' => 0,
                                                                            'champ' => 'compte',
                                                                            'table' => 'pieceregelemnt',
                                                                            // 'value' => 6,
                                                                            'name' => 'data[pieceregelemnt][0][compte]'
                                                                        ));
                                                                        // echo $this->Form->control('compte_id', array(
                                                                        //     'div' => 'form-group',
                                                                        //     'between' => '<div class="col-sm-10">',
                                                                        //     'after' => '</div>',
                                                                        //     'class' => 'form-control    ',
                                                                        //     'empty' => 'veuillez choisir',
                                                                        //     'label' => '',
                                                                        //     'index' => 0,
                                                                        //     'champ' => 'compte_id',
                                                                        //     'table' => 'pieceregelemnt',
                                                                        //     'value' => 6,
                                                                        //     'name' => 'data[pieceregelemnt][0][compte_id]'
                                                                        // ));
                                                                        ?>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td name="data[piece][0][trendosse]" id="" index="0" champ="trendossea" table="piece" style="display:none" class="modecheque">Endossé</td>
                                                                <td name="data[piece][0][trendosse]" id="" index="0" champ="trendosseb" table="piece" style="display:none" class="modecheque">
                                                                    <div id="divsous" champ="divsous">

                                                                        <?php
                                                                        echo $this->Form->control('endosse', array(
                                                                            'div' => 'form-group',
                                                                            'between' => '<div class="col-sm-10">',
                                                                            'after' => '</div>',
                                                                            'class' => 'form-control    ',
                                                                            'empty' => 'veuillez choisir',
                                                                            'label' => '',
                                                                            'index' => 0,
                                                                            'champ' => 'endosse',
                                                                            'table' => 'pieceregelemnt',
                                                                            'name' => 'data[pieceregelemnt][0][endosse]'
                                                                        ));
                                                                        ?>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td name="data[piece][0][trnum]" id="" index="0" champ="trnuma" table="piece" style="display:none" class="modecheque">Numéro pièce </td>
                                                                <td name="data[piece][0][trnum]" id="" index="0" champ="trnumb" table="piece" style="display:none" class="modecheque">
                                                                    <div class='form-group' id="" index="0" champ="divnumc" table="piece" style="display:none">
                                                                        <label class='col-md-2 control-label'></label>
                                                                        <div class='col-sm-10' name="data[piece][0][trnum]" id="" index="0" champ="trnumc" table="piece" class="modecheque"> </div>
                                                                    </div>
                                                                    <div class='form-group' id="" index="0" champ="divnump" table="piece" style="display:none">
                                                                        <div class='col-sm-12'><?php echo $this->Form->control('num_piece', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][num_piece]')); ?></div>
                                                                    </div>
                                                                </td>

                                                            </tr>

                                                            <tr>
                                                                <td name="data[piece][0][trbanque]" id="" index="0" champ="trfaca" table="piece" style="display:none" class="modecheque">Facture </td>
                                                                <td name="data[piece][0][trbanque]" id="" index="0" champ="trfacb" table="piece" style="display:none" class="">

                                                                    <select table="pieceregelemnt" champ="fac_id" index class="form-control montttc">
                                                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                        <?php foreach ($facturesav as $f) {
                                                                        ?>
                                                                            <option value="<?php echo $f->id; ?>"><?php echo $f->numero . ' ' . $f->totalttc ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                            </tr>



                                                        </table>

                                                    </td>

                                                    <td align="center">
                                                        <i id="" index="0" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;"></i>
                                                    </td>
                                                </tr>

                                                <input type="" value="-1" id="index" hidden>
                                                </tbody>
                                            </table><br>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </section>

                    <?php } ?>



                    <!-- /.box-body -->


                </div>
                <!-- /.box -->
            </div>
        </div>
        <?php if ($client_id != null) { ?>
            <button type="submit" class="pull-right btn btn-success verifmontant desactive numeroreg" id="testpersonnel" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
        <?php } ?>
        <?php echo $this->Form->end(); ?>
    </div>
    <!-- /.row -->
</section>

<?php


$missingSerials = [];

$connection = ConnectionManager::get('default');

$typereg = $type;
$currentYear = date('Y');
$query = 'SELECT numero FROM reglementclients WHERE YEAR(reglementclients.date) = :year AND reglementclients.type =' . $typereg;
$serialNumbers = $connection->execute($query, ['year' => $currentYear])->fetchAll('assoc');


$numericSerialNumbers = array_map('intval', array_column($serialNumbers, 'numero'));


if (!empty($numericSerialNumbers)) {
    $minSerial = min($numericSerialNumbers);
    $maxSerial = max($numericSerialNumbers);


    for ($i = $minSerial + 1; $i < $maxSerial; $i++) {
        if (!in_array($i, $numericSerialNumbers)) {
            $missingSerials[] = $i;
        }
    }
}

?>
<script type="text/javascript">
    function padNumberWithZeros(number, length) {
        return String(number).padStart(length, '0');
    }

    $(function() {
        $(".numeroreg").on("click", function() {

            var missingSerialsJs = <?php echo json_encode($missingSerials); ?>;

            if (missingSerialsJs.length > 0) {
                var firstMissingSerial = missingSerialsJs[0];
                var paddedString = padNumberWithZeros(firstMissingSerial, 5);

                var confirmMessage = "Le numéro " + paddedString + " est libre. Voulez-vous l'utiliser ? Sinon, annulez pour conserver le numéro actuel.";

                if (confirm(confirmMessage)) {

                    $("#numero").prop('readonly', false)
                        .val(paddedString)
                        .prop('readonly', true);
                } else {
                    var numero = $("#numero").val();
                    alert("Numéro Réglement : " + numero);
                }
            } else {
             //   alert("Aucun numéro manquant n'est disponible.");
            }
        });
    });
</script>
<?php echo $this->Html->script('alert'); ?>
<script>
    $(document).ready(function () {
        clickinp();
    });
    $('.afficheinputmontantreglementclient2').on('click', function () {
        clickinp();
    })
    function clickinp() {
        index = $(this).attr('index');
        // alert(index)
        if ($('#facture_id0').is(':checked')) {
            $('#Montantregler0').show();
        } else {
            $('#Montantregler0').hide();
        }
    }

    $('.checkmaxfac1').on('mouseover', function () {
        function tot1() {
            ttb = Number($('#ttpayerbon').val());
            ttf = Number($('#ttpayer').val())
            $('#Montant').val((ttb + ttf).toFixed(3));
           // $('#difference').val(($('#Montant').val() - $('#mtotal').val()).toFixed(3));

        }
        function chekreglementfac1() {
            $('#ttpayer').val(0.000);
            var total = 0;
            var max = $('#max').val();

            for (var i = 0; i <= max; i++) {
                if ($('#facture_id0').is(':checked')) {
                    total += Number($('#Montantregler0').val());
                }
            }
            $('#ttpayer').val(total.toFixed(3));
        }

        tr = $(this).parent().parent().parent();
        console.log(tr);
        montantlivraison = Number(tr.find("td").eq(7).html());
        val = Number($(this).val());
        index = $(this).attr('index');


        // if (montantlivraison < val)
        //     $('#Montantregler' + index).val(montantlivraison);
        chekreglementfac1();
        tot1();




    })
    $('.calculmontantt1').on('mouseover', function () {
        ttb = Number($('#ttpayerbon').val());
        ttf = Number($('#ttpayer').val())
        $('#Montant').val((ttb + ttf).toFixed(3));
       // $('#difference').val(($('#Montant').val() - $('#mtotal').val()).toFixed(3));


    })
</script>
<script>

    function toggleCheckboxes(state) {
        var checkboxes = document.querySelectorAll('.afficheinputmontantreglementclient2.chekreglementfac1.calculmontantt1');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = state;
        });
    }


    document.getElementById('cocherTout').addEventListener('click', function(event) {
        toggleCheckboxes(false); 
        $('.afficheinputmontantreglementclient2.chekreglementfac1.calculmontantt1').click(); 
        event.preventDefault(); 
    });


    document.getElementById('decocherTout').addEventListener('click', function(event) {
        toggleCheckboxes(true); 
        $('.afficheinputmontantreglementclient2.chekreglementfac1.calculmontantt1').click(); 
        event.preventDefault();
    });
</script>
<script>
    $(function() {
        $('#diff').on('change', function() {
            // alert('aaaaaa')
            if ($(this).is(':checked')) {
                $(this).val(1); // Case cochée, valeur 1
            } else {
                $(this).val(0); // Case décochée, valeur 0
            }
        });

    
    });


    $(function() {
        $('.mnt').on('blur', function() {
            // alert("hay");
            v = $(this).attr('index'); //alert(v)//console.log(v);

            //alert("libre"+val);

            tt = 0;


            for (i = 0; i <= v; i++) {
                th = $('#montant' + i).val() || 0;
                // alert(th);
                tt = (Number(tt) + Number(th)).toFixed(3);
                //  ttpayer2=(Number(ttpayer2)-Number(th)).toFixed(3);
            }
            $('#Montant').val(Number(tt).toFixed(3));

        });
        $('#test').on('click', function() {

            ind = $(this).attr('index');
            $('#sup' + ind).val(1);
            $(this).parent().parent().hide();
            $('#btnenr').prop("disabled", false);
            v = $('#index').val();
            console.log(v);
            tt = 0;
            th = 0;
            for (i = 0; i <= v; i++) {
                if ($('#sup' + i).val() != 1) {
                    th = $('#montant' + i).val() || 0; //console.log(th);
                    tt = Number(tt) + Number(th);
                }
            }
            console.log(tt);
            $('#Montant').val(tt);
        });
        $('.modereglement2').on('change', function() {
            //alert();
            index = $(this).attr('index');
            val = $(this).val();
            //alert(val);
            typefrs = $('#typefrs').val();
            //$('#montant'+index).val('');
            nb = 0;
            // if(index!=0){
            //     for(j=0;j<=i;j++){
            //       if($('#paiement_id'+j).val()==5)  {
            //         nb++;  
            //       }
            //     }
            //     if(nb>1){
            //      $('#btnenr').prop("disabled", true);
            //        bootbox.alert('interdit de choisi le mode retenue une autre fois', function (){});
            //        return false   
            //     }else{
            //       $('#btnenr').prop("disabled", false);  
            //     }
            // }
            console.log(index);
            if (Number(val) == 1 || Number(val) == 9) {
                //alert();
                //$('#trechance'+index).attr('class','') ;

                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trnbrmoins' + index).hide();
                $('#trechancea' + index).hide();
                $('#trechanceb' + index).hide();
                $('#trbanquea' + index).hide();
                $('#trbanqueb' + index).hide();
                $('#trcomptea' + index).hide();
                $('#trcompteb' + index).hide();
                // $('#trnum'+index).attr('class','') ;

                $('#trendossea' + index).hide();
                $('#trendosseb' + index).hide();

                $('#trimg' + index).show();
                $('#trnuma' + index).hide();
                $('#trnumb' + index).hide()
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();

            } else if (Number(val) == 22) {
                // alert();
                //$('#trechance'+index).attr('class','') ;
                $('#trcomptea' + index).hide();
                $('#trcompteb' + index).hide();
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trnbrmoins' + index).hide();
                $('#trechancea' + index).hide();
                $('#trechanceb' + index).hide();
                $('#trbanquea' + index).show();
                $('#trbanqueb' + index).show();

                $('#trendossea' + index).hide();
                $('#trendosseb' + index).hide();
                // $('#trnum'+index).attr('class','') ;
                $('#trimg' + index).show();
                $('#trnuma' + index).hide();
                $('#trnumb' + index).hide()
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
            } else if (Number(val) == 2) {
                //  alert('cheque');
                $('#trcomptea' + index).show();
                $('#trcompteb' + index).show();
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trimg' + index).show();

                $('#trendossea' + index).show();
                $('#trendosseb' + index).show();

                $('#trechancea' + index).show();
                $('#trechanceb' + index).show();
                $('#trbanquea' + index).show();
                $('#trbanqueb' + index).show();
                $('#banque_idb' + index).hide(); // modifiction amin  
                $('#banque_ida' + index).hide(); // modifiction amin   
                $('#trnuma' + index).show();
                $('#trnumb' + index).show();
                //ajouter select carnet trnumb0
                $('#trcarnetnuma' + index).show();
                $('#trcarnetnumb' + index).show();
                $('#divnumc' + index).show();

                $('#divnump' + index).show();

            } else if (Number(val) == 5) {
                $('#pop').html('');
                $('#trimg' + index).show();
                $('#trmontantbruta' + index).show();
                $('#trmontantbrutb' + index).show();
                $('#trmontantneta' + index).show();
                $('#trmontantnetb' + index).show();
                $('#trtauxa' + index).show();
                $('#trtauxb' + index).show();
                $('#trcomptea' + index).hide();
                $('#trcompteb' + index).hide();
                $('#trnbrmoins' + index).hide();
                $('#trechancea' + index).hide();
                $('#trechanceb' + index).hide();
                $('#trbanquea' + index).hide();
                $('#trbanqueb' + index).hide();

                $('#trendossea' + index).hide();
                $('#trendosseb' + index).hide();
                // $('#trnum'+index).attr('class','') ;
                $('#trnuma' + index).show();
                $('#trnumb' + index).show();
                $('#divnump' + index).show();
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide();
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
                ttpayer = $('#ttpayer').val();
                $('#montantbrut' + index).val(ttpayer);
            } else if (Number(val) == 54) {
                $('#pop').html('');
                $('#trimg' + index).show();
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trnbrmoins' + index).hide();
                $('#trechancea' + index).hide();
                $('#trechanceb' + index).hide();
                $('#trbanquea' + index).show();
                $('#trbanqueb' + index).show();

                $('#trendossea' + index).hide();
                $('#trendosseb' + index).hide();
                $('#trcomptea' + index).hide();
                $('#trcompteb' + index).hide();
                // $('#trnum'+index).attr('class','') ;
                $('#trnuma' + index).hide();
                $('#trnumb' + index).hide();
                $('#divnump' + index).hide();
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide();
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
                ttpayer = $('#ttpayer').val();
                $('#montantbrut' + index).val(ttpayer);

            } else {
                //  alert('aa');
                //$('#pop').html('');
                if (typefrs != 1) {
                    if ((Number(val) == 4) || (Number(val) == 6)) {
                        $('#tablepaiement' + index).show();
                        $('#tr_regle_fournisseur' + index).show();
                    }
                }
                $('#trimg' + index).show();
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                //******************
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
                $('#divnumc' + index).hide();
                $('#trechancea' + index).show();
                $('#trechanceb' + index).show();
                $('#trbanquea' + index).show();
                $('#trbanqueb' + index).show();

                $('#trcomptea' + index).hide();
                $('#trcompteb' + index).hide();
                $('#banque_idb' + index).show(); // modifiction amin
                $('#banque_ida' + index).show(); // modifiction amin
                //$('#trechance'+index).attr('class','display:none') ;
                $('#trnuma' + index).show();
                $('#trnumb' + index).show();

                $('#divnump' + index).show();
                //$('#trnum'+index).attr('class','display:none') ;  
            }

            if (Number(val) == 7 || Number(val) == 6) {
                //alert('aa');
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trechancea' + index).hide();
                $('#trechanceb' + index).hide();
                $('#trbanquea' + index).hide();
                $('#trbanqueb' + index).hide();

                $('#trendossea' + index).hide();
                $('#trendosseb' + index).hide();
                $('#trnbrmoins' + index).show();
                $('#trnuma' + index).hide();
                $('#trnumb' + index).hide()
                $('#banque' + index).hide()
                $('#trcomptea' + index).hide();
                $('#trcompteb' + index).hide();
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();

            }

            if (Number(val) == 8) {
                facture()
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trechancea' + index).hide();
                $('#trechanceb' + index).hide();
                $('#trbanquea' + index).hide();
                $('#trbanqueb' + index).hide();

                $('#trendossea' + index).hide();
                $('#trendosseb' + index).hide();
                $('#trfaca' + index).show();
                $('#trfacb' + index).show();
                $('#trcomptea' + index).hide();
                $('#trcompteb' + index).hide();

                $('#trnbrmoins' + index).show();
                $('#trnuma' + index).hide();
                $('#trnumb' + index).hide()
                $('#banque' + index).hide()

                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
            }
            // if (Number(val) == 9) {
            //     facture()
            //     $('#trmontantbruta' + index).hide();
            //     $('#trmontantbrutb' + index).hide();
            //     $('#trmontantneta' + index).hide();
            //     $('#trmontantnetb' + index).hide();
            //     $('#trtauxa' + index).hide();
            //     $('#trtauxb' + index).hide();
            //     $('#trechancea' + index).hide();
            //     $('#trechanceb' + index).hide();
            //     $('#trbanquea' + index).hide();


            //     $('#trendossea' + index).hide();
            //     $('#trendosseb' + index).hide();  

            //     $('#trbanqueb' + index).hide();
            //     $('#trcomptea' + index).hide();
            //     $('#trcompteb' + index).hide();
            //     $('#trfaca' + index).show();
            //     $('#trfacb' + index).show();


            //     $('#trnbrmoins' + index).show();
            //     $('#trnuma' + index).hide();
            //     $('#trnumb' + index).hide()
            //     $('#banque' + index).hide()

            //     $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
            //     $('#banque_ida' + index).hide(); // modifiction amin
            //     $('#trcarnetnuma' + index).hide();
            //     $('#trcarnetnumb' + index).hide();
            // }




        });

        function facture() {
            ///alert('hechem')
            ind = $(this).attr('index'); //alert(ind)
            /// alert(ind)
            client = $('#client_id').val(); //alert(client)
            id = $('#paiement_id' + ind).val();

            //alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Reglementclients', 'action' => 'getFac']) ?>",
                dataType: "json",
                data: {
                    client: client,
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {

                    ////    alert(data.select)

                    $('#fac_id' + ind).html(data.select);

                }

            })
        }


        $('.montttc').on('change', function() {

            i = $(this).attr('index');

            //// alert(i)

            fac = $("#fac_id" + i + " option:selected").text();
            ///alert(fac)
            parts = fac.split('-');
            value = parts[1].trim();
            $('#montant' + i).val(value);

            val = $('#montant' + i).val();
            //alert(val)


            total = 0;
            index = $('#index').val();

            for (j = 0; j <= index; j++) {

                total = Number($('#montant' + j).val()) + total


            }



            diff = Number($('#ttpayer').val()) - Number(total)
            //alert(diff)



            $('#mtotal').val(Number(total).toFixed(3));
           // $('#difference').val(Number(diff).toFixed(3));




        })







        // $('.montantbrut').on('keyup change', function() {
        //     // alert('hhh')
        //     index = $('#index').val();
        //     max = $('#max').val();
        //     variable1 = 0;
        //     for (i = 0; i <= max; i++) {
        //         if ($('#factureclient_id' + i).is(':checked')) {
        //             variable1 = Number($('#Montantregler' + i).val()) + variable1
        //         }
        //     }
        //     montantbrut = $('#montantbrut' + index).val(variable1) || 0;
        //     //alert(montantbrut);
        //     t = $('#taux' + index).val() || 0; //alert(t);
        //     //  alert(t);
        //     if (t == '1') {
        //         taux = 1.5
        //     };
        //     if (t == '4') {
        //         taux = 5
        //     };
        //     if (t == '3') {
        //         taux = 15
        //     };
        //     if (t == '5') {
        //         taux = 10
        //     };
        //     if (t == '6') {
        //         taux = 3
        //     };
        //     if (t == '7') {
        //         taux = 7
        //     };
        //     if (t == '8') {
        //         taux = 1
        //     };
        //     //alert(taux);
        //     retenue = (montantbrut * (taux / 100)).toFixed(3);
        //     $('#montantnet' + index).val(retenue);

        //     // net=(montantbrut-retenue).toFixed(3);
        //     // $('#montantnet'+index).val(net);
        //     // $('#netapayer').val(net);
        //     v = $('#index').val(); //alert(v)//console.log(v);
        //     tt = 0;
        //     th = 0;
        //     i = 0;
        //     //for(i=0;i<=v;i++){
        //     while ($('#montant' + i).val() != undefined) {
        //         th = $('#montant' + i).val() || 0; //console.log(th);
        //         tt = Number(tt) + Number(th);
        //         i++;
        //     }
        //     // ttt=Number(tt)+Number(retenue);
        //     // console.log(tt);
        //     $('#Montant').val((tt).toFixed(3));

        // });


        $('.montantbrut').on('keyup change', function() {
            index = $(this).attr('index');
            montantbrut = $('#montantbrut' + index).val() || 0;
            // alert(montantbrut);
            t = $('#taux' + index).val() || 0;
            //  alert(t);
            // if (t == '1') {
            //     taux = 1.5
            // };
            // if (t == '4') {
            //     taux = 5
            // };
            // if (t == '3') {
            //     taux = 15
            // };
            // if (t == '5') {
            //     taux = 10
            // };
            // if (t == '6') {
            //     taux = 3
            // };
            // if (t == '7') {
            //     taux = 7
            // };
            // if (t == '8') {
            //     taux = 1
            // };
            //alert(taux);
            retenue = (montantbrut * (t / 100)).toFixed(3);
            $('#montant' + index).val(retenue);
            // $('#Montant').val(retenue);
            net = (montantbrut - retenue).toFixed(3);
            $('#montantnet' + index).val(net);
            $('#netapayer').val(net);
            v = $('#index').val(); //alert(v)//console.log(v);
            tt = 0;
            th = 0;
            i = 0;
            //for(i=0;i<=v;i++){
            while ($('#montant' + i).val() != undefined) {
                th = $('#montant' + i).val() || 0; //console.log(th);
                tt = Number(tt) + Number(th);
                i++;
            }
            // ttt=Number(tt)+Number(retenue);
            //    console.log(tt);
            $('#Montant').val((tt).toFixed(3));
            //alert('hhhh');
            total = $('#ttpayer').val();
            max = $('#index').val();
            /*  sup = $('#sup'+index).val(); */
            variable1 = 0;


            for (i = 0; i <= max; i++) {
                if ($('#sup' + i).val() != 1)
                    variable1 += Number($('#montant' + i).val());

            }

            $('#mtotal').val(variable1.toFixed(3));
            //$('#difference').val((Number(total) - Number(variable1)).toFixed(3));

        });
    });
</script>
<script>
    // $('.chekreglement').on('click', function() {

    //     ind = $(this).attr('index');
    //     ttpay = 0
    //     max = $('#max').val();
    //     piece = $('#inputlibre' + ind).val();


    //     for (i = 0; i <= max; i++) {

    //         if ($('#factureclient_id' + i).is(':checked')) {
    //             v = $('#inputlibre' + i).show().val();

    //             ttpay = Number(ttpay) + Number(v)
    //             $('#ttpayer').val(Number(ttpay).toFixed(3));

    //         } else {
    //             $('#inputlibre' + i).attr('style', "display:none;");
    //             test = 0
    //         }
    //     }

    // })

    // $('#inputlibre').on('keyup', function() {

    //     ind = $(this).attr('index');
    //     ttpay = 0
    //     max = $('#max').val();

    //     for (i = 0; i <= max; i++) {


    //         v = $('#inputlibre' + i).show().val();
    //         ttpay = Number(ttpay) + Number(v)
    //         $('#ttpayer').val(Number(ttpay).toFixed(3));


    //     }

    // })






























    //     $('.chekreglementbon').on('click',function(){
    //     ind= $(this).attr('index'); 
    //       max= $('#maxbon').val();
    //       //alert(max);
    //       typefrs= $('#typefrs').val();
    //      //alert(typefrs);
    //      ttbl=0;
    //      ttdv=0;
    //      remise=0;
    //      testt=false;
    //      ttounsi=0;
    //     imp= $(this).attr('importation');
    //     ind= $(this).attr('index');
    //    //alert(ind);
    //     testimp=0;
    //     for(i=0;i<=max;i++){
    //       if($('#bonreception_id'+i).is(':checked')){ 
    //           //alert(i);
    //           //alert($('#facture_id'+i).attr('importation'));
    //               if($('#bonreception_id'+i).attr('importation')!=imp){
    //                   testimp=8;
    //                   id=i;
    //               }
    //       }elseif()
    // 	    //zeinab
    // 	compte= $(this).attr('compte')||0;
    // 	if(compte!=0){
    // 	 index=$('#index').val();
    //          //alret(index)
    // 	 if($('#bonreception_id'+i).is(':checked')){ 
    // 	 typefrs=$('#typefrs').val();
    //      i= $(this).attr('index');
    // 	 nom_compte= $('#NonCompte'+i).val(); 
    // 	 if(typefrs !=1){
    //         $('#tablepaiement'+index).show();
    //         $('#tr_regle_fournisseur'+index).show();

    //        $('#trmontantbruta'+index).hide() ;
    //        $('#trmontantbrutb'+index).hide() ;
    //        $('#trmontantneta'+index).hide() ;
    //        $('#trmontantnetb'+index).hide() ;
    //        $('#trtauxa'+index).hide() ;
    //        $('#trtauxb'+index).hide() ;
    //            //******************
    //        $('#trcarnetnuma'+index).hide() ;
    //        $('#trcarnetnumb'+index).hide() ;
    //        $('#divnumc'+index).hide() ;
    //        $('#trechancea'+index).show();
    //        $('#trechanceb'+index).show();
    //        $('#trbanquea'+index).show();

    //        $('#trbanqueb'+index).show();

    //        $('#banque_idb'+index).show() ;         
    //        $('#banque_ida'+index).show() ;         
    //        $('#trnuma'+index).show() ;
    //        $('#trnumb'+index).show() ;
    //        $('#divnump'+index).show() ;
    // 	  //alert(compte);
    // 	   $.ajax({
    //             type: "POST",
    //             data: {
    //                 compte_id: compte,
    // 				ind: index,

    //             },
    //             url: wr+"Reglements/compte/",
    //              dataType : "json",
    //              global : false //}l'envoie'
    //       }).done(function(data){ 
    // 	          console.log(data.select);
    //               $('#compte_id'+index).parent().html(data.select);
    //                uniform_select('compte_id'+index);


    //      })  

    // 	}


    // 	 }else{
    // 		   compt='';
    // 		  $.ajax({
    //             type: "POST",
    //             data: {
    //                 compte_id: compt,
    // 				ind: index,

    //             },
    //             url: wr+"Reglements/compte/",
    //              dataType : "json",
    //              global : false //}l'envoie'
    //       }).done(function(data){ 
    // 	          console.log(data.select);
    //               $('#compte_id'+index).parent().html(data.select);
    //                uniform_select('compte_id'+index);


    //      })  
    //       }	
    //   }


    // 	  //**********
    //     } 
    //     //alert(testimp);
    //     if(testimp==8){
    //                //$('#facture_id'+id).prop('checked', false); 
    //                bootbox.alert('cette fature sur une importation diff�rente', function (){});
    //                return false
    //     } 
    //     for(i=0;i<=max;i++){
    //       if($('#bonreception_id'+i).is(':checked')){//alert();
    //           testt=true;
    //           ttbl=Number($('#bonreception_id'+i).attr('mnt'))+Number(ttbl);
    //           ttounsi=Number($('#bonreception_id'+i).attr('mnttounssi'))+Number(ttounsi);
    //           if(typefrs !=1){
    //           ttdv=Number($('#devise'+i).val())+Number(ttdv);
    //           }
    //         $('#importation_id'+i).prop('checked', true);   
    //       }else{
    //        $('#importation_id'+i).prop('checked', false);   
    //       }
    //     }
    //    if (testt===true){
    //        $('#tc'+ind).attr('readonly', false);
    //        $('#btnenr').prop("disabled", false);
    //    } else {
    //        $('#tc'+ind).attr('readonly', true);
    //        $('#btnenr').prop("disabled", true);
    //    }
    //    ttpayer=Number(ttbl);
    //    $('#ttpayerbon').val((ttpayer).toFixed(3));
    //    $('#netpayer').val((ttpayer).toFixed(3));

    //    if(typefrs !=1){
    //    //tc = $('#tc').val()||0;
    //    ///montantachat = $('#montantachat').val()||0;
    //    //mpayer=Number(tc)*Number(montantachat);    
    //    //$('#ttpayer').val((mpayer).toFixed(3));
    //    //$('#netpayer').val((mpayer).toFixed(3));    
    //    //$('#Montant').val((mpayer).toFixed(3));
    //    //$('#montantdevise0').val((ttdv).toFixed(2));
    //    //$('#prixachattounssi').val((ttounsi).toFixed(2));
    //    //$('#montant0').val((ttpayer).toFixed(2));
    //    //$('#montant0').attr('readonly', true);
    //    calculetotalecredit();
    //    }
    //    v=$('#index').val();
    //    index=0;
    //    test=0;
    //    for(j=0;j<=v;j++){
    //    if($('#paiement_id'+j).val()==5)  {
    //          index=j;
    //          test=1;
    //    }   
    //    }
    //    if(test==1){
    //        //alert("d5Al");
    //        facmontantbrut(index);
    //    }

    // });
    $( /*'.chekreglement'*/ ).on('click', function() {


        max = $('#max').val();
        maxav = $('#maxav').val();
        typefrs = $('#typefrs').val();
        // alert(typefrs);
        ttbl = 0;
        ttdv = 0;
        remise = 0;
        testt = false;
        ttounsi = 0;
        imp = $(this).attr('importation');
        ind = $(this).attr('index');
        //alert(imp);
        testimp = 0;
        for (i = 0; i <= max; i++) {

            if ($('#factureclient_id' + i).is(':checked')) {
                $('#inputlibre' + i).show();
                if ($('#factureclient_id' + i).attr('importation') != imp) {
                    testimp = 8;
                    id = i;
                }
            } else {
                $('#inputlibre' + i).attr('style', "display:none;");
            }
            //zeinab
            compte = $(this).attr('compte') || 0;
            if (compte != 0) {
                index = $('#index').val();
                if ($('#facture_id' + i).is(':checked')) {
                    typefrs = $('#typefrs').val();
                    i = $(this).attr('index');
                    nom_compte = $('#NonCompte' + i).val();
                    if (typefrs != 1) {
                        $('#tablepaiement' + index).show();
                        $('#tr_regle_fournisseur' + index).show();
                        $('#trmontantbruta' + index).hide();
                        $('#trmontantbrutb' + index).hide();
                        $('#trmontantneta' + index).hide();
                        $('#trmontantnetb' + index).hide();
                        $('#trtauxa' + index).hide();
                        $('#trtauxb' + index).hide();
                        //******************
                        $('#trcarnetnuma' + index).hide();
                        $('#trcarnetnumb' + index).hide();
                        $('#divnumc' + index).hide();
                        $('#trechancea' + index).show();
                        $('#trechanceb' + index).show();
                        $('#trbanquea' + index).show();
                        $('#trcomptea' + index).show();
                        $('#trcompteb' + index).show();
                        $('#trbanqueb' + index).show();

                        $('#banque_idb' + index).show();
                        $('#banque_ida' + index).show();
                        $('#trnuma' + index).show();
                        $('#trnumb' + index).show();
                        $('#divnump' + index).show();
                        //alert(compte);
                        $.ajax({
                            type: "POST",
                            data: {
                                compte_id: compte,
                                ind: index,

                            },
                            url: wr + "Reglements/compte/",
                            dataType: "json",
                            global: false //}l'envoie'
                        }).done(function(data) {
                            console.log(data.select);
                            $('#compte_id' + index).parent().html(data.select);
                            uniform_select('compte_id' + index);
                        })

                    }


                } else {
                    compt = '';
                    $.ajax({
                        type: "POST",
                        data: {
                            compte_id: compt,
                            ind: index,

                        },
                        url: wr + "Reglements/compte/",
                        dataType: "json",
                        global: false //}l'envoie'
                    }).done(function(data) {
                        console.log(data.select);
                        $('#compte_id' + index).parent().html(data.select);
                        uniform_select('compte_id' + index);
                    })
                }
            }


            //**********
        }
        //alert(testimp);

        for (i = 0; i <= max; i++) {
            if ($('#facture_id' + i).is(':checked')) { //alert();
                testt = true;
                ttbl = Number($('#facture_id' + i).attr('mnt')) + Number(ttbl);
                ttounsi = Number($('#facture_id' + i).attr('mnttounssi')) + Number(ttounsi);
                if (typefrs != 1) {
                    ttdv = Number($('#devise' + i).val()) + Number(ttdv);
                }
                $('#importation_id' + i).prop('checked', true);
            } else {
                $('#importation_id' + i).prop('checked', false);
            }
        }
        for (i = 0; i <= maxav; i++) {
            if ($('#factureavoirfr_id' + i).is(':checked')) { //alert();
                testt = true;
                ttbl = Number(ttbl) - Number($('#factureavoirfr_id' + i).attr('mnt'));
                ttounsi = Number($('#factureavoirfr_id' + i).attr('mnttounssi')) + Number(ttounsi);
                if (typefrs != 1) {
                    ttdv = Number($('#devise' + i).val()) + Number(ttdv);
                }
                $('#importation_id' + i).prop('checked', true);
            } else {
                $('#importation_id' + i).prop('checked', false);
            }
        }
        //    if(testimp==8){
        //               //$('#facture_id'+id).prop('checked', false);
        //               bootbox.alert('cette fature sur une importation diff?rente', function (){});
        //               return false
        //    }
        if (testt === true) {
            $('#tc' + ind).attr('readonly', false);
            $('#btnenr').prop("disabled", false);
        } else {
            $('#tc' + ind).attr('readonly', true);
            $('#btnenr').prop("disabled", true);
        }
        ttpayer = Number(ttbl);
        $('#ttpayer').val((ttpayer).toFixed(3));
        $('#netpayer').val((ttpayer).toFixed(3));
        if (typefrs != 1) {
            //tc = $('#tc').val()||0;
            ///montantachat = $('#montantachat').val()||0;
            //mpayer=Number(tc)*Number(montantachat);
            //$('#ttpayer').val((mpayer).toFixed(3));
            //$('#netpayer').val((mpayer).toFixed(3));
            //$('#Montant').val((mpayer).toFixed(3));
            //$('#montantdevise0').val((ttdv).toFixed(2));
            //$('#prixachattounssi').val((ttounsi).toFixed(2));
            //$('#montant0').val((ttpayer).toFixed(2));
            //$('#montant0').attr('readonly', true);
            calculetotalecredit();
        }
        v = $('#index').val();
        index = 0;
        test = 0;
        for (j = 0; j <= v; j++) {
            if ($('#paiement_id' + j).val() == 5) {
                index = j;
                test = 1;
            }
        }
        if (test == 1) {
            //alert("d5Al");
            facmontantbrut(index);
        }
    });
    //
    //  $('.ajouterligne_ww').on('click', function() {
    //    table = $(this).attr('table');
    //  //  alert(table);
    //    index = $(this).attr('index');
    //    //alert(index);
    //    ajouter_lignee(table, index);
    //  });
    $(".ajouterligne").on('click', function() {
        table = $(this).attr('table'); //id table
        index = $(this).attr('index'); // id max compteur
        tr = $(this).attr('tr'); //class class type
        ind = Number($('#' + index).val()) + 1;
        $ttr = $('#' + table).find('.' + tr).clone(true);
        $ttr.attr('class', 'cc'); //amin
        i = 0;
        tabb = [];
        //alert(ind);
        $ttr.find('a,input,select,div,td,textarea,tr,table,i,select2').each(function() {

            tab = $(this).attr('table');
            champ = $(this).attr('champ');
            if (champ != "trstituation") {
                $(this).attr('index', ind);
                $(this).attr('id', champ + ind);
                $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
                $(this).removeClass('anc');
                if ($(this).is('select')) {
                    if (champ != "etatpiecereglement_id") {
                        tabb[i] = champ + ind;
                        // alert(tabb[i]);
                        //----------- Amin
                        i = Number(i) + 1;
                    }
                    if (champ == 'matierepremiere_id') {
                        nompage = $('.nompage').val();
                        four = $('#' + nompage + 'FournisseurId').val() || 0;
                        $(this).attr('onchange', 'cal_prix(' + four + ',' + ind + ')');
                    }
                    if (champ == 'bouttonajoutlignepetit') {
                        $(this).attr('index', ind);
                    }
                    // ----------
                }
                //  $(this).val('');

            }
        })
        $ttr.find('i').each(function() {
            $(this).attr('index', ind);
        }); //alert();console.log($ttr);
        //alert(table);
        // console.log($ttr);
        //console.log($('#'+table).find('tr:last'));
        $ttr.attr('style', '');
        $('#' + table).append($ttr);
        $('#' + index).val(ind);
        //        $('#echance'+ind).datetimepicker({
        //        timepicker: false,
        //        datepicker:true,
        //        mask:'39/19/9999',
        //        format:'d/m/Y'
        //    });
        $('#' + table).find('tr:last').show();
        //// alert(ind)
        // $("#paiement_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        $("#banque_id" + ind).select2({
            width: '100%' // need to override the changed default
        });
        // $("#valeur_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        // $('#'+table).find('tr:last').attr('style','');
        //		for(j=0;j<=i;j++){
        //		uniform_select(tabb[j]);
        //		}
        $('.trstituation').hide();

        //});
        //    alert('ffffffffffffff')

    });
</script>

<script>
    function calculetotalecredit(index) {
        //alert();
        //index=$('#index').val();
        nbrtr = $('#nbrtr' + index).val();
        montant = $('#montant').val() || 0;
        //alert(montant);
        test = 0;
        tt = 0;
        for (j = 1; j <= nbrtr; j++) {
            th = $('#' + index + 'montantcredit' + j).val() || 0;
            tt = (Number(tt) + Number(th)).toFixed(3);
            if (Number(tt) > Number(montant)) {
                $('#' + index + 'montantcredit' + j).val("");
                test = 1;
            }
        }
        //alert(tt);
        if (test == 1) {
            bootbox.alert('V�rifier le montant', function() {});
            return false
        } else {
            $('#' + index + 'total').val(tt);
        }
        //agio = Number(Number(tt) - Number(montant)).toFixed(3);
        //$('#' + index + 'agio').val(agio);

    }
</script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>
<?php $this->end(); ?>


<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-d    a        t              epicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(function() {

        //Initialize Select2 Elements
        $('.select2').select2()
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()
        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: ' MM/DD/YYYY h:mm A'
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })
        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()
        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>
<?php $this->end(); ?>

<script>
    $('.afficherancienclient').on('click', function() {
        //    alert("tt");
        //        if ($('#non').is(':checked')) { //alert('non is checked');
        //            $('#afficher').attr('style', "display:true;");
        //        } else
        if ($('#oui').is(':checked')) {
            alert("true is checked");
            $('#afficher').attr('style', "display:none;");
        }

    });


    $('.desactive').on('click', function() {
        $('#testpersonnel').hide();
    });
</script>