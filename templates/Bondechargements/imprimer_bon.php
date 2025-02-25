<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<div style="display:flex">
    <div style="margin-left:1%">
        <?php
        echo $this->Html->image('m.png', ['alt' => 'CakePHP', 'height' => '100px', 'width' => '200px']); ?>

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
    <tr>
        <td colspan="2"><br>
            <hr>
        </td>
    </tr>
    <tr align="center">







    </tr>
</table>
<br>
<?php echo $this->Form->create($bondechargement, ['type' => 'get']);
//debug($bondechargement);
?>

<div style="display:flex ;">
    <div style="border: solid;width: 40%; height: 60px;margin-right:40px;padding-top: 10px;padding-bottom: 15px;">
        <p style="padding-left:20px;font-weight: bold; font-size:small;"> Bon de Chargement N°: <?php echo $bondechargement->numero ?> </p>
        <p style="padding-left:20px;font-weight: bold; font-size:small;">Date: <?php echo $bondechargement->date ?></p>
    </div>
    <div style="border: solid;width: 40%; height: 60px;margin-left:90px;padding-top: 10px;padding-bottom: 15px;">
        <p style="padding-left:20px;font-weight: bold; font-size:small;"> Point de vente : <?php echo $bondechargement->pointdevente->name ?> </p>
        <p style="padding-left:20px;font-weight: bold; font-size:small;">Depot: <?php echo $bondechargement->depot->name ?></p>
    </div>

</div>
<br/>
<section class="invoice">

    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table border="1" align="center" cellpadding="2" cellspacing="0" width="100%" class="table" nobr="true">

                <tr style="background-color: #BDBDBD">
                    <th width="20%" align="center"><?= h('Code') ?></th>

                    <th width="20%" align="center"><?= h('Article') ?></th>
                  

                    <th width="20%" align="center"><?= h('Quntité') ?></th>
                    <th width="20%" align="center"><?= h('Prix') ?></th>
                    <th width="20%" align="center"><?= h('Total') ?></th>

                </tr>
                </thead>
                <tbody>
                    <?php foreach ($lignebonchargements as $ligne) : //debug($ligne->article->Dsignationon) ?>
                        <tr>
                        <td align="center" style="font-size:14px ;"><?= h($ligne->article->Code) ?></td>

                            <td align="center" style="font-size:10px ;"><?= h($ligne->article->Dsignation) ?></td>
                            <td align="center" style="font-size:14px ;"><?= h($ligne->qte) ?></td>
                            <td align="center" style="font-size:14px ;"><?= h($ligne->prix) ?></td>
                            <td align="center" style="font-size:14px ;"><?= h($ligne->total)  ?></td>


                            </td>
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