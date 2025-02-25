<?php $this->layout = 'def'; ?>

<?php ?>
<style>
    .hidden {
        display: none;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php //echo $this->Html->script('salma'); ?>
<?php //echo $this->Html->script('hechem'); ?>
<?php //echo $this->Html->script('controle_frs'); ?>

<?php //echo $this->Html->css('select2'); ?>



<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>



<?php echo $this->fetch('script'); ?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <h1>
        Compte
        <small><?php echo __('Ajouter'); ?></small>
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
            <div class="box ">

                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($compte, ['role' => 'form']); ?>
                <div class="box-body">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('numero', ['label' => 'Numéro']);
                            ?>
                        </div>
                        <div class="col-xs-6">
                                    <?php echo $this->Form->control('date', ["value" => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime(date('Y-m-d H:i:s'))))]) ?>
                                </div>
                    <div class="col-md-6">
                        <?php

                        echo $this->Form->input('agence_id', array(
                            'empty' => 'Veuillez choisir !!', 'options' => $agences, 'class' => ' form-control ', 'name' => 'agence_id', 'label' => 'Agences', 'id' => 'agence_id', 'type' => '', 'class' => 'form-control select2'
                        ));
                        ?>
                    </div>
                    <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('montant', ['label' => 'Solde']);
                            ?>
                        </div>

                      <br>


                    <div class="col-md-12">
                        <div class="box-header with-border">
                            <a class="btn btn-primary btn " table="addtable" id="ajouter_lignecompte" index="index" style="
             float: right;
             margin-bottom: 5px;
             ">
                                <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

                        </div>
                    </div>

                    <div class="box-body" style="background-color: white ;">
                        <table id="idtable2" class="table table-bordered table-striped">


                            <thead>
                                <tr>
                                    <td align="center" style="width: 10%; font: size 20px;"><strong>Type Crédit</strong></td>




                                    <td align="center" style="width: 7%;"></td>
                                </tr>

                            </thead>
                            <tbody>

                                <tr class="tr" style="display: none !important">

                                    <td align="center" table="ligner">

                                        <?php //debug($typecredits);
                                        echo $this->Form->input('typecredit_id', array('class' => ' form-control  ','options'=>$typecredits, 'label' => '', 'index' => '', 'champ' => 'typecredit_id', 'table' => 'ligner', 'name' => 'typecredit_id', 'empty' => 'Veuillez choisir !!', 'id' => 'typecredit_id'));
                                        ?>



                                        <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">
                                    </td>









                                    <td align="center">
                                        <i index class="fa fa-times supLigne2" style="color: #c9302c;font-size: 22px;"></i>
                                    </td>
                                </tr>

                            </tbody>


                        </table>
                        <input value="-1" id="index" type="hidden">

                        <br>
                        <button type="submit" class="pull-right btn btn-success" id="controlecompte" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                        <?php echo $this->Form->end(); ?>
                    </div>

                    <!-- /.box-body -->


                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
</section>


