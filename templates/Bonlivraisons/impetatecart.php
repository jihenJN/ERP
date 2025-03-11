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
    <div align="center" style="color:#b22222;">
        <strong> Etat Ecart </strong>
    </div>
    <br><br>
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr style='background-color:#F0865F;'>
                    <th hidden style="text-align: center;">id</th>
                    <th style="text-align: center;width:10%">Code</th>
                    <th style="text-align: center;width:18%">Raison Social</th>
                    <th style="text-align: center;width:10%">Numéro</th>
                    <th style="text-align: center;width:10%">BL/FC</th>

                    <!-- <th style="text-align: center;width:6%">Mode paiement</th> -->
                    <th style="text-align: center;width:8%">Date</th>
                    <!-- <th style="text-align: center;width:15%">Observation</th> -->

                    <th style="text-align: center;width:10%">Montant</th>
                    <!-- <th style="text-align: center;width:10%">Crédit</th> -->
                    <th hidden style="text-align: center;width:12%">Solde</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $totalDebits = 0;
                $totalCredits = 0;
                $total = 0;
                $solde = 0;
                $totalss = 0;

                usort($clientData, function ($a, $b) {
                    return strtotime($a['date']) - strtotime($b['date']);
                });


                foreach ($clientData as $i => $data):

                    // debug($data['index']);
                    $totalDebits += (float) $data['debit'];
                    $totalCredits += (float) $data['credit'];




                    $solde -= (float) $data['credit'];
                    $solde += (float) $data['debit'];
                    $totalss += (float) $data['debit'] - (float) $data['credit'];

                ?>
                    <tr>
                        <td hidden></td>

                        <td align="center">
                            <?php
                            if ($data['index'] == 2) {
                                echo ($data['Code']);
                            }

                            ?>
                        </td>
                        <td align="center">
                            <?php
                            if ($data['index'] == 2) {
                                echo ($data['name']);
                            }

                            ?>
                        </td>
                        <td>
                            <?php echo ($data['num']) ?>
                        </td>

                        <td>
                            <?php
                            if ($data['numfact']) {
                                foreach ($data['numfact'] as $nn => $valfact) {

                                    if (strpos($valfact, 'FAC N°') !== false) {
                                        echo '<span style="color:#8b0000; font-weight:bold;">' . ($valfact) . '</span><br>';
                                    } else if (strpos($valfact, 'BL N°') !== false) {
                                        echo '<span style="color:#0000ff; font-weight:bold;">' . ($valfact) . '</span><br>';
                                    } else if (strpos($valfact, 'CMD N°') !== false) {
                                        echo '<span style="color:#29ab87; font-weight:bold;">' . ($valfact) . '</span><br>';
                                    } else {
                                        echo '';
                                    }
                                }
                            }

                            ?>
                        </td>

                        <td align="center">
                            <?php echo $this->Time->format($data['date'], 'dd/MM/y'); ?>
                        </td>
                        <td align="center" hidden>
                            <?php echo ($data['observation']) ?>
                        </td>


                        <td style="text-align:right;padding-right:5px">
                            <?php
                            if ($data['debit'] != '') {
                            ?>
                                <?php
                                if ($data['index'] == 1) {
                                ?>
                                    <strong
                                        style="color:green"><?php echo sprintf("%01.3f", $data['debit']); ?></strong>
                                <?php } else {
                                    echo sprintf("%01.3f", $data['debit']);
                                }


                                ?>
                            <?php   } else  if ($data['credit'] != '') {
                                echo sprintf("%01.3f", -$data['credit']);
                            }



                            ?>
                        </td>
                        <td hidden style="text-align:right;padding-right:5px">
                            <?php
                            //echo sprintf("%01.3f", $data['montant']);
                            echo sprintf("%01.3f", $solde);

                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>



                <tr style='border:solid 1px'>
                    <td colspan="5" style="background-color:#F0865F;text-align: center;">Total :</td>



                    <td colspan="" align="right" style="width: 33%;">
                        <?php echo sprintf("%01.3f", $totalDebits - $totalCredits) ?>

                    </td>
                </tr>












            </tbody>
        </table>

    </div>
    <!--    <br>
    <div style="width: 100%;border:0px solid black;border-radius: 15px;height:40px;">
        <br>

    </div>-->
</div>
</div>