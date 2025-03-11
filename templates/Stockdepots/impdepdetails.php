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
<table>
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
                            <?php echo $societefirst->adresseEntete; ?><br>
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
                <div style="margin-left: 5px ;color: #a52a2a; "> </div>


                <div align="center" style="color: #c71585 ; ">
                    ETAT DE DETAIL de STOCK</div>
            </h3>

            <h5 align="center"> <strong> DU </strong><?= $this->Time->format(
                                                            $this->request->getQuery('datedebut'),
                                                            'dd/MM/y'
                                                        ); ?><strong> &nbsp;&nbsp;&nbsp;&nbsp; AU </strong><?= $this->Time->format(
                                                                                                                $this->request->getQuery('datefin'),
                                                                                                                'dd/MM/y'
                                                                                                            ); ?></h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped table-bottomless" width="100%" id="example1" border="1">
                                <!-- <table class="table table-bordered table-striped table-bottomless" id="example1" border="1"> -->
                                <thead>
                                    <tr>
                                        <td style="font-size: 16px;"><strong>Depot</strong></td>
                                        <?php foreach ($depotalls as $depot) : ?>
                                            <td style="font-size: 16px;" colspan="7"><strong><?php echo $depot['name']; ?></strong></td>
                                        <?php endforeach; ?>
                                    </tr>

                                    <tr style="background-color: #ffc0cb; color: #000000; font-style: italic; font-weight: bold;">
                                        <td style="font-size: 16px;" align="center" width="8%">Marque</td>
                                        <!-- <td style="font-size: 16px;" align="center"  width="8%">Famille</td> -->
                                        <td style="font-size: 16px;" align="center" width="10%">Code</td>
                                        <td style="font-size: 16px;" align="center" width="32%">Désignation</td>
                                        <td style="font-size: 16px;" align="center" width="6%">Unité</td>
                                        <td style="font-size: 16px;" width="10%" align="center">Qte AU: <strong><?php echo $date_formattee; ?></strong></td>
                                        <td style="font-size: 16px;" width="9%" align="center">Qte Entrée</td>
                                        <td style="font-size: 16px;" width="9%" align="center">Qte Sortie</td>
                                        <td style="font-size: 16px;" width="9%" align="center">Qte en Stock</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $previousFamilleId = null;
                                    $previousSousFamilleId = null;

                                    foreach ($marquess as $marq) :


                                        $connection = ConnectionManager::get('default');
                                        $famille = "SELECT * FROM familles WHERE familles.marque_id = " . $marq->id;
                                        $listfamilles = $connection->execute($famille)->fetchAll('assoc');
                                        $sf = count($listfamilles);
                                        $familleRowSpan = 0;
                                        $totalstockdatefam = 0;
                                        $totalstockentrefam = 0;
                                        $totalstocksortiefam = 0;
                                        $totalFamillefam = 0;
                                        foreach ($listfamilles as $fami) {
                                            $articlelist = "SELECT * FROM articles WHERE articles.famille_id = " . $fami['id'];
                                            $listart = $connection->execute($articlelist)->fetchAll('assoc');
                                            $familleRowSpan += count($listart);
                                        }
                                        $firstFamilleRow = true;


                                        foreach ($listfamilles as $fami) :
                                            $articlelist = "SELECT * FROM articles WHERE articles.famille_id = " . $fami['id'];
                                            $listart = $connection->execute($articlelist)->fetchAll('assoc');

                                            $sousfamilleRowSpan = count($listart);
                                            $firstSousFamilleRow = true;
                                            $sommeqtedate = 0;
                                            $totalstockdate = 0;
                                            $totalstockentre = 0;
                                            $totalstocksortie = 0;
                                            $totalFamille = 0;
                                            foreach ($listart as $art) :
                                                if (isset($art['unitearticle_id']) && !empty($art['unitearticle_id'])) {
                                                    $unites = "SELECT name FROM unitearticles WHERE unitearticles.id = " . $art['unitearticle_id'];
                                                    $unitename = $connection->execute($unites)->fetchAll('assoc');
                                                    $name = $unitename[0]['name'];
                                                } else {
                                                    $name = '';
                                                }

                                    ?>

                                                <?php

                                                date_default_timezone_set('Africa/Tunis');

                                                $datef = date('Y-m-d H:i:s');


                                                $connection = ConnectionManager::get('default');
                                                $st = $connection->execute("select stockbassem(" . $art['id'] . ",'" . $datef . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                if (!empty($st)) {

                                                    $totalFamille += $st[0]['v'];
                                                    $totalGeneral += $st[0]['v'];

                                                    $ttfam =  $totalFamille - $ss;

                                                    $qtestock =  $st[0]['v'];
                                                    $total =  $st[0]['v'];
                                                    $final =  $final + $total;
                                                } else {
                                                    $qtestock = 0;
                                                    $total = 0;
                                                    $final = 0;
                                                    $ttfam = 0;
                                                }


                                                date_default_timezone_set('Africa/Tunis');

                                                $dated = $this->request->getQuery('datedebut');

                                                $date = new DateTime($dated, new DateTimeZone('Africa/Tunis'));

                                                $date->modify('-1 day');

                                                $date_precedente = $date->format('Y-m-d H:i:s');

                                                $date_dd = date('Y-m-d', strtotime($datedebut));

                                                $connection = ConnectionManager::get('default');
                                                $stockdate = $connection->execute("select stockbassem(" . $art['id'] . ",'" . $date_precedente . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                if (!empty($stockdate)) {
                                                    $qtestockdate =  $st[0]['v'];
                                                    // debug($qtestockdate);
                                                    $totalstockdate = $totalstockdate +  $qtestockdate;
                                                } else {
                                                    $qtestockdate = 0;
                                                    $totalstockdate = 0;
                                                }
                                                ////////////////////////stock entre /////////////////////////////

                                                $connection = ConnectionManager::get('default');
                                                $date_seulement = date('Y-m-d', strtotime($datedebut));
                                                $date_debut = $date_seulement . ' 00:00:00';
                                                // debug($date_debut);

                                                $date_seulementfin = date('Y-m-d', strtotime($datefin));
                                                $date_fin = $date_seulementfin . ' 23:59:59';
                                                // debug($date_fin);

                                                $stockentree = $connection->execute("select stockentre(" . $art['id'] . ",'" . $date_debut . "','" . $date_fin . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                if (!empty($stockentree)) {
                                                    $qtestockentre =  $stockentree[0]['v'];
                                                    // debug($qtestockentre);
                                                    $totalstockentre = $totalstockentre +  $qtestockentre;
                                                } else {
                                                    $qtestockentre = 0;
                                                    $totalstockentre = 0;
                                                }
                                                ////////////////////////stock sortie /////////////////////////////
                                                $stocksortie = $connection->execute("select stocksortie(" . $art['id'] . ",'" . $date_debut . "','" . $date_fin . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                                if (!empty($stocksortie)) {
                                                    $qtestocksortie =  $stocksortie[0]['v'];
                                                    //  debug($qtestockentre);
                                                    $totalstocksortie = $totalstocksortie +  $qtestocksortie;
                                                } else {
                                                    $qtestocksortie = 0;
                                                    $totalstocksortie = 0;
                                                }

                                                ?>
                                                <tr>
                                                    <?php if ($firstFamilleRow) : ?>
                                                        <td rowspan="<?php echo $familleRowSpan + $sf + 1; ?>" style="font-size: 16px; text-align: center; writing-mode: vertical-lr; transform: rotate(180deg);">

                                                            <?php echo $marq->name; ?>
                                                        </td>
                                                    <?php $firstFamilleRow = false;
                                                    endif; ?>

                                                    <?php if ($firstSousFamilleRow) : ?>
                                                        <td hidden rowspan="<?php echo $sousfamilleRowSpan + 1; ?>" style="font-size: 16px; text-align: center; writing-mode: vertical-lr; transform: rotate(180deg);">
                                                            <?php echo $fami['Nom']; ?>
                                                        </td>
                                                    <?php $firstSousFamilleRow = false;
                                                    endif; ?>

                                                    <td style="font-size: 16px;"> <?php echo $art['Code']; ?> </td>
                                                    <td style="font-size: 16px;"> <?php echo $art['Dsignation']; ?> </td>
                                                    <td style="font-size: 16px;"> <?php echo $name; ?> </td>
                                                    <td align="center" style="font-size: 16px; font-weight: bold;"> <?php echo $qtestockdate; ?> </td>
                                                    <td align="center" style="font-size: 16px; font-weight: bold;"> <?php echo $qtestockentre; ?> </td>
                                                    <td align="center" style="font-size: 16px; font-weight: bold;"> <?php echo $qtestocksortie; ?> </td>
                                                    <td align="center" style="font-size: 16px; font-weight: bold;">
                                                        <?php echo $qtestock; ?>

                                                    </td>
                                                </tr>

                                            <?php endforeach;
                                            $totalstocksortiefam += $totalstocksortie;
                                            $totalstockentrefam += $totalstockentre;
                                            $totalstockdatefam += $totalstockdate;
                                            $totalFamillefam += $totalFamille;

                                            ?>
                                            <tr style="background-color:#D8FFD8;font-weight: bold;font-size: 16px; ">
                                                <td colspan="3"><strong><?php echo $fami['Nom'] . ' ' . '====>'; ?></strong></td>
                                                <!-- <td>Piece</td> -->
                                                <td align="center" style="font-size: 16px;"><?php echo $totalstockdate ?></td>
                                                <td align="center" style="font-size: 16px;"><?php echo $totalstockentre ?></td>
                                                <td align="center" style="font-size: 16px;"><?php echo $totalstocksortie ?></td>
                                                <td align="center" style="font-size: 16px;"><?php echo $totalFamille; ?></td>

                                            </tr>
                                        <?php endforeach;
                                        if ($sf != 0) {

                                        ?>
                                            <tr style="background-color:#FFC0CB;font-weight: bold;">

                                                <td colspan="3"><strong><?php echo $marq->name . ' ' . '====>'; ?></strong></td>
                                                <!-- <td>Piece</td> -->
                                                <td align="center" style="font-size: 16px;"><?php echo $totalstockdatefam ?></td>
                                                <td align="center" style="font-size: 16px;"><?php echo $totalstockentrefam ?></td>
                                                <td align="center" style="font-size: 16px;"><?php echo $totalstocksortiefam ?></td>
                                                <td align="center" style="font-size: 16px;"><?php echo $totalFamillefam; ?></td>

                                            </tr>
                                    <?php
                                        }
                                    endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>