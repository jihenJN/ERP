<?php

use Cake\Datasource\ConnectionManager;

?>
<?php

use Cake\ORM\TableRegistry;
?>
<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'css']); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('calculvente'); ?>

<?php echo $this->fetch('script'); ?>





<section class="content-header">
    <h1>
        Modification
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
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', "class" => "form-control  control-label ", 'value' => $bonlivraison->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('date', ["value" => $bonlivraison->date, "class" => "form-control  control-label "]); ?>
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
                                        echo $this->Form->control('transporteur_id', ['value' => $bonlivraison->transporteur_id, 'label' => 'Transporteur', 'options' => $transporteurs, 'empty' => 'Veuillez Choisir !!', 'class' => "form-control select2 ", 'id' => 'transporteur_id']);
                                        ?>
                                    </div>
                                    <div id="c1" style="display:<?php echo $inputt ?>">
                                        <div class="col-xs-6">

                                            <?php echo $this->Form->control('chauffeurname', ['value' => $bonlivraison->chauffeurname, 'label' => 'Chauffeur', 'required' => 'off']); ?>

                                        </div>

                                        <div class="col-xs-6">
                                            <?php //echo $this->Form->control('matricule', ['value' => $bonlivraison->matricule, 'label' => 'Matricule', 'required' => 'off']); 
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
                                    <label class="control-label" for="depot-id"> Client</label>
                                    <select name="client_id1" id="idclient1" class="form-control select2 clientinfo  getclientdata1 getdetailscheque1 control-label ">
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                        <?php foreach ($clients as $id => $client) { ?>
                                            <option <?php if ($bonlivraison->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale;

                                                                                                                                                                                //echo $client->Code 
                                                                                                                                                                                ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-3" hidden>

                                <div class="form-group input select required">
                                    <label class="control-label" for="depot-id">Nom Client</label>
                                    <select name="client_id" id="idclient" class="form-control  getclientdata getdetailscheque select2 control-label ">
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
                                            <!-- <button type="button" class="btnShowUnpaid" id="btnShowUnpaid" style="color: red; border: red; font-weight: bold;">
                                                Impayé
                                            </button> -->
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
                        <div class="col-xs-12" id="unpaidChecks" style="display:none;">

                        </div>

                        <!-- </div> -->

                        <?php
                        if ($bonlivraison->client_id == 12) {
                            $stylee = "display:block;";
                        } else {
                            $stylee = "display:none;";
                        }
                        //if (/*$bonlivraison->typebl == 1 &&*/$bonlivraison->client_id == 12) {

                        ?>
                        <div class="col-xs-4" id="divnomprenom" style="<?php echo $stylee; ?>">
                            <?php echo $this->Form->control('nomprenom', ['label' => 'Nom / Prénom', 'value' => $bonlivraison->nomprenom, 'required' => 'off', 'class' => 'form-control focus']); ?>

                        </div>
                        <div class="col-xs-4" id="divnumeroident" style="<?php echo $stylee; ?>">
                            <?php echo $this->Form->control('numeroidentite', ['label' => 'Numéro identité', 'value' => $bonlivraison->numeroidentite, 'required' => 'off', 'class' => 'form-control focus']); ?>

                        </div>
                        <div class="col-xs-4" id="divadresseclt" style="<?php echo $stylee; ?>">
                            <?php echo $this->Form->control('adressediv', ['label' => 'Adresse', 'required' => 'off', 'value' => $bonlivraison->adressediv, 'class' => 'form-control focus']); ?>
                        </div>
                        <?php //} 
                        ?>
                        <div class="col-xs-1">
                            <?php echo $this->Form->control('typebl', ['label' => 'Type Bl', 'type' => 'hidden', 'value' => $bonlivraison->typebl, 'required' => 'off']); ?>

                        </div>
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                            <div class="row">




                                <div class="col-xs-6" hidden>
                                    <div class="form-group input text required" id="com_id" hidden>

                                        <?php echo $this->Form->control('commercial_id', ['value' => $bonlivraison->commercial_id, 'options' => $commercials, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Commercial', 'class' => 'form-control select2 control-label', 'name' => 'adresse']); ?>
                                    </div>
                                </div>

                                <?php
                                if ($bonlivraison->typebl == 1) {
                                    //     $select = '';
                                    //     $input = '';
                                    //     if ($bonlivraison->typetransport_id == 1 || $bonlivraison->typetransport_id == 3) {
                                    //         $select = 'none';
                                    //         $input = 'true';
                                    //     } else {
                                    //         $select = 'true';
                                    //         $input = 'none';
                                    //     }
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

                                            <?php //echo $this->Form->control('chauffeurname', ['label' => 'Chauffeur', 'required' => 'off']); 
                                            ?>

                                        </div>

                                        <div class="col-xs-6">
                                            <?php //echo $this->Form->control('matricule', ['label' => 'Camion', 'required' => 'off']); 
                                            ?>

                                        </div>
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
                                                        <td align="center" style="width: 12%;"><strong>Code</strong> </td>
                                                        <td align="center" style="width: 23%;"><strong>Designation</strong></td>
                                                        <td align="center" style="width: 8%;"><strong> stock
                                                            </strong></td>
                                                        <td align="center" style="width: 6%;"><strong>Qte </strong></td>
                                                        <td align="center" style="width: 6%;"><strong>P.Av.R </strong></td>

                                                        <!-- <td align="center" style="width: 6%;"><strong>ml </strong></td> -->
                                                        <td align="center" style="width: 8%;"><strong> PUTTC</strong></td>
                                                        <td align="center" style="width: 4%;"><strong>Remise</strong></td>

                                                        <td align="center" style="width: 6%;"><strong>P.U.H.T</strong></td>
                                                        <td align="center" style="width: 8%;"><strong>T.HT</strong></td>
                                                        <td align="center" style="width: 4%;"><strong> TVA </strong></td>

                                                        <!-- <td align="center" style="width: 4%; font: size 5px;"><strong style="font: size 5px;">Fodec</strong></td> -->

                                                        <td align="center" style="width: 8%;"><strong> TTC</strong></td>
                                                        <!-- <td align="center" style="width: 8%;"><strong>test TTC</strong></td> -->

                                                        <td align="center" style="width: 2%;"><strong></strong></td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = -1;
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

                                                        // $artTable = TableRegistry::getTableLocator()->get('Articles');
                                                        // $sousfamilleTable = TableRegistry::getTableLocator()->get('Sousfamille1s');
                                                        // $sousfam = [];
                                                        // $art = [];
                                                        // if ($res->article_id != null) {
                                                        //     $art = $artTable->find()
                                                        //         ->where(['id' => $res->article_id])
                                                        //         ->first();
                                                        //     if ($art->sousfamille1_id != null) {
                                                        //         $sousfam = $sousfamilleTable->find()
                                                        //             ->where(['id' => $art->sousfamille1_id])
                                                        //             ->first();
                                                        //     }
                                                        // }

                                                        // $readonly = '';
                                                        // if ($sousfam->remiseobligatoire == 0) {
                                                        //     $readonly = 'readonly';
                                                        // }

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

                                                                <?php
                                                                echo $this->Form->control('qtestock', ['readonly' => 'readonly', 'value' => $stock, 'name' => 'data[ligner][' . $i . '][qteStock]', 'empty' => true, 'label' => false, 'table' => 'lignecommandes', 'champ' => 'qteStock', 'class' => 'form-control select   ', 'index']);
                                                                ?>

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
                                                                <?php echo $this->Form->input('article_idd', array('label' => '', 'readonly' => 'readonly', 'value' => $res->article_id, 'name' => 'data[ligner][' . $i . '][article_idd]', 'type' => 'hidden', 'id' => 'article_idd' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 focus')); ?>

                                                                <!-- <input type="text" table="ligner" name="" index="<?php echo $i ?>" value="<?php echo $res->id ?>" readonly id="article_idd<?php echo $i ?>" champ="article_idd" class="  form-control"> -->

                                                                <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control findtth2 focus')); ?>
                                                                <input type="hidden" value='<?php echo $res->article->Poids ?>' table="ligner" name="" id="<?php echo 'poids' . $i ?>" champ="poids" class="calcullignecommande form-control" index="<?php echo $i ?>">

                                                                <input type="hidden" table="ligner" name="" id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                                <input type="hidden" table="ligner" name="" id="<?php echo 'escompte' . $i ?>" champ="escompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                            </td>
                                                            <td align="center" hidden>
                                                                <?php echo $this->Form->input('ml', array('label' => '', 'value' => $res->ml, 'name' => 'data[ligner][' . $i . '][ml]', 'type' => 'text', 'id' => 'ml' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 ')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('puttcapr', array('label' => '', 'value' => $res->puttcapr, 'readonly' => 'readonly', 'name' => 'data[ligner][' . $i . '][puttcapr]', 'type' => '', 'id' => 'puttcapr' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculligne2 findtth1 ttcligne')); ?>

                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('puttc', array('label' => '', 'value' => $res->puttc, 'name' => 'data[ligner][' . $i . '][puttc]', 'type' => '', 'id' => 'puttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control findtth1 ttcligne')); ?>

                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('escompte', array('label' => '', 'value' => '', 'name' => 'data[ligner][' . $i . '][escompte]', 'type' => 'hidden', 'id' => 'escompte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>
                                                                <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ajoutligneeettc2  findtth2')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('prix', array('label' => '', 'readonly' => 'readonly', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('ht', array('readonly', 'label' => '', 'value' => $res->prixht, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>
                                                            </td>

                                                            <td align="center">

                                                                <?php echo $this->Form->control('monatantlignetva', ['value' => $res->totaltva, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => 'monatantlignetva' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][monatantlignetva]', 'required' => 'off']); ?>


                                                                <?php echo $this->Form->input('tva', array('readonly', 'value' => $res->tva, 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>
                                                            </td>


                                                            <td align="center" hidden>

                                                                <?php echo $this->Form->control('fodeccommandeclient', ['value' => '', 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][fodeccommandeclient]', 'required' => 'off']); ?>

                                                                <?php echo $this->Form->input('fodec', array('readonly' => 'readonly', 'label' => '', 'value' => $res->fodec, 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => '', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>


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
                                                                <?php echo $this->Form->input('ttc', array('label' => '', 'readonly' => 'readonly', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  verifttc ')); ?>
                                                                <?php echo $this->Form->input('ttchidden', array('label' => '', 'readonly' => 'readonly', 'value' => $res->ttchidden, 'name' => 'data[ligner][' . $i . '][ttchidden]', 'type' => 'hidden', 'id' => 'ttchidden' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>

                                                            </td>
                                                            <td align="center" hidden>
                                                                <?php echo $this->Form->input('ttctest', array('readonly', 'label' => '', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttctest]', 'type' => '', 'id' => 'ttctest' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control verifttc ')); ?>

                                                            </td>
                                                            <td align="center">

                                                                <i index="<?php echo $i ?>" class="fa fa-times supLignearticle2" style="color: #C9302C;font-size: 22px;">
                                                            </td>





                                                        </tr>

                                                    <?php endforeach; ?>
                                                    </tr>

                                                    <tr class="tr" style="display: none;font-size: 18px;font-weight: bold;">
                                                        <td champ="tdcode">
                                                            <input table="ligner" class="getdesignation articleidbl1" champ="article_idcode" type="text">

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

                                                            <input type="number" table="ligner" name="" id="" champ="qteStock" type="text" class="  form-control" readonly index>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input type="hidden" table="ligner" name="" readonly champ="article_idd" class="  form-control" index>

                                                            <input type="number" table="ligner" name="" id="" champ="qte" type="text" class=" findtth2 focus form-control" index>
                                                        </td>

                                                        <td align="center" table="ligner" hidden>
                                                            <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">

                                                            <?php // echo $this->Form->control('sup', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'sup', 'id' => '', 'index', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); 
                                                            ?>

                                                            <input table="ligner" champ="ml" type="text" class="form-control calculligne2" index>
                                                        </td>
                                                        <td>
                                                            <input table="ligner" readonly type="text" name="" champ="puttcapr" class="form-control    calculligne2  findtth1  ttcligne" index>

                                                        </td>
                                                        <td>
                                                            <input table="ligner" type="text" name="" champ="puttc" class="form-control findtth1 ttcligne" index>

                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" champ="remise" class="form-control ajoutligneeettc2  findtth2" index name=''>
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
                                                            <input readonly table="ligner" type="text" name="" champ="ttc" class="form-control   verifttc " index>
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
                                        <?php echo $this->Form->control('total', ['id' => 'totalht', 'class' => 'form-control', 'value' => $bonlivraison->totalht, 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'class' => 'form-control', 'value' => $bonlivraison->totalremise, 'readonly' => 'readonly', 'label' => 'Total remise', 'name' => 'remisee', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'class' => 'form-control', 'value' => $bonlivraison->totalremise, 'readonly' => 'readonly', 'label' => 'test remise', 'name' => 'remiseee', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalapres', ['class' => 'form-control', 'value' => $bonlivraison->totalht - $bonlivraison->totalremise, 'id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                    </div>


                                    
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control', 'value' => $bonlivraison->totaltva, 'readonly' => 'readonly', 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'readonly' => 'readonly', 'label' => 'Total puttc', 'value' => $bonlivraison->totalputtc, 'name', 'class' => 'form-control verifttctotal calculinversetot', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'label' => 'Total ttc', 'value' => $bonlivraison->totalttc, 'name', 'class' => 'form-control calculinversetot', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'readonly' => 'readonly', 'value' => $bonlivraison->totalttc, 'label' => 'test ttc', 'name', 'class' => 'form-control verifttctotal calculinversetot', 'required' => 'off']); ?>
                                    </div>

                                    <?php if ($bonlivraison->typebl == 2) { ?>
                                    
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('timbre', ['type' => 'hidden', 'id' => 'timbre', 'name' => 'timbre', 'value' => $bonlivraison->timbre_id]);

                                            echo $this->Form->control('timbre_id', ['options' => $tim, 'name' => 'timbre_id', 'id' => 'timbre_id', 'class' => 'form-control', 'readonly' => true,  'label' => 'Timbre']); ?>

                                        </div>
                                    <?php } ?>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('Montant_Regler', ['class' => 'form-control', 'type' => 'text', 'value' => $bonlivraison->Montant_Regler, 'id' => 'Montant_Regler', 'readonly' => 'readonly', 'label' => 'Montant_Regler', 'name' => 'Montant_Regler', 'required' => 'off']); ?>
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
                                                    <?php echo $this->Form->control('total', ['id' => 'totalht', 'value'=>$bonlivraison->totalht,'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong> Total Remise </strong>
                                            </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('remisee', ['id' => 'totalremise', 'value'=>$bonlivraison->totalremise,'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remisee', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong> Total TVA</strong>
                                            </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control','value'=>$bonlivraison->totaltva, 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <strong> Total TTC </strong> </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('totalttc', ['id' => 'ttc','value'=>$bonlivraison->totalttc, 'label' => false, 'name', 'class' => 'form-control  calculinversetot', 'required' => 'off']); ?>
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
                                            <tr>

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
                                                    <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1','value'=>$bonlivraison->totalremise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remiseee', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr hidden>
                                            <td>Total HT après remise</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('totalapres', ['class' => 'form-control','value'=>$bonlivraison->totalht - $bonlivraison->totalremise, 'id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr hidden>
                                            <td>Total Fodec</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('fodec', ['id' => 'totalfodec','value'=>$bonlivraison->totalfodec, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr hidden>
                                            <td>Total PU ttc</td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc','value'=>$bonlivraison->totalputtc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td hidden>test ttc</td>
                                            <td>
                                                <div class="col-xs-4" hidden>
                                                    <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest','value'=>$bonlivraison->totalttc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                                                </div>
                                                <!-- <div class="col-xs-4" hidden>
                                                      <?php echo $this->Form->control('totalapres1', ['id' => 'totalhtapres1', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'test après remise', 'name', 'required' => 'off']); ?>
                                                 </div> -->
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div><br>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'value' => $bonlivraison->observation, 'type' => 'textarea']); ?>
                            </div>
                            <br>
                            <!-- <div class="col-xs-6">
                               
                                <textarea id="editor-container1" name="observation" class="form-control summernote" rows="100" cols="100" style="height: 900px;">
                                          <?php echo h($bonlivraison->observation); ?>
                                    </textarea>
                            </div> -->
                            <br>
                        </div>
                    </section>



                    <?php if ($bonlivraison->typebl == 1) { ?>


                        <section class="content-header">
                            <h1 class="box-title"><?php echo __('Mode Réglement'); ?></h1>
                        </section>

                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <a class="btn btn-primary ajouterligne reglclientchekajoutligne " table="addtable" index="indexreg" tr='type' style="
                                                        float: right;
                                                        margin-bottom: 5px;
                                                        ">
                                            <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

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



                                                                    <select table="pieceregelemnt" index="" champ="paiement_id" class="modereglement2 form-control select selectized">
                                                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                        <?php foreach ($paiements as $id => $paiement) {


                                                                        ?>
                                                                            <option value="<?php echo $id; ?>"><?php echo  $paiement ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                    <?php echo $this->Form->input('sup2', array('name' => '', 'id' => '', 'champ' => 'sup2', 'table' => 'pieceregelemnt', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form', 'label' => '')); ?>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbruta" table="piece" style="display:none" class="modecheque">Montant brut</td>
                                                                <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbrutb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                                        ?> </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Montant</td>
                                                                <td><?php
                                                                    echo $this->Form->control('montant', array('type'=>'number','step'=>'any','class' => 'form-control differance sum-input', 'label' => '', 'champ' => 'montant', 'table' => 'pieceregelemnt', 'name' => ''));
                                                                    ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxa" table="piece" style="display:none" class="modecheque">Taux</td>
                                                                <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                        echo $this->Form->input('valeur_id', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => ' form-control montantbrut', 'label' => '', 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => '', 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                        ?> </td>
                                                            </tr>
                                                            <tr>
                                                                <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantneta" table="piece" style="display:none" class="modecheque">Montant Net </td>
                                                                <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantnetb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                                    echo $this->Form->input('control', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => ''));
                                                                                                                                                                                                    ?> </td>
                                                            </tr>

                                                            <tr>
                                                                <td name="data[piece][0][trechance]" id="" index="0" champ="trechancea" table="piece" style="display:none" class="modecheque">Echéance </td>
                                                                <td name="data[piece][0][trechance]" id="" index="0" champ="trechanceb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                                echo $this->Form->control('echance', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'date', 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => ''));
                                                                                                                                                                                                ?> </td>
                                                            </tr>

                                                            <tr>
                                                                <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanquea" table="piece" style="display:none" class="modecheque">Banque </td>
                                                                <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanqueb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                            echo  $this->Form->control('banque_id', array(
                                                                                                                                                                                                'class' => 'form-control ',
                                                                                                                                                                                                'empty' => 'veuillez choisir',

                                                                                                                                                                                                'label' => '',
                                                                                                                                                                                                'champ' => 'banque',
                                                                                                                                                                                                'table' => 'pieceregelemnt',
                                                                                                                                                                                                'name' => ''
                                                                                                                                                                                            ));
                                                                                                                                                                                            ?></td>
                                                            </tr>


                                                            <tr>
                                                                <td name="data[piece][0][trnum]" id="" index="0" champ="trnuma" table="piece" style="display:none" class="modecheque">Numéro pièce </td>
                                                                <td name="data[piece][0][trnum]" id="" index="0" champ="trnumb" table="piece" style="display:none" class="modecheque">
                                                                    <div class='form-group' id="" index="0" champ="divnumc" table="piece" style="display:none">
                                                                        <label class='col-md-2 control-label'></label>
                                                                        <div class='col-sm-10' name="data[piece][0][trnum]" id="" index="0" champ="trnumc" table="piece" class="modecheque"> </div>
                                                                    </div>
                                                                    <div class='form-group' id="" index="0" champ="divnump" table="piece" style="display:none">
                                                                        <div class='col-sm-12'><?php echo $this->Form->input('num_piece', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => '')); ?></div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <!-- <tr>
                                                                <td name="data[piece][0][trporteur]" id="" index="0" champ="trporteura" table="piece" style="display:none" class="modecheque">Porteur chèque </td>
                                                                <td name="data[piece][0][trporteur]" id="" index="0" champ="trporteurb" table="piece" style="display:none" class="modecheque">
                                                                    <div class='form-group' id="" index="0" champ="divportc" table="piece" style="display:none">
                                                                        <label class='col-md-2 control-label'></label>
                                                                        <div class='col-sm-10' name="data[piece][0][trporteur]" id="" index="0" champ="trporteurc" table="piece" class="modecheque"> </div>
                                                                    </div>
                                                                    <div class='form-group' id="" index="0" champ="divportp" table="piece" style="display:none">
                                                                        <div class='col-sm-12'><?php echo $this->Form->input('porteurcheque', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'champ' => 'porteurcheque', 'table' => 'pieceregelemnt', 'name' => '')); ?></div>
                                                                    </div>
                                                                </td>

                                                            </tr> -->

                                                            <!-- <tr>
                                                                <td name="data[piece][0][trrib]" id="" index="0" champ="trriba" table="piece" style="display:none" class="modecheque">RIB </td>
                                                                <td name="data[piece][0][trrib]" id="" index="0" champ="trribb" table="piece" style="display:none" class="modecheque">
                                                                    <div class='form-group' id="" index="0" champ="divribc" table="piece" style="display:none">
                                                                        <label class='col-md-2 control-label'></label>
                                                                        <div class='col-sm-10' name="data[piece][0][trrib]" id="" index="0" champ="trribc" table="piece" class="modecheque"> </div>
                                                                    </div>
                                                                    <div class='form-group' id="" index="0" champ="divribp" table="piece" style="display:none">
                                                                        <div class='col-sm-12'><?php echo $this->Form->input('rib', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'champ' => 'rib', 'table' => 'pieceregelemnt', 'name' => '')); ?></div>
                                                                    </div>
                                                                </td>

                                                            </tr> -->
                                                            <!-- <tr>
                                                                <td>Caisse</td>

                                                                <td><?php
                                                                    echo $this->Form->input('caisse_id', array('class' => 'form-control', 'label' => '', 'empty' => 'Veuillez choisir !!', 'champ' => 'caisse_id', 'value' => $caisses, 'table' => 'pieceregelemnt', 'name' => ''));
                                                                    ?>
                                                                </td>

                                                            </tr> -->


                                                        </table>

                                                    </td>

                                                    <td align="center">
                                                        <i index="0" id="test" class="fa fa-times suppiece" style="color: #c9302c;font-size: 22px;"></i>
                                                    </td>
                                                </tr>
                                                <?php $read = "";
                                                $i = -1;
                                                foreach ($piecereglementclients as $i => $piece) {
                                                    //debug($piece->paiement_id); 
                                                    $i++;
                                                ?>
                                                    <tr>
                                                        <td colspan="8" style="vertical-align: top;">
                                                            <table>
                                                                <tr>
                                                                    <td>Mode de paiement </td>
                                                                    <td><?php
                                                                        echo $this->Form->control('paiement_id', array(
                                                                            'value' => $piece->paiement_id,
                                                                            'class' => 'form-control modereglement2 select2',
                                                                            'label' => '',
                                                                            'index' => $i,
                                                                            'id' => 'paiement_id' . $i,
                                                                            'table' => 'pieceregelemnt',
                                                                            'name' => 'data[pieceregelemnt][' . $i . '][paiement_id]'
                                                                        ));
                                                                        ?>
                                                                        <?php echo $this->Form->input('id', array('value' => $piece->id, 'name' => 'data[pieceregelemnt][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                                                        <?php echo $this->Form->input('sup2', array('name' => 'data[pieceregelemnt][' . $i . '][sup2]', 'id' => 'sup2' . $i, 'champ' => 'sup2', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>

                                                                    </td>
                                                                </tr>
                                                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trmontantbrut<?php echo $i  ?>">
                                                                    <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbruta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbruta" table="piece" class="modecheque">Montant brut</td>
                                                                    <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbrutb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbrutb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                                    echo $this->Form->control('montant_brut', array('value' => $piece->montant_brut, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control editmontantbrut', 'label' => '', 'type' => 'text', 'index' => $i, 'champ' => 'montantbrut', 'id' => 'montantbrut' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant_brut]'));
                                                                                                                                                                                                                                                    ?> </td>
                                                                </tr>
                                                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trtaux<?php echo $i  ?>">
                                                                    <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxa<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxa" table="piece" class="modecheque">Taux</td>
                                                                    <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                echo $this->Form->control('valeur_id', array('value' => $piece->to_id, 'class' => 'form-control select editmontantbrut', 'label' => '', 'index' => $i, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][taux]', 'id' => 'taux' . $i, 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                                                                ?> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Montant</td>
                                                                    <td><?php
                                                                        echo $this->Form->control('montant', array('type'=>'number','step'=>'any','value' => $piece->montant, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control differance sum-input', 'label' => '', 'index' => $i, 'champ' => 'montant', 'id' => 'montant' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant]'));
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trmontantnet<?php echo $i  ?>">
                                                                    <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantneta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantneta" table="piece" class="modecheque">Montant Net</td>
                                                                    <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantnetb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantnetb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                                                    echo $this->Form->control('montant_net', array('value' => $piece->montant_net, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => $i, 'id' => 'montantnet' . $i, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montantnet]'));
                                                                                                                                                                                                                                                    ?> </td>
                                                                </tr>
                                                                <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trechance]" id="trechancea<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Echéance</td>
                                                                    <td name="data[piece][<?php echo $i ?>][trechance]" id="trechanceb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                    echo $this->Form->control('echance', array('value' => $piece->echance, 'class' => 'form-control datetimepicker', 'label' => '', 'type' => 'date', 'id' => 'echance' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][echance]'));
                                                                                                                                                                                                                    ?> </td>
                                                                </tr>

                                                                <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trbanque<?php echo $i  ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Banque </td>
                                                                    <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                echo  $this->Form->control('banque_id', array(
                                                                                                                                                                                                                    'class' => 'form-control ',
                                                                                                                                                                                                                    'empty' => 'veuillez choisir',
                                                                                                                                                                                                                    'value' => $piece->banque_id,

                                                                                                                                                                                                                    'label' => '',
                                                                                                                                                                                                                    'index' => $i,
                                                                                                                                                                                                                    'id' => 'banque' . $i,
                                                                                                                                                                                                                    'table' => 'pieceregelemnt',
                                                                                                                                                                                                                    'name' => 'data[pieceregelemnt][' . $i . '][banque_id]'
                                                                                                                                                                                                                ));
                                                                                                                                                                                                                ?></td>
                                                                </tr>


                                                                <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="numpiece<?php echo $i  ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trnuma]" id="trnuma<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Numero piéce</td>
                                                                    <td name="data[piece][<?php echo $i ?>][trnumb]" id="trnumb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                                            echo $this->Form->control('num_piece', array('value' => $piece->num, 'class' => 'form-control ', 'label' => '', 'type' => 'number', 'id' => 'num' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][num_piece]'));
                                                                                                                                                                                                            ?> </td>
                                                                </tr>
                                                                <!-- <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="porteur<?php echo $i  ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trporteura]" id="trporteura<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Porteur chèque</td>
                                                                    <td name="data[piece][<?php echo $i ?>][trporteurb]" id="trporteurb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                    echo $this->Form->input('porteur', array('value' => $piece->porteurcheque, 'class' => 'form-control ', 'label' => '', 'type' => '', 'id' => 'porteurcheque' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][porteurcheque]'));
                                                                                                                                                                                                                    ?> </td>
                                                                </tr>
                                                                <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="nrib<?php echo $i  ?>">
                                                                    <td name="data[piece][<?php echo $i ?>][trriba]" id="trriba<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">RIB</td>
                                                                    <td name="data[piece][<?php echo $i ?>][trribb]" id="trribb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                                            echo $this->Form->input('rib', array('value' => $piece->rib, 'class' => 'form-control ', 'label' => '', 'type' => '', 'id' => 'rib' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][rib]'));
                                                                                                                                                                                                            ?> </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Caisse</td>

                                                                    <td><?php
                                                                        echo $this->Form->input('caisse_id', array('value' => $piece->caisse_id, 'class' => 'form-control', 'label' => '', 'index' => 0, 'empty' => 'Veuillez choisir !!', 'champ' => 'caisse_id', 'id' => 'caisse_id' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][caisse_id]'));

                                                                        ?>
                                                                    </td>

                                                                </tr> -->



                                                            </table>


                                                        </td>
                                                        <td align="center">
                                                            <i index="<?php echo $i ?>" class="fa fa-times suppiece" style="color: #c9302c;font-size: 22px;"></i>
                                                        </td>



                                                    </tr>
                                                <?php } ?>
                                                <input type="" value="<?php echo $i ?>" id="indexreg" hidden>
                                                </tbody>
                                            </table><br>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </section>
                    <?php } ?>
                    <!-- <div align="center">
                        <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff" id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                    </div> -->
                    <?php //echo $this->Form->end(); 
                    ?>
                    <div align="center">

                        <!-- <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff  btnOffreprix" id="boutonlivraison" style="margin-right:51%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button> -->
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 20px; margin-top: 20px; margin-bottom: 20px;">
                            <button type="submit" class=" testbl testdiv btn btn-success btn-sm verifBonres btnOffreprix" id="boutonlivraison" name="enregistrer" style="width: 130px;">
                                Enregistrer
                            </button>
                            <button type="submit" class="  testbl testdiv btn btn-primary btn-sm verifBonres btnOffreprix" id="boutonpdf" name="pdf" style="width: 70px;">
                                <i class="fa fa-print"></i> PDF
                            </button>
                            <button type="submit" class="  testbl testdiv btn btn-xs btn-primary custom-class" id="boutonimprimer" name="enregistrer_imprimer" style="background-color: #bb3385; color: white; border-color: white; width: 40px;">
                                <i class="fa fa-print"></i>
                            </button>

                            <br>
                        </div>

                        <?php echo $this->Form->hidden('action', ['id' => 'action']); ?>

                    </div>
                    <?php echo $this->Form->end(); ?>

                </div>



            </div>
        </div>
</section>
<script>
    $(document).ready(function() {
        $('.clientinfo').on('change', function() {
            // alert('hello');
            id = $('#idclient1').val();
            date = $('#date').val();

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
    // document.addEventListener('DOMContentLoaded', function() {
    //     var index = <?php echo $i; ?>;

    //     var inputCode = document.getElementById('article_idcode' + index);
    //     var datalistCode = document.getElementById('codearticle_id' + index);

    //     var inputDes = document.getElementById('article_iddes' + index);
    //     var datalistDes = document.getElementById('desarticle_id' + index);

    //     function selectOption(input, datalist) {
    //         var value = input.value.trim();
    //         var options = Array.from(datalist.options);

    //         // Vérifiez si la valeur de l'input est présente dans les options du datalist
    //         var optionExists = options.some(option => option.value === value);

    //         if (!optionExists) {
    //             // La valeur n'existe pas, donc nous la mettons à une valeur vide ou par défaut
    //             input.value = '';
    //         }
    //     }

    //     selectOption(inputCode, datalistCode);
    //     selectOption(inputDes, datalistDes);
    // });
</script>

<script>
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


<script type="text/javascript">
    $(document).ready(function() {
        $('#boutonlivraison').click(function() {
            $('#action').val('save');
        });

        $('#boutonimprimer').click(function() {
            $('#action').val('saveAndImprime');
        });

        $('#boutonpdf').click(function() {
            $('#action').val('saveAndImprimepdf');
        });


    });
    $(document).ready(function() {
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
            selectedcodename = $(this).val();
            // alert(selectedcodename);
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
                            // alert(data.select)
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
        $(function() {
            $('#transporteur_id').on('change', function() {

                selectedValue = $(this).val();


                if (selectedValue == 3) {
                   // $('#transporteur_id').val('').trigger('change');
                    $('#c1').show();
                    // $('#c2').show();
                    // $('#chauffeur_id').val('').trigger('change');
                    // $('#materieltransport_id').val('').trigger('change');
                    // $('#inputdiv').show();
                } else {
                    $('#c1').hide();
                    //$('#c2').hide();
                    // $('#selectdiv').show();
                    // $('#inputdiv').hide();
                    // $('#chauffeurname').val('');
                    // $('#matricule').val('');
                }
            });
        });

        $('.articleidbl1des').on('change', function() {
            // alert("hh");
            index = $(this).attr('index');
            //  alert(index);
            article_id = $('#article_iddes' + index).val();
            //  (article_id);
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
            article_id = $('#article_idcode' + index).val();

            // lert(article_id);
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
                            a = '<a onClick=\'openWindow(1000, 1000,wr+"promoarticles/notgrandsurface/' + valnot + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<div>aucun promo</div>'
                            $('#typecli').html(a);

                        }
                    } else if (data.typeclient == true) {
                        if (valgs != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,wr+"gspromoarticles/grandsurface/' + valgs + '")\'>' + nom + '</a>'
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
                    // $('#blocclient').show();
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
        //let rowAdded = false; // Flag to track if a row has been added

        $(".getclientdata").on("change", function() {
            var client_id = $("#idclient").val();
            var typebl = $("#typebl").val();

            $('#blocclient').hide();


            // if (!rowAdded) {
            if (client_id == 12 /*&& typebl == 1*/ ) {
                // ajoutermk('tabligne', 'index');
                //rowAdded = true; // Mark that the row is added
                $('#divnomprenom').attr('style', 'display:block;');
                $('#divnumeroident').attr('style', 'display:block;');
                $('#divadresseclt').attr('style', 'display:block;');
            } else if (client_id != 12) {
                // ajoutermk('tabligne', 'index');
                //  rowAdded = true; // Mark that the row is added
                $('#divnomprenom').attr('style', 'display:none;');
                $('#divnumeroident').attr('style', 'display:none;');
                $('#divadresseclt').attr('style', 'display:none;');
                $('#divnomprenom').val('');
                $('#divnumeroident').val('');
                $('#divadresseclt').val('');
            }
            //}

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
                        $('#blocclient').show();

                        $('#echanciere').val((data.echanciere).toFixed(3));
                        $('#echancierebl').val((data.echancierebl).toFixed(3));

                        $('#solde').val((data.solde).toFixed(3));
                        $('#plafond').val(data.donne.plafontheorique);

                        $('#encours').val((data.encours).toFixed(3));
                    },
                });
            }
        });


        $(".getclientdata1").on("change", function() {
            var client_id = $("#idclient1").val();
            var typebl = $("#typebl").val();

            $('#blocclient').hide();

            // Check if the row has been added already to avoid duplication
            //if (!rowAdded) {
            if (client_id == 12 /* && typebl == 1*/ ) {
                //  ajoutermk('tabligne', 'index');
                //  rowAdded = true; // Mark that the row is added
                $('#divnomprenom').attr('style', 'display:block;');
                $('#divnumeroident').attr('style', 'display:block;');
                $('#divadresseclt').attr('style', 'display:block;');
            } else if (client_id != 12) {
                //   ajoutermk('tabligne', 'index');
                //   rowAdded = true; // Mark that the row is added
                $('#divnomprenom').attr('style', 'display:none;');
                $('#divnumeroident').attr('style', 'display:none;');
                $('#divadresseclt').attr('style', 'display:none;');
                $('#divnomprenom').val('');
                $('#divnumeroident').val('');
                $('#divadresseclt').val('');
            }
            //}

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
                        $('#blocclient').show();

                        $('#echanciere').val((data.echanciere).toFixed(3));
                        $('#echancierebl').val((data.echancierebl).toFixed(3));

                        $('#solde').val((data.solde).toFixed(3));
                        $('#plafond').val(data.donne.plafontheorique);

                        $('#encours').val((data.encours).toFixed(3));
                    },
                });
            }
        });
    });
</script>
<script>
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
    // $(document).ready(function() {

    //     Calcul();
    //     $("form").submit(function() {
    //         $('#boutonlivraison').attr('disabled', 'disabled');
    //     })

    //     $("#boutonlivraison").on("mouseover", function() {
    //         Calcul();
    //     });


    // });
</script>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
        $(document).ready(function() {
            $('.testbl').on('mouseover', function() {
                // Retrieve input values
                depot = $('#depot-id').val();
                transporteur = $('#transporteur_id').val();
                chauffeurname = $('#chauffeurname').val();

                typebl = $('#typebl').val();
                //alert(typebl);
                //alert(transporteur)
                client = $('#idclient1').val();

                nomprenom = $('#nomprenom').val();
                numeroidentite = $('#numeroidentite').val();
                ttc = $('#ttc').val();

                indexreg = $('#indexreg').val();


                if (depot === "") {
                    alert("Veuillez choisir le depot !");
                    return false;
                }

                if (transporteur === "" && typebl == 1) {
                    alert("Veuillez choisir le transporteur !");
                    return false;
                }

                if (chauffeurname === "" && transporteur == 3 && typebl == 1) {
                    alert("Veuillez saisir le chauffeur !");
                    return false;
                }
                if (client === "") {
                    alert("Veuillez choisir le client !");
                    return false;
                }
                if (nomprenom === "" && client == 12) {
                    alert("Veuillez saisir le nom et prenom divérs !");
                    return false;
                }
                if (numeroidentite === "" && client == 12) {
                    alert("Veuillez saisir le numeroidentite !");
                    return false;
                }
                /*  if (indegreg === -1 && typebl == 1) {
                      alert("Veuillez choisir un mode paiement  !");
                      return false;
                  }*/
                 sum=0;
                $(".sum-input").each(function() {
                    if ($(this).is(":visible")) {
                        sum += Number($(this).val()) || 0;
                    }
                });
               // alert(sum);
               // alert(ttc);
                if (sum > ttc && typebl == 1) {
                    alert("Ne dépassez pas le total TTC du bon de livraison !");
                    return false;
                }
            });
            // $(".testdiv").on("mouseover", function() {
            //     var client = $("#idclient1").val();
            //     var nom = $("#nomprenom").val();
            //     var iden = $("#numeroidentite").val();

            //     // alert(type);
            //     if (client == 12) {
            //         if (nom == "") {
            //             alert("Saisie Le nom et prenom divers SVP !!");
            //             return;
            //         } else

            //         if (iden == "") {
            //             alert("Saisie Le numéro identité divers SVP !!");
            //             return;
            //         }
            //     }
            // })
        });
    </script>
<script>
    $(function() {

        $('#typetransport_id').on('change', function() {

            selectedValue = $(this).val();


            if (selectedValue == 3 || selectedValue == 1) {

                $('#selectdiv').hide();
                $('#chauffeur_id').val('').trigger('change');
                $('#materieltransport_id').val('').trigger('change');
                $('#inputdiv').show();
            } else {
                $('#selectdiv').show();
                $('#inputdiv').hide();
                $('#chauffeurname').val('');
                $('#matricule').val('');
            }
        });


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
                    var montantValue = $('#montant' + i).val().replace(',', '.');

                    if ($('#paiement_id' + i).val() == 10) {
                        sum = Number(sum) - Number(montantValue) || 0;
                    } else {
                        sum += Number(montantValue) || 0;
                    }
                }
            }

            $("#Montant_Regler").val(sum);
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
            $("#Montant_Regler").val(Number(sum)).trigger('change');

            $('#Montant').val(Number(sum));
        });

        $('.modereglement2').on('change', function() {

            index = $(this).attr('index');
            val = $(this).val();
            typefrs = $('#typefrs').val();
            nb = 0;

            $('#montant' + index).val('');

            diff2();

            if (Number(val) == 1) {

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
                $('#trimg' + index).show();
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
            } else if (Number(val) == 8) {
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
                $('#trimg' + index).show();
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

                tva = $('#CommandeclientTotaltva').val();
                retenuetva = Number(tva * 25 / 100);
                $('#montant' + index).val((retenuetva).toFixed(3));

            }

            //Perte*****************************
            else if (Number(val) == 9) {
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
                $('#trimg' + index).show();
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

            }
            //Gain******************************
            else if (Number(val) == 10) {


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
                $('#trimg' + index).show();
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
                $('#trimg' + index).show();
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
                $('#trmontantbruta' + index).hide();
                $('#trmontantbrutb' + index).hide();
                $('#trmontantneta' + index).hide();
                $('#trmontantnetb' + index).hide();
                $('#trtauxa' + index).hide();
                $('#trtauxb' + index).hide();
                $('#trimg' + index).show();
                $('#trechancea' + index).show();
                $('#trechanceb' + index).show();
                $('#trbanquea' + index).show();
                $('#trbanqueb' + index).show();
                $('#banque_idb' + index).hide(); // modifiction amin  
                $('#banque_ida' + index).hide(); // modifiction amin   
                $('#trnuma' + index).show();
                $('#trnumb' + index).show();
                $('#trporteura' + index).show();
                $('#trporteurb' + index).show();
                $('#trriba' + index).show();
                $('#trribb' + index).show();
                $('#trcarnetnuma' + index).show();
                $('#trcarnetnumb' + index).show();
                $('#divnumc' + index).show();
                $('#divportc' + index).show();
                $('#divribc' + index).show();
                $('#divnump' + index).show();
                $('#divportp' + index).show();
                $('#divribp' + index).show();
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
                $('#trnuma' + index).show();
                $('#trnumb' + index).show();
                $('#trporteura' + index).show();
                $('#trporteurb' + index).show();
                $('#trriba' + index).show();
                $('#trribb' + index).show();
                $('#divnump' + index).show();
                $('#divportp' + index).show();
                $('#divribp' + index).show();
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide();
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
                $('#montantbrut' + index).val('');
                $('#montantnet' + index).val('');
                $('#num_piece' + index).val('');
                $('#taux' + index).val(0).trigger('change');
            } else {
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
                $('#divportc' + index).hide();
                $('#divribc' + index).hide();
                $('#trechancea' + index).show();
                $('#trechanceb' + index).show();
                $('#trbanquea' + index).show();
                $('#trbanqueb' + index).show();
                $('#banque_idb' + index).show(); // modifiction amin
                $('#banque_ida' + index).show(); // modifiction amin
                $('#trnuma' + index).show();
                $('#trnumb' + index).show();
                $('#trporteura' + index).show();
                $('#trporteurb' + index).show();
                $('#trriba' + index).show();
                $('#trribb' + index).show();
                $('#divnump' + index).show();
                $('#divportp' + index).show();
                $('#divribp' + index).show();
            }

            if (Number(val) == 7) {
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
                $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
                $('#banque_ida' + index).hide(); // modifiction amin
                $('#trcarnetnuma' + index).hide();
                $('#trcarnetnumb' + index).hide();
            }



        });
        // $('.modereglement2').on('change', function() {

        //     index = $(this).attr('index');
        //     val = $(this).val();
        //     typefrs = $('#typefrs').val();
        //     nb = 0;

        //     $('#montant' + index).val('');

        //     diff2();

        //     if (Number(val) == 1) {
        //         //alert(val);
        //         //$('#trechance'+index).attr('class','') ;

        //         $('#trmontantbruta' + index).hide();
        //         $('#trmontantbrutb' + index).hide();
        //         $('#trmontantneta' + index).hide();
        //         $('#trmontantnetb' + index).hide();
        //         $('#trtauxa' + index).hide();
        //         $('#trtauxb' + index).hide();
        //         $('#trnbrmoins' + index).hide();
        //         $('#trechancea' + index).hide();
        //         $('#trechanceb' + index).hide();
        //         $('#trbanque' + index).hide();
        //         $('#trbanquea' + index).hide();
        //         $('#trbanqueb' + index).hide();
        //         // $('#trnum'+index).attr('class','') ;
        //         $('#trimg' + index).show();
        //         $('#numpiece' + index).hide();
        //         $('#porteur' + index).hide();
        //         $('#nrib' + index).hide(); // modifiction amin   
        //         $('#trnuma' + index).hide();
        //         $('#trnumb' + index).hide();
        //         $('#trporteura' + index).hide();
        //         $('#trporteurb' + index).hide();
        //         $('#trriba' + index).hide();
        //         $('#trribb' + index).hide();
        //         $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        //         $('#banque_ida' + index).hide(); // modifiction amin
        //         $('#trcarnetnuma' + index).hide();
        //         $('#trcarnetnumb' + index).hide();
        //     } else if (Number(val) == 22) {
        //         //alert(val);
        //         //$('#trechance'+index).attr('class','') ;

        //         $('#trmontantbruta' + index).hide();
        //         $('#trmontantbrutb' + index).hide();
        //         $('#trmontantneta' + index).hide();
        //         $('#trmontantnetb' + index).hide();
        //         $('#trtauxa' + index).hide();
        //         $('#trtauxb' + index).hide();
        //         $('#trnbrmoins' + index).hide();
        //         $('#trechancea' + index).hide();
        //         $('#trechanceb' + index).hide();
        //         $('#trbanquea' + index).show();
        //         $('#trbanqueb' + index).show();
        //         // $('#trnum'+index).attr('class','') ;
        //         $('#trimg' + index).show();
        //         $('#numpiece' + index).hide();
        //         $('#porteur' + index).hide();
        //         $('#nrib' + index).hide(); // modifiction amin   
        //         $('#trnuma' + index).hide();
        //         $('#trnumb' + index).hide();
        //         $('#trporteura' + index).hide();
        //         $('#trporteurb' + index).hide();
        //         $('#trriba' + index).hide();
        //         $('#trribb' + index).hide();
        //         $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        //         $('#banque_ida' + index).hide(); // modifiction amin
        //         $('#trcarnetnuma' + index).hide();
        //         $('#trcarnetnumb' + index).hide();
        //     } else if (Number(val) == 2) {
        //         //alert('cheque');
        //         $('#trmontantbruta' + index).hide();
        //         $('#trmontantbrutb' + index).hide();
        //         $('#trmontantneta' + index).hide();
        //         $('#trmontantnetb' + index).hide();
        //         $('#trtauxa' + index).hide();
        //         $('#trtauxb' + index).hide();
        //         $('#trimg' + index).show(); //alert('ok')

        //         $('#trechances' + index).show(); //alert('ok')
        //         $('#trechancea' + index).show(); //alert('ok')
        //         $('#trechanceb' + index).show();

        //         $('#trbanquea' + index).hide();
        //         $('#trbanqueb' + index).hide();
        //         $('#banque_idb' + index).hide(); // modifiction amin  
        //         $('#banque_ida' + index).hide();

        //         $('#numpiece' + index).show();
        //         $('#porteur' + index).show();
        //         $('#nrib' + index).show(); // modifiction amin   
        //         $('#trnuma' + index).show();
        //         $('#trnumb' + index).show();
        //         $('#trporteura' + index).show();
        //         $('#trporteurb' + index).show();
        //         $('#trriba' + index).show();
        //         $('#trribb' + index).show();

        //         //ajouter select carnet trnumb0
        //         $('#trcarnetnuma' + index).show(); //alert('ok')
        //         $('#trcarnetnumb' + index).show(); //alert('ok')
        //         $('#divnumc' + index).show(); //alert('ok')
        //         $('#divportc' + index).show();
        //         $('#divribc' + index).show();

        //         $('#divnump' + index).show(); //alert('ok')
        //         $('#divportp' + index).show();
        //         $('#divribp' + index).show();

        //     } else if (Number(val) == 5) {
        //         $('#pop').html('');
        //         $('#trimg' + index).show();

        //         $('#trmontantbrut' + index).show();
        //         $('#trmontantbruta' + index).show();
        //         $('#trmontantbrutb' + index).show();
        //         $('#trmontantnet' + index).show();
        //         $('#trmontantneta' + index).show();
        //         $('#trmontantnetb' + index).show();
        //         $('#trtaux' + index).show();
        //         $('#trtauxa' + index).show();
        //         $('#trtauxb' + index).show();
        //         $('#trnbrmoins' + index).hide();
        //         $('#trechancea' + index).hide();
        //         $('#trechanceb' + index).hide();
        //         $('#trbanque' + index).hide();
        //         $('#trbanquea' + index).hide();
        //         $('#trbanqueb' + index).hide();
        //         // $('#trnum'+index).attr('class','') ;
        //         $('#trnuma' + index).show();
        //         $('#trnumb' + index).show();
        //         $('#trporteura' + index).show();
        //         $('#trporteurb' + index).show();
        //         $('#trriba' + index).show();
        //         $('#trribb' + index).show();
        //         $('#numpiece' + index).show(); // modifiction amin   
        //         $('#porteur' + index).show();
        //         $('#nrib' + index).show();
        //         $('#divnump' + index).show();
        //         $('#divportp' + index).show();
        //         $('#divribp' + index).show();
        //         $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        //         $('#banque_ida' + index).hide();
        //         $('#trcarnetnuma' + index).hide();
        //         $('#trcarnetnumb' + index).hide();
        //         ttpayer = $('#ttpayer').val();
        //         $('#montantbrut' + index).val(ttpayer);

        //     } else {
        //         //  alert('aa');
        //         //$('#pop').html('');
        //         if (typefrs != 1) {
        //             if ((Number(val) == 4) || (Number(val) == 6)) {
        //                 $('#tablepaiement' + index).show();
        //                 $('#tr_regle_fournisseur' + index).show();
        //             }
        //         }
        //         $('#trimg' + index).show();
        //         $('#trmontantbruta' + index).hide();
        //         $('#trmontantbrutb' + index).hide();
        //         $('#trmontantneta' + index).hide();
        //         $('#trmontantnetb' + index).hide();
        //         $('#trtauxa' + index).hide();
        //         $('#trtauxb' + index).hide();
        //         //******************
        //         $('#trcarnetnuma' + index).hide();
        //         $('#trcarnetnumb' + index).hide();
        //         $('#divnumc' + index).hide();
        //         ('#divportc' + index).hide();
        //         $('#divribc' + index).hide();
        //         $('#trechancea' + index).show();
        //         $('#trechanceb' + index).show();
        //         $('#trbanquea' + index).show();
        //         $('#trbanqueb' + index).show();
        //         $('#banque_idb' + index).show(); // modifiction amin
        //         $('#banque_ida' + index).show(); // modifiction amin
        //         //$('#trechance'+index).attr('class','display:none') ;
        //         $('#trnuma' + index).show();
        //         $('#trnumb' + index).show();
        //         $('#trporteura' + index).show();
        //         $('#trporteurb' + index).show();
        //         $('#trriba' + index).show();
        //         $('#trribb' + index).show();

        //         $('#divnump' + index).show();
        //         $('#divportp' + index).show();
        //         $('#divribp' + index).show();


        //         //$('#trnum'+index).attr('class','display:none') ;  
        //     }

        //     if (Number(val) == 7) {
        //         //alert('aa');
        //         $('#trmontantbruta' + index).hide();
        //         $('#trmontantbrutb' + index).hide();
        //         $('#trmontantneta' + index).hide();
        //         $('#trmontantnetb' + index).hide();
        //         $('#trtauxa' + index).hide();
        //         $('#trtauxb' + index).hide();
        //         $('#trechancea' + index).hide();
        //         $('#trechanceb' + index).hide();
        //         $('#trbanquea' + index).show();
        //         $('#trbanqueb' + index).show();

        //         $('#trnbrmoins' + index).show();
        //         $('#trnuma' + index).hide();
        //         $('#trnumb' + index).hide();
        //         $('#trporteura' + index).hide();
        //         $('#trporteurb' + index).hide();
        //         $('#trriba' + index).hide();
        //         $('#trribb' + index).hide();
        //         $('#numpiece' + index).hide();
        //         $('#porteur' + index).hide();
        //         $('#nrib' + index).hide(); // modifiction amin   

        //         $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        //         $('#banque_ida' + index).hide(); // modifiction amin
        //         $('#trcarnetnuma' + index).hide();
        //         $('#trcarnetnumb' + index).hide();
        //     }




        // });
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
    $('.select2').select2();
</script>
<?php $this->end(); ?>