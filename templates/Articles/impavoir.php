<?php $this->layout = 'AdminLTE.print'; 
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;

?>
<style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style>

<div>
    <div>
        <?php
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '110px', 'width' => '200px']); ?>
    </div>
    <div align="left">
        Société CODIFA <br>
        Rte Fouchana 1.8 km 1135 naassen <br>
        Phone : (+216) 71 398 404 / (+216) 71 398 158 <br>
        Mail : codifa@gnet.tn <br>
    </div>
</div>
<br><br><br>
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
                            <?php

                            $total = 0;
                            $dernierprix = 0;

                            foreach ($articles as $art) :

                                $articleid = $art['id'];


                                date_default_timezone_set('Africa/Tunis');
                                $date11 =    date("Y") . '-01-01' . date(" 00:00:00");
                                $time = new FrozenTime('now', 'Africa/Tunis');
                                $date22 = date("Y-m-d H:i:s");

                                $connection = ConnectionManager::get('default');
                                $month = (int)date('m');
                                $inv = $connection->execute("select stockbassem(" . $articleid . ",'" . $date22 . "','0'," . $depotid . " ) as v")->fetchAll('assoc');

                                $qtestock = $inv[0]['v'];
                            ?>
                                <tr>


                                    <td align="center">
                                            <?php echo  $art['Code'] ?>
                                    </td>
                                    <td align="center">
                                            <?php echo  $art['Dsignation'] ?>
                                    </td>

                                    <td align="center"><?php
                                                        echo $qtestock;                                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

