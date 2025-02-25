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
    <h2>Listes des offres de prix </h2>
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
<table id="example1" class="table">
                        <thead>
                        <tr style='background-color:#4DAAA5;'>
                                <th hidden style="text-align: center;">id</th>
                                <th width="10%" style="text-align: center;">N°</th>
                                <th width="10%" style="text-align: center;">Date</th>
                                <th width="16%" style="text-align: center;">client</th>

                                <th width="9%" style="text-align: center;">TotalHt</th>
                                <th width="9%" style="text-align: center;">Totalttc</th>
                                <th width="10%" style="text-align: center;">Commercial</th>
                                <th width="10%" style="text-align: center;">Dépot</th>

                                <!-- <th style="text-align: center;">Date</th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalttc = 0;
                            $totalht = 0;
                            foreach ($offprix1 as $i => $data) :
                                // debug($data);

                                // $query = 'SELECT SUM(lignebonlivraisons.prixht -lignebonlivraisons.prixht*COALESCE(lignebonlivraisons.remise, 0)/100 ) AS total_prixht, SUM(lignebonlivraisons.ttc) AS total_ttc
                                // FROM lignebonlivraisons
                                // JOIN articles ON lignebonlivraisons.article_id = articles.id
                                // JOIN sousfamille1s ON articles.sousfamille1_id = sousfamille1s.id
                                // WHERE lignebonlivraisons.bonlivraison_id = ' . $data['id'] . '
                                //   AND sousfamille1s.sanscalcul = 0;';

                                $query = 'SELECT SUM(lignebonlivraisons.qte*lignebonlivraisons.ml*lignebonlivraisons.punht -lignebonlivraisons.qte*lignebonlivraisons.ml*lignebonlivraisons.punht*COALESCE(lignebonlivraisons.remise, 0)/100 ) AS total_prixht, SUM(lignebonlivraisons.ttc) AS total_ttc
                                
                                FROM lignebonlivraisons
                                JOIN articles ON lignebonlivraisons.article_id = articles.id
                                JOIN sousfamille1s ON articles.sousfamille1_id = sousfamille1s.id
                                WHERE lignebonlivraisons.bonlivraison_id = ' . $data['id'] . '
                                  AND sousfamille1s.sanscalcul = 0;';

                                       $lignesde = $connection->execute($query)->fetchAll('assoc');
                                      // debug($lignesde);
                                $totalttc += $lignesde[0]['total_ttc'];
                                $totalht += $lignesde[0]['total_prixht'];
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
                                        <?= h($data['client']['Raison_Sociale']) ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                       echo sprintf("%01.3f",($lignesde[0]['total_prixht']))  ?>
                                    </td>
                                    <td align="center">
                                        <?php  echo sprintf("%01.3f",($lignesde[0]['total_ttc'])) ?>

                                    </td>
                                    <td align="center">
                                        <?= h($data['commercial']['name']) ?>
                                    </td>
                                    <td align="center">
                                        <?= h($data['depot']['name']) ?>
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="2" style="width: 100%;">
                                    <table style="width: 100%;">
                                        <tr style='background-color:#4DAAA5;'>
                                            <th colspan="2" style="text-align: center;">Total Période :</th>
                                        </tr>
                                         <tr>
                                            <td style="width: 50%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background" style="width: 100%;"
                                                    value="<?php echo sprintf("%01.3f", $totalht) ?>" disabled>
                                            </td>
                                            <td style="width: 50%;">
                                                <input type="text" name="additional_input"
                                                    class="center-text gray-background" style="width: 100%;"
                                                    value="<?php echo sprintf("%01.3f",$totalttc)  ?>" disabled>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td></td>

                                <!-- <td></td> -->
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