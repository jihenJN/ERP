<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;



/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('calculvente'); ?>

<?php echo $this->fetch('script'); ?>
<?php if ($type == 4) { ?>
    <section class="content-header">
        <h1>
            Validation Integration
            <small><?php echo __(''); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'index', $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <?php echo $this->Form->create($bonlivraison, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); //debug($bonlivraison);
                    ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="row">
                                <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $bonlivraison->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('date', ["value" => $bonlivraison->date]); ?>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('nouveau_client', ['type' => 'hidden', 'value' => $clientc->nouveau_client, 'id' => 'nouv', 'label' => '', 'class' => 'form-control ontrol-label']); ?>
                                        <?php echo $this->Form->control('bonusclient', ['type' => 'hidden', 'value' => $bonus, 'id' => 'bonus', 'label' => '', 'class' => 'form-control ontrol-label']); ?>
                                        <?php echo $this->Form->control('commercial', ['type' => 'hidden', 'name' => 'commercial_id', 'value' => $bonlivraison->commercial_id, 'label' => '', 'class' => 'form-control ontrol-label']); ?>
                                        <div class="form-group input select required">

                                            <label class="control-label" for="depot-id">Clients</label>

                                            <select name="client_id" id="client" class="form-control select2 control-label ">
                                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                <?php foreach ($clients as $id => $client) {
                                                ?>
                                                    <option <?php if ($bonlivraison->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php if($client->Tel!=null){ echo $client->Tel . ' -- '; } echo $client->Raison_Sociale ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group input text required" id="com_id">
                                            <?php echo $this->Form->control('commercial_id', ['value' => $bonlivraison->commercial_id, 'options' => $commercials, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Commercial', 'class' => 'form-control select2 control-label', 'name' => 'adresse']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('depot_id', ['value' => $bonlivraison->depot_id, 'options' => $depots, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Dépot', 'class' => 'form-control select2 control-label']); ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('observation', ['readonly','label' => 'Commentaire', 'class' => 'form-control', 'value' => $bonlivraison->observation, 'type' => 'textarea']); ?>
                                    </div>
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
                                                        <a onClick="openWindow(1000, 1000, 'http://sirepprefaprod.isofterp.com/ERP/promoarticles/notgrandsurface/<?php echo $not ?>');"><?php echo $clientc->typeclient->type ?></a>
                                                    <?php } ?>
                                                    <?php if ($not == 0) { ?>
                                                        <div> aucun promo </div>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if ($clientc->typeclient->grandsurface == true) {
                                                    if ($gs != 0) { ?>
                                                        <a onClick="openWindow(1000, 1000, 'http://sirepprefaprod.isofterp.com/ERP/gspromoarticles/grandsurface/<?php echo $gs ?>');"><?php echo $clientc->typeclient->type ?></a>
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
                                                OUI <input type="radio" name="bl" id="OUI" style="margin-right: 20px" <?php if ($bonlivraison->bl == 1) { ?> checked="checked" <?php } ?>value='1'>
                                                NON <input type="radio" name="bl" id="NON" <?php if ($bonlivraison->bl == 0) { ?> checked="checked" <?php } ?>value='0'>

                                            </div>

                                        </div>

                                        <div class="col-xs-2" style="flex-direction:row;display: flex;margin-top: 40px;width: 20% !important;">
                                            <label>Remise : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                            <div id="remi">
                                                <?php if ($rz == 'avec palier') { ?>
                                                    <a onClick="openWindow(1000, 1000, 'http://sirepprefaprod.isofterp.com/ERP/remiseclients/consultation/<?php echo $remcli ?>');"><?php echo $rz ?></a>
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
                                                    <a onClick="openWindow(1000, 1000, 'http://sirepprefaprod.isofterp.com/ERP/remiseescomptes/consultation/<?php echo $remes ?>');"><?php echo $es ?></a>
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
                                    <div class="box box-primary">

                                        <div class="panel-body">
                                            <div class="table-responsive ls-table">
                                                <table class="table table-bordered table-striped table-bottomless" id="addtable">


                                                    <thead>
                                                        <tr width:20px>

                                                            <td align="center" style="width: 12%; font: size 20px;"><strong>Article</strong></td>
                                                            <td align="center" style="width: 4%;"><strong>Qte </strong></td>
                                                            <td align="center" style="width: 4%;"><strong>ml</strong></td>
                                                            <td align="center" style="width: 4%;"><strong>P.U.H.T</strong></td>
                                                            <td align="center" style="width: 4%;"><strong>Total HT</strong></td>
                                                            <td align="center" style="width: 4%;"><strong>Remise</strong></td>
                                                            <td align="center" style="width: 3%;"><strong> TVA </strong></td>
                                                            <td align="center" style="width: 1%; font: size 5px;"><strong style="font: size 5px;">Fodec</strong></td>
                                                            <td align="center" style="width: 4%;"><strong>Total TTC</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>




                                                        <?php
                                                        foreach ($lignebonlivraisons as $i => $res) :




                                                          



                                                            $connection = ConnectionManager::get('default');
                                                            $thisarticle = $connection->execute("SELECT * FROM articles WHERE refBureauEtude = '" . $res->CODE . "'")->fetchAll('assoc');

                                                            $sousfamilleTable = TableRegistry::getTableLocator()->get('Sousfamille1s');
                                                            $sousfam =[];
                                                           
                                                                if ($thisarticle[0]['sousfamille1_id']!=null){
                                                            $sousfam = $sousfamilleTable->find()
                                                                ->where(['id' => $thisarticle[0]['sousfamille1_id']])
                                                                ->first();
                                                                }
                                                            
        
                                                            $readonly='';
                                                            if  ($sousfam->remiseobligatoire==0){
                                                                $readonly='readonly';
                                                            }




                                                            $articleid = $connection->execute("SELECT id FROM articles WHERE refBureauEtude = '" . $res->CODE . "'")->fetchAll('assoc');
                                                            $articleIdValue = $articleid[0]['id']; // Extract the ID value from the fetched result
                                                            $depotid = $bonlivraison->depot_id;
                                                            date_default_timezone_set('Africa/Tunis');
                                                            $date = date("Y-m-d H:i:s");
                                                               if ($articleIdValue != null) {
                                                                $inventaires = $connection->execute("SELECT stockbassem(" . $articleIdValue . ", '" . $date . "', '0', " . $depotid . ") as v")->fetchAll('assoc');
                                                                $stock = $inventaires[0]['v'];
                                                                $bc = $connection->execute("SELECT stockbassemseuil(" . $articleIdValue . ", '" . $date . "', '0', " . $depotid . ") as q")->fetchAll('assoc');
                                                            }
                                                            $tax = $connection->execute("SELECT tva_id , fodec,remise FROM articles WHERE refBureauEtude = '" . $res->CODE . "'")->fetchAll('assoc');
                                                            if ($tax[0]['tva_id'] != null) {
                                                                $tvaa = $connection->execute("SELECT valeur FROM tvas WHERE id =" . $tax[0]['tva_id'])->fetchAll('assoc');
                                                                $fod = $tax[0]['fodec'];
                                                                $ttva = $tvaa[0]['valeur'];
                                                            } else {
                                                                $fod = 0;
                                                                $ttva = 0;
                                                            }
                                                            if ($res->N != 'N°') { ?>
                                                                <tr>
                                                                    <td hidden>
                                                                        <?php
                                                                        echo $this->Form->control('article_id', ['readonly' => 'readonly', 'value' => $articleIdValue, 'name' => 'data[ligner][' . $i . '][article_id]', 'type' => 'text', 'label' => '', 'table' => 'lignecommandes', 'champ' => 'article_id', 'class' => 'form-control ', 'index']);
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <label for=""></label>
                                                                        <select disabled name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" width="100%" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="ligner" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleidbl1">
                                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                            <?php foreach ($articles as $id => $article) {
                                                                            ?>
                                                                                <option style="font-size: 10px;" <?php if ($res->CODE == $article->refBureauEtude) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                            <?php } ?>
                                                                        </select>

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
                                                                        <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculm calculligne ', 'index')); ?>
                                                                        <input type="hidden" value='<?php echo $res->article->Poids ?>' table="ligner" name="" id="<?php echo 'poids' . $i ?>" champ="poids" class="calcullignecommande form-control" index="<?php echo $i ?>">
                                                                    </td>
                                                                    <td align="center">
                                                                        <?php echo $this->Form->input('ml', array('label' => '', 'value' => $thisarticle[0]['ml'], 'name' => 'data[ligner][' . $i . '][ml]', 'type' => 'text', 'id' => 'ml' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculm calculligne ', 'index')); ?>
                                                                    </td>
                                                                    <td align="center">
                                                                        <?php echo $this->Form->input('prix', array('label' => '', 'value' => $thisarticle[0]['Prix_LastInput'], 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculm calculligne', 'index')); ?>
                                                                    </td>
                                                                    <td align="center">
                                                                        <?php echo $this->Form->input('ht', array('readonly' => 'readonly', 'label' => '', 'value' => sprintf("%01.3f", $thisarticle[0]['Prix_LastInput']*$thisarticle[0]['ml'] * $res->qte), 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                                    </td>
                                                                    <td align="center">
                                                                        <?php echo $this->Form->input('remise', array('readonly'=>$readonly,'label' => '',  'name' => 'data[ligner][' . $i . '][remise]', 'value' => $tax[0]['remise'], 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculm calculligne', 'index', 'champ' => 'remise')); ?>
                                                                    </td>
                                                                    <td align="center">

                                                                        <?php echo $this->Form->control('monatantlignetva', ['readonly' => 'readonly', 'value' => $res->totaltva, 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'monatantlignetva', 'id' => 'monatantlignetva' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][monatantlignetva]', 'required' => 'off']); ?>
                                                                        <?php 
                                                                        $val=0;
                                                                        if ($exotva==''){
                                                                            $val=$ttva;
                                                                        }
                                                                        echo $this->Form->input('tva', array('readonly' => 'readonly', 'value' => $val, 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                                    </td>
                                                                    <td align="center">

                                                                        <?php echo $this->Form->control('fodeccommandeclient', ['readonly' => 'readonly', 'value' => '', 'type' => 'hidden', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient' . $i, 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][fodeccommandeclient]', 'required' => 'off']); ?>

                                                                        <?php
                                                                        $valf=0;
                                                                        if ($exofodec==''){
                                                                            $valf=$fod;
                                                                        }
                                                                        echo $this->Form->input('fodec', array('readonly' => 'readonly', 'label' => '', 'value' => $valf, 'name' => 'data[ligner][' . $i . '][fodec]', 'type' => '', 'id' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                                                        <?php //echo $this->Form->input('ttc', array('label' => '', 'value' => '', 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => 'hidden', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); 
                                                                        ?>
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
                                                                        <?php
                                                                        $ht = $thisarticle[0]['Prix_LastInput']*$thisarticle[0]['ml'] * $res->qte;
                                                                        $tva = ($ttva / 100) * $ht;
                                                                        $remise = ($tax[0]['remise'] / 100) * $ht;
                                                                       
                                                                        $fodec = ($fod / 100) * $ht;
                                                                        $ttc = $ht + $tva + $fodec - $remise;
                                                                        echo $this->Form->input('ttc', array('readonly','label' => '', 'value' => sprintf("%01.3f", $ttc), 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                                                    </td>
                                                                </tr>
                                                        <?php }
                                                        endforeach; ?>
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

                                    <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalht', ['id' => 'totalht', 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                        </div>
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                        </div>

                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalhtapres', ['id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                        </div>
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totaltva', ['id' => 'totaltva', 'readonly' => 'readonly', 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                        </div>
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalfodec', ['id' => 'totalfodec', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                        </div>
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'readonly' => 'readonly', 'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                        <div align="center">
                            <button type="submit" class="pull-right btn btn-success btn-sm Testqtestock chauff " id="boutonlivraison" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Valider</button>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
    </section>

<?php } ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(document).ready(function() {
        Calcul();
       



        $("form").submit(function() {
            // alert("dsf");
            $('#boutonlivraison').attr('disabled', 'disabled');

        })

   

        $("#boutonlivraison").on("mouseover", function() {
            Calcul();
        });

    
    });
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