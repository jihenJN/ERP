<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<div style="display:flex">
    <div style="margin-left:6%">
        <?php
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '140px', 'width' => '200px']); ?>
    </div>
    <div style="width: 75%;margin-left:23%" class="box" align="left">
        Société CODIFA <br>
        Rte Fouchana 1.8 km 1135 naassen <br>
        Phone : (+216) 71 398 404 / (+216) 71 398 158 <br>
        Mail : codifa@gnet.tn <br>
    </div>
</div>
<br><br>
<h3 align="center">
    Relevé Commercials
</h3>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="15%" align="center"><?= ('Date Opération') ?></th>
            <th width="35%" align="center"><?= ('libele') ?></th>
            <th width="25%" align="center"><?= ('Debit') ?></th>
            <th width="25%" align="center"><?= ('Credit') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tot = 0;
        $totcr = 0;
        foreach ($dat as $relefe) :
            $tot = $tot + $relefe['debit'];
            $totcr = $totcr + $relefe['credit'];
            $tots = $tot + $totcr;
        ?>
            <tr>
                <td align="center"><?php echo date("d/m/Y", strtotime(str_replace('-', '/', @$relefe['date']))); ?></td>
                <td align="center"><?php echo @$relefe['type']; ?> N° <?php echo @$relefe['numero']; ?>
                </td>
                <td align="center"><?php echo number_format(@$relefe['debit'], 3, '.', ' '); ?></td>
                <td align="center"><?php echo number_format(@$relefe['credit'], 3, '.', ' '); ?></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" align="center"><b> Total</b></td>
            <td align="center"> <?php echo number_format(@$tot, 3, '.', ' '); ?></td>
            <td align="center"> <?php echo number_format(@$totcr, 3, '.', ' '); ?></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><b> Total</b></td>
            <td colspan="2" align="center"> <?php echo number_format(@$tots, 3, '.', ' '); ?></td>
        </tr>
    </tfoot>
</table>
<br>