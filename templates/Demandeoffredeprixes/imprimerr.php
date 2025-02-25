<?php


use Cake\ORM\TableRegistry;

?>


<?php

$societeTable = TableRegistry::getTableLocator()->get('Societes');

$societe = $societeTable->find()->where('id=1')->first();

use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;

?>
<?php

use Cake\Core\App; ?>

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
<table>
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
            <?php echo $societe->adresseEntete; ?>
            <br>
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
    
    <br>
    <HR> <br><br>










    <div style="display:flex ;width:50%;">
        <div style="width: 10000%;" class="box" align="left">
            <b> DEMANDE N° : </b><?= h($demandeoffredeprix->numero) ?> <br>
            <b> Date : </b><?=
                            $this->Time->format(
                                $demandeoffredeprix->date,
                                'd/MM/y'
                            )
                            ?> <br>



        </div>
    </div>








    <!-- <div style="width: 10000%;" align="left"> -->
        <?php
        //$o = 0;
       // foreach ($frs as $o => $frs) :
            //echo $o;
        ?>
            <?php
           // if ($o > 0) {
            ?>



                <!-- 
                <div style="display:flex">
                    <div style="margin-left:4%">
                        <?php echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '110px', 'width' => '200px']); ?>
                    </div>
                    <div style="width: 58%;margin-left:23%" class="box" align="left">
                        Société Sirep Beton <br>
                        GPI KM 6, BP N°38-6021,
                        GHANNOUCH-Gabes
                        <br>
                        Phone : (+216) 75 350 600<br>
                        Mail : codifa@gnet.tn <br>
                    </div>
                </div>
                <br>
                <HR> <br><br> -->

                <!-- <div style="display:flex ;width:50%; ">
                    <div style="width: 10000%;" class="box" align="left">
                        <b> DEMANDE N° : </b><?= h($demandeoffredeprix->numero) ?> <br>
                        <b> Date : </b><?=
                                        $this->Time->format(
                                            $demandeoffredeprix->date,
                                            'd/MM/y'
                                        )
                                        ?> <br>



                    </div>
                </div> -->

            <?php
          //  }
            ?>




    <!-- </div> -->

    <div class="box">
        <div class="panel-body">
            <table class="table table-bordered table-striped table-bottomless" >
                <thead>
                    <tr>
                        <td align="center" style="width: 20%;"><strong>Designation</strong></td>
                        <td align="center" style="width: 20%;"><strong> fournisseur</strong></td>
                        <td align="center" style="width: 20%;"><strong>Quantité </strong></td>
                        <!-- <td align="center" style="width: 20%;"><strong>Prix</strong></td> -->
                        <!-- <td align="center" style="width: 20%;"><strong>HT</strong></td> -->
                    </tr>
                </thead>
                <tbody>



                    <tr class="tr">
                        <?php
                        foreach ($lignebande as $i => $tab1) :
                        ?>

                            <td style="width: 20%;height: 20px" align="center">
                            <?= h($tab1->article->Dsignation) ?>

                            </td>
                            <td style="width: 25%;height: 20px" align="center">
                                <?= h($tab1->nameF) ?>
                            </td>

                            <td style="width: 25%;height: 20px" align="center">
                                <?= h($tab1->qte) ?>

                            </td>
                            <!-- <td style="width: 20%;height: 20px" align="center">
                                <?= h($tab1->prix) ?>
                            </td>
                            <td style="width: 20%;height: 20px" align="center">
                                <?= h($tab1->ht) ?>
                            </td> -->
                            <br>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
<?php //endforeach ?>
</table>