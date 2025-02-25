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
<?php echo $this->Html->script('salma'); ?>

<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('calculvente'); ?>



<?php echo $this->fetch('script'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ajout offre de prix
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/2']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
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
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $mm, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>

                                <div class="col-xs-2">

                                    <?php echo $this->Form->control('choixdate', ['id' => 'choixdate', 'options' => $dates, 'empty' => 'Veuillez choisir !!', 'label' => 'Choix date', 'class' => 'form-control select2 control-label']); ?>
                                </div>
                                <div class="col-xs-2" style="display:none ;" id="dateimp">
                                    <?php echo $this->Form->control('date', ['id' => 'dateimp', 'name' => 'dateimp', 'label' => 'Date']); ?>
                                </div>

                                <div class="col-xs-2" style="display:none ;" id="datedeb">
                                    <?php echo $this->Form->control('date', ['id' => 'dateintdebut', 'name' => 'dateintdebut', 'label' => 'Date debut']); ?>
                                </div>


                                <div class="col-xs-2" style="display:none;" id="datef">
                                    <?php echo $this->Form->control('date', ['id' => 'dateintfin', 'name' => 'dateintfin', 'label' => 'Date fin']); ?>
                                </div>

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('client_id', ['value' => $bonlivraison->client_id, 'id' => 'client', 'options' => $clients, 'empty' => 'Veuillez choisir !!', 'label' => 'Clients', 'class' => 'form-control select2 control-label']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <div id="com_id">
                                        <?php echo $this->Form->control('commercial_id', ['value' => $bonlivraison->commercial_id, 'options' => $commercials, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Commercials', 'class' => 'form-control select2 control-label']); ?>
                                    </div>
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
                                <div class="col-xs-6">

                                    <?php echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>
                                </div>
                                <div class="col-xs-6">

                                    <?php echo $this->Form->control('depot_id', ['options' => $depots, 'required' => 'off', 'label' => 'Depots', 'class' => 'form-control select2 control-label']); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="col-xs-6">
                            <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6" style="margin-top: 20px ;">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>
                                    OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="oui" style="margin-right: 20px" checked>
                                    NON <input type="radio" name="checkpayement" value="0" id="NON" class="oui">
                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px">
                        <input type="hidden" name="fodecclientexo" id="fodecclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="timbreclientexo" id="timbreclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="tvaclientexo" id="tvaclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="tpeclientexo" id="tpeclientexo" class="" style="margin-right: 20px">


                        <input type="hidden" name="categclient" id="categclient" class="" style="margin-right: 20px">
                        <input type="hidden" value="<?php echo $clientc->prix ?>" name="formule" id="formule" class="" style="margin-right: 20px">
                    </div>
                    <br>
                    <br>

                    <div class="col-md-12" id="blocclient" style="display: true;">
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
                                        <?php if ($clientc->typeclient->grandsurface == false) {
                                            if ($not != 0) { ?>
                                                <a onClick="openWindow(1000, 1000, 'http://codifaerp.isofterp.com/demo/promoarticles/notgrandsurface/<?php echo $not ?>');"><?php echo $clientc->typeclient->type ?></a>
                                            <?php } ?>
                                            <?php if ($not == 0) { ?>
                                                <div> aucun promo </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($clientc->typeclient->grandsurface == true) {
                                            if ($gs != 0) { ?>
                                                <a onClick="openWindow(1000, 1000, 'http://codifaerp.isofterp.com/demo/gspromoarticles/grandsurface/<?php echo $gs ?>');"><?php echo $clientc->typeclient->type ?></a>
                                            <?php } ?>
                                            <?php if ($gs == 0) { ?>
                                                <div> aucun promo </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-xs-3" style="display: flex;margin-top: 30px;">
                                    <div id="BL">
                                        <label style="margin-right: 20px">BL:</label>


                                        OUI <input type="radio" name="bl" id="OUI" style="margin-right: 20px" value="1">
                                        NON <input type="radio" name="bl" id="NON" checked="checked" value="0">
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
                                                <tr>
                                                    <td align="center" style="width: 30%; font: size 20px;"><strong>Article</strong></td>
                                                    <td align="center" style="width: 6%;"><strong>Qte </strong></td>
                                                    <td align="center" style="width: 6%;"><strong>ml </strong></td>
                                                    <td align="center" style="width: 6%;"><strong>P.U.H.T</strong></td>
                                                    <td align="center" style="width: 8%;"><strong>Total HT</strong></td>
                                                    <td align="center" style="width: 4%;"><strong>Remise</strong></td>
                                                    <td align="center" style="width: 4%;"><strong> TVA </strong></td>
                                                    <td align="center" style="width: 4%; font: size 5px;"><strong style="font: size 5px;">Fodec</strong></td>
                                                    <td align="center" style="width: 8%;"><strong>Total TTC</strong></td>
                                                    <td align="center" style="width: 2%;"><strong></strong></td>

                                                </tr>
                                            </thead>
                                            <tbody>

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
                                                    $sousfam =[];
                                                    $art =[];
                                                    if ($res->article_id!=null){
                                                        $art = $artTable->find()
                                                        ->where(['id' => $res->article_id])
                                                        ->first();
                                                        if ($art->sousfamille1_id!=null){
                                                    $sousfam = $sousfamilleTable->find()
                                                        ->where(['id' => $art->sousfamille1_id])
                                                        ->first();
                                                        }
                                                    }

                                                    $readonly='';
                                                    if  ($sousfam->remiseobligatoire==0){
                                                        $readonly='readonly';
                                                    }
                                                ?>
                                                    <tr>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                            <?php
                                                            echo $this->Form->input('id', array(
                                                                'champ' => 'id', 'label' => '', 'name' => 'data[ligner][' . $i . '][id]',
                                                                'value' => $res->id,
                                                                'type' => 'hidden', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group',
                                                                'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'
                                                            ));
                                                            ?>
                                                            <div>
                                                                <label></label>
                                                                <select readonly name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" id="<?php echo 'article_id' . $i ?>" style="pointer-events:none" table="ligner" index="<?php echo $i ?>" champ="article_id" class="form-control articleidbl1 Testdep single">
                                                                    <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                    <?php foreach ($articles as $id => $article) {
                                                                    ?>
                                                                        <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                    <?php } ?>
                                                                </select>

                                                            </div>



                                                        </td>

                                                        <td align="center">

                                                            <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'number', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne ', 'index')); ?>

                                                            <input type="hidden" table="ligner" name="" id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('ml', array('label' => '', 'value' => $res->ml, 'name' => 'data[ligner][' . $i . '][ml]', 'type' => 'text', 'id' => 'ml' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne ', 'index')); ?>
                                                        </td>

                                                        <td align="center">
                                                            <?php echo $this->Form->input('prix', array('label' => '', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne', 'index', 'readonly')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('ht', array('readonly', 'label' => '', 'value' => $res->prixht, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('remise', array('readonly'=>$readonly,'label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculligne', 'index')); ?>

                                                            <?php echo $this->Form->input('montantht', array('label' => '', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][motanttotal]', 'type' => 'hidden', 'id' => 'motanttotal' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                            <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->control('monatantlignetva', ['value' => $res->totaltva, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => 'monatantlignetva' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][monatantlignetva]', 'required' => 'off']); ?>
                                                            <?php echo $this->Form->input('tva', array('value' => $res->tva, 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->control('fodeccommandeclient', ['value' => $res->fodec, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][fodeccommandeclient]', 'required' => 'off']); ?>
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

                                                        <td align="center">
                                                            <br>
                                                            <i index="<?php echo $i ?>" class="fa fa-times supLignearticle" style="color: #C9302C;font-size: 22px;">
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
                </div>

                <section class="content" style="width: 99%">
                    <div class="row" id="sec">
                        <div class="row">
                            <div style=" position: static;">
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('total', ['id' => 'totalht', 'value' => $bonlivraison->totalht, 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('remisee', ['value' => $bonlivraison->totalremise, 'id' => 'totalremise', 'readonly' => 'readonly', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                </div>

                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('totalapres', ['id' => 'totalhtapres', 'value' => $bonlivraison->totalht - $bonlivraison->totalremise, 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'value' => $bonlivraison->totaltva, 'readonly' => 'readonly', 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'value' => $bonlivraison->totalfodec, 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('totalttc', ['value' => $bonlivraison->totalttc, 'id' => 'ttc', 'readonly' => 'readonly', 'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4 ">
                                    <?php echo $this->Form->control('Montant_Regler', ['type' => 'hidden', 'value' => 0, 'id' => 'Montant_Regler', 'readonly' => 'readonly', 'label' => 'Montant_Regler', 'name' => 'Montant_Regler', 'required' => 'off']); ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>



                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Acompte'); ?></h1>
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
                                                                    <option value="<?php echo $id; ?>"><?php echo  $paiement ?></option>
                                                                <?php } ?>
                                                            </select>

                                                            <?php echo $this->Form->input('sup2', array('name' => '', 'id' => '', 'champ' => 'sup2', 'table' => 'pieceregelemnt', 'index' => '', 'type' => 'hidden', 'class' => 'form', 'label' => '')); ?>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbruta" table="piece" style="display:none" class="modecheque">Montant brut</td>
                                                        <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbrutb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                                echo $this->Form->input('montant_brut', array('class' => 'form-control montantbrut', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantbrut', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant_brut]'));
                                                                                                                                                                                                ?> </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Montant</td> <!-- mnt bl -->
                                                        <td><?php
                                                            echo $this->Form->input('montant', array('class' => 'form-control sum-input differance', 'label' => '', 'index' => 0, 'champ' => 'montant', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant]'));
                                                            ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxa" table="piece" style="display:none" class="modecheque">Taux</td>
                                                        <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                echo $this->Form->input('valeur_id', array('class' => ' form-control tauxx', 'label' => '', 'index' => 0, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][taux]', 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantneta" table="piece" style="display:none" class="modecheque">Montant Net </td>
                                                        <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantnetb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                            echo $this->Form->input('montant_net', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant_net]'));
                                                                                                                                                                                            ?> </td>
                                                    </tr>

                                                    <tr>
                                                        <td name="data[piece][0][trechance]" id="" index="0" champ="trechancea" table="piece" style="display:none" class="modecheque">Echéance </td>
                                                        <td name="data[piece][0][trechance]" id="" index="0" champ="trechanceb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                        echo $this->Form->input('echance', array('class' => 'form-control ', 'label' => '', 'type' => 'date', 'value' => '99/99/9999', 'index' => 0, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][echance]'));
                                                                                                                                                                                        ?> </td>
                                                    </tr>

                                                    <tr>
                                                        <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanquea" table="piece" style="display:none" class="modecheque">Banque </td>
                                                        <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanqueb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                                    echo  $this->Form->input('banque_id', array('class' => 'form-control ', 'empty' => 'veuillez choisir', 'label' => '', 'index' => 0, 'champ' => 'banque', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][banque]'));
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
                                                                <div class='col-sm-12'><?php echo $this->Form->input('num_piece', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][num_piece]')); ?></div>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                    <tr>
                                                        <td name="data[piece][0][trporteur]" id="" index="0" champ="trporteura" table="piece" style="display:none" class="modecheque">Porteur chèque </td>
                                                        <td name="data[piece][0][trporteur]" id="" index="0" champ="trporteurb" table="piece" style="display:none" class="modecheque">
                                                            <div class='form-group' id="" index="0" champ="divportc" table="piece" style="display:none">
                                                                <label class='col-md-2 control-label'></label>
                                                                <div class='col-sm-10' name="data[piece][0][trporteur]" id="" index="0" champ="trporteurc" table="piece" class="modecheque"> </div>
                                                            </div>
                                                            <div class='form-group' id="" index="0" champ="divportp" table="piece" style="display:none">
                                                                <div class='col-sm-12'><?php echo $this->Form->input('porteurcheque', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'porteurcheque', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][porteurcheque]')); ?></div>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                    <tr>
                                                        <td name="data[piece][0][trrib]" id="" index="0" champ="trriba" table="piece" style="display:none" class="modecheque">RIB </td>
                                                        <td name="data[piece][0][trrib]" id="" index="0" champ="trribb" table="piece" style="display:none" class="modecheque">
                                                            <div class='form-group' id="" index="0" champ="divribc" table="piece" style="display:none">
                                                                <label class='col-md-2 control-label'></label>
                                                                <div class='col-sm-10' name="data[piece][0][trrib]" id="" index="0" champ="trribc" table="piece" class="modecheque"> </div>
                                                            </div>
                                                            <div class='form-group' id="" index="0" champ="divribp" table="piece" style="display:none">
                                                                <div class='col-sm-12'><?php echo $this->Form->input('rib', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'rib', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][rib]')); ?></div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>Caisse</td>

                                                        <td><?php
                                                            echo $this->Form->input('caisse_id', array('class' => 'form-control', 'label' => '', 'index' => 0, 'empty' => 'Veuillez choisir !!', 'champ' => 'caisse_id', 'value' => $caisses, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][caisse_id]'));
                                                            ?>
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


                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm verifBonres" id="boutonCommande" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                </div>
                <?php echo $this->Form->end(); ?>

            </div>



        </div>
    </div>
</section>


<script>
    $(document).ready(function() {



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
        $(".boutonlivraison").on("keyup", function() {
            Calcul();
        });


    });
</script>
<script type="text/javascript">
    $(function() {


        $('.tauxx').on('keyup change', function() {
            // alert('hhh')
            index = $('#indexreg').val();
            max = $('#max').val();
            variable1 = $('#CommandeclientTotalttc').val();
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
                    // alert(data.ligne.Fodec);
                    //  $('#adresselivraison-id').html(data.select);
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
                    //  alert(response);

                    $('#prix' + index).val(response['donnearticle']["Prix_LastInput"]);
                    $('#ml' + index).val(response['donnearticle']["ml"]);
                    $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);
                    $('#fodec' + index).val(response['donnearticle']["fodec"]);
                    Calcul();
                }
            })
        });
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





<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
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
</script>
<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>
<?php $this->end(); ?>