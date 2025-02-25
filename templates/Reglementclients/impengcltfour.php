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
                    <strong> Etat Débit Crédit </strong>
                </div>
                <br><br>
                <div class="panel-body">
                    <div>


                        <table style=" border-collapse: collapse; width: 100%;">
                            <tr style="background-color: #0095b6 ;">
                                <th width="10%" class="actions text-center" style=" border: 1px solid black; padding: 8px;"><?php echo ('Date'); ?></th>
                                <th width="10%" class="actions text-center " style=" border: 1px solid black; padding: 8px;"><?php echo ('Code'); ?></th>
                                <th width="10%" class="actions text-center " style=" border: 1px solid black; padding: 8px;"><?php echo ('Fournisseur'); ?></th>
                                <th width="10%" class="actions text-center " style=" border: 1px solid black; padding: 8px;"><?php echo ('Client'); ?></th>
                                <!-- <th width="10%" class="actions text-center " style=" border: 1px solid black; padding: 8px;"><?php echo ('Numéro'); ?></th> -->
                                <th width="10%" class="actions text-center " style=" border: 1px solid black; padding: 8px;"><?php echo ('Echéance '); ?></th>
                                <th width="10%" class="actions text-center " style=" border: 1px solid black; padding: 8px;"><?php echo ('Débit'); ?></th>
                                <th width="10%" class="actions text-center " style=" border: 1px solid black; padding: 8px;"><?php echo ('Crédit'); ?></th>
                                <!-- <th width="10%" class="actions text-center "><?php echo ('Total'); ?></th> -->


                            </tr>


                            <?php
                            $tt = 0;
                            $i = 0;

                            $tt = 0;
                            $solde = 0;
                            $ttdebit = 0;
                            $ttcredit = 0;
                            foreach ($data  as $i => $dataItem) :
                                // debug($dataItem['sortie']);die;
                                $solde = $dataItem['debit'] - $dataItem['credit'];
                                $ttdebit += $dataItem['debit'];
                                $ttcredit += $dataItem['credit'];
                                $tt += $solde;

                            ?>

                                <tr>
                                    <td align="center" style=" border: 1px solid black; padding: 8px;"> <?= $this->Time->format($dataItem['date'], 'dd/MM/yyyy'); ?></td>

                                    <td align="center" style=" border: 1px solid black; padding: 8px;"><?= h($dataItem['code']) ?></td>

                                    <?php //if ($dataItem['index'] == 2) { 
                                    ?>
                                    <td align="center" style=" border: 1px solid black; padding: 8px;"><?= h($dataItem['fournisseur']) ?></td>
                                    <?php //} else { 
                                    ?>
                                    <td align="center" style=" border: 1px solid black; padding: 8px;"><?= h($dataItem['client']) ?></td>

                                    <?php //} 
                                    ?>
                                    <!-- <td align="center" style=" border: 1px solid black; padding: 8px;"><?= h($dataItem['num']) ?></td> -->
                                    <td align="center" style=" border: 1px solid black; padding: 8px;"> <?= $this->Time->format($dataItem['echance'], 'dd/MM/yyyy'); ?></td>

                                    <td align="center" style=" border: 1px solid black; padding: 8px;"><?php if (h($dataItem['debit']) == 0) {
                                                                                                            echo  '';
                                                                                                        } else {
                                                                                                            echo sprintf("%.3f", $dataItem['debit']);
                                                                                                        } ?>
                                    </td>
                                    <td align="center" style=" border: 1px solid black; padding: 8px;"><?php if (h($dataItem['credit']) == 0) {
                                                                                                            echo  '';
                                                                                                        } else {
                                                                                                            echo sprintf("%.3f", $dataItem['credit']);
                                                                                                        } ?>
                                    </td>
                                    <!-- <td align="center"><?= h(abs($solde)) ?></td> -->






                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td align="center" style=" border: 1px solid black; padding: 8px;" colspan="5" rowspan="2"><strong> TOTAL</strong></td>
                                <td align="center" style=" border: 1px solid black; padding: 8px;background-color: #0095b6;"><strong><?= sprintf("%.3f", $ttdebit); ?></strong></td>
                                <td align="center" style=" border: 1px solid black; padding: 8px;background-color: #0095b6;"><strong><?= sprintf("%.3f", $ttcredit); ?></strong></td>

                            </tr>
                            <tr>
                                <!-- <td align="center" colspan="5" ><strong>Total</strong></td> -->
                                <td align="center" style=" border: 1px solid black; padding: 8px;background-color: #0095b6;" colspan="2"><strong><?= sprintf("%.3f", abs($tt)); ?></strong></td>

                            </tr>
                        </table>
                    </div>
                </div>
                <br>

            </div>


        </td>
    </tr>
</table>