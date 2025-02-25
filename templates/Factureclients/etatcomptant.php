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
        <h1 style="text-align:center;"> Détails de Vente</h1>
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
                <button type="submit" style="background-color:#417dc1;border:#417dc1;" class="btn btn-primary btn-sm getcaisseName1">Afficher</button>
                <?php echo $this->Html->link('<i class="fa fa-refresh"></i> Actualiser', ['action' => 'etatcomptant'], ['class' => 'btn btn-primary btn-sm', 'style' => 'background-color:#417dc1;border:#417dc1;', 'escape' => false]) ?>
                <a onclick="openWindow(1000, 1000, wr+ 'Factureclients/impetatcomptant?&historiquede=<?php echo @$this->request->getQuery('historiquede'); ?>&au=<?php echo @$this->request->getQuery('au'); ?>&client_id=<?php echo @$this->request->getQuery('client_id'); ?>')"><button style="background-color:#417dc1; border:1px solid #417dc1; height:43%; color:white; padding:9px 19px;" class="btn btn-primary fa fa-print getcaisseName1">Imprimer</button></a>
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
                    <h3 class="box-title">Etat Détails<span id="nameofcaisse"></span></h3>
                </div>
                <div class="box-body">
                    <!-- <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr style='background-color:#96c8a2;'>
                                <th hidden style="text-align: center;">id</th>
                                <th style="text-align: center;width:10%">Type</th>
                                <th style="text-align: center;width:10%">Code</th>
                                <th style="text-align: center;width:15%">Client</th>
                                <th style="text-align: center;width:8%">Numéro</th>

                                <th style="text-align: center;width:8%">Date</th>
                                <th style="text-align: center;width:10%">Personnel</th>
                                <th style="text-align: center;width:12%">Observation</th>

                                <th style="text-align: center;width:12%">Montant</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalfinal = 0;


                            usort($clientData, function ($a, $b) {
                                return strtotime($a['date']) - strtotime($b['date']);
                            });
                            // debug($clientData);

                            foreach ($clientData as $i => $data) :
                                // $totalDebits += $data['debit'];
                                //  debug($data['idbl']);
                                $totalDebits += (float)$data['debit'];
                                $totalCredits += (float)$data['credit'];



                                $solde -= (float)$data['credit'];
                                $solde += (float)$data['debit'];
                                $totalss += (float)$data['debit'] - (float)$data['credit'];
                                $totalfinal += (float)$data['credit'] + (float)$data['debit'];
                            ?>
                                <tr>
                                    <td hidden> <?php echo ($data['id']) ?></td>
                                    <td align="center"> <?php echo ($data['type']) ?> </td>
                                    <td align="center">
                                        <?php

                                        echo ($data['code']);

                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php

                                        echo ($data['name']);

                                        ?>
                                    </td>


                                    <td>
                                        <?php
                                        if (!empty($data['fac']) && $data['fac'] != 'FAC : ') {
                                            echo '<span style="color:#8b0000; font-weight:bold;">' . htmlspecialchars($data['fac']) . '</span>';
                                        } elseif (!empty($data['bl']) && $data['bl'] != 'BL : ') {
                                            echo '<span style="color:#0000ff; font-weight:bold;">' . htmlspecialchars($data['bl']) . '</span>';
                                        } else {
                                            echo '';  // Optional, since nothing will be printed if both conditions are false
                                        }
                                        ?>
                                    </td>


                                    <td align="center">
                                        <?php echo $this->Time->format($data['date'], 'dd/MM/y'); ?>
                                    </td>

                                    <td>
                                        <?php echo ($data['personnel']) ?>
                                    </td>
                                    <td align="center">
                                        <?php echo ($data['observation']) ?>
                                    </td>
                                    <td style="text-align:right;padding-right:5px">

                                        <?php
                                        if ($data['index'] == 1) {
                                        ?>
                                            <strong style="color:blue"><?php echo sprintf("%01.3f", $data['credit']); ?></strong>
                                        <?php } else { ?>
                                            <strong style="color:red"><?php echo sprintf("%01.3f", $data['debit']); ?></strong>
                                        <?php   }

                                        // $solde += $data['credit'];
                                        // $solde -= $data['debit'];

                                        ?>
                                    </td>



                                </tr>
                            <?php endforeach; ?>

                            <tr>
                                <td colspan="7" align="center" style='background-color:#96c8a2;'><strong>Total</strong></td>
                                <td style="text-align:right;padding-right:5px"><strong><?php echo sprintf("%01.3f", $totalfinal); ?></strong></td>

                            </tr>










                        </tbody>
                    </table> -->


                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr style='background-color:#417dc1;'>
                                    <!-- <th hidden style="text-align: center;">ID</th> -->
                                    <!-- <th style="text-align: center;width:10%">Type</th> -->
                                    <th style="text-align: center;width:8%">Date</th>
                                    <th style="text-align: center;width:8%">Numéro</th>
                                    <th style="text-align: center;width:10%">Personnel</th>
                                    <!-- <th style="text-align: center;width:10%">Code</th> -->
                                    <th style="text-align: center;width:15%">Client</th>
                                    <th style="text-align: center;width:12%">Régler / NON</th>
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
                                // usort($clientData, function ($a, $b) {
                                //     return strtotime($a['date']) - strtotime($b['date']);
                                // });

                                foreach ($clientData as $i => $data) :
                                    // debug()
                                    $totalDebits += (float)$data['debit'];
                                    $totalCredits += (float)$data['credit'];
                                    $solde -= (float)$data['credit'];
                                    $solde += (float)$data['debit'];
                                    $totalss += (float)$data['debit'] - (float)$data['credit'];
                                    $totalfinal += (float)$data['credit'] + (float)$data['debit'];
                                ?>
                                    <tr style="background-color:#b0c4de;">
                                        <!-- <td hidden> <?php echo h($data['id']); ?></td> -->
                                        <!-- <td align="center"><strong> <?php echo h($data['type']); ?></strong> </td> -->
                                        <td align="center">
                                            <?php echo $this->Time->format($data['date'], 'dd/MM/y'); ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (!empty($data['fac']) && $data['fac'] != 'FAC : ') {
                                                echo '<span style="color:#0000ff; font-weight:bold;">' . h($data['fac']) . '</span>';
                                            } elseif (!empty($data['bl']) && $data['bl'] != 'BL : ') {
                                                echo '<span style="color:red; font-weight:bold;">' . h($data['bl']) . '</span>';
                                            } else {
                                                echo '';  // Optional
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo h($data['personnel']); ?>
                                        </td>
                                        <!-- <td align="center">
                                            <?php echo h($data['code']); ?>
                                        </td> -->
                                        <td align="center">
                                            <?php echo h($data['name']); ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if (!empty($data['payerfac']) && $data['payerfac'] != 'RF : ') {
                                                if ($data['payerfac'] === 'RF : Oui') {
                                                    echo '<button style="color:white;border:green; background-color:green; font-weight:bold;">OUI</button>';
                                                } else {
                                                    echo '<button style="color:white;border:red; background-color:red; font-weight:bold;">NON</button>';
                                                }
                                            } elseif (!empty($data['payerbl']) && $data['payerbl'] != 'RL : ') {
                                                if ($data['payerbl'] === 'Rl : Oui') {
                                                    echo '<button style="color:white; border:green;background-color:green; font-weight:bold;">OUI</button>';
                                                } else {
                                                    echo '<button style="color:white;border:red; background-color:red; font-weight:bold;">NON</button>';
                                                }
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </td>

                                        <!-- <td style="text-align:right;padding-right:5px">
                                            <?php
                                            if ($data['index'] == 1) {
                                            ?>
                                                <strong style="color:red"><?php echo sprintf("%01.3f", $data['credit']); ?></strong>
                                            <?php } else { ?>
                                                <strong style="color:blue"><?php echo sprintf("%01.3f", $data['debit']); ?></strong>
                                            <?php }
                                            ?>
                                        </td> -->
                                    </tr>

                                    <?php
                                    if ($data['index'] == 1) { // Bonlivraison
                                        $lignebl = $connection->execute('SELECT * FROM lignebonlivraisons WHERE bonlivraison_id=' . $data['idbl'] . ';')->fetchAll('assoc');

                                        if (!empty($lignebl)) :
                                    ?>
                                            <tr>
                                                <td colspan="5">
                                                    <table id="example1" class="table">
                                                        <thead>
                                                            <tr style='background-color:#45b1e8;'>
                                                                <th style="text-align: center;">Code</th>
                                                                <th style="text-align: center;">Désignation</th>
                                                                <th style="text-align: center;">Qté</th>
                                                                <th style="text-align: center;">PUTTC</th>
                                                                <th style="text-align: center;">Remise</th>

                                                                <th style="text-align: center;">TTC</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($lignebl as $lineb) :
                                                                $articlee = $connection->execute('SELECT * FROM articles WHERE articles.id=' . $lineb['article_id'] . ';')->fetchAll('assoc');
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo h($articlee[0]['Code']); ?></td>
                                                                    <td><?php echo h($articlee[0]['Dsignation']); ?></td>
                                                                    <td><?php echo h($lineb['qte']); ?></td>
                                                                    <td><?php echo sprintf("%01.3f", $lineb['puttc']); ?></td>
                                                                    <td><?php echo ($lineb['remise']); ?></td>

                                                                    <td><?php echo sprintf("%01.3f", $lineb['ttc']); ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php endif;
                                    } elseif ($data['index'] == 2) { // Factureclient
                                        $lignefac = $connection->execute('SELECT * FROM lignefactureclients WHERE factureclient_id=' . $data['idfac'] . ';')->fetchAll('assoc');

                                        if (!empty($lignefac)) :
                                        ?>
                                            <tr>
                                                <td colspan="5">
                                                    <table id="example1" class="table">
                                                        <thead>
                                                            <tr style='background-color:#45b1e8;'>
                                                                <th style="text-align: center;">Code</th>
                                                                <th style="text-align: center;">Désignation</th>
                                                                <th style="text-align: center;">Qté</th>
                                                                <th style="text-align: center;">PUTTC</th>
                                                                <th style="text-align: center;">Remise</th>
                                                                <th style="text-align: center;">TTC</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($lignefac as $line) :
                                                                $article = $connection->execute('SELECT * FROM articles WHERE articles.id=' . $line['article_id'] . ';')->fetchAll('assoc');
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo h($article[0]['Code']); ?></td>
                                                                    <td><?php echo h($article[0]['Dsignation']); ?></td>
                                                                    <td><?php echo h($line['qte']); ?></td>
                                                                    <td><?php echo sprintf("%01.3f", $line['puttc']); ?></td>
                                                                    <td><?php echo ($line['remise']); ?></td>

                                                                    <td><?php echo sprintf("%01.3f", $line['ttc']); ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                    <?php endif;
                                    }
                                    ?>

                                <?php endforeach; ?>

                                <tr>
                                    <td colspan="3" align="center" style='background-color:#417dc1;'><strong>Total</strong></td>
                                    <td style="text-align:right;padding-right:5px"><strong><?php echo sprintf("%01.3f", $totalfinal); ?></strong></td>
                                </tr>
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