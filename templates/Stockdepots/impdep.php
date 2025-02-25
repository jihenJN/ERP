<?php $this->layout = 'AdminLTE.print'; ?>
<?php


use Cake\ORM\TableRegistry;

?>


<?php

$societeTable = TableRegistry::getTableLocator()->get('Societes');

$societe = $societeTable->find()->where('id=1')->first();

?><?php

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

        </td>
    </table>
</div>
<br>

<h3>
    <div style="margin-left: 5px ;color: #a52a2a; "> <?php echo $societe->nom ?></div>


    <div align="center" style="color: #8b008b; ">
        ETAT DE STOCK GLOBAL</div>
</h3>

<h5 align="center">
    <h5 align="center"> <strong> DU </strong><?= $this->Time->format(
                                                    $this->request->getQuery('datedebut'),
                                                    'dd/MM/y'
                                                ); ?><strong> &nbsp;&nbsp;&nbsp;&nbsp; AU </strong><?= $this->Time->format(
                                                                                                                $this->request->getQuery('datefin'),
                                                                                                                'dd/MM/y'
                                                                                                            ); ?></h5>
    <!-- <strong> DU </strong>01/01/2022 <strong> &nbsp;&nbsp;&nbsp;&nbsp; AU </strong>11/03/2024</h6> -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-bottomless" id="example1" border="1">
                        <thead>
                            <tr>
                                <td style="font-size: 16px;"><strong>Depot</strong></td>
                                <?php foreach ($depotalls as $depot) : ?>
                                    <td style="font-size: 16px;" colspan="5"><strong><?php echo $depot['name']; ?></strong></td>
                                <?php endforeach; ?>
                            </tr>
                            <tr style=" background-color: #a9a9a9; color: #000000 ; font-style: italic;font-weight: bold;">


                                <td style="font-size:  18px; " colspan="2" align="center">Article</td>

                                <td style="font-size:  18px; " colspan="4" align="center">Quantité</td>
                            </tr>
                            <tr style="background-color: #add8e6; color: #0000ff; font-style: italic; font-weight: bold;">
                                <td style="font-size: 16px;" align="center" width="8%">Marque</td>
                                <!-- <td style="font-size: 16px;" align="center"  width="8%">Famille</td> -->
                                <td style="font-size: 16px;" align="center" width="10%">Code</td>
                                <td style="font-size: 16px;" align="center" width="32%">Désignation</td>
                                <td style="font-size:  18px; " width="14%" align="center">Stock</td>

                                <td style="font-size:  18px; " width="14%" align="center">Réserver</td>
                                <td style="font-size:  18px; " width="12%" align="center">Total</td>
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
                                $totalstock1 = 0;
                                $totalreser1 = 0;
                                $totalfin1 = 0;
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
                                    $totalstockfam = 0;
                                    $totalreserfam = 0;
                                    $totalfinfam = 0;
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
                                        $date1 = date("Y") . '-01-01' . date(" 00:00:00");

                                        // debug($depotid);die;

                                        $connection = ConnectionManager::get('default');
                                        $st = $connection->execute("select stockbassem(" . $art['id'] . ",'" . $datef . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                                        if (!empty($st)) {

                                            $totalFamille += $st[0]['v'];
                                            $totalGeneral += $st[0]['v'];

                                            $ttfam =  $totalFamille - $ss;

                                            $qtestock =  $st[0]['v'];
                                            $total =  $st[0]['v'];
                                            $final =  $final + $total;
                                            $totalstockfam +=  $total;
                                        } else {
                                            $qtestock = 0;
                                            $total = 0;
                                            $final = 0;
                                            $ttfam = 0;
                                            $totalstockfam = 0;
                                        }


                                        /* reserver*/

                                        $commander = "SELECT SUM(ligne.qte) AS total_qte FROM lignecommandes AS ligne
                                            INNER JOIN commandes AS bc ON bc.id = ligne.commande_id
                                            WHERE ligne.article_id = " . $art['id'] . "
                                            AND bc.depot_id = " . $depotid . "
                                            AND bc.bonlivraison_id = 0";
                                        $result = $connection->execute($commander)->fetchAll('assoc');
                                        if ($result[0]['total_qte'] != 0) {
                                            $qtecom = $result[0]['total_qte'];

                                            $totalreserfam += $qtecom;
                                        } else {
                                            $qtecom = 0;
                                            $totalreserfam = 0;
                                        }
                                        $totalfinfam = $totalstockfam - $totalreserfam;

                                        /*            */


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

                                            <td align="center" style="font-size: 16px; font-weight: bold;">
                                                <a href='/ERP/Articles/indexspec?date1=<?php echo @$date1; ?>&date2=<?php echo @$datef; ?>&depot_id=<?php echo @$depotid; ?>&article_id=<?php echo $art['id']; ?>' target="_blank">
                                                    <?php echo $qtestock; ?>
                                                </a>
                                            </td>

                                            <td align="center" style="font-size: 16px; font-weight: bold;">
                                                <?php echo $qtecom;
                                                ?>

                                            </td>
                                            <td align="center" style="font-size: 16px; font-weight: bold;">
                                                <?php echo ($qtestock - $qtecom);
                                                ?>

                                            </td>
                                        </tr>

                                    <?php endforeach;

                                    $totalstock1 += $totalstockfam;
                                    $totalreser1 += $totalreserfam;
                                    $totalfin1 += $totalfinfam;


                                    ?>
                                    <tr style="background-color:#D8FFD8;font-weight: bold;font-size: 16px; ">
                                        <td colspan="2"><strong><?php echo $fami['Nom'] . ' ' . '====>'; ?></strong></td>
                                        <!-- <td>Piece</td> -->
                                        <td align="center" style="font-size: 16px;"><?php echo $totalstockfam ?></td>
                                        <td align="center" style="font-size: 16px;"><?php echo $totalreserfam; ?></td>
                                        <td align="center" style="font-size: 16px;"><?php echo $totalfinfam; ?></td>


                                    </tr>
                                <?php endforeach;
                                if ($sf != 0) {

                                ?>
                                    <tr style="background-color:#FFC0CB;font-weight: bold;">

                                        <td colspan="2"><strong><?php echo $marq->name . ' ' . '====>'; ?></strong></td>
                                        <!-- <td>Piece</td> -->
                                        <td align="center" style="font-size: 16px;"><?php echo $totalstock1 ?></td>
                                        <td align="center" style="font-size: 16px;"><?php echo $totalreser1; ?></td>
                                        <td align="center" style="font-size: 16px;"><?php echo $totalfin1; ?></td>


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