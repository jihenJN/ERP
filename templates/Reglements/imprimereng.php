<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

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
<table width="100%">
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
            <td>

        </tr>
    </thead>
    <tr>
        <td>
            <br><br>
            <div>
                <div align="center" style="color:#b22222;">
                    <strong> Engagement Fournisseur </strong>
                </div>
                <br><br>
                <div class="panel-body">
                    <div>



                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr style="background-color: #bdb76b  ;">
                                    <th width="14%" class="actions text-center "><?php echo ('Mode Paiement'); ?></th>
                                    <th width="10%" class="actions text-center "><?php echo ('Fournisseur'); ?></th>
                                    <th width="10%" class="actions text-center "><?php echo ('Numéro'); ?></th>
                                    <th width="8%" class="actions text-center"><?php echo ('Encaissement'); ?></th>
                                    <th width="8%" class="actions text-center "><?php echo ('Echéance'); ?></th>
                                    <th width="10%" class="actions text-center "><?php echo ('Compte'); ?></th>

                                    <th width="10%" class="actions text-center "><?php echo ('Montant'); ?></th>
                                    <th width="10%" class="actions text-center "><?php echo ('Situation'); ?></th>
                                </tr>
                            </thead>
                            <?php
                            $mnt = 0;
                            $i = 0;

                            $tt = 0;
                            //    debug($etat_id);
                            foreach ($piecereglements  as $i => $dataItem) :

                                $mnt += $dataItem->montant;

                                $tt = $connection->execute('SELECT etat_id,reglement_id ,piecereglement_id from etatpieceregelemnts  where etatpieceregelemnts.piecereglement_id = ' . $dataItem->id  . ' and  etatpieceregelemnts.reglement_id = ' . $dataItem->reglement->id  . ' ;')->fetchAll('assoc');


                                $etat_id = 1;
                                foreach ($tt as $etatRecord) {
                                    // debug($etatRecord);
                                    $etat_id = $etatRecord['etat_id'];

                                    $reglement_id = $etatRecord['reglement_id'];

                                    $piecereglement_id = $etatRecord['piecereglement_id'];
                                }


                            ?>

                                <tr>
                                    <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $dataItem->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control ']); ?></td>
                                    <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $dataItem->reglement->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control ']); ?></td>

                                    <td align="center"><?= h($dataItem->paiement->name) ?></td>
                                    <td align="center"><?= h($dataItem->reglement->fournisseur->name) ?></td>
                                    <td align="center"><?= h($dataItem->num) ?></td>
                                    <td align="center"> <?= $this->Time->format($dataItem->reglement->Date, 'dd/MM/yyyy'); ?></td>
                                    <td align="center"> <?= $this->Time->format($dataItem->echance, 'dd/MM/yyyy'); ?></td>
                                    <td align="center"><?= h($dataItem->compte->numero) ?></td>
                                    <td align="center"><?= h($dataItem->montant) ?></td>

                                    <!-- <td align="center"><?= h($dataItem->etat->name) ?></td> -->
                                    <td align="center">
                                        <?php
                                        if (($etat_id == 1) || ($etat_id == 0)) {
                                            echo 'En Attente';
                                        } elseif ($etat_id == 2) {
                                            echo 'Payé';
                                        } else {
                                            echo 'Impayé';
                                        }


                                        ?>
                                    </td>


                                </tr>
                            <?php
                            endforeach; ?>
                            <tr>
                                <td align="center" colspan="6"> <strong><?php echo 'Total   ';
                                                                        ?></strong></td>
                                <td align="center" colspan="1" style="background-color: #bdb76b  ;"><strong><?php echo sprintf("%.3f", $mnt);
                                                                                                            ?></strong></td>
                                <td align="center" colspan="1"><?php
                                                                ?></td>
                                <!-- <td align="center" colspan="1"><?php
                                                                ?></td> -->

                            </tr>
                        </table>
                    </div>
                    <br>

                </div>

            </div>
        </td>
    </tr>
</table>