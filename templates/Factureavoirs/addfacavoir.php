<?php

use Cake\Datasource\ConnectionManager;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php //echo $this->Html->script('hechem'); 
?>
<?php echo $this->Html->script('calculvente'); ?>
<section class="content-header">
    <h1>
        Ajout facture avoir
    </h1>
    <ol class="breadcrumb">

        <a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>

    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">


                <?php echo $this->Form->create($factureavoir, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">

                    <div class="row">

                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('numero', ["value" => $numspecial, 'readonly' => 'readonly']);


                            ?>
                        </div>
                        <div class="col-xs-1" hidden>
                            <?php echo $this->Form->control('typebl', ['label' => 'Type Bl', 'type' => 'text', 'value' => 2, 'required' => 'off']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]); ?>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label>Depots</label>

                                <select readonly name="depot_id" id="client" class="form-control  control-label ">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($depots as $dep) {
                                    ?>
                                        <option <?php if ($factureclient->depot_id == $dep->id) { ?> selected="selected" <?php } ?> value="<?php echo $dep->id; ?>"><?php echo $dep->name ?></option>
                                    <?php } ?>
                                </select>


                            </div>




                        </div>
                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label>Clients</label>

                                <select name="client_id" readonly id="client" class="form-control ">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($clients as $client) {
                                    ?>
                                        <option <?php if ($factureclient->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                    <?php } ?>
                                </select>


                            </div>




                        </div>
                    </div>

                </div>
                <div class="col-md-12" id="blocclient" style="display: none;">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo __('Info de client'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-6">
                                <?php
                                echo $this->Form->input('name', array('value' => $clientc->Raison_Sociale, 'readonly' => 'readonly', 'label' => 'Raison Sociale', 'id' => 'name', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                ?>
                            </div>
                            <div class="col-xs-3" style="flex-direction:row; display: flex;margin-top: 30px">
                                <label>Type Clients : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <div id="typecli">
                                    <?php if ($clientc->typeclient->grandsurface == false) { ?>
                                        <a onClick="openWindow(1000, 1000, 'http://codifaerp.isofterp.com/demo/promoarticles/notgrandsurface/<?php echo $not ?>');"><?php echo $clientc->typeclient->type ?></a>
                                    <?php } ?>
                                    <?php if ($clientc->typeclient->grandsurface == true) { ?>
                                        <a onClick="openWindow(1000, 1000, 'http://codifaerp.isofterp.com/demo/gspromoarticles/grandsurface/<?php echo $gs ?>');"><?php echo $clientc->typeclient->type ?></a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="col-xs-3" style="display: flex;margin-top: 30px;">
                                <label style="margin-right: 20px">BL:</label>
                                <div id="BL">
                                    OUI <input disabled type="radio" name="checkbl" value="1" id="OUI" style="margin-right: 20px" <?php if ($BL == 1) { ?> checked="checked" <?php } ?>>
                                    NON <input disabled type="radio" name="checkbl" value="0" id="NON" <?php if ($BL == 0) { ?> checked="checked" <?php } ?>>

                                </div>
                            </div>

                            <div class="col-xs-2" style="flex-direction:row;display: flex;margin-top: 40px;width: 20% !important;">
                                <label>Remise : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <div id="remi">
                                    <?php if ($rz == 'avec palier') { ?>
                                        <a onClick="openWindow(1000, 1000, 'http://codifaerp.isofterp.com/demo/remiseclients/consultation/<?php echo $remcli ?>');"><?php echo $rz ?></a>
                                    <?php } ?>
                                    <?php if ($rz == 'sans palier') {
                                        echo $rz;
                                    } ?>
                                </div>
                            </div>
                            <div class="col-xs-4" style="width:15%;margin-top: 10px;">
                                <?php
                                echo $this->Form->input('remisee', array('readonly' => 'readonly', 'label' => '', 'id' => 'remise-val', 'value' => $clientc->remise, 'class' => 'form-control'));
                                ?>
                            </div>

                            <div class="col-xs-6" style="margin-top:-70px">
                                <?php
                                echo $this->Form->input('matriculefiscale', array('value' => $clientc->Matricule_Fiscale, 'label' => 'Matricule Fiscale', 'id' => 'matriculefiscale', 'div' => 'form-group', 'readonly' => 'readonly', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                ?>
                            </div>

                            <div class="col-xs-2" style="flex-direction:row;display: flex;margin-top:25px;width: 20% !important;">
                                <label>Escompte : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <div id="com">

                                    <?php if ($rz == 'avec palier') { ?>
                                        <a onClick="openWindow(1000, 1000, 'http://codifaerp.isofterp.com/demo/remiseescomptes/consultation/<?php echo $remes ?>');"><?php echo $es ?></a>
                                    <?php } ?>
                                    <?php if ($es == 'sans palier') {
                                        echo $es;
                                    } ?>
                                </div>
                            </div>
                            <div class="col-xs-4" style="width:15%">
                                <?php
                                echo $this->Form->input('escompte', array('readonly' => 'readonly', 'label' => '', 'value' => $clientc->escompte, 'id' => 'escompte-val', 'class' => 'form-control'));
                                ?>
                            </div>

                            <div class="col-xs-6" style="margin-top:-75px">
                                <?php
                                echo $this->Form->input('adresse', array('value' => $clientc->Adresse, 'readonly' => 'readonly', 'label' => 'Adresse', 'id' => 'adresse', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                ?>
                            </div>

                            <input type="hidden" id="cl_id" value="<?php echo $clientc->id ?>">
                            <input type="hidden" id="typeclient" value="<?php echo $cl; ?>">
                            <input type="hidden" id="typeclientidd" value="<?php echo $clientc->typeclient_id ?>">

                            <input type="hidden" id="gouvernorat_id" value="<?php echo $clientc->gouvernorat_id ?>">

                        </div>
                    </div>
                </div>
                <?php
                if ($factureclient->client_id == 12) {
                    $stylee = "display:block;";
                } else {
                    $stylee = "display:none;";
                }
                if (/*$bonlivraison->typebl == 1 &&*/$factureclient->client_id == 12) {

                ?>
                    <div class="col-xs-4" id="divnomprenom" style="<?php echo $stylee; ?>">
                        <?php echo $this->Form->control('nomprenom', ['label' => 'Nom / Prénom', 'readonly' => 'readonly', 'value' => $factureclient->nomprenom, 'required' => 'off', 'class' => 'form-control focus']); ?>

                    </div>
                    <div class="col-xs-4" id="divnumeroident" style="<?php echo $stylee; ?>">
                        <?php echo $this->Form->control('numeroidentite', ['label' => 'Numéro identité', 'readonly' => 'readonly', 'value' => $factureclient->numeroidentite, 'required' => 'off', 'class' => 'form-control focus']); ?>

                    </div>
                    <div class="col-xs-4" id="divadresseclt" style="<?php echo $stylee; ?>">
                        <?php echo $this->Form->control('adressediv', ['label' => 'Adresse', 'readonly' => 'readonly', 'required' => 'off', 'value' => $factureclient->adressediv, 'class' => 'form-control focus']); ?>
                    </div>
                <?php } ?>
                <br>
                <br>
                <br>
                <?php
                if ($factureclient->client_id == 12) {
                    $style = 'display: none;';
                } else {
                    $style = 'display: block;';
                }
                ?>

                <div class="col-md-12" id="blocclientinfo" style="<?= $style; ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo __('Info de client'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            if ($typeclientid == 1) {
                                $styleMatri = '';
                                $styleNumi = 'style="display:none;"';
                            } else {
                                $styleMatri = 'style="display:none;"';
                                $styleNumi = '';
                            }
                            ?>
                            <div class="col-xs-4">
                                <?php echo $this->Form->control('name', array('readonly' => 'readonly', 'value' => $lignebloc->Raison_Sociale, 'label' => 'Raison Sociale', 'id' => 'name', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                ?>
                            </div>
                            <div class="col-xs-4">
                                <?php
                                echo $this->Form->control('Tel', array('readonly' => 'readonly', 'label' => 'Téléphone', 'value' => $lignebloc->Tel, 'id' => 'telclient', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                ?>
                            </div>
                            <div class="col-xs-4">
                                <?php echo $this->Form->control('typeclient', array('readonly' => 'readonly', 'label' => 'Type Client', 'value' => $typeclientname, 'id' => 'typeclientname', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                ?>
                            </div>
                            <div class="col-xs-4" id="matri" <?= $styleMatri; ?>>
                                <?php
                                echo $this->Form->control('matriculefiscale', array('label' => 'Matricule Fiscale', 'value' => $lignebloc->Matricule_Fiscale, 'id' => 'matriculefiscale', 'div' => 'form-group', 'readonly' => 'readonly', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                ?>
                            </div>
                            <div class="col-xs-4" id="numi" <?= $styleNumi; ?>>
                                <?php
                                echo $this->Form->control('numidentite', array('label' => 'Numéro Identité', 'value' => $lignebloc->numidentite, 'id' => 'numidentite', 'div' => 'form-group', 'readonly' => 'readonly', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                ?>
                            </div>


                            <div class="col-xs-4">
                                <?php
                                echo $this->Form->control('adresse', array('readonly' => 'readonly', 'value' => $adresse, 'label' => 'Adresse', 'id' => 'adresse', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                ?>
                            </div>
                            <div class="col-xs-4">
                                <?php
                                echo $this->Form->control('remiseee', array('readonly' => 'readonly', 'value' => $lignebloc->plafontheorique, 'id' => 'remise', 'label' => 'platfond théorique',  'class' => 'form-control'));
                                ?>
                            </div>
                        </div>


                    </div>
                </div>

                <br>

                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Ligne Facture avoir'); ?></h1>
                </section>
                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">


                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless">
                                        <thead>
                                            <tr>
                                                <th align="center" style="width: 12%; font-size: 16px;">Code</th>
                                                <th align="center" style="width: 20%; font-size: 16px;">Désignation</th>
                                                <th align="center" style="width: 8%; font-size: 16px;">Qté</th>
                                                <th align="center" style="width: 8%; font-size: 16px;color:#ff0000">Qté Av</th>

                                                <!-- <th scope="col" >Qté KG</th>
                                                <th scope="col" style="color:#ff0000">Qté KG Av</th> -->

                                                <td align="center" style="width: 6%;"><strong>P.Av.R </strong></td>

                                                <td align="center" style="width: 8%;"><strong> PUTTC </strong></td>
                                                <td align="center" style="width: 4%;"><strong>Remise</strong></td>

                                                <!-- <td align="center" style="width: 6%;"><strong>ml </strong></td> -->
                                                <td align="center" style="width: 6%;"><strong>P.U.H.T</strong></td>
                                                <td align="center" style="width: 8%;"><strong>T.HT</strong></td>
                                                <td align="center" style="width: 4%;"><strong> TVA </strong></td>
                                                <!-- <td align="center" style="width: 4%; font: size 5px;"><strong
                                                 style="font: size 5px;">Fodec</strong></td> -->
                                                <td align="center" style="width: 8%;"><strong>TTC</strong>
                                                </td>
                                                <td align="center" style="width: 2%;"><strong></strong>
                                                </td>
                                                <td hidden align="center" style="width: 8%;"><strong> TTC test</strong>
                                                </td>
                                                <!-- <th scope="col">TTC</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $connection = ConnectionManager::get('default');
                                            $i = -1;
                                            foreach ($lignefactures as $l) {
                                                //debug($l->remise);


                                                $connection = ConnectionManager::get('default');
                                                $qte = $connection->execute('SELECT SUM(lignefactureavoirs.quantite)  as q FROM lignefactureavoirs where lignefactureavoirs.lignefactureclient_id =' . $l->id . ' ;')->fetchAll('assoc');

                                                $liv = ($l->qte) - $qte[0]['q'];

                                                // debug($liv);

                                                if ($liv != 0) {
                                                    $i++;

                                            ?>
                                                    <tr class="cc">
                                                        <td>
                                                            <select readonly table="Lignefacture" name="data[Lignefacture][<?php echo $i ?>][article_id]" index="<?php echo  $i ?>" champ="article_id" class="form-control  ">
                                                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                                <?php foreach ($art as $id => $article) {
                                                                ?>
                                                                    <option readonly value="<?= h($article->id) ?>" <?php if ($article->id == $l->article_id) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?= h($article->Code) ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <?php //echo $this->Form->control('article_id', array('label' => '',  'value' => $l->article->Code, 'options' => $art, 'name' => 'data[Lignefacture][' . $i . '][article_id]', 'id' => 'article_id' . $i,  'index' => $i, 'class' => 'form-control ')); 
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <select readonly table="Lignefacture" name="data[Lignefacture][<?php echo $i ?>][article_idd]" index="<?php echo  $i ?>" champ="article_idd" class=" form-control   ">
                                                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                                <?php foreach ($art as $id => $article) {
                                                                ?>
                                                                    <option readonly value="<?= h($article->id) ?>" <?php if ($article->id == $l->article_id) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?= h($article->Dsignation) ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <?php //echo $this->Form->control('article_idd', array('label' => '',  'value' => $l->article->Dsignation, 'options' => $art, 'name' => 'data[Lignefacture][' . $i . '][article_idd]', 'id' => 'article_idd' . $i,  'index' => $i, 'class' => 'form-control ')); 
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->input('sup', array('name' => "data[Lignefacture][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden')); ?>

                                                            <?php

                                                            echo $this->Form->input('qte', array('name' => 'data[Lignefacture][' . $i . '][qte]', 'readonly', 'value' => $liv, 'label' => '', 'div' => 'form-group', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'qtee' . $i, 'champ' => 'qte', 'type' => 'text', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>

                                                        </td>
                                                        <td hidden>

                                                            <?php

                                                            echo $this->Form->input('qter', array('name' => 'data[Lignefacture][' . $i . '][qter]', 'value' => 0, 'label' => '', 'div' => 'form-group', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'qter' . $i, 'champ' => 'qter', 'type' => 'text', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>

                                                        </td>
                                                        <td hidden>

                                                            <?php echo $this->Form->input('id', array('value' => $l->id, 'name' => 'data[Lignefacture][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                                            <?php

                                                            // echo $this->Form->input('qtekg', array('name' => 'data[Lignefacture][' . $i . '][qtekg]', 'readonly', 'value' => $l->qtekg, 'label' => '', 'div' => 'form-group', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'qtekg' . $i, 'champ' => 'qtekg', 'type' => 'text', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); 
                                                            ?>

                                                        </td>
                                                        <td>
                                                            <?php

                                                            echo $this->Form->input('quantite', array('value' => $liv, 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][quantite]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'qte' . $i, 'champ' => 'quantite', 'type' => 'text', 'class' => 'form-control  calculligne2 ')); ?>

                                                        </td>
                                                        <td align="center" hidden>
                                                            <?php echo $this->Form->input('ml', array('label' => '', 'value' => $l->ml, 'name' => 'data[Lignefacture][' . $i . '][ml]', 'type' => 'text', 'id' => 'ml' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 ')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('puttcapr', array('label' => '', 'value' => $l->puttcapr, 'readonly' => 'readonly', 'name' => 'data[Lignefacture][' . $i . '][puttcapr]', 'type' => '', 'id' => 'puttcapr' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculligne2 findtth1 ttcligne')); ?>

                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('puttc', array('label' => '', 'value' => $l->puttc, 'name' => 'data[Lignefacture][' . $i . '][puttc]', 'type' => '', 'id' => 'puttc' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control findtth1 ttcligne')); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->input('remise', array('value' => $l->remise, 'readonly' => 'readonly', 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][remise]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'remise' . $i, 'champ' => 'remise', 'type' => 'text', 'class' => 'form-control  findtth2 ')); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->input('prix', array('value' => $l->punht, 'readonly' => 'readonly', 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][prix]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'prix' . $i, 'champ' => 'prix', 'type' => 'text', 'class' => 'form-control calculligne2 ')); ?>


                                                        </td>



                                                        <td>

                                                            <?php echo $this->Form->input('prixht', array('value' => $l->prixht, 'readonly' => 'readonly', 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][totalht]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'ht' . $i, 'champ' => 'totalht', 'type' => 'text', 'class' => 'form-control  ')); ?>
                                                        </td>
                                                        <td hidden>
                                                            <?php echo $this->Form->input('fodec', array('value' => $l->fodec, 'readonly' => 'readonly', 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][fodec]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'fodec' . $i, 'champ' => 'fodec', 'type' => 'text', 'class' => 'form-control  number ')); ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Form->input('tva', array('value' => $l->tva, 'readonly' => 'readonly', 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][tva_id]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'tva' . $i, 'champ' => 'tva_id', 'class' => 'form-control   number ')); ?>

                                                        </td>

                                                        <td align="center">
                                                            <?php echo $this->Form->input('ttc', array('label' => '', 'readonly' => 'readonly', 'value' => $l->ttc, 'name' => 'data[Lignefacture][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  verifttc ')); ?>
                                                            <?php echo $this->Form->input('ttchidden', array('label' => '', 'readonly' => 'readonly', 'value' => $l->ttchidden, 'name' => 'data[Lignefacture][' . $i . '][ttchidden]', 'type' => 'hidden', 'id' => 'ttchidden' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>

                                                        </td>
                                                        <td align="center">

                                                            <i index="<?php echo $i ?>" class="fa fa-times supLignearticle2" style="color: #C9302C;font-size: 22px;">
                                                        </td>
                                                    </tr>
                                            <?php }
                                            }
                                            ?>
                                        </tbody>
                                    </table><br>
                                    <input type="hidden" value="<?php echo $i; ?>" id="index" />
                                </div>

                            </div>
                        </div>


                        <!-- <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('remise', ['id' => 'remise', 'class' => 'form-control  ', 'readonly', 'value' => $factureclient->totalremise]); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('totalht', ['id' => 'ht', 'class' => 'form-control  ', 'readonly', 'value' => $factureclient->totalht]); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('fodec', ['id' => 'fodec', 'class' => 'form-control', 'readonly', 'value' => $factureclient->totalfodec]); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('totalttc', ['id' => 'ttc', 'class' => 'form-control  ', 'readonly', 'value' => $factureclient->totalttc]); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('tva', ['id' => 'tva', 'class' => 'form-control  ', 'readonly', 'value' => $factureclient->totaltva]); ?>
                        </div> -->


                        <div class="row">
                            <!-- <div style=" position: static;">
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('total', ['id' => 'totalht', 'name' => 'totalht', 'class' => 'form-control', 'value' => $factureclient->totalht, 'readonly' => 'readonly', 'label' => 'Total HT', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'name' => 'remise', 'class' => 'form-control', 'value' => $factureclient->totalremise, 'readonly' => 'readonly', 'label' => 'Total remise', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'class' => 'form-control', 'value' => $factureclient->totalremise, 'readonly' => 'readonly', 'label' => 'test remise', 'name' => 'remiseee', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalapres', ['class' => 'form-control', 'value' => $factureclient->totalht - $factureclient->totalremise, 'id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => 'Total HT après remise',  'required' => 'off']); ?>
                                </div>


                              
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control', 'name' => 'tva', 'value' => $factureclient->totaltva, 'readonly' => 'readonly', 'label' => 'Total TVA', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'name' => 'fodec', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'name' => 'totalputtc',  'readonly' => 'readonly', 'label' => 'Total puttc', 'value' => $factureclient->totalputtc,  'class' => 'form-control verifttctotal calculinversetot', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'name' => 'totalttc', 'label' => 'Total ttc', 'value' => $factureclient->totalttc,  'class' => 'form-control calculinversetot', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'readonly' => 'readonly', 'value' => $factureclient->totalttc, 'label' => 'test ttc', 'class' => 'form-control verifttctotal calculinversetot', 'required' => 'off']); ?>
                                </div>
                              
                                <?php //if ($bonlivraison->typebl == 2) { 
                                ?>
                                <div class="col-xs-4">
                                    <?php
                                    echo $this->Form->control('timbre', ['value' => $tim, 'type' => 'hidden', 'name' => 'timbre', 'id' => 'timbre', 'class' => 'form-control', 'readonly' => true,  'label' => 'Timbre']);

                                    echo $this->Form->control('timbre_id', ['options' => $tim, 'name' => 'timbre_id', 'id' => 'timbre_id', 'class' => 'form-control', 'readonly' => true,  'label' => 'Timbre']); ?>

                                </div>
                                <?php // } 
                                ?>
                            </div> -->

                            <div style=" position: static;">
                                <table style="width:55%;margin-left:70%;">
                                    <tr>
                                        <td>
                                            <strong> Total HT</strong>
                                        </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('total', ['id' => 'totalht', 'value' => $factureclient->totalht, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Total Remise </strong>
                                        </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('remisee', ['id' => 'totalremise', 'value' => $factureclient->totalremise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remisee', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Total TVA</strong>
                                        </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control', 'value' => $factureclient->totaltva, 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong> Total TTC </strong> </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'value' => $factureclient->totalttc, 'label' => false, 'name', 'class' => 'form-control  calculinversetot', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td> <strong> Timbre </strong> </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('timbre', ['value' => $tim, 'type' => 'hidden', 'name' => 'timbre', 'id' => 'timbre', 'class' => 'form-control', 'readonly' => true,  'label' => 'Timbre']);

                                                echo $this->Form->control('timbre_id', ['options' => $tim, 'name' => 'timbre_id', 'id' => 'timbre_id', 'class' => 'form-control', 'readonly' => true,  'label' => false]); ?>

                                            </div>

                                        </td>
                                    </tr>

                                    <tr hidden>
                                        <td>test remise</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'value' => $factureclient->totalremise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remiseee', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td>Total HT après remise</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalapres', ['class' => 'form-control', 'value' => $factureclient->totalht - $factureclient->totalremise, 'id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr hidden>
                                        <td>Total Fodec</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'value' => $factureclient->totalfodec, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td>Total PU ttc</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => $factureclient->totalputtc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td hidden>test ttc</td>
                                        <td>
                                            <div class="col-xs-4" hidden>
                                                <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'value' => $factureclient->totalttc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                                            </div>
                                            <!-- <div class="col-xs-4" hidden>
                                                      <?php echo $this->Form->control('totalapres1', ['id' => 'totalhtapres1', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'test après remise', 'name', 'required' => 'off']); ?>
                                                 </div> -->
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="pull-right btn btn-success btn-sm " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </section>
            </div>
            <!-- /.box --facavoir>
        </div>
    </div>
    <!-- /.row -->
</section>

<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(document).ready(function() {
        // calculeachat1();
    });
    /*$(".qteliv,.htb").on("keyup change", function() {
        ///alert('dalandaaaa')
        calculeachat1();
    });

    function calculeachat1() {
        index = $("#index").val();
        // alert(index);
        exontva = $("#exontva").val() || 0;
        taux = $("#taux").val();
        exonfodec = $("#exonfodec").val() || 0;
        totalremise = 0;
        totalht = 0;
        totalfodec = 0;
        totaltva = 0;
        totalttc = 0;
        for (i = 0; i <= index; i++) {
            sup = $("#sup0" + i).val() || 0;

            // if (Number(sup) != 1) {
            fodecl = 0;
            ht = 0;
            tval = 0;
            ttcl = 0;
            //   if ($("#qteliv" + i).val()) {
            //     qte = $("#qteliv" + i).val() || 0; //alert(qte);
            //} else {
            qte = $("#qte" + i).val() || 0;
            // alert(qte);
            // }
            prix = $("#prix" + i).val() || 0; //alert(prix);
            remise = $("#remise" + i).val() || 0; //alert(remise);
            //alert(remise);

            fodec = $("#fodec" + i).val() || 0;

            //tva = $('#tva' + i).val() || 0;
            // alert(tva)
            //alert(fodec)
            remisel = Number(qte) * Number(prix) * Number(remise / 100);
            totalremise = Number(totalremise) + Number(remisel);
            ht = Number(qte) * Number(prix) - Number(remisel);
            $("#ht" + i).val(Number(ht).toFixed(3));
            // alert(ht);
            totalht = Number(totalht) + Number(ht);
            fodecl = Number(ht) * Number(fodec / 100);
            totalfodec = Number(totalfodec) + Number(fodecl);
            htfodec = Number(ht) + Number(fodecl);
            var elt = document.querySelector("#tva_id" + i); //alert(elt)
            /* tvai = Number($('#tva_id' + i).val()); 
                   //alert(tvai)
                   tva=elt.options[tvai-1].label; */
    /* tva = Number($("#tva" + i).val()) || 0;
            /// alert(tva)
            if (exonfodec == "0") $("#fodec" + i).val();
            else $("#fodec" + i).val(0);
            if (exontva == "0") $("#tva" + i).val();
            else $("#tva" + i).val(3);
            tval = Number(htfodec) * Number(tva / 100);
            totaltva = Number(totaltva) + Number(tval);
            ttcl = Number(htfodec) + Number(tval);

            $("#ttc" + i).val(Number(ttcl).toFixed(3));

            totalttc = Number(totalttc) + Number(ttcl);

            totaldevise = Number(totalttc) / Number(taux);
        }
        
        $("#remise").val(Number(totalremise).toFixed(3));
        $("#ht").val(Number(totalht).toFixed(3));
        $("#fodec").val(Number(totalfodec).toFixed(3));
        $("#tva").val(Number(totaltva).toFixed(3));
        $("#ttc").val(Number(totalttc).toFixed(3));
        $("#totaldevise").val(Number(totaldevise).toFixed(3));
    }*/

    $(function() {
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
    $('.select2').select2();
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
<?php echo $this->Html->css('select2'); ?>


<?php $this->end(); ?>