<?php $this->layout = 'AdminLTE.print'; ?>
<br>
<div style="display:flex">
  <div style="margin-left:6%">
    <?php
    echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '140px', 'width' => '200px']); ?>
  </div>
  <div style="width: 75%;margin-left:23%" class="box" align="left">
    Société CODIFA <br>
    Rte Fouchana 1.8 km 1135 naassen <br>
    Phone : (+216) 71 398 404 / (+216) 71 398 158 <br>
    Mail : codifa@gnet.tn <br>
  </div>
</div>
<br><br>
<h3 align="center">
  Relevé Commercials
</h3>
<h3 align="center">
    <?php
    $Date_debut = $this->Time->format($Date_debut, 'dd/MM/y');
    $Date_fin = $this->Time->format($Date_fin, 'dd/MM/y');

    echo 'Du ' . $Date_debut . ' au ' . $Date_fin ?>
</h3>
<table width="100%">
    <tbody>
    <tr>
            <td width="50%">
                Commercial : <?php echo $thiscommercial->name ?>

            </td>
            <td width="25%">
                Type : <?php echo $thiscommercial->category->name ?>

            </td>
            <td width="25%">
                Prix : <?php echo $thiscommercial->category->valeur ?>

            </td>
        </tr>
    </tbody>
</table>

