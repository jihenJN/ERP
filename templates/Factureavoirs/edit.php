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
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->script('mahdi'); ?>


<section class="content-header">
  <?php if ($typefac ==  2) { ?>

    <h1>
      Modifier facture avoir marchandise
    </h1>
  <?php } ?>

  <?php if ($typefac ==  1) { ?>

    <h1>
      Modifier facture avoir financière
    </h1>
  <?php } ?>
  <ol class="breadcrumb">


    <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $typefac]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>

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

                    <select name="client_id" id="client" class="form-control select2 control-label ">
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

                    <select name="depot_id" id="depot-id" class="form-control select2 control-label ">
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

                    <select name="commercial_id" id="commercial-id" class="form-control select2 ">
                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                      <?php foreach ($commercials as $com) {
                      ?>
                        <option <?php if ($commercial->id == $com->id) { ?> selected="selected" <?php } ?> value="<?php echo $com->id; ?>"><?php echo $com->name ?></option>
                      <?php } ?>
                    </select>


                  </div>
                </div>

                <div class="col-xs-6" style="float: right;">
                  <?php
                  echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'type' => 'textarea', 'value' => $bonreception->observation]); ?>
                </div>
                <div class="col-xs-6" style="margin-top: 20px ;">
                  <label class="control-label" for="unipxte-id" style="margin-right: 20px">Payement comptant:</label>

                  OUI <input type="radio" name="checkpayement" value="1" id="OUI" class="oui calcheck" style="margin-right: 20px">
                  NON <input type="radio" name="checkpayement" value="0" id="NON" class="oui calcheck " checked>


                </div>
              </div>
            </div>


            <div class="col-md-12">


              <section class="content" style="width: 99%">
                <div class="row">
                  <div class="box">
                    <div class="box-header with-border">
                      <a class="btn btn-primary ajouter_ligne_inventaire btn  btnajoutlignecommande" table="tabligne" index="index" style="
                                           float: right;
                                           margin-bottom: 5px;
                                           ">
                        <i class="fa fa-plus-circle "></i> Ajouter ligne</a>

                    </div>

                    <div class="panel-body">
                      <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                          <thead>
                            <tr>
                              <td align="center" style="width: 37%; font-size: 13px;"><strong>Article</strong></td>
                              <td align="center" style="width: 9%;font-size: 13px;"><strong>Qte stock </strong></td>
                              <td align="center" style="width: 9%;font-size: 13px;"><strong>Qte récept </strong></td>
                              <td align="center" style="width: 10%;font-size: 13px;"><strong>Prix</strong></td>
                              <td align="center" style="width:8%; font-size: 13px;"><strong>R/Fac</strong></td>
                              <td align="center" style="width:8%;font-size: 13px;"><strong>R/Pro </strong></td>
                              <td align="center" style="width:7%;font-size: 13px;"><strong> TVA </strong></td>
                              <td align="center" style="width:7%;font-size: 13px;"><strong> Fodec </strong></td>
                              <td align="center" style="width: 5%;font-size: 13px;"><strong> </strong></td>

                            </tr>
                          </thead>
                          <tbody>


                            <?php //if (!empty($factureavoir)) : // debug($commande);  
                            ?>
                            <?php
                            foreach ($lignefactureavoirs as $i => $res) :

                              ///debug($res);


                            ?>
                              <tr>

                                <td>
                                  <div>
                                    <label></label>
                                    <select name="<?php echo "data[Lignefacture][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="Lignefacture" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleQtest">
                                      <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                      <?php foreach ($articles as $id => $article) {
                                      ?>
                                        <option <?php if ($res->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                      <?php }


                                      ?>
                                    </select>

                                  </div>
                                  <?php echo $this->Form->input('sup', array('name' => "data[Lignefacture][" . $i . "][sup]", 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden')); ?>




                                  <?php
                                  echo $this->Form->input('id', array(
                                    'champ' => 'id', 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][id]',
                                    'value' => $res->id,
                                    'type' => 'hidden', 'id' => '', 'table' => 'Lignefacture', 'index' => '', 'div' => 'form-group',
                                    'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'
                                  ));
                                  ?>

                                </td>



                                <td align="center" table="Lignefacture">

                                  <?php echo $this->Form->control('qtestock', ['id' => 'qtestock' . $i, 'index' => $i, 'readonly' => 'readonly', 'value' => $res->qtestock, 'name' => 'data[Lignefacture][' . $i . '][qtestock]', 'empty' => true, 'label' => '', 'table' => 'lignecommandes', 'champ' => 'qtestock', 'class' => 'form-control select getstock', 'index']); ?>

                                </td>


                                <td align="center" table="Lignefacture">
                                  <?php echo $this->Form->input('quantite', array('index' => $i, 'label' => '', 'value' => $res->qte, 'name' => 'data[Lignefacture][' . $i . '][quantite]', 'type' => 'text', 'id' => 'quantite' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control htb focus', 'index')); ?>


                                </td>
                                <td align="center" table="Lignefacture">
                                  <?php echo $this->Form->input('prix', array('index' => $i, 'label' => '', 'value' => $res->prix, 'name' => 'data[Lignefacture][' . $i . '][prix]', 'type' => 'text', 'id' => 'prix' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                </td>


                                <td align="center" table="Lignefacture">
                                  <?php echo $this->Form->input('remisearticle', array('index' => $i, 'label' => '', 'value' => $res->remise, 'name' => 'data[Lignefacture][' . $i . '][remisearticle]', 'type' => 'text', 'id' => 'remisearticle' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                </td>

                                <td align="center" table="Lignefacture">
                                  <?php echo $this->Form->input('remiseclient', array('index' => $i, 'label' => '', 'value' => $res->remiseclient, 'name' => 'data[Lignefacture][' . $i . '][remiseclient]', 'type' => 'text', 'id' => 'remiseclient' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                </td>

                                <td align="center" table="Lignefacture">
                                  <?php echo $this->Form->input('tva', array('index' => $i, 'label' => '', 'value' => $res->tva, 'name' => 'data[Lignefacture][' . $i . '][tva]', 'type' => 'text', 'id' => 'tva' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                </td>

                                <td align="center" table="Lignefacture">
                                  <?php echo $this->Form->input('fodec', array('index' => $i, 'label' => '', 'value' => $res->fodec, 'name' => 'data[Lignefacture][' . $i . '][fodec]', 'type' => 'text', 'id' => 'fodec' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control ', 'index', 'readonly')); ?>
                                </td>

                                <td align="center" table="Lignefacture">
                                  <br>
                                  <i class="fa fa-times supp" style="color: #c9302c;font-size: 22px;" index="<?php echo $i ?>"></i>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                            <?php //endif; 
                            ?>
                            </tr>


                            <tr class="tr" style="display: none ">
                              <td align="center">
                                <input type="hidden" id="" champ="sup" name="" table="Lignefacture" index="" class="form-control ">
                                <select table="Lignefacture" index champ="article_id" class="js-example-responsive  articleQtest">
                                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                                  <?php foreach ($articles as $id => $article) {
                                  ?>
                                    <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                  <?php } ?>
                                </select>
                              </td>



                              <td align="center" table="Lignefacture">
                                <input table="Lignefacture" champ="qtestock" type="text" class="form-control getprixht getstock" index readonly>
                              </td>

                              <td align="center" table="Lignefacture">


                                <input table="Lignefacture" name="" id="" champ="quantite" type="text" class=" form-control htb focus" index>

                              </td>

                              <td align="center" table="Lignefacture">
                                <input readonly table="Lignefacture" type="text" champ="prix" class="form-control" index name=''>
                              </td>

                              <td align="center" table="Lignefacture">
                                <input readonly table="Lignefacture" type="text" champ="remisearticle" class="form-control" index name=''>
                              </td>
                              <td align="center" table="Lignefacture">
                                <input readonly table="Lignefacture" type="text" champ="remiseclient" class="form-control" index name=''>
                              </td>
                              <td align="center" table="Lignefacture">
                                <input readonly table="Lignefacture" type="text" champ="tva" class="form-control htb" index name=''>
                              </td>
                              <td align="center" table="Lignefacture">
                                <input readonly table="Lignefacture" type="text" champ="fodec" class="form-control htb" index name=''>
                              </td>




                              <td align="center" table="Lignefacture">
                                <i id="" class="fa fa-times supp" style="color: #c9302c;font-size: 22px;" table="Lignefacture" name=""></i>
                                <input type='hidden' table="Lignefacture" champ="" class="form-control" index name='' id="">
                              </td>
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
                <div class="row">
                  <div class="row">
                    <div style=" position: static;">
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('brut', ['id' => 'brutHT', 'value' => sprintf("%01.3f", str_replace(",", ".", $factureavoir->brut)), 'readonly' => 'readonly', 'label' => 'Brut HT', 'name', 'required' => 'off']); ?>
                      </div>
                      <div class="col-xs-4">

                        <?php echo $this->Form->control('totalremise', ['id' => 'totalremise', 'readonly' => 'readonly', 'value' => $factureavoir->remise, 'label' => 'Remise', 'name', 'required' => 'off']); ?>
                      </div>

                      <div class="col-xs-4">
                        <?php echo $this->Form->control('fodec', ['value' => $factureavoir->fodec, 'id' => 'fod', 'readonly' => 'readonly', 'label' => 'Fodec', 'name', 'required' => 'off']); ?>
                      </div>


                    </div>
                  </div>
                  <div class="row">
                    <div style=" position: static;">

                      <div class="col-xs-4">
                        <?php echo $this->Form->control('total', ['id' => 'total', 'value' => str_replace(",", ".", $factureavoir->total), 'readonly' => 'readonly', 'label' => 'Net HT', 'name', 'required' => 'off']); ?>
                      </div>



                      <?php echo $this->Form->control('fodeccommande', ['type' => 'hidden', 'id' => 'fodeccommande', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('tvacommande', ['value' => $factureavoir->tva, 'id' => 'tvacommande', 'readonly' => 'readonly', 'label' => 'TVA', 'name', 'required' => 'off']); ?>
                      </div>

                      <div class="col-xs-4">
                        <?php echo $this->Form->control('valeurescompte', ['id' => 'valeurescompte', 'type' => 'hidden', 'value' => '', 'label' => 'valeurescompte', 'name']); ?>

                        <?php echo $this->Form->control('escompte', ['id' => 'escompte', 'readonly' => 'readonly', 'value' => '', 'label' => 'Escompte', 'name', 'required' => 'off']); ?>
                      </div>

                      <!-- <div class="col-xs-4 pull-right">
                        <?php echo $this->Form->control('totalttc', ['id' => 'netapayer', 'readonly' => 'readonly', 'label' => 'Net à payé', 'name', 'required' => 'off']); ?>
                      </div> -->


                    </div>
                  </div>
                  <div class="row">
                    <div style=" position: static;">
                      <div class="col-xs-4">
                        <?php echo $this->Form->control('base', ['id' => 'baseHT', 'value' => sprintf("%01.3f", str_replace(",", ".", $factureavoir->total) + $factureavoir->fodec + $factureavoir->tpe), 'readonly' => 'readonly', 'label' => 'Base HT', 'name', 'required' => 'off']); ?>
                      </div>

                      <div class="col-xs-4">
                        <?php echo $this->Form->control('totalttc', ['id' => 'totalttccommande', 'readonly' => 'readonly', 'label' => 'TTC', 'name', 'required' => 'off']); ?>
                      </div>



                    </div>
                  </div>


                  <div class="col-xs-5">
                    <?php echo $this->Form->control('remise', ['value' => $factureavoir->client->remise, 'type' => 'hidden', 'id' => 'remise', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                  </div>

                  <div class="col-xs-5">


                    <?php echo $this->Form->control('comptant', ['type' => 'hidden', 'id' => 'comptant', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>





                    <?php echo $this->Form->control('basetva', ['type' => 'hidden', 'id' => 'basetva', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>


                  </div>

                </div>



                <div class="row">
                  <div class="row">
                    <div style=" position: static;">


                    </div>
                  </div>

                </div>
              </section>


            </div><br>
            <!-- <input type="hidden" value="<?php echo $i ?>" id="index0"> -->
          </div>
        </div>
      </div>
    </div>

    <div align="center" class="row">
      <table>


        <tr>
          <td style="text-align:center;">

            <div style="text-align:center;">
              <button type="submit" class="btn btn-success btn-sm  verifqte chauff" id="boutonCommande" style="text-align: center">Enregistrer</button>
            </div>
          </td>
        </tr>
      </table>

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
                echo $this->Form->control('date', ['empty' => true, 'value' => date("d/m/Y"), 'class' => 'form-control', 'id' => 'date']);

                ?>
              </div>
            </div>

            <div class="row">

              <div class="col-md-6">

                <label>Clients</label>

                <select name="client_id" id="client_id" class="form-control select2 control-label ">
                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                  <?php foreach ($clients as $client) {
                  ?>
                    <option <?php if ($factureavoir->client_id == $client->id) { ?> selected="selected" <?php } ?> value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-6">
                <?php
                echo $this->Form->control('commentaire', ['class' => 'form-control', 'id' => '', 'type' => 'textarea']);

                ?>
              </div>

            </div>

          </div>

          <section class="content-header">
            <h1 class="box-title"><?php echo __('Ligne facture avoir financière'); ?></h1>
          </section>
          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box">
                <div class="box-header with-border">
                  <a class="btn btn-primary al " table='tabligne'  index='index' id='ajouter_ligne_fin' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                    <i class="fa fa-plus-circle "></i> Ajouter ligne </a>
                </div>
                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                      <thead>
                        <tr>
                          <td align="center" style="width: 35%;"><strong>Article</strong></td>
                          <td align="center" style="width: 15%;"><strong>Quantité</strong></td>
                          <td align="center" style="width: 10%;"><strong>Prix</strong></td>
                          <td align="center" style="width: 10%;"><strong>Fodec</strong></td>
                          <td align="center" style="width: 10%;"><strong>TVA</strong></td>
                          <td align="center" style="width: 15%;"><strong>TTC</strong></td>
                          <td align="center" style="width: 5%;"></td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="tr" style="display: none !important">
                          <td align="center" table="Lignefacture">
                            <input type="hidden" id="" champ="sup" name="" table="Lignefacture" index="" class="form-control">

                            <?php
                            echo $this->Form->input('designation', array('class' => ' form-control  focus', 'type' => 'text', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'designation', 'table' => 'Lignefacture', 'name' => '', 'id' => ''));
                            ?>

                            <?php
                            ?>
                          </td>


                          <td align="center" table="Lignefacture">
                            <?php
                            echo $this->Form->input('quantite', array('class' => ' form-control calculavoir ', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'quantite', 'table' => 'Lignefacture', 'name' => '',  'id' => ''));
                            ?>
                          </td>


                          <td align="center" table="Lignefacture">
                            <?php
                            echo $this->Form->input('prix', array('class' => ' form-control calculavoir', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'prix', 'table' => 'Lignefacture', 'name' => '', 'id' => ''));
                            echo $this->Form->input('motanttotal', array('class' => ' form-control calculavoir', 'type' => 'hidden', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'motanttotal', 'table' => 'Lignefacture', 'name' => '', 'id' => ''));

                            ?>

                          </td>

                          <td align="center" table="Lignefacture">
                            <?php
                            echo $this->Form->input('fodec', array('class' => ' form-control  calculavoirChange', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'fodec', 'table' => 'Lignefacture', 'name' => '', 'id' => '', 'options' => $fod, 'empty' => 'Veuillez choisir !!'));
                            echo $this->Form->input('fodeccl', array('class' => ' form-control calculavoir', 'type' => 'hidden', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'fodeccl', 'table' => 'Lignefacture', 'name' => '', 'id' => ''));

                            ?>
                          </td>
                          <td align="center" table="Lignefacture">
                            <label></label>
                            <select table="Lignefacture" index champ="tva" class="js-example-responsive form-control calculavoirChange focus ">
                              <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                              <?php foreach ($tvas as $i => $t) {
                              ?>
                                <option value="<?php echo $t->id; ?>"><?php echo $t->valeur ?></option>
                              <?php } ?>
                            </select>

                            <?php
                            //echo $this->Form->input('tva', array('class' => ' form-control  calculavoirChange', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'tva', 'table' => 'Lignefacture', 'name' => '', 'id' => '', 'options' => $tv, 'empty' => 'Veuillez choisir !!'));
                            echo $this->Form->input('monatantlignetva', array('class' => ' form-control calculavoir', 'type' => 'hidden', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'monatantlignetva', 'table' => 'Lignefacture', 'name' => '', 'id' => ''));

                            ?>
                          </td>
                          <td align="center" table="Lignefacture">
                            <?php
                            echo $this->Form->input('ttc', array('class' => ' form-control calculavoir', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'ttc', 'table' => 'Lignefacture', 'name' => '', 'id' => '', 'readonly' => true));
                            echo $this->Form->input('totalttc', array('class' => ' form-control calculavoir', 'type' => 'hidden', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'totalttc', 'table' => 'Lignefacture', 'name' => '', 'id' => '', 'readonly' => true));

                            ?>
                          </td>

                          <td align="center">
                            <i class="fa fa-times supLignefacav" style="color: #c9302c;font-size: 22px;"></i>
                          </td>
                        </tr>
                        <?php
                        foreach ($lignefactureavoirs as $i => $l) {

                          // debug($l);


                        ?>
                          <tr class="cc">
                            <td>
                              <?php echo $this->Form->input('sup', array('name' => 'data[Lignefacture][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden', 'class' => 'form-control'));
                              ?>
                              <?php echo $this->Form->input('id', array('label' => '', 'value' => $l->id, 'name' => 'data[Lignefacture][' . $i . '][id]', 'type' => 'hidden', 'id' => 'name' . $i, 'table' => 'Lignefacture', 'index' => $i, 'div' => 'form-group', 'class' => 'form-control')); ?>

                              <?php echo $this->Form->control('designation', array('label' => '',  'value' => $l->designation, 'name' => 'data[Lignefacture][' . $i . '][designation]', 'id' => 'designation' . $i,  'index' => $i, 'class' => 'form-control')); ?>

                            </td>
                            <td>
                              <?php echo $this->Form->input('quantite', array('value' => $l->quantite, 'label' => '',  'name' => 'data[Lignefacture][' . $i . '][quantite]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'quantite' . $i, 'champ' => 'quantite', 'type' => 'text', 'class' => 'form-control calculavoir')); ?>

                            </td>
                            <td>
                              <?php echo $this->Form->input('prix', array('value' => $l->prix, 'label' => '',  'name' => 'data[Lignefacture][' . $i . '][prix]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'prix' . $i, 'champ' => 'prix', 'type' => 'text', 'class' => 'form-control calculavoir')); ?>

                            </td>

                            <td>
                              <label></label>
                              <select name="data[Lignefacture][<?php echo $i ?>][fodec]" id="fodec<?php echo $i ?>" class="form-control select2 calculavoirChange  control-label ">
                                <option value="" selected="selected">Veuillez choisir !!</option>

                                <?php foreach ($fodecs as $t) {
                                ?>
                                  <option <?php if ($l->fodec == $t->id) { ?> selected="selected" <?php } ?> value="<?php echo $t->id; ?>"><?php echo $t->valeur  ?></option>
                                <?php } ?>
                              </select>
                            </td>

                            <td>
                              <label></label>
                              <select name="data[Lignefacture][<?php echo $i ?>][tva]" id="tva<?php echo $i ?>" class="form-control select2 calculavoirChange control-label ">
                                <option value="" selected="selected">Veuillez choisir !!</option>

                                <?php foreach ($tvas as $t) {
                                ?>
                                  <option <?php if ($l->tva == $t->id) { ?> selected="selected" <?php } ?> value="<?php echo $t->id; ?>"><?php echo $t->valeur  ?></option>
                                <?php } ?>
                              </select>
                            </td>


                            <td>

                              <?php echo $this->Form->input('ttc', array('value' => $l->ttc, 'label' => '', 'name' => 'data[Lignefacture][' . $i . '][ttc]', 'table' => 'Lignefacture', 'index' => $i, 'id' => 'ttc' . $i, 'champ' => 'ttc', 'type' => 'text',  'class' => 'form-control', 'readonly')); ?>
                            </td>

                            <td align="center">
                              <br>
                              <i index="<?php echo $i ?>" class="fa fa-times supLignefacav" style="color: #C9302C;font-size: 22px;">
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
                <div class="row">
                  <div class="row">
                    <div style=" position: static;">
                      <div class="col-xs-6">
                        <?php echo $this->Form->control('brut', ['id' => 'ht', 'readonly' => 'readonly', 'label' => 'Total HT', 'name', 'required' => 'off', 'value' => sprintf("%01.3f", $factureavoir->brut)]); ?>
                      </div>

                      <div class="col-xs-6">
                        <?php echo $this->Form->control('fodec', ['id' => 'fod', 'readonly' => 'readonly', 'label' => 'Fodec', 'name', 'required' => 'off']); ?>

                      </div>



                    </div>
                  </div>
                  <div class="row">
                    <div style=" position: static;">




                      <div class="col-xs-6">
                        <?php echo $this->Form->control('base', ['id' => 'baseHT', 'readonly' => 'readonly', 'label' => 'Base HT', 'name', 'required' => 'off', 'value' => sprintf("%01.3f", str_replace(",", ".", ($factureavoir->brut) + ($factureavoir->fodec))),]); ?>
                      </div>

                      <div class="col-xs-6">
                        <?php echo $this->Form->control('tva', ['id' => 'tvacommande', 'readonly' => 'readonly', 'label' => 'TVA', 'name', 'required' => 'off']); ?>
                      </div>



                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-6">
                      <?php echo $this->Form->control('totalttc', ['id' => 'netapayer', 'readonly' => 'readonly', 'label' => 'TTC', 'name', 'required' => 'off']); ?>
                    </div>
                  </div>


                  <div class="col-xs-5">
                    <?php echo $this->Form->control('remise', ['type' => 'hidden', 'id' => 'remise', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>
                  </div>

                  <div class="col-xs-5">

                    <?php echo $this->Form->control('comptant', ['type' => 'hidden', 'id' => 'comptant', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>

                    <?php echo $this->Form->control('fodeccommande', ['type' => 'hidden', 'id' => 'fodeccommande', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>

                    <?php echo $this->Form->control('basetva', ['type' => 'hidden', 'id' => 'basetva', 'readonly' => 'readonly', 'label' => '', 'name', 'required' => 'off']); ?>


                  </div>





                </div>



              </section>




              <button type="submit" class="pull-right btn btn-success btn-sm alertFacavoir" id="" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
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
  $(document).ready(function() {

    // $('#client_id').on('change', function() {

    //     $('html, body').animate({
    //         scrollTop: $("#tabligne").offset().top
    //     }, 1000);
    //     ajouter("tabligne", "index");


    // })


    $(document).on('keyup', '.focus', function(e) {

      e.preventDefault(); //
      if (event.which == 13) {
        //alert('dddd')
        var $tableBody = $('#tabligne').find("tbody"), //idftable
          $trLast = $tableBody.find("tr:last");
        //  $trNew = $trLast.clone();



        // $trLast.after($trNew);
        ajouter('tabligne', 'index');

        document.getElementById("invBtnn").scrollIntoView(); //idfbouton

        e.preventDefault();
        return false;
      }
      if (event.which === 13) {
        //alert('hechem')
        //if($('input').not(':hidden')  )
        {
          var index = $('.focus').index(this) + 1;

          //  class f les    select ili temchilhom 
          $('.focus').eq(index).focus();
          event.preventDefault();
          return false;
        }
      }
      e.preventDefault();
      return false;
    });

    $(document).on('keyup', '.foc', function(e) {

      e.preventDefault(); //

      if (e.which === 13) {
        // alert('hechem')
        //if($('input').not(':hidden')  )
        {
          var index = $('.focus').index(this) + 1;


          $('#prix' + index).focus();


          // console.log('this index '+ index);
          $('.focus').eq(index).focus();
          event.preventDefault();
          return false;
        }
      }
      e.preventDefault();
      return false;
    });

    $(document).on('keyup', '.focuss', function(e) {

      e.preventDefault(); //

      if (e.which === 13) {
        // alert('hechem')
        //if($('input').not(':hidden')  )
        {
          var index = $('.focus').index(this) + 1;


          $('#remise' + index).focus();


          // console.log('this index '+ index);
          $('.focus').eq(index).focus();
          event.preventDefault();
          return false;
        }
      }
      e.preventDefault();
      return false;
    });

    $(document).on('keyup', '.focusss', function(e) {

      e.preventDefault(); //

      if (e.which === 13) {
        // alert('hechem')
        //if($('input').not(':hidden')  )
        {
          var index = $('.focus').index(this) + 1;


          $('#fodec' + index).focus();


          // console.log('this index '+ index);
          $('.focus').eq(index).focus();
          event.preventDefault();
          return false;
        }
      }
      e.preventDefault();
      return false;
    });

    $(document).on('keyup', '.focussss', function(e) {

      e.preventDefault(); //

      if (e.which === 13) {
        // alert('hechem')
        //if($('input').not(':hidden')  )
        {
          var index = $('.focus').index(this) + 1;


          $('#tva' + index).focus();


          // console.log('this index '+ index);
          $('.focus').eq(index).focus();
          event.preventDefault();
          return false;
        }
      }
      e.preventDefault();
      return false;
    });
  });
</script>
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
<?php echo $this->Html->css('select2'); ?>
<script>
  $(function() {

    $('.desactive').on('click', function() {
      /// alert('hechem')
      $(this).find("button[type='submit']").hide();
      //$(this).attr("type", "submit");
    });



    $('.calcul').on('keyup', function() {

    })



  })
</script>



<script>
  $(function() {

    $('.articleQtest').on('change', function() {

      index = $(this).attr('index');
      article_id = $('#article_id' + index).val();
      date = $('#date').val();
      depot = $('#depot-id').val();
      client = $('#client').val();


      $.ajax({
        method: "GET",
        type: "GET",
        url: "<?= $this->Url->build(['controller' => 'Bonsortiestocks', 'action' => 'getquantite']) ?>",
        dataType: "JSON",
        data: {
          idarticle: article_id,
          date: date,
          depot: depot,
          client: client,

        },
        success: function(data) {
          //  alert(data.qtes)

          $('#qtestock' + index).val(data.qtes);
          $('#prix' + index).val(data.prix);
          $('#remiseclient' + index).val(data.remise);
          $('#tva' + index).val(data.tva);
          $('#fodec' + index).val(data.fodec);
          $('#remisearticle' + index).val(data.remiseart);
          $('#quantite' + index).focus();
          $('#qte' + index).val('');


        }

      })

    })
    $('.calculHT').on('keyup', function() {
      Calcul();
    })


    // $('.supp').on('click', function() {

    //   i = $(this).attr('index');
    //   index = $('#index').val();

    //   $('#sup' + i).val('1');
    //   $(this).parent().parent().hide();

    //   Calcul(i);


    // });
  })

  function Calcul() {
    ///  alert('hechem')


    index = $('#index').val();

    totalht = 0;

    /// alert(ht)


    for (i = 0; i <= index; i++) {
      sup = $('#sup' + i).val() || 0;

      if (Number(sup) != 1) {

        prix = $('#prix' + i).val() || 0;
        ///alert(prix); 
        qte = $('#qte' + i).val() || 0;

        tot = Number(prix) * Number(qte);
        /// alert(tot)
        totalht = Number(tot) + Number(totalht);
        ///   alert(totalht)



      }
    }

    $('#ht').val(Number(totalht).toFixed(3));


  }
</script>
<script>
  const submitBtn = document.querySelector('button[type="submit"]');

  ///console.log(submitBtn)

  document.querySelector('form').addEventListener('submit', function() {

    submitBtn.disabled = true;
  });
</script>

<?php $this->end(); ?>]