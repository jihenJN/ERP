<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Devi $devi
 * @var string[]|\Cake\Collection\CollectionInterface $clients
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
            <div class="box">
                <?php echo $this->Form->create($devi, ['role' => 'form']); ?>
                <div class="box-body">
                    <div class="row" style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('numero', ['label' => 'Numéro', 'readOnly' => true]); ?>
                        </div>
                        <div class="col-xs-6">
                            <?php echo $this->Form->control('date', ['label' => 'Date']); ?>
                        </div>
                        <br>
                        <div class="col-xs-6">
                            <?= $this->Form->control('client_id', [
                                'label' => 'Client',
                                'options' => $clients,
                                'empty' => 'Veuillez choisir!!!',
                                'class' => 'form-control select2 ',
                                'type' => 'select',
                            ]); ?>


                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <a class="btn btn-primary ajouterligne_w btn  btnajoutlignecommande"
                                    table="addtable" index="index" style="
                                       float: right;
                                       margin-bottom: 5px;
                                        border-color:#3C386E!important;background-color:#3C386E!important;">
                                    <i class="fa fa-plus-circle "></i>
                                </a>

                            </div>
                            <div class="panel-body">
                                <div class="table-responsive ls-table">
                                    <table border="1px" class="table table-bordered table-striped table-bottomless"
                                        id="addtable">

                                        <thead>
                                            <tr>
                                                <td align="center" style="width: 12%; font-size: 16px;">
                                                    <strong>Article</strong>
                                                </td>
                                                <td align="center" style="width: 14%;font-size: 16px;"><strong>Prix
                                                        Unitaire</strong></td>
                                                <td align="center" style="width: 8%;font-size: 16px;">
                                                    <strong>Qte</strong>
                                                </td>

                                                <td align="center" style="width: 15%;font-size: 16px;">
                                                    <strong>Remise %</strong>
                                                </td>
                                                <td align="center" style="width: 15%;font-size: 16px;"><strong>Prix
                                                        HT</strong></td>
                                                <td align="center" style="width:2%;"></td>


                                            </tr>
                                        </thead>
                                        <?php $index = 0; ?>
                                        <tbody>
                                            <?php foreach ($lignedevis as $i => $res):   ?>
                                                
                                                <tr>

                                                    <td align="center">
                                                        <?php echo $this->Form->input('sup', array('name' => "data[ligner][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => '', 'class' => 'form-control', 'type' => 'hidden')); ?>
                                                        <?php
                                                        echo $this->Form->input('id', array(
                                                            'champ' => 'id',
                                                            'label' => '',
                                                            'name' => 'data[ligner][' . $i . '][id]',
                                                            'value' => $res->id,
                                                            'type' => 'hidden',
                                                            'id' => '',
                                                            'table' => 'ligner',
                                                            'index' => '',
                                                            'div' => 'form-group',
                                                            'between' => '<div class="col-sm-12">',
                                                            'after' => '</div>',
                                                            'class' => 'form-control'
                                                        ));
                                                        ?>
                                                        <div champ="divart" index="<?= $i ?>" id="divart<?= $i ?>">

                                                            <select name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" id="<?php echo 'article_id' . $i ?>" table="ligner" index="<?php echo $i ?>" champ="article_id" class="form-control articleidbl1 Testdep single">
                                                                <option disabled="true" disabled>Veuillez choisir !!</option>
                                                                <?php foreach ($articles as $id => $article) {
                                                                ?>
                                                                    <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>



                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('prix', array('label' => '', 'value' => $res->prix, 'name' => 'data[ligner][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number', 'index', 'readOnly' => true)); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('qte', array('label' => '', 'value' => $res->qte, 'name' => 'data[ligner][' . $i . '][qte]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number', 'index')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('remise', array('label' => '', 'value' => $res->remise, 'name' => 'data[ligner][' . $i . '][remise]', 'type' => 'text', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number', 'index')); ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $this->Form->input('ht', array('label' => '', 'value' => $res->ht, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number', 'index', 'readOnly' => true)); ?>
                                                    </td>

                                                    <td align="center" table="ligner">
                                                        <i id="" class="fa fa-times supLigne0ch" style="color: #c9302c;font-size: 22px;" table="ligner"   index="<?= $i ?>"  name=""></i>
                                                        <input type='hidden' table="ligner" champ="suptest" class="form-control" name='' >
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr class="tr" style="display: none;">
                                                <td align="center" table="ligner">
                                                    <input type="hidden" id="" champ="sup" name="" table="ligner"
                                                        index="" class="form-control ">
                                                    <div champ="divart" id="divart<?= $index ?>">
                                                        <select table="ligner" index champ="article_id"
                                                            class="form-control js-example-responsive   ">
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
                                                    <input table="ligner" champ="prix" type="text"
                                                        class="form-control " readonly=true index>
                                                </td>
                                                <td align="center" table="ligner">
                                                    <input table="ligner" champ="qte" type="text"
                                                        class="form-control " index>
                                                </td>
                                                <td align="center" table="ligner">
                                                    <input table="ligner" champ="remise" type="text"
                                                        class="form-control " index>
                                                </td>
                                                <td align="center" table="ligner">
                                                    <input table="ligner" champ="ht" type="text"
                                                        class="form-control " readonly=true index>
                                                </td>
                                                <td align="center" table="ligner">
                                                    <i id="" class="fa fa-times supLigne0ch" style="color: #c9302c;font-size: 22px;" table="ligner" name=""></i>
                                                    <input type='hidden' table="ligner" champ="suptest" class="form-control" index name='' id="" >
                                                </td>
                                            </tr>
                                            <input type="text" value="<?php echo $i; ?>" id="index" style="display: none;">
                                        </tbody>

                                    </table>
                                    <br />

                                </div>


                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Totals Section (Still Inside Box-Body to Ensure It Works) -->
                    <div class="row" style="text-align: right" ;>
                        <div class="col-xs-12">
                            <div class="form-inline">

                                <label style="text-align: end;">Total Brute</label>
                                <?php echo $this->Form->control('total_brute', ['label' => false, 'readonly' => true, 'class' => 'form-control']); ?>
                            </div>
                        </div>
                        <br>
                        <div class="col-xs-12">
                            <div class="form-inline">
                                <label style="text-align: end;">Total Remise</label>
                                <?php echo $this->Form->control('total_remise', ['label' => false, 'readonly' => true, 'class' => 'form-control']); ?>
                            </div>
                        </div>
                        <br>
                        <div class="col-xs-12">
                            <div class="form-inline">

                                <label style="text-align: end;">Total HT</label>
                                <?php echo $this->Form->control('total_ht', ['label' => false, 'readonly' => true, 'class' => 'form-control']); ?>
                            </div>
                        </div>



                    </div>

                </div>

            </div>
        </div>
        <button type="submit" class="pull-right btn btn-success" id="testde" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
    </div>

</section>




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

    $(document).on('change', 'select[champ="article_id"]', function() {
        var index = $(this).attr('index');
        var articleId = $(this).val();
        if (articleId) {
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Devis', 'action' => 'getArticleDetails']) ?>", // Correct URL for the getArticleDetails method
                dataType: "json",
                data: {
                    id: articleId // Send the article ID to the server
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content') // Include CSRF token if needed
                },
                success: function(data) {
                    console.log("Response from server:", data);
                    if (data.prixachat) {
                        $('#prix' + index).val(data.prixachat);
                        console.log(data.prixachat);
                    }
                    // Trigger update after article price is fetched
                    updateTotals();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX request failed: " + textStatus + ", " + errorThrown);
                    console.log("Response Text: " + jqXHR.responseText);
                }
            });
        }
    });


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
    /*
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
        }*/


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
            console.log("supp cliqued")  ;     
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
            console.log(i);

            $('#sup' + i).val('1');
            $('#suptest' + i).val('1');
            $(this).parent().parent().hide();
            updateTotals();


        })
    });


    

    $(".ajouterligne_w").on("click", function() {
        // Get table and index
        var table = $(this).attr("table");
        var index = $(this).attr("index");
        var ind = $("#index").val();
        var supp = $("#sup" + ind).val();

        //   var remise = $("#remise").val();

        // Check if required fields are filled
        if (
            (!$("#article_id" + ind).val() || !$("#qte" + ind).val()) &&
            ind != -1 &&
            supp != 1
        ) {
            return false; // Do not proceed if fields are not valid
        }

        // Add a new row and update total brute
        ajouter(table, index);
        updateTotals();
    });


    function updateTotalBrute() {
        var totalBrute = 0;
        $("tbody tr:visible").each(function(index) {
            var row = $(this);
            var prixField = row.find("input[name*='[prix]']");
            var qteField = row.find("input[name*='[qte]']");
            var prix = prixField.length && prixField.val().trim() !== "" ? parseFloat(prixField.val()) || 0 : 0;
            var qte = qteField.length && qteField.val().trim() !== "" ? parseFloat(qteField.val()) || 0 : 0;
            totalBrute += prix * qte;
        });
        $("input[name='total_brute']").val(totalBrute.toFixed(2));
    }

    function updateTotalRemise() {
        var totalRemise = 0;
        $("tbody tr:visible").each(function(index) {
            var row = $(this);
            var prixField = row.find("input[name*='[prix]']");
            var qteField = row.find("input[name*='[qte]']");
            var remiseField = row.find("input[name*='[remise]']");
            var prix = prixField.length && prixField.val().trim() !== "" ? parseFloat(prixField.val()) || 0 : 0;
            var qte = qteField.length && qteField.val().trim() !== "" ? parseFloat(qteField.val()) || 0 : 0;
            var remise = remiseField.length && remiseField.val().trim() !== "" ? parseFloat(remiseField.val()) || 0 : 0;
            if (prix && qte && remise && !isNaN(prix) && !isNaN(qte) && !isNaN(remise)) {
                let prixSansRemise = prix * qte;
                let prixAvecRemise = prix * qte * (1 - remise / 100);
                let remiseForArticle = prixSansRemise - prixAvecRemise;
                totalRemise += remiseForArticle;
            }
        });
        $("input[name='total_remise']").val(totalRemise.toFixed(2));
    }


    // Function to calculate the HT price after applying the discount for each row
    function updateHTPriceAndTotal() {
        var totalHT = 0;

        $("tbody tr:visible").each(function(index) { // Only count visible rows
            var row = $(this);
            var prixField = row.find("input[name*='[prix]']");
            var qteField = row.find("input[name*='[qte]']");
            var remiseField = row.find("input[name*='[remise]']");
            var htField = row.find("input[name*='[ht]']");

            var prix = prixField.length && prixField.val().trim() !== "" ? parseFloat(prixField.val()) || 0 : 0;
            var qte = qteField.length && qteField.val().trim() !== "" ? parseFloat(qteField.val()) || 0 : 0;
            var remise = remiseField.length && remiseField.val().trim() !== "" ? parseFloat(remiseField.val()) || 0 : 0;


            var prixAvecRemise = prix * qte * (1 - remise / 100);
            // Update the HT field
            if (htField.length) {
                htField.val(prixAvecRemise.toFixed(2));
            }
        
            totalHT += prixAvecRemise;


        });

        // Update the Total HT field
        $("input[name='total_ht']").val(totalHT.toFixed(2));
    }

    $(document).ready(function() {
        updateTotals();
    });

    $(document).on("input", "input[name*='[prix]'], input[name*='[qte]'], input[name*='[remise]']", function() {
        updateTotals();
    });

    // Recalculate function
    function updateTotals() {
        updateTotalBrute();
        updateTotalRemise();
        updateHTPriceAndTotal();
    }



    // Function to add a new row to the table
    function ajouter(table, index) {
        var ind = Number($("#" + index).val()) + 1; // Get new index by incrementing
        var $ttr = $("#" + table).find(".tr").first().clone(true); // Clone the first row (hidden template)
        $ttr.attr("class", ""); // Remove any class from the cloned row

        var tabb = [];
        var i = 0;

        // Iterate over each element inside the row and update attributes
        $ttr.find("input, select, textarea, tr, td, div, ul, li").each(function() {
            var tab = $(this).attr("table");
            var champ = $(this).attr("champ");

            // Set new index and id for the cloned row
            $(this).attr("index", ind);
            $(this).attr("id", champ + ind);

            if (champ === "marchandisetype_id") {
                $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "][]");
                $(this).attr("data-bv-field", "data[" + tab + "][" + ind + "][" + champ + "]");
            } else {
                $(this).attr("name", "data[" + tab + "][" + ind + "][" + champ + "]");
                $(this).attr("data-bv-field", "data[" + tab + "][" + ind + "][" + champ + "]");
            }

            // Reset values for inputs
            $(this).val("");

            // Special handling for radio buttons
            if ($(this).attr("type") === "radio") {
                $(this).attr("name", "data[" + champ + "]");
                $(this).val(ind);
            }

            // Handle specific fields like date
            if (champ === "datedebut" || champ === "datefin") {
                $(this).attr("onblur", "nbrjour(" + ind + ")");
            }

            $(this).removeClass("anc");

            if ($(this).is("select", "multiple")) {
                tabb[i] = champ + ind;
                i++;
            }
        });

        // Handle icons and set their index
        $ttr.find("i").each(function() {
            $(this).attr("index", ind);
        });

        // Append the new row to the table
        $("#" + table).append($ttr);
        $("#" + index).val(ind);

        // Make the new row visible
        $("#" + table).find("tr:last").show();

        // Reinitialize select2 for new elements
        $("#charge_id" + ind).select2({
            width: "100%"
        });
        $("#article" + ind).select2({
            width: "100%"
        });
        $("#famille_id" + ind).select2("open");
        $("#client_id" + ind).select2({
            width: "100%"
        });
        $("#fr_id" + ind).select2({
            width: "100%"
        });
        $("#banque_id" + ind).select2({
            width: "100%"
        });
        $("#typeexon_id" + ind).select2({
            width: "100%"
        });
        $("#gouvernorat_id" + ind).select2({
            width: "75%"
        });
        $("#ligneplan_id" + ind).select2({
            width: "75%"
        });
        $("#nature_id" + ind).select2({
            width: "75%"
        });
        $("#taxe_id" + ind).select2({
            width: "75%"
        });
        $("#champ_id" + ind).select2({
            width: "75%"
        });

        // Mark the row as inserted
        $("#inserted" + ind).val(1);
        $("#auto" + ind).val(1);
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