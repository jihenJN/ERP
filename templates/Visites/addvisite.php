<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/summernote/summernote.min', ['block' => 'css']); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"> </script>

<?php echo $this->Html->css('select2'); ?>

<section class="content-header">

    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
                <?php echo __('Retour'); ?></a></li>
    </ol>
</section><br>

<section class="content">

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="col-md-12">
                        <div class="col-xs-6">
                            <?php echo $this->Html->image('logoSMBM.png', array('width' => '250px', 'height' => '110px')); ?>
                        </div>
                        <div class="col-xs-6">
                            <h1 class="box-title" style="color:#3C386E!important;margin-top:5%;"><strong>Ajouter Visite
                                    sur site N° <?php echo $mm; ?></strong></h1>

                        </div>
                    </div>
                    <!-- <h3 class="box-title">Formulaire Consultation Client</h3> -->
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($visite, ['role' => 'form', 'id' => 'testform', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"]); ?>
                <div class="box box-primary">
                    <!-- <section class="content-header">
                        <h1 class="box-title"><strong><?php echo __('Civilité'); ?></strong></h1>
                        <br>
                    </section> -->
                    <div class="row">
                        <div class="row">
                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6" style="margin-bottom: 20px;">
                                    <?php echo $this->Form->control('datecontact', ['label' => 'Date Contact', 'type' => 'datetime', 'name']); ?>
                                </div>
                                <div class="col-xs-6" style="margin-bottom: 20px;">
                                    <?php echo $this->Form->control('dateplanifie', ['label' => 'Date Planifiée pour la visite', 'type' => 'datetime']); ?>
                                </div>
                                <?php if (!empty($id) && isset($clients)): ?>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Raison_Sociale', ['label' => 'Client', 'readonly' => 'readonly', 'value' => $clients->Raison_Sociale]) ?>
                                    <?php echo $this->Form->control('client_id', ['label' => 'Client', 'type' => 'hidden', 'value' => $clients->id]) ?>

                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Adresse', ['label' => 'Adresse', 'readonly' => 'readonly', 'value' => $clients->Adresse]) ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('responsable', ['label' => 'Responsable', 'readonly' => 'readonly', 'value' => $clients->responsable]) ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('Tel', ['label' => 'Tel', 'readonly' => 'readonly', 'value' => $clients->Tel, 'name']); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('libelle', ['label' => 'Type Contact', 'readonly' => 'readonly', 'value' => $typeContacts->libelle]) ?>
                                    <?php echo $this->Form->control('type_contact_id', ['label' => 'Type Contact', 'type' => 'hidden', 'value' => $typeContacts->id]) ?>
                                </div>
                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('name', ['label' => 'Visiteur', 'readonly' => 'readonly', 'value' => $commercials->name]) ?>
                                    <?php echo $this->Form->control('commercial_id', ['label' => 'Visiteur', 'type' => 'hidden', 'value' => $commercials->id]) ?>
                                </div>
                                <?php else: ?>
                                    
                                <!-- If there is  no demandeclient id  -->

                                <div class="col-xs-6 addable-type-container">
                                        <div class="col-xs-12">
                                            <label>Clients</label>
                                        </div>
                                        <div class="col-xs-11">
                                            <?php echo $this->Form->control('client_id', [
                                                'label' => false,
                                                'options' => $clientsList,
                                                'empty' => 'Veuillez choisir !!',
                                                'class' => 'form-control type-contact-select'
                                            ]); ?>

                                            <input type="text" class="form-control new-type-contact"
                                                placeholder="Ajouter un type contact"
                                                style="display: none; margin-top: 5px;">
                                            <input type="hidden" name="Raison_Sociale" class="hidden-new-type-contact">
                                        </div>

                                        <div class="col-xs-1">
                                            <button type="button"
                                                class="btn btn-sm btn-primary fa fa-plus-circle toggle-add-type"
                                                style="height:35px;width:35px;"></button>
                                        </div>

                                    </div>


                                    <div class="col-xs-6 addable-type-container">
                                        <div class="col-xs-12">
                                            <label>Type Contacts</label>
                                        </div>
                                        <div class="col-xs-11">
                                            <?php echo $this->Form->control('type_contact_id', [
                                                'label' => false,
                                                'options' => $typeContactsList,
                                                'empty' => 'Veuillez choisir !!',
                                                'class' => 'form-control type-contact-select',
                                            ]); ?>
                                            <input type="text" class="form-control new-type-contact"
                                                placeholder="Ajouter un type contact"
                                                style="display: none; margin-top: 5px;">
                                            <input type="hidden" name="libelle" class="hidden-new-type-contact">
                                        </div>
                                        <div class="col-xs-1">
                                            <button type="button"
                                                class="btn btn-sm btn-primary fa fa-plus-circle toggle-add-type"
                                                style="height:35px;width:35px;"></button>
                                        </div>
                                    </div>

                                <div class="col-xs-6">
                                    <?php echo $this->Form->control('commercial_id', [
                                            'label' => 'Visiteurs',
                                            'options' => $commercialsList,
                                            'empty' => 'Veuillez choisir !!',
                                            'class' => 'form-control'
                                        ]); ?>
                                </div>


                                <div class="col-xs-6" style="margin-bottom: 20px;">
                                    <?php echo $this->Form->control('date_visite', ['label' => 'Date de la visite', 'type' => 'datetime']); ?>
                                </div>

                                <?php endif; ?>

                            </div>
                        </div>

                        <section class="content-header">
                            <div class="box box-primary">
                                <!-- <h3 class="box-title"><strong><?php echo __('Demande Client'); ?></strong></h3><br> -->
                                <div class="row">


                                    <div class="row" style="gap: 20px; display: flex; flex-wrap: wrap;">
                                        <div
                                            style="margin: 0 auto; margin-left: 20px; margin-right: 20px; position: static; width: 100%;">


                                            <div class="col-xs-6" style="margin-bottom: 20px;">

                                                <label>Travail demandé :</label>
                                                <?php echo $this->Form->control('trdemande', ['type' => 'textarea', 'label' => false]); ?>
                                            </div>
                                            <div class="col-xs-6"></div>
                                            <div class="col-xs-12" style="margin-bottom: 20px;">
                                                <label>Description :</label>

                                                <textarea id="editor-container1" name="description"
                                                    class="form-control summernote" rows="100" cols="100"
                                                    style="height: 900px;">

                                               </textarea>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                        <section class="content" style="width: 98%">
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="box-header with-border">

                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table" style=" height: 100%;">
                                            <div class="col-xs-12" style="margin-bottom: 20px;">

                                                <label>Schéma décriptif :</label>
                                                <?php echo $this->Form->control('descriptif', ['name' => 'descriptif', 'type' => 'textarea', 'label' => false]); ?>
                                            </div>
                                            <br><br>
                                            <div class="col-xs-12">
                                                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                                    <?php foreach ($typebesoins as $id => $name): ?>
                                                    <label style="display: flex; align-items: center; gap: 5px;">
                                                        <input type="checkbox" class="typebesoin-checkbox"
                                                            name="typebesoins[]" value="<?= $id; ?>">
                                                        <?= h($name); ?>
                                                    </label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>


                                            <div class="col-xs-12" id="piece" style="display:none;">
                                                <?php echo $this->Form->input('piece', ['type' => 'file', 'id' => 'pie', 'label' => false]); ?>
                                            </div>
                                            <br>

                                            <br><br>

                                            <div class="col-xs-12" style="margin-bottom: 20px;">
                                                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                                    <label>Compte rendu à qui ?:</label> &nbsp; &nbsp; &nbsp; &nbsp;
                                                    &nbsp; &nbsp;

                                                    <?php foreach ($compterendus as $id => $name): ?>
                                                    <label style="display: flex; align-items: center; gap: 5px;">
                                                        <input type="checkbox" class="compterendu-checkbox"
                                                            name="compterendus[]" value="<?= $id; ?>">
                                                        <?= h($name); ?>
                                                    </label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-6" style="margin-bottom: 20px;">
                                                <?php echo $this->Form->control('datecptrendu', ['label' => 'Date compte rendu', 'type' => 'datetime', 'name']); ?>
                                            </div>

                                        </div>


                                    </div>

                                </div>
                            </div>


                        </section>







                    </div>




                </div>

                <div align="center">
                    <button type="submit" class="pull-right btn btn-primary btn-sm " id="testformulaire"
                        style="margin-right:48%;margin-top: 20px;margin-bottom:20px; border-color:#3C386E!important;background-color:#3C386E!important;">Création</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
$(document).ready(function() {
    $('.typebesoin-checkbox').change(function() {
        if ($('.typebesoin-checkbox[value="1"]').is(':checked')) {
            $('#piece').show();
        } else {
            $('#piece').hide();
        }
    });
});
</script>
<script>
$(function() {
    $('.summernote').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']]
        ],
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Calibri',
            'Calibri light',
            'Sakkal Majalla',
            'Aldhabi',
            'Arabic typesetting',
            'Algerian',

            'Bell MT',
            'Bodoni MT',
            'Bookman Old Style',
            'Bradley Hand ITC',
            'Californian FB',
            'Centaur',
            'Century',
            'Corbel light',
            'Lucida Calligraphy',
            'Leelawadee UI',
            'Leelawadee UI Semilight',
            'Ink free',
            'Modern No. 20',
            'Monotype Corsiva',
            'Perpetua Titling MT',
            'Pristina',
            'Sitka text',
        ]
    });
})
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("testform");

    form.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Bloquer l'action par défaut
        }
    });

    form.addEventListener("submit", function(event) {
        // Facultatif : Vous pouvez ajouter des vérifications ici
        // console.log("Formulaire soumis !");
    });
});

