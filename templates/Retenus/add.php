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
        Ajout Retenu

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
</section>


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
                        echo $this->Form->control('numero', ['label' => 'Numéro', 'value' => $code, 'readonly']); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('date', ['label' => 'Date', 'id' => 'date', 'value' => $now]); ?>
                    </div>

                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('client_id', ['label' => 'Client', 'options' => $clientss, 'value' => $idclient,  'empty' => 'Veuillez choisir !!', 'id' => 'client_id', 'class' => 'form-control ajourete clientfacture select2']); ?>
                    </div>
                </div>
                <?php if ($idclient != 0) { ?>
                    <section class="content-header">
                        <h1 class="box-title"><?php echo __('Ligne retenu'); ?></h1>
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

                                                        <select table="ligner" index champ="factureclient_id" class=" form-control js-example-responsive facturedet montantbrut  ">
                                                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                            <?php foreach ($factureclients as $id => $fac) {
                                                            ?>
                                                                <option value="<?php echo $fac->id; ?>"><?php echo $fac->numero  ?></option>
                                                            <?php } ?>
                                                        </select>

                                                        <?php
                                                        ?>
                                                    </td>
                                                    <td align="center" table="ligner">
                                                        <?php
                                                        echo $this->Form->control('date', ['class' => ' form-control', 'label' => false, 'id' => 'date', 'index' => '', 'champ' => 'date', 'table' => 'ligner', 'name' => '', 'id' => '', 'readonly' => true]); ?>
                                                    </td>
                                                    <td align="center" table="ligner">


                                                        <?php
                                                        echo $this->Form->input('totalttc', array('class' => ' form-control montantbrut', 'step' => 'any', 'type' => 'number', 'value' => '0', 'label' => '', 'index' => '', 'champ' => 'totalttc', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
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
                                                        echo $this->Form->control('to_id', array('class' => ' form-control  montantbrut', 'options' => $tos, 'label' => false, 'index' => '', 'champ' => 'taux', 'empty' => 'Veuillez choisir !!', 'table' => 'ligner', 'name' => '', 'id' => 'taux'));
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
                                                <input type="hidden" value="-1" id="index">
                                            </tbody>
                                        </table><br>


                                    </div>

                                </div>

                                <!-- <div class="box-header with-border">
                                    <a class="btn btn-primary al ajouter_ligne_inventaire" table='addtable' index='index' id='' style="
                                                        float: right;
                                                        margin-bottom: 5px;
                                                        margin-left: 100px;
                                                        ">
                                        <i class="fa fa-plus-circle "></i>  </a>
                                    </div> -->

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


                <?php } ?>
                <!-- /.box-body -->
                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                    <!-- <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'invBtnn']); ?> -->

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
    $(document).ready(function() {
        // calmontant();
    });
    $('.select2').select2({

    })

    $(document).ready(function() {

        $('.montantbrut').on('keyup change', function() {
            calmontant();
        });

    });

    function calmontant() {
        ind = $(this).attr('index');
        index = $('#index').val();
        tt = 0;
        for (var i = 0; i <= index; i++) {

            montantbrut = $('#totalttc' + i).val() || 0;
            timbre = $('#timbre' + i).val() || 0;
// alert(timbre);
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




<script>
    $(function() {


        $('.ajouttt').on('change', function() {

            // $('html, body').animate({
            //     scrollTop: $("#tabligne").offset().top
            // }, 1000);
            ajouter("tabligne", "index");
        })




        $('.facturedet').on('change', function() {

            index = $(this).attr('index');
            //  alert(index);
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
                    $('#totalttc' + index).val(parseFloat(data.ttc).toFixed(3));
                    $('#timbre' + index).val(parseFloat(data.timbre).toFixed(3));
                    $('#timbre_id' + index).val(data.timbre_id);

                    $('#date' + index).val(data.date);
                    calmontant();

                }

            })

        })


        $(function() {

            $('.clientfacture').on('change', function() {
                val = $('#client_id').val() || 0;
                // val2=$('#pointdevente_id').val()||0;
                //alert(val);
                if (val != 0)

                    var currentUrl = window.location.href;
                var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
                var link = wr + "retenus/add/" + val;

                $(location).attr('href', link);

            });
        });

        $('.supLigne2').on('click', function() {

            index = $('#index').val();
            ind = $(this).attr('index');

            $('#sup' + ind).val(1);

            $(this).parent().parent().hide();

            calmontant()

        });
    });
</script>

<?php $this->end(); ?>