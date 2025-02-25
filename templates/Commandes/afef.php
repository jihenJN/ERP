<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<!--<style>
    table tbody, table thead
{
    display: block;
}
table tbody 
{
   overflow: auto;
   height: 250px;
}


</style>-->

<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>
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
                                    <?php echo $this->Form->control('date', ['id' => 'dateintdebut', 'name' => 'dateintdebut', 'label' => 'Date d�but']); ?>
                                </div>

                                <div class="col-xs-2" style="display:none;" id="datef">
                                    <?php echo $this->Form->control('date', ['id' => 'dateintfin', 'name' => 'dateintfin', 'label' => 'Date fin']); ?>
                                </div>

                            </div>
                        </div>


                        <div class="row">

                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>
                                </div>


                                <div class="col-xs-6">

                                    <div class="form-group input select required">

                                        <label class="control-label" for="depot-id">Clients</label>

                                        <select name="client_id" id="client" class="form-control select2 control-label  ">
                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                            <?php foreach ($clients as $id => $client) {
                                            ?>
                                                <option value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>



                                <?php echo $this->Form->control('nouveau_client', ['type' => 'hidden', 'id' => 'nouv', 'label' => '', 'class' => 'form-control ontrol-label']); ?>

                            </div>
                        </div>

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6">
                                    <div>
                                        <?php echo $this->Form->control('commercial_id', ['options' => $commercials, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Commercials', 'class' => 'form-control select2 control-label getcategcom']); ?>
                                    </div>
                                </div>
                                <div class="col-xs-6">

                                    <?php echo $this->Form->control('depot_id', ['options' => $depots, 'value' => 34, 'required' => 'off', 'label' => 'Depots', 'class' => 'form-control select2 control-label']); ?>
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="col-xs-6" style="margin-top: 20px ;">
                                    <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>

                                    OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="calcheck" style="margin-right: 20px">
                                    NON <input type="radio" name="checkpayement" value="0" id="NON" class="calcheck " checked>


                                </div>

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control ']); ?>

                                </div>

                                <div>
                                    <?php
                                    echo $this->Form->input('bl', ['type' => 'hidden', 'label' => '', 'class' => 'form-control']);
                                    ?>
                                </div>

                            </div>
                        </div>

                        <input type="hidden" name="fodecclient" id="fodecclient" class="" style="margin-right: 20px">
                        <input type="hidden" name="fodecclientexo" id="fodecclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="timbreclientexo" id="timbreclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="tvaclientexo" id="tvaclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="tpeclientexo" id="tpeclientexo" class="" style="margin-right: 20px">
                        <input type="hidden" name="categclient" id="categclient" class="" style="margin-right: 20px">
                        <input type="hidden" name="formule" id="formule" class="" style="margin-right: 20px">
                        <input type="hidden" name="escompteSociete" id="escompteSociete" value="<?php echo $escompte ?>" style="margin-right: 20px">
                    </div>


                    <br />
                    <br />

                    <div class="col-md-12" id="blocclient" style="display: none;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo __('Info de client'); ?></h3>
                            </div>
                            <div class="panel-body">

                                <div class="col-xs-6">
                                    <?php echo $this->Form->input('name', array('readonly' => 'readonly', 'label' => 'Raison Sociale', 'id' => 'name', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                    ?>
                                </div>

                                <div class="col-xs-3" style="flex-direction:row; display: flex;margin-top: 30px">
                                    <label>Type Clients : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <div id="typecli"></div>


                                </div>

                                <div class="col-xs-3" style="display: flex;margin-top: 30px;">
                                    <div id="BL"></div>
                                </div>



                                <div class="col-xs-2" style="flex-direction:row;display: flex;margin-top: 40px;width: 20% !important;">
                                    <label>Remise : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                                    <div id="remi"></div>
                                </div>
                                <div class="col-xs-4" style="width:15%;margin-top: 10px;">
                                    <?php
                                    echo $this->Form->input('remiseee', array('readonly' => 'readonly', 'id' => 'remise-val', 'label' => '',  'class' => 'form-control'));
                                    ?>
                                </div>



                                <div class="col-xs-6" style="margin-top:-70px">
                                    <?php
                                    echo $this->Form->input('matriculefiscale', array('label' => 'Matricule Fiscale', 'id' => 'matriculefiscale', 'div' => 'form-group', 'readonly' => 'readonly', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                    ?>
                                </div>

                                <div class="col-xs-2" style="flex-direction:row;display: flex;margin-top: 25px;width: 20% !important;">
                                    <label>Escompte : </label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <div id="com"></div>
                                </div>
                                <div class="col-xs-4" style="width:15%">
                                    <?php
                                    echo $this->Form->input('escomptee', array('readonly' => 'readonly', 'label' => '', 'id' => 'escompte-val', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                    ?>
                                </div>



                                <div class="col-xs-6" style="margin-top:-75px">
                                    <?php
                                    echo $this->Form->input('adresse', array('readonly' => 'readonly', 'label' => 'Adresse', 'id' => 'adresse', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                                    ?>
                                </div>








                                <input type="hidden" id="cl_id" />
                                <input type="hidden" id="typeclient" />
                                <input type="hidden" id="typeclientidd" />
                                <input type="hidden" id="gouvernerat" />

                            </div>
                        </div>
                    </div>




                    <section>
                        <div class="row">
                            <div style=" position: static;">
                                <div class="col-xs-3">
                                    <!--                                                            <h1 class="box-title"><?php echo __('Ligne bon de commande'); ?></h1>-->
                                    <?php echo $this->Form->control('nbligne', ['nbligne' => 'Poids', 'readonly' => 'readonly', 'label' => 'Ligne bon de commande', 'name', 'required' => 'off']); ?>

                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Poids', ['id' => 'Poids', 'value' => '', 'readonly' => 'readonly', 'label' => 'Poids', 'name', 'required' => 'off']); ?>


                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Coeff', ['id' => 'Coeff', 'value' => '', 'readonly' => 'readonly', 'label' => 'NB Palette', 'name', 'required' => 'off']); ?>

                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('pallette', ['id' => 'pallette', 'value' => '', 'readonly' => 'readonly', 'label' => 'Poids Par palette', 'name', 'required' => 'off']); ?>

                                </div>

                            </div>
                        </div>
                    </section>

                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <a class="btn btn-primary ajouterligne_w btn verifclient  btnajoutlignecommande" table="addtable" index="index" style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter ligne
                                    </a>

                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="addtable">



                                            <thead>
                                                <tr width:20px>


                                                    <td align="center" style="width: 12%; font-size: 12px;"><strong>Article</strong></td>
                                                    <!-- <td align="center" style="width: 4%; font-size: 12px;"><strong>Code article</strong></td> -->

                                                    <td align="center" style="width: 4%;font-size: 12px;"><strong>Qte stock </strong></td>
                                                    <td align="center" style="width: 6%;font-size: 12px;"><strong>Qte </strong></td>
                                                    <td align="center" style="width: 6%;font-size: 12px;"><strong>P.U.H.T</strong></td>
                                                    <td align="center" style="width: 7%;font-size: 12px;color:#FF0000" id="prixverif"><strong>Prix verif</strong></td>



                                                    <td align="center" style="width:3%;font-size: 12px;"><strong>R/Fac</strong></td>
                                                    <td align="center" style="width:3%;font-size: 12px;"><strong>R/Pro </strong></td>


                                                    <td align="center" style="width: 3%;font-size: 12px;"><strong> TVA </strong></td>
                                                    <td align="center" style="width: 3%; font-size: 12px;"><strong style="font: size 5px;">Fodec</strong></td>


                                                    <!-- <td align="center" style="width: 4%;font-size: 12px;"><strong> DC </strong></td> -->
                                                    <td align="center" style="width: 4%;font-size: 12px;"><strong> TPE </strong></td>

                                                    <td align="center" style="width:2%;"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="tr afef" style="display: none;">
                                                    <td align="center" champ='tdart'>
                                                        <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control ">
                                                        <select table="ligner" index champ="article_id" class="js-example-responsive   articleidbl1">
                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                            <?php foreach ($articles as $id => $article) {
                                                            ?>
                                                                <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                            <?php } ?>
                                                        </select>

                                                    </td>
                                                    <td align="center" champ='td' style="display: none">
                                                        <input table="ligner" champ="articlee" type="text" class="form-control " index>
                                                    </td>


                                                    <!-- <td align="center" table="ligner">
                                                        <input table="ligner" champ="codearticle" type="text" class="form-control " index readonly>
                                                    </td> -->




                                                    <td align="center" table="ligner" champ="a">
                                                        <input table="ligner" champ="qteStock" type="text" class="form-control getstock getprixht" index readonly>
                                                        <input table="ligner" champ="alertart" type="hidden" index>
                                                        <input table="ligner" type="hidden" name="" champ="categorieclient" id='' class="form-control " index>

                                                    </td>

                                                    <td align="center" table="ligner" champ="b">
                                                        <input type="hidden" table="ligner" name="" id="" champ="pourcentageescompte" type="text" class="calcullignecommande form-control" index>


                                                        <input type="text" table="ligner" name="" id="" champ="escompte" class="calcullignecommande form-control" index>

                                                        <input table="ligner" name="" id="" champ="qte" type="text" class=" form-control  pourcentescompte calculqte focus" index>
                                                        <input table="ligner" name="" id="" champ="poids" type="hidden" class=" form-control  pourcentescompte calculqte" index>


                                                    </td>


                                                    <td align="center" table="ligner" champ="c">
                                                        <input readonly table="ligner" type="text" champ="prix" class="form-control" index name=''>
                                                    </td>


                                                    <td align="center" table="ligner" champ="d">
                                                        <input style="color:#FF0000" readonly table="ligner" type="number" champ="prixEntre" class="form-control prixx" index name=''>
                                                    </td>



                                                    <td align="center" table="ligner" champ="e">
                                                        <input readonly table="ligner" type="hidden" champ="totremiseclient" class="form-control" index name=''>

                                                        <input readonly table="ligner" type="text" champ="remiseclient" class="form-control" index name=''>
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







                                                    <td champ="h">
                                                        <input table="ligner" champ="fodec" type="text" class="form-control " index readonly>
                                                        <?php echo $this->Form->control('fodeccommandeclient', ['type' => 'text', 'table' => 'ligner', 'champ' => 'fodeccommandeclient', 'id' => 'fodeccommandeclient', 'index', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>

                                                    </td>





                                                    <!-- <td align="center" table="ligner">
                                                        <input table="ligner" type="text" name="" champ="dc" class="form-control" index>



                                                    </td> -->


                                                    <td champ="i">
                                                        <input table="ligner" type="text" name="" champ="tpe" class="form-control  focuss" index>

                                                        <?php echo $this->Form->control('tpecommandeclient', ['type' => 'hidden', 'table' => 'ligner', 'champ' => 'tpecommandeclient', 'id' => 'tpecommandeclient', 'index', 'readonly' => 'readonly', 'label' => '', 'name' => 'tpe', 'required' => 'off']); ?>

                                                        <input table="ligner" type="hidden" name="" champ="tpeh" class="form-control" index>

                                                        <input table="ligner" type="hidden" name="" champ="remiseligne" class="form-control" index>


                                                    </td>

                                                    <td align="center" table="ligner" champ="j">
                                                        <i id="" class="fa fa-times supLigne0ch" style="color: #c9302c;font-size: 22px;" table="ligner" name=""></i>
                                                        <input type='hidden' table="ligner" champ="suptest" class="form-control" index name='' id="">
                                                    </td>
                                                </tr>
                                                <input type="hidden" value="-1" id="index">
                                            </tbody>

                                        </table>
                                        <br />
                                        <a class="btn btn-primary ajouterligne_w btn  btnajoutlignecommande" table="addtable" index="index" style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                            <i class="fa fa-plus-circle "></i> Ajouter ligne</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>







                </div>


                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="row">
                            <div style=" position: static;">
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('brut', ['id' => 'brutHT', 'value' => '', 'readonly' => 'readonly', 'label' => 'Brut HT', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly', 'value' => '', 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('valeurescompte', ['id' => 'valeurescompte', 'type' => 'hidden', 'value' => '', 'label' => 'valeurescompte', 'name']); ?>

                                    <?php echo $this->Form->control('escompte', ['id' => 'escompte', 'readonly' => 'readonly', 'value' => '', 'label' => 'Escompte', 'name', 'required' => 'off']); ?>
                                </div>



                            </div>
                        </div>
                        <div class="row">
                            <div style=" position: static;">

                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('total', ['id' => 'total', 'readonly' => 'readonly', 'label' => 'Net HT', 'name', 'required' => 'off', 'value' => '']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('fod', ['id' => 'fod', 'readonly' => 'readonly', 'label' => 'Fodec', 'name', 'required' => 'off']); ?>
                                </div>

                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('tpecommande', ['id' => 'tpecommande', 'readonly' => 'readonly', 'label' => 'Tpe', 'name', 'required' => 'off']); ?>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div style=" position: static;">
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('base', ['id' => 'baseHT', 'readonly' => 'readonly', 'label' => 'Base HT', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('tvacommande', ['id' => 'tvacommande', 'readonly' => 'readonly', 'label' => 'TVA', 'name', 'required' => 'off']); ?>
                                </div>
                                <div class="col-xs-4">
                                    <?php echo $this->Form->control('totalttc', ['value' => '', 'id' => 'totalttccommande', 'readonly' => 'readonly', 'label' => 'TTC', 'name', 'required' => 'off']); ?>
                                </div>



                            </div>
                        </div>
                        <div class="row">

                            <div style=" position: static;">
                                <div class="col-xs-4 pull-right">
                                    <?php echo $this->Form->control('netapayer', ['id' => 'netapayer', 'readonly' => 'readonly', 'label' => 'Net à payé', 'name', 'required' => 'off']); ?>
                                </div>


                            </div>


                        </div>





                        <div class="col-xs-5">
                            <?php echo $this->Form->control('remise', ['type' => 'hidden', 'id' => 'remise', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                        </div>

                        <div class="col-xs-5">


                            <?php echo $this->Form->control('comptant', ['type' => 'hidden', 'id' => 'comptant', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>




                            <?php echo $this->Form->control('fodeccommande', ['type' => 'hidden', 'id' => 'fodeccommande', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>

                            <?php echo $this->Form->control('basetva', ['type' => 'hidden', 'id' => 'basetva', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>


                        </div>





                    </div>



                </section>



                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm  chauff verifqte" id="boutonCommande" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                </div>


            </div>



        </div>
    </div>
</section>
<?php echo $this->Form->end(); ?>



<!-- Ajout ajax recup?ration select -->
<script type="text/javascript">
    $(function() {

        $('.verifclient').on('mousemove', function() {

           // alert('hechem')
           
             styleValue = $('#blocclient').attr('style');
            
             if (styleValue == 'display: none;' ){
                alert('Verifier le client choisie SVP')
             }
  

        });


        $('.getcategcom').on('change', function() {
            id = $('#commercial-id').val();
            //// alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getcategorie']) ?>",
                dataType: "json",
                data: {
                    idfam: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    $('#categclient').val(data.valeurcategorie);
                }
            })
        });



        $('.getstock').on('click', function() {
            index = $(this).attr('index'); //alert(index)
            article_id = $('#article_id' + index).val(); //alert(article_id)
            idClient = $('#client').val(); //alert(idClient);//alert(
            depot_id = $('#depot-id').val(); //alert(depot_id)
            date = $('#date').val();

            ms = "";

            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getquantite']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    idadepot: depot_id,
                    idClient: idClient,
                    date: date,

                },
                success: function(data, status, settings) {

                    stock = data.inv;
                    qtecommande = data.qtecommande;
                    if (stock == qtecommande) {
                        qte = qtecommande;
                    } else {
                        qte = qtecommande;
                    }
                    seuil = data.alert;
                    ms = (ms) + 'la quantité en stock est ' + stock + "\n";
                    ms = (ms) + 'la quantité commandé est ' + qte + "\n";
                    ms = (ms) + 'la quantité seuil est ' + seuil;
                    alert(ms)



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
                    // $('#categclient').val(data.valeurcategorie);

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
                            a = '<a onclick="myFunction()">' + nom + '</a>'
                            $('#typecli').html(a);

                        }
                    } else if (data.typeclient == true) {
                        if (valgs != 0) {
                            a = '<a onClick=\'openWindow(1000, 1000,"http://codifaerp.isofterp.com/demo/gspromoarticles/grandsurface/' + valgs + '")\'>' + nom + '</a>'
                            $('#typecli').html(a);
                        } else {
                            a = '<a  onclick="myFunction()" >' + nom + '</a>'
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
            date = $('#date').val();
            valeurcateg = $('#categclient').val();

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
                    date: date,

                },
                success: function(response) {
                    // alert(response);
                    //    alert(response['ligne']["Code"]);
                    qtestockx = response['qtestockx'];
                    $('#alertart' + index).val(response['alert']);

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
                    $('#tpeh' + index).val(response['donnearticle']["TXTPE"]);

                    $('#fodec' + index).val(response['donnearticle']["fodec"]);
                    // alert(response['ligne']["fodec"]);
                    // $('#ttc' + index).val(response['ligne']["PTTC"]);
                    //$('#exofodec').val(response['ligne']["FODEC"]);
                    $('#prixht' + index).val(response['donnearticle']["PHT"]);
                    $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);



                    $('#qte' + index).focus();
                    $('#categorieclient' + index).val(valeurcateg);

                }
            })
        });
    });






    $(function() {
        //calcheck
        //            $('.clickclient').on('onchange', function () {
        //       
        //calculbc(1);
        //
        //    })
        $('.calcheck').on('click', function() {

            calculbccheck();

        })
        $('.calculqte').on('blur', function() {
            //         index = $(this).attr('index');
            //            i = $(this).attr('index');
            //            // alert(index);
            //             articleid = $('#article_id' + index).val();
            //            qte = $('#qte' + index).val();
            //                  ind = Number($('#index').val());

        })
        $('.pourcentescompte').on('blur', function() {

            index = $(this).attr('index'); //alert(index)
            indexattr = $(this).attr('index');
            ind = Number($('#index').val());
            $('#remisearticle' + index).val(0);
            if (ind != index) {
                indexpre = Number(index) + 1;
                // alert(indexpre+"indexpre");
                if ($('#articlee' + indexpre).val() != "") {
                    // alert('afefe')
                    $('#sup' + indexpre).val('1');
                    $('#trart' + indexpre).hide();
                    //         $(this).parent().parent().hide();
                }
            }
            i = $(this).attr('index');
            // alert(index);

            qte = $('#qte' + index).val();
            formule = $('#formule').val();

            /// alert(formule);

            //alert(qte);
            test = 0;
            if (qte.match(/^(?:[1-9]\d*|0)?(?:\.\d+)?$/)) {
                test = 1;
            }
            if (test == 0) {
                $("#qte" + index).val("");
            }

            //alert(depot_id);
            //            $.ajax({
            //                method: "GET",
            //                type: "GET",
            //                async: false,
            //
            //                url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
            //                dataType: "JSON",
            //                data: {
            //                    qte: qte,
            //
            //                },
            //                success: function(response) {
            //                    // alert(response);die;
            //                    //  alert(response.tab[0]['qtemax']);
            //                    numbers = response.tab;

            //alert(numbers);



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
            totbrutt = 0;
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




            escompte = 0;
            nb = 0;
            indext = $('#index').val(); //alert(indext)
            for (jj = 0; jj <= indext; jj++) {
                //  alert(j);
                sup = $('#sup' + jj).val(); //  alert(sup);



                if (Number(sup) != 1) {
                    nb++;
                    tpe = $('#tpe' + jj).val() || 0;
                    tva = Number($('#tva' + jj).val()) || 0; // alert(tva);
                    fodec = $('#fodec' + jj).val() || 0; //alert(tpe);        
                    fodecclientexo = $('#fodecclientexo').val();
                    tpeclientexo = $('#tpeclientexo').val();
                    tvaclientexo = $('#tvaclientexo').val();
                    qte = ($('#qte' + jj).val()) * 1; //alert(qte);
                    poids = ($('#poids' + jj).val()) * 1; //alert(qte);
                    totalpoids = Number(qte) * Number(poids);
                    totalpoidsfin += Number(totalpoids);
                    prix = $('#prix' + jj).val(); // alert(prix);
                    qteStock = ($('#qteStock' + jj).val()) * 1; //alert(qteStock);

                    remisearticle = $('#remisearticle' + jj).val() || 0; //alert(remisearticle);


                    netbrut = (Number(qte) * Number(prix)); // alert(netbrut+"montcal");
                    //   alert(netbrut);
                    totalremise = Number(remisearticle); //alert(totalremise+'totalremise')
                    montremise = Number(netbrut) * Number(totalremise) / 100;
                    montcal = Number(netbrut) - Number(montremise); //alert(montcal+"montcal")
                    //alert(netbrut)
                    totbrutt += Number(netbrut); //alert(totbrut+'totbrut')//
                    //alert(totbrutt+'totbrutss')
                    getremsie(totbrutt, indexattr);

                }
            }


           // calculbc(indext);
            //}
            //})
        });
    });


    function pourcentagesup(i) {

        ind = Number($('#index').val());
        i = ind;
        $('#remisearticle' + index).val(0);
        //            if(ind!=index){
        //                indexpre = Number(index)+1;
        //          // alert(indexpre+"indexpre");
        //                if( $('#articlee' + indexpre).val()!=""){
        //                    $('#sup' + indexpre).val('1');
        //         $(this).parent().parent().hide();
        //        }}

        // alert(index);
        articleid = $('#article_id' + index).val();
        qte = $('#qte' + index).val();

        //alert(article_id);

        //alert(qte);
        test = 0;
        if (qte.match(/^(?:[1-9]\d*|0)?(?:\.\d+)?$/)) {
            test = 1;
        }
        if (test == 0) {
            $("#qte" + index).val("");
        }

        //alert(depot_id);
        $.ajax({
            method: "GET",
            type: "GET",
            async: false,

            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
            dataType: "JSON",
            data: {
                qte: qte,

            },
            success: function(response) {
                // alert(response);die;
                //  alert(response.tab[0]['qtemax']);
                numbers = response.tab;

                //alert(numbers);



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
                //-------------------------------


                qteStock = ($('#qteStock' + i).val()) * 1; //alert(qteStock);
                qte = ($('#qte' + i).val()) * 1; //alert(qte);
                prix = $('#prix' + i).val(); //alert(prix);
                remisearticle = $('#remisearticle' + i).val() || 0; //alert(remisearticle);
                // remiseclient = $('#remiseclient' + i).val() || 0;



                /* if (qte > qteStock) {*/
                // alert("veuillez enter quantit? inf?rieur a la qunatit? de stock !!");
                //   $('#qte' + i).val(0);

                //    }
                //  else {

                netbrut = (Number(qte) * Number(prix)); //alert(netbrut);
                //   alert(netbrut);
                totalremise = Number(remisearticle);
                montremise = netbrut * totalremise / 100;
                montcal = netbrut - montremise; //alert(montcal);

                getremsie(montcal, index);
                remiseclient = $('#remiseclient' + i).val() || 0; //alert(remiseclient)

                montremiseclient = montcal * remiseclient / 100;
                totremiseclient = Number(montremiseclient) + Number(montremise);
                //    alert(totremiseclient);
                $('#totremiseclient' + i).val(Number(totremiseclient)); // alert(motanttotal);
                motanttotal = montcal - montremiseclient; //alert(motanttotal+'motanttotalremise');
                //motanttotal = netbrut - remisefinale; //alert(netht);
                //   ttc = motanttotal * 1.19 / qte;

                $('#motanttotal' + i).val(Number(motanttotal)); // alert(motanttotal);



                $('#comptant').val(Number(motanttotal).toFixed(3));
                ttc = motanttotal * (1 + tva) / qte;
                $('#ttc' + i).val(Number(ttc));




                $('#remiseligne' + i).val(Number(totalremise));



                $('#monatantlignetva' + i).val(Number(montanttva));


                //  alert($('#monatantlignetva' + i).val());

                $('#totalttc' + i).val(Number(totalttc));



                escompte = 0;

                index = $('#index').val();
                for (j = 0; j <= index; j++) {
                    // alert(j);
                    sup = $('#sup' + j).val(); // alert(sup);



                    if (Number(sup) != 1) {
                        tpe = $('#tpe' + j).val() || 0;
                        tva = Number($('#tva' + j).val()) || 0; // alert(tva);
                        fodec = $('#fodec' + j).val() || 0; //alert(tpe);        
                        fodecclientexo = $('#fodecclientexo').val();
                        tpeclientexo = $('#tpeclientexo').val();
                        tvaclientexo = $('#tvaclientexo').val();
                        qte = ($('#qte' + j).val()) * 1; //alert(qte);
                        //alert(qte);
                        prix = $('#prix' + j).val(); // alert(prix);
                        totbrut += Number(prix) * Number(qte); //alert(totbrut+'totbrut')

                        totrem = totrem + Number(totremiseclient); //alert(totrem+'totrem');

                        totaltotal = Number($('#motanttotal' + j).val()); //alert(Number($('#motanttotal' + j).val())+'total')

                        total = Number(total) + Number(totaltotal); //alert(Number($('#motanttotal' + j).val())+'total')

                        totremiseclientt = ($('#totremiseclient' + j).val());
                        totrmt += Number(totremiseclientt);
                        remisecommande += Number($('#remiseligne' + j).val()); //alert(remisecommande+'remisecommande')
                        //pourcentageescompte
                        if ($('#OUI').is(':checked')) {
                            // alert(total+"total")
                            // alert(totaltotal+'totaltotal')
                            getescompte(totaltotal, j);
                            valeurescompte = $('#pourcentageescompte' + j).val(); //alert(valeurescompte+"valeurescompte");
                            // alert(valeurescompte+'valeurescompte')
                            montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100; //alert(montantescompte);
                            totalmontantescompteligne += Number(montantescompteligne);
                            montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                            totalmontantescomptelignee += Number(montantescomptelignee); //alert(totalmontantescomptelignee+"totalmontantescomptelignee")

                            montantescompte += Number(montantescompteligne);
                            // alert(montantescompteligne+"montantescompteligne")
                            $('#escompte' + j).val(Number(montantescomptelignee).toFixed(3));
                            //totalescom=Number(total)- Number(montantescompte);//alert(Number($('#motanttotal' + j).val())+'total')

                            //  $('#valeurescompte').val(montantescompte);

                        }

                        //alert(total);
                        else {
                            valeurescompte = 0; //alert(valeurescompte+"valeurescompte");
                            montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100; //alert(montantescompte);
                            totalmontantescompteligne += Number(montantescompteligne);
                            montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                            totalmontantescomptelignee += Number(montantescomptelignee); //alert(totalmontantescomptelignee+"totalmontantescomptelignee")
                            montantescompte += Number(montantescompteligne); //alert(montantescompte+"montantescompte")
                            $('#escompte' + j).val(Number(montantescomptelignee).toFixed(3));
                        }
                        prixavecformulclient(prix, index, formule, fodec, tva, tpe, valeurescompte, remiseclient, remisearticle)
                        if (fodec != 0 && fodecclientexo == '') {
                            //   alert("cc");
                            montantfodec = montantescomptelignee * fodec / 100;
                            fod += montantfodec;

                            motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                            totalmotanttotal += Number(motanttotal);
                            $('#fodeccommandeclient' + i).val(Number(montantfodec));
                        } else {
                            montantfodec = 0;
                            fod += montantfodec;
                            $('#fodeccommandeclient' + i).val(Number(montantfodec));
                            motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                            totalmotanttotal += Number(motanttotal);
                        }

                        if (tpe != 0 && tpeclientexo == '') {
                            montanttpe = motanttotal * tpe / 100; //alert(montanttpe);
                            motanttotaltpe += montanttpe;
                            $('#tpecommandeclient' + i).val(Number(montanttpe));
                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                            totaltpecommandeclient += Number(tpecommandeclient);

                        } else {
                            montanttpe = 0 //alert(montanttpe);
                            motanttotaltpe += montanttpe;
                            $('#tpecommandeclient' + i).val(Number(montanttpe));
                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                            totaltpecommandeclient += Number(tpecommandeclient);
                        }







                        if (tva != 0 && tvaclientexo == '') {
                            //   alert("hh");
                            // alert("tva recup?r? apr?s if");
                            // alert(netht);

                            montanttva = Number(tpecommandeclient) * tva / 100; //alert(montanttva);
                            tvacomd += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                            $('#monatantlignetva' + i).val(Number(montanttva));
                            totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                            $('#totalttc' + i).val(Number(totalttc));
                            totalCommandettc += Number(totalttc);

                        } else {
                            montanttva = 0;
                            tvacomd += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                            $('#monatantlignetva' + i).val(Number(montanttva));
                            totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                            totalCommandettc += Number(totalttc);
                            $('#totalttc' + i).val(Number(totalttc));
                        }








                        //   escompte += Number($('#escompte' + j).val());


                        //$('#ttc' + i).val(Number(ttc));
                    }
                }




                maxpourcentage = response.tab[numbers.length - 1]['pourcentage'];
                maxqte = response.tab[numbers.length - 1]['qtemax'];




                //                    brutHT=totalescom+remisecommande;
                //             
                //                    baseHT=totalescom+fod+tpecmd;
                // ttcfinal=baseHT+tvacomd;

                $('#netapayer').val(Number(totalCommandettc).toFixed(3));
                $('#baseHT').val(Number(totaltpecommandeclient).toFixed(3));
                $('#brutHT').val(Number(totbrut).toFixed(3));


                $('#escompte').val(Number(totalmontantescompteligne).toFixed(3));
                //-----------------------------------------
                //alert(total+"total")
                //alert(total+'total');
                $('#totalremise').val(Number(totrmt).toFixed(3));
                $('#total').val(Number(totalmontantescomptelignee).toFixed(3));
                $('#totalttccommande').val(Number(totalCommandettc).toFixed(3));
                $('#fod').val(Number(fod).toFixed(3));
                $('#tpecommande').val(Number(motanttotaltpe).toFixed(3));
                $('#tvacommande').val(Number(tvacomd).toFixed(3));


            }
        })
    };


    function prixavecformulclient(prix, i, formule, fodec, tva, tpe, escompte, remiseclient, remisearticle) {
        //alert(formule)
        //alert(param);
        //      alert(prix)
        //      alert(i)
        //      alert(formule)
        //     alert(fodec+"fodec")
        //      alert(tva)
        //      alert(tpe)
        //      alert(escompte)
        //      alert(remiseclient)
        //      alert(remisearticle)



        //      index = $(this).attr('index');
        //            i = $(this).attr('index');
        //            formule = 0;
        //    
        //            formule = $('#formule').val();

        if (formule == 'PHT+Fodec') {

            formule = 1;
        }
        if (formule == 'PHT') {

            formule = 2;
        }
        if (formule == '(PHT-Remise)+Fodec') {

            formule = 3;
        }
        if (formule == '((PHT-Remise)-Escompte)+Fodec') {

            formule = 4;
        }

        //   prixEntre = Number($('#prixEntre' + i).val());
        //            prix = Number($('#prix' + i).val());
        //            fodec = Number($('#fodec' + i).val());
        //            tva = Number($('#tva' + i).val());
        //            tpe = Number($('#tpe' + i).val());
        //            escompte = Number($('#escompteSociete').val());
        //            remiseclient = Number($('#remiseclient' + i).val());
        //            remisearticle = Number($('#remisearticle' + i).val());
        montantfodec = 0;
        montanttpe = 0;
        montanttva = 0;
        montantescompte = 0;
        montantremisearticle = 0;
        montantremiseclient = 0;
        // alert(remiseclient)
        // alert(remisearticle)
        trem = Number(remiseclient) + Number(remisearticle); //alert(trem+"trem")
        //alert(prix);
        if (fodec != 0) {
            //alert(fodec);
            montantfodec = Number(prix) * Number(fodec) / 100;
            //  alert(montantfodec);
        }
        if (tpe != 0) {
            //  alert(fodec);
            montanttpe = Number(prix) * Number(tpe) / 100;
        }
        if (tva != 0) {
            //  alert(fodec);
            montanttva = Number(prix) * Number(tva) / 100;
        }

        if (escompte != 0 && $('#OUI').is(':checked')) {
            //  alert(fodec);
            montantescompte = Number(prix) * Number(escompte) / 100;
        }


        if (remiseclient != 0) {

            ///   alert(remiseclient+'remiseclient');
            montantremiseclient = Number(prix) * Number(remiseclient) / 100;
            // alert(montantremiseclient+'montantremiseclient');
        }


        if (remisearticle != 0) {
            // alert(remisearticle);
            montantremisearticle = Number(prix) * Number(remisearticle) / 100;
            //    alert(montantremisearticle);
        }

        // formule PHT+Fodec
        if (formule == 1) {

            total = Number(prix) + Number(montantfodec);


            $('#prixEntre' + i).val(Number(total).toFixed(3))

        }


        // formule PHT
        if (formule == 2) {


            $('#prixEntre' + i).val(Number(prix).toFixed(3))

        }
        ///  alert(formule)
        // (PHT-Escompte)+Fodec
        if (formule == 3) { //alert(trem)
            tmnt = Number(prix) - ((Number(prix) * Number(trem)) / 100);
            mntfod = Number(tmnt) + ((Number(tmnt) * Number(fodec)) / 100);
            totall = Number(mntfod);

            //   total = (Number(prix) - ((Number(remisearticle) + Number(montantremiseclient)))) +Number(montantfodec);

            $('#prixEntre' + i).val(Number(totall).toFixed(3))

        }
        // alert(escompte)

        // ((PHT-Remise)-Escompte)+Fodec
        // alert(escompte);
        if (formule == 4) {

            tmnt = Number(prix) - ((Number(prix) * Number(trem)) / 100); //alert(escompte+"escompte");

            montantescompte = Number(tmnt) - (Number(tmnt) * Number(escompte) / 100); //alert(montantescompte+'montantescompte')

            mntfod = Number(montantescompte) + ((Number(montantescompte) * Number(fodec)) / 100); //alert(mntfod+"mntfod")
            totall = Number(mntfod);
            //                alert(Number(prix)+"prix");
            //                   alert(Number(montantremisearticle)+"montantremisearticle");
            //                    alert(Number(montantremiseclient)+"montantremiseclient");
            //                     alert(Number(montantescompte)+"montantescompte");
            //                     alert(Number(montantfodec)+"montantfodec")
            //                     alert(Number(prix)+"prix"+Number(montantremisearticle)+"montantremisearticle"+Number(montantescompte)+"montantescompte"+Number(montantfodec)+"montantfodec")
            //                // alert(Number(montantremisearticle + montantremiseclient));
            //                total = (Number(prix)- (Number(montantremisearticle) + Number(montantremiseclient)) - Number(montantescompte) ) + Number(montantfodec);
            //            
            $('#prixEntre' + i).val(Number(totall).toFixed(3))

        }



    }


    function getcategorie(param) {
        //alert(param);

        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getcategorie']) ?>",
            dataType: "json",
            data: {
                idfam: id,

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {





                $('#categclient').val(data.valeurcategorie);








            }

        })



    }

    function getescompte(montant) {
       
        id = $('#cl_id').val(); //alert(id+'idclient');
        //  alert(montant+'montant');
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescomptee']) ?>",
            dataType: "json",
            async: false,
            data: {
                idfam: id,
                montant: montant
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {

                rem = Number(data.escompte['0']['v']) || 0;
       
                $('#valeurescompte').val(rem);
            }
        })
    }

    function getremsie(montant, indexattr) {
        index = Number($('#index').val());
        id = $('#cl_id').val();

        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getsremise']) ?>",
            dataType: "json",
            async: false,
            data: {
                idfam: id,
                montant: montant

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {

                console.log(data);
                rem = Number(data.remise['0']['v']) || 0;
                // alert(rem+'ret');
                // alert(index+"getremsie")

                for (k = 0; k <= index; k++) {
                    // alert(i)
                    // alert(rem+'remise')
                    $('#remiseclient' + k).val(rem);
                    // 
                }
                //  alert(index+'calculbcr')
                calculbcr(indexattr);
            }

        })


    }

    function calculbcr(indexattr) {
        //alert(indexattr+'indexattr')
        ind = Number($('#index').val());
        i = ind;
        qte = $('#qte' + indexattr).val();
        formule = $('#formule').val();
        //   $('#remisearticle'+index).val(0);
        //            if(ind!=index){
        //                indexpre = Number(index)+1;
        //          // alert(indexpre+"indexpre");
        //                if( $('#articlee' + indexpre).val()!=""){
        //                    $('#sup' + indexpre).val('1');
        //         $(this).parent().parent().hide();
        //        }}

        // alert(index);
        articleid = $('#article_id' + index).val(); //alert(articleid)
        qte = $('#qte' + index).val();

        //alert(article_id);

        //alert(qte);
        test = 0;
        //if (qte.match(/^(?:[1-9]\d*|0)?(?:\.\d+)?$/)) { 
        //    test = 1;
        //}
        //if (test == 0) {
        //    $("#qte"+index).val("");
        //}

        //alert(depot_id);
        //        $.ajax({
        //            method: "GET",
        //            type: "GET",
        //            async: false,
        //
        //            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
        //            dataType: "JSON",
        //            data: {
        //                qte: qte,
        //
        //            },
        //            success: function(response) {
        //                // alert(response);die;
        //                //  alert(response.tab[0]['qtemax']);
        //                numbers = response.tab;
        //
        //                //alert(numbers);



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




        escompte = 0;
        nb = 0;
        index = $('#index').val();
        for (t = 0; t <= index; t++) {
            // alert(j);
            sup = $('#sup' + t).val(); // alert(sup);



            if (Number(sup) != 1) {
                nb++;
                tpe = $('#tpe' + t).val() || 0;
                tva = Number($('#tva' + t).val()) || 0; // alert(tva);
                fodec = $('#fodec' + t).val() || 0; //alert(tpe);        
                fodecclientexo = $('#fodecclientexo').val();
                tpeclientexo = $('#tpeclientexo').val();
                tvaclientexo = $('#tvaclientexo').val();
                qte = ($('#qte' + t).val()) * 1; //alert(qte);
                poids = ($('#poids' + t).val()) * 1; //alert(qte);
                totalpoids = Number(qte) * Number(poids);
                totalpoidsfin += Number(totalpoids);
                prix = $('#prix' + t).val(); // alert(prix);
                qteStock = ($('#qteStock' + t).val()) * 1; //alert(qteStock);

                remisearticle = $('#remisearticle' + t).val() || 0; //alert(remisearticle);


                netbrut = (Number(qte) * Number(prix)); // alert(netbrut+"montcal");
                //   alert(netbrut);
                totalremise = Number(remisearticle); //alert(totalremise+'totalremise')
                montremise = Number(netbrut) * Number(totalremise) / 100;
                montcal = Number(netbrut) - Number(montremise); //alert(montcal+"montcal")
                totbrut += Number(prix) * Number(qte); //alert(totbrut+'totbrut')
                //getremsie(totbrut) ;
                remiseclient = $('#remiseclient' + t).val() || 0; //alert(remiseclient+"remiseclient")

                montremiseclient = Number(netbrut) * (Number(remiseclient) + Number(remisearticle)) / 100; //alert(montremiseclient)
                totremiseclient = Number(montremiseclient); //alert(totremiseclient)
                //    alert(totremiseclient);
                $('#totremiseclient' + t).val(Number(totremiseclient)); // alert(motanttotal);
                motanttotal = Number(netbrut) - Number(montremiseclient); //alert(motanttotal+'motanttotalremise');


                $('#motanttotal' + t).val(Number(motanttotal)); // alert(motanttotal);










                totrem = Number(totrem) + Number(totremiseclient); //alert(totrem+'totrem');

                totaltotal = Number($('#motanttotal' + t).val()); //alert(Number($('#motanttotal' + j).val())+'total')

                total = Number(total) + Number(totaltotal); //alert(Number($('#motanttotal' + j).val())+'total')

                totremiseclientt = ($('#totremiseclient' + t).val());
                totrmt += Number(totremiseclientt);
                remisecommande += Number($('#remiseligne' + t).val()); //alert(remisecommande+'remisecommande')
                //pourcentageescompte

                if ($('#OUI').is(':checked')) {
                   //alert(total+'totam')
                  //alert(total);
                    getescompte(total);
                    valeurescompte = $('#valeurescompte').val(); //alert(valeurescompte+"valeurescompte");
                    montantescompte = Number(total) * Number(valeurescompte) / 100; //alert(montantescompte);
                    //  $('#valeurescompte').val(montantescompte);
                    //  alert(montantescompte+"esc");
                    //  $('#escompte').val(Number(montantescompte).toFixed(3));
                    montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100;//alert(montantescompteligne+"montantescompteligne");
                    totalmontantescompteligne += Number(montantescompteligne);
                    montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                    totalmontantescomptelignee += Number(montantescomptelignee);// alert(totalmontantescomptelignee+"totalmontantescomptelignee")
                    montantescompte += Number(montantescompteligne);
                    $('#escompte' + t).val(Number(montantescomptelignee));
                }
                //alert(total);
                else {
                    $('#valeurescompte').val(0); //alert(valeurescompte+"valeurescompte");
                    valeurescompte = $('#valeurescompte').val();
                    montantescompte = 0; //alert(montantescompte);$('#escompte').val(0);}
                    // alert(montantescompte+"esc");
                    //  $('#escompte').val(Number(montantescompte).toFixed(3));
                    montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100;
                    totalmontantescompteligne += Number(montantescompteligne);
                    montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                    totalmontantescomptelignee += Number(montantescomptelignee);
                    montantescompte += Number(montantescompteligne);
                    $('#escompte' + t).val(Number(montantescomptelignee));
                }
                //  alert(valeurescompte+"valeurescompte");
                prixavecformulclient(prix, t, formule, fodec, tva, tpe, valeurescompte, remiseclient, remisearticle);
//                if (tpe != 0 && tpeclientexo == '') {
//                    // alert(montantescomptelignee);
//                    montanttpe = montantescomptelignee * tpe / 100; //alert(montanttpe);
//                    motanttotaltpe += montanttpe;
//                    $('#tpecommandeclient' + j).val(Number(montanttpe));
//                    //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    //                            totaltpecommandeclient += Number(tpecommandeclient);
//
//                } else {
//                    montanttpe = 0 //alert(montanttpe);
//                    motanttotaltpe += montanttpe;
//                    $('#tpecommandeclient' + j).val(Number(montanttpe));
//                    //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    //                            totaltpecommandeclient += Number(tpecommandeclient);
//                }
                if (fodec != 0 && fodecclientexo == '') {
                    //   alert("cc");
                    montantfodec = montantescomptelignee * fodec / 100;
                    fod += Number(montantfodec);

                    motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                    totalmotanttotal += Number(motanttotal);
                    $('#fodeccommandeclient' + t).val(Number(montantfodec));
                } else {
                    montantfodec = 0;
                    fod += montantfodec;
                    $('#fodeccommandeclient' + t).val(Number(montantfodec));
                    motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                    totalmotanttotal += Number(motanttotal);
                }
                         if (tpe != 0 && tpeclientexo == '') {
                  montanttpe = Number(motanttotal) * Number(tpe) / 100; //alert(montanttpe);
                            motanttotaltpe += Number(montanttpe);
                            $('#tpecommandeclient' + t).val(Number(montanttpe));
                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                            totaltpecommandeclient += Number(tpecommandeclient);

                        } else {
                  montanttpe = 0 //alert(montanttpe);
                            motanttotaltpe += Number(montanttpe);
                            $('#tpecommandeclient' + t).val(Number(montanttpe));
                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                            totaltpecommandeclient += Number(tpecommandeclient);
                        }

//                if (tpe != 0 && tpeclientexo == '') {
//
//                    tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    totaltpecommandeclient += Number(tpecommandeclient);
//
//                } else {
//
//                    tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    totaltpecommandeclient += Number(tpecommandeclient);
//                }






                if (tva != 0 && tvaclientexo == '') {
                    //   alert("hh");
                    // alert("tva recup?r? apr?s if");
                    // alert(netht);

                    montanttva = Number(tpecommandeclient) * tva / 100; //alert(montanttva);
                    tvacomd += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                    $('#monatantlignetva' + t).val(Number(montanttva));
                    totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                    $('#totalttc' + t).val(Number(totalttc));
                    totalCommandettc += Number(totalttc);

                } else {
                    montanttva = 0;
                    tvacomd += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                    $('#monatantlignetva' + t).val(Number(montanttva));
                    totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                    totalCommandettc += Number(totalttc);
                    $('#totalttc' + t).val(Number(totalttc));
                }








                //   escompte += Number($('#escompte' + j).val());


                //$('#ttc' + i).val(Number(ttc));
            }
        }

        if ($('#OUI').is(':checked')) {
            getescompte(total);
            valeurescompte = $('#valeurescompte').val(); //alert(valeurescompte+"valeurescompte");
            montantescompte = Number(total) * Number(valeurescompte) / 100; //alert(montantescompte);
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
        ttf=Number(totaltt)*1/100;
       $('#fod').val(Number(fod).toFixed(3));
               //afef  $('#fod').val(Number(ttf).toFixed(3));

        $('#tpecommande').val(Number(motanttotaltpe).toFixed(3));
        totaltpecommandeclientt = Number(totaltt) + Number(fod) + Number(motanttotaltpe);
         //afef  totaltpecommandeclientt = Number(totaltt) + Number(fod);
        $('#baseHT').val(Number(totaltpecommandeclientt).toFixed(3));
ttv=Number(totaltpecommandeclientt)*19/100;
   $('#tvacommande').val(Number(tvacomd).toFixed(3));
        //afef    $('#tvacommande').val(Number(ttv).toFixed(3));
     totaltpecommandeclienttc = Number(totaltpecommandeclientt) + Number(tvacomd);
      //  afef totaltpecommandeclienttc = Number(totaltpecommandeclientt) + Number(ttv);
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



        typeclient = $('#typeclient').val();
        clientid = $('#cl_id').val();
        //alert(typeclient+"typeclient");
        typeclientidd = $('#typeclientidd').val();
        gouvernerat = $('#gouvernerat').val(); //alert(gouvernerat+'gouvernerat');
        date = $('#date').val(); //alert(date+'choixdate');
        //dateimp
        if (typeclient == 'false') {
            articleid = $('#article_id' + indexattr).val();
            qte = $('#qte' + indexattr).val();
            //      alert(articleid+'articleid') 
            //      alert(indexattr+"indexattr")
            //       alert(ind+"ind")
            //          alert(typeclientidd+"typeclientidd")
            //             alert(gouvernerat+"gouvernerat")
            //                alert(date+"date")
            //                   alert(qte+"qte")
            //alert('afefef')
            promonotgrandsurface(indexattr, ind, typeclientidd, gouvernerat, articleid, date, qte);
        } else {
            promograndsurface(indexattr, ind, clientid, articleid, date, qte);

        }
       calculbc(indexattr);
        //}
        //})
    }

    function calculbccheck() { //alert(index+'index')
        //alert('calculbc')
        ind = Number($('#index').val()); //alert(ind+'ind')
        i = ind;
        //   $('#remisearticle'+index).val(0);
        //            if(ind!=index){
        //                indexpre = Number(index)+1;
        //          // alert(indexpre+"indexpre");
        //                if( $('#articlee' + indexpre).val()!=""){
        //                    $('#sup' + indexpre).val('1');
        //         $(this).parent().parent().hide();
        //        }}

        // alert(index);
        articleid = $('#article_id' + index).val(); //alert(articleid)
        qte = $('#qte' + index).val();

        //alert(article_id);

        //alert(qte);
        test = 0;
        //if (qte.match(/^(?:[1-9]\d*|0)?(?:\.\d+)?$/)) { 
        //    test = 1;
        //}
        //if (test == 0) {
        //    $("#qte"+index).val("");
        //}

        //alert(depot_id);
        //        $.ajax({
        //            method: "GET",
        //            type: "GET",
        //            async: false,
        //
        //            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
        //            dataType: "JSON",
        //            data: {
        //                qte: qte,
        //
        //            },
        //            success: function(response) {
        //                // alert(response);die;
        //                //  alert(response.tab[0]['qtemax']);
        //                numbers = response.tab;

        //alert(numbers);



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

        nb = 0;
        for (j = 0; j <= ind; j++) {
            // alert(j);
            sup = $('#sup' + j).val(); // alert(sup);



            if (Number(sup) != 1) {
                nb++;
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
                    getescompte(total);
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
                prixavecformulclient(prix, j, formule, fodec, tva, tpe, valeurescompte, remiseclient, remisearticle);
//                if (tpe != 0 && tpeclientexo == '') {
//                    // alert(montantescomptelignee);
//                    montanttpe = montantescomptelignee * tpe / 100; //alert(montanttpe);
//                    motanttotaltpe += montanttpe;
//                    $('#tpecommandeclient' + j).val(Number(montanttpe));
//                    //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    //                            totaltpecommandeclient += Number(tpecommandeclient);
//
//                } else {
//                    montanttpe = 0 //alert(montanttpe);
//                    motanttotaltpe += montanttpe;
//                    $('#tpecommandeclient' + j).val(Number(montanttpe));
//                    //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    //                            totaltpecommandeclient += Number(tpecommandeclient);
//                }
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
                  montanttpe = motanttotal * tpe / 100; //alert(montanttpe);
                            motanttotaltpe += montanttpe;
                            $('#tpecommandeclient' + j).val(Number(montanttpe));
                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                            totaltpecommandeclient += Number(tpecommandeclient);

                        } else {
                  montanttpe = 0 //alert(montanttpe);
                            motanttotaltpe += montanttpe;
                            $('#tpecommandeclient' + j).val(Number(montanttpe));
                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                            totaltpecommandeclient += Number(tpecommandeclient);
                        }
//                if (tpe != 0 && tpeclientexo == '') {
//
//                    tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    totaltpecommandeclient += Number(tpecommandeclient);
//
//                } else {
//
//                    tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    totaltpecommandeclient += Number(tpecommandeclient);
//                }







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
            getescompte(total);
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
        ttf=Number(totaltt)*1/100;
        //afef$('#fod').val(Number(fod).toFixed(3));
                $('#fod').val(Number(ttf).toFixed(3));

        $('#tpecommande').val(Number(motanttotaltpe).toFixed(3));
        //afeftotaltpecommandeclientt = Number(totaltt) + Number(fod) + Number(motanttotaltpe);
           totaltpecommandeclientt = Number(totaltt) + Number(fod);
        $('#baseHT').val(Number(totaltpecommandeclientt).toFixed(3));
ttv=Number(totaltpecommandeclientt)*19/100;
       //afef $('#tvacommande').val(Number(tvacomd).toFixed(3));
       $('#tvacommande').val(Number(ttv).toFixed(3));
      //  afeftotaltpecommandeclienttc = Number(totaltpecommandeclientt) + Number(tvacomd);
      totaltpecommandeclienttc = Number(totaltpecommandeclientt) + Number(ttv);
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





        //  }
        // })
    }

    function calculbc(index) { //alert(index+'index')
        //alert('calculbc')
        ind = Number($('#index').val()); //alert(ind+'ind')
        i = ind;
        //   $('#remisearticle'+index).val(0);
        //            if(ind!=index){
        //                indexpre = Number(index)+1;
        //          // alert(indexpre+"indexpre");
        //                if( $('#articlee' + indexpre).val()!=""){
        //                    $('#sup' + indexpre).val('1');
        //         $(this).parent().parent().hide();
        //        }}

        // alert(index);
        articleid = $('#article_id' + index).val(); //alert(articleid)
        qte = $('#qte' + index).val();

        //alert(article_id);

        //alert(qte);
        test = 0;
        //if (qte.match(/^(?:[1-9]\d*|0)?(?:\.\d+)?$/)) { 
        //    test = 1;
        //}
        //if (test == 0) {
        //    $("#qte"+index).val("");
        //}

        //alert(depot_id);
        //        $.ajax({
        //            method: "GET",
        //            type: "GET",
        //            async: false,
        //
        //            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
        //            dataType: "JSON",
        //            data: {
        //                qte: qte,
        //
        //            },
        //            success: function(response) {
        //                // alert(response);die;
        //                //  alert(response.tab[0]['qtemax']);
        //                numbers = response.tab;

        //alert(numbers);



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

        nb = 0;
        for (j = 0; j <= ind; j++) {
            // alert(j);
            sup = $('#sup' + j).val(); // alert(sup);



            if (Number(sup) != 1) {
                nb++;
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
                motanttotal = Number(netbrut) - Number(montremiseclient); //alert(motanttotal+'motanttotalremise');
                $('#motanttotal' + j).val(Number(motanttotal)); // alert(motanttotal);










                totrem = Number(totrem) + Number(totremiseclient); //alert(totrem+'totrem');

                totaltotal = Number($('#motanttotal' + j).val()); //alert(Number($('#motanttotal' + j).val())+'total')

                total = Number(total) + Number(totaltotal); //alert(Number($('#motanttotal' + j).val())+'total')

                totremiseclientt = ($('#totremiseclient' + j).val());
                totrmt += Number(totremiseclientt);
                remisecommande += Number($('#remiseligne' + j).val()); //alert(remisecommande+'remisecommande')
                //pourcentageescompte

                if ($('#OUI').is(':checked')) {
                    getescompte(total);
                    valeurescompte = $('#valeurescompte').val(); //alert(valeurescompte+"valeurescompte");
                    montantescompte = Number(total) * Number(valeurescompte) / 100; //alert(montantescompte);
                    //  $('#valeurescompte').val(montantescompte);
                    //  alert(montantescompte+"esc");
                    //    $('#escompte').val(Number(montantescompte).toFixed(3));
                    montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100; //alert(montantescompte);
                    totalmontantescompteligne += Number(montantescompteligne);
                    montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                    totalmontantescomptelignee += Number(montantescomptelignee); //alert(totalmontantescomptelignee+"totalmontantescomptelignee")
                    montantescompte += Number(montantescompteligne);
                    $('#escompte' + j).val(Number(montantescomptelignee));
                }
                //alert(total);
                else {
                    $('#valeurescompte').val(0); //alert(valeurescompte+"valeurescompte");
                    valeurescompte = $('#valeurescompte').val();
                    montantescompte = 0; //alert(montantescompte);$('#escompte').val(0);}
                    // alert(montantescompte+"esc");
                    //  $('#escompte').val(Number(montantescompte).toFixed(3));
                    montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100;
                    totalmontantescompteligne += Number(montantescompteligne);
                    montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                    totalmontantescomptelignee += Number(montantescomptelignee);
                    montantescompte += Number(montantescompteligne);
                    $('#escompte' + j).val(Number(montantescomptelignee));
                }
                //  alert(valeurescompte+"valeurescompte");
                prixavecformulclient(prix, j, formule, fodec, tva, tpe, valeurescompte, remiseclient, remisearticle);
//                if (tpe != 0 && tpeclientexo == '') {
//                    // alert(montantescomptelignee);
//                    montanttpe = montantescomptelignee * tpe / 100; //alert(montanttpe);
//                    motanttotaltpe += montanttpe;
//                    $('#tpecommandeclient' + j).val(Number(montanttpe));
//                    //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    //                            totaltpecommandeclient += Number(tpecommandeclient);
//
//                } else {
//                    montanttpe = 0 //alert(montanttpe);
//                    motanttotaltpe += montanttpe;
//                    $('#tpecommandeclient' + j).val(Number(montanttpe));
//                    //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    //                            totaltpecommandeclient += Number(tpecommandeclient);
//                }
                if (fodec != 0 && fodecclientexo == '') {
                    //   alert("cc");
                    montantfodec = Number(montantescomptelignee) * Number(fodec)/ 100;
                    fod += montantfodec;

                    motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                    totalmotanttotal += Number(motanttotal);
                    $('#fodeccommandeclient' + j).val(Number(montantfodec));
                } else {
                    montantfodec = 0;
                    fod += Number(montantfodec);
                    $('#fodeccommandeclient' + j).val(Number(montantfodec));
                    motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                    totalmotanttotal += Number(motanttotal);
                }
         if (tpe != 0 && tpeclientexo == '') {
                  montanttpe = Number(motanttotal) * Number(tpe) / 100; //alert(montanttpe);
                            motanttotaltpe += Number(montanttpe);
                            $('#tpecommandeclient' + j).val(Number(montanttpe));
                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                            totaltpecommandeclient += Number(tpecommandeclient);

                        } else {
                  montanttpe = 0 //alert(montanttpe);
                            motanttotaltpe += Number(montanttpe);
                            $('#tpecommandeclient' + j).val(Number(montanttpe));
                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                            totaltpecommandeclient += Number(tpecommandeclient);
                        }
//                if (tpe != 0 && tpeclientexo == '') {
//
//                    tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    totaltpecommandeclient += Number(tpecommandeclient);
//
//                } else {
//
//                    tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
//                    totaltpecommandeclient += Number(tpecommandeclient);
//                }







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
            getescompte(total);
            valeurescompte = $('#valeurescompte').val(); //alert(valeurescompte+"valeurescompte");
            montantescompte = Number(total) * Number(valeurescompte) / 100; //alert(montantescompte);
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
        ttf=Number(totaltt)*1/100;
       $('#fod').val(Number(fod).toFixed(3));
               //afef  $('#fod').val(Number(ttf).toFixed(3));

        $('#tpecommande').val(Number(motanttotaltpe).toFixed(3));
        totaltpecommandeclientt = Number(totaltt) + Number(fod) + Number(motanttotaltpe);
         //afef  totaltpecommandeclientt = Number(totaltt) + Number(fod);
        $('#baseHT').val(Number(totaltpecommandeclientt).toFixed(3));
ttv=Number(totaltpecommandeclientt)*19/100;
   $('#tvacommande').val(Number(tvacomd).toFixed(3));
        //afef    $('#tvacommande').val(Number(ttv).toFixed(3));
     totaltpecommandeclienttc = Number(totaltpecommandeclientt) + Number(tvacomd);
      //  afef totaltpecommandeclienttc = Number(totaltpecommandeclientt) + Number(ttv);
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

    function desactiveEnter() {
        return event.keyCode != 98;
        /* if (event.keyCode == 13) {
             event.keyCod
             e = 0;
             window.event.returnValue = false;
             //document.getElementById("text").innerHTML="&nbsp;&nbsp;&nbsp;Veuillez utiliser la souris pour valider ce devis ";
             bootbox.alert('&nbsp;&nbsp;&nbsp;?????? ??????? ?????? ???????? ')
         }*/
    }

    function ajouterlignepress() {

        if (event.keyCode == 120 || event.keyCode == 107 || event.keyCode == 9) {
            table = $(this).attr("table");
            //alert(table)
            //alert(table);

            //  alert("hh");
            //  alert(index);
            ind = Number($('#index').val()) + 1;

            //ind = Number($("#" + index).val()) + 1;
            //alert(ind)
            $ttr = $("#" + table)
                .find(".tr")
                .clone(true);
            $ttr.attr("class", "");
            i = 0;
            tabb = [];
            $ttr.find("input,select,textarea,tr,td,div,ul,li").each(function() {

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
            //alert(ind+"ind")
            $("#index").val(ind);

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
    }

    function promonotgrandsurface(i, ind, typeclient, gouvernerat, articleid, date, qte) {
        // alert(articleid+"articleid")
        // alert('ajouter')
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getpromonotgrandesurface']) ?>",
            dataType: "json",
            async: false,
            data: {
                typeclient: typeclient,
                gouvernerat: gouvernerat,
                articleid: articleid,
                date: date,
                qte: qte

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {

                console.log(data);
                qtpromi = Number(data.qtepromo) || 0;
                //alert(qtpromi+'qtpromiqtpromi');

                //            i = $(this).attr('index');
                //            ind = Number($('#index').val());
                //            qte =  $('#qte'+i).val();
                //            article =  $('#article_id'+i).val();
                //if(i == ind){
                a = Number(ind - 1);
                typnat = data.type; //alert(typnat+"typnat");
                // }data.name
                //    alert(a)
                //     alert(article)
                //     alert($('#article_id'+ind).val())
                // if((article !=  $('#article_id'+a).val())){

                name = 'Promo: ' + data.name;
                if (qtpromi != 0 && typnat == 0) {
                    //    alert(index)
                    artna = $('#articlee' + ind).val(); //alert(artna)
                    //  if(artna==""){
                    // alert('tr')
                    ajouterauto('addtable', 'index', articleid, qtpromi, name);
                    //alert(data.name)
                    // $('#articlee' + j).val(data.name)
                    // }
                } else if (qtpromi != 0 && typnat == 1) {
                    // alert(i+'index')
                    $('#remisearticle' + i).val(qtpromi);
                }
                // }
            }

        })
    }

    function promograndsurface(i, ind, clientid, articleid, date, qte) {
        //alert(i+'i'),alert(ind+'ind')


        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getpromograndesurface']) ?>",
            dataType: "json",
            async: false,
            data: {
                clientid: clientid,

                articleid: articleid,
                date: date,
                qte: qte

            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {

                console.log(data);
                qtpromi = Number(data.qtepromo) || 0;
                //  alert(qtpromi+'qtpromiqtpromi');

                //            i = $(this).attr('index');
                //            ind = Number($('#index').val());
                //            qte =  $('#qte'+i).val();
                //            article =  $('#article_id'+i).val();
                //if(i == ind){
                a = Number(ind - 1);
                // }
                //    alert(a)
                //     alert(article)
                //     alert($('#article_id'+ind).val())
                // if((article !=  $('#article_id'+a).val())){
                if (qtpromi != 0) {
                    $('#remisearticle' + i).val(qtpromi);
                    //                    artna = $('#articlee' + index).val(); //alert(artna)
                    //                    if (artna == "") {
                    //                        name = 'Promo: ' + data.name;
                    //
                    //                        ajouterauto('addtable', 'index', articleid, qtpromi, name);
                    //                        $('#articlee' + j).val(data.name);
                    //                    }
                    // $("#article_id" + i).val(article);
                    // $("option[value='1']").remove();}
                    // }
                }

            }
        })
    }

    function ajouterauto(table, index, articleid, qte, name) {
        //  alert(index);
        i = $(this).attr('index');
        //alert(i)
        j = Number(i) + 1;
        //alert(j)
        ind = Number($('#' + index).val()) + 1;
        //  qte = $("#qte" + i).val();
        //art = $("#article_id" + i).val();
        $ttr = $('#' + table).find('.tr').clone(true);
        $ttr.attr('class', '');
        i = 0;
        tabb = [];
        $ttr.find('input,select,textarea,tr,td,div,ul,li').each(function() {
            tab = $(this).attr('table'); //alert(tab)
            champ = $(this).attr('champ');
            $(this).attr('index', ind);
            $(this).attr('id', champ + ind); //alert(champ);
            if (champ == 'marchandisetype_id') {
                //alert(champ)
                $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + '][]');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            } else {
                $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            }
            //     if($ttr.find('tr')){
            //                 alert('afefe')
            //    $(this).attr('id',champ+ ind);
            //      }
            $type = $(this).attr('type');
            $(this).val('');
            if ($type == 'radio') {
                $(this).attr('name', 'data[' + champ + ']');
                //$(this).attr('value',ind);
                $(this).val(ind);
            }
            if ((champ == 'datedebut') || (champ == 'datefin')) {
                $(this).attr('onblur', 'nbrjour(' + ind + ')')
            }

            //         if (champ == 'afef') {
            //          alert('afefe')
            //           $(this).attr('id','afeff'+ ind);
            //    
            //      }
            $(this).removeClass('anc');
            if ($(this).is('select', 'multiple')) {
                //alert(champ);
                //alert(ind);
                tabb[i] = champ + ind; //alert(tabb[i]);
                i = Number(i) + 1;
            }
            // $(this).val('');
        })
        $ttr.find('i').each(function() {
            $(this).attr('index', ind);
        });
        $('#' + table).append($ttr);
        $('#' + index).val(ind);
        $('#' + table).find('tr:last').show();
        // $("#article_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });

        $('#' + table).find('tr:last').attr('id', 'trart' + ind);
        // $('.tr').attr('id','trart'+ind);

        // $("#article" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        // $("#article_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        // $("#banque_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        // $("#typeexon_id" + ind).select2({
        //     width: '100%' // need to override the changed default
        // });
        // $("#gouvernorat_id" + ind).select2({
        //     width: '75%' // need to override the changed default
        // });
        $("#qte" + j).val(qte);
        $("#prix" + j).val(0);
        $("#prixEntre" + j).val(0);
        $("#remiseclient" + j).val(0);
        $("#remisearticle" + j).val(0);
        $("#tva" + j).val(0);
        $("#tpe" + j).val(0);
        $("#qteStock" + j).val(0);
        $("#tdart" + j).hide();
        $("#td" + j).show();
        $("#totremiseclient" + j).val(0);
        $("#motanttotal" + j).val(0);

        $("#fodec" + j).val(0);



        // alert(articleid+"article");
        $("#article_id" + j).val(articleid);
        //alert(name)
        $("#articlee" + j).val(name);
        $('#articlee' + j).attr('readonly', "");
        //$("option[value='1']").remove();
        $('#qte' + j).attr('readonly', "");

        //    $('#articlee'+j).attr('name', "");
        //  $('#article_id'+j).attr('disabled', "");








        // var e = document.getElementById("article_id"+j);
        // var value = e.value;
        // var value = e.options[e.selectedIndex].text;
        // console.log(value)
        // $("option['value'="+value+"]");
        for (j = 0; j <= i; j++) {
            // alert(tabb[j]);
            //  $('marchandisetype_id1').attr('class','select2');
            //  uniform_select(tabb[j]); jareb
            //$('#'+tabb[j]).select2({ });
        }
    }


    function ajouter(table, index) {
        //  alert(index);
        i = $(this).attr('index');
        //alert(i)
        j = Number(i) + 1;
        //alert(j)
        ind = Number($('#' + index).val()) + 1;
        //  qte = $("#qte" + i).val();
        //art = $("#article_id" + i).val();
        $ttr = $('#' + table).find('.tr').clone(true);
        $ttr.attr('class', '');
        i = 0;
        tabb = [];
        $ttr.find('input,select,textarea,tr,td,div,ul,li').each(function() {
            tab = $(this).attr('table'); //alert(tab)
            champ = $(this).attr('champ');
            $(this).attr('index', ind);
            $(this).attr('id', champ + ind); //alert(champ);
            if (champ == 'marchandisetype_id') {
                //alert(champ)
                $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + '][]');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            } else {
                $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
            }
            //     if($ttr.find('tr')){
            //                 alert('afefe')
            //    $(this).attr('id',champ+ ind);
            //      }
            $type = $(this).attr('type');
            $(this).val('');
            if ($type == 'radio') {
                $(this).attr('name', 'data[' + champ + ']');
                //$(this).attr('value',ind);
                $(this).val(ind);
            }
            if ((champ == 'datedebut') || (champ == 'datefin')) {
                $(this).attr('onblur', 'nbrjour(' + ind + ')')
            }

            //         if (champ == 'afef') {
            //          alert('afefe')
            //           $(this).attr('id','afeff'+ ind);
            //    
            //      }
            $(this).removeClass('anc');
            if ($(this).is('select', 'multiple')) {
                //alert(champ);
                //alert(ind);
                tabb[i] = champ + ind; //alert(tabb[i]);
                i = Number(i) + 1;
            }
            // $(this).val('');
        })
        $ttr.find('i').each(function() {
            $(this).attr('index', ind);
        });
        $('#' + table).append($ttr);
        $('#' + index).val(ind);
        $('#' + table).find('tr:last').show();




    }





    $(function() {
        $('.supLigne0ch').on('click', function() {
            nbligne = $('#nbligne').val($('#nbligne').val() - 1);
            indd = Number($('#index').val());
            index = $(this).attr('index');
            artt = $('#article_id' + index).val();
            for (j = 0; j <= indd; j++) {
                art = $('#article_id' + j).val();
                if (Number(art) == Number(artt)) {
                    $('#trart' + j).hide();
                }
            }

            i = $(this).attr('index');
            //  alert(index);
            //  qte = $('#qte' + index).val();
            //          indexpre=Number(ind)+1;
            $('#sup' + i).val('1');
            $('#suptest' + i).val('1');
            $(this).parent().parent().hide();

            calculbc(i);
        })
        //        $('.supLigne0ch').on('click', function () {
        //             // alert('hh');
        //             index = $(this).attr('index');
        //             i = $(this).attr('index');
        //              alert(index);
        //             qte = $('#qte' + index).val();
        //             $('#sup' + i).val('1');
        //             $(this).parent().parent().hide();
        //             //alert(article_id);

        //             //alert(depot_id);
        //             $.ajax({
        //                 method: "GET",
        //                 type: "GET",
        //                 url: "<?= $this->Url->build(['controller' => 'Commandes', 'action' => 'getescompte']) ?>",
        //                 dataType: "JSON",
        //                 data: {
        //                     qte: qte,

        //                 },
        //                 success: function (response) {
        //                     //  alert(response.tab[0]['qtemax']);
        //                     numbers = response.tab;


        //                     //    alert(response['ligne']["Code"]);
        //                     //   qtestockx = response['qtestockx'];
        //                     //alert('hh');

        //                     //   $('#pourcentageescompte' + index).val(response['remise']);

        //                     /// $('#qteStock' + index).val(qtestockx);
        //                     //$('#prix' + index).val(response['ligne']["Prix_LastInput"]);
        //                     // $('#ttc' + index).val(response['ligne']["PTTC"]);
        //                     //   //$('#exofodec').val(response['ligne']["FODEC"]);
        //                     // $('#prixht' + index).val(response['ligne']["PHT"]);

        //                     // $('#tva' + index).val(response['ligne']["tva"]["valeur"]);
        //                     //$('#tpe' + index).val(response['ligne']["TXTPE"]);
        //                     // $('#fodec' + index).val(response['ligne']["fodec"]);
        //                     // $('#remisearticle' + index).val(response['ligne']["remise"]);

        //                     // pourcentageescompte = $('#pourcentageescompte' + i).val(); //alert(pourcentageescompte);
        //                     index = $('#index').val();
        //                     // timbre = $('#timbre').val();// alert(timbre);
        //                     //  alert(i);


        //                     for (j = 0; j <= index; j++) {
        //                         tpe = $('#tpe' + j).val();
        //                         tva = Number($('#tva' + j).val()); // alert(tva);
        //                         fodec = $('#fodec' + j).val(); //alert(tpe);
        //                         fodecclient = $('#fodecclient').val();
        //                         //
        //                         fodecclientexo = $('#fodecclientexo').val();
        //                         tpeclientexo = $('#tpeclientexo').val();
        //                         tvaclientexo = $('#tvaclientexo').val();
        //                         //
        //                         total = 0;
        //                         totalremise = 0;
        //                         remisecommande = 0;
        //                         montanttpe = 0;
        //                         montantfodec = 0;
        //                         montanttva = 0;
        //                         totalttc = 0;
        //                         totalCommandettc = 0;
        //                         motanttotal = 0;
        //                         ttc = 0;
        //                         fodeccommandeclient = 0;
        //                         fod = 0;
        //                         tpecommandeclient = 0;
        //                         tpecmd = 0;
        //                         monatantlignetva = 0;
        //                         tvacomd = 0;
        // //-------------------------------
        //                     baseHT=0;
        //                     brutHT=0;
        // //------------------------------------


        //                         qteStock = ($('#qteStock' + j).val()) * 1;
        //                         qte = ($('#qte' + j).val()) * 1;
        //                         prix = $('#prix' + j).val();
        //                         remisearticle = $('#remisearticle' + j).val() || 0;
        //                         remiseclient = $('#remiseclient' + j).val() || 0;




        //                         /* if (qte > qteStock) {*/
        //                         // alert("veuillez enter quantit� inf�rieur a la qunatit� de stock !!");
        //                         //   $('#qte' + i).val(0);

        //                         //    }
        //                         //  else {

        //                         netbrut = (Number(qte) * Number(prix)); //alert(netbrut);

        //                         totalremise = Number(remisearticle) + Number(remiseclient);

        //                         remisefinale = netbrut.toFixed(2) * totalremise / 100;
        //                         motanttotal = netbrut - remisefinale; //alert(motanttotal);
        //                         //   ttc = motanttotal * 1.19 / qte;

        //                         $('#motanttotal' + j).val(Number(motanttotal).toFixed(2));  //alert( $('#motanttotal' + j).val());





        //                         //  }

        //                         // if ($('#OUI').is(':checked')) {
        //                         // alert("dhh");
        //                         //fodec = Number($('#OUI').val());

        //                         // remisepayementmontant = motanttotal * pourcentageescompte / 100; // alert("hh");
        //                         //motanttotal = motanttotal - remisepayementmontant;
        //                         //alert(netht);
        //                         // alert(remisepayementmontant);
        //                         // $('#escompte' + i).val(Number(remisepayementmontant).toFixed(2)); //alert(remisepayementmontant)



        //                         //  } else {
        //                         // $('#escompte' + i).val('');
        //                         // }
        //                         //  $('#comptant').val(Number(motanttotal).toFixed(3));
        //                         ttc = motanttotal * (1 + tva) / qte;
        //                         $('#ttc' + i).val(Number(ttc).toFixed(3));







        //                         //alert($('#ttc' + i).val());



        //                         // alert($('#motanttotal0').val());


        //                         if (fodec != 0 && fodecclientexo == '') {
        //                             montantfodec = motanttotal * fodec / 100;
        //                             fodeccommandeclient += montantfodec;

        //                             motanttotal += montantfodec; //alert(motanttotal);
        //                         }
        //                         $('#fodeccommande').val(Number(motanttotal).toFixed(2));
        //                         $('#fodeccommandeclient' + j).val(Number(fodeccommandeclient).toFixed(2));
        //                         // alert($('#fodeccommandeclient' + i).val());





        //                         if (tpe != 0 && tpeclientexo == '') {
        //                             montanttpe = motanttotal * tpe / 100; //alert(montanttpe);
        //                             motanttotal += montanttpe;
        //                             tpecommandeclient += montanttpe; //alert(tpecommandeclient);

        //                         }



        //                         $('#tpecommandeclient' + j).val(Number(tpecommandeclient).toFixed(2));
        //                         // alert($('#tpecommandeclient' + i).val());




        //                         //   alert("tva recup�r� avant if");
        //                         // alert(tva);
        //                         if (tva != 0 && tvaclientexo == '') {
        //                             //   alert("hh");
        //                             // alert("tva recup�r� apr�s if");
        //                             // alert(netht);
        //                             montanttva = motanttotal * tva / 100; //alert(montanttva);
        //                             totalttc = motanttotal + montanttva;

        //                         } else {
        //                             totalttc = motanttotal;
        //                         }

        //                         $('#remiseligne' + j).val(Number(remisefinale).toFixed(3));


        //                         //   alert('total ttc apres tva' + totalttc);
        //                         $('#monatantlignetva' + j).val(Number(montanttva).toFixed(3));


        //                         //  alert($('#monatantlignetva' + i).val());

        //                         $('#totalttc' + j).val(Number(totalttc).toFixed(3));




        //                     }


        //                     escompte = 0;


        //                     for (ii = 0; ii <= index; ii++) {
        //                         // alert("hh");
        //                         sup = $('#sup' + ii).val(); // alert(sup);



        //                         if (Number(sup) != 1) {
        //                             total += Number($('#motanttotal' + ii).val());








        //                             //alert(total);
        //                             remisecommande += Number($('#remiseligne' + ii).val());
        //                             // alert(totalCommandettc);
        // //------------------------------------

        //                     baseHT=total+fod;                    
        //                     brutHT=total+remisecommande;
        //                    // brutHT=prix*qte;


        //                     $('#baseHT').val(Number(baseHT).toFixed(3));
        //                     $('#brutHT').val(Number(brutHT).toFixed(3));

        // //-----------------------------------------

        //                             totalCommandettc += Number($('#totalttc' + ii).val()); //alert($('#totalttc' + ii).val());
        //                             fod += Number($('#fodeccommandeclient' + ii).val()); // alert(fod);
        //                             tpecmd += Number($('#tpecommandeclient' + ii).val());
        //                             tvacomd += Number($('#monatantlignetva' + ii).val()); // alert(tvacomd);



        //                             //   escompte += Number($('#escompte' + j).val());


        //                             //$('#ttc' + i).val(Number(ttc));
        //                         }
        //                     }

        //                     montantescompte = 0


        //                     maxpourcentage = response.tab[numbers.length - 1]['pourcentage'];
        //                     maxqte = response.tab[numbers.length - 1]['qtemax'];
        //                     //alert(total);


        //                     if ($('#OUI').is(':checked')) {
        //                         numbers.forEach(myFunction);

        //                         function myFunction(item) {
        //                             //  alert(total);
        //                             //  alert('kk');
        //                             if (total >= item['qtemin'] && total <= item['qtemax']) {
        //                                 // alert(item['pourcentage']);

        //                                 montantescompte = total * Number(item['pourcentage']) / 100;

        //                                 $('#valeurescompte').val(item['pourcentage']);
        //                             } else if (total > maxqte) {
        //                                 //alert('hh');
        //                                 montantescompte = total * Number(maxpourcentage) / 100;
        //                                 $('#valeurescompte').val(maxpourcentage);
        //                             }
        //                         }
        //                     }
        //                     //alert(total);
        //                     $('#escompte').val(Number(montantescompte).toFixed(3));


        //                     $('#totalremise').val(Number(remisecommande).toFixed(3));
        //                     $('#total').val(Number(total).toFixed(3));
        //                     $('#totalttccommande').val(Number(totalCommandettc).toFixed(3));
        //                     $('#fod').val(Number(fod).toFixed(3));
        //                     $('#tpecommande').val(Number(tpecmd).toFixed(3));
        //                     $('#tvacommande').val(Number(tvacomd).toFixed(3));


        //                 }
        //             })
        //         });
    });

    // $('.nopromo').on('click', function() {
    //     alert("Pas de promotion trouvés");
    // });
</script>

<script>
    function myFunction() {
        alert("Pas de promotion trouvés");
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


        $(document).on('keyup blur change click', '.focuss', function(e) {
            //  alert(event.which)
            // alert('fff')
            e.preventDefault(); //alert(event.which)
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

                //  })
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
        $(document).on('keyup', '.focus', function(e) {
            //    alert(event.which)
            index = $(this).attr('index');
            e.preventDefault(); //alert(event.which)
            if (event.which == 13) {
                // alert('dddd')

                //  $trNew = $trLast.clone();

                $('#tpe' + index).focus();


                // $trLast.after($trNew);


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


<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>



<?php $this->end(); ?>