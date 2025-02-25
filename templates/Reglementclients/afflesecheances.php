<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma');

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default'); ?>

<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Liste des clients</h1>
    </header>
</section>
<br> <br>
<!-- <section class="content-header">
    <h1>
        Recherche
    </h1>
</section> -->
<?php echo $this->Form->create(null, ['type' => 'get']); ?>

<?php echo $this->Form->end(); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <!-- <h3 class="box-title">Etat De Caisse<span id="nameofcaisse"></span></h3> -->
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr style='background-color:#b0c24a;'>
                                <th hidden style="text-align: center;">id</th>
                                <th style="text-align: center;width:15%">Code client</th>
                                <th style="text-align: center;width:30%">Nom client</th>
                                <th style="text-align: center;width:10%">Date echeance</th>
                                <th style="text-align: center;width:10%">Banque</th>
                                <th style="text-align: center;width:20%">Numéro compte</th>
                                <th style="text-align: center;width:15%">Montant</th>
                                <th style="text-align: center;width:15%"></th>



                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($echeances as $i => $ech):
                                $regl = $connection->execute("SELECT client_id from reglementclients where id =" . $ech['reglementclient_id'] . " ;")->fetchAll('assoc');

                                $client = $connection->execute("SELECT Raison_Sociale,Code from clients where id =" . $regl[0]['client_id'] . " ;")->fetchAll('assoc');
                                if ($ech['banque_id']) {
                                    $banque = $connection->execute("SELECT name from banques where id =" . $ech['banque_id'] . " ;")->fetchAll('assoc');
                                }
                                // if ($ech['compte_id']) {
                                //     $compte = $connection->execute("SELECT numero from comptes where id =" . $ech['compte_id'] . " ;")->fetchAll('assoc');
                                // }

                            ?>
                                <tr>
                                    <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $ech['id'], 'label' => '', 'champ' => 'id', 'type' => 'text', 'class' => 'form-control']); ?>
                                    </td>
                                    <td align="center"> <?php echo ($client[0]['Code']) ?> </td>
                                    <td align="start">
                                        <span> <?php echo ($client[0]['Raison_Sociale']) ?></span>
                                    </td>
                                    <td align="center">
                                        <?php
                                        echo ($ech['echance']);

                                        ?>
                                    </td>
                                    <td>
                                        <?php echo ($banque[0]['name']) ?>
                                    </td>

                                    <td>
                                        <?php echo ($ech['compte']) ?>
                                    </td>

                                    <td align="center">
                                        <?php
                                        echo ($ech['montant']);

                                        ?>
                                    </td>
                                    <td width="10%" align="center">
                                        <div>
                                            <input type="checkbox" id="checkbox<?php echo $i; ?>" value="<?php echo $ech['id'] ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="facc6 facture6" />


                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>









                        </tbody>
                    </table>
                    <input type="hidden" value="<?php echo $i; ?>" id="index" />
                    <table>
                        <tr>
                            <td>
                                <div class="col-md-6  testcheck" style="display: none;margin-left:10px;">
                                    <input type="hidden" name="tes6" value="0" class="test6" />
                                    <input type="hidden" name="tes6" value="0" class="test6" />
                                    <input type="hidden" name="nombre" value="<?php echo @$i; ?>" class="nombre" />
                                    <a class="btn btn btn-primary btnfac6" style="border:#B0C24A;background-color:#B0C24A; margin-right:48%;margin-top: 20px;margin-bottom:20px;"> <i class="fa fa-plus-circle"></i> Créer Bordereau </a>
                                </div>
                                <input type="hidden" name="tab" value="" id="tabValues">
                            </td>
                        </tr>
                    </table>
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
<style>
    .btn-purple {
        background-color: purple;
        color: white;
    }

    .center-text {
        text-align: center;
    }

    /* .gray-background {
        background-color: #b0c24a;
    } */

    table {
        width: 200%;
        /* Make the table take up the full width */
        table-layout: fixed;
        /* Fix the table layout */
    }

    th,
    td {
        width: 110px;
        /* Set a fixed width for the cells */
        text-align: center;
    }

    .total-row th {
        width: 100%;
        /* Set full width for the total row header cell */
    }

    .total-row td {
        width: 100%;
        /* Set full width for the total row data cell */
    }
</style>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }
    $(function() {
        $('#example1').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
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
</script>

<script>
    // $(document).ready(function() {
    //     const selectAllButton = $("#select-all");
    //     const checkboxes = $(".facc6");

    //     selectAllButton.on("click", function() {
    //         checkboxes.prop("checked", !checkboxes.prop("checked"));
    //         updateButtonText();
    //         updateMyButtonVisibility();
    //         updateTabValues(); // Mise à jour des valeurs des cases cochées
    //     });

    //     checkboxes.on("change", function() {
    //         updateButtonText();
    //         updateMyButtonVisibility(this);
    //         updateTabValues(); // Mise à jour des valeurs des cases cochées
    //     });

    //     function updateButtonText() {
    //         selectAllButton.text(checkboxes.filter(":checked").length === checkboxes.length ?
    //             "Désélectionner Tout" :
    //             "Sélectionner Tout"
    //         );
    //     }

    //     function updateMyButtonVisibility(checkbox) {
    //         if (checkboxes.filter(":checked").length > 0) {
    //             $(".testcheck").show();
    //         } else {
    //             $(".testcheck").hide();
    //         }
    //     }


    //     function updateTabValues() {
    //         var tabValues = [];
    //         checkboxes.each(function() {
    //             if ($(this).is(':checked')) {
    //                 // Check if the corresponding factureclient_id is 0
    //                 var index = $(this).attr('ligne');
    //                 // if ($("#factureclient_id" + index).val() == 0) {
    //                     tabValues.push($(this).val());
    //                 // }
    //             }
    //         });
    //         var divid = tabValues.join(',');
    //         $("#tabValues").val(tabValues.join(',')); // Met à jour la valeur de l'input hidden avec les IDs des bons de livraison sélectionnés séparés par des virgules
    //     }
    // });


   

    $(document).ready(function() {
    const checkboxes = $(".facc6");

    checkboxes.prop("checked", true);
    updateTabValues(); 

    checkboxes.on("change", function() {
        updateMyButtonVisibility();
        updateTabValues(); 
    });

    function updateMyButtonVisibility() {
        if (checkboxes.filter(":checked").length > 0) {
            $(".testcheck").show();
        } else {
            $(".testcheck").hide();
        }
    }

    function updateTabValues() {
        const selectedValues = checkboxes.filter(":checked").map(function() {
            return $(this).val();
        }).get();
        $("#tabValues").val(selectedValues.join(',')); 
    }

    $('.btnfac6').on('click', function() {
        const tabValues = $('#tabValues').val(); 

        $.ajax({
            method: "GET",
            url: "<?= $this->Url->build(['controller' => 'Reglementclients', 'action' => 'getids']) ?>",
            dataType: "json",
            data: {
                tabValues: tabValues
            },
            success: function(data) {
                alert('Bordereau Versement Chéques Ajoutées avec succès');
                window.location.href = wr+'bordereauversementcheques/index/2';
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('.facture6').on('click', function() {
        updateMyButtonVisibility(); 
    });

    updateMyButtonVisibility();
});

</script>

<?php $this->end(); ?>