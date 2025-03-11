<section class="content-header">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</section>

<?php

use Cake\Datasource\ConnectionManager;

echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<style>
    .btn-purple {
        background-color: purple;
        color: white;
    }
</style>
<section class="content-header">
    <header>
        <?php if ($type == 1) { ?>
            <h1 style="text-align:center;">Bon de livraison</h1>
        <?php 
    $add = "";
    $edit = "";
    $delete = "";
    $view = "";
    $session = $this->request->getSession();
    $abrv = $session->read('abrvv');
    $lien = $session->read('lien_vente' . $abrv);
    foreach ($lien as $k => $liens) {
        if (@$liens['lien'] == 'bonlivraisons') {
            $add = $liens['ajout'];
            $edit = $liens['modif'];
            $delete = $liens['supp'];
            $valide = $liens['valide'];
            $imp = $liens['imprimer'];
        }
    }
    
    }  ?>
        <?php if ($type == 2) { ?>
            <h1 style="text-align:center;">Offre de prix </h1>
        <?php }  ?>
        <?php if ($type == 3) { ?>
            <h1 style="text-align:center;">BL retour marchandise</h1>
        <?php }  ?>
        <?php if ($type == 4) { ?>
            <h1 style="text-align:center;">Integration</h1>
        <?php 
    $add = "";
    $edit = "";
    $delete = "";
    $view = "";
    $session = $this->request->getSession();
    $abrv = $session->read('abrvv');
    $lien = $session->read('lien_vente' . $abrv);
    foreach ($lien as $k => $liens) {
        if (@$liens['lien'] == 'integrations') {
            $add = $liens['ajout'];
            $edit = $liens['modif'];
            $delete = $liens['supp'];
            $valide = $liens['valide'];
            $imp = $liens['imprimer'];
        }
    }
    
    }  ?>
    </header>
</section>
<?php



