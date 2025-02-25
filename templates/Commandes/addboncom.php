<?php

use Cake\Datasource\ConnectionManager;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('mahdi'); ?>

<section class="content-header">
    <h1>
        Ajout commande retour marchandise
    </h1>
    <ol class="breadcrumb">

        <a href="<?php echo $this->Url->build(['controller' => 'Bonreceptionstocks', 'action' => 'index/']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>

    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box ">
                <?php echo $this->Form->create($commande, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">

                    <div class="row">

                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('numero', ["value" => $mm, 'readonly' => 'readonly']);


                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))  ,'type'=>'date','class'=>'form-control']); ?>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('depot_id', ['options' => $depots, 'value' => 34, 'required' => 'off', 'label' => 'Depots', 'class' => 'form-control select2 control-label']); ?>

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


                    </div>

                </div>

                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Ligne commande retour marchandise'); ?></h1>
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
                                                <td align="center" style="width: 45%; font-size: 13px;"><strong>Article</strong></td>
                                                <td align="center" style="width: 15%;font-size: 13px;"><strong>Quantité réceptionnelle </strong></td>
                                                <td align="center" style="width: 15%;font-size: 13px;"><strong>Quantité livrée </strong></td>
                                                <td align="center" style="width: 15%;font-size: 13px;"><strong>Prix</strong></td>
                                                <td align="center" style="width: 8%;font-size: 13px;"><strong> </strong></td>

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
                                                    echo $this->Form->input('quantite', array('class' => ' form-control calculHT', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'quantite', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>
                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('quantiteliv', array('class' => ' form-control calculHT focus', 'label' => '', 'index' => '', 'champ' => 'quantiteliv', 'table' => 'ligne', 'name' => '', 'id' => '', 'type' => 'text'));
                                                    ?>
                                                </td>

                                                <td align="center" table="ligne">
                                                    <?php
                                                    echo $this->Form->input('prix', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'prix', 'table' => 'ligne', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>


                                                <td align="center">
                                                    <i class="fa fa-times supp" style="color: #c9302c;font-size: 22px;"></i>
                                                </td>
                                            </tr>

                                            <?php

                                            $i = -1;
                                            foreach ($lignes as $l) {
                                                // debug($l);
                                                $articleid =  $l->article_id;
                                                $depotid = $bonreception->depot_id;
                                                date_default_timezone_set('Africa/Tunis');
                                                $date = date('Y-m-d H:i:s');
                                                $connection = ConnectionManager::get('default');
                                                $qte = $connection->execute('SELECT SUM(lignecommandes.quantiteliv)  as q FROM lignecommandes where lignecommandes.lignebonreceptionstock_id=' . $l->id . ' ;')->fetchAll('assoc');
                                                $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                $stockk = $inv[0]['v'];
                                                //debug($stockk);
                                                $qteliv = $qte[0]['q'];
                                                /// debug($qteliv);
                                                if ($l->qte != $qteliv) :
                                                    $i++;
                                            ?>

                                         
                                                    <tr class="cc">
                                                        <td>
                                                            <?php echo $this->Form->input('sup', array('name' => "data[ligne][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden')); ?>

                                                            <label></label>
                                                            <select name="<?php echo "data[ligne][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="ligne" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleQtest">
                                                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                                <?php foreach ($articles as $j => $article) {
                                                                ?>
                                                                    <option <?php if ($l->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                <?php }


                                                                ?>
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <?php

                                                            echo $this->Form->input('quantite', array('value' => $l->qte - $qteliv, 'label' => '', 'name' => 'data[ligne][' . $i . '][quantite]', 'table' => 'ligne', 'index' => $i, 'id' => 'quantite' . $i, 'champ' => 'quantite', 'type' => 'text', 'class' => 'form-control  calculHT', 'readonly')); ?>

                                                        </td>

                                                        <td>

                                                            <?php echo $this->Form->input('id', array('value' => $l->id, 'name' => 'data[ligne][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'ligne', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                                            <?php

                                                            echo $this->Form->input('quantiteliv', array('name' => 'data[ligne][' . $i . '][quantiteliv]', 'value' => $l->qte - $qteliv, 'label' => '', 'div' => 'form-group', 'table' => 'ligne', 'index' => $i, 'id' => 'quantiteliv' . $i, 'champ' => 'quantiteliv', 'type' => 'text', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculHT ')); ?>

                                                        </td>

                                                        <td>
                                                            <?php echo $this->Form->input('prix', array('value' => $l->article->Prix_LastInput, 'label' => '', 'name' => 'data[ligne][' . $i . '][prix]', 'table' => 'ligne', 'index' => $i, 'id' => 'prix' . $i, 'champ' => 'prix', 'type' => 'text', 'class' => 'form-control htb number getcalc getprixarticle', 'readonly')); ?>


                                                        </td>



                                                        <td align="center">
                                                            <br>
                                                            <!-- <i index="<?php echo $i ?>" class="fa fa-times supp" style="color: #C9302C;font-size: 22px;"> -->
                                                        </td>

                                                    </tr>
                                                <?php endif; ?>

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
                        foreach ($lignes as $i => $l) {

                            $qte = $l->qte;
                            $p  = $l->article->Prix_LastInput;
                            $tot = $qte * $p;
                            $total += $tot;
                        }


                        ?>


                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('total', ['id' => 'tot', 'class' => 'form-control  ', 'readonly', 'value' => $total, 'label' => 'Total HT réceptionnelle']); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('totalliv', ['id' => 'ht', 'class' => 'form-control  ', 'readonly', 'value' => $total, 'label' => 'Total HT livrés']); ?>
                        </div>






                        <button type="submit" class="pull-right btn btn-success btn-sm Qteliv  " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
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
                    $('#qteStock' + index).focus();
                    $('#qte' + index).val('');
                    $('#quantiteliv' + index).focus();



                }

            })

        })
        $('.calculHT').on('keyup', function() {
            Calcul();
        })


        $('.supp').on('click', function() {

            i = $(this).attr('index');
            index = $('#index').val();

            $('#sup' + i).val('1');
            $(this).parent().parent().hide();

            Calcul(i);


        });

        $('.Qteliv').on('mouseover', function() {
            index = $('#index').val();
          ////  alert(index);
            for (j = 0; j <= Number(index); j++) {
                sup = $('#sup' + j).val();
                article_id = $('#article_id' + j).val();
               /// alert(article_id)
                quantiteliv = $('#quantiteliv' + j).val();

                if ((article_id == null || article_id == '') && (sup != 1)) {
                    alert('Selectionnez un article', function() {});
                    return false;
                } else if ((quantiteliv == '') && (sup != 1)) {
                    alert('Saisi une quantite livrée', function() {});
                    return false;
                }


            }

        });






    })

    function Calcul() {
        ///  alert('hechem')


        index = $('#index').val();

        totalht = 0;
        totalhtliv = 0;

        /// alert(ht)


        for (i = 0; i <= index; i++) {
            sup = $('#sup' + i).val() || 0;

            if (Number(sup) != 1) {

                prix = $('#prix' + i).val() || 0;
                qteliv = $('#quantiteliv' + i).val() || 0;
                qte = $('#quantite' + i).val() || 0;




                tot = Number(prix) * Number(qteliv);
                // alert(tot)
                totalhtliv = Number(tot) + Number(totalhtliv);


                tott = Number(prix) * Number(qte);
                totalht = Number(tott) + Number(totalht);

            }
        }

        $('#ht').val(Number(totalhtliv).toFixed(3));
        $('#tot').val(Number(totalht).toFixed(3));



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