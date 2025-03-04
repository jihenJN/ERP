<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">

    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
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
                            <h1 class="box-title" style="color:#3C386E!important;margin-top:5%;"><strong> Création Formulaire Consultation Client</strong></h1>

                        </div>
                    </div>
                    <!-- <h3 class="box-title">Formulaire Consultation Client</h3> -->
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create(null, ['role' => 'form','id'=>'testform', 'onkeypress' => "return event.keyCode!=13"]); ?>
               
         
               
               
               
                <div class="box box-primary">
                    <section class="content-header">
                        <h1 class="box-title"><strong><?php echo __('Civilité'); ?></strong></h1>
                        <br>
                    </section>
                    <div class="row">
                        <div class="row">


                            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Code', ['value' => $code, 'readonly', 'label' => 'Code Client', 'name', 'required' => 'off']); ?>
                                </div>

                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('responsable', ['label' => 'responsable']) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Adresse', ['label' => 'Adresse']) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('fax', ['label' => 'Fax']) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('Raison_Sociale', ['label' => 'Client', 'name', 'required' => 'off']); ?>
                                </div>

                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('mail', ['label' => 'Mail']) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('tel', ['label' => 'Tél']) ?>
                                </div>
                                <div class="col-xs-3">
                                    <?php echo $this->Form->control('portable', ['label' => 'Portable']) ?>
                                </div>
                            </div>
                        </div>


                        <section class="content-header">
                            <div class="box box-primary">
                                <h3 class="box-title"><strong><?php echo __('Demande Client'); ?></strong></h3><br>
                                <div class="row">

                                    
                                    <div class="row" style="gap: 20px; display: flex; flex-wrap: wrap;">
                                        <div style="margin: 0 auto; margin-left: 20px; margin-right: 20px; position: static; width: 100%;">
                                            <div class="col-xs-3" style="margin-bottom: 20px;">
                                                <?php echo $this->Form->control('dateconsulation', ['label' => 'Date Consultation', 'type' => 'datetime', 'name', 'required' => 'off']); ?>
                                            </div>

                                            <div class="col-xs-3" style="margin-bottom: 20px;">
                                                <?php echo $this->Form->control('delaivoulu', ['label' => 'Délai voulu Conception', 'type' => 'datetime']); ?>
                                            </div>

                                            <div class="col-xs-3" style="margin-bottom: 20px;">
                                                <?php echo $this->Form->control('delaireponse', ['type' => 'datetime', 'label' => 'Délai de Réponse']); ?>
                                            </div>

                                            <div class="col-xs-3" style="margin-bottom: 20px;">
                                                <?php echo $this->Form->control('delaiapprov', ['type' => 'datetime', 'label' => 'Délai d`approvisionnement']); ?>
                                            </div>
                                            <!--------JN changes ---------->
                                          <div class="col-xs-3" style="margin-bottom: 20px;">
                                            <div class="row d-flex align-items justify-content-start">
                                                <div class="col-xs-12">
                                                    <label> Type Contact </label>
                                                </div>
                                                <div class="col-xs-9">
                                                    <?= $this->Form->control('type_contact_id', [
                                                        'label' => false,
                                                        'options' => $typeContacts,
                                                        'empty' => 'Veuillez choisir !!',
                                                        'class' => 'form-control',
                                                        'id' => 'type_contact_select'
                                                    ]); ?>
                                                    <input type="text" id="new_type_contact" class="form-control" 
                                                        placeholder="Ajouter un type contact" 
                                                        style="display: none; margin-top: 5px;">
                                                </div>
                                                <div class="col-xs-3">
                                                    <button id="toggleAddType" style="height:35px;width:35" type="button" 
                                                            class="btn btn-sm btn-primary fa fa-plus-circle"></button>
                                                </div>
                                            </div>
                                        </div>


                                            <div class="col-xs-3" style="margin-bottom: 20px;">
                                            <?php  echo $this->Form->control('commercial_id', [
                                                'label' => 'Visiteurs',
                                                'options' => $commercials,
                                                'empty' => 'Veuillez choisir !!',
                                                'class' => 'form-control'
                                            ]);?>
                                            </div>

                                            <div class="col-xs-12">
                                                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                                    <?php foreach ($typedemandes as $id => $name): ?>
                                                        <label style="display: flex; align-items: center; gap: 5px;">
                                                            <input type="checkbox" class="typedemande-checkbox" name="typedemandes[]" value="<?= $id; ?>">
                                                            <?= h($name); ?>
                                                        </label>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </section>
                        <section class="content" style="width: 99%">
                            <div class="row">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <a class="btn btn-primary ajouterligne_w btn  btnajoutlignecommande" table="addtable" index="index" style="
                                       float: right;
                                       margin-bottom: 5px;
                                        border-color:#3C386E!important;background-color:#3C386E!important;">
                                            <i class="fa fa-plus-circle "></i>
                                        </a>

                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">
                                            <table border="1px" class="table table-bordered table-striped table-bottomless" id="addtable">

                                                <thead>
                                                    <tr>


                                                        <td align="center" style="width: 12%; font-size: 16px;">
                                                            <strong>N° boite</strong>
                                                        </td>

                                                        <td align="center" style="width: 14%;font-size: 16px;"><strong>Famille </strong></td>
                                                        <td align="center" style="width: 14%;font-size: 16px;"><strong>Sous-Famille </strong></td>
                                                        <td align="center" style="width: 15%;font-size: 16px;"><strong>Réf produit</strong></td>
                                                        <td align="center" style="width: 8%;font-size: 16px;"><strong>Qte</strong></td>

                                                        <td align="center" style="width: 10%;font-size: 16px;"><strong>Unité</strong></td>

                                                        <td align="center" style="width: 20%;font-size: 16px;"><strong>Exigence</strong></td>

                                                        <td align="center" style="width:2%;"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="tr afef" style="display: none;">
                                                        <td align="center" table="ligner">
                                                            <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control ">

                                                            <input table="ligner" champ="numboite" type="text" class="form-control " index>
                                                        </td>
                                                        <td align="center">
                                                            <select table="ligner" index champ="famille_id" class="form-control js-example-responsive   familles">
                                                                <option value="" selected="selected" disabled>Veuillez
                                                                    choisir !!</option>
                                                                <?php foreach ($familles as $id => $fam) {
                                                                ?>
                                                                    <option value="<?php echo $fam->id; ?>">
                                                                        <?php echo $fam->Nom ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                        </td>
                                                        <td align="center">
                                                            <div champ="divsous" id="divsous<?= $index ?>">
                                                                <select table="ligner" index champ="sousfamille1_id" class="form-control js-example-responsive   ">
                                                                    <option value="" selected="selected" disabled>Veuillez
                                                                        choisir !!</option>
                                                                    <?php foreach ($sousfamille1s as $id => $sous) {
                                                                    ?>
                                                                        <option value="<?php echo $sous->id; ?>">
                                                                            <?php echo $sou->name ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <div champ="divart" id="divart<?= $index ?>">
                                                                <select table="ligner" index champ="article_id" class="form-control js-example-responsive   ">
                                                                    <option value="" selected="selected" disabled>Veuillez
                                                                        choisir !!</option>
                                                                    <?php foreach ($articles as $id => $article) {
                                                                    ?>
                                                                        <option value="<?php echo $article->id; ?>">
                                                                            <?php echo $article->Code . ' ' . $article->Dsignation ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <input table="ligner" champ="qte" type="text" class="form-control " index>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <div champ="divunite" id="divunite<?= $index ?>">

                                                                <select readonly table="ligner" index champ="unite_id" class=" form-control ">
                                                                    <option value="" selected="selected" disabled>Veuillez
                                                                        choisir !!</option>
                                                                    <?php //debug($unitearticles);
                                                                    foreach ($unites as $id => $unite) {
                                                                    ?>
                                                                        <option value="<?php echo $unite->id; ?>">
                                                                            <?php echo $unite->name ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </td>


                                                        <td align="center" table="ligner">
                                                            <input table="ligner" champ="exigence" type="text" class="form-control " index>
                                                        </td>
                                                        <td align="center" table="ligner">
                                                            <i id="" class="fa fa-times getmontant pourcentescompte supLigne0ch" style="color: #c9302c;font-size: 22px;" table="ligner" name=""></i>
                                                            <input type='hidden' table="ligner" champ="suptest" class="form-control" index name='' id="">
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" value="-1" id="index">
                                                </tbody>

                                            </table>
                                            <br />
                                            <!-- <a class="btn btn-primary ajouterligne_w btn  btnajoutlignecommande" table="addtable" index="index" style="
                                                    float: right;
                                                    margin-bottom: 5px;
                                                    ">
                                                <i class="fa fa-plus-circle "></i></a> -->
                                        </div>


                                    </div>
                                </div>
                            </div>


                        </section>







                    </div>




                </div>

                <div align="center">
                    <button type="submit" class="pull-right btn btn-primary btn-sm " id="testformulaire" style="margin-right:48%;margin-top: 20px;margin-bottom:20px; border-color:#3C386E!important;background-color:#3C386E!important;">Création</button>
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
    document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("testform");

    form.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Bloquer l'action par défaut
        }
    });

    form.addEventListener("submit", function (event) {
        // Facultatif : Vous pouvez ajouter des vérifications ici
       // console.log("Formulaire soumis !");
    });
});

    $('.select2').select2()

    $(function() {
        $('.familles').on('change', function() {
            const index = $(this).attr('index');
            const id = $('#famille_id' + index).val();

            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Demandeclients', 'action' => 'getsousfam']) ?>",
                dataType: "json",
                data: {
                    id: id,
                    ind: index
                },
                success: function(data) {
                    $('#divsous' + index).html(data.select);
                    // alert(data.select);
                }
            });
        });



    });

    function getArticles(id, index) {
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Demandeclients', 'action' => 'getarticles']) ?>",
            dataType: "json",
            data: {
                id: id,
                ind: index
            },
            success: function(data) {
                $('#divart' + index).html(data.select);
                // alert(data.select)
            }
        });
    }

    function getUnites(id, index) {
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Demandeclients', 'action' => 'getunites']) ?>",
            dataType: "json",
            data: {
                id: id,
                ind: index
            },
            success: function(data) {
                $('#divunite' + index).html(data.select);
                // alert(data.select);
            }
        });
    }


    $("#testformulaire").on("mouseover", function() {
    let code = $("#code").val();
    let responsable = $("#responsable").val();
    let adresse = $("#adresse").val();
    let fax = $("#fax").val();
    let raison = $("#raison-sociale").val();
    let mail = $("#mail").val();
    let tel = $("#tel").val();
    let portable = $("#portable").val();

    let dateconsulation = $("#dateconsulation").val();
    let delaivoulu = $("#delaivoulu").val();
    let delaireponse = $("#delaireponse").val();
    let delaiapprov = $("#delaiapprov").val();
    let ind = $(this).attr("index");

    let index = $("#index").val();
    let supp = $("#sup" + ind).val();

    // Réinitialisation de l'état du bouton
    $("#testformulaire").prop('disabled', false);

    // Vérification des champs
    if (!code) {
        alert("Saisissez un Code Client");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!responsable) {
        alert("Saisissez le responsable");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!adresse) {
        alert("Saisissez une adresse");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!fax) {
        alert("Saisissez le fax");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!raison) {
        alert("Saisissez le raison social du client");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!mail) {
        alert("Saisissez le mail");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!tel) {
        alert("Saisissez le Numéro tel");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!portable) {
        alert("Saisissez le Numéro portable");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!dateconsulation) {
        alert("Saisissez la date de consultation");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!delaivoulu) {
        alert("Saisissez le délai voulu pour la conception");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!delaireponse) {
        alert("Saisissez le délai de réponse");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }
    if (!delaiapprov) {
        alert("Saisissez le délai d'approvisionnement");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }

    if ($(".typedemande-checkbox:checked").length === 0) {
        alert("Veuillez choisir au moins un type de demande");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }

    if (index == -1) {
        alert("Ajoutez au moins une ligne");
        $("#testformulaire").prop('disabled', true);  // Désactivation du bouton
        return false;
    }

    // Si tout est valide, on garde le bouton activé
    return true;
});


    $(function() {
        $('.supLigne0ch').on('click', function() {
            nbligne = $('#nbligne').val($('#nbligne').val() - 1);
            indd = Number($('#index').val());
            index = $(this).attr('index');
            artt = $('#article_id' + index).val();
            for (j = 0; j <= indd; j++) {
                art = $('#article_id' + j).val();
                if (Number(art) == Number(artt)) {
                    $('#trart' + j).hide();
                }
            }

            i = $(this).attr('index');
            //  alert(index);
            //  qte = $('#qte' + index).val();
            //          indexpre=Number(ind)+1;
            $('#sup' + i).val('1');
            $('#suptest' + i).val('1');
            $(this).parent().parent().hide();


        })
    });
    $(".ajouterligne_w").on("click", function() {
        // alert('alll');
        table = $(this).attr("table");
        // alert(table);
        index = $(this).attr("index");
        ind = $("#index").val();
        supp = $("#sup" + ind).val();

        // i=Number(ind)+1;

        remise = $("#remise").val(); //alert(remise);
        if (
            (!$("#article_id" + ind).val() || !$("#qte" + ind).val()) &&
            ind != -1 &&
            supp != 1
        ) {
            // alert("veuillez choisir l'article et la quantité");
            return false;
        }

        ajouter(table, index);

    });

    function ajouter(table, index) {
        //alert("hh");
        //  alert(index);
        ind = Number($("#" + index).val()) + 1;
        $ttr = $("#" + table)
            .find(".tr")
            .clone(true);
        $ttr.attr("class", "");
        i = 0;
        tabb = [];
        $ttr.find("input,select,textarea,tr,td,div,ul,li").each(function() {
            //alert()
            tab = $(this).attr("table"); //alert(tab)
            champ = $(this).attr("champ");
            $(this).attr("index", ind);
            $(this).attr("id", champ + ind); //alert(champ);
            if (champ == "marchandisetype_id") {
                //alert(champ)
                $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "][]");
                $(this).attr(
                    "data-bv-field",
                    "data[" + tab + "][" + ind + "][" + champ + "]"
                );
            } else {
                $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "]");
                $(this).attr(
                    "data-bv-field",
                    "data[" + tab + "][" + ind + "][" + champ + "]"
                );
            }
            $type = $(this).attr("type");
            $(this).val("");
            if ($type == "radio") {
                $(this).attr("name", "data[" + champ + "]");
                //$(this).attr('value',ind);
                $(this).val(ind);
            }
            if (champ == "datedebut" || champ == "datefin") {
                $(this).attr("onblur", "nbrjour(" + ind + ")");
            }
            $(this).removeClass("anc");
            if ($(this).is("select", "multiple")) {
                //alert(champ);
                //alert(ind);
                tabb[i] = champ + ind; //alert(tabb[i]);
                i = Number(i) + 1;
            }
            // $(this).val('');
        });
        $ttr.find("i").each(function() {
            $(this).attr("index", ind);
        });
        $("#" + table).append($ttr);
        $("#" + index).val(ind);

        $("#" + table)
            .find("tr:last")
            .show();
        // $("#article_id" + ind).select2({
        //   width: "100%", // need to override the changed default
        // });
        $("#charge_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#article" + ind).select2({
            width: "100%", // need to override the changed default
        });
        // $("#article_id" + ind).select2({
        //     width: "100%", // need to override the changed default
        // });
        $("#famille_id" + ind).select2("open");
        $("#client_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#fr_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#banque_id" + ind).select2({
            width: "100%", // need to override the changed default
        });
        $("#typeexon_id" + ind).select2({
            width: "100%", // need to override the changed default
        });

        $("#gouvernorat_id" + ind).select2({
            width: "75%", // need to override the changed default
        });
        $("#ligneplan_id" + ind).select2({
            width: "75%", // need to override the changed default
        });
        $("#nature_id" + ind).select2({
            width: "75%", // need to override the changed default
        });
        $("#taxe_id" + ind).select2({
            width: "75%", // need to override the changed default
        });

        $("#champ_id" + ind).select2({
            width: "75%", // need to override the changed default
        });

        //indd = Number($("#" + index).val()) ;
        //alert(indd);
        $("#inserted" + ind).val(1);

        $("#auto" + ind).val(1);

        for (j = 0; j <= i; j++) {
            // alert(tabb[j]);
            //  $('marchandisetype_id1').attr('class','select2');
            //  uniform_select(tabb[j]); jareb
            //$('#'+tabb[j]).select2({ });
        }
    }