if ($add == 1) { ?>
    <?php if ($type == 4) { ?>
        <div class="pull-left" style="margin-left:25px;margin-top: 20px">
            <?php echo $this->Html->link(__('Ajouter excel'), ['action' => 'addexcl/' . $type], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    <?php } ?>
<?php } ?>

<br> <br><br><br><br>
<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            <?php echo $this->Form->create($bonlivraisons, ['type' => 'get']); ?>
            <div class="row">
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->input('datedebut', array('required' => 'off', 'label' => 'Date début', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                            ?> </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->input('datefin', array('required' => 'off', 'label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">

                            <div class="form-group input text required">
                                <label class="control-label" for="name">Client
                                </label>
                                <select class="form-control select2" name="client_id">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                    <?php foreach ($clients as $id => $client) {
                                    ?>

                                        <option <?php if ($this->request->getQuery('client_id') == $client->id) echo 'selected="selected"' ?> value="<?php echo $client->id; ?>"><?php if ($client->Tel != null) {
                                                                                                                                                                                        echo $client->Tel . ' -- ';
                                                                                                                                                                                    }
                                                                                                                                                                                    echo $client->Raison_Sociale ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-xs-6">
                            <div class="form-group input text required" id="divsous">
                                <?php echo $this->Form->control('depot_id', ['value' => $this->request->getQuery('depot_id'), 'options' => $depots, 'name' => 'depot_id', 'label' => 'Depot', 'class' => 'form-control select2', 'empty' => 'Veuillez choisir !!']); ?>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('zone_id', [
                                'class' => 'form-control select2 control-label',
                                'required' => 'off', 'label' => 'Zones ', 'options' => $zones, 'empty' => 'Veuillez choisir !!', 'value' => $this->request->getQuery('zone_id')
                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label class="control-label" for="depot-id">Articles</label>

                                <select name="article_id" id="article_id" class="form-control select2 control-label " value='<?php $this->request->getQuery('article_id') ?>'>
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($articles as $id => $articlee) {
                                    ?>
                                        <option value="<?php echo $articlee->id; ?>" <?php if ($article == $articlee->id) { ?> selected <?php } ?>><?php echo $articlee->Code . ' ' . $articlee->Dsignation ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->input('numero', array('required' => 'off', 'label' => 'Numero', 'value' => $this->request->getQuery('numero'), 'id' => 'num', 'class' => 'form-control '));
                            ?>

                        </div>

                    </div>
                </div>
            </div>

            <div style="text-align:center">
                <button type="submit" class="btn btn-primary btn-sm">Afficher</button>

                <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index', $type], ['class' => 'btn btn-primary btn-sm']) ?>
            </div>
            <?php echo $this->Form->end(); ?>
</section>

<div class="box-header with-border">
                    <?php
                    if ($type == 1) { ?>
                        <h3 class="box-title">Bon livraison</h3>
                    <?php } ?>
                    <?php
                    if ($type == 2) { ?>
                        <h3 class="box-title">Offre de prix</h3>
                    <?php } ?>
                    <?php
                    if ($type == 3) { ?>
                        <h3 class="box-title">Bon de livraison marchandise</h3>
                    <?php } ?>
                    <?php
                    if ($type == 4) { ?>
                        <h3 class="box-title">Integration</h3>
                    <?php } ?>
                    <?php
                    if ($type == 5) { ?>
                        <h3 class="box-title">Offre de prix</h3>
                    <?php } ?>
                </div>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th hidden>id</th>
                                <th>Numero</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Dépot</th>
                                <?php
                                foreach ($bonlivraisons as $i => $bonlivraison) :

                                ?>
                                <?php endforeach; ?>

                                <?php if ($bonlivraison->typebl == 1 || $bonlivraison->typebl == 2) { ?>
                                    <th>Net à payer</th>
                                <?php } ?>

                                <?php if ($bonlivraison->typebl == 3) { ?>
                                    <th>Total HT</th>
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 2) { ?>
                                    <th style='text-align:center !important'>Etat </th>
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 2) { ?>
                                    <th>Bon de commande </th>
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 1) { ?>
                                    <th> Facture </th>
                                <?php } ?>

                                <?php if ($bonlivraison->typebl == 4) { ?>
                                    <th> Offre de prix </th>
                                <?php } ?>
                                <?php if ($type == 5) { ?>
                                    <th> Devis </th>
                                <?php } ?>


                                <th width=10%>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($bonlivraisons as $i => $bonlivraison) :
                            ?>
                                        <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $bonlivraison->id, 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>


                                        <?php if ($type == 2) { ?>
                                            <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $bonlivraison->id, 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                            <?php echo $this->Form->control('tre', ['index' => $i, 'id' => 'treilles' . $i, 'value' => $bonlivraison->treilles, 'label' => '', 'champ' => 'treilles', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                            <?php echo $this->Form->control('aut', ['index' => $i, 'id' => 'autorisation' . $i, 'value' => $bonlivraison->autorisation, 'label' => '', 'champ' => 'autorisation', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                        <?php } ?>
                                <tr>
                                    <td hidden><?=($bonlivraison->date) ?></td>
                                    <td><?= h($bonlivraison->numero) ?></td>
                                    <td>
                                        <?=
                                        $this->Time->format(
                                            $bonlivraison->date,
                                            'dd/MM/y'
                                        );
                                        ?></td>
                                    <td><?= $bonlivraison->client->Code . ' ' . h($bonlivraison->client->Raison_Sociale) ?></td>
                                    <td><?= h($bonlivraison->depot->name) ?></td>

                                    <?php if (($bonlivraison->typebl == 1) || ($bonlivraison->typebl == 2)) { ?>
                                        <td><?= h($bonlivraison->totalttc) ?></td>
                                    <?php } ?>
                                    <?php if ($bonlivraison->typebl == 3) { ?>
                                        <td><?= h($bonlivraison->totalht) ?></td>
                                    <?php } ?>

                                    <?php if ($bonlivraison->typebl == 2) {
                                        $id = $bonlivraison->id;
                                        // debug($id);

                                        $commandeTotQte = 0;
                                        $BLTotQte = 0;
                                        $connection = ConnectionManager::get('default');
                                        $thisbl = $connection->execute('SELECT * FROM bonlivraisons WHERE bonlivraisons.id = ' . $id . ';')->fetchAll('assoc');
                                        $commande_id = $thisbl[0]['commande_id'];
                                        if (!empty($commande_id)) {
                                            $commandeTotQte = $connection->execute('SELECT SUM(qte) AS sommeqtecmd FROM lignecommandes WHERE commande_id = :commande_id', ['commande_id' => $commande_id])
                                                ->fetch('assoc');
                                            //  debug($commandeTotQte);
                                        }
                                        if (!empty($commande_id)) {
                                            $bls = $connection->execute('SELECT * FROM bonlivraisons WHERE bonlivraisons.commande_id = ' . $commande_id . ' AND bonlivraisons.typebl=1;')->fetchAll('assoc');

                                            if (!empty($bls)) {
                                                $blsIds = [];
                                                foreach ($bls as $bl) {
                                                    $blsIds[] = $bl['id'];
                                                }

                                                $blsIdsString = implode(',', $blsIds);

                                                $BLTotQte = $connection
                                                    ->execute('SELECT SUM(qte) AS sommeqtebl FROM lignebonlivraisons WHERE bonlivraison_id IN (' . $blsIdsString . ')')
                                                    ->fetch('assoc');

                                                // debug($BLTotQte);
                                            }
                                        }
                                        $articlesId = $connection->execute('SELECT article_id FROM lignebonlivraisons WHERE lignebonlivraisons.bonlivraison_id = ' . $id . ';')->fetchAll('assoc');
                                        $commande = $connection->execute('SELECT * FROM commandes WHERE commandes.bonlivraison_id = ' . $id . ';')->fetchAll('assoc');

                                        // debug($commande_id);

                                    ?>
                                        <td align="center">
                                            <?php
                                            if ($BLTotQte['sommeqtebl'] == $commandeTotQte['sommeqtecmd'] && $BLTotQte['sommeqtebl'] != 0) {
                                                echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #54A74D; color: white;">Livré</button>';
                                            } elseif ($BLTotQte['sommeqtebl'] == 0) {
                                                echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #F55C43; color: white;">En cours</button>';
                                            } elseif ($BLTotQte['sommeqtebl'] < $commandeTotQte['sommeqtecmd']) {
                                                echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #F99048; color: white;">Livré Partiel</button>';
                                            }
                                            ?>
                                        </td>
                                    <?php } ?>
                                    <?php
                                    ?>
                                    <?php if ($bonlivraison->typebl == 1 || $bonlivraison->typebl == 3) { ?>
                                        <td align="center">
                                            <div <?php if ($bonlivraison->excel == null) { ?> <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->commande_id != 0 and $bonlivraison->typebl == 2) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->bl == 1) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->typebl == 3) { ?> style="display:none" <?php } ?>>
                                                <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                <input type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="fac" <?php if ($bonlivraison->etatliv == '1') { ?> style="display:none" <?php } ?> />
                                            <?php } ?>
                                            </div>
                                        </td>
                                    <?php } ?>

                                    <?php if ($bonlivraison->typebl == 2) {
                                        //debug( $bonlivraison->confirme) 
                                    ?>
                                        <td align="center">
                                            <div <?php if ($bonlivraison->excel == null) { ?> <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->commande_id != 0 and $bonlivraison->typebl == 2) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->bl == 1) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->confirme == 0) { ?> style="display:none" <?php } ?>>
                                                <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                <input type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="fac" <?php if ($bonlivraison->etatliv == '1') { ?> style="display:none" <?php } ?> />

                                            <?php } ?>

                                            </div>
                                            <?php if ($bonlivraison->confirme == 0) { ?>
                                                <button style="background-color:black" class="btn btn-success btn-xs glyphicon glyphicon-edit opendialogcycle" index=<?php echo $i ?> id="<?php echo '' ?>"></button>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>

                                    <?php if ($bonlivraison->typebl == 4) { ?>
                                        <td align="center">
                                            <?php if ($bonlivraison->id_offredeprix == 0) { ?>
                                                <div <?php if ($bonlivraison->excel == null) { ?> <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->commande_id != 0 and $bonlivraison->typebl == 2) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->bl == 1) { ?> style="display:none" <?php } ?>>
                                                    <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                    <input type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="offre" <?php if ($bonlivraison->etatliv == '1') { ?> style="display:none" <?php } ?> />
                                                <?php } ?>
                                                </div>

                                            <?php } ?>
                                        </td>
                                    <?php } ?>

                                    <?php if ($bonlivraison->typebl == 5) { ?>
                                        <td align="center">
                                            <div <?php if ($bonlivraison->excel == null) { ?> <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->commande_id != 0 and $bonlivraison->typebl == 2) { ?> style="display:none" <?php } ?> <?php if ($bonlivraison->bl == 1) { ?> style="display:none" <?php } ?>>
                                                <input id="client_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $bonlivraison->client_id ?>">
                                                <input type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $bonlivraison['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="devis" <?php if ($bonlivraison->etatliv == '1') { ?> style="display:none" <?php } ?> />
                                            <?php } ?>
                                            </div>
                                        </td>
                                    <?php } ?>






                                    <!-------------------------- BL ---------------------->

                                    <?php if ($bonlivraison->typebl == 1) { ?>


                                        <td>
                                            <div style="display: flex;">
                                                <div style="margin-right:2px ;">

                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonlivraison->id), array('escape' => false)); ?>

                                                </div>
                                                <div style="margin-right:2px ;">
                                                    <?php if ($edit == 1) { ?>
                                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bonlivraison->id), array('escape' => false)); ?>
                                                    <?php } ?>
                                                </div>

                                                <?php if ($type == 1) { ?>

                                                    <div style="margin-right:2px ;">
                                                        <a onclick="openWindow(1000, 1000, 'https://sirepprefaprod.isofterp.com/ERP/Bonlivraisons/imprimeviewbl/<?php echo $bonlivraison->id; ?>')"><button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button></a>
                                                    </div>

                                                <?php } else { ?>
                                                    <div style="margin-right:2px ;">
                                                        <a onclick="openWindow(1000, 1000, 'https://sirepprefaprod.isofterp.com/ERP/Bonlivraisons/imprimeview/<?php echo $bonlivraison->id; ?>')"><button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button></a>
                                                    </div>
                                                <?php } ?>

                                                    <?php if ($delete == 1) { ?>
                                                <div <?php if ($bonlivraison->factureclient_id != 0) { ?> style="display:none" <?php } ?>>

                                                    <?php echo $this->Form->postLink("<button class=' deleteConfirm btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $bonlivraison->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $bonlivraison->id)); ?>
                                                </div>
                                                <?php } ?>




                                            </div>

                                        </td>
                                    <?php } ?>


                                    <!--------------------------  Offre de prix ---------------------->
                                    <?php if ($bonlivraison->typebl == 2) { ?>
                                        <td>
                                            <div style="display: flex;" align="center">
                                                <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonlivraison->id), array('escape' => false)); ?>
                                                </div>
                                                <div <?php if ($bonlivraison->commande_id != 0) { ?> style="display:none;margin-right:2px ;" <?php } else { ?> style="margin-right:2px ;" <?php } ?>>

                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bonlivraison->id), array('escape' => false)); ?>
                                                </div>

                                                <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $bonlivraison->id), array('escape' => false)); ?>
                                                </div>


                                                <div style="margin-right:2px ;">
                                                    <?php echo $this->Html->Link("<button class='btn btn-xs btn-purple'><i class='fa fa-print'></i></button>", array('action' => 'imprimeviewbyfamille', $bonlivraison->id), array('escape' => false)); ?>
                                                </div>

                                                <div <?php if ($bonlivraison->commande_id != 0) { ?> style="display:none;margin-right:2px ;" <?php } ?>>

                                                    <?php
                                                    echo ("<button type=button index= '" . $i . "' id='delete" . $i . "' class='btn btn-xs btn-danger deleteverif'><i class='fa fa-trash-o'></i></button>");
                                                    ?>


                                                </div>
                                        </td>

                                    <?php } ?>


                                    <!-------------------------- Integration ---------------------->

                                    <?php if ($bonlivraison->typebl == 4) { ?>

                                        <td>
                                            <div style="display: flex;" align="center">
                                                <?php if ($bonlivraison->excel != null) { ?>
                                                    <div style="margin-right:2px ;">
                                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'viewxcl', $bonlivraison->id), array('escape' => false)); ?>
                                                    </div>

                                                    <?php 
                                                    if ($edit==1){ ?>
                                                    <div style="margin-right:2px ;">
                                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-info'><i class='fa fa-check'></i></button>", array('action' => 'editxcl', $bonlivraison->id), array('escape' => false));
                                                       } ?>
                                                    </div>
                                                    <div <?php
                                                    if ($delete==1){
                                                    if ($bonlivraison->id_offredeprix != 0) { ?> style="display:none;margin-right:2px ;" <?php } ?>>

                                                        <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'deletebr', $bonlivraison->id), array('escape' => false, null)) ?>
                                                    </div>
                                                <?php }} else { ?>
                                                    <div style="margin-right:2px ;">

                                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonlivraison->id), array('escape' => false)); ?>

                                                    </div>

                                                    <div <?php
                                                     if ($edit==1){
                                                    if ($bonlivraison->id_offredeprix != 0) { ?> style="display:none;margin-right:2px ;margin-left:2px ;" <?php } ?>>

                                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $bonlivraison->id), array('escape' => false));
                                                        
                                                     } ?>
                                                    </div>


                                                    <div style="margin-right:2px ;">
                                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $bonlivraison->id), array('escape' => false)); ?>
                                                    </div>

                                                    <?php if ($delete==1){  ?>
                                                    <div <?php if ($bonlivraison->id_offredeprix != 0) { ?> style="display:none;margin-right:2px ;" <?php } ?>>

                                                        <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'deletebr', $bonlivraison->id), array('escape' => false, null)) ?>
                                                    </div>

                                                <?php } } ?>
                                            </div>
                                        </td>
                                    <?php } ?>

                                    <!--------------------------  bon livraison marchandise ---------------------->

                                    <?php if ($bonlivraison->typebl == 3) { ?>

                                        <td>
                                            <div style="display: flex;" align="center">
                                                <div style="margin-right:2px ;">

                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'viewm', $bonlivraison->id), array('escape' => false)); ?>

                                                </div>
                                                <div style="margin-right:2px ;">

                                                    <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'editm', $bonlivraison->id), array('escape' => false)); ?>
                                                </div>


                                                <!-- <div style="margin-right:2px ;">
                                <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $bonlivraison->id), array('escape' => false)); ?>
                            </div> -->

                                                <div>

                                                    <?php echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'deletebrece', $bonlivraison->id), array('escape' => false, null)) ?>
                                                </div>

                                            </div>
                                        </td>
                                    <?php } ?>





                                </tr>



                            <?php endforeach; ?>
                        </tbody>

                    </table>
                    <input type="hidden" value="<?php echo $i; ?>" id="index" />
                    <table>

                        <tr>

                            <td align="center">

                                <?php if ($bonlivraison->typebl == 2) { ?>

                                    <div class="col-md-12  testcheck" style="display:none;">
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />

                                        <a class="btn btn btn-success " id="com"> <i class="fa fa-plus-circle"></i> Créer bon de commande </a>

                                    </div>
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 1) { ?>

                                    <div class="col-md-12  testcheck" style="display:none;">
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />

                                        <a class="btn btn btn-primary  " id="facture"> <i class="fa fa-plus-circle"></i> Facture </a>

                                    </div>
                                <?php } ?>



                                <?php if ($bonlivraison->typebl == 4) { ?>

                                    <div class="col-md-12  testcheck" style="display:none;">
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />

                                        <a class="btn btn btn-success " id="offrebutton"> <i class="fa fa-plus-circle"></i> Créer offre de prix </a>

                                    </div>
                                <?php } ?>
                                <?php if ($bonlivraison->typebl == 5) { ?>

                                    <div class="col-md-12  testcheck" style="display:none;">
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="tes" value="0" class="tes" />
                                        <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />

                                        <a class="btn btn btn-primary  " id="devisbutton"> <i class="fa fa-plus-circle"></i> Créer devis </a>

                                    </div>
                                <?php } ?>

                            </td>

                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<?php if ($type == 2) { ?>
    <div id="dialogcycle" title="Confirmation">
        <section class="content" style="width: 99%">
            <?php echo $this->Form->create($suivi, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
            ?>


            <!-- Checkbox: Treilles Soudés Obligatoire -->
            <div align=center class="col-xs-12">
                <?php
                echo $this->Form->control('treilles', [
                    'type' => 'checkbox',
                    'label' => 'Treilles Soudés Obligatoire'
                ]);
                ?>
            </div>

            <!-- Checkbox: Autorisation Sans Avance -->
            <div align=center class="col-xs-12">
                <?php
                echo $this->Form->control('autorisation', [
                    'type' => 'checkbox',
                    'label' => 'Autorisation Sans Avance'
                ]);
                echo $this->Form->control('iddialog', ['label' => false, 'class' => 'form-control', 'required' => 'off', 'type' => 'hidden']); ?>

            </div>


        </section>

        <div class="dialog-footer" align="center">
            <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'dialogbutton']); ?>
            <?php //echo $this->Html->link("<button index= '" . $i . "' id='view" . $i . "' class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonlivraisonusine->id), array('escape' => false)); 
            ?>

        </div>
        <?php echo $this->Form->end(); ?>


    </div>
