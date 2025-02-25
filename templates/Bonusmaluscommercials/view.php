<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>


<?php echo $this->Html->script('salma'); ?>



<?php echo $this->fetch('script'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Consultation malus bonus commercial
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
                <?php echo $this->Form->create($bonusmaluscommercial, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>


                <div class="box-body">
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                                <div class="row">
                                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                        <div class="col-xs-3">
                                            <?php echo $this->Form->control('numero', ['readonly','value' => $bonusmaluscommercial->numero, 'label' => 'Numero', 'type' => 'text']); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">

                                    <?php echo $this->Form->control('commercial_id', ['disabled'=>true ,'id' => 'commercial_id', 'options' => $commercials, 'empty' => 'Veuillez choisir !!', 'label' => 'Commercials', 'class' => 'form-control select2 control-label']); ?>
                                </div>

                                <div class="col-xs-2" id="datedeb">
                                    <?php echo $this->Form->control('datedebut', ['readonly','type' => 'date', 'id' => 'datedebut', 'name' => 'datedebut', 'label' => 'Date début']); ?>
                                </div>


                                <div class="col-xs-2" id="datef">
                                    <?php echo $this->Form->control('datefin', ['readonly','type' => 'date', 'id' => 'datefin', 'name' => 'datefin', 'label' => 'Date fin']); ?>
                                </div>


                                



                            </div>
                        </div>





                        <br>
                        <br>
                        <div class="row ligne">
                            <div class="col-md-12 m" id="m">

                                <table align="center" style="width: 80%;" class="table table-bordered table-striped table-bottomless" id="tab">



                                    <tr>
                                        <th style="width:15% ;"> </th>
                                        <?php
                                        //   $i = 1;
                                        //debug($i);
                                        foreach ($mois as $m) : //debug($m); 
                                        ?>
                                            <th style="width: 1%;text-align:center" colspan="3"> <?php echo $m->name  ?> </th>
                                        <?php endforeach; ?>
                                        <th rowspan="2" width="30px"> Montant</th>

                                    </tr>
                                    <tr>
                                        <th> Article</th>
                                        <?php foreach ($mois as $m) : //debug($m);  
                                        ?>
                                            <th style="width: 1%; font-size:10px "> Objectif</th>
                                            <th style="width: 1%;font-size:10px "> Qte livrée</th>
                                            <th style="width: 1%;font-size:10px "> Ecart</th>
                                        <?php endforeach; ?>

                                    </tr>
                                    <?php //debug($tab); 
                                    ?>

                                    <?php $total = 0;
                                    $montant = 0;
                                    foreach ($tab as $i => $s) :




                                    ?>



                                        <tr style="height:20px">
                                            <td>
                                                <?php echo $i  ?>
                                            </td>

                                            <?php $a = 0;
                                            foreach ($s as $ii) : //debug($ii['mon']);
                                                $montant += $ii['mon'];
                                                //  debug($ii);
                                            ?>

                                                <td>

                                                    <input readonly name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][objectif]' ?>" value="<?php echo $ii['objectif'] ?>" style="height:30px;width:50px" type="text" class="form-control">
                                                    <input readonly name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][article_id]' ?>" value="<?php echo $ii['article_id'] ?>" style="height:30px;width:50px" type="hidden" class="form-control">
                                                    <input  readonly name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][mois]' ?>" value="<?php echo $ii['mois'] ?>" style="height:30px;width:50px" type="hidden" class="form-control">


                                                    <input readonly name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][mon]' ?>" value="<?php echo $ii['mon'] ?>" style="height:30px;width:50px" type="hidden" class="form-control">





                                                </td>




                                                <td style="width: 30px;">
                                                    <input readonly  name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][qteliv]' ?>" value="<?php echo $ii['qteliv'] ?>" style="height:30px;width:50px" type="text" class="form-control">
                                                </td>



                                                <td style="width: 30px;">
                                                    <input readonly name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][ecart]' ?>" value="<?php echo $ii['ecart'] ?>" style="height:30px;width:50px" type="text" class="form-control">
                                                </td>




                                            <?php $a = $a + 1;
                                            endforeach;  ?>
                                            <td style="width: 50px;">
                                                <input readonly value="<?php echo $montant ?>" style="height:30px;width:90%" type="text" class="form-control">
                                            </td>





                                        </tr>
                                        <?php $total += $montant;
                                        $montant = 0;
                                        ?>
                                    <?php endforeach; ?>
                                    <?php //$i + 1 
                                    ?>

                                    <input readonly name="total" value="<?php echo $total ?>" style="height:30px;width:90%" type="hidden" class="form-control">



                                </table>

                            </div>
                        </div>

                    </div>



                </div>


                <div align="center">

                </div>
                <?php echo $this->Form->end(); ?>

            </div>



        </div>
    </div>
</section>




<!-- Ajout ajax recupération select -->
<script type="text/javascript">
    $(function() {
        $('#commercial_id').on('change', function() {
            // var selection = [];

            idcommercial = $('#commercial_id').val();
            datedebut = $('#datedebut').val();

            datefin = $('#datefin').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Commercials', 'action' => 'getcommercial']) ?>",
                dataType: "html",
                data: {
                    idcommercial: idcommercial,
                    datedebut: datedebut,
                    datefin: datefin,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    //alert(data.select);
                    //alert(data);
                    $('#m').html(data);




                    //  $.each(data, function(index) {
                    // alert(data[index].name);
                    // $('#sous').append('<option value="' + data[index].name + '">' + data[index].name + '</option>');


                    //   alert(d[index].TEST2);
                    //  });





                    //  var opts = $.parseJSON(data);
                    // alert(opts);
                    //   alert("hh");


                    // $('#sousfamille1').html(data.select);
                    // uniform_select('sousfamille1_id');
                    /*  $.each(opts, function(i, d) {
                    //You will need to alter the below to get the right values from your json object.  Guessing that d.id /d.modelName are columns in your carModels data
                    $('#emptyDropdown').append('<option value="' + d.ModelID + '">' + d.ModelName + '</option>');
                });*/

                }

            })
        });
    });
</script>





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
<?php $this->end(); ?>