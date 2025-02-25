<?php $this->layout = 'def'; ?>
<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('hechem'); ?>
<?php echo $this->Html->script('dhouha'); ?>
<?php echo $this->Html->css('select2'); ?>
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

    .select2-container {
        display: block;
        width: auto !important;
    }
</style>
<section class="content-header">
    <h1>

        Nouveau tiers (Fournisseur)
    </h1>
    <!-- <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?></a></li>
  </ol> -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12" style="font-size: 12px;">
            <div class="box">
                <?php echo $this->Form->create($fournisseur, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']); ?>
                <div class="row" style="font-size: 12px;">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                        <div class="col-xs-3" style="pointer-events: none;" readonly>
                            <span><strong>Fournisseur</strong></span>
                            <select name="fournisseur" style="pointer-events: none , readonly;"
                                class="form-control select2 control-label" id="fournisseur">
                                <option value="">Veuillez choisir !!</option>
                                <option selected value="1">OUI </option>
                                <option value="0">NON</option>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('codefr', ['value' => $code, 'readonly' => true, 'class' => 'form-control', 'label' => 'Code fournisseur']); ?>
                        </div>

                        <div class="col-xs-3">
                            <?php echo $this->Form->control('prospect_id', ['value' => 4, 'disabled' => true, 'empty' => 'Veuillez choisissez !!!!', 'class' => 'form-control select2', 'label' => 'Prospect / Client']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('codeclient', ['class' => 'form-control', 'disabled' => true, 'label' => 'Code client']); ?>
                        </div>
                    </div>
                </div>
                <div class="row" style="font-size: 12px;">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('nom', ['class' => 'form-control', 'label' => 'Nom du tiers']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('nomalert', ['class' => 'form-control', 'label' => 'Nom alternatif (commercial, marque, ...)']); ?>
                        </div>
                        <div class="col-xs-3">
                            <span><strong>Etats</strong></span>
                            <select name="etat" class="form-control select2 control-label" id="etat">
                                <option value="">Veuillez choisir !!</option>
                                <option value="0">Clos </option>
                                <option value="1">Ouvert</option>
                            </select>
                            <?php //echo $this->Form->control('etat', ['class' => 'form-control', 'label' => 'Etats']); 
                            ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('devise_id', ['empty' => 'Veuillez choisissez devise !!!!', 'class' => 'form-control select2', 'label' => 'Devise']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Adresse', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Adresse']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('port', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Port']); ?>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                        <div class="col-xs-2">
                            <?php echo $this->Form->control('pay_id', ['label' => 'Pays', 'empty' => 'Veuillez choisir !!', 'id' => 'pay_id', 'class' => 'form-control select2 control-label pays']); ?>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus url" style="color:success;font-size: 25px;"></i></a>
                        </div>
                        <div class="col-xs-2">
                            <?php echo $this->Form->control('article_id', ['options' => $articles, 'label' => 'Articles', 'empty' => 'Veuillez choisir !!', 'id' => 'article_id', 'class' => 'form-control select2 control-label url']); ?>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus urlproduits" style="color:success;font-size: 25px;"></i></a>
                        </div>
                        <!-- <div class="col-xs-2">
                            <?php echo $this->Form->control('tag_id', [
                                'class' => 'form-control select2 control-label',
                                'label' => 'Tags Fournisseur',
                                'required' => true,
                                'options' => $tags,
                                'id' => 'tag_id',
                                'empty' => 'veuillez choisir',
                                'data-select2-id' => 'tag_id',
                                'multiple' => 'multiple'
                            ]); ?>
                        </div> -->

                        <!-- <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus ulr" style="color:success;font-size: 25px;"></i></a>
                        </div> -->
                        <div class="col-xs-5" style="color: blue" id="categ">
                            <?php echo $this->Form->control('categorie_id', ['data-select2-id' => 'categorie_id', 'multiple' => 'multiple', 'id' => 'categorie_id', 'label' => 'Categorie/Tags', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 souscat getproduits', 'required' => true]); ?>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus urlcateg" style="color:success;font-size: 20px;"></i></a>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Tel', ['class' => 'form-control', 'type' => 'number', 'label' => 'Telephone']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Fax', ['label' => 'Fax', 'type' => 'number', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Code', ['class' => 'form-control ', 'type' => 'number', 'label' => 'Code Postal']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Code_Ville', ['label' => 'Ville', 'type' => 'number', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Email', ['class' => 'form-control', 'type' => 'text', 'label' => 'Email']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('site', ['class' => 'form-control', 'type' => 'text', 'label' => 'Web']); ?>
                        </div>

                        <!--                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Contact', ['class' => 'form-control', 'type' => 'text', 'label' => 'Web']); ?>
                        </div>
                    </div>
                </div>-->
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('RC', ['class' => 'form-control', 'type' => 'text', 'label' => 'Id. prof. 1 (RC)']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Matricule_Fiscale', ['label' => 'Id. prof. 2 (Matricule fiscal)', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('codedouane', ['class' => 'form-control', 'type' => 'text', 'label' => 'Id. prof. 3 (Code en douane)']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('BAN', ['label' => 'Id. prof. 4 (BAN)', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Capital', ['class' => 'form-control', 'type' => 'number', 'label' => 'Capital']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('numerotva', ['label' => 'Numéro de TVA', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <span><strong>Assujetti à la TVA</strong></span>
                            <select name="R_TVA" class="form-control select2 control-label" id="R_TVA">
                                <option value="">Veuillez choisir !!</option>
                                <option value="1">OUI </option>
                                <option value="0">NON</option>

                            </select>
                            <?php //echo $this->Form->control('R_TVA', ['class' => 'form-control', 'type' => 'text', 'label' => 'Assujetti à la TVA']); 
                            ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('compte_comptable', ['class' => 'form-control ', 'type' => 'number', 'label' => 'Compte comptable']); ?>
                        </div>

                        <div class="col-xs-3">
                            <?php echo $this->Form->control('typetier_id', ['empty' => 'Veuillez choisissez Type tier !!!!', 'class' => 'form-control select2', 'label' => 'Type du tiers']); ?>
                        </div>
                        <div class="col-xs-3">

                            <?php echo $this->Form->control('salari_id', ['empty' => 'Veuillez choisissez !!!!', 'label' => 'Salariés', 'class' => 'form-control select2']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('typeentite_id', ['empty' => 'Veuillez choisissez !!!!', 'class' => 'form-control select2', 'label' => 'Type d\'entité légale']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('incoterm_id', ['empty' => 'Veuillez choisissez !!!!', 'class' => 'form-control select2', 'label' => 'Incoterms']); ?>
                        </div>


                        <div class="col-xs-3">
                            <?php echo $this->Form->control('commercial_id', ['empty' => 'Veuillez choissisez un commercial', 'value' => $personnel_id, 'style' => "pointer-events: none;", 'readonly', 'class' => 'form-control', 'label' => 'Affecter un personnel']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('logo', ['class' => 'form-control', 'type' => 'file', 'label' => 'Logo']); ?>
                        </div>
                    </div>
                </div>
                <div class="content-header">
                    <div style="font-size: 14px;"><strong>
                            <?php echo __('Code Swift'); ?>
                        </strong> </div>
                </div><br><br>
                <div class="content" style="width: 99%">
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">
                                <a class="btn btn-primary" table='addtable' index='index3' id='ajouter_ligne33' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                    <i class="fa fa-plus-circle "></i> Ajouter Code swift</a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Code Swift</th>
                                                <th scope="col">Banque</th>
                                                <th scope="col">Domicialisation Bancaire</th>
                                                <th scope="col">Rib Bancaire</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr" style="display: none ;">
                                                <td style="width: 15%;" align="center">
                                                    <?php echo $this->Form->input('sup', ['name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'tabligne3', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                                    <input table="tabligne3" name="" id="" type='text' champ='code'
                                                        index="" class='form-control'>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-xs-10">
                                                            <select table="tabligne3" index="" champ="banque_id"
                                                                class="form-control selectized banque_id"
                                                                style="margin-bottom: 0;">
                                                                <option value="" selected disabled>Veuillez choisir !!
                                                                </option>
                                                                <?php foreach ($banques as $id => $banque) { ?>
                                                                    <option value="<?php echo $id; ?>">
                                                                        <?php echo $banque ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-xs-1" style="margin-top: 6px;">
                                                            <a><i class="fa fa fa-plus url1"
                                                                    style="color: success; font-size: 25px;"></i></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input table="tabligne3" name="" id="" type='number' champ='count'
                                                        index="" class='form-control  count number'>
                                                    <!-- <input table="tabligne3" name="" id="" type='number' champ='counter' index="" class='form-control  count number'> -->

                                                </td>
                                                <td>
                                                    <input table="tabligne3" name="" id="" type='number' champ='rib'
                                                        index="" class='form-control count number'>
                                                    <!-- <p>Nombre de caractères saisis :<span table="tabligne3" name="" id="" type='number' champ='counter' index="">0</span></p> -->
                                                </td>
                                                <td style="width: 5%;" align="center"><i
                                                        class="fa fa-times supLigneswift"
                                                        style="color: #C9302C;font-size: 22px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <input type="hidden" value="-1" id="index3">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div align="center">
                        <div class="pull-right" style="margin-right:40%;margin-top: 20px;">
                            <button type="submit" class="btn btn-primary" id="addclient">Créer Tiers</button>
                            <a href="<?php echo $this->Url->build(['action' => 'index']); ?>"
                                class="btn btn-primary">Annuler</a>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
</section>

<script>
    $(document).ready(function() {
        $('.count').on('input', function() {
            var inputId = $(this).attr('index');
            var text = $(this).val();
            var characterCount = text.length;
            $('#counter' + inputId).val(characterCount);
        });
    });
</script>


<script type="text/javascript">
    $('#code').on('keyup', function() {
        code = $('#code').val();
        $('#compte').val(code);
    })
    $(function() {
        $('.url').on('click', function() {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
            var link = parentUrl + "/fournisseurs/addpays/";
            openWindow(1000, 1000, link);
        });
        $('.ulr').on('click', function() {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
            var link = parentUrl + "/fournisseurs/addlistetags/";
            openWindow(1000, 1000, link);
        });
        $(".urlproduits").on("click", function() {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split("/").slice(0, -2).join("/");
            var link = parentUrl + "/addarticle";
            window.open(link, "_blank", "width=1000,height=1000");
        });
        $('.urlcateg').on('click', function() {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
            var link = parentUrl + "/addcateg/";
            openWindow(1000, 1000, link);
        });

        $('.url1').on('click', function() {
            var index = $(this).closest('tr').index();
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
            var link = parentUrl + "/fournisseurs/addbanque/" + index;
            openWindow(1000, 1000, link);
        });

        function openWindow(width, height, url) {
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            window.open(url, '_blank', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
        }
        $('.getproduits').on('change', function() {
            id = $('#categorie_id').val();
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Fournisseurs', 'action' => 'getproduits']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    $('#article_id').html('');
                    $.each(data.options, function(index, option) {
                        $('#article_id').append('<option value="' + option.id + '">' + option.Dsignation + '</option>');
                    });
                }
            })
        });

        $('.pays').on('change', function() {
            id = $('#pay_id').val();
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
                    $('#divgouv').html(data.select);
                    $('#gouvernorat').select2();
                }
            })

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
<style>
    #counter {
        color: red;
        font-size: 80%;
    }
</style>

<?php $this->end(); ?>