<?php } ?>

<style type="text/css">
    .ui-dialog {
        z-index: 4000;

    }

    #dialogcycle {
        position: relative;
    }

    .dialog-footer {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
    }
</style>


<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>

<script type="text/javascript">
    $(function() {
        $('.deleteverif').on('click', function() {
            ind = $(this).attr('index');
            id = $('#id' + ind).val();

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'verif']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    if (data.lignereg != 0) {
                        alert('Offre de prix déjà existe dans un règlement');
                    } else {
                        if (confirm('Voulez-vous vraiment supprimer cet enregistrement')) {
                            window.location = "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'deletebr']) ?>/" + id;
                        }
                    }
                }
            })
        });
    });
</script>


<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
    $(function() {

        $("form").submit(function() {
            $('#dialogbutton').attr('disabled', 'disabled');
        })


        $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
    })
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
</script>
<?php $this->end(); ?>
<script type="text/javascript">
    $j = jQuery.noConflict();

    $(document).ready(function() {


        $j("#dialogcycle").dialog({
            autoOpen: false,
            width: 500,
            modal: true,

            open: function(event, ui) {
                originalContent = $("#dialogcycle").html();
                $j('.ui-widget-overlay').bind('click', function() {

                    $j("#dialogcycle").dialog('close');
                    $("#dialogcycle").html(originalContent);

                });
            }

        });
        $j('.opendialogcycle').on('click', function() {

            index = $(this).attr('index');
            id = $('#id' + index).val();
            $('#iddialog').val(id);
            $j("#dialogcycle").dialog('open');
        });
    });
</script>