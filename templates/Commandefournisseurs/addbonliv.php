<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php

use Cake\Datasource\ConnectionManager;

echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
    <h1>
        Ajout Bon Livraison Achat
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $typered]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <?php echo $this->Form->create($livraison, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
        ?>
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box">
                <div class="box-header with-border">

                    <section>




                        <div class="box-body">
                            <div class="row">


                                <div class="row">
                                    <div class="col-xs-6">
                                        <?php
                                        //debug($commandes);
                                        echo $this->Form->input('commandefournisseur_id', array('value' => $commandes['id'], 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden'));

                                        echo $this->Form->control('nmcmd', ['name' => 'nmcmd', 'label' => 'Commande numero', 'id' => 'nmcmd', 'value' => $nmc['num'], 'readonly' => 'readonly', 'type' => 'hidden']);

                                        echo $this->Form->control('numero', array('label' => 'Numéro', 'div' => 'form-group', 'readonly','value' => $b, 'class' => 'form-control')); ?>
                                    </div>
                                    <!-- <div class="col-xs-6">
                                        <?php
                                        // echo $this->Form->control('date', [
                                        //     'name' => 'date', 'readonly' => 'readonly', 'value' => date("Y-m-d H:i:s"),  'label' => 'Date', 'id' => 'datecommande', 'class' => "form-control pull-right"
                                        // ]);
                                        ?>
                                    </div> -->

                                    <div class="col-xs-6">
                                        <?php
                                        date_default_timezone_set('Africa/Tunis');
                                        $now = date('Y-m-d H:i:s');
                                        echo $this->Form->control('date', ['value' => $now, 'readonly' => 'readonly']);
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <?php
                                        echo $this->Form->control('fournisseur_id', ['value' => $commandes['fournisseur_id'], 'options' => $fournisseurs, 'class' => 'form-control select2 control-label', 'id' => 'fourniss']);
                                        ?> </div>
                                    <div class="col-xs-6">
                                        <?php
                                        echo $this->Form->control('depot_id', ['options' => $depot, 'class' => 'form-control select2 control-label', 'id' => 'depot']);
                                        ?> </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <?php
                                        echo $this->Form->control('blfournisseur', ['label' => 'N° BL Fournisseur', 'class' => 'form-control  control-label', 'id' => 'blfournisseur']);
                                        ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php echo $this->Form->control('observation', ['label' => 'Commentaire', 'class' => 'form-control', 'type' => 'textarea']); ?>
                                    </div>
                                </div>
                                <div class="col-xs-6" hidden>
                                    <?php
                                    echo $this->Form->control('service_id', [
                                        'label' => 'Service',
                                        'value' => $commandes['service_id'],
                                        'required' => 'off',
                                        'empty' => 'Veuillez choisir!!!',
                                        'class' => 'form-control select2 ',
                                        'type' => 'select',
                                        'options' => $services

                                    ]);
                                    ?>
                                </div>
                                <div class="col-xs-6" hidden>
                                    <?php
                                    echo $this->Form->control('machine_id', [
                                        'label' => 'Machine',
                                        'value' => $commandes['machine_id'],
                                        'required' => 'off',
                                        'empty' => 'Veuillez choisir!!!',
                                        'class' => 'form-control select2 ',
                                        'type' => 'select',
                                        'options' => $machines

                                    ]);
                                    ?>
                                </div>





                            </div>

                    </section>
                </div>
                <section class="content-header">
                    <h1 class="box-title"><?php echo __(' Les articles commandés'); ?></h1>
                </section>


                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">

                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                                        <thead>
                                            <tr width:20px>
                                                <td align="center" style="width: 12%;"><strong> Code</strong></td>
                                                <td align="center" style="width: 25%;"><strong> Designation</strong></td>

                                                <td align="center" style="width: 8%;"><strong>Qte</strong></td>
                                                <td align="center" style="width: 8%;"><strong>Reste</strong></td>

                                                <td align="center" style="width: 8%;"><strong>Qte Liv</strong></td>
                                                <td align="center" style="width: 8%;"><strong>PrixHT</strong></td>
                                                <td align="center" style="width: 10%;"><strong>PUNHT</strong></td>
                                                <td align="center" style="width: 3%;"><strong>Remise</strong></td>
                                                <td align="center" hidden style="width: 5%;"><strong>Fodec</strong></td>
                                                <td align="center" style="width: 5%;"><strong>Tva</strong></td>
                                                <td align="center" style="width: 10%;"><strong>TTC</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = -1;
                                            $totht = 0;
                                            $totttc = 0;
                                            $i = -1;
                                            foreach ($lignes as  $ligne) { //debug($ligne);
                                                $i++;
                                                $totht = $totht + $ligne['punht'];
                                                $totttc = $totht + $ligne['ttc'];


                                                $connection = ConnectionManager::get('default');
                                                $totalqteliv =  $connection->execute("
                                                               SELECT SUM(qteliv) AS total_qteliv
                                                               FROM lignelivraisons where lignelivraisons.lignecommandefournisseur_id =" . $ligne['id'] . ";")->fetchAll('assoc');


                                                //print_r($ligne['id']);
                                                // debug($ligne['qte']) ;
                                                // debug($totalqteliv[0]['total_qteliv']) ;
                                                // debug($ligne['qte'] - $totalqteliv[0]['total_qteliv']);
                                                if ($ligne['qte'] - $totalqteliv[0]['total_qteliv'] > 0) {



                                            ?>
                                                    <tr>

                                                        <td align="center">
                                                            <?php echo $this->Form->input('sup0', array('name' => 'data[ligner][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                            ?>
                                                            <?php
                                                            // foreach ($articless as $art ){
                                                            //  debug( $art);
                                                            echo $this->Form->input('id', array('value' => $ligne['id'], 'label' => '', 'name' => 'data[ligner][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));
                                                            echo $this->Form->control('code', array('readonly', 'style' => 'pointer-events:none', 'value' => $ligne->article->Code, 'label' => false, 'name' => 'data[ligner][' . $i . '][code]', 'id' => 'code' . $i, 'champ' => 'code', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  '));
                                                            echo $this->Form->control('article_id', array('readonly','options'=>$articles,'type'=>'hidden', 'style' => 'pointer-events:none', 'value' => $ligne->article->id, 'label' => false, 'name' => 'data[ligner][' . $i . '][article_id]', 'id' => 'article_id' . $i, 'champ' => 'article_id', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  '));

                                                            // }
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                          
                                                            <?php
                    
                                                            echo $this->Form->control('designiationA', array('readonly','style' => 'pointer-events:none', 'value' => $ligne->article->Dsignation, 'label' => false, 'name' => 'data[ligner][' . $i . '][designiationA]', 'id' => 'article_idd' . $i, 'champ' => 'article_idd', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  '));
                                                           
                                                            ?>
                                                        </td>
                                                        <!--                                <td align="center">
                                                    <?php
                                                    //echo $this->Form->input('codefrs',array('value'=>$ligne['codefrs'],'label'=>'','name'=>'data[ligner]['.$i.'][codefrs]','id'=>'codefrs'.$i,'champ'=>'codefrs','table'=>'ligner','index'=>$i,'div'=>'form-group','between'=>'<div class="col-sm-12">','after'=>'</div>','class'=>'form-control') );
                                                    ?>
                                                    </td>-->
                                                        <td align="center">
                                                            <?php

                                                            echo $this->Form->input('qte', array('type' => 'number', 'value' => $ligne['qte'], 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][qte]', 'id' => 'qtecmd' . $i, 'champ' => 'qte', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php

                                                            echo $this->Form->input('reste', array('type' => 'number', 'value' => $ligne['qte'] - $totalqteliv[0]['total_qteliv'], 'readonly' => 'readonly', 'label' => '', 'name' => 'data[ligner][' . $i . '][reste]', 'id' => 'reste' . $i, 'champ' => 'qte', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control '));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php

                                                            echo $this->Form->input('qtelivre', array('type' => 'number', 'step' => 'any', 'value' => '', 'label' => '', 'name' => 'data[ligner][' . $i . '][qtelivre]', 'id' => 'qte' . $i, 'champ' => 'qtelivre', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc verifierlivr '));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('prix', array('value' => $ligne['prix'], 'label' => '', 'name' => 'data[ligner][' . $i . '][prix]', 'id' => 'prix' . $i, 'champ' => 'prix', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('punht', array('readonly' => 'readonly', 'value' => $ligne['ht'], 'label' => '', 'name' => 'data[ligner][' . $i . '][punht]', 'id' => 'punht' . $i, 'champ' => 'punht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('remise', array('value' => $ligne['remise'], 'label' => '', 'name' => 'data[ligner][' . $i . '][remise]', 'id' => 'remise' . $i, 'champ' => 'remise', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>

                                                        <td align="center" hidden>
                                                            <?php
                                                            echo $this->Form->input('fodec', array('value' => $ligne['fodec'], 'label' => '', 'name' => 'data[ligner][' . $i . '][fodec]', 'id' => 'fodec' . $i, 'champ' => 'fodec', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('tva', array('value' => $ligne['tva'], 'label' => '', 'name' => 'data[ligner][' . $i . '][tva]', 'id' => 'tva' . $i, 'champ' => 'tva', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text')); ?>
                                                        </td>


                                                        <td align="center">
                                                            <?php
                                                            echo $this->Form->input('ttc', array('readonly' => 'readonly', 'value' => $ligne['ttc'], 'label' => '', 'name' => 'data[ligner][' . $i . '][ttc]', 'id' => 'ttc' . $i, 'champ' => 'ttc', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htbc', 'type' => 'text'));
                                                            ?>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>


                                            <input type="hidden" value="<?php echo $i ?>" id="index0">

                                        </tbody>

                                    </table><br>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    echo $this->Form->control('remise', array('value' => sprintf('%.3f', @$commandes['remise']), 'readonly' => 'readonly', 'id' => 'remise', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));
                                    echo $this->Form->control('tva', array('value' => sprintf('%.3f', @$commandes['tva']), 'readonly' => 'readonly', 'id' => 'tva', 'label' => 'TVA', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));
                                    echo $this->Form->control('fodec', array('value' => sprintf('%.3f', @$commandes['fodec']), 'readonly' => 'readonly', 'id' => 'fodec', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden'));
                                    ?></div>
                                <div class="col-md-6"><?php
                                                        echo $this->Form->control('ht', array('id' => 'ht', 'value' => sprintf('%.3f', @$commandes['ht']), 'readonly' => 'readonly', 'label' => 'HT', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));

                                                        echo $this->Form->control('ttc', array('value' => sprintf('%.3f', @$commandes['ttc']), 'readonly' => 'readonly', 'id' => 'ttc', 'label' => 'TTC', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'text'));
                                                        ?>
                                </div>

                            </div>
                        </div>
                    </div>




                    <div class="" id="verifierlivraison" align="center" class="btn btn-primary ">
                        <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'bonliv', 'class' => ' btn btn-success btnajout verifierlivraison']); ?>
                    </div>



                    <?php echo $this->Form->end(); ?>



                </section>

            </div>

        </div>


    </div>






</section>








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

        $("form").submit(function() {
            $('#bonliv').attr('disabled', 'disabled');
        })
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
    $('.btnajout').on('mouseover', function() {
        //alert('dalanda')
        numero = $('#numero').val();
        depot = $('#depot-id').val();
        fournisseur = $('#fournisseur-id').val();
        if (numero == '') {
            alert('choisir numéro SVP !!', function() {});
        }
        // if (fournisseur == '') {
        //     alert('choisir fournisseur SVP !!', function() {});
        // }
        // //alert(namepv)
        // if (depot == '') {
        //     alert('choisir depot SVP !!', function() {});
        // }

    });
</script>
<?php $this->end(); ?>