<?php
error_reporting(E_ERROR | E_PARSE);

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reglementclient $reglementclient
 * @var string[]|\Cake\Collection\CollectionInterface $utilisateurs
 */
?>
<?php

use Cake\Datasource\ConnectionManager;
?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('mariem'); ?>
<section class="content-header">
    <h1>
        Réglement Clients
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'vieww/' . $project_id]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <?= $this->Form->create($reglement) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('numeroconca', ['label' => 'Numero', 'readonly' => 'readonly']);
                            ?></div>

                        <div class="col-xs-6">
                            <?php
                            //dd($reglement);
                            echo $this->Form->control('Date', ['empty' => true, 'readonly' => 'readonly', 'value' => $reglement->Date, 'class' => 'form-control', 'id' => 'date']);

                            ?></div>

                        <div class="col-xs-6">
                            <div class="form-group input select required">
                                <label class="control-label" for="client_id">Clients</label>
                                <select name="client_id" id="client_id" style="pointer-events: none;" readonly class="form-control readonly control-label clientreglement" value='<?php $this->request->getQuery('client_id') ?>'>
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                    <?php foreach ($clients as $id => $client) { ?>
                                        <option <?php if ($cli == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>" disabled><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php if ($cli != 0) { ?>
                        <section class="content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th><strong> Facture </strong>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td>N° Facture</td>
                                                        <td>Date</td>
                                                        <td>Total TTC</td>
                                                        <td>Montant réglé</td>
                                                        <td>Reste</td>
                                                        <td></td>
                                                    </tr>
                                                    <?php
                                                    if (!empty($factures)) {
                                                        $i = -1;
                                                        foreach ($factures as $fac) {
                                                            $i++;
                                                            foreach ($lignesreg as $r => $lignesre) {
                                                                $connection = ConnectionManager::get('default');
                                                                $mon = $connection->execute("select montantregler(" . $fac->id . " ) as mont")->fetchAll('assoc');
                                                                $lig = $connection->execute('SELECT * FROM lignereglementclients WHERE  lignereglementclients.reglementclient_id = ' . $id . ' AND lignereglementclients.factureclient_id=' . $fac['id'] . ';')->fetchAll('assoc');
                                                                if ($lig) {
                                                                    $style = "display:yesy";
                                                                } else {
                                                                    $style = "display:none";
                                                                }
                                                                if ($mon[0]['mont'] == null) {
                                                                    $montreg = 0;
                                                                } else {
                                                                    $montreg = $mon[0]['mont'] - $lig[0]['Montant'];
                                                                }
                                                                $reste = $fac->totalttc - $montreg;
                                                    ?>
                                                                <tr>
                                                                    <td><?= h($fac->numero) ?></td>
                                                                    <td><?= h($fac->date) ?></td>
                                                                    <td><?= h($fac->totalttc) ?></td>
                                                                    <td><?= h($montreg) ?></td>
                                                                    <td><?= $reste ?></td>
                                                                    <td>
                                                                        <?php if ($lignesre->factureclient_id == $fac->id) { ?>
                                                                            <input hidden type="checkbox" checked name="data[Lignereglementclient][<?php echo $i; ?>][factureclient_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt chekreglementfacachat calculereglementclient afficheinputmontantreglementclient" value="<?php echo $fac->id ?>" mnttounssi="<?php echo $fac->ttc; ?>" mnt="<?php echo $reste; ?>">
                                                                            <?php
                                                                            echo $lignesre->Montant;
                                                                            echo @$this->Form->input('Montanttt', array('type' => 'hidden', 'readonly' => true, 'value' => $lignesre->Montant, 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '',  'class' => 'form-control testmontantreglementclient  testmontantreglementclient1 checkmaxfa calculto  calculmontantt number'));

                                                                            ?>
                                                                        <?php } else {
                                                                        ?>
                                                                            <input type="checkbox" name="data[Lignereglementclient][<?php echo $i; ?>][factureclient_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt chekreglementfacachat  calculereglementclient afficheinputmontantreglementclient" value="<?php echo $fac->id ?>" mnttounssi="<?php echo $fac->ttc; ?>" mnt="<?php echo $reste; ?>">
                                                                            <?php
                                                                            echo @$this->Form->input('Montanttt', array('readonly' => true, 'value' => '', 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '', 'type' => 'text', 'class' => 'form-control testmontantreglementclient checkmaxfa calculto  testmontantreglementclient1 calculmontantt number'));

                                                                            ?>
                                                                        <?php } ?>


                                                                    </td>
                                                                </tr>
                                                    <?php }
                                                        }
                                                    } ?>
                                                    <input type="hidden" name="max" value="<?php echo @$i; ?>" id="max">
                                                    <tr id="totalefacture">
                                                        <td colspan="5"> Total factures</td>
                                                        <td colspan="3">
                                                            <?php echo $mtfact; ?>
                                                            <!-- <input type="number" name="data[Reglementclient][ttpayer]" id="ttpayer" class="form-control" value="<?php echo $mtfact; ?>" readonly> -->
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <!-- <th><strong> Montant </strong> </th> -->

                                                    </tr>
                                                    <tr id="montantpayer">
                                                        <td colspan="5">Montant à payer</td>
                                                        <td colspan="3">
                                                            <?php echo $reglement->Montant; ?>
                                                            <!-- <input type="number" name="data[Reglementclient][Montant]" id="Montant" class="form-control " value="<?php echo $reglement->Montant; ?>" readonly> -->
                                                        </td>
                                                    </tr>
                                                    <tr hidden>
                                                        <td colspan="5">Differance echange</td>
                                                        <td colspan="3">
                                                            <input type="number" name="data[Reglementclient][differance]" id="difference" class="form-control " value="0.000" readonly>
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
                            <h1 class="box-title"><?php echo __('Mode de Réglement'); ?></h1>
                        </section>
                        <section class="content" style="width: 99%">
                            <div class="row">

                                <div class="box box-primary">
                                    <div class="box box-">

                                        <div class="panel-body">
                                            <div class="table-responsive ls-table">
                                                <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                                    <?php $read = "";
                                                    $i = -1;
                                                    foreach ($piecereglementclients as $i => $piece) {
                                                        $i++;
                                                    ?>
                                                        <thead>
                                                            <th>Mode de paiement</th>
                                                            <th>Montant</th>
                                                            <th>Banque</th>
                                                            <th>Date</th>

                                                        </thead>
                                                        <tbody>

                                                            <td><?php echo $piece->paiement->name; ?></td>
                                                            <td><?php echo $piece->montant; ?></td>
                                                            <td><?php echo $piece->banque->name; ?></td>
                                                            <td><?php echo $piece->echance; ?></td>
                                                        </tbody>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section hidden class="content" style="width: 99%">
                            <div class="row">

                                <div class="box box-primary">
                                    <div class="box box-">
                                        <!-- <div class="box-header with-border">
                                            <a class="btn btn-primary ajouterligne  reglclientchekajoutligne " table="addtable" index="index" tr='type' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                                <i class="fa fa-plus-circle "></i> Ajouter ligne</a>
                                        </div> -->
                                        <div class="panel-body">
                                            <div class="table-responsive ls-table">
                                                <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                                    <tr class="type" style="display: none ">
                                                        <td colspan="8" style="vertical-align: top;">
                                                            <table>
                                                                <tr>
                                                                    <td>Mode règlement </td>
                                                                    <td>
                                                                        <select table="pieceregelemnt" index="" champ="paiement_id" class="modereglement2 form-control select selectized">
                                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                                            <?php foreach ($paiements as $id => $paiement) {
                                                                            ?>
                                                                                <option value="<?php echo $id; ?>"><?php echo $paiement ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <?php
                                                                        // echo $this->Form->input('paiement_id',array('empty'=>'choix','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control modereglement  ',
                                                                        // 'empty'=>'veuillez choisir',
                                                                        // 'label'=>'','index'=>0,'champ'=>'paiement_id','table'=>'pieceregelemnt','name'=>'data[pieceregelemnt][0][paiement_id]') );   
                                                                        ?>
                                                                        <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'pieceregelemnt', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form', 'label' => '')); ?>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbruta" table="piece" style="display:none" class="modecheque">Montant brut</td>
                                                                    <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbrutb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                                            //echo $this->Form->input('montant_brut',array('div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control montantbrut','label'=>'','type'=>'text','index'=>0,'champ'=>'montantbrut','table'=>'pieceregelemnt','name'=>'data[pieceregelemnt][0][montant_brut]') );   
                                                                                                                                                                                                            ?> </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Montant</td>
                                                                    <td><?php
                                                                        echo $this->Form->input('montant', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control calculdiff  testmontantreglementachat differance mnt bl ', 'label' => '', 'index' => 0, 'champ' => 'montant', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant]'));
                                                                        ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxa" table="piece" style="display:none" class="modecheque">Taux</td>
                                                                    <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                            echo $this->Form->input('valeur_id', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => ' form-control montantbrut', 'label' => '', 'index' => 0, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][taux]', 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                            ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantneta" table="piece" style="display:none" class="modecheque">Montant Net </td>
                                                                    <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantnetb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                                        echo $this->Form->input('montant_net', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montantnet]'));
                                                                                                                                                                                                        ?> </td>
                                                                </tr>

                                                                <tr>
                                                                    <td name="data[piece][0][trechance]" id="" index="0" champ="trechancea" table="piece" style="display:none" class="modecheque">Echéance </td>
                                                                    <td name="data[piece][0][trechance]" id="" index="0" champ="trechanceb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                                    echo $this->Form->input('echance', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'date', 'index' => 0, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][echance]'));
                                                                                                                                                                                                    ?> </td>
                                                                </tr>

                                                                <!-- <tr><td name="data[piece][0][trcarnetnum]" id="" index="0"  champ="trcarnetnuma" table="piece"  style="display:none" class="modecheque" >Numéro de carnet </td>  
                                                <td  name="data[piece][0][trcarnetnum]" id="" index="0"  champ="trcarnetnumb" table="piece"  style="display:none" class="modecheque"><?php
                                                                                                                                                                                        echo $this->Form->input(
                                                                                                                                                                                            'carnetcheque_id',
                                                                                                                                                                                            array(
                                                                                                                                                                                                'div' => 'form-group',
                                                                                                                                                                                                'between' => '<div class="col-sm-10">',
                                                                                                                                                                                                'after' => '</div>',
                                                                                                                                                                                                'class' => 'form-control  getnumcheque  ',
                                                                                                                                                                                                'empty' => 'veuillez choisir',
                                                                                                                                                                                                'label' => '',
                                                                                                                                                                                                'index' => 0,
                                                                                                                                                                                                'champ' => 'carnetcheque_id',
                                                                                                                                                                                                'table' => 'pieceregelemnt',
                                                                                                                                                                                                'name' => 'data[pieceregelemnt][0][carnetcheque_id]'
                                                                                                                                                                                            )
                                                                                                                                                                                        );
                                                                                                                                                                                        ?></td>
                                            </tr> -->

                                                                <tr>
                                                                    <td name="data[piece][0][trnum]" id="" index="0" champ="trnuma" table="piece" style="display:none" class="modecheque">Numéro pièce </td>
                                                                    <td name="data[piece][0][trnum]" id="" index="0" champ="trnumb" table="piece" style="display:none" class="modecheque">
                                                                        <div class='form-group' id="" index="0" champ="divnumc" table="piece" style="display:none">
                                                                            <label class='col-md-2 control-label'></label>
                                                                            <div class='col-sm-10' name="data[piece][0][trnum]" id="" index="0" champ="trnumc" table="piece" class="modecheque"> </div>
                                                                        </div>
                                                                        <div class='form-group' id="" index="0" champ="divnump" table="piece" style="display:none">
                                                                            <div class='col-sm-12'><?php echo $this->Form->input('num_piece', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][num_piece]')); ?></div>
                                                                        </div>
                                                                    </td>

                                                                </tr>



                                                            </table>

                                                        </td>

                                                        <td align="center">
                                                            <i index="0" id="test" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;"></i>
                                                        </td>
                                                    </tr>
                                                    <?php $read = "";
                                                    foreach ($piecereglementclients as $i => $piece) { //debug($piece); 
                                                    ?>
                                                        <tr>
                                                            <td colspan="8" style="vertical-align: top;">
                                                                <table>
                                                                    <tr>
                                                                        <td>Mode règlement </td>
                                                                        <td><?php
                                                                            echo $this->Form->input(
                                                                                'paiement_id',
                                                                                array(
                                                                                    'disabled' => true,
                                                                                    'value' => $piece->paiement_id,
                                                                                    'div' => 'form-group',
                                                                                    'between' => '<div class="col-sm-10">',
                                                                                    'after' => '</div>',
                                                                                    'class' => 'form-control modereglement select  ',
                                                                                    'label' => '',
                                                                                    'index' => $i,
                                                                                    'id' => 'paiement_id' . $i,
                                                                                    'champ' => 'paiement_id',
                                                                                    'table' => 'pieceregelemnt',
                                                                                    'name' => 'data[pieceregelemnt][' . $i . '][paiement_id]'
                                                                                )
                                                                            );
                                                                            ?>
                                                                            <?php echo $this->Form->input('id', array('value' => $piece->id, 'name' => 'data[pieceregelemnt][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                                                            <?php echo $this->Form->input('sup', array('name' => 'data[pieceregelemnt][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>

                                                                        </td>
                                                                    </tr>
                                                                    <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } ?> id="trmontantbrut<?php echo $i ?>">
                                                                        <td name="data[piece][<?php echo $i ?>][trmontantbrut]" id="trmontantbruta<?php echo $i ?>" index="<?php echo $i ?>" champ="trmontantbruta" table="piece" class="modecheque">Montant brut</td>
                                                                        <td name="data[piece][<?php echo $i ?>][trmontantbrut]" id="trmontantbrutb<?php echo $i ?>" index="<?php echo $i ?>" champ="trmontantbrutb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                                        echo $this->Form->input('montant_brut', array('value' => $piece->montant_brut, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control editmontantbrut', 'label' => '', 'type' => 'text', 'index' => $i, 'champ' => 'montantbrut', 'id' => 'montantbrut' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant_brut]'));
                                                                                                                                                                                                                                                        ?> </td>
                                                                    </tr>
                                                                    <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } ?> id="trtaux<?php echo $i ?>">
                                                                        <td name="data[piece][<?php echo $i ?>][trtaux]" id="trtauxa<?php echo $i ?>" index="<?php echo $i ?>" champ="trtauxa" table="piece" class="modecheque">Taux</td>
                                                                        <td name="data[piece][<?php echo $i ?>][trtaux]" id="trtauxb<?php echo $i ?>" index="<?php echo $i ?>" champ="trtauxb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                echo $this->Form->input('valeur_id', array('value' => $piece->to_id, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'select editmontantbrut', 'label' => '', 'index' => $i, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][taux]', 'id' => 'taux' . $i, 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                                                                ?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Montant</td>
                                                                        <td><?php
                                                                            echo $this->Form->input('montant', array('readonly' => true, 'value' => $piece->montant, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control mnt', 'label' => '', 'index' => $i, 'champ' => 'montant', 'id' => 'montant' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant]'));
                                                                            //echo $this->Form->input('montantdevise',array('value'=>$piece['Piecereglement']['montantdevise'],'type'=>'hidden','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control','label'=>'','index'=>$i,'champ'=>'montantdevise','id'=>'montantdevise'.$i,'table'=>'pieceregelemnt','name'=>'data[pieceregelemnt]['.$i.'][montantdevise]') );   
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } ?> id="trmontantnet<?php echo $i ?>">
                                                                        <td name="data[piece][<?php echo $i ?>][trmontantnet]" id="trmontantneta<?php echo $i ?>" index="<?php echo $i ?>" champ="trmontantneta" table="piece" class="modecheque">Montant Net</td>
                                                                        <td name="data[piece][<?php echo $i ?>][trmontantnet]" id="trmontantnetb<?php echo $i ?>" index="<?php echo $i ?>" champ="trmontantnetb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                                    echo $this->Form->input('montant_net', array('value' => $piece->montant_net, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => $i, 'id' => 'montantnet' . $i, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montantnet]'));
                                                                                                                                                                                                                                                    ?> </td>
                                                                    </tr>
                                                                    <tr <?php
                                                                        if (($piece->paiement_id == 1)) { ?> style="display:'none'" <?php } else { ?>style="display:" <?php } ?> id="trbanque<?php echo $i; ?>">
                                                                        <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Banque </td>
                                                                        <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">
                                                                            <?php
                                                                            echo $this->Form->control('banque_id', [
                                                                                'class' => 'form-control select2',
                                                                                'label' => '',
                                                                                'empty' => 'Veuillez choisir !!',
                                                                                'value' => $piece->banque,
                                                                            ]); ?>
                                                                        </td>
                                                                    </tr>
                                                                    < ?php //debug($piece->paiement_id);?>
                                                                        <tr <?php
                                                                            if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } ?> id="trechances<?php echo $i ?>">
                                                                            <td name="data[piece][<?php echo $i ?>][trechance]" id="trechancea[<?php echo $i ?>" index="[<?php echo $i ?>" champ="trechancea" table="piece" class="modecheque">Echéance</td>
                                                                            <td name="data[piece][<?php echo $i ?>][trechance]" id="trechanceb[<?php echo $i ?>" index="[<?php echo $i ?>" champ="trechanceb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                                echo $this->Form->input('echance', array('value' => $piece->echance, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datetimepicker', 'label' => '', 'type' => 'date', 'id' => 'echance' . $i, 'index' => $i, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][echance]'));
                                                                                                                                                                                                                                                ?> </td>
                                                                        </tr>
                                                                        <!-- //***************************************************--->
                                                                        <!-- <tr <?php if ($piece->paiement_id != 2) { ?>   style="display:none" <?php } ?> id="trcarnetnum<?php echo $i ?>" >
                                                    <td name="data[piece][<?php echo $i ?>][trcarnetnum]" id="trcarnetnuma<?php echo $i ?>" index="<?php echo $i ?>"  champ="trcarnetnuma" table="piece"   class="modecheque" >Numéro de carnet</td>  
                                                    <td  name="data[piece][<?php echo $i ?>][trcarnetnum]" id="trcarnetnumb<?php echo $i ?>" index="<?php echo $i ?>"  champ="trcarnetnumb" table="piece"   class="modecheque"><?php
                                                                                                                                                                                                                                echo $this->Form->input(
                                                                                                                                                                                                                                    'carnetcheque_id',
                                                                                                                                                                                                                                    array(
                                                                                                                                                                                                                                        'value' => $piece->carnetcheque_id,
                                                                                                                                                                                                                                        'div' => 'form-group',
                                                                                                                                                                                                                                        'between' => '<div class="col-sm-10">',
                                                                                                                                                                                                                                        'after' => '</div>',
                                                                                                                                                                                                                                        'class' => 'form-control select getnumcheque  ',
                                                                                                                                                                                                                                        'empty' => 'veuillez choisir',
                                                                                                                                                                                                                                        'label' => '',
                                                                                                                                                                                                                                        'index' => $i,
                                                                                                                                                                                                                                        'champ' => 'carnetcheque_id',
                                                                                                                                                                                                                                        'table' => 'pieceregelemnt',
                                                                                                                                                                                                                                        'name' => 'data[pieceregelemnt][' . $i . '][carnetcheque_id]'
                                                                                                                                                                                                                                    )
                                                                                                                                                                                                                                );
                                                                                                                                                                                                                                ?></td>
                                             </tr> -->
                                                                        <!-- //***************************************************--->
                                                                        <!-- <tr  <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 7)) { ?>   style="display:none" <?php } ?> id="trnums<?php echo $i ?>"  >
                                                <td name="data[piece][<?php echo $i ?>][trnum]" id="trnuma<?php echo $i ?>" index="<?php echo $i ?>"  champ="trnuma" table="piece"  class="modecheque" >Numéro pièce</td>  
                                                
<!--                                                <td  name="data[piece][<?php echo $i ?>][trnum]" id="trnumb0" index="<?php echo $i ?>"  champ="trnumb" table="piece"   class="modecheque"></td>-->
                                                                        <!-- <div class='form-group' id="divnumc<?php echo $i ?>" index="<?php echo $i ?>"  champ="divnumc" table="piece"  <?php if ($piece->paiement_id != 2) { ?>   style="display:none" <?php } ?>  >
                                                      <label class='col-md-2 control-label'></label>       
                                                       <div class="col-sm-10" id="trnumc<?php echo $i ?>" index="<?php echo $i ?>"  champ="trnumc" table="piece" >   
                                                        </div></div>
                                                           <td  name="data[piece][<?php echo $i ?>][trcarnetnum]" id="trcarnetnum<?php echo $i ?>" index="<?php echo $i ?>"  champ="trcarnetnumb" table="piece"  style="display:none" class="modecheque"><?php

                                                                                                                                                                                                                                                            // echo $this->Form->input('carnetcheque_id',array('value'=>$piece->carnetcheque_id,'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control  getnumcheque  ','empty'=>'veuillez choisir',
                                                                                                                                                                                                                                                            // 'label'=>'','index'=>$i,'champ'=>'carnetcheque_id','table'=>'pieceregelemnt','name'=>'data[pieceregelemnt]['.$i.'][carnetcheque_id]') );   
                                                                                                                                                                                                                                                            ?></td> 
                                                  
                                                    
                                                <td>
                                                   <div class='form-group ' id="divnump<?php echo $i ?>" index="<?php echo $i ?>"  champ="divnump" table="piece"  <?php if ($piece->paiement_id != 2) { ?>   style="display:none" <?php } ?> >
                                                     <div class='col-sm-10'>
                                                     <?php //echo $this->Form->input('num_piece',array('value'=>$piece->num,'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control ','label'=>'','type'=>'text','index'=>$i,'id'=>'num_piece'.$i,'champ'=>'num_piece','table'=>'pieceregelemnt','name'=>'data[pieceregelemnt]['.$i.'][num_piece]') );
                                                        ?>
                                                     </div>
                                                   </div>
                                                </td>   
                                            </tr> -->



                                                                </table>







                                                            </td>
                                                            <!-- <td>
                                                                <i index="<?php echo $i ?>" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;" />
                                                            </td> -->



                                                        </tr>
                                                    <?php } ?>
                                                    <input type="" value="<?php echo $i ?>" id="index" hidden>
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
        <!-- <button type="submit" class="pull-right btn btn-success testsubmitachat btn-sm " id="testpersonnel" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button> -->
        <?php echo $this->Form->end(); ?>
    </div>
    <!-- /.row -->
