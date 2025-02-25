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
<?php echo $this->Html->script('salma'); ?>
<section class="content-header">
  <h1>
    Modification bon de reception stock
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
        <?php echo $this->Form->create($bonreceptionstock, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6"><?php
                                  echo $this->Form->control('numero', ["readonly" => true]);

                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('date', ['empty' => true]);

                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('pointdevente_id', ['label' => "Site", 'empty' => 'Veuillez choisir !!', 'options' => $pointdeventes, 'class' => 'form-control select2']);

                                  ?></div>

            <div class="col-md-6"><?php
                                  echo $this->Form->control('depot_id', ['label' => "Depot", 'empty' => 'Veuillez choisir !!', 'options' => $depots, 'class' => 'form-control select2']);

                                  ?></div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('typentree_id', ['label' => 'Type dentrée', 'empty' => 'Veuillez choisir !!', 'id' => 'typeentree_id', 'class' => 'form-control select2 typeEntr', 'options' => $typentrees,]); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('typereception_id', ['label' => 'Type de reception', 'empty' => 'Veuillez choisir !!', 'id' => 'typereception_id', 'class' => 'form-control select2', 'options' => $typereceptions,]); ?>
            </div>

            <div class="col-xs-6" id="selectClient" <?php if ($bonreceptionstock->client_id == null) { ?> style="display: none" <?php } ?> <?php if ($bonreceptionstock->client_id != null) { ?> style="display: true" <?php } ?>>
              <div class="form-group input select required">

                <label>Client</label>

                <select name="client_id" id="client_id" class="form-control select2 control-label ">
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
              echo $this->Form->control('observation', ['label' => 'Observation', 'class' => 'form-control', 'type' => 'textarea']); ?>
            </div>



          </div>

        </div>


        <section class="content-header">
          <h1 class="box-title"><?php echo __('Ligne bon de reception'); ?></h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary al ajouter_ligne_inventaire" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter article </a>
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                    <thead>
                      <tr width:"20px">
                        <td align="center" style="width: 35%;"><strong>Article</strong></td>
                        <td align="center" style="width: 15%;"><strong>Qte Stock</strong></td>
                        <td align="center" style="width: 15%;"><strong>Qte</strong></td>
                        <td align="center" style="width: 15%;"><strong>Prix</strong></td>
                        <td align="center" style="width: 15%;"><strong>Total</strong></td>
                        <td align="center" style="width: 5%;"></td>

                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important">
                        <td align="center" table="ligner">
                          <label></label>
                          <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">

                          <select table="ligner" index champ="article_id" class="js-example-responsive arti articleQtest">
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                            <?php foreach ($articles as $id => $article) {
                            ?>
                              <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                            <?php } ?>
                          </select>

                          <?php
                          ?>
                        </td>


                        <td align="center" table="ligner">
                          <?php
                          echo $this->Form->input('qtestock', array('class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => 'qtestock', 'table' => 'ligner', 'name' => '', 'id' => '', 'type' => 'text', 'readonly' => true));
                          ?>
                        </td>

                        <td align="center" table="ligner">
                          <?php
                          echo $this->Form->input('qte', array('class' => ' form-control tot focus', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'qte', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                          ?>
                        </td>

                        <td align="center" table="ligner">
                          <?php
                          echo $this->Form->input('prix', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'prix', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                          ?>
                        </td>
                        <td align="center" table="ligner">
                          <?php
                          echo $this->Form->input('total', array('class' => ' form-control', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'total', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => '', 'readonly' => true));
                          ?>
                        </td>

                        <td align="center">
                          <i class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                      <?php
                      $i = -1;

                      foreach ($lignes as $i => $li) :


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
                            <select name="<?php echo "data[ligner][" . $i . "][article_id]" ?>" width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="ligner" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 articleQtest">
                              <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                              <?php foreach ($articles as $id => $article) {
                              ?>
                                <option <?php if ($li->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                              <?php } ?>
                            </select>


                          </td>

                          <td align="center">
                            <?php echo $this->Form->control('qtestock', array('class' => 'form-control', 'label' => '', 'value' => $stock, 'champ' => 'qtestock', 'name' => 'data[ligner][' . $i . '][qtestock]', 'id' => 'qtestock' . $i, 'table' => 'ligner', 'index' => $i, 'readonly' => true)); ?>

                          </td>
                          <td align="center">
                            <?php echo $this->Form->control('qte', array('class' => 'form-control tot', 'label' => '', 'value' => $li->qte, 'champ' => 'qte', 'name' => 'data[ligner][' . $i . '][qte]', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

                          </td>
                          <td align="center">
                            <?php echo $this->Form->control('prix', array('class' => 'form-control', 'label' => '', 'value' => $li->prix, 'champ' => 'qteStock', 'name' => 'data[ligner][' . $i . '][prix]', 'id' => 'prix' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

                          </td>
                          <td align="center">
                            <?php echo $this->Form->control('total', array('class' => 'form-control', 'label' => '', 'value' => $li->total, 'champ' => 'total', 'name' => 'data[ligner][' . $i . '][total]', 'id' => 'total' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

                          </td>

                          <td align="center">
                            <br>
                            <i index="<?php echo $i ?>" class="fa fa-times supLigne0" style="color: #C9302C;font-size: 22px;">
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <input type="hidden" value="<?php echo $i ?>" id="index">

                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>

          </div>


        </section>




        <div align="center" id="receptionSubmit">

          <button type="submit" id="" class="btn btn-primary  ">Enregistrer</button>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>

<script>
  $('.select2').select2({

  })
</script>
<script>
  $(function() {
    $('.depot').on('change', function() {
      ///alert('hechem');
      id = $('#site-id').val();
      //alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Inventaires', 'action' => 'getDepot']) ?>",
        dataType: "json",
        data: {
          id: id,

        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {

          $('#depot_id').html(data.select);

        }

      })
    });


    $('.articleQtest').on('change', function() {
      /// alert('hechem')

      index = $(this).attr('index');
      article_id = $('#article_id' + index).val();
      date = $('#date').val();
      depot = $('#depot-id').val();


      /// alert(depot)

      $.ajax({
        method: "GET",
        type: "GET",
        url: "<?= $this->Url->build(['controller' => 'Bonsortiestocks', 'action' => 'getquantite']) ?>",
        dataType: "JSON",
        data: {
          idarticle: article_id,
          date: date,
          depot: depot,



        },
        success: function(data) {
          //  alert(data.qtes)

          $('#qtestock' + index).val(data.qtes);
          $('#prix' + index).val(data.prix);
          $('#qte' + index).focus();

        }

      })

    })
    $('.tot').on('keyup', function() {

      ind = Number($('#index').val());
      for (j = 0; j <= ind; j++) {
        qte = Number($('#qte' + j).val()) || 0;
        prix = Number($('#prix' + j).val()) || 0;

        tot = Number(qte) * Number(prix);
        Number($('#total' + j).val(tot))


      }

    })



  });
</script>

<script>
    const submitBtn = document.querySelector('button[type="submit"]');

    ///console.log(submitBtn)

    document.querySelector('form').addEventListener('submit', function() {

        submitBtn.disabled = true;
    });
</script>
<?php $this->end(); ?>