<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Devi $devi
 * @var \Cake\Collection\CollectionInterface|string[] $clients
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
    <h1>
        Ajout Type Contact
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
            <div class="box ">

                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($devi, ['role' => 'form']); ?>
                <div class="box-body">


                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numero', ['label' => 'Numéro', 'readOnly' => true]); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('date', ['label' => 'Date']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?= $this->Form->control('client_id', [
                                'label' => 'Client',
                                'options' => $clients,
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'type' => 'select',
                            ]); ?>


                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('total_remise', ['label' => 'Total Remise']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('total_ht', ['label' => 'Total HT']); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('total_brute', ['label' => 'Total Brute']); ?>
                        </div>
                    </div>

                    //////////////////////

                    <br>

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


                                                    <td align="center" style="width: 12%; font-size: 16px;"><strong>Article</strong></td>
                                                    <td align="center" style="width: 14%;font-size: 16px;"><strong>Prix Unitaire</strong></td>
                                                    <!--td align="center" style="width: 8%;font-size: 16px;"><strong>Qte</strong></td-->
                                                    <!--td align="center" style="width: 14%;font-size: 16px;"><strong>Prix Brute</strong></td-->
                                                    <td align="center" style="width: 15%;font-size: 16px;"><strong>Remise</strong></td>
                                                    <td align="center" style="width: 15%;font-size: 16px;"><strong>Prix HT</strong></td>
                                                    <td align="center" style="width:2%;"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="tr afef" style="display: none;">
                                                    <!--td align="center" table="ligner">
                                                        <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control ">

                                                        <input table="ligner" champ="numboite" type="text" class="form-control " index>
                                                    </td-->

                                                    <td align="center" table="ligner">
                                                        <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control ">
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
                                                        <input table="ligner" champ="prix" type="text" class="form-control " index>
                                                    </td>
                                                    	

                                                    <td align="center" table="ligner">
                                                        <input table="ligner" champ="ht" type="text" class="form-control " index>
                                                    </td>

                                                    <td align="center" table="ligner">
                                                        <input table="ligner" champ="remise" type="text" class="form-control " index>
                                                    </td>
                                             

                                                    <!--td align="center" table="ligner">
                                                            <input table="ligner" champ="qte" type="text" class="form-control " index>
                                                        </td-->



                                                </tr>
                                                <input type="hidden" value="-1" id="index">
                                            </tbody>

                                        </table>
                                        <br />

                                    </div>


                                </div>
                            </div>
                        </div>


                    </section>




                </div>
</section>




<button type="submit" class="pull-right btn btn-success" id="testde" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
<?php echo $this->Form->end(); ?>
</div>

<!-- /.box-body -->


</div>
<!-- /.box -->
</div>
</div>
<!-- /.row -->
</section>


<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
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

    $(function() {
        /*  $('.familles').on('change', function() {
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
          });*/



    });

    function getArticles(index) {
        console.log(index);
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Devis', 'action' => 'getarticles']) ?>",
            dataType: "json",
            data: {


                ind: index
            },

            success: function(data) {
                $('#divart' + index).html(data.select);
                alert(data.select)
            }


        });
    }

    /*  function getUnites(id, index) {
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
      }*/


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
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!responsable) {
            alert("Saisissez le responsable");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!adresse) {
            alert("Saisissez une adresse");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!fax) {
            alert("Saisissez le fax");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!raison) {
            alert("Saisissez le raison social du client");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!mail) {
            alert("Saisissez le mail");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!tel) {
            alert("Saisissez le Numéro tel");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!portable) {
            alert("Saisissez le Numéro portable");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!dateconsulation) {
            alert("Saisissez la date de consultation");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!delaivoulu) {
            alert("Saisissez le délai voulu pour la conception");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!delaireponse) {
            alert("Saisissez le délai de réponse");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }
        if (!delaiapprov) {
            alert("Saisissez le délai d'approvisionnement");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }

        if ($(".typedemande-checkbox:checked").length === 0) {
            alert("Veuillez choisir au moins un type de demande");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
            return false;
        }

        if (index == -1) {
            alert("Ajoutez au moins une ligne");
            $("#testformulaire").prop('disabled', true); // Désactivation du bouton
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

            if (input.is(":visible")) {
                // Hide input and reset value
                input.hide().val("");
                select.prop("disabled", false);
                button.removeClass("fa-times-circle btn-danger")
                    .addClass("fa-plus-circle btn-primary");
            } else {
                // Show input and disable select
                input.show().focus();
                select.prop("disabled", true);
                button.removeClass("fa-plus-circle btn-primary")
                    .addClass("fa-times-circle btn-danger");

                // Listen for Enter key to add new type
                input.off("keydown").on("keydown", function(e) {
                    if (e.key === "Enter") {
                        e.preventDefault(); // Prevent form submission
                        let newType = $(this).val().trim();

                        if (newType !== "") {
                            let newOption = $("<option>", {
                                value: newType,
                                text: newType,
                                selected: true
                            });

                            select.append(newOption);
                            input.hide();
                            select.prop("disabled", false);
                            button.removeClass("fa-times-circle btn-danger")
                                .addClass("fa-plus-circle btn-primary");
                        }
                    }
                });
            }
        });

        // Ensure input is correctly submitted
        $("form").submit(function() {
            let input = $("#new_type_contact");
            let select = $("#type_contact_select");

            if (input.is(":visible") && input.val().trim() !== "") {
                select.append($("<option>", {
                    value: input.val().trim(),
                    text: input.val().trim(),
                    selected: true
                }));
                input.hide();
            }
        });
    });
</script>