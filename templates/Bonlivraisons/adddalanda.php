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
<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'css']); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript">
</script>

<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>

<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('calculvente'); ?>



<?php echo $this->fetch('script'); ?>

<!-- <style>
.dalanda {
    overflow-y: auto !important;
    /* ou overflow-x: auto; */
    overflow-x: hidden !important;
}
</style> -->


<!-- Content Header (Page header) -->
<section class="content-header">
    <?php if ($type == 2) { ?>
        <h1>
            Ajout Devis
            <small>
                <?php echo __(''); ?>
            </small>
        </h1>
    <?php } else { ?>
        <h1>
            Ajout Bon livraison
            <small>
                <?php echo __(''); ?>
            </small>
        </h1>
    <?php }  ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?>
            </a></li>
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
                <?php echo $this->Form->create($bonlivraison, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>


                <div class="box-body ">
                    <div class="row">
                        <div class="row dalanda">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('numero', ['class' => 'form-control', 'readonly' => 'readonly', 'value' => $mm, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-3">

                                    <?php echo $this->Form->control('date', ['class' => 'form-control', 'id' => 'date', "value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>
                                </div>
                                <!-- <div class="col-xs-2">

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
                            </div> -->

                                <!-- <div class="col-xs-6">
                                <?php echo $this->Form->control('client_id', ['id' => 'idclient', 'options' => $clients, 'empty' => 'Veuillez choisir !!', 'label' => 'Clients', 'class' => 'form-control select2 control-label idclient']); ?>
                            </div> -->
                                <div class="col-xs-3">

                                    <?php echo $this->Form->control('depot_id', ['options' => $depots, 'value' => 6, 'id' => 'depot_id', 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Depots', 'class' => 'form-control select2 control-label']); ?>
                                </div>

                                <?php
                                if ($type == 1) { ?>
                                    <div class="col-xs-3">
                                        <?php
                                        echo $this->Form->control('transporteur_id', ['label' => 'Transporteur', 'options' => $transporteurs, 'empty' => 'Veuillez Choisir !!', 'class' => "form-control select2 ", 'id' => 'transporteur_id']);
                                        ?>
                                    </div>

                                    <div class="col-xs-6" id="c1" style="display:none">

                                        <?php echo $this->Form->control('chauffeurname', ['label' => 'Chauffeur', 'required' => 'off']); ?>

                                    </div>

                                    <div class="col-xs-6" id="c2" style="display:none">
                                        <?php echo $this->Form->control('matricule', ['label' => 'Matricule', 'required' => 'off']); ?>

                                    </div>

                                <?php  } ?>

                                <div class="col-xs-12">
                                    <div class="col-xs-2">
                                        <label class="control-label" for="depot-id">Code Client</label>
                                        <select name="client_id" id="idclient" class="form-control select2   clientajout control-label getclientdata  ">
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                            <?php foreach ($clients as $id => $client) { ?>
                                                <option value="<?php echo $client->id; ?>">
                                                    <?php if ($client->Code != null) {
                                                        echo $client->Code;
                                                    }
                                                    //  echo $client->Code 
                                                    ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <label class="control-label" for="depot-id">Nom Client</label>
                                        <select name="client_id1" id="idclient1" class="form-control select2   control-label   getclientdata1">
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                            <?php foreach ($clients as $id => $client) { ?>
                                                <option value="<?php echo $client->id; ?>">
                                                    <?php if ($client->Raison_Sociale != null) {
                                                        echo $client->Raison_Sociale;
                                                    }
                                                    // echo $client->Raison_Sociale 
                                                    ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>



                                    <div class="col-xs-7" id="blocclient" style="display: none;">
                                        <!-- <div class="panel panel-default"> -->
                                        <!-- <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <?php echo __('Solde'); ?>
                                            </h3>
                                            </div> -->
                                        <!-- <div class="panel-body"> -->


                                        <div class="col-xs-12">
                                            <!-- <div class="col-xs-4" hidden>
                                                <label style="color: #c46210;">Plafond :</label>

                                                <?php
                                                echo $this->Form->input('plafond', array('readonly' => 'readonly',  'style' => 'background-color:#FFEFD4; color:#000000 ;', 'label' => 'plafond', 'id' => 'plafond', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                                 </div> -->
                                            <div class="col-xs-3">
                                                <label style="color: #350CEF;">Encours :</label>

                                                <?php
                                                echo $this->Form->input('encours', array('readonly' => 'readonly',  'style' => 'background-color:#a1caf1; color:#000000 ;', 'label' => 'encours', 'id' => 'encours', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </div>
                                            <div class="col-xs-3">
                                                <label style="color: #C11616;"> Solde : </label>

                                                <?php
                                                echo $this->Form->input('solde', array('readonly' => 'readonly', 'style' => 'background-color:#FFD4D4; color:#000000 ;', 'label' => 'solde', 'id' => 'solde', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </div>
                                            <div class="col-xs-3">
                                                <label style="color: #0C9A4A;"> Echanciére : </label>
                                                <?php
                                                echo $this->Form->input('echanciere', array('readonly' => 'readonly', 'label' => false, 'style' => 'background-color:#C6FBC6; color:#000000 ;', 'id' => 'echanciere', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </div>
                                            <div class="col-xs-3" hidden>
                                                <label style="color: #800080;"> Echanciére BL: </label>
                                                <?php
                                                echo $this->Form->input('echancierebl', array('readonly' => 'readonly', 'label' => false, 'style' => 'background-color:#DB9CDB; color:#000000 ;', 'id' => 'echancierebl', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </div>

                                            <!-- </div> -->
                                            <!-- <input type="hidden" id="cl_id" value="<?php echo $clientc->id ?>">
                                                 <input type="hidden" id="typeclient" value="<?php echo $cl; ?>">
                                                 <input type="hidden" id="typeclientidd" value="<?php echo $clientc->typeclient_id ?>">
                                                 <input type="hidden" id="gouvernorat_id" value="<?php echo $clientc->gouvernorat_id ?>"> -->

                                            <!-- </div> -->
                                        </div>
                                    </div>
                                    <div class="col-xs-4" id="divnomprenom" style="display:none">
                                        <?php echo $this->Form->control('nomprenom', ['label' => 'Nom / Prénom', 'required' => 'off', 'class' => 'form-control focus']); ?>

                                    </div>
                                    <div class="col-xs-1" hidden>
                                        <?php echo $this->Form->control('typebl', ['label' => 'Type Bl', 'value' => $type, 'required' => 'off']); ?>

                                    </div>
                                </div>
                                <div class="col-xs-6" hidden>
                                    <div id="com_id" hidden>
                                        <?php echo $this->Form->control('commercial_id', ['options' => $commercials,  'value' => 30, 'id' => 'commercial_id', 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Commercials', 'class' => 'form-control select2 control-label']); ?>
                                    </div>
                                </div>
                                <div class="col-xs-6" style="margin-top: 20px ;" hidden>
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement
                                        comptant:</label>
                                    OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="oui" style="margin-right: 20px" checked>
                                    NON <input type="radio" name="checkpayement" value="0" id="NON" class="oui">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row" hidden>

                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <?php echo $this->Form->control('exotva', ['type' => 'hidden', 'value' => '']); ?>
                            <?php echo $this->Form->control('exofodec', ['type' => 'hidden', 'value' => '']); ?>
                            <?php echo $this->Form->control('nouveau_client', ['type' => 'hidden', 'id' => 'nouv', 'label' => '', 'class' => 'form-control ontrol-label']); ?>

                        </div>
                    </div>



                    <div class="row" hidden>
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                        </div>
                        <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px">
                        <input type="hidden" name="fodecclientexo" id="fodecclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="timbreclientexo" id="timbreclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="tvaclientexo" id="tvaclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="tpeclientexo" id="tpeclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="categclient" id="categclient" class="" style="margin-right: 20px">
                        <input type="hidden" value="<?php echo $clientc->prix ?>" name="formule" id="formule" class="" style="margin-right: 20px">
                    </div>

                    <section class="content-header">
                        <h1 class="box-title">
                            <?php echo __('Articles'); ?>
                        </h1>
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
                                                    <td align="center" style="width: 8%;"><strong>Code</strong> </td>
                                                    <td align="center" style="width: 15%;"><strong>Désignation</strong></td>
                                                    <td align="center" style="width: 6%;"><strong> Stock</strong></td>

                                                    <td align="center" style="width: 6%;"><strong>Qte </strong></td>
                                                    <!-- <td align="center" style="width: 6%;"><strong>ml </strong></td> -->
                                                    <td align="center" style="width: 6%;"><strong>P.U.H.T</strong></td>
                                                    <td align="center" style="width: 8%;"><strong>Total HT</strong></td>
                                                    <td align="center" style="width: 4%;"><strong>Remise</strong></td>
                                                    <td align="center" style="width: 4%;"><strong> TVA </strong></td>
                                                    <!-- <td align="center" style="width: 4%; font: size 5px;"><strong
                                                        style="font: size 5px;">Fodec</strong></td> -->
                                                    <td align="center" style="width: 8%;"><strong> PUTTC </strong></td>
                                                    <td align="center" style="width: 8%;"><strong>Total TTC</strong>
                                                    </td>
                                                    <td hidden align="center" style="width: 8%;"><strong> TTC test</strong>
                                                    </td>
                                                    <td align="center" style="width: 2%;"><strong></strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="tr" style="display: none ">
                                                    <td align="center">

                                                        <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">

                                                        <select table="ligner" index champ="article_id" style="width: 100% !important;" class="form-control select  js-example-responsive articlecode   articleidbl1">
                                                            <option value="" selected="selected">Veuillez
                                                                choisir !!</option>
                                                            <?php foreach ($articles as $id => $article) {
                                                            ?>
                                                                <option value="<?php echo $article->id; ?>">
                                                                    <?php  echo $article->Code  ?>
                                                                    <?php //echo $article->Code . ' ' . $article->Dsignation ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </td>
                                                    <td align="center">


                                                        <select table="ligner" index champ="articledes" style="width: 100% !important;" class="form-control focus js-example-responsive select articlecode2  articleidbl11">
                                                            <option value="" selected="selected">Veuillez
                                                                choisir !!</option>
                                                            <?php foreach ($articles as $id => $article) {
                                                            ?>
                                                                <option value="<?php echo $article->id; ?>">
                                                                    <?php echo $article->Dsignation ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>

                                                    </td>
                                                    <td align="center" table="ligner">
                                                        <input type="number" table="ligner" name="" readonly id="qteStock" champ="qteStock" type="text" class="  form-control" index>
                                                    </td>
                                                    <td align="center" table="ligner">
                                                        <input type="number" table="ligner" name="" id="qte" champ="qte" type="text" class="  calculligne form-control focus" index>
                                                    </td>
                                                    <td align="center" table="ligner" hidden>
                                                        <input table="ligner" champ="ml" type="text" class="form-control calculligne" index>
                                                    </td>
                                                    <td align="center" table="ligner">
                                                        <input table="ligner" type="text" id="prix" champ="prix" class="form-control calculligne" index name=''>
                                                    </td>
                                                    <td align="center" table="ligner">
                                                        <input readonly table="ligner" type="text" champ="ht" class="form-control" index name=''>
                                                    </td>
                                                    <td align="center" table="ligner">
                                                        <input table="ligner" type="text" id="remise" champ="remise" class="form-control calculligne" index name=''>
                                                        <input table="ligner" type="hidden" name="" champ="motanttotal" id='' class="form-control " index>
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
                                                        <input table="ligner" type="text" name="" champ="puttc" class="form-control   ajoutligneeettc findtth  classttc verifttc calculinverse ttcligne" index>

                                                    </td>
                                                    <td>
                                                        <input table="ligner" type="text" name="" readonly champ="ttc" class="form-control    classttc verifttc calculinverse ttcligne" index>

                                                    </td>
                                                    <td hidden>
                                                        <input table="ligner" type="text" name="" champ="ttctest" class="form-control  verifttc calculinverse" index>

                                                    </td>
                                                    <td align="center">
                                                        <i index id="" class="fa fa-times supLignearticle" style="color: #c9302c;font-size: 22px;"></i>
                                                    </td>
                                                </tr>
                                                <input type="hidden" value="-1" id="index" hidden>

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
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('total', ['id' => 'totalht', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('remisee', ['id' => 'totalremise', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total remise', 'name' => 'remisee', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'test remise', 'name' => 'remiseee', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalapres', ['class' => 'form-control', 'id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                                </div>


                                <!-- <div class="col-xs-4" hidden>
                                <?php echo $this->Form->control('totalapres1', ['id' => 'totalhtapres1', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'test après remise', 'name', 'required' => 'off']); ?>
                            </div> -->
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'readonly' => 'readonly', 'label' => 'Total PU ttc', 'name', 'class' => 'form-control verifttctotal ', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'label' => 'Total ttc', 'name', 'class' => 'form-control calculinversetot verifttctotal ', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4" hidden>
                                    <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'readonly' => 'readonly', 'label' => 'test ttc', 'name', 'class' => 'form-control verifttctotal ', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4 ">
                                    <?php echo $this->Form->control('Montant_Regler', ['class' => 'form-control tauxx', 'type' => 'hidden', 'id' => 'Montant_Regler', 'readonly' => 'readonly', 'label' => 'Montant_Regler', 'name' => 'Montant_Regler', 'required' => 'off']); ?>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="col-xs-6">
                        <textarea id="editor-container1" name="note_prive" class="form-control summernote" rows="100" cols="100"
                    style="height: 10000px;">

                      </textarea>
                        <?php //echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
                        </div><br>
                    </div>
                </section>
                <?php if ($type == 1) { ?>
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
                                                                echo $this->Form->control('valeur_id', array('class' => ' form-control sum-input tauxx', 'label' => '', 'index' => 0, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][taux]', 'empty' => 'Veuillez choisir'));
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

                <?php } ?>

                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm verifBonres" id="btnOffreprix" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                </div>
                <?php echo $this->Form->end(); ?>

            </div>



        </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        // $('#idclient1').change(function() {
        //     // Vérifier si un code client est sélectionné
        //     var clientId = $(this).val();
        //     if (clientId !== '') {
        //         // Ajouter une nouvelle ligne
        //         ajoutermk();
        //     }
        // });
        // $(document).ready(function() {
        //     $(".ajouttt").on("click", function() {
        //         // Ancrez la position de défilement au niveau du div dalanda
        //         $('html, body').animate({
        //             scrollTop: $("#dalanda").offset().top
        //         }, 1000);
        //     });
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

        $('.articlecode').change(function(event) {
            var index = $(this).attr('index');

            $("#articledes" + index).val('');
            selectedCodename = $("#article_id" + index).val();
            $("#articledes" + index).select2('destroy');
            $("#articledes" + index).val(selectedCodename);
            $("#articledes" + index).select2();
         
            if (event.keyCode === 9) {
                $('#qte' + index).focus();
            }
        });

        $('.articlecode2').change(function(event) {
            var index = $(this).attr('index');

            $("#article_id" + index).val('');
            selectedCodename = $("#articledes" + index).val();
            $("#article_id" + index).select2('destroy');
            $("#article_id" + index).val(selectedCodename);
            //   $('#articledes' + index).focus();

           $("#article_id" + index).select2();
            if (event.keyCode === 9) {
                $('#qte' + index).focus();
            }
           
        });

    

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
    $(document).ready(function() {

        $("#btnOffreprix").on("mouseover", function() {
            var date = $("#date").val();
            var client = $("#idclient").val();
            var commercial = $("#commercial_id").val();
            var depot = $("#depot_id").val();
            var index = $("#index").val();
            var indice = $("#indexreg").val();

            if (client == null) {
                alert("Choisissez un client SVP !!");
                return;
            }

            // if (commercial == "") {
            //     alert("Choisissez un commercial SVP !!");
            //     return;
            // }

            if (date == "") {
                alert("Choisissez une date SVP !!");
                return;
            }

            if (depot == "") {
                alert("Choisissez un depot SVP !!");
                return;
            }

            if (index == -1) {
                alert("Veuillez ajouter au moins une ligne de commande SVP !!");
                return;
            }

            for (var i = 0; i <= index; i++) {
                var article_id = $('#article_id' + i).val();
                var qte = $('#qte' + i).val();
                var prix = $('#prix' + i).val();
                var remise = $('#remise' + i).val();
                var sup = $('#sup' + i).val();

                if ((article_id == null || article_id == '') && (sup != 1)) {
                    alert('Selectionnez un article SVP !!');
                    return;
                }
                if ((qte == null || qte == '') && (sup != 1)) {
                    alert('Saisissez une quantité SVP !!');
                    return;
                }
                if ((prix == null || prix == '') && (sup != 1)) {
                    alert('Saisissez un prix SVP !!');
                    return;
                }
                // if ((remise == null || remise == '') && (sup != 1)) {
                //     alert('Saisissez une remise SVP !!');
                //     return;
                // }
            }

            // if (indice == -1) {
            //     alert("Veuillez ajouter au moins une ligne de paiement SVP !!");
            //     return;
            // }

            // for (var j = 0; j <= indice; j++) {
            //     var pai = $('#paiement_id' + j).val();
            //     var montant = $('#montant' + j).val();
            //     var caisse = $('#caisse_id' + j).val();

            //     if ((pai == null || pai == '') && (sup != 1)) {
            //         alert('Selectionnez le mode de paiement SVP !!');
            //         return;
            //     }
            //     if ((montant == null || montant == '') && (sup != 1)) {
            //         alert('Saisissez un montant SVP !!');
            //         return;
            //     }
            //     if ((caisse == null || caisse == '') && (sup != 1)) {
            //         alert('Selectionnez la caisse SVP !!');
            //         return;
            //     }
            // }
        });
    });
</script>
<!-- <script>
$(document).ready(function () {
    $("#btnOffreprix").on("mouseover", function () {
        date = $("#date").val(); //alert(date);
        client = $("#idclient").val(); //alert(client);
        commercial = $("#commercial_id").val();
        depot = $("#depot_id").val();
        index = $("#index").val();  //alert(index)
        indice = $("#indexreg").val();//alert(indice)
        ind = $(this).attr("index");
        sup = -1;
        if (client == null) {
            alert("choisir un client SVP !!", function () { });
        } else if (commercial == "") {
            alert("choisir un commercial SVP !!", function () { });
        } else if (date == "") {
            alert("choisir un date SVP !!", function () { });
        } else if (depot == "") {
            alert("choisir un depot SVP !!", function () { });
        } else if (index == -1) {
            alert("Veuillez ajouter une ligne SVP !!");
        } else if (index != -1) {
            for (i = 0; i <= index; i++) {
                article_id = $('#article_id' + i).val();
                qte = $('#qte' + i).val();
                prix = $('#prix' + i).val();
                remise = $('#remise' + i).val();
                sup = $('#sup' + i).val();
                if ((article_id == null || article_id == '') && (sup != 1)) {
                    alert('Selectionnez un article', function () { });
                    return false;
                } else if ((qte == null || qte == '') && (sup != 1)) {
                    alert('saisir une quantité SVP !!', function () { });
                    return false;
                } else if ((prix == null || prix == '') && (sup != 1)) {
                    alert('saisir un prix SVP !!', function () { });
                    return false;
                } else if ((remise == null || remise == '') && (sup != 1)) {
                    alert('saisir une remise SVP !!', function () { });
                    return false;
                }
                supp = $("#sup" + i).val();
                if (supp == 1) {
                    sup += 1;
                }
                if (sup == index) {
                    alert("Veuillez ajouter une ligne SVP !!");
                }
            }
        } if (indice == -1) {
            alert("Veuillez ajouter une ligne SVP !!");
        } else if (indice != -1) {
            for (i = 0; i <= indice; i++) {
                pai = $('#paiement_id' + i).val();
                montant = $('#montant' + i).val();
                caisse = $('#caisse_id' + i).val();
                sup = $('#sup' + i).val();
                if ((pai == null || pai == '') && (sup != 1)) {
                    alert('Selectionnez le mode de paiement SVP !!', function () { });
                    return false;
                } else if ((montant == null || montant == '') && (sup != 1)) {
                    alert('saisir un montant SVP !!', function () { });
                    return false;
                } else if ((caisse == null || caisse == '') && (sup != 1)) {
                    alert('Selectionnez la caisse SVP !!', function () { });
                    return false;
                }
                supp = $("#sup" + i).val();
                if (supp == 1) {
                    sup += 1;
                }
                if (sup == indice) {
                    alert("Veuillez ajouter une ligne SVP !!");
                }
            }
        }

    });
});
</script> -->
<script>
    $(document).ready(function() {

        $(".getclientdata").on("change", function() {
            var client_id = $("#idclient").val();

            var typebl = $("#typebl").val();

            if (client_id == 12 && typebl == 1) {
                ajoutermk('tabligne', 'index');

                $('#divnomprenom').show();
            } else {
                $('#divnomprenom').hide();
            }

            $('#blocclient').hide();
            //ajoutermk();
            if (client_id != 12) {
                ajoutermk('tabligne', 'index');
            }
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
                        console.log(data);
                        // alert(data.solde);
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
            //  alert(client_id);
            var typebl = $("#typebl").val();

            if (client_id == 12 && typebl == 1) {
                ajoutermk('tabligne', 'index');

                $('#divnomprenom').show();
            } else {
                $('#divnomprenom').hide();
            }
            if (client_id != 12) {
                ajoutermk('tabligne', 'index');
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

                        // }
                    },
                });
            }
        });
    });
</script>
<!-- <style>
.select2 {
    text-align: left !important;
}

#client.select2 {
    text-align: left !important;
}
</style> -->
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
        // $(".boutonlivraison").on("keyup", function() {
        //     Calcul();
        // });


    });
</script>
<script>
  $(function () {
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
    $(function() {


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
        $('.client').on('change', function() {
            //alert('hello');
            id = $('#idclient').val();
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
                    //  $('#blocclient').show();
                    page = $('#page').val() || 0;
                    //if(page=="factureclient"){
                    $('#typeclientid').parent().parent().html(data.select);
                    uniform_select('typeclientid');





                }

            })
        });



        $('.client1').on('change', function() {
            //alert('hello');
            id = $('#idclient1').val();
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
                    //  $('#blocclient').show();
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
            idClient = $('#idclient').val();
            depot_id = $('#depot_id').val(); //alert(depot_id)
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


                    Calcul();
                }
            })
        });
    });

    $(function() {
        $('.articleidbl11').on('change', function() {
            // alert("hh");
            index = $(this).attr('index');
            //  alert(index);
            article_id = $('#articledes' + index).val();
            //alert(article_id);
            datecreation = $('#date').val();
            idClient = $('#idclient1').val();
            depot_id = $('#depot_id').val(); //alert(depot_id)
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

                    $('#fodec' + index).val(response['donnearticle']["fodec"]);
                    $('#remise' + index).val(response['donnearticle']["remise"]);
                    if (response['donnearticle']["tva"] != null) {
                        tva = response['donnearticle']["tva"]["valeur"];
                    } else {
                        tva = 0;
                    }
                    $('#tva' + index).val(tva);
                   // $('#qte' + index).focus();
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