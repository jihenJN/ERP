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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript">
</script>

<?php echo $this->Html->css('select2'); ?>
<?php //echo $this->Html->script('salma');
?>

<?php //echo $this->Html->script('hechem'); 
?>
<?php echo $this->Html->script('calculvente'); ?>



<?php echo $this->fetch('script'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ajout commande
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
                <?php echo $this->Form->create($commande, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>


                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-1" hidden>
                                    <?php echo $this->Form->control('typebl', ['label' => 'Type Bl', 'type' => 'text', 'value' => 1, 'required' => 'off']); ?>

                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $mm, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">

                                    <?php echo $this->Form->control('date', ['readonly', "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>
                                </div>

                                <?php //debug($bonlivraison->client_id); 
                                ?>

                                <div class="col-xs-4">

                                    <?php echo $this->Form->control('depot_id', ['options' => $depots, 'value' => $bonlivraison->depot_id, 'empty' => 'Veuillez choisir !!', 'readonly' => 'readonly', 'required' => 'off', 'label' => 'Depots', 'class' => 'form-control  control-label']); ?>
                                </div>



                            </div>
                        </div>


                        <div class="col-xs-12">

                            <div class="col-xs-4">

                                <div class="form-group input select required">

                                    <label class="control-label"> Client</label>

                                    <select name="client_id" readonly id="client" class="form-control  control-label ">
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                        <?php foreach ($clients as  $client) {
                                        ?>
                                            <option <?php if ($bonlivraison->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                                echo $client->Code . '  ' . $client->Raison_Sociale ?></option>
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
                                            <option <?php if ($bonlivraison->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
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
                                        echo $this->Form->input('plafond', array('readonly' => 'readonly', 'value' => $bonlivraison->client->plafontheorique, 'style' => 'background-color:#FFEFD4; color:#000000 ;', 'label' => 'plafond', 'id' => 'plafond', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
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

                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <?php echo $this->Form->control('exotva', ['type' => 'hidden', 'value' => '']); ?>
                            <?php echo $this->Form->control('exofodec', ['type' => 'hidden', 'value' => '']); ?>
                            <?php echo $this->Form->control('nouveau_client', ['value' => $clientc->nouveau_client, 'type' => 'hidden', 'id' => 'nouv', 'label' => '', 'class' => 'form-control ontrol-label']); ?>

                        </div>
                    </div>
                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="col-xs-6" hidden>
                                <div id="com_id">
                                    <?php echo $this->Form->control('commercial_id', ['value' => $bonlivraison->commercial_id, 'readonly' => 'readonly', 'options' => $commercials, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Commercials', 'class' => 'form-control  control-label']); ?>
                                </div>
                            </div>

                            <div class="col-xs-6" hidden>

                                <?php echo $this->Form->control('etattransport_id', ['empty' => 'Veuillez choisir !!', 'options' => $etattransports, 'required' => 'off', 'label' => 'Etat transport', 'class' => 'form-control select2 control-label']); ?>
                            </div>


                        </div>
                    </div>


                    <div class="row" hidden>
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="col-xs-6" style="margin-top: 20px ;">
                                <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>

                                OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="oui" style="margin-right: 20px" checked>
                                NON <input type="radio" name="checkpayement" value="0" id="NON" class="oui">


                            </div>


                        </div>
                    </div>

                    <?php
                    if ($bonlivraison->client_id == 12) {
                        $stylee = "display:block;";
                    } else {
                        $stylee = "display:none;";
                    }
                   /// if (/*$bonlivraison->typebl == 1 &&*/$bonlivraison->client_id == 12) {

                    ?>
                        <div class="col-xs-4" id="divnomprenom" style="<?php echo $stylee; ?>">
                            <?php echo $this->Form->control('nomprenom', ['label' => 'Nom / Prénom', 'readonly' => 'readonly', 'value' => $bonlivraison->nomprenom, 'required' => 'off', 'class' => 'form-control focus']); ?>

                        </div>
                        <div class="col-xs-4" id="divnumeroident" style="<?php echo $stylee; ?>">
                            <?php echo $this->Form->control('numeroidentite', ['label' => 'Numéro identité', 'readonly' => 'readonly', 'value' => $bonlivraison->numeroidentite, 'required' => 'off', 'class' => 'form-control focus']); ?>

                        </div>
                        <div class="col-xs-4" id="divadresseclt" style="<?php echo $stylee; ?>">
                            <?php echo $this->Form->control('adressediv', ['label' => 'Adresse', 'required' => 'off', 'readonly' => 'readonly', 'value' => $bonlivraison->adressediv, 'class' => 'form-control focus']); ?>
                        </div>
                    <?php //} ?>

                    <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px">
                    <input type="hidden" name="fodecclientexo" id="fodecclientexo" class="" style="margin-right: 20px">
                    <input type="hidden" name="timbreclientexo" id="timbreclientexo" class="" style="margin-right: 20px">
                    <input type="hidden" name="tvaclientexo" id="tvaclientexo" class="" style="margin-right: 20px">
                    <input type="hidden" name="tpeclientexo" id="tpeclientexo" class="" style="margin-right: 20px">


                    <input type="hidden" name="categclient" id="categclient" class="" style="margin-right: 20px">
                    <input type="hidden" value="<?php echo $clientc->prix ?>" name="formule" id="formule" class="" style="margin-right: 20px">


                    <!-- autorisation -->
                    <div>

                        <input type="hidden" value="<?php echo $bonlivraison->treilles ?>" name="treilles" id="treilles" class="form-control" style="margin-right: 20px">
                        <input type="hidden" value="<?php echo $bonlivraison->autorisation ?>" name="autorisation" id="autorisation" class="form-control" style="margin-right: 20px">


                    </div>

                    <br>



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
                                <!-- <div class="box-header with-border" >
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
                                                <tr style="font-size: 20px;">



                                                    <td align="center" style="width: 12%; font: size 20px;"><strong>Code</strong></td>

                                                    <td align="center" style="width: 23%; font: size 20px;"><strong>Désignation</strong></td>
                                                    <td align="center" style="width: 8%;"><strong>Qté Stock</strong></td>

                                                    <td align="center" style="width: 6%;"><strong>Qté </strong></td>
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
                                                $connection = ConnectionManager::get('default');

                                                // debug($bonlivraison->id);
                                                $famillequery = 'SELECT *  FROM sousfamille1s 
                                                    WHERE sousfamille1s.obligatoire = 1 ;';


                                                $famillesobligatoires = $connection->execute($famillequery)->fetchAll('assoc');

                                                // Initialize a variable to track if all required familles exist
                                                $allFamillesExist = 'true';

                                                foreach ($famillesobligatoires as $famille) {
                                                    $familleId = $famille['id'];

                                                    // Check if the famille exists in the articles inside lignebonlivraisons
                                                    $familleExistsQuery = 'SELECT COUNT(*) as count FROM lignebonlivraisons 
                                                    WHERE bonlivraison_id = ' . $bonlivraison->id . ' AND 
                                                          article_id IN (SELECT id FROM articles WHERE sousfamille1_id = ' . $familleId . ');';

                                                    $familleExists = $connection->execute($familleExistsQuery)->fetch('assoc');

                                                    // If the count is 0, the famille doesn't exist in lignebonlivraisons
                                                    if ($familleExists['count'] == 0) {
                                                        $allFamillesExist = 'false';
                                                        break; // No need to continue checking if one is missing
                                                    }
                                                }

                                                // debug(  $allFamillesExist);


                                                ?>

                                                <input id="exist" class='form-control' type="hidden" value="<?php echo $allFamillesExist ?>">
                                                <?php
                                                foreach ($lignebonlivraisons as $i => $res) :
                                                    $articleid =  $res->article_id;
                                                    $depotid = $bonlivraison->depot_id;
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
                                                        <td align="center">
                                                            <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden')); ?>
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
                                                                <!-- <label></label> -->
                                                                <select readonly name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" id="<?php echo 'article_id' . $i ?>" style="pointer-events:none" table="ligner" index="<?php echo $i ?>" champ="article_id" class="form-control articleidbl1 Testdep single">
                                                                    <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                    <?php foreach ($articles as $id => $article) {
                                                                    ?>
                                                                        <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code ?></option>
                                                                    <?php } ?>
                                                                </select>

                                                            </div>



                                                        </td>
                                                        <td align="center">

                                                            <div>
                                                                <!-- <label></label> -->
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
                                                            <?php echo $this->Form->input('qteStock', array('label' => '', 'value' => $stockk, 'readonly' => 'readonly', 'name' => 'data[ligner][' . $i . '][qteStock]', 'type' => 'text', 'id' => 'qteStock' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne ', 'index')); ?>
                                                        </td>

                                                        <td align="center">

                                                            <?php echo $this->Form->input('qte', array('label' => '',  'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'number', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 ', 'index')); ?>

                                                            <input type="hidden" table="ligner" name="" id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                        </td>
                                                        <td align="center" hidden>
                                                            <?php echo $this->Form->input('ml', array('label' => '', 'value' => $res->ml, 'name' => 'data[ligner][' . $i . '][ml]', 'type' => 'text', 'id' => 'ml' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 ', 'index')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('puttcapr', array('label' => '', 'value' => $res->puttcapr, 'readonly' => 'readonly', 'name' => 'data[ligner][' . $i . '][puttcapr]', 'type' => '', 'id' => 'puttcapr' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculligne2 findtth1 ttcligne')); ?>

                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('puttc', array('label' => '', 'value' => $res->puttc, 'name' => 'data[ligner][' . $i . '][puttc]', 'type' => '', 'id' => 'puttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control findtth1 ttcligne', 'index')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control findtth2 ', 'index')); ?>

                                                            <?php echo $this->Form->input('montantht', array('label' => '', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][motanttotal]', 'type' => 'hidden', 'id' => 'motanttotal' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                            <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('prix', array('label' => '', 'readonly' => 'readonly', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2', 'index')); ?>
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
                                                            <?php echo $this->Form->input('ttchidden', array('label' => '', 'readonly' => 'readonly', 'value' => $res->ttchidden, 'name' => 'data[ligner][' . $i . '][ttchidden]', 'type' => 'hidden', 'id' => 'ttchidden' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>

                                                        </td>

                                                        <td align="center">

                                                            <i index="<?php echo $i ?>" class="fa fa-times supLignearticle2" style="color: #C9302C;font-size: 22px;">
                                                        </td>

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

                                                    <td align="center" hidden>
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
                                    <?php echo $this->Form->control('total', ['id' => 'totalht', 'value' => $bonlivraison->totalht, 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('remisee', ['value' => $bonlivraison->totalremise, 'id' => 'totalremise', 'readonly' => 'readonly', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'class' => 'form-control',  'readonly' => 'readonly', 'label' => 'test remise', 'name' => 'remiseee', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalapres', ['id' => 'totalhtapres', 'value' => $bonlivraison->totalht - $bonlivraison->totalremise, 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'value' => $bonlivraison->totaltva, 'readonly' => 'readonly', 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'value' => $bonlivraison->totalfodec, 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => $bonlivraison->totalputtc, 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total puttc', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('totalttc', ['value' => $bonlivraison->totalttc - $bonlivraison->timbre->timbre, 'id' => 'ttc', 'class' => 'form-control calculinversetot', 'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'readonly' => 'readonly', 'label' => 'test ttc', 'name', 'class' => 'form-control verifttctotal calculinversetot', 'required' => 'off']); ?>
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
                                                <?php echo $this->Form->control('total', ['id' => 'totalht', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraison->total)),  'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Total Remise </strong>
                                        </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('remisee', ['id' => 'totalremise', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraison->remise)),  'class' => 'form-control', 'readonly' => 'readonly', 'label' =>false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Total TVA</strong>
                                        </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraison->tva)), 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong> Total TTC </strong> </td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalttc', ['class' => 'form-control verifttctotal calculinversetot', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraison->totalttc)),  'id' => 'ttc', 'label' => false, 'name', 'required' => 'off']); ?>
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
                                                <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraison->remise)), 'class' => 'form-control',  'readonly' => 'readonly', 'label' => 'test remise', 'name' => 'remiseee', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td>Total HT après remise</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalapres', ['id' => 'totalhtapres', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraison->total -  $bonlivraison->remise)),  'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr hidden>
                                        <td>Total Fodec</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraison->fodec)), 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td>Total PU ttc</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraison->totalputtc)),  'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total puttc', 'name', 'required' => 'off']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr hidden>
                                        <td >test ttc</td>
                                        <td>
                                            <div class="col-xs-4">
                                                <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'value' => sprintf("%01.3f", str_replace(",", ".", $bonlivraison->totalttc)),  'readonly' => 'readonly', 'label' => 'test ttc', 'name', 'class' => 'form-control verifttctotal calculinversetot', 'required' => 'off']); ?>
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
                            <?php echo $this->Form->control('observation', ['value' => $bonlivraison->observation, 'label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
                        </div>
                        <br>
                    </div>
                </section>

                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm testdepqte verifBonres " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                </div>
                <?php echo $this->Form->end(); ?>

            </div>

        </div>
    </div>

    </div>
    </div>
</section>


<script>
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
                    alert('Saisi une quantite livréé', function() {});
                    return false;
                } else if (Number(quantiteliv) > Number(quantite)) {
                    alert('La quantité livrée doit etre inferieur à  la quantité commandée !!', function() {});
                    quantiteliv = "";
                    return false;

                }

            }

        });
    });
    $(document).ready(function() {
        //Calcul();

        $("form").submit(function() {
            $('#boutonCommande').attr('disabled', 'disabled');
        })

    });




    $(function() {
        $('#boutonCommande').on('mouseover', function() {


            treilles = $('#treilles').val();
            if (treilles == 1) {
                exist = $('#exist').val();
                if (exist == 'false') {
                    alert('Sous Famille obligatoire manquante');
                    return false
                }
            }




            // autorisation = $('#autorisation').val();
            // if (autorisation == 0) {
            //     ttc = $('#ttc').val();
            //     Montant_Regler = $('#Montant_Regler').val();
            //     if (Number(ttc) - Number(Montant_Regler) != 0) {
            //         alert('Le montant reglé est different du total ttc');
            //         return false;

            //     }




            // }
        })


        $('#client').on('change', function() {
            //alert('hello');
            id = $('#client').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getremise']) ?>",
                dataType: "json",
                data: {
                    idfam: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    $('#com_id').html(data.select);
                    $('#commercial_id').select2();
                    $('#remise').val(data.ligne.remise);
                    $('#fodecclient').val(data.ligne.Fodec);



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
                    uniform_select('typeclientid');





                }

            })
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
                    //   Calcul();
                }
            })
        });
    });
</script>




<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    function openWindow(h, w, url) {
        //alert()
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
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

    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>

<script>
    $(function() {

        $(".ajouterligne").on('click', function() {

            table = $(this).attr('table'); //id table
            index = $(this).attr('index'); // id max compteur
            //alert(index);

            tr = $(this).attr('tr'); //class class type
            ind = Number($('#' + index).val()) + 1;
            //alert(ind);
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


        $('.suppiece').on('click', function() {
            ind = $(this).attr('indexreg');
            $('#sup2' + ind).val(1);
            $(this).parent().parent().hide();
            $('#btnenr').prop("disabled", false);
            // v = $('#index').val();
            var sum = 0;
            $(".sum-input").each(function() {
                if ($(this).is(":visible")) {
                    sum += Number($(this).val()) || 0;
                }
            });
            totalmnt = $("#totalmnt").val();
            $("#Montant_Regler").val(Number(sum) + Number(totalmnt));
            $("#Montant_Reglercmd").val(sum);
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
            if ($('#sup2' + i).val() != 1) {
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
<?php $this->end(); ?>