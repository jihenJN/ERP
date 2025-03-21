<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */

use Cake\ORM\TableRegistry;

?>
<?php

use Cake\Datasource\ConnectionManager;

?>
<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'css']); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->css('select2'); ?>

<?php echo $this->fetch('script'); ?>
<?php //echo $this->Html->script('calculvente'); 
?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Modifier Facture A Terme
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
                                <div class="col-xs-1" hidden>
                                    <?php echo $this->Form->control('typebl', ['label' => 'Type Bl', 'type' => 'text', 'value' => 2, 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $factureclient->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('date', ["value" => $factureclient->date, "class" => "form-control  control-label "]); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('depot_id', ['readonly' => 'readonly', 'value' => $factureclient->depot_id, 'options' => $depots, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Dépot', 'class' => 'form-control  control-label']); ?>
                                    <?php echo $this->Form->control('type', ['readonly' => 'readonly', 'type' => 'hidden', 'value' => $factureclient->type, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'type', 'class' => 'form-control  control-label']); ?>

                                </div>


                            </div>
                        </div>


                        <div class="col-xs-12">

                            <div class="col-xs-4">
                                <div class="form-group input select required">

                                    <label class="control-label" for="depot-id"> Client</label>
                                    <select name="client_id" id="client1" class="form-control clientinfo getclientdata1 select2 control-label ">
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                        <?php foreach ($clients as $id => $client) {

                                        ?>
                                            <option <?php if ($factureclient->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                                echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                        <?php } ?>
                                    </select>


                                </div>

                            </div>
                            <div class="col-xs-3" hidden>
                                <div class="form-group input select required">

                                    <!-- <label class="control-label" for="depot-id">Name Client</label>
                                    <select readonly name="client_id" id="client" class="form-control   control-label ">
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                        <?php foreach ($clients as $id => $client) {

                                        ?>
                                            <option <?php if ($factureclient->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php
                                                                                                                                                                                echo $client->Raison_Sociale ?></option>
                                        <?php } ?>
                                    </select>
 -->

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
                                        echo $this->Form->input('plafond', array('readonly' => 'readonly', 'value' => $factureclient->client->plafontheorique, 'style' => 'background-color:#FFEFD4; color:#000000 ;', 'label' => 'plafond', 'id' => 'plafond', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
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

                                <!-- </div>
                                </div> -->
                            </div>
                        </div>

                        <?php
                        if ($factureclient->client_id == 12) {
                            $stylee = "display:block;";
                        } else {
                            $stylee = "display:none;";
                        }


                        ?>
                        <div class="col-xs-4" id="divnomprenom" style="<?php echo $stylee; ?>">
                            <?php echo $this->Form->control('nomprenom', ['label' => 'Nom / Prénom', 'value' => $factureclient->nomprenom, 'required' => 'off', 'class' => 'form-control focus']); ?>

                        </div>
                        <div class="col-xs-4" id="divnumeroident" style="<?php echo $stylee; ?>">
                            <?php echo $this->Form->control('numeroidentite', ['label' => 'Numéro identité', 'value' => $factureclient->numeroidentite, 'required' => 'off', 'class' => 'form-control focus']); ?>

                        </div>
                        <div class="col-xs-4" id="divadresseclt" style="<?php echo $stylee; ?>">
                            <?php echo $this->Form->control('adressediv', ['label' => 'Adresse', 'required' => 'off', 'value' => $factureclient->adressediv, 'class' => 'form-control focus']); ?>
                        </div>










                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">




                            <div class="row">







                                <?php echo $this->Form->control('exotva', ['type' => 'hidden', 'value' => '']); ?>
                                <?php echo $this->Form->control('exofodec', ['type' => 'hidden', 'value' => '']); ?>

                                <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px" value="<?php echo $factureclient->client->Fodec ?>">







                            </div>



                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; " hidden>


                                <div class="row">


                                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                        <div class="col-xs-6" style="margin-top: 20px ;">
                                            <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>

                                            OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="calcheck" style="margin-right: 20px" <?php if ($factureclient->payementcomptant == 1) { ?> checked="checked" <?php } ?>>
                                            NON <input type="radio" name="checkpayement" value="0" id="NON" class="calcheck" <?php if ($factureclient->payementcomptant == 0) { ?> checked="checked" <?php } ?>>


                                        </div>
                                    </div>
                                </div>
                            </div>






                            <br>

                            <input value="<?php echo $exofodec ?>" type="hidden" name="fodecclientexo" id="fodecclientexo" class="" style="margin-right: 20px">
                            <input type="hidden" name="timbreclientexo" id="timbreclientexo" class="" style="margin-right: 20px">
                            <input value="<?php echo $exotva ?>" type="hidden" name="tvaclientexo" id="tvaclientexo" class="" style="margin-right: 20px">
                            <input value="<?php echo $exotpe ?>" type="hidden" name="tpeclientexo" id="tpeclientexo" class="" style="margin-right: 20px">









                        </div>



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
                                                        <td align="center" style="width: 12%;"><strong>Code</strong> </td>
                                                        <td align="center" style="width: 23%;"><strong>Désignation</strong></td>
                                                        <td align="center" style="width: 8%;"><strong> Stock</strong></td>

                                                        <td align="center" style="width: 6%;"><strong>Qte </strong></td>
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
                                                        <td hidden align="center" style="width: 8%;"><strong> TTC test</strong>
                                                        </td>
                                                        <td hidden align="center" style="width: 2%;"><strong></strong></td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($lignefactureclient as $i => $res) :
                                                        $articleid = $res->article_id;




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

                                                        $readonly = '';
                                                        // if ($sousfam->remiseobligatoire == 0) {
                                                        //     $readonly = 'readonly';
                                                        // }


                                                        date_default_timezone_set('Africa/Tunis');
                                                        $date = date("Y-m-d H:i:s");
                                                        $connection = ConnectionManager::get('default');
                                                        $articleid = $res->article_id;
                                                        $depotid = $factureclient->depot_id;

                                                        $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                        $stock = $inventaires[0]['v'];
                                                        $bc = $connection->execute("select stockbassemseuil(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as q")->fetchAll('assoc');

                                                    ?>
                                                        <tr style="font-size: 18px;font-weight: bold;">
                                                            <td champ="tdcode">
                                                                <input table="ligner" index="<?php echo $i ?>" class="getdesignation articleidbl1" id="article_idcode<?php echo $i ?>" champ="article_idcode"
                                                                    type="text" list="codearticle_id<?php echo $i ?>"
                                                                    value="<?php echo htmlspecialchars($res->article->Code, ENT_QUOTES, 'UTF-8'); ?>" readonly>
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
                                                                    value="<?php echo htmlspecialchars($res->article->Dsignation, ENT_QUOTES, 'UTF-8'); ?>" readonly>
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
                                                                <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>
                                                                <?php
                                                                echo $this->Form->control('qtestock', ['readonly' => 'readonly', 'value' => $stock, 'name' => 'data[ligner][' . $i . '][qteStock]', 'empty' => true, 'label' => false, 'table' => 'ligner', 'champ' => 'qteStock', 'class' => 'form-control select   ', 'index']);

                                                                ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('article_idd', array('label' => '', 'readonly' => 'readonly', 'value' => $res->article_id, 'name' => 'data[ligner][' . $i . '][article_idd]', 'type' => 'hidden', 'id' => 'article_idd' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 focus', 'index')); ?>

                                                                <?php echo $this->Form->input('qte', array('readonly' => 'readonly', 'label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 focus ', 'index')); ?>
                                                                <input type="hidden" value='<?php echo $res->article->Poids ?>' table="ligner" name="" id="<?php echo 'poids' . $i ?>" champ="poids" class="calcullignecommande form-control" index="<?php echo $i ?>">

                                                                <input type="hidden" table="ligner" name="" id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                                <input type="hidden" table="ligner" name="" id="<?php echo 'escompte' . $i ?>" champ="escompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                            </td>
                                                            <td align="center" hidden>
                                                                <?php echo $this->Form->input('ml', array('label' => '', 'value' => $res->ml, 'name' => 'data[ligner][' . $i . '][ml]', 'type' => 'text', 'id' => 'ml' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne2 ', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('puttcapr', array('label' => '', 'value' => $res->puttcapr, 'readonly' => 'readonly', 'name' => 'data[ligner][' . $i . '][puttcapr]', 'type' => '', 'id' => 'puttcapr' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  calculligne2 findtth1 ttcligne')); ?>

                                                            </td>
                                                            <td align="center">
                                                                <?php //echo $this->Form->input('puttc', array('label' => '', 'value' => $res->puttc, 'name' => 'data[ligner][' . $i . '][puttc]', 'type' => '', 'id' => 'puttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control findtth verifttc  ajoutligneeettc', 'index')); 
                                                                ?>
                                                                <?php echo $this->Form->input('puttc', array('readonly' => 'readonly', 'label' => '', 'value' => $res->puttc, 'name' => 'data[ligner][' . $i . '][puttc]', 'type' => '', 'id' => 'puttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  findtth1', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('escompte', array('label' => '', 'value' => '', 'name' => 'data[ligner][' . $i . '][escompte]', 'type' => 'hidden', 'id' => 'escompte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                                <?php echo $this->Form->input('remise', array('readonly' => 'readonly', 'label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ajoutligneeettc2  findtth2', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('prix', array('label' => '', 'readonly' => 'readonly', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne', 'index')); ?>
                                                            </td>
                                                            <td align="center">
                                                                <?php echo $this->Form->input('ht', array('readonly', 'label' => '', 'value' => $res->prixht, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                            </td>

                                                            <td align="center">

                                                                <?php echo $this->Form->control('monatantlignetva', ['value' => $res->totaltva, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => 'monatantlignetva' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][monatantlignetva]', 'required' => 'off']); ?>


                                                                <?php echo $this->Form->input('tva', array('value' => $res->tva, 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculm', 'index')); ?>
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
                                                                <?php echo $this->Form->input('ttc', array('label' => '', 'readonly' => 'readonly', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control verifttc  ', 'index')); ?>
                                                                <?php echo $this->Form->input('ttchidden', array('label' => '', 'readonly' => 'readonly', 'value' => $res->ttchidden, 'name' => 'data[ligner][' . $i . '][ttchidden]', 'type' => 'hidden', 'id' => 'ttchidden' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  ')); ?>

                                                            </td>
                                                            <td align="center" hidden>
                                                                <?php echo $this->Form->input('ttctest', array('readonly', 'label' => '', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttctest]', 'type' => '', 'id' => 'ttctest' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control verifttc ', 'index')); ?>

                                                            </td>
                                                            <td align="center" hidden>

                                                                <i index="<?php echo $i ?>" class="fa fa-times supLignearticle2" style="color: #C9302C;font-size: 22px;">
                                                            </td>

                                                            </td>





                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tr>

                                                    <tr class="tr" style="display: none ;font-size: 18px;font-weight: bold;">
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

                                                            <input type="number" table="ligner" name="" id="" champ="qteStock" type="text" class="  form-control" readonly index>
                                                        </td>


                                                        <td align="center" table="ligner">
                                                            <input type="hidden" table="ligner" name="" readonly champ="article_idd" class="  form-control" index>

                                                            <input type="number" table="ligner" name="" id="" champ="qte" type="text" class=" calculligne2 form-control focus" index>
                                                        </td>

                                                        <td hidden align="center" table="ligner">
                                                            <input table="ligner" champ="ml" type="text" class="form-control calculligne" index>
                                                        </td>
                                                        <td>
                                                            <input table="ligner" readonly type="text" name="" champ="puttcapr" class="form-control    calculligne2   findtth1  ttcligne" index>

                                                        </td>
                                                        <td>
                                                            <input table="ligner" type="text" name="" champ="puttc" class="form-control findtth1" index>

                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" champ="remise" class="form-control ajoutligneeettc2  findtth2" index name=''>
                                                            <input table="ligner" type="hidden" name="" champ="motanttotal" id='' class="form-control " index>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" readonly champ="prix" class="form-control calculligne2" index name=''>
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
                                                            <input readonly table="ligner" type="text" name="" champ="ttc" class="form-control verifttc " index>
                                                            <input table="ligner" type="text" name="" readonly champ="ttchidden" class="form-control" index>

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
                                        <?php echo $this->Form->control('totalht', ['id' => 'totalht', 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'class' => 'form-control', 'value' => $factureclient->totalremise, 'readonly' => 'readonly', 'label' => 'test remise', 'name' => 'remiseee', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalapres', ['class' => 'form-control', 'value' => $factureclient->totalht - $factureclient->totalremise, 'id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalhtapres', ['id' => 'totalhtapres', 'value' => $factureclient->totalht - $factureclient->totalremise, 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totaltva', ['id' => 'totaltva', 'readonly' => 'readonly', 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalfodec', ['id' => 'totalfodec', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => $factureclient->totalputtc, 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total puttc', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('timbre', ['type' => 'hidden', 'id' => 'timbre', 'name' => 'timbre', 'value' => $factureclient->timbre_id]);

                                        echo $this->Form->control('timbre_id', ['options' => $tim, 'name' => 'timbre_id', 'id' => 'timbre_id', 'class' => 'form-control', 'readonly' => true,  'label' => 'Timbre']); ?>

                                    </div>
                                    
                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('totalttc', ['value' => sprintf("%01.3f", $factureclient->totalttc), 'readonly', 'id' => 'ttc', 'class' => 'form-control  tot',  'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-4" hidden>
                                        <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'value' => sprintf("%01.3f", $factureclient->totalttc), 'readonly' => 'readonly', 'label' => 'test ttc', 'name', 'class' => 'form-control verifttctotal tot', 'required' => 'off']); ?>
                                    </div>
                                    <br>
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
                                                    <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'readonly' => 'readonly', 'value' => $factureclient->totalttc, 'label' => false, 'name', 'class' => 'form-control  calculinversetot', 'required' => 'off']); ?>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>

                                            <td> <strong> Timbre </strong> </td>
                                            <td>
                                                <div class="col-xs-4">
                                                    <?php echo $this->Form->control('timbre', ['type' => 'hidden', 'id' => 'timbre', 'name' => 'timbre', 'value' => $factureclient->timbre_id]);

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
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'readonly' => 'readonly', 'class' => 'form-control', 'value' => $factureclient->observation, 'type' => 'textarea']);
                                ?>

                            </div><br>
                            <!-- <br>
                            <div class="col-xs-6">
                                <textarea id="editor-container1" name="observation" class="form-control summernote" rows="100" cols="100" style="height: 900px;">
                                          <?php echo h($factureclient->observation); ?>
                                    </textarea>
                            </div>
                            <br> -->
                        </div>
                    </section>





                    <section class="content" style="width: 99%" hidden>
                        <div class="row">
                            <h3> Réglement Facture N° <?php echo $factureclient->numero ?></h3>
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




                        <br>
                        <div class="row">
                            <div class="box box-primary">

                                <table style="width:30%;color:green" class="table table-bordered table-striped table-bottomless pull-right">
                                    <tbody>
                                        <tr>
                                            <?php $totaltotal = $totalmntcmd + $totalmnt;
                                            $reste = $factureclient->totalttc - $totaltotal; ?>
                                            <td width="67%"><strong>Net à payer</strong></td>
                                            <td><strong><?php echo sprintf("%01.3f", $factureclient->totalttc); ?></strong></td>
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


                    <div align="center">
                        <!-- <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff" id="boutonlivraison" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button> -->
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 20px; margin-top: 20px; margin-bottom: 20px;">
                            <button type="submit" class=" testdiv btn btn-success btn-sm verifBonres btnOffreprix" id="boutonlivraison" name="enregistrer" style="width: 130px;">
                                Enregistrer
                            </button>
                            <button type="submit" class="testdiv btn btn-primary btn-sm verifBonres btnOffreprix" id="boutonpdf" name="pdf" style="width: 70px;">
                                <i class="fa fa-print"></i> PDF
                            </button>
                            <button type="submit" class="testdiv btn btn-xs btn-primary custom-class" id="boutonimprimer" name="enregistrer_imprimer" style="background-color: #bb3385; color: white; border-color: white; width: 40px;">
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

        $(".testdiv").on("mouseover", function() {
            var client = $("#client1").val();
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
        $('.clientinfo').on('change', function() {
            // alert('hello');
            id = $('#client1').val();
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
        $('.articleidbl1des').on('change', function() {
            // alert("hh");
            index = $(this).attr('index');
            //  alert(index);
            article_id = $('#article_iddes' + index).val(); //alert(article_id);
            //alert(article_id);
            datecreation = $('#date').val();
            idClient = $('#client1').val();
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
            idClient = $('#client1').val();
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
        $(".getclientdata").on("change", function() {
            var client_id = $("#client1").val();

            // var typebl = $("#typebl").val();


            if (client_id == 12 /* && typebl == 1*/ ) {

                $('#divnomprenom').attr('style', 'display:block;');
                $('#divnumeroident').attr('style', 'display:block;');
                $('#divadresseclt').attr('style', 'display:block;');
            } else if (client_id != 12) {

                $('#divnomprenom').attr('style', 'display:none;');
                $('#divnumeroident').attr('style', 'display:none;');
                $('#divadresseclt').attr('style', 'display:none;');
                $('#divnomprenom').val('');
                $('#divnumeroident').val('');
                $('#divadresseclt').val('');
            }




            $('#blocclient').hide();
            /// alert(client_id);
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
                        //// alert(data.donne);
                        $('#blocclient').show();

                        $('#echanciere').val((data.echanciere).toFixed(3));
                        $('#echancierebl').val((data.echancierebl).toFixed(3));

                        $('#solde').val((data.solde).toFixed(3));
                        $('#plafond').val(data.donne.plafontheorique);

                        $('#encours').val((data.encours).toFixed(3));
                        $('#article_idcode0').focus();

                    },
                });
            }
        });
        $(".getclientdata1").on("change", function() {
            var client_id = $("#client1").val();

            if (client_id == 12 /* && typebl == 1*/ ) {

                $('#divnomprenom').attr('style', 'display:block;');
                $('#divnumeroident').attr('style', 'display:block;');
                $('#divadresseclt').attr('style', 'display:block;');
            } else if (client_id != 12) {

                $('#divnomprenom').attr('style', 'display:none;');
                $('#divnumeroident').attr('style', 'display:none;');
                $('#divadresseclt').attr('style', 'display:none;');
                $('#divnomprenom').val('');
                $('#divnumeroident').val('');
                $('#divadresseclt').val('');
            }

            $('#blocclient').hide();
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
                        // $('#nomprenom').focus();

                        // }
                    },
                });
            }
        });
    });
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

        //  Calculfacture();
    })
    $(function() {

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
        $('.calcheck').on('click', function() {

            calculbccheck();

        })
        $('.pourcentescompte').on('keyup', function() {
            //alert('hh');
            index = $(this).attr('index');
            i = $(this).attr('index');
            // alert(index);
            qte = $('#qte' + index).val();
            //alert(article_id);

            //alert(depot_id);
            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
                dataType: "JSON",
                data: {
                    qte: qte,

                },
                success: function(response) {
                    //  alert(response.tab[0]['qtemax']);
                    numbers = response.tab;



                    //    alert(response['ligne']["Code"]);
                    //   qtestockx = response['qtestockx'];
                    //alert('hh');

                    //   $('#pourcentageescompte' + index).val(response['remise']);

                    /// $('#qteStock' + index).val(qtestockx);
                    //$('#prix' + index).val(response['ligne']["Prix_LastInput"]);
                    // $('#ttc' + index).val(response['ligne']["PTTC"]);
                    //   //$('#exofodec').val(response['ligne']["FODEC"]);
                    // $('#prixht' + index).val(response['ligne']["PHT"]);

                    // $('#tva' + index).val(response['ligne']["tva"]["valeur"]);
                    //$('#tpe' + index).val(response['ligne']["TXTPE"]);
                    // $('#fodec' + index).val(response['ligne']["fodec"]);
                    // $('#remisearticle' + index).val(response['ligne']["remise"]);

                    // pourcentageescompte = $('#pourcentageescompte' + i).val(); //alert(pourcentageescompte);
                    tpe = $('#tpe' + i).val();
                    tva = Number($('#tva' + i).val()); // alert(tva);
                    fodec = $('#fodec' + i).val(); //alert(tpe);        
                    fodecclientexo = $('#fodecclientexo').val();
                    tpeclientexo = $('#tpeclientexo').val();
                    tvaclientexo = $('#tvaclientexo').val();
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
                    //-------------------------------


                    qteStock = ($('#qteStock' + i).val()) * 1; //alert(qteStock);
                    qte = ($('#qte' + i).val()) * 1; //alert(qte);
                    prix = $('#prix' + i).val(); //alert(prix);
                    remisearticle = $('#remisearticle' + i).val() || 0; //alert(remisearticle);
                    remiseclient = $('#remiseclient' + i).val() || 0;




                    /* if (qte > qteStock) {*/
                    // alert("veuillez enter quantit? inf?rieur a la qunatit? de stock !!");
                    //   $('#qte' + i).val(0);

                    //    }
                    //  else {

                    netbrut = (Number(qte) * Number(prix)); //alert(netbrut);

                    totalremise = Number(remisearticle) + Number(remiseclient);
                    remisefinale = netbrut.toFixed(3) * totalremise / 100; //alert(remisefinale);
                    motanttotal = netbrut - remisefinale; //alert(netht);
                    //   ttc = motanttotal * 1.19 / qte;

                    $('#motanttotal' + i).val(Number(motanttotal).toFixed(3)); // alert(motanttotal);





                    //  }

                    // if ($('#OUI').is(':checked')) {
                    // alert("dhh");
                    //fodec = Number($('#OUI').val());

                    // remisepayementmontant = motanttotal * pourcentageescompte / 100; // alert("hh");
                    //motanttotal = motanttotal - remisepayementmontant;
                    //alert(netht);
                    // alert(remisepayementmontant);
                    // $('#escompte' + i).val(Number(remisepayementmontant).toFixed(2)); //alert(remisepayementmontant)



                    //  } else {
                    // $('#escompte' + i).val('');
                    // }
                    $('#comptant').val(Number(motanttotal).toFixed(3));
                    ttc = motanttotal * (1 + tva) / qte;
                    $('#ttc' + i).val(Number(ttc).toFixed(3));



                    // alert(fodecclientexo);

                    if (fodec != 0 && fodecclientexo == '') {
                        //   alert("cc");
                        montantfodec = motanttotal * fodec / 100;
                        fodeccommandeclient += montantfodec;

                        motanttotal += montantfodec; //alert(motanttotal);
                    }
                    $('#fodeccommande').val(Number(motanttotal).toFixed(3));
                    $('#fodeccommandeclient' + i).val(Number(fodeccommandeclient).toFixed(3));
                    // alert($('#fodeccommandeclient' + i).val());





                    if (tpe != 0 && tpeclientexo == '') {
                        montanttpe = motanttotal * tpe / 100; //alert(montanttpe);
                        motanttotal += montanttpe;
                        tpecommandeclient += montanttpe; //alert(tpecommandeclient);

                    }



                    $('#tpecommandeclient' + i).val(Number(tpecommandeclient).toFixed(3));
                    // alert($('#tpecommandeclient' + i).val());




                    //   alert("tva recup?r? avant if");
                    // alert(tva);
                    if (tva != 0 && tvaclientexo == '') {
                        //   alert("hh");
                        // alert("tva recup?r? apr?s if");
                        // alert(netht);
                        montanttva = motanttotal * tva / 100; //alert(montanttva);
                        totalttc = motanttotal + montanttva;

                    } else {
                        totalttc = motanttotal;
                    }

                    $('#remiseligne' + i).val(Number(remisefinale).toFixed(3));



                    $('#monatantlignetva' + i).val(Number(montanttva).toFixed(3));


                    //  alert($('#monatantlignetva' + i).val());

                    $('#totalttc' + i).val(Number(totalttc).toFixed(2));



                    escompte = 0;

                    index = $('#index').val();
                    for (j = 0; j <= index; j++) {
                        // alert(j);
                        sup = $('#sup' + j).val(); // alert(sup);



                        if (Number(sup) != 1) {
                            total += Number($('#motanttotal' + j).val());
                            //  alert(total);
                            remisecommande += Number($('#remiseligne' + j).val());
                            // alert(totalCommandettc);

                            totalCommandettc += Number($('#totalttc' + j).val()); //alert($('#totalttc' + j).val());
                            fod += Number($('#fodeccommandeclient' + j).val()); // alert(fod);
                            tpecmd += Number($('#tpecommandeclient' + j).val());
                            tvacomd += Number($('#monatantlignetva' + j).val()); // alert(tvacomd);



                            //   escompte += Number($('#escompte' + j).val());


                            //$('#ttc' + i).val(Number(ttc));
                        }
                    }
                    montantescompte = 0


                    maxpourcentage = response.tab[numbers.length - 1]['pourcentage'];
                    maxqte = response.tab[numbers.length - 1]['qtemax'];


                    // m = numbers[numbers.length - 1]['pourcentage'];

                    if ($('#OUI').is(':checked')) {
                        numbers.forEach(myFunction);

                        function myFunction(item) {
                            //  alert(total);
                            //  alert('kk');
                            if (total >= item['qtemin'] && total <= item['qtemax']) {
                                // alert(item['pourcentage']);

                                montantescompte = total * Number(item['pourcentage']) / 100;

                                $('#valeurescompte').val(item['pourcentage']);
                            } else if (total > maxqte) {
                                //alert('hh');
                                montantescompte = total * Number(maxpourcentage) / 100;
                                $('#valeurescompte').val(maxpourcentage);
                            }
                        }
                    }
                    //alert(total);
                    $('#escompte').val(Number(montantescompte).toFixed(3));


                    //mahdi------------------------------------
                    brutHT = total + remisecommande;
                    baseHT = total + fod;

                    $('#netapayer').val(Number(totalCommandettc).toFixed(3));
                    $('#baseHT').val(Number(baseHT).toFixed(3));
                    $('#brutHT').val(Number(brutHT).toFixed(3));


                    //-----------------------------------------

                    $('#totalremise').val(Number(remisecommande).toFixed(3));
                    $('#total').val(Number(total).toFixed(3));
                    $('#totalttccommande').val(Number(totalCommandettc).toFixed(3));
                    $('#fod').val(Number(fod).toFixed(3));
                    $('#tpecommande').val(Number(tpecmd).toFixed(3));
                    $('#tvacommande').val(Number(tvacomd).toFixed(3));

                }
            })
        });
    });

    function calculbccheck() { //alert(index+'index')
        //alert('calculbc')
        ind = Number($('#index').val()); //alert(ind+'ind')
        i = ind;

        test = 0;




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
        formule = $('#formule').val();
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
                    //   getescompte(total);
                    valeurescompte = $('#valeurescompte').val(); //alert(valeurescompte+"valeurescompte");
                    montantescompte = total * Number(valeurescompte) / 100; //alert(montantescompte);
                    //  $('#valeurescompte').val(montantescompte);
                    //  alert(montantescompte+"esc");
                    //  $('#escompte').val(Number(montantescompte).toFixed(3));
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
                    // $('#escompte').val(Number(montantescompte).toFixed(3));
                    montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100;
                    totalmontantescompteligne += Number(montantescompteligne);
                    montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                    totalmontantescomptelignee += Number(montantescomptelignee);
                    montantescompte += Number(montantescompteligne);
                    $('#escompte' + j).val(Number(montantescomptelignee).toFixed(3));
                }
                //  alert(valeurescompte+"valeurescompte");
                //  prixavecformulclient(prix, j, formule, fodec, tva, tpe, valeurescompte, remiseclient, remisearticle)
                if (tpe != 0 && tpeclientexo == '') {
                    // alert(montantescomptelignee);
                    montanttpe = montantescomptelignee * tpe / 100; //alert(montanttpe);
                    motanttotaltpe += montanttpe;
                    $('#tpecommandeclient' + j).val(Number(montanttpe));
                    //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                    //                            totaltpecommandeclient += Number(tpecommandeclient);

                } else {
                    montanttpe = 0 //alert(montanttpe);
                    motanttotaltpe += montanttpe;
                    $('#tpecommandeclient' + j).val(Number(montanttpe));
                    //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                    //                            totaltpecommandeclient += Number(tpecommandeclient);
                }
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

                    tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                    totaltpecommandeclient += Number(tpecommandeclient);

                } else {

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
            // getescompte(total);
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
        //
        //
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





        //            }
        //        })
    }
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
    function openWindow(h, w, url) {
        //alert()
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php $this->end(); ?>