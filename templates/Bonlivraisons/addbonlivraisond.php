<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>

<?php

use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2');
//debug($commande);die;
?>

<?php //echo $this->Html->script('salma'); 
?>
<?php echo $this->Html->script('calculvente'); ?>


<?php echo $this->fetch('script'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ajout Bon de livraison
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['controller' => 'commandes',    'action' => 'index']);
                        ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
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
                <?php ///  debug($commande);
                echo $this->Form->create($bonlivraison, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>


                <div class="box-body">
                    <div class="row">




                        <div class="col-xs-1" hidden>
                            <?php echo $this->Form->control('typebl', ['label' => 'Type Bl', 'type' => 'text', 'value'  => 1, 'required' => 'off']); ?>

                        </div>

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'class' => 'form-control', 'value' => $mm, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>




                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('date', ['readonly', 'class' => 'form-control', "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]); ?>
                                </div>

                                <div class="col-xs-3">

                                    <label class="control-label" for="depot-id">Depots</label>

                                    <select readonly name="depot_id" id="depot" class="form-control  control-label ">
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                        <?php foreach ($depots as $i => $d) {
                                        ?>
                                            <option <?php if ($depot_id == $d->id) { ?> selected="selected" <?php } ?> value="<?php echo $d->id; ?>"><?php echo $d->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>



                                <?php echo $this->Form->control('exotva', ['type' => 'hidden', 'value' => '']); ?>
                                <?php echo $this->Form->control('exofodec', ['type' => 'hidden', 'value' => '']); ?>

                                <div class="col-xs-3">
                                    <?php
                                    echo $this->Form->control('transporteur_id', ['label' => 'Transporteur', 'options' => $transporteurs, 'empty' => 'Veuillez Choisir !!', 'class' => "form-control select2 ", 'id' => 'transporteur_id']);
                                    ?>
                                </div>


                            </div>
                        </div>






                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                            <div class="row">


                                <div class="col-xs-6" hidden>

                                    <?php echo $this->Form->control('nouveau_client', ['type' => 'hidden', 'value' => $nv_client, 'id' => 'nouv', 'label' => '', 'class' => 'form-control ontrol-label']); ?>


                                    <?php echo $this->Form->control('bonusclient', ['type' => 'hidden', 'value' => $bonus, 'id' => 'bonus', 'label' => '', 'class' => 'form-control ontrol-label']); ?>


                                    <?php echo $this->Form->control('commercial', ['type' => 'hidden', 'name' => 'commercial_id', 'value' => $commercial->id, 'label' => '', 'class' => 'form-control ontrol-label']); ?>

                                </div>










                            </div>
                        </div>








                        <!-- <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; "> -->















                        <div class="col-xs-6" id="c1" style="display:none">
                            <?php
                            echo $this->Form->control('chauffeurname', ['label' => ' Chauffeur',  'class' => "form-control  ", 'id' => 'chauffeurname']);
                            ?>
                        </div>
                        <div class="col-xs-6" id="c2" style="display:none" hidden>
                            <?php
                            // echo $this->Form->control('matricule', ['label' => 'Matricule',  'class' => "form-control  ", 'id' => 'matricule']);
                            ?>
                        </div>


                    </div>

                    <br>
                    <?php //if ($type == 1 ) { 
                    ?>

                    <?php //} 
                    ?>

                    <div id="selectdiv">

                        <div class="col-xs-6" hidden>
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

                    <div id="inputdiv" style="display:none">

                        <!-- <div class="col-xs-6" hidden>

                                <?php //echo $this->Form->control('chauffeurname', ['label' => 'Chauffeur', 'required' => 'off']); 
                                ?>

                            </div>

                            <div class="col-xs-6" hidden>
                                <?php //echo $this->Form->control('matricule', ['label' => 'Camion', 'required' => 'off']); 
                                ?>

                            </div> -->
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

                    <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px" value="<?php echo $commande->client->Fodec ?>">


                    <!-- <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; " hidden>


                            <div class="row">


                                <div class="col-xs-6" style="margin-top: 20px ;">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>

                                    OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="calcheck" style="margin-right: 20px" <?php if ($payment == 1) { ?> checked="checked" <?php } ?>>
                                    NON <input type="radio" name="checkpayement" value="0" id="NON" class="calcheck" <?php if ($payment == 0) { ?> checked="checked" <?php } ?>>


                                </div>

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'value' => $commande->observation, 'type' => 'textarea']); ?>
                                </div>
                            </div>
                        </div> -->



                    <div>
                        <?php
                        echo $this->Form->input('bl', ['type' => 'hidden', 'label' => '', 'class' => 'form-control', 'value' => $commande->bl]);
                        ?>
                    </div>



                    <div class="col-xs-12">
                        <div class="col-xs-4">
                            <div class="form-group input select required">

                                <label class="control-label"> Client</label>

                                <select name="client_id" readonly id="client" class="form-control  control-label ">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($clients as $id => $client) {
                                    ?>
                                        <option <?php if ($client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                            echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-3" hidden>
                            <div class="form-group input select required">

                                <label class="control-label">Nom Client</label>

                                <select name="client_id" readonly id="client" class="form-control  control-label ">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($clients as $id => $client) {
                                    ?>
                                        <option <?php if ($client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                            //if ($client->Tel != null) {
                                                                                                                                                            //  echo $client->Tel . ' -- ';
                                                                                                                                                            //}
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
                                    echo $this->Form->input('plafond', array('readonly' => 'readonly', 'value' => $bonlivraisonfirst->client->plafontheorique,   'style' => 'background-color:#FFEFD4; color:#000000 ;', 'label' => 'plafond', 'id' => 'plafond', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
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


                                <!-- <input type="hidden" id="cl_id" value="<?php echo $clientc->id ?>">
                                   <input type="hidden" id="typeclient" value="<?php echo $cl; ?>">
                                  <input type="hidden" id="typeclientidd" value="<?php echo $clientc->typeclient_id ?>">
                                   <input type="hidden" id="gouvernorat_id" value="<?php echo $clientc->gouvernorat_id ?>"> -->


                            </div>
                        </div>

                    </div>

                    <?php
                    if ($bonlivraisonfirst->client_id == 12) {
                        $stylee = "display:block;";
                    } else {
                        $stylee = "display:none;";
                    }
                    //    if (/*$bonlivraison->typebl == 1 &&*/$bonlivraisonfirst->client_id == 12) {

                    ?>
                    <div class="col-xs-4" id="divnomprenom" style="<?php echo $stylee; ?>">
                        <?php echo $this->Form->control('nomprenom', ['label' => 'Nom / Prénom', 'readonly' => 'readonly', 'value' => $bonlivraisonfirst->nomprenom, 'required' => 'off', 'class' => 'form-control focus']); ?>

                    </div>
                    <div class="col-xs-4" id="divnumeroident" style="<?php echo $stylee; ?>">
                        <?php echo $this->Form->control('numeroidentite', ['label' => 'Numéro identité', 'readonly' => 'readonly', 'value' => $bonlivraisonfirst->numeroidentite, 'required' => 'off', 'class' => 'form-control focus']); ?>

                    </div>
                    <div class="col-xs-4" id="divadresseclt" style="<?php echo $stylee; ?>">
                        <?php echo $this->Form->control('adressediv', ['label' => 'Adresse', 'required' => 'off', 'readonly' => 'readonly', 'value' => $bonlivraisonfirst->adressediv, 'class' => 'form-control focus']); ?>
                    </div>
                    <?php //} 
                    ?>

                    <input value="<?php echo $exofodec ?>" type="hidden" name="fodecclientexo" id="fodecclientexo" class="" style="margin-right: 20px">
                    <input type="hidden" name="timbreclientexo" id="timbreclientexo" class="" style="margin-right: 20px">
                    <input value="<?php echo $exotva ?>" type="hidden" name="tvaclientexo" id="tvaclientexo" class="" style="margin-right: 20px">
                    <input value="<?php echo $exotpe ?>" type="hidden" name="tpeclientexo" id="tpeclientexo" class="" style="margin-right: 20px">






                </div>
                <?php $poids = 0;
                $nbli = 0;

                foreach ($commande as $i => $com) {
                    $poids += $com->Poids;
                    $nbli += $com->nbligne;
                    $p = $com->pallette;

                    if ($p) {
                        $coeff = $poids / $p;
                    }

                    // debug( $coeff );                  
                }
                ?>


                <br>
                <br>
                <?php
                if ($bonlivraisonfirst->client_id == 12) {
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
                                <!-- <a class="btn btn-primary al" table='addtable' index='index' id='ajouter_ligne_article' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter article</a> -->
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">


                                        <thead>
                                            <tr style="font-size: 20px;">
                                                <td align="center" style="width: 12%; font: size 20px;"><strong>Code</strong></td>

                                                <td align="center" style="width: 20%; font: size 20px;"><strong>Désignation</strong></td>
                                                <td align="center" style="width: 8%;"><strong>Qte Stock </strong></td>
                                                <td align="center" style="width: 6%;"><strong>Qte </strong></td>
                                                <td align="center" style="width: 6%;"><strong>Qte liv</strong></td>
                                                <td align="center" style="width: 6%;"><strong>Qte reste</strong></td>
                                                <td align="center" style="width: 6%;"><strong>P.Av.R </strong></td>

                                                <!-- <td align="center" style="width: 6%;"><strong>ml </strong></td> -->
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

                                            <?php $i = -1;
                                            foreach ($lignebonlivraisons as  $res) :
                                                //debug($res);
                                                $articleid =  $res->article_id;

                                                $depotid = $bonlivraisonfirst->depot_id;
                                                // debug($depotid);die;
                                                date_default_timezone_set('Africa/Tunis');
                                                $date = date('Y-m-d H:i:s');


                                                $connection = ConnectionManager::get('default');

                                                $lignebls = $connection->execute('SELECT SUM(quantiteliv) AS qtelivre FROM lignebonlivraisons WHERE idlignebonlivraison = :idlignebonlivraison', ['idlignebonlivraison' => $res->id])
                                                    ->fetch('assoc');
                                                $qteliv = 0;
                                                if ($lignebls['qtelivre'] != null) {
                                                    $qteliv = $lignebls['qtelivre'];
                                                }



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
                                                // $connection = ConnectionManager::get('default');
                                                // $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                // $stockk = $inv[0]['v'];
                                                if ($res->qte - $qteliv > 0) {
                                                    $i++;
                                            ?>
                                                    <tr style="font-size: 18px;font-weight: bold;">
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
                                                            <div>
                                                                <select readonly name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" id="<?php echo 'article_id' . $i ?>" style="pointer-events:none" table="ligner" index="<?php echo $i ?>" champ="article_id" class="form-control articleidbl1 Testdep single">
                                                                    <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                    <?php foreach ($articles as $id => $article) {
                                                                    ?>
                                                                        <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code  ?></option>
                                                                    <?php } ?>
                                                                </select>

                                                            </div>



                                                        </td>
                                                        <td align="center">

                                                            <div>
                                                                <select readonly name="<?php echo "data[ligner][" . $i . "][articledes]" ?>" id="<?php echo 'articledes' . $i ?>" style="pointer-events:none" table="ligner" index="<?php echo $i ?>" champ="articledes" class="form-control articleidbl1 Testdep single">
                                                                    <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                    <?php foreach ($articles as $id => $article) {
                                                                    ?>
                                                                        <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo  $article->Dsignation ?></option>
                                                                    <?php } ?>
                                                                </select>

                                                            </div>



                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('qteStock', array('label' => '', 'value' => $stockk, 'readonly' => 'readonly', 'name' => 'data[ligner][' . $i . '][qteStock]', 'type' => 'text', 'id' => 'qteStock' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ', 'index')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('qtetot', array('label' => '', 'value' => $res->qte - $lignebls['qtelivre'], 'name' => 'data[ligner][' . $i . '][qtetot]', 'type' => 'number', 'id' => 'qtetot' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ', 'index', 'readonly')); ?>

                                                            <input type="hidden" table="ligner" name="" id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('qtelivre', array('label' => '', 'value' => $qteliv, 'name' => 'data[ligner][' . $i . '][qtelivre]', 'type' => 'number', 'id' => 'qtelivre' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte - $lignebls['qtelivre'], 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'number', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 ', 'index')); ?>

                                                            <input type="hidden" table="ligner" name="" id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                        </td>
                                                        <td align="center" hidden>
                                                            <?php echo $this->Form->input('ml', array('label' => '', 'value' => $res->ml, 'name' => 'data[ligner][' . $i . '][ml]', 'type' => 'text', 'id' => 'ml' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 ', 'index')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('puttcapr', array('label' => '', 'value' => $res->puttcapr, 'readonly' => 'readonly', 'name' => 'data[ligner][' . $i . '][puttcapr]', 'type' => '', 'id' => 'puttcapr' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculligne2 findtth1 ttcligne')); ?>

                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('puttc', array('label' => '', 'value' => $res->puttc, 'name' => 'data[ligner][' . $i . '][puttc]', 'type' => '', 'id' => 'puttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control findtth1 ttcligne ', 'index')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('remise', array('readonly' => $readonly, 'label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control findtth2', 'index')); ?>

                                                            <?php echo $this->Form->input('montantht', array('label' => '', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][motanttotal]', 'type' => 'hidden', 'id' => 'motanttotal' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                            <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('prix', array('label' => '', 'readonly' => 'readonly', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 ', 'index')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('ht', array('readonly', 'label' => '', 'value' => $res->prixht, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                        </td>

                                                        <td align="center">
                                                            <?php echo $this->Form->control('monatantlignetva', ['value' => $res->totaltva, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => 'monatantlignetva' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][monatantlignetva]', 'required' => 'off']); ?>
                                                            <?php echo $this->Form->input('tva', array('value' => $res->tva, 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                                        </td>
                                                        <td align="center" hidden>
                                                            <?php echo $this->Form->control('fodeccommandeclient', ['value' => $res->fodec, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][fodeccommandeclient]', 'required' => 'off']); ?>
                                                            <?php echo $this->Form->input('fodec', array('readonly' => 'readonly', 'label' => '', 'value' => $res->fodec, 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => '', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                            <?php
                                                            echo $this->Form->input('totatlttc', array(
                                                                'type' => 'hidden',
                                                                'name' => 'data[ligner][' . $i . '][totalttc]',
                                                                'label' => '',
                                                                'value' => $res->ttc,
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
                                                            <?php
                                                            echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ttcligne', 'index')); ?>
                                                            <?php echo $this->Form->input('ttchidden', array('label' => '', 'readonly' => 'readonly', 'value' => $res->ttchidden, 'name' => 'data[ligner][' . $i . '][ttchidden]', 'type' => 'hidden', 'id' => 'ttchidden' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>

                                                        </td>
                                                        <td align="center" hidden>
                                                            <?php echo $this->Form->input('ttctest', array('readonly', 'label' => '', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttctest]', 'type' => '', 'id' => 'ttctest' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control verifttc calculinverse', 'index')); ?>

                                                        </td>
                                                        <td align="center">

                                                            <i index="<?php echo $i ?>" class="fa fa-times supLignearticle2" style="color: #C9302C;font-size: 22px;">
                                                        </td>


                                                    </tr>
                                            <?php }
                                            endforeach; ?>
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
                                                    <input type="number" table="ligner" name="" id="" champ="qte" type="text" class=" calculligne2 form-control" index>
                                                </td>

                                                <td align="center" table="ligner">
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
                                    </table><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <section class="content" style="width: 99%">
                    <div class="row" id="sec">
                        <div class="row">
                            <!-- <div style=" position: static;">
                           
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('total', ['id' => 'totalht', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalht)), 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('remisee', ['id' => 'totalremise', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalremise)),  'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalremise)),  'class' => 'form-control',  'readonly' => 'readonly', 'label' => 'test remise', 'name' => 'remiseee', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalapres', ['id' => 'totalhtapres', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalht - $bonlivraisonfirst->totalremise)),  'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totaltva)), 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalfodec)), 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalputtc)),  'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total puttc', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('totalttc', ['class' => 'form-control calculinversetot  ', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalttc - $bonlivraisonfirst->timbre->timbre)), 'id' => 'ttc', 'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'readonly' => 'readonly', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalttc - $bonlivraisonfirst->timbre->timbre)), 'label' => 'test ttc', 'name', 'class' => 'form-control verifttctotal calculinversetot', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('Montant_Regler', ['class' => 'form-control', 'type' => 'text', 'value' => '', 'id' => 'Montant_Regler', 'readonly' => 'readonly', 'label' => 'Montant_Regler', 'name', 'required' => 'off']); ?>
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
                                                <?php echo $this->Form->control('total', ['id' => 'totalht', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->total)),  'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Total Remise </strong>
                                        </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('remisee', ['id' => 'totalremise', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->remise)),  'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Total TVA</strong>
                                        </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->tva)), 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong> Total TTC </strong> </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalttc', ['class' => 'form-control verifttctotal calculinversetot', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalttc)),  'id' => 'ttc', 'label' => false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>

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
                                                <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->remise)), 'class' => 'form-control',  'readonly' => 'readonly', 'label' => 'test remise', 'name' => 'remiseee', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td>Total HT après remise</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalapres', ['id' => 'totalhtapres', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->total -  $bonlivraisonfirst->remise)),  'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr hidden>
                                        <td>Total Fodec</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->fodec)), 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td>Total PU ttc</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalputtc)),  'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total puttc', 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td >test ttc</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraisonfirst->totalttc)),  'readonly' => 'readonly', 'label' => 'test ttc', 'name', 'class' => 'form-control verifttctotal calculinversetot', 'required' => 'off']); ?>
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
                            <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'value' => $bonlivraisonfirst->observation, 'class' => 'form-control',  'type' => 'textarea']); ?>
                        </div><br>
                    </div>
                </section>

                <?php //if ($type == 1) { 
                ?>
                <section class="content-header">
                    <h1 class="box-title">
                        <?php echo __('Mode Réglement'); ?>
                    </h1>
                </section>
                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box box-">
                            <div class="box-header with-border">
                                <a class="btn btn-primary ajouterligne  reglclientchekajoutligne " table="addtable2" index="indexreg" tr='type' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                    <i class="fa fa-plus-circle "></i> Ajouter ligne </a>

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="addtable2">
                                        <tr class="type" style="display: none ">
                                            <td colspan="8" style="vertical-align: top;">
                                                <table>
                                                    <tr>
                                                        <td>Mode de paiement </td>
                                                        <td>
                                                            <select table="pieceregelemnt" index="" champ="paiement_id" id="paiement_id" class="modereglement2  form-control">
                                                                <?php foreach ($paiements as $id => $paiement) {
                                                                ?>
                                                                    <option value="<?php echo $id; ?>">
                                                                        <?php echo $paiement ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                            <?php echo $this->Form->input('sup2', array('name' => '', 'id' => '', 'champ' => 'sup2', 'table' => 'pieceregelemnt', 'index' => '', 'type' => 'hidden', 'class' => 'form', 'label' => '')); ?>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbruta" table="piece" style="display:none" class="modecheque">Montant brut</td>
                                                        <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbrutb" table="piece" style="display:none" class="modecheque">
                                                            <?php
                                                            echo $this->Form->control('montant_brut', array('class' => 'form-control montantbrut', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantbrut', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant_brut]'));
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Montant</td> <!-- mnt bl -->
                                                        <td>
                                                            <?php
                                                            echo $this->Form->control('montant', array('class' => 'form-control sum-input differance', 'id' => 'montant', 'label' => '', 'index' => 0, 'champ' => 'montant', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant]'));
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxa" table="piece" style="display:none" class="modecheque">Taux</td>
                                                        <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxb" table="piece" style="display:none" class="modecheque">
                                                            <?php
                                                            echo $this->Form->control('valeur_id', array('class' => ' form-control sum-input  tauxx', 'label' => '', 'index' => 0, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][taux]', 'empty' => 'Veuillez choisir'));
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantneta" table="piece" style="display:none" class="modecheque">Montant Net </td>
                                                        <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantnetb" table="piece" style="display:none" class="modecheque">
                                                            <?php
                                                            echo $this->Form->control('montant_net', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant_net]'));
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td name="data[piece][0][trechance]" id="" index="0" champ="trechancea" table="piece" style="display:none" class="modecheque">Echéance </td>
                                                        <td name="data[piece][0][trechance]" id="" index="0" champ="trechanceb" table="piece" style="display:none" class="modecheque">
                                                            <?php
                                                            echo $this->Form->control('echance', array('class' => 'form-control ', 'label' => '', 'type' => 'date', 'value' => '99/99/9999', 'index' => 0, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][echance]'));
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanquea" table="piece" style="display:none" class="modecheque">Banque </td>
                                                        <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanqueb" table="piece" style="display:none" class="modecheque">
                                                            <?php
                                                            echo $this->Form->control('banque_id', array('class' => 'form-control ', 'empty' => 'veuillez choisir', 'label' => '', 'index' => 0, 'champ' => 'banque', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][banque]'));
                                                            ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td name="data[piece][0][trnum]" id="" index="0" champ="trnuma" table="piece" style="display:none" class="modecheque">Numéro
                                                            pièce </td>
                                                        <td name="data[piece][0][trnum]" id="" index="0" champ="trnumb" table="piece" style="display:none" class="modecheque">
                                                            <div class='form-group' id="" index="0" champ="divnumc" table="piece" style="display:none">
                                                                <label class='col-md-2 control-label'></label>
                                                                <div class='col-sm-10' name="data[piece][0][trnum]" id="" index="0" champ="trnumc" table="piece" class="modecheque"> </div>
                                                            </div>
                                                            <div class='form-group' id="" index="0" champ="divnump" table="piece" style="display:none">
                                                                <div class='col-sm-12'>
                                                                    <?php echo $this->Form->control('num_piece', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][num_piece]')); ?>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>





                                                </table>

                                            </td>

                                            <td align="center">
                                                <i id="" index="0" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;"></i>
                                            </td>
                                        </tr>

                                        <input type="" value="-1" id="indexreg" hidden>
                                        </tbody>
                                    </table><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php //} 
                ?>

                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff testdepqte numerobl" id="boutonlivraison" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                </div>
                <?php echo $this->Form->end(); ?>

            </div>

        </div>

    </div>
    </div>
</section>



<?php


$missingSerials = [];

$connection = ConnectionManager::get('default');


$currentYear = date('Y');
$query = 'SELECT numero FROM bonlivraisons WHERE YEAR(bonlivraisons.date) = :year AND bonlivraisons.typebl = 1';
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
        $(".numerobl").on("click", function() {
    
            var missingSerialsJs = <?php echo json_encode($missingSerials); ?>;

            if (missingSerialsJs.length > 0) {
                var firstMissingSerial = missingSerialsJs[0];
                var paddedString = padNumberWithZeros(firstMissingSerial, 0);

                var confirmMessage = "Le numéro " + paddedString + " est libre. Voulez-vous l'utiliser ? Sinon, annulez pour conserver le numéro actuel.";

                if (confirm(confirmMessage)) {
               
                    $("#numero").prop('readonly', false)
                        .val(paddedString)
                        .prop('readonly', true);
                } else {
                    var numero = $("#numero").val();
                    alert("Numéro Bon Livraison : " + numero);
                }
            } else {
                alert("Aucun numéro manquant n'est disponible.");
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.testdepqte').on('mouseover', function() {
            // index = $('#ligne0').val() || 0;
            index = $('#index').val();
            //alert(index);
            for (j = 0; j <= Number(index); j++) {

                quantiteliv = $('#qte' + j).val();
                /// alert(quantiteliv);
                quantite = $('#qtetot' + j).val();

                //alert(qtestock)
                if ((quantiteliv == '')) {
                    alert('Saisie une quantité livrée dans la ligne N° ' + (j + 1));
                    return false;
                } else if (Number(quantiteliv) > Number(quantite)) {
                    alert('La quantité livrée doit être supérieure à la quantité commandée dans la ligne N° ' + (j + 1));
                    $('#qte' + j).val(""); // Clear the entered quantity
                    return false;

                }

            }

        });
    });

    $(function() {




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
                    //  Calcul();
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

        $("#boutonlivraison").on("mouseover", function() {
            // alert('ffffffffffffff');
            var client = $("#client").val();
            var indice = $("#indexreg").val();

            if (client == 12) {
                if (indice == -1) {
                    alert("Veuillez ajouter au moins une ligne de paiement SVP !!");
                    return;
                }
            }

        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.tauxx').on('keyup change', function() {
            // alert('hhh')
            index = $('#indexreg').val();
            max = $('#max').val();
            variable1 = $('#ttc').val();
            $('#montantbrut' + index).val(variable1) || 0;
            montantbrut = $('#montantbrut' + index).val();
            taux = '';
            t = $('#taux' + index).val() || 0; //alert(t);
            //  alert(t);
            if (t == '1') {
                taux = 1
            };
            if (t == '2') {
                taux = 3
            };
            if (t == '3') {
                taux = 10
            };
            if (t == '4') {
                taux = 5
            };
            if (t == '5') {
                taux = 1.5
            };
            if (t == '6') {
                taux = 0.5
            };
            if (t == '7') {
                taux = 15
            };
            if (t == '8') {
                taux = 0
            };
            if (t == '9') {
                taux = 25
            };
            // alert(taux);
            //alert(montantbrut);
            retenue = (montantbrut * (taux / 100)).toFixed(3);
            $('#montant' + index).val(retenue);

            net = (montantbrut - retenue).toFixed(3);
            $('#montantnet' + index).val(net);
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

        $(".ajouterligne").on('click', function() {

            table = $(this).attr('table'); //id table
            index = $(this).attr('index'); // id max compteur
            tr = $(this).attr('tr');
            //  alert(tr);
            ajouterlignereg(table, index, tr);
        })


        $(".supreg").on("click", function() {
            index = $(this).attr("indexreg");
            //alert(index);
            $("#sup2" + index).val("1");
            //alert(('#sup0' + ind).val());
            $(this).parent().parent().hide();
            var sum = 0;
            $(".sum-input").each(function() {
                if ($(this).is(":visible")) {
                    sum += Number($(this).val()) || 0;
                }
            });
            $("#Montant_Regler").val(sum);
        });
        // $(".boutonlivraison").on("keyup", function() {
        //     Calcul();
        // });


    });

    $(document).on("change", ".sum-input", function() {
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

    function ajouterlignereg(table, index, tr) {
        //class class type
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
        //alert(ind)
        // $("#paiement_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        $("#banque_id" + ind).select2({
            width: '100%' // need to override the changed default
        });

        // $('#'+table).find('tr:last').attr('style','');
        //		for(j=0;j<=i;j++){
        //		uniform_select(tabb[j]);
        //		}
        $('.trstituation').hide();

        //});
        //    alert('ffffffffffffff')

    }

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
    $(document).ready(function() {
        //  Calcul();


        // $("form").submit(function() {
        //     $('#boutonlivraison').attr('disabled', 'disabled');
        // })
        // $(".calculm").on("keyup", function() {
        //     Calcul();
        // });
        // $("#boutonlivraison").on("mouseover", function() {
        //     Calcul();
        // });





        $('#transporteur_id').on('change', function() {

            selectedValue = $(this).val();


            if (selectedValue == 3) {

                $('#c1').show();
                $('#c2').show();
                // $('#chauffeur_id').val('').trigger('change');
                // $('#materieltransport_id').val('').trigger('change');
                // $('#inputdiv').show();
            } else {
                $('#c1').hide();
                $('#c2').hide();
                // $('#selectdiv').show();
                // $('#inputdiv').hide();
                // $('#chauffeurname').val('');
                // $('#matricule').val('');
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
<?php $this->start('scriptBottom'); ?>
<script>
    $('.select2').select2();
</script>
<?php $this->end(); ?>