</section>


<?php echo $this->Html->script('alert'); ?>
<script>
    $(document).ready(function() {
        $("#testsubmitachat").on("mouseover ", function() {
            index = $("#index").val();
            if (index == -1) {
                alert(" Ajouter une ligne de Mode de Reglement", function() {});
                return false;
            }
            s = 0;
            for (i = 0; i <= index; i++) {
                if ($("#sup" + i).val() != 1) s = s + 1;
            }
            if (s == 0) {
                alert(" Ajouter une ligne de Mode de Reglement", function() {});
                return false;
            }
            difference = $("#difference").val();
            if (difference != 0) {
                alert("Les montants saisie et different a montant à payer");
                return false;
            }
            for (var i = 0; i <= index; i++) {
                var paiement_id = $("#paiement_id" + i).val();
                var montant = $("#montant" + i).val();
                if (Number(sup) != 1) {
                    if (!paiement_id) {
                        alert("Sélectionnez un mode de paiement pour la ligne" + i + ".");
                        return false;
                    }
                }
                if (Number(sup) != 1) {
                    if (!montant) {
                        alert("Entrez un montant pour la ligne " + i + ".");
                        return false;
                    }
                }
            }
        });

        $(".calculdiff").on("keyup change ", function() {
            max = $("#max").val();
            index = $("#index").val();
            sup = $("#sup" + index).val();
            payer = $("#Montant").val();
            variable1 = 0;
            for (i = 0; i <= max; i++) {
                if ($("#facture_id" + i).is(":checked")) {
                    variable1 = Number($("#Montantregler" + i).val()) + variable1;
                }
            }
            montantpaye = 0;
            for (j = 0; j <= index; j++) {
                montant = Number($("#montant" + j).val());
                montantpaye = Number(montant) + montantpaye;
            }
            difference = variable1 - montantpaye;
            $("#difference").val(difference);
        });
        $('.testmontantreglementachat').on('change keyup', function() {
            var max = $('#index').val();
            var montant = 0;
            for (var i = 0; i <= max; i++) {
                var val = $('#montant' + i).val();
                if (!isNaN(val)) {
                    //  alert();
                    montant += parseFloat(val);
                }
                if (montant > parseFloat($('#ttpayer').val())) {
                    alert('vous avez depasser le total a payer');
                    $(this).val(0);
                    bl();

                }
            }
        });
        $(".chekreglementfacachat").on("change keyup", function() {
            v = Number($("#ttpayer").val());
            total = 0;
            max = $("#max").val();
            for (i = 0; i <= max; i++) {
                if ($("#facture_id" + i).is(":checked"))
                    total += Number($("#Montantregler" + i).val()); ///alert('total'+ total)
            }
            $("#ttpayer").val(total.toFixed(3));
        });


        $(".testmontantreglementclient1 ").on("change keyup", function() {
            max = $("#max").val();
            // alert(max);
            for (i = 0; i <= max; i++) {
                // montant=$("#Montantregler" + i).val();
                // alert(montant);
                reste = Number($("#reste" + i).val());
                montant = Number($("#Montantregler" + i).val());
                if ($('#facture_id' + index).is(':checked')) {
                    if (montant > reste) {
                        // alert(montant > reste);
                        // alert(montant);
                        // alert(reste);
                        alert('le montant saisie dépasse le reste à payer');
                        $("#Montantregler" + i).val(reste);
                    }
                }
            }
        });

        $(".ajouterligne").on('click', function() {
            table = $(this).attr('table');
            index = $(this).attr('index');
            tr = $(this).attr('tr');
            ind = Number($('#' + index).val()) + 1;
            $ttr = $('#' + table).find('.' + tr).clone(true);
            $ttr.attr('class', 'cc');
            i = 0;
            tabb = [];
            $ttr.find('a,input,select,div,td,textarea,tr,table,i').each(function() {

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
                    }
                }
            })
            $ttr.find('i').each(function() {
                $(this).attr('index', ind);
            });
            $ttr.attr('style', '');
            $('#' + table).append($ttr);
            $('#' + index).val(ind);
            $('#echance' + ind).datetimepicker({
                timepicker: false,
                datepicker: true,
                mask: '39/19/9999',
                format: 'd/m/Y'
            });
            $('#' + table).find('tr:last').show();
            $("#paiement_id" + ind).select2({
                width: '100%'
            });
            $('.trstituation').hide();
        })
    });
    $(function() {
        //          $('.mnt').on('blur',function(){
        //    // alert("hay");
        //     v=$(this).attr('index');//alert(v)//console.log(v);

        //     //alert("libre"+val);

        //     tt=0;


        //     for(i=0;i<=v;i++){
        //        th= $('#montant'+i).val()||0; 
        //       // alert(th);
        //        tt=(Number(tt)+Number(th)).toFixed(3);  
        //      //  ttpayer2=(Number(ttpayer2)-Number(th)).toFixed(3);
        //     }
        //      $('#Montant').val(Number(tt).toFixed(3)); 

        // });
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
            // alert(val);
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
            if (Number(val) == 1) {
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
                $('#trbanquea' + index).show();
                $('#trbanqueb' + index).show();
                // $('#trnum'+index).attr('class','') ;
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
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trimg' + index).show();
                $('#trechancea' + index).show();
                $('#trechanceb' + index).show();
                $('#trbanquea' + index).hide();
                $('#trbanqueb' + index).hide();
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
                $('#trnbrmoins' + index).hide();
                $('#trechancea' + index).hide();
                $('#trechanceb' + index).hide();
                $('#trbanquea' + index).hide();
                $('#trbanqueb' + index).hide();
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
                $('#banque_idb' + index).show(); // modifiction amin
                $('#banque_ida' + index).show(); // modifiction amin
                //$('#trechance'+index).attr('class','display:none') ;
                $('#trnuma' + index).show();
                $('#trnumb' + index).show();

                $('#divnump' + index).show();
                //$('#trnum'+index).attr('class','display:none') ;  
            }

            if (Number(val) == 7) {
                //alert('aa');
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trechancea' + index).hide();
                $('#trechanceb' + index).hide();
                $('#trbanquea' + index).show();
                $('#trbanqueb' + index).show();

                $('#trnbrmoins' + index).show();
                $('#trnuma' + index).hide();
                $('#trnumb' + index).hide()
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
            }



        });
        $('.montantbrut').on('keyup change', function() {
            index = $(this).attr('index');
            montantbrut = $('#montant' + index).val() || 0;
            t = $('#taux' + index).val() || 0;
            //  alert(t);
            if (t == '1') {
                taux = 1.5
            };
            if (t == '4') {
                taux = 5
            };
            if (t == '3') {
                taux = 15
            };
            if (t == '5') {
                taux = 10
            };
            if (t == '6') {
                taux = 3
            };
            if (t == '7') {
                taux = 7
            };
            if (t == '8') {
                taux = 1
            };
            //alert(taux);
            retenue = (montantbrut * (taux / 100)).toFixed(3);
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
            console.log(tt);
            $('#Montant').val((tt).toFixed(3));

        });
    });