$('.select2').select2()



$("#testformulaire").on("mouseover", function() {
    let datecontact = $("#datecontact").val();
    let dateplanifie = $("#dateplanifie").val();
    let trdemande = $("#trdemande").val();
    let description = $("#editor-container1").val();
    let descriptif = $("#descriptif").val();
    let datecptrendu = $("#datecptrendu").val();
    let pie = $("#pie").val();


    $("#testformulaire").prop('disabled', false);

    if (!datecontact) {
        alert("Saisissez la date contact");
        $("#testformulaire").prop('disabled', true); // Désactivation du bouton
        return false;
    }
    if (!dateplanifie) {
        alert("Saisissez la date planifiée");
        $("#testformulaire").prop('disabled', true); // Désactivation du bouton
        return false;
    }
    if (!trdemande) {
        alert("Saisissez le travail demandé");
        $("#testformulaire").prop('disabled', true); // Désactivation du bouton
        return false;
    }
    if (!description) {
        alert("Saisissez la Description");
        $("#testformulaire").prop('disabled', true); // Désactivation du bouton
        return false;
    }
    if (!descriptif) {
        alert("Saisissez la Schéma décriptif");
        $("#testformulaire").prop('disabled', true); // Désactivation du bouton
        return false;
    }



    if ($(".typebesoin-checkbox:checked").length === 0) {
        alert("Veuillez choisir au moins un besoin visite");
        $("#testformulaire").prop('disabled', true); // Désactivation du bouton
        return false;
    }
    if ($('.typebesoin-checkbox[value="1"]').is(':checked') && !pie) {
        alert("Veuillez choisir une piece jointe");
        $("#testformulaire").prop('disabled', true); // Désactivation du bouton
        return false;

    }

    if ($(".compterendu-checkbox:checked").length === 0) {
        alert("Veuillez choisir le Compte rendu à qui ?");
        $("#testformulaire").prop('disabled', true); // Désactivation du bouton
        return false;
    }

    return true;
});
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
        $(".toggle-add-type").click(function() {
            let button = $(this);
            let container = button.closest(".addable-type-container");
            let select = container.find(".type-contact-select");
            let input = container.find(".new-type-contact");
            let hiddenInput = container.find(".hidden-new-type-contact");

            if (input.is(":visible")) {
                // Hide input, enable select, reset button
                input.hide().val("");
                select.prop("disabled", false);
                button.removeClass("fa-times-circle btn-danger").addClass("fa-plus-circle btn-primary");
            } else {
                // Show input, disable select
                input.show().focus();
                select.prop("disabled", true);
                button.removeClass("fa-plus-circle btn-primary").addClass("fa-times-circle btn-danger");

                // Handle Enter key press
                input.off("keydown").on("keydown", function(e) {
                    if (e.key === "Enter") {
                        e.preventDefault();
                        let newType = input.val().trim();

                        if (newType !== "") {
                            let newOption = $("<option>", {
                                value: "new_" + newType,
                                text: newType,
                                selected: true
                            });

                            select.append(newOption);
                            hiddenInput.val(newType); // Store new value
                            input.hide().val("");
                            select.prop("disabled", false);
                            button.removeClass("fa-times-circle btn-danger").addClass(
                                "fa-plus-circle btn-primary");
                        }
                    }
                });
            }
        });
    });
</script>

<?php $this->end(); ?>