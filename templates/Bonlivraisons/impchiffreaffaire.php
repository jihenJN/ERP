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
    @media print {
    @page {
        size: landscape;
    }
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
    <div style="margin-left: 5px ;color: #a52a2a; "><?php echo $societefirst->nom ?></div>


    <div align="center" style="color: #a52a2a; ">
    Chiffre d'affaire mensuelle par démarcheur</div>
</h3>

<h5 align="center"> <strong> DU </strong><?php echo $datedebut = date('Y-01-01') ?><strong> &nbsp;&nbsp;&nbsp;&nbsp; AU </strong><?php echo $datefin = date('Y-12-t');?></h6>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                <table class="table table-bordered table-striped table-bottomless" id="example1" border="1">
                    <thead>
                        <tr style="font-style: italic; font-weight: bold;">
                            <td> Démarcheur</td>
                            <?php foreach ($mois as $mm) : ?>
                                <td style="font-size: 16px;background-color: #4DAAA5; color: #000000; font-style: italic; font-weight: bold;" align="center"><?php echo $mm; ?></td>
                            <?php endforeach; ?>
                            <td style="font-style: italic; font-weight: bold;"> Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //debug($mois);

                        $total = 0;
                        $totalm = 0;
                        $totalparmois = 0;

                        foreach ($personnels as $personnel) :
                            $personnel_id = $personnel->id;
                            // debug($personnel_id);die;
                        ?>
                            <tr>
                                <td style="background-color: #a9ba9d ; color: #000000;"><?php echo $personnel->nom; ?></td>

                                <?php
                                foreach ($moiss as $mois_id => $mm) :

                                    $mois = $mm->num;
                                    $annee_en_cours = date('Y');
                                    //debug($annee_en_cours);die;
                                    $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                                    $date_fin = date('Y-12-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                                    //    debug($date_debut);
                                    // debug($date_fin);die;

                                    $listebl = $connection->execute('SELECT SUM(totalttc) AS sumtotalttc FROM bonlivraisons 
                                    INNER JOIN users ON bonlivraisons.user_id = users.id
                                    WHERE MONTH(bonlivraisons.date) = ' . $mois . ' 
                                    AND bonlivraisons.typebl = 1 
                                    AND users.personnel_id = ' . $personnel_id . '
                                    AND bonlivraisons.date BETWEEN \'' . $date_debut . '\' AND \'' . $date_fin . '\'')
                                        ->fetchAll('assoc');

                                    $total = $total + $listebl[0]['sumtotalttc'];
                                    // Afficher le total pour chaque mois
                                    foreach ($listebl as $row) {

                                        $totalm =  $totalm +  $row['sumtotalttc'];
                                        echo "<td>" . $row['sumtotalttc'] . "</td>";
                                    }



                                ?>
                                <?php endforeach;
                                ?>

                                <td> <?php echo  $totalm;
                                        ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tr>
                        <td></td>

                        <?php
                        foreach ($moiss as $mois_id => $mm) :

                            $mois = $mm->num;
                            $annee_en_cours = date('Y');
                            //debug($annee_en_cours);die;
                            $date_debut = date('Y-m-01 00:00:00', mktime(0, 0, 0, $mois, 1, $annee_en_cours));
                            $date_fin = date('Y-12-t 23:59:59', mktime(0, 0, 0, $mois, 1, $annee_en_cours));

                            //    debug($date_debut);
                            // debug($date_fin);die;

                            $listebl2 = $connection->execute('SELECT SUM(totalttc) AS sumtotalttc FROM bonlivraisons 
                                    INNER JOIN users ON bonlivraisons.user_id = users.id
                                    WHERE MONTH(bonlivraisons.date) = ' . $mois . ' 
                                    AND bonlivraisons.typebl = 1 
                                   
                                    AND bonlivraisons.date BETWEEN \'' . $date_debut . '\' AND \'' . $date_fin . '\'')
                                ->fetchAll('assoc');

                            $totalparmois = $listebl2[0]['sumtotalttc'];
                            // Afficher le total pour chaque mois
                            foreach ($listebl as $row) {


                                echo "<td><strong>" .  $totalparmois . "</strong></td>";
                            }



                        ?>
                        <?php endforeach; ?>

                        <td><strong><?php echo $total; ?></strong></td>


                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>