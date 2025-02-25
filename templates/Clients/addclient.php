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

        Nouveau tiers (Client)
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index', $dhouha]); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol> -->
</section>
<section class="content">
    <div class="row" style="font-size: 12px;">
        <div class="col-md-12" style="font-size: 12px;">
            <div class="box ">
                <?php echo $this->Form->create($client, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']); ?>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3" style="color: blue">
                            <?php echo $this->Form->control('prospect_id', ['value' => 3, 'empty' => 'Veuillez choisissez !!!!', 'class' => 'form-control select2', 'label' => 'Prospect / Client']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('codeclient', ['class' => 'form-control', 'readonly' => 'readonly', 'label' => 'Code client', 'value' => $code]); ?>
                        </div>

                        <div class="col-xs-3" style="color: blue">
                            <?php echo $this->Form->control('nom', ['class' => 'form-control', 'label' => 'Nom du tiers', 'id' => 'nomcli']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Raison_Sociale', ['class' => 'form-control', 'label' => 'Nom alternatif (commercial, marque, ...)']); ?>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3" style="color: blue">
                            <span><strong>Fournisseur</strong></span>
                            <select readonly name="fournisseur"
                                class="form-control  control-label pointer-events: none;" id="fournisseur">
                                <option value="">Veuillez choisir !!</option>
                                <option value="1">OUI </option>
                                <option selected value="0">NON</option>

                            </select>

                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('codefr', ['readonly', 'class' => 'form-control', 'label' => 'Code fournisseur']); ?>
                        </div>

                        <div class="col-xs-3">
                            <span><strong>Etats</strong></span>
                            <select name="etat" class="form-control select2 control-label" id="etat">
                                <option value="">Veuillez choisir !!</option>
                                <option value="0">Clos </option>
                                <option value="1">Ouvert</option>

                            </select>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('devise_id', ['empty' => 'Veuillez choisissez devise !!!!', 'class' => 'form-control select2', 'label' => 'Devise']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Adresse', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Adresse']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('adresse1', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Adresse A']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('port', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Port']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style="margin: 0 auto; margin-left: 20px; margin-right: 20px; position: static;">
                        <div class="col-xs-3">

                            <?php echo $this->Form->control('salari_id', ['empty' => 'Veuillez choisissez !!!!', 'label' => 'Salariés', 'class' => 'form-control select2']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('typeentite_id', ['empty' => 'Veuillez choisissez !!!!', 'class' => 'form-control select2', 'label' => 'Type d\'entité légale']); ?>
                        </div>

                        <div class="col-xs-2">
                            <?php echo $this->Form->control('pay_id', ['label' => 'Pays', 'empty' => 'Veuillez choisir !!', 'id' => 'pay_id', 'class' => 'form-control select2 control-label pays']); ?>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus url" style="color:success;font-size: 25px;"></i></a>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Code', ['class' => 'form-control', 'label' => 'Code Postal']); ?>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Tel', ['class' => 'form-control', 'type' => 'text', 'label' => 'Telephone']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Fax', ['label' => 'Fax', 'class' => 'form-control']); ?>
                        </div>


                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Email', ['class' => 'form-control', 'type' => 'text', 'label' => 'Email']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Contact', ['class' => 'form-control', 'type' => 'text', 'label' => 'Web']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('RC', ['class' => 'form-control', 'type' => 'text', 'label' => 'Id. prof. 1 (RC)']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Matricule_Fiscale', ['label' => 'Id. prof. 2 (Matricule fiscal)', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('codedouane', ['class' => 'form-control', 'type' => 'text', 'label' => 'Id. prof. 3 (Code en douane)']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('BAN', ['label' => 'Id. prof. 4 (BAN)', 'class' => 'form-control']); ?>
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
                        <!-- <div class="col-xs-3">
                            <?php echo $this->Form->control('Code_Ville', ['label' => 'Ville', 'class' => 'form-control']); ?>
                        </div> -->
                        <div class="col-xs-3" id="divgouv">
                            <?php echo $this->Form->control('gouvernorat_id', ['label' => 'Ville', 'id' => 'gouvernorat', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label gouv']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('numerotva', ['label' => 'Numéro de TVA', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('Capital', ['class' => 'form-control', 'type' => 'text', 'label' => 'Capital']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('typetier_id', [
                                'empty' => 'Veuillez choisissez Type tier !!!!',
                                'class' => 'form-control select2',
                                'label' => 'Type du tiers',
                                'id' => 'typetier_id',
                                'data-select2-id' => 'typetier_id'
                            ]); ?>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus url3" style="color:success;font-size: 25px;"></i></a>
                        </div>
                        <!-- 
                        <div class="col-xs-2">
                            <?php echo $this->Form->control('pay_id', ['label' => 'Pays', 'empty' => 'Veuillez choisir !!', 'id' => 'pay_id', 'class' => 'form-control select2 control-label pays']); ?>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus url" style="color:success;font-size: 25px;"></i></a>
                        </div> -->

                    </div>
                    <!-- </div> -->

                    <!-- <div class="row"> -->
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                        <div class="col-xs-3">
                            <?php echo $this->Form->control('tag_id', [
                                'class' => 'form-control select2 control-label',
                                'label' => 'Tags clients/prosp',
                                'required' => true,
                                'options' => $tags,
                                'id' => 'tag_id',
                                'empty' => 'veuillez choisir',
                                'data-select2-id' => 'tag_id',
                                'multiple' => 'multiple'
                            ]); ?>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus ulr" style="color:success;font-size: 25px;"></i></a>
                        </div>

                        <!-- <div class="col-xs-5">
                            <?php echo $this->Form->control('commercial_id', ['empty' => 'Veuillez choissisez un commercial', 'class' => 'form-control select2', 'label' => 'Affecter un personnel']); ?>
                        </div> -->
                        <?php //debug($personnel_id); 
                        ?>

                        <div class="col-xs-3">
                            <?php echo $this->Form->control('commercial_id', [
                                'empty' => 'Veuillez choissir un commercial',
                                'id' => 'commercial_id',
                                'class' => 'form-control',
                                'style' => "pointer-events: none;",
                                'readonly',
                                'label' => 'Affecter un personnel',
                                'data-select2-id' => 'commercial_id',
                                'value' => $personnel_id,
                                'readonly' => 'readonly'
                            ]); ?>
                        </div>
                        <!-- <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus url1" style="color:success;font-size: 25px;"></i></a>
                        </div> -->

                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('incoterm_id', ['empty' => 'Veuillez choisissez !!!!', 'class' => 'form-control select2', 'label' => 'Incoterms']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('logo', ['class' => 'form-control', 'type' => 'file', 'label' => 'Logo']); ?>
                        </div>
                    </div>
                </div>
                <div class="content" style="width: 99%">
                    <strong style="font-size: 14px;">
                        <?php echo __('Modalité de paiement'); ?>
                    </strong> <br><br>
                    <div class="row">
                        <div class="box">
                            <div class="box-header with-border">
                                <a class="btn btn-primary" table='addtable' index='index3' id='ajouter_ligne33' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                                    <i class="fa fa-plus-circle "></i> Ajouter </a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
                                        <thead>
                                            <tr>
                                                <th scope="col">Mode de paiement </th>
                                                <th scope="col">Modalite de paiement en jours</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="tr" style="display: none ;">
                                                <td>
                                                    <select table="tabligne3" index="" champ="paiement_id"
                                                        id="paiement_id"
                                                        class=" form-control espece paiement_id selectized">
                                                        <option value="" selected="selected" disabled>Veuillez choisir
                                                            !!</option>
                                                        <?php
                                                        foreach ($paiements as $id => $paiement) {
                                                            ?>
                                                            <option value="<?php echo $id; ?>">
                                                                <?php echo $paiement ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td style="width: 15%;" align="center">
                                                    <?php
                                                    echo $this->Form->input('sup', ['name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'tabligne3', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control']); ?>
                                                    <input table="tabligne3" name="" id="" type='text' champ='duree'
                                                        index="" class='form-control number'>
                                                </td>
                                                <td style="width: 5%;" align="center"><i
                                                        class="fa fa-times paiement_id supLigne235"
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
                </div>
                <div align="center">
                    <div class="pull-right" style="margin-right:40%;margin-top: 20px;">
                        <button type="submit" class="btn btn-primary" id="addclient">Créer Tiers</button>
                        <a href="<?php echo $this->Url->build(['action' => 'index', $dhouha]); ?>"
                            class="btn btn-primary">Annuler</a>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $(function () {

            $('.payss').on('change', function () {
                //alert('hello');
                id = $('#pay_id').val();
                // alert(id)
                $.ajax({
                    method: "GET",
                    url: "<?= $this->Url->build(['controller' => 'Fournisseurs', 'action' => 'getgouv']) ?>",
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                    },
                    success: function (data) {
                        //alert(data.select);
                        $('#divsector').html(data.select);
                        $('#gouvernorat_id').select2();
                    }

                })

            });
        });
        $('.pays').on('change', function () {
            // alert('hello');
            id = $('#pay_id').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Fournisseurs', 'action' => 'getgouv']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    //alert(data.select);
                    $('#divgouv').html(data.select);
                    $('#gouvernorat').select2();
                    // uniform_select('sousfamille1_id');


                }

            })

        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#addclient").click(function () {
            var fournisseurValue = $("#fournisseur").val();
            var nomcli = $("#nomcli").val();
            var prospectValue = $("#prospect_id").val();
            var nomValue = $("#nom").val();
            // if (fournisseurValue === "" || prospectValue === "" || nomValue === "") {
            //     alert("Tous les champs obligatoires doivent être remplis !");
            //     return false;
            // }
            if (nomcli === "") {
                alert("Veuillez saisir le nom du client SVP !!!");
                return false;
            }
        });
    });
</script>

<script type="text/javascript">
    $('#code').on('keyup', function () {
        code = $('#code').val();
        $('#compte').val(code);
    })



    $(function () {
        $('.espece').on('change', function () {
            index = $(this).attr('index');
            // alert(index);
            var selectedOption = $(this).val();
            if (selectedOption == '1') {
                $('#duree' + index).hide();
                $('#duree' + index).val(10);
            } else {

                $('#duree' + index).val(0);
                $('#duree' + index).show();

            }
        });

        $('.url1').on('click', function () {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
            var link = parentUrl + "/clients/addcommmm/9";
            openWindow(1000, 1000, link);
        });
        $('.url').on('click', function () {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
            var link = parentUrl + "/clients/addpays/";
            openWindow(1000, 1000, link);
        });
        $('.url3').on('click', function () {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
            var link = parentUrl + "/clients/addtypetiers/";
            openWindow(1000, 1000, link);
        });
        $('.ulr').on('click', function () {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
            var link = parentUrl + "/addlistetags/";
            // alert(link);
            openWindow(1000, 1000, link);
        });

        function openWindow(width, height, url) {
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            window.open(url, '_blank', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
        }

        $('.paiement_id').on('change', function () {
            var selectedOptions = [];
            var index3 = parseInt($('#index3').val());
            //    for (var i = 0; i < index3; i++) {
            $('#tabligne3 tbody tr').each(function () {
                var supValue = parseInt($('#sup' + i).val());
                //  alert(supValue);
                if (supValue !== 1) {
                    var selectedOption = $(this).find('.paiement_id').val();
                    // alert(selectedOptions);
                    selectedOptions.push(selectedOption);
                }
            });
            //}
            var currentOption = $(this).val();
            var duplicateCount = 0;
            for (var i = 0; i < selectedOptions.length; i++) {
                if (selectedOptions[i] == currentOption) {

                    duplicateCount++;
                }
            }
            if (duplicateCount > 1) {
                alert('Option déjà choisie');
                $(this).val('').trigger('chosen:updated');
            }
            console.log(selectedOptions);
        });
    });
    $('.ulr').on('click', function () {

        var currentUrl = window.location.href;
        var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
        var link = parentUrl + "/addlistetags/";
        // alert(link);
        openWindow(1000, 1000, link);
    });
    // $(document).ready(function () {
    //     $('.pays').on('change', function () {
    //         // alert('hello');
    //         id = $('#pay_id').val();
    //         // alert(id)
    //         $.ajax({
    //             method: "GET",
    //             url: "<?= $this->Url->build(['controller' => 'Clients', 'action' => 'getgouv']) ?>",
    //             dataType: "json",
    //             data: {
    //                 id: id,

    //             },
    //             headers: {
    //                 'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
    //             },
    //             success: function (data) {
    //                 //alert(data.select);
    //                 $('#divgouv').html(data.select);
    //                 $('#gouvernorat').select2();
    //                 // uniform_select('sousfamille1_id');


    //             }

    //         })

    //     });
    // });
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
    $(function () {
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
            function (start, end) {
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