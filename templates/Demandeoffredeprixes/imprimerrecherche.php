<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<div style="display:flex">
    <div style="margin-left:1%">
        <?php echo $this->Html->image('m.png', ['alt' => 'CakePHP', 'height' => '100px', 'width' => '200px']); ?>
    </div>
    <div style="margin-left:30%">
        Société Laboratoires Grenat <br>
        Route de Teboulbi km 5 <br>
        Phone:20182836 <br>
        Mail :contact@laboratoires-grenat.com <br>
    </div>
</div>
<table width="100%">
    <tr>
        <td width="45%" height="50px">

        </td>

        <td width="55%">

        </td>

    </tr>
    <tr><td colspan="2"><br><hr></td></tr>
    <tr>
        <td width="100%"  align="center">
            <span style="font-weight: bold;"> Liste des Fournisseurs </span>
        </td>



    </tr>
</table>
<br>



<section class="invoice">
    <?php echo $this->Form->create($recherches, ['type' => 'get']);
   // debug($demandeoffredeprixes);
    ?>
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table border="1" align="center" cellpadding="2" cellspacing="0"  width="100%" class="table" nobr="true">
                <thead>
                    <tr style="background-color: #BDBDBD">
                        <th width="20%" align="center"><?= h('Numéro') ?></th>
                        <th width="20%" align="center"><?= h('Date') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recherches as $recherches): 
                     //  debug($recherches);?>
                        <tr>
                            <td align="center"><?= h($recherches->numero) ?></td>
                            <td align="center"><?= h($recherches->date) ?></td>
                          
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>

    <?php echo $this->Form->end(); ?>
    <!-- /.row -->



</section>
