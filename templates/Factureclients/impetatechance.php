<?php $this->layout = 'AdminLTE.print'; ?>
<?php

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
                    <?php echo $societefirst->adresseEntete; ?><br>
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
</div>
<br>

<h3>
    <div style="margin-left: 5px ;color: #a52a2a; ">  <?php echo $societefirst->nom; ?></div>


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
                    <table border="1" class="table table-bordered table-striped table-bottomless">

                        <!-- <table class="table table-bordered table-striped table-bottomless"> -->

                        <thead>
                            <tr>
                                <th width="7%" align="center" style="text-align: center;background-color: #b768a2 ;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Echéance</strong></span>
                                </th>
                                <th align="center" width="8%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Reg N°</strong></span>
                                </th>
                                <th align="center" width="15%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Client</strong></span>
                                </th>
                                <th align="center" width="10%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Date</strong></span>
                                </th>
                                <th align="center" width="5%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Banque</strong></span>
                                </th>
                                <th align="center" width="10%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"> <strong>Nature</strong></span>
                                </th>
                                <th align="center" width="8%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>N°</strong></span>
                                </th>
                                <th align="center" width="12%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Montant</strong></span>
                                </th>
                                <th align="center" width="12%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Ech.AU</strong></span>
                                </th>
                                <!-- <th align="center" width="3%" style="text-align: center;background-color: #b768a2;">
                                   <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Reg.com</strong></span>
                                </th> -->
                                <th align="center" hidden width="9%" style="text-align: center;background-color: #b768a2;">
                                    <span style="  color: #000000 ; font-style: italic;font-weight: bold;"><strong>Compte</strong></span>
                                </th>
                            </tr>

                        </thead>



                        <tbody>
                            <?php

                           
                            if (!empty($tablignelachats)) {
                                $runningTotal = 0; 

                                usort($tablignelachats, function ($a, $b) {
                                    return strtotime($b['echance']) <=> strtotime($a['echance']);
                                });

                                foreach ($tablignelachats as $tab) :
                                    $runningTotal += $tab['Montantreg'];

                             
                                    $connection = ConnectionManager::get('default');


                            ?>
                                    <tr>






                                        <td align="center">
                                            <?= $this->Time->format($tab['echance'], 'dd/MM/y'); ?> <br>

                                        </td>

                                        <td align="center">

                                            <?php
                                            echo  $tab['numero'];
                                            ?>

                                        </td>
                                        <td align="center">
                                            <?php
                                            echo  $tab['client'];
                                            ?>

                                        </td>
                                        <td align="center">
                                            <?php
                                            echo  $tab['date'];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php echo  $tab['banque'];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php echo  $tab['paiement']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo  $tab['num']; ?>
                                        </td>
                                        <td align="center">
                                            <?php echo  $tab['Montantreg']; ?>
                                        </td>

                                      
                                        <td align="center">
                                        <?php echo  $runningTotal;  ?>
                                        </td>


                                        <td align="center" hidden>
                                            <?php echo  $tab['compte']; ?>
                                        </td>



                                    </tr>
                            <?php endforeach;
                            }
                            ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>