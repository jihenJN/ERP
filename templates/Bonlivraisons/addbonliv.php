<?php

use Cake\Datasource\ConnectionManager;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('mahdi'); ?>
<section class="content-header">
    <h1>
        Ajout bon livraison marchandise
    </h1>
    <ol class="breadcrumb">

        <a href="<?php echo $this->Url->build(['controller' => 'Commandes', 'action' => 'indexm/']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>

    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <?php echo $this->Form->create($bonlivraison, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">

                    <div class="row">

                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('numero', ["value" => $mm, 'readonly' => 'readonly']);


                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]); ?>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group input select required">

                                <label>Dépot</label>

                                <select name="depot_id" id="depot_id" class="form-control select2 control-label ">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($depots as $dep) {
                                    ?>
                                        <option <?php if ($commande->depot_id == $dep->id) { ?> selected="selected" <?php } ?> value="<?php echo $dep->id; ?>"><?php echo $dep->name ?></option>
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
                                        <option <?php if ($commande->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
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
                            echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'type' => 'textarea', 'value' => $commande->observation]); ?>
                        </div>


                    </div>

                </div>

                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Ligne bon livraison marchandise'); ?></h1>
                </section>
                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <!-- <div class="box-header with-border">
                                <a class="btn btn-primary al ajouter_ligne_inventaire" table='addtable' index='index' id='' style="
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
                                                <td align="center" style="width: 10%; font-size: 12px;"><strong>Article</strong></td>
                                                <td align="center" style="width: 3%;font-size: 12px;"><strong>Quantité stock </strong></td>
                                                <td align="center" style="width: 3%;font-size: 12px;"><strong>Quantité recep </strong></td>
                                                <td align="center" style="width: 3%;font-size: 12px;"><strong>Quantité </strong></td>
                                                <!-- <td align="center" style="width: 3%;font-size: 12px;"><strong>Quantité livrée</strong></td> -->
                                                <td align="center" style="width: 4%;font-size: 12px;"><strong>Prix</strong></td>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- <tr class="tr" style="display: none !important">
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
                                                    echo $this->Form->input('quantite', array('class' => ' form-control ', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'quantite', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('qteliv', array('class' => ' form-control calculBonrec', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'qteliv', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                                                    ?>
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
                                                    echo $this->Form->input('remisearticle', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'remisearticle', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('tva', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'tva', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('fodec', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'fodec', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('tpe', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'tpe', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>

                                                <td align="center">
                                                    <i class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
                                                </td>
                                            </tr> -->

                                            <?php
                                            $i = -1;
                                            foreach ($lignes as $k => $l) {
                                            // debug($l);
                                                $articleid =  $l->article_id;
                                                $depotid = $commande->depot_id;
                                                date_default_timezone_set('Africa/Tunis');
                                                $date = date('Y-m-d H:i:s');
                                            ?>

                                                <?php


                                                $connection = ConnectionManager::get('default');
                                                $qte = $connection->execute('SELECT SUM(lignebonlivraisons.quantiteliv)  as q FROM lignebonlivraisons where lignebonlivraisons.lignecommande_id=' . $l->id . ' ;')->fetchAll('assoc');
                                                $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                $stockk = $inv[0]['v'];
                                                //debug($stockk);
                                                $qteliv = $qte[0]['q'];
                                               /// if (  ($l->quantiteliv != $qteliv )  ) :
                                                    $i ++ ; 

                                                   /// debug($i);

                                                ?>
                                                <tr class="cc">
                                                    <td>

                                                        <?php echo $this->Form->control('article_id', array('label' => '',  'value' => $l->article_id, 'options' => $art, 'name' => 'data[ligne][' . $i . '][article_id]', 'id' => 'article_id' . $i,  'index' => $i, 'class' => 'form-control select2 articleQtest')); ?>

                                                    </td>
                                                    <td>

                                                        <?php echo $this->Form->input('id', array('value' => $l->id, 'name' => 'data[ligne][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                                        <?php

                                                        echo $this->Form->input('qtestock', array('name' => 'data[ligne][' . $i . '][qtestock]', 'readonly', 'value' => $stockk, 'label' => '', 'div' => 'form-group', 'table' => 'ligne', 'index' => $i, 'id' => 'qtestock' . $i, 'champ' => 'qtestock', 'type' => 'text', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ')); ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                        echo $this->Form->input('qte', array('value' => $l->qte, 'label' => '', 'name' => 'data[ligne][' . $i . '][qte]', 'table' => 'ligne', 'index' => $i, 'id' => 'qte' . $i, 'champ' => 'qte', 'type' => 'text', 'class' => 'form-control  ')); ?>

                                                    </td>
                                                    <td>
                                                        <?php

                                                        echo $this->Form->input('quantite', array('value' => $l->quantiteliv, 'label' => '', 'name' => 'data[ligne][' . $i . '][quantite]', 'table' => 'ligne', 'index' => $i, 'id' => 'quantite' . $i, 'champ' => 'quantite', 'type' => 'text', 'class' => 'form-control  getcalc htb number ')); ?>

                                                    </td>
                                                    <!-- <td>
                                                        <?php

                                                        echo $this->Form->input('qteliv', array('value' => '', 'label' => '', 'name' => 'data[ligne][' . $i . '][qteliv]', 'table' => 'ligne', 'index' => $i, 'id' => 'qteliv' . $i, 'champ' => 'qteliv', 'type' => 'text', 'class' => 'form-control calculBonrec')); ?>

                                                    </td> -->
                                                    <td>
                                                        <?php echo $this->Form->input('prix', array('value' => $l->prix, 'label' => '', 'name' => 'data[ligne][' . $i . '][prix]', 'table' => 'ligne', 'index' => $i, 'id' => 'prix' . $i, 'champ' => 'prix', 'type' => 'text', 'class' => 'form-control htb number getcalc getprixarticle', 'readonly')); ?>


                                                    </td>
                                                    <!-- <td>
                                                        <?php //echo $this->Form->input('remiseclient', array('value' => $commande->client->remise, 'label' => '', 'name' => 'data[ligne][' . $i . '][remiseclient]', 'table' => 'ligne', 'index' => $i, 'id' => 'remiseclient' . $i, 'champ' => 'remiseclient', 'type' => 'text', 'class' => 'form-control  getcalc htb number ')); 
                                                        ?>
                                                    </td>


                                                    <td>

                                                        <?php //echo $this->Form->input('remisearticle', array('value' => $l->article->remise, 'label' => '', 'name' => 'data[ligne][' . $i . '][remisearticle]', 'table' => 'ligne', 'index' => $i, 'id' => 'remisearticle' . $i, 'champ' => 'remisearticle', 'type' => 'text', 'class' => 'form-control  ')); 
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        foreach ($tvas as $t) {

                                                            if ($l->article->tva_id == $t->id) {
                                                                //  echo $t->valeur ;

                                                                // echo $this->Form->input('tva', array('value' => $t->valeur,  'label' => '', 'name' => 'data[ligne][' . $i . '][tva]', 'table' => 'ligne', 'index' => $i, 'id' => 'tva' . $i, 'champ' => 'tva_id', 'class' => 'form-control  getcalc htb number '));
                                                            }
                                                        } ?>
                                                        <?php  // echo $this->Form->input('monatantlignetva', array('value' => '', 'label' => '', 'name' => 'data[ligne][' . $i . '][monatantlignetva]', 'table' => 'ligne', 'index' => $i, 'id' => 'monatantlignetva' . $i, 'champ' => 'monatantlignetva', 'type' => 'hidden', 'class' => 'form-control ')); 
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php // echo $this->Form->input('fodec', array('value' => $l->article->fodec, 'label' => '', 'name' => 'data[ligne][' . $i . '][fodec]', 'table' => 'ligne', 'index' => $i, 'id' => 'fodec' . $i, 'champ' => 'fodec', 'type' => 'text', 'class' => 'form-control ')); 
                                                        ?>
                                                        <?php // echo $this->Form->input('fodeccl', array('value' => '', 'label' => '', 'name' => 'data[ligne][' . $i . '][fodeccl]', 'table' => 'ligne', 'index' => $i, 'id' => 'fodeccl' . $i, 'champ' => 'fodeccl', 'type' => 'hidden', 'class' => 'form-control ')); 
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php //echo $this->Form->input('tpe', array('value' =>  $l->article->tpe, 'label' => '', 'name' => 'data[ligne][' . $i . '][tpe]', 'table' => 'ligne', 'index' => $i, 'id' => 'tpe' . $i, 'champ' => 'tpe', 'type' => 'text', 'class' => 'form-control ')); 
                                                        ?>
                                                        <?php //echo $this->Form->input('totalttc', array('value' => '', 'label' => '', 'name' => 'data[ligne][' . $i . '][totalttc]', 'table' => 'ligne', 'index' => $i, 'id' => 'totalttc' . $i, 'champ' => 'totalttc', 'type' => 'hidden', 'class' => 'form-control ')); 
                                                        ?>
                                                        <?php //echo $this->Form->input('motanttotal', array('value' => '', 'label' => '', 'name' => 'data[ligne][' . $i . '][motanttotal]', 'table' => 'ligne', 'index' => $i, 'id' => 'motanttotal' . $i, 'champ' => 'motanttotal', 'type' => 'hidden', 'class' => 'form-control ')); 
                                                        ?>


                                                    </td> -->
                                                    <!-- <td align="center">
                                                        <br>
                                                        <i index="<?php echo $i ?>" class="fa fa-times supLigne0" style="color: #C9302C;font-size: 22px;">
                                                    </td> -->

                                                </tr>
                                                <?php /// endif; ?>
                                            <?php }
                                            // } 
                                            ?>
                                        </tbody>
                                    </table><br>
                                    <input type="hidden" value="<?php echo $i; ?>" id="index" />
                                </div>

                            </div>
                        </div>



                        <!-- <div class="col-xs-6">
                            <?php
                            // echo $this->Form->control('remise', ['id' => 'remise', 'class' => 'form-control  ', 'readonly', 'value' => '']); 
                            ?>
                        </div> -->
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('totalht', ['id' => 'ht', 'class' => 'form-control  ', 'readonly', 'value' => $commande->totalliv, 'label' => 'Total HT livrés']); ?>
                        </div>

                        <!-- <div class="col-xs-6">
                            <?php
                            // echo $this->Form->control('totalfodec', ['id' => 'totalfodec', 'class' => 'form-control', 'readonly', 'value' => '','label'=>'Total Fpdec']); 
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            //  echo $this->Form->control('totalttc', ['id' => 'ttc', 'class' => 'form-control  ', 'readonly', 'value' => '','label'=>'Total TTC']); 
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            //  echo $this->Form->control('tva', ['id' => 'tva', 'class' => 'form-control  ', 'readonly', 'value' => '']); 
                            ?>
                        </div> -->


                        <button type="submit" class="pull-right btn btn-success btn-sm verifqtee " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
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
            depot = $('#depot_id').val();
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
                    $('#qteStock' + index).focus();
                    $('#qte' + index).val('');


                }

            })

        })



    })
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


<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>


<?php $this->end(); ?>