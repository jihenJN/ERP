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

<h3 style="margin-left: 5px ;">
    Articles
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="ls-editable-table table-responsive ls-table">
                    <table class="table table-bordered table-striped" width="99%">
                        <thead>
                            <tr>
                                <th width="20%" class="actions text-center"> <?php echo ('Code '); ?></th>
                                <th width="50%" class="actions text-center "><?php echo ('Designation'); ?></th>
                                <th width="30%" class="actions text-center "><?php echo ('Quantité'); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php //debug($stockdepots);die;
                            $total = 0;
                            $dernierprix = 0;
                            foreach ($stockdepots as $stockdepot) :

                                $articleid = $stockdepot['id'];


                                date_default_timezone_set('Africa/Tunis');
                                $date1 =    date("Y").'-01-01'. date(" 00:00:00");
                                ///debug($date1);
                                $time = new FrozenTime('now', 'Africa/Tunis');
                                $date2 = date('Y-m-d H:i:s');

                              ///  debug($date2);


                                $connection = ConnectionManager::get('default');
                                $month = (int)date('m');
                                $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date2 . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                            
                                $qtestock = $inv[0]['v'];
                                ///debug($qtestock);






                            
                            ?>
                                <?php  if ($qtestock != 0) : ?>
                                <tr>

                                    <td align="center">

                                        <?php echo  $stockdepot['Code'] ?>

                                    </td>
                                    <td align="center">

                                        <?php echo  $stockdepot['Dsignation'] ?>

                                    </td>

                                    <td align="center"><?php
                                                        echo $qtestock
                                                        ?>
                                    </td>

                                </tr>
                                <?php endif ; ?>
                            <?php endforeach ; ?>
                         
                        </tbody>

                    </table>