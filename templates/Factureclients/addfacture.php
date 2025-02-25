<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('calculvente'); ?>


<?php echo $this->fetch('script'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ajout facture client
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($factureclient, ['role' => 'form']); ?>


                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $mm, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group input select required">

                                        <label class="control-label" for="depot-id">Code Client</label>

                                        <select readonly name="client1" id="client1" class="form-control  control-label ">
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                            <?php foreach ($clients as $id => $client) {
                                            ?>
                                                <option <?php if ($client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                    echo $client->Code ?></option>
                                            <?php } ?>
                                        </select>


                                    </div>




                                </div>

                                <div class="col-xs-6">
                                    <div class="form-group input select required">

                                        <label class="control-label" for="depot-id">Nom Client</label>

                                        <select readonly name="client_id" id="client" class="form-control  control-label ">
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                            <?php foreach ($clients as $id => $client) {
                                            ?>
                                                <option <?php if ($client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                    echo $client->Raison_Sociale ?></option>
                                            <?php } ?>
                                        </select>


                                    </div>




                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('depot_id', ['readonly' => 'readonly', 'value' => $depot_id, 'options' => $depots, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Dépot', 'class' => 'form-control  control-label']); ?>
                                </div>


                            </div>
                        </div>







                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                            <div class="row">



                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('date', ['readonly', "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]); ?>
                                </div>










                                <?php echo $this->Form->control('exotva', ['type' => 'hidden', 'value' => '']); ?>
                                <?php echo $this->Form->control('exofodec', ['type' => 'hidden', 'value' => '']); ?>
                            </div>
                        </div>









                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">




                            <div class="row">







                            </div>

                            <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px" value="<?php echo $bonlivraison->client->Fodec ?>">


                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                                <div class="row">


                                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                        <div class="col-xs-6" style="margin-top: 20px ;">
                                            <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>

                                            OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="" style="margin-right: 20px" <?php if ($bonlivraison->payementcomptant == 1) { ?> checked="checked" <?php } ?>>
                                            NON <input type="radio" name="checkpayement" value="0" id="NON" class="" <?php if ($bonlivraison->payementcomptant == 0) { ?> checked="checked" <?php } ?>>


                                        </div>
                                    </div>
                                </div>
                            </div>


                            <br>
                            <br>

                            <!--                            <div class="col-md-12" id="blocclient" style="display: true;">
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
                            <div class="col-xs-3"  style="flex-direction:row; display: flex;margin-top: 30px">
                                <label>Type Clients : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <div id="typecli">
                                <?php if ($clientc->typeclient->grandsurface == false) { ?>
                                <a onClick="openWindow(1000, 1000, wr+'promoarticles/notgrandsurface/<?php echo $not ?>');"><?php echo $clientc->typeclient->type ?></a>
                                <?php } ?>
                                <?php if ($clientc->typeclient->grandsurface == true) { ?>
                                <a onClick="openWindow(1000, 1000, wr+'gspromoarticles/grandsurface/<?php echo $gs ?>');"><?php echo $clientc->typeclient->type ?></a>
                                <?php } ?>
                                </div>
                            </div>

                            <div class="col-xs-3" style="display: flex;margin-top: 30px;">
                                <label  style="margin-right: 20px">BL:</label>
                                <div id="BL">
                                OUI <input disabled type="radio" name="checkbl" value="1" id="OUI"  style="margin-right: 20px" <?php if ($bonlivraison->bl == 1) { ?> checked="checked" <?php } ?>>
                                NON <input disabled type="radio" name="checkbl" value="0" id="NON"  <?php if ($bonlivraison->bl == 0) { ?> checked="checked" <?php } ?>>

                                </div>
                              </div>

                            <div class="col-xs-2"  style="flex-direction:row;display: flex;margin-top: 40px;width: 20% !important;">
                                <label>Remise : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <div id="remi"> 
                                <?php if ($rz == 'avec palier') { ?>
                                    <a onClick="openWindow(1000, 1000, wr+'remiseclients/consultation/<?php echo $remcli ?>');"><?php echo $rz ?></a>
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
                               
                            <div class="col-xs-2"  style="flex-direction:row;display: flex;margin-top:25px;width: 20% !important;">
                                    <label>Escompte : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <div id="com"> 
                                    
                                    <?php if ($rz == 'avec palier') { ?>
                                        <a onClick="openWindow(1000, 1000, wr+'remiseescomptes/consultation/<?php echo $remes ?>');"><?php echo $es ?></a>
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
                    </div>-->

                            <div class="col-md-12" id="blocclient" style="display: true;">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <?php echo __('Solde'); ?>
                                        </h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="col-xs-12">
                                            <div class="col-xs-3" hidden>
                                                <label style="color: #c46210;">Plafond :</label>

                                                <?php
                                                echo $this->Form->input('plafond', array('readonly' => 'readonly', 'value' => $clientc->plafontheorique, 'style' => 'background-color:#FFEFD4; color:#000000 ;', 'label' => 'plafond', 'id' => 'plafond', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </div>
                                            <div class="col-xs-3">
                                                <label style="color: #350CEF;">Encours :</label>

                                                <?php
                                                echo $this->Form->input('encours', array('readonly' => 'readonly', 'value' => $encours,  'style' => 'background-color:#a1caf1; color:#000000 ;', 'label' => 'encours', 'id' => 'encours', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </div>
                                            <div class="col-xs-3">
                                                <label style="color: #C11616;"> Solde : </label>

                                                <?php
                                                echo $this->Form->input('solde', array('readonly' => 'readonly', 'value' => $solde, 'style' => 'background-color:#FFD4D4; color:#000000 ;', 'label' => 'solde', 'id' => 'solde', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </div>
                                            <div class="col-xs-3">
                                                <label style="color: #0C9A4A;"> Echanciére : </label>
                                                <?php
                                                echo $this->Form->input('echanciere', array('readonly' => 'readonly', 'value' => $echanciere, 'label' => 'echanciere', 'style' => 'background-color:#C6FBC6; color:#000000 ;', 'id' => 'echanciere', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </div>
                                            <div class="col-xs-3">
                                                <label style="color: #800080;"> Echanciére BL: </label>
                                                <?php
                                                echo $this->Form->input('echancierebl', array('readonly' => 'readonly', 'value' => $echancierebl, 'label' => 'echanciere bl', 'style' => 'background-color:#DB9CDB; color:#000000 ;', 'id' => 'echancierebl', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </div>

                                        </div>
                                        <!-- <input type="hidden" id="cl_id" value="<?php echo $clientc->id ?>">
                                   <input type="hidden" id="typeclient" value="<?php echo $cl; ?>">
                                  <input type="hidden" id="typeclientidd" value="<?php echo $clientc->typeclient_id ?>">
                                   <input type="hidden" id="gouvernorat_id" value="<?php echo $clientc->gouvernorat_id ?>"> -->

                                    </div>
                                </div>
                            </div>









                        </div>

                        <?php $poids = 0;
                        $nbli = 0;

                        foreach ($bonliv as $i => $com) {
                            $poids += $com->Poids;
                            $nbli += $com->nbligne;
                            $p = $com->pallette;
                            if ($p != 0) {
                                $coeff = $poids / $p;
                            }

                            //debug( $coeff );                  
                        }
                        ?>








                        <section class="content-header">
                            <h1 class="box-title"><?php echo __('Articles'); ?></h1>
                        </section>

                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box">
                                    <!-- <div class="box-header with-border">
                                        <a class="btn btn-primary al" table='addtable' index='index' id='ajouter_ligne_article' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                            <i class="fa fa-plus-circle "></i> Ajouter article</a>
                                    </div> -->
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                                                <thead>
                                                    <tr>
                                                        <td align="center" style="width: 8%; font: size 20px;"><strong>Code</strong></td>

                                                        <td align="center" style="width: 20%; font: size 20px;"><strong>Désignation</strong></td>
                                                        <td align="center" style="width: 6%;"><strong>Qte </strong></td>
                                                        <!-- <td align="center" style="width: 6%;"><strong>ml </strong></td> -->
                                                        <td align="center" style="width: 6%;"><strong>P.U.H.T</strong></td>
                                                        <td align="center" style="width: 8%;"><strong>Total HT</strong></td>
                                                        <td align="center" style="width: 4%;"><strong>Remise</strong></td>
                                                        <td align="center" style="width: 4%;"><strong> TVA </strong></td>
                                                        <!-- <td align="center" style="width: 4%; font: size 5px;"><strong style="font: size 5px;">Fodec</strong></td> -->
                                                        <td align="center" style="width: 8%;"><strong>Total TTC</strong></td>
                                                        <!-- <td align="center" style="width: 2%;"><strong></strong></td> -->

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($lignebonlivraisons as $i => $res) :
                                                        //debug($res);
                                                        $articleid = $res->article_id;
                                                        $depotid = $bonlivraison->depot_id;
                                                        date_default_timezone_set('Africa/Tunis');
                                                        $date = date("Y-m-d H:i:s");
                                                        $connection = ConnectionManager::get('default');


                                                        $artTable = TableRegistry::getTableLocator()->get('Articles');
                                                        $sousfamilleTable = TableRegistry::getTableLocator()->get('Sousfamille1s');
                                                        $sousfam = [];
                                                        $art = [];
                                                        if ($res->article_id != null) {
                                                            $art = $artTable->find()
                                                                ->where(['id' => $res->article_id])
                                                                ->first();
                                                            if ($art->sousfamille1_id != null) {
                                                                $sousfam = $sousfamilleTable->find()
                                                                    ->where(['id' => $art->sousfamille1_id])
                                                                    ->first();
                                                            }
                                                        }

                                                        $readonly = '';
                                                        if ($sousfam->remiseobligatoire == 0) {
                                                            $readonly = 'readonly';
                                                        }
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <!-- <label></label> -->
                                                                <select readonly name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" width="100%" id="<?php echo 'article_id' . $i ?>" table="ligner" index="<?php echo $i ?>" champ="article_id" style="pointer-events:none;" class="form-control articleidbl1">
                                                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                                    <?php foreach ($articles as $id => $article) {
                                                                    ?>
                                                                        <option style="font-size: 10px;" <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <!-- <label></label> -->
                                                                <select readonly name="<?php echo "data[ligner][" . $i . "][articledes]" ?>" width="100%" id="<?php echo 'articledes' . $i ?>" table="ligner" index="<?php echo $i ?>" champ="articledes" style="pointer-events:none;" class="form-control articleidbl1">
                                                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                                    <?php foreach ($articles as $id => $article) {
                                                                    ?>
                                                                        <option style="font-size: 10px;" <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo  $article->Dsignation ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                            <?php
                                                            echo $this->Form->input('id', array(
                                                                'champ' => 'id', 'label' => '', 'name' => 'data[ligner][' . $i . '][id]',
                                                                'value' => $res->id,
                                                                'type' => 'hidden', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group',
                                                                'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'
                                                            ));
                                                            ?>
                                                            <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>
                                                            </td>
                                                            <td align="center">

                                                                <?php echo $this->Form->input('qte', array('readonly', 'label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne  ', 'index')); ?>
                                                                <input type="hidden" value='<?php echo $res->article->Poids ?>' table="ligner" name="" id="<?php echo 'poids' . $i ?>" champ="poids" class="calcullignecommande form-control" index="<?php echo $i ?>">

                                                                <input type="hidden" table="ligner" name="" id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                                <input type="hidden" table="ligner" name="" id="<?php echo 'escompte' . $i ?>" champ="escompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                            </td>
                                                            <td align="center" hidden>
                                                                <?php echo $this->Form->input('ml', array('label' => '', 'value' => $res->ml, 'name' => 'data[ligner][' . $i . '][ml]', 'type' => 'text', 'id' => 'ml' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne ', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('prix', array('readonly', 'label' => '', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('ht', array('readonly', 'label' => '', 'value' => $res->qte * $res->punht, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('escompte', array('label' => '', 'value' => '', 'name' => 'data[ligner][' . $i . '][escompte]', 'type' => 'hidden', 'id' => 'escompte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                                <?php echo $this->Form->input('remise', array('readonly' => $readonly, 'label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne', 'index')); ?>
                                                            </td>
                                                            <td align="center">

                                                                <?php echo $this->Form->control('monatantlignetva', ['value' => $res->totaltva, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => 'monatantlignetva' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][monatantlignetva]', 'required' => 'off']); ?>


                                                                <?php echo $this->Form->input('tva', array('readonly', 'value' => $res->tva, 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                            </td>


                                                            <td align="center" hidden>

                                                                <?php echo $this->Form->control('fodeccommandeclient', ['value' => '', 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][fodeccommandeclient]', 'required' => 'off']); ?>

                                                                <?php echo $this->Form->input('fodec', array('readonly' => 'readonly', 'label' => '', 'value' => $res->fodec, 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => '', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>


                                                                <?php
                                                                echo $this->Form->input('totatlttc', array(
                                                                    'type' => 'hidden',
                                                                    'name' => 'data[ligner][' . $i . '][totalttc]',
                                                                    'label' => '', 'value' => $res->totalttc,
                                                                    'table' => 'ligner', 'index' => $i, 'id' => 'totalttc' . $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '
                                                                ));
                                                                ?>

                                                            </td>

                                                            <td align="center">
                                                                <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                            </td>
                                                            <!-- <td align="center">
                                                                <br>
                                                                <i index="<?php echo $i ?>" class="fa fa-times supLignearticle" style="color: #C9302C;font-size: 22px;">
                                                            </td> -->

                                                            </td>




                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tr>

                                                    <tr class="tr" style="display: none ">
                                                        <td align="center">

                                                            <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">

                                                            <select table="ligner" index champ="article_id" class="js-example-responsive  articleidbl1">
                                                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                                <?php foreach ($articles as $id => $article) {
                                                                ?>
                                                                    <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                <?php } ?>
                                                            </select>

                                                        </td>


                                                        <td align="center" table="ligner">
                                                            <input type="number" table="ligner" name="" id="" champ="qte" type="text" class=" calculligne form-control" index>
                                                        </td>

                                                        <td align="center" table="ligner" hidden>
                                                            <input table="ligner" champ="ml" type="text" class="form-control calculligne" index>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" champ="prix" class="form-control calculligne" index name=''>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input readonly table="ligner" type="text" champ="ht" class="form-control" index name=''>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" champ="remise" class="form-control calculligne" index name=''>
                                                            <input table="ligner" type="hidden" name="" champ="motanttotal" id='' class="form-control " index>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input readonly table="ligner" type="text" name="" champ="tva" id='' class="form-control" index>
                                                            <?php echo $this->Form->control('monatantlignetva', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => '', 'index', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                                                        </td>
                                                        <td>
                                                            <input readonly table="ligner" champ="fodec" type="text" class="form-control " index>
                                                            <?php echo $this->Form->control('fodeccommandeclient', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                                                        </td>
                                                        <td>
                                                            <input readonly table="ligner" type="text" name="" champ="ttc" class="form-control" index>

                                                        </td>

                                                        <td align="center">
                                                            <i index id="" class="fa fa-times supLignearticle" style="color: #c9302c;font-size: 22px;"></i>
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" value="<?php echo $i ?>" id="index">


                                                </tbody>
                                            </table>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </section>

                    </div>

                    <section class="content" style="width: 99%">
                        <div class="row" id="sec">
                            <div class="row">
                                <div style=" position: static;">
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalht', ['id' => 'totalht', 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                    </div>

                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalhtapres', ['id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totaltva', ['id' => 'totaltva', 'readonly' => 'readonly', 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalfodec', ['id' => 'totalfodec', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('timbre', ['value' => $timbre, 'id' => 'timbre', 'readonly' => 'readonly', 'label' => 'Timbre', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4 pull-right">
                                        <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'readonly' => 'readonly', 'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('observation', ['value' => $bonlivrai->observation, 'readonly', 'label' => 'Commentaire', 'class' => 'form-control',  'type' => 'textarea']); ?>

                            </div><br>
                        </div>
                    </section>



                    <div align="center">
                        <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff" id="boutonlivraison" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                    </div>
                    <?php echo $this->Form->end(); ?>

                </div>



            </div>
        </div>
</section>




<!-- Ajout ajax recupération select -->
<script type="text/javascript">
    $(document).ready(function() {

        Calculfacture();
    })






















    $(function() {
        var filterFloat = function(value) {
            if (/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
                .test(value))
                return Number(value);
            return NaN;
        }
        $('#client').on('change', function() {
            // alert('hello');
            id = $('#client').val();
            $('#cl_id').val(id);

            date = $('#date').val();
            // alert(date)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getremise']) ?>",
                dataType: "json",
                data: {
                    idfam: id,
                    date: date,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    // alert(data.select);
                    // alert(data.ligne.Fodec);
                    //  $('#adresselivraison-id').html(data.select);
                    $('#com_id').html(data.select);

                    //alert(data.typeclient);



                    $('#formule').val(data.ligne.prix);
                    $('#form').val(data.ligne.prix);
                    verifprix = data.ligne.prix;

                    if (verifprix == 'PHT+Fodec') {

                        formul = 'PHT+Fod';
                    }
                    if (verifprix == 'PHT') {

                        formul = 'PHT';
                    }
                    if (verifprix == '(PHT-Remise)+Fodec') {

                        formul = '(PHT-R%)+Fod';
                    }
                    if (verifprix == '((PHT-Remise)-Escompte)+Fodec') {

                        formul = '((PHT-R%)-Esc%)+Fod';
                    }
                    $('#prixverif').html(formul);
                    $('#categclient').val(data.valeurcategorie);

                    $('#remise').val(data.ligne.remise);
                    $('#fodecclient').val(data.ligne.Fodec);
                    //typeclient
                    $('#typeclient').val(data.typeclient);
                    $('#typeclientidd').val(data.typeclientid);
                    $('#gouvernerat').val(data.govname);

                    //$client->localite->name.' '.$client->delegation->name.' '.$client->delegation->codepostale
                    $('#typeclientname').val(data.typeclientname);
                    nom = data.typeclientname
                    valnot = Number(data.not);
                    //alert(data.typeclientname);
                    // valgs = Number(data.gs);
                    valgs = data.gs;
                    //alert("kkkkkk");
                    if (data.typeclient == false) {
                        if (valnot != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,wr+"promoarticles/notgrandsurface/' + valnot + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<a>' + nom + '</a>'
                            $('#typecli').html(a);

                        }
                    } else if (data.typeclient == true) {
                        if (valgs != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,wr+"gspromoarticles/grandsurface/' + valgs + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<a>' + nom + '</a>'
                            $('#typecli').html(a);
                        }
                    }


                    $('#nouv').val(data.ligne.nouveau_client);

                    valrem = Number(data.remcli);
                    valcom = Number(data.remes);
                    if (data.remise == true) {
                        $('#remise-val').val(data.ligne.remise);
                        if (valrem != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,wr+"remiseclients/consultation/' + valrem + '")\'>avec palier</a>'
                            $('#remi').html(a);
                        } else {
                            a = '<a>avec palier</a>'
                            $('#remi').html(a);
                        }
                    }

                    if (data.remise == false) {
                        $('#remise-val').val(data.ligne.remise);
                        div = '<div >sans palier</div>'
                        $('#remi').html(div);
                    }

                    if (data.escompte == true) {
                        $('#escompte-val').val(data.ligne.escompte);
                        if (valcom != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,wr+"remiseescomptes/consultation/' + valcom + '")\'>avec palier</a>'
                            $('#com').html(a);
                        } else {
                            a = '<a>avec palier</a>'
                            $('#com').html(a);
                        }
                    }
                    if (data.escompte == false) {
                        $('#escompte-val').val(data.ligne.escompte);
                        div = '<div >sans palier</div>'
                        $('#com').html(div);
                    }

                    bl = Number(data.typeclientbl);
                    if (data.typeclientbl == true) {
                        check = 'OUI <input disabled type="radio" name="checkbl" value="1" id="OUI" style="margin-right: 20px" checked> NON <input disabled type="radio" name="checkbl" value="0" id="NON" >'
                        $('#BL').html(check);
                    } else {
                        check = 'OUI <input disabled type="radio" name="checkbl" value="0" id="OUI" style="margin-right: 20px"> NON <input disabled type="radio" name="checkbl" value="1" id="NON"  checked>'
                        $('#BL').html(check);
                    }



                    $('#adresse').val(data.ligne.Adresse);
                    $('#matriculefiscale').val(data.ligne.Matricule_Fiscale);
                    $('#name').val(data.ligne.Code + " " + data.ligne.Raison_Sociale);
                    $('#telclient').val(data.tel);
                    $('#auto').val(data.autor);
                    $('#solde').val(data.solde);
                    $('#valreste').val(data.valreste);
                    //$('#typeclientid').val(data.typeclientid);
                    $('#blocclient').show();
                    page = $('#page').val() || 0;
                    //if(page=="factureclient"){
                    $('#typeclientid').parent().parent().html(data.select);
                    // uniform_select('typeclientid');


                    $('#fodecclientexo').val(data.exofodec);
                    $('#timbreclientexo').val(data.exotimbre);
                    $('#tvaclientexo').val(data.exotva);
                    $('#tpeclientexo').val(data.exotpe);

                    //   alert(data.exofodec);
                    if (data.exofodec == '' && data.exotva == '' && data.exotpe == '') {
                        $('#typeexenoration').val('Non exoneré');
                    } else {
                        $('#typeexenoration').val(data.exofodec + '/' + data.exotva + '/' + data.exotpe);
                    }





                }

            })


        });
    });














    $(function() {
        $('#client').on('change', function() {
            //alert('hello');
            id = $('#client').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getadresselivraison']) ?>",
                dataType: "json",
                data: {
                    idfam: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    // alert(data.ligne.Fodec);
                    $('#adresselivraison-id').html(data.select);
                    // uniform_select('adresse');
                    $('#exofodec').val(data.ligne.Fodec);
                    $('#exotva').val(data.ligne.R_TVA);




                }

            })
        });
    });

    $(function() {
        $('.pourcentescompte').on('blur', function() {

            index = $(this).attr('index');
            indexattr = $(this).attr('index');
            ind = Number($('#index').val());
            // $('#remisearticle' + index).val(0);
            //            if (ind != index) {
            //                indexpre = Number(index) + 1;
            //                // alert(indexpre+"indexpre");
            //                if ($('#articlee' + indexpre).val() != "") {
            //                    $('#sup' + indexpre).val('1');
            //                    $('#trart' + indexpre).hide();
            //                    //         $(this).parent().parent().hide();
            //                }
            //            }
            i = $(this).attr('index');
            // alert(index);

            qte = $('#qte' + index).val();
            formule = $('#formule').val();

            //alert(article_id);

            //alert(qte);
            test = 0;
            if (qte.match(/^(?:[1-9]\d*|0)?(?:\.\d+)?$/)) {
                test = 1;
            }
            if (test == 0) {
                $("#qte" + index).val("");
            }

            //alert(depot_id);
            //            $.ajax({
            //                method: "GET",
            //                type: "GET",
            //                async: false,
            //
            //                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
            //                dataType: "JSON",
            //                data: {
            //                    qte: qte,
            //
            //                },
            //                success: function(response) {
            //                    // alert(response);die;
            //                    //  alert(response.tab[0]['qtemax']);
            //                    numbers = response.tab;

            //alert(numbers);



            total = 0;
            totalremise = 0;
            remisecommande = 0;
            montanttpe = 0;
            montantfodec = 0;
            montanttva = 0;
            totalttc = 0;
            totalCommandettc = 0;
            motanttotal = 0;
            ttc = 0;
            fodeccommandeclient = 0;
            fod = 0;
            tpecommandeclient = 0;
            tpecmd = 0;
            monatantlignetva = 0;
            tvacomd = 0;
            //mahdi-------------------------------
            baseHT = 0;
            brutHT = 0;
            totrem = 0;
            totbrut = 0;
            totrmt = 0;
            montantescompte = 0;
            // tvacomd=0;
            vacomd = 0;
            totalmontantescompteligne = 0;
            totalmontantescomptelignee = 0;
            totalmotanttotal = 0;
            totaltpecommandeclient = 0;
            tpecommandeclient = 0;
            motanttotaltpe = 0;
            totalpoidsfin = 0;
            totalpoids = 0;
            //-------------------------------




            escompte = 0;
            nb = 0;
            index = $('#index').val();
            //                    for (j = 0; j <= index; j++) {
            //                        // alert(j);
            //                        sup = $('#sup' + j).val(); // alert(sup);
            //
            //                        nb++;
            //
            //                        if (Number(sup) != 1) {
            //                            tpe = $('#tpe' + j).val() || 0;
            //                            tva = Number($('#tva' + j).val()) || 0; // alert(tva);
            //                            fodec = $('#fodec' + j).val() || 0; //alert(tpe);        
            //                            fodecclientexo = $('#fodecclientexo').val();
            //                            tpeclientexo = $('#tpeclientexo').val();
            //                            tvaclientexo = $('#tvaclientexo').val();
            //                            qte = ($('#qte' + j).val()) * 1; //alert(qte);
            //                            poids = ($('#poids' + j).val()) * 1; //alert(qte);
            //                            totalpoids = Number(qte) * Number(poids);
            //                            totalpoidsfin += Number(totalpoids);
            //                            prix = $('#prix' + j).val(); // alert(prix);
            //                            qteStock = ($('#qteStock' + j).val()) * 1; //alert(qteStock);
            //
            //                            remisearticle = $('#remisearticle' + j).val() || 0; //alert(remisearticle);
            //
            //
            //                            netbrut = (Number(qte) * Number(prix)); // alert(netbrut+"montcal");
            //                            //   alert(netbrut);
            //                            totalremise = Number(remisearticle); //alert(totalremise+'totalremise')
            //                            montremise = Number(netbrut) * Number(totalremise) / 100;
            //                            montcal = Number(netbrut) - Number(montremise); //alert(montcal+"montcal")
            //                            totbrut += Number(prix) * Number(qte); //alert(totbrut+'totbrut')
            //
            //                           // calculbcr( indexattr);
            //
            //                        }
            //                    }


            calculbc(index);
            //}
            // })
        });

        $('.articleidbl1').on('change', function() {
            // alert("hh");
            index = $(this).attr('index');
            //  alert(index);
            article_id = $('#article_id' + index).val();
            //alert(article_id);
            datecreation = $('#date').val();
            depot_id = $('#depot-id').val(); //alert(depot_id)
            //alert(depot_id);
            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantite']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    idadepot: depot_id,
                },
                success: function(response) {
                    //  alert(index);

                    $('#prix' + index).val(response['donnearticle']["Prix_LastInput"]);
                    $('#ml' + index).val(response['donnearticle']["ml"]);
                    $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);
                    $('#fodec' + index).val(response['donnearticle']["fodec"]);
                    Calcul();
                }
            })
        });

        function calculbc(index) { //alert(index+'index')
            //alert('calculbc')
            ind = Number($('#index').val()); //alert(ind+'ind')
            i = ind;
            //   $('#remisearticle'+index).val(0);
            //            if(ind!=index){
            //                indexpre = Number(index)+1;
            //          // alert(indexpre+"indexpre");
            //                if( $('#articlee' + indexpre).val()!=""){
            //                    $('#sup' + indexpre).val('1');
            //         $(this).parent().parent().hide();
            //        }}

            // alert(index);
            articleid = $('#article_id' + index).val(); //alert(articleid)
            qte = $('#qte' + index).val();

            //alert(article_id);

            //alert(qte);
            test = 0;
            //if (qte.match(/^(?:[1-9]\d*|0)?(?:\.\d+)?$/)) { 
            //    test = 1;
            //}
            //if (test == 0) {
            //    $("#qte"+index).val("");
            //}

            //alert(depot_id);
            //        $.ajax({
            //            method: "GET",
            //            type: "GET",
            //            async: false,
            //
            //            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
            //            dataType: "JSON",
            //            data: {
            //                qte: qte,
            //
            //            },
            //            success: function(response) {
            //                // alert(response);die;
            //                //  alert(response.tab[0]['qtemax']);
            //                numbers = response.tab;
            //
            //                //alert(numbers);



            total = 0;
            totalremise = 0;
            remisecommande = 0;
            montanttpe = 0;
            montantfodec = 0;
            montanttva = 0;
            totalttc = 0;
            totalCommandettc = 0;
            motanttotal = 0;
            ttc = 0;
            fodeccommandeclient = 0;
            fod = 0;
            tpecommandeclient = 0;
            tpecmd = 0;
            monatantlignetva = 0;
            tvacomd = 0;
            //mahdi-------------------------------
            baseHT = 0;
            brutHT = 0;
            totrem = 0;
            totbrut = 0;
            totrmt = 0;
            montantescompte = 0;
            // tvacomd=0;
            vacomd = 0;
            totalmontantescompteligne = 0;
            totalmontantescomptelignee = 0;
            totalmotanttotal = 0;
            totaltpecommandeclient = 0;
            tpecommandeclient = 0;
            motanttotaltpe = 0;
            totalpoidsfin = 0;
            totalpoids = 0;
            //-------------------------------

            nb = 0;
            for (j = 0; j <= ind; j++) {
                // alert(j);
                sup = $('#sup' + j).val(); // alert(sup);

                nb++;

                if (Number(sup) != 1) {
                    tpe = $('#tpe' + j).val() || 0;
                    tva = Number($('#tva' + j).val()) || 0; // alert(tva);
                    fodec = $('#fodec' + j).val() || 0; //alert(tpe);        
                    fodecclientexo = $('#fodecclientexo').val();
                    tpeclientexo = $('#tpeclientexo').val();
                    tvaclientexo = $('#tvaclientexo').val();
                    qte = ($('#qte' + j).val()) * 1; //alert(qte+"qte");
                    poids = ($('#poids' + j).val()) * 1; //alert(poids+"poids");
                    totalpoids = Number(qte) * Number(poids);
                    totalpoidsfin += Number(totalpoids);
                    prix = $('#prix' + j).val(); // alert(prix);
                    qteStock = ($('#qteStock' + j).val()) * 1; //alert(qteStock);

                    remisearticle = $('#remisearticle' + j).val() || 0; //alert(remisearticle);


                    netbrut = (Number(qte) * Number(prix)); //alert(netbrut);
                    //   alert(netbrut);
                    totalremise = Number(remisearticle);
                    montremise = netbrut * totalremise / 100;
                    montcal = netbrut - montremise; //alert(montcal);
                    totbrut += Number(prix) * Number(qte); //alert(totbrut+'totbrut')
                    //getremsie(totbrut) ;
                    remiseclient = $('#remiseclient' + j).val() || 0; //alert(remiseclient+"remiseclient")

                    //                        montremiseclient = montcal* remiseclient / 100;//alert(montremiseclient)
                    //                        totremiseclient=Number(montremiseclient)+Number(montremise);//alert(totremiseclient)
                    //                                //    alert(totremiseclient);
                    //                         $('#totremiseclient' + j).val(Number(totremiseclient)); // alert(motanttotal);
                    //                        motanttotal=montcal-montremiseclient;//alert(motanttotal+'motanttotalremise');
                    //                  
                    montremiseclient = Number(netbrut) * (Number(remiseclient) + Number(remisearticle)) / 100; //alert(montremiseclient)
                    totremiseclient = Number(montremiseclient); //alert(totremiseclient)
                    //    alert(totremiseclient);
                    $('#totremiseclient' + j).val(Number(totremiseclient)); // alert(motanttotal);
                    motanttotal = netbrut - montremiseclient; //alert(motanttotal+'motanttotalremise');
                    $('#motanttotal' + j).val(Number(motanttotal)); // alert(motanttotal);










                    totrem = totrem + Number(totremiseclient); //alert(totrem+'totrem');

                    totaltotal = Number($('#motanttotal' + j).val()); //alert(Number($('#motanttotal' + j).val())+'total')

                    total = Number(total) + Number(totaltotal); //alert(Number($('#motanttotal' + j).val())+'total')

                    totremiseclientt = ($('#totremiseclient' + j).val());
                    totrmt += Number(totremiseclientt);
                    remisecommande += Number($('#remiseligne' + j).val()); //alert(remisecommande+'remisecommande')
                    //pourcentageescompte

                    if ($('#OUI').is(':checked')) {
                        getescompte(total);
                        valeurescompte = $('#valeurescompte').val(); //alert(valeurescompte+"valeurescompte");
                        montantescompte = total * Number(valeurescompte) / 100; //alert(montantescompte);
                        //  $('#valeurescompte').val(montantescompte);
                        //  alert(montantescompte+"esc");
                        //    $('#escompte').val(Number(montantescompte).toFixed(3));
                        montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100; //alert(montantescompte);
                        totalmontantescompteligne += Number(montantescompteligne);
                        montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                        totalmontantescomptelignee += Number(montantescomptelignee); //alert(totalmontantescomptelignee+"totalmontantescomptelignee")
                        montantescompte += Number(montantescompteligne);
                        $('#escompte' + j).val(Number(montantescomptelignee).toFixed(3));
                    }
                    //alert(total);
                    else {
                        $('#valeurescompte').val(0); //alert(valeurescompte+"valeurescompte");
                        valeurescompte = $('#valeurescompte').val();
                        montantescompte = 0; //alert(montantescompte);$('#escompte').val(0);}
                        // alert(montantescompte+"esc");
                        //  $('#escompte').val(Number(montantescompte).toFixed(3));
                        montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100;
                        totalmontantescompteligne += Number(montantescompteligne);
                        montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                        totalmontantescomptelignee += Number(montantescomptelignee);
                        montantescompte += Number(montantescompteligne);
                        $('#escompte' + j).val(Number(montantescomptelignee).toFixed(3));
                    }
                    //  alert(valeurescompte+"valeurescompte");
                    //  prixavecformulclient(prix, j, formule, fodec, tva, tpe, valeurescompte, remiseclient, remisearticle)
                    if (fodec != 0 && fodecclientexo == '') {
                        //   alert("cc");
                        montantfodec = montantescomptelignee * fodec / 100;
                        fod += montantfodec;

                        motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                        totalmotanttotal += Number(motanttotal);
                        $('#fodeccommandeclient' + j).val(Number(montantfodec));
                    } else {
                        montantfodec = 0;
                        fod += montantfodec;
                        $('#fodeccommandeclient' + j).val(Number(montantfodec));
                        motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                        totalmotanttotal += Number(motanttotal);
                    }


                    if (tpe != 0 && tpeclientexo == '') {
                        montanttpe = motanttotal * tpe / 100; //alert(montanttpe);
                        motanttotaltpe += montanttpe;
                        $('#tpecommandeclient' + j).val(Number(montanttpe));
                        tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                        totaltpecommandeclient += Number(tpecommandeclient);

                    } else {
                        montanttpe = 0 //alert(montanttpe);
                        motanttotaltpe += montanttpe;
                        $('#tpecommandeclient' + j).val(Number(montanttpe));
                        tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                        totaltpecommandeclient += Number(tpecommandeclient);
                    }







                    if (tva != 0 && tvaclientexo == '') {
                        //   alert("hh");
                        // alert("tva recup?r? apr?s if");
                        // alert(netht);

                        montanttva = Number(tpecommandeclient) * tva / 100; //alert(montanttva);
                        tvacomd += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                        $('#monatantlignetva' + j).val(Number(montanttva));
                        totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                        $('#totalttc' + j).val(Number(totalttc));
                        totalCommandettc += Number(totalttc);

                    } else {
                        montanttva = 0;
                        tvacomd += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                        $('#monatantlignetva' + j).val(Number(montanttva));
                        totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                        totalCommandettc += Number(totalttc);
                        $('#totalttc' + j).val(Number(totalttc));
                    }








                    //   escompte += Number($('#escompte' + j).val());


                    //$('#ttc' + i).val(Number(ttc));
                }
            }

            if ($('#OUI').is(':checked')) {
                getescompte(total);
                valeurescompte = $('#valeurescompte').val(); //alert(valeurescompte+"valeurescompte");
                montantescompte = total * Number(valeurescompte) / 100; //alert(montantescompte);
                //  $('#valeurescompte').val(montantescompte);
                //    alert(montantescompte+"esc");
                $('#escompte').val(Number(montantescompte).toFixed(3));
            }
            //alert(total);
            else {
                $('#valeurescompte').val(0); //alert(valeurescompte+"valeurescompte");
                valeurescompte = $('#valeurescompte').val();
                montantescompte = 0; //alert(montantescompte);$('#escompte').val(0);}
                //   alert(montantescompte+"esc");
                $('#escompte').val(Number(montantescompte).toFixed(3));
            }


            //                maxpourcentage = response.tab[numbers.length - 1]['pourcentage'];
            //                maxqte = response.tab[numbers.length - 1]['qtemax'];




            //                    brutHT=totalescom+remisecommande;
            //             
            //                    baseHT=totalescom+fod+tpecmd;
            // ttcfinal=baseHT+tvacomd;
            mntesc = $('#escompte').val();
            $('#nbligne').val(Number(nb));

            $('#brutHT').val(Number(totbrut).toFixed(3));
            $('#totalremise').val(Number(totrmt).toFixed(3));
            // alert(mntesc+" alert(mntesc);");
            totaltt = Number(totbrut) - Number(totrmt) - Number(mntesc);
            $('#total').val(Number(totaltt).toFixed(3));
            $('#fod').val(Number(fod).toFixed(3));
            $('#tpecommande').val(Number(motanttotaltpe).toFixed(3));
            totaltpecommandeclientt = Number(totaltt) + Number(fod) + Number(motanttotaltpe);
            $('#baseHT').val(Number(totaltpecommandeclientt).toFixed(3));

            $('#tvacommande').val(Number(tvacomd).toFixed(3));
            totaltpecommandeclienttc = Number(totaltpecommandeclientt) + Number(tvacomd);
            $('#totalttccommande').val(Number(totaltpecommandeclienttc).toFixed(3));
            $('#netapayer').val(Number(totaltpecommandeclienttc).toFixed(3));

            //totalpoidsfin

            // $('#escompte').val(Number(totalmontantescompteligne).toFixed(3));
            nbpallete = Number(totalpoidsfin) / 450;
            $('#Poids').val(Number(totalpoidsfin).toFixed(3));
            $('#Coeff').val(Number(nbpallete).toFixed(3));
            pal = Number(450);
            //alert(pal);
            $('#pallette').val(Number(pal));
            //-----------------------------------------
            //alert(total+"total")
            //alert(total+'total');




            //
            //            }
            //        })
        }
    });
</script>
















<!--    -->



<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
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

<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>

<?php $this->end(); ?>