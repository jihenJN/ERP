<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Commandeclient $commandeclient
 * @var string[]|\Cake\Collection\CollectionInterface $clients
 * @var string[]|\Cake\Collection\CollectionInterface $pointdeventes
 * @var string[]|\Cake\Collection\CollectionInterface $depots
 * @var string[]|\Cake\Collection\CollectionInterface $cartecarburants
 * @var string[]|\Cake\Collection\CollectionInterface $materieltransports
 * @var string[]|\Cake\Collection\CollectionInterface $bonlivraisons
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
    <h1>
        Consultation commande client
        <small>
            <?php echo __(''); ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'vieww/', $project_id]); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?>
            </a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <?php echo $this->Form->create($commandeclient, ['role' => 'form']); ?>
                <div class="box-body">
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('code', ['disabled' => true]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('client_id', ['empty' => 'Veuillez choisir !!!', 'class' => "form-control select2", 'options' => $clients]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('date');
                        ?>

                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('projet_id', ['empty' => 'Veuillez choisir !!!', 'class' => "form-control select2",]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('depot_id', ['options' => $depots, 'empty' => 'Veuillez choisir !!!', 'class' => "form-control select2",]);
                        ?>
                    </div>
                    <!-- <div class="col-xs-6">
                        <?php
                        //echo $this->Form->control('numero réference');
                        ?>
                    </div> -->
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('commentaire');
                        ?>

                    </div>
                    <!-- /.box -->
                    <div class="col-md-12">
                        <section class="content-header">
                            <h1 class="box-title">
                                <?php echo __('Ligne demande client'); ?>
                            </h1>
                        </section>
                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box">
                                    <!-- <div class="box-header with-border">
                                        <a class="btn btn-primary  " table='addtable' index='index3'
                                            id='ajouter_ligne33' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                            <i class="fa fa-plus-circle "></i> Ajouter ligne demande client</a>
                                    </div> -->
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                                                <thead>
                                                    <tr width:20px>
                                                        <td align="center" nowrap="nowrap"><strong>Produit</strong></td>
                                                        <!-- <td align="center" nowrap="nowrap"><strong>Quantité stock</strong></td> -->
                                                        <td align="center" nowrap="nowrap"><strong>Quantite</strong>
                                                        </td>
                                                        <td align="center" nowrap="nowrap"><strong>Prixht</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Remise</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>PUNHT</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Tva</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Fodec</strong></td>
                                                        <td align="center" nowrap="nowrap"><strong>Ttc</strong></td>

                                                        <!-- <td align="center" nowrap="nowrap"></td> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class='tr' style="display: none !important">
                                                        <td style="width: 10%;" align="center">

                                                            <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>
                                                            <?php
                                                            echo $this->Form->input('sup0', array('name' => '', 'id' => '', 'champ' => 'sup0', 'table' => 'tabligne3', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden'));

                                                            echo $this->Form->control('article_id', ['options' => $articles, 'empty' => 'Veuillez choisir !!', 'label' => '', 'table' => 'tabligne3', 'champ' => 'article_id', 'class' => 'form-control']); ?>

                                                        </td>
                                                        <!-- <td align="center">

                                                            <?php //echo $this->Form->input('qtestock', array('champ' => 'qtestock', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht getprixarticle')); 
                                                            ?>
                                                        </td> -->
                                                        <td align="center">

                                                            <?php echo $this->Form->input('qte', array('champ' => 'qte', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('prixht', array('champ' => 'prixht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht getprixarticle')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('remise', array('champ' => 'remise', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('punht', array('champ' => 'punht', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('tva', array('champ' => 'tva', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('fodec', array('champ' => 'fodec', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center">

                                                            <?php echo $this->Form->input('ttc', array('champ' => 'ttc', 'label' => '', 'name' => '', 'type' => 'text', 'id' => '', 'table' => 'lignecommandeclients', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                        </td>
                                                        <td align="center"><i index="" id="" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>
                                                    </tr>
                                                    <?php
                                                    //debug($lignecommandeclients);die;
                                                    $i = -1;
                                                    foreach ($lignecommandeclients as $res) :
                                                        $i++;
                                                    ?>

                                                        <tr>
                                                            <td style="width: 15%;" align="center">

                                                                <?php
                                                                echo $this->Form->input('sup0', array('name' => 'data[lignecommandeclients][' . $i . '][sup0]', 'id' => 'sup0' . $i, 'champ' => 'sup0', 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                                echo $this->Form->input('id', array('label' => '', 'value' => $res->id, 'name' => 'data[lignecommandeclients][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                                echo $this->Form->control('article_id', ['empty' => 'Veuillez choisir !!!', 'index' => $i, 'id' => 'article_id' . $i, 'options' => $articles, 'value' => $res->article_id, 'name' => 'data[lignecommandeclients][' . $i . '][article_id]', 'label' => '', 'table' => 'lignecommandeclients', 'champ' => 'article_id', 'class' => 'form-control select2 getprixarticle Testdep getprixht ']); ?>

                                                            </td>
                                                            <!-- <td style="width: 10%;" align="center">
                                                                <?php //echo $this->Form->input('qtestock', array('label' => '', 'value' => $res->qtestock, 'name' => 'data[lignecommandeclients][' . $i . '][qtestock]', 'type' => 'text', 'id' => 'qtestock' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht getprixarticle')); 
                                                                ?>
                                                            </td> -->
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[lignecommandeclients][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                            </td>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('prixht', array('label' => '', 'value' => $res->prixht, 'name' => 'data[lignecommandeclients][' . $i . '][prixht]', 'type' => 'text', 'id' => 'prixht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht getprixarticle')); ?>
                                                            </td>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res->remise, 'name' => 'data[lignecommandeclients][' . $i . '][remise]', 'type' => 'text', 'id' => 'remise' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                            </td>
                                                            <td style="width: 8%;" align="center">
                                                                <?php echo $this->Form->input('punht', array('label' => '', 'value' => $res->punht, 'name' => 'data[lignecommandeclients][' . $i . '][punht]', 'type' => 'text', 'id' => 'punht' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                            </td>
                                                            <td style="width: 10%;" align="center">
                                                                <?php echo $this->Form->input('tva', array('label' => '', 'value' => $res->tva, 'name' => 'data[lignecommandeclients][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                            </td>
                                                            <td style="width: 12%;" align="center">
                                                                <?php echo $this->Form->input('fodec', array('label' => '', 'value' => $res->fodec, 'name' => 'data[lignecommandeclients][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                            </td>
                                                            <td style="width: 12%;" align="center">
                                                                <?php echo $this->Form->input('ttc', array('label' => '', 'value' => $res->ttc, 'name' => 'data[lignecommandeclients][' . $i . '][ttc]', 'type' => 'text', 'id' => 'ttc' . $i, 'table' => 'lignecommandeclients', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control getprixht ')); ?>
                                                            </td>
                                                            <!-- <td style="width: 5%;" align="center"><i
                                                                    class="fa fa-times supLigne"
                                                                    style="color: #C9302C;font-size: 22px;"></td> -->

                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table><br>
                                            <input type="hidden" value="<?php echo $i ?>" id="index3">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>

                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalht'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totaltva'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalfodec'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalremise'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        echo $this->Form->control('totalttc'); ?>
                    </div>
                    <!-- <button type="submit" class="pull-right btn btn-success btn-sm" id="pointv"
                        style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button> -->
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>

        </div>

    </div>

</section>

</div>


<!-- /.row -->

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

<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>

<script type="text/javascript">
    $(function() {
        $('.gettvas').on('change', function() {
            // alert('hello');
            index = $(this).attr("index");
            id = $('#tva_id').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commandeclients', 'action' => 'gettvas']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    $('#tva' + index).val(data.val);


                }

            })

        });
    });
    nouveau_client
</script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
        // $("#verifenr").on("mouseover", function () {
        //   client_id = $("#client_id").val();//alert(client_id)
        //   opportunite_id = $("#opportunite_id").val();
        //   datedebut = $("#datedebut").val();
        //   datefin = $("#datefin").val();
        //   if (client_id == "") {
        //     alert("Veuillez choisir un tier !!", function () { });
        //     return false;
        //   } if (datedebut == "") {
        //     alert("Veuillez entrer la date de debut !!", function () { });
        //     return false;
        //   }if (datefin == "") {
        //     alert("Veuillez entrer la date fin !!", function () { });
        //     return false;
        //   }if (opportunite_id == "") {
        //     alert("Veuillez choisir une Statut opportunit� !!", function () { });
        //     return false;
        //   }
        // });
        $('select').attr('disabled', 'true');
        $('input,textarea').attr('readonly', 'readonly');
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
<style>
    .select2-selection__rendered {
        line-height: 25px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        border-color: #D2D6DE !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

    .select2-selection__choice {
        height: 24px !important;
        color: black !important;
        background-color: white !important;
        font-size: 18px !important;
    }

    .select2-container {
        display: block;
        /* width: auto !important; */
    }
</style>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php $this->end(); ?>