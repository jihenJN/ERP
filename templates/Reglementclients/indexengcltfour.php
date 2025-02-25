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
            <a href="<?php echo $this->Url->build(['action' => 'indexengcltfour']); ?>">
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

                            echo $this->Form->control('date', array('value' => $this->request->getQuery('date'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Date'));
                            ?>

                        </div>
                        <div class="col-xs-6">
                            <?php

                            echo $this->Form->control('echance', array('value' => $this->request->getQuery('echance'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datePickerOnly ', 'type' => 'date', 'label' => 'Echéance du'));
                            ?>

                        </div>


                        <div class="col-xs-6">

                            <?php
                            echo $this->Form->control('client_id', array('id' => 'client_id', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Client', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $clients, 'value' => $this->request->getQuery('client_id')));
                            ?>

                        </div>
                        <div class="col-xs-6">

                            <?php
                            echo $this->Form->control('fournisseur_id', array('id' => 'fournisseur_id', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Fournisseur', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2', 'options' => $fournisseurs, 'value' => $this->request->getQuery('fournisseur_id')));
                            ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
                            <button type="submit" style="background-color:#0095b6;border:#0095b6;" class="btn btn-primary  alertHisto" id="">Afficher</button>

                            <?php
                            //debug($count);
                            if ($count != 0) {
                            ?>
                                <a onclick="openWindow(1000, 1000, wr+'reglementclients/impengcltfour?datereg=<?php echo @$datereg; ?>&echance=<?php echo @$echance;  ?>&clientid=<?php echo @$clientid; ?>&fournisseurid=<?php echo @$fournisseurid;  ?>&echance=<?php echo @$echance;  ?>')"><button class="btn btn-primary " style="background-color:#0095b6;border:#0095b6;">Imprimer</button></a>
                            <?php }
                            ?>
                            <?php echo $this->Html->link(__('Actualiser'), ['action' => '/indexengcltfour'], ['style' => 'background-color:#0095b6;border:#0095b6;', 'class' => 'btn btn-primary']) ?>

                        </div>
                    </div>


                    <?php echo $this->Form->end(); ?>

                </div>

                <br>


                <h3 style="margin-left: 5px ;">
                    Etat Débit Crédit
                </h3>
                <div class="box-body">

                    <table id="example1" class="table table-bordered   table-striped">
                        <tr style="background-color: #0095b6 ;">
                            <!-- <th width="10%" class="actions text-center "><?php echo ('Mode Paiement'); ?></th> -->
                            <th width="10%" class="actions text-center"><?php echo ('Date'); ?></th>

                            <th width="10%" class="actions text-center "><?php echo ('Code'); ?></th>

                            <th width="10%" class="actions text-center "><?php echo ('Fournisseur'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Client'); ?></th>

                            <!-- <th width="10%" class="actions text-center "><?php echo ('Numéro'); ?></th> -->
                            <th width="10%" class="actions text-center "><?php echo ('Echéance '); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Débit'); ?></th>
                            <th width="10%" class="actions text-center "><?php echo ('Crédit'); ?></th>
                            <!-- <th width="10%" class="actions text-center "><?php echo ('Total'); ?></th> -->


                        </tr>
                        </tr>

                        <?php
                        $tt = 0;
                        $i = 0;

                        $tt = 0;
                        $solde = 0;
                        $ttdebit = 0;
                        $ttcredit = 0;
                        foreach ($data  as $i => $dataItem) :
                            // debug($dataItem['sortie']);die;
                            $solde = $dataItem['debit'] - $dataItem['credit'];
                            $ttdebit += $dataItem['debit'];
                            $ttcredit += $dataItem['credit'];
                            $tt += $solde;

                        ?>

                            <tr>
                                <td align="center"> <?= $this->Time->format($dataItem['date'], 'dd/MM/yyyy'); ?></td>

                                <td align="center"><?= h($dataItem['code']) ?></td>


                                <td align="center"><?= h($dataItem['fournisseur']) ?></td>

                                <td align="center"><?= h($dataItem['client']) ?></td>


                                <!-- <td align="center"><?= h($dataItem['num']) ?></td> -->
                                <td align="center"> <?= $this->Time->format($dataItem['echance'], 'dd/MM/yyyy'); ?></td>

                                <td align="center"><?php if (h($dataItem['debit']) == 0) {
                                                        echo  '';
                                                    } else {
                                                        echo sprintf("%.3f", $dataItem['debit']);
                                                    } ?>
                                </td>
                                <td align="center"><?php if (h($dataItem['credit']) == 0) {
                                                        echo  '';
                                                    } else {
                                                        echo sprintf("%.3f", $dataItem['credit']);
                                                    } ?>
                                    <!-- <td align="center"><?= h(abs($solde)) ?></td> -->






                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td align="center" colspan="5"><strong></strong></td>
                            <td align="center" style="background-color: #0095b6;"><strong><?= sprintf("%.3f", $ttdebit); ?></strong></td>
                            <td align="center" style="background-color: #0095b6;"><strong><?= sprintf("%.3f", $ttcredit); ?></strong></td>

                        </tr>
                        <tr>
                            <td align="center" colspan="5"><strong>Total</strong></td>
                            <td align="center" style="background-color: #0095b6;" colspan="2"><strong><?= sprintf("%.3f", abs($tt)); ?></strong></td>

                        </tr>
                    </table>

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