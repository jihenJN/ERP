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
        <h1 style="text-align:center;">Etat Retenus</h1>
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
                        echo $this->Form->control('historiquede', [
                            'label' => 'Date début',
                            'value' =>$datedebut, //$this->request->getQuery('historiquede'),
                            // 'max' => $historiquede,
                            'type' => 'date',
                            // 'readonly' => 'readonly',
                            'empty' => 'Veuillez choisir !!',
                            'class' => 'form-control',
                            'required' => 'off'
                        ]);
                        ?>
                    </div>
                    <div class="col-xs-6">
                        
                        <?php
                         $datefin = date('Y-12-t');
                        echo $this->Form->control('au', [
                            'label' => 'Date fin',
                            'value' => $datefin, // $this->request->getQuery('au'),
                            // 'max' => $au,
                            'type' => 'date',
                            // 'readonly' => 'readonly',
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
                        <a onclick="openWindow(1000, 1000, wr+'reglementclients/impetatretenus?historiquede=<?php echo @$historiquede; ?>&au=<?php echo @$au; ?>&client_id=<?php echo @$client_id; ?>')">
                            <button class="btn btn-primary">Imprimer</button>
                        </a>



                        <?php echo $this->Html->link(__('Actualiser'), ['action' => '/etatretenus'], ['class' => 'btn btn-primary ']) ?>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<br>
<input type="hidden" id="page" value="1" />
<h3 style="margin-left: 5px;">Etat Retenus</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- <table class="table table-bordered table-striped table-bottomless" id="example1" border="1">  -->

                <table class="table table-bordered table-striped table-bottomless" id="example1" border="1">
                    <thead>
                        <tr style="background-color:#E0A9A9;color:white;">

                            <!-- <th>Facture</th> -->
                            <th>Date</th>
                            <th>Numéro</th>

                            <th>Code</th>
                            <th>Name</th>
                            <!-- <th>Date</th> -->
                            <!-- <th>Observation</th> -->
                            <th>Retenu</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $som = 0;
                        foreach ($clientData as $data):
                            $som += $data['total_piece_montant']; ?>
                            <tr>
                                <td><?= h($data['date_retenu']) ?></td>
                                <td><?= h($data['numero']) ?></td>

                                <!-- <td><strong style="color:#AA4A4A;">N° :</strong><?= h($data['Fac']) ?></td> -->
                                <td><?= h($data['client_code']) ?></td>
                                <td><?= h($data['client_name']) ?></td>
                                <!-- <td><?= h($data['date_reglement']) ?></td> -->
                                <!-- <td><?= h($data['observation']) ?></td> -->
                                <td><?= h($data['total_piece_montant']) ?></td>

                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td align="center" style="background-color:#E0A9A9;color:white;" colspan="4"><strong>Total Retenu</strong></td>

                            <td><strong><?= h($som) ?></strong></td>

                        </tr>
                    </tbody>
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