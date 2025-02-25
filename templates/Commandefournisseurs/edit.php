<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commande $commande
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
    <h1>
        Modification Commande Achat
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo __(''); ?></h3>
                </div>

                <?php echo $this->Form->create($commande, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
                //debug($commande);
                ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numero', ['readonly' => 'readonly']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('date', ['readonly' => 'readonly', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control']); ?>



                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('fournisseur_id', ['class' => 'select2 form-control', 'options' => $fournisseurs, 'empty' => true]); ?>
                        </div>

                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('depot_id', ['empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control', 'options' => $depots]); ?>
                        </div>

                        <div class="col-xs-6" hidden>
                            <?php
                            echo $this->Form->control('service_id', [
                                'label' => 'Service',
                                'required' => 'off',
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'style' => 'text-align:right',
                                'type' => 'select',
                                'options' => $services

                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6" hidden>
                            <?php
                            echo $this->Form->control('machine_id', [
                                'label' => 'Machine',
                                'required' => 'off',
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'type' => 'select',
                                'options' => $machines

                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
                        </div>
                    </div>
                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Les articles commandes'); ?></h1>
                    </section>



                    <section class="content" style="width: 99%">
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">

                                    <a class="btn btn-primary " table='addtable' index='index' id='ajouter_ligne0' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                        <i class="fa fa-plus-circle "></i> Ajouter article</a>

                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                                            <thead>
                                                <tr>
                                                    <td align="center" style="width: 15%;"><strong>Code</strong> </td>
                                                    <td align="center" style="width: 25%;"><strong>Designation</strong> </td>
                                                    <td align="center" style="width: 10%;"><strong>Qté</strong></td>
                                                    <td align="center" style="width: 10%;"><strong>PrixHt</strong></td>
                                                    <td align="center" style="width: 10%;"><strong>PUNHT</strong></td>
                                                    <td align="center" style="width: 5%;"><strong>Remise</strong></td>
                                                    <td hidden align="center" style="width: 5%;"><strong>Fodec</strong></td>
                                                    <td align="center" style="width: 5%;"><strong>Tva</strong></td>
                                                    <td align="center" style="width: 10%;"><strong>TTC</strong></td>
                                                    <td align="center" style="width: 10%;"><strong></strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($lignecommandes as $i => $res) : //debug($res);

                                                ?>
                                                    <tr style="font-size: 18px;font-weight: bold;">


                                                        <td champ="tdcode">
                                                            <input table="ligner" index="<?php echo $i ?>" class="getdesignation articleidbl1" id="article_idcode<?php echo $i ?>" champ="article_idcode"
                                                                type="text" list="codearticle_id<?php  echo $i ?>"
                                                                value="<?php echo htmlspecialchars($res->article->Code, ENT_QUOTES, 'UTF-8'); ?>">
                                                            <datalist table="ligner" index="<?= h($i) ?>"
                                                                id="codearticle_id<?php echo $i; ?>"
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
                                                                value="<?php echo htmlspecialchars($res->article->Dsignation, ENT_QUOTES, 'UTF-8'); ?>">
                                                            <datalist table="ligner" index="<?php echo $i ?>"
                                                                id="desarticle_id<?php echo $i?>"
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
                                                            <?php
                                                            echo $this->Form->input('article_idd', ['name' => 'data[ligner][' . $i . '][article_idd]','value'=>$res->article_id, 'id' => 'article_idd' . $i, 'champ' => 'article_idd', 'table' => 'ligner', 'index' =>  $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control']);
                                                            ?>
                                                            <?php echo $this->Form->input('sup0', ['name' => 'data[ligner][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control ']);

                                                            echo $this->Form->input('id', array('label' => '', 'value' => $res['id'], 'name' => 'data[ligner][' . $i . '][id]', 'type' => 'hidden', 'id' => 'name' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'class' => 'form-control')); ?>
                                                            <?php
                                                            echo $this->Form->input('qte', array('value' => $res['qte'], 'label' => '', 'name' => 'data[ligner][' . $i . '][qte]', 'id' => 'qte' . $i, 'champ' => 'qte', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control vali htbc'));
                                                            ?>
                                                        </td>
                                                        <td align="center" champ='tt'>
                                                            <?php
                                                            echo $this->Form->input('prix', array('value' => $res['prix'], 'label' => '', 'name' => 'data[ligner][' . $i . '][prix]', 'id' => 'prix' . $i, 'champ' => 'prix', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc vali', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('punht', array('value' => $res['ht'], 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][punht]', 'id' => 'punht' . $i, 'champ' => 'punht', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('remisee', array('value' => $res['remise'], 'label' => '', 'name' => 'data[ligner][' . $i . '][remise]', 'id' => 'remise' . $i, 'champ' => 'remise', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>

                                                        <td align="center" hidden>
                                                            <?php
                                                            echo $this->Form->input('fodec', array('value' => $res['fodec'], 'label' => '', 'name' => 'data[ligner][' . $i . '][fodec]', 'id' => 'fodec' . $i, 'champ' => 'fodec' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>


                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('tva', array('value' => $res['tva'], 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'id' => 'tva' . $i, 'champ' => 'tva', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc ajoutligneeetva', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('ttc', array('value' => $res['ttc'], 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][ttc]', 'id' => 'ttc' . $i, 'champ' => 'ttc', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center"><i index="<?php echo $i ?>" id="" class="fa fa-times supLigne20" style="color: #c9302c;font-size: 22px;"></td>


                                                    </tr>

                                                <?php endforeach; ?>
                                                <tr class='tr' style="display: none !important;font-size: 18px;font-weight: bold;">

                                                    <td champ="tdcode"><input table="ligner" index="" class="getdesignation articleidbl1" champ="article_idcode" type="text">

                                                        <datalist table="ligner" index="" champ="codearticle_id">
                                                            <?php //debug($articles);
                                                            foreach ($articles as $id => $article) {
                                                                //debug($article); 
                                                            ?>
                                                                <option value="<?php echo $article->Code; ?>">

                                                                </option>

                                                            <?php } ?>
                                                        </datalist>


                                                    </td>
                                                    <td champ="tddes">
                                                        <input table="ligner" index="" class="getcode articleidbl1des" champ="article_iddes" type="text">

                                                        <datalist table="ligner" index="" champ="desarticle_id">
                                                            <?php foreach ($articles as $id => $article) { ?>
                                                                <option value="<?php echo $article->Dsignation; ?>">

                                                                </option>

                                                            <?php } ?>
                                                        </datalist>
                                                    </td>
                                                    <td align="center">
                                                    <?php
                                                        echo $this->Form->input('article_idd', ['name' => '', 'id' => '', 'champ' => 'article_idd', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control']);
                                                        ?>
                                                        <?php echo $this->Form->input('sup0', ['name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                                        <?php
                                                        echo $this->Form->input('qte', array('value' => '', 'label' => '', 'name' => '', 'id' => '', 'champ' => 'qte', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control vali focus htbc'));
                                                        ?>
                                                    </td>
                                                    <td align="center" champ='tt'>
                                                        <?php
                                                        echo $this->Form->input('prix', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'prix', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc vali', 'type' => 'text'));
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('punht', array('readonly' => 'readonly', 'label' => '', 'name' => '', 'id' => '', 'champ' => 'punht', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('remise', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'remise', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                        ?>
                                                    </td>

                                                    <td align="center" hidden>
                                                        <?php
                                                        echo $this->Form->input('fodec', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'fodec', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                        ?>
                                                    </td>


                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('tva', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'tva', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc ajoutligneeetva', 'type' => 'text'));
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php
                                                        echo $this->Form->input('ttc', array('readonly' => 'readonly', 'label' => '', 'name' => '', 'id' => '', 'champ' => 'ttc', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                        ?>
                                                    </td>

                                                    <td align="center"><i index="" id="" class="fa fa-times supLigne20" style="color: #c9302c;font-size: 22px;"></td>

                                                </tr>




                                                <input type="hidden" value="<?php echo $i ?>" id="index0">

                                            </tbody>

                                        </table>

                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->control('remise', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->remise), 'id' => 'remise', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));
                                            echo $this->Form->control('tva', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->tva), 'id' => 'tva', 'label' => 'TVA', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));
                                            echo $this->Form->control('fodec', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->fodec), 'id' => 'fodec', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden'));

                                            ?></div>
                                        <div class="col-md-6"><?php
                                                                echo $this->Form->control('ht', array('readonly' => 'readonly', 'id' => 'ht', 'value' => sprintf('%.3f', $commande->ht), 'label' => 'HT', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));

                                                                echo $this->Form->control('ttc', array('readonly' => 'readonly', 'value' => sprintf('%.3f', $commande->ttc), 'id' => 'ttc', 'label' => 'TTC', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));

                                                                ?>
                                        </div>


                                        <br>



                                    </div>
                                    <!--Table Wrapper Finish-->
                                </div>

                            </div>
                        </div>
                        <!-- <div align="center" class="addcmd" id="e1">
                            <?php echo $this->Form->submit(__('Enregistrer')); ?>
                        </div> -->

                        <div align="center" id="e1" class="addcmd">
                            <?= $this->Form->button('Enregistrer', ['type' => 'submit',  'class' => 'btn btn-success']) ?>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </section>













                    <!--                        echo $this->Form->control('valide');
                        echo $this->Form->control('remise');
                        echo $this->Form->control('tva');
                        echo $this->Form->control('fodec');
                        echo $this->Form->control('ttc');
                        echo $this->Form->control('ht');
                       ;
                        ?>-->
                </div>
                <!-- /.box-body -->



                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(document).ready(function() {
        calculeachat();
    })
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
<script>
      $(document).ready(function() {
        $('.getcode').on('change', function() {
            index = $(this).attr('index'); //alert(index);
            selectedcodename = $(this).val(); //alert(selectedcodename);
            if (selectedcodename !== "") {

                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getcode']) ?>",
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
                    url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getdesignation']) ?>",
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
        $(function() {

            function getdesignation(selectedcodename, index) {

                // selectedcodename = $(this).val();
                // alert(selectedcodename);
                // index = $(this).attr('index');//alert(index);
                // electedcodename = $(this).val();//alert(selectedcodename);

                if (selectedcodename !== "") {

                    $.ajax({
                        method: "GET",
                        url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getdesignation']) ?>",
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
                        url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getcode']) ?>",
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
    });
    $(function() {
        // $('.articleidbl1').on('change', function() {
        //     //   alert("hh");
        //     index = $(this).attr('index');
        //     // alert(inde);
        //     article_id = $('#article_id' + index).val();
        //     fournisseur_id = $('#frs').val();
        //     //  alert(fournisseur_id);

        //     //alert(depot_id);
        //     $.ajax({
        //         method: "GET",
        //         type: "GET",
        //         url: "<?= $this->Url->build(['controller' => 'Commandefournisseurs', 'action' => 'getquantite']) ?>",
        //         dataType: "JSON",
        //         data: {
        //             idarticle: article_id,
        //             idfournisseur: fournisseur_id,
        //         },
        //         success: function(response) {
        //             //alert("rrrr");
        //             //alert(response.ligne);
        //             $('#remise' + index).val(response.remise);
        //             $('#prix' + index).val(response.lignep);
        //             $('#fodec' + index).val(response.lignef);
        //             $('#tva' + index).val(response.lignet);
        //             $('#qte' + index).focus();

        //             // qtestockx = response['qtestockx'];
        //             //    alert(response.lignep);


        //         }
        //     })
        // });
        $('.articleidbl1des').on('change', function() {
            // alert("hh");
            index = $(this).attr('index');
            //  alert(index);
            article_id = $('#article_iddes' + index).val(); //alert(article_id);
            //alert(article_id);
            // datecreation = $('#date').val();
            idClient = $('#fournisseur-id').val();
            // depot_id = $('#depot_id').val(); //alert(depot_id)
            //alert(depot_id);
            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getquantitedes']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    // idadepot: depot_id,
                    // idClient: idClient,
                    // date: datecreation,
                },
                success: function(response) {
                    //  alert(response);
                    // qtestockx = response['inv'];

                    // $('#qteStock' + index).val(qtestockx);
                    $('#prix' + index).val(response['donnearticle']["Prix_LastInput"]);
                    // val = (Number(response['donnearticle']["Prix_LastInput"]) * (1 - (response['donnearticle']["remise"] / 100)) * (1 + (Number(response['donnearticle']["tva"]["valeur"]) / 100))); //*(1+(Number(remise) / 100)) /*+ ((Number(puttc) - (puttc * (Number(tva) / 100))) * (Number(remise) / 100))*/;
                    // $('#puttc' + index).val(val.toFixed(3));
                    // $('#ml' + index).val(response['donnearticle']["ml"]);
                    $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);
                    // $('#fodec' + index).val(response['donnearticle']["fodec"]);
                    // $('#remise' + index).val(response['donnearticle']["remise"]);
                    $('#article_idd' + index).val(response['donnearticle']["id"]);
                    $('#qte' + index).focus();


                    // Calcul();
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
            idClient = $('#fournisseur-id').val();
            // depot_id = $('#depot_id').val(); //alert(depot_id)
            //alert(depot_id);
            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Livraisons', 'action' => 'getquantitecode']) ?>",
                dataType: "JSON",
                data: {
                    idarticle: article_id,
                    // idadepot: depot_id,
                    // idClient: idClient,
                    // date: datecreation,
                },
                success: function(response) {
                    //  alert(response);
                    // qtestockx = response['inv'];

                    // $('#qteStock' + index).val(qtestockx);
                    // //  response['donnearticle']["remise"]=20;
                    // $('#prix' + index).val(response['donnearticle']["Prix_LastInput"]);
                    // val = (Number(response['donnearticle']["Prix_LastInput"]) * (1 - (response['donnearticle']["remise"] / 100)) * (1 + (Number(response['donnearticle']["tva"]["valeur"]) / 100))); //*(1+(Number(remise) / 100)) /*+ ((Number(puttc) - (puttc * (Number(tva) / 100))) * (Number(remise) / 100))*/;
                    // $('#puttc' + index).val(val.toFixed(3));
                    // $('#ml' + index).val(response['donnearticle']["ml"]);
                    $('#tva' + index).val(response['donnearticle']["tva"]["valeur"]);
                    // $('#fodec' + index).val(response['donnearticle']["fodec"]);
                    // $('#remise' + index).val(response['donnearticle']["remise"]);
                    $('#article_idd' + index).val(response['donnearticle']["id"]);
                    $('#qte' + index).focus();


                }
            })
        });
    });
</script>
<?php $this->end(); ?>