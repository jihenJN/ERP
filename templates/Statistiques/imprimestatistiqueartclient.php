<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

?>
<?php
$connection = ConnectionManager::get('default');
?>
<?php $this->layout = 'AdminLTE.print'; ?>
<!-- <style>
    .margin-right-20 {
        margin-right: 500px;
    }
</style> -->
<style>
    /* body {
        font-size: 12px;
    } */

    /* table {
        margin-left: 80px;
    } */

    .large-column {
        width: 25%;
    }

    .small-text {
        font-size: 12px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<br>
<div style="display:flex;margin-bottom:3px;" align="center">
</div>
<br>
<div style="width:100%" align="center">
    <h2>
        Statistique Par Clients
    </h2>
</div>
<br><br>
<table style="border:0 !important;" width='30%'>
    <tr>
        <td><strong>Du:</strong>
            <?php if ($datedebut != '') {
                echo
                    $this->Time->format($datedebut, 'dd/MM/y');
            } ?>
        </td>
        <td><strong>Au:</strong>
            <?php if ($datefin != '') {
                echo $this->Time->format(
                    $datefin,
                    'dd/MM/y'
                );
            } ?>
        </td>

    </tr>
</table>
<div class="row">
    <div class="col-md-12">
        <div>
            <div class="box-header with-border">

                <div class="box-tools pull-right">
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button> -->
                </div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th align="center" style="width: 50%;background-color: #3c8dbc;">Article</th>
                            <th style="width: 50%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tabs as $i => $art): ?>
                            <tr>
                                <td align="center">
                                    <?php echo $art['nom']; ?>
                                </td>
                                <td>
                                    <table class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th align="center" style="width: 75%;">Clients</th>
                                                <th align="center" style="width: 25%;">Quantité</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($art['client'] as $j => $cl): ?>
                                                <tr>
                                                    <td align="center">
                                                        <?php echo $cl['name']; ?>
                                                    </td>
                                                    <td align="center">
                                                        <?php echo $cl['qte']; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- /.box-body -->
        </div>
        <!-- LINE CHART -->

        <!-- /.box -->

        <!-- BAR CHART -->

        <!-- /.box -->

    </div>
</div>