<script>
    function openWindow(h, w, url) {
        // alert('tre');
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<script>
    $(document).ready(function() {

        $('#ajouter_lignecompte').on('click', function() {
            // alert('click') ;
            index = Number($('#index').val());
            // alert(index);
            ajouter('idtable2', 'index');
        });

        $('.supLigne2').on('click', function() {

            index = $('#index').val();
            ind = $(this).attr('index');
            ///alert(ind);
            // alert(index);
            $('#sup' + ind).val('1');
            $(this).parent().parent().hide();


        });

        function ajouter(table, index) {


            ind = Number($('#' + index).val()) + 1;
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
                $type = $(this).attr('type');
                if (champ !== 'tva' && champ !== 'fodec' && champ !== 'remise') {
                    $(this).val('');
                }
                // if (champ !== 'tva') {
                //     $(this).val('');
                // } else if (champ !== 'fodec') {
                //     $(this).val('');
                // } else if (champ !== 'remise') {
                //     $(this).val('');
                // }

                // $(this).val('');
                if ($type == 'radio') {
                    $(this).attr('name', 'data[' + champ + ']');
                    //$(this).attr('value',ind);
                    $(this).val(ind);
                }
                if ((champ == 'datedebut') || (champ == 'datefin')) {
                    $(this).attr('onblur', 'nbrjour(' + ind + ')')
                }
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

            $("#compte_id" + ind).select2({
                width: '100%' // need to override the changed default
            });
            $("#article" + ind).select2({
                width: '100%' // need to override the changed default
            });
            $("#article_id" + ind).select2({
                width: '100%' // need to override the changed default
            });
            $("#banque_id" + ind).select2({
                width: '100%' // need to override the changed default
            });
            $("#typeexon_id" + ind).select2({
                width: '100%' // need to override the changed default
            });
            $("#gouvernorat_id" + ind).select2({
                width: '75%' // need to override the changed default
            });
            for (j = 0; j <= i; j++) {
                // alert(tabb[j]);
                //  $('marchandisetype_id1').attr('class','select2');
                //  uniform_select(tabb[j]); jareb
                //$('#'+tabb[j]).select2({ });
            }
            $("#article_id" + ind).select2({
                width: '75%' // need to override the changed default
            });
            $("#categorie_id" + ind).select2({
                width: '100%' // need to override the changed default
            });
            // $("#categorie_id" + ind).select2({
            //   width: '100%' // need to override the changed default
            // });
            // $("#quantite" + ind).select2({
            //   width: '100%' // need to override the changed default
            // });
            $("#unitescontenaire_id" + ind).select2({
                width: '100%' // need to override the changed default
            });

        }




        // $('.urlarticle').on('click', function() {
        // /// alert('dfgdfgdrg');
        // var index = $(this).attr('index');
        // var currentUrl = window.location.href;
        // var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
        // var link = parentUrl + "/comptes/addcompte/" + index;
        // // alert(link);
        // window.open(link, "_blank", "width=1000,height=1000");
        // });
    });
</script>













<script type="text/javascript">
    $(document).ready(function() {

        $('.pai').on('click', function() {
            // alert('hhh');
            var currentindex = $(this).attr("index");
            $('#paiementt' + currentindex).toggle();
            if ($('#paiementt' + currentindex).is(':visible')) {
                $('#paiement_id' + currentindex).prop("selectedIndex", 0).change();
                $('#paiement_id' + currentindex).attr('disabled', 'disabled');
                $('#pai' + currentindex).attr('class', 'btn btn-sm btn-danger fa fa-times-circle pai');

            } else {
                $('#paiement_id' + currentindex).attr('disabled', false);
                $('#paiementt' + currentindex).val(null);
                $('#pai' + currentindex).attr('class', 'btn btn-sm btn-primary fa fa-plus-circle pai');
            }
        })
        $('#code').on('keyup', function() {
            code = $('#code').val();
            $('#compte').val(code);
        })
        $("#ajouter_lignemodedepaiement").on("click", function() {
            index = Number($("#index").val());
            ajoutermode("tabligne", "index");
        });

        function ajoutermode(table, index) {
            ind = Number($('#' + index).val()) + 1;
            $ttr = $('#' + table).find('.tr').clone(true);
            $ttr.attr('class', '');
            i = 0;
            tabb = [];
            $ttr.find('input,select,textarea,tr,td,i,div').each(function() {
                tab = $(this).attr('table'); //alert(tab)
                champ = $(this).attr('champ');
                $(this).attr('index', ind);
                $(this).attr('id', champ + ind);
                $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
                $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
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
                $(this).removeClass('anc');
                if ($(this).is('select')) {
                    tabb[i] = champ + ind;
                    i = Number(i) + 1;
                }
            })
            $ttr.find('i').each(function() {
                $(this).attr('index', ind);
            });
            $('#' + table).append($ttr);
            $('#' + index).val(ind);
            $('#' + table).find('tr:last').show();
            for (j = 0; j <= i; j++) {}
            $('#matierepremiere_id' + ind).select2();
            $('#article_id' + ind).select2();
            $('#unite_id' + ind).select2();
            $('#depot_id' + ind).select2();
            $('#fonction_id' + ind).select2();
            $('#typepf_id' + ind).select2();
        }
        $(function() {
            $('.paystest').on('change', function() {
                // alert('hello');
                id = $('#pay_id').val();
                // alert(id)
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getgouv']) ?>",
                    dataType: "json",
                    data: {
                        id: id,

                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function(data) {
                        //alert(data.select);
                        $('#divgouv').html(data.select);
                        $('#gouvernorat').select2();
                        // uniform_select('sousfamille1_id');


                    }

                })

            });
        });
    });