</script>
<script>
    $('.chekreglement').on('click', function() {

        ind = $(this).attr('index');
        ttpay = 0
        max = $('#max').val();
        //piece= $('.inputlibre'+ind).val();


        for (i = 0; i <= max; i++) {

            if ($('#facture_id' + i).is(':checked')) {
                $('#Montantregler' + i).show();

                ttpay = Number(ttpay) + Number(v)
                $('#ttpayer').val(Number(ttpay).toFixed(3));

            } else {
                $('#Montantregler' + i).attr('style', "display:none;");
                test = 0
            }
        }

    })

    $('#inputlibre').on('keyup', function() {

        ind = $(this).attr('index');
        ttpay = 0
        max = $('#max').val();

        for (i = 0; i <= max; i++) {


            v = $('#inputlibre' + i).show().val();
            ttpay = Number(ttpay) + Number(v)
            $('#ttpayer').val(Number(ttpay).toFixed(3));


        }

    })

    $('.input').val(Number(ttpay).toFixed(3));


























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
    // //    $(".ajouterligne").on('click', function() { 
    // //        table= $(this).attr('table');//id table
    // //        index= $(this).attr('index');// id max compteur
    // //        tr= $(this).attr('tr'); //class class type
    // //        ind=Number($('#'+index).val())+1;
    // //        $ttr =$('#'+table).find('.'+tr).clone(true);
    // //        $ttr.attr('class','cc'); //amin
    // //        i=0;tabb=[];
    // //        alert(ind);
    // //        $ttr.find('a,input,select,div,td,textarea,tr,table,i').each(function(){

    // //             tab = $(this).attr('table');
    // //             champ = $(this).attr('champ');
    // //             if(champ !="trstituation"){
    // //             $(this).attr('index',ind);
    // //             $(this).attr('id',champ+ind);
    // //             $(this).attr('name','data['+tab+']['+ind+']['+champ+']');
    // //         $(this).attr('data-bv-field','data['+tab+']['+ind+']['+champ+']');
    // //             $(this).removeClass('anc');
    // //              if($(this).is('select')){
    // //                             if(champ !="etatpiecereglement_id"){ 
    // //                  tabb[i]=champ+ind;
    // //                                 // alert(tabb[i]);
    // //                                 //----------- Amin
    // //                  i=Number(i)+1;
    // //                             } 
    // //                                  if(champ=='matierepremiere_id'){
    // //                                      nompage=$('.nompage').val();
    // //                                      four=$('#'+nompage+'FournisseurId').val()||0;
    // //                                      $(this).attr('onchange','cal_prix('+four+','+ind+')');
    // //                                  }
    // //                                   if(champ=='bouttonajoutlignepetit'){
    // //                                   $(this).attr('index',ind);    
    // //                                  }
    // //                                  // ----------
    // //             }
    // //           //  $(this).val('');

    // //         }		
    // //         })
    // //         $ttr.find('i').each(function(){
    // //            $(this).attr('index',ind); 
    // //         });//alert();console.log($ttr);
    // //         //alert(table);
    // //        // console.log($ttr);
    // //         //console.log($('#'+table).find('tr:last'));
    // //         $ttr.attr('style','');
    // //         $('#'+table).append($ttr);
    // //         $('#'+index).val(ind);
    // //         $('#echance'+ind).datetimepicker({
    // //         timepicker: false,
    // //         datepicker:true,
    // //         mask:'39/19/9999',
    // //         format:'d/m/Y'
    // //     });
    // //         $('#'+table).find('tr:last').show();
    //          $("#paiement_id" + ind).select2({
    //             width: '100%' // need to override the changed default
    //         });

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
</script>
<style>
    input[type="text"]:read-only {
        color: #000;
    }

    input[type="checkbox"]:disabled {
        color: #000;
    }
</style>