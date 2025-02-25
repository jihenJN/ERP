<?php $this->layout = 'AdminLTE.print'; ?>
<style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style>

<div style="display:flex;">
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
                S.web : www.sirep-prefa.com.tn<br>
				M.F: 1001267P/NW000<br>
				R.C: 80827832007<br>
				</strong>
        </td>
        <td align="center" style="width: 25%;border: none;">
            <div>
                <?php
                echo $this->Html->image('ISO-9001.png', ['alt' => 'CakePHP', 'height' => '50px', 'width' => '100%']); ?>

            </div>
        </td>

        </td>
    </table>
</div>
<br><br><br>
<h2 style="margin-left: 5px ;">
    État historique article
</h2>

<table class="table table-bordered table-striped" style="width: 100%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;" height="200px">
    <tr>
        <th width="10%" class="actions text-center"> <?php echo ('Date '); ?></th>
        <th width="10%" class="actions text-center "><?php echo ('Action'); ?></th>
        <th width="10%" class="actions text-center "><?php echo ('Dépot'); ?></th>
        <th width="10%" class="actions text-center "><?php echo ('Numéro'); ?></th>
        <th width="20%" class="actions text-center "><?php echo ('Client'); ?></th>
        <th width="10%" class="actions text-center "><?php echo ('Entrée'); ?></th>
        <th width="10%" class="actions text-center "><?php echo ('Sortie'); ?></th>
        <th width="10%" class="actions text-center "><?php echo ('PU HT'); ?></th>
        <th width="10%" class="actions text-center "><?php echo ('TOT HT'); ?></th>

    </tr>
    <?php
    $nb = 0;
    $qte_ent = 0;
    $qte_sor = 0;
    $qte_final = 0;
    //debug($historiquearticles);die;
    foreach ($historiquearticles as $historiquearticle) {
        // debug($historiquearticle);
        $nb = $nb + 1;
        ///     debug($historiquearticle);
        if (!empty($historiquearticle['date'])) {
        } else {
            $date = "";
        }
        // if($historiquearticle['indice']==4){
        //     $qte_ent= $qte_ent + sprintf("%.3f",$historiquearticle['qte']);
        // }


        if ($historiquearticle['indice'] == 4) {
            $qte_sor = 0;
            $qte_ent = sprintf("%.3f", $historiquearticle['qte']);
            $qte_sor = $qte_sor;
        }

        //debug($qte_ent);

        if (($historiquearticle['mode'] == "Entreé") && ($historiquearticle['indice'] != 4)) {
            $qte_ent = $qte_ent + sprintf("%.3f", $historiquearticle['qte']);
            ///debug($qte_ent);
        }

        ///debug($qte_ent);


        if ($historiquearticle['mode'] == "Sortie") {
            $qte_sor = $qte_sor + sprintf("%.3f", $historiquearticle['qte']);
        }
        $qte_final = sprintf("%.3f", $qte_ent) - sprintf("%.3f", $qte_sor);
        //debug($qte_final);
    ?>
        <tr>

            <?php
            $date = date("Y-m-d H:i:s", strtotime(str_replace('-', '/',  $historiquearticle['date'])));
            ?>


            <td align="center"><?php echo $date; ?></td>
            <td align="center"><?php echo $historiquearticle['type']; ?></td>
            <td align="center"><?php echo $historiquearticle['depot']; ?></td>
            <td align="center"><?php echo $historiquearticle['numero']; ?></td>
            <td align="center">
                <?php if ($historiquearticle['type'] != 'Inventaire')  echo $clientcod;
                else {
                    echo '';
                } ?>

            </td>


            <?php if ($historiquearticle['indice'] == 4) { ?>
                <td align="center" colspan="2">
                    <?php
                    if ($historiquearticle['qte'] == null) {
                        echo '0';
                    } else {
                        echo $historiquearticle['qte'];
                    }

                    ?>
                </td>


            <?php } else {  ?>
                <td align="center">
                    <?php
                    if ($historiquearticle['mode'] == "Entreé") {
                        echo $historiquearticle['qte'];
                    }
                    ?>&nbsp;
                </td>
                <td align="center">
                    <?php
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
        <td align="center"><?php echo $qte_ent ?></td>
        <td align="center"><?php echo  $qte_sor ?></td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="5"></td>
        <td colspan="2" align="center"><?php echo @$qte_final; ?></td>
        <td colspan="4"></td>
    </tr>
</table>