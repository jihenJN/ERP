<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inventaire $inventaire
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->fetch('script'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Modification Retenu Facture Client
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

                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($retenu, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box-body">
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('numero', ['label' => 'Numéro',  'readonly']); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('date', ['label' => 'Date', 'id' => 'date']); ?>
                    </div>

                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('client_id', ['label' => 'Client', 'readonly', 'options' => $clients, 'empty' => 'Veuillez choisir !!', 'id' => 'client_id', 'class' => 'form-control clientfacture ']); ?>
                    </div>


                </div>

                <section class="content-header">
                    <h1 class="box-title"><?php echo __('Ligne Retenu'); ?></h1>
                </section>

                <section class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">
                                <a class="btn btn-primary al ajouter_ligne_inventaire" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                    <i class="fa fa-plus-circle "></i> </a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                                        <thead>
                                            <tr>
                                                  <td align="center" style="width: 20%;"><strong>Facture</strong></td>
                                                    <td align="center" style="width: 10%;"><strong>Date</strong></td>

                                                    <td align="center" style="width: 15%;"><strong>Montant Brut</strong></td>
                                                    <td align="center" style="width: 10%;"><strong>Taux</strong></td>

                                                    <td align="center" style="width: 15%;"><strong>Retenu</strong></td>
                                                    <td align="center" style="width: 15%;"><strong>Montant Net</strong></td>

                                                    <td align="center" style="width: 5%;"></td>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr" style="display: none !important">
                                                <td align="center" table="ligner">
                                                    <!-- <label></label> -->
                                                    <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">

                                                    <select table="ligner" index champ="factureclient_id" class=" form-control js-example-responsive facturedet montantbrut ">
                                                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                        <?php foreach ($factureclients as $id => $fac) {
                                                        ?>
                                                            <option value="<?php echo $fac->id; ?>"><?php echo $fac->numero  ?></option>
                                                        <?php } ?>
                                                    </select>

                                                    <?php
                                                    ?>
                                                <td align="center" table="ligner">
                                                    <?php
                                                    echo $this->Form->control('date', ['class' => ' form-control', 'label' => false, 'id' => 'date', 'index' => '', 'champ' => 'date', 'table' => 'ligner', 'name' => '', 'id' => '', 'readonly' => true]); ?>
                                                </td>
                                                <td align="center" table="ligner">
                                                    <?php
                                                    echo $this->Form->input('totalttc', array('class' => ' form-control montantbrut',  'value' => '0', 'label' => false, 'index' => '', 'champ' => 'totalttc', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                                                    ?>
                                                     <?php
                                                        echo $this->Form->input('timbre', array('class' => ' form-control montantbrut', 'step' => 'any', 'type' => 'hidden', 'value' => '0', 'label' => '', 'index' => '', 'champ' => 'timbre', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                                                        ?>
                                                         <?php
                                                        echo $this->Form->control('timbre_id', array('class' => ' form-control montantbrut', 'step' => 'any', 'type' => 'hidden', 'value' => '0', 'label' => '', 'index' => '', 'champ' => 'timbre_id', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                                                        ?>
                                                </td>
                                                <td align="center" table="ligner">


                                                    <?php
                                                    echo $this->Form->control('to_id', array('class' => ' form-control  montantbrut', 'options' => $tos, 'label' => false, 'index' => '', 'champ' => 'taux', 'table' => 'ligner', 'name' => '', 'id' => 'taux'));
                                                    ?>
                                                </td>





                                                <td align="center" table="ligner">


                                                    <?php
                                                    echo $this->Form->input('montant', array('class' => ' form-control', 'type' => 'number', 'value' => '0', 'label' => '', 'index' => '', 'champ' => 'montant', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>
                                                <td align="center" table="ligner">


                                                    <?php
                                                    echo $this->Form->input('montant_net', array('class' => ' form-control', 'type' => 'number', 'value' => '0', 'label' => '', 'index' => '', 'champ' => 'montant_net', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                                                    ?>
                                                </td>
                                                <td align="center">

                                                    <i index="0" id="" class="fa fa-times supLigne2 montantbrut" style="color: #c9302c;font-size: 22px;"></i>
                                                </td>
                                            </tr>
                                            <?php
                                            $i = -1;

                                            foreach ($lignes as $i => $li) :
                                            ?>
                                                <tr>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('sup', array('name' => 'data[ligner][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden', 'class' => 'form-control'));
                                                        ?>
                                                        <?php echo $this->Form->input('id', array('label' => '', 'value' => $li->id, 'name' => 'data[ligner][' . $i . '][id]', 'type' => 'hidden', 'id' => 'name' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'class' => 'form-control')); ?>
                                                        <?php //echo $this->Form->control('article_id', array('class' => 'form-control  select2','label' => '','empty'=>'Veuillez choisir !!', 'value' => $li->article_id, 'champ' =>'article_id' ,'name' => 'data[ligner][' . $i . '][article_id]', 'id' => 'article_id' .$i, 'table' => 'ligner', 'index' => $i)); 
                                                        ?>



                                                        <!-- <label></label> -->
                                                        <select name="<?php echo "data[ligner][" . $i . "][factureclient_id]" ?>" id="<?php echo 'factureclient_id' . $i ?>" table="ligner" index="<?php echo $i ?>" champ="factureclient_id" class=" form-control js-example-responsive  facturedet montantbrut ">
                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                            <?php foreach ($factureclients as $id => $fac) {
                                                            ?>
                                                                <option <?php if ($li->factureclient_id == $fac->id) { ?> selected="selected" <?php } ?> value="<?php echo $fac->id; ?>"><?php echo $fac->numero  ?></option>
                                                            <?php } ?>
                                                        </select>


                                                    </td>
                                                    <td align="center" table="ligner">
                                                        <?php
                                                        echo $this->Form->control('date', ['class' => ' form-control', 'label' => false, 'value' => $li->date, 'index' => $i, 'champ' => 'date', 'table' => 'ligner', 'name' => 'data[ligner][' . $i . '][date]', 'id' => 'date' . $i, 'readonly' => true]); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->control('totalttc', array('class' => 'form-control montantbrut', 'label' => false, 'value' => $li->totalttc, 'champ' => 'totalttc', 'name' => 'data[ligner][' . $i . '][totalttc]', 'id' => 'totalttc' . $i, 'table' => 'ligner', 'index' => $i)); ?>
                                                        <?php echo $this->Form->control('timbre', array('type'=>'hidden','class' => 'form-control montantbrut', 'label' => false, 'value' => $li->factureclient->timbre->timbre, 'champ' => 'timbre', 'name' => 'data[ligner][' . $i . '][timbre]', 'id' => 'timbre' . $i, 'table' => 'ligner', 'index' => $i)); ?>
                                                        <?php echo $this->Form->control('timbre_idd', array('type'=>'hidden','class' => 'form-control montantbrut', 'label' => false, 'value' => $li->timbre_id, 'champ' => 'timbre_id', 'name' => 'data[ligner][' . $i . '][timbre_id]', 'id' => 'timbre_id' . $i, 'table' => 'ligner', 'index' => $i)); ?>

                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->control('to_id', array('class' => 'form-control montantbrut ', 'options' => $tos, 'label' => false, 'value' => sprintf("%01.3f", $li->to_id), 'champ' => 'taux', 'name' => 'data[ligner][' . $i . '][taux]', 'id' => 'taux' . $i, 'table' => 'ligner', 'index' => $i)); ?>

                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->control('montant', array('class' => 'form-control ', 'label' => false, 'value' => sprintf("%01.3f", $li->montant), 'readonly', 'champ' => 'montant', 'name' => 'data[ligner][' . $i . '][montant]', 'id' => 'montant' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

                                                    </td>

                                                    <td align="center">
                                                        <?php echo $this->Form->control('montant_net', array('class' => 'form-control ', 'label' => false, 'value' => sprintf("%01.3f", $li->montant_net), 'readonly', 'champ' => 'montant_net', 'name' => 'data[ligner][' . $i . '][montant_net]', 'id' => 'montant_net' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

                                                    </td>




                                                    <td align="center">

                                                        <i index="<?php echo $i ?>" class="fa fa-times supLigne2 montantbrut" style="color: #C9302C;font-size: 22px;">
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <input type="hidden" value="<?php echo $i ?>" id="index">

                                        </tbody>
                                    </table><br>
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
                                    <?php echo $this->Form->control('total', ['id' => 'total', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Total', 'name', 'required' => 'off']); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>



                <!-- /.box-body -->
                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                    <!-- <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'inventaire']); ?> -->
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>

<script>
    $('.select2').select2({

    })




    /////////////////
</script>
<script>
    $(document).ready(function() {
        calmontant();
    });
    $(document).ready(function() {

        $('.montantbrut').on('keyup change', function() {
            calmontant();
        });

        $('.facturedet').on('change', function() {

            index = $(this).attr('index');
            factureclient_id = $('#factureclient_id' + index).val();


            $.ajax({
                method: "GET",
                type: "GET",
                url: "<?= $this->Url->build(['controller' => 'Retenus', 'action' => 'getttcfacture']) ?>",
                dataType: "JSON",
                data: {
                    idfacture: factureclient_id,


                },
                success: function(data) {
                    //  alert(data.qtes)
                    $('#date' + index).val(data.date);
                    $('#timbre' + index).val(parseFloat(data.timbre).toFixed(3));
                    $('#timbre_id' + index).val(data.timbre_id);
                    $('#totalttc' + index).val(parseFloat(data.ttc).toFixed(3));
                    //   $('#qteStock' + index).focus();
                    calmontant();
                }

            })

        })
        $('.supLigne2').on('click', function() {

            index = $('#index').val();
            ind = $(this).attr('index');

            $('#sup' + ind).val(1);

            $(this).parent().parent().hide();

            calmontant()

        });

    });

    function calmontant() {
        ind = $(this).attr('index');
        index = $('#index').val();
        tt = 0;
        for (var i = 0; i <= index; i++) {

            montantbrut = $('#totalttc' + i).val() || 0;
            timbre = $('#timbre' + i).val() || 0;
            t = $('#taux' + i).val();
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
            // alert(taux);
            sup = $('#sup' + i).val();

            if (sup != 1) {
                retenue = (montantbrut * (taux / 100)).toFixed(3);
                $('#montant' + i).val(parseFloat(retenue).toFixed(3));
                net = (Number(timbre) + Number(montantbrut)) - Number(retenue);
                $('#montant_net' + i).val(parseFloat(net).toFixed(3));
                tt = Number(tt) + Number(retenue);
            }
        }

        console.log(tt);
        $('#total').val((tt).toFixed(3));

    }
</script>
<?php $this->end(); ?>