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

            </td>
        </tr>
    </thead>

    <tr>
        <td>
            <div>
                <div align="center" style="color:#b22222;">
                    <strong> Engagement Client </strong>
                </div>
                <br><br>
                <div class="panel-body">
                    <div>



                        <table id="example1" class="table table-bordered   table-striped">
                            <tr style="background-color: #8fbc8f ;">
                                <th width="10%" class="actions text-center "><?php echo ('Mode Paiement'); ?></th>
                                <th width="10%" class="actions text-center "><?php echo ('Code'); ?></th>

                                <th width="15%" class="actions text-center "><?php echo ('Client'); ?></th>
                                <th width="10%" class="actions text-center "><?php echo ('Endossé'); ?></th>

                                <th width="10%" class="actions text-center "><?php echo ('Numéro'); ?></th>
                                <th width="10%" class="actions text-center"><?php echo ('Encaissement'); ?></th>
                                <th width="10%" class="actions text-center "><?php echo ('Echéance '); ?></th>
                                <th width="10%" class="actions text-center " style="color:#dc143c;"><?php echo ('Echéance2'); ?></th>

                                <!-- <th width="10%" class="actions text-center "><?php echo ('Compte'); ?></th> -->
                                <th width="10%" class="actions text-center "><?php echo ('Montant'); ?></th>

                                <th width="10%" class="actions text-center "><?php echo ('Situation'); ?></th>
                                <!-- <th width="5%" class="actions text-center "><?php echo (''); ?></th> -->
                            </tr>


                            <?php
                            $mnt = 0;
                            $i = 0;

                            $tt = 0;
                            foreach ($piecereglements  as $i => $dataItem) :

                                $mnt += $dataItem->montant;

                                $tt = $connection->execute('SELECT etat_id,reglementclient_id ,piecereglementclient_id from etatreglementclients  where etatreglementclients.piecereglementclient_id = ' . $dataItem->id  . ' and  etatreglementclients.reglementclient_id = ' . $dataItem->reglementclient->id  . ' ;')->fetchAll('assoc');
                                //  $tt = $connection->execute('SELECT * FROM etatpieceregelemnts WHERE piecereglementachat_id=' . $dataItem->id);
                                //debug($tt);
                                $etat_id = 1;
                                foreach ($tt as $etatRecord) {
                                    // debug($etatRecord);
                                    $etat_id = $etatRecord['etat_id'];

                                    $reglementclient_id = $etatRecord['reglementclient_id'];

                                    $piecereglementclient_id = $etatRecord['piecereglementclient_id'];
                                }
                                $compteQuery = $connection->execute(
                                    '
                                                                        SELECT c.numero
                                                                        FROM etatreglementclients erc
                                                                        INNER JOIN comptes c ON erc.compte_id = c.id
                                                                        WHERE erc.piecereglementclient_id = ' . $dataItem->id . ' 
                                                                        AND erc.reglementclient_id = ' . $dataItem->reglementclient->id
                                );
                                $compte = $compteQuery->fetch('assoc');
                                // debug($compte['numero']);
                                if ($compte) {
                                    $numeroCompte = $compte['numero'];
                                    // Le reste de votre code...
                                }

                            ?>
                                <tr>

                                    <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $dataItem->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control ']); ?></td>
                                    <td hidden><?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $dataItem->reglementclient->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control ']); ?></td>

                                    <td align="center"><?= h($dataItem->paiement->name) ?></td>
                                    <td align="center"><?= h($dataItem->reglementclient->client->Code) ?></td>

                                    <td align="center"><?= h($dataItem->reglementclient->client->Raison_Sociale) ?></td>
                                    <td align="center"><?= h($dataItem->endosse) ?></td>

                                    <td align="center"><?= h($dataItem->num) ?></td>
                                    <td align="center"> <?= $this->Time->format($dataItem->reglementclient->date, 'dd/MM/yyyy'); ?></td>
                                    <td align="center"> <?= $this->Time->format($dataItem->echance, 'dd/MM/yyyy'); ?></td>
                                    <td align="center" style="color:#dc143c;"> <?= $this->Time->format($dataItem->echance2, 'dd/MM/yyyy'); ?></td>
                                    <td align="center" hidden><?php echo $numeroCompte; ?></td>
                                    <td align="center"><?= h($dataItem->montant) ?></td>

                                    <!-- <td align="center"><?= h($dataItem->etat->name) ?></td> -->

                                    <td align="center">
                                        <?php
                                        if (($dataItem->etat_id == 1) || ($dataItem->etat_id == 0)) {
                                            echo 'En Attente';
                                        } elseif ($dataItem->etat_id == 2) {
                                            echo 'Payé';
                                        } else {
                                            echo 'Impayé';
                                        }

                                        ?>


                                    </td>



                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td align="center" colspan="8"> <strong><?php echo 'Total   ';  //debug($qte_ent); 
                                                                        ?></strong></td>
                                <td align="center" colspan="1" style="background-color: #8fbc8f ;"><strong><?php echo sprintf("%.3f", $mnt); //debug($qte_ent); 
                                                                                                            ?></strong></td>

                                <td align="center" colspan="1"><?php //echo sprintf("%.3f", $qte_sor); 
                                                                ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>

            </div>
     
         
        </td>
    </tr>
</table>