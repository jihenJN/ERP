<?php

use Cake\ORM\TableRegistry;
?>

<section class="content" style="width: 99%">
    <div class="row">
        <h3> Réglement Offre de prix N° <?php echo $bonlivraison->numero ?></h3>
    </div>
    <br>
    <div class="row">
        <div class="box box-primary">
            <table class="table table-bordered table-striped table-bottomless">
                <tbody>
                    <tr>
                        <td><strong>Mode de paiement </strong></td>
                        <td><strong>Montant</strong></td>
                        <!-- <td><strong>taux</strong></td>
                        <td><strong>Montant net</strong></td> -->
                        <td><strong>Echéance</strong></td>
                        <td><strong>Banque</strong></td>
                        <td><strong>Numero piéce</strong></td>
                        <td><strong>Caisse</strong></td>
                        <td></td>

                    </tr>



                    <?php

                    $totaltotal = 0;

                    $totalmnt = 0;

                    foreach ($lignereglements as $lrc) {
                        $piecereglementclientsTable = TableRegistry::getTableLocator()->get('Piecereglementclients');
                        $piecereglementclientoffres =[];
                        if ($lrc->reglementclient_id!=null){
                        $piecereglementclientoffres = $piecereglementclientsTable->find()
                            ->where(['reglementclient_id' => $lrc->reglementclient_id])->contain(['Paiements', 'Caisses', 'Banques'])
                            ->toArray();
                        }






                        $read = "";
                        $i = 1;
                        foreach ($piecereglementclientoffres as $i => $piece) { //debug($piece); 


                            $totalmnt += $piece->montant;
                    ?>
                            <tr>



                                <td><?php
                                    echo  $piece->paiement->name;
                                    ?>

                                </td>
                                <td><?php
                                    echo  $piece->montant;
                                    ?>

                                </td>
                                <!-- <td><?php
                                            echo $piece->to->name;
                                            ?>

                            </td>
                            <td>
                                <?php
                                echo $piece->montant_net;
                                ?>
                            </td> -->

                                <td>
                                    <?php
                                    echo  $this->Time->format($piece->echance, 'dd/MM/y');
                                    ?>
                                </td>

                                <td><?php
                                    echo $piece->banque->name;
                                    ?>

                                </td>

                                <td>
                                    <?php
                                    echo $piece->num;
                                    ?>
                                </td>
                                <td><?php
                                    echo $piece->caiss->name;
                                    ?>
                                </td>
                                <td>
                                    <div>
                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('controller'=>'Reglementclients','action' => 'edit/2/'. $piece->reglementclient_id), array('escape' => false)); ?>
                                    </div>
                                </td>
                            </tr>
                    <?php }
                    } ?>




                </tbody>
            </table>
            <br>
            <table style=width:30% class="table table-bordered table-striped table-bottomless pull-right">
                <tbody>
                    <tr>
                        <td><strong>Montant total</strong></td>
                        <td><?php echo sprintf("%01.3f", $totalmnt); ?></td>
                        <input type='hidden' value="<?php echo $totalmnt ?>" id="totalmnt">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <?php
    // debug($lignereglementcmds);

    if (!empty($lignereglementcmds)) { ?>


        <div class="row">
            <h3> Réglement Commande N° <?php echo $commande->numero ?></h3>
        </div>
        <br>



        <div class="row">
            <div class="box box-primary">
                <table class="table table-bordered table-striped table-bottomless">
                    <tbody>
                        <tr>
                            <td><strong>Mode de paiement </strong></td>
                            <td><strong>Montant</strong></td>
                            <!-- <td><strong>taux</strong></td>
                        <td><strong>Montant net</strong></td> -->
                            <td><strong>Echéance</strong></td>
                            <td><strong>Banque</strong></td>
                            <td><strong>Numero piéce</strong></td>
                            <td><strong>Caisse</strong></td>
                            <td></td>

                        </tr>



                        <?php

                        $totalmntcmd = 0;

                        foreach ($lignereglementcmds as $lrcmd) {
                            $piecereglementclientsTable = TableRegistry::getTableLocator()->get('Piecereglementclients');
                            $piecereglementclientcmds =[];
                            if ($lrcmd->reglementclient_id!=null){
                            $piecereglementclientcmds = $piecereglementclientsTable->find()
                                ->where(['reglementclient_id' => $lrcmd->reglementclient_id])->contain(['Paiements', 'Caisses', 'Banques'])
                                ->toArray();
                            }






                            $read = "";
                            $i = 1;
                            foreach ($piecereglementclientcmds as $i => $piece) { //debug($piece); 


                                $totalmntcmd += $piece->montant;
                        ?>
                                <tr>



                                    <td><?php
                                        echo  $piece->paiement->name;
                                        ?>

                                    </td>
                                    <td><?php
                                        echo  $piece->montant;
                                        ?>

                                    </td>
                                    <!-- <td><?php
                                                echo $piece->to->name;
                                                ?>

                            </td>
                            <td>
                                <?php
                                echo $piece->montant_net;
                                ?>
                            </td> -->

                                    <td>
                                        <?php
                                        echo  $this->Time->format($piece->echance, 'dd/MM/y');
                                        ?>
                                    </td>

                                    <td><?php
                                        echo $piece->banque->name;
                                        ?>

                                    </td>

                                    <td>
                                        <?php
                                        echo $piece->num;
                                        ?>
                                    </td>
                                    <td><?php
                                        echo $piece->caiss->name;
                                        ?>
                                    </td>
                                    <td>
                                    <div>
                                        <?php echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('controller'=>'Reglementclients','action' => 'edit/2/'. $piece->reglementclient_id), array('escape' => false)); ?>
                                    </div>
                                </td>
                                </tr>
                        <?php }
                        } ?>




                    </tbody>
                </table>
                <br>
                <table style=width:30% class="table table-bordered table-striped table-bottomless pull-right">
                    <tbody>
                        <tr>
                            <td><strong>Montant total</strong></td>
                            <td><?php echo sprintf("%01.3f", $totalmntcmd); ?></td>
                            <input type='hidden' value="<?php echo $totalmntcmd ?>" id="totalmntcmd">
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>

    <br>
    <div class="row">
    <div class="box box-primary">

        <table style="width:30%;color:green" class="table table-bordered table-striped table-bottomless pull-right">
            <tbody>
                <tr>
                    <?php $totaltotal = $totalmntcmd + $totalmnt;
                    $reste = $bonlivraison->totalttc - $totaltotal; ?>
                    <td width="67%"><strong>Net à payer</strong></td>
                    <td><strong><?php echo sprintf("%01.3f", $bonlivraison->totalttc); ?></strong></td>
                </tr>
                <tr>
                    <td><strong>Total réglé</strong></td>
                    <td><strong><?php echo sprintf("%01.3f", $totalmntcmd + $totalmnt); ?></strong></td>
                    <input type='hidden' value="<?php echo $totalmntcmd + $totalmnt ?>" id="totaltotal">
                </tr>
                <tr>
                    <td><strong>Reste</strong></td>
                    <td><strong><?php echo sprintf("%01.3f", $reste); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
</section>