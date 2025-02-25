<?php $this->layout = 'AdminLTE.print'; ?>

<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Agence $agence
 */
?>
<?php echo $this->Html->css('select2'); ?>
<?php

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default');


$agence = $connection->execute('SELECT *  FROM agences WHERE id=' . $bordereauversementcheque->compte->agence_id . ';')->fetchAll('assoc');
$societe = $connection->execute('SELECT *  FROM societes ;')->fetchAll('assoc');
//debug($societe);die;
?>


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <table>
        <tr>
          <td width="20%">


            <?php echo $this->Html->image('logoSMBM.png', ['style' => 'max-width:150px;height:150px;']); ?>

          </td>
          <td style="width:5%!important;"> </td>
          <td>
            <?php if($bordereauversementcheque->type == 2){?>
            <h1 align="center" style="margin-top:7%!important;">BORDEREAU DE VERSEMENT</h1>
            <?php }else if($bordereauversementcheque->type == 1){?>
              <h1 align="center" style="margin-top:7%!important;">BORDEREAU DE VERSEMENT TRAITE</h1>
              <?php }?>
          </td>
        </tr>
      </table>

      <table width="90%">
        <tr>
          <td>
            <h2> <?php
                  echo $societe[0]['nom'];
                  ?>
            </h2>
          </td>
          <td style="text-align: center;">
            <h5>
              <?php
              echo 'N°Bordereau : ' . $bordereauversementcheque->numero;
              ?>
            </h5>
          </td>
        </tr>
        <tr>
          <td>
            <h5>
              <?php
              echo 'R.I.B : ' . $societe[0]['rib'];

              // echo 'Adresse : ' . $societe[0]['adresse'];
              ?>
            </h5>
          </td>
          <td style="text-align: center;">
            <h5>
              <?php
              echo 'Date : ' . $this->Time->format(
                $bordereauversementcheque->dateimp,
                'dd/MM/y'
              );
              ?>
            </h5>
          </td>

        </tr>
      </table>



      <div class="row">

        <table class="tbborder" style="width:100%" align="center">
          <thead>
            <tr>
              <td class="tdborder" align="center" style="width:5%" nowrap="nowrap"></td>
              <td class="tdborder" align="center" style="width:20%" nowrap="nowrap">Banque Payeur</td>

              <td class="tdborder" align="center" style="width:20%" nowrap="nowrap">N° Pièce</td>
              <td class="tdborder" align="center" style="width:35%" nowrap="nowrap">Tireur (Emetteur)</td>
              <td class="tdborder" align="center" style="width:20%" nowrap="nowrap">Montant</td>

            </tr>
          </thead>
          <tbody>
            <?php $i = 0;
            $f = 0;
            $sum = 0;
            //debug($lignebordereauversementcheques);die;
            foreach ($lignebordereauversementcheques as $i => $lg) {
              $f++;
              $piece = $connection->execute('SELECT piecereglementclients.id as idp,piecereglementclients.num,piecereglementclients.montant,piecereglementclients.banque_id as bnq ,reglementclients.id as idr,reglementclients.client_id as idc,clients.Raison_Sociale as rs  FROM piecereglementclients,reglementclients,clients WHERE piecereglementclients.reglementclient_id=reglementclients.id and reglementclients.client_id=clients.id and  piecereglementclients.id=' . $lg['piecereglementclient_id'] . ';')->fetchAll('assoc');
              $sum += $piece[0]['montant'];
              if ($piece['bnq']) {
                $bnq = $connection->execute('SELECT name FROM banques WHERE banques.id=' . $piece['bnq'] . ';')->fetchAll('assoc');
              }
            ?>

              <tr class="tr">
                <td class="tdborder" align="center"><?php echo $f ?></td>
                <td class="tdborder">&thinsp;&thinsp;<?php echo $bnq[0]['name'] ?>&thinsp;&thinsp;</td>

                <td class="tdborder" align="center">&thinsp;&thinsp;<?php echo $piece[0]['num'] ?>&thinsp;&thinsp;</td>

                <td class="tdborder">&thinsp;&thinsp;<?php echo $piece[0]['rs'] ?>&thinsp;&thinsp;</td>

                <td class="tdborder" align="right">&thinsp;<?php echo  h(number_format(abs($piece[0]['montant']), 3, ',', ' ')); ?>&thinsp;</td>
                </td>
              </tr>

            <?php } ?>

          </tbody>
        </table>
        <input type="hidden" value="<?php echo $i; ?>" id="index" />

      </div>
      <table width="100%">
        <tr>
          <td></td>
          <td style="text-align:right;">
            <h4>
              <?php
                                                     

              echo 'Montant total en DT : ' . number_format(abs($sum), 3, ',', ' ');// number_format($sum, 3, '.', ',');
              ?>
            </h4>
          </td>
        </tr>
      </table>

      <div class="row">
        <table class="tbborder" width="100%">
          <thead>
            <tr>
              <th class="tdborder">Date de l'opération</th>
              <th class="tdborder">Signature de la partie versante</th>
              <th class="tdborder">Cachet et visa de la banque</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td align="center" class="tdborder"> <br><br><?php
                                                            echo  $this->Time->format(
                                                              $bordereauversementcheque->dateimp,
                                                              'dd/MM/y'
                                                            );
                                                            ?><br><br><br></td>
              <td class="tdborder"></td>
              <td class="tdborder"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<style>
  .tbborder,
  .tdborder {
    border: 1px solid black;
    border-collapse: collapse;
  }
</style>