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


<style>
    /* Define your table border style here */
    #example1 {
        border-collapse: collapse;
        /* Collapse borders to avoid double borders */
        border: 2px solid #080400;
        /* Example: 2px solid black border */
    }

    #example1 th,
    #example1 td {
        border: 1px solid #080400;
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

<div style="display: flex; justify-content: space-between; align-items: flex-start; border-top: 2px solid black; border-bottom: 2px solid black; padding: 2px 0;">


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

        </td>
    </table>

</div><br>

<h3>
    <div style="margin-left: 5px ;color: #a52a2a; "> SOLDE Clients</div>


    <div align="center" style="color: #c71585 ; ">
    </div>
</h3>

<h5 align="center"> <strong> DU </strong><?= $this->Time->format(
                                                $this->request->getQuery('date1'),
                                                'dd/MM/y'
                                            ); ?><strong> &nbsp;&nbsp;&nbsp;&nbsp; AU </strong><?= $this->Time->format(
                                                                                                    $this->request->getQuery('date2'),
                                                                                                    'dd/MM/y'
                                                                                                ); ?></h6>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table border="1">

                        <!-- <table class="table table-bordered table-striped table-bottomless"> -->

                        <thead>
                            <tr>
                                <th width="7%" align="center" style="text-align: center;background-color: #acbf60 ;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong> Code</strong></span>
                                </th>
                                <th align="center" width="8%" style="text-align: center;background-color: #acbf60;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Client</strong></span>
                                </th>
                                <th align="center" width="15%" style="text-align: center;background-color: #acbf60;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Solde Départ</strong></span>
                                </th>
                                <th align="center" width="10%" style="text-align: center;background-color: #acbf60;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Débit</strong></span>
                                </th>
                                <th align="center" width="5%" style="text-align: center;background-color: #acbf60;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Crédit</strong></span>
                                </th>
                                <th align="center" width="10%" style="text-align: center;background-color: #acbf60;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"> <strong>Solde</strong></span>
                                </th>

                            </tr>

                        </thead>


                        <tbody>
                            <?php $generel = 0;
                            $soldef = 0;
                            foreach ($data as $client_data) :

                                $soldef = ($client_data['soldedepart'] + $client_data['Debit']) -  $client_data['Credit'];
                                $generel +=  $soldef; ?>
                                <tr>
                                    <td><?= h($client_data['code']) ?></td>
                                    <td><?= h($client_data['client']) ?></td>
                                    <td><?php echo sprintf("%01.3f", abs($client_data['soldedepart'])); ?></td>
                                    <td><?php echo sprintf("%01.3f", abs($client_data['Debit'])); ?></td>
                                    <td><?php echo sprintf("%01.3f", abs($client_data['Credit'])); ?></td>
                                    <td><?php echo sprintf("%01.3f", abs($soldef)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tr>
                            <td align="center" colspan="5" style="background-color: #acbf60;"><strong>Total</strong></td>
                            <td align="center"><strong><?php echo number_format(abs($generel), 3, ',', ' '); ?></strong></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>