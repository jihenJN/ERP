<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Bondereservation $bondereservation
 */

use League\Container\Argument\DefaultValueArgument;
use PhpParser\Node\Stmt\Label;

?>



<section class="content-header">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
  <ol class="breadcrumb">
    <li><a href="</*?php echo $this->Url->build(['action' => 'index']); */?>"><i class="fa fa-dashboard"></i> </*?php echo __('Home'*/); ?></a></li>
  </ol>

  <div class="row">
    <div class="col-md-12">
      <div style="margin-bottom:10px" type="submit"><?php echo $this->Html->link(__('retour'), ['action' => 'index'], ['class' => 'btn btn-success ']) ?>
      </div>
    </div>

</section>




<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
        <div class="box-header with-border">
          <h1 class="box-title">Modification bon de reservation</h1>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($bondereservation, ['role' => 'form']); ?>

        <div class="box ">
          <div class="row">
            <div class="panel-body">

              <div class="col-xs-6">
                <?php
                echo $this->Form->control('numero', ['readonly' => "readonly"]); ?>
              </div>

              <div class="col-xs-6">
                <?php
                echo $this->Form->control('depot_id', ['options' => $depots, 'empty' => true]); ?>
              </div>

              <div class="col-xs-6">
                <?php
                echo $this->Form->control('date', ['empty' => true, 'class' => "form-control pull-right"]); ?>
              </div>

              <div class="col-xs-6">
                <?php
                echo $this->Form->control('pointdevente_id', ['options' => $pointdeventes, 'empty' => true]); ?>
              </div>


              <div class="col-xs-6">
                <?php
                echo $this->Form->control('client_id', ['options' => $clients, 'empty' => true]); ?>
              </div>


              <div class="col-md-12">

                <section class="content-header">
                  <h1 class="box-title"><?php echo __('Ligne bon de reservation'); ?></h1>
                </section>
                <section class="content" style="width: 99%">
                  <div class="row">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <a class="btn btn-primary  " table='addtable' index='index2' id='ajouter_ligne2' style="
                         float: right;
                         margin-bottom: 5px;
                         ">
                          <i class="fa fa-plus-circle "></i> ajouter Ligne bon de reservation</a>

                      </div>
                      <div class="panel-body">
                        <div class="table-responsive ls-table">
                          <table class="table table-bordered table-striped table-bottomless" id="tabligne2">
                            <thead>
                              <tr width:20px">


                                <td align="center" nowrap="nowrap"><strong>Article</strong></td>
                                <td align="center" nowrap="nowrap"><strong>Quantité stock</strong></td>
                                <td align="center" nowrap="nowrap"><strong>quantite</strong></td>
                                <td align="center" nowrap="nowrap"></td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="tr" style="display: none !important">

                                <td style="width: 30%;" align="center">
                                  <?php echo $this->Form->input('sup', array('name' => '', 'id' => 'sup', 'champ' => 'sup', 'table' => 'tabligne2', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                  ?>
                                  <?php
                                  echo $this->Form->control('article_id', ['options' => $articles, 'label' => '', 'label' => '', 'name' => '', 'id' => 'article_id', 'table' => 'tabligne2', 'champ' => 'article_id', 'class' => 'form-control', 'between' => '<div class="col-sm-12">', 'after' => '</div>',]); ?>
                                  <?php echo $this->Form->input('id', array('champ' => 'id', 'label' => '', 'name' => '', 'type' => 'hidden', 'id' => '', 'table' => 'tabligne2', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                </td>


                                <td style="width: 30%;" align="center">

                                  <input table="tabligne2" type='text' champ='quantitéstock' class='form-control ' class='input' style="margin-right:50%;margin-top: 20px;" disabled>

                                </td>

                                <td style="width: 30%;margin-right:50%;margin-top: 20px;" align="center">

                                  <?php echo $this->Form->input('quantite', array('champ' => 'quantite', 'label' => '',  'name' => '', 'type' => 'text', 'id' => 'quantite', 'table' => 'tabligne2', 'index' => '', 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number')); ?>

                                </td>


                                <td align="center"><i index="" id="" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;"></td>

                              </tr>
                              <?php
                              $i = -1;
                              foreach ($lignebondereservations as $i => $lig) :

                              ?>
                                <tr>
                                  <td style="width: 30%;" align="center">

                                    <?php echo $this->Form->input('sup', array('name' => 'data[tabligne2][' . $i . '][sup]', 'id' => 'sup' . $i, 'champ' => 'sup', 'table' => 'tabligne2', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'type' => 'hidden', 'class' => 'form-control'));
                                    ?>
                                    <?php echo $this->Form->input('id', array('label' => '', 'value' => $lig->id, 'champ' => 'id', 'name' => 'data[tabligne2][' . $i . '][id]', 'type' => 'hidden', 'id' => 'id' . $i, 'table' => 'tabligne2', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control'));
                                    ?>
                                    <?php echo $this->Form->control('article_id', array('options' => $articles, 'label' => '', 'Value' => h($lig->article_id), 'name' => 'data[tabligne2][' . $i . '][article_id]',  'id' => 'article_id' . $i, 'table' => 'tabligne2', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control')); ?>

                                  </td>
                                  <td style="width: 30%;" align="center">

                                    <input table="tabligne2" type='text' champ='quantitéstock' class='form-control ' class='input' style="margin-right:50%;margin-top: 20px;" disabled>

                                  </td>
                                  <td style="width: 30%;margin-right:50%;margin-top: 20px;" align="center">

                                    <?php echo $this->Form->input('quantite', array('label' => '', 'value' => $lig->quantite, 'name' => 'data[tabligne2][' . $i . '][quantite]', 'type' => 'text', 'id' => 'quantite' . $i, 'table' => 'tabligne2', 'index' => $i, 'div' => 'form-group', 'between' => '<div class="col-sm-12">', 'after' => '</div>', 'class' => 'form-control number')); ?>

                                  </td>
                                  <td align="center">
                                    <i index="<?php echo $i ?>" class="fa fa-times supLigne" style="color: #C9302C;font-size: 22px;">
                                  </td>
                                </tr>
                              <?php endforeach; ?>




                            </tbody>
                          </table><br>
                          <input type="hidden" value="<?php echo $i ?>" id="index2">
                        </div>
                      </div>
                    </div>
                  </div>

                </section>
              </div>


            </div>

          </div>


        </div>

        <div class="text-center">

          <?php echo $this->Form->submit(__('enregistrer'), ['class' => 'btn btn-primary TestQte']); ?>

          <?php echo $this->Form->end(); ?>
        </div>


      </div>
    </div>
  </div>

  </div>

  </div>

</section>
<script>
  $(function() {

    $('.supLigne').on('click', function() {
      //  alert('hh');
      //index = $(this).attr('index');
      index = $(this).attr('index');
      // alert(index)
      //bootbox.confirm("�tes-vous s�r de supprimer la ligne!!", function (result) {
      // if (result) {
      $('.supLigne').each(function() {
        ind = $(this).attr('index');
        if (ind == index) {
          $('#sup' + index).val(1);
          $(this).parent().parent().hide();
        }
      })
      //}


    })

    function ajouter_ligne(table, index) {
      ind = Number($('#' + index).val()) + 1;

      $ttr = $('#' + table).find('.tr').clone(true);
      $ttr.attr('class', '');
      i = 0;
      tabb = [];
      $ttr.find('input,select,textarea,tr,td,div').each(function() {
        tab = $(this).attr('table'); //alert(tab)
        champ = $(this).attr('champ');
        $(this).attr('index', ind);
        $(this).attr('id', champ + ind);
        $(this).attr('name', 'data[' + tab + '][' + ind + '][' + champ + ']');
        $(this).attr('data-bv-field', 'data[' + tab + '][' + ind + '][' + champ + ']');
        $type = $(this).attr('type');
        $(this).val('');
        if ($type == 'radio') {
          $(this).attr('name', 'data[' + champ + ']');
          //$(this).attr('value',ind);
          $(this).val(ind);
        }
        if ((champ == 'datedebut') || (champ == 'datefin')) {
          $(this).attr('onblur', 'nbrjour(' + ind + ')')
        }

        $(this).removeClass('anc');
        if ($(this).is('select')) {
          tabb[i] = champ + ind;
          i = Number(i) + 1;
        }
        // $(this).val('');

      })
      $ttr.find('i').each(function() {
        $(this).attr('index', ind);
      });
      $('#' + table).append($ttr);
      $('#' + index).val(ind);
      $('#' + table).find('tr:last').show();
      for (j = 0; j <= i; j++) {
        //  uniform_select(tabb[j]);
      }
      /*$('#datedebut'+ind).datetimepicker({
    timepicker: false,
    datepicker:true,
    mask:'39/19/9999',
    format:'d/m/Y'});
   $('#datefin'+ind).datetimepicker({
    timepicker: false,
    datepicker:true,
    mask:'39/19/9999',
    format:'d/m/Y'});
$('#date'+ind).datetimepicker({
    timepicker: false,
    datepicker:true,
    mask:'39/19/9999',
    format:'d/m/Y'});
           
   */
    }
    $('.TestQte').on('mousemove', function() {
      index = $('#index2').val();

      article_id = $('#article_id' + index).val();
      for (var i = 0; i <= index; i++) {
        sup = $('#sup' + i).val();
        //alert(sup);

        if (sup != 1) {
          art = $('#article_id' + i).val();
          if (art == "") {
            alert('Choisir article svp ', function() {});
            return false;
          }
          quantite_id = $('#quantite' + i).val();
          if (quantite_id == "") {
            alert('Choisir quantite svp  ', function() {});
            return false;
          }
        } else {
          alert('ajouter Ligne bon de reservation')
        }
      }
      pointdevente_id = $('#pointdevente_id').val();
      if (pointdevente_id == "") {
        alert('Choisir point de vente svp ', function() {});
        return false;
      }
      depot_id = $('#depot_id').val();
      if (depot_id == "") {
        alert('Choisir depot svp ', function() {});
        return false;
      }
      client_id = $('#client_id').val();
      if (client_id == "") {
        alert('Choisir client svp ', function() {});
        return false;
      }
      date_id = $('#date_id').val(); //alert(date_id)
      if (date_id == "") {
        alert('choisir date SVP', function() {});
        return false
      }
      if (index == -1) {
        alert('ajouter ligne bon de reservation', function() {});
        return false;
      }
    });
    $('#ajouter_ligne2').on('click', function() {

      index = Number($('#index2').val());
      sup = $('#sup' + index).val();

      alert(index)
      coffre = $('#article_id' + index).val(); //alert(index)
      coffree = $('#quantitéstock' + index).val(); //alert(index)
      coffreee = $('#quantite' + index).val(); //alert(index)

      if (coffre == "" && sup != 1) {
        bootbox.alert('Veuillez remplir la premiere ligne', function() {});
      } else {
        ajouter_ligne('tabligne2', 'index2');
      }




    });
    $('.supLigne').on('click', function() {
      //  alert('hh');
      //index = $(this).attr('index');
      index = $(this).attr('index');
      // alert(index)
      //bootbox.confirm("�tes-vous s�r de supprimer la ligne!!", function (result) {
      // if (result) {
      $('.supLigne').each(function() {
        ind = $(this).attr('index');
        if (ind == index) {
          $('#sup' + index).val(1);
          $(this).parent().parent().hide();
        }
      })
      //}


    })
  })
</script>