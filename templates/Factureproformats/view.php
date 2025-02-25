<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ville $ville
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
    <h1>
        Modifier facture proformat
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
                            <div class="col-xs-6">
                                <?php
                                echo $this->Form->control('numero', ['readonly' => 'readonly']);
                                ?>
                            </div>
                            <div class="col-xs-2">

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

                            </div>

                            <div <?php if ($commande->dateimp == null) { ?> style="display:none" <?php } ?> class="col-xs-2" id="dateimp">

                                <?php echo $this->Form->control('dateimp', ['id' => 'dateimpp', 'type' => '', 'name' => 'dateimp', 'label' => 'Date impérative']); ?>



                            </div>

                            <div <?php if ($commande->dateintdebut == null) { ?> style="display:none" <?php } ?> class="col-xs-2" id="datedeb">




                                <?php echo $this->Form->control('dateintdebut', ['type' => '', 'value' => $commande->dateintdebut, 'name' => 'dateintdebut', 'label' => 'Date début', 'calss' => 'form-control']); ?>
                            </div>

                            <div <?php if ($commande->dateintfin == null) { ?> style="display:none" <?php } ?> class="col-xs-2" id="datef">
                                <?php echo $this->Form->control('dateintfin', ['type' => '', 'value' => $commande->dateintfin, 'name' => 'dateintfin', 'label' => 'Date fin', 'calss' => 'form-control']); ?>
                            </div>


                        </div>
                    </div>

                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <div class="col-xs-6">
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

                            <div class="col-xs-6">
                                <div class="form-group input select required">

                                    <label class="control-label" for="depot-id">Clients</label>

                                    <select name="client_id" id="client" class="form-control select2 control-label ">
                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                        <?php foreach ($clients as $id => $client) {

                                        ?>
                                            <option <?php if ($commande->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                        <?php } ?>
                                    </select>


                                </div>




                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <div class="col-xs-6" id="com_id">
                                <?php
                                echo $this->Form->control('commercial_id', ['class' => 'form-control select2 control-label', 'empty' => 'Veuillez choisir !!', 'required' => 'off']);
                                ?>
                            </div>
                            <div class="col-xs-6">
                                <?php
                                // echo 'tt'.$commande;
                                echo $this->Form->control('depot_id', ['value' => $commande->depot_id, 'class' => 'form-control select2 control-label', 'required' => 'off']);
                                ?>
                            </div>



                        </div>
                    </div>

                    <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px" value="<?php echo $commande->client->Fodec ?>">



                    <div class="row" hidden>
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                            <div class="col-xs-6" style="margin-top: 20px ;">
                                <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>

                                OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="calcheck" style="margin-right: 20px" <?php if ($commande->payementcomptant == 1) { ?> checked="checked" <?php } ?>>
                                NON <input type="radio" name="checkpayement" value="0" id="NON" class="calcheck" <?php if ($commande->payementcomptant == 0) { ?> checked="checked" <?php } ?>>


                            </div>

                            <div class="col-xs-6">
                                <?php echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control ']); ?>
                            </div>

                        </div>
                    </div>

                    <div>
                        <?php
                        echo $this->Form->input('bl', ['type' => 'hidden', 'label' => '', 'class' => 'form-control']);
                        ?>
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
                                                <a onClick="openWindow(1000, 1000, 'http://gcip.isofterp.com/gcip/promoarticles/notgrandsurface/<?php echo $not ?>');"><?php echo $clientc->typeclient->type ?></a>
                                            <?php } ?>
                                            <?php if ($not == 0) { ?>
                                                <a><?php echo $clientc->typeclient->type ?></a>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($clientc->typeclient->grandsurface == true) {
                                            if ($gs != 0) { ?>
                                                <a onClick="openWindow(1000, 1000, 'http://gcip.isofterp.com/gcip/gspromoarticles/grandsurface/<?php echo $gs ?>');"><?php echo $clientc->typeclient->type ?></a>
                                            <?php } ?>
                                            <?php if ($gs == 0) { ?>
                                                <a><?php echo $clientc->typeclient->type ?></a>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-xs-3" style="display: flex;margin-top: 30px;">
                                    <div id="BL">
                                        <?php if ($commande->bl == 1) { ?>
                                            <label style="margin-right: 20px">BL:</label>
                                        <?php } ?>
                                        <?php if ($commande->bl == 0) { ?>
                                            <label style="margin-right: 20px">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                        <?php } ?>
                                        <?php if ($commande->bl == 1) { ?>
                                            OUI <input type="radio" name="bl" id="OUI" style="margin-right: 20px" <?php if ($commande->bl == 1) { ?> checked="checked" <?php } ?> value='1'>
                                            NON <input type="radio" name="bl" id="NON" <?php if ($commande->bl == 0) { ?> checked="checked" <?php } ?> value='0'>
                                        <?php } ?>
                                    </div>

                                </div>

                                <div class="col-xs-2" style="flex-direction:row;display: flex;margin-top: 40px;width: 20% !important;">
                                    <label>Remise : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <div id="remi">
                                        <?php if ($rz == 'avec palier') { ?>
                                            <a onClick="openWindow(1000, 1000, 'http://gcip.isofterp.com/gcip/remiseclients/consultation/<?php echo $remcli ?>');"><?php echo $rz ?></a>
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
                                            <a onClick="openWindow(1000, 1000, 'http://gcip.isofterp.com/gcip/remiseescomptes/consultation/<?php echo $remes ?>');"><?php echo $es ?></a>
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

                    <input value="<?php echo $exofodec ?>" type="hidden" name="fodecclientexo" id="fodecclientexo" class="" style="margin-right: 20px">
                    <input type="hidden" name="timbreclientexo" id="timbreclientexo" class="" style="margin-right: 20px">
                    <input value="<?php echo $exotva ?>" type="hidden" name="tvaclientexo" id="tvaclientexo" class="" style="margin-right: 20px">
                    <input value="<?php echo $exotpe ?>" type="hidden" name="tpeclientexo" id="tpeclientexo" class="" style="margin-right: 20px">




                    <input type="hidden" value="<?php echo $clientc->prix ?>" name="formule" id="formule" class="" style="margin-right: 20px">



                    <input type="hidden" name="escompteSociete" id="escompteSociete" value="<?php echo $escompte ?>" style="margin-right: 20px">



                    <div class="col-md-12">




                        <div class="row" hidden>
                            <div style=" position: static;">
                                <div class="col-xs-3">
                                    <!--                                                            <h1 class="box-title"><?php echo __('Ligne bon de commande'); ?></h1>-->
                                    <?php echo $this->Form->control('nbligne', ['value' => $commande->nbligne, 'nbligne' => 'Poids', 'readonly' => 'readonly', 'label' => 'Ligne facture proformat ', 'name', 'required' => 'off']); ?>

                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Poids', ['id' => 'Poids', 'value' => $commande->poids, 'readonly' => 'readonly', 'label' => 'Poids', 'name', 'required' => 'off']); ?>


                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Coeff', ['id' => 'Coeff', 'value' => $commande->Coeff, 'readonly' => 'readonly', 'label' => 'NB Palette', 'name', 'required' => 'off']); ?>

                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('pallette', ['id' => 'pallette', 'value' => $commande->pallette, 'readonly' => 'readonly', 'label' => 'Poids Par palette', 'name', 'required' => 'off']); ?>

                                </div>
                            </div>
                        </div>
                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box">

                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="addtable">
                                                <thead>
                                                    <tr width:20px>


                                                        <td align="center" style="width: 12%; font-size: 12px;"><strong>Article</strong></td>
                                                        <!-- <td align="center" style="width: 4%; font-size: 12px;"><strong>Code article</strong></td> -->

                                                        <td align="center" style="width: 4%;font-size: 12px;"><strong>Qte stock </strong></td>
                                                        <td align="center" style="width: 6%;font-size: 12px;"><strong>Qte </strong></td>
                                                        <td align="center" style="width: 7%;font-size: 12px;"><strong>P.U.H.T</strong></td>


                                                        <td align="center" style="width: 3%;font-size: 12px;"><strong>Remise</strong></td>


                                                        <td align="center" style="width: 3%;font-size: 12px;"><strong> TVA </strong></td>
                                                        <td align="center" style="width: 3%; font-size: 12px;"><strong style="font: size 5px;">Fodec</strong></td>


                                                        <!-- <td align="center" style="width: 4%;font-size: 12px;"><strong> DC </strong></td> -->

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php if (!empty($commande)) : // debug($commande);  
                                                    ?>
                                                        <?php
                                                        foreach ($lignecommandes as $i => $res) : //debug($res);die; // debug($lignebonchargements->id);
                                                            //  foreach ($lignebonchargements as $i => $ligne) :  debug($ligne->article->Dsignation);
                                                            ///debug($res->qtestock);
                                                            //$stock = $res->qtestock ;
                                                            //  $date = $commande->date ;
                                                            $articleid = $res->article_id;
                                                            //debug($articleid);
                                                            $depotid = $commande->depot_id;

                                                            //debug($depotid);
                                                            date_default_timezone_set('Africa/Tunis');
                                                            $date = date("Y-m-d H:i:s");

                                                            //debug($date);

                                                            //  if ($res->qtestock == null){

                                                            $connection = ConnectionManager::get('default');


                                                            $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                            $bc = $connection->execute("select stockbassemseuil(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as q")->fetchAll('assoc');
                                                            // $inventaires[0]['v']=$inventaires[0]['v']+$res->qte;
                                                            $bc[0]['q'] = $bc[0]['q'] - $res->qte;
                                                            // debug($bc[0]['q']);
                                                            $month = (int)date('m');
                                                            $seuil = $connection->execute('SELECT * FROM `seuilmois` WHERE article_id="' . $articleid . '" and moi_id="' . $month . '" ')->fetchAll('assoc');

                                                            if (is_null($seuil)) {
                                                                $alert = 0;
                                                            } else {
                                                                $alert = (int)$seuil['0']['alert'];
                                                            }

                                                            //debug($bc[0]['q']);

                                                            if ($inventaires[0]['v'] == $bc[0]['q']) {
                                                                $stock = $inventaires[0]['v'] - $alert;
                                                            } else {
                                                                $stock = $inventaires[0]['v'] - $bc[0]['q'] - $alert;
                                                            }
                                                            //debug($stock);

                                                            //  }


                                                            if ($res->prix == 0) {
                                                                $style1 = 'none';
                                                                $style2 = '';
                                                            } else {
                                                                $style2 = 'none';
                                                                $style1 = '';
                                                            }
                                                            $month = (int)date('m');
                                                            $seuil = $connection->execute('SELECT * FROM `seuilmois` WHERE article_id="' . $res->article_id . '" and moi_id="' . $month . '" ')->fetchAll('assoc');

                                                            if (empty($seuil))
                                                                $alert = 0;
                                                            else
                                                                $alert = (int)$seuil['0']['alert'];
                                                            // debug($alert);

                                                            $seuill = $stock + $alert;
                                                            //debug($seuill);
                                                            if ($res->qte > $seuill + 1) {

                                                                $color = 'background-color: salmon ; ';
                                                            }
                                                            if ($res->qte > $stock + 1 && $res->qte < $seuill) {

                                                                $color = 'background-color: pink ; ';
                                                            }
                                                            if ($res->qte <= $stock) {

                                                                $color = 'background-color: white ; ';
                                                            }

                                                            $qtestock =  $stock;






                                                        ?>
                                                            <tr style="<?php echo $color ?>">
                                                                <td align="center" champ='tdart' id='tdart<?php echo $i ?>' style="display:<?php echo $style1 ?> ">



                                                                    <div>
                                                                        <label></label>
                                                                        <select name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="ligner" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleidbl1">
                                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                            <?php foreach ($articles as $id => $article) {
                                                                            ?>
                                                                                <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                            <?php }
                                                                            /*  $connection = ConnectionManager::get('default');
                                                                                       $month=(int)date('m') ;
                                                                                       $seuil= $connection->execute("SELECT * FROM `Seuilmois` WHERE article_id='".$$res->article_id."' and moi_id='".$month."'")->fetchAll('assoc');
                                                                                        dd($seuil) ;
                                                                             */

                                                                            ?>
                                                                        </select>
                                                                        <input type="hidden" id="alert<?php echo $i ?>" value=<?php echo $alert ?> name="<?php echo "data[ligner][" . $i . "][alert]" ?>">

                                                                    </div>
                                                                    <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden')); ?>




                                                                    <?php
                                                                    echo $this->Form->input('id', array(
                                                                        'champ' => 'id', 'label' => '', 'name' => 'data[ligner][' . $i . '][id]',
                                                                        'value' => $res->id,
                                                                        'type' => 'hidden', 'id' => '', 'table' => 'ligner', 'index' => '', 'div' => 'form-group',
                                                                        'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'
                                                                    ));
                                                                    ?>
                                                                    <!--<div style="margin-top:10%">-->





                                                                    <?php //echo $this->Form->control('article_id', ['index' => $i, 'id' => 'article_id' . $i, 'options' => $articles, 'value' => $res->article_id, 'name' => 'data[ligner][' . $i . '][article_id]', 'empty' => true, 'label' => '', 'table' => 'ligner', 'champ' => 'article_id', 'class' => 'form-control select2 articleidbl1 Testdep single']);  
                                                                    ?>
                                                                    <!--</div>-->
                                                                </td>
                                                                <td align="center" champ='td' id='td<?php echo $i ?>' style="display:<?php echo $style2 ?> ">

                                                                    <input table="ligner" 'readonly' champ="articlee" type="text" value="Promo: <?php echo $res->article->Code . ' ' . $res->article->Dsignation ?>" class="form-control " index>
                                                                </td>

                                                                <!-- <td align="center">

                                                                    <?php echo $this->Form->control('Code', ['index' => $i, 'readonly' => 'readonly', 'value' => $res->article->Code, 'name' => 'data[ligner][' . $i . '][codearticle]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'article_id', 'class' => 'form-control select Testdep single', 'index']); ?>

                                                                </td> -->


                                                                <td align="center" table="ligner" id='qs<?php echo $i ?>'>
                                                                    <?php echo $this->Form->control('qtr', ['id' => 'qtr' . $i, 'index' => $i, 'type' => 'hidden', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qtr]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'qteStock', 'class' => 'form-control select getprixarticle Testdep single getstock', 'index']); ?>

                                                                    <?php echo $this->Form->control('qtestock', ['id' => 'qteStock' . $i, 'index' => $i, 'readonly' => 'readonly', 'value' => $qtestock, 'name' => 'data[ligner][' . $i . '][qteStock]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'qteStock', 'class' => 'form-control select getstock', 'index']); ?>

                                                                </td>


                                                                <td align="center" table="ligner" id='q<?php echo $i ?>'>
                                                                    <?php echo $this->Form->input('qte', array('index' => $i, 'label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control pourcentescompte focus boutonlivraison', 'index')); ?>
                                                                    <input type="hidden" value='<?php echo $res->article->Poids ?>' table="ligner" name="" id="<?php echo 'poids' . $i ?>" champ="poids" class="calcullignecommande form-control" index="<?php echo $i ?>">


                                                                    <input type="hidden" table="ligner" name="" value='<?php echo $res->pourcentageescompte ?>' id="<?php echo 'pourcentageescompte' . $i ?>" champ="pourcentageescompte" class="calcullignecommande form-control" index="<?php echo $i ?>">


                                                                    <input type="hidden" table="ligner" name="" value='<?php echo $res->escompte ?>' id="<?php echo 'escompte' . $i ?>" champ="escompte" class="calcullignecommande form-control" index="<?php echo $i ?>">




                                                                </td>
                                                                <td align="center" table="ligner" id='p<?php echo $i ?>'>
                                                                    <?php echo $this->Form->input('prix', array('index' => $i, 'label' => '', 'value' => $res->prix, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                                                </td>



                                                                <td align="cnter" table="ligner" id='ra<?php echo $i ?>'>
                                                                    <?php echo $this->Form->input('remisearticle', array('label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remisearticle]', 'type' => 'text', 'id' => 'remisearticle' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>

                                                                    <?php echo $this->Form->input('montantht', array('label' => '', 'value' => $res->montantht, 'name' => 'data[ligner][' . $i . '][motanttotal]', 'type' => 'hidden', 'id' => 'motanttotal' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>




                                                                </td>






                                                                <td align="center" table="ligner" id='tv<?php echo $i ?>'>

                                                                    <?php echo $this->Form->control('monatantlignetva', ['value' => $res->totaltva, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => 'monatantlignetva' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][monatantlignetva]', 'required' => 'off']); ?>


                                                                    <?php echo $this->Form->input('tva', array('value' => $res->tva, 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                                                </td>


                                                                <td align="center" table="ligner" id='fo<?php echo $i ?>'>



                                                                    <?php echo $this->Form->control('fodeccommandeclient', ['value' => $res->fodec, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][fodeccommandeclient]', 'required' => 'off']); ?>

                                                                    <?php echo $this->Form->input('fodec', array('readonly' => 'readonly', 'label' => '', 'value' => $res->article->fodec, 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                                    <?php echo $this->Form->input('ttc', array('label' => '', 'value' => $res->ttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => 'hidden', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                                    <?php echo $this->Form->input('totatlttc', array('type' => 'hidden', 'name' => 'data[ligner][' . $i . '][totalttc]', 'label' => '', 'value' => $res->totalttc, 'table' => 'ligner', 'index' => $i, 'id' => 'totalttc' . $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>



                                                                </td>









                                                                <!-- <td align="center">
                                                                    <?php echo $this->Form->input('dc', array('label' => '', 'value' => '', 'name' => 'data[ligner][' . $i . '][dc]', 'type' => 'text', 'id' => 'dc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control', 'index')); ?>
                                                                </td> -->




                                                               
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    </tr>















                                                    <tr class="tr" style="display: none ">
                                                        <td align="center" champ='tdart'>
                                                            <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control ">
                                                            <select table="ligner" index champ="article_id" class="js-example-responsive  articleidbl1">
                                                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                                <?php foreach ($articles as $id => $article) {
                                                                ?>
                                                                    <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td align="center" champ='td' style="display: none">

                                                            <input table="ligner" 'readonly' champ="articlee" type="text" class="form-control " index>
                                                        </td>

                                                        <!-- <td align="center" table="ligner">
                                                        <input table="ligner" champ="codearticle" type="text" class="form-control " index readonly>
                                                    </td> -->

                                                        <td align="center" table="ligner" champ="a">
                                                            <input table="ligner" champ="qteStock" type="text" class="form-control getprixht getstock" index readonly>
                                                        </td>

                                                        <td align="center" table="ligner" champ="b">
                                                            <input type="hidden" table="ligner" name="" id="" champ="pourcentageescompte" type="text" class="calcullignecommande form-control" index>

                                                            <input type="hidden" table="ligner" name="" id="" champ="escompte" type="text" class="calcullignecommande form-control" index>
                                                            <input table="ligner" champ="alertart" type="hidden" index>

                                                            <input table="ligner" name="" id="" champ="qte" type="text" class=" form-control  pourcentescompte calculqte focus boutonlivraison" index>
                                                            <input table="ligner" name="" id="" champ="poids" type="hidden" class=" form-control  pourcentescompte calculqte" index>

                                                        </td>

                                                        <td align="center" table="ligner" champ="c">
                                                            <input readonly table="ligner" type="text" champ="prix" class="form-control" index name=''>
                                                        </td>







                                                        <td align="center" table="ligner" champ="f">
                                                            <input readonly table="ligner" type="text" champ="remisearticle" class="form-control" index name=''>
                                                            <input table="ligner" type="hidden" name="" champ="motanttotal" id='' class="form-control " index>
                                                        </td>


                                                        <td align="center" table="ligner" champ="g">
                                                            <input readonly table="ligner" type="text" name="" champ="tva" id='' class="form-control" index>
                                                            <?php echo $this->Form->control('monatantlignetva', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => '', 'index', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>

                                                            <input table="ligner" type="hidden" name="" champ="ttc" id='' class="form-control" index>

                                                            <input table="ligner" type="hidden" name="" champ="totalttc" id='' class="form-control" index>
                                                        </td>


                                                        <td table="ligner" champ="h">
                                                            <input table="ligner" champ="fodec" type="text" class="form-control " index readonly>
                                                            <?php echo $this->Form->control('fodeccommandeclient', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient', 'index', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>

                                                        </td>











                                                        <td align="center" table="ligner" champ="j">
                                                            <i id="" class="fa fa-times supLigne0ch" style="color: #c9302c;font-size: 22px;" table="ligner" name=""></i>
                                                            <input type='hidden' table="ligner" champ="suptest" class="form-control" index name='' id="">
                                                        </td>
                                                    </tr>







                                                    <input type="" value="<?php echo $i ?>" id="index" hidden>

                                                </tbody>

                                            </table>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </section>


                        <section class="content" style="width: 99%">
                            <div class="row" id="sec">
                                <div class="row">
                                    <div style=" position: static;">
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'value' => $commande->remise, 'readonly' => 'readonly', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                        </div>

                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalht', ['id' => 'totalht', 'value' => $commande->total, 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                        </div>
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totaltva', ['id' => 'totaltva', 'value' => $commande->tva, 'readonly' => 'readonly', 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                        </div>
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalfodec', ['id' => 'totalfodec', 'value' => $commande->fodec, 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                        </div>
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'readonly', 'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div><br>
                    <!-- <input type="hidden" value="<?php echo $i ?>" id="index0"> -->
                </div>
            </div>
        </div>
    </div>


    <br>
    <br>














    <br>
    <!-- </div>
            </div>
        </div>
    </div>





</section> -->

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
        // Disable all form elements
        $('input, select, textarea, button').prop('disabled', true);
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
        $('.articleidbl1').on('change', function() {
            //  alert("hh");
            index = $(this).attr('index'); //alert(index)
            //  alert(index);
            article_id = $('#article_id' + index).val(); //alert(article_id)
            idClient = $('#client').val(); //alert(idClient);//alert(
            //alert(article_id);
            datecreation = $('#date').val();
            depot_id = $('#depot-id').val(); //alert(depot_id)
            formule = $('#formule').val();
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
                    // alert(response);
                    //    alert(response['ligne']["Code"]);
                    qtestockx = response['qtestockx'];
                    //alert(response['donnearticle']);

                    $('#codearticle' + index).val(response['donnearticle']["Code"]);
                    $('#poids' + index).val(response['donnearticle']["Poids"]);
                    $('#remisearticle' + index).val(response['donnearticle']["remise"]);

                    $('#qteStock' + index).val(qtestockx);
                    $('#prix' + index).val(response['ligne']);
                    fodec = response['donnearticle']["fodec"];
                    //   alert(response['donnearticle']["tva"])
                    if (response['donnearticle']["tva"] != null) {
                        tva = response['donnearticle']["tva"]["valeur"];
                    } else {
                        tva = 0;
                    }
                    tpe = response['donnearticle']["TXTPE"];
                    escompte = Number($('#escompteSociete').val()); //alert(escompte+"escompte")
                    remiseclient = Number($('#remiseclient' + index).val()); //alert(remiseclient+"remiseclient")
                    remisearticle = response['donnearticle']["remise"];

                    prix = response['ligne'];
                    //prixavecformulclient(prix,index,formule,fodec,tva,tpe,escompte,remiseclient,remisearticle) 
                    $('#tpe' + index).val(response['donnearticle']["TXTPE"]);
                    $('#fodec' + index).val(response['donnearticle']["fodec"]);
                    // alert(response['ligne']["fodec"]);
                    // $('#ttc' + index).val(response['ligne']["PTTC"]);
                    //$('#exofodec').val(response['ligne']["FODEC"]);
                    $('#prixht' + index).val(response['donnearticle']["PHT"]);
                    $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);



                    $('#qte' + index).focus();
                }
            })
        });
    });
</script>
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
<?php $this->end(); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
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
        //Initialize Select2 Elements
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
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
</script>
<script>
    $(document).ready(function() {


        $(document).on('keyup', '.focus', function(e) {
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
<?php $this->end(); ?>