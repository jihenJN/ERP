<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->fetch('script'); ?>
<section class="content-header">

    <h1>
        Modification Dépense
        <small>
            <?php echo __(''); ?>
        </small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?>
            </a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <?php echo $this->Form->create($depense, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]); ?>
                <div class="box-body">
                    <div class="row">
                        <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'label' => 'Numero', 'name', 'required' => 'off']); ?>
                            </div>
                            <div class="col-xs-6">
                                <?php $dd = date('Y-m-d'); ?>
                                <?php echo $this->Form->control('date', ['label' => 'Date', 'style' => 'text-align:left', 'class' => 'form-control', 'id' => 'date', 'required' => 'off', 'type' => 'datetime']); ?>
                            </div>

                            <div class="col-xs-6">
                                <?php echo $this->Form->control('type', ['options' => [1 => 'Caisse', 2 => 'Banque', 3 => 'Divers'], 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Type', 'id' => 'type', 'class' => 'form-control select2 control-label']); ?>
                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('typedepense_id', ['options' => $typedepenses, 'id' => 'typedepense_id', 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Type depense', 'class' => 'form-control select2 control-label']); ?>
                            </div>
                            <?php
                            $style = "none";
                            if ($depense->type == 1) {
                                $style = "true";
                            } ?>
                            <div id="divcaisse" style="display:<?php echo $style ?>">
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('caisse_id', ['options' => $caisses, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Caisse', 'id' => 'caisse_id', 'class' => 'form-control select2 control-label getmontant']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('soldecourant', ['readonly', 'id' => 'soldecourant', 'label' => 'Solde courant', 'value' => $soldecourant, 'name', 'required' => 'off']); ?>
                                </div>
                            </div>



                            <div class="col-xs-12">
                            </div>

                            <div class="col-xs-6">
                                <?php echo $this->Form->control('paiement_id', ['options' => $paiements, 'id' => 'paiement_id', 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Mode de paiement', 'class' => 'form-control select2 control-label paiement']); ?>
                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('montant', ['id' => 'montant', 'label' => 'Montant', 'name' => 'montant', 'required' => 'off', 'class' => 'form-control control-label checkmontant']); ?>
                            </div>

                            <?php
                            $style2 = "none";
                            $style3 = "none";

                            if ($depense->paiement_id == 2 || $depense->paiement_id == 3|| $depense->paiement_id == 4) {
                                $style2 = "true";
                                $style3 = "true";
                              if ($depense->paiement_id == 4){
                                $style3 = "none";
                              }

                            } ?>
                            <div id="chequediv" style="display:<?php echo $style2 ?>">
                                <div style="display:<?php echo $style3 ?>" id="divnumero" class="col-xs-6">
                                    <?php echo $this->Form->control('numeropiece', ['id' => 'numeropiece', 'label' => 'N° piece', 'name' => 'numeropiece', 'required' => 'off', 'class' => 'form-control control-label']); ?>
                                </div>

                                <div style="display:<?php echo $style3 ?>" id="divporteur" class="col-xs-6">
                                    <?php echo $this->Form->control('porteur', ['value'=>$depense->porteur,'id' => 'porteur',  'label' => 'Porteur chèque', 'name' => 'porteur', 'required' => 'off', 'class' => 'form-control control-label']); ?>
                                </div>

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('compte_id', ['options' => $comptes, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Compte', 'id' => 'compte_id', 'class' => 'form-control select2 control-label']); ?>
                                    <?php //echo $this->Form->control('rib', ['id' => 'rib', 'value' => '', 'label' => 'RIB', 'name' => 'rib', 'required' => 'off', 'class' => 'form-control control-label']); 
                                    ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('echeance', ['required' => 'off', 'label' => 'Echéance', 'id' => 'echeance', 'class' => 'form-control  control-label']); ?>
                                </div>

                            </div>
                            <div class="col-xs-6">
                                <?php echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Fournisseur', 'id' => 'fournisseur_id', 'class' => 'form-control select2 control-label ']); ?>
                            </div>
                            <div  class="col-xs-6">
                                <div id="divbc">
                                <?php echo $this->Form->control('commandefournisseur_id', ['options' => $commandefournisseurs, 'empty' => 'Veuillez choisir !!', 'required' => 'off', 'label' => 'Commande', 'id' => 'commandefournisseur_id', 'class' => 'form-control select2 control-label ']); ?>

                                </div>
                            </div>
                            <br>
                            
                            <div style="margin-top:10px" class="col-xs-12 ">
                                <?php echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'type' => 'textarea']); ?>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm " id="test" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
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
    $('.select2').select2({
        width: '100%' // need to override the changed default
    });

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
<script>
    $(document).ready(function() {


        $("form").submit(function() {
            $('#test').attr('disabled', 'disabled');
        })
        $(".getmontant").on("change", function() {
            // alert();
            getMontant();
        });


        $("#type").on("change", function() {
            if ($(this).val() == 1) {
                $("#divcaisse").show();
                //  $("#divbanque").hide();


                $("#paiement_id").html('<option value="0">Veuillez choisir !!</option><option value="1">Espèce</option>');
                $("#chequediv").hide();
                $("#numeropiece").val("");
                $("#porteur").val("");
                // $("#rib").val("");
                $("#compte_id").val("").trigger('change');
            } else if ($(this).val() == 2) {
                $("#caisse_id").val("").trigger('change');
                $("#soldecourant").val("")

                $("#divcaisse").hide();
                $("#divbanque").show();
                $("#paiement_id").html('<option value="0">Veuillez choisir !!</option><option value="2">Chèque</option><option value="3">Traite</option><option value="4">Virement</option>');

            } else if ($(this).val() == 3 || $(this).val() == 0) {


                $("#caisse_id").val("").trigger('change');
                $("#soldecourant").val("")

                $("#divcaisse").hide();
                $("#divbanque").hide();
                $("#paiement_id").html('<option value="0">Veuillez choisir !!</option><option value="1">Espèce</option>');
                $("#chequediv").hide();
                $("#numeropiece").val("");
                $("#porteur").val("");
                // $("#rib").val("");
                $("#compte_id").val("").trigger('change');
            }


        });


        $(".paiement").on("change", function() {
            if ($(this).val() == 1) {
                $("#chequediv").hide();
                $("#numeropiece").val("");
                $("#porteur").val("");
                // $("#rib").val("");
                $("#compte_id").val("").trigger('change');



            } 
            else   if ($(this).val()==2 || $(this).val()==3) {
                $("#chequediv").show();
                $("#divnumero").show();
                $("#divporteur").show();

            } else if ($(this).val()==4) {
                $("#chequediv").show();

                $("#numeropiece").val("");
                $("#porteur").val("");
                $("#divnumero").hide();
                $("#divporteur").hide();
            }

        });



        $("#test").on("mouseover", function() {
            date = $("#date").val();
            caisse_id = $("#caisse_id").val();
            compte_id = $("#compte_id").val();
            paiement_id = $("#paiement_id").val();
            typedepense_id = $("#typedepense_id").val();
            type = $("#type").val();
            solde = $("#soldecourant").val();
            // alert(solde);
            montant = $("#montant").val();
            // alert(montant);
            if (date == "") {
                alert("veuillez choisir une date", function() {});
                return false;
            }
            if (type == "") {
                alert("veuillez choisir le type ", function() {});
                return false;
            }
            if (caisse_id == "" && $("#caisse_id").is(":visible")) {
                alert("veuillez choisir la caisse", function() {});
                return false;
            }
            if (compte_id == "" && $("#compte_id").is(":visible")) {
                alert("veuillez choisir le compte", function() {});
                return false;
            }
            if (typedepense_id == "") {
                alert("veuillez choisir le type de dépense", function() {});
                return false;
            }
            if (paiement_id == null || paiement_id == "" || paiement_id == 0) {
                alert("veuillez choisir le mode de paiement", function() {});
                return false;
            }
            if (montant == "") {
                alert("veuillez saisir le montant", function() {});
                return false;
            }
            if (Number(montant) > Number(solde) && $("#caisse_id").is(":visible")) {
                alert("Le montant de dépense a dépassé le solde de la caisse", function() {});
                return false;
            }
        });
    });











    function getMontant(id) {
        // alert();
        caisse_id = $("#caisse_id").val();
        // alert(caisse_id);
        if (caisse_id != "") {
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Depenses', 'action' => 'getsolde']) ?>",
                dataType: "json",
                data: {
                    caisse_id: caisse_id,
                },
                headers: {
                    "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
                },
                success: function(data) {
                    $('#soldecourant').val(data.montant);
                },
            });
        } else {
            $('#montant').val("");
        }
    }
</script>


<script>
    $(document).ready(function() {
      // Disable all input and select elements
      $('input, select , textarea').prop('disabled', true);
    });
  </script>

<?php $this->end(); ?>