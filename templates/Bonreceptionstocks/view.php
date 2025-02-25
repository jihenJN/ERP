<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bonsortiestock $bonsortiestock
 */
?>
<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php

use Cake\Datasource\ConnectionManager;
?>
<section class="content-header">
  <h1>
    Consultation bon reception stock
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($bonreceptionstock, ['role' => 'form']); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6"><?php
                                  echo $this->Form->control('numero', ["readonly" => true]);
                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('date', ['empty' => true]);
                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('depot_id', ['label' => "Depot", 'empty' => 'Veuillez choisir !!', 'options' => $depots, 'class' => 'form-control select2', 'disabled' => true]);

                                  ?></div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('typentree_id', ['label' => 'Type dentrée', 'empty' => 'Veuillez choisir !!', 'id' => 'typeentree_id', 'class' => 'form-control select2 typeEntr', 'options' => $typentrees, 'disabled' => true]); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('typereception_id', ['label' => 'Type de reception', 'empty' => 'Veuillez choisir !!', 'id' => 'typereception_id', 'class' => 'form-control select2', 'options' => $typereceptions, 'disabled' => true]); ?>
            </div>

            <div class="col-xs-6" id="selectClient" <?php if ($bonreceptionstock->client_id == null) { ?> style="display: none" <?php } ?> <?php if ($bonreceptionstock->client_id != null) { ?> style="display: true" <?php } ?>>
              <div class="form-group input select required">

                <label>Client</label>

                <select disabled name="client_id" id="client" class="form-control select2 control-label ">
                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                  <?php foreach ($clients as $id => $client) {
                  ?>
                    <option <?php if ($bonreceptionstock->client_id == $client->id) { ?> selected="selected" <?php } ?> class="val" value="<?php echo $client->id; ?>"><?php echo $client->Code . ' ' . $client->Raison_Sociale ?></option>
                  <?php } ?>
                </select>

              </div>

            </div>

            <div class="col-xs-6" style="float: right;">
              <?php
              echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'type' => 'textarea','readonly']); ?>
            </div>

          </div>
          <!-- /.box-body -->
          <!-- /.box-body -->
          <section class="content-header">
            <h1 class="box-title"><?php echo __('Ligne bon de reception'); ?></h1>
          </section>
          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box">


                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                      <thead>
                        <tr>
                          <td align="center" style="width: 35%;"><strong>Article</strong></td>
                          <td align="center" style="width: 15%;"><strong>Qte Stock</strong></td>
                          <td align="center" style="width: 15%;"><strong>Qte</strong></td>
                          <td align="center" style="width: 15%;"><strong>Prix</strong></td>
                          <td align="center" style="width: 15%;"><strong>Total</strong></td>

                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($lignes as $i => $li) :
                          date_default_timezone_set('Africa/Tunis');

                          $date = $this->Time->format(
                            $bonreceptionstock->date,
                            'yyyy-MM-dd HH:mm:ss'
                          );


                          $connection = ConnectionManager::get('default');
                          $st = $connection->execute("select stockbassem(" . $li['article_id'] . ",'" . $date . "','0'," . $bonreceptionstock['depot_id'] . " ) as v")->fetchAll('assoc');
                          $stock = $st[0]['v'];
                          ///debug($stock);
                        ?>

                          <tr>
                            <td align="center">
                              <?php echo $this->Form->input('sup', array('name' => 'data[ligner][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'type' => 'hidden', 'class' => 'form-control'));
                              ?>
                              <?php echo $this->Form->input('id', array('label' => '', 'value' => $li->id, 'name' => 'data[ligner][' . $i . '][id]', 'type' => 'hidden', 'id' => 'name' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'class' => 'form-control')); ?>
                              <?php //echo $this->Form->control('article_id', array('class' => 'form-control  select2','label' => '','empty'=>'Veuillez choisir !!', 'value' => $li->article_id, 'champ' =>'article_id' ,'name' => 'data[ligner][' . $i . '][article_id]', 'id' => 'article_id' .$i, 'table' => 'ligner', 'index' => $i)); 
                              ?>
                              <label></label>
                              <select disabled name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="ligner" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleQtest">
                                <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                <?php foreach ($articles as $id => $article) {
                                ?>
                                  <option <?php if ($li->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                <?php } ?>
                              </select>


                            </td>
                            <td align="center">
                              <?php echo $this->Form->control('qtestock', array('readonly' => true, 'class' => 'form-control', 'label' => '', 'value' => $stock, 'champ' => 'qte', 'name' => 'data[ligner][' . $i . '][qteStock]', 'id' => 'qteStock' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

                            </td>
                            <td align="center">
                              <?php echo $this->Form->control('qte', array('readonly' => true, 'class' => 'form-control', 'label' => '', 'value' => $li->qte, 'champ' => 'qte', 'name' => 'data[ligner][' . $i . '][qteStock]', 'id' => 'qteStock' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

                            </td>

                            <td align="center">
                              <?php echo $this->Form->control('prix', array('readonly' => true, 'class' => 'form-control', 'label' => '', 'value' => sprintf("%01.3f", $li->prix), 'champ' => 'qteStock', 'name' => 'data[ligner][' . $i . '][qteStock]', 'id' => 'qteStock' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

                            </td>

                            <td align="center">
                              <?php echo $this->Form->control('total', array('readonly' => true, 'class' => 'form-control', 'label' => '', 'value' => sprintf("%01.3f", $li->total), 'champ' => 'qteStock', 'name' => 'data[ligner][' . $i . '][qteStock]', 'id' => 'qteStock' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

                            </td>

                          </tr>

                        <?php endforeach; ?>

                      </tbody>
                    </table>
                    <input type="hidden" value="<?php echo $i ?>" id="index">


                    <br>
                  </div>
                </div>
              </div>
            </div>

          </section>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>

<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>

<script>
  $('.select2').select2({

  })
</script>
<script>

</script>
<?php $this->end(); ?>