<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ville $ville
 */
?>
<?php

use Cake\ORM\TableRegistry;
?>
<!-- Content Header (Page header) -->
<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'css']); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php ///echo $this->Html->script('salma'); 
?>
<?php echo $this->Html->script('calculvente'); ?>

<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
    <h1>
        Modification Commande
        <small><?php echo __(''); ?></small>
    </h1>
    <?php if ($type == 1) { ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
        </ol>
    <?php } ?>

    <?php if ($type == 2) { ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'indexm']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
        </ol>
    <?php } ?>

</section>




<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <?php
                //debug($commande);
                echo $this->Form->create($commande, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]);
                //  debug(str_replace(",", ".",$commande->total));
                //die;
                ?>
                <div class="box-body">

                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <!-- <div class="col-xs-2">

                                <div class="form-group input select">
                                    <div class="form-group input text required">
                                        <label class="control-label" for="name">Choix date</label>
                                        <select class="form-control select2" id="choixdate">
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                            <option value="0" <?php if ($commande->dateimp != null) { ?> selected="selected" <?php } ?>> Impérative</option>
                                            <option value="1" <?php if ($commande->dateintdebut != null && $commande->dateintfin != null) { ?> selected="selected" <?php } ?>> Intervale</option>

                                        </select>
                                    </div>
                                </div>

                            </div> -->

                            <!-- <div <?php if ($commande->dateimp == null) { ?> style="display:none" <?php } ?> class="col-xs-2" id="dateimp">

                                <?php echo $this->Form->control('dateimp', ['id' => 'dateimpp', 'type' => '', 'name' => 'dateimp', 'label' => 'Date impérative']); ?>



                            </div>

                            <div <?php if ($commande->dateintdebut == null) { ?> style="display:none" <?php } ?> class="col-xs-2" id="datedeb">




                                <?php echo $this->Form->control('dateintdebut', ['type' => '', 'value' => $commande->dateintdebut, 'name' => 'dateintdebut', 'label' => 'Date début', 'calss' => 'form-control']); ?>
                            </div>

                            <div <?php if ($commande->dateintfin == null) { ?> style="display:none" <?php } ?> class="col-xs-2" id="datef">
                                <?php echo $this->Form->control('dateintfin', ['type' => '', 'value' => $commande->dateintfin, 'name' => 'dateintfin', 'label' => 'Date fin', 'calss' => 'form-control']); ?>
                            </div> -->


                        </div>
                    </div>

                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="col-xs-1" hidden>
                                <?php echo $this->Form->control('typebl', ['label' => 'Type Bl', 'type' => 'text', 'value' => 1, 'required' => 'off']); ?>
                            </div>
                            <div class="col-xs-4">
                                <?php

                                use Cake\Core\Configure;
                                use Cake\Datasource\ConnectionManager;

                                $connection = ConnectionManager::get('default');
                                $client = $connection->execute('SELECT  * FROM clients where clients.id=' . $commande->client_id . ' ;')->fetchAll('assoc');
                                //   debug($client);die;
                                echo $this->Form->control('date');
                                //  debug($commande->client_id);
                                ?>
                            </div>
                            <div class="col-xs-4">
                                <?php
                                echo $this->Form->control('numero', ['readonly' => 'readonly']);
                                ?>
                            </div>
                            <div class="col-xs-4">
                                <?php
                                // echo 'tt'.$commande;
                                echo $this->Form->control('depot_id', ['value' => $commande->depot_id, 'class' => 'form-control select2 control-label', 'required' => 'off']);
                                ?>
                            </div>

                        </div>
                    </div>


                    <div class="col-xs-12">

                        <div class="col-xs-3">


                            <div class="form-group input select required">
                                <label class="control-label" for="depot-id"> Client</label>
                                <select name="client_id1" id="idclient1" class="form-control select2 clientinfo getclientdata1 control-label ">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                    <?php foreach ($clients as $id => $client) { ?>
                                        <option <?php if ($commande->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                        echo $client->Code . '' . $client->Raison_Sociale ?></option>
                                    <?php } ?>
                                </select>
                            </div>




                        </div>
                        <div class="col-xs-3" hidden>
                            <div class="form-group input select required">

                                <label class="control-label" for="depot-id">Nom Client</label>
                                <select name="client_id" id="idclient" class="form-control  getclientdata select2 control-label ">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                    <?php foreach ($clients as $id => $client) { ?>
                                        <option <?php if ($commande->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                        echo $client->Raison_Sociale ?></option>
                                    <?php } ?>
                                </select>


                            </div>




                        </div>
                        <div class="col-xs-7" id="blocclient" style="display: true;">
                            <!-- <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <?php echo __('Solde'); ?>
                                    </h3>
                                </div>
                                <div class="panel-body"> -->

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
                                <!-- <div class="col-xs-3">
                                    <label style="color: #800080;"> Echanciére BL: </label>
                                    <?php
                                    echo $this->Form->input('echancierebl', array('readonly' => 'readonly', 'value' => $echancierebl, 'label' => 'echanciere bl', 'style' => 'background-color:#DB9CDB; color:#000000 ;', 'id' => 'echancierebl', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                    ?>
                                </div> -->

                            </div>
                            <!-- <input type="hidden" id="cl_id" value="<?php echo $clientc->id ?>">
                                   <input type="hidden" id="typeclient" value="<?php echo $cl; ?>">
                                  <input type="hidden" id="typeclientidd" value="<?php echo $clientc->typeclient_id ?>">
                                   <input type="hidden" id="gouvernorat_id" value="<?php echo $clientc->gouvernorat_id ?>"> -->
                            <!-- 
                                </div>
                            </div> -->
                        </div>

                    </div>
                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <div class="col-xs-6" id="com_id" hidden>
                                <?php
                                echo $this->Form->control('commercial_id', ['class' => 'form-control select2 control-label', 'empty' => 'Veuillez choisir !!', 'required' => 'off']);
                                ?>
                            </div>




                        </div>
                    </div>

                    <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px" value="<?php echo $commande->client->Fodec ?>">

                    <div class="col-xs-6" hidden>

                        <?php echo $this->Form->control('etattransport_id', ['empty' => 'Veuillez choisir !!', 'options' => $etattransports, 'required' => 'off', 'label' => 'Etat transport', 'class' => 'form-control select2 control-label']); ?>
                    </div>


                    <div class="row" hidden>
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <div class="col-xs-6" style="margin-top: 20px ;">
                                <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>

                                OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="calcheck" style="margin-right: 20px" <?php if ($commande->payementcomptant == 1) { ?> checked="checked" <?php } ?>>
                                NON <input type="radio" name="checkpayement" value="0" id="NON" class="calcheck" <?php if ($commande->payementcomptant == 0) { ?> checked="checked" <?php } ?>>


                            </div>




                        </div>
                    </div>

                    <div>
                        <?php
                        echo $this->Form->input('bl', ['type' => 'hidden', 'label' => '', 'class' => 'form-control']);
                        ?>
                    </div>





                    <?php
                    if ($commande->client_id == 12) {
                        $stylee = "display:block;";
                    } else {
                        $stylee = "display:none;";
                    }
                    //   if (/*$bonlivraison->typebl == 1 &&*/$commande->client_id == 12) {

                    ?>
                    <div class="col-xs-4" id="divnomprenom" style="<?php echo $stylee; ?>">
                        <?php echo $this->Form->control('nomprenom', ['label' => 'Nom / Prénom', 'value' => $commande->nomprenom, 'required' => 'off', 'class' => 'form-control focus']); ?>

                    </div>
                    <div class="col-xs-4" id="divnumeroident" style="<?php echo $stylee; ?>">
                        <?php echo $this->Form->control('numeroidentite', ['label' => 'Numéro identité', 'value' => $commande->numeroidentite, 'required' => 'off', 'class' => 'form-control focus']); ?>

                    </div>
                    <div class="col-xs-4" id="divadresseclt" style="<?php echo $stylee; ?>">
                        <?php echo $this->Form->control('adressediv', ['label' => 'Adresse', 'required' => 'off', 'value' => $commande->adressediv, 'class' => 'form-control focus']); ?>
                    </div>
                    <?php //} 
                    ?>

                    <br>

                    <input value="<?php echo $exofodec ?>" type="hidden" name="fodecclientexo" id="fodecclientexo" class="" style="margin-right: 20px">
                    <input type="hidden" name="timbreclientexo" id="timbreclientexo" class="" style="margin-right: 20px">
                    <input value="<?php echo $exotva ?>" type="hidden" name="tvaclientexo" id="tvaclientexo" class="" style="margin-right: 20px">
                    <input value="<?php echo $exotpe ?>" type="hidden" name="tpeclientexo" id="tpeclientexo" class="" style="margin-right: 20px">




                    <input type="hidden" value="<?php echo $clientc->prix ?>" name="formule" id="formule" class="" style="margin-right: 20px">



                    <input type="hidden" name="escompteSociete" id="escompteSociete" value="<?php echo $escompte ?>" style="margin-right: 20px">

                    <br>
                    <br>
                    <?php
                    if ($commande->client_id == 12) {
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

                    <div class="col-md-12">





                        <section class="content-header">
                            <h1 class="box-title"><?php echo __('Articles'); ?></h1>
                        </section>

                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <a class="btn btn-primary al" table='addtable' index='index' id='ajouter_ligne_article' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                            <i class="fa fa-plus-circle "></i> Ajouter article</a>
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                                                <thead>
                                                    <tr style="font-size: 20px;">

                                                        <td align="center" style="width: 12%; font: size 23px;"><strong>Code</strong></td>

                                                        <td align="center" style="width: 23%; font: size 20px;"><strong>Désignation</strong></td>
                                                        <td align="center" style="width: 8%;"><strong>Qte Stock </strong></td>

                                                        <td align="center" style="width: 6%;"><strong>Qte </strong></td>
                                                        <!-- <td align="center" style="width: 6%;"><strong>ml </strong></td> -->
                                                        <td align="center" style="width: 6%;"><strong>P.Av.R </strong></td>

                                                        <td align="center" style="width: 8%;"><strong> PUTTC</strong></td>
                                                        <td align="center" style="width: 4%;"><strong>Remise</strong></td>

                                                        <td align="center" style="width: 6%;"><strong>P.U.H.T</strong></td>
                                                        <td align="center" style="width: 8%;"><strong>T.HT</strong></td>
                                                        <td align="center" style="width: 4%;"><strong> TVA </strong></td>
                                                        <!-- <td align="center" style="width: 4%; font: size 5px;"><strong style="font: size 5px;">Fodec</strong></td> -->


                                                        <td align="center" style="width: 8%;"><strong>TTC</strong></td>
                                                        <td align="center" style="width: 2%;"><strong></strong></td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($lignecommandes as $i => $res) :
                                                        $articleid =  $res->article_id;
                                                        $depotid = $commande->depot_id;
                                                        date_default_timezone_set('Africa/Tunis');
                                                        $date = date('Y-m-d H:i:s');
                                                        $connection = ConnectionManager::get('default');
                                                        $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                        $stockk = $inv[0]['v'];

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
                                                        <tr style="font-size: 18px;font-weight: bold;">
                                                            <td champ="tdcode">
                                                                <input table="ligner" index="<?php echo $i ?>" class="getdesignation articleidbl1" id="article_idcode<?php echo $i ?>" champ="article_idcode"
                                                                    type="text" list="codearticle_id<?php echo $i ?>"
                                                                    value="<?php echo htmlspecialchars($res->article->Code, ENT_QUOTES, 'UTF-8'); ?>">
                                                                <datalist table="ligner" index="<?php echo $i ?>"
                                                                    id="codearticle_id<?php echo $i ?>"
                                                                    champ="codearticle_id">
                                                                    <?php foreach ($articles as $article) { ?>
                                                                        <option style="font-size: 10px;"
                                                                            value="<?php echo htmlspecialchars($article->Code, ENT_QUOTES, 'UTF-8'); ?>">
                                                                            <?php echo htmlspecialchars($article->Code, ENT_QUOTES, 'UTF-8'); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </datalist>
                                                            </td>
                                                            <td champ="tddes">
                                                                <input table="ligner" index="<?php echo $i ?>" class="getcode articleidbl1des" id="article_iddes<?php echo $i ?>"
                                                                    champ="article_iddes" type="text" list="desarticle_id<?php echo $i ?>"
                                                                    value="<?php echo htmlspecialchars($res->article->Dsignation, ENT_QUOTES, 'UTF-8'); ?>">
                                                                <datalist table="ligner" index="<?php echo $i ?>"
                                                                    id="desarticle_id<?php echo $i ?>"
                                                                    champ="desarticle_id">
                                                                    <?php foreach ($articles as $article) { ?>
                                                                        <option style="font-size: 10px;"
                                                                            value="<?php echo htmlspecialchars($article->Dsignation, ENT_QUOTES, 'UTF-8'); ?>">
                                                                            <?php echo htmlspecialchars($article->Dsignation, ENT_QUOTES, 'UTF-8'); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </datalist>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                                <?php
                                                                echo $this->Form->input('id', array(
                                                                    'champ' => 'id',
                                                                    'label' => '',
                                                                    'name' => 'data[ligner][' . $i . '][id]',
                                                                    'value' => $res->id,
                                                                    'type' => 'hidden',
                                                                    'id' => '',
                                                                    'table' => 'ligner',
                                                                    'index' => '',
                                                                    'div' => 'form-group',
                                                                    'between' => '<div class="col-sm-12">',
                                                                    'after' => '</div>',
                                                                    'class' => 'form-control'
                                                                ));
                                                                ?>

                                                                <?php echo $this->Form->input('qteStock', array('readonly' => 'readonly', 'label' => '', 'value' => $stockk, 'name' => 'data[ligner][' . $i . '][qteStock]', 'type' => 'number', 'id' => 'qteStock' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control pourcentescompte ', 'index')); ?>

                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('article_idd', array('label' => '', 'readonly' => 'readonly', 'value' => $res->article_id, 'name' => 'data[ligner][' . $i . '][article_idd]', 'type' => 'hidden', 'id' => 'article_idd' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 focus', 'index')); ?>

                                                                <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'number', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control findtth2 focus', 'index')); ?>

                                                                <input type="hidden" table="ligner" name="" id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                            </td>
                                                            <td align="center" hidden>
                                                                <?php echo $this->Form->input('ml', array('label' => '', 'value' => $res->ml, 'name' => 'data[ligner][' . $i . '][ml]', 'type' => 'text', 'id' => 'ml' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 ', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('puttcapr', array('label' => '', 'value' => $res->puttcapr, 'readonly' => 'readonly', 'name' => 'data[ligner][' . $i . '][puttcapr]', 'type' => '', 'id' => 'puttcapr' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculligne2 findtth1 ttcligne')); ?>

                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('puttc', array('label' => '', 'value' => $res->puttc, 'name' => 'data[ligner][' . $i . '][puttc]', 'type' => '', 'id' => 'puttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  findtth1  ttcligne ', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('remise', array('readonly' => $readonly, 'label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ajoutligneeettc2 findtth1', 'index')); ?>

                                                                <?php echo $this->Form->input('montantht', array('label' => '', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][motanttotal]', 'type' => 'hidden', 'id' => 'motanttotal' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                                <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('prix', array('label' => '', 'value' => $res->prix, 'readonly' => 'readonly', 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 ', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('ht', array('readonly', 'label' => '', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                            </td>

                                                            <td align="center">
                                                                <?php echo $this->Form->control('monatantlignetva', ['value' => $res->totaltva, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => 'monatantlignetva' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][monatantlignetva]', 'required' => 'off']); ?>
                                                                <?php echo $this->Form->input('tva', array('value' => $res->tva, 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                            </td>
                                                            <td align="center" hidden>
                                                                <?php echo $this->Form->control('fodeccommandeclient', ['value' => $res->fodec, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][fodeccommandeclient]', 'required' => 'off']); ?>
                                                                <?php echo $this->Form->input('fodec', array('label' => '', 'value' => $res->fodec, 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => '', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                                <?php
                                                                echo $this->Form->input('totatlttc', array(
                                                                    'type' => 'hidden',
                                                                    'name' => 'data[ligner][' . $i . '][totalttc]',
                                                                    'label' => '',
                                                                    'value' => $res->totalttc,
                                                                    'table' => 'ligner',
                                                                    'index' => $i,
                                                                    'id' => 'totalttc' . $i,
                                                                    'div' => 'form-group',
                                                                    'between' => '<div class="col-sm-12">',
                                                                    'after' => '</div>',
                                                                    'class' => 'form-control '
                                                                ));
                                                                ?>
                                                            </td>

                                                            <td align="center">
                                                                <?php echo $this->Form->input('ttc', array('label' => '', 'readonly', 'value' => $res->totalttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control verifttc ', 'index')); ?>
                                                                <?php echo $this->Form->input('ttchidden', array('label' => '', 'readonly' => 'readonly', 'value' => $res->ttchidden, 'name' => 'data[ligner][' . $i . '][ttchidden]', 'type' => 'hidden', 'id' => 'ttchidden' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>

                                                            </td>
                                                            <td align="center" hidden>
                                                                <?php echo $this->Form->input('ttctest', array('readonly', 'label' => '', 'value' => $res->totalttc, 'name' => 'data[ligner][' . $i . '][ttctest]', 'type' => '', 'id' => 'ttctest' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control verifttc ', 'index')); ?>

                                                            </td>
                                                            <td align="center">

                                                                <i index="<?php echo $i ?>" class="fa fa-times supLignearticle2" style="color: #C9302C;font-size: 22px;">
                                                            </td>

                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tr>

                                                    <tr class="tr" style="display: none;font-size: 18px;font-weight: bold;">

                                                        <td champ="tdcode"><input table="ligner" class="getdesignation articleidbl1" champ="article_idcode" type="text">

                                                            <datalist table="ligner" champ="codearticle_id">
                                                                <?php foreach ($articles as $id => $article) { ?>
                                                                    <option value="<?php echo $article->Code; ?>">

                                                                    </option>

                                                                <?php } ?>
                                                            </datalist>
                                                        </td>
                                                        <td champ="tddes">
                                                            <input table="ligner" class="getcode articleidbl1des" champ="article_iddes" type="text">

                                                            <datalist table="ligner" champ="desarticle_id">
                                                                <?php foreach ($articles as $id => $article) { ?>
                                                                    <option value="<?php echo $article->Dsignation; ?>">

                                                                    </option>

                                                                <?php } ?>
                                                            </datalist>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">

                                                            <input readonly type="number" table="ligner" name="" id="" champ="qteStock" type="text" class=" calculligne2 form-control" index>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input type="hidden" table="ligner" name="" readonly champ="article_idd" class="  form-control" index>

                                                            <input type="number" table="ligner" name="" id="" champ="qte" type="text" class=" findtth2 form-control focus" index>
                                                        </td>

                                                        <td align="center" table="ligner" hidden>
                                                            <input table="ligner" champ="ml" type="text" class="form-control calculligne2" index>
                                                        </td>
                                                        <td align="center" table="ligner">

                                                            <input table="ligner" readonly type="text" name="" champ="puttcapr" class="form-control    calculligne2  findtth1  ttcligne" index>

                                                        </td>
                                                        <td>
                                                            <input table="ligner" type="text" name="" champ="puttc" class="form-control findtth1  ttcligne  " index>

                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" champ="remise" class="form-control  ajoutligneeettc2 findtth2" index name=''>
                                                            <input table="ligner" type="hidden" name="" champ="motanttotal" id='' class="form-control " index>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" readonly type="text" champ="prix" class="form-control calculligne2" index name=''>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input readonly table="ligner" type="text" champ="ht" class="form-control" index name=''>
                                                        </td>

                                                        <td align="center" table="ligner">
                                                            <input readonly table="ligner" type="text" name="" champ="tva" id='' class="form-control" index>
                                                            <?php echo $this->Form->control('monatantlignetva', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => '', 'index', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                                                        </td>
                                                        <td hidden>
                                                            <input readonly table="ligner" champ="fodec" type="text" class="form-control " index>
                                                            <?php echo $this->Form->control('fodeccommandeclient', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                                                        </td>

                                                        <td>
                                                            <input table="ligner" type="text" readonly name="" champ="ttc" class="form-control  verifttc " index>
                                                            <input table="ligner" type="hidden" name="" readonly champ="ttchidden" class="form-control" index>


                                                        </td>
                                                        <td hidden>
                                                            <input readonly table="ligner" type="text" name="" champ="ttctest" class="form-control  verifttc " index>

                                                        </td>
                                                        <td align="center">
                                                            <i index id="" class="fa fa-times supLignearticle2" style="color: #c9302c;font-size: 22px;"></i>
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" value="<?php echo $i ?>" id="index">
                                                </tbody>
                                            </table><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <section class="content" style="width: 99%">
                        <div class="row" id="sec">
                            <div class="row">
                                <!-- <div style=" position: static;">
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('total', ['id' => 'totalht',  'value' => $commande->total, 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'value' => $commande->remise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total remise', 'name' => 'remisee', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'class' => 'form-control', 'value' => $commande->remise, 'readonly' => 'readonly', 'label' => 'test remise', 'name' => 'remiseee', 'required' => 'off']); ?>
                                    </div>

                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalapres', ['id' => 'totalhtapres', 'readonly' => 'readonly', 'value' => $commande->total - $commande->remise, 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'readonly' => 'readonly',  'value' => $commande->tva, 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'readonly' => 'readonly', 'value' => $commande->fodec, 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => $commande->totalputtc, 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total puttc', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'label' => 'Total ttc', 'name', 'value' => $commande->totalttc, 'class' => 'form-control calculinversetot ', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'readonly' => 'readonly', 'value' => $commande->totalttctest, 'label' => 'test ttc', 'name', 'class' => 'form-control verifttctotal tot', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4 ">
                                        <?php echo $this->Form->control('Montant_Regler', ['type' => 'hidden', 'value' => '', 'id' => 'Montant_Regler', 'readonly' => 'readonly', 'label' => 'Montant_Regler', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4 ">
                                        <?php echo $this->Form->control('Montant_Reglercmd', ['type' => 'hidden', 'value' => $commande->Montant_Regler, 'id' => 'Montant_Reglercmd', 'readonly' => 'readonly', 'label' => 'Montant_Reglercmd', 'name', 'required' => 'off']); ?>
                                    </div>


                                  
                                   
                                </div> -->
                                <div style=" position: static;">
                                    <table style="width:55%;margin-left:70%;">
                                        <tr>
                                            <td>
                                                <strong> Total HT</strong>
                                            </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('total', ['id' => 'totalht','value' => $commande->total, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong> Total Remise </strong>
                                            </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('remisee', ['id' => 'totalremise','value' => $commande->remise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remisee', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong> Total TVA</strong>
                                            </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('tva', ['id' => 'totaltva','value' => $commande->tva, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <strong> Total TTC </strong> </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('totalttc', ['id' => 'ttc','value' => $commande->totalttc, 'label' => false, 'name', 'class' => 'form-control calculinversetot ', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>


                                        <tr hidden>

                                            <td> <strong> Montant Regler</strong></td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('Montant_Regler', ['class' => 'form-control tauxx', 'type' => 'text', 'id' => 'Montant_Regler', 'readonly' => 'readonly', 'label' => false, 'name' => 'Montant_Regler', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr hidden>
                                            <td>test remise</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1','value' => $commande->remise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'test remise', 'name' => 'remiseee', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr hidden>
                                            <td>Total HT après remise</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('totalapres', ['class' => 'form-control','value' => $commande->remise, 'id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr hidden>
                                            <td>Total Fodec</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('fodec', ['id' => 'totalfodec','value' => $commande->fodec, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr hidden>
                                            <td>Total PU ttc</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc','value' => $commande->totalputtc, 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total puttc', 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr hidden>
                                            <td>test ttc</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest','value' => $commande->totalttc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                                                </div>
                                                <!-- <div class="col-xs-4" hidden>
                                                      <?php echo $this->Form->control('totalapres1', ['id' => 'totalhtapres1', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'test après remise', 'name', 'required' => 'off']); ?>
                                                 </div> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <br>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'value' => $commande->observation, 'type' => 'textarea']);
                                ?>
                            </div>
                        </div>

                    </section>













                    <tr>
                        <td style="text-align:center;">

                            <!-- <div style="text-align:center;">
                                <button type="submit" class="btn btn-success btn-sm  verifqte chauff" id="boutonCommande" style="text-align: center">Enregistrer</button>
                            </div> -->
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 20px; margin-top: 20px; margin-bottom: 20px;">
                                <button type="submit" class="testdiv btn btn-success btn-sm verifqte chauff" id="boutonCommande" name="enregistrer" style="width: 130px;">
                                    Enregistrer
                                </button>
                                <button type="submit" class=" testdiv btn btn-primary btn-sm verifqte chauff" id="boutonpdf" name="pdf" style="width: 70px;">
                                    <i class="fa fa-print"></i> PDF
                                </button>


                                <br>
                            </div>
                            <?php echo $this->Form->hidden('action', ['id' => 'action']); ?>

                        </td>
                    </tr>
                    </table>

                </div>
                <br>
                <br>




            </div>
            <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
    </div>
    </div>
    <!-- /.row -->
</section>
<script>
    $(document).ready(function() {

        $(".testdiv").on("mouseover", function() {
            var client = $("#idclient1").val();
            var nom = $("#nomprenom").val();
            var iden = $("#numeroidentite").val();

            // alert(type);
            if (client == 12) {
                if (nom == "") {
                    alert("Saisie Le nom et prenom divers SVP !!");
                    return;
                } else

                if (iden == "") {
                    alert("Saisie Le numéro identité divers SVP !!");
                    return;
                }
            }
        })
    });
</script>
<script>
    $(document).ready(function() {
        $('.clientinfo').on('change', function() {
            // alert('hello');
            id = $('#idclient1').val();
            date = $('#date').val();
            //  alert(id)
            $('#blocclientinfo').hide();

            if (id != 12) {
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getblocclients']) ?>",
                    dataType: "json",
                    data: {
                        idfam: id,
                        date: date,

                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function(data) {

                        // alert(data.ligne);
                        $('#remise').val(data.ligne.plafontheorique);
                        $('#typeclientname').val(data.typeclientname);
                        $('#typeclientidd').val(data.typeclientid);
                        if (data.typeclientid == 1) {
                            $('#matri').show();
                            $('#numi').hide();
                        } else {
                            $('#matri').hide();

                            $('#numi').show();

                        }
                        $('#adresse').val(data.adresse);
                        $('#matriculefiscale').val(data.ligne.Matricule_Fiscale);
                        $('#numidentite').val(data.ligne.numidentite);
                        $('#name').val(data.ligne.Code + " " + data.ligne.Raison_Sociale);
                        $('#telclient').val(data.ligne.Tel);
                        $('#telclient1').val(data.ligne.Tel1);

                        $('#blocclientinfo').show();
                        // $('#fodecclientexo').val(data.exofodec);
                        // $('#timbreclientexo').val(data.exotimbre);
                        // $('#tvaclientexo').val(data.exotva);
                        // $('#tpeclientexo').val(data.exotpe);







                    }

                })

            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        let rowAdded = false;

        $(".getclientdata").on("change", function() {
            var client_id = $("#idclient").val();

            var typebl = $("#typebl").val();

            $('#blocclient').hide();

            // Check if the row has been added already to avoid duplication
            //  if (!rowAdded) {
            if (client_id == 12 /* && typebl == 1*/ ) {
                // ajoutermk('tabligne', 'index');
                // rowAdded = true; // Mark that the row is added
                $('#divnomprenom').attr('style', 'display:block;');
                $('#divnumeroident').attr('style', 'display:block;');
                $('#divadresseclt').attr('style', 'display:block;');
            } else if (client_id != 12) {
                // ajoutermk('tabligne', 'index');
                // rowAdded = true; // Mark that the row is added
                $('#divnomprenom').attr('style', 'display:none;');
                $('#divnumeroident').attr('style', 'display:none;');
                $('#divadresseclt').attr('style', 'display:none;');
                $('#divnomprenom').val('');
                $('#divnumeroident').val('');
                $('#divadresseclt').val('');
            }
            // }



            if (client_id !== "") {
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getclientdata']) ?>",
                    dataType: "json",
                    data: {
                        client_id: client_id,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                    },
                    success: function(data) {
                        console.log(data);
                        $('#blocclient').show();

                        $('#echanciere').val((data.echanciere).toFixed(3));
                        $('#echancierebl').val((data.echancierebl).toFixed(3));

                        $('#solde').val((data.solde).toFixed(3));
                        $('#plafond').val(data.donne.plafontheorique);

                        $('#encours').val((data.encours).toFixed(3));
                        // $('#nomprenom').focus();
                        $('#article_idcode0').focus();

                    },
                });
            }
        });


        $(".getclientdata1").on("change", function() {
            var client_id = $("#idclient1").val();

            var typebl = $("#typebl").val();

            $('#blocclient').hide();

            // Check if the row has been added already to avoid duplication
            //  if (!rowAdded) {
            if (client_id == 12 /* && typebl == 1*/ ) {
                // ajoutermk('tabligne', 'index');
                // rowAdded = true; // Mark that the row is added
                $('#divnomprenom').attr('style', 'display:block;');
                $('#divnumeroident').attr('style', 'display:block;');
                $('#divadresseclt').attr('style', 'display:block;');
            } else if (client_id != 12) {
                // ajoutermk('tabligne', 'index');
                // rowAdded = true; // Mark that the row is added
                $('#divnomprenom').attr('style', 'display:none;');
                $('#divnumeroident').attr('style', 'display:none;');
                $('#divadresseclt').attr('style', 'display:none;');
                $('#divnomprenom').val('');
                $('#divnumeroident').val('');
                $('#divadresseclt').val('');
            }
            // }


            if (client_id !== "") {
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getclientdata']) ?>",
                    dataType: "json",
                    data: {
                        client_id: client_id,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                    },
                    success: function(data) {
                        console.log(data);
                        // alert(data.echancierebl);
                        //if (data) {
                        /// alert(data.solde);
                        $('#blocclient').show();


                        $('#echanciere').val((data.echanciere).toFixed(3));
                        $('#echancierebl').val((data.echancierebl).toFixed(3));

                        $('#solde').val((data.solde).toFixed(3));


                        $('#plafond').val(data.donne.plafontheorique);

                        $('#encours').val((data.encours).toFixed(3));
                        $('#article_idcode0').focus();

                        // $('#nomprenom').focus();

                        // }
                    },
                });
            }
        });
    });
</script>
<script>
    $(function() {
        $('.summernote').summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']]
            ],
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Calibri',
                'Calibri light',
                'Sakkal Majalla',
                'Aldhabi',
                'Arabic typesetting',
                'Algerian',

                'Bell MT',
                'Bodoni MT',
                'Bookman Old Style',
                'Bradley Hand ITC',
                'Californian FB',
                'Centaur',
                'Century',
                'Corbel light',
                'Lucida Calligraphy',
                'Leelawadee UI',
                'Leelawadee UI Semilight',
                'Ink free',
                'Modern No. 20',
                'Monotype Corsiva',
                'Perpetua Titling MT',
                'Pristina',
                'Sitka text',
            ]
        });
    })
</script>
<script>
    $(document).ready(function() {
        $('.articleidbl1des').on('change', function() {
            // alert("hh");
            index = $(this).attr('index');
            //  alert(index);
            article_id = $('#article_iddes' + index).val(); //alert(article_id);
            //alert(article_id);
            datecreation = $('#date').val();
            idClient = $('#idclient1').val();
            depot_id = $('#depot-id').val(); //alert(depot_id)
            //alert(depot_id);
            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantitedes']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    idadepot: depot_id,
                    idClient: idClient,
                    date: datecreation,
                },
                success: function(response) {
                    //  alert(response);
                    qtestockx = response['inv'];

                    $('#qteStock' + index).val(qtestockx);
                    //  response['donnearticle']["remise"]=20;
                    $('#prix' + index).val(response['donnearticle']["Prix_LastInput"]);
                    val = (Number(response['donnearticle']["Prix_LastInput"]) * (1 - (response['donnearticle']["remise"] / 100)) * (1 + (Number(response['donnearticle']["tva"]["valeur"]) / 100))); //*(1+(Number(remise) / 100)) /*+ ((Number(puttc) - (puttc * (Number(tva) / 100))) * (Number(remise) / 100))*/;
                    $('#puttc' + index).val(val.toFixed(3));

                    $('#ttchidden' + index).val(val.toFixed(3));
                    $('#puttcapr' + index).val(val.toFixed(3));
                    $('#ml' + index).val(response['donnearticle']["ml"]);
                    $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);
                    $('#fodec' + index).val(response['donnearticle']["fodec"]);
                    $('#remise' + index).val(response['donnearticle']["remise"]);
                    $('#article_idd' + index).val(response['donnearticle']["id"]);
                    $('#qte' + index).focus();


                    // Calcul2();
                }
            })
        });
        $('.articleidbl1').on('change', function() {
            // alert("hh");
            index = $(this).attr('index');
            //  alert(index);
            article_id = $('#article_idcode' + index).val(); //alert(article_id);
            //alert(article_id);
            datecreation = $('#date').val();
            idClient = $('#idclient1').val();
            depot_id = $('#depot-id').val(); //alert(depot_id)
            //alert(depot_id);
            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantitecode']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    idadepot: depot_id,
                    idClient: idClient,
                    date: datecreation,
                },
                success: function(response) {
                    //  alert(response);
                    qtestockx = response['inv'];

                    $('#qteStock' + index).val(qtestockx);
                    //  response['donnearticle']["remise"]=20;
                    $('#prix' + index).val(response['donnearticle']["Prix_LastInput"]);
                    val = (Number(response['donnearticle']["Prix_LastInput"]) * (1 - (response['donnearticle']["remise"] / 100)) * (1 + (Number(response['donnearticle']["tva"]["valeur"]) / 100))); //*(1+(Number(remise) / 100)) /*+ ((Number(puttc) - (puttc * (Number(tva) / 100))) * (Number(remise) / 100))*/;
                    $('#puttc' + index).val(val.toFixed(3));
                    $('#ttchidden' + index).val(val.toFixed(3));
                    $('#puttcapr' + index).val(val.toFixed(3));
                    $('#ml' + index).val(response['donnearticle']["ml"]);
                    $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);
                    $('#fodec' + index).val(response['donnearticle']["fodec"]);
                    $('#remise' + index).val(response['donnearticle']["remise"]);
                    $('#article_idd' + index).val(response['donnearticle']["id"]);
                    $('#qte' + index).focus();


                    //  Calcul2();
                }
            })
        });
        // Calcul();
        // $(".boutonlivraison").on("keyup", function() {
        //     Calcul();
        // });

        $('.getcode').on('change', function() {
            index = $(this).attr('index'); //alert(index);
            selectedcodename = $(this).val(); //alert(selectedcodename);
            if (selectedcodename !== "") {

                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getcode']) ?>",
                    dataType: "json",
                    data: {
                        client: selectedcodename,
                        index: index,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                    },
                    success: function(data) {
                        if (data) {
                            //alert(data.select)
                            //alert(data.select)
                            // Determine which dropdown to update based on the ID

                            //  $("#tdcode"+index).html(data.select);
                            $("#codearticle_id" + index).html(data.select);
                            $('#article_idcode' + index).val(data.value);
                            $('#article_idcode' + index).focus();

                            //  $("#idclient1").html(data.select1);


                            // Trigger change event on updated dropdown if necessary
                            // $(this).trigger("change");
                        }
                    },
                });
            }
        });

        $('.getdesignation').on('change', function() {
            index = $(this).attr('index'); //alert(index);
            selectedcodename = $(this).val(); //alert(selectedcodename);
            if (selectedcodename !== "") {

                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getdesignation']) ?>",
                    dataType: "json",
                    data: {
                        client: selectedcodename,
                        index: index,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                    },
                    success: function(data) {
                        if (data) {
                            //alert(data.select)
                            //alert(data.select)
                            // Determine which dropdown to update based on the ID

                            //$("#tddes"+index).html(data.select);
                            $("#desarticle_id" + index).html(data.select);
                            $('#article_iddes' + index).val(data.value);
                            $('#article_iddes' + index).focus();


                            //  $("#idclient1").html(data.select1);


                            // Trigger change event on updated dropdown if necessary
                            // $(this).trigger("change");
                        }
                    },
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#boutonCommande').click(function() {
            $('#action').val('save');
        });

        // $('#boutonimprimer').click(function() {
        //     $('#action').val('saveAndImprime');
        // });

        $('#boutonpdf').click(function() {
            $('#action').val('saveAndImprimepdf');
        });
    });
    $(document).ready(function() {

        $('#idclient1').change(function() {
            var selectedcodename = $(this).val();
            $("#idclient").select2('destroy');
            $("#idclient").val(selectedcodename);
            $("#idclient").select2();

        });
        $('#idclient').change(function() {
            var selectedcodename = $(this).val();
            $("#idclient1").select2('destroy');
            $("#idclient1").val(selectedcodename);
            $("#idclient1").select2();

        });
        ///////////////

        $('.articlecode').change(function() {
            var index = $(this).attr('index');

            $("#articledes" + index).val('');
            selectedCodename = $("#article_id" + index).val();
            $("#articledes" + index).select2('destroy');
            $("#articledes" + index).val(selectedCodename);
            $("#articledes" + index).select2();
            $('#qte' + index).focus();

        });
        $('.articlecode2').change(function() {
            var index = $(this).attr('index');


            $("#article_id" + index).val('');
            selectedCodename = $("#articledes" + index).val();
            $("#article_id" + index).select2('destroy');
            $("#article_id" + index).val(selectedCodename);
            $("#article_id" + index).select2();
            $('#qte' + index).focus();
        });
        // $('.articlename').change(function() {
        //     $("#article_id" + index).val('');
        //     var selectedCodename = $(this).val();
        //     var index = $(this).attr('index');

        //   //  alert(selectedCodename);

        //     $("#article_id" + index).val(selectedCodename).change();
        // });

        // $('.articlecodename').change(function() {
        //     var selectedCodename = $(this).val();
        //     var index = $(this).attr('index');

        //   //  alert(selectedCodename);

        //     $("#article_id1" + index).val(selectedCodename).change();
        // });

        ////////////////

        $('.getcodename0703').change(function() {
            //var client = $(this).val();  // Use 'this' to reference the changed dropdown
            var selectedcodename = $(this).val();
            if (selectedcodename !== "") {
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'codenamee']) ?>",
                    dataType: "json",
                    data: {
                        client: selectedcodename,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                    },
                    success: function(data) {
                        if (data) {
                            //alert(data.select)
                            // Determine which dropdown to update based on the ID

                            $("#idclient").html(data.select);

                            $("#idclient1").html(data.select1);


                            // Trigger change event on updated dropdown if necessary
                            // $(this).trigger("change");
                        }
                    },
                });
            }
        });
    });
</script>
<script>
    $(function() {
        function getdesignation(selectedcodename, index) {

            // selectedcodename = $(this).val();alert(selectedcodename);
            // index = $(this).attr('index');//alert(index);
            // electedcodename = $(this).val();//alert(selectedcodename);

            if (selectedcodename !== "") {

                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getdesignation']) ?>",
                    dataType: "json",
                    data: {
                        client: selectedcodename,
                        index: index,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                    },
                    success: function(data) {
                        if (data) {
                            //alert(data.select)
                            //alert(data.select)
                            // Determine which dropdown to update based on the ID

                            $("#tddes" + index).html(data.select);

                            //  $("#idclient1").html(data.select1);


                            // Trigger change event on updated dropdown if necessary
                            // $(this).trigger("change");
                        }
                    },
                });
            }
        }

        function getcode(selectedcodename, index) {

            // selectedcodename = $(this).val();alert(selectedcodename);
            // index = $(this).attr('index');//alert(index);
            // electedcodename = $(this).val();//alert(selectedcodename);


            if (selectedcodename !== "") {

                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getcode']) ?>",
                    dataType: "json",
                    data: {
                        client: selectedcodename,
                        index: index,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                    },
                    success: function(data) {
                        if (data) {
                            //alert(data.select)
                            //alert(data.select)
                            // Determine which dropdown to update based on the ID

                            $("#tdcode" + index).html(data.select);

                            //  $("#idclient1").html(data.select1);


                            // Trigger change event on updated dropdown if necessary
                            // $(this).trigger("change");
                        }
                    },
                });
            }
        }

    });

    // $(document).ready(function() {
    //     $(".getclientdata").on("change", function() {
    //         var client_id = $("#idclient").val();
    //         ajoutermk('tabligne', 'index');
    //         $('#blocclient').hide();
    //         /// alert(client_id);
    //         if (client_id !== "") {
    //             $.ajax({
    //                 method: "GET",
    //                 url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getclientdata']) ?>",
    //                 dataType: "json",
    //                 data: {
    //                     client_id: client_id,
    //                 },
    //                 headers: {
    //                     "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
    //                 },
    //                 success: function(data) {
    //                     //// alert(data.donne);
    //                     $('#blocclient').show();

    //                     $('#echanciere').val((data.echanciere).toFixed(3));
    //                     $('#echancierebl').val((data.echancierebl).toFixed(3));

    //                     $('#solde').val((data.solde).toFixed(3));
    //                     $('#plafond').val(data.donne.plafontheorique);

    //                     $('#encours').val((data.encours).toFixed(3));

    //                 },
    //             });
    //         }
    //     });
    //     $(".getclientdata1").on("change", function() {
    //         var client_id = $("#idclient1").val();
    //         /// alert(client_id);
    //         ajoutermk('tabligne', 'index');
    //         $('#blocclient').hide();
    //         if (client_id !== "") {
    //             $.ajax({
    //                 method: "GET",
    //                 url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getclientdata']) ?>",
    //                 dataType: "json",
    //                 data: {
    //                     client_id: client_id,
    //                 },
    //                 headers: {
    //                     "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
    //                 },
    //                 success: function(data) {
    //                     if (data) {
    //                         $('#blocclient').show();

    //                         $('#echanciere').val((data.echanciere).toFixed(3));
    //                         $('#echancierebl').val((data.echancierebl).toFixed(3));

    //                         $('#solde').val((data.solde).toFixed(3));
    //                         $('#plafond').val(data.donne.plafontheorique);

    //                         $('#encours').val((data.encours).toFixed(3));

    //                     }
    //                 },
    //             });
    //         }
    //     });
    // });
</script>
<script>
    $(document).ready(function() {
        Calcul2();
       // Calcul();
        $(".boutonlivraison").on("keyup", function() {
           // Calcul();
        });


    });
</script>
<script type="text/javascript">
    $(function() {
        $('.articleidbl11').on('change', function() {
            // alert("hh");
            index = $(this).attr('index');
            //  alert(index);
            article_id = $('#articledes' + index).val();
            //alert(article_id);
            datecreation = $('#date').val();
            idClient = $('#idclient1').val();
            depot_id = $('#depot_id').val(); //
            //alert(depot_id)
            //alert(depot_id);
            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantite']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    idadepot: depot_id,
                    idClient: idClient,
                    date: datecreation,
                },
                success: function(response) {
                    //  alert(response);
                    qtestockx = response['inv'];

                    $('#qteStock' + index).val(qtestockx);
                    $('#prix' + index).val(response['donnearticle']["Prix_LastInput"]);
                    $('#ml' + index).val(response['donnearticle']["ml"]);
                    $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);
                    $('#fodec' + index).val(response['donnearticle']["fodec"]);
                    $('#remise' + index).val(response['donnearticle']["remise"]);
                    $('#qte' + index).focus();
                  //  Calcul();
                }
            })
        });

        $('#typecli').on('click', function() {
            alert("Pas de promotion trouvés");
        });

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
                    valnot = data.not;
                    //alert(data.typeclientname);
                    // valgs = Number(data.gs);
                    valgs = data.gs;
                    //alert("kkkkkk");
                    if (data.typeclient == false) {
                        if (valnot != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,wr+"promoarticles/notgrandsurface/' + valnot + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<a >' + nom + '</a>'
                            $('#typecli').html(a);

                        }
                    } else if (data.typeclient == true) {
                        if (valgs != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,wr+"gspromoarticles/grandsurface/' + valgs + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<a >' + nom + '</a>'
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
                        check = ' <label  > BL:</label> OUI <input  type="radio" name="bl" value="1" id="maryam" style="margin-right: 20px" checked> NON <input  type="radio" name="bl" value="0" id="mahdi" >'
                        $('#BL').html(check);
                    } else {
                        check = '<label style="" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label><input disabled type="hidden" name="che" value="0" id="mar" style="margin-right: 20px">  <input disabled type="hidden" name="che" value="1" id="mah"  checked>'
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
        $('.getstock').on('click', function() {
            index = $(this).attr('index'); //alert(index)
            article_id = $('#article_id' + index).val(); //alert(article_id)
            idClient = $('#client').val();
            date = $('#dateCom').val();
            // alert(date)
            //alert(idClient);//alert(
            depot_id = $('#depot-id').val(); //alert(depot_id)
            qtr = $('#qtr' + index).val() || 0;
            // alert(qtr)

            ms = "";

            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantite']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    idadepot: depot_id,
                    idClient: idClient,
                    date: date,
                },
                success: function(data, status, settings) {

                    stock = data.inv;
                    qtecommande = data.qtecommande;
                    if (stock == qtecommande) {
                        qte = qtr;
                    } else {
                        qte = qtecommande - qtr;
                    }
                    seuil = data.alert;
                    ms = (ms) + 'la quantité en stock est ' + stock + "\n";
                    ms = (ms) + 'la quantité commandé est ' + qte + "\n";
                    ms = (ms) + 'la quantité seuil est ' + seuil;
                    alert(ms)



                }
            })

        });

    });






    $(function() {
        //calcheck
        //            $('.clickclient').on('onchange', function () {
        //       
        //calculbc(1);
        //
        //    })
        // $('.calcheck').on('click', function() {

        //     calculbccheck();

        // })
        // $('.calculqte').on('blur', function() {
        //         index = $(this).attr('index');
        //            i = $(this).attr('index');
        //            // alert(index);
        //             articleid = $('#article_id' + index).val();
        //            qte = $('#qte' + index).val();
        //                  ind = Number($('#index').val());

        // })
        // $('.pourcentescompte').on('blur', function() {

        //     index = $(this).attr('index'); //alert(index)
        //     indexattr = $(this).attr('index');
        //     ind = Number($('#index').val());
        //     $('#remisearticle' + index).val(0);
        //     if (ind != index) {
        //         indexpre = Number(index) + 1;
        //         // alert(indexpre+"indexpre");
        //         if ($('#articlee' + indexpre).val() != "") {
        //             // alert('afefe')
        //             $('#sup' + indexpre).val('1');
        //             $('#trart' + indexpre).hide();
        //             //         $(this).parent().parent().hide();
        //         }
        //     }
        //     i = $(this).attr('index');
        //     // alert(index);

        //     qte = $('#qte' + index).val();
        //     formule = $('#formule').val();

        //     /// alert(formule);

        //     //alert(qte);
        //     test = 0;
        //     if (qte.match(/^(?:[1-9]\d*|0)?(?:\.\d+)?$/)) {
        //         test = 1;
        //     }
        //     if (test == 0) {
        //         $("#qte" + index).val("");
        //     }

        //     //alert(depot_id);
        //     //            $.ajax({
        //     //                method: "GET",
        //     //                type: "GET",
        //     //                async: false,
        //     //
        //     //                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
        //     //                dataType: "JSON",
        //     //                data: {
        //     //                    qte: qte,
        //     //
        //     //                },
        //     //                success: function(response) {
        //     //                    // alert(response);die;
        //     //                    //  alert(response.tab[0]['qtemax']);
        //     //                    numbers = response.tab;

        //     //alert(numbers);



        //     total = 0;
        //     totalremise = 0;
        //     remisecommande = 0;
        //     montanttpe = 0;
        //     montantfodec = 0;
        //     montanttva = 0;
        //     totalttc = 0;
        //     totalCommandettc = 0;
        //     motanttotal = 0;
        //     ttc = 0;
        //     fodeccommandeclient = 0;
        //     fod = 0;
        //     tpecommandeclient = 0;
        //     tpecmd = 0;
        //     monatantlignetva = 0;
        //     tvacomd = 0;
        //     //mahdi-------------------------------
        //     baseHT = 0;
        //     brutHT = 0;
        //     totrem = 0;
        //     totbrutt = 0;
        //     totrmt = 0;
        //     montantescompte = 0;
        //     // tvacomd=0;
        //     vacomd = 0;
        //     totalmontantescompteligne = 0;
        //     totalmontantescomptelignee = 0;
        //     totalmotanttotal = 0;
        //     totaltpecommandeclient = 0;
        //     tpecommandeclient = 0;
        //     motanttotaltpe = 0;
        //     totalpoidsfin = 0;
        //     totalpoids = 0;
        //     //-------------------------------




        //     escompte = 0;
        //     nb = 0;
        //     indext = $('#index').val(); //alert(indext)
        //     for (jj = 0; jj <= indext; jj++) {
        //         ///  alert(j);
        //         sup = $('#sup' + jj).val(); //  alert(sup);



        //         if (Number(sup) != 1) {
        //             nb++;
        //             tpe = $('#tpe' + jj).val() || 0;
        //             tva = Number($('#tva' + jj).val()) || 0; // alert(tva);
        //             fodec = $('#fodec' + jj).val() || 0; //alert(tpe);        
        //             fodecclientexo = $('#fodecclientexo').val();
        //             tpeclientexo = $('#tpeclientexo').val();
        //             tvaclientexo = $('#tvaclientexo').val();
        //             qte = ($('#qte' + jj).val()) * 1; //alert(qte);
        //             poids = ($('#poids' + jj).val()) * 1; //alert(qte);
        //             totalpoids = Number(qte) * Number(poids);
        //             totalpoidsfin += Number(totalpoids);
        //             prix = $('#prix' + jj).val(); // alert(prix);
        //             qteStock = ($('#qteStock' + jj).val()) * 1; //alert(qteStock);

        //             remisearticle = $('#remisearticle' + jj).val() || 0; //alert(remisearticle);


        //             netbrut = (Number(qte) * Number(prix)); // alert(netbrut+"montcal");
        //             //   alert(netbrut);
        //             totalremise = Number(remisearticle); //alert(totalremise+'totalremise')
        //             montremise = Number(netbrut) * Number(totalremise) / 100;
        //             montcal = Number(netbrut) - Number(montremise); //alert(montcal+"montcal")
        //             //alert(netbrut)
        //             totbrutt += Number(netbrut); //alert(totbrut+'totbrut')//
        //             //alert(totbrutt+'totbrutss')
        //             getremsie(totbrutt, indexattr);

        //         }
        //     }


        //     calculbc(indext);
        //     //}
        //     //})
        // });
    });




    function desactiveEnter() {
        return event.keyCode != 13;
        /* if (event.keyCode == 13) {
             event.keyCod
             e = 0;
             window.event.returnValue = false;
             //document.getElementById("text").innerHTML="&nbsp;&nbsp;&nbsp;Veuillez utiliser la souris pour valider ce devis ";
             bootbox.alert('&nbsp;&nbsp;&nbsp;?????? ??????? ?????? ???????? ')
         }*/
    }

    function ajouterlignepress() {

        if (event.keyCode == 120 || event.keyCode == 107 || event.keyCode == 9) {
            table = $(this).attr("table");
            //alert(table)
            //alert(table);

            //  alert("hh");
            //  alert(index);
            ind = Number($('#index').val()) + 1;

            //ind = Number($("#" + index).val()) + 1;
            //alert(ind)
            $ttr = $("#" + table)
                .find(".tr")
                .clone(true);
            $ttr.attr("class", "");
            i = 0;
            tabb = [];
            $ttr.find("input,select,textarea,tr,td,div,ul,li").each(function() {

                tab = $(this).attr("table"); //alert(tab)
                champ = $(this).attr("champ");
                $(this).attr("index", ind);
                $(this).attr("id", champ + ind); //alert(champ);
                if (champ == "marchandisetype_id") {
                    //alert(champ)
                    $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "][]");
                    $(this).attr(
                        "data-bv-field",
                        "data[" + tab + "][" + ind + "][" + champ + "]"
                    );
                } else {
                    $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "]");
                    $(this).attr(
                        "data-bv-field",
                        "data[" + tab + "][" + ind + "][" + champ + "]"
                    );
                }
                $type = $(this).attr("type");
                $(this).val("");
                if ($type == "radio") {
                    $(this).attr("name", "data[" + champ + "]");
                    //$(this).attr('value',ind);
                    $(this).val(ind);
                }
                if (champ == "datedebut" || champ == "datefin") {
                    $(this).attr("onblur", "nbrjour(" + ind + ")");
                }
                $(this).removeClass("anc");
                if ($(this).is("select", "multiple")) {
                    //alert(champ);
                    //alert(ind);
                    tabb[i] = champ + ind; //alert(tabb[i]);
                    i = Number(i) + 1;
                }
                // $(this).val('');
            });

            $ttr.find("i").each(function() {

                $(this).attr("index", ind);
            });
            $("#" + table).append($ttr);
            //alert(ind+"ind")
            $("#index").val(ind);

            $("#" + table)
                .find("tr:last")
                .show();
            $("#article_id" + ind).select2({
                width: "100%", // need to override the changed default
            });
            $("#charge_id" + ind).select2({
                width: "100%", // need to override the changed default
            });
            $("#article" + ind).select2({
                width: "100%", // need to override the changed default
            });
            $("#article" + ind).select2({
                width: "100%", // need to override the changed default
            });
            $("#client_id" + ind).select2({
                width: "100%", // need to override the changed default
            });
            $("#fr_id" + ind).select2({
                width: "100%", // need to override the changed default
            });
            $("#banque_id" + ind).select2({
                width: "100%", // need to override the changed default
            });
            $("#typeexon_id" + ind).select2({
                width: "100%", // need to override the changed default
            });

            $("#gouvernorat_id" + ind).select2({
                width: "75%", // need to override the changed default
            });
            //indd = Number($("#" + index).val()) ;
            //alert(indd);
            $("#inserted" + ind).val(1);

            for (j = 0; j <= i; j++) {
                // alert(tabb[j]);
                //  $('marchandisetype_id1').attr('class','select2');
                //  uniform_select(tabb[j]); jareb
                //$('#'+tabb[j]).select2({ });
            }
        }
    }




    function ajouterauto(table, index, articleid, qte, name) {
        //  alert(index);
        i = $(this).attr('index');
        //alert(i)
        j = Number(i) + 1;
        //alert(j)
        ind = Number($('#' + index).val()) + 1;
        //  qte = $("#qte" + i).val();
        //art = $("#article_id" + i).val();
        $ttr = $('#' + table).find('.tr').clone(true);
        $ttr.attr('class', '');
        i = 0;
        tabb = [];
        $ttr.find('input,select,textarea,tr,td,div,ul,li').each(function() {
            tab = $(this).attr('table'); //alert(tab)
            champ = $(this).attr('champ');
            $(this).attr('index', ind);
            $(this).attr('id', champ + ind); //alert(champ);
            if (champ == 'marchandisetype_id') {
                //alert(champ)
                $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + '][]');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            } else {
                $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            }
            //     if($ttr.find('tr')){
            //                 alert('afefe')
            //    $(this).attr('id',champ+ ind);
            //      }
            $type = $(this).attr('type');
            $(this).val('');
            if ($type == 'radio') {
                $(this).attr('name', 'data[' + champ + ']');
                //$(this).attr('value',ind);
                $(this).val(ind);
            }
            if ((champ == 'datedebut') || (champ == 'datefin')) {
                $(this).attr('onblur', 'nbrjour(' + ind + ')')
            }

            //         if (champ == 'afef') {
            //          alert('afefe')
            //           $(this).attr('id','afeff'+ ind);
            //    
            //      }
            $(this).removeClass('anc');
            if ($(this).is('select', 'multiple')) {
                //alert(champ);
                //alert(ind);
                tabb[i] = champ + ind; //alert(tabb[i]);
                i = Number(i) + 1;
            }
            // $(this).val('');
        })
        $ttr.find('i').each(function() {
            $(this).attr('index', ind);
        });
        $('#' + table).append($ttr);
        $('#' + index).val(ind);
        $('#' + table).find('tr:last').show();
        // $("#article_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });

        $('#' + table).find('tr:last').attr('id', 'trart' + ind);
        // // $('.tr').attr('id','trart'+ind);

        // $("#article" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        // $("#article_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        // $("#banque_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        // $("#typeexon_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        // $("#gouvernorat_id" + ind).select2({
        //     width: '75%' // need to override the changed default
        // });
        $("#qte" + j).val(qte);
        $("#prix" + j).val(0);
        $("#prixEntre" + j).val(0);
        $("#remiseclient" + j).val(0);
        $("#remisearticle" + j).val(0);
        $("#tva" + j).val(0);
        $("#tpe" + j).val(0);
        $("#qteStock" + j).val(0);
        $("#tdart" + j).hide();
        $("#td" + j).show();
        $("#totremiseclient" + j).val(0);
        $("#motanttotal" + j).val(0);

        $("#fodec" + j).val(0);



        // alert(articleid+"article");
        $("#article_id" + j).val(articleid);
        //alert(name)
        $("#articlee" + j).val(name);
        $('#articlee' + j).attr('readonly', "");
        //$("option[value='1']").remove();
        $('#qte' + j).attr('readonly', "");

        //    $('#articlee'+j).attr('name', "");
        //  $('#article_id'+j).attr('disabled', "");








        // var e = document.getElementById("article_id"+j);
        // var value = e.value;
        // var value = e.options[e.selectedIndex].text;
        // console.log(value)
        // $("option['value'="+value+"]");
        for (j = 0; j <= i; j++) {
            // alert(tabb[j]);
            //  $('marchandisetype_id1').attr('class','select2');
            //  uniform_select(tabb[j]); jareb
            //$('#'+tabb[j]).select2({ });
        }
    }





    $(function() {
        $('.supLigne0ch').on('click', function() {
            nbligne = $('#nbligne').val($('#nbligne').val() - 1);
            indd = Number($('#index').val());
            index = $(this).attr('index');
            artt = $('#article_id' + index).val();
            for (j = 0; j <= indd; j++) {
                art = $('#article_id' + j).val();
                if (Number(art) == Number(artt)) {
                    $('#trart' + j).hide();
                }
            }

            i = $(this).attr('index');
            //  alert(index);
            //  qte = $('#qte' + index).val();
            //          indexpre=Number(ind)+1;
            $('#sup' + i).val('1');
            $('#suptest' + i).val('1');

            $(this).parent().parent().hide();

            calculbc(i);
        })

    });
</script>
<script>
    $(document).ready(function() {

        $('#client1').change(function() {
            var selectedcodename = $(this).val();
            $("#client").select2('destroy');
            $("#client").val(selectedcodename);
            $("#client").select2();

        });
        $('#client').change(function() {
            var selectedcodename = $(this).val();
            $("#client1").select2('destroy');
            $("#client1").val(selectedcodename);
            $("#client1").select2();

        });
        ///////////////

        $('.articlecode').change(function() {
            var index = $(this).attr('index');

            $("#articledes" + index).val('');
            selectedCodename = $("#article_id" + index).val();
            $("#articledes" + index).select2('destroy');
            $("#articledes" + index).val(selectedCodename);
            $("#articledes" + index).select2();

        });
        $('.articlecode2').change(function() {
            var index = $(this).attr('index');


            $("#article_id" + index).val('');
            selectedCodename = $("#articledes" + index).val();
            $("#article_id" + index).select2('destroy');
            $("#article_id" + index).val(selectedCodename);
            $("#article_id" + index).select2();
        });
        // $('.articlename').change(function() {
        //     var selectedCodename = $(this).val();
        //     var index = $(this).attr('index');

        //   //  alert(selectedCodename);

        //     $("#article_id" + index).val(selectedCodename).change();
        // });

        // $('.articlecodename').change(function() {
        //     var selectedCodename = $(this).val();
        //     var index = $(this).attr('index');

        //   //  alert(selectedCodename);

        //     $("#article_id1" + index).val(selectedCodename).change();
        // });

        ////////////////

        $('.getcodename0703').change(function() {
            //var client = $(this).val();  // Use 'this' to reference the changed dropdown
            var selectedcodename = $(this).val();
            if (selectedcodename !== "") {
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'codenamee']) ?>",
                    dataType: "json",
                    data: {
                        client: selectedcodename,
                    },
                    headers: {
                        "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                    },
                    success: function(data) {
                        if (data) {
                            //alert(data.select)
                            // Determine which dropdown to update based on the ID

                            $("#idclient").html(data.select);

                            $("#idclient1").html(data.select1);


                            // Trigger change event on updated dropdown if necessary
                            // $(this).trigger("change");
                        }
                    },
                });
            }
        });
    });
</script>





<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>


<?php $this->start('scriptBottom'); ?>

<script>
    $(function() {

        $(".ajouterligne").on('click', function() {

            table = $(this).attr('table'); //id table
            index = $(this).attr('index'); // id max compteur

            tr = $(this).attr('tr'); //class class type
            ind = Number($('#' + index).val()) + 1;
            $ttr = $('#' + table).find('.' + tr).clone(true);
            $ttr.attr('class', 'cc'); //amin
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
                width: '100%' // need to override the changed default
            });

            $('.trstituation').hide();

        });

        $(document).on("input", ".sum-input", function() {
            sum = 0;
            index = $(this).attr('index');
            sumInputs = document.querySelectorAll(".sum-input");

            for (i = 0; i < sumInputs.length; i++) {

                if ($('#montant' + i).is(":visible")) {
                    // Replace commas with periods
                    //alert('hhhh');
                    var montantValue = $('#montant' + i).val().replace(',', '.');

                    if ($('#paiement_id' + i).val() == 10) {
                        sum = Number(sum) - Number(montantValue) || 0;
                    } else {
                        sum += Number(montantValue) || 0;
                    }
                }
            }
            totalmnt = $("#totalmnt").val();
            // alert(sum);
            $("#Montant_Regler").val(Number(sum) + Number(totalmnt));
            $("#Montant_Reglercmd").val(Number(sum));

        });


        $('.suppiece').on('click', function() {
            ind = $(this).attr('index');
            $('#sup2' + ind).val(1);
            $(this).parent().parent().hide();
            $('#btnenr').prop("disabled", false);
            v = $('#index').val();
            // console.log(v);
            tt = 0;
            th = 0;
            for (i = 0; i <= v; i++) {
                if ($('#sup2' + i).val() != 1) {
                    th = $('#montant' + i).val() || 0;
                    tt = Number(tt) + Number(th);
                }
            }
            var sum = 0;
            $(".sum-input").each(function() {
                if ($(this).is(":visible")) {
                    sum += Number($(this).val()) || 0;
                }
            });
            totalmnt = $("#totalmnt").val();
            $("#Montant_Regler").val(Number(sum) + Number(totalmnt));
            $("#Montant_Reglercmd").val(sum);
            $('#Montant').val(sum);
        });


        $('.modereglement2').on('change', function() {

            index = $(this).attr('index');
            val = $(this).val();
            typefrs = $('#typefrs').val();
            nb = 0;

            $('#montant' + index).val('');

            diff2();

            if (Number(val) == 1) {
                //alert(val);
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
                $('#trbanque' + index).hide();
                $('#trbanquea' + index).hide();
                $('#trbanqueb' + index).hide();
                // $('#trnum'+index).attr('class','') ;
                $('#trimg' + index).show();
                $('#numpiece' + index).hide();
                $('#porteur' + index).hide();
                $('#nrib' + index).hide(); // modifiction amin   
                $('#trnuma' + index).hide();
                $('#trnumb' + index).hide();
                $('#trporteura' + index).hide();
                $('#trporteurb' + index).hide();
                $('#trriba' + index).hide();
                $('#trribb' + index).hide();
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
            } else if (Number(val) == 22) {
                //alert(val);
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
                $('#numpiece' + index).hide();
                $('#porteur' + index).hide();
                $('#nrib' + index).hide(); // modifiction amin   
                $('#trnuma' + index).hide();
                $('#trnumb' + index).hide();
                $('#trporteura' + index).hide();
                $('#trporteurb' + index).hide();
                $('#trriba' + index).hide();
                $('#trribb' + index).hide();
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
            } else if (Number(val) == 2) {
                //alert('cheque');
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

                $('#trbanquea' + index).hide();
                $('#trbanqueb' + index).hide();
                $('#banque_idb' + index).hide(); // modifiction amin  
                $('#banque_ida' + index).hide();

                $('#numpiece' + index).show();
                $('#porteur' + index).show();
                $('#nrib' + index).show(); // modifiction amin   
                $('#trnuma' + index).show();
                $('#trnumb' + index).show();
                $('#trporteura' + index).show();
                $('#trporteurb' + index).show();
                $('#trriba' + index).show();
                $('#trribb' + index).show();

                //ajouter select carnet trnumb0
                $('#trcarnetnuma' + index).show(); //alert('ok')
                $('#trcarnetnumb' + index).show(); //alert('ok')
                $('#divnumc' + index).show(); //alert('ok')
                $('#divportc' + index).show();
                $('#divribc' + index).show();

                $('#divnump' + index).show(); //alert('ok')
                $('#divportp' + index).show();
                $('#divribp' + index).show();

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
                $('#trporteura' + index).show();
                $('#trporteurb' + index).show();
                $('#trriba' + index).show();
                $('#trribb' + index).show();
                $('#numpiece' + index).show(); // modifiction amin   
                $('#porteur' + index).show();
                $('#nrib' + index).show();
                $('#divnump' + index).show();
                $('#divportp' + index).show();
                $('#divribp' + index).show();
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
                ('#divportc' + index).hide();
                $('#divribc' + index).hide();
                $('#trechancea' + index).show();
                $('#trechanceb' + index).show();
                $('#trbanquea' + index).show();
                $('#trbanqueb' + index).show();
                $('#banque_idb' + index).show(); // modifiction amin
                $('#banque_ida' + index).show(); // modifiction amin
                //$('#trechance'+index).attr('class','display:none') ;
                $('#trnuma' + index).show();
                $('#trnumb' + index).show();
                $('#trporteura' + index).show();
                $('#trporteurb' + index).show();
                $('#trriba' + index).show();
                $('#trribb' + index).show();

                $('#divnump' + index).show();
                $('#divportp' + index).show();
                $('#divribp' + index).show();


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
                $('#trporteura' + index).hide();
                $('#trporteurb' + index).hide();
                $('#trriba' + index).hide();
                $('#trribb' + index).hide();
                $('#numpiece' + index).hide();
                $('#porteur' + index).hide();
                $('#nrib' + index).hide(); // modifiction amin   

                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
            }



        });
        $('.montantbrut').on('keyup change', function() {
            // alert('hhh')
            index = $('#index').val();
            max = $('#max').val();
            variable1 = 0;
            for (i = 0; i <= max; i++) {
                if ($('#factureclient_id' + i).is(':checked')) {
                    variable1 = Number($('#Montantregler' + i).val()) + variable1
                }
            }
            montantbrut = $('#montantbrut' + index).val(variable1) || 0;
            //alert(montantbrut);
            t = $('#taux' + index).val() || 0; //alert(t);
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
            $('#montantnet' + index).val(retenue);

            // net=(montantbrut-retenue).toFixed(3);
            // $('#montantnet'+index).val(net);
            // $('#netapayer').val(net);
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
            // console.log(tt);
            $('#Montant').val((tt).toFixed(3));

        });
    });




    function diff2() {
        total = Number($('#ttpayer').val());
        max = $('#index').val();
        /*  sup = $('#sup'+index).val(); */
        variable1 = 0;

        //  alert(max);
        for (i = 0; i <= max; i++) {
            // alert($('#sup'+i).val());
            if ($('#sup' + i).val() != 1) {
                //  alert($('#paiement_id' + i).val());
                if ($('#paiement_id' + i).val() == 10) {
                    variable1 = Number(variable1) - Number($('#montant' + i).val());
                    //  alert($('#paiement_id' + i).val());
                } else {
                    variable1 = Number(variable1) + Number($('#montant' + i).val());
                    // alert( Number($('#montant' + i).val()));

                }
            }

        }
        //  alert(total);
        //  alert(variable1);
        $('#mtotal').val(variable1.toFixed(3));


        $('#difference').val((total - variable1).toFixed(3));
    }
</script>
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
    $('.select2').select2({
        width: '100%' // need to override the changed default
    });
    //Datemask dd/mm/yyyy
    //    $('#datemask').inputmask('dd/mm/yyyy', {
    //        'placeholder': 'dd/mm/yyyy'
    //    })
    //    //Datemask2 mm/dd/yyyy
    //    $('#datemask2').inputmask('mm/dd/yyyy', {
    //        'placeholder': 'mm/dd/yyyy'
    //    })
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
    $(document).ready(function() {


        $(document).on('keyup', '.focuss', function(e) {
            //alert('fff')
            e.preventDefault(); //
            if (event.which == 13) {
                // alert('dddd')
                var $tableBody = $('#addtable').find("tbody"), //idftable
                    $trLast = $tableBody.find("tr:last");
                //  $trNew = $trLast.clone();



                // $trLast.after($trNew);
                ajouter('addtable', 'index');
                // alert('ccc')
                document.getElementById("boutonCommande").scrollIntoView(); //idfbouton

                e.preventDefault();
                return false;
            }
            //            if (e.which === 13) {
            // 			//if($('input').not(':hidden')  )
            //			{
            //                var index = $('.focus').index(this) + 1;     //  class f les    select ili temchilhom 
            //               // console.log('this index '+ index);
            //                $('.focus').eq(index).focus();
            //                event.preventDefault();
            //                return false;
            //				}
            //            }
            //            e.preventDefault();
            //            return false;
        });
        $(document).on('keyup', '.focus', function(e) {
            //alert('fff')
            index = $(this).attr('index');
            e.preventDefault(); //
            if (event.which == 13) {
                // alert('dddd')

                //  $trNew = $trLast.clone();

                $('#tpe' + index).focus();


                // $trLast.after($trNew);


                e.preventDefault();
                return false;
            }
            //            if (e.which === 13) {
            // 			//if($('input').not(':hidden')  )
            //			{
            //                var index = $('.focus').index(this) + 1;     //  class f les    select ili temchilhom 
            //               // console.log('this index '+ index);
            //                $('.focus').eq(index).focus();
            //                event.preventDefault();
            //                return false;
            //				}
            //            }
            //            e.preventDefault();
            //            return false;
        });
    });
</script>




<script>
    function ajouter(table, index) {
        //alert("hh");
        //  alert(index);
        ind = Number($("#" + index).val()) + 1;
        $ttr = $("#" + table)
            .find(".tr")
            .clone(true);
        $ttr.attr("class", "");
        i = 0;
        tabb = [];
        $ttr.find("input,select,textarea,tr,td,div,ul,li").each(function() {
            //alert()
            tab = $(this).attr("table"); //alert(tab)
            champ = $(this).attr("champ");
            $(this).attr("index", ind);
            $(this).attr("id", champ + ind); //alert(champ);
            if (champ == "marchandisetype_id") {
                //alert(champ)
                $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "][]");
                $(this).attr(
                    "data-bv-field",
                    "data[" + tab + "][" + ind + "][" + champ + "]"
                );
            } else {
                $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "]");
                $(this).attr(
                    "data-bv-field",
                    "data[" + tab + "][" + ind + "][" + champ + "]"
                );
            }
            $type = $(this).attr("type");
            $(this).val("");
            if ($type == "radio") {
                $(this).attr("name", "data[" + champ + "]");
                //$(this).attr('value',ind);
                $(this).val(ind);
            }
            if (champ == "datedebut" || champ == "datefin") {
                $(this).attr("onblur", "nbrjour(" + ind + ")");
            }
            $(this).removeClass("anc");
            if ($(this).is("select", "multiple")) {
                //alert(champ);
                //alert(ind);
                tabb[i] = champ + ind; //alert(tabb[i]);
                i = Number(i) + 1;
            }
            // $(this).val('');
        });
        $ttr.find("i").each(function() {
            $(this).attr("index", ind);
        });
        $("#" + table).append($ttr);
        $("#" + index).val(ind);

        $("#" + table)
            .find("tr:last")
            .show();
        $("#article_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#charge_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#article" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#article" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $('#article_id' + ind).select2("open");
        $("#client_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#fr_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#banque_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#typeexon_id" + ind).select2({
            width: "100%", // need to override the changed default
        });

        $("#gouvernorat_id" + ind).select2({
            width: "75%", // need to override the changed default
        });
        //indd = Number($("#" + index).val()) ;
        //alert(indd);
        $("#inserted" + ind).val(1);

        for (j = 0; j <= i; j++) {
            // alert(tabb[j]);
            //  $('marchandisetype_id1').attr('class','select2');
            //  uniform_select(tabb[j]); jareb
            //$('#'+tabb[j]).select2({ });
        }
    }

    function openWindow(h, w, url) {
        //alert()
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>

<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>
<?php $this->end(); ?>