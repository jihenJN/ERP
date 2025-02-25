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
?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript">
    </script>

    <?php echo $this->Html->css('select2'); ?>
    <?php echo $this->Html->script('salma'); ?>

    <?php echo $this->Html->script('hechem'); ?>


    <?php echo $this->fetch('script'); ?>



    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ajout devis
            <small><?php echo __(''); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'index/5']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
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
                            <!-- <input type="hidden" name="escompteSociete" id="escompteSociete" value="<?php echo $escompte ?>" style="margin-right: 20px"> -->


                        </div>


                        <br>
                        <br>



                        <!-- <div class="col-md-12" id="blocclient" style="display: true;">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo __('Info de client'); ?></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="col-xs-6">


                                        <?php
                                        //debug($clientc);
                                        echo $this->Form->input('name', array('value' => $clientc->Raison_Sociale, 'readonly' => 'readonly', 'label' => 'Raison Sociale', 'id' => 'name', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                        ?>


                                    </div>
                                    <div class="col-xs-6">
                                        <?php
                                        echo $this->Form->input('matriculefiscale', array('value' => $clientc->Matricule_Fiscale, 'label' => 'Matricule Fiscale', 'id' => 'matriculefiscale', 'div' => 'form-group', 'readonly' => 'readonly', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                        ?>
                                    </div>

                                    <div class="col-xs-6">
                                        <?php
                                        echo $this->Form->input('adresse', array('value' => $clientc->Adresse, 'readonly' => 'readonly', 'label' => 'Adresse', 'id' => 'adresse', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                        // echo $this->Form->input('adresse', array('value' => $clientc->localite->name . ' ' . $clientc->delegation->name . ' ' . $clientc->delegation->codepostale, 'readonly' => 'readonly', 'label' => 'Adresse', 'id' => 'adresse', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                        ?>
                                    </div>

                                    <div class="col-xs-6">
                                        <?php
                                        if ($exotva == '' && $exotpe == '' && $exofodec == '') {
                                            $exo = 'Non exoneré';
                                        } else {
                                            $exo = $exotva . '/' . $exotpe . '/' . $exofodec;
                                        }
                                        echo $this->Form->input('exonorationclient', array('value' => $exo, 'readonly' => 'readonly', 'label' => 'Type exenorations', 'id' => 'typeexenoration', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                        ?>
                                        <?php
                                        //echo $this->Form->input('exonorationclient', array('value' => $exotva . '/' . $exotpe . '/' . $exofodec, 'readonly' => 'readonly', 'label' => 'Type exenorations', 'id' => 'typeexenoration', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                        ?>
                                    </div>



                                </div>
                            </div>
                        </div> -->


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


                        <section>
                            <div class="row">
                                <div style=" position: static;">
                                    <div class="col-xs-3">
                                        <!--                                                            <h1 class="box-title"><?php echo __('Ligne bon de commande'); ?></h1>-->
                                        <?php echo $this->Form->control('nbligne', ['nbligne' => 'Poids', 'readonly' => 'readonly', 'label' => 'Ligne bon de commande', 'name', 'required' => 'off', 'value' => $bonlivraison->nbligne]); ?>

                                    </div>
                                    <div class="col-xs-3">
                                        <?php echo $this->Form->control('Poids', ['id' => 'Poids', 'readonly' => 'readonly', 'label' => 'Poids', 'name', 'required' => 'off', 'value' => $bonlivraison->Poids]); ?>


                                    </div>
                                    <div class="col-xs-3">
                                        <?php echo $this->Form->control('Coeff', ['id' => 'Coeff', 'readonly' => 'readonly', 'label' => 'NB Palette', 'name', 'required' => 'off', 'value' => $bonlivraison->Coeff]); ?>

                                    </div>
                                    <div class="col-xs-3">
                                        <?php echo $this->Form->control('pallette', ['id' => 'pallette', 'readonly' => 'readonly', 'label' => 'Poids Par palette', 'name', 'required' => 'off', 'value' => $bonlivraison->pallette]); ?>

                                    </div>

                                </div>
                            </div>
                        </section>



                        <section class="content-header">
                            <h1 class="box-title"><?php echo __('Ligne bon de commande'); ?></h1>
                        </section>

                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <!-- <a class="btn btn-primary ajouterligne_w btn  btnajoutlignecommande" table="addtable" index="index" style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter ligne</a> -->

                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="addtable">



                                                <thead>
                                                    <tr width:20px>


                                                        <td align="center" style="width: 12%; font: size 20px;"><strong>Article</strong></td>
                                                        <!-- <td align="center" style="width: 5%; font: size 20px;"><strong>Code article</strong></td> -->

                                                        <td align="center" style="width: 6%;"><strong>Qte stock </strong></td>
                                                        <td align="center" style="width: 6%;"><strong>Qte </strong></td>
                                                        <td align="center" style="width: 4%;"><strong>P.U.H.T</strong></td>



                                                        <td align="center" style="width: 4%;"><strong>Remise</strong></td>


                                                        <td align="center" style="width: 4%;"><strong> TVA </strong></td>
                                                        <td align="center" style="width: 2%; font: size 5px;"><strong style="font: size 5px;">Fodec</strong></td>


                                                        <!-- <td align="center" style="width: 4%;"><strong> DC </strong></td> -->

                                                        <!-- <td align="center" style="width:2%;"></td>
                                                </tr> -->
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($lignebonlivraisons as $i => $res) :
                                                      ///  debug($res);die;
                                                        $articleid =  $res->article_id;
                                                        $depotid = $bonlivraison->depot_id;
                                                        date_default_timezone_set('Africa/Tunis');
                                                        $date = date('Y-m-d H:i:s');
                                                        $connection = ConnectionManager::get('default');
                                                        $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                        $stockk = $inv[0]['v'];
                                                        //debug($res)
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
                                                                    <select name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="ligner" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleidbl1 Testdep single">
                                                                        <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                        <?php foreach ($articles as $id => $article) {
                                                                        ?>
                                                                            <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>

                                                                <?php //echo $this->Form->control('article_id', ['options' => $articles, 'value' => $res->article_id, 'name' => 'data[ligner][' . $i . '][article_id]', 'empty' => true, 'label' => '', 'table' => 'ligner', 'champ' => 'article_id', 'class' => 'form-control select2 articleidbl1  Testdep single']); 
                                                                ?>

                                                            </td>


                                                            <!-- <td align="center">

                                                            <?php echo $this->Form->control('Code', ['readonly' => 'readonly', 'value' => $res->article->Code, 'name' => 'data[ligner][' . $i . '][codearticle]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'article_id', 'class' => 'form-control select Testdep single', 'index']); ?>

                                                        </td> -->




                                                            <td align="center">
                                                                <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>

                                                                <?php
                                                                echo $this->Form->control('qtestock', ['readonly' => 'readonly', 'value' => $stockk, 'name' => 'data[ligner][' . $i . '][qteStock]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'qteStock', 'class' => 'form-control select getprixarticle Testdep single', 'index', 'id' => 'qteStock' . $i,]);
                                                                ?>


                                                            </td>


                                                            <td align="center">

                                                                <?php echo $this->Form->input('qte', array('readonly' => 'readonly','label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'number', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control pourcentescompte ', 'index')); ?>

                                                                <input type="hidden" table="ligner" name="" id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">

                                                            </td>




                                                            <td align="center">
                                                                <?php echo $this->Form->input('prix', array('label' => '', 'value' => $res->punht, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                                            </td>







                                                            <td align="center">
                                                                <?php echo $this->Form->input('remisearticle', array('label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remisearticle]', 'type' => 'text', 'id' => 'remisearticle' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>

                                                                <?php echo $this->Form->input('montantht', array('label' => '', 'value' => $res->montantht, 'name' => 'data[ligner][' . $i . '][motanttotal]', 'type' => 'hidden', 'id' => 'motanttotal' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                                <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>



                                                            </td>


                                                            <td align="center">

                                                                <?php echo $this->Form->control('monatantlignetva', ['value' => $res->totaltva, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => 'monatantlignetva' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][monatantlignetva]', 'required' => 'off']); ?>


                                                                <?php echo $this->Form->input('tva', array('value' => $res->tva, 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                                            </td>


                                                            <td align="center">

                                                                <?php echo $this->Form->control('fodeccommandeclient', ['value' => $res->fodec, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][fodeccommandeclient]', 'required' => 'off']); ?>

                                                                <?php echo $this->Form->input('fodec', array('readonly' => 'readonly', 'label' => '', 'value' => $res->article->fodec, 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => '', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                                <?php echo $this->Form->input('ttc', array('label' => '', 'value' => '', 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => 'hidden', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                                <?php
                                                                echo $this->Form->input('totatlttc', array(
                                                                    'type' => 'hidden',
                                                                    'name' => 'data[ligner][' . $i . '][totalttc]',
                                                                    'label' => '', 'value' => $res->totalttc,
                                                                    'table' => 'ligner', 'index' => $i, 'id' => 'totalttc' . $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '
                                                                ));
                                                                ?>

                                                            </td>




                                                            <!-- <td align="center">
                                                            <?php echo $this->Form->input('dc', array('label' => '', 'value' => '', 'name' => 'data[ligner][' . $i . '][dc]', 'type' => 'text', 'id' => 'dc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'index')); ?>
                                                        </td> -->

                                                            <!-- <td align="center">
                                                            <i id="" class="fa fa-times supLigne0ch" style="color: #c9302c;font-size: 22px;" index="<?php echo $i ?>"></i>

                                                        </td> -->



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



                                                        <!-- <td align="center" table="ligner">
                                                        <input table="ligner" champ="codearticle" type="text" class="form-control " index readonly>
                                                    </td> -->




                                                        <td align="center" table="ligner">
                                                            <input table="ligner" champ="qteStock" type="text" class="form-control getprixht" index readonly>
                                                        </td>


                                                        <td align="center" table="ligner">
                                                            <input type="number" table="ligner" name="" id="" champ="qte" type="text" class=" pourcentescompte form-control" index>
                                                        </td>


                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" champ="prix" class="form-control" index name=''>
                                                        </td>



                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" champ="remiseclient" class="form-control" index name=''>
                                                        </td>


                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" champ="remisearticle" class="form-control" index name=''>
                                                            <input table="ligner" type="hidden" name="" champ="motanttotal" id='' class="form-control " index>
                                                        </td>




                                                        <td align="center" table="ligner">
                                                            <input table="ligner" type="text" name="" champ="tva" id='' class="form-control" index>
                                                            <?php echo $this->Form->control('monatantlignetva', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => '', 'index', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>

                                                            <input table="ligner" type="hidden" name="" champ="ttc" id='' class="form-control" index>
                                                            <input table="ligner" type="hidden" name="" champ="totalttc" id='' class="form-control" index>

                                                        </td>


                                                        <td>
                                                            <input table="ligner" champ="fodec" type="text" class="form-control " index readonly>
                                                            <?php echo $this->Form->control('fodeccommandeclient', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                                                        </td>





                                                        <!-- <td align="center" table="ligner">
                                                        <input table="ligner" type="text" name="" champ="dc" class="form-control" index>
                                                    </td> -->


                                                        <td>
                                                            <input table="ligner" type="text" name="" champ="tpe" class="form-control" index>
                                                            <?php echo $this->Form->control('tpecommandeclient', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'tpecommandeclient', 'id' => 'tpecommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'tpe', 'required' => 'off']); ?>
                                                            <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>
                                                        </td>




                                                        <td align="center">
                                                            <i index id="" class="fa fa-times supLigne0ch" style="color: #c9302c;font-size: 22px;"></i>
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
                                        <?php echo $this->Form->control('remisee', ['value' => $bonlivraison->totalremise, 'id' => 'totalremise', 'readonly' => 'readonly', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                    </div>

                                    <div class="col-xs-4">
                                        <?php echo $this->Form->control('total', ['id' => 'totalht', 'value' => $bonlivraison->totalht, 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
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
            $(".boutonlivraison").on("keyup", function() {
                Calcul();
            });

            function Calcul() {
                /// alert('hechem')
                index = $('#index').val();
                totalht = 0;
                taux = $('#taux').val();
                totalremise = 0;
                totalht = 0;
                totalfodec = 0;
                totaltva = 0;
                totalttc = 0;
                for (i = 0; i <= index; i++) {
                    sup = $('#sup' + i).val() || 0;
                    if (Number(sup) != 1) {
                        prix = $('#prix' + i).val() || 0;
                        qte = $('#qte' + i).val() || 0;
                        remise = $('#remisearticle' + i).val() || 0;
                        tva = Number($('#tva' + i).val()) || 0;
                        //alert(tva)
                        tott = Number(prix) * Number(qte);
                        // totalht = Number(tott) + Number(totalht);
                        remisel = ((Number(qte) * Number(prix)) * Number(remise / 100));
                        totalremise = Number(totalremise) + Number(remisel);
                        ht = (Number(qte) * Number(prix)) - Number(remisel);
                        // ht = (Number(qte) * Number(prix)) - Number(remisel);
                        $('#ht' + i).val(Number(ht).toFixed(3));
                        // alert(ht);
                        fodec = $('#fodec' + i).val() || 0;
                        totalht = Number(totalht) + Number(ht);
                        fodecl = Number(ht) * Number(fodec / 100);
                        totalfodec = Number(totalfodec) + Number(fodecl);
                        htfodec = Number(ht) + Number(fodecl);
                        tval = Number(htfodec) * Number(tva / 100);
                        totaltva = Number(totaltva) + Number(tval);
                        ttcl = Number(htfodec) + Number(tval);
                        $('#ttc' + i).val(Number(ttcl).toFixed(3));
                        totalttc = Number(totalttc) + Number(ttcl);
                        totaldevise = Number(totalttc) / Number(taux);
                    }
                }
                //alert(totalfodec);
                //$('#tot').val(Number(totalht).toFixed(3));
                $('#tot').val(Number(totalttc).toFixed(3));
                $('#totalremise').val(Number(totalremise).toFixed(3));
                $('#totalht').val(Number(totalht).toFixed(3));
                $('#totalfodec').val(Number(totalfodec).toFixed(3));
                $('#totaltva').val(Number(totaltva).toFixed(3));
                $('#ttc').val(Number(totalttc).toFixed(3));
                $('#sec').css('display', 'block');

            }
        });


        </script>
        <script type = "text/javascript" >
            $(function() {
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
                        // alert(response);
                        //    alert(response['ligne']["Code"]);
                        qtestockx = response['qtestockx'];
                        // alert(qtestockx);

                        $('#codearticle' + index).val(response['ligne']["Code"]);

                        $('#qteStock' + index).val(qtestockx);
                        $('#prix' + index).val(response['ligne']["Prix_LastInput"]);
                        // $('#ttc' + index).val(response['ligne']["PTTC"]);
                        //$('#exofodec').val(response['ligne']["FODEC"]);
                        $('#prixht' + index).val(response['ligne']["PHT"]);

                        $('#tva' + index).val(response['ligne']["tva"]["valeur"]);
                        $('#tpe' + index).val(response['ligne']["TXTPE"]);
                        $('#fodec' + index).val(response['ligne']["fodec"]);
                        $('#remisearticle' + index).val(response['ligne']["remise"]);
                    }
                })
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