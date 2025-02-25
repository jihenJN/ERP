<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bonsortiestock $bonsortiestock
 */
?>
<?php

use Cake\Datasource\ConnectionManager;
?>
<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->css('select2'); ?>
<section class="content-header">
  <h1>
    Consultation bon de sortie stock
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
        <?php echo $this->Form->create($bonsortiestock, ['role' => 'form']); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6"><?php
                                  echo $this->Form->control('numero', ["readonly" => true]);
                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('date', ['empty' => true ,'readonly']);
                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('pointdevente_id', ['label' => "Site", 'empty' => 'Veuillez choisir !!', 'options' => $pointdeventes, 'disabled' => true, 'class' => 'form-control select2']);

                                  ?></div>

            <div class="col-md-6"><?php
                                  echo $this->Form->control('depot_id', ['label' => "Depot", 'empty' => 'Veuillez choisir !!', 'options' => $depots, 'disabled' => true, 'class' => 'form-control select2']);

                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('typesortiee', ['label' => "Type de sortie", 'readonly', 'class' => 'form-control ']);

                                  ?></div>
            <div class="col-md-6" hidden><?php
                                          echo $this->Form->control('typesortie_id', ['label' => "Type de sortie", 'empty' => 'Veuillez choisir !!', 'options' => $typesorties, 'class' => 'form-control select2', 'disabled' => true,]);

                                          ?></div>
            <div class="col-xs-6" hidden>
              <?php
              echo $this->Form->control('machine_id', [
                'label' => 'Machine',
                'required' => 'off',
                'empty' => 'Veuillez choisir!!!',
                'class' => 'form-control select2 ',
                'type' => 'select',
                'options' => $machines,
                'disabled' => true

              ]);
              ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('remarque', ['label' => 'Remarque', 'class' => 'form-control ', 'type' => 'textarea', 'readonly' => true]); ?>

            </div>


          </div>

        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
        <section class="content-header">
          <h1 class="box-title"><?php echo __('Ligne bon de sortie'); ?></h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">


              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                    <thead>
                      <tr>
                        <td align="center" style="width: 40%;"><strong>Article</strong></td>
                        <td align="center" style="width: 15%;"><strong>Qte</strong></td>
                        <td align="center" style="width: 15%;"><strong>Qte Stock</strong></td>
                        <td align="center" style="width: 15%;"><strong>Prix</strong></td>
                        <td align="center" style="width: 15%;"><strong>Total</strong></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($lignes as $i => $li) :
                        $articleid = $li->article_id;
                        $date = $this->Time->format(
                          $bonsortiestock->date,
                          'yyyy-MM-dd HH:mm:ss'
                        );
                        $depotid = $bonsortiestock->depot_id;
                        $connection = ConnectionManager::get('default');
                        $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                        $stock = $inventaires[0]['v'];
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
                            <?php echo $this->Form->control('qte', array('readonly' => true, 'class' => 'form-control', 'label' => '', 'value' => $li->qte, 'champ' => 'qte', 'name' => 'data[ligner][' . $i . '][qteStock]', 'id' => 'qteStock' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

                          </td>
                          <td align="center">
                            <?php echo $this->Form->control('qtestock', array('readonly' => true,   'class' => 'form-control', 'label' => '', 'value' => $stock, 'champ' => 'qtestock', 'name' => 'data[ligner][' . $i . '][qteTheorique]', 'id' => 'qteTheorique' . $i, 'table' => 'ligner', 'index' => $i)); ?>

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