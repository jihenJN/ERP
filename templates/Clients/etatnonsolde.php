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
                        $datedebut = date('Y-01-01 00:00:00');
                        echo $this->Form->control('datedebut', [
                            'label' => 'Date début',
                            'value' => $datedebut,
                            'max' => $datedebut,
                            'type' => 'datetime',
                            'readonly' => 'readonly',
                            'empty' => 'Veuillez choisir !!',
                            'class' => 'form-control',
                            'required' => 'off'
                        ]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        <?php
                        $datefin = date('Y-12-t 23:59:59');
                        echo $this->Form->control('datefin', [
                            'label' => 'Date fin',
                            'value' => $datefin,
                            'max' => $datefin,
                            'type' => 'datetime',
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
                        <a onclick="openWindow(1000, 1000,wr+ 'clients/impnonsolde?datedebut=<?php echo @$datedebut; ?>&datefin=<?php echo @$datefin; ?>&client_id=<?php echo @$client_id; ?>')">
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

                <table class="table table-bordered table-striped table-bottomless" id="example1" border="1">
                    <?php date_default_timezone_set('Africa/Tunis');
                    $datedebut = date('Y-01-01 00:00:00');
                    $datefin = date('Y-12-t 23:59:59'); ?>
                    <!-- <table id="example1" class="table-fixed table table-bordered table-striped" style='display: block; overflow-x: auto; white-space: nowrap;'> -->
                    <thead style='position: sticky; top: 0;'>
                        <tr style="font-style: italic; font-weight: bold;">
                            <td width="15%">Démarcheur</td>
                            <td>Solde Ini</td>
                            <?php foreach ($mois as $mm) : ?>
                                <td style="font-size: 16px; background-color: #d7837f; color: #000000; font-style: italic; font-weight: bold;" align="center"><?php echo $mm; ?></td>
                            <?php endforeach; ?>
                            <td style="font-style: italic; font-weight: bold;">Encours</td>
                            <td style="font-style: italic; font-weight: bold;">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalini = 0;
                        $totalencours = 0;
                        $generaltotaltt = 0;
                        foreach ($clients as $client) :
                            $client_id = $client->id;
                            $date = date('Y') - 1;
                            $test = $connection->prepare("SELECT SUM(totalttc) as sumtotalttc
                                                          FROM factureclients
                                                          LEFT JOIN lignereglementclients ON lignereglementclients.factureclient_id = factureclients.id
                                                          WHERE YEAR(factureclients.date) = ? AND factureclients.client_id = ?");
                            $test->bindValue(1, $date);
                            $test->bindValue(2, $client->id);
                            $test->execute();
                            $resulttest = $test->fetchAll('assoc');

                            $res = $resulttest ? $resulttest[0]['sumtotalttc'] : 0;
                            $totalini += $res + $client->soldedebut;

                            date_default_timezone_set('Africa/Tunis');
                            $datedebut = date('Y-01-01 00:00:00');
                            $datefin = date('Y-12-t 23:59:59');
                            $statement = $connection->prepare("SELECT SUM(totalttc) as ttc FROM bonlivraisons WHERE bonlivraisons.factureclient_id = 0 AND bonlivraisons.typebl = 1 AND bonlivraisons.client_id = ? AND bonlivraisons.date BETWEEN ? AND ?");
                            $statement->bindValue(1, $client_id);
                            $statement->bindValue(2, $datedebut);
                            $statement->bindValue(3, $datefin);
                            $statement->execute();
                            $test1 = $statement->fetchAll('assoc');
                            $testfin = $test1 ? $test1['0']['ttc'] : 0;


                            $parmoisdd = 0;
                            foreach ($moiss as $mois_id => $mm) {
                                $mois = $mm->num;
                                $annee_en_cours = date('Y');
                                $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                                $date_fin = date('Y-m-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                                $listefact = $connection->execute('SELECT SUM(totalttc) AS sumtotalttc FROM factureclients 
                                        WHERE factureclients.client_id = ' . $client->id . '
                                        AND factureclients.date BETWEEN \'' . $date_debut . '\' AND \'' . $date_fin . '\'
                                        AND factureclients.id NOT IN (
                                            SELECT factureclient_id FROM lignereglementclients
                                            WHERE lignereglementclients.factureclient_id = factureclients.id
                                        )')
                                    ->fetchAll('assoc');
                                $totalm = 0;
                                foreach ($listefact as $row) {
                                    $totalm += $row['sumtotalttc'];
                                    $parmoisdd += $row['sumtotalttc'];
                                }
                            }
                            $tt = $client->soldedebut + $res + $parmoisdd + $testfin;
                            if ($tt != 0 || $testfin != 0) {
                                $totalencours += $testfin;
                        ?>
                                <tr>
                                    <td style="background-color: #8fbc8f; color: #000000;"><?php echo $client->Raison_Sociale; ?></td>
                                    <td>
                                        <?php

                                        echo $client->soldedebut + $res;
                                        ?>
                                    </td>
                                    <?php
                                    $parmoisdd = 0;
                                    foreach ($moiss as $mois_id => $mm) :
                                        $mois = $mm->num;
                                        $annee_en_cours = date('Y');
                                        $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                                        $date_fin = date('Y-m-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                                        $listefact = $connection->execute('SELECT SUM(totalttc) AS sumtotalttc FROM factureclients 
                                        WHERE factureclients.client_id = ' . $client->id . '
                                        AND factureclients.date BETWEEN \'' . $date_debut . '\' AND \'' . $date_fin . '\'
                                        AND factureclients.id NOT IN (
                                            SELECT factureclient_id FROM lignereglementclients
                                            WHERE lignereglementclients.factureclient_id = factureclients.id
                                        )')
                                            ->fetchAll('assoc');

                                        //$totalm = 0;
                                        foreach ($listefact as $row) {
                                            // $totalm += $row['sumtotalttc'];
                                            // $parmoisdd += $row['sumtotalttc'];
                                            echo "<td>" . $row['sumtotalttc'] . "</td>";
                                        }
                                    endforeach;





                                    $generaltotaltt += $tt;
                                    ?>
                                    <td><?php echo $testfin; ?></td>
                                    <td><?php echo $tt; ?></td>
                                </tr>
                        <?php }
                        endforeach; ?>
                    </tbody>
                    <tr>
                        <td></td>
                        <td><strong><?php echo $totalini; ?></strong></td>
                        <?php
                        foreach ($moiss as $mois_id => $mm) :
                            $mois = $mm->num;
                            $annee_en_cours = date('Y');
                            $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                            $date_fin = date('Y-m-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                            $listefact22 = $connection->execute('SELECT SUM(totalttc) AS sumtotalttc FROM factureclients 
                                WHERE factureclients.date BETWEEN \'' . $date_debut . '\' AND \'' . $date_fin . '\'
                                AND factureclients.id NOT IN (
                                    SELECT factureclient_id FROM lignereglementclients
                                    WHERE lignereglementclients.factureclient_id = factureclients.id
                                )')
                                ->fetchAll('assoc');

                            $totalm22 = 0;
                            foreach ($listefact22 as $row) {
                                $totalm22 += $row['sumtotalttc'];
                                echo "<td><strong>" . $row['sumtotalttc'] . "</strong></td>";
                            }
                        endforeach;
                        ?>
                        <td><strong><?php echo $totalencours; ?></strong></td>
                        <td><strong><?php echo $generaltotaltt; ?></strong></td>
                    </tr>
                </table>
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
            'paging': true,
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