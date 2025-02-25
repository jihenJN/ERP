<table align="center" style="width: 80%;" class="table table-bordered table-striped table-bottomless" id="tab">



    <tr>
        <th style="width:15% ;"> </th>
        <?php
        //   $i = 1;
        //debug($i);
        foreach ($mois as $m) : //debug($m); 
        ?>
            <th style="width: 1%;text-align:center" colspan="3"> <?php echo $m->name  ?> </th>
        <?php endforeach; ?>
        <th rowspan="2" width="30px" style="text-align:center"> Montant</th>

    </tr>
    <tr>
        <th> Article</th>
        <?php foreach ($mois as $m) : //debug($m);  
        ?>
            <th style="width: 10%; font-size:10px "> Objectif</th>
            <th style="width: 10%;font-size:10px "> Qte livrée</th>
            <th style="width: 10%;font-size:10px "> Ecart</th>
        <?php endforeach; ?>

    </tr>
    <?php //debug($tab); 
    ?>

    <?php $total = 0;
    $montant = 0;
    foreach ($tab as $i => $s) :




    ?>



        <tr style="height:20px">
            <td>
                <?php echo $i  ?>
            </td>

            <?php $a = 0;
            foreach ($s as $ii) : //debug($ii);
                $montant += $ii['mon'];
              //  debug($ii);
            ?>

            <td>

                <input readonly name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][objectif]' ?>" value="<?php echo $ii['objectif'] ?>" style="height:30px;width:80%" type="text" class="form-control">
                    <input name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][article_id]' ?>" value="<?php echo $ii['article_id'] ?>" style="height:30px;width:80%" type="hidden" class="form-control">
                    <input name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][mois]' ?>" value="<?php echo $ii['mois'] ?>" style="height:30px;width:50px" type="hidden" class="form-control">


                    <input name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][mon]' ?>" value="<?php echo $ii['mon'] ?>" style="height:30px;width:80%" type="hidden" class="form-control">





                </td>




                <td >
                    <input readonly  name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][qteliv]' ?>" value="<?php echo $ii['qteliv'] ?>" style="height:30px;width:80%" type="text" class="form-control">
                </td>



                <td>
                    <input  readonly  name="<?php echo 'data[bonusmalus][' . $ii['article_id'] . '][' . $a . '][ecart]' ?>" value="<?php echo $ii['ecart'] ?>" style="height:30px;width:80%" type="text" class="form-control">
                </td>




            <?php $a = $a + 1;
            endforeach;  ?>
            <td style="width: 30px;">
                <input readonly value="<?php echo $montant ?>" style="height:30px;width:90%" type="text" class="form-control">
            </td>





        </tr>
        <?php $total += $montant;
        $montant = 0;
        ?>
    <?php endforeach; ?>
    <?php //$i + 1 
    ?>

    <input name="total" value="<?php echo $total ?>" style="height:30px;width:90%" type="hidden" class="form-control">



</table>