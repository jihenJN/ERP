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


<br>
<style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style>

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
            <!-- <div>
                <?php
                echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); ?>

            </div> -->
        </td>


        </td>
    </table>
</div>

<br><br>
<h3 style="margin-left: 5px ;">
    Chiffres d'affaire
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="ls-editable-table table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="" width="99%">
                        <thead style='background-color: #3c8dbc; color: white;'>
                            <tr>
                                <th>Article</th>
                                <th width="19%" align="center">Quantité</th>
                                <th width="25%" align="center">CA HT</th>
                                <th width="25%" align="center">CA TTC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tabs as $i => $art) : ?>
                                <tr style="font-size: 14px;">
                                    <td align="center"><?php echo $art['nom']; ?></td>
                                    <td align="center"><?php echo $art['qte']; ?></td>
                                    <td align="center"><?php echo $art['prixht']; ?></td>
                                    <td align="center"><?php echo $art['ttc']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tr style="font-size: 14px;">
                            <td colspan="3" align="center" style='background-color: #3c8dbc; color: white;'><strong>Total Qte</strong></td>

                            <td align="center"><strong><?php echo $totalqte; ?></strong></td>
                        </tr>
                        <tr style="font-size: 14px;">
                            <td colspan="3" align="center" style='background-color: #3c8dbc; color: white;'><strong>Total HT</strong></td>

                            <td align="center"><strong><?php echo $totalht; ?></strong></td>
                        </tr>
                        <tr style="font-size: 14px;">
                            <td colspan="3" align="center" style='background-color: #3c8dbc; color: white;'><strong>Total TTC</strong></td>

                            <td align="center"><strong><?php echo $totalttc; ?></strong></td>
                        </tr>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>