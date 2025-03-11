<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reglementclient $reglementclient
 * @var string[]|\Cake\Collection\CollectionInterface $utilisateurs
 */
?>

<?php

use Cake\Datasource\ConnectionManager;
?>

<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('dalanda'); ?>



<?php if ($type == 1) { ?>
  <section class="content-header">
    <h1>
      Consulter Réglement bon livraison
      <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index/1']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
  </section>
<?php }  ?>


<?php if ($type == 2) { ?>
  <section class="content-header">
    <h1>
      Consulter Réglement factures
      <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index/2']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
  </section>
<?php } ?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
        <?= $this->Form->create($reglement, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]) ?>
        <div class="box-body">
          <div class="row">

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('numeroconca', ['label' => 'numero', 'readonly' => 'readonly']);
              ?></div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('date', ['empty' => true, 'value' => $reglement->date, 'type' => 'date', 'class' => 'form-control', 'id' => 'date']);

              ?></div>
            <!-- <div class="col-xs-6">
              <?php
              echo $this->Form->control('client_id', ['options' => $clients, 'value' => $cli, 'empty' => true, 'empty' => 'Veuillez choisir !!', 'id' => 'client_id', 'class' => 'form-control fournisseurreglement']);
              ?></div> -->



            <div class="col-xs-6">

              <div class="form-group input select required">

                <label class="control-label" for="client_id">Clients</label>

                <select name="client_id" id="client_id" class="form-control select2 control-label clientreglement " value='<?php $this->request->getQuery('client_id') ?>'>
                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                  <?php foreach ($clients as $id => $client) { ?>
                    <option <?php if ($cli == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                  <?php } ?>
                </select>

              </div>
            </div>



          </div>
          <?php if ($cli != 0) { ?>
            <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <?php if ($type == 1) { ?>

                          <!-- <td><strong> Solde Debut</strong></td>


                          <td align="center" style="color: #cd5b45 ;"><strong> <?php
                                                                                echo $compte->soldedebut;  ?></strong>
                          </td>
                          </tr> -->
                          <tr style="color: #dc143c;">
                            <th> <strong> Bon de livraison </strong>
                            </th>
                          </tr>
                          <tr style="background-color: #3C8DBC; color: white;">
                            <td hidden>id</td>
                            <td>N° Bon de livraison</td>
                            <td>Date</td>
                            <td>Total TTC</td>

                            <td>Montant réglé</td>
                            <td></td>
                            <td>Reste</td>

                            <td></td>
                          </tr>

                          <tbody> <?php

                                  if (!empty($livraisons)) {

                                    $i = -1;

                                    foreach ($livraisons as $liv) {
                                      $i++;


                                      $connection = ConnectionManager::get('default');
                                      $mon = $connection->execute("select montantreglerbl(" . $liv['id'] . ") as mont")->fetchAll('assoc');
                                      //debug($ss);die;
                                      $lig = $connection->execute('SELECT * FROM lignereglementclients WHERE lignereglementclients.reglementclient_id=' . $s . ' AND lignereglementclients.bonlivraison_id = ' . $liv['id'] . ';')->fetchAll('assoc');
                                      //debug($lig);

                                      if ($lig) {
                                        $style = "display:yes;background-color: #9bc4e2 ; font-weight: bold;";
                                      } else {
                                        $style = "display:none;background-color: #9bc4e2 ; font-weight: bold;";
                                      }
                                      //debug($style);die;
                                      if ($mon[0]['mont'] == null) {
                                        $montreg = 0;
                                      } else {
                                        $montreg = $mon[0]['mont'];
                                      }

                                      $reste = $liv['totalttc'] - $montreg;
                                      // debug($reglement) ;
                                      //if (($mon[0]['mont'] ) != $liv['totalttc']) {
                                  ?>

                                  <tr>
                                    <td><?= h($liv['numero']) ?></td>
                                    <td><?= h($liv['date']) ?></td>
                                    <td><?= h($liv['totalttc']) ?></td>
                                    <td><?= h($montreg) ?></td>
                                    <td></td>
                                    <td><?= $reste ?></td>
                                    <td>
                                      <input type="checkbox" <?php if ($lig) { ?> checked <?php } ?> name="data[Lignereglementclient][<?php echo $i; ?>][bonreception_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt calculereglementclient afficheinputmontantreglementclient" value="<?php echo $liv['id'] ?>" mnttounssi="<?php echo $liv['totalttc']; ?>" mnt="<?php echo $reste; ?>">
                                      <?php
                                        echo @$this->Form->input('Montanttt', array('value' => $lig[0]['Montant'], 'style' => $style, 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '',  'type' => 'text', 'class' => 'form-control testmontantreglementclient  chekreglementfac checkmaxfac number calculmontantt '));
                                      ?>
                                    </td>
                                  </tr>
                              <?php // }
                                    } ?>
                              <input type="hidden" name="max" value="<?php echo @$i; ?>" id="max"> <?php } ?>
                            <tr id="totalbon" style="color: #3C8DBC ; font-weight: bold;">
                              <td colspan="6"> Total Bonlivraisons</td>
                              <td colspan="3">
                                <input type="text" name="data[Reglementclient][ttpayer]" id="ttpayer" class="form-control" value="<?php echo $mtbon; ?>" readonly>
                              </td>
                            </tr>
                          <?php } ?>


                          <?php if ($type == 2) { ?>
                            <!-- <tr>
                              <td><strong> Solde Debut</strong></td>

                              <td align="center" style="color: #cd5b45 ;"><strong> <?php
                                                                                    echo $compte->soldedebut;  ?></strong>
                              </td>
                            </tr> -->
                            <tr style="color: #dc143c;">
                              <th><strong> Solde Client </strong>
                              </th>
                            </tr>
                            <tr style="background-color: #d2691e ; color: white;">

                              <td hidden>id</td>
                              <!-- <td>Type</td> -->
                              <td>Type</td>
                              <td></td>
                              <td></td>
                              <td>Montant</td>

                              <td> Solde Réglé</td>
                              <td></td>

                              <td>Reste</td>

                              <td></td>
                            </tr>

                            <?php $i = -1;
                            //debug($factureclients->toArray());
                            if (!empty($compte)) {


                              $i++;
                              // debug($i);

                              //debug($fac);
                              $connection = ConnectionManager::get('default');


                              $ligco = $connection->execute('select * from lignereglementclients where lignereglementclients.reglementclient_id=' . $idd . ' and lignereglementclients.client_id=' . $cli . ';')->fetchAll('assoc');
                              //  echo'select * from lignereglementclients where lignereglementclients.reglementclient_id=' . $idd . ' and lignereglementclients.client_id=' . $cli. ';';die;
                              // $mtfact += $lig2[0]['Montant'];
                              if ($ligco) {
                                $montregsolde += $ligco[0]['Montant'];
                              } else {
                                $montregsolde = 0;
                              }
                              if ($ligco) {
                                $style2 = "display:yes;background-color: #d2691e ; font-weight: bold;color:white;";
                                $reste =  $compte['soldedebut'] - $montregsolde;
                              } else {
                                $style2 = "display:none;background-color: #d2691e ; font-weight: bold;color:white;";
                                $reste = $compte['soldedebut'];
                              }

                              // $reste = $compte['soldedebut'] ; // - $lig;
                            ?>

                              <tr>

                                <td hidden><?= h($compte->id) ?></td>
                                <!-- <td>Solde Début</td> -->
                                <td>Solde Début</td>
                                <td></td>
                              
                                <td></td>
                                <td><?= h($compte->soldedebut) ?></td>

                                <td><?php echo  $montregsolde; ?></td>
                                <td></td>

                                <td>
                                  <?php
                                  echo $reste;
                                  //  echo $this->Form->control('rest', array('value' => $reste, 'index' => $i,  'id' => 'reste' . $i, 'label' => '', 'class' => 'form-control getrest number', 'readonly' => 'readonly'));
                                  ?>
                                </td>
                                <td>
                                  <input type="checkbox" <?php if ($ligco) { ?> checked <?php } ?> name="data[Lignereglementclient][<?php echo $i; ?>][client_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt calculereglementclient afficheinputmontantreglementclient" value="<?php echo $compte['id'] ?>" mnttounssi="<?php echo $compte['soldedebut']; ?>" mnt="<?php echo $reste; ?>">
                                  <?php
                                  echo $this->Form->input('Montanttt', array('value' => $montregsolde, 'style' => $style2, 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '',  'type' => 'text', 'class' => 'form-control testmontantreglementclient  chekreglementfac checkmaxfac number calculmontantt '));
                                  ?>

                                </td>
                              </tr>
                              <!-- <td style="display: none;">
                                <?php echo $reste; ?>
                              </td> -->
                              <!-- </tr> -->



                            <?php }  ?>







                            <!-- <input type="text" name="max" value="<?php echo $i; ?>" id="max"> -->


                            <tr style="color: #dc143c;">
                              <th><strong> Facture </strong>
                              </th>
                            </tr>

                            <tr style="background-color: #3C8DBC; color: white;">
                            <td>Type </td>
                              <td>N° </td>
                              <td>Date</td>
                              <td>Total TTC</td>

                              <td>Montant réglé</td>
                              <td><strong>Avoir</strong></td>

                              <td>Reste</td>

                              <td></td>
                            </tr>
                            <?php
                            if (!empty($factures)) {
                              // $i = -1;
                              foreach ($factures as $fac) {
                                $i++;

                                 /******************* */
                                 $connection = ConnectionManager::get('default');

                                 $totavoir = $connection->execute("select sum(factureavoirs.totalttc)as tot from factureavoirs where factureavoirs.factureclient_id =" . $fac['id'])->fetchAll('assoc');
                                 if ($totavoir['0']['tot'] == null) {
                                   $avtot = 0;
                                 } else {
                                   $avtot = $totavoir['0']['tot'];
                                 }
 
                                 /************** */
                                $mon = $connection->execute("select montantregler(" . $fac['id'] . " ) as mont")->fetchAll('assoc');
                                // debug($mon);
                                $lig = $connection->execute('select * from lignereglementclients where lignereglementclients.reglementclient_id=' . $s . ' and lignereglementclients.factureclient_id=' . $fac['id'] . ';')->fetchAll('assoc');
                                //debug($lig);

                                if ($lig) {
                                  $styler = "display:yesy;background-color:#0087bd;color:white;font-weight: bold;";
                                } else {
                                  $styler = "display:none;background-color:#0087bd;color:white;font-weight: bold;";
                                }
                                //debug($style);die;
                                if ($mon[0]['mont'] == null) {
                                  $montreg = 0;
                                } else {
                                  $montreg = $mon[0]['mont'];
                                }

                                $reste = $fac['totalttc'] - $montreg - $avtot;
                                // debug($reglement) ;
                                //if(($mon[0]['mont']-$lig[0]['Montant'])!= $fac['totalttc']+$timbre)
                                {
                            ?>

                                  <tr>
                                  <td>Facture </td>
                                    <td><?= h($fac['numero']) ?></td>
                                    <td><?= h($fac['date']) ?></td>
                                    <td><?= h($fac['totalttc']) ?></td>
                                    <td><?= h($montreg) ?></td>
                                    <td><?= h($avtot) ?></td>

                                    <td><?= $reste ?></td>
                                    <td>
                                      <input type="checkbox" <?php if ($lig) { ?> checked <?php } ?> name="data[Lignereglementclient][<?php echo $i; ?>][factureclient_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt calculereglementclient afficheinputmontantreglementclient" value="<?php echo $fac['id'] ?>" mnttounssi="<?php echo $fac['totalttc']; ?>" mnt="<?php echo $reste; ?>">
                                      <?php
                                      echo $this->Form->input('Montanttt', array('value' => $lig[0]['Montant'], 'style' => $styler, 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '',  'type' => 'text', 'class' => 'form-control testmontantreglementclient  chekreglementfac checkmaxfac number calculmontantt '));
                                      ?>

                                    </td>
                                  </tr>
                            <?php }
                              }
                            } ?>
                            <?php
                            if (!empty($factureavoirs)) {
                              $i = -1;
                              foreach ($factureavoirs as $facav) {
                                $i++;

                                // debug($fac);
                                $connection = ConnectionManager::get('default');
                                $monav = $connection->execute("select montantreglerav(" . $facav['id'] . " ) as mont")->fetchAll('assoc');
                                // debug($mon);
                                $lig = $connection->execute('select * from lignereglementclients where lignereglementclients.reglementclient_id=' .  $reglement->id . ' and lignereglementclients.factureavoir_id=' . $facav['id'] . ';')->fetchAll('assoc');
                                //debug($lig);

                                if ($lig) {
                                  $style = "display:yes;background-color: #9bc4e2 ; font-weight: bold;";
                                } else {
                                  $style = "display:none;background-color: #9bc4e2 ; font-weight: bold;";
                                }
                                //debug($style);die;
                                if ($monav[0]['mont'] == null) {
                                  $montreg = 0;
                                } else {
                                  $montreg = -$monav[0]['mont'] - $lig[0]['Montant'];
                                }

                                $reste = $facav['totalttc']  - $montreg;
                                // debug($reglement) ;
                                // if ((-$monav[0]['mont'] - $lig[0]['Montant']) != $facav['totalttc'] + $timbre)
                                {
                            ?>

                                  <tr>
                                    <td>Facture avoir</td>
                                    <td><?= h($facav['numero']) ?></td>
                                    <td><?= h($facav['date']) ?></td>
                                    <td><?= h($facav['totalttc']) ?></td>
                                    <td><?= h($montreg) ?></td>
                                    <td></td>
                                    <td><?= $reste ?></td>
                                    <td>
                                      <input type="checkbox" readonly <?php if ($lig) { ?> checked <?php } ?> name="data[Lignereglementclient][<?php echo $i; ?>][factureclientav_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt calculereglementclient afficheinputmontantreglementclient" value="<?php echo $facav['id'] ?>" mnttounssi="<?php echo -$facav['totalttc']; ?>" mnt="<?php echo $reste; ?>">
                                      <?php
                                      echo $this->Form->input('Montanttt', array('value' => -$lig[0]['Montant'], 'style' => $style, 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '',  'type' => 'text', 'class' => 'form-control testmontantreglementclient  chekreglementfac checkmaxfac number calculmontantt ', 'readonly'));
                                      ?>

                                    </td>
                                  </tr>
                            <?php }
                              }
                            } ?>

                            <input type="hidden" name="max" value="<?php echo @$i; ?>" id="max">
                            <tr id="totalefacture" style="color:#3C8DBC; font-weight: bold;">
                              <td colspan="6"> Total</td>
                              <td colspan="3">
                                <input type="text" name="data[Reglementclients][ttpayer]" id="ttpayer" class="form-control" value="<?php echo $mtfact; ?>" readonly>
                              </td>
                            </tr>
                            <!-- <tr> -->
                            <?php }  ?>

                            <!-- <th><strong> Montant </strong> </th>

                            </tr> -->
                            <tr id="montantpayer" style="color:#3C8DBC; font-weight: bold;">
                              <td colspan="6">Montant à payer</td>
                              <td colspan="3">
                                <input type="text" name='data[Reglementclients][Montant]' id="mtotal" class="form-control" value="<?php echo $reglement->Montant ?>" readonly>
                                <?php //debug($reglement)
                                ?>



                              </td>
                            </tr>
                            <tr style="color:#3C8DBC; font-weight: bold;">
                            <td colspan="6">Ecart</td>
                            <td colspan="3">
                              <input <?php if ($reglement->dif ==  1) { ?> checked <?php } ?> type="checkbox" name="diff" id="diff" index="<?php echo $i; ?>" class="" value="<?php echo $reglement->dif ?>">

                              <!-- <input <?php if ($reglement->dif ==  1) { ?> checked <?php } ?> type="checkbox" name="diff" id="diff" index="<?php echo $i; ?>" class="" value="1"> -->

                              <input type="text" name="differance" id="difference" class="form-control " value="<?php echo $reglement->differance ?>" readonly>
                            </td>
                          </tr>
                            <!-- <tr>
                              <td colspan="6">Ecart</td>
                              <td colspan="3">
                                <input type="text" name="data[Reglementclients][differance]" id="difference" class="form-control " value="0.000" readonly>
                              </td>
                            </tr> -->
                          </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
              </div>
            </section>

            <section class="content-header">
              <h1 class="box-title"><?php echo __('Mode de Réglement'); ?></h1>
            </section>

            <section class="content" style="width: 99%">
              <div class="row">
                <div class="box box-primary">
                  <div class="box-header with-border">


                  </div>
                  <div class="panel-body">
                    <div class="table-responsive ls-table">
                      <table class="table table-bordered table-striped table-bottomless" id="addtable">
                        <tr class="type" style="display: none ">
                          <td colspan="8" style="vertical-align: top;">
                            <table>
                              <tr>
                                <td>Mode de paiement </td>
                                <td>
                                  <select table="pieceregelemnt" index="" champ="paiement_id" class="modereglement2 form-control select selectized">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($paiements as $id => $paiement) {


                                    ?>
                                      <option value="<?php echo $id; ?>"><?php echo  $paiement ?></option>
                                    <?php } ?>
                                  </select>

                                  <?php echo $this->Form->input('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'pieceregelemnt', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form', 'label' => '')); ?>
                                </td>

                              </tr>
                              <tr>
                                <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbruta" table="piece" style="display:none" class="modecheque">Montant brut</td>
                                <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbrutb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                      ?> </td>
                              </tr>

                              <tr>
                                <td>Montant</td>
                                <td><?php
                                    echo $this->Form->input('montant', array('class' => 'form-control differance ', 'label' => '', 'index' => 0, 'champ' => 'montant', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant]'));
                                    ?> </td>
                              </tr>
                              <tr>
                                <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxa" table="piece" style="display:none" class="modecheque">Taux</td>
                                <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                        echo $this->Form->input('valeur_id', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => ' form-control montantbrut', 'label' => '', 'index' => 0, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][taux]', 'empty' => 'Veuillez choisir'));
                                                                                                                                                        ?> </td>
                              </tr>
                              <tr>
                                <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantneta" table="piece" style="display:none" class="modecheque">Montant Net </td>
                                <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantnetb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                    echo $this->Form->input('montant_net', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montantnet]'));
                                                                                                                                                                    ?> </td>
                              </tr>

                              <tr>
                                <td name="data[piece][0][trechance]" id="" index="0" champ="trechancea" table="piece" style="display:none" class="modecheque">Echéance </td>
                                <td name="data[piece][0][trechance]" id="" index="0" champ="trechanceb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                              echo $this->Form->input('echance', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'date', 'index' => 0, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][echance]'));
                                                                                                                                                              ?> </td>
                              </tr>

                              <tr>
                                <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanquea" table="piece" style="display:none" class="modecheque">Banque </td>
                                <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanqueb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                            echo  $this->Form->input('banque_id', array(
                                                                                                                                                              'class' => 'form-control ',
                                                                                                                                                              'empty' => 'veuillez choisir',

                                                                                                                                                              'label' => '',
                                                                                                                                                              'index' => 0,
                                                                                                                                                              'champ' => 'banque',
                                                                                                                                                              'table' => 'pieceregelemnt',
                                                                                                                                                              'name' => 'data[pieceregelemnt][0][banque_id]'
                                                                                                                                                            ));
                                                                                                                                                            ?></td>
                              </tr>

                              <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 55) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                <td name="data[piece][<?php echo $i ?>][trendosse]" id="trendossea<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Endossé</td>
                                <td name="data[piece][<?php echo $i ?>][trendosse]" id="trendosseb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                              echo $this->Form->control('endosse', array('value' => $piece->endosse, 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'id' => 'endosse' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][endosse]'));
                                                                                                                                                                              ?> </td>
                              </tr>
                              <tr>
                                <td name="data[piece][0][trnum]" id="" index="0" champ="trnuma" table="piece" style="display:none" class="modecheque">Numéro pièce </td>
                                <td name="data[piece][0][trnum]" id="" index="0" champ="trnumb" table="piece" style="display:none" class="modecheque">
                                  <div class='form-group' id="" index="0" champ="divnumc" table="piece" style="display:none">
                                    <label class='col-md-2 control-label'></label>
                                    <div class='col-sm-10' name="data[piece][0][trnum]" id="" index="0" champ="trnumc" table="piece" class="modecheque"> </div>
                                  </div>
                                  <div class='form-group' id="" index="0" champ="divnump" table="piece" style="display:none">
                                    <div class='col-sm-12'><?php echo $this->Form->input('num_piece', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][num_piece]')); ?></div>
                                  </div>
                                </td>

                              </tr>



                            </table>

                          </td>


                        </tr>
                        <?php $read = "";
                        $i = 1;
                        foreach ($piecereglementclients as $i => $piece) { //debug($piece->paiement_id); 
                        ?>
                          <tr>
                            <td colspan="8" style="vertical-align: top;">
                              <table>
                                <tr>
                                  <td>Mode de paiement </td>
                                  <td><?php
                                      echo $this->Form->control('paiement_id', array(
                                        'value' => $piece->paiement_id,
                                        'class' => 'form-control modereglement2 select2',
                                        'label' => '',
                                        'index' => $i,
                                        'id' => 'paiement_id' . $i,
                                        'table' => 'pieceregelemnt',
                                        'name' => 'data[pieceregelemnt][' . $i . '][paiement_id]'
                                      ));
                                      ?>
                                    <?php echo $this->Form->control('id', array('value' => $piece->id, 'name' => 'data[pieceregelemnt][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                    <?php echo $this->Form->control('sup', array('name' => 'data[pieceregelemnt][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>

                                  </td>
                                </tr>
                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trmontantbrut<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbruta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbruta" table="piece" class="modecheque">Montant brut</td>
                                  <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbrutb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbrutb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                  echo $this->Form->control('montant_brut', array('value' => $piece->montant_brut, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control editmontantbrut', 'label' => '', 'type' => 'text', 'index' => $i, 'champ' => 'montantbrut', 'id' => 'montantbrut' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant_brut]'));
                                                                                                                                                                                                                  ?> </td>
                                </tr>
                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trtaux<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxa<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxa" table="piece" class="modecheque">Taux</td>
                                  <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxb" table="piece" class="modecheque"><?php
                                                                                                                                                                                              echo $this->Form->control('valeur_id', array('value' => $piece->to_id, 'class' => 'form-control select editmontantbrut', 'label' => '', 'index' => $i, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][taux]', 'id' => 'taux' . $i, 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                              ?> </td>
                                </tr>
                                <tr>
                                  <td>Montant</td>
                                  <td><?php
                                      echo $this->Form->control('montant', array('value' => $piece->montant, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control differance', 'label' => '', 'index' => $i, 'champ' => 'montant', 'id' => 'montant' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant]'));
                                      ?>
                                  </td>
                                </tr>
                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trmontantnet<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantneta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantneta" table="piece" class="modecheque">Montant Net</td>
                                  <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantnetb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantnetb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                echo $this->Form->control('montant_net', array('value' => $piece->montant_net, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => $i, 'id' => 'montantnet' . $i, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montantnet]'));
                                                                                                                                                                                                                ?> </td>
                                </tr>
                                <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 54) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trechance]" id="trechancea<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Echéance</td>
                                  <td name="data[piece][<?php echo $i ?>][trechance]" id="trechanceb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                echo $this->Form->control('echance', array('value' => $piece->echance, 'class' => 'form-control datetimepicker', 'label' => '', 'type' => 'date', 'id' => 'echance' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][echance]'));
                                                                                                                                                                                ?> </td>
                                </tr>
                                <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 55) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trechance2]" id="trechancea2<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Echéance 2</td>
                                  <td name="data[piece][<?php echo $i ?>][trechance2]" id="trechanceb2<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                  echo $this->Form->control('echance2', array('value' => $piece->echance2, 'class' => 'form-control datetimepicker', 'label' => '', 'type' => 'date', 'id' => 'echance2' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][echance2]'));
                                                                                                                                                                                  ?> </td>
                                </tr>
                                <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trbanque<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Banque </td>
                                  <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                              echo  $this->Form->control('banque_id', array(
                                                                                                                                                                                'class' => 'form-control ',
                                                                                                                                                                                'empty' => 'veuillez choisir',
                                                                                                                                                                                'value' => $piece->banque_id,

                                                                                                                                                                                'label' => '',
                                                                                                                                                                                'index' => $i,
                                                                                                                                                                                'id' => 'banque' . $i,
                                                                                                                                                                                'table' => 'pieceregelemnt',
                                                                                                                                                                                'name' => 'data[pieceregelemnt][' . $i . '][banque_id]'
                                                                                                                                                                              ));
                                                                                                                                                                              ?></td>
                                </tr>

                                <tr <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?> id="trcompte<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trcompte]" id="trcompte<?php echo $i ?>" index="<?php echo $i ?>" champ="trcomptea" table="piece" class="modecheque">Compte</td>
                                  <td name="data[piece][<?php echo $i ?>][trcompte]" id="trcompte<?php echo $i ?>" index="<?php echo $i ?>" champ="trcompteb" table="piece" class="modecheque">


                                    <div name="data[<?php echo $i ?>][divsous]" id="divsous<?php echo $i ?>" index="<?php echo $i ?>"><?php
                                                                                                                                      echo $this->Form->control('compte', array(

                                                                                                                                        'value' => $piece->compte,
                                                                                                                                        'div' => 'form-group',
                                                                                                                                        'between' => '<div class="col-sm-10">',
                                                                                                                                        'after' => '</div>',
                                                                                                                                        'class' => 'form-control    ',
                                                                                                                                        'empty' => 'veuillez choisir',
                                                                                                                                        'label' => '',
                                                                                                                                        'index' => $i,
                                                                                                                                        'champ' => 'compte',
                                                                                                                                        'table' => 'pieceregelemnt',
                                                                                                                                        'name' => 'data[pieceregelemnt][' . $i . '][compte]'
                                                                                                                                      ));
                                                                                                                                      ?></div>
                                  </td>
                                </tr>
                                <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 54) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="numpiece<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trnuma]" id="trnuma<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Numero piéce</td>
                                  <td name="data[piece][<?php echo $i ?>][trnumb]" id="trnumb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                          echo $this->Form->control('num_piece', array('value' => $piece->num, 'class' => 'form-control ', 'label' => '', 'type' => 'number', 'id' => 'num' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][num_piece]'));
                                                                                                                                                                          ?> </td>
                                </tr>



                              </table>







                            </td>




                          </tr>
                        <?php } ?>
                        <input type="" value="<?php echo $i ?>" id="index" hidden>
                        </tbody>
                      </table><br>
                    </div>
                  </div>
                </div>
              </div>


            </section>

          <?php } ?>



          <!-- /.box-body -->


        </div>
        <!-- /.box -->
      </div>

      <!-- /.row -->
</section>


<?php echo $this->Html->script('alert'); ?>



<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
      'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      format: 'MM/DD/YYYY h:mm A'
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    })
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<?php $this->end(); ?>


<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-d    a        t              epicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('select').attr('disabled', 'true');
    $('select2').attr('readonly', 'readonly');
    $('input[type="checkbox"]').attr('disabled', 'true');
    $('input,textarea').attr('readonly', 'readonly');

    //Initialize Select2 Elements
    $('.select2').select2()
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
      'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      format: ' MM/DD/YYYY h:mm A'
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    })
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<?php $this->end(); ?>