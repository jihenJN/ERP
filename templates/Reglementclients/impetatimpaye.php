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

<br><br>
<div>
    <!-- <div align="center" style="color:#b22222;">
        <strong> Etat Chéques Impayé </strong>
    </div>
    <br><br> -->
    <table border="1" style="border-collapse: collapse; width: 100%;">
        <tr>
            <td colspan="8" align="center" style="font-size: 16px; font-weight: bold;">
                <?php echo date('d/m/Y'); ?>

            </td>
        </tr>
        <tr>
            <td colspan="8" align="center" style="font-size: 14px; font-weight: bold;">
                <?php echo 'IMPAYEES SIEGE'; ?>
            </td>
        </tr>
        <tr>
            <th class="actions text-center" style="width: 25%;"><?php echo ('Nom & Prénom'); ?></th>
            <th class="actions text-center" style="width: 10%;"><?php echo ('Montant'); ?></th>
            <th class="actions text-center" style="width: 10%;"><?php echo ('Echéance'); ?></th>
            <th class="actions text-center" style="width: 10%; color: #dc143c;"><?php echo ('Echéance2'); ?></th>
            <th class="actions text-center" style="width: 10%;"><?php echo ('CH N°/EFF'); ?></th>
            <th class="actions text-center" style="width: 10%;"><?php echo ('Banque'); ?></th>
            <th class="actions text-center" style="width: 10%;"><?php echo ('Note'); ?></th>
            <th width="10%" hidden class="actions text-center"><?php echo ('Etat'); ?></th>
        </tr>

        <?php
        $mnt = 0;
        foreach ($piecereglements as $dataItem) :
            $mnt += $dataItem->montant;
        ?>
            <tr>
                <td align="center"><?php if ($dataItem->reglementclient->client_id == 12) {
                                        echo ($dataItem->reglementclient->nomprenom);
                                    } else {
                                        echo ($dataItem->reglementclient->client->Code . ' ' . $dataItem->reglementclient->client->Raison_Sociale);
                                    } ?></td>
                <td align="center"><?= h($dataItem->montant) ?></td>

                <td align="center"><?= $this->Time->format($dataItem->echance, 'dd/MM/yyyy'); ?></td>
                <td align="center" style="color: #dc143c;"><?= $this->Time->format($dataItem->echance2, 'dd/MM/yyyy'); ?></td>
                <td align="center"><?= h($dataItem->num) ?></td>
                <td align="center"><?= h($dataItem->banque) ?></td>
                <td align="center"><?= h($dataItem->endosse) ?></td>

                <td align="center" hidden>
                    <?php
                    if ($dataItem->etat_id !== null) {
                        if ($dataItem->etat_id == 3) { // Impayé
                            $Color = 'blue';
                            $Text = 'Impayé';
                        } elseif ($dataItem->etat_id == 1) { // En attente
                            $Color = 'red';
                            $Text = 'En attente';
                        } elseif ($dataItem->etat_id == 2) { // Payé
                            $Color = 'green';
                            $Text = 'Payé';
                        }
                    ?>
                        <span style="color: <?= h($Color); ?>;">
                            <?= h($Text); ?>
                        </span>
                    <?php
                    }
                    ?>
                </td>

            </tr>
        <?php endforeach; ?>

        <tr>
            <td align="center" colspan="1">
                <strong><?php echo 'TOTAL SOGEM SIEGE'; ?></strong>
            </td>
            <td align="center">
                <strong><?php echo sprintf("%.3f", $mnt); ?></strong>
            </td>
            <td align="center">
            </td>
            <td align="center">

            </td>
            <td align="center">

            </td>
            <td align="center">

            </td>
        </tr>
    </table>

</div>
</div>