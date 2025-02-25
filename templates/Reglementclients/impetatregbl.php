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

<?php
$connection = ConnectionManager::get('default');
?>
<?php $this->layout = 'AdminLTE.print'; ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>

<table style="border: 0 !important; border-collapse: collapse;">
    <thead>
        <tr style="border: none !important;">
            <td style="border: none !important;">


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
            </td>

            <br>

        </tr>
    </thead>

    <tr style="border: none !important;">
        <td style="border: none !important;">
            Date: <?php
                    date_default_timezone_set('Africa/Tunis');

                    echo date('d/m/Y H:i:s');
                    ?>

            <div align="center">
                <h3> Etat Réglement BL</h3>

            </div>
            <style>
                body {
                    font-size: 12px;
                }

                table {
                    font-size: 12px;
                }

                table {
                    border-collapse: collapse;
                    width: 100%;
                }

                th,
                td {
                    border: 1px solid black;
                    padding: 8px;
                }

                th {

                    text-align: center;
                }

                .total-row th {
                    background-color: #96c8a2;
                }

                .total-row {
                    border: none;
                    /* Ensure no border on the row */
                }

                .total-row td {
                    border: none;
                    /* Ensure no border on the cells */
                }
            </style>

            <br>

            <div>
                <div class="panel-body">
                    <div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr style='background-color:#5f9ea0;'>

                                    <th style="text-align: center;width:8%">Date</th>
                                    <th style="text-align: center;width:8%">Numéro</th>
                                    <th style="text-align: center;width:8%">Code</th>
                                    <th style="text-align: center;width:15%">Raison Social</th>
                                    <th style="text-align: center;width:10%">Total TTC</th>
                                    <th style="text-align: center;width:10%">Montant Régler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalfinal = 0;
                                $totalDebits = 0;
                                $totalCredits = 0;
                                $solde = 0;
                                $totalss = 0;
                                usort($clientData, function ($a, $b) {
                                    return strtotime($b['date']) - strtotime($a['date']);
                                });


                                foreach ($clientData as $i => $data) : ?>
                                    <tr style="background-color:#97D7D7;">

                                        <td align="center">
                                            <?php echo $this->Time->format($data['date'], 'dd/MM/y'); ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<span style="color:#4682b4; font-weight:bold;">' . h($data['bl']);
                                            if (!empty($data['fac'])) {
                                                echo '  <span style="color:#000000;"> ==></span> <span style="color:#BF6363; font-weight:bold;">FAC: ' . h($data['fac']) . '</span>';
                                            } else {
                                                echo ' ';
                                            }
                                            echo '</span>';
                                            ?>


                                        </td>

                                        <td align="center">
                                            <?php echo h($data['code']); ?>
                                        </td>
                                        <td align="center">
                                            <?php echo h($data['name']); ?>
                                        </td>
                                        <td align="center">
                                            <?php echo h($data['totalttc']); ?>
                                        </td>
                                        <td align="center">
                                            <strong><?php echo h($data['Montant_Regler']); ?></strong>
                                        </td>



                                    </tr>
                                    <?php
                                    $lignereg = $connection->execute('SELECT * FROM lignereglementclients WHERE bonlivraison_id=' . $data['idbl'] . ';')->fetchAll('assoc');

                                    foreach ($lignereg as &$ligner) {
                                        $ligner['source'] = 'lignereg';
                                    }

                                    if ($data['factureclient_id'] != 0) {
                                        $ligneregFacture = $connection->execute('SELECT * FROM lignereglementclients WHERE factureclient_id=' . $data['factureclient_id'] . ';')->fetchAll('assoc');

                                        foreach ($ligneregFacture as &$lignerFacture) {
                                            $lignerFacture['source'] = 'ligneregFacture';
                                        }

                                        // Fusion des règlements BL et Facture
                                        $lignereg = array_merge($lignereg, $ligneregFacture);
                                    }

                                    if (!empty($lignereg)) :
                                    ?>
                                        <tr>
                                            <td colspan="6">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr style='background-color:#b0c4de;'>
                                                            <th style="text-align: center;">Type Réglement</th>
                                                            <th style="text-align: center;">Mode de Paiement</th>
                                                            <th style="text-align: center;">Numéro</th>
                                                            <th style="text-align: center;">Échéance</th>
                                                            <th style="text-align: center;">Montant</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $totalReglementGlobal = 0;

                                                        // Parcourir tous les règlements et afficher chaque pièce avec son montant
                                                        foreach ($lignereg as $ligner) {
                                                            $pieces = $connection->execute(
                                                                'SELECT piece.*, paiements.name FROM piecereglementclients AS piece 
                                                                       JOIN paiements ON piece.paiement_id = paiements.id WHERE piece.reglementclient_id = :reglementclient_id',
                                                                ['reglementclient_id' => $ligner['reglementclient_id']]
                                                            )->fetchAll('assoc');

                                                            $typeReglement = ($ligner['source'] == 'ligneregFacture') ? 'Règlement Facture' : 'Règlement Bon de Livraison';

                                                            foreach ($pieces as $piece) {
                                                                // Accumuler le total global
                                                                $totalReglementGlobal += $piece['montant'];
                                                        ?>
                                                                <tr style='background-color:<?php echo ($typeReglement == 'Règlement Facture') ? "#EAC6C6" : "#b0c4de"; ?>;'>
                                                                    <td style=" font-style: italic;"><?php echo h($typeReglement); ?></td>
                                                                    <td><?php echo h($piece['name']); ?></td>
                                                                    <td><?php echo h($piece['numero']); ?></td>
                                                                    <td><?php echo h($piece['echeance']); ?></td>
                                                                    <td><?php echo sprintf("%01.3f", $piece['montant']); ?></td>
                                                                </tr>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        <!-- Afficher le total général à la fin -->
                                                        <tr>
                                                            <td colspan="4" style="text-align: center; font-weight: bold;background-color:#b0c4de;">Total Règlement Global :</td>
                                                            <td style="text-align: center; font-weight: bold;background-color:#97D7D7;"><?php echo sprintf("%01.3f", $totalReglementGlobal); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach;
                                ?>





                            </tbody>
                        </table>
                        <br>

                    </div>
                    <br>


                </div>
            </div>
            <br>
        </td>
    </tr>
</table>