</script>
<?php $this->end(); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#toggleAddType").click(function() {
        let select = $("#type_contact_select");
        let input = $("#new_type_contact");
        let button = $("#toggleAddType");

        if (input.length === 0) {
            // Create input dynamically
            input = $("<input>", {
                type: "text",
                id: "new_type_contact",
                class: "form-control",
                placeholder: "Enter new type contact"
            }).insertAfter(select).focus();

            select.prop("disabled", true);
            button.removeClass("fa-plus-circle btn-primary")
                  .addClass("fa-times-circle btn-danger");

            // Listen for Enter key to add new type contact
            input.on("keydown", function(e) {
                if (e.key === "Enter") { // Enter key pressed
                    let newType = $(this).val().trim();

                    if (newType !== "") {
                        let newOption = $("<option>", {
                            value: newType, // Keeping value same as text
                            text: newType,
                            selected: true
                        });

                        select.append(newOption);
                        input.remove();
                        select.prop("disabled", false);
                        button.removeClass("fa-times-circle btn-danger")
                              .addClass("fa-plus-circle btn-primary");
                    }
                }
            });

        } else {
            // Remove input, enable select, reset button
            input.remove();
            select.prop("disabled", false);
            button.removeClass("fa-times-circle btn-danger")
                  .addClass("fa-plus-circle btn-primary");
        }
    });
});

</script>


