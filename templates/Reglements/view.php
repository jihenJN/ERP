<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<?php //echo $this->Html->script('salma'); 
?>
<?php

use Cake\Datasource\ConnectionManager;
?>
<?php echo $this->fetch('script'); ?>
<section class="content-header">
  <h1>
   Consultation Réglement Achat
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
        <?= $this->Form->create($reglement) ?>
        <div class="box-body">
          <div class="row">

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('numeroconca', ['label' => 'numero', 'readonly' => 'readonly']);
              ?></div>
            <!-- <div class="col-xs-6">
              <?php
              //  echo $this->Form->control('pointdevente_id', ['options' => $pointdeventes, 'value' => $p, 'empty' => true, 'empty' => 'Veuillez choisir !!', 'id' => 'pointdevente_id']);
              ?></div> -->
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('Date', ['empty' => true, 'class' => "form-control pull-right"]);

              ?></div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('fournisseur_id', ['options' => $fournisseurs, 'value' => $four, 'empty' => true, 'empty' => 'Veuillez choisir !!', 'id' => 'fournisseur_id', 'class' => 'form-control fournisseurreglement']);
              ?></div>


          </div>
          <?php if ($four != 0) { ?>
            <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-body">

                      <?php //if ($type == 2) { 
                      ?>
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr style="color: #dc143c;">
                            <th><strong> Solde Fournisseur </strong>
                            </th>
                          </tr>
                          <tr style="background-color: #d2691e ; color: white;font-weight: bold;">

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


                            $ligco = $connection->execute('select * from lignereglements where lignereglements.reglement_id=' . $idd . ' and lignereglements.fournisseur_id=' . $four . ';')->fetchAll('assoc');
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
                                <input type="checkbox" <?php if ($ligco) { ?> checked <?php } ?> name="data[Lignereglement][<?php echo $i; ?>][fournisseur_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class="afficheinputmontantreglementclient   chekreglementfacdalanda checkmaxfac2  calculmontantt2" value="<?php echo $compte['id'] ?>" mnttounssi="<?php echo $compte['soldedebut']; ?>" mnt="<?php echo $reste; ?>">
                                <?php
                                echo $this->Form->input('Montanttt', array('value' => $montregsolde, 'style' => $style2, 'index' => $i, 'name' => 'data[Lignereglement][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '',  'type' => 'text', 'class' => 'form-control  afficheinputmontantreglementclient   chekreglementfacdalanda checkmaxfac2  calculmontantt2'));
                                ?>

                              </td>
                            </tr>
                            <!-- <td style="display: none;">
                                <?php echo $reste; ?>
                              </td> -->
                            <!-- </tr> -->



                          <?php }  ?>
                          <tr style="color:#dc143c;">
                            <th><strong> Facture </strong>
                            </th>
                          </tr>
                          <strong>
                            <tr style="background-color: #4DAAA5 ;color:aliceblue; font-weight: bold;">
                              <td>Type </td>

                              <td>N° </td>
                              <td>Date</td>
                              <td>Total TTC</td>

                              <td>Montant réglé</td>
                              <td><strong>Avoir</strong></td>

                              <td>Reste</td>

                              <td></td>
                            </tr>
                          </strong>
                          <?php
                          if (!empty($factures)) {
                            // $i = -1;
                            foreach ($factures as $i => $fac) {
                              $i++;
                              // $reste = $fac->ttc - $fac->Montant_Regler;
                              /******************* */
                              $connection = ConnectionManager::get('default');

                              $totavoir = $connection->execute("select sum(factureavoirfrs.totalttc)as tot from factureavoirfrs where factureavoirfrs.facture_id =" . $fac['id'])->fetchAll('assoc');
                              if ($totavoir['0']['tot'] == null) {
                                $avtot = 0;
                              } else {
                                $avtot = $totavoir['0']['tot'];
                              }

                              /************** */
                              $mon = $connection->execute("select montantreglerachat	(" . $fac['id'] . " ) as mont")->fetchAll('assoc');
                              // debug($mon);
                              $lig = $connection->execute('select * from lignereglements where lignereglements.reglement_id=' . $idd . ' and lignereglements.facture_id=' . $fac['id'] . ';')->fetchAll('assoc');
                              //debug($lig);

                              if ($lig) {
                                $styler = "display:yesy;background-color:#4DAAA5;color:white;font-weight: bold;";
                              } else {
                                $styler = "display:none;background-color:#4DAAA5;color:white;font-weight: bold;";
                              }
                              //debug($style);die;
                              if ($mon[0]['mont'] == null) {
                                $montreg = 0;
                              } else {
                                $montreg = $mon[0]['mont'];
                              }

                              $reste = $fac['ttc']  - $montreg - $avtot;

                          ?>

                              <tr>
                                <td><?php echo 'Facture'; ?></td>

                                <td><?= h($fac['numero']) ?></td>
                                <td><?= h($fac['date']) ?></td>
                                <td><?= h($fac['ttc']) ?></td>

                                <td><?php echo ($montreg); ?></td>
                                <td><strong><?= h($avtot) ?></strong></td>
                                <td><?= $reste ?></td>



                                <td>
                                  <input type="checkbox" <?php if ($lig) { ?> checked <?php } ?> name="data[Lignereglement][<?php echo $i; ?>][facture_id]" id="facture_id<?php echo $i; ?>" index="<?php echo $i; ?>" class=" afficheinputmontantreglementclient   chekreglementfacdalanda checkmaxfac2  calculmontantt2" value="<?php echo $fac['id'] ?>" class="chekreglementbon" mnttounssi="<?php echo $fac['ttc']; ?>" mnt="<?php echo $reste; ?>">
                                  <strong> <?php
                                            echo @$this->Form->input('Montanttt', array('value' => $lig[0]['Montant'], 'style' => $styler, 'index' => $i, 'name' => 'data[Lignereglement][' . $i . '][Montanttt]', 'id' => 'Montantregler' . $i, 'label' => '',  'type' => 'text', 'class' => 'form-control afficheinputmontantreglementclient   chekreglementfacdalanda checkmaxfac2  calculmontantt2'));
                                            ?>
                                  </strong>
                                </td>
                              </tr>
                          <?php }
                          } ?>
                          <input type="hidden" name="max" value="<?php echo @$i; ?>" id="max">
                          <tr id="totalefacture" style="color:#4DAAA5; font-weight: bold;">
                            <td colspan="6"> Total factures</td>
                            <td colspan="3">
                              <input type="text" name="data[Reglement][ttpayer]" id="ttpayer" class="form-control" value="<?php echo $mtfact; ?>" readonly>
                            </td>
                          </tr>
                          <tr id="montantpayer" style="color:#4DAAA5; font-weight: bold;">
                            <td colspan="6">Montant à payer</td>
                            <td colspan="3">
                              <input type="text" name='data[Reglement][Montant]' id="mtotal" class="form-control" value="<?php echo $reglement->Montant ?>" readonly>
                              <?php //debug($reglement)
                              ?>



                            </td>
                          </tr>
                          <tr style="color:#4DAAA5; font-weight: bold;">
                            <td colspan="6">Ecart </td>
                            <td colspan="3">
                              <input <?php if ($reglement->dif ==  1) { ?> checked <?php } ?> type="checkbox" name="diff" id="diff" index="<?php echo $i; ?>" class="" value="<?php echo $reglement->dif ?>">

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
                    <!-- <a class="btn btn-primary ajouterligne   " table="addtable" index="index" tr='type' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                      <i class="fa fa-plus-circle "></i> Ajouter ligne</a> -->

                  </div>
                  <div class="panel-body">
                    <div class="table-responsive ls-table">
                      <table class="table table-bordered table-striped table-bottomless" id="addtable">
                        <tr class="type" style="display: none ">
                          <td colspan="8" style="vertical-align: top;">
                            <table>
                              <tr>
                                <td>Mode règlement </td>
                                <td>



                                  <select table="pieceregelemnt" index="" champ="paiement_id" class="  modereglement2 form-control montantbrut
                             select selectized">
                                    <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                    <?php foreach ($paiements as $id => $paiement) {


                                    ?>
                                      <option value="<?php echo $id; ?>"><?php echo  $paiement ?></option>
                                    <?php } ?>
                                  </select>
                                  <?php
                                  // echo $this->Form->input('paiement_id',array('empty'=>'choix','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control modereglement  ',
                                  // 'empty'=>'veuillez choisir',
                                  // 'label'=>'','index'=>0,'champ'=>'paiement_id','table'=>'pieceregelemnt','name'=>'data[pieceregelemnt][0][paiement_id]') );   
                                  ?>
                                  <?php echo $this->Form->control('sup', array('name' => '', 'id' => '', 'champ' => 'sup', 'table' => 'pieceregelemnt', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form', 'label' => '')); ?>
                                </td>

                              </tr>
                              <tr>
                                <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbruta" table="piece" style="display:none" class="modecheque">Montant brut</td>
                                <td name="data[piece][0][trmontantbrut]" id="" index="0" champ="trmontantbrutb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                                      echo $this->Form->control('montant_brut', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control montantbrut', 'label' => '', 'type' => 'text', 'index' => 0, 'champ' => 'montantbrut', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant_brut]'));
                                                                                                                                                                      ?> </td>
                              </tr>

                              <tr>
                                <td>Montant</td>
                                <td><?php
                                    echo $this->Form->control('montant', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control mnt bl calculmontantt differance  calculmontantt2 ', 'label' => '', 'index' => 0, 'champ' => 'montant', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][montant]'));
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
                                <td name="data[piece][0][trechance]" id="" index="0" champ="trechancea" table="piece" style="display:none" class="modecheque">Echéance </td>
                                <td name="data[piece][0][trechance]" id="" index="0" champ="trechanceb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                              echo $this->Form->control('echance', array('div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'date', 'index' => 0, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][0][echance]'));
                                                                                                                                                              ?> </td>
                              </tr>

                              <tr>
                                <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanquea" table="piece" style="display:none" class="modecheque">Banque</td>
                                <td name="data[piece][0][trbanque]" id="" index="0" champ="trbanqueb" table="piece" style="display:none" class="modecheque"><?php
                                                                                                                                                            echo $this->Form->control('banque_id', array(
                                                                                                                                                              'div' => 'form-group',
                                                                                                                                                              'between' => '<div class="col-sm-10">',
                                                                                                                                                              'after' => '</div>',
                                                                                                                                                              'class' => 'form-control  getcomptes  ',
                                                                                                                                                              'empty' => 'veuillez choisir',
                                                                                                                                                              'label' => '',
                                                                                                                                                              'index' => 0,
                                                                                                                                                              'champ' => 'banque_id',
                                                                                                                                                              'table' => 'pieceregelemnt',
                                                                                                                                                              'name' => 'data[pieceregelemnt][0][banque_id]'
                                                                                                                                                            ));
                                                                                                                                                            ?></td>
                              </tr>
                              <tr>
                                <td name="data[piece][0][trcompte]" id="" index="0" champ="trcomptea" table="piece" style="display:none" class="modecheque">Compte</td>
                                <td name="data[piece][0][trcompte]" id="" index="0" champ="trcompteb" table="piece" style="display:none" class="modecheque">
                                  <div id="divsous" champ="divsous">

                                    <?php
                                    echo $this->Form->control('compte_id', array(
                                      'div' => 'form-group',
                                      'between' => '<div class="col-sm-10">',
                                      'after' => '</div>',
                                      'class' => 'form-control    ',
                                      'empty' => 'veuillez choisir',
                                      'label' => '',
                                      'index' => 0,
                                      'champ' => 'compte_id',
                                      'table' => 'pieceregelemnt',
                                      'name' => 'data[pieceregelemnt][0][compte_id]'
                                    ));
                                    ?>
                                  </div>
                                </td>

                              </tr>

                              <tr>
                                <td name="data[piece][0][trcarnetnum]" id="" index="0" champ="trcarnetnuma" table="piece" style="display:none" class="modecheque">Numéro de carnet </td>
                                <td name="data[piece][0][trcarnetnum]" id="" index="0" champ="trcarnetnumb" table="piece" style="display:none" class="modecheque">
                                  <div id="divsoussous" champ="divsoussous">
                                    <?php echo $this->Form->control('carnetcheque_id', array(
                                      'div' => 'form-group',
                                      'between' => '<div class="col-sm-10">',
                                      'after' => '</div>',
                                      'class' => 'form-control    ',
                                      'empty' => 'veuillez choisir',
                                      'label' => '',
                                      'index' => 0,
                                      'champ' => 'carnetcheque_id',
                                      'table' => 'pieceregelemnt',
                                      'name' => 'data[pieceregelemnt][0][carnetcheque_id]'
                                    ));
                                    ?>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td name="data[piece][0][trcheque]" id="" index="0" champ="trchequea" table="piece" style="display:none" class="modecheque">Numéro de chéque </td>
                                <td name="data[piece][0][trcheque]" id="" index="0" champ="trchequeb" table="piece" style="display:none" class="modecheque">
                                  <div id="divsoussoussous" champ="divsoussoussous"><?php
                                                                                    echo $this->Form->control('cheque_id', array(
                                                                                      'div' => 'form-group',
                                                                                      'between' => '<div class="col-sm-10">',
                                                                                      'after' => '</div>',
                                                                                      'class' => 'form-control    ',
                                                                                      'empty' => 'veuillez choisir',
                                                                                      'label' => '',
                                                                                      'index' => 0,
                                                                                      'champ' => 'cheque_id',
                                                                                      'table' => 'pieceregelemnt',
                                                                                      'name' => 'data[pieceregelemnt][0][cheque_id]'
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



                            </table>

                          </td>

                          <td align="center">
                            <i index="0" id="test" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;"></i>
                          </td>
                        </tr>
                        <?php $read = "";
                        foreach ($piecereglements as $i => $piece) {
                          //  debug($piece); 
                        ?>
                          <tr>
                            <td colspan="8" style="vertical-align: top;">
                              <table>
                                <tr>
                                  <td>Mode règlement </td>
                                  <td><?php
                                      echo $this->Form->control('paiement_id', array(
                                        'value' => $piece->paiement_id,
                                        'div' => 'form-group',
                                        'between' => '<div class="col-sm-10">',
                                        'after' => '</div>',
                                        'class' => 'form-control modereglement select  ',
                                        'label' => '',
                                        'index' => $i,
                                        'id' => 'paiement_id' . $i,
                                        'champ' => 'paiement_id',
                                        'table' => 'pieceregelemnt',
                                        'name' => 'data[pieceregelemnt][' . $i . '][paiement_id]'
                                      ));
                                      ?>
                                    <?php echo $this->Form->input('id', array('value' => $piece->id, 'name' => 'data[pieceregelemnt][' . $i . '][id]', 'id' => 'id' . $i, 'champ' => 'id', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>
                                    <?php echo $this->Form->input('sup', array('name' => 'data[pieceregelemnt][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'pieceregelemnt', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'type' => 'hidden', 'after' => '</div>', 'class' => 'form-control', 'label' => 'Nom')); ?>

                                  </td>
                                </tr>
                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } ?> id="trmontantbrut<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbruta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbruta" table="piece" class="modecheque">Montant brut</td>
                                  <td name="data[piece][<?php echo $i  ?>][trmontantbrut]" id="trmontantbrutb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantbrutb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                  echo $this->Form->control('montant_brut', array('value' => $piece->montant_brut, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control editmontantbrut', 'label' => '', 'type' => 'text', 'index' => $i, 'champ' => 'montantbrut', 'id' => 'montantbrut' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant_brut]'));
                                                                                                                                                                                                                  ?> </td>
                                </tr>
                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } ?> id="trtaux<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxa<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxa" table="piece" class="modecheque">Taux</td>
                                  <td name="data[piece][<?php echo $i  ?>][trtaux]" id="trtauxb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trtauxb" table="piece" class="modecheque"><?php
                                                                                                                                                                                              echo $this->Form->control('valeur_id', array('value' => $piece->to_id, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select editmontantbrut', 'label' => '', 'index' => $i, 'champ' => 'taux', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][taux]', 'id' => 'taux' . $i, 'empty' => 'Veuillez choisir'));
                                                                                                                                                                                              ?> </td>
                                </tr>
                                <tr>
                                  <td>Montant</td>
                                  <td><?php
                                      echo $this->Form->control('montant', array('value' => $piece->montant, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control mnt calculmontantt differance  calculmontantt2', 'label' => '', 'index' => $i, 'champ' => 'montant', 'id' => 'montant' . $i, 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montant]'));
                                      //echo $this->Form->input('montantdevise',array('value'=>$piece['Piecereglement']['montantdevise'],'type'=>'hidden','div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control','label'=>'','index'=>$i,'champ'=>'montantdevise','id'=>'montantdevise'.$i,'table'=>'pieceregelemnt','name'=>'data[pieceregelemnt]['.$i.'][montantdevise]') );   
                                      ?>
                                  </td>
                                </tr>
                                <tr <?php if ($piece->paiement_id != 5) { ?> style="display:none" <?php } ?> id="trmontantnet<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantneta<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantneta" table="piece" class="modecheque">Montant Net</td>
                                  <td name="data[piece][<?php echo $i  ?>][trmontantnet]" id="trmontantnetb<?php echo $i  ?>" index="<?php echo $i  ?>" champ="trmontantnetb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                                echo $this->Form->control('montant_net', array('value' => $piece->montant_net, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'label' => '', 'type' => 'text', 'index' => $i, 'id' => 'montantnet' . $i, 'champ' => 'montantnet', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][montantnet]'));
                                                                                                                                                                                                                ?> </td>
                                </tr>
                                <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } ?> id="trechances<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trechance]" id="trechancea[<?php echo $i ?>" index="[<?php echo $i ?>" champ="trechancea" table="piece" class="modecheque">Echéance</td>
                                  <td name="data[piece][<?php echo $i ?>][trechance]" id="trechanceb[<?php echo $i ?>" index="[<?php echo $i ?>" champ="trechanceb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                      echo $this->Form->control('echance', array('value' => $piece->echance, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control datetimepicker', 'label' => '', 'type' => 'date', 'id' => 'echance' . $i, 'index' => $i, 'champ' => 'echance', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][echance]'));
                                                                                                                                                                                                      ?> </td>
                                </tr>
                                <!-- //***************************************************--->
                                <!-- //***************************************************--->
                                <tr <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?> id="trbanque<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanquea<?php echo $i ?>" index="<?php echo $i ?>" champ="trbanquea" table="piece" class="modecheque">Banque</td>
                                  <td name="data[piece][<?php echo $i ?>][trbanque]" id="trbanqueb<?php echo $i ?>" index="<?php echo $i ?>" champ="trbanqueb" table="piece" class="modecheque"><?php
                                                                                                                                                                                                echo $this->Form->control('banque_id', array(

                                                                                                                                                                                                  'value' => $piece->banque_id,
                                                                                                                                                                                                  'options' => $banques,
                                                                                                                                                                                                  'div' => 'form-group',
                                                                                                                                                                                                  'between' => '<div class="col-sm-10">',
                                                                                                                                                                                                  'after' => '</div>',
                                                                                                                                                                                                  'class' => 'form-control select getcomptes  ',
                                                                                                                                                                                                  'empty' => 'veuillez choisir',
                                                                                                                                                                                                  'label' => '',
                                                                                                                                                                                                  'index' => $i,
                                                                                                                                                                                                  'champ' => 'banque_id',
                                                                                                                                                                                                  'id' => 'banque_id',
                                                                                                                                                                                                  'table' => 'pieceregelemnt',
                                                                                                                                                                                                  'name' => 'data[pieceregelemnt][' . $i . '][banque_id]'
                                                                                                                                                                                                ));
                                                                                                                                                                                                ?></td>
                                </tr>
                                <tr <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?> id="trcompte<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trcompte]" id="trcompte<?php echo $i ?>" index="<?php echo $i ?>" champ="trcomptea" table="piece" class="modecheque">Compte</td>
                                  <td name="data[piece][<?php echo $i ?>][trcompte]" id="trcompte<?php echo $i ?>" index="<?php echo $i ?>" champ="trcompteb" table="piece" class="modecheque">


                                    <div name="data[<?php echo $i ?>][divsous]" id="divsous<?php echo $i ?>" index="<?php echo $i ?>"><?php
                                                                                                                                      echo $this->Form->control('compte_id', array(

                                                                                                                                        'value' => $piece->compte_id,
                                                                                                                                        'options' => $comptes,
                                                                                                                                        'div' => 'form-group',
                                                                                                                                        'between' => '<div class="col-sm-10">',
                                                                                                                                        'after' => '</div>',
                                                                                                                                        'class' => 'form-control select   ',
                                                                                                                                        'empty' => 'veuillez choisir',
                                                                                                                                        'label' => '',
                                                                                                                                        'index' => $i,
                                                                                                                                        'champ' => 'compte_id',
                                                                                                                                        'table' => 'pieceregelemnt',
                                                                                                                                        'name' => 'data[pieceregelemnt][' . $i . '][compte_id]'
                                                                                                                                      ));
                                                                                                                                      ?></div>
                                  </td>
                                </tr>
                                <tr <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?> id="trcarnetnum<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trcarnetnum]" id="trcarnetnuma<?php echo $i ?>" index="<?php echo $i ?>" champ="trcarnetnuma" table="piece" class="modecheque">Numéro de carnet</td>
                                  <td name="data[piece][<?php echo $i ?>][trcarnetnum]" id="trcarnetnumb<?php echo $i ?>" index="<?php echo $i ?>" champ="trcarnetnumb" table="piece" class="modecheque">
                                    <div name="data[<?php echo $i ?>][divsoussous]" id="divsoussous<?php echo $i ?>" index="<?php echo $i ?>">
                                      <?php
                                      echo $this->Form->control('carnetcheque_id', array(

                                        'value' => $piece->carnetcheque_id,
                                        'div' => 'form-group',
                                        'between' => '<div class="col-sm-10">',
                                        'after' => '</div>',
                                        'class' => 'form-control select   ',
                                        'empty' => 'veuillez choisir',
                                        'label' => '',
                                        'index' => $i,
                                        'champ' => 'carnetcheque_id',
                                        'table' => 'pieceregelemnt',
                                        'name' => 'data[pieceregelemnt][' . $i . '][carnetcheque_id]'
                                      ));
                                      ?></div>
                                  </td>
                                </tr>
                                <tr <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?> id="trcheque<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trcheque]" id="trchequea<?php echo $i ?>" index="<?php echo $i ?>" champ="trchequea" table="piece" class="modecheque">Numéro Cheque</td>
                                  <td name="data[piece][<?php echo $i ?>][trcheque]" id="trchequeb<?php echo $i ?>" index="<?php echo $i ?>" champ="trchequeb" table="piece" class="modecheque">
                                    <div name="data[<?php echo $i ?>][divsoussoussous]" id="divsoussoussous<?php echo $i ?>" index="<?php echo $i ?>"><?php

                                                                                                                                                      echo $this->Form->control('cheque_id', array(
                                                                                                                                                        'options' => $cheques,
                                                                                                                                                        'value' => $piece->cheque_id,
                                                                                                                                                        'div' => 'form-group',
                                                                                                                                                        'between' => '<div class="col-sm-10">',
                                                                                                                                                        'after' => '</div>',
                                                                                                                                                        'class' => 'form-control select   ',
                                                                                                                                                        'empty' => 'veuillez choisir',
                                                                                                                                                        'label' => '',
                                                                                                                                                        'index' => $i,
                                                                                                                                                        'champ' => 'cheque_id',
                                                                                                                                                        'table' => 'pieceregelemnt',
                                                                                                                                                        'name' => 'data[pieceregelemnt][' . $i . '][cheque_id]'
                                                                                                                                                      ));
                                                                                                                                                      ?></div>
                                  </td>
                                </tr>
                                <!-- //***************************************************--->
                                <!-- //***************************************************--->
                                <tr <?php if (($piece->paiement_id == 1) || ($piece->paiement_id == 7)) { ?> style="display:none" <?php } ?> id="trnums<?php echo $i  ?>">
                                  <td name="data[piece][<?php echo $i ?>][trnum]" id="trnuma<?php echo $i ?>" index="<?php echo $i ?>" champ="trnuma" table="piece" class="modecheque">Numéro pièce</td>

                                  <!--                                                <td  name="data[piece][<?php echo $i ?>][trnum]" id="trnumb0" index="<?php echo $i ?>"  champ="trnumb" table="piece"   class="modecheque"></td>-->
                                  <div class='form-group' id="divnumc<?php echo $i ?>" index="<?php echo $i ?>" champ="divnumc" table="piece" <?php if ($piece->paiement_id != 2) { ?> style="display:none" <?php } ?>>
                                    <label class='col-md-2 control-label'></label>
                                    <div class="col-sm-10" id="trnumc<?php echo $i ?>" index="<?php echo $i ?>" champ="trnumc" table="piece">
                                    </div>
                                  </div>
                                  <td name="data[piece][<?php echo $i ?>][trcarnetnum]" id="trcarnetnum<?php echo $i ?>" index="<?php echo $i ?>" champ="trcarnetnumb" table="piece" style="display:none" class="modecheque"><?php

                                                                                                                                                                                                                              echo $this->Form->control('carnetcheque_id', array(
                                                                                                                                                                                                                                'value' => $piece->carnetcheque_id,
                                                                                                                                                                                                                                'div' => 'form-group',
                                                                                                                                                                                                                                'between' => '<div class="col-sm-10">',
                                                                                                                                                                                                                                'after' => '</div>',
                                                                                                                                                                                                                                'class' => 'form-control  getnumcheque  ',
                                                                                                                                                                                                                                'empty' => 'veuillez choisir',
                                                                                                                                                                                                                                'label' => '',
                                                                                                                                                                                                                                'index' => $i,
                                                                                                                                                                                                                                'champ' => 'carnetcheque_id',
                                                                                                                                                                                                                                'table' => 'pieceregelemnt',
                                                                                                                                                                                                                                'name' => 'data[pieceregelemnt][' . $i . '][carnetcheque_id]'
                                                                                                                                                                                                                              ));
                                                                                                                                                                                                                              ?></td>


                                  <td>
                                    <!-- <div class='form-group ' id="divnump<?php echo $i ?>" index="<?php echo $i ?>"  champ="divnump" table="piece"  <?php if ($piece->paiement_id != 2) { ?>   style="display:none" <?php } ?> > -->
                                    <!-- <div class='col-sm-12'> -->
                                    <?php echo $this->Form->control('num_piece', array('value' => $piece->num, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'label' => '', 'type' => 'text', 'index' => $i, 'id' => 'num_piece' . $i, 'champ' => 'num_piece', 'table' => 'pieceregelemnt', 'name' => 'data[pieceregelemnt][' . $i . '][num_piece]')); ?>
                                    <!-- </div> -->
                                    <!-- </div> -->
                                  </td>
                                </tr>



                              </table>







                            </td>
                            <td hidden>
                              <i index="<?php echo $i ?>" class="fa fa-times supreg" style="color: #c9302c;font-size: 22px;" />
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
    </div>
    <!-- <button type="submit" class="pull-right btn btn-success btn-sm " id="testpersonnel" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button> -->
    <?php echo $this->Form->end(); ?>
  </div>
  <!-- /.row -->
</section>

<?php echo $this->Html->script('alert'); ?>
<script>
    $(document).ready(function() {
      // Disable all input and select elements
      $('input, select ,textarea,checkbox').prop('disabled', true);
    });
  </script>
<script>
  $('#diff').on('change', function() {
    // alert('aaaaaa')
    if ($(this).is(':checked')) {
      $(this).val(1); // Case cochée, valeur 1
    } else {
      $(this).val(0); // Case décochée, valeur 0
    }
  });
  $('.afficheinputmontantreglementclient').on('click', function() {
    index = $(this).attr('index');
    type = $('#type').val();

    if (type == 1) {

      if ($('#bonreception_id' + index).is(':checked')) {
        $('#Montantregler' + index).show();
      } else {
        $('#Montantregler' + index).hide();
      }
    } else {

      if ($('#facture_id' + index).is(':checked')) {
        $('#Montantregler' + index).show();
      } else {
        $('#Montantregler' + index).hide();
      }

    }
  })

  $('.calculmontantt').on('change keyup', function() {
    ttb = Number($('#ttpayerbon').val());
    // ttf = Number($('#ttpayer').val())
    $('#Montant').val((ttb).toFixed(3));
    $('#difference').val(($('#Montant').val() - $('#mtotal').val()).toFixed(3));


  })
  $('.chekreglementfac').on('change keyup', function() {
    function chekreglementfac() {
      $('#ttpayerbon').val(0.000);
      total = 0;
      max = $('#maxbon').val();

      for (i = 0; i <= max; i++) {
        if ($('#bonreception_id' + i).is(':checked'))
          total += Number($('#Montantregler' + i).val());
      }
      $('#ttpayerbon').val(total.toFixed(3));

    }
    chekreglementfac();



  })



  $('.checkmax').on('keyup', function() {
    function tot() {
      ttb = Number($('#ttpayerbon').val());
      ttf = Number($('#ttpayer').val())
      $('#Montant').val((ttb).toFixed(3));
      $('#difference').val(($('#Montant').val() - $('#mtotal').val()).toFixed(3));

    }

    function aaaa() {
      $('#ttpayerbon').val(0.000);
      total = 0;
      max = $('#maxbon').val();

      for (i = 0; i <= max; i++) {
        if ($('#bonreception_id' + i).is(':checked'))
          total += Number($('#montantlivraison' + i).val());
      }
      $('#ttpayerbon').val(total.toFixed(3));
      $('#mtotal').val(total.toFixed(3));

    }

    tr = $(this).parent().parent();
    montantlivraison = Number(tr.find("td").eq(4).html());
    console.log(montantlivraison);
    val = Number($(this).val());
    index = $(this).attr('index');


    if (montantlivraison < val)
      $('#montantlivraison' + index).val(montantlivraison);
    aaaa();
    tot();




  })
  $('.checkmaxfac').on('keyup', function() {
    function tot() {
      ttb = Number($('#ttpayerbon').val());
      ttf = Number($('#ttpayer').val())
      $('#Montant').val((ttb).toFixed(3));
      $('#difference').val(($('#Montant').val() - $('#mtotal').val()).toFixed(3));
      $('#mtotal').val(ttb.toFixed(3));

    }

    function chekreglementfac() {
      $('#ttpayerbon').val(0.000);
      total = 0;
      max = $('#max').val();

      for (i = 0; i <= max; i++) {
        if ($('#bonreception_id' + i).is(':checked'))
          total += Number($('#Montantregler' + i).val());
      }
      $('#ttpayerbon').val(total.toFixed(3));
      $('#mtotal').val(total.toFixed(3));

    }
    tr = $(this).parent().parent().parent();
    console.log(tr);
    montantlivraison = Number(tr.find("td").eq(7).html());
    val = Number($(this).val());
    index = $(this).attr('index');


    if (montantlivraison < val)
      $('#Montantregler' + index).val(montantlivraison);
    chekreglementfac();
    tot();




  })

  $(function() {
    $('.differance').on('keyup change', function() {
      //alert('hhhh');
      type = $('#type').val();

      if (type == 1) {
        total = $('#ttpayerbon').val();
        //alert(total)
        max = $('#index').val();
        /*  sup = $('#sup'+index).val(); */
        variable1 = 0;


        for (i = 0; i <= max; i++) {
          if ($('#sup' + i).val() != 1)
            variable1 = Number($('#montant' + i).val()) + variable1

        }

        $('#mtotal').val(variable1.toFixed(3));
        $('#difference').val(($('#ttpayerbon').val() - $('#mtotal').val()).toFixed(3));

      } else {

        variable1 = 0;

        total = $('#ttpayer').val();
        //alert(total)
        max = $('#index').val();
        /*  sup = $('#sup'+index).val(); */
        variable1 = 0;
        for (i = 0; i <= max; i++) {
          if ($('#sup' + i).val() != 1)
            variable1 = Number($('#montant' + i).val()) + variable1

        }

        $('#mtotal').val(variable1.toFixed(3));
        $('#difference').val(($('#ttpayer').val() - $('#mtotal').val()).toFixed(3));
      }


    })
    $('.mntbl').on('blur', function() {
      //  alert("hay");
      v = $(this).attr('index'); //alert(v)//console.log(v);

      //alert("libre"+val);

      tt = 0;


      for (i = 0; i <= v; i++) {
        th = $('#montant' + i).val() || 0;
        // alert(th);
        tt = (Number(tt) + Number(th)).toFixed(3);
        // alert(tt)
        //  ttpayer2=(Number(ttpayer2)-Number(th)).toFixed(3);
      }
      $('#mtotal').val(Number(tt).toFixed(3));
      // $('#difference').val(Number(tt).toFixed(3));


    });
  });
</script>


<script>
  // $('.afficheinputmontantreglementclient2').on('click', function() {
  //     index = $(this).attr('index');
  //     // alert(index)
  //     if ($('#facture_id' + index).is(':checked')) {
  //         $('#Montantregler' + index).show();
  //     } else {
  //         $('#Montantregler' + index).hide();
  //     }
  // })

  $('.calculmontantt2').on('change keyup', function() {
    ttb = Number($('#ttpayer').val());
    // ttf = Number($('#ttpayer').val())
    $('#Montant').val((ttb).toFixed(3));
    $('#difference').val(($('#Montant').val() - $('#mtotal').val()).toFixed(3));


  })
  $('.chekreglementfacdalanda').on('change keyup', function() {
    function chekreglementfacdalanda() {
      $('#ttpayer').val(0.000);
      total = 0;
      max = $('#max').val();

      for (i = 0; i <= max; i++) {
        if ($('#facture_id' + i).is(':checked'))
          total += Number($('#Montantregler' + i).val());
      }
      $('#ttpayer').val(total.toFixed(3));

    }
    chekreglementfacdalanda();



  })



  $('.checkmax2').on('keyup', function() {
    function tot() {
      ttb = Number($('#ttpayer').val());
      ttf = Number($('#ttpayer').val())
      $('#Montant').val((ttb).toFixed(3));
      $('#difference').val(($('#Montant').val() - $('#mtotal').val()).toFixed(3));

    }

    function aaaa2() {
      $('#ttpayer').val(0.000);
      total = 0;
      max = $('#max').val();

      for (i = 0; i <= max; i++) {
        if ($('#facture_id' + i).is(':checked'))
          total += Number($('#montantlivraison' + i).val());
      }
      $('#ttpayer').val(total.toFixed(3));
      $('#mtotal').val(total.toFixed(3));

    }

    tr = $(this).parent().parent();
    montantlivraison = Number(tr.find("td").eq(4).html());
    console.log(montantlivraison);
    val = Number($(this).val());
    index = $(this).attr('index');


    if (montantlivraison < val)
      $('#montantlivraison' + index).val(montantlivraison);
    aaaa2();
    tot2();




  })
  $('.checkmaxfac2').on('keyup', function() {
    function tot() {
      ttb = Number($('#ttpayerbon').val());
      ttf = Number($('#ttpayer').val())
      $('#Montant').val((ttf).toFixed(3));
      $('#difference').val(($('#Montant').val() - $('#mtotal').val()).toFixed(3));
      $('#mtotal').val(ttb.toFixed(3));

    }

    function chekreglementfacdalanda() {
      $('#ttpayer').val(0.000);
      total = 0;
      max = $('#max').val();

      for (i = 0; i <= max; i++) {
        if ($('#facture_id' + i).is(':checked'))
          total += Number($('#Montantregler' + i).val());
      }
      $('#ttpayer').val(total.toFixed(3));
      $('#mtotal').val(total.toFixed(3));

    }
    tr = $(this).parent().parent().parent();
    console.log(tr);
    montantlivraison = Number(tr.find("td").eq(7).html());
    val = Number($(this).val());
    index = $(this).attr('index');


    if (montantlivraison < val)
      $('#Montantregler' + index).val(montantlivraison);
    chekreglementfacdalanda();
    tot2();




  })

  // $(function() {
  //     $('.differancefac').on('keyup change', function() {
  //         //alert('hhhh');
  //         total = $('#ttpayer').val();
  //         //alert(total)
  //         max = $('#index').val();
  //         /*  sup = $('#sup'+index).val(); */
  //         variable1 = 0;
  //         for (i = 0; i <= max; i++) {
  //             if ($('#sup' + i).val() != 1)
  //                 variable1 = Number($('#montant' + i).val()) + variable1

  //         }

  //         $('#mtotal').val(variable1.toFixed(3));
  //         $('#difference').val(($('#ttpayer').val() - $('#mtotal').val()).toFixed(3));

  //     })
  //     $('.mntfact').on('blur', function() {
  //         //  alert("hay");
  //         v = $(this).attr('index'); //alert(v)//console.log(v);

  //         //alert("libre"+val);

  //         tt = 0;


  //         for (i = 0; i <= v; i++) {
  //             th = $('#montant' + i).val() || 0;
  //             // alert(th);
  //             tt = (Number(tt) + Number(th)).toFixed(3);
  //             // alert(tt)
  //             //  ttpayer2=(Number(ttpayer2)-Number(th)).toFixed(3);
  //         }
  //         $('#mtotal').val(Number(tt).toFixed(3));
  //         // $('#difference').val(Number(tt).toFixed(3));


  //     });
  // });
</script>
<script>
  $(function() {
    $('.getcomptes').on('change', function() {
      ind = $(this).attr('index');
      banque_id = $('#banque_id' + ind).val() || 0;

      // alert(banque_id);
      // alert(ind);
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Reglements', 'action' => 'getcompte']) ?>",
        dataType: "json",
        data: {
          banque_id: banque_id,
          ind: ind,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          // alert(data.select1);
          $('#divsous' + ind).html(data.select1);
        }
      });

    });
  });

  function getcarnet(param, ind) {
    // alert('hh');
    $.ajax({
      method: "GET",
      url: "<?= $this->Url->build(['controller' => 'Reglements', 'action' => 'getc']) ?>",
      dataType: "json",
      data: {
        id: param,
        ind: ind,
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
      },
      success: function(data) {
        // alert(data.select);
        $('#divsoussous' + ind).html(data.select2);
        // uniform_select('divsoussous' + ind);
      }
    });
  }

  function getcheque(param, ind) {
    // alert('hh');
    $.ajax({
      method: "GET",
      url: "<?= $this->Url->build(['controller' => 'Reglements', 'action' => 'getchequess']) ?>",
      dataType: "json",
      data: {
        id: param,
        ind: ind,
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
      },
      success: function(data) {
        // alert(data.select3);
        $('#divsoussoussous' + ind).html(data.select3);
        // uniform_select('divsoussous' + ind);
      }
    });
  }

  function getnumcheque(param, ind) {
    // alert('hh');
    $.ajax({
      method: "GET",
      url: "<?= $this->Url->build(['controller' => 'Reglements', 'action' => 'getnum']) ?>",
      dataType: "json",
      data: {
        id: param,
        ind: ind,
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
      },
      success: function(data) {
        // alert(data.select);
        // $('#num_piece' + ind).val(data.numeroc).prop('readonly', true);
        // uniform_select('divsoussous' + ind);
      }
    });
  }




  $(function() {
    $('.mnt').on('blur', function() {
      // alert("hay");
      v = $(this).attr('index'); //alert(v)//console.log(v);

      //alert("libre"+val);

      tt = 0;


      for (i = 0; i <= v; i++) {
        th = $('#montant' + i).val() || 0;
        //alert(th);
        tt = (Number(tt) + Number(th)).toFixed(3);
        //  ttpayer2=(Number(ttpayer2)-Number(th)).toFixed(3);
      }
      $('#Montant').val(Number(tt).toFixed(3));

    });
    $('.supreg').on('click', function() {

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
          th = $('#montant' + i).val() || 0; //console.log(th);
          tt = Number(tt) + Number(th);
        }
      }
      console.log(tt);
      $('#Montant').val(tt);
    });
    $('.modereglement2').on('change', function() {
      //alert();
      index = $(this).attr('index');
      val = $(this).val();
      // alert(val);
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
      console.log(index);
      if (Number(val) == 1) {
        //alert();
        //$('#trechance'+index).attr('class','') ;

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
        $('#trnuma' + index).hide();
        $('#trnumb' + index).hide()
        $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        $('#banque_ida' + index).hide(); // modifiction amin
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();



        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trbanquea' + index).hide();
        $('#trbanqueb' + index).hide();
        $('#trchequea' + index).hide();
        $('#trchequeb' + index).hide();
      } else if (Number(val) == 22) {
        // alert();
        //$('#trechance'+index).attr('class','') ;

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
        $('#trnuma' + index).hide();
        $('#trnumb' + index).hide()
        $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        $('#banque_ida' + index).hide(); // modifiction amin
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();


        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trbanquea' + index).hide();
        $('#trbanqueb' + index).hide();
        $('#trchequea' + index).hide();
        $('#trchequeb' + index).hide();
      } else if (Number(val) == 2) {
        //  alert('cheque');
        $('#trmontantbruta' + index).hide();
        $('#trmontantbrutb' + index).hide();
        $('#trmontantneta' + index).hide();
        $('#trmontantnetb' + index).hide();
        $('#trtauxa' + index).hide();
        $('#trtauxb' + index).hide();
        $('#trimg' + index).show();
        $('#trechancea' + index).show();
        $('#trechanceb' + index).show();
        $('#trbanquea' + index).hide();
        $('#trbanqueb' + index).hide();
        $('#banque_idb' + index).hide(); // modifiction amin  
        $('#banque_ida' + index).hide(); // modifiction amin   
        $('#trnuma' + index).show();
        $('#trnumb' + index).show();
        //ajouter select carnet trnumb0
        $('#trcarnetnuma' + index).show();
        $('#trcarnetnumb' + index).show();


        $('#trcomptea' + index).show();
        $('#trcompteb' + index).show();
        $('#trbanquea' + index).show();
        $('#trbanqueb' + index).show();
        $('#trchequea' + index).show();
        $('#trchequeb' + index).show();
        $('#divnumc' + index).show();

        $('#divnump' + index).show();

      } else if (Number(val) == 5) {
        $('#pop').html('');
        $('#trimg' + index).show();
        $('#trmontantbruta' + index).show();
        $('#trmontantbrutb' + index).show();
        $('#trmontantneta' + index).show();
        $('#trmontantnetb' + index).show();
        $('#trtauxa' + index).show();
        $('#trtauxb' + index).show();
        $('#trnbrmoins' + index).hide();
        $('#trechancea' + index).show();
        $('#trechanceb' + index).show();
        $('#trbanquea' + index).hide();
        $('#trbanqueb' + index).hide();
        // $('#trnum'+index).attr('class','') ;
        $('#trnuma' + index).show();
        $('#trnumb' + index).show();
        $('#divnump' + index).show();
        $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        $('#banque_ida' + index).hide();
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();



        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trbanquea' + index).hide();
        $('#trbanqueb' + index).hide();
        $('#trchequea' + index).hide();
        $('#trchequeb' + index).hide();
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
        //******************

        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();
        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trbanquea' + index).hide();
        $('#trbanqueb' + index).hide();
        $('#trchequea' + index).hide();
        $('#trchequeb' + index).hide();
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

        $('#trnbrmoins' + index).show();
        $('#trnuma' + index).hide();
        $('#trnumb' + index).hide()
        $('#banque_idb' + index).hide(); // modifiction amin pr pag mpreglement
        $('#banque_ida' + index).hide(); // modifiction amin
        $('#trcarnetnuma' + index).hide();
        $('#trcarnetnumb' + index).hide();


        $('#trcomptea' + index).hide();
        $('#trcompteb' + index).hide();
        $('#trbanquea' + index).hide();
        $('#trbanqueb' + index).hide();
        $('#trchequea' + index).hide();
        $('#trchequeb' + index).hide();
      }



    });
    $('.montantbrut').on('keyup change', function() {
      index = $(this).attr('index');
      //   alert(index);
      montantbrut = $('#montantbrut' + index).val() || 0;
      //   alert()
      t = $('#taux' + index).val() || 0;
      // alert(t);
      if (t == '1') {
        taux = 1.5
      };
      if (t == '4') {
        taux = 5
      };
      if (t == '3') {
        taux = 15
      };
      if (t == '5') {
        taux = 10
      };
      if (t == '6') {
        taux = 3
      };
      if (t == '7') {
        taux = 7
      };
      if (t == '8') {
        taux = 1
      };
      //alert(taux);
      retenue = (montantbrut * (taux / 100)).toFixed(3);
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
      console.log(tt);
      $('#Montant').val((tt).toFixed(3));

    });
  });
</script>
<script>
  $(function() {

    $('.fournisseurreglement').on('change', function() {
      val = $('#fournisseur_id').val() || 0;
      val2 = $('#pointdevente_id').val() || 0;
      //alert(val);
      if (val != 0)
        ulr = 'https://codifaerp.isofterp.com/codifa2022/reglements/add';
      // alert(ulr);
      $(location).attr('href', ulr + "/" + val + "/" + val2);

    });

    $('.chekreglementbon').on('click', function() {
      ind = $(this).attr('index');
      max = $('#maxbon').val();
      //alert(max);
      typefrs = $('#typefrs').val();
      //alert(typefrs);
      ttbl = 0;
      ttdv = 0;
      remise = 0;
      testt = false;
      ttounsi = 0;
      imp = $(this).attr('importation');
      ind = $(this).attr('index');
      //alert(ind);
      testimp = 0;
      for (i = 0; i <= max; i++) {
        if ($('#bonreception_id' + i).is(':checked')) {
          //alert(i);
          //alert($('#facture_id'+i).attr('importation'));
          if ($('#bonreception_id' + i).attr('importation') != imp) {
            testimp = 8;
            id = i;
          }
        }
        //zeinab
        compte = $(this).attr('compte') || 0;
        if (compte != 0) {
          index = $('#index').val();
          //alret(index)
          if ($('#bonreception_id' + i).is(':checked')) {
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
      if (testimp == 8) {
        //$('#facture_id'+id).prop('checked', false); 
        bootbox.alert('cette fature sur une importation diff�rente', function() {});
        return false
      }
      for (i = 0; i <= max; i++) {
        if ($('#bonreception_id' + i).is(':checked')) { //alert();
          testt = true;
          ttbl = Number($('#bonreception_id' + i).attr('mnttounssi')) + Number(ttbl);
          ttounsi = Number($('#bonreception_id' + i).attr('mnttounssi')) + Number(ttounsi);
          if (typefrs != 1) {
            ttdv = Number($('#devise' + i).val()) + Number(ttdv);
          }
          $('#importation_id' + i).prop('checked', true);
        } else {
          $('#importation_id' + i).prop('checked', false);
        }
      }
      if (testt === true) {
        $('#tc' + ind).attr('readonly', false);
        $('#btnenr').prop("disabled", false);
      } else {
        $('#tc' + ind).attr('readonly', true);
        $('#btnenr').prop("disabled", true);
      }
      ttpayer = Number(ttbl);
      $('#ttpayerbon').val((ttpayer).toFixed(3));
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
    $('.chekreglement').on('click', function() {

      $("#inputlibre").val("0");
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
        if ($('#facture_id' + i).is(':checked')) {
          //alert(i);
          //alert($('#facture_id'+i).attr('importation'));
          if ($('#facture_id' + i).attr('importation') != imp) {
            testimp = 8;
            id = i;
          }
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
          ttbl = Number($('#facture_id' + i).attr('mnttounssi')) + Number(ttbl);
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
          ttounsi = Number($('#factureavoirfr_id' + i).attr('mnttounssi')) + Number(ttounsi);
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
    //
    //  $('.ajouterligne_ww').on('click', function() {
    //    table = $(this).attr('table');
    //  //  alert(table);
    //    index = $(this).attr('index');
    //    //alert(index);
    //    ajouter_lignee(table, index);
    //  });
    $(".ajouterligne").on('click', function() {
      table = $(this).attr('table'); //id table
      index = $(this).attr('index'); // id max compteur
      tr = $(this).attr('tr'); //class class type
      ind = Number($('#' + index).val()) + 1;
      $ttr = $('#' + table).find('.' + tr).clone(true);
      $ttr.attr('class', 'cc'); //amin
      i = 0;
      tabb = [];
      //alert(ind);
      $ttr.find('a,input,select,div,td,textarea,tr,table').each(function() {

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
              // alert(tabb[i]);
              //----------- Amin
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
            // ----------
          }
          //  $(this).val('');

        }
      })
      $ttr.find('i').each(function() {
        $(this).attr('index', ind);
      }); //alert();console.log($ttr);
      //alert(table);
      // console.log($ttr);
      //console.log($('#'+table).find('tr:last'));
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
      // $('#'+table).find('tr:last').attr('style','');
      //		for(j=0;j<=i;j++){
      //		uniform_select(tabb[j]);
      //		}
      $('.trstituation').hide();

    });
    //    alert('ffffffffffffff')
    //    $('.supreg').on('click',function(){
    //        alert()
    //    ind= $(this).attr('index');
    //    $('#sup'+ind).val(1);
    //    $(this).parent().parent().hide();
    //    $('#btnenr').prop("disabled", false); 
    //    v=$('#index').val();console.log(v);
    //    tt=0;
    //    th=0;
    //    for(i=0;i<=v;i++){
    //    if($('#sup'+i).val() != 1)  {  
    //    th= $('#montant'+i).val()||0;  //console.log(th);
    //    tt=Number(tt)+Number(th);  
    //    }}
    //    console.log(tt);
    //    $('#Montant').val(tt);
    //        });
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