<?php $this->layout = 'AdminLTE.print'; ?>
<?php
use Cake\Datasource\ConnectionManager;


use Cake\ORM\TableRegistry;

?>


<?php
$connection = ConnectionManager::get('default');

$societeTable = TableRegistry::getTableLocator()->get('Societes');

$societe = $societeTable->find()->where('id=1')->first();

?>
<style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style>

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
</div><br>
<h2 style="margin-left: 5px ;">
    État historique article KG

</h2>

<table id="example1" class="table table-bordered" style="border-width : 1px;">
    <tr style="background-color:#367FA9;color:#ffffff;">
        <td width="12%" class="actions text-center"> <?php echo ('Date '); ?></td>
        <td width="15%" class="actions text-center "><?php echo ('Action'); ?></td>
        <td width="9%" class="actions text-center "><?php echo ('Dépot'); ?></td>
        <td width="7%" class="actions text-center "><?php echo ('Numéro'); ?></td>
        <td width="10%" class="actions text-center "><?php echo ('Client'); ?></td>
        <td width="15%" class="actions text-center "><?php echo ('Entrée'); ?> </td>

        <td width="15%" class="actions text-center "><?php echo ('Sortie'); ?> </td>

        <td width="9%" class="actions text-center "><?php echo ('PU HT'); ?></td>
        <td width="9%" class="actions text-center "><?php echo ('TOT HT'); ?></td>

    </tr>
    <tr>
        <td align="center" colspan="5"> <strong>Solde </strong></td>

        <td align="center" colspan="2"> <strong><?php echo $soldee; ?> </strong></td>
        <td align="center" colspan="2"></td>

    </tr>
    <?php
    $nb = 0;
    $qte_ent = $soldee;
    $qte_ent1 = 0;
    $qte_sor = 0;

    $qte_final = 0;

    foreach ($historiquearticles as $historiquearticle) {
        // debug($historiquearticle);
        $nb = $nb + 1;
        ///     debug($historiquearticle);
        if (!empty($historiquearticle['date'])) {
        } else {
            $date = "";
        }



        if ($historiquearticle['indice'] == 4) {
            $qte_sor = 0;

            $qte_ent = $historiquearticle['qte'];
            $qte_sor = $qte_sor;
        }

        //debug($qte_ent);

        if (($historiquearticle['mode'] == "Entreé") && ($historiquearticle['indice'] != 4)) {
            $qte_ent = $qte_ent + sprintf("%.3f", $historiquearticle['qte']);
        }




        if ($historiquearticle['mode'] == "Sortie") {
            $qte_sor = $qte_sor + sprintf("%.3f", $historiquearticle['qte']);
        }
        $qte_final = sprintf("%.3f", $qte_ent) - sprintf("%.3f", $qte_sor);

    ?>

        <tr>
            <?php
            // $date = date("Y-m-d H:i:s", strtotime(str_replace('-', '/',  $historiquearticle['date'])));
            $date = $this->Time->format($historiquearticle['date'], 'dd/MM/y HH:mm:ss');
            ?>
            <?php
            // $date = date("Y-m-d H:i:s", strtotime(str_replace('-', '/',  $historiquearticle['date'])));

            ?>
            <td align="center"><?php echo $date ?></td>
            <td align="center"><?php echo $historiquearticle['type']; ?></td>
            <td align="center"><?php echo $historiquearticle['depot']; ?></td>
            <td align="center"><?php echo $historiquearticle['numero']; ?></td>
            <td align="center">
                <?php if ($historiquearticle['type'] != 'Inventaire' && $historiquearticle['type'] != 'Lancer Ordre fabrication' && $historiquearticle['type'] != 'Validation Ordre fabrication') {
                    echo $clientcod;
                } else {
                    echo '';
                } ?>

            </td>


            <?php if ($historiquearticle['indice'] == 4) { ?>
                <td align="center">
                    <?php
                    if ($historiquearticle['qte'] == null) {
                        echo '0';
                    } else {
                        echo $historiquearticle['qte'];
                    }

                    ?>
                </td>


            <?php } else {  ?>

                <td align="center"> <?php
                                    if ($historiquearticle['mode'] == "Entreé") {
                                        echo $historiquearticle['qte'];
                                    }
                                    ?>&nbsp;

                </td>


                <td align="center"> <?php
                                    if ($historiquearticle['mode'] == "Sortie") {
                                        echo $historiquearticle['qte'];
                                    }
                                    ?>&nbsp;
                </td>





            <?php }  ?>
            <td align="center"><?php echo $historiquearticle['pu']; ?></td>
            <td align="center"><?php echo $historiquearticle['ptot']; ?></td>
        </tr>

    <?php } ?>
    <tr>
        <td colspan="5"></td>

        <td align="center" style="color: #008000;"> <strong><?php echo $qte_ent ?> </strong></td>


        <td align="center" style="color: #4f86f7;"> <strong><?php echo  $qte_sor ?> </strong></td>

        <td colspan="2"></td>

    </tr>
    <tr>
        <td colspan="5"></td>
        <td colspan="2" style="background-color:#367FA9" align="center"> <strong>
                <?php echo @$qte_final  ?>
            </strong>



        <td colspan="2"></td>
    </tr>
</table>