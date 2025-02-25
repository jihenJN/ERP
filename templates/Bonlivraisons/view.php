<?php

use Cake\Datasource\ConnectionManager;

?>
<?php

use Cake\ORM\TableRegistry;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->fetch('script'); ?>
<?php //echo $this->Html->script('calculvente'); 
?>




<section class="content-header">
    <h1>
        Consultation
        <?php
        if ($bonlivraison->typebl == 4) {
            echo 'Integration';
        } else  if ($bonlivraison->typebl == 2) {
            echo 'Facture Proforma';
        } else if ($bonlivraison->typebl == 1) {
            echo 'Bon de livraison';
        } else if ($bonlivraison->typebl == 3) {
            echo 'BL retour marchandise';
        }
        ?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index', $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>
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
                <?php echo $this->Form->create($bonlivraison, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); //debug($bonlivraison);
                ?>
                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'class' => 'form-control ontrol-label', 'value' => $bonlivraison->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('date', ['class' => 'form-control ontrol-label', "value" => $bonlivraison->date]); ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('depot_id', ['value' => $bonlivraison->depot_id, 'options' => $depots, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Dépot', 'class' => 'form-control select2 control-label']); ?>
                                </div>

                                <?php

                                if ($bonlivraison->typebl == 1) {
                                    // $select = '';
                                    $inputt = '';
                                    if ($bonlivraison->transporteur_id == 3) {
                                        //  $select = 'none';
                                        $inputt = 'true';
                                    } else {
                                        //  $select = 'true';
                                        $inputt = 'none';
                                    }
                                ?>
                                    <div class="col-xs-3">
                                        <?php
                                        echo $this->Form->control('transporteur_id', ['value' => $bonlivraison->transporteur_id, 'label' => 'Transporteur', 'options' => $transporteurs, 'disabled' => 'disabled', 'empty' => 'Veuillez Choisir !!', 'class' => "form-control select2 ", 'id' => 'transporteur_id']);
                                        ?>
                                    </div>
                                    <div id="c1" style="display:<?php echo $inputt ?>">
                                        <div class="col-xs-6">

                                            <?php echo $this->Form->control('chauffeurname', ['value' => $bonlivraison->chauffeurname, 'disabled' => 'disabled', 'label' => 'Chauffeur', 'required' => 'off']); ?>

                                        </div>

                                        <div class="col-xs-6">
                                            <?php //echo $this->Form->control('matricule', ['value' => $bonlivraison->matricule,'disabled'=>'disabled', 'label' => 'Matricule', 'required' => 'off']); 
                                            ?>

                                        </div>
                                    </div>

                                <?php  } ?>
                            </div>
                        </div>

                        <!-- <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; "> -->
                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <?php echo $this->Form->control('nouveau_client', ['type' => 'hidden', 'value' => $clientc->nouveau_client, 'id' => 'nouv', 'label' => '', 'class' => 'form-control ontrol-label']); ?>
                                <?php echo $this->Form->control('bonusclient', ['type' => 'hidden', 'value' => $bonus, 'id' => 'bonus', 'label' => '', 'class' => 'form-control ontrol-label']); ?>
                                <?php echo $this->Form->control('commercial', ['type' => 'hidden', 'name' => 'commercial_id', 'value' => $bonlivraison->commercial_id, 'label' => '', 'class' => 'form-control ontrol-label']); ?>
                                <div class="form-group input select required">
                                    <label class="control-label" for="depot-id">Code Client</label>
                                    <select name="client_id1" id="idclient1" class="form-control select2  getclientdata1 getdetailscheque1 control-label ">
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                        <?php foreach ($clients as $id => $client) { ?>
                                            <option <?php if ($bonlivraison->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale;

                                                                                                                                                                                // echo $client->Code 
                                                                                                                                                                                ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-3" hidden>

                                <div class="form-group input select required">
                                    <label class="control-label" for="depot-id">Nom Client</label>
                                    <select name="client_id" id="idclient" class="form-control  getclientdata select2  getdetailscheque control-label ">
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                        <?php foreach ($clients as $id => $client) { ?>
                                            <option <?php if ($bonlivraison->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                                echo $client->Raison_Sociale ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-7" id="blocclient" style="display: true;">
                                <!-- <div class="panel panel-default"> -->
                                <!-- <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <?php echo __('Solde'); ?>
                                            </h3>
                                        </div> -->
                                <!-- <div class="panel-body"> -->

                                <div class="col-xs-12">
                                    <!-- <div class="col-xs-3" hidden>
                                                    <label style="color: #c46210;">Plafond :</label>

                                                    <?php
                                                    echo $this->Form->input('plafond', array('readonly' => 'readonly', 'value' => $bonlivraison->client->plafontheorique, 'style' => 'background-color:#FFEFD4; color:#000000 ;', 'label' => 'plafond', 'id' => 'plafond', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                    ?>
                                                </div> -->
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
                                    <div class="col-xs-3" hidden>
                                        <label style="color: #800080;"> Echanciére BL: </label>
                                        <?php
                                        echo $this->Form->input('echancierebl', array('readonly' => 'readonly', 'value' => $echancierebl, 'label' => 'echanciere bl', 'style' => 'background-color:#DB9CDB; color:#000000 ;', 'id' => 'echancierebl', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                        ?>
                                    </div>
                                    <?php if ($bonlivraison->typebl == 1) { ?>
                                        <div class="col-xs-2">
                                            <br>
                                            <button type="button" class="btnShowUnpaid" id="btnShowUnpaid">
                                                <i class="fa fa-question text-red"></i>
                                            </button>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- <input type="hidden" id="cl_id" value="<?php echo $clientc->id ?>">
                                   <input type="hidden" id="typeclient" value="<?php echo $cl; ?>">
                                  <input type="hidden" id="typeclientidd" value="<?php echo $clientc->typeclient_id ?>">
                                   <input type="hidden" id="gouvernorat_id" value="<?php echo $clientc->gouvernorat_id ?>"> -->

                                <!-- </div>
                                    </div> -->
                            </div>

                        </div>
                        <!-- </div> -->
                        <?php
                        if ($bonlivraison->client_id == 12) {
                            $style = "display:block;";
                        } else {
                            $style = "display:none;";
                        }
                        if (/*$bonlivraison->typebl == 1 &&*/$bonlivraison->client_id == 12) {

                        ?>
                            <div class="col-xs-4" id="divnomprenom" style="<?php echo $style; ?>">
                                <?php echo $this->Form->control('nomprenom', ['readonly' => 'readonly', 'label' => 'Nom / Prénom', 'value' => $bonlivraison->nomprenom, 'required' => 'off', 'class' => 'form-control focus']); ?>

                            </div>
                            <div class="col-xs-4" id="divnumeroident" style="<?php echo $style; ?>">
                                <?php echo $this->Form->control('numeroidentite', ['readonly' => 'readonly', 'label' => 'Numéro identité', 'value' => $bonlivraison->numeroidentite, 'required' => 'off', 'class' => 'form-control focus']); ?>

                            </div>
                            <div class="col-xs-4" id="divadresseclt" style="<?php echo $style; ?>">
                                <?php echo $this->Form->control('adressediv', ['readonly' => 'readonly', 'label' => 'Adresse', 'required' => 'off', 'value' => $bonlivraison->adressediv, 'class' => 'form-control focus']); ?>
                            </div>
                        <?php } ?>
                        <div class="col-xs-1" hidden>
                            <?php echo $this->Form->control('typebl', ['label' => 'Type Bl', 'value' => $type, 'required' => 'off']); ?>

                        </div>
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                            <div class="row">
                                <div class="col-xs-6" hidden>
                                    <div class="form-group input text required" id="com_id">

                                        <?php echo $this->Form->control('commercial_id', ['value' => $bonlivraison->commercial_id, 'options' => $commercials, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Commercial', 'class' => 'form-control select2 control-label', 'name' => 'adresse']); ?>
                                    </div>
                                </div>


                                <?php
                                if ($bonlivraison->typebl == 1) {
                                    $select = '';
                                    $input = '';
                                    if ($bonlivraison->typetransport_id == 1 || $bonlivraison->typetransport_id == 3) {
                                        $select = 'none';
                                        $input = 'true';
                                    } else {
                                        $select = 'true';
                                        $input = 'none';
                                    }
                                ?>

                                    <div class="col-xs-6" hidden>
                                        <?php
                                        echo $this->Form->control('typetransport_id', ['label' => 'Type de Transport', 'options' => $typetransports, 'empty' => 'Veuillez Choisir !!', 'class' => "form-control select2 ", 'id' => 'typetransport_id']);
                                        ?>
                                    </div>

                                    <div id="selectdiv" style="display:<?php echo $select ?>" hidden>
                                        <div class="col-xs-6">
                                            <?php
                                            echo $this->Form->control('chauffeur_id', ['label' => 'Chauffeur', 'options' => $chauffeurs, 'empty' => 'Veuillez Choisir !!', 'class' => "form-control select2 ", 'id' => 'chauffeur_id']);
                                            ?>
                                        </div>

                                        <div class="col-xs-6" hidden>
                                            <?php
                                            echo $this->Form->control('materieltransport_id', ['label' => 'Camion', 'options' => $materieltransports, 'empty' => 'Veuillez Choisir !!', 'class' => "form-control select2 ", 'id' => 'materieltransport_id']);
                                            ?>
                                        </div>
                                    </div>

                                    <div id="inputdiv" style="display:<?php echo $input ?>" hidden>

                                        <div class="col-xs-6">

                                            <?php echo $this->Form->control('chauffeurname', ['label' => 'Chauffeur', 'required' => 'off']); ?>

                                        </div>

                                        <div class="col-xs-6">
                                            <?php //echo $this->Form->control('matricule', ['label' => 'Camion', 'required' => 'off']); 
                                            ?>

                                        </div>
                                    </div>
                                    <div class="col-xs-12" id="unpaidChecks" style="display:none;">

                                    </div>
                                    <div class="col-xs-6" hidden>
                                        <?php
                                        echo $this->Form->control('personnel_id', ['label' => 'Agent de Controle', 'options' => $agents, 'empty' => 'Veuillez Choisir !!', 'class' => "form-control select2 ", 'id' => 'personnel_id']);
                                        ?>
                                    </div>


                                    <div class="col-xs-6" hidden>
                                        <?php echo $this->Form->control('qtepalette', ['label' => 'Qté Palette', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-6" hidden>
                                        <?php echo $this->Form->control('destination', ['label' => 'Destination', 'required' => 'off']); ?>
                                    </div>

                                <?php } ?>

                                <?php echo $this->Form->control('exotva', ['type' => 'hidden', 'value' => '']); ?>
                                <?php echo $this->Form->control('exofodec', ['type' => 'hidden', 'value' => '']); ?>
                                <input value="<?php echo $exofodec ?>" type="hidden" name="fodecclientexo" id="fodecclientexo" class="" style="margin-right: 20px">
                                <input type="hidden" name="timbreclientexo" id="timbreclientexo" class="" style="margin-right: 20px">
                                <input value="<?php echo $exotva ?>" type="hidden" name="tvaclientexo" id="tvaclientexo" class="" style="margin-right: 20px">
                                <input value="<?php echo $exotpe ?>" type="hidden" name="tpeclientexo" id="tpeclientexo" class="" style="margin-right: 20px">

                            </div>
                        </div>
                        <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px" value="<?php echo $bonlivraison->client->Fodec ?>">



                        <br>
                        <br>
                        <?php
                        if ($bonlivraison->client_id == 12) {
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


                        <section class="content-header">
                            <h1 class="box-title"><?php echo __('Articles'); ?></h1>
                        </section>
                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                                <thead>
                                                    <tr>
                                                        <td align="center" style="width: 12%; font: size 8px;"><strong>Code</strong></td>

                                                        <td align="center" style="width: 23%; font: size 20px;"><strong>Désignation</strong></td>
                                                        <td align="center" style="width: 8%;"><strong>stock
                                                            </strong></td>
                                                        <td align="center" style="width: 6%;"><strong>Qte </strong></td>
                                                        <td align="center" style="width: 6%;"><strong>P.Av.R </strong></td>

                                                        <!-- <td align="center" style="width: 6%;"><strong>ml </strong></td> -->
                                                        <td align="center" style="width: 8%;"><strong>PUTTC</strong></td>
                                                        <td align="center" style="width: 4%;"><strong>Remise</strong></td>

                                                        <td align="center" style="width: 6%;"><strong>P.U.H.T</strong></td>
                                                        <td align="center" style="width: 8%;"><strong>T.HT</strong></td>
                                                        <td align="center" style="width: 4%;"><strong> TVA </strong></td>
                                                        <!-- <td align="center" style="width: 4%; font: size 5px;"><strong style="font: size 5px;">Fodec</strong></td> -->
                                                        <td align="center" style="width: 8%;"><strong>Total TTC</strong></td>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($lignebonlivraisons as $i => $res) :
                                                        date_default_timezone_set('Africa/Tunis');
                                                        $date = date("Y-m-d H:i:s");
                                                        $connection = ConnectionManager::get('default');
                                                        $articleid = $res->article_id;
                                                        $depotid = $bonlivraison->depot_id;

                                                        $connection = ConnectionManager::get('default');
                                                        $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                        $stock = $inventaires[0]['v'];
                                                        $bc = $connection->execute("select stockbassemseuil(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as q")->fetchAll('assoc');

                                                    ?>
                                                        <tr style="font-size: 18px;font-weight: bold;">
                                                            <td>

                                                                <select readonly name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" width="100%" id="<?php echo 'article_id' . $i ?>" table="ligner" index="<?php echo $i ?>" champ="article_id" style="pointer-events:none;" class="form-control articleidbl1">
                                                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                                    <?php foreach ($articles as $id => $article) {
                                                                    ?>
                                                                        <option style="font-size: 10px;" <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>

                                                                <select readonly name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" width="100%" id="<?php echo 'article_id' . $i ?>" table="ligner" index="<?php echo $i ?>" champ="article_id" style="pointer-events:none;" class="form-control articleidbl1">
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
                                                            <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>
                                                            </td>
                                                            <td align="center">

                                                                <?php
                                                                echo $this->Form->control('qtestock', ['readonly' => 'readonly', 'value' => $stock, 'name' => 'data[ligner][' . $i . '][qteStock]', 'empty' => true, 'label' => false, 'table' => 'lignecommandes', 'champ' => 'qteStock', 'class' => 'form-control select   ', 'index']);

                                                                ?>
                                                            </td>
                                                            <td align="center">

                                                                <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculm pourcentescompte ', 'index')); ?>
                                                                <input type="hidden" value='<?php echo $res->article->Poids ?>' table="ligner" name="" id="<?php echo 'poids' . $i ?>" champ="poids" class="calcullignecommande form-control" index="<?php echo $i ?>">

                                                                <input type="hidden" table="ligner" name="" id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                                <input type="hidden" table="ligner" name="" id="<?php echo 'escompte' . $i ?>" champ="escompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                            </td>
                                                            <td align="center" hidden>
                                                                <?php echo $this->Form->input('ml', array('readonly' => 'readonly', 'label' => '', 'value' => $res->ml, 'name' => 'data[ligner][' . $i . '][ml]', 'type' => 'text', 'id' => 'ml' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculm ', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('puttcapr', array('label' => '', 'value' => $res->puttcapr, 'readonly' => 'readonly', 'name' => 'data[ligner][' . $i . '][puttcapr]', 'type' => '', 'id' => 'puttcapr' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculligne2 findtth1 ttcligne')); ?>

                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('puttc', array('readonly', 'label' => '', 'value' => $res->puttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('escompte', array('label' => '', 'value' => '', 'name' => 'data[ligner][' . $i . '][escompte]', 'type' => 'hidden', 'id' => 'escompte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                                <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculm', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('prix', array('label' => '', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculm', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('ht', array('readonly', 'label' => '', 'value' => $res->prixht, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                            </td>

                                                            <td align="center">

                                                                <?php echo $this->Form->control('monatantlignetva', ['value' => $res->totaltva, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => 'monatantlignetva' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][monatantlignetva]', 'required' => 'off']); ?>


                                                                <?php echo $this->Form->input('tva', array('value' => $res->tva, 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculm', 'index')); ?>
                                                            </td>


                                                            <td align="center" hidden>

                                                                <?php echo $this->Form->control('fodeccommandeclient', ['value' => '', 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][fodeccommandeclient]', 'required' => 'off']); ?>

                                                                <?php echo $this->Form->input('fodec', array('readonly' => 'readonly', 'label' => '', 'value' => $res->fodec, 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => '', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>


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
                                                                <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                            </td>





                                                        </tr>
                                                    <?php endforeach; ?>
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
                                <!-- <div style=" position: static;">
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalht', ['id' => 'totalht', 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                    </div>

                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalhtapres', ['id' => 'totalhtapres', 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totaltva', ['id' => 'totaltva', 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalfodec', ['id' => 'totalfodec', 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total puttc', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <?php if ($bonlivraison->typebl == 2) { ?>
                                    
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('timbre', ['type' => 'hidden', 'id' => 'timbre', 'name' => 'timbre', 'value' => $bonlivraison->timbre_id]);

                                            echo $this->Form->control('timbre_id', ['options' => $tim, 'name' => 'timbre_id', 'id' => 'timbre_id', 'class' => 'form-control', 'readonly' => true,  'label' => 'Timbre']); ?>

                                        </div>
                                    <?php } ?>
                                </div> -->
                                <div style=" position: static;">
                                    <table style="width:55%;margin-left:70%;">
                                        <tr>
                                            <td>
                                                <strong> Total HT</strong>
                                            </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('total', ['id' => 'totalht', 'value' => $bonlivraison->totalht, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong> Total Remise </strong>
                                            </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('remisee', ['id' => 'totalremise', 'value' => $bonlivraison->totalremise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remisee', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong> Total TVA</strong>
                                            </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control', 'value' => $bonlivraison->totaltva, 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <strong> Total TTC </strong> </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'value' => $bonlivraison->totalttc, 'label' => false, 'name', 'class' => 'form-control  calculinversetot', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php if ($type == 2) { ?>
                                            <tr>

                                                <td> <strong> Timbre </strong> </td>
                                                <td>
                                                    <div class="col-xs-4">
                                                        <?php echo $this->Form->control('timbre', ['type' => 'hidden', 'id' => 'timbre', 'name' => 'timbre', 'value' => $timbre_id]);

                                                        echo $this->Form->control('timbre_display', ['value' => sprintf("%01.3f", $timbre_max), 'id' => 'timbre', 'class' => 'form-control', 'readonly' => true,  'label' => false]); ?>

                                                    </div>

                                                </td>
                                            </tr>
                                        <?php  } ?>
                                        <?php if ($type == 1) { ?>
                                            <tr hidden>

                                                <td> <strong> Montant Regler</strong></td>
                                                <td>
                                                    <div class="col-xs-4">
                                                        <?php echo $this->Form->control('Montant_Regler', ['class' => 'form-control tauxx', 'type' => 'text', 'id' => 'Montant_Regler', 'readonly' => 'readonly', 'label' => false, 'name' => 'Montant_Regler', 'required' => 'off']); ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr hidden>
                                            <td>test remise</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'value' => $bonlivraison->totalremise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remiseee', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr hidden>
                                            <td>Total HT après remise</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('totalapres', ['class' => 'form-control', 'value' => $bonlivraison->totalht - $bonlivraison->totalremise, 'id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr hidden>
                                            <td>Total Fodec</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'value' => $bonlivraison->totalfodec, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr hidden>
                                            <td>Total PU ttc</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => $bonlivraison->totalputtc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td hidden>test ttc</td>
                                            <td>
                                                <div class="col-xs-4" hidden>
                                                    <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'value' => $bonlivraison->totalttc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                                                </div>
                                                <!-- <div class="col-xs-4" hidden>
                                                      <?php echo $this->Form->control('totalapres1', ['id' => 'totalhtapres1', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'test après remise', 'name', 'required' => 'off']); ?>
                                                 </div> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'value' => $bonlivraison->observation, 'type' => 'textarea']); ?>
                            </div><br>
                        </div>
                    </section>



                    <?php if ($bonlivraison->typebl == 1) { ?>

                        <section class="content" style="width: 99%">
                            <div class="row">
                                <h3> Réglement Bon livraison N° <?php echo $bonlivraison->numero ?></h3>
                            </div>
                            <br>
                            <div class="row">
                                <div class="box box-primary">
                                    <table class="table table-bordered table-striped table-bottomless">
                                        <tbody>
                                            <tr>
                                                <td><strong>Mode de paiement </strong></td>
                                                <td><strong>Montant</strong></td>
                                                <!-- <td><strong>taux</strong></td>
                                       <td><strong>Montant net</strong></td> -->
                                                <td><strong>Echéance</strong></td>
                                                <td><strong>Banque</strong></td>
                                                <td><strong>Numero piéce</strong></td>
                                                <!-- <td><strong>Caisse</strong></td> -->

                                            </tr>



                                            <?php

                                            $totaltotal = 0;

                                            $totalmnt = 0;

                                            foreach ($lignereglements as $lrc) {
                                                $piecereglementclientsTable = TableRegistry::getTableLocator()->get('Piecereglementclients');
                                                $piecereglementclientoffres = $piecereglementclientsTable->find()
                                                    ->where(['reglementclient_id' => $lrc->reglementclient_id])->contain(['Paiements', 'Caisses', 'Banques'])
                                                    ->toArray();






                                                $read = "";
                                                $i = 1;
                                                foreach ($piecereglementclientoffres as $i => $piece) { //debug($piece); 


                                                    $totalmnt += $piece->montant;
                                            ?>
                                                    <tr>



                                                        <td><?php
                                                            echo  $piece->paiement->name;
                                                            ?>

                                                        </td>
                                                        <td><?php
                                                            echo  $piece->montant;
                                                            ?>

                                                        </td>
                                                        <!-- <td><?php
                                                                    echo $piece->to->name;
                                                                    ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $piece->montant_net;
                                                            ?>
                                                        </td> -->

                                                        <td>
                                                            <?php
                                                            echo  $this->Time->format($piece->echance, 'dd/MM/y');
                                                            ?>
                                                        </td>

                                                        <td><?php
                                                            echo $piece->banque->name;
                                                            ?>

                                                        </td>

                                                        <td>
                                                            <?php
                                                            echo $piece->num;
                                                            ?>
                                                        </td>
                                                        <!-- <td><?php
                                                                    echo $piece->caiss->name;
                                                                    ?>
                                                        </td> -->
                                                    </tr>
                                            <?php }
                                            } ?>




                                        </tbody>
                                    </table>
                                    <br>
                                    <table style=width:30% class="table table-bordered table-striped table-bottomless pull-right">
                                        <tbody>
                                            <tr>
                                                <td><strong>Montant total</strong></td>
                                                <td><?php echo sprintf("%01.3f", $totalmnt); ?></td>
                                                <input type='hidden' value="<?php echo $totalmnt ?>" id="totalmnt">
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <?php
                            // debug($lignereglementcmds);

                            if (!empty($lignereglementcmds)) { ?>


                                <div class="row">
                                    <h3> Réglement Commande N° <?php echo $commande->numero ?></h3>
                                </div>
                                <br>



                                <div class="row">
                                    <div class="box box-primary">
                                        <table class="table table-bordered table-striped table-bottomless">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Mode de paiement </strong></td>
                                                    <td><strong>Montant</strong></td>
                                                    <!-- <td><strong>taux</strong></td>
                                                    <td><strong>Montant net</strong></td> -->
                                                    <td><strong>Echéance</strong></td>
                                                    <td><strong>Banque</strong></td>
                                                    <td><strong>Numero piéce</strong></td>
                                                    <td><strong>Caisse</strong></td>

                                                </tr>



                                                <?php

                                                $totalmntcmd = 0;

                                                foreach ($lignereglementcmds as $lrcmd) {
                                                    $piecereglementclientsTable = TableRegistry::getTableLocator()->get('Piecereglementclients');
                                                    $piecereglementclientcmds = $piecereglementclientsTable->find()
                                                        ->where(['reglementclient_id' => $lrcmd->reglementclient_id])->contain(['Paiements', 'Caisses', 'Banques'])
                                                        ->toArray();






                                                    $read = "";
                                                    $i = 1;
                                                    foreach ($piecereglementclientcmds as $i => $piece) { //debug($piece); 


                                                        $totalmntcmd += $piece->montant;
                                                ?>
                                                        <tr>



                                                            <td><?php
                                                                echo  $piece->paiement->name;
                                                                ?>

                                                            </td>
                                                            <td><?php
                                                                echo  $piece->montant;
                                                                ?>

                                                            </td>
                                                            <!-- <td><?php
                                                                        echo $piece->to->name;
                                                                        ?>

                                                                                </td>
                                                                                <td>
                                                                                    <?php
                                                                                    echo $piece->montant_net;
                                                                                    ?>
                                                                                </td> -->

                                                            <td>
                                                                <?php
                                                                echo  $this->Time->format($piece->echance, 'dd/MM/y');
                                                                ?>
                                                            </td>

                                                            <td><?php
                                                                echo $piece->banque->name;
                                                                ?>

                                                            </td>

                                                            <td>
                                                                <?php
                                                                echo $piece->num;
                                                                ?>
                                                            </td>
                                                            <!-- <td><?php
                                                                        echo $piece->caiss->name;
                                                                        ?>
                                                            </td> -->
                                                        </tr>
                                                <?php }
                                                } ?>




                                            </tbody>
                                        </table>
                                        <br>
                                        <table style=width:30% class="table table-bordered table-striped table-bottomless pull-right">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Montant total</strong></td>
                                                    <td><?php echo sprintf("%01.3f", $totalmntcmd); ?></td>
                                                    <input type='hidden' value="<?php echo $totalmntcmd ?>" id="totalmntcmd">
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php } ?>

                            <br>
                            <div class="row">
                                <div class="box box-primary">

                                    <table style="width:30%;color:green" class="table table-bordered table-striped table-bottomless pull-right">
                                        <tbody>
                                            <tr>
                                                <?php $totaltotal = $totalmntcmd + $totalmnt;
                                                $reste = $bonlivraison->totalttc - $totaltotal; ?>
                                                <td width="67%"><strong>Net à payer</strong></td>
                                                <td><strong><?php echo sprintf("%01.3f", $bonlivraison->totalttc); ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total réglé</strong></td>
                                                <td><strong><?php echo sprintf("%01.3f", $totalmntcmd + $totalmnt); ?></strong></td>
                                                <input type='hidden' value="<?php echo $totalmntcmd + $totalmnt ?>" id="totaltotal">
                                            </tr>
                                            <tr>
                                                <td><strong>Reste</strong></td>
                                                <td><strong><?php echo sprintf("%01.3f", $reste); ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>


                    <?php } ?>


                    <?php echo $this->Form->end(); ?>

                </div>



            </div>
        </div>
</section>

<script>
    $(document).ready(function() {
        $('#idclient1').on('change', function() {
            $('#unpaidChecks').hide();
        });
        $('#btnShowUnpaid').on('click', function() {
            var clientId = $('#idclient1').val();

            if (!clientId) {
                alert('Veuillez choisir un client');
                return;
            }

            if ($('#unpaidChecks').is(':visible')) {
                $('#unpaidChecks').hide();
                return;
            }

            $.ajax({
                url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getchequeclient']) ?>",
                method: 'GET',
                data: {
                    client_id: clientId
                },
                success: function(response) {
                    $('#unpaidChecks').empty();

                    if (typeof response === "string") {
                        response = JSON.parse(response);
                    }

                    if (response && response.res) {
                        $('#unpaidChecks').append(response.res).show();
                    } else {
                        $('#unpaidChecks').append('<p>Aucun chèque impayé pour ce client.</p>').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    // $('#unpaidChecks').append('<p>Erreur lors du chargement des chèques.</p>').show();
                }
            });


        });
    });
</script>

<script>
    // $(document).ready(function() {
    //     // Function to get cheque details for the selected client
    //     function getChequeDetails() {
    //         var clientId = $('#idclient').val();
    //         var typebl = $("#typebl").val();
    //         // alert(typebl)
    //         if (!clientId) {
    //             $('#unpaidChecks').hide();
    //             return;
    //         }

    //         if ($('#unpaidChecks').is(':visible')) {
    //             $('#unpaidChecks').hide();
    //             return;
    //         }

    //         $.ajax({
    //             url: "<?= $this->Url->build(['controller' => 'Bonlivraisons', 'action' => 'getchequeclient']) ?>",
    //             method: 'GET',
    //             data: {
    //                 client_id: clientId
    //             },
    //             success: function(response) {
    //                 $('#unpaidChecks').empty();

    //                 if (typeof response === "string") {
    //                     response = JSON.parse(response);
    //                 }

    //                 if (response && response.res != '' && typebl == 1) {
    //                     $('#unpaidChecks').append(response.res).show();
    //                 } else {
    //                     $('#unpaidChecks').hide();
    //                 }
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error('AJAX error:', status, error);
    //             }
    //         });
    //     }


    //     $('#idclient').on('change', function() {
    //         getChequeDetails();
    //     });


    //     if ($('#idclient').val() !== '') {
    //         getChequeDetails();
    //     }
    // });
</script>
<script type="text/javascript">
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
                    valnot = data.not;
                    //alert(data.typeclientname);
                    valgs = data.gs;
                    //alert("kkkkkk");
                    if (data.typeclient == false) {
                        if (valnot != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/promoarticles/notgrandsurface/' + valnot + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<div>aucun promo</div>'
                            $('#typecli').html(a);

                        }
                    } else if (data.typeclient == true) {
                        if (valgs != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/gspromoarticles/grandsurface/' + valgs + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<div>aucun promo</div>'
                            $('#typecli').html(a);
                        }
                    }


                    $('#nouv').val(data.ligne.nouveau_client);

                    valrem = Number(data.remcli);
                    valcom = Number(data.remes);
                    if (data.remise == true) {
                        $('#remise-val').val(data.ligne.remise);
                        if (valrem != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/remiseclients/consultation/' + valrem + '")\'>avec palier</a>'
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
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/remiseescomptes/consultation/' + valcom + '")\'>avec palier</a>'
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
                    $('#blocclient').show();
                    page = $('#page').val() || 0;
                    $('#typeclientid').parent().parent().html(data.select);
                    $('#fodecclientexo').val(data.exofodec);
                    $('#timbreclientexo').val(data.exotimbre);
                    $('#tvaclientexo').val(data.exotva);
                    $('#tpeclientexo').val(data.exotpe);
                    if (data.exofodec == '' && data.exotva == '' && data.exotpe == '') {
                        $('#typeexenoration').val('Non exoneré');
                    } else {
                        $('#typeexenoration').val(data.exofodec + '/' + data.exotva + '/' + data.exotpe);
                    }
                }

            })


        });
    });
</script>
<script>
    $(document).ready(function() {

        Calcul();
        $("form").submit(function() {
            $('#boutonlivraison').attr('disabled', 'disabled');
        })
        $(".calculm").on("keyup", function() {
            Calcul();
        });
        $("#boutonlivraison").on("mouseover", function() {
            Calcul();
        });


    });
</script>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $('.select2').select2();
</script>
<script>
    $(document).ready(function() {
        $('input, select,textarea').prop('disabled', true);
    });
</script>
<?php $this->end(); ?>