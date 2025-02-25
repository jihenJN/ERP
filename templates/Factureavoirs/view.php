<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Factureavoirfr $factureavoirfr
 * @var string[]|\Cake\Collection\CollectionInterface $utilisateurs
 */
?>
<?php

use Cake\Datasource\ConnectionManager;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('hechem'); ?>



<section class="content-header">
  <?php if ($typefac ==  2) { ?>

    <h1>
      Conultation facture avoir marchandise
    </h1>
  <?php } ?>

  <?php if ($typefac ==  1) { ?>

    <h1>
      Conultation facture avoir
    </h1>
  <?php } ?>
  <ol class="breadcrumb">


    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>

  </ol>
</section>
<br>

<?php if ($typefac ==  2) { ?>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box ">
          <?php
          //debug($commande);
          echo $this->Form->create($factureavoir, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13",]);
          //  debug(str_replace(",", ".",$commande->total));
          //die;
          ?>
          <div class="box-body">

            <div class="row">

              <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                <div class="col-xs-6">
                  <?php
                  echo $this->Form->control('numero', ['readonly' => 'readonly']);
                  ?>
                </div>

                <div class="col-xs-6">
                  <?php

                  echo $this->Form->control('date');
                  ?>
                </div>



              </div>
            </div>

            <div class="row">

              <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">


                <div class="col-xs-6">
                  <div class="form-group input select required">

                    <label class="control-label" for="depot-id">Clients</label>

                    <select disabled name="client_id" id="client" class="form-control select2 control-label ">
                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                      <?php foreach ($clients as $id => $client) {

                      ?>
                        <option <?php if ($factureavoir->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                      <?php } ?>
                    </select>


                  </div>

                </div>
                <div class="col-xs-6">
                  <div class="form-group input select required">

                    <label>Depot</label>

                    <select disabled name="depot_id" id="depot-id" class="form-control select2 control-label ">
                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                      <?php foreach ($depots as $dep) {
                      ?>
                        <option <?php if ($factureavoir->depot_id == $dep->id) { ?> selected="selected" <?php } ?> value="<?php echo $dep->id; ?>"><?php echo $dep->name ?></option>
                      <?php } ?>
                    </select>


                  </div>




                </div>
              </div>
            </div>

            <div class="row">
              <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

                <div class="col-xs-6">
                  <div class="form-group input select required">

                    <label>Commercial</label>

                    <select disabled name="commercial_id" id="" class="form-control select2 ">
                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                      <?php foreach ($commercials as $com) {
                      ?>
                        <option <?php if ($commercial->id == $com->id) { ?> selected="selected" <?php } ?> value="<?php echo $com->id; ?>"><?php echo $com->name ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>


              </div>
            </div>

            <br>
            <br>
            <div class="col-md-12" id="blocclientinfo" style="display: true;">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><?php echo __('Info de client'); ?></h3>
                </div>
                <div class="panel-body">
                  <?php
                  if ($typeclientid == 1) {
                    $styleMatri = '';
                    $styleNumi = 'style="display:none;"';
                  } else {
                    $styleMatri = 'style="display:none;"';
                    $styleNumi = '';
                  }
                  ?>
                  <div class="col-xs-4">
                    <?php echo $this->Form->control('name', array('readonly' => 'readonly', 'value' => $lignebloc->Raison_Sociale, 'label' => 'Raison Sociale', 'id' => 'name', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    ?>
                  </div>
                  <div class="col-xs-4">
                    <?php
                    echo $this->Form->control('Tel', array('readonly' => 'readonly', 'label' => 'Téléphone', 'value' => $lignebloc->Tel, 'id' => 'telclient', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    ?>
                  </div>
                  <div class="col-xs-4">
                    <?php echo $this->Form->control('typeclient', array('readonly' => 'readonly', 'label' => 'Type Client', 'value' => $typeclientname, 'id' => 'typeclientname', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    ?>
                  </div>
                  <div class="col-xs-4" id="matri" <?= $styleMatri; ?>>
                    <?php
                    echo $this->Form->control('matriculefiscale', array('label' => 'Matricule Fiscale', 'value' => $lignebloc->Matricule_Fiscale, 'id' => 'matriculefiscale', 'div' => 'form-group', 'readonly' => 'readonly', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    ?>
                  </div>
                  <div class="col-xs-4" id="numi" <?= $styleNumi; ?>>
                    <?php
                    echo $this->Form->control('numidentite', array('label' => 'Numéro Identité', 'value' => $lignebloc->numidentite, 'id' => 'numidentite', 'div' => 'form-group', 'readonly' => 'readonly', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    ?>
                  </div>


                  <div class="col-xs-4">
                    <?php
                    echo $this->Form->control('adresse', array('readonly' => 'readonly', 'value' => $adresse, 'label' => 'Adresse', 'id' => 'adresse', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    ?>
                  </div>
                  <div class="col-xs-4">
                    <?php
                    echo $this->Form->control('remiseee', array('readonly' => 'readonly', 'value' => $lignebloc->plafontheorique, 'id' => 'remise', 'label' => 'platfond théorique',  'class' => 'form-control'));
                    ?>
                  </div>
                </div>


              </div>
            </div>
            <div class="col-md-12">


              <section class="content" style="width: 99%">
                <div class="row">
                  <div class="box">

                    <div class="panel-body">
                      <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless" id="addtable">
                          <thead>
                            <tr>
                              <th align="center" style="width: 12%; font-size: 16px;">Code</th>
                              <th align="center" style="width: 20%; font-size: 16px;">Désignation</th>
                              <th align="center" style="width: 8%; font-size: 16px;color:#ff0000">Qté Av</th>

                              <!-- <th scope="col" >Qté KG</th>
                                                <th scope="col" style="color:#ff0000">Qté KG Av</th> -->

                              <td align="center" style="width: 6%;"><strong>P.Av.R </strong></td>

                              <td align="center" style="width: 8%;"><strong> PUTTC </strong></td>
                              <td align="center" style="width: 4%;"><strong>Remise</strong></td>

                              <!-- <td align="center" style="width: 6%;"><strong>ml </strong></td> -->
                              <td align="center" style="width: 6%;"><strong>P.U.H.T</strong></td>
                              <td align="center" style="width: 8%;"><strong>T.HT</strong></td>
                              <td align="center" style="width: 4%;"><strong> TVA </strong></td>
                              <!-- <td align="center" style="width: 4%; font: size 5px;"><strong
                                                 style="font: size 5px;">Fodec</strong></td> -->
                              <td align="center" style="width: 8%;"><strong>TTC</strong>
                              </td>
                              <td hidden align="center" style="width: 8%;"><strong> TTC test</strong>
                              </td>

                            </tr>
                          </thead>
                          <tbody>


                            <?php
                            // debug($factureavoir);

                            //if (!empty($factureavoir)) : // debug($commande);  
                            ?>
                            <?php
                            foreach ($lignefactureavoirs as $i => $l) :

                              ///debug($l);


                            ?>
                              <tr>



                                <td>
                                  <div>

                                    <select disabled name="<?php echo "data[Lignefacture][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="Lignefacture" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleQtest">
                                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                      <?php foreach ($articles as $id => $article) {
                                      ?>
                                        <option <?php if ($l->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code ?></option>
                                      <?php }


                                      ?>
                                    </select>

                                  </div>
                                  <?php echo $this->Form->input('sup', array('name' => "data[Lignefacture][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden')); ?>




                                  <?php
                                  echo $this->Form->input('id', array(
                                    'champ' => 'id',
                                    'label' => '',
                                    'name' => 'data[Lignefacture][' . $i . '][id]',
                                    'value' => $l->id,
                                    'type' => 'hidden',
                                    'id' => '',
                                    'table' => 'Lignefacture',
                                    'index' => '',
                                    'div' => 'form-group',
                                    'between' => '<div class="col-sm-12">',
                                    'after' => '</div>',
                                    'class' => 'form-control'
                                  ));
                                  ?>

                                </td>

                                <td>
                                  <div>

                                    <select disabled name="<?php echo "data[Lignefacture][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="Lignefacture" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleQtest">
                                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                      <?php foreach ($articles as $id => $article) {
                                      ?>
                                        <option <?php if ($l->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Dsignation ?></option>
                                      <?php }


                                      ?>
                                    </select>

                                  </div>
                                </td>

                                <td align="center" table="Lignefacture" hidden>

                                  <?php echo $this->Form->control('qtestock', ['id' => 'qtestock' . $i, 'index' => $i, 'readonly' => 'readonly', 'value' => $l->qtestock, 'name' => 'data[Lignefacture][' . $i . '][qtestock]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'qtestock', 'class' => 'form-control select getstock', 'index']); ?>

                                </td>


                                <td align="center" table="Lignefacture">
                                  <?php echo $this->Form->input('quantite', array('index' => $i, 'label' => '', 'value' => $l->qte, 'name' => 'data[Lignefacture][' . $i . '][quantite]', 'type' => 'text', 'id' => 'quantite' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculavoirm focus', 'index', 'readonly')); ?>


                                </td>
                                <td align="center">
                                  <?php echo $this->Form->input('puttcapr', array('readonly', 'readonly', 'label' => '', 'value' => $l->puttcapr, 'name' => 'data[ligner][' . $i . '][puttcapr]', 'type' => '', 'id' => 'puttcapr' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                </td>
                                <td align="center">
                                  <?php echo $this->Form->input('puttc', array('readonly', 'readonly', 'label' => '', 'value' => $l->puttc, 'name' => 'data[ligner][' . $i . '][puttc]', 'type' => '', 'id' => 'puttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                </td>
                                <td align="center" table="Lignefacture">
                                  <?php echo $this->Form->input('remisearticle', array('index' => $i, 'label' => '', 'value' => $l->remise, 'name' => 'data[Lignefacture][' . $i . '][remisearticle]', 'type' => 'text', 'id' => 'remisearticle' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                </td>

                                <td align="center" table="Lignefacture">
                                  <?php echo $this->Form->input('prix', array('index' => $i, 'label' => '', 'value' => $l->prix, 'name' => 'data[Lignefacture][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                </td>

                                <td align="center">
                                  <?php echo $this->Form->input('ht', array('readonly', 'label' => '', 'value' => $l->totalht, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                                </td>



                                <td align="center" table="Lignefacture">
                                  <?php echo $this->Form->input('tva', array('index' => $i, 'label' => '', 'value' => $l->tva_id, 'name' => 'data[Lignefacture][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                </td>

                                <td align="center" table="Lignefacture" hidden>
                                  <?php echo $this->Form->input('fodec', array('index' => $i, 'label' => '', 'value' => $l->fodec, 'name' => 'data[Lignefacture][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                </td>
                                <td align="center">
                                  <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $l->totalttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                                </td>

                              </tr>
                            <?php endforeach; ?>
                            <?php //endif; 
                            ?>
                            </tr>

                            <input type="" value="<?php echo $i ?>" id="index" hidden>

                          </tbody>

                        </table>


                      </div>
                    </div>
                  </div>
                </div>


              </section>


              <section class="content" style="width: 99%">
                <div class="row" id="sec">
                  <div class="row">
                    <!-- <div style=" position: static;">
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('totalht', ['id' => 'totalht', 'readonly' => 'readonly', 'value' => $factureavoir->totalht, 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly', 'value' => $factureavoir->remise, 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                      </div>

                      <div class="col-xs-4" hidden>
                        <?php echo $this->Form->control('totalhtapres', ['id' => 'totalhtapres', 'value' => $factureavoir->totalht - $factureavoir->remise, 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('totaltva', ['id' => 'totaltva', 'readonly' => 'readonly', 'value' => $factureavoir->tva, 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4" hidden>
                        <?php echo $this->Form->control('totalfodec', ['id' => 'totalfodec', 'readonly' => 'readonly',  'value' => $factureavoir->fodec, 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4" hidden>
                        <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => $factureavoir->totalputtc, 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total puttc', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('timbre', ['type' => 'hidden', 'id' => 'timbre', 'name' => 'timbre', 'value' => $factureavoir->timbre_id]);

                        echo $this->Form->control('timbre_id', ['options' => $tim, 'name' => 'timbre_id', 'id' => 'timbre_id', 'class' => 'form-control', 'readonly' => true,  'label' => 'Timbre']); ?>

                      </div>
                    
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'value' => $factureavoir->totalttc, 'readonly' => 'readonly', 'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                      </div>
                      <br>
                    </div> -->

                    <div style=" position: static;">
                      <table style="width:55%;margin-left:70%;">
                        <tr>
                          <td>
                            <strong> Total HT</strong>
                          </td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('total', ['id' => 'totalht', 'value' => $factureavoir->totalht, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <strong> Total Remise </strong>
                          </td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('remisee', ['id' => 'totalremise', 'value' => $factureavoir->remise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remisee', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <strong> Total TVA</strong>
                          </td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('tva', ['id' => 'totaltva', 'class' => 'form-control', 'value' => $factureavoir->tva, 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> <strong> Total TTC </strong> </td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'readonly','value' => $factureavoir->totalttc, 'label' => false, 'name', 'class' => 'form-control  calculinversetot', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>

                        <tr>

                          <td> <strong> Timbre </strong> </td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('timbre', ['type' => 'hidden', 'id' => 'timbre', 'name' => 'timbre', 'value' => $factureavoir->timbre_id]);

                              echo $this->Form->control('timbre_id', ['options' => $tim, 'name' => 'timbre_id', 'id' => 'timbre_id', 'class' => 'form-control', 'readonly' => true,  'label' => false]); ?>

                            </div>

                          </td>
                        </tr>

                        <tr hidden>
                          <td>test remise</td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'value' => $factureavoir->remise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remiseee', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr hidden>
                          <td>Total HT après remise</td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('totalapres', ['class' => 'form-control', 'value' => $factureavoir->totalht - $factureavoir->remise, 'id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>

                        <tr hidden>
                          <td>Total Fodec</td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'value' => $factureavoir->fodec, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr hidden>
                          <td>Total PU ttc</td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => $factureavoir->totalputtc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td hidden>test ttc</td>
                          <td>
                            <div class="col-xs-4" hidden>
                              <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'value' => $factureavoir->totalttc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                            </div>
                            <!-- <div class="col-xs-4" hidden>
                                                      <?php echo $this->Form->control('totalapres1', ['id' => 'totalhtapres1', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'test après remise', 'name', 'required' => 'off']); ?>
                                                 </div> -->
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <br>
                </div>
              </section>


            </div><br>
            <!-- <input type="hidden" value="<?php echo $i ?>" id="index0"> -->
          </div>
        </div>
      </div>
    </div>


    <br>
    <br>

    </div>
    <?php echo $this->Form->end(); ?>
    </div>
    <!-- /.box -->
    </div>
    </div>
    <!-- /.row -->
  </section>


<?php } ?>



<?php if ($typefac == 1) { ?>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box ">

          <?php echo $this->Form->create($factureavoir, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
          <div class="box-body">

            <div class="row">

              <div class="col-md-6">
                <?php
                echo $this->Form->control('numero', ['readonly' => 'readonly']);

                ?>
              </div>
              <div class="col-md-6">
                <?php
                echo $this->Form->control('date', ['empty' => true, 'value' => date("d/m/Y"), 'class' => 'form-control', 'id' => 'date', 'readonly']);

                ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">

                <label>Clients</label>

                <select disabled name="client_id" id="client" class="form-control select2 control-label ">
                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                  <?php foreach ($clients as $client) {
                  ?>
                    <option <?php if ($factureavoir->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6">
                <?php
                // echo $this->Form->control('commentaire', ['class' => 'form-control', 'id' => '', 'type' => 'textarea', 'readonly']);

                ?>
              </div>

            </div>

            <?php
            if ($factureavoir->client_id == 12) {
              $stylee = "display:block;";
            } else {
              $stylee = "display:none;";
            }


            ?>
            <div class="col-xs-4" id="divnomprenom" style="<?php echo $stylee; ?>">
              <?php echo $this->Form->control('nomprenom', ['label' => 'Nom / Prénom', 'readonly' => 'readonly', 'value' => $factureavoir->nomprenom, 'required' => 'off', 'class' => 'form-control focus']); ?>

            </div>
            <div class="col-xs-4" id="divnumeroident" style="<?php echo $stylee; ?>">
              <?php echo $this->Form->control('numeroidentite', ['label' => 'Numéro identité', 'readonly' => 'readonly', 'value' => $factureavoir->numeroidentite, 'required' => 'off', 'class' => 'form-control focus']); ?>

            </div>
            <div class="col-xs-4" id="divadresseclt" style="<?php echo $stylee; ?>">
              <?php echo $this->Form->control('adressediv', ['label' => 'Adresse', 'readonly' => 'readonly', 'required' => 'off', 'value' => $factureavoir->adressediv, 'class' => 'form-control focus']); ?>
            </div>




          </div>

          <br>
          <br>
          <?php
          if ($factureavoir->client_id == 12) {
            $style = 'display: none;';
          } else {
            $style = 'display: block;';
          }
          ?>

          <div class="col-md-12" id="blocclientinfo" style="<?= $style; ?>">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><?php echo __('Info de client'); ?></h3>
              </div>
              <div class="panel-body">
                <?php
                if ($typeclientid == 1) {
                  $styleMatri = '';
                  $styleNumi = 'style="display:none;"';
                } else {
                  $styleMatri = 'style="display:none;"';
                  $styleNumi = '';
                }
                ?>
                <div class="col-xs-4">
                  <?php echo $this->Form->control('name', array('readonly' => 'readonly', 'value' => $lignebloc->Raison_Sociale, 'label' => 'Raison Sociale', 'id' => 'name', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                  ?>
                </div>
                <div class="col-xs-4">
                  <?php
                  echo $this->Form->control('Tel', array('readonly' => 'readonly', 'label' => 'Téléphone', 'value' => $lignebloc->Tel, 'id' => 'telclient', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                  ?>
                </div>
                <div class="col-xs-4">
                  <?php echo $this->Form->control('typeclient', array('readonly' => 'readonly', 'label' => 'Type Client', 'value' => $typeclientname, 'id' => 'typeclientname', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                  ?>
                </div>
                <div class="col-xs-4" id="matri" <?= $styleMatri; ?>>
                  <?php
                  echo $this->Form->control('matriculefiscale', array('label' => 'Matricule Fiscale', 'value' => $lignebloc->Matricule_Fiscale, 'id' => 'matriculefiscale', 'div' => 'form-group', 'readonly' => 'readonly', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                  ?>
                </div>
                <div class="col-xs-4" id="numi" <?= $styleNumi; ?>>
                  <?php
                  echo $this->Form->control('numidentite', array('label' => 'Numéro Identité', 'value' => $lignebloc->numidentite, 'id' => 'numidentite', 'div' => 'form-group', 'readonly' => 'readonly', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                  ?>
                </div>


                <div class="col-xs-4">
                  <?php
                  echo $this->Form->control('adresse', array('readonly' => 'readonly', 'value' => $adresse, 'label' => 'Adresse', 'id' => 'adresse', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                  ?>
                </div>
                <div class="col-xs-4">
                  <?php
                  echo $this->Form->control('remiseee', array('readonly' => 'readonly', 'value' => $lignebloc->plafontheorique, 'id' => 'remise', 'label' => 'platfond théorique',  'class' => 'form-control'));
                  ?>
                </div>
              </div>


            </div>
          </div>


          <br>
          <section class="content-header">
            <h1 class="box-title"><?php echo __('Ligne facture avoir'); ?></h1>
          </section>
          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box">
                <div class="box-header with-border">


                </div>
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless">
                      <thead>
                        <tr>
                          <th align="center" style="width: 12%; font-size: 16px;">Code</th>
                          <th align="center" style="width: 20%; font-size: 16px;">Désignation</th>
                          <th align="center" style="width: 8%; font-size: 16px;color:#ff0000">Qté Av</th>

                          <!-- <th scope="col" >Qté KG</th>
                                                <th scope="col" style="color:#ff0000">Qté KG Av</th> -->

                          <td align="center" style="width: 6%;"><strong>P.Av.R </strong></td>

                          <td align="center" style="width: 8%;"><strong> PUTTC </strong></td>
                          <td align="center" style="width: 4%;"><strong>Remise</strong></td>

                          <!-- <td align="center" style="width: 6%;"><strong>ml </strong></td> -->
                          <td align="center" style="width: 6%;"><strong>P.U.H.T</strong></td>
                          <td align="center" style="width: 8%;"><strong>T.HT</strong></td>
                          <td align="center" style="width: 4%;"><strong> TVA </strong></td>
                          <!-- <td align="center" style="width: 4%; font: size 5px;"><strong
                                                 style="font: size 5px;">Fodec</strong></td> -->
                          <td align="center" style="width: 8%;"><strong>TTC</strong>
                          </td>
                          <td hidden align="center" style="width: 8%;"><strong> TTC test</strong>
                          </td>
                        </tr>
                      </thead>
                      <tbody>

                        <?php
                        //  debug($factureavoir);
                        foreach ($lignefactureavoirs as $i => $l) {
                          // debug($l);

                        ?>
                          <tr>



                            <td>
                              <div>

                                <select disabled name="<?php echo "data[Lignefacture][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="Lignefacture" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleQtest">
                                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                  <?php foreach ($articles as $id => $article) {
                                  ?>
                                    <option <?php if ($l->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code ?></option>
                                  <?php }


                                  ?>
                                </select>

                              </div>
                              <?php echo $this->Form->input('sup', array('name' => "data[Lignefacture][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden')); ?>




                              <?php
                              echo $this->Form->input('id', array(
                                'champ' => 'id',
                                'label' => '',
                                'name' => 'data[Lignefacture][' . $i . '][id]',
                                'value' => $l->id,
                                'type' => 'hidden',
                                'id' => '',
                                'table' => 'Lignefacture',
                                'index' => '',
                                'div' => 'form-group',
                                'between' => '<div class="col-sm-12">',
                                'after' => '</div>',
                                'class' => 'form-control'
                              ));
                              ?>

                            </td>

                            <td>
                              <div>

                                <select disabled name="<?php echo "data[Lignefacture][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="Lignefacture" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleQtest">
                                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                  <?php foreach ($articles as $id => $article) {
                                  ?>
                                    <option <?php if ($l->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Dsignation ?></option>
                                  <?php }


                                  ?>
                                </select>

                              </div>
                            </td>

                            <td align="center" table="Lignefacture" hidden>

                              <?php echo $this->Form->control('qtestock', ['id' => 'qtestock' . $i, 'index' => $i, 'readonly' => 'readonly', 'value' => $l->qtestock, 'name' => 'data[Lignefacture][' . $i . '][qtestock]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'qtestock', 'class' => 'form-control select getstock', 'index']); ?>

                            </td>


                            <td align="center" table="Lignefacture">
                              <?php echo $this->Form->input('quantite', array('index' => $i, 'label' => '', 'value' => $l->qte, 'name' => 'data[Lignefacture][' . $i . '][quantite]', 'type' => 'text', 'id' => 'quantite' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control calculavoirm focus', 'index', 'readonly')); ?>


                            </td>
                            <td align="center">
                              <?php echo $this->Form->input('puttcapr', array('readonly', 'readonly', 'label' => '', 'value' => $l->puttcapr, 'name' => 'data[ligner][' . $i . '][puttcapr]', 'type' => '', 'id' => 'puttcapr' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                            </td>
                            <td align="center">
                              <?php echo $this->Form->input('puttc', array('readonly', 'readonly', 'label' => '', 'value' => $l->puttc, 'name' => 'data[ligner][' . $i . '][puttc]', 'type' => '', 'id' => 'puttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                            </td>
                            <td align="center" table="Lignefacture">
                              <?php echo $this->Form->input('remisearticle', array('index' => $i, 'label' => '', 'value' => $l->remise, 'name' => 'data[Lignefacture][' . $i . '][remisearticle]', 'type' => 'text', 'id' => 'remisearticle' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                            </td>

                            <td align="center" table="Lignefacture">
                              <?php echo $this->Form->input('prix', array('index' => $i, 'label' => '', 'value' => $l->prix, 'name' => 'data[Lignefacture][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                            </td>

                            <td align="center">
                              <?php echo $this->Form->input('ht', array('readonly', 'label' => '', 'value' => $l->totalht, 'name' => 'data[ligner][' . $i . '][ht]', 'type' => 'text', 'id' => 'ht' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>
                            </td>



                            <td align="center" table="Lignefacture">
                              <?php echo $this->Form->input('tva', array('index' => $i, 'label' => '', 'value' => $l->tva_id, 'name' => 'data[Lignefacture][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                            </td>

                            <td align="center" table="Lignefacture" hidden>
                              <?php echo $this->Form->input('fodec', array('index' => $i, 'label' => '', 'value' => $l->fodec, 'name' => 'data[Lignefacture][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                            </td>
                            <td align="center">
                              <?php echo $this->Form->input('ttc', array('readonly', 'label' => '', 'value' => $l->totalttc, 'name' => 'data[ligner][' . $i . '][ttc]', 'type' => '', 'id' => 'ttc' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index')); ?>

                            </td>

                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <input type="hidden" value="<?php echo $i; ?>" id="index" />
                  </div>
                </div>
              </div>
              <section class="content" style="width: 99%">
                <div class="row" id="sec">
                  <div class="row">
                    <!-- <div style=" position: static;">
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('totalht', ['id' => 'totalht', 'readonly' => 'readonly', 'value' => $factureavoir->totalht, 'label' => 'Total HT', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly', 'value' => $factureavoir->remise, 'label' => 'Total remise', 'name', 'required' => 'off']); ?>
                      </div>

                      <div class="col-xs-4" hidden>
                        <?php echo $this->Form->control('totalhtapres', ['id' => 'totalhtapres', 'value' => $factureavoir->totalht - $factureavoir->remise, 'readonly' => 'readonly', 'label' => 'Total HT après remise', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('totaltva', ['id' => 'totaltva', 'readonly' => 'readonly', 'value' => $factureavoir->tva, 'label' => 'Total TVA', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4" hidden>
                        <?php echo $this->Form->control('totalfodec', ['id' => 'totalfodec', 'readonly' => 'readonly',  'value' => $factureavoir->fodec, 'label' => 'Total Fodec', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4" hidden>
                        <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => $factureavoir->totalputtc, 'class' => 'form-control ontrol-label', 'readonly' => 'readonly', 'label' => 'Total puttc', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4" hidden>
                        <?php echo $this->Form->control('timbre', ['value' => sprintf("%01.3f", $timbre), 'id' => 'timbre', 'readonly' => 'readonly', 'label' => 'Timbre', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4" hidden>
                        <?php echo $this->Form->control('totalttc', ['id' => 'ttc', 'value' => $factureavoir->totalttc, 'readonly' => 'readonly', 'label' => 'Total ttc', 'name', 'required' => 'off']); ?>
                      </div>
                      <br>
                    </div> -->
                    <div style=" position: static;">
                      <table style="width:55%;margin-left:70%;">
                        <tr>
                          <td>
                            <strong> Total HT</strong>
                          </td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('total', ['id' => 'totalht', 'value' => $factureavoir->totalht, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <strong> Total Remise </strong>
                          </td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('remisee', ['id' => 'totalremise', 'value' => $factureavoir->remise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remisee', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <strong> Total TVA</strong>
                          </td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('totaltva', ['id' => 'totaltva', 'class' => 'form-control', 'value' => $factureavoir->tva, 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td> <strong> Total TTC </strong> </td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('totalttc', ['id' => 'ttc','readonly', 'value' => $factureavoir->totalttc, 'label' => false, 'name', 'class' => 'form-control  calculinversetot', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>

                        <tr>

                          <td> <strong> Timbre </strong> </td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('timbre', ['type' => 'hidden', 'id' => 'timbre', 'name' => 'timbre', 'value' => $factureavoir->timbre_id]);

                              echo $this->Form->control('timbre_id', ['options' => $tim, 'name' => 'timbre_id', 'id' => 'timbre_id', 'class' => 'form-control', 'readonly' => true,  'label' => false]); ?>

                            </div>

                          </td>
                        </tr>

                        <tr hidden>
                          <td>test remise</td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('remiseee', ['id' => 'totalremise1', 'value' => $factureavoir->remise, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name' => 'remiseee', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr hidden>
                          <td>Total HT après remise</td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('totalapres', ['class' => 'form-control', 'value' => $factureavoir->totalht - $factureavoir->remise, 'id' => 'totalhtapres', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>

                        <tr hidden>
                          <td>Total Fodec</td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('fodec', ['id' => 'totalfodec', 'value' => $factureavoir->fodec, 'class' => 'form-control', 'readonly' => 'readonly', 'label' => false, 'name', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr hidden>
                          <td>Total PU ttc</td>
                          <td>
                            <div class="col-xs-4">
                              <?php echo $this->Form->control('totalputtc', ['id' => 'totalputtc', 'value' => $factureavoir->totalputtc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td hidden>test ttc</td>
                          <td>
                            <div class="col-xs-4" hidden>
                              <?php echo $this->Form->control('totalttctest', ['id' => 'ttctest', 'value' => $factureavoir->totalttc, 'readonly' => 'readonly', 'label' => false, 'name', 'class' => 'form-control total ', 'required' => 'off']); ?>
                            </div>
                            <!-- <div class="col-xs-4" hidden>
                                                      <?php echo $this->Form->control('totalapres1', ['id' => 'totalhtapres1', 'class' => 'form-control', 'readonly' => 'readonly', 'label' => 'test après remise', 'name', 'required' => 'off']); ?>
                                                 </div> -->
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <br>
                </div>
              </section>



              <?php echo $this->Form->end(); ?>
            </div>
          </section>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  </section>
<?php } ?>






<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })



  })
  $('.select2').select2();
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
</script>
<?php $this->end(); ?>