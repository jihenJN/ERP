<?php

use Cake\Datasource\ConnectionManager;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('mahdi'); ?>

<section class="content-header">
    <h1>
        Ajout facture avoir marchandise
    </h1>
    <ol class="breadcrumb">

        <a href="<?php echo $this->Url->build(['controller' => 'Bonreceptionstocks', 'action' => 'index/']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>

    <!--</ol>-->
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <?php echo $this->Form->create($factureavoir, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">

                    <div class="row">

                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('numero', ["value" => $mm, 'readonly' => 'readonly']);


                            ?>
                        </div>
<!--                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]); ?>


                        </div>-->

                          <div class="col-xs-6">
                                    <?php 
                                                                echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))  ,'type'=>'date','class'=>'form-control']); ?>

                                </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label>Dépot</label>

                                <select name="depot_id" id="depot-id" class="form-control select2 control-label ">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($depots as $dep) {
                                    ?>
                                        <option <?php if ($bonreception->depot_id == $dep->id) { ?> selected="selected" <?php } ?> value="<?php echo $dep->id; ?>"><?php echo $dep->name ?></option>
                                    <?php } ?>
                                </select>


                            </div>




                        </div>
                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label>Client</label>

                                <select name="client_id" id="client" class="form-control select2 ">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($clients as $client) {
                                    ?>
                                        <option <?php if ($bonreception->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                                    <?php } ?>
                                </select>


                            </div>




                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label>Commercial</label>

                                <select name="commercial_id" id="" class="form-control select2 ">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($commercials as $com) {
                                    ?>
                                        <option <?php if ($commercial->id == $com->id) { ?> selected="selected" <?php } ?> value="<?php echo $com->id; ?>"><?php echo $com->name ?></option>
                                    <?php } ?>
                                </select>


                            </div>

                        </div>

                        <div class="col-xs-6" style="float: right;">
                            <?php
                            echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'type' => 'textarea', 'value' => $bonreception->observation]); ?>
                        </div>
                        <div class="col-xs-6" style="margin-top: 20px ;">
                            <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>

                            OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="oui calcheck" style="margin-right: 20px">
                            NON <input type="radio" name="checkpayement" value="0" id="NON" class="oui calcheck " checked>


                        </div>

                    </div>

                </div>

                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Ligne facture avoir marchandise'); ?></h1>
                </section>
                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">
                                <a class="btn btn-primary al ajouter_ligne_inventaire" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                    <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                                        <thead>
                                            <tr>
                                                <td align="center" style="width: 37%; font-size: 13px;"><strong>Article</strong></td>
                                                <td align="center" style="width: 9%;font-size: 13px;"><strong>Qte stock </strong></td>
                                                <td align="center" style="width: 9%;font-size: 13px;"><strong>Qte récept </strong></td>
                                                <td align="center" style="width: 10%;font-size: 13px;"><strong>Prix</strong></td>
                                                <td align="center" style="width:8%; font-size: 13px;"><strong>R/Fac</strong></td>
                                                <td align="center" style="width:8%;font-size: 13px;"><strong>R/Pro </strong></td>
                                                <td align="center" style="width:7%;font-size: 13px;"><strong> TVA </strong></td>
                                                <td align="center" style="width:7%;font-size: 13px;"><strong> Fodec </strong></td>
                                                <td align="center" style="width: 5%;font-size: 13px;"><strong> </strong></td>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="tr" style="display: none !important">
                                                <td align="center" table="ligne">
                                                    <label></label>
                                                    <input type="hidden" id="" champ="sup" name="" table="ligne" index="" class="form-control">

                                                    <select table="ligne" index champ="article_id" class="js-example-responsive articleQtest  ">
                                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                        <?php foreach ($articles as $id => $article) {
                                                        ?>
                                                            <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                        <?php } ?>
                                                    </select>

                                                    <?php
                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('qtestock', array('class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => 'qtestock', 'table' => 'ligne', 'name' => '', 'id' => '', 'type' => 'text', 'readonly' => true));
                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('quantite', array('class' => ' form-control calculavoirm', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'quantite', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                                                    ?>
                                                    <input table="ligne" type="hidden" name="" champ="motanttotal" id='' class="form-control " index>

                                                </td>


                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('prix', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'prix', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('remiseclient', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'remiseclient', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('remisearticle', array('class' => ' form-control calculavoirm', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'remisearticle', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">


                                                    <?php
                                                    echo $this->Form->input('tva', array('class' => ' form-control  ', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'tva', 'table' => 'ligne', 'name' => '', 'id' => '', 'readonly'));
                                                    echo $this->Form->input('monatantlignetva', array('class' => ' form-control ', 'type' => 'hidden', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'monatantlignetva', 'table' => 'ligne', 'name' => '', 'id' => ''));

                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('fodec', array('class' => ' form-control  ', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'fodec', 'table' => 'ligne', 'name' => '', 'id' => '', 'readonly'));
                                                    echo $this->Form->input('fodeccl', array('class' => ' form-control calculavoir', 'type' => 'hidden', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'fodeccl', 'table' => 'ligne', 'name' => '', 'id' => ''));

                                                    ?>
                                                </td>

                                                <td align="center">
                                                    <br>
                                                    <i class="fa fa-times supp" style="color: #c9302c;font-size: 22px;"></i>
                                                </td>
                                            </tr>

                                            <?php
                                            foreach ($lignes as $i => $l) {
                                                //debug($l);
                                                $articleid =  $l->article_id;
                                                $depotid = $bonreception->depot_id;
                                                date_default_timezone_set('Africa/Tunis');
                                                $date = date('Y-m-d H:i:s');
                                            ?>

                                                <?php


                                                $connection = ConnectionManager::get('default');
                                                //$qte = $connection->execute('SELECT SUM(lignebonlivraisons.quantiteliv)  as q FROM lignebonlivraisons where lignebonlivraisons.lignecommande_id='. $l->id.' ;')->fetchAll('assoc');
                                                $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                $stockk = $inv[0]['v'];
                                                //debug($stockk);


                                                ?>
                                                <tr class="cc">
                                                    <td>
                                                        <?php echo $this->Form->input('sup', array('name' => "data[ligne][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden')); ?>

                                                        <label></label>
                                                        <select name="<?php echo "data[ligne][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="ligne" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleQtest">
                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                            <?php foreach ($articles as $id => $article) {
                                                            ?>
                                                                <option <?php if ($l->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                            <?php }


                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>

                                                        <?php echo $this->Form->input('id', array('value' => $l->id, 'name' => 'data[ligne][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                                        <?php

                                                        echo $this->Form->input('qtestock', array('name' => 'data[ligne][' . $i . '][qtestock]', 'readonly', 'value' => $stockk, 'label' => '', 'div' => 'form-group', 'table' => 'ligne', 'index' => $i, 'id' => 'qtestock' . $i, 'champ' => 'qtestock', 'type' => 'text', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                        echo $this->Form->input('motanttotal', array('name' => 'data[ligne][' . $i . '][motanttotal]', 'readonly', 'value' => '', 'label' => '', 'div' => 'form-group', 'table' => 'ligne', 'index' => $i, 'id' => 'motanttotal' . $i, 'champ' => 'motanttotal', 'type' => 'hidden', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                        echo $this->Form->input('quantite', array('value' => $l->qte, 'label' => '', 'name' => 'data[ligne][' . $i . '][quantite]', 'table' => 'ligne', 'index' => $i, 'id' => 'quantite' . $i, 'champ' => 'quantite', 'type' => 'text', 'class' => 'form-control  calculavoirm  ')); ?>

                                                    </td>

                                                    <td>
                                                        <?php echo $this->Form->input('prix', array('value' => $l->prix, 'label' => '', 'name' => 'data[ligne][' . $i . '][prix]', 'table' => 'ligne', 'index' => $i, 'id' => 'prix' . $i, 'champ' => 'remisearticleva', 'type' => 'text', 'class' => 'form-control htb number getcalc getprixarticle', 'readonly',)); ?>


                                                    </td>
                                                    <td>
                                                        <?php echo $this->Form->input('remiseclient', array('value' => $bonreception->client->remise, 'label' => '', 'name' => 'data[ligne][' . $i . '][remiseclient]', 'table' => 'ligne', 'index' => $i, 'id' => 'remiseclient' . $i, 'champ' => 'remiseclient', 'type' => 'text', 'class' => 'form-control', 'readonly',)); ?>


                                                    </td>
                                                    <td>
                                                        <?php echo $this->Form->input('remisearticle', array('value' => $l->article->remise, 'label' => '', 'name' => 'data[ligne][' . $i . '][remisearticle]', 'table' => 'ligne', 'index' => $i, 'id' => 'remisearticle' . $i, 'champ' => 'remisearticle', 'type' => 'text', 'class' => 'form-control calculavoirm')); ?>


                                                    </td>
                                                    <td>
                                                        <label for=""></label>
                                                        <input name="<?php echo "data[ligne][" . $i . "][tva]" ?>" id="tva<?php echo $i ?>" type="text" readonly class="form-control" value="  <?php
                                                                                                                                                                                                foreach ($tvas as $p) {
                                                                                                                                                                                                    if ($l->article->tva_id == $p->id) {
                                                                                                                                                                                                        echo $p->valeur;
                                                                                                                                                                                                    }
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo $this->Form->input('fodec', array('value' => $l->article->fodec, 'label' => '', 'name' => 'data[ligne][' . $i . '][fodec]', 'table' => 'ligne', 'index' => $i, 'id' => 'fodec' . $i, 'champ' => 'fodec', 'type' => 'text', 'class' => 'form-control', 'readonly',)); ?>


                                                    </td>

                                                    <td align="center">
                                                        <br>
                                                    </td>

                                                </tr>
                                            <?php }
                                            // } 
                                            ?>
                                        </tbody>
                                    </table><br>
                                    <input type="hidden" value="<?php echo $i; ?>" id="index" />
                                </div>

                            </div>
                        </div>



                        <?php
                        $total = 0;
                        $totalremise = 0;
                        $totalfodec = 0;
                        $totaltva = 0;
                        $net = 0;
                        $totalttc = 0;

                        foreach ($lignes as $i => $l) {

                            foreach ($tvas as $t) {


                                if ($l->article->tva_id == $t->id) {
                                    $tva = $t->valeur;
                                }
                            }

                            // debug($tva);

                            $qte = $l->qte;
                            $p  = $l->prix;
                            $remiseclient = $bonreception->client->remise;
                            $remisearticle  = $l->article->remise;
                            $fodec  = $l->article->fodec;
                            $tot = $qte * $p;
                            $total += $tot;


                            $remiseligne = $tot * ($remiseclient / 100);
                            $remiseligneart = $tot * ($remisearticle / 100);

                            ////debug($remiseligneart);

                            $totalremise = $totalremise + $remiseligne + $remiseligneart;




                            $fodecc = ($tot - $remiseligne) * ($fodec / 100);
                            // debug($fodecc);
                            $totalfodec += $fodecc;


                            $htfodec = ($tot - $remiseligne) + $fodecc;
                            // debug($htfodec);

                            $tval = $htfodec * ($tva / 100);
                            // debug($tval);
                            $totaltva += $tval;
                            //debug($totaltva);


                            $net = $total - $totalremise;
                            /// debug($net);

                            $baseht = $net + $totalfodec;


                            $ttc = $htfodec + $tval;
                            $totalttc =  $totalttc + $ttc;

                            ///debug($totalttc);

                            $tpe = $net + $totalfodec;
                            $netapayer = $tpe + $totaltva;
                            // debug($netapayer);


                        }

                        ?>



                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="row">
                                    <div style=" position: static;">
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('brut', ['id' => 'brutHT',  'value' => sprintf("%01.3f", str_replace(",", ".", $total)), 'readonly' => 'readonly', 'label' => 'Brut HT', 'name', 'required' => 'off']); ?>
                                        </div>
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly',  'value' => sprintf("%01.3f", str_replace(",", ".", $totalremise)), 'label' => 'Remise', 'name', 'required' => 'off']); ?>
                                        </div>

                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('fod', ['id' => 'fod', 'readonly' => 'readonly', 'label' => 'Fodec', 'name', 'required' => 'off',  'value' => sprintf("%01.3f", str_replace(",", ".", $totalfodec))]); ?>
                                        </div>


                                    </div>
                                </div>
                                <div class="row">
                                    <div style=" position: static;">

                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('total', ['id' => 'total', 'readonly' => 'readonly', 'label' => 'Net HT', 'name', 'required' => 'off',  'value' => sprintf("%01.3f", str_replace(",", ".", $net))]); ?>
                                        </div>

                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('tvacommande', ['id' => 'tvacommande', 'readonly' => 'readonly', 'label' => 'TVA', 'name', 'required' => 'off',  'value' => sprintf("%01.3f", str_replace(",", ".", $totaltva))]); ?>
                                        </div>
                                        <!-- <div class="col-xs-4 pull-right">
                                            <?php echo $this->Form->control('netapayer', [
                                                'id' => 'netapayer', 'readonly' => 'readonly', 'label' => 'Net à payé', 'name', 'required' => 'off', 'value' => sprintf("%01.3f", str_replace(",", ".", $netapayer))
                                            ]); ?>
                                        </div> -->
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('valeurescompte', ['id' => 'valeurescompte', 'type' => 'hidden', 'value' => '', 'label' => 'valeurescompte', 'name']); ?>

                                            <?php echo $this->Form->control('escompte', ['id' => 'escompte', 'readonly' => 'readonly', 'value' => '', 'label' => 'Escompte', 'name', 'required' => 'off']); ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div style=" position: static;">
                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('base', ['id' => 'baseHT', 'readonly' => 'readonly', 'label' => 'Base HT', 'name', 'required' => 'off',  'value' => sprintf("%01.3f", str_replace(",", ".", $totalttc))]); ?>
                                        </div>

                                        <div class="col-xs-4">
                                            <?php echo $this->Form->control('totalttc', [
                                                'value' => sprintf("%01.3f", str_replace(",", ".", $totalttc)), 'id' => 'totalttccommande', 'readonly' => 'readonly', 'label' => 'TTC', 'name', 'required' => 'off'
                                            ]); ?>
                                        </div>



                                    </div>
                                </div>
                                <div class="row">

                                    <div style=" position: static;">



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





                        <button type="submit" class="pull-right btn btn-success  alertFacavoirm  " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </section>






            </div>

        </div>
    </div>

</section>


<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
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

        $('.articleQtest').on('change', function() {

            index = $(this).attr('index');
            article_id = $('#article_id' + index).val();
            date = $('#date').val();
            depot = $('#depot-id').val();
            client = $('#client').val();


            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Bonsortiestocks', 'action' => 'getquantite']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    date: date,
                    depot: depot,
                    client: client,

                },
                success: function(data) {
                    //  alert(data.qtes)

                    $('#qtestock' + index).val(data.qtes);
                    $('#prix' + index).val(data.prix);
                    $('#remiseclient' + index).val(data.remise);
                    $('#tva' + index).val(data.tva);
                    $('#fodec' + index).val(data.fodec);
                    $('#remisearticle' + index).val(data.remiseart);
                    $('#quantite' + index).focus();
                    $('#qte' + index).val('');


                }

            })

        })
        $('.calculHT').on('keyup', function() {
            Calcul();
        })




        $('.calculavoirm').on('blur', function() {

            calculavoirmarch();

        });

        $('.calcheck').on('click', function() {

            calculavoirmarch();
            // alert('hechem')

        });
        $('.supp').on('click', function() {

            i = $(this).attr('index');
            index = $('#index').val();

            $('#sup' + i).val('1');
            $(this).parent().parent().hide();

            calculavoirmarch(i);


        });






    })

    function Calcul() {
        ///  alert('hechem')


        index = $('#index').val();

        totalht = 0;

        /// alert(ht)


        for (i = 0; i <= index; i++) {
            sup = $('#sup' + i).val() || 0;

            if (Number(sup) != 1) {

                prix = $('#prix' + i).val() || 0;
                ///alert(prix); 
                qte = $('#quantite' + i).val() || 0;

                tot = Number(prix) * Number(qte);
                /// alert(tot)
                totalht = Number(tot) + Number(totalht);
                ///   alert(totalht)



            }
        }

        $('#ht').val(Number(totalht).toFixed(3));


    }


    function calculavoirmarch() {

        index = $('#index').val();
        //alert(index)
        totalremise = 0;
        totalht = 0;
        totalfodec = 0;
        totaltva = 0;
        totalttc = 0;
        totht = 0;
        total = 0;
        brutht = 0;
        baseHT = 0;
        netHt = 0;
        baseHTT = 0;
        NET = 0;
        totalmontantescompteligne = 0;
        totalmontantescomptelignee = 0;
        totalmotanttotal = 0;
        fod = 0;
        tvacomd = 0;
        totalCommandettc = 0;
        for (i = 0; i <= index; i++) {
            sup = $('#sup' + i).val() || 0;


            if (Number(sup) != 1) {


                fodecl = 0;
                ht = 0;
                tval = 0;
                ttcl = 0;

                qte = $('#quantite' + i).val() || 0;
                prix = $('#prix' + i).val() || 0;
                remise = $('#remiseclient' + i).val() || 0;
                remiseart = $('#remisearticle' + i).val() || 0;
                /////alert(remiseart)
                fodec = $('#fodec' + i).val() || 0;

                remisel = ((Number(qte) * Number(prix)) * Number(remise / 100));
                remisearticle = ((Number(qte) * Number(prix)) * Number(remiseart / 100));

                // alert(remisearticle)
                $('#totalremise' + i).val(Number(remisel).toFixed(3));

                totalremise = Number(totalremise) + Number(remisel) + Number(remisearticle);
                //alert(totalremise)
                ht = (Number(qte) * Number(prix));
                brut = (Number(qte) * Number(prix));

                brutht = Number(brutht) + Number(brut);

                //alert(brut)
                ////alert(brutht)

                net = Number(brutht) - Number(totalremise);

                htremise = Number(ht) - Number(remisel) - Number(remisearticle);


                $('#motanttotal' + i).val(Number(htremise).toFixed(3));
                totaltotal = Number($('#motanttotal' + i).val());

                //alert(totaltotal)

                total = Number(total) + Number(totaltotal);

                ///  alert(total)
                ///alert(totalht)
                fodecl = Number(htremise) * Number(fodec / 100);
                // alert(fodecl)
                $('#fodeccl' + i).val(fodecl);
                //alert(fodecl)
                totalfodec = Number(totalfodec) + Number(fodecl);
                //alert(totalfodec)
                htfodec = Number(htremise) + Number(fodecl);
                ///alert(htfodec+'htfodec')

                tva = $("#tva" + i).val();


                tval = Number(htfodec) * Number(tva / 100);
                //alert(tval)
                $('#monatantlignetva' + i).val(tval);

                totaltva = Number(totaltva) + Number(tval);
                //alert(totaltva)
                ttcl = Number(htfodec) + Number(tval);
                //alert(ttcl)
                $('#totalttc' + i).val(ttcl);

                $('#ttc' + i).val(Number(ttcl).toFixed(3));

                totalttc = Number(totalttc) + Number(ttcl);

                tpecomm = Number(netHt) + Number(totalfodec);

                baseHTT += tpecomm;

                NET = Number(tpecomm) + Number(totaltva);



                if ($('#OUI').is(':checked')) {

                    //alert(brutht)

                    getescompte(total);
                    valeurescompte = $('#valeurescompte').val();

                    //alert(valeurescompte)

                    //console.log('brut'+ brut , 'brutht'+ brutht)
                    montantescompte = brutht * Number(valeurescompte) / 100;

                    //console.log(montantescompte)
                    //alert(montantescompte)
                    montantescompteligne = totaltotal * Number(valeurescompte) / 100;
                    ///  alert(montantescompteligne);
                    //alert(montantescompteligne) ;
                    totalmontantescompteligne += Number(montantescompteligne);
                    /// alert(totalmontantescompteligne)
                    montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                    // alert(montantescomptelignee)
                    $('#escompte' + i).val(Number(montantescomptelignee).toFixed(3));



                } else {
                    $('#valeurescompte').val(0);
                    valeurescompte = $('#valeurescompte').val();
                    montantescompte = 0;

                    montantescompteligne = Number(totaltotal) * Number(valeurescompte) / 100;
                    totalmontantescompteligne += Number(montantescompteligne);
                    montantescomptelignee = Number(totaltotal) - Number(montantescompteligne);
                    totalmontantescomptelignee += Number(montantescomptelignee);
                    montantescompte += Number(montantescompteligne);
                    $('#escompte' + i).val(Number(montantescomptelignee).toFixed(3));
                }
                if (fodec != 0) {
                    // alert(fodec);
                    /// alert(montantescomptelignee)
                    montantfodec = montantescomptelignee * fodec / 100;

                    fod += montantfodec;

                    /// alert(fod)


                    motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                    totalmotanttotal += Number(motanttotal);
                    $('#fodeccommandeclient' + i).val(Number(montantfodec));
                } else {
                    montantfodec = 0;
                    totalfodec += montantfodec;
                    $('#fodeccommandeclient' + i).val(Number(montantfodec));
                    motanttotal = Number(montantescomptelignee) + Number(montantfodec); //alert(motanttotal);
                    totalmotanttotal += Number(motanttotal);
                }

                

                // if (tva != 0) {

                //     //  alert(motanttotal)


                //     montanttva = Number(motanttotal) * tva / 100;
                //     //alert(montanttva);
                //     totaltva += Number(montanttva);
                //     //alert(tvacomd)
                //     //alert(montanttva+"alert(montanttva)")
                //     $('#monatantlignetva' + i).val(Number(montanttva));
                //     totalttc = Number(motanttotal) + Number(montanttva); //alert(totalttc)
                //     $('#totalttc' + i).val(Number(totalttc));
                //     totalCommandettc += Number(totalttc);

                // } else {
                //     montanttva = 0;
                //     totaltva += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                //     $('#monatantlignetva' + i).val(Number(montanttva));
                //     totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                //     totalCommandettc += Number(totalttc);
                //     $('#totalttc' + i).val(Number(totalttc));
                // }









                // totht += totalht ; 

            }
        }

        if ($('#OUI').is(':checked')) {
            getescompte(total);
            valeurescompte = $('#valeurescompte').val();
            //alert(valeurescompte);
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

        mntesc = $('#escompte').val();
        ///  alert(mntesc)
        totaltt = Number(net) - Number(mntesc);

        // alert(totaltt)


        $('#brutHT').val(Number(brutht).toFixed(3));
        $('#netapayer').val(Number(NET).toFixed(3));
        $('#total').val(Number(totaltt).toFixed(3));
        $('#totalremise').val(Number(totalremise).toFixed(3));
        $('#baseHT').val(Number(totalttc).toFixed(3));
        $('#fod').val(Number(fod).toFixed(3));
        $('#tvacommande').val(Number(totaltva).toFixed(3));
        $('#totalttccommande').val(Number(totalttc).toFixed(3));


    }



    function getescompte(montant) {
        id = $('#client').val();
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
                ///alert(rem)
                $('#valeurescompte').val(rem);
            }
        })
    }















    $('.select2').select2();
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
<?php echo $this->Html->css('select2'); ?>


<?php $this->end(); ?>