<?php echo $this->Html->css('select2'); ?>

<?php

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;

$connection = ConnectionManager::get('default');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<style>
    #example1 {
        border-collapse: collapse;
        border: 2px solid #000;
    }

    #example1 th,
    #example1 td {
        border: 1px solid #000;
        padding: 8px;
    }
</style>

<section class="content-header">
    <header>
        <h1 style="text-align:center;">Etat de Client Non Soldé</h1>
    </header>
</section>
<br>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo $this->Form->create(null, ['type' => 'get']); ?>
                <div class="row">
                    <div class="col-xs-6">
                        <?php
                        date_default_timezone_set('Africa/Tunis');
                        $datedebut = date('Y-01-01');
                        echo $this->Form->control('datedebut', [
                            'label' => 'Date début',
                            'value' => $datedebut,
                            'max' => $datedebut,
                            'type' => 'date',
                            'readonly' => 'readonly',
                            'empty' => 'Veuillez choisir !!',
                            'class' => 'form-control',
                            'required' => 'off'
                        ]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        $datefin = date('Y-12-31');
                        echo $this->Form->control('datefin', [
                            'label' => 'Date fin',
                            'value' => $datefin,
                            'max' => $datefin,
                            'type' => 'date',
                            'readonly' => 'readonly',
                            'empty' => 'Veuillez choisir !!',
                            'class' => 'form-control',
                            'required' => 'off'
                        ]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php

                        echo $this->Form->control('client_id', [
                            'label' => 'Client',
                            'value' => $this->request->getQuery('client_id'),
                            'options' => $clientss,
                            'empty' => 'Veuillez choisir !!',
                            'class' => 'form-control select2',
                            'required' => 'off'
                        ]);
                        ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary ">Afficher</button>
                        <a onclick="openWindow(1000, 1000, wr+'clients/impnonsolde?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&client_id=<?php echo @$client_id; ?>')">
                            <button class="btn btn-primary">Imprimer</button>
                        </a>



                        <?php echo $this->Html->link(__('Actualiser'), ['action' => '/etatnonsolde'], ['class' => 'btn btn-primary ']) ?>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<br>
<input type="hidden" id="page" value="1" />
<h3 style="margin-left: 5px;">Etat Client Non Soldé</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- <table class="table table-bordered table-striped table-bottomless" id="example1" border="1">  -->
                <div style="overflow: auto;  max-height: 900px;">

                    <!-- <table class="table table-bordered table-striped table-bottomless"  id="example1" border="1"> -->
                    <?php date_default_timezone_set('Africa/Tunis');
                    $datedebut = date('Y-01-01');
                    $datefin = date('Y-12-t'); ?>
                    <table id="example1" class="table-fixed table table-bordered table-striped" style='display: block; overflow-x: auto; white-space: nowrap;'>
                        <thead style='position: sticky; top: 0;'>
                            <tr style="font-style: italic; font-weight: bold;height:20px;">
                                <th style="width:10%!important;background-color:rgb(238, 236, 236); color: #000000;">Démarcheur</th>
                                <th style="width:20%!important;background-color:rgb(238, 236, 236); color: #000000;">Solde Ini</th>
                                <?php foreach ($mois as $mm) : ?>
                                    <th width="20%" style="font-size: 16px; background-color: #d7837f; color: #000000; font-style: italic; font-weight: bold;" align="center"><?php echo $mm; ?></th>
                                <?php endforeach; ?>
                                <th style="width:20%!important;background-color:rgb(238, 236, 236); color: #000000;font-style: italic; font-weight: bold;">Encours</th>
                                <th style="width:20%!important;background-color:rgb(238, 236, 236); color: #000000;font-style: italic; font-weight: bold;">Solde</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sumsoldedebut = 0;
                            $sumencours = 0;
                            $sumsolde = 0;
                            foreach ($clients as $client) :
                                $client_id = $client->id;
                                $sumsoldedebut += $client->soldedebut;

                                $test = $connection->prepare("SELECT SUM(totalttc) as sumtotalttc
                            FROM factureclients
                            WHERE factureclients.client_id = ? AND Date(factureclients.date) BETWEEN ? AND ?");
                                $test->bindValue(1, $client->id);
                                $test->bindValue(2, $datedebut);
                                $test->bindValue(3, $datefin);
                                $test->execute();
                                $resulttest = $test->fetchAll('assoc');
                                $resFacture = $resulttest ? $resulttest[0]['sumtotalttc'] : 0;

                                $statement = $connection->prepare("SELECT SUM(totalttc) as ttc
                                FROM bonlivraisons
                                WHERE bonlivraisons.factureclient_id = 0 AND bonlivraisons.typebl = 1
                                AND bonlivraisons.client_id = ? AND Date(bonlivraisons.date) BETWEEN ? AND ?");
                                $statement->bindValue(1, $client_id);
                                $statement->bindValue(2, $datedebut);
                                $statement->bindValue(3, $datefin);
                                $statement->execute();
                                $test1 = $statement->fetchAll('assoc');
                                $resBL = $test1 ? $test1[0]['ttc'] : 0;

                                $reglementQuery = $connection->prepare("SELECT SUM(lignereglementclients.Montant) AS sumMontant
                            FROM lignereglementclients
                            LEFT JOIN reglementclients 
                            ON lignereglementclients.reglementclient_id = reglementclients.id
                            WHERE reglementclients.client_id = ? AND reglementclients.date BETWEEN ? AND ?");
                                $reglementQuery->bindValue(1, $client_id);
                                $reglementQuery->bindValue(2, $datedebut);
                                $reglementQuery->bindValue(3, $datefin);
                                $reglementQuery->execute();
                                $reglementResult = $reglementQuery->fetchAll('assoc');
                                $resReg = $reglementResult ? $reglementResult[0]['sumMontant'] : 0;

                                $tt = $client->soldedebut + $resFacture + $resBL - $resReg;
                                $sumencours += ($resFacture + $resBL);
                                $sumsolde += $tt;

                                if ($tt != 0) :
                            ?>
                                    <tr style="height:30px;">
                                        <td style="background-color: #8fbc8f; color: #000000;"><?php echo $client->Raison_Sociale; ?></td>
                                        <td><?php echo  h(number_format(abs($client->soldedebut), 3, ',', ' ')) ?></td>
                                        <?php foreach ($moiss as $mois_id => $mm) :

                                            $month_start_date = date('Y-m-01', strtotime("{$mm->num}/01/" . date('Y')));
                                            $month_end_date = date('Y-m-t', strtotime($month_start_date));

                                            // Query for factureclients totalttc for this month
                                            $test = $connection->prepare("SELECT SUM(totalttc) as sumtotalttc
                                        FROM factureclients
                                        WHERE factureclients.client_id = ? AND Date(factureclients.date) BETWEEN ? AND ?");
                                            $test->bindValue(1, $client->id);
                                            $test->bindValue(2, $month_start_date);
                                            $test->bindValue(3, $month_end_date);
                                            $test->execute();
                                            $resulttest = $test->fetchAll('assoc');
                                            $resFacturemoi = $resulttest ? $resulttest[0]['sumtotalttc'] : 0;

                                            // Query for bonlivraisons totalttc for this month
                                            $statement = $connection->prepare("SELECT SUM(totalttc) as ttc 
                                        FROM bonlivraisons 
                                        WHERE bonlivraisons.factureclient_id = 0 AND bonlivraisons.typebl = 1 
                                        AND bonlivraisons.client_id = ? AND Date(bonlivraisons.date) BETWEEN ? AND ?");
                                            $statement->bindValue(1, $client_id);
                                            $statement->bindValue(2, $month_start_date);
                                            $statement->bindValue(3, $month_end_date);
                                            $statement->execute();
                                            $test1 = $statement->fetchAll('assoc');
                                            $resBLmoi = $test1 ? $test1[0]['ttc'] : 0;

                                            // Query for total reglement amount for this month
                                            $reglementQuery = $connection->prepare("SELECT SUM(lignereglementclients.Montant) AS sumMontant
                                            FROM lignereglementclients
                                            LEFT JOIN reglementclients 
                                            ON lignereglementclients.reglementclient_id = reglementclients.id
                                            WHERE reglementclients.client_id = ? AND reglementclients.date BETWEEN ? AND ?");
                                            $reglementQuery->bindValue(1, $client_id);
                                            $reglementQuery->bindValue(2, $month_start_date);
                                            $reglementQuery->bindValue(3, $month_end_date);
                                            $reglementQuery->execute();
                                            $reglementResult = $reglementQuery->fetchAll('assoc');
                                            $resRegmoi = $reglementResult ? $reglementResult[0]['sumMontant'] : 0;

                                            $parmoisdd =  $resFacturemoi + $resBLmoi - $resRegmoi;
                                            $monthly_totals[$mois_id] += $parmoisdd;

                                        ?>
                                            <td><?php if ($parmoisdd != 0) {
                                                    echo  h(number_format(abs($parmoisdd), 3, ',', ' '));
                                                } ?></td>
                                        <?php endforeach; ?>
                                        <td><?php if (($resBL + $resFacture) != 0) {
                                                echo  h(number_format(abs($resBL + $resFacture), 3, ',', ' '));
                                            } ?></td>
                                        <td><?php if ($tt != 0) {
                                                echo  h(number_format(abs($tt), 3, ',', ' '));
                                            } ?></td>
                                    </tr>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </tbody>
                        <tr style="height:30px;">
                            <td style="background-color: #dcdcdc; font-weight: bold;">Total</td>
                            <td style=" font-weight: bold;"><?php echo  h(number_format(abs($sumsoldedebut), 3, ',', ' ')) ?></td>
                            <?php foreach ($monthly_totals as $total) : ?>
                                <td style="background-color:#F0D2D2; font-weight: bold;"><?php echo h(number_format(abs($total), 3, ',', ' ')); ?></td>
                            <?php endforeach; ?>
                            <td style="font-weight: bold;"> <?php echo h(number_format(abs($sumencours), 3, ',', ' ')); ?></td>
                            <td style="font-weight: bold;background-color:#C7FCC7;"> <?php echo h(number_format(abs($sumsolde), 3, ',', ' ')); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>

<!-- DataTables -->
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
    function openWindow(h, w, url) {
        leftOffset = (screen.width / 2) - w / 2;
        topOffset = (screen.height / 2) - h / 2;
        window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
    }

    $(function() {
        $('#example2').DataTable()
        $('#example1').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        })
    })
    $('.select2').select2()
</script>
<?php $this->end(); ?>