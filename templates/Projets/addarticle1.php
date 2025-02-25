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

<section class="content-header">
    <h1>

        Nouveau produit
        <!-- <ol class="breadcrumb">
            <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                    <?php echo __('Retour'); ?>
                </a></li>
        </ol> -->
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box ">
                <?php echo $this->Form->create($article, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']); ?>
                <div class="row" style="font-size: 12px;">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <label> produit | Service </label>
                            <select name="typearticle" class="form-control" id="ch81">
                                <option> Veuillez choisir !!
                                <option value="1" <?php if ($article->typearticle == 1) { ?> selected <?php } ?>> produit
                                <option value="2" <?php if ($article->typearticle == 2) { ?> selected <?php } ?>> Service
                            </select>
                        </div>
                        <div class="col-xs-6">
                        </div>
                    </div>
                </div>
                <div class="row" style="font-size: 12px;">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-2" style="color: blue">
                            <br><br>
                            <?php echo $this->Form->control('Reffourni', ['class' => 'form-control', 'id' => 'Reffourni', 'label' => 'Ref.Fourn']); ?>
                        </div>
                        <div class="col-xs-3" style="color: blue">
                            <br><br>
                            <?php echo $this->Form->control('Refggb', ['class' => 'form-control', 'id' => 'Refggb', 'label' => 'Ref.ggb']); ?>
                        </div>
                        <div class="col-xs-3">
                            <br><br>
                            <?php echo $this->Form->control('Dsignation', ['class' => 'form-control', 'id' => 'Dsignation', 'label' => 'Libelle']); ?>
                        </div>
                        <div class="col-xs-2" style="font-size: 12px;">
                            <br><br>
                            <span><strong>État (Vente)</strong></span>
                            <select name="vente" class="form-control select2 control-label" id="etatv">
                                <!--                                <option value="">Veuillez choisir !!</option>-->
                                <option value="1">OUI </option>
                                <option value="0">NON</option>

                            </select>
                        </div>
                        <div class="col-xs-2" style="font-size: 12px;">
                            <br><br>
                            <span><strong>État (Achat)</strong></span>
                            <select name="etat" class="form-control select2 control-label" id="etata">
                                <option value="1">OUI </option>
                                <option value="0">NON</option>
                            </select>
                        </div>

                    </div>
                </div>


                <!-- <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                      
                    </div>
                </div> -->
                <div class="row" style="font-size: 12px;">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-12">

                            <?php echo $this->Form->control('Description', ['class' => 'form-control', 'type' => 'textarea', 'label' => 'Description']); ?>
                        </div>

                    </div>
                </div>

                <div hidden class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Quantit_Disponible', ['type' => 'text', 'class' => 'form-control', 'label' => 'Limite stock pour alerte']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('Quantit_Command', ['type' => 'text', 'class' => 'form-control', 'label' => 'Stock désiré optimal']); ?>
                        </div>
                    </div>
                </div>
                <div class="row" style="font-size: 12px;">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('URL', ['class' => 'form-control', 'label' => 'URL publique']); ?>
                        </div>
                        <div class="col-xs-3" style="font-size: 12px;">
                            <div id="showlist1">
                                <?php echo $this->Form->control('typearticle_id', ['class' => 'form-control select2', 'empty' => 'Veuillez choisir !!', 'label' => 'Nature du produit']); ?>

                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div id="showlist2">
                                <?php echo $this->Form->control('devise_id', ['label' => 'Devise', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-2" style="font-size: 12px;">
                            <?php echo $this->Form->control('unite_id', ['options' => $unites, 'label' => 'Unite', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']); ?>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus url3" style="color:success;font-size: 20px;"></i></a>
                        </div>
                        <div class="col-xs-3" style="font-size: 12px;">
                            <?php echo $this->Form->control('longueur', ['label' => 'Longueur', 'class' => 'form-control']); ?>

                        </div>
                        <div class="col-xs-3" style="font-size: 12px;">
                            <div id="showlist3">
                                <?php echo $this->Form->control('largeur', ['label' => 'Largeur', 'class' => 'form-control']); ?>
                            </div>
                        </div>
                        <div class="col-xs-3" style="font-size: 12px;">
                            <div id="showlist4">
                                <?php echo $this->Form->control('hauteur', ['label' => 'Hauteur', 'class' => 'form-control']); ?>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3" style="font-size: 12px;">
                            <div id="showlist5">
                                <?php echo $this->Form->control('poidsbrut', ['label' => 'Poids', 'class' => 'form-control']); ?>
                            </div>
                        </div>
                        <div class="col-xs-3" style="font-size: 12px;">
                            <div id="showlist6">
                                <?php echo $this->Form->control('Code', ['label' => 'Nomenclature douanière / Code SH', 'class' => 'form-control']); ?>
                            </div>
                        </div>

                        <!-- </div>
                </div>

                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; "> -->
                        <div class="col-xs-3" style="font-size: 12px;">
                            <div id="showlist7">
                                <?php echo $this->Form->control('surface', ['label' => 'Surface', 'class' => 'form-control']); ?>
                            </div>
                        </div>
                        <div class="col-xs-3" style="font-size: 12px;">
                            <div id="showlist8">
                                <?php echo $this->Form->control('volume', ['label' => 'Volume', 'class' => 'form-control']); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                        <div class="col-xs-12" style="font-size: 12px;">
                            <?php echo $this->Form->control('note', ['class' => 'form-control', 'type' => 'textarea', 'label' => 'Note (non visible sur les factures, propals...)']); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                        <div class="col-xs-2" style="font-size: 12px;">
                            <div id="showlist10">
                                <?php echo $this->Form->control('fournisseur_id', ['label' => 'Fournisseurs', 'empty' => 'Veuillez choisir !!', 'id' => 'fournisseur_id', 'class' => 'form-control select2 control-label']); ?>
                            </div>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <div id="showlist11">
                                <a><i class="fa fa fa-plus urlfournisseurs" style="color:success;font-size: 25px;"></i></a>
                            </div>
                        </div>


                        <div class="col-xs-2" style="font-size: 12px;">
                            <div id="showlist9">
                                <?php echo $this->Form->control('pay_id', ['label' => 'Pays', 'empty' => 'Veuillez choisir !!', 'id' => 'pay_id', 'class' => 'form-control select2 control-label pays']); ?>

                            </div>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <div id="showlist13">
                                <a><i class="fa fa fa-plus url" style="color:success;font-size: 20px;"></i></a>
                            </div>
                        </div>


                        <div class="col-xs-6" id="divgouv" style="font-size: 12px;" hidden>
                            <?php echo $this->Form->control('gouvernorat_id', ['label' => 'Département / Canton', 'id' => 'gouvernorat', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 control-label gouv']); ?>
                        </div>
                    </div>
                </div>

                <div class="row" style="font-size: 12px;">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3" style="font-size: 12px;">
                            <?php echo $this->Form->control('categorie_id', [
                                'class' => 'form-control select2 control-label getproduits',
                                'label' => 'Categorie',
                                'required' => false,
                                'options' => $categories,
                                'id' => 'categorie_id',
                                'empty' => 'veuillez choisir',
                                'data-select2-id' => 'categorie_id',
                                'multiple' => 'multiple'
                            ]); ?>
                        </div>
                        <!-- <div class="col-xs-3" style="color: blue">
                            <?php //echo $this->Form->control('categorie_id', ['label' => 'Categorie', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 souscat', 'required' => true]); 
                            ?>
                        </div> -->
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus url1" style="color:success;font-size: 20px;"></i></a>
                        </div>
                        <div class="col-xs-3" id="divsous">
                            <?php echo $this->Form->control('souscategorie_id', ['label' => 'Sous categorie', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2', 'required' => false]); ?>
                        </div>
                        <div class="col-xs-1" style="margin-top: 31px;">
                            <a><i class="fa fa fa-plus url2" style="color:success;font-size: 20px;"></i></a>
                        </div>
                        <div class="col-xs-4">
                            <?php echo $this->Form->control('dure', ['label' => 'Durée', 'class' => 'form-control', 'required' => false]); ?>
                        </div>
                    </div>
                </div>
                <div class="row" style="font-size: 12px;">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('PrixV', ['label' => 'Prix de vente', 'type' => 'number', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('ancienprix', ['label' => 'Ancien Prix',  'type' => 'number', 'class' => 'form-control']); ?>
                        </div>

                        <div class="col-xs-3">
                            <?php echo $this->Form->control('PrixVM', ['label' => 'Prix de vente min.',  'type' => 'number', 'class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('tva_id', ['label' => 'Taux TVA', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']); ?>

                        </div>
                    </div>
                </div>
                <div class="row" style="font-size: 12px;">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('codecomptablevente_id', ['label' => 'Code comptable (vente)', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('codecomptableexport_id', ['label' => 'Code comptable (vente a l\'export)', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('codecomptableachat_id', ['label' => 'Code comptable (achat)', 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2']); ?>
                        </div>
                        <div class="col-xs-3">
                            <?php echo $this->Form->control('meilleur_prix_achat', ['label' => 'Meilleur prix achat',  'type' => 'number', 'class' => 'form-control']); ?>
                        </div>

                        
                    </div>
                    <div align="center">
                    <div class="pull-right" style="margin-right:40%;margin-top: 20px;">
                        <button type="submit" class="btn btn-primary" id="addclient">Créer</button>
                        <a href="<?php echo $this->Url->build(['action' => 'index']); ?>" class="btn btn-primary">Annuler</a>
                    </div>
                </div>
                 
                   
                </div>

               
               
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#showlist').hide();
        $('#showlist1').hide();
        $('#showlist2').hide();
        $('#showlist3').hide();
        $('#showlist4').hide();
        $('#showlist5').hide();
        $('#showlist6').hide();
        $('#showlist7').hide();
        $('#showlist8').hide();
        $('#showlist9').hide();
        $('#showlist10').show();
        $('#showlist11').show();
        $('#showlist12').hide();
        $('#showlist13').hide();
        $('#ch81').change(function() {
            if ($('#ch81').val() == 1) {
                $('#showlist').show();
                $('#showlist1').show();
                $('#showlist2').show();
                $('#showlist3').show();
                $('#showlist4').show();
                $('#showlist5').show();
                $('#showlist6').show();
                $('#showlist7').show();
                $('#showlist8').show();
                $('#showlist9').show();
                $('#showlist10').show();
                $('#showlist11').show();
                $('#showlist12').show();
                $('#showlist13').show();
            } else if ($('#ch81').val() == 2) {
                $('#showlist').hide();
                $('#showlist1').hide();
                $('#showlist2').hide();
                $('#showlist3').hide();
                $('#showlist4').hide();
                $('#showlist5').hide();
                $('#showlist6').hide();
                $('#showlist7').hide();
                $('#showlist8').hide();
                $('#showlist9').hide();
                $('#showlist10').show();
                $('#showlist11').show();
                $('#showlist12').hide();
                $('#showlist13').hide();
            }
        });
        $('#ch81').trigger('change');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('addclient');
        addButton.addEventListener('click', function(event) {
            const reffourniField = document.querySelector('input[name="Reffourni"]');
            const refggbField = document.querySelector('input[name="Refggb"]');
            const etatvField = document.getElementById('etatv');
            const etataField = document.getElementById('etata');
            const categorieField = document.querySelector('select[name="categorie_id"]');
            const typearticleField = document.querySelector('select[name="typearticle"]');
            const souscategorieField = document.querySelector('select[name="souscategorie_id"]');

            if (!reffourniField.value) {
                alert('NB: Les champs en bleu sont obligatoire, Le champ "Référence Fournisseur" est manquant.');
                event.preventDefault();
                return;
            }
               if (typearticleField.value=='Veuillez choisir !!') {
                alert('NB: Les champs en bleu sont obligatoire, Le champ "Type produit" est manquant.');
                event.preventDefault();
                return;
            }
            if (!refggbField.value) {
                alert('NB: Les champs en bleu sont obligatoire, Le champ "Référence GGB" est manquant.');
                event.preventDefault();
                return;
            }
            if (!etatvField.value) {
                alert('NB: Les champs en bleu sont obligatoire, Le champ "État Vente" est manquant.');
                event.preventDefault();
                return;
            }
            if (!etataField.value) {
                alert('NB: Les champs en bleu sont obligatoire, Le champ "État Achat" est manquant.');
                event.preventDefault();
                return;
            }
            if (!categorieField.value) {
                alert('NB: Les champs en bleu sont obligatoire, Le champ "Catégorie" est manquant.');
                event.preventDefault();
                return;
            }
            /*   if (!souscategorieField.value) {
                alert('NB: Les champs en bleu sont obligatoire, Le champ "Sous-catégorie" est manquant.');
                event.preventDefault();
                return;
            }
    */
        });
    });
</script>

<script type="text/javascript">
    $('#code').on('keyup', function() {
        code = $('#code').val();
        $('#compte').val(code);
    })




    $(function() {
        $(".urlfournisseurs").on("click", function() {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split("/").slice(0, -2).join("/");
            var link = parentUrl + "/articles/addfournisseurs";
            window.open(link, "_blank", "width=1000,height=1000");
        });
        $('.pays').on('change', function() {
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
                }
            })
        });
        $('.url3').on('click', function() {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
            var link = parentUrl + "/articles/addunite/";
            openWindow(1000, 1000, link);
        });
        $('.url2').on('click', function() {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
            var link = parentUrl + "/articles/addsouscateg/";
            openWindow(1000, 1000, link);
        });
        $('.url').on('click', function() {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
            var link = parentUrl + "/articles/addpays/";
            openWindow(1000, 1000, link);
        });
        $('.url1').on('click', function() {
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
            var link = parentUrl + "/articles/addcateg/";
            openWindow(1000, 1000, link);
        });

        $('.ulr').on('click', function() {

            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, -1).join('/');
            var link = parentUrl + "/addlistetags/";
            openWindow(1000, 1000, link);
        });

        function openWindow(width, height, url) {
            var left = (screen.width - width) / 2;
            var top = (screen.height - height) / 2;
            window.open(url, '_blank', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
        }

        $('.souscat').on('change', function() {
            // alert('hello');
            id = $('#categorie-id').val();
            // alert(id)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getsouscat']) ?>",
                dataType: "json",
                data: {
                    id: id,

                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function(data) {
                    //alert(data.select);
                    $('#divsous').html(data.select);
                    $('#souscategorie_id').select2();
                    // uniform_select('sousfamille1_id');


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
    $('.getproduits').on('change', function() {
        id = $('#categorie_id').val();
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getproduitss']) ?>",
            dataType: "json",
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {
                $('#souscategorie-id').html('');
                $.each(data.options, function(index, option) {
                    $('#souscategorie-id').append('<option value="' + option.id + '">' + option.name + '</option>');
                });
            }
        })
    });
    $('.getproduits').on('change', function() {
        id = $('#categorie_id').val();

        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Articles', 'action' => 'getproduits']) ?>",
            dataType: "json",
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {
                $('#fournisseur_id').html('');
                $.each(data.options, function(index, option) {
                    $('#fournisseur_id').append('<option value="' + option.id + '">' + option.name + '</option>');
                });
            }
        })
    });
</script>
<script>
    $(function() {
        $('.select2').select2()
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        $('[data-mask]').inputmask()
        $('#reservation').daterangepicker()
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            format: 'MM/DD/YYYY h:mm A'
        })
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