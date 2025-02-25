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
<table class="table table-bordered table-striped table-bottomless" style="border:2px solid black;">
  <thead>
    <tr>
      <th width="15%" class=" text-center" style="border:4px solid black;"><?= ('Date Opération') ?></th>
      <th width="52%" class=" text-center" style="border:4px solid black;"><?= ('Libele') ?></th>
      <th width="15%" class=" text-center" style="border:4px solid black;"><?= ('Debit') ?></th>
      <th width="15%" class=" text-center" style="border:4px solid black;"><?= ('Credit') ?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="2" align="center" style="border:3px solid black;"><strong>SOLDE</strong></td>
      <td colspan="4" align="center" style="border:3px solid black;"><?php echo number_format(@$solde, 3, '.', ' '); ?></td>
    </tr>
    <?php
    $tot = 0;
    $totcr = 0;
    $tots = 0;
    if ($dat) {
      foreach ($dat as $k => $v) {
        $avis[$k] = $v['date'];
      }
      array_multisort($avis, SORT_ASC, $dat);
      //  debug($dat);die;
      foreach ($dat as $i => $relefe) :
        $tot = $tot + $relefe['debit'];
        $totcr = $totcr + $relefe['credit'];
        $tots = ($tot - $totcr) + $solde;
    ?>
        <tr>
          <td align="center" style="border:2px solid black;"><?php echo date("d/m/Y", strtotime(str_replace('-', '/', @$relefe['date']))); ?></td>
          <td align="center" style="border:2px solid black;"><?php echo @$relefe['type']; ?>
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
          <td style="border:2px solid black;"> <?php if (@$relefe['debit'] == "0.000") {
                                                  echo '';
                                                } else {
                                                  echo (@$relefe['debit']);
                                                } ?></td>
          <td style="border:2px solid black;"> <?php if (@$relefe['credit'] == "0.000") {
                                                  echo '';
                                                } else {
                                                  echo (@$relefe['credit']);
                                                } ?></td>
        </tr>
        <tr class='montreg' id="montreg<?php echo $i; ?>">
          <td style="border:1px solid black;" colspan="4" width="100%">
            <table class="table table-bordered table-striped table-bottomless">
              <?php
              foreach ($dat[$i]['ligne'] as $j => $rel) :
                // debug($rel) ; die ;
              ?>
                <tr>
                  <td width="60%" style="border:1px solid black;white-space: nowrap;">
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
                  <td style="border:1px solid black;" width="60%"><?php echo @$rel['montantcommissions']; ?><?php echo @$rel['montantss']; ?><?php echo @$rel['montants']; ?></td>
                </tr>
              <?php endforeach; ?>
            </table>
          </td>
        </tr>
    <?php endforeach;
    } ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="2" align="center" style="border:3px solid black;"><b> Total Debit/Credit</b></td>
      <td align="center" style="border:3px solid black;"> <?php echo number_format(@$tot, 3, '.', ' '); ?></td>
      <td align="center" style="border:3px solid black;"> <?php echo number_format(@$totcr, 3, '.', ' '); ?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" style="border:3px solid black;"><b> Total</b></td>
      <td colspan="2" align="center" style="border:3px solid black;"> <?php echo number_format(@$tots, 3, '.', ' '); ?></td>
    </tr>
  </tfoot>
</table>
<br>