</script>












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
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-d    a        t              epicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    function gouv(id) {
        // $(function () {
        //     $('.gouv').on('change', function () {
        //         id = $('#gouvernorat').val();
        //         $('#gouv').val((id));

        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getbureaupostegouvs']) ?>",
            dataType: "json",
            data: {
                idgouv: id,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(response, status, settings) {
                //alert(response.query);
                //  alert(response.name);
                bureauposte = $('#bureauposte').val();
                $('#bureauposte').val(response.query);
                $('#gouvadresse').val(response.name);
                $('#adresses').val(response.name + ' ' + response.query);
                $('#adresse0').val(response.name + ' ' + response.query);


                $('#adress').val(response.name + ' ' + response.query);

                $('#code').val(response.queryyy);
                $('#compte').val(response.queryyy);
                $('#delegation').html(response.select);
                $('#deleg').select2();
                // uniform_select('delegation');



                //$('#adresses').val((id));

            }
        })
    }

    function localite(id) {
        //alert(id)
        idgouv = $('#gouvernorat').val();
        iddeleg = $('#deleg').val();

        $.ajax({
            method: "GET",
            // url: wr + "Clients/getbureaupostedelegs/",
            url: "<?= $this->Url->build(['controller' => 'Clients/getbureaupostelocs']) ?>",
            dataType: "json",
            data: {
                idloc: id,
                idgouv: idgouv,
                iddeleg: iddeleg,


            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(response, status, settings) {
                // alert(response.query);
                $('#bureauposte').val(response.query);
                valeur = $('#adresses').val();

                $('#localiteadrresse').val(response.name);

                $('#adresses').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());
                $('#adress').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());

                $('#adresse0').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());
            }
        })

    }







    function delegation(id) {
        //alert("yyy");

        //alert(id)
        //id = $('#deleg').val();
        // alert(id);
        idgouv = $('#gouvernorat').val();
        $.ajax({
            method: "GET",
            // url: wr + "Clients/getbureaupostedelegs/",
            url: "<?= $this->Url->build(['controller' => 'Clients/getbureaupostedelegs']) ?>",
            dataType: "json",
            data: {
                iddeleg: id,
                idgouv: idgouv
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(response, status, settings) {
                // alert(response.query);
                // alert(response.name);
                bureauposte = $('#bureauposte').val();

                $('#bureauposte').val(response.query);
                $('#localite').html(response.select);
                $('#loc').select2();
                valeur = $('#adresses').val();
                //let v = valeur.substr(-4);
                //   let v = valeur.substr(valeur.length - 4);
                //alert(v);
                //  valeur.replace(v, bureauposte);
                //  alert(valeur);
                $('#delegationadr').val(response.name);

                $('#adresses').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());
                $('#adresse0').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());

                $('#adress').val($('#localiteadrresse').val() + ' ' + $('#delegationadr').val() + ' ' + $('#gouvadresse').val() + ' ' + $('#bureauposte').val());


                // uniform_select('localite');
            }
        })

    }
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
            format: ' MM/DD/YYYY h:mm A'
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
    $(function() {
        // $('.afficherancienclient').on('click', function () {
        //     //alert('alert')
        //     if ($('#non').is(':checked')) { 
        //         //alert('oui is checked');
        //         $('#afficher').attr('style', "display:true;");
        //     } else {
        //         $('#afficher').attr('style', "display:none;");
        //         $('#client_id').val(' ');
        //     }
        // });

        $('input[type=radio][name=nouveau_client]').click(function() {

            if (this.value == 'FALSE') {

                $('.closerow').attr('style', "display:true;");
                $(".closerow").removeClass("hidden");

            } else if (this.value == 'TRUE') {

                $('.closerow').attr('style', "display:none;");
                $(".closerow").addClass("hidden");

                $('#client_id').val(' ');

            }

        });
        $('input[type=radio][name=etat]').click(function() {

            if (this.value == 'FALSE') {

                /*     $('.closerow').attr('style', "display:true;");
                 */
                $(".hiddenob").addClass("hidden");
                $('#observationtext').val(' ');


            } else if (this.value == 'TRUE') {

                $('.closerow').attr('style', "display:none;");
                $(".hiddenob").removeClass("hidden");


            }

        });



    });
</script>

<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>


<?php $this->end(); ?>

<script>
    $(function() {
        $(".alertcode").on("mouseover", function() {

            code = $("#code").val();
            //alert(code)
            $.ajax({
                type: "GET",
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'gtcode']) ?>",
                dataType: "json",
                data: {
                    code: code,
                },
                success: function(data) {

                    res = data.codes;
                    if (res == 1) {
                        alert(
                            " code est déjà utilisé , Veuillez vous choisir une autre code"
                        );
                        return false;
                    }
                },
            });
        });

        $('.close').on('click', function() {

            $(".tableclose").toggle();

        })
    });
</script>