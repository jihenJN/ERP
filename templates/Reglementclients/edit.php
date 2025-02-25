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
      Modifier Réglement bon livraison
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
      Modifier Réglement factures
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
              ?>
            </div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('date', ['empty' => true, 'class' => 'form-control', 'id' => 'date', 'type' => 'date']);
              echo $this->Form->control('type', ['label' => 'Type', 'value' => $type, 'type' => 'hidden']);

              ?>
            </div>
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
                          <tr> -->
                          <tr style="color: #dc143c;">
                            <th><strong> Bon Livraison </strong>
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

                          <tbody>
                            <?php

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
                                  $montreg = $mon[0]['mont'] ;
                                }

                                $reste = $liv['totalttc'] - $montreg;
                                // debug($reglement) ;
                                if (($mon[0]['mont']) != $liv['totalttc']) {
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
                              <?php }
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
                              //debug($style);die;


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

                            <tr style="color: #dc143c;">
                              <th><strong> Facture </strong>
                              </th>
                            </tr>
                            <tr style="background-color: #3C8DBC; color: white;">

                              <td>Type</td>
                              <td>N° Facture</td>
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
                                $lig = $connection->execute('select * from lignereglementclients where lignereglementclients.reglementclient_id=' . $reglement->id . ' and lignereglementclients.factureclient_id=' . $fac['id'] . ';')->fetchAll('assoc');
                                //debug($lig);die;
                                if ($fac['bonlivraison_id']) {
                                  $montbonli = $connection->execute("select sum(lignereglementclients.montant)as tot from lignereglementclients where lignereglementclients.bonlivraison_id =" . $fac['bonlivraison_id'] . ";")->fetchAll('assoc');
                                  if ($montbonli['0']['tot']) {
                                    $montantregbon = $montbonli['0']['tot'];
                                  } else {
                                    $montantregbon = 0;
                                  }
                                } else {
                                  $montantregbon = 0;
                                }
                                if ($lig) {
                                  $styler = "display:yesy;background-color:#0087bd;color:white;font-weight: bold;";
                                } else {
                                  $styler = "display:none;background-color:#0087bd;color:white;font-weight: bold;";
                                }
                                //debug($style);die;
                                if ($mon[0]['mont'] == null) {
                                  $montreg = 0 + $montantregbon;
                                } else {
                                  $montreg = $mon[0]['mont'] + $montantregbon;  //- $lig[0]['Montant'];
                                }

                                $reste = $fac['totalttc']  - $montreg - $avtot;
                                // debug($reglement) ;
                                //  if (($mon[0]['mont'] - $lig[0]['Montant']) != $fac['totalttc'] + $timbre) 
                                {
                            ?>

                                  <tr>
                                    <td>Facture</td>
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
                                      <input type="checkbox" <?php if ($lig) { ?> checked <?php } ?> name="data[Lignereglementclient][<?php echo $i; ?>][factureclientav_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" calculmontantt calculereglementclient afficheinputmontantreglementclient" value="<?php echo $facav['id'] ?>" mnttounssi="<?php echo -$facav['totalttc']; ?>" mnt="<?php echo $reste; ?>">
                                      <?php
                                      echo $this->Form->input('Montanttt', array('value' => -$lig[0]['Montant'], 'style' => $style, 'index' => $i, 'name' => 'data[Lignereglementclient][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '',  'type' => 'text', 'class' => 'form-control testmontantreglementclient  chekreglementfac checkmaxfac number calculmontantt '));
                                      ?>

                                    </td>
                                  </tr>
                            <?php }
                              }
                            } ?>
                            <input type="hidden" name="max" value="<?php echo @$i; ?>" id="max">
                            <tr id="totalefacture" style="color:#3C8DBC; font-weight: bold;">
                              <td colspan="6"> Total factures</td>
                              <td colspan="3">
                                <input type="text" name="data[Reglementclients][ttpayer]" id="ttpayer" class="form-control" value="<?php echo $mtfact; ?>" readonly>
                              </td>
                            </tr>
                            <!-- <tr> -->
                          <?php }  ?>
                          <!-- 
                            <th><strong> Montant </strong> </th>

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
                    <a class="btn btn-primary ajouterligne reglclientchekajoutligne " table="addtable" index="index" tr='type' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                      <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

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
                                  <select table="pieceregelemnt" index="" champ="paiement_id" class="modereglement2  montantbrut form-control select selectized">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($paiements as $id => $paiement) {


                                    ?>
                                      <option value="<?php echo $id; ?>"><?php echo  $paiement ?></option>
                                    <?php } ?>
                                  </select>

                                  <?php echo $this->Form->control('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'pieceregelemnt', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form', 'label' => '')); ?>
                                </td>

                          </td>

                        </tr>
                        <tr>
                          <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbruta" table="piece" style="display:none" class="modecheque">Montant brut</td>
                          <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbrutb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                echo $this->Form->control('montant_brut', array('class' => 'form-control montantbrut', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantbrut', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant_brut]'));
                                                                                                                                                                ?> </td>
                        </tr>

                        <tr>
                          <td>Montant</td>
                          <td><?php
                              echo $this->Form->control('montant', array('class' => 'form-control differance ', 'label' => '', 'index' => 0, 'champ' => 'montant', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant]'));
                              ?> </td>
                        </tr>
                        <tr>
                          <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxa" table="piece" style="display:none" class="modecheque">Taux</td>
                          <td name="data[piece][0][trtaux]" id="" index="0" champ="trtauxb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                  echo $this->Form->control('valeur_id', array('div' => 'form-group', 'value' => 1, 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => ' form-control montantbrut', 'label' => '', 'index' => 0, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][taux]', 'empty' => 'Veuillez choisir'));
                                                                                                                                                  ?> </td>
                        </tr>
                        <tr>
                          <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantneta" table="piece" style="display:none" class="modecheque">Montant Net </td>
                          <td name="data[piece][0][trmontantnet]" id="" index="0" champ="trmontantnetb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                              echo $this->Form->control('montant_net', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montantnet]'));
                                                                                                                                                              ?> </td>
                        </tr>

                        <tr>
                          <td name="data[piece][0][trechance]" id="" index="0" champ="trechancea" table="piece" class="modecheque" style="display:none;"><strong>Echéance </strong> </td>
                          <td name="data[piece][0][trechance]" id="" index="0" champ="trechanceb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                        echo $this->Form->control('echance', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'date', 'index' => 0, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][echance]'));
                                                                                                                                                        ?> </td>
                        </tr>
                        <tr>
                          <td name="data[piece][0][trechance2]" id="" index="0" champ="trechancea2" table="piece" style="display:none" class="modecheque" style="color:#dc143c;">Echéance 2</td>
                          <td name="data[piece][0][trechance2]" id="" index="0" champ="trechanceb2" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                          echo $this->Form->control('echance2', array('div' => 'form-group', 'style' => 'color:#dc143c;', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'date', 'index' => 0, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][echance2]'));
                                                                                                                                                          ?> </td>
                        </tr>
                        <tr>
                          <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanquea" table="piece" style="display:none" class="modecheque">Banque </td>
                          <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanqueb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                      echo  $this->Form->control('banque_id', array(
                                                                                                                                                        'class' => 'form-control',
                                                                                                                                                        'empty' => 'veuillez choisir',
                                                                                                                                                        'options' => $banques,
                                                                                                                                                        'label' => '',
                                                                                                                                                        'index' => 0,
                                                                                                                                                        'id' => 'banque_id',
                                                                                                                                                        'champ' => 'banque',
                                                                                                                                                        // 'value' => 26,
                                                                                                                                                        'table' => 'pieceregelemnt',
                                                                                                                                                        'name' => 'data[pieceregelemnt][0][banque_id]'
                                                                                                                                                      ));
                                                                                                                                                      ?></td>
                        </tr>
                        <td name="data[piece][0][trcompte]" id="" index="0" champ="trcomptea" table="piece" style="display:none" class="modecheque">Compte</td>
                        <td name="data[piece][0][trcompte]" id="" index="0" champ="trcompteb" table="piece" style="display:none" class="modecheque">
                          <div id="divsous" champ="divsous">

                            <?php
                            echo $this->Form->control('comptee', array(
                              'div' => 'form-group',
                              'between' => '<div class="col-sm-10">',
                              'after' => '</div>',
                              'class' => 'form-control    ',
                              'empty' => 'veuillez choisir',
                              'label' => '',
                              'index' => 0,
                              'champ' => 'compte',
                              // 'value' => 6,
                              'table' => 'pieceregelemnt',
                              'name' => 'data[pieceregelemnt][0][compte]'
                            ));
                            ?>
                          </div>
                        </td>

                        </tr>


                        <tr>
                          <td name="data[piece][0][trendosse]" id="" index="0" champ="trendossea" table="piece" style="display:none" class="modecheque">Endossé</td>
                          <td name="data[piece][0][trendosse]" id="" index="0" champ="trendosseb" table="piece" style="display:none" class="modecheque">
                            <div id="divsous" champ="divsous">

                              <?php
                              echo $this->Form->control('endosse', array(
                                'div' => 'form-group',
                                'between' => '<div class="col-sm-10">',
                                'after' => '</div>',
                                'class' => 'form-control    ',
                                'empty' => 'veuillez choisir',
                                'label' => '',
                                'index' => 0,
                                'champ' => 'endosse',
                                'table' => 'pieceregelemnt',
                                'name' => 'data[pieceregelemnt][0][endosse]'
                              ));
                              ?>
                            </div>
                          </td>

                        </tr>
                        <tr>
                          <td name="data[piece][0][trnum]" id="" index="0" champ="trnuma" table="piece" style="display:none" class="modecheque">Numéro pièce </td>
                          <td name="data[piece][0][trnum]" id="" index="0" champ="trnumb" table="piece" style="display:none" class="modecheque">
                            <div class='form-group' id="" index="0" champ="divnumc" table="piece" style="display:none">
                              <label class='col-md-2 control-label'></label>
                              <div class='col-sm-10' name="data[piece][0][trnum]" id="" index="0" champ="trnumc" table="piece" class="modecheque"> </div>
                            </div>
                            <div class='form-group' id="" index="0" champ="divnump" table="piece" style="display:none">
                              <div class='col-sm-12'><?php echo $this->Form->control('num_piece', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][num_piece]')); ?></div>
                            </div>
                          </td>

                        </tr>

                        <tr>
                          <td name="data[piece][0][trbanque]" id="" index="0" champ="trfaca" table="piece" style="display:none" class="modecheque">Facture </td>
                          <td name="data[piece][0][trbanque]" id="" index="0" champ="trfacb" table="piece" style="display:none" class="">

                            <select table="pieceregelemnt" champ="fac_id" index class="form-control montttc">
                              <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                              <?php foreach ($facturesav as $f) {
                              ?>
                                <option value="<?php echo $f->id; ?>"><?php echo $f->numero . ' ' . $f->totalttc ?></option>
                              <?php } ?>
                            </select>
                          </td>
                        </tr>





                      </table>

                      </td>

                      <td align="center">
                        <i index="0" id="test" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;"></i>
                      </td>
                      </tr>
                      <?php $read = "";
                     // $i = -1;
                      foreach ($piecereglementclients as $i => $piece) {
                        /// debug($piece);
                        $connection = ConnectionManager::get('default');

                        if ($piece->id != null) {
                          $chequepaye = $connection->execute(
                            'SELECT * FROM piecereglementclients 
                                                       WHERE id = :id 
                                                       AND paiement_id = 2 
                                                       AND etat_id = 2',
                            ['id' => $piece->id]
                          )
                            ->fetch('assoc');

                          // debug($chequepaye['etat_id']);
                          if (!empty($chequepaye['etat_id']) && $chequepaye['etat_id'] == 2) {
                            $readonly = 'true';
                            $style = 'pointer-events:none';
                          } else {
                            $readonly = 'false';
                            $style = '';
                          }
                        }
                        if($piece->paiement_id !=9){
                          $i++;
                      ?>
                        <tr>
                          <td colspan="8" style="vertical-align: top;">
                            <table>
                              <tr <?php if (($piece->paiement_id == 7) || ($piece->paiement_id == 6) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                <td>Mode de paiement </td>
                                <td><?php
                                    echo $this->Form->control('paiement_id', array(
                                      'value' => $piece->paiement_id,
                                      'class' => 'form-control montantbrut  modereglement2 ',
                                      'label' => '',
                                      // 'style' => $style,
                                      'readonly' => $readonly,
                                      'index' => $i,
                                      'id' => 'paiement_id' . $i,
                                      'table' => 'pieceregelemnt',
                                      'name' => 'data[pieceregelemnt][' . $i . '][paiement_id]'
                                    ));
                                    ?>
                                  <?php echo $this->Form->input('id', array('value' => $piece->id, 'name' => 'data[pieceregelemnt][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                  <?php echo $this->Form->input('sup', array('name' => 'data[pieceregelemnt][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>

                                </td>

                              </tr>
                              <tr <?php if ($piece->factureavoir_id == null) { ?> style="display:none ; " <?php } ?>>
                                <td> Facture </td>

                                <td>
                                  <select table="pieceregelemnt" index="" champ="paiement_id" class="modereglement2 form-control select selectized">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($facturesav as $f) {


                                    ?>
                                      <option <?php if ($piece->factureavoir_id == $f->id) { ?> selected="selected" <?php } ?> value="<?php echo $f->id; ?>"><?php echo $f->numero . '-' . $f->totalttc ?></option>
                                    <?php } ?>
                                  </select>
                                </td>
                              </tr>
                              <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trmontantbrut<?php echo $i  ?>">
                                <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbruta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbruta" table="piece" class="modecheque">Montant brut</td>
                                <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbrutb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbrutb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                echo $this->Form->control('montant_brut', array('value' => $piece->montant_brut, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control montantbrut', 'label' => '', 'type' => 'text', 'index' => $i, 'champ' => 'montantbrut', 'id' => 'montantbrut' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant_brut]'));
                                                                                                                                                                                                                ?> </td>
                              </tr>
                              <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trtaux<?php echo $i  ?>">
                                <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxa<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxa" table="piece" class="modecheque">Taux</td>
                                <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxb" table="piece" class="modecheque"><?php
                                                                                                                                                                                            echo $this->Form->control('valeur_id', array('value' => $piece->to_id, 'class' => 'form-control select montantbrut ', 'label' => '', 'index' => $i, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][taux]', 'id' => 'taux' . $i, 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                            ?> </td>
                              </tr>
                              <tr <?php if (($piece->paiement_id == 7) || ($piece->paiement_id == 6) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                <td>Montant</td>
                                <td><?php
                                    echo $this->Form->control('montant', array('value' => $piece->montant, 'readonly' => $readonly, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control differance', 'label' => '', 'index' => $i, 'champ' => 'montant', 'id' => 'montant' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant]'));
                                    ?>
                                </td>
                              </tr>
                              <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trmontantnet<?php echo $i  ?>">
                                <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantneta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantneta" table="piece" class="modecheque">Montant Net</td>
                                <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantnetb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantnetb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                              echo $this->Form->control('montant_net', array('value' => $piece->montant_net, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => $i, 'id' => 'montantnet' . $i, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montantnet]'));
                                                                                                                                                                                                              ?> </td>
                              </tr>
                              <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 55) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                <td name="data[piece][<?php echo $i ?>][trechance]" id="trechancea<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><strong>Echéance</strong></td>
                                <td name="data[piece][<?php echo $i ?>][trechance]" id="trechanceb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                              echo $this->Form->control('echance', array('value' => $piece->echance, 'class' => 'form-control datetimepicker', 'readonly', 'label' => '', 'type' => 'date', 'id' => 'echance' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][echance]'));
                                                                                                                                                                              ?> </td>
                              </tr>
                              <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 55) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                <td name="data[piece][<?php echo $i ?>][trechance2]" id="trechancea2<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque" style="color:#dc143c;">Echéance 2</td>
                                <td name="data[piece][<?php echo $i ?>][trechance2]" id="trechanceb2<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                                echo $this->Form->control('echance2', array('value' => $piece->echance2, 'style' => 'color:#dc143c;', 'readonly' => $readonly, 'class' => 'form-control datetimepicker', 'label' => '', 'type' => 'date', 'id' => 'echance2' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][echance2]'));
                                                                                                                                                                                ?> </td>
                              </tr>
                              <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5)  || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trbanque<?php echo $i  ?>">
                                <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Banque </td>
                                <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanque<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                            echo  $this->Form->control('banque_id', array(
                                                                                                                                                                              'class' => 'form-control getcomptes',
                                                                                                                                                                              'empty' => 'veuillez choisir',
                                                                                                                                                                              'value' => $piece->banque_id,
                                                                                                                                                                              'options' => $banques,
                                                                                                                                                                              // 'style' => $style,
                                                                                                                                                                              'readonly' => $readonly,
                                                                                                                                                                              'label' => '',
                                                                                                                                                                              'index' => $i,
                                                                                                                                                                              'id' => 'banque_id' . $i,
                                                                                                                                                                              'table' => 'pieceregelemnt',
                                                                                                                                                                              'name' => 'data[pieceregelemnt][' . $i . '][banque_id]'
                                                                                                                                                                            ));
                                                                                                                                                                            ?></td>
                              </tr>
                              <tr <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?> id="trcompte<?php echo $i  ?>">
                                <td name="data[piece][<?php echo $i ?>][trcompte]" id="trcompte<?php echo $i ?>" index="<?php echo $i ?>" champ="trcomptea" table="piece" class="modecheque">Compte</td>
                                <td name="data[piece][<?php echo $i ?>][trcompte]" id="trcompte<?php echo $i ?>" index="<?php echo $i ?>" champ="trcompteb" table="piece" class="modecheque">


                                  <div name="data[<?php echo $i ?>][divsous]" id="divsous<?php echo $i ?>" index="<?php echo $i ?>"><?php
                                                                                                                                    echo $this->Form->control('comptee', array(

                                                                                                                                      'value' => $piece->compte,
                                                                                                                                      // 'options' => $comptes,
                                                                                                                                      'div' => 'form-group',
                                                                                                                                      'between' => '<div class="col-sm-10">',
                                                                                                                                      'after' => '</div>',
                                                                                                                                      'class' => 'form-control    ',
                                                                                                                                      'empty' => 'veuillez choisir',
                                                                                                                                      'label' => '',
                                                                                                                                      'readonly' => $readonly,
                                                                                                                                      'index' => $i,
                                                                                                                                      'champ' => 'compte',
                                                                                                                                      'table' => 'pieceregelemnt',
                                                                                                                                      'name' => 'data[pieceregelemnt][' . $i . '][compte]'
                                                                                                                                    ));
                                                                                                                                    ?></div>
                                </td>
                              </tr>
                              <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 55) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="trechances<?php echo $i  ?>">
                                <td name="data[piece][<?php echo $i ?>][trendosse]" id="trendossea<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Endossé</td>
                                <td name="data[piece][<?php echo $i ?>][trendosse]" id="trendosseb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                              echo $this->Form->control('endosse', array('value' => $piece->endosse, 'readonly' => $readonly, 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'id' => 'endosse' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][endosse]'));
                                                                                                                                                                              ?> </td>
                              </tr>
                              <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 5) || ($piece->paiement_id == 55) || ($piece->paiement_id == 7) || ($piece->paiement_id == 8) || ($piece->paiement_id == 9)) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="numpiece<?php echo $i  ?>">
                                <td name="data[piece][<?php echo $i ?>][trnuma]" id="trnuma<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque">Numero piéce</td>
                                <td name="data[piece][<?php echo $i ?>][trnumb]" id="trnumb<?php echo $i ?>" index="<?php echo $i ?>" table="piece" class="modecheque"><?php
                                                                                                                                                                        echo $this->Form->control('num_piece', array('value' => $piece->num, 'readonly' => $readonly, 'class' => 'form-control ', 'label' => '', 'type' => 'number', 'id' => 'num' . $i, 'index' => $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][num_piece]'));
                                                                                                                                                                        ?> </td>
                              </tr>


                            </table>







                          </td>

                          <td <?php if ($piece->paiement_id == 9) { ?> style="display:none" <?php } else { ?>style="display:" <?php } ?> id="supreg<?php echo $i  ?>">


                            <i index="<?php echo $i ?>" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;"></i>
                          </td>



                        </tr>
                      <?php } }?>
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
        <!-- /.box  testpersonnel-->
      </div>
    </div>
    <button type="submit" class="pull-right btn btn-success btn-sm " id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
    <?php echo $this->Form->end(); ?>
  </div>
  <!-- /.row -->
</section>


<?php echo $this->Html->script('alert'); ?>

<script>
  $(function() {


    $('#diff').on('change', function() {
      // alert('aaaaaa')
      if ($(this).is(':checked')) {
        $(this).val(1); // Case cochée, valeur 1
      } else {
        $(this).val(0); // Case décochée, valeur 0
      }
    });
    $('.getcomptes').on('change', function() {
      ind = $(this).attr('index');
      banque_id = $('#banque_id' + ind).val() || 0;

      // alert(banque_id);
      // alert(ind);
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Reglementclients', 'action' => 'getcompte']) ?>",
        dataType: "json",
        data: {
          banque_id: banque_id,
          ind: ind,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          //  alert(data.select1);
          $('#divsous' + ind).html(data.select1);
        }
      });

    });
  });

  $(function() {

    $(".ajouterligne").on('click', function() {
      // alert("hhhh");
      table = $(this).attr('table'); //id table
      index = $(this).attr('index'); // id max compteur
      tr = $(this).attr('tr'); //class class type
      ind = Number($('#' + index).val()) + 1;
      $ttr = $('#' + table).find('.' + tr).clone(true);
      $ttr.attr('class', 'cc'); //amin
      i = 0;
      tabb = [];
      //alert(ind);
      $ttr.find('a,input,select,div,td,textarea,tr,table,i').each(function() {

        tab = $(this).attr('table');
        champ = $(this).attr('champ');
        if (champ != "trstituation") {
          $(this).attr('index', ind);
          $(this).attr('id', champ + ind);
          $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
          $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
          $(this).removeClass('anc');
          if ($(this).is('select')) {
            if (champ != "etatpiecereglement_id") {
              tabb[i] = champ + ind;

              i = Number(i) + 1;
            }
            if (champ == 'matierepremiere_id') {
              nompage = $('.nompage').val();
              four = $('#' + nompage + 'FournisseurId').val() || 0;
              $(this).attr('onchange', 'cal_prix(' + four + ',' + ind + ')');
            }
            if (champ == 'bouttonajoutlignepetit') {
              $(this).attr('index', ind);
            }
          }
        }
      })
      $ttr.find('i').each(function() {
        $(this).attr('index', ind);
      });
      $ttr.attr('style', '');
      $('#' + table).append($ttr);
      $('#' + index).val(ind);
      $('#echance' + ind).datetimepicker({
        timepicker: false,
        datepicker: true,
        mask: '39/19/9999',
        format: 'd/m/Y'
      });
      $('#' + table).find('tr:last').show();
      $("#paiement_id" + ind).select2({
        width: '100%' // need to override the changed default
      });

      $('.trstituation').hide();

    });


    $('#test').on('click', function() {
      ind = $(this).attr('index');
      $('#sup' + ind).val(1);
      $(this).parent().parent().hide();
      $('#btnenr').prop("disabled", false);
      v = $('#index').val();
      console.log(v);
      tt = 0;
      th = 0;
      for (i = 0; i <= v; i++) {
        if ($('#sup' + i).val() != 1) {
          th = $('#montant' + i).val() || 0;
          tt = Number(tt) + Number(th);
        }
      }
      $('#Montant').val(tt);
    });


    $('.modereglement2').on('change', function() {
      index = $(this).attr('index'); //alert(index);
      val = $(this).val();
      ////alert(val);
      typefrs = $('#typefrs').val();
      //$('#montant'+index).val('');
      nb = 0;
      // if(index!=0){
      //     for(j=0;j<=i;j++){
      //       if($('#paiement_id'+j).val()==5)  {
      //         nb++;  
      //       }
      //     }
      //     if(nb>1){
      //      $('#btnenr').prop("disabled", true);
      //        bootbox.alert('interdit de choisi le mode retenue une autre fois', function (){});
      //        return false   
      //     }else{
      //       $('#btnenr').prop("disabled", false);  
      //     }
      // }
      //console.log(index);
      if (Number(val) == 1 || Number(val) == 9) {
        //alert(val);
        //$('#trechance'+index).attr('class','') ;
        $('#trendossea' + index).hide();
        $('#trendosseb' + index).hide();
        $('#trechancea2' + index).hide();
        $('#trechanceb2' + index).hide();
        $('#trmontantbruta' + index).hide();
        $('#trmontantbrutb' + index).hide();
        $('#trmontantneta' + index).hide();
        $('#trmontantnetb' + index).hide();
        $('#trtauxa' + index).hide();
        $('#trtauxb' + index).hide();
        $('#trnbrmoins' + index).hide();
        $('#trechancea' + index).hide();
        $('#trechanceb' + index).hide();
        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trbanque' + index).hide();
        $('#trbanquea' + index).hide();
        $('#trbanqueb' + index).hide();
        // $('#trnum'+index).attr('class','') ;
        $('#trimg' + index).show();
        $('#numpiece' + index).hide(); // modifiction amin   
        $('#trnuma' + index).hide();
        $('#trnumb' + index).hide();
        $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        $('#banque_ida' + index).hide(); // modifiction amin
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();
      } else if (Number(val) == 22) {
        //alert(val);
        //$('#trechance'+index).attr('class','') ;
        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trendossea' + index).hide();
        $('#trendosseb' + index).hide();
        $('#trmontantbruta' + index).hide();
        $('#trmontantbrutb' + index).hide();
        $('#trmontantneta' + index).hide();
        $('#trmontantnetb' + index).hide();
        $('#trtauxa' + index).hide();
        $('#trtauxb' + index).hide();
        $('#trnbrmoins' + index).hide();
        $('#trechancea' + index).hide();
        $('#trechanceb' + index).hide();
        $('#trbanquea' + index).show();
        $('#trbanqueb' + index).show();
        // $('#trnum'+index).attr('class','') ;
        $('#trimg' + index).show();
        $('#numpiece' + index).hide(); // modifiction amin   
        $('#trnuma' + index).hide();
        $('#trnumb' + index).hide();
        $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        $('#banque_ida' + index).hide(); // modifiction amin
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();
        $('#trechancea2' + index).hide();
        $('#trechanceb2' + index).hide();
      } else if (Number(val) == 2) {
        //alert('cheque');
        $('#trcomptea' + index).show();
        $('#trcompteb' + index).show();
        $('#trmontantbruta' + index).hide();
        $('#trmontantbrutb' + index).hide();
        $('#trmontantneta' + index).hide();
        $('#trmontantnetb' + index).hide();
        $('#trtauxa' + index).hide();
        $('#trtauxb' + index).hide();
        $('#trendossea' + index).show();
        $('#trendosseb' + index).show();
        $('#trimg' + index).show(); //alert('ok')

        $('#trechances' + index).show(); //alert('ok')
        $('#trechancea' + index).show(); //alert('ok')
        $('#trechanceb' + index).show();
        $('#trechancea2' + index).show();
        $('#trechanceb2' + index).show();

        $('#trbanquea' + index).show();
        $('#trbanqueb' + index).show();
        $('#banque_idb' + index).hide(); // modifiction amin  
        $('#banque_ida' + index).hide();

        $('#numpiece' + index).show(); // modifiction amin   
        $('#trnuma' + index).show();
        $('#trnumb' + index).show();

        //ajouter select carnet trnumb0
        $('#trcarnetnuma' + index).show(); //alert('ok')
        $('#trcarnetnumb' + index).show(); //alert('ok')
        $('#divnumc' + index).show(); //alert('ok')

        $('#divnump' + index).show(); //alert('ok')

      } else if (Number(val) == 5) {
        $('#pop').html('');
        $('#trechancea2' + index).hide();
        $('#trechanceb2' + index).hide();
        $('#trimg' + index).show();
        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trmontantbrut' + index).show();
        $('#trmontantbruta' + index).show();
        $('#trmontantbrutb' + index).show();
        $('#trmontantnet' + index).show();
        $('#trmontantneta' + index).show();
        $('#trmontantnetb' + index).show();
        $('#trendossea' + index).hide();
        $('#trendosseb' + index).hide();
        $('#trtaux' + index).show();
        $('#trtauxa' + index).show();
        $('#trtauxb' + index).show();
        $('#trnbrmoins' + index).hide();
        $('#trechancea' + index).hide();
        $('#trechanceb' + index).hide();
        $('#trbanque' + index).hide();
        $('#trbanquea' + index).hide();
        $('#trbanqueb' + index).hide();
        // $('#trnum'+index).attr('class','') ;
        $('#trnuma' + index).show();
        $('#trnumb' + index).show();
        $('#numpiece' + index).show(); // modifiction amin   

        $('#divnump' + index).show();
        $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        $('#banque_ida' + index).hide();
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();
        ttpayer = $('#ttpayer').val();
        $('#montantbrut' + index).val(ttpayer);




      } else if (Number(val) == 55) {
        $('#pop').html('');
        $('#trendossea' + index).hide();
        $('#trendosseb' + index).hide();
        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trimg' + index).show();
        $('#trmontantbruta' + index).hide();
        $('#trmontantbrutb' + index).hide();
        $('#trmontantneta' + index).hide();
        $('#trmontantnetb' + index).hide();
        $('#trtauxa' + index).hide();
        $('#trtauxb' + index).hide();
        $('#trnbrmoins' + index).hide();
        $('#trechancea' + index).hide();
        $('#trechanceb' + index).hide();
        $('#trechancea2' + index).hide();
        $('#trechanceb2' + index).hide();
        $('#trbanquea' + index).show();
        $('#trbanqueb' + index).show();
        // $('#trnum'+index).attr('class','') ;
        $('#trnuma' + index).hide();
        $('#trnumb' + index).hide();
        $('#divnump' + index).hide();
        $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        $('#banque_ida' + index).hide();
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();
        ttpayer = $('#ttpayer').val();
        $('#montantbrut' + index).val(ttpayer);



      } else {
        //  alert('aa');
        //$('#pop').html('');
        if (typefrs != 1) {
          if ((Number(val) == 4) || (Number(val) == 6)) {
            $('#tablepaiement' + index).show();
            $('#tr_regle_fournisseur' + index).show();
          }
        }
        $('#trimg' + index).show();
        $('#trmontantbruta' + index).hide();
        $('#trmontantbrutb' + index).hide();
        $('#trmontantneta' + index).hide();
        $('#trmontantnetb' + index).hide();
        $('#trtauxa' + index).hide();
        $('#trtauxb' + index).hide();
        $('#trendossea' + index).hide();
        $('#trendosseb' + index).hide();
        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        //******************
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();
        $('#divnumc' + index).hide();
        $('#trechancea' + index).show();
        $('#trechanceb' + index).show();
        $('#trbanquea' + index).show();
        $('#trbanqueb' + index).show();
        $('#banque_idb' + index).show(); // modifiction amin
        $('#banque_ida' + index).show(); // modifiction amin
        //$('#trechance'+index).attr('class','display:none') ;
        $('#trnuma' + index).show();
        $('#trnumb' + index).show();

        $('#divnump' + index).show();
        //$('#trnum'+index).attr('class','display:none') ;  
      }

      if (Number(val) == 7) {
        //alert('aa');
        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trmontantbruta' + index).hide();
        $('#trmontantbrutb' + index).hide();
        $('#trmontantneta' + index).hide();
        $('#trmontantnetb' + index).hide();
        $('#trtauxa' + index).hide();
        $('#trtauxb' + index).hide();
        $('#trechancea' + index).hide();
        $('#trechanceb' + index).hide();
        $('#trbanquea' + index).show();
        $('#trbanqueb' + index).show();
        $('#trendossea' + index).hide();
        $('#trendosseb' + index).hide();
        $('#trechancea2' + index).hide();
        $('#trechanceb2' + index).hide();
        $('#trnbrmoins' + index).show();
        $('#trnuma' + index).hide();
        $('#trnumb' + index).hide();
        $('#numpiece' + index).hide(); // modifiction amin   

        $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        $('#banque_ida' + index).hide(); // modifiction amin
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();
      }

      if (Number(val) == 8) {
        facture()
        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trmontantbruta' + index).hide();
        $('#trmontantbrutb' + index).hide();
        $('#trmontantneta' + index).hide();
        $('#trmontantnetb' + index).hide();
        $('#trtauxa' + index).hide();
        $('#trtauxb' + index).hide();
        $('#trechancea' + index).hide();
        $('#trechanceb' + index).hide();
        $('#trbanquea' + index).hide();
        $('#trbanqueb' + index).hide();
        $('#trechancea2' + index).hide();
        $('#trechanceb2' + index).hide();
        $('#trfaca' + index).show();
        $('#trfacb' + index).show();
        $('#trendossea' + index).hide();
        $('#trendosseb' + index).hide();

        $('#trnbrmoins' + index).show();
        $('#trnuma' + index).hide();
        $('#trnumb' + index).hide()
        $('#banque' + index).hide()

        $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        $('#banque_ida' + index).hide(); // modifiction amin
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();
      }
      // if (Number(val) == 9) {
      //   facture()
      //   $('#trcomptea' + index).hide();
      //   $('#trcompteb' + index).hide();
      //   $('#trmontantbruta' + index).hide();
      //   $('#trmontantbrutb' + index).hide();
      //   $('#trmontantneta' + index).hide();
      //   $('#trmontantnetb' + index).hide();
      //   $('#trtauxa' + index).hide();
      //   $('#trtauxb' + index).hide();
      //   $('#trechancea' + index).hide();
      //   $('#trechanceb' + index).hide();
      //   $('#trbanquea' + index).hide();
      //   $('#trbanqueb' + index).hide();
      //   $('#trendossea' + index).hide();
      //   $('#trendosseb' + index).hide();  
      //   $('#trfaca' + index).show();
      //   $('#trfacb' + index).show();
      //   $('#trechancea2' + index).hide();
      //   $('#trechanceb2' + index).hide();

      //   $('#trnbrmoins' + index).show();
      //   $('#trnuma' + index).hide();
      //   $('#trnumb' + index).hide()
      //   $('#banque' + index).hide()

      //   $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
      //   $('#banque_ida' + index).hide(); // modifiction amin
      //   $('#trcarnetnuma' + index).hide();
      //   $('#trcarnetnumb' + index).hide();
      // }



    });

    function facture() {
      ///  alert('hechem')
      ind = $(this).attr('index'); //alert(ind)
      /// alert(ind)
      client = $('#client_id').val(); //alert(client)
      id = $('#paiement_id' + ind).val();

      //alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Reglementclients', 'action' => 'getFac']) ?>",
        dataType: "json",
        data: {
          client: client,
          id: id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          ////    alert(data.select)

          $('#fac_id' + ind).html(data.select);

        }

      })
    }

    $('.montantbrut').on('keyup change', function() {
      index = $(this).attr('index');

      ttpayer = $('#ttpayer').val();
      $('#montantbrut' + index).val(ttpayer);

      // alert(index);
      montantbrut = $('#montantbrut' + index).val() || 0;

      t = $('#taux' + index).val() || 0;
      //   alert(t);
      // if (t == '1') {
      //     taux = 1.5
      // };
      // if (t == '4') {
      //     taux = 5
      // };
      // if (t == '3') {
      //     taux = 15
      // };
      // if (t == '5') {
      //     taux = 10
      // };
      // if (t == '6') {
      //     taux = 3
      // };
      // if (t == '7') {
      //     taux = 7
      // };
      // if (t == '8') {
      //     taux = 1
      // };
      //alert(taux);
      retenue = (montantbrut * (t / 100)).toFixed(3);
      $('#montant' + index).val(retenue);
      // $('#Montant').val(retenue);
      net = (montantbrut - retenue).toFixed(3);
      $('#montantnet' + index).val(net);
      $('#netapayer').val(net);
      v = $('#index').val(); //alert(v)//console.log(v);
      tt = 0;
      th = 0;
      i = 0;
      //for(i=0;i<=v;i++){
      while ($('#montant' + i).val() != undefined) {
        th = $('#montant' + i).val() || 0; //console.log(th);
        tt = Number(tt) + Number(th);
        i++;
      }
      // ttt=Number(tt)+Number(retenue);
      //    console.log(tt);
      $('#Montant').val((tt).toFixed(3));
      //alert('hhhh');
      total = $('#ttpayer').val();
      max = $('#index').val();
      /*  sup = $('#sup'+index).val(); */
      variable1 = 0;


      for (i = 0; i <= max; i++) {
        if ($('#sup' + i).val() != 1)
          variable1 += Number($('#montant' + i).val());

      }

      $('#mtotal').val(variable1.toFixed(3));
      $('#difference').val((Number(total) - Number(variable1)).toFixed(3));

    });
    // $('.montantbrut').on('keyup change', function() {
    //   // alert('hhh')
    //   index = $('#index').val();
    //   max = $('#max').val();
    //   variable1 = 0;
    //   for (i = 0; i <= max; i++) {
    //     if ($('#factureclient_id' + i).is(':checked')) {
    //       variable1 = Number($('#Montantregler' + i).val()) + variable1
    //     }
    //   }
    //   montantbrut = $('#montantbrut' + index).val(variable1) || 0;
    //   //alert(montantbrut);
    //   t = $('#taux' + index).val() || 0; //alert(t);
    //   //  alert(t);
    //   if (t == '1') {
    //     taux = 1.5
    //   };
    //   if (t == '4') {
    //     taux = 5
    //   };
    //   if (t == '3') {
    //     taux = 15
    //   };
    //   if (t == '5') {
    //     taux = 10
    //   };
    //   if (t == '6') {
    //     taux = 3
    //   };
    //   if (t == '7') {
    //     taux = 7
    //   };
    //   if (t == '8') {
    //     taux = 1
    //   };
    //   //alert(taux);
    //   retenue = (montantbrut * (taux / 100)).toFixed(3);
    //   $('#montantnet' + index).val(retenue);

    //   // net=(montantbrut-retenue).toFixed(3);
    //   // $('#montantnet'+index).val(net);
    //   // $('#netapayer').val(net);
    //   v = $('#index').val(); //alert(v)//console.log(v);
    //   tt = 0;
    //   th = 0;
    //   i = 0;
    //   //for(i=0;i<=v;i++){
    //   while ($('#montant' + i).val() != undefined) {
    //     th = $('#montant' + i).val() || 0; //console.log(th);
    //     tt = Number(tt) + Number(th);
    //     i++;
    //   }
    //   // ttt=Number(tt)+Number(retenue);
    //   // console.log(tt);
    //   $('#Montant').val((tt).toFixed(3));

    // });
  });
