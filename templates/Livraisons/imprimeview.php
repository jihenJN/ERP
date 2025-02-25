<?php $this->layout = 'AdminLTE.print'; ?>
<?php

use Cake\ORM\TableRegistry;

?>


<?php

$societeTable = TableRegistry::getTableLocator()->get('Societes');

$societe = $societeTable->find()->where('id=1')->first();

?>
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
            <!-- <div>
                <?php
                echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); ?>

            </div> -->
        </td>


        </td>
    </table>
</div>
<!-- <div style="display:flex;">
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
                S.web : www.sirep-prefa.com.tn
				<br>
				M.F: 1001267P/NW000<br>
				R.C: 80827832007<br></strong>
        </td>
        <td align="center" style="width: 25%;border: none;">
            <div>
                <?php
                echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); ?>

            </div>
        </td>

        </td>
    </table>
</div> -->



<br>





Date: <?php
        date_default_timezone_set('Africa/Tunis');

        echo date('d/m/Y H:i:s');
        ?>
<br><br>


<div style="display:flex" align="center">





    <div style="display:flex;width: 1000%;">
        <div style="width: 10000%;" class="box" align="left">
            <b> BL N° : </b><?= h($livraison->numero) ?> <br>
            <b> Date : </b><?=
                            $this->Time->format(
                                $livraison->date,
                                'dd/MM/y'
                            )



                            ?> <br>


            <b> Remise : </b><?= h($livraison->remise) ?> <br>

        </div>
    </div>

    <div style="display:flex ;width:1000%;margin-left:10%">

        <div style="width: 10000%;" class="box" align="left"> <b> Fournisseur : </b> <?php
                                                                                        if (isset($livraison->fournisseur)) {
                                                                                            echo  h($livraison->fournisseur->name);
                                                                                        } ?><br>
            <b> Code postal: </b><?= h($livraison->fournisseur->codepostal) ?> <br>
            <b> N° BL Fournisseur: </b><?= h($livraison->blfournisseur) ?> <br>



        </div>
    </div>
</div>
<div class="box">
    <div class="panel-body">
        <div>
            <table border="1">
                <thead>
                    <tr>
                        <!--                        <td align="center" style="width: 11%;"><strong>Code</strong></td>-->
                        <td align="center" style="width: 20%;"><strong>Article</strong></td>
                        <td align="center"><strong>Qte</strong></td>
                        <td align="center"><strong>Prix</strong></td>
                        <td align="center"><strong>Total HT</strong></td>
                        <td align="center" hidden><strong>Fodec </strong></td>
                        <td align="center"><strong>TVA </strong></td>
                        <td align="center"><strong>Total TTC</strong></td>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    foreach ($lignelivraisons as $lignecommande) :
                    ?>

                        <tr class="tr">
                            <!--                            <td style="width: 11%;vertical-align:top" align="center">
                                <?php //($lignecommande->article->Code) 
                                ?>
                            </td>-->
                            <td><?php
                                if (isset($lignecommande->article)) {
                                    echo  h($lignecommande->article->Dsignation);
                                }
                                ?></td>
                            <td style="width: 6%;vertical-align:top" align="center">
                                <?= $this->Number->format($lignecommande->qteliv) ?>
                            </td>
                            <td style="width: 8%;vertical-align:top" align="center">
                                <?php echo  sprintf("%01.3f", $lignecommande->prix) ?>
                            </td>
                            <td style="width: 10%;vertical-align:top" align="center">
                                <?php echo  sprintf("%01.3f", $lignecommande->prix * $lignecommande->qte) ?>
                            </td>
                            <td hidden style="width: 6%;vertical-align:top" align="center">
                                <?= $this->Number->format($lignecommande->fodec)  ?>
                            </td>
                            <td style="width: 6%;vertical-align:top" align="center">
                                <?= $this->Number->format($lignecommande->tva)  ?>
                            </td>
                            <td style="width: 8%;vertical-align:top" align="center">
                                <?php echo  sprintf("%01.3f", $lignecommande->ttc) ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <div style="display:flex ; margin-top:25px;">
                <table class="table table-bordered table-striped table-bottomless" style="margin-right:40px;width: 250px;">
                    <thead>
                        <tr>
                            <td align="center" style="width: 25%;"><strong>Taxe</strong></td>
                            <td align="center" style="width: 20%;"><strong>Taux </strong></td>
                            <td align="center" style="width: 25%;"><strong>Assiette</strong></td>
                            <td align="center" style="width: 20%;"><strong>Montant</strong></td>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- <tr class="tr">
                            <td style="width: 25%;height: 20px" align="center">

                                Fodec
                            </td>

                            <td style="width: 20%;height: 20px" align="center">
                                <?= $this->Number->format($lignecommande->fodec)  ?>

                            </td>


                            <td style="width: 25%;height: 20px" align="center">
                               <?php echo  sprintf("%01.3f", $livraison->ht) ?>

                            </td>
                            <td style="width: 20%;height: 20px" align="center">
                               <?php echo  sprintf("%01.3f", $livraison->fodec) ?>

                            </td>

                        </tr> -->


                        <tr class="tr">
                            <td style="width: 25%;height: 20px" align="center">

                                TVA
                            </td>

                            <td style="width: 20%;height: 20px" align="center">
                                <?= $this->Number->format($lignecommande->tva)  ?>

                            </td>


                            <td style="width: 25%;height: 20px" align="center">
                                <?php echo  sprintf("%01.3f", $livraison->ht + $livraison->fodec) ?>

                            </td>
                            <td style="width: 20%;height: 20px" align="center">
                                <?php echo  sprintf("%01.3f", $livraison->tva) ?>

                            </td>

                        </tr>



                    </tbody>
                </table>
                <!--<div style="margin-right:40px;width: 99% ; border: dashed;height: 150px" class="box ">
                    <h5 align="center">Signature</h5>

                </div>-->
                <div style="display:flex">
                    <div class="table-bordered box" style="width: 100px; display:flex ;   margin-left:250px" align=" left"><strong>Total HT <br><br>
                            <!-- Total Fodec <br><br> -->
                            Total TVA <br><br>
                            Total TTC</strong>
                    </div>
                    <div class="table-bordered box" style="width: 100px; " align="right">
                        <?php  ?>
                        <?php echo  sprintf("%01.3f", $livraison->ht) ?><br><br>
                        <!-- <?php echo  sprintf("%01.3f", $livraison->fodec) ?><br><br> -->

                        <?php echo  sprintf("%01.3f", $livraison->tva) ?><br><br>
                        <?php echo  sprintf("%01.3f", $livraison->ttc) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<table>
    <tr>
        <td>
            <p>
                <Strong>Commentaire : </Strong><?php echo $livraison->observation ?>

            </p>
        </td>
    </tr>
</table>