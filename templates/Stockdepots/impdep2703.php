<?php $this->layout = 'AdminLTE.print'; ?>
<?php

use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
?>
<?php $connection = ConnectionManager::get('default'); ?>


<br>
<style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style>

<div style="display:flex;">
    <table border="1" cellpadding="0" cellspacing="0" style="border: 3px solid black; border-left:none;border-right:none;border-collapse: collapse; width: 100%; ">


        <td align="center" style="width: 25%;border: none;">
            <div>
                <?php
                echo $this->Html->image('logo-sirep.png', ['alt' => 'CakePHP', 'height' => '80px', 'width' => '100%']); ?>
            </div>
        </td>
        <td align="center" style="width: 50%;border: none;"><strong>
                USINE : Route de Gabes Km 86 - BP 61 Skira 3050 - Sfax<br>
                Tél : 79 700 235 &nbsp;&nbsp;&nbsp;Fax : 79 701 006<br>
                E-mail : contact@sirep-prefa.com.tn<br>
                S.web : www.sirep-prefa.com.tn<br>
				M.F: 1001267P/NW000<br>
				R.C: 80827832007<br>
				</strong>
        </td>
        <td align="center" style="width: 25%;border: none;">
            <div>
                <?php
                echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); ?>

            </div>
        </td>

        </td>
    </table>
</div>
<br><br><br>
<h3 style="margin-left: 5px ;">
    Stock depots
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="ls-editable-table table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id=""  width="99%">
                        <thead>
                            <tr>

                                <td style="display: none;"><?php echo ('Id'); ?></td>

                                <td align="center"><strong>Article</strong></td>
                                <?php foreach ($depotalls as $depot) {
                                    /// debug($depot);
                                ?>
                                    <td align="center"> <strong><?php echo $depot['name']; ?></strong></td>
                                <?php } ?>
                                <td align="center">
                                    <strong>
                                        <?php echo ('Qte ToT'); ?>
                                    </strong>
                                 
                                </td>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($articless)) {

                                foreach ($articless as $stockdepot) :

                                    $articleid =  $stockdepot['id'];
                                 
                            ?>
                                    <tr>

                                        <td>
                                            <strong>
                                                <?php echo $stockdepot['Code'] . " " . $stockdepot['Dsignation'];
                                                ?>
                                            </strong>


                                        </td>
                                        <?php $total = 0;
                                        foreach ($depotalls as $d => $depot) {

                                            $dep = $depot['id'];

                                            //debug($d);
                                         
                                            date_default_timezone_set('Africa/Tunis');
                                            $datef = date('Y-m-d H:i:s');
                                            ///debug($datef);
                                            $date1 =    date("Y").'-01-01'. date(" 00:00:00");
                                            ///debug($date1);
                                            $connection = ConnectionManager::get('default');
                                            $st = $connection->execute("select stockbassem(" . $articleid . ",'" . $datef . "','0'," . $dep . " ) as v")->fetchAll('assoc');
                                            ///debug($st);
                                            if (!empty($st)) {
                                                $qtestock = $st[0]['v'];
                                                 //debug($qtestock);
                                                $total = $total + $st[0]['v'];
                                            } else {
                                                $qtestock = 0;
                                            }
                                        ?>
                                            <td align="center">
                                                <?php echo  $qtestock ?>
                                            </td>
                                        <?php } ?>
                                        <td align="center">
                                            <?php echo  $total ?>

                                        </td>

                                    </tr>
                            <?php endforeach;
                            } ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>