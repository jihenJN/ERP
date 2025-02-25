<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

?>


<?php
$connection = ConnectionManager::get('default');
?>
<?php $this->layout = 'AdminLTE.print'; ?>

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


<table width="100%">
    <thead>
        <tr>
            <td>
                <div style="display:flex;">
                    <table border="1" cellpadding="0" cellspacing="0" style="border: 2px solid #002E50; border-left:none;border-right:none;border-collapse: collapse; width: 100%; ">


                        <td align="center" style="width: 25%;border: none;">
                            <div>
                                <?php
                                echo $this->Html->image('logoSMBM.png', ['alt' => 'CakePHP', 'height' => '80px', 'width' => '100%']); ?>
                            </div>
                        </td>
                        <td align="center" style="width: 10%;border: none;">

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
                    </table>
                </div><br><br>

            </td>


        </tr>
    </thead>
    <tr>
        <td>
            <br><br>
            <div>
                <div align="center" style="color:#b22222;">
                    <strong> Engagement Compte </strong>
                </div>
                <br><br>
                <div class="panel-body">
                    <div>



                        <table id="example1" class="table table-bordered  table-striped" style="border-spacing: 0 8px;">
                            <thead>
                                <tr>
                                    <th align="center" colspan="4" style="color:#3c8dbc;"><strong>solde Créditeur </strong></th>
                                    <th colspan="2" style="background-color:#3c8dbc;" align="center"><strong> <?php echo $soldetc ?></strong></th>
                                </tr>
                                <tr style="background-color:#3c8dbc;">
                                    <th width="10%" class="actions text-center "><?php echo ('Date'); ?></th>
                                    <!-- <th width="10%" class="actions text-center "><?php echo ('Compte'); ?></th> -->
                                    <th width="10%" class="actions text-center "><?php echo ('Action'); ?></th>
                                    <th width="10%" class="actions text-center "><?php echo ('Type'); ?></th>
                                    <th width="10%" class="actions text-center "><?php echo ('Montant'); ?></th>
                                    <th width="10%" class="actions text-center"><?php echo ('Débit'); ?></th>
                                    <th width="10%" class="actions text-center "><?php echo ('Crédit'); ?></th>

                                </tr>
                            </thead>

                            <?php
                            $mnt = $soldetc;
                            $i = 0;
                            $totalMontantCheque = 0;
                            // $tt = 0; 
                            //debug($historiquecomptes->toArray());
                            foreach ($historiquecomptes as $historiquearticle) :
                                //   foreach ($piecereglements  as $i => $dataItem) :

                                $mnt += $historiquearticle->debit;

                                $mnt -= $historiquearticle->credit;

                                // if ($historiquearticle->mode == 'Chèque') {
                                //     $totalMontantCheque += $historiquearticle->montant;
                                // }


                            ?>

                                <tr>

                                    <td align="center"><?=
                                                        $this->Time->format(
                                                            $historiquearticle->date,
                                                            'dd/MM/y'
                                                        );
                                                        ?><?php //echo $historiquearticle->date; 
                                                            ?></td>
                                    <td align="center">
                                        <?= h($historiquearticle->mode . ' ' . $historiquearticle->numero) ?>
                                    </td>

                                    <td align="center">
                                        <?php echo $historiquearticle->type; ?>

                                    </td>
                                    <td align="center"><?php
                                                        echo sprintf("%01.3f", abs($historiquearticle->montant));
                                                        ?></td>

                                    <td align="center"><?php if ($historiquearticle->debit != 0) {
                                                            echo sprintf("%01.3f", abs($historiquearticle->debit));
                                                            // echo $historiquearticle->debit;
                                                        } ?>

                                    </td>
                                    <td align="center"><?php //if ($historiquearticle->mode == 'Chèque') {
                                                        //echo $historiquearticle->credit;
                                                        if ($historiquearticle->credit != 0) {
                                                            echo sprintf("%01.3f", abs($historiquearticle->credit));
                                                        }
                                                        //} else {
                                                        //} 
                                                        ?>

                                    </td>


                                </tr>
                            <?php
                            endforeach; ?>
                            <tr>
                                <td align="center" colspan="4" style="color:#3c8dbc;"><strong>solde Créditeur </strong></td>
                                <td colspan="2" align="center" style="background-color:#3c8dbc;"><strong><?php echo sprintf("%01.3f", abs($mnt));
                                                                                                            //echo $mnt; 
                                                                                                            ?></strong></td>


                            </tr>
                        </table>
                    </div>
                    <br>

                </div>

            </div>
        </td>
    </tr>
</table>