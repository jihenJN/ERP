<?php

use Cake\Datasource\ConnectionManager;

?>


<?php
$connection = ConnectionManager::get('default');
?>
<?php $this->layout = 'AdminLTE.print'; ?>
<?php

use Cake\ORM\TableRegistry;

?>


<?php
$connection = ConnectionManager::get('default');

$societeTable = TableRegistry::getTableLocator()->get('Societes');

$societe = $societeTable->find()->where('id=1')->first();

?>
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
<table style="width: 100%;">
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
            <br>

            Date: <?php
                    date_default_timezone_set('Africa/Tunis');

                    echo date('d/m/Y H:i:s');
                    ?>

            <div style="display:flex;margin-bottom:3px;" align="center">
            </div>
            <br>
            <div style="width:100%" align="center">
                <h2>Listes des BLs </h2>
            </div>
            <table style="border:0 !important;" width='60%'>
                <tr>
                    <td><strong>Du:</strong>
                        <?php if ($datedebut != '') {
                            echo
                            $this->Time->format($datedebut, 'dd/MM/y');
                        } ?>
                    </td>
                    <td><strong>Au:</strong>
                        <?php if ($datefin != '') {
                            echo $this->Time->format(
                                $datefin,
                                'dd/MM/y'
                            );
                        } ?>
                    </td>

                </tr>
                <tr>
                    <td><strong>Depot:</strong>
                    </td>
                    <td>
                    </td>

                </tr>
            </table>
            <table id="example1" class="table" style="width: 100%;">
                <thead>
                    <tr style='background-color:#cc7722;'>
                        <th hidden style="text-align: center;">id</th>
                        <th width="10%" style="text-align: center;">N° BL</th>
                        <th width="10%" style="text-align: center;">Date</th>
                        <th width="10%" style="text-align: center;">Code</th>

                        <th width="25%" style="text-align: center;">Raison Social</th>
                        <!-- <th width="10%" style="text-align: center;">Personnel</th> -->

                        <th width="9%" style="text-align: center;">TotalHt</th>
                        <th width="9%" style="text-align: center;">Totalttc</th>
                        <!-- <th width="10%" style="text-align: center;">Commercial</th> -->
                        <!-- <th width="10%" style="text-align: center;">Dépot</th> -->

                        <!-- <th style="text-align: center;">Date</th> -->

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalht = 0;
                    $totalttc = 0;
                    foreach ($bonlivraisons as $i => $facture) :
                        // debug($facture);die;
                        $query = 'SELECT SUM( lignebonlivraisons.qte*lignebonlivraisons.ml*lignebonlivraisons.punht - lignebonlivraisons.qte*lignebonlivraisons.ml*lignebonlivraisons.punht* COALESCE(lignebonlivraisons.remise, 0)/100 ) AS total_prixht, SUM(lignebonlivraisons.ttc) AS total_ttc
                          
                                FROM lignebonlivraisons
                                JOIN articles ON lignebonlivraisons.article_id = articles.id
                                WHERE lignebonlivraisons.bonlivraison_id = ' . $facture['id'] . '';
                        // AND sousfamille1s.sanscalcul = 0;';
                        // JOIN sousfamille1s ON articles.sousfamille1_id = sousfamille1s.id


                        $lignesde = $connection->execute($query)->fetchAll('assoc');
                        // debug($lignesde);
                        // $totalttc += $lignesde[0]['total_ttc'];
                        // $totalht += $lignesde[0]['total_prixht'];
                        $totalttc += $facture->totalttc;
                        $totalht += $facture->totalht;
                        if ($facture->user_id != null) {
                            $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $facture->user->personnel_id . ';')->fetchAll('assoc');

                            //  debug($bonlivraison->user->personnel_id);
                        }
                        if ($uu) {
                            $mm = $uu[0]['code'] . '' . $uu[0]['nom'];
                        } else {
                            $mm;
                        }
                    ?>
                        <tr>
                            <td hidden></td>
                            <td align="center" style="height:2%!important; padding: 10px 0;">
                                <?= h($facture['numero']) ?>
                            </td>
                            <td align="center" style="height:2%!important; padding: 10px 0;">
                                <?= h($this->Time->format($facture['date'], 'dd/MM/y')) ?>
                            </td>
                            <td align="center" style="height:2%!important; padding: 10px 0;">
                                <?= h($facture['client']['Code']) ?>
                            </td>
                            <td align="center" style="height:2%!important; padding: 10px 0;">
                                <?= h($facture['client']['Raison_Sociale']) ?>
                            </td>
                            <!-- <td align="center">
            <?php echo $mm; ?>
        </td> -->
                            <td align="center" style="height:2%!important; padding: 10px 0;">
                                <?= sprintf("%01.3f", ($facture->totalht)) ?>
                            </td>
                            <td align="center" style="height:2%!important; padding: 10px 0;">
                                <?= sprintf("%01.3f", ($facture->totalttc)) ?>
                            </td>
                            <td hidden align="center">
                                <?= h($facture['depot']['name']) ?>
                            </td>
                            <!-- <td class="actions text" align="center">
                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-file-excel-o'></i></button>", array('action' => 'view', $facture->id), array('escape' => false)); ?>
                                        <?php echo $this->Html->Link("<button class='btn btn-xs btn-warning'><i class='fa  fa-print'></i></button>", array('action' => 'imprime', $facture->id), array('escape' => false)); ?>
                                    </td> -->
                        </tr>
                    <?php endforeach; ?>
                    <tr class="total-row">
                        <td hidden></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <!-- <td></td> -->

                        <td colspan="2" style="width: 100%;">
                            <table style="width: 100%;">
                                <tr style='background-color:#cc7722;'>
                                    <th colspan="2" style="text-align: center;">Total Période :</th>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">
                                        <?php echo '<span class="center-text gray-background" style="width: 100%; display: inline-block;">' . sprintf("%01.3f", $totalht) . '</span>'; ?>
                                    </td>
                                    <td style="width: 50%;">
                                        <?php echo '<span class="center-text gray-background" style="width: 100%; display: inline-block;">' . sprintf("%01.3f", $totalttc) . '</span>'; ?>
                                    </td>

                                </tr>
                            </table>
                        </td>
                        <!-- <td></td> -->
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
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