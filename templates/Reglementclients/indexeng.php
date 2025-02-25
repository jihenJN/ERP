<?php

error_reporting(E_ERROR | E_PARSE);
echo $this->Html->css('select2');
?>
<?php

use Cake\Datasource\ConnectionManager;
use Cake\I18n\Number;


$connection = ConnectionManager::get('default'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<section class="content-header">
    <h1>Recherche </h1>
    <br>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo $this->Url->build(['action' => 'index']); ?>">
                <i class="fa fa-reply"></i> <?php echo __('Retour'); ?>
            </a>
        </li>
    </ol>
</section>
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <?php echo $this->Form->create($null, ['type' => 'get']);
                    ?>

                    <div class="row">
                        <div class="col-xs-6">
                            <?php

                            echo $this->Form->input('date', array('value' => @$datereg, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Encaissement du'));
                            ?>

                        </div>
                        <div class="col-xs-6">
                            <?php

                            echo $this->Form->input('echance', array('value' => @$echance, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Echéance du'));
                            ?>

                        </div>


                    </div>

                    <div class="row">
                        <div class="col-xs-6">

                            <?php
                            echo $this->Form->input('fournisseur_id', array('id' => 'fournisseur_id', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Fournisseur', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $fournisseurs, 'value' => $fournisseurid));
                            ?>

                        </div>

                        <div class="col-xs-6">

                            <?php
                            echo $this->Form->input('compte_id', array('id' => 'compte_id', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Compte', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $comptes, 'value' => @$compteid));
                            ?>
                        </div>
                        <div class="col-xs-6">

                            <?php
                            echo $this->Form->input('modepaiement_id', array('id' => 'modepaiement_id', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Mode Paiements', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $modes, 'value' => @$modeid));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                            <button type="submit" class="btn btn-primary  alertHisto" id="">Afficher</button>

                            <?php
                            //debug($count);
                            // if ($count != 0) { 
                            ?>
                            <!-- <a onclick="openWindow(1000, 1000, 'https://facturation.isofterp.com/mtd/Articles/imprimerm?article_id=<?php echo @$articleid; ?> depot_id=<?php echo @$depotid;  ?>date1=<?php echo @$date1; ?>date2=<?php echo @$date2;  ?>')"><button class="btn btn-primary ">Imprimer</button></a> -->
                            <?php ///} 
                            ?>
                            <?php echo $this->Html->link(__('Actualiser'), ['action' => '/indexeng'], ['class' => 'btn btn-primary']) ?>

                        </div>
                    </div>


                    <?php echo $this->Form->end(); ?>

                </div>

                <br>


                <h3 style="margin-left: 5px ;">
                    Engagement fournisseur
                </h3><br>
                <div class="box-body">
                    <div style="text-align: center;">
                        <button id="my_button" style="display: none; color: white; background-color: black;" type="button" data-toggle="modal" class="btn btn btn-black changersituation" data-target="#modal-white">
                            <i class="fa fa-plus-circle"></i> Changer Situation
                        </button>
                        <strong>
                            <!-- <p id="montant_display" style="display: inline-block;"></p> -->
                            <input id="montant_display" type="hidden">


                        </strong>
                        <strong>
                            <!-- <p     id="id_display" style="display: inline-block;"></p> -->
                            <input id="id_display" type="hidden">
                        </strong>
                        <strong>
                            <input id="idreg_display" type="hidden">

                        </strong>
                        <strong>
                            <input id="idcompte_display" type="hidden">

                        </strong>

                    </div>
                    <table id="example1" class="table table-bordered">
                        <tr>
                            <th width="10%" class="actions text-center "><?php echo ('Mode Paiement'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Fournisseur'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Numéro'); ?></th>
                            <th width="10%" class="actions text-center"><?php echo ('Encaissement'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Echéance'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Compte'); ?></th>

                            <th width="10%" class="actions text-center "><?php echo ('Montant'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Situation'); ?></th>
                            <th width="5%" class="actions text-center "><?php echo (''); ?></th>
                        </tr>

                        <?php
                        $mnt = 0;
                        $i = 0;

                        $tt = 0;
                        foreach ($piecereglements  as $i => $dataItem) :

                            $mnt += $dataItem->montant;

                            // $tt = $connection->execute('SELECT etat_id,reglementachat_id ,piecereglementachat_id from etatpieceregelemnts  where etatpieceregelemnts.piecereglementachat_id = ' . $dataItem->id  . ' and  etatpieceregelemnts.reglementachat_id = ' . $dataItem->reglementachat->id  . ' ;')->fetchAll('assoc');
                        

                            // $etat_id = 1;
                            // foreach ($tt as $etatRecord) {
                            //     // debug($etatRecord);
                            //     $etat_id = $etatRecord['etat_id'];

                            //     $reglementachat_id = $etatRecord['reglementachat_id'];

                            //     $piecereglementachat_id = $etatRecord['piecereglementachat_id'];
                          //  }


                        ?>

                            <tr>
                                <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $dataItem->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control ']); ?></td>
                                <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $dataItem->reglementachat->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control ']); ?></td>

                                <td align="center"><?= h($dataItem->modepaiement->name) ?></td>
                                <td align="center"><?= h($dataItem->reglementachat->fournisseur->name) ?></td>
                                <td align="center"><?= h($dataItem->numero) ?></td>
                                <td align="center"><?= h($dataItem->reglementachat->date) ?></td>
                                <td align="center"><?= h($dataItem->echance) ?></td>
                                <td align="center"><?= h($dataItem->compte->numero) ?></td>
                                <td align="center"><?= h($dataItem->montant) ?></td>
                             
                                <td align="center"><?= h($dataItem->etat->name) ?></td>
                                <!-- <td align="center">
                                    <?php if (($etat_id == 1) || ($etat_id == null)) {
                                        echo 'En Attente';
                                    } elseif ($etat_id == 2) {
                                        echo 'Payé';
                                    } else {
                                        echo 'Impayé';
                                    } ?>
                                </td> -->
                                <td align="center">
                                    <?php if ($dataItem->etat_id != 2) { ?>
                                        <input type="checkbox" id="<?php echo $i; ?>"  idp="<?php echo $dataItem->id; ?>" idreg="<?php echo $dataItem->reglementachat->id; ?>" idcompte="<?php echo $dataItem->compte_id; ?>" montant="<?php echo $dataItem->montant; ?>" index="<?php echo $i; ?>" class="afficherbouttonsituation">
                                    <?php } ?>
                                </td>

                            </tr>
                        <?php
                        endforeach; ?>
                        <tr>
                            <td align="center" colspan="6"> <strong><?php echo 'Total   ';
                                                                    ?></strong></td>
                            <td align="center" colspan="1"><strong><?php echo sprintf("%.3f", $mnt);
                                                                    ?></strong></td>
                            <td align="center" colspan="1"><?php
                                                            ?></td>
                                                                 <td align="center" colspan="1"><?php
                                                            ?></td>

                        </tr>
                    </table>


                    <div class="modal modal-white fade" id="modal-white" style="width: 100%;">
                        <?php //echo $this->Form->create($etatpieceregelemnt, ['url' => ['controller' => 'Etatpieceregelemnts', 'action' => 'add']]); 
                        ?>
                        <?php echo $this->Form->create(null, ['url' => ['action' => 'indexeng']]);
                        ?>

                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" align="center"><strong>Changer la Situation</strong></h4>

                                    <div class="col-xs-12">
                                        <?php
                                        date_default_timezone_set('Africa/Tunis');
                                        $now = date('Y-m-d');
                                        echo $this->Form->control('date', ['value' => $now, 'max' => $now, 'table' => 'etatpieceregelemnts', 'id' => 'date', 'name' => 'date', 'type' => 'date', 'class' => 'form-control']);
                                        ?>
                                    </div>
                                    <div class="col-xs-12">
                                        <?php
                                        echo $this->Form->control('etat_id', ['options' => $etats, 'table' => 'etatpieceregelemnts',  'id' => 'etat_id', 'name' => 'etat_id', 'empty' => 'Veuillez choisir Etat!!', 'required' => 'required', 'class' => 'form-control etat  select2']);

                                        ?>

                                        <input id="id_display_modal" type="hidden" table="etatpieceregelemnts" champ="piecereglementachat_id" name="piecereglementachat_id" class="form-control">

                                        <input id="idreg_display_modal" type="hidden" table="etatpieceregelemnts" champ="reglementachat_id" name="reglementachat_id" class="form-control">
                                        <label> Montant</label>
                                        <input id="mm_display_modal" type="text" table="etatpieceregelemnts" champ="montant" name="montant" class="form-control">

                                        <input id="idcompte_display_modal" type="hidden" table="etatpieceregelemnts" champ="compte_id" name="compte_id" class="form-control">


                                    </div>
                                    <div class="col-xs-12" id="divbl" class="form-control">
                                    </div>
                                    <!-- <div class="col-xs-12">

                                        <?php
                                       //  echo $this->Form->input('compte_id', array('id' => 'compte_id','table'=>'etatpieceregelemnts', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Compte', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'options' => $comptes));
                                        ?>
                                    </div> -->


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                        <?php echo $this->Form->button('Ok', ['class' => ' compte btn btn-primary']); ?>


                                        <?php echo $this->Form->end(); ?>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
</section>


<!-- Reste du code HTML -->

<?php $this->start('scriptBottom'); ?>


<script>
    $("#my_button").on("click", function() {
        //  alert('nckhv')
        id = $("#id_display").val();
        idd = $("#idreg_display").val();
        idc = $("#idcompte_display").val();
        // alert(id)
        // alert(idd)
        //  var montant = $(".afficherbouttonsituation:checked").attr("montant");
        //alert(montant);
        montant = $("#montant_display").val();
        // alert(montant);

        $("#idcompte_display_modal").val(idc);
        $("#mm_display_modal").val(montant);
        $("#id_display_modal").val(id);
        $("#idreg_display_modal").val(idd);

    });
    $(document).ready(function() {
        $("#check_all").on("change", function() {
            if ($(this).is(":checked")) {
                $(".afficherbouttonsituation").prop("checked", true);
                showMontantAndButton();
            } else {
                $(".afficherbouttonsituation").prop("checked", false);
                hideMontantAndButton();
            }
        });

        $(".afficherbouttonsituation").on("change", function() {
            if ($(".afficherbouttonsituation:checked").length > 0) {
                showMontantAndButton();
            } else {
                hideMontantAndButton();
            }
        });





        // var isChecked = false; // Variable pour suivre l'état de la case à cocher

        // $("#check").on("change", function() {
        //     var index = $(".afficherbouttonsituation:checked").attr("id");
        //    var dd=  $("#id").val(index);
        //  alert(dd);
        //     if ($(this).is(":checked")) {
        //         if (!isChecked+ index) {
        //             // La case à cocher "check" est cochée pour la première fois
        //             // Faites quelque chose ici
        //             isChecked = true; // Mettre à jour l'état de la case à cocher
        //         } else {
        //             // La case à cocher "check" est déjà cochée, affichez une alerte
        //             alert("La case est déjà cochée !");
        //             $(this).prop("checked", false); // Décocher la case à cocher
        //         }
        //     } else {
        //         // La case à cocher "check" est décochée
        //         // Faites quelque chose ici si nécessaire
        //     }
        // });

        function showMontantAndButton() {

            // Show montant value
            var montant = $(".afficherbouttonsituation:checked").attr("montant");
            //  alert(montant)
            var iidreg = $(".afficherbouttonsituation:checked").attr("idreg");
            var idp = $(".afficherbouttonsituation:checked").attr("idp");
            var idcompte = $(".afficherbouttonsituation:checked").attr("idcompte");
            //alert(idcompte)
            $("#montant_display").val(montant);
            // alert(iidreg)
            //  alert(idp)
            $("#idreg_display").val(iidreg);
            $("#id_display").val(idp);
            $("#idcompte_display").val(idcompte);
            // Show the button
            $("#my_button").show();
        }


        function hideMontantAndButton() {
            // Hide montant value
            $("#montant_display").text("");
            $("#id_display").text("");
            $("#idcompte_display").text("");
            // Hide the button
            $("#my_button").hide();
        }


        //////////

        var isChecked = {}; // Un objet pour suivre l'état des cases à cocher

        $(".afficherbouttonsituation").on("change", function() {
            var index = $(this).attr("id");
            // alert(index)
            if ($(this).is(":checked")) {
                if (!isChecked[index]) {
                    // La case à cocher est cochée pour la première fois
                    // Faites quelque chose ici
                    isChecked[index] = true; // Mettre à jour l'état de la case à cocher
                } else {
                    // La case à cocher est déjà cochée, affichez une alerte
                    alert("La case " + index + " est déjà cochée !");
                    $(this).prop("checked", false); // Décocher la case à cocher
                }
            } else {
                // La case à cocher est décochée
                // Faites quelque chose ici si nécessaire
            }
        });

    });







    //     $(document).ready(function() {
    //     $(".afficherbouttonsituation").change(function() {
    //         var isChecked = $(this).prop("checked");
    //         var idcompte = $(this).attr("idcompte");
    //         var montant = $(this).val();

    //         if (isChecked) {
    //             // Si la case à cocher est cochée
    //             if (idcompte === "") {
    //                 // Si idcompte est vide, définir la valeur du montant
    //                 $("#idcompte_display_modal").val("");
    //                 $("#mm_display_modal").val(montant);
    //             } else {
    //                 // Sinon, mettre à jour idcompte
    //                 $("#idcompte_display_modal").val(idcompte);
    //                 $("#mm_display_modal").val("");
    //             }
    //         } else {
    //             // Si la case à cocher est décochée, réinitialiser les valeurs
    //             $("#idcompte_display_modal").val("");
    //             $("#mm_display_modal").val("");
    //         }

    //         // Afficher les autres informations dans la boîte modale
    //         var id = $("#id_display").val();
    //         var idd = $("#idreg_display").val();
    //         $("#id_display_modal").val(id);
    //         $("#idreg_display_modal").val(idd);
    //     });
    // });
</script>
<script>
    $(".etat").on("change", function() {
        var compte_id = $("#idcompte_display_modal").val();
        var etat_id = $("#etat_id").val();
        // alert(etat_id)
        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Reglementachats', 'action' => 'getc']) ?>",
            dataType: "json",
            data: {
                compte_id: compte_id,
                etat_id: etat_id,
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
            },
            success: function(data) {
                $('#divbl').html(data.select);
                $('#compte_id').html(data.select);
                $('#compte_id').select(); // Met à jour le contenu du champ de sélection
            }
        });
    });
</script>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php $this->end(); ?>