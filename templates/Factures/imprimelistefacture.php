<?php

use Cake\Datasource\ConnectionManager;

?>


<?php
$connection = ConnectionManager::get('default');
?>
<?php $this->layout = 'AdminLTE.print'; ?>

<style>
    body {
        font-size: 12px;
    }

    table {
        font-size: 12px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="display:flex;">
    <table border="1" cellpadding="0" cellspacing="0" style="border: 3px solid black; border-left:none;border-right:none;border-collapse: collapse; width: 100%; ">


        <td align="center" style="width: 25%;border: none;">
            <div>
                <?php
                echo $this->Html->image('logo-sirep.png', ['alt' => 'CakePHP', 'height' => '80px', 'width' => '100%']); ?>
            </div>
        </td>
        <td align="center" style="width: 50%;border: none;"><strong>
                USINE : Route de Gabes Km 86 - BP 61 Skira 3050 - Sfax<br>
                Tél : 79 700 235 &nbsp;&nbsp;&nbsp;Fax : 79 701 006<br>
                E-mail : contact@sirep-prefa.com.tn<br>
                S.web : www.sirep-prefa.com.tn</strong>
        </td>
        <td align="center" style="width: 25%;border: none;">
            <div>
                <?php
                echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); ?>

            </div>
        </td>

        </td>
    </table>
</div>
<br>

Date: <?php
        date_default_timezone_set('Africa/Tunis');

        echo date('d/m/Y H:i:s');
        ?>
<br><br>
<div style="display:flex;margin-bottom:3px;" align="center">
</div>
<br>
<div style="width:100%" align="center">
    <h2>Listes des factures </h2>
</div>
<table style="border:0 !important;" width='60%'>
    <tr>
        <td><strong>Du:</strong>
            <?php if ($historiquede != '') {
                echo
                $this->Time->format($historiquede, 'dd/MM/y');
            } ?>
        </td>
        <td><strong>Au:</strong>
            <?php if ($au != '') {
                echo $this->Time->format(
                    $au,
                    'dd/MM/y'
                );
            } ?>
        </td>

    </tr>
</table>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr style='background-color:#d6c38d;'>
            <th hidden style="text-align: center;">id</th>
            <th style="text-align: center;width:6%">N°</th>
            <th style="text-align: center;width:6%">Date</th>
            <th style="text-align: center;width:10%">Fournisseurs</th>

            <th style="text-align: center;width:10%">TotalHt</th>
            <th style="text-align: center;width:10%">Totalttc</th>
            <th style="text-align: center;width:8%">Service</th>
            <th style="text-align: center;width:8%">Machine</th>
            <!-- <th style="text-align: center;">Date</th> -->

        </tr>
    </thead>
    <tbody>
        <?php
        $totalttc = 0;
        $totalht = 0;
        foreach ($factures as $i => $data) :
            $totalttc += $data['ttc'];
            $totalht += $data['ht'];
        ?>
            <tr>
                <td hidden></td>
                <td align="center">
                    <?= h($data['numero']) ?>
                </td>
                <td align="center">
                    <?= h($this->Time->format($data['date'], 'dd/MM/y')) ?>
                </td>
                <td align="center">
                    <?= h($data['fournisseur']['name']) ?>
                </td>
                <td style="text-align: right">
                    <?php echo sprintf("%01.3f", $data['ht']) ?>
                </td>
                <td style="text-align: right">
                    <?php echo sprintf("%01.3f", $data['ttc']) ?>
                </td>
                <td align="center">
                    <?= h($data['service']['name']) ?>
                </td>
                <td align="center">
                    <?= h($data['machine']['name']) ?>
                </td>

                <!-- <td class="actions text" align="center">
                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-file-excel-o'></i></button>", array('action' => 'view', $data->id), array('escape' => false)); ?>
                                        <?php echo $this->Html->Link("<button class='btn btn-xs btn-warning'><i class='fa  fa-print'></i></button>", array('action' => 'imprimeofprix', $data->id), array('escape' => false)); ?>
                                    </td> -->
            </tr>
        <?php
        endforeach;
        ?>
        <tr class="total-row">
            <td hidden></td>
            <td colspan="3"></td>

            <td colspan="2" style="width: 100%;">
                <table style="width: 100%;">
                    <tr style='background-color:#d6c38d;'>
                        <th colspan="2" style="text-align: center;">Total Période :</th>
                    </tr>
                    <tr style='background-color:#d6c38d;'>
                        <th width="7%" style="text-align: center;">HT</th>
                        <th width="7%" style="text-align: center;">TTC </th>
                    </tr>
                    <tr>
                        <td style="width: 50%;text-align: right">
                            <?php echo sprintf("%01.3f", $totalht)  ?>
                        </td>
                        <td style="width: 50%;text-align: right">
                            <?php echo sprintf("%01.3f", $totalttc)  ?>
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
    </tbody>
</table>
<style>
    #example1 {
        border: 1px solid black;
        border-collapse: collapse;
    }

    #example1 th,
    #example1 td {
        border: 1px solid black;
    }
</style>
<!-- <style>
    /* Style du bouton */
    .excel-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        /* Couleur de fond du bouton (vert ici) */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    /* Style de l'icône */
    .excel-icon {
        margin-right: 8px;
        /* Marge à droite de l'icône pour l'espacement */
    }

    table {
        width: 100%;
        /* Make the table take up the full width */
        table-layout: fixed;
        /* Fix the table layout */
    }

    th,
    td {
        width: 175px;
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
</style> -->