</script>
<script>
  $('.chekreglement').on('click', function() {

    ind = $(this).attr('index');
    ttpay = 0
    max = $('#max').val();
    //piece= $('.inputlibre'+ind).val();


    for (i = 0; i <= max; i++) {

      if ($('#facture_id' + i).is(':checked')) {
        $('#Montantregler' + i).show();

        ttpay = Number(ttpay) + Number(v)
        $('#ttpayer').val(Number(ttpay).toFixed(3));

      } else {
        $('#Montantregler' + i).attr('style', "display:none;");
        test = 0
      }
    }

  })

  $('#inputlibre').on('keyup', function() {

    ind = $(this).attr('index');
    ttpay = 0
    max = $('#max').val();

    for (i = 0; i <= max; i++) {


      v = $('#inputlibre' + i).show().val();
      ttpay = Number(ttpay) + Number(v)
      $('#ttpayer').val(Number(ttpay).toFixed(3));


    }

  })

  //$('.input').val(Number(ttpay).toFixed(3));


























  //     $('.chekreglementbon').on('click',function(){
  //     ind= $(this).attr('index'); 
  //       max= $('#maxbon').val();
  //       //alert(max);
  //       typefrs= $('#typefrs').val();
  //      //alert(typefrs);
  //      ttbl=0;
  //      ttdv=0;
  //      remise=0;
  //      testt=false;
  //      ttounsi=0;
  //     imp= $(this).attr('importation');
  //     ind= $(this).attr('index');
  //    //alert(ind);
  //     testimp=0;
  //     for(i=0;i<=max;i++){
  //       if($('#bonreception_id'+i).is(':checked')){ 
  //           //alert(i);
  //           //alert($('#facture_id'+i).attr('importation'));
  //               if($('#bonreception_id'+i).attr('importation')!=imp){
  //                   testimp=8;
  //                   id=i;
  //               }
  //       }elseif()
  // 	    //zeinab
  // 	compte= $(this).attr('compte')||0;
  // 	if(compte!=0){
  // 	 index=$('#index').val();
  //          //alret(index)
  // 	 if($('#bonreception_id'+i).is(':checked')){ 
  // 	 typefrs=$('#typefrs').val();
  //      i= $(this).attr('index');
  // 	 nom_compte= $('#NonCompte'+i).val(); 
  // 	 if(typefrs !=1){
  //         $('#tablepaiement'+index).show();
  //         $('#tr_regle_fournisseur'+index).show();

  //        $('#trmontantbruta'+index).hide() ;
  //        $('#trmontantbrutb'+index).hide() ;
  //        $('#trmontantneta'+index).hide() ;
  //        $('#trmontantnetb'+index).hide() ;
  //        $('#trtauxa'+index).hide() ;
  //        $('#trtauxb'+index).hide() ;
  //            //******************
  //        $('#trcarnetnuma'+index).hide() ;
  //        $('#trcarnetnumb'+index).hide() ;
  //        $('#divnumc'+index).hide() ;
  //        $('#trechancea'+index).show();
  //        $('#trechanceb'+index).show();
  //        $('#trbanquea'+index).show();

  //        $('#trbanqueb'+index).show();

  //        $('#banque_idb'+index).show() ;         
  //        $('#banque_ida'+index).show() ;         
  //        $('#trnuma'+index).show() ;
  //        $('#trnumb'+index).show() ;
  //        $('#divnump'+index).show() ;
  // 	  //alert(compte);
  // 	   $.ajax({
  //             type: "POST",
  //             data: {
  //                 compte_id: compte,
  // 				ind: index,

  //             },
  //             url: wr+"Reglements/compte/",
  //              dataType : "json",
  //              global : false //}l'envoie'
  //       }).done(function(data){ 
  // 	          console.log(data.select);
  //               $('#compte_id'+index).parent().html(data.select);
  //                uniform_select('compte_id'+index);


  //      })  

  // 	}


  // 	 }else{
  // 		   compt='';
  // 		  $.ajax({
  //             type: "POST",
  //             data: {
  //                 compte_id: compt,
  // 				ind: index,

  //             },
  //             url: wr+"Reglements/compte/",
  //              dataType : "json",
  //              global : false //}l'envoie'
  //       }).done(function(data){ 
  // 	          console.log(data.select);
  //               $('#compte_id'+index).parent().html(data.select);
  //                uniform_select('compte_id'+index);


  //      })  
  //       }	
  //   }


  // 	  //**********
  //     } 
  //     //alert(testimp);
  //     if(testimp==8){
  //                //$('#facture_id'+id).prop('checked', false); 
  //                bootbox.alert('cette fature sur une importation diff�rente', function (){});
  //                return false
  //     } 
  //     for(i=0;i<=max;i++){
  //       if($('#bonreception_id'+i).is(':checked')){//alert();
  //           testt=true;
  //           ttbl=Number($('#bonreception_id'+i).attr('mnt'))+Number(ttbl);
  //           ttounsi=Number($('#bonreception_id'+i).attr('mnttounssi'))+Number(ttounsi);
  //           if(typefrs !=1){
  //           ttdv=Number($('#devise'+i).val())+Number(ttdv);
  //           }
  //         $('#importation_id'+i).prop('checked', true);   
  //       }else{
  //        $('#importation_id'+i).prop('checked', false);   
  //       }
  //     }
  //    if (testt===true){
  //        $('#tc'+ind).attr('readonly', false);
  //        $('#btnenr').prop("disabled", false);
  //    } else {
  //        $('#tc'+ind).attr('readonly', true);
  //        $('#btnenr').prop("disabled", true);
  //    }
  //    ttpayer=Number(ttbl);
  //    $('#ttpayerbon').val((ttpayer).toFixed(3));
  //    $('#netpayer').val((ttpayer).toFixed(3));

  //    if(typefrs !=1){
  //    //tc = $('#tc').val()||0;
  //    ///montantachat = $('#montantachat').val()||0;
  //    //mpayer=Number(tc)*Number(montantachat);    
  //    //$('#ttpayer').val((mpayer).toFixed(3));
  //    //$('#netpayer').val((mpayer).toFixed(3));    
  //    //$('#Montant').val((mpayer).toFixed(3));
  //    //$('#montantdevise0').val((ttdv).toFixed(2));
  //    //$('#prixachattounssi').val((ttounsi).toFixed(2));
  //    //$('#montant0').val((ttpayer).toFixed(2));
  //    //$('#montant0').attr('readonly', true);
  //    calculetotalecredit();
  //    }
  //    v=$('#index').val();
  //    index=0;
  //    test=0;
  //    for(j=0;j<=v;j++){
  //    if($('#paiement_id'+j).val()==5)  {
  //          index=j;
  //          test=1;
  //    }   
  //    }
  //    if(test==1){
  //        //alert("d5Al");
  //        facmontantbrut(index);
  //    }

  // });
  $( /*'.chekreglement'*/ ).on('click', function() {


    max = $('#max').val();
    maxav = $('#maxav').val();
    typefrs = $('#typefrs').val();
    // alert(typefrs);
    ttbl = 0;
    ttdv = 0;
    remise = 0;
    testt = false;
    ttounsi = 0;
    imp = $(this).attr('importation');
    ind = $(this).attr('index');
    //alert(imp);
    testimp = 0;
    for (i = 0; i <= max; i++) {

      if ($('#factureclient_id' + i).is(':checked')) {
        $('#inputlibre' + i).show();
        if ($('#factureclient_id' + i).attr('importation') != imp) {
          testimp = 8;
          id = i;
        }
      } else {
        $('#inputlibre' + i).attr('style', "display:none;");
      }
      //zeinab
      compte = $(this).attr('compte') || 0;
      if (compte != 0) {
        index = $('#index').val();
        if ($('#facture_id' + i).is(':checked')) {
          typefrs = $('#typefrs').val();
          i = $(this).attr('index');
          nom_compte = $('#NonCompte' + i).val();
          if (typefrs != 1) {
            $('#tablepaiement' + index).show();
            $('#tr_regle_fournisseur' + index).show();
            $('#trmontantbruta' + index).hide();
            $('#trmontantbrutb' + index).hide();
            $('#trmontantneta' + index).hide();
            $('#trmontantnetb' + index).hide();
            $('#trtauxa' + index).hide();
            $('#trtauxb' + index).hide();
            //******************
            $('#trcarnetnuma' + index).hide();
            $('#trcarnetnumb' + index).hide();
            $('#divnumc' + index).hide();
            $('#trechancea' + index).show();
            $('#trechanceb' + index).show();
            $('#trbanquea' + index).show();

            $('#trbanqueb' + index).show();

            $('#banque_idb' + index).show();
            $('#banque_ida' + index).show();
            $('#trnuma' + index).show();
            $('#trnumb' + index).show();
            $('#divnump' + index).show();
            //alert(compte);
            $.ajax({
              type: "POST",
              data: {
                compte_id: compte,
                ind: index,

              },
              url: wr + "Reglements/compte/",
              dataType: "json",
              global: false //}l'envoie'
            }).done(function(data) {
              console.log(data.select);
              $('#compte_id' + index).parent().html(data.select);
              uniform_select('compte_id' + index);
            })

          }


        } else {
          compt = '';
          $.ajax({
            type: "POST",
            data: {
              compte_id: compt,
              ind: index,

            },
            url: wr + "Reglements/compte/",
            dataType: "json",
            global: false //}l'envoie'
          }).done(function(data) {
            console.log(data.select);
            $('#compte_id' + index).parent().html(data.select);
            uniform_select('compte_id' + index);
          })
        }
      }


      //**********
    }
    //alert(testimp);

    for (i = 0; i <= max; i++) {
      if ($('#facture_id' + i).is(':checked')) { //alert();
        testt = true;
        ttbl = Number($('#facture_id' + i).attr('mnt')) + Number(ttbl);
        ttounsi = Number($('#facture_id' + i).attr('mnttounssi')) + Number(ttounsi);
        if (typefrs != 1) {
          ttdv = Number($('#devise' + i).val()) + Number(ttdv);
        }
        $('#importation_id' + i).prop('checked', true);
      } else {
        $('#importation_id' + i).prop('checked', false);
      }
    }
    for (i = 0; i <= maxav; i++) {
      if ($('#factureavoirfr_id' + i).is(':checked')) { //alert();
        testt = true;
        ttbl = Number(ttbl) - Number($('#factureavoirfr_id' + i).attr('mnt'));
        ttounsi = Number($('#factureavoirfr_id' + i).attr('tounssi')) + Number(ttounsi);
        if (typefrs != 1) {
          ttdv = Number($('#devise' + i).val()) + Number(ttdv);
        }
        $('#importation_id' + i).prop('checked', true);
      } else {
        $('#importation_id' + i).prop('checked', false);
      }
    }
    //    if(testimp==8){
    //               //$('#facture_id'+id).prop('checked', false);
    //               bootbox.alert('cette fature sur une importation diff?rente', function (){});
    //               return false
    //    }
    if (testt === true) {
      $('#tc' + ind).attr('readonly', false);
      $('#btnenr').prop("disabled", false);
    } else {
      $('#tc' + ind).attr('readonly', true);
      $('#btnenr').prop("disabled", true);
    }
    ttpayer = Number(ttbl);
    $('#ttpayer').val((ttpayer).toFixed(3));
    $('#netpayer').val((ttpayer).toFixed(3));
    if (typefrs != 1) {
      //tc = $('#tc').val()||0;
      ///montantachat = $('#montantachat').val()||0;
      //mpayer=Number(tc)*Number(montantachat);
      //$('#ttpayer').val((mpayer).toFixed(3));
      //$('#netpayer').val((mpayer).toFixed(3));
      //$('#Montant').val((mpayer).toFixed(3));
      //$('#montantdevise0').val((ttdv).toFixed(2));
      //$('#prixachattounssi').val((ttounsi).toFixed(2));
      //$('#montant0').val((ttpayer).toFixed(2));
      //$('#montant0').attr('readonly', true);
      calculetotalecredit();
    }
    v = $('#index').val();
    index = 0;
    test = 0;
    for (j = 0; j <= v; j++) {
      if ($('#paiement_id' + j).val() == 5) {
        index = j;
        test = 1;
      }
    }
    if (test == 1) {
      //alert("d5Al");
      facmontantbrut(index);
    }
  });
