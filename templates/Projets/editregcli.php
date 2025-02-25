<?php

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
        <li><a href="<?php echo $this->Url->build(['action' => 'vieww/', $project_id]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <?= $this->Form->create($reglement, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <label> Numero </label>
                            <div> <?php
                                    echo $reglement->numeroconca;
                                    ?>

                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label> Date </label>
                            <div> <?php
                                    echo $reglement->Date;
                                    ?>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label> Projet </label>
                            <div> <?php
                                    echo $reglement->projet->name;
                                    ?>

                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label> Client </label>
                            <div> <?php
                                    echo $reglement->client->Raison_Sociale;
                                    ?>

                            </div>
                        </div>
                        <div hidden class="col-xs-6">
                            <?php
                            echo $this->Form->control('numeroconca', ['label' => 'Numero', 'readonly' => 'readonly']);
                            ?></div>
                        <div hidden class="col-xs-6">
                            <?php
                            echo $this->Form->control('Date', ['empty' => true, 'value' => $reglement->Date, 'class' => 'form-control', 'id' => 'date']);
                            ?></div>
                        <div hidden class="col-xs-6">
                            <div class="form-group input select required">
                                <label class="control-label" for="client_id">Clients</label>
                                <select name="client_id" id="client_id" class="form-control select2 control-label clientreglement" value='<?php $this->request->getQuery('client_id') ?>'>
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                    <?php foreach ($clients as $id => $client) { ?>
                                        <option <?php if ($cli == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
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
                                                        <th><strong> Facture </strong></th>
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
                                                            // foreach ($lignesreg as $r => $lignesre) {
                                                            //     $connection = ConnectionManager::get('default');
                                                            //     $mon = $connection->execute("select montantregler(" . $fac->id . " ) as mont")->fetchAll('assoc');
                                                            //     $lig = $connection->execute('select sum(lignereglementclients.Montant) as montant from lignereglementclients where lignereglementclients.reglementclient_id=' . $reg_id . ' and lignereglementclients.factureclient_id=' . $fac['id'] . ';')->fetchAll('assoc');
                                                            //     if ($lig) {
                                                            //         $style = "display:yesy";
                                                            //     } else {
                                                            //         $style = "display:none";
                                                            //     }
                                                            //     if ($mon[0]['mont'] == null) {
                                                            //         $montreg = 0;
                                                            //     } else {
                                                            //         $montreg = $mon[0]['mont'] - $lig[0]['montant'];
                                                            //     }
                                                            //     $reste = $fac->totalttc - $montreg;
                                                            // }    
                                                            
                                                            $connection = ConnectionManager::get('default');
                                                            $mon = $connection->execute("select montantregler(" . $fac['id'] . " ) as mont")->fetchAll('assoc');
                                                            // debug($mon);
                                                            $lig = $connection->execute('select * from lignereglementclients where lignereglementclients.reglementclient_id=' . $reglement->id . ' and lignereglementclients.factureclient_id=' . $fac['id'] . ';')->fetchAll('assoc');
                                                            
                                                            
                                                            
                                                            if ($lig[0]['id']) {
                                                                $id = $lig[0]['id'];
                                                            } else {
                                                                $id = 0;
                                                            }
                                                            if ($lig) {
                                                                $style = "display:true";
                                                            } else {
                                                                $style = "display:none";
                                                            }
                                                            //debug($style);die;
                                                            if ($mon[0]['mont'] == null) {
                                                                $montreg = 0;
                                                            } else {
                                                                $montreg = $mon[0]['mont'] - $lig[0]['Montant'];
                                                            }
                            
                                                            $reste = $fac['totalttc'] - $montreg;
                                                            $reste = sprintf("%01.3f",$reste);
                                                            ?>
                                                            <tr>
                                                                <td><?= h($fac->numero) ?></td>
                                                                <td><?= h($fac->date) ?></td>
                                                                <td><?= h($fac->totalttc) ?></td>
                                                                <td><?= h($montreg) ?></td>
                                                                <td><?= $reste ?></td>
                                                                <td>
                                                                    <?php
                                                                    //if ($lignesre->factureclient_id == $fac->id) { ?>
                                                                        <input type="checkbox"  <?php if ($lig) { ?> checked <?php } ?>  name="data[Lignereglementclient][<?php echo $i; ?>][factureclient_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt chekreglementfacachat calculereglementclient afficheinputmontantreglementclient" value="<?php echo $fac->id ?>" mnttounssi="<?php echo $fac->ttc; ?>" mnt="<?php echo $reste; ?>">
                                                                        <?php
                                                                        echo @$this->Form->input('Montanttt', array('value' =>$lig[0]['Montant'], 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '', 'type' => 'text', 'class' => 'form-control testmontantreglementclient  testmontantreglementclient1 checkmaxfa calculto  calculmontantt number'));
                                                                        ?>
                                                                    <?php 
                                                                    
                                                                //} else {
                                                                    ?>
                                                                        <!-- <input type="checkbox" name="data[Lignereglementclient][<?php echo $i; ?>][factureclient_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt chekreglementfacachat  calculereglementclient  afficheinputmontantreglementclient" value="<?php echo $fac->id ?>" mnttounssi="<?php echo $fac->ttc; ?>" mnt="<?php echo $reste; ?>">
                                                                        <?php
                                                                        echo @$this->Form->input('Montanttt', array('value' => '', 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '', 'type' => 'text', 'class' => 'form-control testmontantreglementclient checkmaxfa calculto  testmontantreglementclient1 calculmontantt number'));
                                                                        ?> -->
                                                                    <?php //} ?>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } ?>
                                                    <input type="hidden" name="max" value="<?php echo @$i; ?>" id="max">
                                                    <tr id="totalefacture">
                                                        <td colspan="5"> Total factures</td>
                                                        <td colspan="3">
                                                            <input type="number" name="data[Reglementclient][ttpayer]" id="ttpayer" class="form-control" value="<?php echo $mtfact; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    </tr>
                                                    <tr id="montantpayer">
                                                        <td colspan="5">Montant à payer</td>
                                                        <td colspan="3">
                                                            <input type="number" name="data[Reglementclient][Montant]" id="Montant" class="form-control " value="<?php echo $reglement->Montant; ?>" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">Differance echange</td>
                                                        <td colspan="3">
                                                            <input type="number" name="data[Reglementclient][difference]" id="difference" class="form-control " value="0.000" readonly>
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
                                        <div class="box-header with-border">
                                            <a class="btn btn-primary ajouterligne  reglclientchekajoutligne " table="addtable" index="index" tr='type' style="float: right; margin-bottom: 5px;">
                                                <i class="fa fa-plus-circle "></i> Ajouter ligne</a>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive ls-table">
                                                <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                                    <tr class="type" style="display: none ">
                                                        <td colspan="8" style="vertical-align: top;">
                                                            <table>
                                                                <tr>
                                                                    <td>Mode règlement </td>
                                                                    <td>
                                                                        <select table="pieceregelemnt" index="" champ="paiement_id" class="modereglement25  paiement_id limite form-control select selectized">
                                                                            <option class="modereglement25" value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                                            <?php foreach ($modalites as $id => $modalite) { ?>
                                                                                <option class="modereglement25" value="<?php echo $modalite->paiement_id; ?>"><?php echo $modalite->paiement->name ?></option>
                                                                            <?php } ?>
                                                                        </select>
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
                                                                        echo $this->Form->input('montant', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control calculdiff  testmontantreglementachatt differance mnt bl ', 'label' => '', 'index' => 0, 'champ' => 'montant', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant]'));
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr hidden>
                                                                    <td hidden> Nombre de jours </td> <!-- mnt bl -->
                                                                    <td hidden>
                                                                        <?php
                                                                        echo $this->Form->control('nbjour', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => ' limite form-control ', 'label' => '', 'index' => '', 'champ' => 'nbjour', 'table' => 'pieceregelemnt', 'id' => '', 'name' => ''));
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr hidden>
                                                                    <td hidden> Date limite de paiement </td>
                                                                    <td hidden>
                                                                        <?php
                                                                        echo $this->Form->control('limite', array('div' => 'form-group', 'type' => 'text', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => ' limite form-control ', 'label' => '', 'index' => '', 'champ' => 'limite', 'table' => 'pieceregelemnt', 'id' => '', 'name' => ''));
                                                                        ?>
                                                                    </td>
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
                                                                                                                                                                                                    echo $this->Form->input('echance', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control limite depassedate ', 'label' => '', 'type' => 'date', 'index' => 0, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][echance]'));
                                                                                                                                                                                                    ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td name="data[piece][0][trbanquea]" id="" index="0" champ="trbanquea" table="piece" style="display:none" class="modecheque">Banque </td>
                                                                    <td name="data[piece][0][trbanqueb]" id="" index="0" champ="trbanqueb" table="piece" style="display:none" class="modecheque">
                                                                        <select table="pieceregelemnt" index="" champ="banque_id" id="banque_id" class="modereglement22 limite paiement_id form-control ">
                                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                                            <?php foreach ($banques as $i => $banque) { ?>
                                                                                <option value="<?php echo $banque->id; ?>"><?php echo $banque->name ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                </tr>
                                                                <tr>
                                                                    <td name="data[piece][0][trnum]" id="" index="0" champ="trnuma" table="piece" style="display:none" class="modecheque">Numéro pièce </td>
                                                                    <td name="data[piece][0][trnum]" id="" index="0" champ="trnumb" table="piece" style="display:none" class="modecheque">
                                                                        <?php echo $this->Form->input('num_piece', array('div' => 'form-group', 'between' => '', 'after' => '', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][num_piece]')); ?>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td align="center">
                                                            <i index="0" id="test" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;"></i>
                                                        </td>
                                                    </tr>

                                                    <?php $read = "";
                                                    $i = -1;
                                                    foreach ($piecereglementclients as $i => $piece) {
                                                        $i++;

                                                    ?>
                                                        <tr>
                                                            <td colspan="8" style="vertical-align: top;">
                                                                <table>
                                                                    <tr>
                                                                        <td>Mode règlement </td>
                                                                        <td><?php // debug($piece->paiement_id);
                                                                            echo $this->Form->input(
                                                                                'paiement_id',
                                                                                [
                                                                                    'value' => $piece->paiement_id,
                                                                                    'div' => 'form-group',
                                                                                    'between' => '<div class="col-sm-10">',
                                                                                    'after' => '</div>',
                                                                                    'class' => 'form-control  paiement_id limite modereglement25  select',
                                                                                    'label' => '',
                                                                                    'index' => $i,
                                                                                    'id' => 'paiement_id' . $i,
                                                                                    'champ' => 'paiement_id',
                                                                                    'table' => 'pieceregelemnt',
                                                                                    'name' => 'data[pieceregelemnt][' . $i . '][paiement_id]'
                                                                                ]
                                                                            );
                                                                            ?>
                                                                            <?php echo $this->Form->input('id', array('value' => $piece->id, 'name' => 'data[pieceregelemnt][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control limite', 'label' => 'Nom')); ?>
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
                                                                                                                                                                                                                                echo $this->Form->input('valeur_id', array('value' => $piece->to_id, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'select limite editmontantbrut', 'label' => '', 'index' => $i, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][taux]', 'id' => 'taux' . $i, 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                                                                ?> </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Montant</td>
                                                                        <td><?php
                                                                            echo $this->Form->input('montant', array('value' => $piece->montant, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control limite testmontantreglementachatt  bl calculdiff mnt', 'label' => '', 'index' => $i, 'champ' => 'montant', 'id' => 'montant' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant]'));
                                                                            //echo $this->Form->input('montantdevise',array('value'=>$piece['Piecereglement']['montantdevise'],'type'=>'hidden','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control','label'=>'','index'=>$i,'champ'=>'montantdevise','id'=>'montantdevise'.$i,'table'=>'pieceregelemnt','name'=>'data[pieceregelemnt]['.$i.'][montantdevise]') );   
                                                                            ?>
                                                                        </td>
                                                                    </tr>

                                                                    <tr hidden>
                                                                        <td hidden> Nombre de jours </td> <!-- mnt bl -->
                                                                        <td hidden>
                                                                            <?php
                                                                            echo $this->Form->control('nbjour', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => ' limite form-control ', 'label' => '', 'index' => '', 'champ' => 'nbjour', 'table' => 'pieceregelemnt', 'id' => 'nbjour' . $i, 'name' => ''));
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr hidden>
                                                                        <td hidden> Date limite de paiement </td>
                                                                        <td hidden>
                                                                            <?php
                                                                            echo $this->Form->control('limite', array('div' => 'form-group', 'type' => 'text', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => ' limite form-control ', 'label' => '', 'index' => '', 'champ' => 'limite', 'table' => 'pieceregelemnt', 'id' => 'limite' . $i, 'name' => ''));
                                                                            ?>
                                                                        </td>
                                                                    </tr>


                                                                    <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } ?> id="trmontantnet<?php echo $i ?>">
                                                                        <td name="data[piece][<?php echo $i ?>][trmontantnet]" id="trmontantneta<?php echo $i ?>" index="<?php echo $i ?>" champ="trmontantneta" table="piece" class="modecheque">Montant Net</td>
                                                                        <td name="data[piece][<?php echo $i ?>][trmontantnet]" id="trmontantnetb<?php echo $i ?>" index="<?php echo $i ?>" champ="trmontantnetb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                                    echo $this->Form->input('montant_net', array('value' => $piece->montant_net, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control limite', 'label' => '', 'type' => 'text', 'index' => $i, 'id' => 'montantnet' . $i, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montantnet]'));
                                                                                                                                                                                                                                                    ?> </td>
                                                                    </tr>
                                                                    <?php //debug($piece->paiement_id);
                                                                    ?>
                                                                    <tr <?php
                                                                        if (($piece->paiement_id == 1) || ($piece->paiement_id == 5)) { ?> style="display:none" <?php } ?> id="trechances<?php echo $i ?>">
                                                                        <td name="data[piece][<?php echo $i ?>][trechance]" id="trechancea<?php echo $i ?>" index="[<?php echo $i ?>" champ="trechancea" table="piece" class="modecheque">Echéance</td>
                                                                        <td name="data[piece][<?php echo $i ?>][trechance]" id="trechanceb<?php echo $i ?>" index="[<?php echo $i ?>" champ="trechanceb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                            echo $this->Form->input('echance', array('value' => $piece->echance, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control limite depassedate datetimepicker', 'label' => '', 'type' => 'date', 'id' => 'echance' . $i, 'index' => $i, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][echance]'));
                                                                                                                                                                                                                                            ?> </td>
                                                                    </tr>

                                                                    <tr id="trbanque<?php echo $i; ?>" <?php echo ($piece->paiement_id == 1) ? 'style="display:none;"' : ''; ?>>
                                                                        <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Banque </td>
                                                                        <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">
                                                                            <?php // debug($piece);
                                                                            echo $this->Form->control('banque_id', [
                                                                                'class' => 'form-control select2',
                                                                                'label' => '',

                                                                                'empty' => 'Veuillez choisir !!',
                                                                                'value' => $piece->banque_id,
                                                                            ]); ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr <?php if (($piece->paiement_id == 1)) { ?> style="display:none" <?php } ?> id="trnums<?php echo $i  ?>">
                                                                        <td name="data[piece][<?php echo $i ?>][trnum]" id="trnuma<?php echo $i ?>" index="<?php echo $i ?>" champ="trnuma" table="piece" class="modecheque">Numéro pièce</td>
                                                                        <div class='form-group' id="divnumc<?php echo $i ?>" index="<?php echo $i ?>" champ="divnumc" table="piece" <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?>>
                                                                            <label class='col-md-2 control-label'></label>
                                                                            <div class="col-sm-10" id="trnumc<?php echo $i ?>" index="<?php echo $i ?>" champ="trnumc" table="piece">
                                                                            </div>
                                                                        </div>
                                                                        <td name="data[piece][<?php echo $i ?>][trcarnetnum]" id="trcarnetnum<?php echo $i ?>" index="<?php echo $i ?>" champ="trcarnetnumb" table="piece" style="display:none" class="modecheque"><?php echo $this->Form->input('carnetcheque_id', array('value' => $piece->carnetcheque_id, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control  getnumcheque  ', 'empty' => 'veuillez choisir', 'label' => '', 'index' => $i, 'champ' => 'carnetcheque_id', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][carnetcheque_id]')); ?></td>


                                                                        <td>
                                                                            <div class='form-group ' id="divnump<?php echo $i ?>" index="<?php echo $i ?>" champ="divnump" table="piece" <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?>>
                                                                                <?php echo $this->Form->input('num_piece', array('value' => $piece->num, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => $i, 'id' => 'num_piece' . $i, 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][num_piece]')); ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>
                                                                <i index="<?php echo $i ?>" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;" />
                                                            </td>
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
        <button type="submit" class="pull-right TestBoutonEnregistrer btn btn-success btn-sm " id="testpersonnel" style=" margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
        <?php echo $this->Form->end(); ?>
    </div>
    <!-- /.row -->
</section>


<?php echo $this->Html->script('alert'); ?>
<script>
    $(document).ready(function() {
        $('.paiement_id').on('mouseover change', function() {
            var paiementId = $(this).val();
            client_id = $("#client_id").val();
            index = $(this).attr('index');

            // alert(paiementId);

            $.ajax({
                url: "<?= $this->Url->build(['controller' => 'Reglementclients', 'action' => 'verif']) ?>",
                dataType: "JSON",
                type: "GET",
                method: "GET",
                data: {
                    paiement_id: paiementId,
                    client_id: client_id,
                    index: index,
                },
                success: function(data) {
                    //  alert(data.index);
                    $("#nbjour" + data.index).val(data.num);

                    // nb = $("#nbjour" + data.index).val();
                    // alert(nb);
                }
            });
        });
    });
    $(document).ready(function() {
        $(".depassedate").on("keyup change", function() {
            index = $("#index").val();
            // alert(index);
            echance = $("#echance" + index).val();
            // alert(echance);
            // console.log(echance);
            limite = $("#limite" + index).val();
            // alert(limite);
            var dateLimite = new Date(limite.split("/").reverse().join("-"));
            var limiteFormatted = dateLimite.getFullYear() + "-" + (dateLimite.getMonth() + 1).toString().padStart(2, '0') + "-" + dateLimite.getDate().toString().padStart(2, '0');
            if (echance > limiteFormatted) {
                alert(" Vous avez dépassé la date limite = " + limite);
                $("#echance" + index).val(limiteFormatted)
            }
        });
        setInterval(function() {
            $(".paiement_id").trigger("change").trigger("keyup").trigger("mouseover");
        }, 1000);
        setInterval(function() {
            $(".bl").trigger("change").trigger("keyup").trigger("mouseover");
        }, 1000);
        // setInterval(function() {
        //     $(".limite").trigger("keyup").trigger("change").trigger("mouseover");
        // }, 100000);


        $(".limite").on("keyup change mouseover ", function() {
            index = $("#index").val();
            //   alert();
            // alert(index);
            nbjour = $("#nbjour" + index).val();
            // alert();
            //   alert(nbjour);
            const maintenant = new Date();
            const jour = maintenant.getDate();
            const mois = maintenant.getMonth() + 1;
            const annee = maintenant.getFullYear();
            const dateAujourdhui = `${jour}/${mois}/${annee}`;
            const limite = new Date(maintenant.getTime() + nbjour * 24 * 60 * 60 * 1000);
            const limiteFormattee = limite.toLocaleDateString("fr-FR"); // Formatage de la date
            // console.log(limiteFormattee);
            $("#limite" + index).val(limiteFormattee);
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
            for (j = 1; j <= index; j++) {
                montant = Number($("#montant" + j).val());
                montantpaye = Number(montant) + montantpaye;
            }
            difference = variable1 - montantpaye;
            $("#difference").val(difference);
        });
    });
</script>
<script>
    $(document).ready(function() {

        $('.modereglement25').on('change', function() {
            index = $(this).attr('index'); //alert(index);
            val = $(this).val(); //
            //alert(val);
            typefrs = $('#typefrs').val();
            nb = 0;
            if (Number(val) == 1) {
                // alert(val);
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trnbrmoins' + index).hide();
                $('#trechancea' + index).hide();
                $('#trechanceb' + index).hide();
                $('#trbanque' + index).hide();
                $('#trbanquea' + index).hide();
                $('#trbanqueb' + index).hide();
                $('#trimg' + index).show();
                $('#numpiece' + index).hide(); // modifiction amin   
                $('#trnuma' + index).hide();
                $('#trnumb' + index).hide();
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
                $('#divnump' + index).hide(); //alert('ok')

            } else if (Number(val) == 2) {
                // alert('cheque');
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trimg' + index).show(); //alert('ok')

                $('#trechances' + index).show(); //alert('ok')
                $('#trechancea' + index).show(); //alert('ok')
                $('#trechanceb' + index).show();

                $('#trbanque' + index).show();
                $('#trbanque' + index).show();
                $('#banque_idb' + index).show(); // modifiction amin  
                $('#banque_ida' + index).show();

                $('#numpiece' + index).show(); // modifiction amin   
                $('#trnuma' + index).show();
                $('#trnums' + index).show();

                $('#trnumb' + index).show();

                //ajouter select carnet trnumb0
                $('#trcarnetnuma' + index).show(); //alert('ok')
                $('#trcarnetnumb' + index).show(); //alert('ok')
                $('#divnumc' + index).show(); //alert('ok')

                $('#divnump' + index).show(); //alert('ok')

            } else if (Number(val) == 5) {
                $('#pop').html('');
                $('#trimg' + index).show();

                $('#trmontantbrut' + index).show();
                $('#trmontantbruta' + index).show();
                $('#trmontantbrutb' + index).show();
                $('#trmontantnet' + index).show();
                $('#trmontantneta' + index).show();
                $('#trmontantnetb' + index).show();
                $('#trtaux' + index).show();
                $('#trtauxa' + index).show();
                $('#trtauxb' + index).show();
                $('#trnbrmoins' + index).hide();
                $('#trechancea' + index).hide();
                $('#trechanceb' + index).hide();
                $('#trbanque' + index).hide();
                $('#trbanquea' + index).hide();
                $('#trbanqueb' + index).hide();
                // $('#trnum'+index).attr('class','') ;
                $('#trnuma' + index).show();
                $('#trnumb' + index).show();
                $('#numpiece' + index).show(); // modifiction amin   

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
                $('#trnumb' + index).hide();
                $('#numpiece' + index).hide(); // modifiction amin   
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
            }
        });
        $('.mnt').on('keyup', function() {
            v = $(this).attr('index');
            // console.log(v);
            tt = 0;
            for (i = 0; i <= v; i++) {
                th = $('#montant' + i).val() || 0;
                tt = (Number(tt) + Number(th)).toFixed(3);
            }
            //  alert(tt);
            $('#Montant').val(Number(tt).toFixed(3));

        });
        $('.afficheinputmontantreglementclient').each(function() {
            index = $(this).attr('index');
            if (!$('#facture_id' + index).prop('checked')) {
                $('#Montantregler' + index).hide();
            }
        });

        // $(".calculdiff").on("keyup change ", function() {
        //     max = $("#max").val();
        //     index = $("#index").val();
        //     // console.log(index);

        //     payer = $("#Montant").val();
        //     variable1 = 0;
        //     for (i = 0; i <= max; i++) {
        //         if ($("#facture_id" + i).is(":checked")) {
        //             variable1 = Number($("#Montantregler" + i).val()) + variable1;
        //             // alert(variable1);
        //         }
        //     }

        //     montantpaye = 0;
        //     for (j = 0; j <= index; j++) {
        //         sup = $("#sup" + index).val();
        //         if (sup != 1) {
        //             montant = Number($("#montant" + j).val());
        //             // alert(montant);
        //             Number(montantpaye) = Number(montant) + Number(montantpaye);
        //         }
        //     }
        //     // alert(montantpaye);

        //     difference = variable1 - montantpaye;
        //     alert(difference);
        //     $("#difference").val(difference);
        // });

        $('.testmontantreglementachatt').on('keyup', function() {
            var max = $('#index').val();
            var montant = 0;
          //  alert(max);
            for (var i = 0; i <= max; i++) {
                var val = $('#montant' + i).val();
                if (!isNaN(val)) {
                    montant += parseFloat(val);
                    //    alert(montant);
                }
              
            }
             if (montant > parseFloat($('#ttpayer').val())) {
                    // alert(montant > parseFloat($('#ttpayer').val()));
                    alert('vous avez depasser le total a payer');
                    $(this).val(0);
                    //bl();
                    return false;
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
        $('#test').on('click', function() {
            ind = $(this).attr('index');
            $('#sup' + ind).val(1);
            $(this).parent().parent().hide();
            $('#btnenr').prop("disabled", false);
            v = $('#index').val();
            // console.log(v);
            tt = 0;
            th = 0;
            for (i = 0; i <= v; i++) {
                if ($('#sup' + i).val() != 1) {
                    th = $('#montant' + i).val() || 0;
                    tt = Number(tt) + Number(th);
                }
            }
            // console.log(tt);
            $('#Montant').val(tt);
        });
        $("#testsubmitachat5555").on("mouseover ", function() {
            index = $("#index").val();
            // alert(index);
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
</script>

<script>
    function calculetotalecredit(index) {
        nbrtr = $('#nbrtr' + index).val();
        montant = $('#montant').val() || 0;
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
        if (test == 1) {
            bootbox.alert('V�rifier le montant', function() {});
            return false
        } else {
            $('#' + index + 'total').val(tt);
        }
    }
</script>
<script>
    $(function() {
        $('.select2').select2()
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
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
<script>
    $('.afficherancienclient').on('click', function() {
        if ($('#oui').is(':checked')) {
            alert("true is checked");
            $('#afficher').attr('style', "display:none;");
        }

    });
</script>