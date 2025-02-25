<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->fetch('script'); ?>

<section class="content-header">
    <h1>
        Ajout facture service
        <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
        <?php if ($typef == 1) { ?>
            <a href="<?php echo $this->Url->build(['action' => 'index/' . $typef .'/'. 1]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>
        <?php } else if ($typef == 2) { ?>
            <a href="<?php echo $this->Url->build(['action' => 'index/' . $typef .'/'. 1]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>
        <?php } ?>
    </ol>
</section>


<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <?php echo $this->Form->create($factureservice, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>

                <div class="col-md-6">
                    <?php
                    date_default_timezone_set('Africa/Tunis');

                    echo $this->Form->input('numero', array('id' => 'numero', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'readonly' => 'readonly', 'value' => $mm));
                    echo $this->Form->control('date', ['empty' => true, 'value' => date("d/m/Y"),'class'=>'form-control','id'=>'date']);
                    echo $this->Form->input('fournisseur_id', array('div' => 'form-group', 'id' => 'FournisseurId', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control fact adresselivfournisseur devisefournisseur adressefr devicefr titrefr select2', 'empty' => 'Veuillez Choisir !!'));

                    if ($typef == 1) {
                        // echo $this->Form->input('ticketcaiss_id', array('label' => 'Ticket type', 'id' => 'ticketcaiss_id', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ticketselect', 'empty' => 'Veuillez Choisir !!'));
                        // echo $this->Form->input('referencefournisseur', array('label' => 'Reference fournisseur', 'id' => 'referencefournisseur', 'div' => 'form-group referencef', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control '));
                        // echo $this->Form->input('dateticket', array('label' => 'Date ticket', 'id' => 'dateticket', 'div' => 'form-group dateticket', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly', 'type' => 'text'));
                    }

                    // echo $this->Form->input('exontva', array(/* 'value'=>$exontva, */'id' => 'exontva', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden'));
                    // echo $this->Form->input('exonfodec', array(/* 'value'=>$exonfodec, */'id' => 'exonfodec', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'hidden'));


                    ?>
                    <?php echo $this->Form->input('adresselivraisonfournisseur', array('div' => 'form-group', 'id' => 'adresselivraisonfournisseur_id', 'label' => 'Adresse livraison fournisseur', 'between' => '<div class="col-sm-10 " >', 'after' => '</div>', 'class' => 'form-control adresselivraisonfournisseur_id ')); ?>

                </div> 

                <div class="col-md-6">
                    <div id='doc'></div>
                    <div id='doc1'></div>


                    <?php
                    echo $this->Form->input('devise_id', array('label' => 'Devises', 'div' => 'form-group', 'id' => 'devisee_id', 'style' => '',  'between' => '<div class="col-sm-10" id="deviseee_id">', 'after' => '</div>', 'class' => 'form-control select2', 'empty' => 'Veuillez Choisir !!', 'style' => 'color:#565656 !important;'));
                    echo $this->Form->input('taux', array('id' => 'taux', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control number', 'type' => 'text'));
                    if ($typef == 1) {
                        echo $this->Form->input('paiement_id', array('label' => 'Mode paiement', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'empty' => 'Veuillez Choisir !!'));
                    }
                    if ($typef == 2) {
                        echo $this->Form->input('dossierimportation_id', array('id' => 'impo_id','label' => 'Titre importation', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2 ',  'empty' => 'Veuillez Choisir !!'));
                    }
                    echo $this->Form->input('piece', array('label' => 'Piece joint', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'file'));

                    if ($typef == 1) {   ?>
                       
                       
                    <?php } ?>
                </div>
                <br>
                <div class="col-md-6">
                    <label for=""> Type facture </label>
                    <select table="ligner"  id="typefacture_id" class="form-control select2 typeFactaddser">
                        <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                        <?php foreach ($typefactures as $id => $f) {
                        ?>
                            <option value="<?php echo $f->id; ?>"><?php echo $f->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for=""> Depots </label>
                    <select table="ligner"  id="depot_id" class="form-control select2 ">
                        <option value="" selected="selected" disabled> <?php echo $dep ?> </option>
                        <?php foreach ($depots as $id => $f) {
                        ?>
                            <option value="<?php echo $f->id; ?>"><?php echo $f->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <section class="content" style="width: 100%">
                    <div class="col-md-12">

                        <br><br>
                        <div>
                            <a class="btn btn-primary ajouterligne_w btn"  id="btnajoutligne" table="addtable" index="index" style="
                               float: right;
                               position: relative;
                               top: -25px;

                               "> <i class="fa fa-plus-circle"></i>Ajouter</a>
                        </div>



                        <div class="panel-body">
                            <div class="table-responsive ls-table">

                                <table  style="width: 100%;"  class="table table-bordered table-striped table-bottomless" id="addtable">

                                    <thead>
                                        <tr>
                                            <td align="center" style="width: 26%;" class="tdmatpremiere"><strong><?php echo ('Article'); ?></strong></td>
                                            <td align="center" style="width: 10% ;" class="tdcharge"><strong><?php echo ('Charges'); ?></strong></td>
                                            <td align="center" style="width: 5%;"><strong><?php echo ('Code fournisseur'); ?></strong></td>
                                            <td align="center" style="width: 10%;"><strong><?php echo ('Quantite'); ?></strong></td>
                                            <td align="center" style="width: 8%;"><strong><?php echo ('PrixHt'); ?></strong></td>
                                            <td align="center" style="width: 8%;"><strong><?php echo ('Remise'); ?></strong></td>
                                            <td align="center" style="width: 8%;"><strong><?php echo ('PUNHT'); ?></strong></td>
                                            <td align="center" style="width: 5%;"><strong><?php echo ('Fodec'); ?></strong></td>
                                            <td align="center" style="width: 7%;"><strong><?php echo ('TVA'); ?></strong></td>
                                            <td align="center" style="width: 7%;"><strong><?php echo ('TTC'); ?></strong></td>
                                            <td align="center" style="width: 5%;"></td>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr class='tr' style="display: none !important">


                                            <td align="center" class="tdmatiereprimereid" champ="mpp">
                                                <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                                ?>
                                                <select style="width:150px;" table="ligner" index champ="article_id" class="form-control article">
                                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                    <?php foreach ($articles as $id => $article) {
                                                    ?>
                                                        <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td align="center" class="tdcargeid">
                                                <select style="width:150px;" table="ligner" index champ="charge_id" class="form-control">
                                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                                    <?php foreach ($charges as $id => $ch) {
                                                    ?>
                                                        <option value="<?php echo $ch->id; ?>"><?php echo $ch->name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td align="center">
                                                <?php
                                                echo $this->Form->input('codefrs', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'codefrs', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                echo $this->Form->input('qte', array('label' => '', 'name' => '', 'value' => 1, 'id' => '', 'champ' => 'qte', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htb number'));
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                echo $this->Form->input('prix', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'prix', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control  number htb'));
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                echo $this->Form->input('remise', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'remise', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htb number ', 'type' => 'text'));
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                echo $this->Form->input('ht', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'ht', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htb number ', 'type' => 'text'));
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                echo $this->Form->input('fodec', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'fodec', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number htb ', 'type' => 'text'));
                                                ?>
                                            </td>
                                            </td>
                                            <td align="center">
                                                <?php
                                                echo $this->Form->input('tva', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'tva_id', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htb number tvaaa '));
                                                echo $this->Form->input('tvaa', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'tvaa', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number htb ', 'type' => 'hidden'));

                                                ?>
                                            </td>
                                            </td>
                                            <td align="center">
                                                <?php
                                                echo $this->Form->input('ttc', array('label' => '', 'name' => '', 'id' => '', 'champ' => 'ttc', 'table' => 'ligner', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number htb ', 'type' => 'text'));
                                                ?>

                                            <td align="center"><i index="" id="" class="fa fa-times supLigne0ch" style="color: #c9302c;font-size: 22px;"></td>

                                        </tr>

                                        <input type="hidden" value="" id="index">

                                    </tbody>
                                </table><br />

                            </div>
                            <!--Table Wrapper Finish-->
                        </div>

                    </div>

                </section>
                <div class="col-md-6">
                    <?php

                    echo $this->Form->input('remise', array('id' => 'remise', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control number', 'type' => 'text', 'readonly' => 'readonly'));
                    echo $this->Form->input('tva', array('id' => 'tva', 'label' => 'TVA', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control number', 'type' => 'text', 'readonly' => 'readonly'));
                    echo $this->Form->input('fodec', array('id' => 'fodec', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control number', 'type' => 'text', 'readonly' => 'readonly'));

                    ?></div>
                <div class="col-md-6"><?php
                                       
                                        echo $this->Form->input('ht', array('id' => 'ht', 'label' => 'HT', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control number', 'type' => 'text', 'readonly' => 'readonly'));

                                        echo $this->Form->input('ttc', array('id' => 'ttc', 'label' => 'TTC', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control number', 'type' => 'text', 'readonly' => 'readonly'));

                                        echo $this->Form->input('totaldevise', array('id' => 'totaldevise', 'label' => 'Total devise', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control number', 'type' => 'text', 'readonly' => 'readonly'));

                                        ?>
                </div>
                <br>
                <div  align="center">
                   
                        <button type="submit"  id="alertservice" class="btn btn-primary">Enregistrer</button>
                  
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        $('.supLigne0ch').on('click', function() {
            index = $(this).attr('index');
            i = $(this).attr('index');
            $('#sup' + i).val('1');
            $(this).parent().parent().hide();
        })

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


<script>
    $(function() {
        $('.adressefr').on('change', function() {
            //alert('hello');
            id = $('#FournisseurId').val();
            //alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Factures', 'action' => 'getadresse']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    //alert(data['ligne']['valeur']);

                    $('#adresselivraisonfournisseur_id').val(data.adresse);


                }

            })
        });



        $('.titrefr').on('change', function() {
            //alert('hello');
            id = $('#FournisseurId').val();
            //alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Factures', 'action' => 'gettitre']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    //alert(data['ligne']['valeur']);

                    $('#impo_id').html(data.select);


                }

            })
        });


            


        $('.devicefr').on('change', function() {
            //alert('hello');
            id = $('#FournisseurId').val();
            //alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Factures', 'action' => 'getdevice']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                  
                    $('#devisee_id').html(data.select);

                }

            })
        });





        $('.article').on('change', function() {

            index = $(this).attr('index');
            article_id = $('#article_id' + index).val();


            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getart']) ?>",
                dataType: "json",
                data: {
                    idarticle: article_id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    $('#prix' + index).val(data.prix);


                }

            })
        })




    });
</script>