</script>


<script>
  function calculetotalecredit(index) {
    //alert();
    //index=$('#index').val();
    nbrtr = $('#nbrtr' + index).val();
    montant = $('#montant').val() || 0;
    //alert(montant);
    test = 0;
    tt = 0;
    for (j = 1; j <= nbrtr; j++) {
      th = $('#' + index + 'montantcredit' + j).val() || 0;
      tt = (Number(tt) + Number(th)).toFixed(3);
      if (Number(tt) > Number(montant)) {
        $('#' + index + 'montantcredit' + j).val("");
        test = 1;
      }
    }
    //alert(tt);
    if (test == 1) {
      bootbox.alert('V�rifier le montant', function() {});
      return false
    } else {
      $('#' + index + 'total').val(tt);
    }
    //agio = Number(Number(tt) - Number(montant)).toFixed(3);
    //$('#' + index + 'agio').val(agio);

  }
</script>

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

<script>
  $('.afficherancienclient').on('click', function() {
    //    alert("tt");
    //        if ($('#non').is(':checked')) { //alert('non is checked');
    //            $('#afficher').attr('style', "display:true;");
    //        } else
    if ($('#oui').is(':checked')) {
      alert("true is checked");
      $('#afficher').attr('style', "display:none;");
    }

  });
</script>