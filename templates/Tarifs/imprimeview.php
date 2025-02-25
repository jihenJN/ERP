<?php $this->layout = 'AdminLTE.print'; ?>
<br>
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
<div style="display:flex">
    <div style="margin-left:4%">
        <?php
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '110px', 'width' => '200px']); ?>
    </div>
    <div style="width: 58%;margin-left:23%" class="box" align="left">
        Société CODIFA <br>
        Rte Fouchana 1.8 km 1135 naassen <br>
        Phone : (+216) 71 398 404 / (+216) 71 398 158 <br>
        Mail : codifa@gnet.tn <br>
    </div>
</div>
<br><br>
<div class="box">
    <div class="col-xs-6">
       
    </div>
    <br><br>
    <div class="panel-body">
        <div>
            <table border="1">

                <thead>
                    <tr>
                        <td align="center" style="width: 20%;"><strong>Code</strong></td>
                        <td align="center" style="width: 35%;"><strong>Dsignation </strong></td>
                        <td align="center" style="width: 30%;"><strong>Prix</strong></td>
                        <td align="center" style="width: 30%;"><strong>Tarif Client</strong></td>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarifclients as $i => $tarifclient) : ?>
                        <tr class="tr">
                            <td style="width: 25%;height: 20px" align="center">
                                <?php echo $tarifclient->article->Code ?></td>
                            </td>
                            <td style="width: 25%;height: 20px" align="center">
                                <?php echo $tarifclient->article->Dsignation ?>
                            </td>
                            <td style="width: 25%;height: 20px" align="center">
                                <?php echo $tarifclient->article->Prix_LastInput ?>
                            </td>
                            <td style="width: 25%;height: 20px" align="center">
                                <?php echo $tarifclient->prix ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>