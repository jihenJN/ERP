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

Date: <?php
        date_default_timezone_set('Africa/Tunis');

        echo date('d/m/Y H:i:s');
        ?>
<br><br>
<div style="display:flex;margin-bottom:3px;" align="center">
</div>
<br>
<div style="width:100%" align="center">
    <h2>Listes des factures A Terme </h2>
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
        <td><strong>Depot:</strong>
            <?php
                echo $depots;
                
            ?>
        </td>
        
        <td style="margin-right:5% !important;"><strong>R:</strong>
           Reste
        </td>

    </tr>
</table>
<table id="example1" class="table" style="width: 100%;">
    <thead>
        <tr style='background-color:#6b8e23;'>
            <th hidden style="text-align: center;">id</th>
            <th width="10%" style="text-align: center;">N°</th>
            <th width="10%" style="text-align: center;">Date</th>
            <th width="16%" style="text-align: center;">Code</th>
            <th width="16%" style="text-align: center;">Raison Sociale</th>

            <th width="10%" hidden style="text-align: center;">Personnel</th>

            <th width="9%" style="text-align: center;">TotalHt</th>
            <th width="9%" style="text-align: center;">Totalttc</th>
            <th width="9%" style="text-align: center;">Reglée(s)</th>

            <!-- <th width="10%" style="text-align: center;">Commercial</th> -->
            <!-- <th width="10%" style="text-align: center;">Dépot</th> -->

            <!-- <th style="text-align: center;">Date</th> -->

        </tr>
    </thead>
    <tbody>
        <?php
        $totalht = 0;
        $totalttc = 0;
        foreach ($factureclients as $i => $facture) :
            // debug($facture);die;
            $query = 'SELECT SUM( lignefactureclients.qte*lignefactureclients.ml*lignefactureclients.punht - lignefactureclients.qte*lignefactureclients.ml*lignefactureclients.punht* COALESCE(lignefactureclients.remise, 0)/100 ) AS total_prixht, SUM(lignefactureclients.totalttc) AS total_ttc
                          
                                FROM lignefactureclients
                                JOIN articles ON lignefactureclients.article_id = articles.id
                                WHERE lignefactureclients.factureclient_id = ' . $facture['id'] . '';
            // AND sousfamille1s.sanscalcul = 0;';
            // JOIN sousfamille1s ON articles.sousfamille1_id = sousfamille1s.id


            $lignesde = $connection->execute($query)->fetchAll('assoc');

            $query = $connection->newQuery();
            $existsInLigneregelementclients = $query->select(['count' => $query->func()->count('*')])
                ->from('lignereglementclients')
                ->where(['factureclient_id' => $facture->id])
                ->execute()
                ->fetch('assoc')['count'];
        
            if ($existsInLigneregelementclients > 0) {
               
                $sumQuery = $connection->newQuery();
                $totalMontant = $sumQuery->select(['totalMontant' => $sumQuery->func()->sum('Montant')])
                    ->from('lignereglementclients')
                    ->where(['factureclient_id' => $facture->id])
                    ->execute()
                    ->fetch('assoc')['totalMontant'];
                    $resultat = '<strong>R </strong> ' . ($facture->totalttc - $totalMontant) ;
                } else {
                $resultat='Non';
            }
           
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
                    <?php
                    echo sprintf("%01.3f", ($facture->totalht))  ?>
                </td>
                <td align="center">
                    <?php echo sprintf("%01.3f", ($facture->totalttc)) ?>

                </td>
                <td align="center" style="height:2%!important; padding: 10px 0;">
                    <?php echo $resultat; ?>

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

            <td colspan="2" style="width: 100%;">
                <table style="width: 100%;">
                    <tr style='background-color:#6b8e23 ;'>
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