<table class="table table-bordered table-striped table-bottomless" style="border:2px solid black;">
  <thead>
    <tr>
      <th width="10%" class=" text-center"><?= ('Date') ?></th>
      <th width="52%" class=" text-center"><?= ('Client') ?></th>
      <th width="10%" class=" text-center"><?= ('Total point') ?></th>
      <th width="10%" class=" text-center"><?= ('Débit') ?></th>
      <th width="10%" class=" text-center"><?= ('Crédit') ?></th>
    </tr>
  </thead>
  <tbody>
              <tr>
                <td></td>
                <?php $spaces = str_repeat('&nbsp;', 25); ?>
                <td  align="center"><strong>SOLDE</strong><?php echo $spaces. ' '. number_format(@$solde, 3, '.', ' '); ?> </td>
       
                <td colspan="4" align="center"></td>
              </tr>
              <?php
              $tot = 0;
              $totcr = 0;
              $tots = 0;
              $totdebM = 0;
              $totcredM = 0;

              if ($dat) {
                foreach ($dat as $k => $v) {
                  $avis[$k] = $v['date'];
                }
                array_multisort($avis, SORT_ASC, $dat);
                // debug($dat);die;

                foreach ($dat as $i => $relefe) :
  if (@$relefe['debitM'] == "0.000" || @$relefe['debitM'] == null) {
                       $tot = $tot - $relefe['debit'];
                  }
                    if (@$relefe['creditM'] == "0.000" || @$relefe['creditM'] == null) {
                       $tot = $tot + $relefe['debit'];
                    }
                //  $tot = $tot + $relefe['debit'];
                  $totcr = $totcr + $relefe['credit'];
                  $tots = ($tot - $totcr) + $solde;

                  $totdebM = $totdebM + $relefe['debitM'];
                  $totcredM = $totcredM + $relefe['creditM'];


              ?>
                  <tr style="background-color:#d9dedd;">
                    <td align="center"><?php echo date("d/m/Y", strtotime(str_replace('-', '/', @$relefe['date']))); ?></td>
                    <td align="center"><?php echo @$relefe['type']; ?>
                      <?php if (@$relefe['ty'] != "") { ?>
                        <?php echo date("d/m/Y", strtotime(str_replace('-', '/', @$relefe['datedebut']))); ?>
                        au <?php echo date("d/m/Y", strtotime(str_replace('-', '/', @$relefe['datefin']))); ?>
                      <?php  } ?>
                      N° <?php echo @$relefe['numero']; ?>
                      <?php echo (@$relefe['clients']); ?>
                      <?php

                      foreach ($dat[$i]['ligne'] as $j => $rel) :   $chaine = ''; ?>
                        <?php if (@$rel['nouv_client'] == "TRUE") { ?>
                        <?php $chaine = '(nv_client)';
                        } else {
                          $chaine = '';
                        }
                        ?>


                      <?php endforeach; ?>
                      <?php echo $chaine; ?>
                      <?php echo @$relefe['paiements']; ?>
                    </td>

                    <td> <?php if (@$relefe['debit'] == "0.000") {
                            echo '';
                          } else {
                            echo (@$relefe['debit']);
                          } ?></td>
                    <!-- <td> <?php if (@$relefe['credit'] == "0.000") {
                                echo '';
                              } else {
                                echo (@$relefe['credit']);
                              } ?></td> -->
                    <td>
                    <?php if (@$relefe['debitM'] == "0.000" || @$relefe['debitM'] == null) {
                            echo '';
                          } else {
                               if (@$rel['nouv_client'] == "TRUE"){
                                  @$relefe['debitM']=@$relefe['debitM']*2;
                              }
                            echo (@$relefe['debitM']);
                          } ?>
                    </td>

                    <td>
                    <?php if (@$relefe['creditM'] == "0.000" || @$relefe['creditM'] == null) {
                                echo '';
                              } else {
                                echo (@$relefe['creditM']);
                              } ?>

                    </td>


                  </tr>
                  <tr class='montreg' style="display: none !important" id="montreg<?php echo $i; ?>">
                    <td colspan="4" width="100%">
                      <table align="center" class="table table-bordered table-striped table-bottomless">
                        <thead>
                          <tr>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>Nb points</th>
                            <th>Total nb points</th>
                          </tr>
                        </thead>
                        <?php
                        foreach ($dat[$i]['ligne'] as $j => $rel) :
                          // debug($rel) ; die ;
                        ?>
                          <tr>
                            <td width="60%">
                              <?php if (@$rel['montantss'] > 0) { ?>
                                Bonus article :
                              <?php  } ?>
                              <?php if (@$rel['montantss'] < 0) { ?>
                                Malus article :
                              <?php  } ?>
                              <?php echo @$rel['articles']; ?>
                              <?php if (@$rel['nouv_client'] == "FALSE") { ?>
                                <?php if (@$rel['nouv_article'] == "TRUE") { ?>
                                  (nv_article)
                                <?php  } ?>
                              <?php  } ?>
                              <?php echo @$relefe['articles']; ?>

                              <?php if (@$rel['lignebonlivraison_id'] != 0) { ?>
                                Com BL N° <?php echo @$rel['numero']; ?><br><?php echo @$rel['arti']; ?>
                              <?php  } ?>
                              <?php if (@$rel['lignebonusmalu_id'] != 0) { ?>
                                Bonus/Malus <?php echo @$rel['num']; ?><br><?php echo @$rel['art']; ?>
                              <?php  } ?>
                            </td>
                            <td>
                              <?php echo @$rel['qte']; ?>

                            </td>
                            <td>
                              <?php echo @$rel['nbpoint']; ?>

                            </td>
                            <td>
                              <?php
                              $comligne = 0;
                              if (@$rel['nouv_client'] == "TRUE") {
                                $comligne =  @$rel['nbpoint'] * @$rel['qte'] * 2;
                              } else {
                                $comligne =   @$rel['nbpoint'] * @$rel['qte'];
                              }

                              echo  $comligne;
                              ?>

                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </table>
                    </td>
                  </tr>
              <?php endforeach;
              } ?>
          
              <tr>
                <td colspan="2" align="center"><b> Total </b></td>
                <td align="center"> <?php echo number_format(@$tot, 3, '.', ' '); ?></td>
                <td align="center"> <?php echo number_format(@$totdebM, 3, '.', ' '); ?></td>
                <td align="center"> <?php echo number_format(@$totcredM, 3, '.', ' '); ?></td>

              </tr>
              <tr>
                <td colspan="2" align="center"><b> Total</b></td>
                <td colspan="2" align="center"> <?php echo number_format(@$totdebM-@$totcredM, 3, '.', ' '); ?></td>
              </tr>
  </tbody>
</table>
<br>