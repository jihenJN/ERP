<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
  <h1>
    Promo article Grand surface
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <?php echo $this->Form->create($gspromoarticle, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="box-body">
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('datedebut', ['label' => 'Date debut', "class" => "form-control", 'type' => 'date']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('datefin', ['label' => 'Date fin', "class" => "form-control", 'type' => 'date']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('remarque', ['label' => 'Remarque', 'class' => 'form-control ']); ?>
            </div>
            <section class="content">
              <div class="box-body">
                <table id="tabligne" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="40%" class=" text-center"><?= ('Raison_Sociale') ?></th>
                      <th width="30%" class=" text-center"><button type="button"><i class="fa fa-eye text-red rel"></i></button></th>
                    </tr>
                  </thead>
                  <tbody class='typecli' style="display:none">
                    <?php
                    foreach ($clientgspromoarticles as $c => $clientgspromoarticle) :
                      // debug($clientgspromoarticle);die;
                    ?>
                      <tr>
                        <td hidden>
                          <?php
                          echo $this->Form->control('supc', ["label" => "", "name" => "data[clientgspromoarticles][$c][supc]", "id" => 'supc' . $c, "index" => $c]);
                          ?>
                        </td>
                        <td hidden><?php echo $this->Form->control($clientgspromoarticle->client_id, ["value" => $clientgspromoarticle->client_id, "label" => "", "name" => "data[clientgspromoarticles][$c][client_id]", "id" => 'client_id' . $c, "index" => $c]); ?></td>
                        <td align="left"><?php echo  $clientgspromoarticle->client->Code ?> <?php echo $clientgspromoarticle->client->Raison_Sociale ?> </td>
                        <!-- <td hidden>
                          <input type="checkbox" index="<?php echo $c ?>" id="cli<?php echo $c ?>" name="data[clientgspromoarticles][<?php echo $c ?>][checkk]" champ="checkk" value="0" <?php if ($clientgspromoarticle->checkk == 0) { ?> checked <?php } ?>>
                        </td> -->
                        <td align="center">
                          <input type="checkbox" index="<?php echo $c ?>" id="cli<?php echo $c ?>" name="data[clientgspromoarticles][<?php echo $c ?>][checkk]" champ="checkk" value="1" <?php if ($clientgspromoarticle->checkk == 1) { ?> checked <?php } ?>>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <input type="hidden" value=<?php echo $c ?> id="index">
                  </tbody>
                </table>
              </div>
            </section>
            <section class="content">
              <div>
                <a class="btn btn-primary aj33 " data-toggle="modal" data-target="#modal-default" table='addtable' index='index' id='ajouter_promo' style="
               margin-bottom: 20px;
               margin-top: 50px;
               margin-left: 83%;
               ">
                  <i class="fa fa-plus-circle "></i> Ajouter Article promo</a>
                <table class="table table-bordered table-striped table-bottomless" id="tabligne333">
                  <thead>
                    <tr>
                      <th width="45%"><?= ('Article') ?></th>

                      <th width="20%"><?= ('Valeur') ?></th>
                      <th width="5%"><?= ('') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $p = -1;
                    foreach ($lignegspromoarticles as $p => $lignegspromoarticle) :
                    ?>
                      <tr>
                        <td>
                          <?php echo $this->Form->input('id', array('champ' => 'id', "value" => $lignegspromoarticle->id, 'name' => 'data[lignegspromoarticles][' . $p . '][id]', 'table' => 'lignegspromoarticles', 'class' => 'form-control', 'type' => 'hidden')); ?>
                          <?php echo $this->Form->input('supn', array('champ' => 'supn',  'name' => 'data[lignegspromoarticles][' . $p . '][supn]', 'table' => 'lignegspromoarticles', "id" => "supn" . $p, 'index' => $p, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control')); ?>
                         <label></label>
                          <select style="margin-top: 2%;" table="lignegspromoarticles" index champ="article_id" class="form-control  select2" name="data[lignegspromoarticles][<?php echo $p ?>][article_id]">
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                            <?php foreach ($articles as $id => $article) {
                            ?>
                              <option <?php if ($lignegspromoarticle->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                            <?php } ?>
                          </select>

                        </td>
                        <td align="center" hidden>
                          <?php echo $this->Form->control('qte', ["value" => $lignegspromoarticle->qte, 'name' => 'data[lignegspromoarticles][' . $p . '][qte]', "champ" => "qte", "id" => "qte" . $p, "index" =>  $p, "label" => "", "class" => "form-control aj3", "table" => "lignegspromoarticles"]); ?>
                        </td>
                        <td align="center">
                          <?php echo $this->Form->control('value', ["value" => $lignegspromoarticle->value, 'name' => 'data[lignegspromoarticles][' . $p . '][value]', "champ" => "value", "id" => "value" . $p, "index" =>  $p, "label" => "", "class" => "form-control aj3", "table" => "lignegspromoarticles"]); ?>
                        </td>
                        <td align="center"><i index="<?php echo $p ?>" class="fa fa-times suppromo" style="color: #C9302C;font-size: 22px;"></td>
                      </tr>
                    <?php endforeach; ?>
                    <tr class="tr" style="display: none !important">
                      <td align="center">
                        <input type="hidden" name="" id="" champ="supn" table="lignegspromoarticles" index="" class="form-control">
                        <select table="lignegspromoarticles" index champ="article_id" class="form-control  ">
                          <option value="" selected="selected">Veuillez choisir !!</option>
                          <?php foreach ($articles as $id => $article) {
                          ?>
                            <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td align="center" hidden>
                      </td>
                      <td align="center">
                        <input table="lignegspromoarticles" type="text" class="form-control " index="" name="" id="" champ="value">
                      </td>
                      <td align="center">
                        <i index="" id="" class="fa fa-times suppromo" style="color: #c9302c;font-size: 22px;"></i>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" value="<?php echo $p ?>" id="indexx">
              </div>
            </section>
            <button type="submit" class="pull-right btn btn-success " id="pourr" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

            <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('.select2').select2()
    //alert('m')
  });
</script>
<?php $this->end(); ?>