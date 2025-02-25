<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
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
              echo $this->Form->control('datedebut', ['label' => 'Date debut', "class" => "form-control", 'type' => 'date', 'disabled' => true]); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('datefin', ['label' => 'Date fin', "class" => "form-control", 'type' => 'date', 'disabled' => true]); ?>
            </div>
            <div class="col-xs-6" >
                <?php echo $this->Form->control('remarque', ['label' => 'Remarque', 'class' => 'form-control ','disabled' => true]); ?>
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
                    $c = 1;
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
                        <td align="left"><?php echo $clientgspromoarticle->client->Raison_Sociale ?></td>
                        <td hidden>
                          <input type="checkbox" index="<?php echo $c ?>" id="cli<?php echo $c ?>" name="data[clientgspromoarticles][<?php echo $c ?>][checkk]" champ="checkk" value="0" <?php if ($clientgspromoarticle->checkk == 0) { ?> checked <?php } ?>>
                        </td>
                        <td align="center">
                          <input type="checkbox" index="<?php echo $c ?>" id="cli<?php echo $c ?>" name="data[clientgspromoarticles][<?php echo $c ?>][checkk]" champ="checkk" value="1" <?php if ($clientgspromoarticle->checkk == 1) { ?> checked <?php } ?> disabled>
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
                <table class="table table-bordered table-striped table-bottomless" id="tabligne333">
                  <thead>
                    <tr>
                      <th width="45%"><?= ('Article') ?></th>
                      <th width="20%"><?= ('Valeur') ?></th>
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
                          <select style="margin-top: 2%;" table="lignegspromoarticles" index champ="article_id" class="form-control " name="data[lignegspromoarticles][<?php echo $p ?>][article_id]" disabled>
                            <option value="<?php echo $lignegspromoarticle->article->id; ?>"><?php echo $lignegspromoarticle->article->Code . ' ' . $lignegspromoarticle->article->Dsignation ?></option>
                          </select>
                        </td>
                        <td align="center" hidden>
                          <?php echo $this->Form->control('qte', ["value" => $lignegspromoarticle->qte, 'name' => 'data[lignegspromoarticles][' . $p . '][qte]', "champ" => "qte", "id" => "qte" . $p, "index" =>  $p, "label" => "", "class" => "form-control aj3", "table" => "lignegspromoarticles", 'readonly']); ?>
                        </td>
                        <td align="center">
                          <?php echo $this->Form->control('value', ["value" => $lignegspromoarticle->value, 'name' => 'data[lignegspromoarticles][' . $p . '][value]', "champ" => "value", "id" => "value" . $p, "index" =>  $p, "label" => "", "class" => "form-control aj3", "table" => "lignegspromoarticles", 'readonly']); ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <input type="hidden" value=0 id="indexx">
              </div>
            </section>
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