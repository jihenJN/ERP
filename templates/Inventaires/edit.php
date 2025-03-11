<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inventaire $inventaire
 */
?>
<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->fetch('script'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Modification Inventaire
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
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
        <?php echo $this->Form->create($inventaire, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('numero', ['label' => 'Numéro', 'readonly']); ?>
          </div>
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('date', ['label' => 'Date', 'id' => 'date']); ?>
          </div>


          <div class="col-xs-6">
            <?php
            echo $this->Form->control('pointdevente_id', ['label' => 'Site', 'empty' => 'Veuillez choisir !!', 'id' => 'pointdevente_id', 'class' => 'form-control select2']); ?>
          </div>

          <div class="col-xs-6">
            <?php
            echo $this->Form->control('depot_id', ['label' => 'Dépot', 'empty' => 'Veuillez choisir !!', 'id' => 'depot_id', 'class' => 'form-control select2']); ?>
          </div>


        </div>

        <section class="content-header">
          <h1 class="box-title"><?php echo __('Articles'); ?></h1>
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
                        <td align="center" style="width: 50%;"><strong>Article</strong></td>
                        <td align="center" style="width: 20%;"><strong>Qte Théorique</strong></td>
                        <td align="center" style="width: 20%;"><strong>Qte Stock</strong></td>
                        <td align="center" style="width: 10%;"></td>

                      </tr>
                    </thead>
                    <tbody>
                      <tr class="tr" style="display: none !important">
                        <td align="center" table="ligner">
                          <!-- <label></label> -->
                          <input type="hidden" id="" champ="sup" name="" table="ligner" index="" class="form-control">

                          <select table="ligner" index champ="article_id" class="js-example-responsive arti articleQtest">
                            <option value="" selected="selected" disabled>Veuillez choisir !!</option>
                            <?php foreach ($articles as $id => $article) {
                            ?>
                              <option value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                            <?php } ?>
                          </select>

                          <?php
                          // echo $this->Form->input('article_id',array('class'=>' form-control ','label'=>'','index'=>'','champ'=>'article_id','table'=>'ligner','name'=>'','empty'=>'Veuillez choisir !!','id'=>'') );   
                          ?>

                        <td align="center" table="ligner">


                          <?php
                          echo $this->Form->input('qteTheorique', array('readonly','class' => ' form-control', 'label' => '', 'index' => '', 'champ' => 'qteTheorique', 'table' => 'ligner', 'name' => '', 'id' => ''));
                          ?>
                        </td>
                        <td align="center" table="ligner">


                          <?php
                          echo $this->Form->input('qteStock', array('class' => ' form-control ajouttt', 'label' => '', 'index' => '', 'champ' => 'qteStock', 'table' => 'ligner', 'name' => '', 'id' => '', 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')"));
                          ?>
                        </td>

                        </td>

                        <td align="center">

                          <i index="0" id="" class="fa fa-times supLigne0" style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                      <?php
                      $i = -1;

                      foreach ($lignes as $i => $li) :
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
                            <?php echo $this->Form->control('qteTheorique', array('readonly','class' => 'form-control', 'label' => '', 'value' => $li->qteTheorique, 'champ' => 'qteTheorique', 'name' => 'data[ligner][' . $i . '][qteTheorique]', 'id' => 'qteTheorique' . $i, 'table' => 'ligner', 'index' => $i)); ?>

                          </td>
                          <td align="center">
                            <?php echo $this->Form->control('qteStock', array('class' => 'form-control ajouttt', 'label' => '', 'value' => sprintf("%01.3f", $li->qteStock), 'champ' => 'qteStock', 'name' => 'data[ligner][' . $i . '][qteStock]', 'id' => 'qteStock' . $i, 'table' => 'ligner', 'index' => $i, 'type' => 'number', 'step' => 'any', 'min' => "0", 'oninput' => "validity.valid||(value='')")); ?>

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
            <div class="box-header with-border">
              <a class="btn btn-primary al ajouter_ligne_inventaire" table='addtable' index='index' id='' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                <i class="fa fa-plus-circle "></i> Ajouter article </a>
            </div>
          </div>


        </section>





        <!-- /.box-body -->
        <div align="center">
          <button type="submit" class="pull-right btn btn-success btn-sm " id="inventaire" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

          <!-- <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'inventaire']); ?> -->
        </div>
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
  $(document).ready(function() {
    $('.ajouttt').on('keydown', function (event) {
        // alert('aller')
        if (event.key === "Enter" && event.ctrlKey) {

            event.preventDefault();
            $(this).val($(this).val() + "\n");
        } else if (event.key === "Enter") {

            ajouter("tabligne", "index");

            // });
        }
    });
  });

    $(document).on('keyup', '.focus', function(e) {
      //  alert('fff')
      e.preventDefault(); //
      if (event.which == 13) {
        // alert('dddd')
        var $tableBody = $('#tabligne').find("tbody"), //idftable
          $trLast = $tableBody.find("tr:last");
        //  $trNew = $trLast.clone();



        // $trLast.after($trNew);
        ajouter('tabligne', 'index');

        document.getElementById("invBtnn").scrollIntoView(); //idfbouton

        e.preventDefault();
        return false;
      }
      if (e.which === 13) {
        //if($('input').not(':hidden')  )
        {
          var index = $('.focus').index(this) + 1; //  class f les    select ili temchilhom 
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
  $('.select2').select2({

  })

  $('.articleQtest').on('change', function() {

    index = $(this).attr('index');
    article_id = $('#article_id' + index).val();
    date = $('#date').val();
    depot = $('#depot_id').val();

    $.ajax({
      method: "GET",
      type: "GET",
      url: "<?= $this->Url->build(['controller' => 'Inventaires', 'action' => 'getquantite']) ?>",
      dataType: "JSON",
      data: {
        idarticle: article_id,
        date: date,
        depot: depot,

      },
      success: function(data) {
        //  alert(data.qtes)

        $('#qteTheorique' + index).val(data.qtes);

        $('#qteStock' + index).focus();

      }

    })

  })


  /////////////////

</script>
<?php $this->end(); ?>