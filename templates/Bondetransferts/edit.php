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
    Modification bon de transfert
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
        <?php echo $this->Form->create($bondetransfert, ['role' => 'form','onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6"><?php
                                  echo $this->Form->control('numero', ["readonly" => true]);

                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('date', ['empty' => true]);

                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('pointdeventeentree_id', ['label' => "Site arrive", 'empty' => 'Veuillez choisir !!', 'options' => $pointdeventes, 'class' => 'form-control select2 depotarr']);

                                  ?></div>
            <div class="col-md-6"><?php
                                  echo $this->Form->control('pointdeventesortie_id', ['label' => "Site sortie", 'empty' => 'Veuillez choisir !!', 'options' => $pointdeventes, 'class' => 'form-control select2 depotsort']);

                                  ?></div>

            <div class="col-md-6"><?php
                                  echo $this->Form->control('depotarrive_id', ['label' => "Depot arrive", 'empty' => 'Veuillez choisir !!', 'options' => $depotarrives, 'class' => 'form-control select2']);

                                  ?></div>

            <div class="col-md-6"><?php
                                  echo $this->Form->control('depotsortie_id', ['label' => "Depot sortie", 'empty' => 'Veuillez choisir !!', 'options' => $depotdeparts, 'class' => 'form-control select2']);

                                  ?></div>


          </div>

        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
        <section class="content-header">
          <h1 class="box-title"><?php echo __('Ligne bon de transfert'); ?></h1>
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
                        <td align="center" style="width: 20%;"><strong>Qte stock</strong></td>
                        <td align="center" style="width: 20%;"><strong>Quantite </strong></td>
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
                        <td align="center" table="ligner">
                          <?php
                          echo $this->Form->input('qte', array('class' => ' form-control ', 'label' => '', 'index' => '', 'champ' => 'qte', 'table' => 'ligner', 'name' => '', 'id' => '', 'type' => 'text', 'readonly' => true));
                          ?>
                        </td>

                        <td align="center" table="ligner">
                          <?php
                          echo $this->Form->input('qteliv', array('class' => ' form-control ', 'type' => 'number', 'value' => '', 'label' => '', 'index' => '', 'champ' => 'qteliv', 'table' => 'ligner', 'name' => '', 'empty' => 'Veuillez choisir !!', 'id' => ''));
                          ?>
                        </td>



                        <td align="center">
                          <i class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                      <?php
                      $i = -1;

                      foreach ($lignes as $i => $li) :
                        ///debug($bondetransfert);
                        $articleid = $li->article_id;
                        $date = $this->Time->format(
                          $bondetransfert->date,
                          'yyyy-MM-dd HH:mm:ss'
                        );
                        $depotid = $bondetransfert->depotsortie_id;


                        $connection = ConnectionManager::get('default');
                        $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
                        $stock = $inventaires[0]['v'];
                        //debug($stock);
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
                            <?php echo $this->Form->control('qte', array('class' => 'form-control', 'label' => '', 'value' =>  $stock, 'champ' => 'qte', 'name' => 'data[ligner][' . $i . '][qte]', 'id' => 'qte' . $i, 'table' => 'ligner', 'index' => $i, 'readonly' => true)); ?>

                          </td>
                          <td align="center">
                            <?php echo $this->Form->control('qteliv', array('class' => 'form-control', 'label' => '', 'value' => $li->qteliv, 'champ' => 'qteliv', 'name' => 'data[ligner][' . $i . '][qteliv]', 'id' => 'qteliv' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

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



        <div align="center" id="">

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
    $('.depotarr').on('change', function() {
      ///alert('hechem');
      id = $('#pointdeventeentree-id').val();
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

          $('#depotarrive-id-').html(data.select);

        }

      })
    });

    $('.depotsort').on('change', function() {
      ///alert('hechem');
      id = $('#pointdeventesortie-id').val();
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

          $('#depotsortie-id').html(data.select);

        }

      })
    });


    $('.articleQtest').on('change', function() {
      // alert('hchem')

      index = $(this).attr('index');
      article_id = $('#article_id' + index).val();
      date = $('#date').val();
      depot = $('#depotsortie-id').val();
      // alert(depot)

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
          //   alert(data.qtes)

          $('#qte' + index).val(data.qtes);
          $('#prix' + index).val(data.prix);
          $('#qteStock' + index).focus();

        }

      })

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