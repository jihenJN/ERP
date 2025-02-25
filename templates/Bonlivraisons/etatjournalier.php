<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>

<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Etat Journalier</h1>
    </header>
</section>
<br> <br>
<section class="content-header">
    <h1>
        Recherche
    </h1>
</section>
<?php echo $this->Form->create(null, ['type' => 'get']); ?>
<section class="content" style="width: 99%">
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            <div class="row">
                <div class="row">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('historiquede', [
                                'required' => 'off',
                                'label' => 'Date début',
                                'value' => $this->request->getQuery('historiquede'),
                                'id' => 'historiquede',
                                'div' => 'form-group',
                                'class' => 'form-control',
                                'type' => 'date',
                            ]);
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <?php
                            echo $this->Form->control('au', [
                                'required' => 'off',
                                'label' => 'Date fin',
                                'value' => $this->request->getQuery('au'),
                                'id' => 'au',
                                'div' => 'form-group',
                                'class' => 'form-control',
                                'type' => 'date',
                            ]);
                            ?>
                        </div>
                        <div class="col-xs-4" hidden>


                            <label class="control-label" for="name">Mode de paiement
                            </label>
                            <select class="form-control select2" id="paiement_id" name="paiement_id">
                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                <?php foreach ($paiements as $id => $paiement) {
                                ?>

                                    <option <?php if ($this->request->getQuery('paiement_id') == $paiement->id)
                                                echo 'selected="selected"' ?> value="<?php echo $paiement->id; ?>">
                                        <?php
                                        echo $paiement->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div style="text-align:center">
                <button type="submit" style="background-color:#e66771;border:#e66771;"
                    class="btn btn-primary btn-sm getcaisseName1">Afficher</button>
                <?php echo $this->Html->link('<i class="fa fa-refresh"></i> Actualiser', ['action' => 'etatjournalier'], ['class' => 'btn btn-primary btn-sm', 'style' => 'background-color:#e66771;border:#e66771;', 'escape' => false]) ?>
                <a
                    onclick="openWindow(1000, 1000, wr+ 'bonlivraisons/impetatjournalier?&historiquede=<?php echo @$this->request->getQuery('historiquede'); ?>&au=<?php echo @$this->request->getQuery('au'); ?>&paiement_id=<?php echo @$this->request->getQuery('paiement_id'); ?>')"><button
                        style="background-color:#e66771;border:#e66771; height:43%; color:white; padding:9px 19px;"
                        class="btn btn-primary fa fa-print getcaisseName1">Imprimer</button></a>
            </div>
        </div>
    </div>
</section>
<?php echo $this->Form->end(); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Etat Journalier<span id="nameofcaisse"></span></h3>
                </div>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr style='background-color:#e66771;'>
                                <th hidden style="text-align: center;">id</th>
                                <!-- <th style="text-align: center;width:10%">Type</th> -->
                                <th style="text-align: center;width:10%">Mode</th>
                                <th style="text-align: center;width:10%">Code</th>
                                <th style="text-align: center;width:25%">Client/Caisses</th>
                                <th style="text-align: center;width:10%">Num piéce</th>
                                <th style="text-align: center;width:10%"> BL/FC</th>

                                <th style="text-align: center;width:12%">Date</th>

                                <th style="text-align: center;width:10%">Montant réglé</th>
                                <th style="text-align: center;width:12%">Solde</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalDebits = 0;
                            $totalCredits = 0;
                            $total = 0;
                            $solde = 0;
                            $totalss = 0;

                            usort($clientData, function ($a, $b) {
                                return strtotime($a['date']) - strtotime($b['date']);
                            });
                            // debug($clientData);

                            foreach ($clientData as $i => $data):
                                // $totalDebits += $data['debit'];
                                // debug($data['montantpiece']);
                                if ($data['paiement_id'] == 1) {
                                    $Sumespece += $data['montantpiece'];
                                } else if ($data['paiement_id'] == 2) {
                                    $Sumcheque += $data['montantpiece'];
                                } else if ($data['paiement_id'] == 3) {
                                    $Sumtraite += $data['montantpiece'];
                                } else if ($data['paiement_id'] == 4) {
                                    $Sumvirement += $data['montantpiece'];
                                } else if ($data['paiement_id'] == 5) {

                                    $Sumretenue += $data['montantpiece'];
                                } else if ($data['paiement_id'] == 6) {
                                    $Sumeversement += $data['montantpiece'];
                                } elseif ($data['paiement_id'] == 9) {
                                    $Sumecarte += $data['montantpiece'];
                                }






                                $totalDebits += (float) $data['debit'];
                                $totalCredits += (float) $data['credit'];
                                // debug( $data['numfact']);



                                $solde -= (float) $data['credit'];
                                $solde += (float) $data['debit'];
                                $totalss += (float) $data['debit'] - (float) $data['credit'];
                                $style = "";
                                if ($data['paiement_id'] == 2) {
                                    $style = "   background-color: bisque;";
                                } else if ($data['paiement_id'] == 1) {
                                    $style = "   background-color: #87ceeb ;";
                                } else if ($data['paiement_id'] == 9) {
                                    $style = "   background-color: #f0865f;";
                                } else if ($data['paiement_id'] == 6) {
                                    $style = "   background-color: #b0c24a;";
                                } else if ($data['paiement_id'] == 3) {
                                    $style = "   background-color: #20b2aa;";
                                } else if ($data['paiement_id'] == 5) {
                                    $style = "   background-color: #dda0dd;";
                                }
                            ?>
                                <tr>
                                    <td hidden></td>
                                    <!-- <td align="center"> <?php echo ($data['type']) ?> </td> -->
                                    <td align="center" style="<?php echo $style; ?>">
                                        <span> <?php echo ($data['paiement_name']) ?></span>
                                    </td>
                                    <td>
                                        <?php echo ($data['code']) ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        if ($data['index'] == 2) {
                                            echo ($data['name']);
                                        }
                                        if ($data['index'] == 4) {
                                            echo ($data['caissedep'] . '=>' . $data['caissearr']);
                                        }

                                        if ($data['index'] == 3) {
                                            echo ($data['caissedep']);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo ($data['num']) ?>
                                    </td>
                                   
                                    <td>
                                        <?php
                                        if ($data['numfact']) {
                                            foreach ($data['numfact'] as $nn => $valfact) {

                                                if (strpos($valfact, 'FAC N°') !== false) {
                                                    echo '<span style="color:#8b0000; font-weight:bold;">' . ($valfact) . '</span><br>';
                                                } else if (strpos($valfact, 'BL N°') !== false) {
                                                    echo '<span style="color:#0000ff; font-weight:bold;">' . ($valfact) . '</span><br>';
                                                } else if (strpos($valfact, 'CMD N°') !== false) {
                                                    echo '<span style="color:#29ab87; font-weight:bold;">' . ($valfact) . '</span><br>';
                                                } else {
                                                    echo '';
                                                }
                                            }
                                        }

                                        ?>
                                    </td>

                                    <td align="center">
                                        <?php echo $this->Time->format($data['date'], 'dd/MM/y'); ?>
                                    </td>
                                    <td align="center" hidden>
                                        <?php echo ($data['observation']) ?>
                                    </td>

                                    <!-- <td style="text-align:right;padding-right:5px">
                                        <?php
                                        //echo sprintf("%01.3f", $data['debit']);

                                        ?>
                                        <?php
                                        if ($data['index'] == 1) {
                                        ?>
                                            <strong
                                                style="color:green"><?php echo sprintf("%01.3f", $data['debit']); ?></strong>
                                        <?php } else {
                                            echo sprintf("%01.3f", $data['debit']);
                                        }

                                        // $solde += $data['credit'];
                                        // $solde -= $data['debit'];

                                        ?>
                                    </td> -->
                                    <td style="text-align:right;padding-right:5px">
                                        <?php
                                        if ($data['debit'] != '') {
                                        ?>
                                            <?php
                                            if ($data['index'] == 1) {
                                            ?>
                                                <strong
                                                    style="color:green"><?php echo sprintf("%01.3f", $data['debit']); ?></strong>
                                            <?php } else {
                                                echo sprintf("%01.3f", $data['debit']);
                                            }


                                            ?>
                                        <?php   } else  if ($data['credit'] != '') {
                                            echo sprintf("%01.3f", -$data['credit']);
                                        }



                                        ?>
                                    </td>
                                    <td style="text-align:right;padding-right:5px">
                                        <?php
                                        //echo sprintf("%01.3f", $data['montant']);
                                        echo sprintf("%01.3f", $solde);

                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <tr class="total-row">

                                <!-- <td hidden></td>
                                <td></td> -->
                                <td>
                                    <table style="width: 100%;">
                                        <tr style='background-color:#87ceeb ;border:solid 1px'>
                                            <th colspan="3" style="text-align: center;">Total Espéce :</th>
                                        </tr>

                                        <tr>


                                            <td colspan="3" align="center" style="width: 33%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background"
                                                    style="text-align:right;padding-right:5px;width: 100%;"
                                                    value="<?php echo sprintf("%01.3f", $Sumespece) ?>"
                                                    disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="width: 100%;">
                                        <tr style='background-color:bisque;border:solid 1px'>
                                            <th colspan="3" style="text-align: center;">Total Chéque :</th>
                                        </tr>

                                        <tr>


                                            <td colspan="3" align="center" style="width: 33%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background"
                                                    style="text-align:right;padding-right:5px;width: 100%;"
                                                    value="<?php echo sprintf("%01.3f", $Sumcheque) ?>"
                                                    disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="width: 100%;">
                                        <tr style='background-color:#b0c24a;border:solid 1px'>
                                            <th colspan="3" style="text-align: center;">Total Viremenet :</th>
                                        </tr>

                                        <tr>


                                            <td colspan="3" align="center" style="width: 33%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background"
                                                    style="text-align:right;padding-right:5px;width: 100%;"
                                                    value="<?php echo sprintf("%01.3f", $Sumviremenet) ?>"
                                                    disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="width: 100%;">
                                        <tr style='background-color:#20b2aa;border:solid 1px'>
                                            <th colspan="3" style="text-align: center;">Total Traite :</th>
                                        </tr>

                                        <tr>


                                            <td colspan="3" align="center" style="width: 33%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background"
                                                    style="text-align:right;padding-right:5px;width: 100%;"
                                                    value="<?php echo sprintf("%01.3f", $Sumtraite) ?>"
                                                    disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="width: 100%;">
                                        <tr style='background-color:#dda0dd;border:solid 1px'>
                                            <th colspan="3" style="text-align: center;">Total Retenue :</th>
                                        </tr>

                                        <tr>


                                            <td colspan="3" align="center" style="width: 33%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background"
                                                    style="text-align:right;padding-right:5px;width: 100%;"
                                                    value="<?php echo sprintf("%01.3f", $Sumretenue) ?>"
                                                    disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="width: 100%;">
                                        <tr style='background-color:#5f9ea0 ;border:solid 1px'>
                                            <th colspan="3" style="text-align: center;">Total Versement :</th>
                                        </tr>

                                        <tr>


                                            <td colspan="3" align="center" style="width: 33%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background"
                                                    style="text-align:right;padding-right:5px;width: 100%;"
                                                    value="<?php echo sprintf("%01.3f", $Sumeversement) ?>"
                                                    disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="width: 100%;">
                                        <tr style='background-color:#f0865f;border:solid 1px'>
                                            <th colspan="3" style="text-align: center;">Total Ecart :</th>
                                        </tr>

                                        <tr>


                                            <td colspan="3" align="center" style="width: 33%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background"
                                                    style="text-align:right;padding-right:5px;width: 100%;"
                                                    value="<?php echo sprintf("%01.3f", $Sumecarte) ?>"
                                                    disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table style="width: 100%;">
                                        <tr style='background-color:#e66771;border:solid 1px'>
                                            <th colspan="3" style="text-align: center;">Total Période :</th>
                                        </tr>

                                        <tr>


                                            <td colspan="3" align="center" style="width: 33%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background"
                                                    style="text-align:right;padding-right:5px;width: 100%;"
                                                    value="<?php echo sprintf("%01.3f", $totalDebits - $totalCredits) ?>"
                                                    disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                            </tr>











                        </tbody>
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
    // $(".getcaisseName1").on("click", function() {
    //     caisse = $('#caisse_id').val();

    //     if (caisse == null || caisse == '') {
    //         alert('Veuillez choisir une caisse !!');
    //         return false;
    //     }
    // });
</script>

<?php $this->end(); ?>