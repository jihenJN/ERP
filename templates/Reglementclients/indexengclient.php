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
            <a href="<?php echo $this->Url->build(['action' => 'indexengclient']); ?>">
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

                            echo $this->Form->control('date', array('value' => $this->request->getQuery('date'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Date du'));
                            ?>

                        </div>
                        <div class="col-xs-6">
                            <?php

                            echo $this->Form->control('echance', array('value' => $this->request->getQuery('echance'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Echéance du'));
                            ?>

                        </div>
                        <div class="col-xs-6" style="color:#dc143c;">
                            <?php

                            echo $this->Form->control('echance2', array('value' => $this->request->getQuery('echance2'), 'style' => 'color:#dc143c;', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Echéance 2 du'));
                            ?>

                        </div>

                        <div class="col-xs-6">

                            <?php
                            echo $this->Form->control('client_id', array('id' => 'client_id', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Client', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $clients, 'value' => $this->request->getQuery('client_id')));
                            ?>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xs-6">

                            <?php
                            echo $this->Form->control('endosse', array('id' => 'endosse', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Endossé', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'value' => $this->request->getQuery('endosse')));
                            ?>
                        </div>

                        <div class="col-xs-6" hidden>

                            <?php
                            echo $this->Form->control('paiement_id', array('id' => 'paiement_id', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Mode Paiements', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $modes, 'value' => $this->request->getQuery('paiement_id')));
                            ?>
                        </div>
                        <div class="col-xs-6">

                            <?php
                            //echo $this->Form->input('compte_id', array('id' => 'compte_id', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Compte', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $comptes, 'value' => @$compteid));
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                            <button type="submit" class="btn btn-primary  alertHisto" id="">Afficher</button>

                            <?php
                            //debug($count);
                            if ($count != 0) {
                            ?>
                                <a onclick="openWindow(1000, 1000, wr+'reglementclients/imprimereng?datereg=<?php echo @$datereg; ?>&echance=<?php echo @$echance;  ?>&clientid=<?php echo @$clientid; ?>&modeid=<?php echo @$modeid;  ?>&endosse=<?php echo @$endosse;  ?>&echance2=<?php echo @$echance2;  ?>')"><button class="btn btn-primary ">Imprimer</button></a>
                            <?php }
                            ?>
                            <?php echo $this->Html->link(__('Actualiser'), ['action' => '/indexengclient'], ['class' => 'btn btn-primary']) ?>

                        </div>
                    </div>


                    <?php echo $this->Form->end(); ?>

                </div>

                <br>


                <h3 style="margin-left: 5px ;">
                    Engagement Client
                </h3>
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
                        <!-- <strong>
                            <input id="idcompte_display" type="hidden">

                        </strong> -->
                    </div>
                    <table id="example1" class="table table-bordered   table-striped">
                        <tr style="background-color: #8fbc8f ;">
                            <th width="8%" class="actions text-center "><?php echo ('Mode Paiement'); ?></th>
                            <th width="8%" class="actions text-center "><?php echo ('Code'); ?></th>

                            <th width="15%" class="actions text-center "><?php echo ('Client'); ?></th>
                            <th width="8%" class="actions text-center "><?php echo ('Endossé'); ?></th>

                            <th width="10%" class="actions text-center "><?php echo ('Numéro'); ?></th>
                            <th width="10%" class="actions text-center"><?php echo ('Date'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Echéance '); ?></th>

                            <th width="10%" class="actions text-center " style="color:#dc143c;"><?php echo ('Echéance2'); ?></th>

                            <!-- <th width="10%" class="actions text-center "><?php echo ('Compte'); ?></th> -->
                            <th width="10%" class="actions text-center "><?php echo ('Montant'); ?></th>

                            <th width="8%" class="actions text-center "><?php echo ('Situation'); ?></th>
                            <th width="5%" class="actions text-center "><?php echo (''); ?></th>
                            <th width="8%" class="actions text-center "><?php echo ('Rég'); ?></th>
                        </tr>
                        

                        <?php
                        $mnt = 0;
                        $i = -1;

                        $tt = 0;
                        foreach ($piecereglements  as $i => $dataItem) :
                            // debug($dataItem->reglementclient_id);
                            $mnt += $dataItem->montant;

                            $tt = $connection->execute('SELECT etat_id,reglementclient_id ,piecereglementclient_id from etatreglementclients  where etatreglementclients.piecereglementclient_id = ' . $dataItem->id  . ' and  etatreglementclients.reglementclient_id = ' . $dataItem->reglementclient->id  . ' ;')->fetchAll('assoc');
                            //  $tt = $connection->execute('SELECT * FROM etatpieceregelemnts WHERE piecereglementachat_id=' . $dataItem->id);
                            //debug($tt);
                            $etat_id = 1;
                            // foreach ($tt as $etatRecord) {
                            //     // debug($etatRecord);
                            //     $etat_id = $etatRecord['etat_id'];

                            //     $reglementclient_id = $etatRecord['reglementclient_id'];

                            //     $piecereglementclient_id = $etatRecord['piecereglementclient_id'];
                            // }
                            $compteQuery = $connection->execute(
                                '
                            SELECT c.numero
                            FROM etatreglementclients erc
                            INNER JOIN comptes c ON erc.compte_id = c.id
                            WHERE erc.piecereglementclient_id = ' . $dataItem->id . ' 
                            AND erc.reglementclient_id = ' . $dataItem->reglementclient->id
                            );
                            $compte = $compteQuery->fetch('assoc');
                            // debug($compte['numero']);
                            if ($compte) {
                                $numeroCompte = $compte['numero'];
                                // Le reste de votre code...
                            }

                        ?>
                            <tr>

                                <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $dataItem->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control ']); ?></td>
                                <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $dataItem->reglementclient->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control ']); ?></td>

                                <td align="center"><?= h($dataItem->paiement->name) ?></td>
                                <td align="center"><?= h($dataItem->reglementclient->client->Code) ?></td>

                                <td align="center"><?= h($dataItem->reglementclient->client->Raison_Sociale) ?></td>
                                <td align="center"><?= h($dataItem->endosse) ?></td>

                                <td align="center"><?= h($dataItem->num) ?></td>
                                <td align="center"> <?= $this->Time->format($dataItem->reglementclient->date, 'dd/MM/yyyy'); ?></td>
                                <td align="center"> <?= $this->Time->format($dataItem->echance, 'dd/MM/yyyy'); ?></td>
                                <td align="center" style="color:#dc143c;"> <?= $this->Time->format($dataItem->echance2, 'dd/MM/yyyy'); ?></td>

                                <td hidden align="center"><?php echo $numeroCompte; ?></td>
                                <td align="center"><?= h($dataItem->montant) ?></td>

                                <!-- <td align="center"><?= h($dataItem->etat->name) ?></td> -->

                                <td align="center">
                                    <?php
                                    // if (($etat_id == 1) || ($etat_id == 0)) {
                                    //     echo 'En Attente';
                                    // } elseif ($etat_id == 2) {
                                    //     echo 'Payé';
                                    // } else {
                                    //     echo 'Impayé';
                                    // } 
                                    if (($dataItem->etat_id == 1) || ($dataItem->etat_id == 0)) {
                                        echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #F55C43; color: white;">En Attente</button>';
                                    } elseif ($dataItem->etat_id == 13) {

                                        echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #5f9ea0 ; color: white;">Escompte</button>';
                                    } elseif ($dataItem->etat_id == 2) {

                                        echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #54A74D; color: white;">Payé</button>';
                                    } else {
                                        echo '<button class="btn btn-sm custom-button custom-button" style="background-color: #F99048; color: white;">Impayé</button>';
                                    }

                                    ?>


                                </td>
                                <td align="center">
                                    <?php //if ($dataItem->etat_id != 2) { 
                                    ?>
                                    <input type="checkbox" id="<?php echo $i; ?>" idp="<?php echo $dataItem->id; ?>" idreg="<?php echo $dataItem->reglementclient->id; ?>" montant="<?php echo $dataItem->montant; ?>" index="<?php echo $i; ?>" class="afficherbouttonsituation">

                                    <!-- <input type="checkbox" id="check" idp=<?php echo $dataItem->id; ?> idreg=<?php echo $dataItem->reglementclient->id; ?> value="<?php echo $dataItem->montant; ?>" index="<?php echo $i; ?>" class="afficherbouttonsituation"> -->
                                    <?php //} 
                                    ?>
                                </td>
                                <td align="center">
                                <?php echo $this->Html->link( "<button class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></button>",
                                      ['controller' => 'Reglementclients', 'action' => 'edit', $dataItem->reglementclient->type, $dataItem->reglementclient->id], ['escape' => false, 'target' => '_blank'] );?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td align="center" colspan="8"> <strong><?php echo 'Total   ';  //debug($qte_ent); 
                                                                    ?></strong></td>
                            <!--                            
                            <td align="center" colspan="1" ><?php //echo sprintf("%.3f", $qte_sor); 
                                                            ?></td> -->
                            <td align="center" colspan="1" style="background-color: #8fbc8f ;"><strong><?php echo sprintf("%.3f", $mnt); //debug($qte_ent); 
                                                                                                        ?></strong></td>
                            <td align="center" colspan="2"><?php //echo sprintf("%.3f", $qte_sor); 
                                                            ?></td>
                        </tr>
                    </table>
                    <div class="modal modal-white fade" id="modal-white" style="width: 100%;">
                        <?php //echo $this->Form->create($null, ['url' => ['controller' => 'Etatreglementclients', 'action' => 'add']]); 
                        ?>
                        <?php echo $this->Form->create(null, ['url' => ['action' => 'indexengclient']]);
                        ?>

                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" align="center"><strong>Changer la Situation</strong></h4>

                                    <div class="col-xs-12">
                                        <?php
                                        date_default_timezone_set('Africa/Tunis');
                                        $now = date('Y-m-d');
                                        echo $this->Form->control('date', ['value' => $now, 'max' => $now, 'table' => 'etatreglementclients', 'id' => 'date', 'name' => 'date', 'type' => 'date', 'class' => 'form-control']);
                                        ?>
                                    </div>
                                    <div class="col-xs-12">
                                        <?php
                                        echo $this->Form->control('etat_id', ['options' => $etats, 'table' => 'etatreglementclients',  'id' => 'etat_id', 'name' => 'etat_id', 'empty' => 'Veuillez choisir Etat!!', 'required' => 'required', 'class' => 'form-control select2']);

                                        ?>

                                        <input id="id_display_modal" type="hidden" table="etatreglementclients" champ="piecereglementclient_id" name="piecereglementclient_id" class="form-control">

                                        <input id="idreg_display_modal" type="hidden" table="etatreglementclients" champ="reglementclient_id" name="reglementclient_id" class="form-control">
                                        <label> Montant</label>
                                        <input id="mm_display_modal" type="text" table="etatreglementclients" champ="montant" name="montant" class="form-control">

                                        <!-- <input id="idcompte_display_modal" type="text" table="etatreglementclients" champ="compte_id" name="compte_id" class="form-control"> -->


                                    </div>

                                    <div class="col-xs-12" id="divco" style="display: none;">
                                        <?php
                                        echo $this->Form->control('compte_id', ['options' => $comptes, 'table' => 'etatreglementclients',  'id' => 'compte_id', 'name' => 'compte_id', 'class' => 'form-control select2']);

                                        ?>
                                        <!-- <input id="idcompte_display_modal" type="text" table="etatreglementclients" champ="compte_id" name="compte_id" class="form-control"> -->
                                    </div>
                                    <div class="col-xs-12" id="divbl" class="form-control">
                                    </div>


                                    <!-- <p     id="id_display" style="display: inline-block;"></p> -->



                                    <!-- <p><strong>ID Réglement:</strong> <span id="idreg_display_modal"></span></p>
                                        <p><strong>ID:</strong> <span id="id_display_modal"></span></p> -->







                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                        <?php echo $this->Form->button('Ok', ['class' => 'btn btn-primary']); ?>
                                        <!-- <button type="submit" class="pull-right btn btn-primary" id="" >Ok</button> -->


                                        <?php echo $this->Form->end(); ?>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
</section>
<!-- Reste du code HTML -->

<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<!-- Reste des inclusions CSS et JS -->

<?php $this->end(); ?>


<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    $(document).ready(function() {
        $('#etat_id').change(function() {
            var selectedValue = $(this).val();
            $('#divco').hide(); // Hide the compte field

            // alert(selectedValue);
            if (selectedValue == '2') {
                $('#divco').show(); // Show the compte field
            } else {
                $('#divco').hide(); // Hide the compte field
            }
        });

        // Trigger change event on page load to set the initial state
        $('#etat_id').trigger('change');
    });
</script>
<script>
    $(function() {
        $('#example2').DataTable()
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
    $('.select2').select2()
</script>

<script>
    // $(function() {



    //     $('.alertHisto').on('mouseover', function() {

    //         d1 = $('#date1').val();
    //         d2 = $('#date2').val();
    //         depot = $('#depot_id').val();
    //         article = $('#article_id').val();
    //         ///  client = $('#client_id').val();


    //         if (d1 == '') {
    //             alert("Veuillez choisir le date de début SVP !!")
    //         } else if (d2 == '') {
    //             alert("Veuillez choisir le date du fin SVP !!")
    //         } else if (depot == '') {
    //             alert("Veuillez choisir un dépot SVP  !!")
    //         } else if (article == '') {
    //             alert("Veuillez choisir un article SVP  !!")
    //         }
    //         //else if (client == '') {
    //         //     alert("Veuillez choisir un client SVP  !!")
    //         // }

    //     });
    // })
</script>
<script>
    $("#my_button").on("click", function() {
        //  alert('nckhv')
        id = $("#id_display").val();
        idd = $("#idreg_display").val();
        //  idc = $("#idcompte_display").val();
        // alert(id)
        // alert(idd)
        //  var montant = $(".afficherbouttonsituation:checked").attr("montant");
        //alert(montant);
        montant = $("#montant_display").val();
        // alert(montant);

        ///  $("#idcompte_display_modal").val(idc);
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
            // var idcompte = $(".afficherbouttonsituation:checked").attr("idcompte");
            //alert(idcompte)
            $("#montant_display").val(montant);
            // alert(iidreg)
            //  alert(idp)
            $("#idreg_display").val(iidreg);
            $("#id_display").val(idp);
            //  $("#idcompte_display").val(idcompte);
            // Show the button
            $("#my_button").show();
        }


        function hideMontantAndButton() {
            // Hide montant value
            $("#montant_display").text("");
            $("#id_display").text("");
            //   $("#idcompte_display").text("");
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
    // $(".etat").on("change", function() {
    //     var compte_id = $("#idcompte_display_modal").val();
    //     var etat_id = $("#etat_id").val();
    //     // alert(etat_id)
    //     $.ajax({
    //         method: "GET",
    //         url: "<?= $this->Url->build(['controller' => 'Reglementachats', 'action' => 'getc']) ?>",
    //         dataType: "json",
    //         data: {
    //             compte_id: compte_id,
    //             etat_id: etat_id,
    //         },
    //         headers: {
    //             'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
    //         },
    //         success: function(data) {
    //             $('#divbl').html(data.select);
    //             $('#compte_id').html(data.select);
    //             $('#compte_id').select(); // Met à jour le contenu du champ de sélection
    //         }
    //     });
    // });
</script>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
</script>
<?php $this->end(); ?>