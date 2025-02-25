<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

?>


<?php
$connection = ConnectionManager::get('default');
?>

<section class="content-header">
    <header>
        <h1 style="text-align:center;"> Détail des Réglements BL</h1>
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
                        <div class="col-xs-4">
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
                        <div class="col-xs-4">
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
                        <div class="col-xs-4">
                            <?php
                            echo $this->Form->control('client_id', [
                                'required' => 'off',
                                'label' => 'Client',
                                'value' => $this->request->getQuery('client_id'),
                                'id' => 'client_id',
                                'div' => 'form-group',
                                'class' => 'form-control select2',
                                'options' => $clients,
                                'empty' => 'Veuillez choisir !!',
                            ]);
                            ?>
                        </div>

                    </div>
                </div>
            </div><br><br>
            <div style="text-align:center">
                <button type="submit" style="background-color:#5f9ea0 ;border:#5f9ea0;" class="btn btn-primary btn-sm getcaisseName1">Afficher</button>
                <?php echo $this->Html->link('<i class="fa fa-refresh"></i> Actualiser', ['action' => 'etatreglementbl'], ['class' => 'btn btn-primary btn-sm', 'style' => 'background-color:#5f9ea0 ;border:#5f9ea0 ;', 'escape' => false]) ?>
                <a onclick="openWindow(1000, 1000, wr+ 'reglementclients/impetatregbl?&historiquede=<?php echo @$this->request->getQuery('historiquede'); ?>&au=<?php echo @$this->request->getQuery('au'); ?>&client_id=<?php echo @$this->request->getQuery('client_id'); ?>')"><button style="background-color:#5f9ea0 ; border:1px solid #5f9ea0 ; height:43%; color:white; padding:9px 19px;" class="btn btn-primary fa fa-print getcaisseName1">Imprimer</button></a>
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
                    <h3 class="box-title">Etat Réglement BL<span id="nameofcaisse"></span></h3>
                </div>
                <div class="box-body">


                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr style='background-color:#5f9ea0;'>

                                    <th style="text-align: center;width:8%">Date</th>
                                    <th style="text-align: center;width:8%">Numéro</th>
                                    <th style="text-align: center;width:8%">Code</th>
                                    <th style="text-align: center;width:15%">Raison Social</th>
                                    <th style="text-align: center;width:10%">Total TTC</th>
                                    <th style="text-align: center;width:10%">Montant Régler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalfinal = 0;
                                $totalDebits = 0;
                                $totalCredits = 0;
                                $solde = 0;
                                $totalss = 0;
                                usort($clientData, function ($a, $b) {
                                    return strtotime($b['date']) - strtotime($a['date']);
                                });


                                foreach ($clientData as $i => $data) : ?>
                                    <tr style="background-color:#97D7D7;">

                                        <td align="center">
                                            <?php echo $this->Time->format($data['date'], 'dd/MM/y'); ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<span style="color:#4682b4; font-weight:bold;">' . h($data['bl']);
                                            if (!empty($data['fac'])) {
                                                echo '  <span style="color:#000000;"> ==></span> <span style="color:#BF6363; font-weight:bold;">FAC: ' . h($data['fac']) . '</span>';
                                            } else {
                                                echo ' ';
                                            }
                                            echo '</span>';
                                            ?>


                                        </td>

                                        <td align="center">
                                            <?php echo h($data['code']); ?>
                                        </td>
                                        <td align="center">
                                            <?php echo h($data['name']); ?>
                                        </td>
                                        <td align="center">
                                            <?php echo h($data['totalttc']); ?>
                                        </td>
                                        <td align="center">
                                            <strong><?php echo h($data['Montant_Regler']); ?></strong>
                                        </td>



                                    </tr>
                                    <?php
                                    $lignereg = $connection->execute('SELECT * FROM lignereglementclients WHERE bonlivraison_id=' . $data['idbl'] . ';')->fetchAll('assoc');

                                    foreach ($lignereg as &$ligner) {
                                        $ligner['source'] = 'lignereg';
                                    }

                                    if ($data['factureclient_id'] != 0) {
                                        $ligneregFacture = $connection->execute('SELECT * FROM lignereglementclients WHERE factureclient_id=' . $data['factureclient_id'] . ';')->fetchAll('assoc');

                                        foreach ($ligneregFacture as &$lignerFacture) {
                                            $lignerFacture['source'] = 'ligneregFacture';
                                        }

                                        // Fusion des règlements BL et Facture
                                        $lignereg = array_merge($lignereg, $ligneregFacture);
                                    }

                                    if (!empty($lignereg)) :
                                    ?>
                                        <tr>
                                            <td colspan="6">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr style='background-color:#b0c4de;'>
                                                            <th style="text-align: center;">Type Réglement</th>
                                                            <th style="text-align: center;">Mode de Paiement</th>
                                                            <th style="text-align: center;">Numéro</th>
                                                            <th style="text-align: center;">Échéance</th>
                                                            <th style="text-align: center;">Montant</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $totalReglementGlobal = 0;

                                                        // Parcourir tous les règlements et afficher chaque pièce avec son montant
                                                        foreach ($lignereg as $ligner) {
                                                            $pieces = $connection->execute(
                                                                'SELECT piece.*, paiements.name FROM piecereglementclients AS piece 
                                                                       JOIN paiements ON piece.paiement_id = paiements.id WHERE piece.reglementclient_id = :reglementclient_id',
                                                                ['reglementclient_id' => $ligner['reglementclient_id']]
                                                            )->fetchAll('assoc');

                                                            $typeReglement = ($ligner['source'] == 'ligneregFacture') ? 'Règlement Facture' : 'Règlement Bon de Livraison';

                                                            foreach ($pieces as $piece) {
                                                                // Accumuler le total global
                                                                $totalReglementGlobal += $piece['montant'];
                                                        ?>
                                                                <tr style='background-color:<?php echo ($typeReglement == 'Règlement Facture') ? "#EAC6C6" : "#b0c4de"; ?>;'>
                                                                    <td style=" font-style: italic;"><?php echo h($typeReglement); ?></td>
                                                                    <td><?php echo h($piece['name']); ?></td>
                                                                    <td><?php echo h($piece['numero']); ?></td>
                                                                    <td><?php echo h($piece['echeance']); ?></td>
                                                                    <td><?php echo sprintf("%01.3f", $piece['montant']); ?></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <!-- Afficher le total général à la fin -->
                                                        <tr>
                                                            <td colspan="4" style="text-align: center; font-weight: bold;background-color:#b0c4de;">Total Règlement Global :</td>
                                                            <td style="text-align: center; font-weight: bold;background-color:#97D7D7;"><?php echo sprintf("%01.3f", $totalReglementGlobal); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach;
                                ?>





                            </tbody>
                        </table>


                    </div>



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