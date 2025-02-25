<?php $this->layout = 'AdminLTE.print'; ?>
<?php


use Cake\ORM\TableRegistry;

?>


<?php

$societeTable = TableRegistry::getTableLocator()->get('Societes');

$societe = $societeTable->find()->where('id=1')->first();

use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;

?>
<?php $connection = ConnectionManager::get('default'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<style>
    /* Define your table border style here */
    #example1 {
        border-collapse: collapse;
        /* Collapse borders to avoid double borders */
        border: 2px solid #000;
        /* Example: 2px solid black border */
    }



    #example1 th,
    #example1 td {
        border: 1px solid #000;
        /* Example: 1px solid black border for table cells */
        padding: 8px;
        /* Adjust cell padding as needed */
    }
</style>
<br>
<!-- <style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style> -->
<table width="100%">
    <thead>
        <tr>
            <td>
                <div style="display:flex;">
                    <table border="1" cellpadding="0" cellspacing="0" style="border: 2px solid #002E50; border-left:none;border-right:none;border-collapse: collapse; width: 100%; ">


                        <td align="center" style="width: 25%;border: none;">
                            <div>
                                <?php
                                echo $this->Html->image('logoSMBM.png', ['alt' => 'CakePHP', 'height' => '80px', 'width' => '100%']); ?>
                            </div>
                        </td>
                        <td align="center" style="width: 10%;border: none;">
                            <!-- <div>
                        <?php
                        echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); ?>

                        </div> -->
                        </td>
                        <td align="center" style="width: 50%; border: none; color: #002E50; font-weight: bold;">
                            <?php echo $societe->adresseEntete; ?>
                            <br>
                        </td>
                        <td align="center" style="width: 25%;border: none;">
                            <div>
                                <?php
                                // echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); 
                                ?>

                            </div>
                        </td>

                    </table>
                </div>
                <br>
            </td>




        </tr>
    </thead>
    <tr>
        <td>
            <h3>
               


                <!-- <div align="center" style="color: #ce2029 ; ">
                Etat des Retenus</div> -->
                <div align="center" style="color: #c71585 ; ">
                    ETAT DE RETENUS</div>
            </h3>

            <h5 align="center"> <strong> DU </strong><?php echo $historiquede; //->format('Y-m-d') 
                                                        ?><strong> &nbsp;&nbsp;&nbsp;&nbsp; AU </strong><?php echo $au; //->format('Y-m-d'); 
                                                                                                        ?></h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table width="100%" class="table table-bordered table-striped table-bottomless" id="example1" border="1">
                                <thead>
                                    <tr style="background-color:#E0A9A9;color:white;">

                                        <!-- <th>Facture</th> -->
                                        <th width="12%">Date</th>
                                        <th width="10%">Numéro</th>

                                        <th width="15%">Code</th>
                                        <th width="25%">Name</th>
                                        <!-- <th>Date</th> -->
                                        <!-- <th>Observation</th> -->
                                        <th width="15%">Retenu</th>

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
        </td>
    </tr>
</table>